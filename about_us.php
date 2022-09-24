<?php  

require 'function.php';
session_start();

if ( isset($_SESSION['login']) ) {
  $login = true;
}

if ( !isset($_SESSION['login']) ) {
  $no_login = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    RSP Game
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="assets/css/argon-design-system.css?v=1.2.2" rel="stylesheet" />
</head>

<body class="register-page">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-2">
    <div class="container">
      <a class="navbar-brand mr-lg-5 text-warning" href="index.php">
        RSP game
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbar_global">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a class="text-warning" href="index.php">
                RSP game
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
          <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
              <i class="ni ni-collection d-lg-none"></i>
              <span class="nav-link-inner--text">Halaman</span>
            </a>

            <?php if (isset($no_login)) { ?>
              <div class="dropdown-menu">
                <a href="login.php" class="dropdown-item">Login</a>
                <a href="register.php" class="dropdown-item">Register</a>
              </div>
            <?php } ?>
            
            <?php if (isset($login)) { ?>
              <div class="dropdown-menu">
                <a href="index.php" class="dropdown-item">Game</a>
                <a href="profile.php" class="dropdown-item">Profile</a>
                <a href="logout.php" class="dropdown-item">Logout</a>
              </div>
            <?php } ?> 
            
          </li>
        </ul>
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <a href="about.php" class="nav-link" href="#" role="button">
              <span class="nav-link-inner--text">About us</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper">
    <section class="section section-shaped section-lg">
      <div class="shape shape-style-1 bg-gradient-default">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="container pt-lg-3">
        <div class="row justify-content-center">
          <div class="card bg-secondary shadow border-0">
            <p class="display-3 text-primary mx-auto pt-3">Our Team</p>

              <div class="row mx-auto my-4">

                <div class="col-md-3" style="padding-right: 40px; padding-left: 40px;">
                  <img class="bd-placeholder-img rounded-circle" src="images/boy-2.png" height="140" width="140">
                  <p class="font-weight-bold text-center mt-2 mb-2">Fikri Ahmad Faisal</p>
                  <p class="text-center my-1">207006045</p>
                  <p class="text-center my-1">Universitas Siliwangi</p>
                </div><!-- /.col-lg-4 -->

                <div class="col-md-3" style="padding-right: 40px; padding-left: 40px;">
                  <img class="bd-placeholder-img rounded-circle" src="images/indra.jpg" height="140" width="140">
                  <p class="font-weight-bold text-center mt-2 mb-2">Indra Rusyana</p>
                  <p class="text-center my-1">207006040</p>
                  <p class="text-center my-1">Universitas Siliwangi</p>
                </div><!-- /.col-lg-4 -->

                <div class="col-md-3" style="padding-right: 40px; padding-left: 40px;">
                  <img class="bd-placeholder-img rounded-circle" src="images/putri.jpg" height="140" width="140">
                  <p class="font-weight-bold text-center mt-2 mb-2">Putri Septia Amalia</p>
                  <p class="text-center my-1">207006049</p>
                  <p class="text-center my-1">Universitas Siliwangi</p>
                </div><!-- /.col-lg-4 -->

                <div class="col-md-3" style="padding-right: 40px; padding-left: 40px;">
                  <img class="bd-placeholder-img rounded-circle" src="images/sofia.jpg" height="140" width="140">
                  <p class="font-weight-bold text-center mt-2 mb-2">Sofia Royani</p>
                  <p class="text-center my-1">207006002</p>
                  <p class="text-center my-1">Universitas Siliwangi</p>
                </div><!-- /.col-lg-4 -->

              </div>
          </div>
        </div>
      </div>
    </section>
    <footer class="footer">
      <div class="container">
        <div class="row row-grid align-items-center mb-5">
          <div class="col-lg-6">
            <h3 class="text-primary font-weight-light mb-2">Thank you for supporting us!</h3>
            <h4 class="mb-0 font-weight-light">Let's get in touch on any of these platforms.</h4>
          </div>
        </div>
        <hr>
        <div class="row align-items-center justify-content-md-between">
          <div class="col-md-6">
            <div class="copyright">
              &copy; 2021
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/moment.min.js"></script>
  <script src="assets/js/plugins/datetimepicker.js" type="text/javascript"></script>
  <script src="assets/js/plugins/bootstrap-datepicker.min.js"></script>
  <!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <script src="assets/js/argon-design-system.min.js?v=1.2.2" type="text/javascript"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-design-system-pro"
      });
  </script>
</body>

</html>