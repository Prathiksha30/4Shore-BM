<?php 
include 'connect_db.php';
$keyword = strval($_GET['query']);
$search_param = "{$keyword}%";
global $conn;
// returns a JSON array of industry names
if($stmt = $conn->prepare("SELECT DISTINCT Industry 
  FROM industry_final ORDER BY Industry"))
{
  //WHERE Industry NOT IN ('Mining', 'Information media & telecommunications')
  $stmt->execute();
  $stmt->bind_result($Industry);
  while($stmt->fetch()){
    $rows[] = array('Industry' => $Industry);
  }
  $stmt->close();
   // print_r($rows);
  header('Content-type: application/json');
  echo json_encode($rows);
}
?>
