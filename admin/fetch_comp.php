<?php
include ('../commons/inc/connection.php'); // Include your database connection code

$sqlQuery = "SELECT count(if(status=0,1,null)) as totalComplaints FROM complaints";
$result = mysqli_query($conn, $sqlQuery) or die("database error: " . mysqli_error($conn));
$data = mysqli_fetch_assoc($result);
$totalComplaints = $data['totalComplaints'];

// Return the total complaints as JSON
header('Content-Type: application/json');
echo json_encode(['totalComplaints' => $totalComplaints]);
?>