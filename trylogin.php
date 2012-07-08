<?php
session_start();
include_once("config.php");
include_once("util/DB.class.php");
include_once(dirname(__FILE__)."/secureimage/securimage.php");

if (array_key_exists("username",$_POST)) {
	$loginDetails = DBHandler::getLoginDetails($_POST['username']);
	if ($loginDetails == false) {
	  // redirect back to index.php
	  header( 'Location: index.php');
	  exit(1);
	}
	
	if ($loginDetails['retries'] > 3 && !array_key_exists("captcha_code",$_POST)) {
	  header("Location: index.php?retries=".$loginDetails['retries']);
	  exit(1);
	}
	// check password
	if ($loginDetails['password'] == sha1($_POST['password'])) {
	  if ($loginDetails['retries'] > 3) {
	    //check captcha
	    $retries = $loginDetails['retries'];
	    $secureimage=new Securimage();
	    if ($secureimage->check($_POST['captcha_code']) == true) {
	      DBHandler::resetLoginRetries($_POST['username']);
	      // fall through to the end for success
	    } else {
	      header("Location: index.php?retries=$retries");
	      exit(1);
	    }  
	  } else {
	    DBHandler::resetLoginRetries($_POST['username']);
	  }
	  // fall through to end for successful login
	} else {
	  DBHandler::incLoginRetries($_POST['username']);
	  $retries = $loginDetails['retries'] + 1;
	  header("Location: index.php?retries=$retries");
	  exit(1);
	}
	// success reach here.
	die("Login Successful");
} else {
  // redirect back to index.php
  header( 'Location: index.php');
  exit(1);
}
?>
