<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		//Import File Koneksi database
		require_once('connectdbkopra.php');

		//Mendapatkan Nilai Variable
		//$TicketNumber2 = $_POST['TicketNumber'];
		$ProductName = $_POST['ProductName'];
		$KontrakNo = $_POST['ContractNo'];
		$Batas = $_POST['batas'];
		$IDUser = $_POST['IDUser'];
		$VehicleNumber = $_POST['VehicleNumber'];
		$PurchaseUnit = $_POST['PurchaseUnit'];
		$Weight = $_POST['Weight'];
		$Dust = $_POST['Dust'];
		$WaterContent = $_POST['WaterContent'];
		$Price = $_POST['Price'];
		$DateTime = $_POST['DateTime'];
		$Remarks = $_POST['Remarks'];
		$Total2 = $_POST['Total'];
		$Total = $Weight*$Price;
		$Quantity = $_POST['Quantity'];
		$Owner = $_POST['Owner'];
		//$PhotoPath = $_POST['PhotoPath'];

		$fWeight = floatval($Weight);
		$fDust = floatval($Dust);
		$fbatas = floatval($Batas);
		$fWaterContent = floatval($WaterContent);
		$iPrice = intval($Price);
		$iTotal = intval($Total);
		$DateTimeformated = date('Y-m-d',strtotime($DateTime));
		$sum = $iPrice * $fWeight;

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

		//Get Last Balance
		$lb_query = "SELECT * FROM `tb_wo_payment` WHERE IDUser = '$IDUser' ORDER BY No DESC LIMIT 1";
		$lb_result = mysqli_query($con, $lb_query);
		$lb_getRow = mysqli_fetch_array($lb_result);

		$last_balance = $lb_getRow['Balance'] - $sum;

		//Insert Payment
		$wo_query = "INSERT INTO tb_wo_payment (IDUser, Balance, Status) VALUES ('$IDUser', '$last_balance', 'Payment')";

		//Pembuatan Syntax SQL
		$sql = "INSERT INTO tb_purchase_worker (TicketNumber,ProductName,ContractNo,IDUser,VehicleNumber,PurchaseUnit,Quantity,Weight,Dust,WaterContent,Price,TotalPrice,PurchaseDate,GoodsOwner,Remarks) VALUES ('$TicketNumber','$ProductName','$KontrakNo','$IDUser','$VehicleNumber','$PurchaseUnit','$Quantity','$fWeight','$fDust','$fWaterContent','$iPrice','$iTotal','$DateTimeformated', '$Owner', '$Remarks')";

		//Eksekusi Query database
		if(mysqli_query($con,$sql)){
			if(mysqli_query($con,$wo_query)){
				if($ProductName == "Kopra" && $fWeight >= $fbatas){
					$update = "UPDATE `tbl_broker_contract` SET Achieved = 'Yes' WHERE ContractNo = '$KontrakNo'";
					mysqli_query($con, $update);
					$query_last_deps = "SELECT * FROM tbl_deposit_broker WHERE ID = '$IDUser' ORDER BY No DESC LIMIT 1";
					$val_last_input = $fWeight - $fbatas;
					if($result_last_deps = mysqli_query($con, $query_last_deps)){
						$row_last_deps = mysqli_fetch_array($result_last_deps);
						$insert_val = $row_last_deps['Amaount'] + $val_last_input;
					}else{
						$insert_val = $val_last_input;
					}
					$query_insert_deps = "INSERT INTO tbl_deposit_broker (ID, Amount) VALUES ('$IDUser', 'insert_val')";
					mysqli_query($con, $query_insert_deps);
				}
				echo "Success";
			}else{
				echo "Failed to Submit";
			}
		}else{
			echo 'Failed to Submit Payment';
		}
		mysqli_close($con);
	}


    function get_string_beetween($string, $start, $end){
        $string = ' '. $string;
        $ini = strpos($string, $start);
        if($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) -$ini;
        return substr($string, $ini, $len);
    }
?>