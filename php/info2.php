<!-- 
WARNING: Schools _ Hosp Data : Lat/Long values reversed!! 
to do: UPDATE DB -->
<style type="text/css">
    #active {
        background-color: '#61D2B4';
    }
</style>
<?php
include 'connect_db.php';
global $conn;
$search = $_GET['search'];
if(!empty($search)){
    $query = "SELECT DISTINCT * FROM sportsrec_facilities WHERE lga LIKE '$search%' OR suburb LIKE '$search%' LIMIT 10";
    $search_query = mysqli_query($conn, $query);
    $num_rows = 0;
    
    if(!$search_query){
       // die('QUERY FAILED' . mysqli_error($connect));
        echo "<h6> Sorry, no results at the moment. </h6>";
    }?>
    <!-- <div class="col-lg-3 col-md-6 col-xs-12" style="overflow-y:scroll; height: 520px; width: 200px;"> -->
    <hr>
    <p> Sport </p>
    <hr>
    <?php
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
    <!-- <div class="col-lg-6 col-sm-6 col-xs-6 box-item"> -->
    <ul class="list-unstyled">
        <li style="color: #000000"><?php echo $streetNo." ".$streetAdd; ?></li>
        <li style="color: #000000"><?php echo $suburb." ".$postcode; ?> </li>
        <li style="color: #000000"> Sport: <?php echo $sport; ?> </li>
    </ul>
    <hr>
<?php
    }
    $query2 = "SELECT * FROM schools_final WHERE SA2_Name LIKE '$search%' LIMIT 10";
    $search_query2 = mysqli_query($conn, $query2);
    if(!$search_query2){
       // die('QUERY FAILED' . mysqli_error($connect));
    }?>
    <hr>
    <p> Schools </p>
    <hr>
    <?php
    // Schools Data
    while( $row2 = mysqli_fetch_array($search_query2) ){
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
        <ul class="list-unstyled">
            <li style="color: #000000"><?php echo $street." ".$addP; ?></li>
            <li style="color: #000000">Sector: <?php echo $edu; ?> </li>
            <li style="color: #000000">Type: <?php echo $type; ?> </li>
        </ul>
        <hr>
    <?php
    }
    //Hospital Data
    $query3 = "SELECT * FROM hospitals_final WHERE SA2_Name LIKE '$search%' LIMIT 10";
    $search_query3 = mysqli_query($conn, $query3);
    if(!$search_query3){
       // die('QUERY FAILED' . mysqli_error($connect));
    }?>
    <hr>
    <p> Hospitals </p>
    <hr>
    <?php
    while( $row3 = mysqli_fetch_array($search_query3) ){
        $num_rows++;
        $hName = $row3['LabelName'];
        $hType = $row3['Type'];
        $sName = $row3['SA2_Name'];
        $sAddr = $row3['Street_Address'];
        $pc = $row3['Postcode'];
        $long = $row3['Latitude'];
        $lat = $row3['Longitude'];
        ?>
        <h5 class="team-inner" style="font-size: 14px;" id = "test"><a href="#row" style="font-color: #00000"
        onclick="ZoomCenter( <?php echo $lat;?>, <?php echo $long;?>, '<?php echo $hName;?>' ) "><?php echo $hName; ?></a></h5>
        <ul class="list-unstyled">
            <li style="color: #000000"><?php echo $sAddr." ".$pc; ?></li>
            <li style="color: #000000">Type: <?php echo $hType; ?> </li>
        </ul>
        <hr>
    <?php
    }
    if($num_rows== 0){ 
         ?>
        <div class="row">
            <div class="section-header">
                <center><p class="section-subtitle"> Sorry, no results at the moment.</p></center>
            </div>
        </div>
    <?php 
    }
    
}
?>
    
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKlKmzz6EFwx1wD-4DHTFydRELwHNp2kA&callback=myMap" type="text/javascript"></script>
<script>
<?php 
    // Sports & Recreational Facilities Data 
    $select = "SELECT * FROM sportsrec_facilities WHERE lga LIKE '$search%' OR suburb LIKE '$search%' LIMIT 10";
    $data = $conn->query($select);
    // Schools Data
    $selectSchool = "SELECT * FROM schools_final WHERE SA2_Name LIKE '$search%' LIMIT 10";
    $dataSchool = $conn->query($selectSchool);
    // Hospitals Data
    $selectHosp = "SELECT * FROM hospitals_final WHERE SA2_Name LIKE '$search%' LIMIT 10";
    $dataHosp = $conn->query($selectHosp);
    // Parse into JSON
    foreach ($data as $key ) {
        $locations[]=array( 'name'=>$key['facility_name'], 'streetAdd' => $key['street_add'], 'suburb' => $key['suburb'], 'postcode' => $key['postcode'],'lat'=>$key['latitude'], 'lng'=>$key['longitude'] );
    }
    // Parse into JSON
    foreach ($dataSchool as $key ) {
        $locSchool[]=array( 'name'=>$key['School_Name'], 'streetAdd' => $key['Street_Address'], 'postcode' => $key['Address_Postcode'], 'lat'=>$key['Longitude'], 'lng'=>$key['Latitude'] );
    }
    // Parse into JSON
    foreach ($dataHosp as $key ) {
        $locHosp[]=array( 'name'=>$key['LabelName'], 'streetAdd' => $key['StreetAddress'], 'postcode' => $key['Postcode'], 'lat'=>$key['Longitude'], 'lng'=>$key['Latitude'] );
    }
    $markers = json_encode($locations);
    $markerSchool = json_encode($locSchool);
    $markerHosp = json_encode($locHosp);
    /*Pass JSON data to Javascript 
    * To be processed by Google API
    */
    echo "var markers=$markers;\n";
    echo "var markerSchool=$markerSchool;\n";
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
        for( var s in markerSchool ){
            latS = markerSchool[s].lat;
            lngS=markerSchool[s].lng;
            name=markerSchool[s].name;
            streetAddrSchool = markerSchool[s].streetAdd;
            pcodeSchool = markerSchool[s].postcode;
            addSchool = streetAddrSchool + " " + pcodeSchool;
            var latlng = new google.maps.LatLng(latS, lngS);
            //console.log("Marker School: "+latS +","+lngS);
            createMarker(latlng, name, addSchool);

        }
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

