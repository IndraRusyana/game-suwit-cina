<?php  
require 'function.php';
session_start();

if ( !isset($_SESSION['login']) ) {
  header("Location: login.php");
  exit;
}

$id = $_SESSION['id'];

$username_temp = query("SELECT username FROM akun_user WHERE id = $id")[0];
$username = $username_temp['username'];

$email_temp = query("SELECT email FROM akun_user WHERE id = $id")[0];
$email = $email_temp['email'];

$temp = explode(" ", $username);
$first_name = $temp[0];

$rows_data = mysqli_query($conn,"SELECT * FROM data_$first_name");

foreach ($rows_data as $key) {
      $photo = $key['photo'];
      $play = $key['play'];
      $win = $key['win'];
      $lose = $key['lose'];
      $percent = $key['percent'];
    }


if ( isset($_POST['clear_history']) ) {
  mysqli_query($conn,"DELETE FROM his_$first_name");
  $ubah = "UPDATE data_$first_name SET 
            play = '0',
            win = '0',
            lose = '0',
            percent = '0'
            WHERE id = '1'
          ";
    mysqli_query($conn, $ubah);
    header("refresh:1");
}

if ( isset($_POST['upload']) ) {
  $namaGambar = upload($first_name);
  header("refresh:1");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="">
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

<body class="profile-page">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg bg-white navbar-light top-0 shadow py-2">
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
              <a href="index.php" class="dropdown-item">Game</a>
              <a href="profile.php" class="dropdown-item">Profile</a>
              <a href="logout.php" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Logout</a>
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
    <section class="section-profile-cover section-shaped my-0">
      <div class="shape shape-style-3 shape-default">
        <span class="span-150"></span>
        <span class="span-50"></span>
        <span class="span-50"></span>
        <span class="span-75"></span>
        <span class="span-100"></span>
        <span class="span-75"></span>
        <span class="span-50"></span>
        <span class="span-100"></span>
        <span class="span-50"></span>
        <span class="span-100"></span>
      </div>
      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>
    <section class="section bg-secondary">
      <div class="container">
        <div class="card card-profile shadow mt--300">
          <div class="px-4">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2 ">
                <div class="card-profile-image">
                  <a href="javascript:;">
                    <img src="images/<?= $photo; ?>" class="rounded-circle bg-white" style="">
                  </a>
                </div>
              </div>
              
            </div>

            <div class="text-center mt-8">
            <div class="col-lg">
                <div class="card-profile-stats d-flex justify-content-center">
                  <div>
                    <span class="heading"><?= $play; ?></span>
                    <span class="description">Play</span>
                  </div>
                  <div>
                    <span class="heading"><?= $win ?></span>
                    <span class="description">Win</span>
                  </div>
                  <div>
                    <span class="heading"><?= $lose ?></span>
                    <span class="description">Lose</span>
                  </div>
                  <div>
                    <span class="heading"><?= $percent ?>%</span>
                    <span class="description">Percent</span>
                  </div>
                </div>
              </div>
              <h3><?= $username ?></h3>
              <div class="h6 font-weight-300"><?= $email ?></div>
              <div class="col-lg align-self-lg-center">
                <div class="mt-4">
                  <form action="" method="post">
                    <a class="btn btn-sm btn-info p-1 text-white" data-toggle="modal" data-target="#changeModal">Change photo</a>
                    <button class="btn btn-sm btn-default p-1" type="submit" name="clear_history">Clear history</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="mt-5 py-4 border-top text-center">
              <div class="row justify-content-center">
                <div class="col-lg-9">
                  <h4 class="pb-2">Last Match</h4>
                  <table border="0" cellpadding="10" class="mx-auto">
                    <tr>
                      <th>No</th>
                      <th>Result</th>
                      <th>Score</th>
                      <th>Date</th>
                    </tr>
                    <?php 
                    $history = query("SELECT * FROM his_$first_name ORDER BY id DESC LIMIT 3");
                    $id = 1;
                    foreach ( $history as $key ) { ?>
                      <tr>
                        <td><?= $id; ?></td>
                        <td><?= $key['result']; ?></td>
                        <td><?= $key['score_user']; ?> : <?= $key['score_comp']; ?></td>
                        <td><?= $key['dates']; ?></td>
                      </tr>
                    <?php 
                  $id++;
                  } ?>
                    
                  </table>
                </div>
              </div>
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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Yakin logout?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">Kamu akan logout dari akun ini.</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                  <a class="btn btn-primary" href="logout.php">Logout</a>
              </div>
          </div>
      </div>
  </div>
  <!-- change photo Modal-->
  <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Change photo</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                <form role="form" class="p-4" action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                      </div>
                      <input class="form-control" placeholder="Name" type="file" name="gambar" required>
                    </div>
                    <p>Max 2 mb</p>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary my-2" name="upload">Upload</button>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
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