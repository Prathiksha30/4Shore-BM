<?php
include 'connect_db.php';
global $conn;
$num_rows = 0;
$search = $_GET['search'];
if(!empty($search)){
    $query = "SELECT * FROM hospitals_final WHERE SA2_Name LIKE '$search%'";
    $search_query = mysqli_query($conn, $query);
    if(!$search_query){
       // die('QUERY FAILED' . mysqli_error($connect));
    }?>
    <hr>
    <p> Hospitals </p>
    <hr>
    <?php
    // Schools Data
     while( $row = mysqli_fetch_array($search_query) ){
        $num_rows++;
        $hName = $row['LabelName'];
        $hType = $row['Type'];
        $sName = $row['SA2_Name'];
        $sAddr = $row['StreetAddress'];
        $pc = $row['Postcode'];
        $long = $row['Latitude'];
        $lat = $row['Longitude'];
    ?>
    <h5 class="team-inner" style="font-size: 14px;" id = "test"><a href="#row" style="font-color: #00000" onclick="ZoomCenter( <?php echo $lat;?>, <?php echo $long;?>, '<?php echo $hName;?>' ) "><?php echo $hName; ?></a></h5>
    <!-- <div class="col-lg-6 col-sm-6 col-xs-6 box-item"> -->
    <ul class="list-unstyled">
        <li style="color: #000000"><?php echo $sAddr." ".$pc; ?></li>
        <li style="color: #000000">Type: <?php echo $hType; ?> </li>
    </ul>
    <hr>
<?php
    }
}
if($num_rows== 0){ ?>
    <div class="row">
		<div class="section-header">
			<center><p class="section-subtitle"> Sorry, we couldn't find any results for hospitals in <strong><?php echo $search?></strong>.</p></center>
		</div>
	</div>
<?php 
}
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKlKmzz6EFwx1wD-4DHTFydRELwHNp2kA&callback=myMap" type="text/javascript"></script>
<script>
// Hospital Data
<?php
$selectHosp = "SELECT * FROM hospitals_final WHERE SA2_Name LIKE '$search%' LIMIT 10";
$dataHosp = $conn->query($selectHosp);
foreach ($dataHosp as $key ) {
    $locHosp[]=array( 'name'=>$key['LabelName'], 'streetAdd' => $key['StreetAddress'], 'postcode' => $key['Postcode'], 'lat'=>$key['Longitude'], 'lng'=>$key['Latitude'] );
}
$markerHosp = json_encode($locHosp);
echo "var markerHosp=$markerHosp;\n"; ?>
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
    for( var h in markerHosp ){
        lat = markerHosp[h].lat;
        lng=markerHosp[h].lng;
        name=markerHosp[h].name;
        streetAddrHosp = markerHosp[h].streetAdd;
        pcode = markerHosp[h].postcode;
        addHosp = streetAddrHosp + " " + pcode;
        var latlng = new google.maps.LatLng(lat, lng);
        /*console.log(lat+lng);*/
        createMarker(latlng, name, addHosp);
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