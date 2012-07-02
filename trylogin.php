<?php
include_once("utils/APC.class.php");
include_once("utils/security_policy.php");
include_once("utils/cookies.php");
//security first
if (isset($_COOKIE["SecKey"])) {
  if (!checkSecurityKey($_COOKIE["SecKey"])) {
    error_log("Sent invalid cookie security key");
    header("Location: index.php"); /* Redirect browser */
    exit;
  }
} else {
  error_log("No Security Key set in request");
  header("Location: index.php"); /* Redirect browser */
  exit;    
}
if (isset($_COOKIE["loginRetry"])) {
  parseLoginCookie();
  error_log("successful login");
  header("Location: index.php"); /* Redirect browser */
} else {
  error_log("Failed to find loginRetry cookie in request");
  header("Location: index.php"); /* Redirect browser */
  exit;
}
?>