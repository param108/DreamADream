<?php
class APC {
  //please use wisely
  private static  function getUniq() {
    $uniq="";
    if (session_id() == "") {
      $uniq = getmypid();
    } else {
      $uniq = session_id();
    }
    return $uniq;
  }
  public static function lock($key,&$val,$ttl=5) {
    $uniq=self::getUniq();
    if (apc_fetch($key."_LOCK") == $uniq) {
      error_log("Relocking previously locked data\n");
      $val = apc_fetch($key);
      return true;
    }
    $retries = 0;
    while((!apc_add($key."_LOCK",$uniq,$ttl)) && $retries < 20) {
      usleep(500);
      $retries++;
    }
    if ($retries == 20) {
      error_log("APC:lock failed due to timeout");
      return false;
    }
    $val = apc_fetch($key);
    return true;
  }

  public static function unlock($key) {
    if (apc_fetch($key."_LOCK") != self::getUniq()) {
      return;
    }
    apc_delete($key."_LOCK");
  }

  public static function store($key,$val) {
    apc_store($key,$val);
  }
}