<?php 
include 'connect_db.php';
global $conn;
$search = $_POST['search'];
if(isset($_POST['search']))
{ 
  ?>
<div class="row">
  <?php
    foreach (getHospData() as $hr ): 
    $lat = $hr['Y'];
    $long = $hr['X'];
  ?>
	<!-- <div class="col-lg-6 col-sm-6 col-xs-6 box-item"> -->
	<div class = "col-md-6 col-sm-6">
		<div class="single-team hosp">
			<div class="team-details" style="text-align:left">
				<div class="team-inner">
		      <ul class="list-unstyled"> 
		        <?php echo "<li><strong>{$hr['LabelName']}</strong></li>"?>
		        <?php echo "<li>{$hr['SA2_Name']}</li>"?>
		        <?php echo "<li>{$hr['Postcode']}</li>"?>
		        <?php echo "<li>{$hr['Type']}</li>"?>
		        <?php echo "<li> <i class='lnr lnr-map-marker'> <a href='http://maps.google.com/maps?q= $lat,$long'>Open in maps</a></i>"?>
				  </ul>
			  </div>
		  </div>
	  </div>
    <br><br>
  </div>     
<?php
  endforeach;
?>
</div>  
<?php 
} 
?>




<?php
function getSportData()
{
  global $conn;
  if($stmt = $conn->prepare("SELECT facility_name, street_add, suburb, postcode, sport_type, latitude, longitude 
  	FROM sportsrec_facilities WHERE suburb LIKE '$search%' LIMIT 10"))
  {
    $stmt->execute();
    $stmt->bind_result($facility_name, $street_add, $suburb, $postcode, $sport_type, $latitude, $longitude);
    while($stmt->fetch()){
      $rows [] = array('facility_name' => $facility_name, 'street_add' => $street_add, 'suburb' => $suburb, 'postcode' => $postcode, 'sport_type' => $sport_type,
      	'latitude' => $latitude, 'longitude' => $longitude);
    }
    $stmt->close();
   // print_r($rows);
    return $rows;
  }
  else{
   printf("Error message: %s\n", $conn->error);
 }
}

function getHospData($search)
{
  global $conn;
  if($stmt = $conn->prepare("SELECT LabelName, Type, SA2_Name, Postcode, X, Y FROM hospitals_final WHERE SA2_Name LIKE ? LIMIT 10"))
  {
    $stmt->execute();
    $stmt->bind_result($LabelName, $Type, $SA2_Name, $Postcode, $X, $Y);
    while($stmt->fetch()){
      $rows [] = array('LabelName' => $LabelName, 'Type' => $Type, 'SA2_Name' => $SA2_Name, 'Postcode' => $Postcode, 
      	'X' => $X, 'Y' => $Y);
    }
    $stmt->close();
    //print_r($rows);
    return $rows;
  }
  else{
   printf("Error message: %s\n", $conn->error);
 }
}

function getSchoolData()
{
  global $conn;
  if($stmt = $conn->prepare("SELECT School_Name, School_Type, SA2_Name, Address_Postcode, Education_Sector, X, Y 
  	FROM school_final WHERE SA2_Name LIKE '$search%' AND School_Type LIKE 'Primary' limit 10"))
  {
    $stmt->execute();
    $stmt->bind_result($School_Name, $School_Type, $SA2_Name, $Address_Postcode, $Education_Sector, $X, $Y);
    while($stmt->fetch()){
      $rows [] = array('School_Name' => $School_Name, 'School_Type' => $School_Type, 'SA2_Name' => $SA2_Name, 
      	'Address_Postcode' => $Address_Postcode, 'Education_Sector' => $Education_Sector, 'X' => $X, 'Y' => $Y);
    }
    $stmt->close();
   // print_r($rows);
    return $rows;
  }
  else{
   printf("Error message: %s\n", $conn->error);
 }
}
?>