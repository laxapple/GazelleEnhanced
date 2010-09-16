<?php 

/**
 * Class for connecting and interacting with GazelleEnhanced API
 * 
 * ## Location:
 * /cool_classes/class.whatcdapi.php
 * 
 * @package GazelleEnhanced
 * @author Pierce Moore
 * @copyright View included license.txt, located in the root directory. 
 * @link http://github.com/piercemoore/GazelleEnhanced/
 * @link http://gazelle.refreshedweb.com
 */

define('API_KEY','{{Enter API Key Here}}');
define('API_APP','{{Enter Name of Application Here}}');
define('API_SECRET','{{Enter Secret Code for App}}');

// All necessary elements defined, let's get interactive.
// P.s. Modifying anything below this line could be risky. Just let it handle the dirty work, alright?

class WhatCDAPI {
	
	function __construct()
	{
		$this->api_key = API_KEY;
		$this->api_app = API_APP;
		$this->api_secret = API_SECRET;
	}
	
}


?>