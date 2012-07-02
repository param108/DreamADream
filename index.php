<html>
<head>
<?php
include_once('utils/defines.php');
include_once('utils/APC.class.php');
include_once('utils/security_policy.php');
include_once('utils/cookies.php');
print("FIXME: Need to switch to https\n");
$seckey = setSecurityKey();
if (!$seckey) {
  die("Possibly too many connections :-(");
}
if (isset($_COOKIE["loginRetry"])) {  
  $retries = $_COOKIE["loginRetry"];
} else {
  $retries = 0;
  resetLoginCookie();
}
?>
<link rel="stylesheet" type="text/css" href="../includes/style.css" media="screen" />
<title> Login</title>
<br />
	<script type=’text/javascript’>
function validate()
{
	var x=document.forms["login"]["username"].value
		if (x==null || x=="")
		{
			alert(“Username Cannot Be Left Blank.");
			return false;
		}
	var x=document.forms["login"]["password"].value
		if (x==null || x=="")
		{
			alert(“password Cannot Be Left Blank.");
			return false;
		}
		else
		{
			return true;
		}
}
</script>
</head>
<body>
<?php
if ($retries != 0) {
  echo "Username and password do not match.\n";
}
?>
<form name="login" method="post" action="trylogin.php" onsubmit="return validate();" >

<table class="DreamLogin">
<tr><td height="50">
<b class="DreamLoginText">Login</b>
</td></tr>

<tr>
<td width="219">
<table width="240" align="center" >
<tr> <br /></tr>
<tr>
<td width="71"><span class="DreamLoginUsernameText">Username:</span></td>
<td width="139"><input class="DreamLoginUsernameInput" type="text" name="username" minlength="4" required="required" placeholder="Your username"></td>
</tr>
<tr>
<td width="71"><span class="DreamLoginPasswordText">Password:</span></td>
<td width="139"><input class="DreamLoginPasswordInput" type="password" name="password" minlength="4" required="required" placeholder="Your Password"></td>
</tr>

<tr>
<td width="71">&nbsp;</td>
<td width="139">
<p align="right"><input type="submit" name="submit" value="Submit">
<input type="reset" name="reset" value="Reset"></p>
</td>
</tr>

</table>

</td>
</tr>
<tr>
<td width="219" align="center"><a href=
<?php
   echo "\"newUser.php\">New User Signin</a><br />"
?>
</td>
</tr>

<br />
<br />
<br />
</table>

</form>

</body>
</html>