<?php
	include '/php/connect_db.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Industries</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Parallax, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/line-icons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/nivo-lightbox.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/main.css">    
    <link rel="stylesheet" href="css/responsive.css">
    <!-- JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
  
 /* var x = document.getElementById("mydiv");
  x.style.display = "none";*/
		function Regions() {
			$('#region').empty();
			$('#region').append("<option>Loading......</option>");
			$.ajax({
				type:"GET",
				url:"php/industryName.php", //php file that returns JSON data of region names
				contentType:"application/json; charset=utf-8",
				dataType:"json",
				success:function(data){
					$('#region').empty();
					$('#region').append("<option value='0' style='background-color:#000000bd'>--Select Industry--</option>");
					$.each(data, function(i, item){
						$('#region').append('<option value="'+data[i]+'"style="background-color:#000000bd">'+ data[i].Industry+'</option>');
						//$('#region').append('<li>'+ data[i].LGA+'</li>');
					});
				},
				complete: function(){

				}
			});
		}
     function getData(sel)
    {
      var data="";
      var text = "";
        data = (sel.options[sel.selectedIndex].text);
        text = encodeURIComponent(data);
        console.log(text);
        console.log(data);
        iframe = document.getElementById('myIframe');
        iframe.src = "https://jkang94.shinyapps.io/prats/" + '?Industry=' +text;
        //x.style.display = "block";
    }

		$(document).ready(function(){
			Regions(); //call function Regions when page loads
      iframe = document.getElementById('myIframe');
        iframe.src = "";
		});
	</script>
</head>
<body>
<!-- Header Section Start -->
    <header id="customHero" data-stellar-background-ratio="0.5">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand-lg scrolling-navbar indigo">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a href="index.php" class="navbar-brand"><img class="img-fulid" src="img/BM.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
              <i class="lnr lnr-menu"></i>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
              <li class="nav-item">
                <a class="nav-link page-scroll" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll" href="regVic.html">Regional Victoria</a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll active">Industries</a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Mobile Menu Start -->
         <ul class="mobile-menu">
           <li>
              <a class="page-scroll" href="index.php">Home</a>
            </li>
            <li>
              <a class="page-scroll" href="regVic.html">Regional Victoria</a>
            </li>
            <li>
              <a class="page-scroll" href="#">Industries</a>
            </li>
          </ul>
        <!-- Mobile Menu End -->

      </nav>
      <!-- Navbar End -->   
      <div class="container">      
        <div class="row justify-content-md-center">
          <div class="col-md-10">
            <div class="contents text-center">
              <h1 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">Choose an Industry</h1>
              <!-- <p class="lead  wow fadeIn" data-wow-duration="1000ms" data-wow-delay="400ms"> Search by suburb or regions </p> -->
              <!-- FOR SEARCH -->
                <div class="form-group">
					<select class = "form-control" id="region" style="padding: 0px" onchange="getData(this);"></select>
				</div>
              <!-- <a href="#" class="btn btn-common wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">Download</a> -->
            </div>
          </div>
        </div> 
      </div> 
      
      </header>
      <section id="blog" class="section">
      <div class="mydiv">
      <div class="container">
      <div class="embed-responsive embed-responsive-16by9">
         <iframe id="myIframe" class="embed-responsive-item" allowfullscreen></iframe>
      </div>
      </div>
        <div class="text">
          <h6 id="result"></h6>
          
        </div>
      </section>          
    </header>
</body>
</html>