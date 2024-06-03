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
          <div class="alert alert-info" role="alert">The Question was <b>Already Added</b>!</div>
          <?php
        }
        if(isset($_GET['state']) && $_GET['state']=="004"){
          ?>
          <div class="alert alert-danger" role="alert">The Question was <b>Deleted</b> Successfully!</div>
          <?php
        }
        ?>






        <?php
            ### Insert Question
            if(isset($_POST['btnadd'])){
                $question = mysqli_real_escape_string($connect, $_POST['question']);
                $rid = '0';
                $active = '1';

                ## Check question
                $sqlchk="SELECT * from questions where question='$question' and active='1'";
                $exechk=mysqli_query($connect, $sqlchk);
                if(mysqli_num_rows($exechk)>=1){
                  ## If question exists
                  $rowchk=mysqli_fetch_array($exechk);
                  $qid=$rowchk['qid'];
                  header("Location: question.php?edit=$qid&state=003");
                }else{
                  ## If question is new
                  $sqladd = "INSERT INTO questions VALUES (null, '$question', '$rid', '$active')";
                  $exeadd = mysqli_query($connect, $sqladd);

                  if ($exeadd) {
                      if($_GET['add']!=""){
                        ## If it was unanswered question
                        $uaid=mysqli_real_escape_string($connect, $_GET['add']);
                        $sqlua0="UPDATE unanswered SET active='0' where uaid='$uaid'";
                        $exeua0=mysqli_query($connect, $sqlua0);
                      }
                      header("Location: question.php?state=001&add");
                  }

                }

            }
            
            
            
            ### Edit Question
            if(isset($_POST['btnedit'])){
                $qid=mysqli_real_escape_string($connect, $_GET['edit']);
                $question = mysqli_real_escape_string($connect, $_POST['question']);
                

                $sqledit = "UPDATE questions SET question='$question' where qid='$qid'";
                $exeedit = mysqli_query($connect, $sqledit);

                if ($exeedit) {
                    header("Location: question.php?edit=$qid&state=001");
                }
            }


            
            ### Retrieve Question to Edit
            if(isset($_GET['edit']) && $_GET['edit']!=""){
              $qid=mysqli_real_escape_string($connect, $_GET['edit']);
              $sqlget="SELECT * FROM questions where qid='$qid' and active='1'";
              $exeget=mysqli_query($connect, $sqlget);
              $rowget=mysqli_fetch_array($exeget);
            }
            


            ### Retrieve Question to Add from Unanswered
            if(isset($_GET['add']) && $_GET['add']!=""){
              $uaid=mysqli_real_escape_string($connect, $_GET['add']);
              $sqlua="SELECT question from unanswered where active='1' and uaid='$uaid'";
              $exeua=mysqli_query($connect, $sqlua);
              $rowua=mysqli_fetch_array($exeua);

              $uaquestion=$rowua['question'];
            }


            ### Delete Question
            if(isset($_GET['delete']) && $_GET['delete']!=""){
              $qid=mysqli_real_escape_string($connect, $_GET['delete']);
              $sqldel="UPDATE questions SET active='0' where qid='$qid'";
              $exedel=mysqli_query($connect, $sqldel);
              if($exedel){
                header("Location: question.php?state=004");
              }
            }
            ?>





        <div class="card">
          <div class="card-header">
            <h3>Questions
              <?php
              if(!isset($_GET['add']) || isset($_GET['edit'])){
                ?>
                <span style="float: right;"><a href="question.php?add" class="btn btn-primary">+ NEW</a></span>
                <?php
              }
              ?>
            </h3>
          </div>

          

            
          <?php
            if(isset($_GET['add']) || isset($_GET['edit'])){
            ?>
            <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-10">
                  <input type="text" required name="question" autofocus class="form-control mb-3" placeholder="Type Question" value="<?php if(isset($_POST['question'])){ echo $_POST['question']; }elseif(isset($_GET['edit'])){ echo $rowget['question']; }elseif($_GET['add']!=""){ echo $uaquestion; } ?>">
                </div>

                <div class="col-md-2">
                  <?php
                  if(isset($_GET['edit'])){
                    ?>
                    <input type="submit" name="btnedit" value="UPDATE" class="form-control btn btn-success ">
                    <?php
                  }else{
                    ?>
                    <input type="submit" name="btnadd" value="ADD" class="form-control btn btn-primary ">
                    <?php
                  }
                  ?>
                </div>
                  
              </div>
            </form>

          </div>

          <?php
          }
          ?>

        </div>

        <div class="card" style="margin-top: 10px;">
          <div class="card-header">
            <h3>List of Questions</h3>
          </div>
          <div class="card-body">
            <table class="table table-striped" id="tblquestions">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Question</th>
                  <th>#</th>
                  <th>#</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sqllist="SELECT * FROM questions where active='1'";
                $exelist=mysqli_query($connect, $sqllist);
                while($rowlist=mysqli_fetch_array($exelist)){
                  ?>
                  <tr>
                    <td><?php echo $rowlist['qid']; ?></td>
                    <td><?php echo $rowlist['question']; ?></td>
                    <td><a href="question.php?edit=<?php echo $rowlist['qid']; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                    <td><a href="question.php?delete=<?php echo $rowlist['qid']; ?>" class="btn btn-sm btn-danger text-white" onclick="return confirm('Do you really want to delete the question?')">Delete</a></td>
                    <td>
                      <?php
                      if($rowlist['rid']!=0){
                        ?>
                        <span class="badge bg-success">Assigned</span>
                        <?php
                      }else{
                        ?>
                        <a href="response.php?qid=<?php echo $rowlist['qid']; ?>&add" class="btn btn-sm btn-primary">Assign Response</a>
                        <?php
                      }
                      ?>
                    </td>
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
    new DataTable("#tblquestions", { order:[[0, 'desc']] });
  </script>
</body>
</html>
<?php ob_end_flush(); ?>