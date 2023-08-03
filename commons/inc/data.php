<?php
require ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('Africa/Nairobi');
    $complaintId = $_POST["issue"];
    $currentTime = date("Y-m-d H:i:s");
    $updateQuery = "UPDATE complaints SET Status = 2, Recipient_endtime = '$currentTime' WHERE ComplaintId = '$complaintId'";
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
