<?php
$host = "fshore.cxjhwwvvzrvf.ap-southeast-2.rds.amazonaws.com";
$db = "beyond_melb";
$user = "jkang94";
$conn = new mysqli($host, $user, "HjPr!4ShoreK1.08", $db);
global $conn;
if(mysqli_connect_errno()) {
	echo "connection failed:" . mysqli_connect_errno();
	exit();
}
?>