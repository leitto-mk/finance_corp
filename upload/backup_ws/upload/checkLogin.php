<?php 
	
	//get Value
	$id = $_GET['id'];
	#$id = "Nayan";

	//Import File Koneksi Database
	require_once('dbkopralogin.php');

	if(mysqli_connect_error($con)){
		echo "Failed to Connect to Database".mysqli_connect_error();
	}

	$sql = "SELECT * FROM `tb_users` WHERE IDNumber = '$id' AND SLogin = 'Login'";

	$query = mysqli_query($con, $sql);
	$result = array();
    $last_row = mysqli_fetch_array($query);
	if (mysqli_num_rows($query)>0) {
		array_push($result,array(
			"IDUser"=>$last_row['IDNumber'],
			"Username"=>$last_row['UName'],
			"Password"=>$last_row['UPassword']
		));
	}else {
		array_push($result, array(
			"IDUser" => "",
			"Username" => "",
			"Password" => ""
		));
	}
	echo json_encode(array('result'=>$result));

	mysqli_close($con);

 ?>