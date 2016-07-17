<?php
namespace err;
class err_dbs_shop_buygoods
{
    const GOODS_INFO_ERROR = 1;
    const LIMIT_PERSON_BUYMAX = 2;
    const LIMIT_VIPLEVEL = 3;
    const LIMIT_LEVEL = 4;
    const GAME_COIN_NOT_ENOUGH = 5;
    const DIAMOND_NOT_ENOUGH = 6;
    const POPULARITY_NOT_ENOUGH = 7;
    /**
     * 达到每日购买上限
     */
    const LIMIT_PERSON_DAILY_BUYMAX = 8;
    /**
     * 仓库已经满了
     */
    const WAREHOUSE_IS_FULL = 9;
}