<?php
include 'connect_db.php';
global $conn;
$num_rows = 0;
$search = $_POST['search'];
if(!empty($search)){
	$query = "SELECT * FROM sportsrec_facilities WHERE lga LIKE '$search%' OR suburb LIKE '$search%' LIMIT 10";
	$search_query = mysqli_query($conn, $query);
	if(!$search_query){
       // die('QUERY FAILED' . mysqli_error($connect));
	}?>
	<div class="row">

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
								<a target='_blank' href='http://maps.google.com/maps?q= $lat,$long'>Open in maps</a></i>"?>
						</ul>
					</div>
				</div>
			</div>
			<br><br>
		</div>
		<?php
	}
		if($num_rows== 0){ ?>
			<div class="row">
				<div class="section-header">
					<center><p class="section-subtitle"> Sorry, we couldn't find any results for sports facilities in <strong> <?php echo $search?></strong>.</p></center>
				</div>
			</div>
	<?php }
} ?>
</div>