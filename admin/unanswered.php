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

  <script>
      tinymce.init({
        selector: '#longdes'
      });
    </script>
</head>
<body>

  <?php include "include/sidebar.php"; ?>

  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <?php include "include/header.php"; ?>

    <div class="body flex-grow-1 px-3">
      <div class="container-lg">


        <?php
        if(isset($_GET['state']) && $_GET['state']=="001"){
          ?>
          <div class="alert alert-success" role="alert">The Question is <b>Updated</b> Successfully!</div>
          <?php
        }
        if(isset($_GET['state']) && $_GET['state']=="002"){
          ?>
          <div class="alert alert-success" role="alert">The Question is <b>Added</b> Successfully!</div>
          <?php
        }
        if(isset($_GET['state']) && $_GET['state']=="003"){
          ?>
          <div class="alert alert-warning" role="alert">The Question was <b>Already Added</b>!</div>
          <?php
        }
        ?>


        

        <div class="card" style="margin-top: 10px;">
          <div class="card-header">
            <h3>List of Unanswered Questions</h3>
          </div>
          <div class="card-body">
            <table class="table table-striped" id="tblquestions">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Question</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sqllist="SELECT * FROM unanswered where active='1'";
                $exelist=mysqli_query($connect, $sqllist);
                while($rowlist=mysqli_fetch_array($exelist)){
                  ?>
                  <tr>
                    <td><?php echo $rowlist['uaid']; ?></td>
                    <td><?php echo $rowlist['question']; ?></td>
                    <td><a href="question.php?add=<?php echo $rowlist['uaid']; ?>" class="btn btn-sm btn-info">Take</a></td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>


    
    <?php include "include/footer.php"; ?>
  </div>

  <?php include "include/bottom.php"; ?>

  <script>
    new DataTable("#tblquestions", { order:[[0,'desc']] });

  </script>
</body>
</html>
<?php ob_end_flush(); ?>