<html>
<head>
<?php
print("FIXME: Need to switch to https\n");
?>
<link rel="stylesheet" type="text/css" href="login.css?q=1" media="screen" />
<title> Login</title>
<br />
<script type='text/javascript' src='lib/jquery-1.7.2.js'></script>
<script type='text/javascript' src='login.js'></script>
<script type='text/javascript'>
   var nameready= false;
   $(document).ready(function () {
	 $('#newUserNameText').focusout(function checkUserExists(){
	     var z=document.forms["newUser"]["username"].value
	       if (z == "") {
		 return;
	       }
	     //check for username available
	     xmlhttp = new XMLHttpRequest();
	     xmlhttp.open("POST","checkUserExists.php",true);
	     xmlhttp.onreadystatechange=function() {
	       var x = document.getElementById('usernameUsed');
	       if (xmlhttp.readyState==4 && xmlhttp.status==200)
		 {
		   var ret = eval(xmlhttp.responseText);
		   if (ret) {
		     // go to a good place
		     x.innerHTML = 'Name available';	
		     nameready = true;
		   } else {
		     // stay right here
		     x.innerHTML = 'Please choose another name';	
		     nameready = false;
		   }
		 } else {
		 x.innerHTML = 'Failure to load image'+xmlhttp.readyState+':'+xmlhttp.status;
	       }
	     };
	     xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	     xmlhttp.send("username="+z);
	   });
     });

function validate()
{ 
  var x=document.forms["newUser"]["password"].value
  var y=document.forms["newUser"]["rpassword"].value
  if (x!=y)
  {
    alert("Password typed incorrectly");
    return false;
  }

  if (nameready == false) {
    return false;
  }
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
  <td><input type="text" id="newUserNameText" name="username" required="required"/><div id='usernameUsed'></div></td>
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
   <td><img id="captcha" src="secureimage/securimage_show.php" alt="CAPTCHA Image" /></td>
   <td><a href="#" onclick="document.getElementById('captcha').src = 'secureimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a></td>
</tr>
<tr>   
   <td>Captcha (type in the text you see in the image)</td>
   <td><input type="text" name="captcha_code" size="10" maxlength="6" required="required" /></td>
</tr>
</table>
   <input type="submit" name="submit" value="Submit">
   <input type="reset" name="reset" value="Reset">
</form> 
</body>
</html>