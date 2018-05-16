<?php
include 'connect_db.php';
global $conn;
$num_rows = 0;
$search = $_GET['search'];
if(!empty($search)){
$query = "SELECT * FROM schools_final WHERE SA2_Name LIKE '$search%' AND School_Type LIKE 'Primary'";
$search_query = mysqli_query($conn, $query);
if(!$search_query){
   // die('QUERY FAILED' . mysqli_error($connect));
}?>
<hr>
<p> Schools </p>
<hr>
<?php
// Schools Data
while( $row2 = mysqli_fetch_array($search_query) ){
	$num_rows++;
    $school = $row2['School_Name'];
    $type = $row2['School_Type'];
    $Name = $row2['SA2_Name'];
    $street = $row2['Street_Address'];
    $addP = $row2['Address_Postcode'];
    $edu = $row2['Education_Sector'];
    $long = $row2['Latitude'];
    $lat = $row2['Longitude'];
?>
<h5 class="team-inner" style="font-size: 14px;" id = "test"><a href="#row" style="font-color: #00000" onclick="ZoomCenter( <?php echo $lat;?>, <?php echo $long;?>, '<?php echo $school;?>' ) "><?php echo $school; ?></a></h5>
<!-- <div class="col-lg-6 col-sm-6 col-xs-6 box-item"> -->
<ul class="list-unstyled">
	<li style="color: #000000"><?php echo $street." ".$addP; ?></li>
    <li style="color: #000000">Sector: <?php echo $edu; ?> </li>
    <li style="color: #000000">Type: <?php echo $type; ?> </li>
</ul>
<hr>
    <?php
    }
}
	if($num_rows== 0){ ?>
		<div class="row">
			<div class="section-header">
				<center><p class="section-subtitle"> Sorry, we couldn't find any results for schools in <strong><?php echo $search?></strong>.</p></center>
			</div>
		</div>
<?php 
}
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKlKmzz6EFwx1wD-4DHTFydRELwHNp2kA&callback=myMap" type="text/javascript"></script>
<script>
// Schools Data
<?php
$selectSchool = "SELECT * FROM schools_final WHERE SA2_Name LIKE '$search%' LIMIT 10";
$dataSchool = $conn->query($selectSchool);
foreach ($dataSchool as $key ) {
	$locSchool[]=array( 'name'=>$key['School_Name'], 'streetAdd' => $key['Street_Address'], 'postcode' => $key['Address_Postcode'], 'lat'=>$key['Longitude'], 'lng'=>$key['Latitude'] );
}
$markerSchool = json_encode($locSchool);
echo "var markerSchool=$markerSchool;\n"; ?>
var map;
var infowindow;
function myMap() {
    var mapOptions = {
        // -37.8136, 144.9631 - Melbourne
      center: new google.maps.LatLng(<?php echo $lat;?>, <?php echo $long;?>),
      zoom: 13
  }
	map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    //infowindow = new google.maps.InfoWindow(), marker, lat, lng;
    infowindow = new google.maps.InfoWindow();
    for( var s in markerSchool ){
        latS = markerSchool[s].lat;
        lngS=markerSchool[s].lng;
        name=markerSchool[s].name;
        streetAddrSchool = markerSchool[s].streetAdd;
        pcodeSchool = markerSchool[s].postcode;
        addSchool = streetAddrSchool + " " + pcodeSchool;
        var latlng = new google.maps.LatLng(latS, lngS);
        console.log("Marker School: "+latS +","+lngS);
        createMarker(latlng, name, addSchool);
	}
}
function createMarker(latlng, name, address) {
    var html = "<b>" + name + "</b> <br/>" + address;
    var marker = new google.maps.Marker({
        map: map,
        position: latlng
    });
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(html);
        infowindow.open(map, marker);
    });
    //markers.push( marker );
}
function ZoomCenter (lati, longi, name){
    console.log("ZOOM FUNCTION");
    map.setCenter(new google.maps.LatLng(lati, longi));
    map.setZoom(17);
    console.log($('#active').text());
    if($('.team-inner').text() == name){
        $('.team-inner').css({'background-color': '#61D2B4'});
    }
    $('#active').css({'background-color': '#61D2B4'});
}

</script>