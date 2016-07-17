<?php

namespace hellaEngine\utils\schedule;

use Common\Db\Common_Db_memcacheObject;
use Common\Db\Common_Db_pools;
use Common\Util\Common_Util_LockInterface;
use Common\Util\Common_Util_LockMemcache;
use Common\Util\Common_Util_Log;

/**
 * 定时器管理器
 *
 * @author zhipeng
 *
 */
class utils_schedule_manager
{
    /**
     * 缓存的key
     *
     * @var
     */
    const MEMCACHE_KEY = 'utils_schedule_manager';

    /**
     * 超时时间
     *
     * @var
     */
    const MEMCACHE_TIMEOUT = 60;

    /**
     * singleton
     */
    private static $_instance;

    private function __construct()
    {
        // echo 'This is a Constructed method;';
    }

    public function __clone()
    {
        trigger_error('Clone is not allow!', E_USER_ERROR);
    }

    // 单例方法,用于访问实例的公共的静态方法
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }

    /**
     *
     * @var Common_Util_LockInterface
     */
    private $locker = NULL;
    /**
     * 是否使用缓存
     *
     */
    private $use_memcached = true;

    /**
     *
     * @var string
     */
    const DBKey_tablename = "schedule";

    /**
     *
     * @return \Common\Db\Common_Db_mongo
     */
    protected function db_connect()
    {
        return Common_Db_pools::default_Db_pools()->dbconnect();
    }

    /**
     * 添加任务
     *
     * @param $taskname
     * @param $tasktype
     * @param $attime_or_timeinterval
     * @param utils_schedule_itask $taskobj
     * @return utils_schedule_task
     */
    function addTask($taskname, $tasktype, $attime_or_timeinterval, utils_schedule_itask $taskobj)
    {
        $task = new utils_schedule_task ();
        $task->set_taskname($taskname);
        $task->set_taskrunattime($attime_or_timeinterval);
        $task->set_taskruntimeinterval($attime_or_timeinterval);
        $task->set_tasktype($tasktype);
        $task->set_taskstarttime(0);
        $task->set_taskobj($taskobj);

        $db = $this->db_connect();
        $db->update(self::DBKey_tablename, $task->toArray(), [
            utils_schedule_task::DBKey_taskname => $task->get_taskname()
        ], true);

        return $task;
    }

    /**
     * 是否有任务
     *
     * @param unknown $taskname
     * @return boolean
     */
    function hasTask($taskname)
    {
        $db = $this->db_connect();
        $count = $db->count(self::DBKey_tablename,
            [
                utils_schedule_task::DBKey_taskname => $taskname
            ]);
        return $count != 0;
    }

    /**
     * 删除任务
     *
     * @param unknown $taskname
     */
    function removeTask($taskname)
    {
        $db = $this->db_connect();
        $db->delete(self::DBKey_tablename, array(
            utils_schedule_task::DBKey_taskname => $taskname
        ));
    }

    /**
     * 获取所有任务
     *
     * @return array
     */
    private function getTasks()
    {
        $memcacheObj = null;
        if ($this->use_memcached) {
            $memcacheObj = Common_Db_memcacheObject::create(self::MEMCACHE_KEY);
            $memcacheObj->setExpiration(self::MEMCACHE_TIMEOUT);
            $tasks = $memcacheObj->get_value();
            if (!is_null($tasks)) {
                return $tasks;
            }
        }

        $db = $this->db_connect();
        $ret = $db->query(self::DBKey_tablename);


        $tasks = array();
        foreach ($ret as $taskdata) {
            $task = new utils_schedule_task ();
            $task->fromArray($taskdata);
            $tasks [] = $task;
        }
        if ($this->use_memcached) {
            $memcacheObj->set_value($tasks);
        }

        return $tasks;
    }

    /**
     * 保存任务
     *
     * @param array $tasks
     */
    private function saveTasks(array $tasks)
    {
        $db = $this->db_connect();
        foreach ($tasks as $taskdata) {
            /**@var $taskdata utils_schedule_task */
            $db->update(self::DBKey_tablename, $taskdata->toArray(), array(
                utils_schedule_task::DBKey_taskname => $taskdata->get_taskname()
            ));
        }
        if ($this->use_memcached) {
            $memcacheObj = Common_Db_memcacheObject::create(self::MEMCACHE_KEY);
            $memcacheObj->setExpiration(self::MEMCACHE_TIMEOUT);
            $memcacheObj->set_value($tasks);
        }
    }

    /**
     * 更新
     */
    final function update()
    {
        $locker = new Common_Util_LockMemcache ();
        $locker->set_key("schedule_manager");
        if (!$locker->lock(60, FALSE)) {
            return;
        }

        $tasks = $this->getTasks();
        $dirty = false;
        foreach ($tasks as $key => $task) {

            $error = 0;
            $bdirty = $this->runTask($task, $error);
            if ($error != 0) {
                unset ($tasks [$key]);
                $bdirty = true;
            }
            if ($bdirty) {
                $dirty = true;
            }
        }
        if ($dirty) {
            $this->saveTasks($tasks);
        }
    }

    /**
     * 运行任务
     *
     * @param utils_schedule_task $task
     * @param integer $error
     *            是否运行报错
     * @return boolean
     */
    private function runTask(utils_schedule_task $task, &$error = 0)
    {
        $b_run = false;
        $now = time();
        switch ($task->get_tasktype()) {
            case utils_schedule_constants::RUN_AT_TIME :

                break;

            case utils_schedule_constants::RUN_EVERY_SECOND :
                if ($task->get_taskstarttime() == 0) {
                    // 第一次运行
                    $frist_run_time = ($now - $task->get_taskruntimeinterval() - 1);
                    $task->set_taskstarttime($frist_run_time);
                    $task->set_tasklastruntime($frist_run_time);
                }

                // 运行次数
                $taskrun_lasttime = $task->get_tasklastruntime();
                $runcount = ($now - $taskrun_lasttime) / $task->get_taskruntimeinterval();
                $runcount = intval($runcount);

                // 不够运行的
                if ($runcount === 0) {

                    break;
                }

                try {
                    // 任务对象

                    $taskobj = unserialize($task->get_taskobj());

                    $runtimeinterval = $task->get_taskruntimeinterval();

                    for ($i = 0; $i < $runcount; $i++) {

                        $run_at_time = $taskrun_lasttime + $runtimeinterval * ($i + 1);

                        $task->set_tasklastruntime($run_at_time);
                        $taskobj->onSchedule($run_at_time);
                    }
                } catch (\Exception $e) {
                    // 异常

                    Common_Util_Log::record_error('task_run_error', $e);
                    $error = 1;
                } finally {
                    $b_run = true;
                }

                break;
            default :
                ;
                break;
        }

        return $b_run;
    }
}