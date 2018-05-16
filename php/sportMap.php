<?php
include 'connect_db.php';
global $conn;
$num_rows = 0;
$search = $_GET['search'];
if(!empty($search)){
	$query = "SELECT * FROM sportsrec_facilities WHERE lga LIKE '$search%' OR suburb LIKE '$search%'";
	$search_query = mysqli_query($conn, $query);
	if(!$search_query){
       // die('QUERY FAILED' . mysqli_error($connect));
    }?>
    <hr>
    <p> Sport </p>
    <hr>
    <?php
    // fetch each row that matches the search query
    while( $row = mysqli_fetch_array($search_query) ){
        $num_rows++;
    	$facility = $row['facility_name'];
    	$streetNo = $row['street_no'];
    	$streetAdd = $row['street_add'];
    	$suburb = $row['suburb'];
    	$postcode = $row['postcode'];
    	$sport = $row['sport_type'];
    	$lat = $row['latitude'];
    	$long = $row['longitude'];
    ?>
    <h5 class="team-inner" style="font-size: 14px;" id = "test"><a href="#row" style="font-color: #00000" onclick="ZoomCenter( <?php echo $lat;?>, <?php echo $long;?>, '<?php echo $facility;?>' ) "><?php echo $facility; ?></a></h5>
    <ul class="list-unstyled">
        <li style="color: #000000"><?php echo $streetNo." ".$streetAdd; ?></li>
        <li style="color: #000000"><?php echo $suburb." ".$postcode; ?> </li>
        <li style="color: #000000"> Sport: <?php echo $sport; ?> </li>
    </ul>
    <hr>
    <?php
    }
    if($num_rows== 0){ ?>
        <div class="row">
    	   <div class="section-header">
    			<center><p class="section-subtitle"> Sorry, we couldn't find any results for sports facilities in <strong> <?php echo $search?></strong>.</p></center>
    		</div>
    	</div>
    <?php 
    }
} ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKlKmzz6EFwx1wD-4DHTFydRELwHNp2kA&callback=myMap" type="text/javascript"></script>
<script>
<?php
// Sports & Recreational Facilities Data 
$select = "SELECT * FROM sportsrec_facilities WHERE lga LIKE '$search%' OR suburb LIKE '$search%' LIMIT 10";
$data = $conn->query($select);
foreach ($data as $key ) {
    $locations[]=array( 'name'=>$key['facility_name'], 'streetAdd' => $key['street_add'], 'suburb' => $key['suburb'], 'postcode' => $key['postcode'],'lat'=>$key['latitude'], 'lng'=>$key['longitude'] );
}
$markers = json_encode($locations);
echo "var markers=$markers;\n";
?>
var map;
var infowindow;
function myMap() {
    var mapOptions = {
        center: new google.maps.LatLng(<?php echo $lat;?>, <?php echo $long;?>),
        zoom: 13
    }
    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    //infowindow = new google.maps.InfoWindow(), marker, lat, lng;
    infowindow = new google.maps.InfoWindow();
    for( var o in markers ){
        lat = markers[ o ].lat;
        lng=markers[ o ].lng;
        name=markers[ o ].name;
        streetAdd = markers[ o ].streetAdd;
        suburb = markers[ o ].suburb;
        postcode = markers[ o ].postcode;
        address = streetAdd + " " + suburb + " " + postcode;
        var latlng = new google.maps.LatLng(lat, lng);
        createMarker(latlng, name, address);
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