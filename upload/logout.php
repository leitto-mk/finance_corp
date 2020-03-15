<?php

	//if($_SERVER['REQUEST_METHOD']=='POST'){
		//Mendapatkan Nilai Variable
		$id = $_POST['IDUser'];
		//$id = "EKS001";

		//Import File Koneksi database
		require_once('dbkopralogin.php');

		//Pembuatan Syntax SQL
		$sql = "UPDATE tb_users SET SLogin = 'Logout' WHERE IDNumber = '$id'";
		
		//Eksekusi Query database
		if(mysqli_query($con,$sql)){
			echo "Logout";
		}else{
			echo "Please Check Your Internet Connection !";
		}
		
		mysqli_close($con);
	//}
?>