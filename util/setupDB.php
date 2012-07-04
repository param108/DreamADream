<?php

if (PHP_SAPI != "CLI") {
	die("This script can only be run from CLI");
}
include_once(dirname(__FILE__)."/../config.php");
$createQueries=array();
#create the database
$createQueries[]="create database ".DB_NAME.";";
#use it
$createQueries[]="use ".DB_NAME.";";
#create the login database
$createQueries[]="create table ".DB_TABLE_LOGIN." ( userid int NOT NULL PRIMARY KEY , username varchar(20) NOT NULL UNIQUE KEY, retries int NOT NULL , password varchar(40) NOT NULL );"
#grant permissions
$createQueries[]="grant all on ".DB_NAME.".* to '".DB_USER."'@'".DB_HOST."' identified by '".DB_PASSWORD."';"

#connect to the server mentioned

if ($argc < 3) {
	die(" usage $argv[0] <db host> <db user> <db pass>");
}
$host = $argv[1];
$user = $argv[2];
if (count($argv)>3) {
	$pass = $argv[3];
	mysql_connect($host, $user, $pass);
} else {
	mysql_connect($host, $user);
}

foreach($createQueries as $q) {
	$ret = mysql_query($q);
	if (!$ret) {
		die("Failed Query:".$q);
	}
}
die("Mysql setup success");
