<?php

require_once 'functions/koneksi.php';
require 'vendor/autoload.php';
include_once 'functions/helper.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function ubahFormatTanggal($tanggal)
{
	if ($tanggal) {
		$tanggal_parts = explode('/', $tanggal);
		if (strlen($tanggal_parts[0]) === 2 && strlen($tanggal_parts[1]) === 2 && strlen($tanggal_parts[2]) === 4) {
			$format = 'd/m/Y';
		} elseif (strlen($tanggal_parts[0]) === 2 && strlen($tanggal_parts[1]) === 2 && strlen($tanggal_parts[2]) === 2) {
			$format = 'm/d/y';
		} else {
			return NULL;
		}
		$date = date_create_from_format($format, $tanggal);
		if ($date === false) {
			return NULL;
		}

		// Konversi ke format yang diinginkan (Y/m/d)
		return date_format($date, 'Y-m-d');
	} else {
		return NULL;
	}
}

if (isset($_POST['excel_summary'])) {

	$fileName = $_FILES['import_summary']['name'];
	$file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
	$allowed_ext = ['xls', 'csv', 'xlsx'];

	// var_dump($file_ext);
	// die;
	if (in_array($file_ext, $allowed_ext)) {

		$inputFileNamePath = $_FILES['import_summary']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
		$data = $spreadsheet->getActiveSheet()->toArray();
		session_start();
		mysqli_autocommit($conn, false);

		try {
			foreach ($data as $key => $row) {
				if ($key > 0) {
					$prod_month     = $row['0'];
					$cust_id        = $row['1'];
					$man_po         = $row['2'];
					$cust_po        = $row['3'];
					$po_referance   = $row['4'];
					$factory_code   = $row['5'];
					$sku            = $row['6'];
					$category       = $row['7'];
					$gender         = $row['8'];
					$color          = $row['9'];
					$widht          = $row['10'];
					$code           = $row['11'];
					$destination    = $row['12'];
					$price          = $row['13'];
					$xfd	        = $row['14'];
					$date       	= $row['15'];
					$realise       	= $row['16'];
					$vendor_code    = $row['17'];
					$mode         	= $row['18'];
					$si_date 		= $row['19'];
					// if ($row['19'] === NULL) {
					// 	$si_date = 'NULL';
					// } else {
					// 	$si = ubahFormatTanggal($row['19']);
					// 	$si_date = "'$si'";
					// }

					$cek = mysqli_query($conn, "SELECT * FROM tb_summery WHERE prod_month ='$prod_month' AND factory_code='$factory_code'");

					if (mysqli_num_rows($cek) !== 0) {
					} else {
						$summaryQuery = "INSERT INTO tb_summery (prod_month, cust_id, man_po, cust_po, po_referance, factory_code, sku, category, gender, color, widht, code, destination, price, xfd, date, realise, vendor_code, mode,si_date) 
										 VALUES ('$prod_month','$cust_id','$man_po','$cust_po','$po_referance','$factory_code','$sku','$category','$gender','$color','$widht','$code','$destination','$price','$xfd','$date','$realise','$vendor_code','$mode', $si_date)";
						$result = mysqli_query($conn, $summaryQuery);
						if (!$result) {
							throw new Exception(mysqli_error($conn));
						}
					}
				}
			}

			// Commit transaksi jika tidak ada kesalahan
			mysqli_commit($conn);
			$_SESSION['message'] = $upload;
			header("location: data_summary.php");
		} catch (Exception $e) {
			// Gulung transaksi jika terjadi kesalahan
			var_dump($e->getMessage());
			var_dump("Error at row " . ($key + 1) . ": ", $row);
			die;
			mysqli_rollback($conn);
			$_SESSION['message'] = $failed . " " . $e->getMessage();
			header("location: data_summary.php");
		}
	} else {
		var_dump('error ');
		die;
		session_start();
		$_SESSION['message'] = $upload;
		header("location: data_summary.php");
	}
}
