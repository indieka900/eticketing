<?php
require ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userid"];
    $usertype =  $_POST["usertype"];
    $status =  "Yes";
    $updateQuery = "UPDATE users SET Status = '$status', UserType = '$usertype' WHERE UserId = '$userId'";
    if(mysqli_query($conn, $updateQuery)){
       // echo "<script>alert('Status updated successfully')
      //  window.location.href = '../index.php#D0';
     //   </script>";


    }
    else{
        echo "Error updating status: " . mysqli_error($conn);
    }
}

?>
