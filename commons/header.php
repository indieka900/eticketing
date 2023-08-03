<?php
$uid=$_COOKIE['uid'];
$uname=$_COOKIE['username'];
$useremail=$_COOKIE['useremail'];
$usertype=$_COOKIE['usertype'];
$status=$_COOKIE['status'];

error_reporting(E_ALL);

// speed things up with gzip, also ob_start() is required for csv export
if(!ob_start('ob_gzhandler'))
    ob_start();

header('Content-Type: text/html; charset=utf-8');


echo "
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<link rel='stylesheet' href='../commons/css/style.css'>  
<link rel='stylesheet' href='../commons/css/bootstrap.min.css'>
<script src='../commons/js/jquery-3.7.0.js'></script>
<link rel='stylesheet' href='https://unicons.iconscout.com/release/v4.0.0/css/line.css'>


</head>
<body>
"; 

require ('../commons/inc/connection.php');
require ('../commons/inc/modules.php');



?>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../commons/images/logo.png" alt="">
            </div>

            <!-- <span class="logo_name">Ministry of Information, Communications and The Digital Economy</span> -->
            <span class="logo_name">M.o.I.C.D.E</span>

        </div>