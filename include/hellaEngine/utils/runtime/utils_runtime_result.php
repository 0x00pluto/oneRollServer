<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 16/8/11
 * Time: 下午3:06
 */

namespace hellaEngine\utils\runtime;


use hellaEngine\data\interfaces\data_interfaces_serialize;

class utils_runtime_result implements data_interfaces_serialize
{

    /**
     * 是否成功
     *
     * @var string
     */
    const DBKey_retsucc = "retsucc";

    /**
     * 返回code
     *
     * @var string
     */
    const DBKey_retcode = "retcode";

    /**
     * 返回数据
     *
     * @var string
     */
    const DBKey_retdata = "retdata";

    /**
     * 返回code str解释
     *
     * @var string
     */
    const DBKey_retcode_str = "retcode_str";

    /**
     *
     * 构建消息返回值
     *
     * @param bool $succ
     *            true or false
     * @param string $code
     *            代码
     * @param mixed $data
     *            扩展包含数据
     *
     * @return utils_runtime_result
     */
    public static function Ret($succ, $code = '', $data = null, $code_string = '')
    {
        $retarr = new self ($succ, $code, $data, $code_string);

        return $retarr;
    }

    /**
     *
     * 构建消息返回值(成功)
     *
     * @param array $data
     *            扩展包含数据
     * @param string $code
     *            代码
     *
     * @param string $code_string
     * @return utils_runtime_result
     */
    public static function createSucc($data = [], $code = '', $code_string = 'SUCC')
    {
        return self::Ret(true, $code, $data, $code_string);
    }

    /**
     *
     * 构建消息返回值(失败)
     *
     *
     * @param string $code
     *            代码
     * @param string $code_string
     * @param array $data
     *            扩展包含数据
     *
     * @return utils_runtime_result
     */
    public static function createFail($code, $code_string = '', $data = null)
    {
        return self::Ret(false, $code, $data, $code_string);
    }


    private $_data = array();

    function __construct($succ, $code = '', $data = null, $code_string = '')
    {
        $succ = boolval($succ);
        $code_string = strval($code_string);
        $this->_data [self::DBKey_retsucc] = $succ;
        $this->_data [self::DBKey_retcode] = $code;
        $this->_data [self::DBKey_retdata] = $data;
        $this->_data [self::DBKey_retcode_str] = $code_string;
    }

    /**
     * 获取返回码
     *
     * @return string
     */
    function get_retcode()
    {
        return $this->_data [self::DBKey_retcode];
    }

    /**
     * 是否成功
     *
     * @return boolean
     */
    function is_succ()
    {
        return boolval($this->_data [self::DBKey_retsucc]);
    }


    /**
     * 设置失败
     * @return $this
     */
    function set_failed()
    {
        $this->_data [self::DBKey_retsucc] = FALSE;
        return $this;
    }

    /**
     * 设置成功
     * @return $this
     */
    function set_succ()
    {
        $this->_data [self::DBKey_retsucc] = TRUE;
        return $this;
    }

    /**
     * 获取返回数据
     *
     * @return array:
     */
    function get_retdata()
    {
        return $this->_data [self::DBKey_retdata];
    }

    private function set_retdata($data)
    {
        $this->_data [self::DBKey_retdata] = $data;
    }

    /**
     * 增加返回值携带数据
     * @param $key
     * @param $value
     * @return $this
     */
    function add_retData($key, $value)
    {
        $retdata = $this->get_retdata();
        $retdata[$key] = $value;
        $this->set_retdata($retdata);
        return $this;
    }

    /**
     * 获取返回码说明
     *
     * @return string
     */
    function get_retcode_str()
    {
        return strval($this->_data [self::DBKey_retcode_str]);
    }


    public function toArray($filter = [], $excludefilter = [])
    {
        return $this->_data;
    }

    public function fromArray($arr, $exclude = NULL)
    {
        $this->_data = $arr;
    }
}