<?php
function secLoginRetries($retries) {
  $expire=time()+60*60;
  if ($retries > 3) {
    sleep (30);
    resetLoginCookie();
  } else {
    setLoginCookie($retries + 1);
  }					      
}

class SecKey {
  private $pad;
  private $elapsed_time;
  public function __construct() {
    $this->pad=Array();
    $this->elapsed_time=time()+30;
    $this->pad[]=$this->getNewKey();
  }
  public function getNewKey() {
    $arr = str_split('ABCDEFGHIJKLMNOPQRSTUVYXYZabcdefghijklmnopqrstuvwxyz'); // get all the characters into an array
    shuffle($arr); // randomize the array
    $arr = array_slice($arr, 0, 16); // get the first six (random) characters out
    $str = implode('', $arr); // smush them back into a string 
    return $str;
  }

  public function update() {
    $time = time();
    if ($time > $this->elapsed_time) {
      if ($time - $this->elapsed_time > 300) {
	$this->arr=Array(); //cleanup all keys
      }
      $this->elapsed_time=$time+30;
      $this->pad[]=$this->getNewKey();
    } else if ( $this->elapsed_time  - $time > 30 ) {
      //overflow
      $this->elapsed_time=$time+30;
      $this->pad[]=$this->getNewKey();     
    }
    if (count($this->pad) > 10) {
      $this->pad = array_slice($this->pad,count($this->pad) - 10);
    }
    //return the latest one
    return $this->pad[count($this->pad)-1];
  }
  public function check($key) {
    return in_array($key,$this->pad);
  }
}
function checkSecurityKey($key) {
  if (!APC::lock("SecKey",$seckey)) {
    return false;
  }
  $result = $seckey->check($key);
  APC::unlock("SecKey");
  return $result;
}

function setSecurityKey() {
  if (!APC::lock("SecKey",$seckey)) {
    error_log("Failed to lock security key");
    return false;
  }
  if (!$seckey) {
    $seckey = new SecKey();
  }
  $thiskey = $seckey->update();
  APC::store("SecKey",$seckey);
  APC::unlock("SecKey");
  $expire=time()+60*60;
  setcookie("SecKey",$thiskey,$expire);
  return $thiskey;
}