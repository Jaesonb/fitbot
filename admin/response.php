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
          <div class="alert alert-success" role="alert">The Response is <b>Updated</b> Successfully!</div>
          <?php
        }
        if(isset($_GET['state']) && $_GET['state']=="002"){
          ?>
          <div class="alert alert-success" role="alert">The Response is <b>Added</b> Successfully!</div>
          <?php
        }
        if(isset($_GET['state']) && $_GET['state']=="003"){
          ?>
          <div class="alert alert-warning" role="alert">The Response was <b>Already Added</b>!</div>
          <?php
        }
        ?>








        <?php
            ### Adding Response to the question
            if(isset($_POST['btnadd'])){
                $response = mysqli_real_escape_string($connect, $_POST['response']);
                $qid=mysqli_real_escape_string($connect, $_GET['qid']);
                $active = '1';

                $sqlchk="SELECT * from responses where response='$response' and active='1'";
                $exechk=mysqli_query($connect, $sqlchk);
                if(mysqli_num_rows($exechk)>=1){
                  $rowchk=mysqli_fetch_array($exechk);
                  $rid=$rowchk['rid'];
                  header("Location: response.php?edit=$rid&state=003");
                }else{
                  $sqladd = "INSERT INTO responses VALUES (null, '$response', '$active')";
                  $exeadd = mysqli_query($connect, $sqladd);

                  $sqlchk="SELECT * from responses where response='$response' and active='1'";
                  $exechk=mysqli_query($connect, $sqlchk);
                  $rowchk=mysqli_fetch_array($exechk);
                  $rid=$rowchk['rid'];

                  #Modify question rid
                  $sqlm="UPDATE questions SET rid='$rid' where qid='$qid' and active='1'";
                  $exem=mysqli_query($connect, $sqlm);


                  if ($exem) {
                      header("Location: response.php?state=001");
                  }

                }

            }


            ### Assign existing response to the question
            if(isset($_POST['btnassign'])){
              $qid=mysqli_real_escape_string($connect, $_POST['qid']);
              $rid=mysqli_real_escape_string($connect, $_POST['rid']);

              #Modify question rid
              $sqlm="UPDATE questions SET rid='$rid' where qid='$qid' and active='1'";
              $exem=mysqli_query($connect, $sqlm);
              if ($exem) {
                  header("Location: response.php?edit=$rid&state=001");
              }
            }
            
            
            
            ### Edit response
            if(isset($_POST['btnedit'])){
                $rid=mysqli_real_escape_string($connect, $_GET['edit']);
                $response = mysqli_real_escape_string($connect, $_POST['response']);
                

                $sqledit = "UPDATE responses SET response='$response' where rid='$rid'";
                $exeedit = mysqli_query($connect, $sqledit);

                if ($exeedit) {
                    header("Location: response.php?edit=$rid&state=001");
                }
            }

            
            ### Retrieve response to edit
            if(isset($_GET['edit']) && $_GET['edit']!=""){
              $rid=mysqli_real_escape_string($connect, $_GET['edit']);
              $sqlget="SELECT * FROM responses where rid='$rid' and active='1'";
              $exeget=mysqli_query($connect, $sqlget);
              $rowget=mysqli_fetch_array($exeget);
            }
            ?>






        <?php
        if(isset($_GET['add']) || isset($_GET['edit'])){
        ?>
          <div class="card">
            <div class="card-header">
              <h4>Responses:

                <?php
                if(isset($_GET['qid']) && $_GET['qid']!=""){
                  $qid=mysqli_real_escape_string($connect, $_GET['qid']);
                  $sqlget="SELECT * FROM questions where qid='$qid' and active='1'";
                  $exeget=mysqli_query($connect, $sqlget);
                  $rowget=mysqli_fetch_array($exeget);
                  ?>
                <span class="text-primary"><?php echo $rowget['question']; ?></span>
                  <?php
                }
                  
                if(isset($_GET['edit']) && $_GET['edit']!=""){
                  $rid=mysqli_real_escape_string($connect, $_GET['edit']);
                  $sqlq="SELECT * FROM questions where rid='$rid' and active='1'";
                  $exeq=mysqli_query($connect, $sqlq);
                  $rowq=mysqli_fetch_array($exeq);
                  ?>
                  <span class="text-primary"><?php echo $rowq['question']; ?></span>
                  <?php
                }
                ?>
              </h4>
            </div>

            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-10">
                    <input type="text" required name="response" autofocus class="form-control mb-3" placeholder="Type Response" value="<?php if(isset($_POST['response'])){ echo $_POST['response']; }elseif(isset($_GET['edit'])){ echo $rowget['response']; } ?>">
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
          </div>
          <?php
        }
        ?>





        <div class="card" style="margin-top: 10px;">
          <div class="card-header">
            <h4>List of Responses</h4>
          </div>
          <div class="card-body">
            <table class="table table-striped" id="tblresponses">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Response</th>
                  <th>Assigned Questions</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sqllist="SELECT * FROM responses where active='1'";
                $exelist=mysqli_query($connect, $sqllist);
                while($rowlist=mysqli_fetch_array($exelist)){
                  ?>
                  <tr>
                    <td><?php echo $rowlist['rid']; ?></td>
                    <td>
                      <?php echo $rowlist['response']; ?>
                      <?php
                      if(isset($_GET['qid']) && $_GET['qid']!=""){
                        ?>
                        <form action="" method="post">
                          <input type="hidden" name="qid" value="<?php echo $_GET['qid']; ?>">
                          <input type="hidden" name="rid" value="<?php echo $rowlist['rid']; ?>">
                          <input type="submit" onclick="return confirm('Are you sure?')" name="btnassign" class="btn btn-sm btn-primary" value="Assign">
                        </form>
                        <?php
                      }
                      ?>    
                    </td>
                    <td>
                      <?php 
                        $sqlquestions="SELECT * FROM questions where rid='$rowlist[rid]' and active='1'";
                        $exequestions=mysqli_query($connect, $sqlquestions);
                        while($rowquestions=mysqli_fetch_array($exequestions)){
                          ?>
                          <ul style="margin: 0px;">
                            <li><?php echo $rowquestions['question']; ?></li>
                          </ul>
                          <?php
                        }
                      ?>  
                    </td>
                    <td><a href="response.php?edit=<?php echo $rowlist['rid']; ?>" class="btn btn-sm btn-warning">Edit</a></td>
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
    new DataTable("#tblresponses");
  </script>
</body>
</html>
<?php ob_end_flush(); ?>