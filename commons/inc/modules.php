<?php
require ('connection.php');


//convert the date and time to relative time
function convertToRelativeTime($datetime) {
   $timestamp = strtotime($datetime);
   $currentTimestamp = time();
   $difference = $currentTimestamp - $timestamp + 3600;


   if ($difference < 60) {
       $timeAgo = $difference . " seconds ago";
   } elseif ($difference < 3600) {
       $minutes = floor($difference / 60);
       $timeAgo = $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
   } elseif ($difference < 86400) {
       $hours = floor($difference / 3600);
       $timeAgo = $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
   } else {
       $days = floor($difference / 86400);
       $timeAgo = $days . " day" . ($days > 1 ? "s" : "") . " ago";
   }
   return $timeAgo ;
}



?>
