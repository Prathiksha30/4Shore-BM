<style type="text/css">
  #map-canvas{
    height: 80%;
    width: 100%;
  }
</style>
<!DOCTYPE html>
<html>
<head>
  <title>Regional Victoria</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
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
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand"><img class="img-fulid" src="../img/BM.png" alt=""></a>
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
              <a class="nav-link page-scroll active" href="#">Regional Victoria</a>
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
          <a class="page-scroll" href="../industries.php">Industry</a>
        </li>
      </ul>
      <!-- Mobile Menu End -->
    </nav>
    <!-- Navbar End -->   
    <div class="container">      
      <div class="row justify-content-md-center">
        <div class="col-md-10">
           <div class="contents text-center">
              <h1 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">Explore Regional Victoria</h1>
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
  <section class="section" style="padding: 5px;" id="custom">
  <div class="containerCustom">
    <div class="mydiv">
      <div class="single-team">
      <div class="team-details"><p>Click the name to zoom in and Click the marker for more information!</p></div>
      </div>
      <br />
      <!-- List of public amenities -->
      <div class="col-lg-3 col-md-6 col-xs-12" id="result" style="overflow-y:scroll; height: 520px; width: 210px;">
      </div>
      <div class="col-lg-10 col-md-6 col-xs-12" id="result" style="float: right;">
      <div class="map-canvas" id="map-canvas">
      </div>
      </div>
    </div> 
    </div>
  </section>  
  </section>   
</body>
</html>
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

