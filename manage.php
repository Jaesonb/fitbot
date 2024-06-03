<?php
	include "admin/include/dbconfig.php";

	if(isset($_POST['message']) && $_POST['message']!=""){
		
		$message=mysqli_real_escape_string($connect, $_POST['message']);
		
		$sqlchk="SELECT rid from questions where question like '%$message%' and active='1'";
		$exechk=mysqli_query($connect, $sqlchk);
		if(mysqli_num_rows($exechk)>=1){
			$rowchk=mysqli_fetch_array($exechk);
			$rid=$rowchk['rid'];

			if($rid!=0){
				$sqlget="SELECT response FROM responses where rid='$rid' and active='1'";
				$exeget=mysqli_query($connect, $sqlget);
				$rowget=mysqli_fetch_array($exeget);
				?>
				<div class="message bot"><?php echo $rowget['response']; ?></div>
				<?php
			}else{
				echo "Sorry, I don't get it. Please ask again!";
			}
		}else{
			$sqlua="SELECT * from unanswered where question ='$message' and active='1'";
			$exeua=mysqli_query($connect, $sqlua);
			if(mysqli_num_rows($exeua)<1){
				$sqladd="INSERT INTO unanswered VALUES(null, '$message', 1, 1)";
				$exeadd=mysqli_query($connect, $sqladd);
			}

			echo "Sorry, I don't get it. Please ask again!";
		}
	}
?>