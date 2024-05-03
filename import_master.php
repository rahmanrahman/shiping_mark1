<?php

require_once 'functions/koneksi.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['excel_master']))

{
    $fileName = $_FILES['import_master']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

	if(in_array($file_ext, $allowed_ext))
	{
		$inputFileNamePath = $_FILES['import_master']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
		$data = $spreadsheet->getActiveSheet()->toArray();

		$count = "0";
		foreach ($data as $row) 
		{
			if($count > 0){

			$sku     = $row['0'];
			
			$masterQuery = "INSERT INTO tb_master (sku) 
                            VALUES ('$sku')";
			$result = mysqli_query($conn, $masterQuery);
		    $msg = true;
			
		    }else{

				$count = "1";
				
			}

		}

		if(isset($msg))
		{
			header("location: data_master.php");
			exit(0);
		}
		else
		{
			header("location: data_master.php");
			exit(0);
		}
		
	}
	else
	{
		$_SESSION['message'] = "Invalid File";
		header("location: data_master.php");
		exit(0);
	}
	# code...
}
?>