<?php
include($_SERVER['DOCUMENT_ROOT'].'/ChatEx/dbconfig/db_functions.php');
//get all values submitted from form
$name = $_POST['name'];
$email = $_POST['e_mail'];
$mobile = $_POST['mobile_number'];
$password = $_POST['password'];
$retype_password = $_POST['retype_password'];
$submit = $_POST['submit'];

//when clicking the submit button
if(isset($submit)){

	//retype password doesnot match
	if($password != $retype_password){
		$password_mismatch = "Password Missmatch!!!";
	}else{
			//send object to save in db
			$user_object = (object)[];
			$user_object->name = $name;
			$user_object->email= $email;
			$user_object->password = $password;
			$user_object->mobile = $mobile;

			$get_db = new DB_Functions();

			$result = $get_db->registerUser($user_object);

			if($result){
				echo "Success";
			}else{
				echo "Fail";
			}

			
	}
}

?>
<html>
<head>
<link rel="stylesheet" href="/ChatEx/css/register_page.css" />
</head>
<body>
	<div id="div_form">
	<form method="post" action="RegisterPage.php" class="form" autocomplete="off"> 
		<label id="lbl_name">Name</label>
		<input name="name" id="txt_name" type="textbox" required=""/>
		<label id="lbl_check_avail">Check Availablilty</label>
		<label id ="lbl_e_mail">E-mail</label>
		<input type="e-mail" id="txt_e_mail" name="e_mail" required="" bfval="-1"/>
		<label id="lbl_mobile">Mobile</label>
		<input id="txt_mobile" type="textbox" name="mobile_number" required=""/>
		<label id="lbl_password">Password</label>
		<input id="txt_password" type="password" name="password" required=""/>
		<label id="lbl_retype_password">Re-Type Password</label>
		<input id="txt_retype_password"type="password" name="retype_password" required=""/><?php echo $password_mismatch; ?>
		<button type="submit" name="submit" id="btn_submit"  >Save</button>
	</form>
	</div>
</body>