<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Parallax, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>Public Amenities</title>

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

  </head>
  <body>
   
    <!-- Header Section Start -->
    <header id="customHero" data-stellar-background-ratio="0.5">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar indigo">
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
                <a class="nav-link page-scroll" href="index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll" href="#services">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link page-scroll">Public Amenities</a>
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
      <!-- Navbar End -->   
      <div class="container">      
        <div class="row justify-content-md-center">
          <div class="col-md-10">
            <div class="contents text-center">
              <h1 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">Sports and Recreation Facilities Around</h1>
              <p class="lead  wow fadeIn" data-wow-duration="1000ms" data-wow-delay="400ms"> Search by suburb or regions </p>
              <!-- FOR SEARCH -->
                <div class="active-cyan-4 mb-4" id="search_text">
                  <input class="form-control" type="text" placeholder="Search" aria-label="Search" id="search" name="search">
              </div>
              <!-- <a href="#" class="btn btn-common wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">Download</a> -->
            </div>
          </div>
        </div> 
      </div> 
      </header>
      <section id="blog" class="section">
      <div class="container">
      <!-- <div class="section-header">
      <div class="row"> -->
      
        <div class="text">
          <h6 id="result"></h6>
          
        </div>
       <!--  
      </div>
      </div> -->
      </section>          
    </header>
<?php
include 'footer.html';
?>
<script>
    $(document).ready(function(){
      $('#search').keyup(function(){
        var search = $('#search').val();
        $.ajax({
          url:'php/search2.php',
          data:{search, search},
          type:'POST',
          success:function(data){
            if(!data.error){
              $('#result').html(data);
            }
          }
        });
      });
    });
</script>
