<style type="text/css">
  #map-canvas{
    height: 520px;
    width: 100%;
  }
</style>
<!DOCTYPE html>
<html>
<head>
  <title>Regional Victoria</title>
  <link rel="shortcut icon" href="img/icon-log.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/line-icons.css">
  <link rel="stylesheet" href="../css/owl.carousel.css">
  <link rel="stylesheet" href="../css/owl.theme.css">
  <link rel="stylesheet" href="../css/nivo-lightbox.css">
  <link rel="stylesheet" href="../css/magnific-popup.css">
  <link rel="stylesheet" href="../css/slicknav.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/main.css">    
  <link rel="stylesheet" href="../css/responsive.css"> 
</head>
 <body>
  <!-- Header Section Start -->
 <header id="customHero" data-stellar-background-ratio="0.5">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg scrolling-navbar indigo">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display TW Cen MT Condensed for logo font-->
        <div class="navbar-header">
          <a href="../index.php" class="navbar-brand"><img class="img-fulid" src="../img/BM3.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lnr lnr-menu"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="main-navbar">
          <ul class="navbar-nav mr-auto w-100 justify-content-end">
            <li class="nav-item">
              <a class="nav-link page-scroll" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link page-scroll" style="background: #61D2B4;">Regional Victoria</a>
            </li>
            <li class="nav-item">
              <a class="nav-link page-scroll" href="../industries.php">Industries</a>
            </li>
          </ul>
        </div>
      </div>

      <!-- Mobile Menu Start -->
      <ul class="mobile-menu">
        <li>
          <a class="page-scroll" href="../index.php">Home</a>
        </li>
        <li>
          <a class="page-scroll" href="#">Regional Victoria</a>
        </li>
        <li>
          <a class="page-scroll" href="../industries.php">Industries</a>
        </li>
      </ul>
      <!-- Mobile Menu End -->
    </nav>
    <!-- Navbar End -->   
    <div class="container">      
      <div class="row justify-content-md-center">
        <div class="col-md-10">
          <div class="contents text-center">
            <h1 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">Explore Regional Vic</h1>
            <!-- <p class="lead  wow fadeIn" data-wow-duration="1000ms" data-wow-delay="400ms"> Search by suburb or regions </p> -->
            <!-- FOR SEARCH -->
            <div class="active-cyan-4 mb-4" id="search_text">
                  <input type="text" name="region" id="region" class="form-control input-lg" autocomplete="off" placeholder="Start by typing a suburb here. Ex: Ballarat" />
            </div>
            <!-- <a href="#" class="btn btn-common wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">Download</a> -->
          </div>
        </div>
      </div> 
    </div> 
   </header>
  <br />
<!-- Public Amenities section starts here -->
<section id ="portfolios" class="section" style="padding: 0px;">
  <div class="container">
    <div id="mydiv">
      <div class="section-header">
        <hr class="lines">
        <p class="section-subtitle"> You'll find schools, hospitals and sports/recreation facilities listed below. </p>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="controls text-center">
            <button class="btn" id="all" onclick="allFunc()"> All </button>
            <button class="btn" id="sport" onclick="hospFunc()"> Hospitals</button>
            <button class="btn" id="school" onclick="schFunc()"> Schools </button>
            <button class="btn" id="hosp" onclick="sportFunc()"> Sport </button>
          </div>
        </div>
      </div>
    </div> <!-- END OF MYDIV --> 
  </div>
<!-- BEGIN LIST HERE -->
  <!-- <section class="section" style="padding: 5px;" id="custom"> -->
    <div class="containerCustom" id="custom">
      <div class="mydiv">
        <div class="single-team">
        <div class="team-details"><p>Click the name to zoom in and Click the marker for more information!</p></div>
        </div>
        <!-- List of public amenities col-lg-3 col-md-6 col-xs-12
        col-lg-10 col-md-6 col-xs-12-->
        <br>
        <div class="col-xs-6 col-md-4" id="result" style="overflow-y:scroll; height: 520px; width: 100%;"></div>
        <div class="col-xs-12 col-md-8" id="result" style="float: right;">
          <div class="map-canvas" id="map-canvas"></div>
          <br />
        </div>
      </div> 
    </div>
  <!-- </section>   -->
</section>  
<br /> <br />
</body>

</html>
  <!-- Footer Section Start -->
