<?php  
require 'function.php';
session_start();

if ( !isset($_SESSION['login']) ) {
  header("Location: login.php");
  exit;
}

$id = $_SESSION['id'];

$akun = query("SELECT username FROM akun_user WHERE id = $id")[0];
$username = $akun['username'];

$temp = explode(" ", $username);
$first_name = $temp[0];

if (isset($username)) {
  create_data_user($first_name);
  create_his_user($first_name);
}

date_default_timezone_set('Asia/Jakarta');
$dates = date('d-m-y H:i');

if (isset( $_GET['userScore'] )) {
  $userScore = $_GET['userScore'];
  $compScore = 5;
  mysqli_query($conn," INSERT INTO his_$first_name VALUES('', 'lose', '$userScore', '$compScore', '$dates')");
}

if (isset( $_GET['compScore'] )) {
  $compScore = $_GET['compScore'];
  $userScore = 5;
  mysqli_query($conn, "INSERT INTO his_$first_name VALUES('', 'win', '$userScore', '$compScore','$dates')");
}

if (isset( $_GET['compScore']) || isset( $_GET['userScore']) ) {

    $history_play = query("SELECT * FROM his_$first_name");
    $history_win = query("SELECT result FROM his_$first_name WHERE result = 'win'");
    $history_lose = query("SELECT result FROM his_$first_name WHERE result = 'lose'");

    $play = count($history_play);
    $win = count($history_win);
    $lose = count($history_lose);

    $percent = round( ($win / $play) * 100 );

    $ubah = "UPDATE data_$first_name SET 
            play = '$play',
            win = '$win',
            lose = '$lose',
            percent = '$percent'
            WHERE id = '1'
          ";
    mysqli_query($conn, $ubah);

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favico.png">
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
  <link href="style.css" rel="stylesheet" />
</head>

<body class="landing-page">
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
              <a href="index.php" class="dropdown-item">Game</a>
              <a href="profile.php" class="dropdown-item">Profile</a>
              <a href="logout.php" class="dropdown-item">Logout</a>
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
    <div class="section section-hero section-shaped">
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
      <div class="page-header">
        <div class="container shape-container d-flex align-items-center py-lg">
          <div class="col px-0">
            <div class="row align-items-center justify-content-center">
              <div class="col-lg-6 text-center">
                <h1 class="text-white display-1">Rock Scissors Paper Game</h1>
                <h2 class="display-4 font-weight-normal text-white">Try to beat the game</h2>
                <div class="btn-wrapper mt-4">
                  <a href="#game" class="btn btn-warning btn-icon mt-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
                    <span class="btn-inner--text">Play Now</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <div class="section features-6" id="game">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mx-auto">
            <div class="info info-horizontal">
                <div class="score-board">
                  <div id="user-label" class="badge bg-warning text-white"><?= $first_name ?></div>
                  <div id="computer-label" class="badge bg-warning text-white">comp</div>
                  <span id="user-score" class="text-muted display-2">0</span>
                  <span class="text-muted display-2">:</span>
                  <span id="computer-score" class="text-muted display-2">0</span>
                </div>

                <div class="result">
                  <p class="text-muted display-4 font-weight-normal">Are You Ready !!!</p>
                </div>

                <div class="choices">
                  <div class="choice" id="r">
                    <img class="images" src="images/rock.png" alt="">
                    <p class="atr" id="rock">Rock</p>
                  </div>
                  <div class="choice" id="p">
                    <img class="images" src="images/paper.png" alt="">
                    <p class="atr" id="paper">Paper</p>
                  </div>
                  <div class="choice" id="s">
                    <img class="images" src="images/Scissors.png" alt="">
                    <p class="atr" id="scissors">Scissors</p>
                  </div>
                </div>

                <p id="action-message" class="text-muted display-4 font-weight-normal">Make Your Move.</p>

                <div class="computer">
                  <div class="images-comp">
                    <img class="images" src="images/tandatanya.png" alt="">
                  </div>
                  <p class="choice-comp text-muted display-4 font-weight-normal">Computer Choices.</p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
  <!-- <script type="text/javascript" src="script.js"></script> -->
  <script>
  let userScore = 0;
  let computerScore = 0;
  const userScore_span = document.getElementById('user-score');
  const computerScore_span = document.getElementById('computer-score');
  const scoreBoard_div = document.querySelector('.score-board');
  const result_p = document.querySelector('.result > p');
  const rock_div = document.getElementById('r');
  const paper_div = document.getElementById('p');
  const scissors_div = document.getElementById('s');
  const imgComputer = document.querySelector('.images-comp > img'); 

  function getComputerChoice() {
    const choices = ['r', 'p' , 's'];
    const randomNumber = Math.floor(Math.random() * 3);
    return choices[randomNumber];
  }

  function convertToWord(word) {
    if (word === 'r') return 'Rock';
    if (word === 'p') return 'Paper';
    return 'Scissors'
  }

  function win(userChoice, computerChoice) {
    const userChoice_div = document.getElementById(userChoice);
    userScore++;
    userScore_span.innerHTML = userScore;
    result_p.innerHTML =  `${convertToWord(userChoice)}. beats ${convertToWord(computerChoice)}. You Win ` ;
    userChoice_div.classList.add('green-glow'); 
    
    setTimeout(function() {
      userChoice_div.classList.remove('green-glow')
    }, 800);

    imgComputer.setAttribute('src','images/' + `${convertToWord(computerChoice)}` + '.png');
    setTimeout(function() {
      imgComputer.setAttribute('src','images/tandatanya.png')
    }, 900);

    return userScore;
  }

  function lose(userChoice, computerChoice) {
    const userChoice_div = document.getElementById(userChoice);
    computerScore++;
    computerScore_span.innerHTML = computerScore;
    result_p.innerHTML =  `${convertToWord(userChoice)}. beats ${convertToWord(computerChoice)}. You Lose ` ;
    userChoice_div.classList.add('red-glow');
    
    setTimeout(function() {
      userChoice_div.classList.remove('red-glow')
    }, 800);

    imgComputer.setAttribute('src','images/' + `${convertToWord(computerChoice)}` + '.png');
    setTimeout(function() {
      imgComputer.setAttribute('src','images/tandatanya.png')
    }, 900);

    return computerScore;
  }

  function draw(userChoice, computerChoice) {
    const userChoice_div = document.getElementById(userChoice);
    result_p.innerHTML =  `${convertToWord(userChoice)}. with ${convertToWord(computerChoice)}. Its Draw ` ;
    document.getElementById(userChoice).classList.add('gray-glow');
    
    setTimeout(function() {
      document.getElementById(userChoice).classList.remove('gray-glow')
    }, 800);

    imgComputer.setAttribute('src','images/' + `${convertToWord(computerChoice)}` + '.png');
    setTimeout(function() {
      imgComputer.setAttribute('src','images/tandatanya.png')
    }, 900);
  }

  function game(userChoice) {
    const computerChoice = getComputerChoice();
    switch (userChoice + computerChoice){
      case 'rs':
      case 'pr':
      case 'sp':
        resultUser = win(userChoice, computerChoice);
        break;
      case 'sr':
      case 'rp':
      case 'ps':
        resultComp = lose(userChoice, computerChoice);
        break;
      case 'rr':
      case 'pp':
      case 'ss':
        draw(userChoice, computerChoice);
        break;
    } 

    if (resultUser == 5) {
      alert("You Win!!")
      window.location.href = "index.php?compScore=" + resultComp;
    }  

    if (resultComp == 5) {
        alert("You Lose!!")
        window.location.href = "index.php?userScore=" + resultUser;
    }  
  }

  function main() {
    rock_div.addEventListener('click', function() {
      game('r');
    })
    paper_div.addEventListener('click', function() {
      game('p');
    })
    scissors_div.addEventListener('click', function() {
      game('s');
    })
  }

  main();

  </script>
</body>

</html>