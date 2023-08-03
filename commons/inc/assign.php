<?php
require ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('Africa/Nairobi');
    $complaintId = $_POST["issue"];
    $UserId = $_POST["expert"];
    $assigner = $_POST["userid"];
    $currentTime = date("Y-m-d H:i:s");
    $updateQuery = "UPDATE complaints SET Expert_assigned = $UserId,desk_assigned = $assigner, Status = 1 WHERE ComplaintId = '$complaintId'";
    if(mysqli_query($conn, $updateQuery)){
        // echo "<script>alert('Assigned successfully')
        // window.location.href = '../index.php#D2';
         //</script>";
         //echo $updateQuery;

    }
    else{
        echo "Error assigning: " . mysqli_error($conn);
        echo $updateQuery;
    }
}
?>
