<?php
namespace Common\Util;
/**
 * @package common
 * @subpackage util
 * @author kain
 *
 */
class Common_Util_LocalCacheHandle
{

	public $instance;
	public $usekxi = false;

	function set($key, $value)
	{
		try
		{
			$value = strval($value);
			//不允许设置空串
			if ($value == "")
			{
				return false;
			}
			if ($this->usekxi)
			{
				$pars = array(
				    "key" => $key,
				    "value" => $value,
				);
				$ret = $this->instance->invoke("set", $pars);
				return $ret['ok'];
			}
			else
			{
				return $this->instance->set($key, $value);
			}
		}
		catch (Exception $ex)
		{
			return false;
		}
	}

	function setObj($key, $value)
	{
		try
		{
			$value = serialize($value);
			if ($value == "")
			{
				return false;
			}
			return $this->set($key, $value);
		}
		catch (Exception $ex)
		{
			return false;
		}
	}

	private function spx_get($key, $expire, $obj=false)
	{
		try
		{
			if (is_array($key))
			{
				if (empty($key))
				{
					return array();
				}
				$key = array_unique($key);
				$len = count($key);
				$tmpret = array();
				for ($i = 0; $i < $len; $i+=500)
				{
					$subkey = array_slice($key, $i, 500);
					$tmpret = array_merge($tmpret, $this->instance->getAll($subkey, $expire));
				}
				$ret = array();
				foreach ($tmpret as $k => $v)
				{
					if (strlen($v))
					{
						if ($obj)
						{
							$ret[$k] = unserialize($v);
						}
						else
						{
							$ret[$k] = $v;
						}
					}
					else
					{
						$ret[$k] = false;
					}
				}
				return $ret;
			}
			else
			{
				$ret = $this->instance->get($key, $expire);
				if ($obj)
				{
					return ($ret != "" ? unserialize($ret) : false);
				}
				else
				{
					return ($ret != "" ? $ret : false);
				}
			}
		}
		catch (Exception $ex)
		{
			return false;
		}
	}

	private function kxi_get($key, $expire, $obj = false)
	{
		try
		{
			if (is_array($key))
			{
				if (empty($key))
				{
					return array();
				}
				$key = array_unique($key);
				$len = count($key);
				$tmpret = array();
				for ($i = 0; $i < $len; $i+=500)
				{
					$subkey = array_slice($key, $i, 500);
					$pars = array("keys" => $subkey, "expire" => $expire);
					$ret = $this->instance->invoke("getAll", $pars);
					$tmpret = array_merge($tmpret, $ret['items']);
				}
				$ret = array();

				$ret = array();
				if ($obj)
				{
					foreach ($tmpret as $k => $v)
					{
						$v = strval($v);
						if (strlen($v))
						{
							$ret[$k] = unserialize($v);
						}
					}
				}
				else
				{
					foreach ($tmpret as $k => $v)
					{
						$v = strval($v);
						if (strlen($v))
						{
							$ret[$k] = $v;
						}
					}
				}
				return $ret;
			}
			else
			{
				$pars = array(
				    "key" => strval($key),
				    "expire" => $expire,
				);
				$ret = $this->instance->invoke("get", $pars);
				$ret = strval($ret['value']);
				if ($obj)
				{
					return ($ret != "" ? unserialize($ret) : false);
				}
				else
				{
					return ($ret != "" ? $ret : false);
				}
			}
		}
		catch (Exception $ex)
		{
			return false;
		}
	}

	function get($key, $expire)
	{
		if ($this->usekxi)
		{
			return $this->kxi_get($key, $expire);
		}
		else
		{
			return $this->spx_get($key, $expire);
		}
	}

	function getObj($key, $expire)
	{
		if ($this->usekxi)
		{
			return $this->kxi_get($key, $expire, true);
		}
		else
		{
			return $this->spx_get($key, $expire, true);
		}
	}

	function remove($key)
	{
		try
		{
			if ($this->usekxi)
			{
				$pars = array(
				    "key" => $key,
				);
				$ret = $this->instance->invoke("remove", $pars);
				return $ret['ok'];
			}
			else
			{
				return $this->instance->remove($key);
			}
		}
		catch (Exception $ex)
		{
			return false;
		}
	}

	function plus($key, $value, $expire)
	{
		try
		{
			$value = intval($value);
			if ($this->usekxi)
			{
				$pars = array(
				    "key" => $key,
				    "value" => $value,
				    "expire" => $expire,
				);
				$ret = $this->instance->invoke("plus", $pars);
				return $ret['value'];
			}
			else
			{
				return $this->instance->plus($key, intval($value), $expire);
			}
		}
		catch (Exception $ex)
		{
			return false;
		}
	}

	function remove_answer($service, $method, $params)
	{
		try
		{
			$pars = array(
			    "s" => $service,
			    "m" => $method,
			    "p" => $params,
			);
			$ret = $this->instance->invoke("remove_answer", $pars);
			return $ret['ok'];
		}
		catch (EXCEPTION $ex)
		{
			return false;
		}
	}

}

class Common_Util_LocalCache
{

	static $instance;
	static $kxiinstance;

	static function connect($name = "")
	{
		$inst = $name . "instance";
		try
		{
			if ($name == "kxi")
			{
				self::$$inst->usekxi = true;
				return kxi_createProxy("LCache");
			}
			else
			{
				self::$$inst->usekxi = false;
				return createIceProxy("LCache");
			}
		}
		catch (Exception $ex)
		{
			return false;
		}
	}

	static function getInstance($name = "")
	{
		//兼容老的错误
		if($name && $name != "kxi")
		{
			$name = "";
		}
		$name = "kxi"; // 都用 kxi
		$inst = $name . "instance";
		if (!isset(self::$$inst))
		{
			self::$$inst = new Common_Util_LocalCacheHandle();
			self::$$inst->instance = Common_Util_LocalCache::connect($name);
			if (false === self::$$inst->instance)
			{
				self::$$inst = null;
				return false;
			}
		}
		return self::$$inst;
	}

}

?>