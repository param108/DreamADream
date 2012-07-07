<html>
<head>
<?php
print("FIXME: Need to switch to https\n");
?>
<link rel="stylesheet" type="text/css" href="login.css?q=1" media="screen" />
<title> Login</title>
<br />
<script type='text/javascript' src='login.js'></script>
<script type='text/javascript'>
function validate()
{ 
  var x=document.forms["login"]["username"].value
  if (x==null || x=="")
  {
    alert("Username Cannot Be Left Blank.");
    return false;
  }
  var x=document.forms["login"]["password"].value
  if (x==null || x=="")
  {
    alert("password Cannot Be Left Blank.");
    return false;
  }
  return true;
}
</script>
</head>
<body>

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

<?php
if (array_key_exists("retries",$_GET)) {
	if($_GET["retries"] > 3) {
		echo('<tr>');
		echo('<td class="captcha" width="150" align="center">');
		echo('<img id="captcha" src="/secureimage/securimage_show.php" alt="CAPTCHA Image" />');
		echo('</td>');
		echo('<td class="captcha" width="100" align="center">');
		echo('<input type="text" name="captcha_code" size="10" maxlength="6" />');
		echo('<a href="#" onclick="document.getElementById(\'captcha\').src = \'/securimage/securimage_show.php?\' + Math.random(); return false">[ Different Image ]</a>');
  		//echo('<input class="DreamLoginCaptchaInput" type="text" name="captchaText" minlength="4" placeholder="captcha text" required="required">');
		echo('</td>');
		echo('</tr>');
	}
}?>
<br />
<br />
<br />
</table>

</form>

</body>
</html>
