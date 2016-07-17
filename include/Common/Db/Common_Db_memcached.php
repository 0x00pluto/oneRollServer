<?php

namespace Common\Db;

/**
 * Memcache 操作类
 *
 * 在config文件中 添加
 * 相应配置(可扩展为多memcache server)
 * define('MEMCACHE_HOST', '10.35.52.33');
 * define('MEMCACHE_PORT', 11211);
 * define('MEMCACHE_EXPIRATION', 0);
 * define('MEMCACHE_PREFIX', 'licai');
 * define('MEMCACHE_COMPRESSION', FALSE);
 * demo:
 * $cacheObj = new Common_Db_memcached();
 * $cacheObj -> set('keyName','this is value');
 * $cacheObj -> get('keyName');
 * exit;
 *
 * @access public
 * @return object @date 2012-07-02
 */
class Common_Db_memcached
{
    private $local_cache = array();
    /**
     *
     * @var \Memcache|\Memcached
     */
    private $m;
    private $client_type;
    protected $errors = array();
    // 保存类实例的静态成员变量
    private static $_instance;

    // 单例方法,用于访问实例的公共的静态方法
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $fristclassname = 'Memcached';
        $secondclassname = 'Memcache';

        $this->client_type = class_exists($fristclassname) ? $fristclassname : (class_exists($secondclassname) ? $secondclassname : FALSE);
        if ($this->client_type) {
            $newConnect = true;
            // 判断引入类型
            switch ($this->client_type) {
                case 'Memcached' :
                    $this->m = new \Memcached ('hella_connect');
                    if (count($this->m->getServerList()) == 0) {
                        $this->m->setOption(\Memcached::OPT_COMPRESSION, false); // 关闭压缩功能
                        $this->m->setOption(\Memcached::OPT_BINARY_PROTOCOL, true); // 使用binary二进制协议
                    } else {
                        // dump ( $this->m->getServerList () );
                        // dump ( C ( \configure_constants::MEMCACHE_HOST ) );
                        // dump ( "长连接" );
                        $newConnect = false;
                    }

                    break;
                case 'Memcache' :
                    $this->m = new \Memcache ();
                    // if (auto_compress_tresh){
                    // $this->setcompressthreshold(auto_compress_tresh, auto_compress_savings);
                    // }
                    break;
            }
            // dump ( $this->client_type );
            if ($newConnect) {
                $this->auto_connect();
            }
        } else {
            echo 'ERROR: Failed to load Memcached or Memcache Class (∩_∩)';
            exit ();
        }
    }

    /**
     * @Name: auto_connect
     *
     * @param
     *            :none
     * @todu 连接memcache server
     * @return : none
     *         add by cheng.yafei
     *
     */
    private function auto_connect()
    {
        $configServer = array(
            'host' => C(\configure_constants::MEMCACHE_HOST),
            'port' => C(\configure_constants::MEMCACHE_PORT),
            'weight' => 1
        );

        // dump ( "auto_connect" );

        if (!$this->add_server($configServer)) {
            echo 'ERROR: Could not connect to the server named ' . C(\configure_constants::MEMCACHE_HOST);
        } else {
            // echo 'SUCCESS:Successfully connect to the server named '.MEMCACHE_HOST;
        }
    }

    /**
     * @Name: add_server
     *
     * @param
     *            :none
     * @todu 连接memcache server
     * @return : TRUE or FALSE
     *         add by cheng.yafei
     *
     */
    private function add_server($server)
    {
        extract($server);
        return $this->m->addServer($host, $port, $weight);
    }

    /**
     * @Name: add_server
     * @todu 添加
     *
     * @param
     *            :$key key
     * @param
     *            :$value 值
     * @param
     *            :$expiration 过期时间
     * @return : TRUE or FALSE
     *         add by cheng.yafei
     *
     */
    public function add($key = NULL, $value = NULL, $expiration = 0)
    {
        if (is_null($expiration)) {
            $expiration = C(\configure_constants::MEMCACHE_EXPIRATION);
        }
        $expiration = intval($expiration);

        $add_status = false;
        if (is_array($key)) {
            foreach ($key as $multi) {
                if (!isset ($multi ['expiration']) || $multi ['expiration'] == '') {
                    $multi ['expiration'] = $expiration;
                }
                $this->add($this->key_name($multi ['key']), $multi ['value'], $multi ['expiration']);
            }
        } else {
            $keyname = $this->key_name($key);
            $this->local_cache [$keyname] = $value;
            switch ($this->client_type) {
                case 'Memcache' :
                    $add_status = $this->m->add($keyname, $value, C(\configure_constants::MEMCACHE_COMPRESSION), $expiration);
                    break;

                default :
                case 'Memcached' :

                    $add_status = $this->m->add($keyname, $value, $expiration);
                    // dump ( [
                    // $add_status,
                    // $keyname,
                    // $this->m->getServerList ()
                    // ] );
                    break;
            }

        }
        return $add_status;
    }

    /**
     * @Name 与add类似,但服务器有此键值时仍可写入替换
     *
     * @param $key key
     * @param $value 值
     * @param $expiration 过期时间
     * @return TRUE or FALSE
     *         add by cheng.yafei
     *
     */
    public function set($key = NULL, $value = NULL, $expiration = NULL)
    {
        if (is_null($expiration)) {
            $expiration = C(\configure_constants::MEMCACHE_EXPIRATION);
        }
        $add_status = false;
        if (is_array($key)) {
            foreach ($key as $multi) {
                if (!isset ($multi ['expiration']) || $multi ['expiration'] == '') {
                    $multi ['expiration'] = $expiration;
                }
                $this->set($this->key_name($multi ['key']), $multi ['value'], $expiration);
            }
        } else {
            $this->local_cache [$this->key_name($key)] = $value;
            switch ($this->client_type) {
                case 'Memcache' :
                    $add_status = $this->m->set($this->key_name($key), $value, C(\configure_constants::MEMCACHE_COMPRESSION), $expiration);
                    break;
                case 'Memcached' :
                    $add_status = $this->m->set($this->key_name($key), $value, $expiration);
                    break;
            }
        }
        return $add_status;
    }

    /**
     * @Name get 根据键名获取值
     *
     * @param $key key
     * @return array OR json object OR string...
     *         add by cheng.yafei
     *
     */
    public function get($key = NULL)
    {
        if ($this->m) {
            $keyname = $this->key_name($key);
            if (isset ($this->local_cache [$keyname])) {
                return $this->local_cache [$keyname];
            }
            if (is_null($key)) {
                $this->errors [] = 'The key value cannot be NULL';
                return false;
            }

            if (is_array($key)) {
                foreach ($key as $n => $k) {
                    $key [$n] = $this->key_name($k);
                }
                return $this->m->getMulti($key);
            } else {

                $obj = $this->m->get($keyname);
                $this->local_cache [$keyname] = $obj;

// 				dump_stack ();
                return $obj;
            }
        } else {
            return false;
        }
    }

    /**
     * @Name delete
     *
     * @param string $key key
     * @param $expiration 服务端等待删除该元素的总时间
     * @return true OR false
     *         add by cheng.yafei
     *
     */
    public function delete($key, $expiration = NULL)
    {
        if (is_null($key)) {
            $this->errors [] = 'The key value cannot be NULL';
            return FALSE;
        }

        if (is_null($expiration)) {
            $expiration = C(\configure_constants::MEMCACHE_EXPIRATION);
        }

        if (is_array($key)) {
            foreach ($key as $multi) {
                $this->delete($multi, $expiration);
            }
        } else {
            unset ($this->local_cache [$this->key_name($key)]);
            return $this->m->delete($this->key_name($key), $expiration);
        }
        return false;
    }

    /**
     * @Name replace
     *
     * @param $key 要替换的key
     * @param $value 要替换的value
     * @param $expiration 到期时间
     * @return none add by cheng.yafei
     *
     */
    public function replace($key = NULL, $value = NULL, $expiration = NULL)
    {
        if (is_null($expiration)) {
            $expiration = C(\configure_constants::MEMCACHE_EXPIRATION);
        }
        if (is_array($key)) {
            foreach ($key as $multi) {
                if (!isset ($multi ['expiration']) || $multi ['expiration'] == '') {
                    $multi ['expiration'] = $expiration;
                }
                $this->replace($multi ['key'], $multi ['value'], $expiration);
            }
        } else {
            $this->local_cache [$this->key_name($key)] = $value;

            switch ($this->client_type) {
                case 'Memcache' :
                    $replace_status = $this->m->replace($this->key_name($key), $value, C(\configure_constants::MEMCACHE_COMPRESSION), $expiration);
                    break;
                case 'Memcached' :
                    $replace_status = $this->m->replace($this->key_name($key), $value, $expiration);
                    break;
            }

            return $replace_status;
        }
    }

    /**
     * @Name replace 清空所有缓存
     *
     * @return none add by cheng.yafei
     *
     */
    public function flush()
    {
        return $this->m->flush();
    }

    /**
     * @Name 获取服务器池中所有服务器的版本信息
     */
    public function getversion()
    {
        return $this->m->getVersion();
    }

    /**
     * @Name 获取服务器池的统计信息
     */
    public function getstats($type = "items")
    {
        switch ($this->client_type) {
            case 'Memcache' :
                $stats = $this->m->getStats($type);
                break;

            default :
            case 'Memcached' :
                $stats = $this->m->getStats();
                break;
        }
        return $stats;
    }

    /**
     * @Name: 开启大值自动压缩
     *
     * @param
     *            :$tresh 控制多大值进行自动压缩的阈值。
     * @param
     *            :$savings 指定经过压缩实际存储的值的压缩率，值必须在0和1之间。默认值0.2表示20%压缩率。
     * @return : true OR false
     *         add by cheng.yafei
     *
     */
    public function setcompressthreshold($tresh, $savings = 0.2)
    {
        switch ($this->client_type) {
            case 'Memcache' :
                $setcompressthreshold_status = $this->m->setCompressThreshold($tresh, $savings = 0.2);
                break;

            default :
                $setcompressthreshold_status = TRUE;
                break;
        }
        return $setcompressthreshold_status;
    }

    /**
     * @Name: 生成md5加密后的唯一键值
     *
     * @param
     *            :$key key
     * @return : md5 string
     *         add by cheng.yafei
     *
     */
    public function key_name($key)
    {

        return md5(strtolower(C(\configure_constants::MEMCACHE_PREFIX) . $key));
    }

    /**
     * @Name: 向已存在元素后追加数据
     *
     * @param
     *            :$key key
     * @param
     *            :$value value
     * @return : true OR false
     *         add by cheng.yafei
     *
     */
    public function append($key = NULL, $value = NULL)
    {
        $this->local_cache [$this->key_name($key)] = $value;

        switch ($this->client_type) {
            case 'Memcache' :
                $append_status = $this->m->append($this->key_name($key), $value);
                break;

            default :
            case 'Memcached' :
                $append_status = $this->m->append($this->key_name($key), $value);
                break;
        }

        return $append_status;
    } // END append
} // END class
?>