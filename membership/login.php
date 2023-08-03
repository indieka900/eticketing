<?php
$error=" ";
require "connection.php";

if (isset($_POST['signup'])) {
	//redirect to login
	header("location:registration.php");exit();
}

if (isset($_POST['login'])) {
	//collect data
		$username=is_email($_POST["username"]);
		$passwd=uncrack($_POST["password"]);	

		$sqst="SELECT * from `users` where `Email`='$username' and `Password`='$passwd'";
		$queryresult=mysqli_query($conn,$sqst);
		$arr=mysqli_fetch_array(mysqli_query($conn,$sqst), MYSQLI_BOTH);

		if (mysqli_num_rows($queryresult) == 1) {		
			//True if the member exists. false otherwise.
			global $uid;
			$useremail=$arr["Email"];
			$uname=$arr["Name"];
			$usertype=$arr["UserType"];
			$status=$arr["Status"];
			$uid=$arr['UserId'];
				
				//if the user is not confirmed, ignore everything else. Report error.
				if ($status==='No') {
					$error="<div class='alert w3-card-2 alert-warning alert-dismissible' style='text-align:center'>
					  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					  <strong>Hi, $uname, </strong><br> Please wait for administrator approval before you can login.
					</div>";
				}
				else
				{
					//set cookies to remember the user for 2 days
					$days=2;
                    
					setcookie("username",$uname,time()+86400*$days,"/","",0);
					setcookie("useremail",$useremail,time()+86400*$days,"/","",0);
					setcookie("usertype",$usertype,time()+86400*$days,"/","",0);
					setcookie("status",$status,time()+86400*$days,"/","",0);
					setcookie("uid",$uid,time()+86400*$days,"/","",0);
                    
					//redirect ot relevant pages
					if ($usertype==='Client') {
						header("location:../client/#D2");exit();
					}elseif($usertype==='IT Support'){
						header("location:../expert/#D0");exit();
					}elseif($usertype==='Service Desk'){
						header("location:../service_desk/#D0");exit();
					}elseif($usertype==='Admin'){
						header("location:../admin/#D0");exit();
					}else{
						$error="<div class='alert w3-card-2 alert-warning alert-dismissible' style='text-align:center'>
					  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					  <strong>Hi, $uname, </strong><br> The system failed to identify your login ticket type. Please contact the administrator
					</div>";
					}
					
				}
			}
			else
			{
				$error="<div class='alert w3-card-2 alert-danger alert-dismissible' style='text-align:center'>
					  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					  <strong>Invalid Details </strong><br> 
					  Your Login Details are incorrect. Please try again.
					</div>";
			} 
}

if (isset($_GET['admitted']) && $_GET['admitted']=='true') 
{
	//registration was successful. report success.
	$error="<div class='alert w3-card-2 alert-success alert-dismissible' style='text-align:center'>
					  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					  <strong>Registration Was successful </strong><br> 
					  Thanks for registering with us. Please wait for the confirmation of the system administrator before you can login.
					</div>";
}


?>
<HTML>

<HEAD>
    <TITLE>Login</TITLE>
    <link href="assets/css/style.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/user-registration.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    body {
        background-position: center;
        /* Center the image */
        background-repeat: no-repeat;
        /* Do not repeat the image */
        background-size: cover;
        /* Resize the background image to cover the entire container */
    }

    .sign-up-container {
        background-color: #ac5d16;
    }

    .form-label {
        color: white !important;
    }

    #login-btn {
        color: white;
        font-weight: bold;
        background: #000;
    }
    </style>
</HEAD>
<BODY>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="photos/Logo.png" alt="" class="img-responsive" style="margin: auto; margin-top: 30px;">
                </a>
            </div>

            <div style="width:80%; max-width:500px; padding-top:1.2em; margin-left:auto; margin-right: auto;">
                <?php 
    	echo $error;
    	?>
            </div>

            <div class="phppot-container">
                <div class="sign-up-container">
                    <div class="login-signup">
                    </div>

                    <div class="signup-align">
                        <form name="login" action="login.php" method="post" onsubmit="return loginValidation()">
                            <div class="signup-heading" style="color:black;">Login</div>

                            <div class="row">
                                <div class="inline-block">
                                    <div class="form-label">
                                        Username / Email<span class="required error" id="username-info"></span>
                                    </div>
                                    <input class="input-box-330" type="text" name="username" id="username">
                                </div>
                            </div>
                            <div class="row">
                                <div class="inline-block">
                                    <div class="form-label">
                                        Password<span class="required error" id="login-password-info"></span>
                                    </div>
                                    <input class="input-box-330" type="password" name="password" id="login-password">
                                </div>
                            </div>
                            <div class="row">
                                <input class="btn btn-dark" type="submit" name="login" id="login-btn" value="Login">
                                <br>
                                Or <br>

                                <a href="registration.php">
                                    <span  style="color:#000; border-color:#000; background-color: #337ab700;"  class="btn btn-primary"> Signup</span>
                                </a> <br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <footer>
        <center> 
            <a  href="http://www.ict.go.ke">Ministry of Information, Communications and The Digital Economy</a>
            <P>Copyright &copy; 2019 - <script>document.write(new Date().getFullYear())</script> </P>
        
        </center>
    </footer>
</body>
</html>