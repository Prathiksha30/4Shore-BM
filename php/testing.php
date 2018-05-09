

<?php
include 'connect_db.php';
global $conn;
$request = mysqli_real_escape_string($conn, $_POST["query"]);
$query = "
 SELECT DISTINCT Name FROM unemployment_final WHERE Name LIKE '".$request."%'";

$result = mysqli_query($conn, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["Name"];
 }
 echo json_encode($data);
}

?>
