

<?php 

 /*
 
 penulis: Muhammad yusuf
 website: http://www.kodingindonesia.com/
 
 */
	
	//Mendapatkan Nilai Dari Variable ID Pegawai yang ingin ditampilkan
	$id = $_GET['id'];
	
	//Importing database
	require_once('connectdbkopra.php');
	
	//Membuat SQL Query dengan pegawai yang ditentukan secara spesifik sesuai ID
	$sql = "SELECT Balance FROM `tb_wo_payment` WHERE IDUser = '$id' ORDER BY No DESC LIMIT 1";
	
	//Mendapatkan Hasil 
	$r = mysqli_query($con,$sql);
	
	//Memasukkan Hasil Kedalam Array
	$result = array();
	$row = mysqli_fetch_array($r);
	if(mysqli_num_rows($r)>0){
		array_push($result,array(
			"Balance"=>$row['Balance']
		));
	}else{
		array_push($result,array(
			"Balance"=>"0"
		));
	}

	//Menampilkan dalam format JSON
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);
?>