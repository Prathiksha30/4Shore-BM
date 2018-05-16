<?php
// Get parameters from URL
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
//$radius = $_GET["radius"];
// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
// Opens a connection to a mySQL server
$connection=new mysqli ("fshore.cxjhwwvvzrvf.ap-southeast-2.rds.amazonaws.com", "jkang94", "HjPr!4ShoreK1.08", "beyond_melb");
if (!$connection) {
  die("Not connected : " . mysqli_connect_errno());
}
// Set the active mySQL database
/*$db_selected = mysql_select_db("beyond_melb", $connection);
if (!$db_selected) {
  die ("Can\'t use db : " . mysql_error());
}*/
// Search the rows in the markers table
$result = $connection->query("SELECT facility_name, street_add, suburb, postcode, latitude, longitude FROM sportsrec_facilities");
/*$result = mysql_query($query);
$result = mysql_query($query);*/

if (!$result) {
  die("Invalid query: " . mysqli_connect_errno());
}
header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each
while ($row = $result->fetch_assoc()){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  //$newnode->setAttribute("id", $row['id']);
  $newnode->setAttribute("facility_name", utf8_encode($row['facility_name']));
  $newnode->setAttribute("treet_add", utf8_encode($row['street_add']));
  $newnode->setAttribute("address", utf8_encode($row['suburb']));
  $newnode->setAttribute("postcode", utf8_encode($row['postcode']));
  $newnode->setAttribute("lat", utf8_encode($row['latitude']));
  $newnode->setAttribute("lng", utf8_encode($row['longitude']));
  //$newnode->setAttribute("distance", $row['distance']);
}
echo $dom->saveXML();
?>