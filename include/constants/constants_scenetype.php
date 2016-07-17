<?php
namespace constants;
class constants_scenetype
{
    /**
     * 中餐烹饪台
     */
    const SCENETYPE_1 = '1';
    /**
     * 西餐烹饪台
     */
    const SCENETYPE_2 = '2';
    /**
     * 餐台
     */
    const SCENETYPE_3 = '3';
    /**
     * 冰箱
     */
    const SCENETYPE_4 = '4';
    /**
     * 饮料机
     */
    const SCENETYPE_5 = '5';
    /**
     * 餐桌
     */
    const SCENETYPE_6 = '6';
    /**
     * 餐椅
     */
    const SCENETYPE_7 = '7';
    /**
     * 地板
     */
    const SCENETYPE_8 = '8';
    /**
     * 墙纸
     */
    const SCENETYPE_9 = '9';
    /**
     * 摆件(地面)
     */
    const SCENETYPE_10 = '10';
    /**
     * 挂饰(墙面)
     */
    const SCENETYPE_11 = '11';
    /**
     * 窗户
     */
    const SCENETYPE_12 = '12';
    /**
     * 装饰品
     */
    const SCENETYPE_13 = '13';
    /**
     * 地毯(无用)
     */
    const SCENETYPE_14 = '14';
    /**
     * 基础墙面
     */
    const SCENETYPE_15 = '15';
    /**
     * 门
     */
    const SCENETYPE_16 = '16';
    /**
     * 地毯
     */
    const SCENETYPE_17 = '17';
    /**
     * 甜品烹饪台
     */
    const SCENETYPE_18 = '18';
    /**
     * 日料烹饪台
     */
    const SCENETYPE_19 = '19';
    /**
     * 创意烹饪台
     */
    const SCENETYPE_20 = '20';
    /**
     * 扩地牌子
     */
    const SCENETYPE_21 = '21';
    /**
     * 壁炉
     */
    const SCENETYPE_22 = '22';


    public static $itemSubtype2LayerId = [
        /**
         * 中餐烹饪台
         */
        self::SCENETYPE_1 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 西餐烹饪台
         */
        self::SCENETYPE_2 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 餐台
         */
        self::SCENETYPE_3 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 冰箱
         */
        self::SCENETYPE_4 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 饮料机
         */
        self::SCENETYPE_5 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 餐桌
         */
        self::SCENETYPE_6 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 餐椅
         */
        self::SCENETYPE_7 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 地板
         */
        self::SCENETYPE_8 => constants_sceneLayerId::LAYER_ID_BACK,
        /**
         * 墙纸
         */
        self::SCENETYPE_9 => constants_sceneLayerId::LAYER_ID_MID,
        /**
         * 摆件(地面)
         */
        self::SCENETYPE_10 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 挂饰(墙面)
         */
        self::SCENETYPE_11 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 窗户
         */
        self::SCENETYPE_12 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 装饰品
         */
        self::SCENETYPE_13 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 地毯
         */
        self::SCENETYPE_14 => constants_sceneLayerId::LAYER_ID_MID,
        /**
         * 基础墙面
         */
        self::SCENETYPE_15 => constants_sceneLayerId::LAYER_ID_BACK,
        /**
         * 门
         */
        self::SCENETYPE_16 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 地毯
         */
        self::SCENETYPE_17 => constants_sceneLayerId::LAYER_ID_MID,
        /**
         * 甜品烹饪台
         */
        self::SCENETYPE_18 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 日料烹饪台
         */
        self::SCENETYPE_19 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 创意烹饪台
         */
        self::SCENETYPE_20 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 扩地牌子
         */
        self::SCENETYPE_21 => constants_sceneLayerId::LAYER_ID_FRONT,
        /**
         * 壁炉
         */
        self::SCENETYPE_22 => constants_sceneLayerId::LAYER_ID_FRONT
    ];
}