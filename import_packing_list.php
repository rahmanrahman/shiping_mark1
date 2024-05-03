<?php
require_once 'functions/koneksi.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['excel_packing_list']))

{	
	
	$idPacking = $_POST['id_add_packing'];
	$datauser = $_POST['userLogin'];
    $fileName = $_FILES['import_packing_list']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

	if(in_array($file_ext, $allowed_ext))
	{
		$inputFileNamePath = $_FILES['import_packing_list']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
		$data = $spreadsheet->getActiveSheet()->toArray();

        $arr = ["1","1.5","2","2.5","3","3.5","4","4.5","5","5.5","6","6.5","7","7.5","8","8.5","9","9.5","10","10.5","11","11.5","12","12.5","13","13.5","14","14.5","15","16","17","18"];
		$count = "0";
		$arrindex =[0,33,34,35];
		foreach ($data as $x => $val) 
		{
			if($x != 0){
				$idDetail = "";
				foreach ($val as $y =>$bet)
				{
					$isi = $bet;
					if($y == 0){
						$ctn_no = $isi;
					}

					if(!in_array($y,$arrindex)){
						if($isi != ""){
							$yy = $y-1;
							$size = $arr[$yy];
							
							$Query = "SELECT b.sku 
										FROM tb_add_packing a
										LEFT JOIN tb_summery b ON a.id_summary = b.id_summary
										WHERE a.id_add_packing=".$idPacking."";
							$coba = mysqli_query($conn, $Query);
							$arrCoba = Mysqli_fetch_array($coba, MYSQLI_ASSOC);
							$idMaster = $arrCoba['sku'];

							$masterQuery = "SELECT * FROM tb_detail_master WHERE sku = '".$idMaster."' AND packing_metode='".$isi."' AND size='".$size."'";
							$test = mysqli_query($conn, $masterQuery);
							$arrMaster = Mysqli_fetch_array($test, MYSQLI_ASSOC);
							$idDetail = $arrMaster['id_detail'];
						}
					}

					if($y == 33){
						$prs_ctn = $bet;
					}else if($y == 34){
						$qty_prs = $bet;
					}else if($y == 35){
						$no_ctn = $bet;
					}
				}

				$tanggal_update = date('l, d F Y');
				if($idDetail != ""){
					$packingQuery = "INSERT INTO tb_packing_list (ctn_no, no_ctn, prs_ctn, qty_prs, id_add_packing, id_detail, updateuser, tgl_update) 
                            	VALUES ('$ctn_no','$no_ctn','$prs_ctn','$qty_prs','$idPacking','$idDetail','$datauser','$tanggal_update')";
					$result = mysqli_query($conn, $packingQuery);
				}
				
			}
		}
		$_SESSION['message'] = $upload;
		header("location: data_packing_list.php?id_add_packing=$idPacking");
		exit(0);
		
	}else{
		$_SESSION['message'] = $failed;
		header("location: data_packing_list.php?id_packing=$idPacking");
		exit(0);
	}
	# code...
}
?>