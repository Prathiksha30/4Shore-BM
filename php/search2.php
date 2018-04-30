<?php
    /*$connect = mysqli_connect('localhost', 'root', '', 'test');*/
    include 'connect_db.php';

/*if( $connect ){
    echo 'Yes. It is working';
}*/
    //$connect = mysqli_connect('fshore.cxjhwwvvzrvf.ap-southeast-2.rds.amazonaws.com', 'jkang94', 'HjPr!4ShoreK1.08', 'beyond_melb');
global $conn;
$search = $_POST['search'];
if(!empty($search)){
    $query = "SELECT * FROM sportsrec_facilities WHERE lga LIKE '$search%' OR suburb LIKE '$search%'";
    $search_query = mysqli_query($conn, $query);
    if(!$search_query){
       // die('QUERY FAILED' . mysqli_error($connect));
    }?>
    <div class="row">
            
    <?php
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
<!-- <div class="col-lg-6 col-sm-6 col-xs-6 box-item"> -->
<div class = "col-md-6 col-sm-6">
<div class="single-team">
<div class="team-details" style="text-align:left">
<div class="team-inner">


        <ul class="list-unstyled"> 
             <?php echo "<li><strong>{$facility}</strong></li>"?>
             <?php echo "<li>{$streetNo} {$streetAdd}</li>"?>
             <?php echo "<li>{$suburb} {$postcode}</li>"?>
             <?php echo "<li>{$sport}</li>"?>
             <?php echo "<li> <i class='lnr lnr-map-marker'>
             <a href='http://maps.google.com/maps?q= $lat,$long'>Open in maps</a>
             </i>"?>
        </ul>
        </div>
        </div>
        </div>
        <br><br>
        </div>
        
    <?php
    }
} ?>

</div>
