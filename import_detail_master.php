<?php

require_once 'functions/koneksi.php';
require 'vendor/autoload.php';
include_once 'functions/helper.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['excel_detail_master']))

{
    $fileName = $_FILES['import_detail_master']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

	if(in_array($file_ext, $allowed_ext)){

		$inputFileNamePath = $_FILES['import_detail_master']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
		$data = $spreadsheet->getActiveSheet()->toArray();

		$count = "0";
		session_start();
		foreach ($data as $row){

			if($count > 0){

				$sku                = $row['0'];
				$packing_metode     = $row['1'];
				$carton_code        = $row['2'];
				$size               = $row['3'];
				$meas               = $row['4'];
				$meas_carton        = $row['5'];
				$nw                 = $row['6'];
				$gw                 = $row['7'];
				$material_code1     = $row['8'];
				$material_code2     = $row['9'];
				$cbm                = $row['10'];

				$cek = mysqli_query($conn, "SELECT * FROM tb_detail_master WHERE sku ='$sku' AND carton_code='$carton_code' AND size='$size' AND meas='$meas'");
				if(mysqli_num_rows($cek) !== 0){
					$_SESSION['message'] = $failed;
					header("location: detail_master.php?sku=$sku");
				}else{
					$nw1 = $nw / $packing_metode;
					$gw1 = $gw / $packing_metode;
					$detailQuery = "INSERT INTO tb_detail_master (packing_metode, carton_code, size, meas, meas_carton, nw, gw, material_code1, material_code2, nw1, gw1, cbm, sku) 
            	    				VALUES ('$packing_metode','$carton_code','$size','$meas','$meas_carton','$nw','$gw','$material_code1','$material_code2','$nw1','$gw1','$cbm','$sku')";
					$result = mysqli_query($conn, $detailQuery);
					
				}
				
	    	}else{
				$count = "1";
			}
			$_SESSION['message'] = $upload;
			header("location: detail_master.php?sku=$sku");
			

		}

	}else{
		session_start();
		$_SESSION['message'] = $upload;
		header("location: detail_master.php?sku=$idMaster");
	}
	# code...
}
?>