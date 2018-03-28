<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<!-- Unemployment Section Start -->
<section id="services" class="section">
  <div class="container">
    <div class="section-header">          
      <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Unemployment Rates</h2>
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Play around with the interactive map below to see which regional areas have the highest or lowest employment rates.</p>
    </div>
    <!-- Tableau section -->
    <div class='container' id='viz1521951465270' style='position: relative'>
      <noscript>
        <a href='#'><img alt='Dashboard 1 ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Da&#47;Dashboard_1022&#47;Dashboard1&#47;1_rss.png' style='border: none' /></a>
      </noscript>
      <object class='tableauViz'  style='display:none;'>
        <param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> 
        <param name='embed_code_version' value='3' /> <param name='site_root' value='' />
        <param name='name' value='Dashboard_1022&#47;Dashboard1' />
        <param name='tabs' value='no' /><param name='toolbar' value='yes' />
        <param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Da&#47;Dashboard_1022&#47;Dashboard1&#47;1.png' />
        <param name='animate_transition' value='yes' />
        <param name='display_static_image' value='yes' />
        <param name='display_spinner' value='yes' />
        <param name='display_overlay' value='yes' />
        <param name='display_count' value='yes' />
      </object>
    </div>                
    <script type='text/javascript'>                    
      var divElement = document.getElementById('viz1521951465270');                    
      var vizElement = divElement.getElementsByTagName('object')[0];                    
      vizElement.style.width='1000px';vizElement.style.height='827px';                    
      var scriptElement = document.createElement('script');                    
      scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    
      vizElement.parentNode.insertBefore(scriptElement, vizElement);                
    </script>
    <div class="section-header">          
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"> Think the map is a bit confusing? We've got you covered. Click <a href= "unemploy.php"> Here </a> to view the data in a tabular format!</p>
    </div>
  </div>
</section>
<!-- Unemployment Section End -->

<!-- Industries - Repeat Services section -->
<section id="features" class="section">
  <div class="container">
    <div class="section-header">          
      <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Industries Around Regional Victoria</h2>
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"> Use the filter options on the right to add in the industry and region of your choice to see the number of businesses in that region, on an interactive map. </p>
      <p> Or use the filters below that to view it in a time series graph. </p>
    </div>
    <!-- Tableau section -->
    <div class='container' id='viz1522212704727' style='position: relative'>
      <noscript>
        <a href='#'><img alt='Dashboard 1 ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;In&#47;Industry_26&#47;Dashboard1&#47;1_rss.png' style='border: none' /></a>
      </noscript>
      <object class='tableauViz'  style='display:none;'>
        <param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> 
        <param name='embed_code_version' value='3' /> 
        <param name='site_root' value='' />
        <param name='name' value='Industry_26&#47;Dashboard1' />
        <param name='tabs' value='no' />
        <param name='toolbar' value='yes' />
        <param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;In&#47;Industry_26&#47;Dashboard1&#47;1.png' /> 
        <param name='animate_transition' value='yes' />
        <param name='display_static_image' value='yes' />
        <param name='display_spinner' value='yes' />
        <param name='display_overlay' value='yes' />
        <param name='display_count' value='yes' />
      </object>
    </div>                
    <script type='text/javascript'>                    
      var divElement = document.getElementById('viz1522212704727');                    
      var vizElement = divElement.getElementsByTagName('object')[0];                    
      vizElement.style.width='1000px';vizElement.style.height='827px';                    
      var scriptElement = document.createElement('script');                    
      scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    
      vizElement.parentNode.insertBefore(scriptElement, vizElement);                
    </script>
    <!-- Tableau end -->
    <div class="section-header">          
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"> Think the map is a bit confusing? We've got you covered. Click <a href= "industry.php"> Here </a> to view the data in a tabular format!</p>
    </div>
  </div>
</section>
<!-- Industries Section End -->    

<!-- Rent Section -->
<section id="portfolios" class="section">
  <div class="container">
    <div class="section-header">          
      <h2 class="section-title">Housing Around Regional Victoria</h2>
      <hr class="lines">
      <p class="section-subtitle"> Use the filters on the right below, to select the type of housing and the region, which then displays a time series of rent prices through a few years. </p>
      <p>Housing prices may help you decide which region has affordable options to live in.</p>
    </div>
    <div class="row">          
      <div class="col-md-12">
        <!-- Portfolio Controller/Buttons -->
        <div class='container' id='viz1522212662968' style='position: relative'>
          <noscript>
            <a href='#'> <img alt='Dashboard 2 ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Re&#47;Rent_6&#47;Dashboard2&#47;1_rss.png' style='border: none' /></a>
          </noscript>
          <object class='tableauViz'  style='display:none;'>
            <param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> 
            <param name='embed_code_version' value='3' /> 
            <param name='site_root' value='' />
            <param name='name' value='Rent_6&#47;Dashboard2' />
            <param name='tabs' value='no' />
            <param name='toolbar' value='yes' />
            <param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Re&#47;Rent_6&#47;Dashboard2&#47;1.png' /> 
            <param name='animate_transition' value='yes' />
            <param name='display_static_image' value='yes' />
            <param name='display_spinner' value='yes' />
            <param name='display_overlay' value='yes' />
            <param name='display_count' value='yes' />
            <param name='filter' value='publish=yes' />
          </object>
        </div>                
        <script type='text/javascript'>                    
          var divElement = document.getElementById('viz1522212662968');                    
          var vizElement = divElement.getElementsByTagName('object')[0];                    
          vizElement.style.width='1000px';vizElement.style.height='827px';                    
          var scriptElement = document.createElement('script');                    
          scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    
          vizElement.parentNode.insertBefore(scriptElement, vizElement);                
        </script>
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
                <a href="#features">Industries Around</a>
              </li>
              <li>
                <a href="#portfolios">Housing</a>
              </li>
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