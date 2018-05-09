
<?php include '/php/connect_db.php';
$keyword = strval($_POST['query']);
$search_param = "{$keyword}%";
global $conn;
//$query = "SELECT DISTINCT LGA FROM sportsrec_facilities";

if($stmt = $conn->prepare("SELECT DISTINCT LGA FROM sportsrec_facilities ORDER BY LGA"))
  {
    $stmt->execute();
    $stmt->bind_result($LGA);
    while($stmt->fetch()){
      $rows[] = array('LGA' => $LGA);
    }
    $stmt->close();
   // print_r($rows);
  	header('Content-type: application/json');
   	echo json_encode($rows);
   }
?>
