<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<body onload="initViz(); initViz2();">
<!-- Unemployment Section Start -->
<section id="services" class="section">
  <div class="container">
    <div class="section-header">          
      <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Unemployment Rates</h2>
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Play around with the interactive map below to see which regional areas have the highest or lowest unemployment rates.</p>
    </div>
    <!-- Tableau section -->
    <div class='container' id= 'vizContainer2' style='position: relative'>
     </div>
    <div class="section-header">          
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"> Think the map is a bit confusing? We've got you covered. Click <a href= "unemploy.php"> Here </a> to view the data in a tabular format!</p>
    </div>
  </div>
</section>
<!-- Unemployment Section End -->   

<!-- Rent Section -->
<section id="features" class="section">
  <div class="container">
    <div class="section-header">          
      <h2 class="section-title">Industries & Housing in Regional Victoria</h2>
      <hr class="lines">
      <p class="section-subtitle"> Use the filters on the left below, to select the region, or use the interactive map. </p>
      <!-- <p>Housing prices may help you decide which region has affordable options to live in.</p> -->
    </div>
    <div class="row">          
      <div class="col-md-12">
        <!-- Tableau Section RESPONSIVE-->
        <div class='container' id='vizContainer' style='position: relative'>
          
          <!--  <div class="section-header">          
          <hr class="lines wow zoomIn" data-wow-delay="0.3s">
          <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"> Think the map is a bit confusing? We've got you covered. Click <a href= "industry.php"> Here </a> to view the data in a tabular format!</p>
        </div> -->
      </div>
    </section>
    <!-- Rent Section Ends --> 


    <!-- Footer Section Start -->
    <footer>          
      <div class="container">
        <div class="row">
          <!-- Footer Links -->
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <ul class="footer-links">
              <li>
                <a href="#hero-area">Homepage</a>
              </li>
              <li>
                <a href="#services">Unemployment Rates</a>
              </li>
              <li>
                <a href="#features">Industries & Housing</a>
              </li>
              <!-- <li>
                <a href="#portfolios">Housing</a>
              </li> -->
            </ul>
          </div>
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="copyright">
              <p>"The World's Unfair" - How can I help?</p>
              <p> By 4Shore</p>
            </div>
          </div>  
        </div>
      </div>
    </footer>
    <!-- Footer Section End --> 

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
      <i class="lnr lnr-arrow-up"></i>
    </a>

    <div id="loader">
      <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
      </div>
    </div>     

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="js/jquery-min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mixitup.js"></script>
    <script src="js/nivo-lightbox.js"></script>
    <script src="js/owl.carousel.js"></script>    
    <script src="js/jquery.stellar.min.js"></script>    
    <script src="js/jquery.nav.js"></script>    
    <script src="js/scrolling-nav.js"></script>    
    <script src="js/jquery.easing.min.js"></script>    
    <script src="js/smoothscroll.js"></script>    
    <script src="js/jquery.slicknav.js"></script>     
    <script src="js/wow.js"></script>   
    <script src="js/jquery.vide.js"></script>
    <script src="js/jquery.counterup.min.js"></script>    
    <script src="js/jquery.magnific-popup.min.js"></script>    
    <script src="js/waypoints.min.js"></script>    
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>   
    <script src="js/main.js"></script>
    
  </body>
  </html>