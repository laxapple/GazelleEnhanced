<?php 

/**
 * Config.php, where you will define all the settings you require for this auto-population tool for Gazelle.
 * 
 * ## LOCATION:
 * /db_populate/includes/config.php
 * 
 * @package Gazelle Enhanced
 * @author Pierce
 * @copyright View included license.txt, located in the root directory. 
 * @link http://github.com/piercemoore/GazelleEnhanced/
 * @link http://gazelle.refreshedweb.com
 */

## First, let's set up all our fun (required, mostly) details.

// Define all database settings. If Gazelle is already working, these should be found in 'classes/config.php'.
define('DB_USER','{{Database Username}}');
define('DB_PASS','{{Database Password}}');
define('DB_NAME','{{Name of Database}}');	// Should be 'gazelle_enhanced', if using the provided .sql file.
define('DB_HOST','{{Database Host}}');		// Usually 'localhost'. If you aren't sure, just make it 'localhost'.

// Now we define a few things for our error logging functions
define('ERROR_LOG_LOCATION','error_log.log');	// Change if you want, this just allows the log to keep from getting cluttered up with random crap.
define('CURRENT_DATE_FORMAT','Y-m-d H:i:s');	// Defaults to MySQL timestamp: 2010-09-14 17:27:09

## Now let's specify just how detailed we want the auto-population to be.

// Define which tables should be populated with sample data.
define('AUTO_POP_MAIN',true);		// Should be left set to true, or else even the 'users_main' table won't populate.
define('AUTO_POP_INFO',true);		// Autopopulation of the 'users_info' table, contains basic style and user settings.
define('AUTO_POP_EMAILS',false);	// Up to you. This populates the 'user_history_emails' table.
define('AUTO_POP_IPS',false);		// Again, up to you. This populates the 'user_history_ips' table.

// Granular settings for new users
define('NEW_USER_PARANOIA',0);		// Paranoia level for new users. Defaults to 0 for maximum data sharing.
define('DEFAULT_USER_CLASS',5);		// What the Gazelle Enhanced database defaults to.

// Up/Down for new users
define('NEW_USER_UPLOAD_CREDIT',524288000); // What Gazelle Enhanced defaults to.
define('NEW_USER_DOWNLOAD_CREDIT',0);		// Current default as well, change if you really want to.

// Allow newly created users to be SysOps?
define('NEW_USER_SYSOP',false);		// Defaults to false, for security reasons.

## All defined, let's just grab the data store functions...
require_once('data/data_email.php');
require_once('data/data_users.php');

// Grab the classes for error handling and database administration...
require_once('class.error.php');	// Get our error-handling functions.
require_once('class.db.php');		// Get our database goodies.

// Fully loaded, and away we go...


/**
 * End of file 'config.php'
 */
?>