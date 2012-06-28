<html>
<head>
//Linking external stylesheet
<link rel="stylesheet" type="text/css" href="../includes/style.css" media="screen" />
<title> Login</title>
<br />

//Javascript for Validation of user inputs

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

<form name="login" method="post" action="logindatabase.php" onsubmit="return validate();" >

<table border="3" width="355" align="center" bgcolor="#affeff" >
<tr><td height="50" bgcolor="#aa0eff">
<b>Login</b>
</td></tr>

<tr>
<td width="219">
<table width="240" align="center" >
<tr> <br /></tr>
<tr>
<td width="71"><span style="font-size:12pt;">Username:</span></td>
<td width="139"><input type="text" name="username" minlength="4" required="required" placeholder="Your username"></td>
</tr>
<tr>
<td width="71"><span style="font-siz:12pt;">Password:</span></td>
<td width="139"><input type="password" name="password" minlength="4" required="required" placeholder="Your Password"></td>
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
<td width="219" bgcolor="#aa0eff" align="center"><br />
</td>
</tr>

<br />
<br />
<br />
</table>

</form>

</body>
</html>
