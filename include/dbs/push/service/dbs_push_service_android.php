<?php

namespace dbs\push\service;

class dbs_push_service_android extends dbs_push_service_base {
	function sendBroadcast($devicetokens, $title, $contents, $attachkeyvalues = array()) {
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see dbs_push_service_base::sendUnicast()
	 */
	function sendUnicast($devicetoken, $title, $contents, $attachkeyvalues = array()) {
		try {

			$unicast = new \AndroidUnicast ();
			$unicast->setAppMasterSecret ( $this->appMasterSecret );
			$unicast->setPredefinedKeyValue ( "appkey", $this->appkey );
			$unicast->setPredefinedKeyValue ( "timestamp", $this->timestamp );
			// Set your device tokens here
			$unicast->setPredefinedKeyValue ( "device_tokens", $devicetoken );
			$unicast->setPredefinedKeyValue ( "ticker", $title );
			$unicast->setPredefinedKeyValue ( "title", $title );
			$unicast->setPredefinedKeyValue ( "text", $contents );
			$unicast->setPredefinedKeyValue ( "after_open", "go_app" );
			// Set 'production_mode' to 'false' if it's a test device.
			// For how to register a test device, please see the developer doc.
			$unicast->setPredefinedKeyValue ( "production_mode", $this->production );
			// Set extra fields
			foreach ( $attachkeyvalues as $key => $value ) {
				$unicast->setExtraField ( $key, $value );
			}

			$unicast->send ();
		} catch ( \Exception $e ) {
		}
	}
}