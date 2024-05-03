<?php

require_once 'functions/koneksi.php';
require 'vendor/autoload.php';
include_once 'functions/helper.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['update_master']))

{
    $fileName = $_FILES['update_master']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

	if(in_array($file_ext, $allowed_ext))
	{
		$inputFileNamePath = $_FILES['update_master']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
		$data = $spreadsheet->getActiveSheet()->toArray();

		$count = "0";
		foreach ($data as $row) 
		{
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

				$cek = "SELECT * FROM tb_detail_master WHERE sku='$sku' AND packing_metode='$packing_metode' AND size='$size'";
				$sql = mysqli_query($conn, $cek);
				$arrCek = Mysqli_fetch_array($sql, MYSQLI_ASSOC);
				$idDetail = $arrCek['id_detail'];

				$nw1 = $nw / $packing_metode;
				$gw1 = $gw / $packing_metode;
				$updateQuery = "UPDATE tb_detail_master SET carton_code='$carton_code', meas='$meas', meas_carton='$meas_carton', nw='$nw', gw='$gw', material_code1='$material_code1', material_code2='$material_code2', nw1='$nw1', gw1='$gw1', cbm='$cbm' 
								WHERE id_detail='$idDetail'";
				$result = mysqli_query($conn, $updateQuery);
				
		    }else{

				$count = "1";
				
			}
		}
		session_start();
		$_SESSION['message'] = $edited;
		header("location: detail_master.php?sku=$sku");
		
	}
	else
	{
		$_SESSION['message'] = "Invalid File";
		header("location: data_summary.php");
		exit(0);
	}
	# code...
}
?>