<?php

namespace dbs\friend;

use Common\Util\Common_Util_Guid;
use dbs\templates\friend\dbs_templates_friend_requestdata;

class dbs_friend_requestdata extends dbs_templates_friend_requestdata
{


    function __construct($fromuserid, $touserid, $timespan)
    {
        parent::__construct();
        $this->set_fromuserid($fromuserid);
        $this->set_touserid($touserid);
        $this->set_timespan($timespan);
        $this->set_requestguid(Common_Util_Guid::gen_friend_request());
    }


    function get_data()
    {
        return $this->toArray();
    }
}