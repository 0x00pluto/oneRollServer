<?php
/**
 * Created by PhpStorm.
 * User: zhipeng
 * Date: 15/12/30
 * Time: 上午11:26
 */

namespace constants;

/**
 * Class constants_sceneLayerId
 * @package constants
 */
class constants_sceneLayerId
{

    /**
     * 背景層,主要是地砖,墙纸
     *
     */
    const LAYER_ID_BACK = "layer_0";
    /**
     * 中层,主要是地摊
     *
     */
    const LAYER_ID_MID = "layer_1";
    /**
     * 前景層,主要是建筑,装饰
     *
     */
    const LAYER_ID_FRONT = "layer_2";
    /**
     * 最上层,预留,目前没想到干嘛
     *
     */
    const LAYER_ID_TOP = "layer_3";
}