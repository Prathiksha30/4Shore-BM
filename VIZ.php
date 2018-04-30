<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Parallax, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>Regional Victoria</title>

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
    <script src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script>
    <script src="js/tableauViz.js"></script>
  </head>
<header>
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
                <a class="nav-link page-scroll" href="index.php" style="color: #000000">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll" style="color: #000000">Regional Victoria</a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll" href="publicAmenities.php" style="color: #000000">Public Amenities</a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Mobile Menu Start -->
        <ul class="mobile-menu">
           <li>
              <a class="page-scroll" href="index.html">Home</a>
            </li>
            <li>
              <a class="page-scroll" href="visuals.php">Regional Victoria</a>
            </li>
            <li>
              <a class="page-scroll" href="publicAmenities">Public Amenities</a>
            </li>
          </ul>
        <!-- Mobile Menu End -->

      </nav>
</header>
<body onload="mainViz();">
<section id="services" class="section">
    <div class="section-header">
      <div class="video-promo-content text-center">
        <h5 class="section-title2 wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
          Use the Interactive Visualisations Below
        </h5>
        <hr class="lines wow zoomIn" data-wow-delay="0.3s">
        <h5 class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
        </h5>
      </div>
      <!-- TABLEAU SECTION -->
      <div class="container" id="vizContainer" style="position: relative">
      </div>
    </div>
</section> 
</body>
<?php
  include 'footer.html';
?>