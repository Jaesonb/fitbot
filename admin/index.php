<?php
ob_start();
include "include/functions.php";

?>
<!DOCTYPE html>
<!-- Admin Template by Theesan - tkmtheesan1996@gmail.com - +94(76)7078 650 -->
<html lang="en">
<head>
  <?php include "include/head.php"; ?>
  <title></title>
</head>
<body>
  
  <?php include "include/sidebar.php"; ?>

  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <?php include "include/header.php"; ?>

    <div class="body flex-grow-1 px-3">
      <div class="container-lg">

        <div class="row">

          <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
              <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                  <div class="fs-4 fw-semibold">
                    <?php
                    $sq="SELECT distinct(question) from questions where active='1'";
                    $ex=mysqli_query($connect, $sq);
                    echo mysqli_num_rows($ex);
                    ?>
                  </div>
                  <div>
                    Questions
                  </div>
                </div>
              </div>
            </div>
          </div><!-- /.col-->

          <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-info">
              <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                  <div class="fs-4 fw-semibold">
                    <?php
                    $sq="SELECT distinct(response) from responses where active='1'";
                    $ex=mysqli_query($connect, $sq);
                    echo mysqli_num_rows($ex);
                    ?>
                  </div>
                  <div>
                    Answers
                  </div>
                </div>
              </div>
            </div>
          </div><!-- /.col-->

          <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning">
              <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                  <div class="fs-4 fw-semibold">
                    <?php
                    $sq="SELECT distinct(question) from unanswered where active='1'";
                    $ex=mysqli_query($connect, $sq);
                    echo mysqli_num_rows($ex);
                    ?>
                  </div>
                  <div>
                    Unanswered
                  </div>
                </div>
              </div>
            </div>
          </div><!-- /.col-->
          
          <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-secondary">
              <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                  <div class="fs-4 fw-semibold">
                    <?php
                    $sq="SELECT userID from users where active='1'";
                    $ex=mysqli_query($connect, $sq);
                    echo mysqli_num_rows($ex);
                    ?>
                  </div>
                  <div>
                    Users
                  </div>
                </div>
              </div>
            </div>
          </div><!-- /.col-->

          
          
          
        </div><!-- /.row-->

       
        

      </div>
    </div>
    <?php include "include/footer.php"; ?>
  </div>

  <?php include "include/bottom.php"; ?>
</body>
</html>
<?php ob_end_flush(); ?>