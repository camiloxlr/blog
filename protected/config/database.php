<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	/*
	'connectionString' => 'mysql:host=localhost;dbname=testdrive',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	*/
	'class'=>'CDbConnection',
	'connectionString'=>'mysql:host=localhost;dbname=blog',
	'username'=>'root',
	'password'=>'root',
	'emulatePrepare'=>true,  // needed by some MySQL installations
);