<footer style="position: relative; width: 100%; clear: both; bottom: 0px;">          
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-sm-6 col-xs-12">
        <ul class="footer-links">
          <li>
            <a href="../index.php">Homepage</a>
          </li>
          <li>
            <a href="#top">Regional Victoria</a>
          </li>
          <li>
            <a href="../industries.php">Industries</a>
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
  <!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.mixitup.js"></script>
<script src="../js/nivo-lightbox.js"></script>
<script src="../js/owl.carousel.js"></script>    
<script src="../js/jquery.stellar.min.js"></script>    
<script src="../js/jquery.nav.js"></script>    
<script src="../js/scrolling-nav.js"></script>    
<script src="../js/jquery.easing.min.js"></script>    
<script src="../js/smoothscroll.js"></script>    
<script src="../js/jquery.slicknav.js"></script>     
<script src="../js/wow.js"></script>   
<script src="../js/jquery.vide.js"></script>
<script src="../js/jquery.counterup.min.js"></script>    
<script src="../js/jquery.magnific-popup.min.js"></script>    
<script src="../js/waypoints.min.js"></script>    
<script src="../js/form-validator.min.js"></script>
<script src="../js/contact-form-script.js"></script>   
<script src="../js/main.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
     var x = document.getElementById("mydiv");
     var y = document.getElementById("custom");
     y.style.display = "none";
     x.style.display = "none";
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
     $('#region').keyup(function(e){
      var m = document.getElementById('map-canvas');
      m.style.display = "block";
      if(e.keyCode == 13)
      {
          var search = $('#region').val();
          if(!($('#region').val().match(/[A-Za-z]+/)) || ($('#region').val().match(/\d+/))){
            // Your code here
            alert("Make sure you enter a valid suburb name!");
        }
        else{
          console.log(search);
          $.ajax({
            url:'info2.php',
            data:{search, search},
            type:'GET',
            success:function(data){
              if(!data.error){
                $('#result').html(data);
                console.log("inside if");
                x.style.display ="block";
                y.style.display = "block";
            }
            else{
                x.style.display ="none";
            }

        }
    });
      }
  }
});
   });
// on click for All
function allFunc(){
  var x = document.getElementById("mydiv");
  x.style.display = "none";
  var search = $('#region').val();
  console.log(search);
  $.ajax({
    url:'info2.php',
    data:{search, search},
    type:'GET',
    success:function(data){
      if(!data.error){
        $('#result').html(data);
        x.style.display = "block";
    }
    else{
        x.style.display = "none";
    }
}
});
}

// on click function for Sport
function sportFunc(){
  console.log("button clicked");
  var x = document.getElementById("mydiv");
  x.style.display = "none";
  var search = $('#region').val();
  $.ajax({
    url:'sportMap.php',
    data:{search, search},
    type: 'GET',
    success:function(data){
     if(!data.error){
        $('#result').html(data);
        x.style.display = "block";
    }
    else{
        x.style.display = "none";
    }
}
});
}

// on click for schools
function schFunc(){
  console.log("school button clicked");
  var x = document.getElementById("mydiv");
  x.style.display = "none";
  var search = $('#region').val();
  $.ajax({
    url:'schoolMap.php',
    data:{search, search},
    type: 'GET',
    success:function(data){
     if(!data.error){
        $('#result').html(data);
        x.style.display = "block";
    }
    else{
        x.style.display = "none";
    }
}
});
}
// on click for hospital
function hospFunc(){
  console.log("hospital button clicked");
  var x = document.getElementById("mydiv");
  x.style.display = "none";
  var search = $('#region').val();
  $.ajax({
    url:'hospMap.php',
    data:{search, search},
    type: 'GET',
    success:function(data){
     if(!data.error){
        $('#result').html(data);
        x.style.display = "block";
    }
    else{
        x.style.display = "none";
        alert("Sorry nothing to display at this moment..");
    }
}
});
}
</script>
<!-- CSS for Typehead Autocomplete -->
<style type="text/css">
  .typeahead{
    background-color: #fff;
    min-width: 100%;
    max-height: 130px;
  overflow-y: auto;
}

.typeahead li{
    padding: 5px;
    overflow: auto;
    font-size: 16px;
}

.typeahead li.active{
    background-color: #eee;
}
</style>

