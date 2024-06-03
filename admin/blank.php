<?php
ob_start();
include "include/functions.php";
?>
<!DOCTYPE html>
<!-- Admin Template by Theesan - tkmtheesan1996@gmail.com - +94(76)7078 650 -->
<html lang="en">
<head>
  <?php include "include/head.php"; ?>
  <title>FitBot - Admin </title>
</head>
<body>

  <?php include "include/sidebar.php"; ?>

  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <?php include "include/header.php"; ?>

    <div class="body flex-grow-1 px-3">
      <div class="container-lg">



      </div>
    </div>


    
    <?php include "include/footer.php"; ?>
  </div>

  <?php include "include/bottom.php"; ?>
</body>
</html>
<?php ob_end_flush(); ?>