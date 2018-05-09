<?php
include 'connect_db.php';
global $conn;
$search = $_POST['search'];
$num_rows = 0;
if(!empty($search)){
	$query = "SELECT * FROM hospitals_final WHERE SA2_Name LIKE '$search%'";
	$search_query = mysqli_query($conn, $query);
	if(!$search_query){
       // die('QUERY FAILED' . mysqli_error($connect));
	}?>
	<div class="row">

		<?php
		while( $row = mysqli_fetch_array($search_query) ){
			$num_rows++;
			$hName = $row['LabelName'];
			$hType = $row['Type'];
			$sName = $row['SA2_Name'];
			$pc = $row['Postcode'];
			$lat = $row['Y'];
			$long = $row['X'];
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
		if($num_rows== 0){ ?>
			<div class="row">
				<div class="section-header">
					<center><p class="section-subtitle"> Sorry, we couldn't find any results for hospitals in <strong><?php echo $search?></strong>.</p></center>
				</div>
			</div>
	<?php }
	}
} ?>
</div>