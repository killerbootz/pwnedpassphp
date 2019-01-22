<?php
$hash = sha1($_POST['password']);
$first5 = substr($hash, 0, 5);  
$lastbit = substr($hash, -35);
$hash = null;
$api = "https://api.pwnedpasswords.com/range/";
$url = $api . $first5;
$contents = file_get_contents($url);
?>

<html>
<head>
</head>
<body>


<form id='form' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>PwnedPasswords.API</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>

<label for='password' >Password*:</label>
<input type='password' name='password' id='password' maxlength="50" />

<input type='submit' name='Submit' value='Submit' />

</fieldset>
</form>
</body>
</html>


<?php
$rsuff = ":[0-9]{1,9}/mi";
$regex = "/" . $lastbit . $rsuff;
preg_match($regex, $contents, $matches);
echo "This password has been seen ";
$pwnedpass = ($matches[0]);
$numatch = "/:[0-9]{0,9}/mi";
preg_match($numatch, $pwnedpass, $matches);
$finmatch0 =  ($matches[0]);
$finmatch1 = substr($finmatch0, 1);
if($finmatch1 == 0){
	echo "<b>0</b> times in the Pwned Passwords database.";
}else{
	echo "<b>" . $finmatch1 . "</b> times in the Pwned Passwords database.";
}
echo "<br>";
echo "More information on the Pwned Passwords database and/or API can be found by visiting Troy Hunt's 'HaveIBeenPwned' <a href='https://haveibeenpwned.com/Passwords'> website</a>."
?>
