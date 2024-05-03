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
		return date_format($date, 'm-d-Y');
	} else {
		return NULL;
	}
}

if (isset($_POST['update_summary'])) {
	$fileName = $_FILES['update_summary']['name'];
	$file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

	$allowed_ext = ['xls', 'csv', 'xlsx'];

	if (in_array($file_ext, $allowed_ext)) {
		$inputFileNamePath = $_FILES['update_summary']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
		$data = $spreadsheet->getActiveSheet()->toArray();

		$count = "0";
		foreach ($data as $row) {
			if ($count > 0) {

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


				$summaryQuery = "SELECT * FROM tb_summery WHERE prod_month='$prod_month' AND factory_code = '$factory_code'";
				$sql = mysqli_query($conn, $summaryQuery);
				$arrSummary = Mysqli_fetch_array($sql, MYSQLI_ASSOC);
				$idSummary = $arrSummary['id_summary'];

				$updateQuery = "UPDATE tb_summery SET prod_month='$prod_month', sku='$sku', cust_id='$cust_id', man_po='$man_po', cust_po='$cust_po', po_referance='$po_referance', factory_code='$factory_code', category='$category', gender='$gender', color='$color', widht='$widht', code='$code', destination='$destination', price='$price', xfd='$xfd', date='$date', realise='$realise', vendor_code='$vendor_code', mode='$mode', si_date='$si_date'
				 WHERE id_summary='$idSummary'";
				$result = mysqli_query($conn, $updateQuery);
			} else {
				$count = "1";
			}
		}
		session_start();
		$_SESSION['message'] = $edited;
		header("location: data_summary.php");
	} else {
		$_SESSION['message'] = "Invalid File";
		header("location: data_summary.php");
		exit(0);
	}
	# code...
}
