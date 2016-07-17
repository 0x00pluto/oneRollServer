<?php
namespace err;
class err_service_neighboorhood_getneighboorhoodinfo {
	/**
	 * 不在一个组里面
	 *
	 * @var unknown
	 */
	const NOT_IN_GROUP = 1;

	/**
	 * 群组信息不存在
	 *
	 * @var unknown
	 */
	const NEIGHBOORHOOD_INFO_NOT_EXISTS = 2;
}
class err_service_neighboorhood_getmymemberinfo extends err_dbs_neighbourhood_playerdata_getmemberinfo {
}
class err_service_neighboorhood_sendgiftpackage extends err_dbs_neighbourhood_playerdata_sendgiftpackage {
}
class err_service_neighboorhood_recvgiftpackage extends err_dbs_neighbourhood_playerdata_recvgiftpackage {
}
class err_service_neighboorhood_thanksgiftpackagesender extends err_dbs_neighbourhood_playerdata_thanksgiftpackagesender {
}