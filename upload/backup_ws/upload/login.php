<?php 
	
	//get Value
	$id = $_GET['id'];
	//$id = "end|abase.com";

	$uname = substr($id, 0, strpos($id, '|'));
	$passwd = substr($id, strpos($id,"|") +1);


	//Import File Koneksi Database
	require_once('dbkopralogin.php');

	if(mysqli_connect_error($con)){
		echo "Failed to Connect to Database".mysqli_connect_error();
	}

	$sql = "SELECT * FROM tb_users WHERE UName = '$uname'";

	$query = mysqli_query($con, $sql);
	$result = array();
    $last_row = mysqli_fetch_array($query);
	if (mysqli_num_rows($query)>0) {
		if(password_verify($passwd, $last_row['UPassword'])){
			if($last_row['SLogin'] == "Login"){
				$reset_id = $last_row['IDNumber'];
				array_push($result, array(
					"IDUser" => $reset_id,
					"Username" => "LoggedIn",
					"Password" => ""
				));
			}else{
				if($last_row['Ulevel'] == "Broker"){
					$uid = $last_row['IDNumber'];
					$update = "UPDATE tb_users SET SLogin = 'Login' WHERE IDNumber = '$uid'";
					if(mysqli_query($con, $update)){
						array_push($result,array(
							"IDUser"=>$last_row['IDNumber'],
							"Username"=>$last_row['UName'],
							"Password"=>$last_row['UPassword']
						));
					}else{
						array_push($result, array(
						"IDUser" => "",
						"Username" => "",
						"Password" => ""
					));
					}
				}else{
					array_push($result, array(
						"IDUser" => "",
						"Username" => "",
						"Password" => ""
					));
				}
			}
		}else{
			array_push($result, array(
				"IDUser" => "",
				"Username" => "",
				"Password" => ""
			));
		}
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