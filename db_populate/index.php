<?php 

/**
 * Index.php, all the magic happens.
 * 
 * ## LOCATION:
 * /db_populate/index.php
 * 
 * @package Gazelle Enhanced
 * @author Pierce
 * @copyright View included license.txt, located in the root directory. 
 * @link http://github.com/piercemoore/GazelleEnhanced/
 * @link http://gazelle.refreshedweb.com
 */

require_once('includes/class.populate.php');

$pop = new Populate;

$get = $pop->buildUserList();

print_r($get); // Comment this line if un-commenting the lines below to avoid confusion.

//Un-comment the following lines to get the system started!
/*

	if(!$pop->saveUserList()) {
		log('Error: Unable to save user list.');
	} else {
		log('Success: User list successfully saved.');
	}

 */


/*
 * End of file 'index.php'
 */

?>