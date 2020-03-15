<?php
 
	//Import File Koneksi Database
	require_once('connectdbkopra.php');

	$last_ticket = "SELECT TicketNumber FROM tb_purchase_worker ORDER BY No DESC LIMIT 1";

    $cur_date = date('ymd');
    if($last_result = mysqli_query($con, $last_ticket)){
    	$last_row = mysqli_fetch_array($last_result);
        $last_date = get_string_beetween($last_row['TicketNumber'], '-', '-');
        $proc_seq = substr($last_row['TicketNumber'], strpos($last_row['TicketNumber'],"-") +1);
        $seq = substr($proc_seq, strpos($proc_seq,"-") +1);
        if($last_date == $cur_date){
            $seq_num = $seq+1;
            $TicketNumber = "WNS-".$cur_date."-".str_pad($seq_num, 5, '0', STR_PAD_LEFT);
        }else{
            $TicketNumber = "WNS-".$cur_date."-00001";
        }
    }else{
        $TicketNumber = "WNS-".$cur_date."-00001";
    }
	
	//Membuat SQL Query
	//$sql = "SELECT * FROM tb_purchase_worker ORDER BY No DESC LIMIT 1";
	
	//Mendapatkan Hasil
	//$r = mysqli_query($con,$sql);
	
	//Membuat Array Kosong 
	$result = array();
	array_push($result,array(
		"TicketNumber"=>$TicketNumber
	));

	//while($row = mysqli_fetch_array($r)){
		
		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
		//array_push($result,array(
			//"TicketNumber"=>$row['TicketNumber']
		//));
	//}
	
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('result'=>$result));
	
	mysqli_close($con);

	function get_string_beetween($string, $start, $end){
        $string = ' '. $string;
        $ini = strpos($string, $start);
        if($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) -$ini;
        return substr($string, $ini, $len);
    } 
    
    function random_word($id){
        $pool = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        $word = '';
        for ($i = 0; $i < $id; $i++){
            $word .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
        }
        return $word; 
    }
?>