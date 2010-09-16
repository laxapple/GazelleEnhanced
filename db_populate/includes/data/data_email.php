<?php 

/**
 * This is the large array of random usernames. Instead of writing a jillion fake email addresses, we will just append the username with a random .tld (@hotmail.com,@gmail.com, etc)
 * 
 * ## LOCATION:
 * /db_populate/includes/data/data_email.php
 * 
 * @package Gazelle Enhanced
 * @author Pierce
 * @copyright View included license.txt, located in the root directory. 
 * @link http://github.com/piercemoore/GazelleEnhanced/
 * @link http://gazelle.refreshedweb.com
 */

// 

function list_emails() {
	$sites = array(
		'gmail','digg','msn','hotmail','aol','refreshedweb','yahoo',
		'inbox','aim','mail'
	);
	$tlds = array(
		'org','net','com','info'
	);
	$data = array();
	foreach($sites as $k=>$v) {
		foreach($tlds as $key=>$val) {
			$data[] = "@$v." . $val;
		}
	}
	return $data;
}


/**
 * End of file 'data_email.php'
 */
?>