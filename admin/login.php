<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('include/dbconfig.php');

if (isset($_SESSION['user_session'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Esanwin Solutions (Pvt) Ltd - 0767078650">
    <meta name="author" content="T.K. Mohanatheesan">
    

    <link rel="manifest" href="assets/favicon/manifest.json">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="css/vendors/simplebar.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/examples.css" rel="stylesheet">
    
  </head>
  <body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card-group d-block d-md-flex row">
              <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                  <?php
                  if (isset($_POST['btnlogin'])) {
                      $useremail = mysqli_real_escape_string($connect, $_POST['useremail']);
                      $password = mysqli_real_escape_string($connect, $_POST['password']);

                      $sqlchk = "SELECT * FROM users WHERE useremail='$useremail' AND active='1'";
                      $exechk = mysqli_query($connect, $sqlchk);
                      if (mysqli_num_rows($exechk) >= 1) {
                          $rowchk = mysqli_fetch_array($exechk);
                          if (md5($password) == $rowchk['password']) {
                              $_SESSION['user_session'] = $rowchk['userID'];
                              $_SESSION['user_name'] = $rowchk['username'];
                              $_SESSION['user_email'] = $rowchk['useremail'];
                              $_SESSION['user_level'] = $rowchk['level'];
                              header("Location: index.php");

                              //var_dump($_SESSION);
                              //exit();
                          } else {
                              echo '<div class="alert alert-danger" role="alert">Invalid Password</div>';
                          }
                      } else {
                          echo '<div class="alert alert-danger" role="alert">There is no account with the email ID!</div>';
                      }
                  }
                  ?>
                </div>

                <div class="card-body">
                  <form action="" method="post">
                    <h1>Administrator</h1>
                    <p class="text-medium-emphasis">Sign In to your account</p>
                    <div class="input-group mb-3">
                      <span class="input-group-text">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                        </svg>
                      </span>
                      <input class="form-control" type="text" placeholder="Email" name="useremail" autofocus required>
                    </div>
                    <div class="input-group mb-4">
                      <span class="input-group-text">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                        </svg>
                      </span>
                      <input class="form-control" type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <button class="btn btn-primary px-4" type="submit" name="btnlogin">Login</button>
                      </div>
                      <div class="col-6 text-end" style="display: none;">
                        <button class="btn btn-link px-0" type="button">Forgot password?</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card col-md-5 text-white bg-primary py-5">
                <div class="card-body text-center">
                  <div>
                    <h4>AI Coursework 2</h4>
                    
                  </div>
                  <div>
                    <a href="../" class="form-control btn btn-dark">GO TO CHATBOT</a>
                    <hr>
                    <p style="text-align: justify;">This is FitBot, a chatbot for Health & Fitness related questions & Answeres.</p>
                    <hr>
                    <p>Developed by<br>E227421 TK Mohanatheesan<br>E221345 Jaeson HBS</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script> 
    <script src="vendors/simplebar/js/simplebar.min.js"></script> 
    <script src="vendors/@coreui/utils/js/coreui-utils.js"></script> 
    <script src="js/main.js"></script> 
    
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  </body>
</html>
