<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
<?php
 
  include 'connect_db.php';
  global $conn;
  $apikey = "AIzaSyDKlKmzz6EFwx1wD-4DHTFydRELwHNp2kA";
  //$id = $_GET['id'];
 
  $lat = 0;
  $long = 0;
  $zoom = 12;
  $search = "Balla";
 //$search = $_POST['search'];
  $findmap = "SELECT latitude, longitude FROM sportsrec_facilities WHERE lga LIKE '$search%' OR suburb LIKE '$search%'";
 
  if(!$result = $conn->query($findmap)){
     die('There was an error running the query [' . $conn->error . ']');
  } else {
      $row = $result->fetch_assoc();
      $lat = $row['latitude'];
      $long = $row['longitude'];
  }   
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport"
        content="initial-scale=1.0, user-scalable=no" />
   
    <style>
      body { font-family: sans-serif; }
      #map-canvas, #panel { height: 500px; }
      #panel { width: 300px; float: left; margin-right: 10px; }
      #panel .feature-filter label { width: 130px; }
      p.attribution, p.attribution a { color: #666; }
      .store .hours { color: grey; }
 </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=
          <?php echo $apikey; ?>&sensor=false">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(<?php echo $lat.', '.$long; ?>),
          zoom: <?php echo $zoom; ?>
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
        <?php
          $getpoints = "SELECT facility_name, latitude, longitude FROM sportsrec_facilities WHERE lga LIKE '$search%' OR suburb LIKE '$search%'";
         
          if(!$result = $conn->query($getpoints)){
            die('There was an error running the query 
                [' . $conn->error . ']');
          } else {
            while ($row = $result->fetch_assoc()) {
              echo '  var myLatlng1 = new google.maps.LatLng('.
                  $row[latitude].', '.$row[longitude].'); 
          var marker1 = new google.maps.Marker({ 
            position: myLatlng1, 
            map: map, 
            title:"'.$row[facility_name].'"
          });';
            }
          }
?>
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
  <div class="active-cyan-4 mb-4" id="search_text">
    <input type="text" name="country" id="region" class="form-control input-lg" autocomplete="off" placeholder="Start by typing a suburb here. Ex: Ballarat" />
  </div>
  <div id = "panel">
    <?php 
      $query = "SELECT * FROM sportsrec_facilities WHERE lga LIKE '$search%' OR suburb LIKE '$search%' LIMIT 10";
      $search_query = mysqli_query($conn, $query);
      while( $row = mysqli_fetch_array($search_query) ){
      $facility = $row['facility_name'];
      $streetNo = $row['street_no'];
      $streetAdd = $row['street_add'];
      $suburb = $row['suburb'];
      $postcode = $row['postcode'];
      $sport = $row['sport_type'];
      $lat = $row['latitude'];
      $long = $row['longitude'];
    ?>
    
            <div class="team-inner">
                <?php echo "<strong>{$facility}</strong>"?>
          </div>
    </div>
    <?php } ?>
    <div id="map-canvas"/>
  </body>
</html>
<script type="text/javascript">
   $(document).ready(function(){
     $('#region').typeahead({
        source: function(query, result)
        {
           $.ajax({
              url:"suburbName.php",
              method:"POST",
              data:{query:query},
              dataType:"json",
              success:function(data)
              {
                 result($.map(data, function(item){
                    return item;
                }));
             }
         })
       }
   });
     
   });
</script>