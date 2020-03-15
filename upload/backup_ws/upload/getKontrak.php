<?php

    //get Value
	$id = $_GET['id'];
	//$id = "90";
	//echo $id;
 
	//Import File Koneksi Database
	require_once('connectdbkopra.php');

	if(mysqli_connect_error($con)){
		echo "Failed to Connect to Database".mysqli_connect_error();
	}

	$sql = "SELECT ContractNo, Booked FROM tbl_broker_contract WHERE BrokerID = '$id' AND Achieved = 'No' LIMIT 1";

	$query = mysqli_query($con, $sql);
	//echo $query;
	$result = array();
	if (mysqli_num_rows($query)>0) {
		while($row = mysqli_fetch_array($query)){
			array_push($result,array(
				"ContractNo"=>$row['ContractNo'],
				"Booked"=>$row['Booked']
			));
		}	
	}else {
		array_push($result, array(
			"ContractNo" => "",
			"Booked" => ""
		));
	}
	echo json_encode(array('result'=>$result));

	mysqli_close($con);
?>