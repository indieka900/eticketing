<?php

//set cookies to remember the user for 2 days
	$days=2;

	setcookie("username",$uname,time()-86400*$days,"/","",0);
	setcookie("useremail",$email,time()-86400*$days,"/","",0);
	setcookie("usertype",$usertype,time()-86400*$days,"/","",0);
	setcookie("status",0,time()-86400*$days,"/","",0);

	header("location:login.php");


?>