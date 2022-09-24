<?php  
require 'function.php';

session_start();

// user yng sudah login tidak bisa kembali ke halaman register
if ( isset($_SESSION['login']) ) {
  header("Location: index.php");
  exit;
}

if ( isset($_POST['create']) ) {
  if ( registrasi($_POST) > 0 ) {
    echo "<script>
        alert('User Berhasil Ditambahkan, Silahkan Login');
        document.location.href = 'login.php';
        </script>";
  } elseif ( registrasi($_POST) == 0 ) {
    $error1 = true;
  } 
  else {
    $error2 = true;
  }
}

// change password
if (isset($_POST['change'])) {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];
    $check_pw = mysqli_query($conn, "SELECT * FROM akun_user WHERE username = '$username' AND email = '$email' ");

    if (mysqli_fetch_assoc($check_pw)) {

      if ( $password1 == $password2 ) {
          // enkripsi password
          $password = password_hash($password1, PASSWORD_DEFAULT);
          mysqli_query($conn,"UPDATE akun_user SET password = '$password' WHERE username = '$username' ");

          echo "<script>
              alert('Password changed successfully');
              document.location.href = 'login.php';
              </script>";
      } else{
          echo "<script>
            alert('Password doesn't match);
            </script>";
      }
      
    } else{
        echo "<script>
          alert('Account not found');
          </script>";
    }
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
            <div class="dropdown-menu">
              <a href="login.php" class="dropdown-item">Login</a>
              <a href="register.php" class="dropdown-item">Register</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <a href="about_us.php" class="nav-link" href="#" role="button">
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
      <div class="col-lg-6 text-center mx-auto">
          <h1 class="text-white display-1">Rock Scissors Paper Game</h1>
      </div>
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
      <div class="container pt-lg-7">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="card bg-secondary shadow border-0">
              <p class="display-3 text-primary mx-auto pt-3">Register Form</p>
                <form role="form" class="p-4" action="" method="post">
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                      </div>
                      <input class="form-control" placeholder="Name" type="text" name="username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                      <input class="form-control" placeholder="Email" type="email" name="email" required>
                    </div>
                  </div>
                  <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Password" type="password" name="password1" required>
                    </div>
                  </div>
                  <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Confirm password" type="password" name="password2" required>
                    </div>
                  </div>
                  <div class="row my-4">    
                    <div class="mx-auto">
                      <button type="submit" class="btn btn-primary mt-4" name="create">Create account</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="mx-auto">
            <a href="#" class="text-light" data-toggle="modal" data-target="#changeModal"><small>Forgot password? </small></a>
            <span class="text-muted">or</span>
            <a href="login.php" class="text-light"><small> Have an account</small></a>
             <?php
              if ( isset($error1) ) : ?>
                <p style="font-style: italic; color: red; text-align: center">Username / email not available</p>
              <?php endif;

              if ( isset($error2) ) : ?>
                <p style="font-style: italic; color: red; text-align: center;">Password not same</p>
              <?php endif; ?>
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
    <!-- change password Modal-->
    <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                <form role="form" class="p-4" action="" method="post">
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                      </div>
                      <input class="form-control" placeholder="Name" type="text" name="username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                      <input class="form-control" placeholder="Email" type="email" name="email" required>
                    </div>
                  </div>
                  <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="New password" type="password" name="password1" required>
                    </div>
                  </div>
                  <div class="form-group focused">
                    <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Confirm new password" type="password" name="password2" required>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary my-2" name="change">Change</button>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Back</button>
              </div>
            </div>
        </div>
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