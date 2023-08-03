<?php

//error reporting. Disable these three lines before deployment.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//end of error reporting

//beginning of connector initialization
$host = 'localhost';
$user = 'root';
$db = 'eticketing';
$pwd = '';


global $mysqli, $conn, $edited;


//for OOP uses
$mysqli=new mysqli($host,$user,$pwd,$db);
//for imperative
$conn=mysqli_connect($host,$user,$pwd,$db);

//alert failure in connection
if(mysqli_connect_errno()){
	die("<script> alert (\" There was a fatal error connecting to the database\");</script>");
}
else
{
	
		/******************************************************************************
			Before editing anything in this page, Kindly contact paulnyaxx@gmail.com.
		*******************************************************************************/
		function uncrack($data){
				$data=trim($data);
				$data= htmlspecialchars($data);
				$data=stripcslashes($data);
				//replace quotes and forward slashes for SQL
				$data=str_replace('"', '\\"', $data);
				$data=str_replace("'", "\\'", $data);
				//replace dashes with underscore
				$data=str_replace("-", "_", $data);
				//strip misplaced commas
				$data=str_replace(" ,", "", $data);

				return $data;
			};

		function decrack($data){
				$data= htmlspecialchars_decode($data);
				//replace underscore with dashes
				$data=str_replace("_", "-", $data);
				return $data;
			};


		//format usernames
		function is_username($data){
			$data=uncrack($data);
			$data=strtolower($data);
			$data=ucwords($data);
			return $data;
		}

		//format emails
		function is_email($data){
			$data=uncrack($data);
			$data=strtolower($data);
			return $data;
		}

		//a banned user
		function is_banned(){
			if (isset($_COOKIE['banned'])) {
			if ($_COOKIE['banned']=='true') {
				return true;
			}
		}
		}

		//a checks if user edited content
		function is_edited(){
			if (isset($_COOKIE['edited'])) 
			{
				return true;
			}
			else
			{ return false;}
		}

		//redirects page on updates
		function resume_page(){
			if (isset($_COOKIE['level'])) 
			{
				$level=$_COOKIE['level'];
			}
			else
			{
				return;
			}

		}

			//not so important but is critical too for temporary passwords.
		function random_password() {
		    $alphabet = 'abcdefghijklmnopqrstuvwxyz.ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@%&';
		    $pass = array(); //remember to declare $pass as an array
		    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		    for ($i = 0; $i < 8; $i++) {
		        $n = rand(0, $alphaLength);
		        $pass[] = $alphabet[$n];
		    }
		    return implode($pass); //turn the array into a string
		}

		//will help us to determine the logged in users and hand relevant controls
		function is_logged_in(){
			if (isset($_COOKIE["username"]) && isset($_COOKIE["usertype"]) && isset($_COOKIE['useremail'])) {
				//set global variables for logged users and return true
				global $uname, $email, $funame, $usertype;

				$uname=$_COOKIE["username"];
				$email=$_COOKIE["useremail"];
				$usertype=$_COOKIE["usertype"];
				$funame=substr($uname, 0,strpos($uname," "));//first name
				return true;
			}
			else
			{ 
				return false;
			}
		}

		
		//must be logged in, and have usertype Admin
		function is_admin(){
			if (is_logged_in() && $_COOKIE['usertype'] =="Admin") {
				return true;
			}
			else
			{
				return false;
			}
		}

		function is_respondent(){
			if (is_logged_in() && $_COOKIE['usertype'] =="Respondent") {
				return true;
			}
			else
			{
				return false;
			}
		}

		//fetch the real IP Address of the user
		 function get_ip_address() 
		 {  
		    //whether ip is from the share internet  
			    if(!empty($_SERVER['HTTP_CLIENT_IP'])) 
					{  
			            $ip = $_SERVER['HTTP_CLIENT_IP'];  
			        }  
			    //whether ip is from the proxy  
			    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
			    	{  
			            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
			     	}  
			//whether ip is from the remote address  
			    else
			   		 {  
			             $ip = $_SERVER['REMOTE_ADDR'];  
			   		 }  
			     return $ip;  
		}
		


}

?>