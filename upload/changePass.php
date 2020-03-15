<?php 
	
	//get Value
	$id = $_GET['id'];
	#$id = "Light|abase.com";

	$idn = substr($id, 0, strpos($id, '|'));
	$newPass = substr($id, strpos($id,"|") +1);


	//Import File Koneksi Database
	require_once('dbkopralogin.php');

	if(mysqli_connect_error($con)){
		echo "Failed to Connect to Database".mysqli_connect_error();
	}

	$hash = password_hash($newPass, PASSWORD_BCRYPT);

	$sql = "UPDATE tb_users SET UPassword = '$hash' WHERE IDNumber = '$idn'";

	if (mysqli_query($con, $sql)) {
		echo "Password Successfully Changed";
	}else {
		echo "Password Fail to Changed, Connection Problem!";
	}

	mysqli_close($con);

 ?>