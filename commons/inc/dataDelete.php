<?php
require ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userid"];
    $deleteQuery = "UPDATE users SET Status ='deleted' WHERE UserId = '$userId'";
    if(mysqli_query($conn, $deleteQuery)){
       // echo "<script>alert('Status updated successfully')
      //  window.location.href = '../index.php#D0';
     //   </script>";


    }
    else{
        echo "Error deleting: " . mysqli_error($conn);
    }
}

?>
