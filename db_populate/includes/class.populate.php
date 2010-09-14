<?php

/**
 * Pop_users.php, the main hub for auto-population of the 'users' tables for your new Gazelle Enhanced installation.
 * 
 * ## LOCATION:
 * /db_populate/includes/class.populate.php
 * 
 * @package Gazelle Enhanced
 * @author Pierce
 * @copyright View included license.txt, located in the root directory. 
 * @link http://github.com/piercemoore/GazelleEnhanced/
 * @link http://gazelle.refreshedweb.com
 */

require_once('config.php');

class Populate {
	
	function __construct()
	{
		$this->error = new Error;
		$this->db = new Db;
	}
	
	/**
	 * Fetches array of random usernames from 'data/data_users.php'
	 * 
	 * @return array
	 */
	 */
	private final function buildUsernameList()
	{
		return list_usernames();
	}
	
	/**
	 * Builds array of passwords for corresponding usernames
	 * 
	 * @return array
	 */
	private final function buildPassList()
	{	
		$pass = array();
		$users = $this->buildUsernameList();
		foreach($users as $k=$v) {
			$pass[] = sha1($v);
		}
		return $pass;
	}
	
	/**
	 * Builds array of 'secret's for corresponding usernames
	 * 
	 * @return array
	 */
	private final function buildSecretList()
	{	
		$secret = array();
		$users = $this->buildUsernameList();
		foreach($users as $k=$v) {
			$secret[] = md5($v);
		}
		return $secret;
	}
	
	/**
	 * Builds array of emails, using each username as its base
	 * 
	 * @return array
	 */
	private final function buildEmailList()
	{
		$email = array();
		$users = $this->buildUsernameList();
		foreach($users as $k=$v) {
			$suffix = array_rand(array_flip(list_emails()));
			$email[] = $v . $suffix;
		}
		return $email;
	}
	
	/**
	 * Builds array of IP addresses
	 * 
	 * @return array
	 */
	private final function buildIpList()
	{
		$ip = array();
		$users = $this->buildUsernameList();
		foreach($users as $k=$v) {
			$ip[] = rand(5,100) . '.' . rand(1,250) . '.' . rand(1,250) . '.' . rand(1,250);
		}
		return $ip;
	}
	
	/**
	 * Builds array of random classes for users. Allows for new SysOps if NEW_USER_SYSOP is true
	 */
	private final function buildClassList()
	{
		$allowed_classes = (NEW_USER_SYSOP) ? (2,3,4,5,15) : (2,3,4,5);
		$class = array();
		$users = $this->buildUsernameList();
		foreach($users as $k=>$v) {
			$class[] = array_rand(array_flip($allowed_classes));
		}
		return $class;
	}
	
	/**
	 * Assembles final list of users to insert into database.
	 * 
	 * @return array
	 */
	public function buildUserList()
	{
		$info = array();
		
		$users = $this->buildUsernameList();
		$pass = $this->buildPassList();
		$secret = $this->buildSecretList();
		$email = $this->buildEmailList();
		$ip = $this->buildIpList();
		$class = $this->buildClassList();
		
		for($i = 0;$i < count($users);$i++) {
			$info[] = array(
					'Username'		=>	$users[$i],
					'Email'			=>	$email[$i],
					'PassHash'		=>	$pass[$i],
					'Secret'		=>	$secret[$i],
					'LastLogin'		=>	date(CURRENT_DATE_FORMAT),
					'LastAccess'	=>	date(CURRENT_DATE_FORMAT),
					'IP'			=>	$ip[$i],
					'Class'			=>	DEFAULT_USER_CLASS,
					'Uploaded'		=>	NEW_USER_UPLOAD_CREDIT,
					'Downloaded'	=>	NEW_USER_DOWNLOAD_CREDIT,
					'Enabled'		=>	1,
					'Paranoia'		=>	NEW_USER_PARANOIA,
					'Visible'		=>	1,
					'PermissionID'	=>	$class[$i],
					'LastSeed'		=>	date(CURRENT_DATE_FORMAT),
					'can_leech'		=>	1,
					'wait_time'		=>	0					
				);
		}
		
		return $info;
	}
	
	public function saveUserList($list)
	{
		try {
			if(empty($list)) {
				throw new exception("User list required.");
			}
			if(!is_array($list)) {
				throw new exception("User list must be an array.");
			}
			foreach($list as $k) {
				if(!$this->db->query("
					INSERT INTO `users_main` 
						(
							`Username`,
							`Email`,
							`PassHash`,
							`Secret`,
							`LastLogin`,
							`LastAccess`,
							`IP`,
							`Class`,
							`Uploaded`,
							`Downloaded`,
							`Enabled`,
							`Paranoia`,
							`Visible`,
							`PermissionID`,
							`LastSeed`,
							`can_leech`,
							`wait_time`
						) VALUES (
							'" . $k['Username'] . "',
							'" . $k['Email'] . "',
							'" . $k['PassHash'] . "',
							'" . $k['Secret'] . "',
							'" . $k['LastLogin'] . "',
							'" . $k['LastAccess'] . "',
							'" . $k['IP'] . "',
							'" . $k['Class'] . "',
							'" . $k['Uploaded'] . "',
							'" . $k['Downloaded'] . "',
							'" . $k['Enabled'] . "',
							'" . $k['Paranoia'] . "',
							'" . $k['Visible'] . "',
							'" . $k['PermissionID'] . "',
							'" . $k['LastSeed'] . "',
							'" . $k['can_leech'] . "',
							'" . $k['wait_time'] . "'
						)
				")) {
					throw new exception("Insert failed. Here is the item the broke it all: " . print_r($k,true));
				}
			}
			log('Success: Successfully inserted all new users into database.');
			return true;
		} catch(exception $e) {
			log('Error: ' . $e->getMessage());
			return false;
		}
	}
	
}


/**
 * End of file 'class.populate.php'
 */
?>