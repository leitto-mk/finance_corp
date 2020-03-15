<?php

	$id = $_GET['id'];
	//$id = "90";
 
	//Import File Koneksi Database
	require_once('connectdbkopra.php');
	
	//Membuat SQL Query
	$sql = "SELECT TicketNumber, ProductName, IDUser, VehicleNumber, PurchaseUnit, Weight, Dust, WaterContent, (Price*Weight) AS Price, GoodsOwner, DATE_FORMAT(PurchaseDate, '%d %b %Y') AS DateTime, Remarks FROM tb_purchase_worker WHERE IDUser = '$id' ORDER BY No DESC";
	
	//Mendapatkan Hasil
	$r = mysqli_query($con,$sql);
	
	//Membuat Array Kosong 
	$result = array();
	
	while($row = mysqli_fetch_array($r)){
		
		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
		array_push($result,array(
			"TicketNumber"=>$row['TicketNumber'],
			"ProductName"=>$row['ProductName'],
			"IDUser"=>$row['IDUser'],
			"VehicleNumber"=>$row['VehicleNumber'],
			"PurchaseUnit"=>$row['PurchaseUnit'],
			"Weight"=>$row['Weight'],
			"Dust"=>$row['Dust'],
			"WaterContent"=>$row['WaterContent'],
			"Price"=>$row['Price'],
			"DateTime"=>$row['DateTime'],
			"Owner"=>$row['GoodsOwner'],
			"Remarks"=>$row['Remarks']
		));
	}
	
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
?>