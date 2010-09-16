<?php 

/**
 * API class, used to track ratio, CRUD personal information, etc.
 * 
 * Full functionality modules can be enabled/disabled by SysOp
 * ex: SysOp temporarily disables modification of user information via API
 * 
 * ## Location:
 * /package/pubapi.php
 * 
 * @package GazelleEnhanced
 * @author Pierce Moore
 * @copyright View included license.txt, located in the root directory. 
 * @link http://github.com/piercemoore/GazelleEnhanced/
 * @link http://gazelle.refreshedweb.com
 */

// First, let's grab all necesary parts from the URL for Authorization
define('USER_ID',$_GET['uid']);
define('APP_ID',$_GET['aid']);
define('APP_TOK',$_GET['tok']);

// Now we get all parts from the URL for interactivity
define('FUNC',$_GET['func']);
define('KEY',$_GET['key']);
define('VALUE',$_GET['val']);
define('FORMAT',$_GET['format']);

// Grab a few files to access their functionality..
require 'classes/config.php'; //The config contains all site wide configuration information as well as memcached rules
require(SERVER_ROOT.'/classes/class_cache.php'); // Require the caching class
require(SERVER_ROOT.'/classes/class_debug.php'); // Require the debug class
require(SERVER_ROOT.'/classes/class_mysql.php'); // Get all our database functionality

// And we're off!
class Pubapi {
	
	function __construct()
	{
		$this->db = new DbMysql;
		$this->cache = new CACHE;
		$this->debug = new DEBUG;
		$this->debug->handle_errors();
	}
	
	/**
	 * Start the exchange of information between calling device and API
	 * 
	 * @return bool
	 */
	private final function begin_transaction()
	{
		$errors = '';
		
		// First, let's make sure that they user provided at least the minimum amount of information required.
		$required = array('User ID'=>USER_ID,'Application ID'=>APP_ID,'Application Token'=>APP_TOK,'Function Name'=>FUNC,'Return Format'=>FORMAT);
		foreach($required as $k=>$v) {
			if(!isset(v) || ($v == '') || ($v == 0)) {
				$errors .= "$k is required for Gazelle Enhanced API access.<br />\n";
			}
		}
		if(!$this->validate_api_app(USER_ID,APP_ID,APP_TOK)) {
			$errors .= "Application ID " . APP_ID . " is either not a valid application, is currently disabled, or is not accessible by User " . USER_ID . ".<br />\n";
		}
		if(!$this->validate_user(USER_ID,APP_ID,APP_TOK)) {
			$errors .= "User ID " . USER_ID . " is not valid or does not have access to the API at this time.<br />\n";
		}
		if(strcmp($errors,'') == 0) {
			return true;
		}
		display_error($errors);
		return false;
	}
	
	/**
	 * Complete the exchange of information, and flush output to end user
	 * 
	 * @return string
	 */
	private final function complete_transaction()
	{
		echo $this->_output;
		exit();
	}
	
	/**
	 * Sends an error message to the end user
	 * 
	 * @param msg: string
	 * @return string
	 */
	function display_error($msg = 'Error')
	{
		$this->_output = $msg;
		$this->complete_transaction();
	}
	
	/**
	 * Ensures that a user has the ability to use the API
	 * 
	 * @param uid: int
	 * @param aid: string
	 * @param tok: string
	 * @return bool
	 */
	function validate_user($uid = USER_ID , $aid = APP_ID , $tok = APP_TOK)
	{
		
	}
	
	/**
	 * Validates a provided API key, for security purposes
	 * 
	 * @param uid: int
	 * @param aid: string
	 * @param tok: string
	 * @return bool
	 */
	function validate_api_app($uid = USER_ID , $aid = APP_ID , $tok = APP_TOK)
	{
		
	}
	
	/**
	 * Fetches all information about a user.
	 * 
	 * @param uid: int
	 * @return array
	 */
	function fetch_user($uid = USER_ID)
	{
		
	}
	
}

?>