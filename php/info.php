<?php
include 'connect_db.php';
global $conn;
$search = $_POST['search'];
if(!empty($search)){
	$query = "SELECT * FROM sportsrec_facilities WHERE lga LIKE '$search%' OR suburb LIKE '$search%' LIMIT 10";
	$search_query = mysqli_query($conn, $query);
	$num_rows = 0;
	
	if(!$search_query){
       // die('QUERY FAILED' . mysqli_error($connect));
		echo "<h6> Sorry, no results at the moment. </h6>";
	}?>
	<div class="row">

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
								<a target='_blank' href='http://maps.google.com/maps?q= $lat,$long'>Open in maps</a>
							</i>"?>
						</ul>
					</div>
				</div>
			</div>
			<br><br>
		</div>
		<?php
	}
	
	//Schools Data
	$query2 = "SELECT * FROM school_final WHERE SA2_Name LIKE '$search%' AND School_Type LIKE 'Primary' LIMIT 10";
	$search_query2 = mysqli_query($conn, $query2);
	if(!$search_query2){
       // die('QUERY FAILED' . mysqli_error($connect));
	}?>
	<!-- <div class="row"> -->
		<?php
		while( $row2 = mysqli_fetch_array($search_query2) ){
			$num_rows++;
			$school = $row2['School_Name'];
			$type = $row2['School_Type'];
			$Name = $row2['SA2_Name'];
			$addP = $row2['Address_Postcode'];
			$edu = $row2['Education_Sector'];
			$lat = $row2['Y'];
			$long = $row2['X'];
			?>
			<!-- <div class="col-lg-6 col-sm-6 col-xs-6 box-item"> -->
			<div class = "col-md-6 col-sm-6">
				<div class="single-team">
					<div class="team-details" style="text-align:left">
						<div class="team-inner">
							<ul class="list-unstyled"> 
								<?php echo "<li><strong>{$school}</strong></li>"?>
								<?php echo "<li>{$Name}</li>"?>
								<?php echo "<li>{$addP}</li>"?>
								<?php echo "<li>{$type}</li>"?>
								<?php echo "<li> <i class='lnr lnr-map-marker'>
								<a target='_blank' href='http://maps.google.com/maps?q= $lat,$long'>Open in maps</a>
							</i>"?>
						</ul>
					</div>
				</div>
			</div>
			<br><br>
		</div>
		<?php
	}
	//Hospital Data
	$query3 = "SELECT * FROM hospitals_final WHERE SA2_Name LIKE '$search%' LIMIT 10";
	$search_query3 = mysqli_query($conn, $query3);
	if(!$search_query3){
       // die('QUERY FAILED' . mysqli_error($connect));
	}?>
	<!-- <div class="row"> -->
		<?php
		while( $row3 = mysqli_fetch_array($search_query3) ){
			$num_rows++;
			$hName = $row3['LabelName'];
			$hType = $row3['Type'];
			$sName = $row3['SA2_Name'];
			$pc = $row3['Postcode'];
			$lat = $row3['Y'];
			$long = $row3['X'];
			?>
			<!-- <div class="col-lg-6 col-sm-6 col-xs-6 box-item"> -->
			<div class = "col-md-6 col-sm-6">
				<div class="single-team">
					<div class="team-details" style="text-align:left">
						<div class="team-inner">
							<ul class="list-unstyled"> 
								<?php echo "<li><strong>{$hName}</strong></li>"?>
								<?php echo "<li>{$sName} {$pc}</li>"?>
								<?php echo "<li>{$pc}</li>"?>
								<?php echo "<li>{$hType}</li>"?>
								<?php echo "<li> <i class='lnr lnr-map-marker'>
								<a target='_blank' href='http://maps.google.com/maps?q= $lat,$long'>Open in maps</a>
							</i>" ?>
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
			<center><p class="section-subtitle"> Sorry, no results at the moment.</p></center>
		</div>
	</div>
	<?php }
} ?>

</div>
