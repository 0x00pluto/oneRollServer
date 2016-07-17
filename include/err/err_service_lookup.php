<?php

namespace err;

class err_service_lookup_base
{
    const DEST_USER_NOT_FOUND = 1;
}

class err_service_lookup_lookupchefinfo extends err_service_lookup_base
{
}

class err_service_lookup_lookupchefhireinfo extends err_service_lookup_base
{
}

class err_service_lookup_lookupsceneinfo extends err_service_lookup_base
{
}

class err_service_lookup_lookuprestaurantinfo extends err_service_lookup_base
{
}

class err_service_lookup_lookuproleinfo extends err_service_lookup_base
{
}

class err_service_lookup_lookuproleinfobyrolename extends err_service_lookup_lookuproleinfo
{
}

class err_service_lookup_lookupsceneboxinfo extends err_service_lookup_base
{
}

class err_service_lookup_lookupsuperslotmachine extends err_service_lookup_base
{
    const SLOT_MACHINE_NOT_EXIST = 10;
}

class err_service_lookup_lookupfriendhelp extends err_service_lookup_base
{
}

class err_service_lookup_lookupPhotoAblum extends err_service_lookup_base
{
}

class err_service_lookup_lookUpNormalModel extends err_service_lookup_base
{
    /**
     * 模块不存在
     */
    const MODEL_NOT_EXISTS = 10;
}

class err_service_lookup_lookUpThemeRestaurantReputation extends err_service_lookup_base
{
    /**
     * 餐厅没有开启
     */
    const RESTARUANT_NOT_OPEN = 10;
}