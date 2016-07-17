<?php
use utilphp\util;

class functions_dump
{
    /**
     * 富文本输出
     *
     * @var
     */
    const RICH_HTML = TRUE;
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
        if (!(self::$_instance instanceof static)) {
            self::$_instance = new static ();
        }
        return self::$_instance;
    }

    function dump($varVal, $isExit = FALSE, $linestack = 0)
    {
        if (C(configure_constants::DUMP_ENABLE)) {
            $debuginfo = debug_backtrace();
            $debuginfo = $debuginfo [$linestack];
            echo $debuginfo ["file"] . ":" . $debuginfo ['line'] . '<br>';
            if (self::RICH_HTML) {
                util::var_dump($varVal, false, -1);
            } else {

                ob_start();
                var_dump($varVal);
                $varVal = ob_get_clean();
                $varVal = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $varVal);
                echo '<pre>' . $varVal . '</pre>';
            }

            $isExit && exit ();
        }
    }

    /**
     * 打印调用堆栈
     * @param int $lineStack
     * @param bool|FALSE $return
     * @return array
     */
    function dump_stack($lineStack = 0, $return = FALSE)
    {
        $debug_Info = debug_backtrace();
        $stack = [];
        foreach ($debug_Info as $value) {
            if (isset($value['file'])) {
                $info = $value ['file'] . ':' . $value ['line'] . " " . $value ['function'];
                $stack[] = $info;
            }
        }
        array_shift($stack);
        if ($return) {
            return $stack;
        } else {
            $this->dump($stack, FALSE, $lineStack + 1);
        }
    }

    /**
     * 管道输出标志位
     *
     * @var bool
     */
    private $dump_pool_enable = FALSE;

    /**
     * 开始管道输出
     */
    public function dump_pool_start()
    {
        $this->dump_pool_enable = TRUE;
    }

    /**
     * 结束管道输出
     */
    public function dump_pool_end()
    {
        $this->dump_pool_enable = FALSE;
    }

    /**
     * 管道输出
     *
     * @param mixed $varVal
     *            输出的变量
     * @param bool $isExit
     *            是否中断
     * @param number $linestack
     *            堆栈数量
     */
    function dump_pool($varVal, $isExit = FALSE, $linestack = 0)
    {
        if ($this->dump_pool_enable) {
            $this->dump($varVal, $isExit, $linestack + 1);
        }
    }

    /**
     * @param int $linestack
     * @param bool|FALSE $return
     * @return array
     */
    public function dump_pool_stack($linestack = 0, $return = FALSE)
    {
        if ($this->dump_pool_enable) {
            return $this->dump_stack($linestack + 1, $return = FALSE);
        }
        return [];
    }
}

function dump_pool_start()
{
    functions_dump::getInstance()->dump_pool_start();
}

function dump_pool_end()
{
    functions_dump::getInstance()->dump_pool_end();
}

/**
 * @param $varVal
 * @param bool|FALSE $isExit
 * @param int $linestack
 */
function dump_pool($varVal, $isExit = FALSE, $linestack = 0)
{
    functions_dump::getInstance()->dump_pool($varVal, $isExit, $linestack + 1);
}

function dump_pool_stack($linestack = 0, $return = FALSE)
{
    return functions_dump::getInstance()->dump_pool_stack($linestack + 1, $return);
}

/**
 *
 * @param mixed $varVal
 * @param string $isExit
 * @param number $linestack
 *            输出行信息 一般默认即可
 */
function dump($varVal, $isExit = FALSE, $linestack = 0)
{
    functions_dump::getInstance()->dump($varVal, $isExit, $linestack + 1);
}

/**
 * 打印调用堆栈
 */
function dump_stack($return = FALSE)
{
    return functions_dump::getInstance()->dump_stack(1, $return);
}

