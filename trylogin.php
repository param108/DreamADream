<?php
include_once("config.php");
include_once("util/DB.class.php");

if (array_key_exists("username",$_POST)) {
	$loginDetails = DBHandler::getLoginDetails($_POST['username']);
	if ($loginDetails == false) {
	  // redirect back to index.php
	  header( 'Location: index.php');
	  exit(1);
	}
	
	if ($loginDetails['retries'] > 3 && !array_key_exists("captchaText",$_POST)) {
	  header("Location: index.php?retries=".$loginDetails['retries']);
	  exit(1);
	}
	// check password
	if ($loginDetails['password'] == sha1($_POST['password'])) {
	  DBHandler::resetLoginRetries($_POST['username']);
	  die("Login Successful");
	}
	DBHandler::incLoginRetries($_POST['username']);
	$retries = $loginDetails['retries'] + 1;
	header("Location: index.php?retries=$retries");
	exit(1);
} else {
  // redirect back to index.php
  header( 'Location: index.php');
  exit(1);
}
?>
