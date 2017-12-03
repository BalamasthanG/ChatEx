<?php
include($_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_functions.php');
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$submit = $_POST['submit'];
if(isset($submit)){
	$get_db = new DB_Functions();

	$result = $get_db->loginAuth($mobile,$password);
	if($result){
		$row = mysqli_fetch_array($result);
		if($row){
			session_start();
			$_SESSION['sessionId'] = $row['Name'];
			$_SESSION['mobile'] = $mobile;
			echo "success";
			header('location:FriendSearch.php');
		}else{
			echo "Wrong Mobile no and pass";
		}
	}else{
		echo "Fail";
	}
}
?>
<html>
<head>
</head>
<body>
	<form method="post" action="LogInPage.php" class="form" autocomplete="off">
		<label id="lbl_mobile">Mobile No</label>
		<input id="txt_mobile" type="text" name="mobile" required=""/>
		<label id="lbl_password">Password</label>
		<input id="txt_password" type="password" name="password" required=""/>
		<button id="btn_login" type="submit" name="submit">Login</button>
	</form>
</body>
</html>
