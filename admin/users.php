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

        <div class="card">
          <div class="card-header">
            <h3>User Management</h3>
          </div>
          <div class="card-body">
            <?php
                if(isset($_POST['btnregister'])){
                  $username=mysqli_real_escape_string($connect, $_POST['username']);
                  $useremail=mysqli_real_escape_string($connect, $_POST['useremail']);
                  $password1=mysqli_real_escape_string($connect, $_POST['password1']);
                  $password2=mysqli_real_escape_string($connect, $_POST['password2']);

                  if($password1==$password2){
                    $sqlchk="SELECT * from users where useremail='$useremail' and active='1'";
                    $exechk=mysqli_query($connect, $sqlchk);
                    if(mysqli_num_rows($exechk)>=1){
                      ?>
                      <div class="alert alert-danger" role="alert">The User Email ID exist! Please try a different email ID</div>
                      <?php
                    }else{
                      $password=md5($password1);
                      $code=time();
                      $active='1';

                      echo $sqlinsert="INSERT INTO users values (null, '$username', '$useremail', '$password', '$code', '$active')";
                      $exeinsert=mysqli_query($connect, $sqlinsert);
                      if($exeinsert){
                        header("Location: users.php?success");
                      }else{
                        echo mysqli_error($connect);
                      }
                    }
                  }else{
                    ?>
                    <div class="alert alert-danger" role="alert">Passwords did not match!</div>
                    <?php
                  }
                }


                if(isset($_POST['btnedit'])){
                  $userID=mysqli_real_escape_string($connect, $_GET['edit']);
                  $username=mysqli_real_escape_string($connect, $_POST['username']);
                  $useremail=mysqli_real_escape_string($connect, $_POST['useremail']);
                  $password1=mysqli_real_escape_string($connect, $_POST['password1']);
                  $password2=mysqli_real_escape_string($connect, $_POST['password2']);

                  if($password1==$password2){
                    
                      $password=md5($password1);
                      $code=time();
                      $active='1';

                      $sqlupdate="UPDATE users SET username='$username', useremail='$useremail', password='$password' where userID='$userID'";
                      $exeupdate=mysqli_query($connect, $sqlupdate);
                      if($exeupdate){
                        header("Location: users.php?success2");
                      }else{
                        echo mysqli_error($connect);
                      }
                    
                  }else{
                    ?>
                    <div class="alert alert-danger" role="alert">Passwords did not match!</div>
                    <?php
                  }
                }

                if(isset($_GET['success'])){
                  ?>
                  <div class="alert alert-success" role="alert">The User was Added Successfully!</div>
                  <?php
                }
                if(isset($_GET['success2'])){
                  ?>
                  <div class="alert alert-success" role="alert">The User was Updated Successfully!</div>
                  <?php
                }

                if(isset($_GET['edit'])){
                  if($_GET['edit']!=""){
                    $userID=mysqli_real_escape_string($connect, $_GET['edit']);

                    $sqlget="SELECT * from users where userID='$userID' and active='1'";
                    $exeget=mysqli_query($connect, $sqlget);
                    $rowget=mysqli_fetch_array($exeget);
                  }else{
                    header("Location: users.php");
                  }
                }
                ?>

            <form action="" method="post">
              <div class="row">
                
                <div class="col-md-4">
                  <input type="text" required class="form-control mb-3" id="username" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; }elseif(isset($_GET['edit'])){ echo $rowget['username']; } ?>">
                  
                  <input type="email" required class="form-control mb-3" id="useremail" name="useremail" placeholder="Email" value="<?php if(isset($_POST['useremail'])){ echo $_POST['useremail']; }elseif(isset($_GET['edit'])){ echo $rowget['useremail']; } ?>" <?php if(isset($_GET['edit'])){ echo "readonly"; } ?>>
                </div>
                <div class="col-md-4">
                  <input type="password" required class="form-control mb-3" id="password1" name="password1" placeholder="Password">
                
                  <input type="password" required class="form-control mb-3" id="password2" name="password2" placeholder="Retype Password">
                </div>

                <div class="col-md-4">
                  <select required class="form-control mb-3" id="level" name="level" style="display:none;">
                    
                    <option value="1" <?php if(isset($_POST['level']) && $_POST['level']=='1'){ echo "selected"; }elseif(isset($_GET['edit']) && $rowget['level']=='1'){ echo "selected"; } ?> >Admin</option>
                  </select>

                  <?php
                  if(isset($_GET['edit'])){
                    ?>
                    <button class="form-control mb-3 btn btn-success" name="btnedit">Edit User</button>
                    <?php
                  }else{
                    ?>
                    <button class="form-control mb-3 btn btn-primary" name="btnregister">Add User</button>
                    <?php
                  }
                  ?>
                </div>
                
              </div>
            </form>


          </div>
        </div>

        <!-- ======================== -->

        <div class="card mt-3">
          <div class="card-body">
            <table class="table table-striped" id="tblusers">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sqllist="SELECT * from users where active='1'";
                $exelist=mysqli_query($connect, $sqllist);
                while($rowlist=mysqli_fetch_array($exelist)){
                  ?>
                  <tr>
                    <td><?php echo $rowlist['userID']; ?></td>
                    <td><?php echo $rowlist['username']; ?></td>
                    <td><?php echo $rowlist['useremail']; ?></td>
                    
                    <td>
                      <a href="users.php?edit=<?php echo $rowlist['userID']; ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure to edit?')">Edit</a>
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
    
new DataTable('#tblusers');

  </script>
</body>
</html>
<?php ob_end_flush(); ?>