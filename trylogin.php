<?php
include_once("util/DB.class.php");

if (array_key_exists("username",$_POST)) {
	$loginDetails = DBHandler::getLoginDetails($_POST['username']);
	if ($loginDetails == false) {
		#redirect back to index.php
	}
} else {
# redirect back to index.php
}
?>
