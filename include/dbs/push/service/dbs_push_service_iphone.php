<?php

namespace dbs\push\service;

class dbs_push_service_iphone extends dbs_push_service_base {
	function sendBroadcast($devicetokens, $title, $contents, $attachkeyvalues = array()) {
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see dbs_push_service_base::sendUnicast()
	 */
	function sendUnicast($devicetoken, $title, $contents, $attachkeyvalues = array()) {
		try {
			$unicast = new \IOSUnicast ();
			$unicast->setAppMasterSecret ( $this->appMasterSecret );
			$unicast->setPredefinedKeyValue ( "appkey", $this->appkey );
			$unicast->setPredefinedKeyValue ( "timestamp", $this->timestamp );
			// Set your device tokens here
			$unicast->setPredefinedKeyValue ( "device_tokens", $devicetoken );
			$unicast->setPredefinedKeyValue ( "alert", $contents );
			$unicast->setPredefinedKeyValue ( "badge", 1 );
			$unicast->setPredefinedKeyValue ( "sound", "chime" );
			$unicast->setPredefinedKeyValue ( "content-available", $contents );
			// Set 'production_mode' to 'true' if your app is under production mode

			$unicast->setPredefinedKeyValue ( "production_mode", $this->production );
			// Set customized fields
			foreach ( $attachkeyvalues as $key => $value ) {
				$unicast->setCustomizedField ( $key, $value );
			}

			// print ("Sending unicast notification, please wait...\r\n") ;
			$unicast->send ();
			// print ("Sent SUCCESS\r\n") ;
		} catch ( \Exception $e ) {
			// print ("Caught exception: " . $e->getMessage ()) ;
		}
	}
}