<?php
/* Database connection start */
//Connection



//end of error reporting


global $mysqli, $conn, $edited;

//for OOP uses
$mysqli=new mysqli("localhost","root","","eticketing");
//for imperative
$conn=mysqli_connect("localhost","root","","eticketing");

//alert failure in connection
if(mysqli_connect_errno()){
    die("<script> alert (\" There was a fatal error connecting to the database\");</script>");
}
else
{
    

}
?>