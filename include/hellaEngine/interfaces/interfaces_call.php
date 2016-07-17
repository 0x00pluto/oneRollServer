<?php

namespace hellaEngine\interfaces;

/**
 * 调用接口
 *
 * @author zhipeng
 *
 */
interface interfaces_call {
	/**
	 * 实际调用主函数前调用
	 */
	function call_before();

	/**
	 * 实际调用主函数后调用
	 */
	function call_after();

	/**
	 * 所有调用之后
	 */
	function call_end();
}