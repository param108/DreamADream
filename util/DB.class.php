<?php
class DBHandler {
public static $conn = null;
#update the login table
private function requireSetup() {
	if (self::$conn == null) {
		self::$conn  = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	}
	if (self::$conn == null) {
		error_log("Failed to connect to db:".DB_HOST.",user:".DB_USER);
	}
}
public static function createLogin($userid, $name,$password) {
	self::requireSetup();
	mysql_select_db(DB_NAME,self::$conn);
	$result = mysql_query("insert into ".DB_TABLE_LOGIN." values ($userid,\"$name\",0,SHA1(\"$password\"));",self::$conn);
	if (!$result) {
		error_log("failed to insert login line");
	}
	return $result;
}

public static function getLoginDetails($uname) {
  self::requireSetup();
  mysql_select_db(DB_NAME,self::$conn);
  $result = mysql_query("select * from ".DB_TABLE_LOGIN." where username='$uname';");
  if ($result == false) {
    return false;
  }
  
  // Use result
  if ($row = mysql_fetch_assoc($result)) {
    return $row;
  }
  
  return $row;
}

public static function incLoginRetries($uname) {
  self::requireSetup();
  mysql_select_db(DB_NAME,self::$conn);
  $result = mysql_query("update ".DB_TABLE_LOGIN." set retries=retries+1 where username='$uname';");
  return $result;
}

public static function resetLoginRetries($uname) {
  self::requireSetup();
  mysql_select_db(DB_NAME,self::$conn);
  $result = mysql_query("update ".DB_TABLE_LOGIN." set retries=0 where username='$uname';");
  return $result;
}
}