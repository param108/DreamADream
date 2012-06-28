<?php

function resetLoginCookie()
{
    $expire=time()+60*60;
    setcookie("loginRetry", "0", $expire);
}

function setLoginCookie($val)
{
    $expire=time()+60*60;
    setcookie("loginRetry", $val, $expire);
}

function parseLoginCookie()
{
  $retries = 0;
  if (!isset($_COOKIE["loginRetry"])) {
    $expire=time()+60*60;
    setcookie("loginRetry", "0", $expire);
  } else {
    $retries = $_COOKIE["loginRetry"];
    secLoginRetries($retries);
  }
  return $retries;
}

function setSecKeyCookie($val) 
{
  $expire=time()+60*60;
  setcookie("SecKey",$val,$expire);
}