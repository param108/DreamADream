<?php
include_once('config.php');
include_once('util/DB.class.php');
error_log("Included DB");
if (!array_key_exists("username",$_POST)) {
  echo "false";
  exit;
}

// check if the username exists in the DB
$result = DBHandler::getLoginDetails($_POST['username']);
if (is_array($result) && count($result) != 0) {
  echo "false";
  exit;
} else {
  echo "true";
  exit;
}