<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">

  <div class="card">
    <div class="row">

      <div class="col-6"><img src="" alt="Logo Here" ></div>

      <div class="col-6">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link"><b>Contact Us</b></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link"><b>About</b></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="register/" class="nav-link"><b>Sign Up</b></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <b class="nav-link">|</b>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="login/" class="nav-link"><b>Login</b></a>
            </li>
          </ul>
        </nav>
        <!-- /.navbar -->
      </div>
      <!-- /.col-6 -->

    </div>
    <!-- /.row -->
  </div>
  <!-- /.card -->

  <div class="row justify-content-center mt-5"><h2><b>Resource Generation Management Office</b> <i>(RGMO)</i> <b>Rental Services Monitoring System</b></h2></div>
  <!-- <div class="row justify-content-center"><h2></h2></div> -->

  <div class="row justify-content-center">
    <div id="carousel-main-div" class="carousel slide border border-dark mt-5" style="height: 300px; width: 400px;" data-ride="carousel">
      <ol class="carousel-indicators"></ol>
      <div class="carousel-inner"></div>
      <a class="carousel-control-prev" href="#carousel-main-div" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-main-div" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <div class="row justify-content-center mt-5"><h4><b>Available Services</b></h4></div>
  <div class="row w-100 justify-content-center" id="services-display-div"></div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  
  $(document).ready(function() {

    // Carousel auto slide
    $('.carousel').carousel();

    // Get All Services image
    $.ajax({
      url: 'controller/ServicesController.php',
      type: 'POST',
      data: {case: 'all types'},
      success: function(data) {

        for(index = data.length - 1, counter = 0; index >= 0; index--, counter++ ) {
          
          let li_target = $("<li data-target='#carousel-main-div' data-slide-to='"+counter+"'></li>");
          let carousel_item = $("<div class='carousel-item'></div>");
          let img = $("<img class='d-block' style='height: 300px; width: '400px;' src='includes/images/"+data[index].service_image+"' alt='"+data[index].type_name+"'>")
          let div_caption = $("<div class='carousel-caption d-none d-md-block'></div>");
          let h5 = $("<h5>"+data[index].type_name+"</h5>");
          let p = $("<p>Service "+data[index].service_id+"</p>");

          // Carousel Indicators
          if(counter == 0) { li_target.addClass('active') }
          $('.carousel-indicators').append(li_target);

          // Carousel Inner
          div_caption.append(h5).append(p);
          carousel_item.append(img).append(div_caption);
          if(index == 0) { carousel_item.addClass('active') }
          $('.carousel-inner').prepend(carousel_item);

        }// for

      }
    });

    // Get List of Services
    $.ajax({
      url: 'controller/ServicesController.php',
      type: 'POST',
      data: {case: 'services'},
      success: function(data) {

        data.forEach(element => {
          
          let col = $("<div class='col-2' style='cursor: pointer;'></div>");
          let small_box = $("<div class='small-box bg-primary mt-5'></div>");
          let inner_box = $("<div class='inner'>" +
            "<small>"+element.service_name+"</small>" +
            "<div class='icon'>" +
              "<i class='ion ion-bag'></i>" +
            "</div>" +
          "</div>");

          small_box.append(inner_box);
          col.append(small_box).on('click', function() {
            window.location.href = 'services/direct_service.php?service_name=' + element.service_name + '&type_id=0&client=0';
          });
          $('#services-display-div').append(col);

        });// foreach

      }
    });

  });//ready


</script>

</body>
</html>

