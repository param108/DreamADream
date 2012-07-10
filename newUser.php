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
  var x=document.forms["newUser"]["password"].value
  var y=document.forms["newUser"]["rpassword"].value
  if (x!=y)
  {
    alert("Password typed incorrectly");
    return false;
  }
  var z=document.forms["login"]["username"].value
  //check for username available
  return true;
}
</script>
</head>
<body>
<form name="newUser" method="post" action="createNewUser.php" onsubmit="return validate();">
<table>
<tr>
  <td>First name:</td>
  <td><input type="text" name="firstname" required="required"/></td>
</tr>
<tr>
  <td>Last name:</td> 
  <td><input type="text" name="lastname" required="required"/></td>
</tr>
<tr>
  <td>Email Id:</td>
  <td><input type="text" name="emailid" required="required"/></td> 
</tr>
<tr>
  <td>Username:</td>
  <td><input type="text" name="username" required="required"/></td>
</tr>
<tr>
   <td>Password:</td>
   <td><input type="password" name="password" required="required"/></td>
</tr>
<tr>
   <td>Password (once again)</td>
   <td><input type="password" name="rpassword" required="required"/></td>
</tr>
<tr>
   <td>Captcha (type in the text you see in the image)</td>
</tr>
<tr>
   <td><img id="captcha" src="secureimage/securimage_show.php" alt="CAPTCHA Image" /></td>
   <td><input type="text" name="captcha_code" size="10" maxlength="6" required="required" />
<a href="#" onclick="document.getElementById(\'captcha\').src = \'secureimage/securimage_show.php?\' + Math.random(); return false">[ Different Image ]</a></td>
</tr>
</table>
   <input type="submit" name="submit" value="Submit">
   <input type="reset" name="reset" value="Reset">
</form> 
</body>
</html>