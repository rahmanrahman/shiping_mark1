<?php

require 'functions/function_summary.php';
require_once 'assets/PHPExcel/PHPExcel.php';
$excel = new PHPExcel();

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
	'font' => array('bold' => true), // Set font nya jadi bold
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
		'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
	)
);
$styleHeader = array(
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
	)
);

$excel->getActiveSheet()->setCellValue('A1', "Prod Month");
$excel->getActiveSheet()->setCellValue('B1', "Cust Id");
$excel->getActiveSheet()->setCellValue('C1', "Man Po");
$excel->getActiveSheet()->setCellValue('D1', "Cust Po");
$excel->getActiveSheet()->setCellValue('E1', "Po Referance");
$excel->getActiveSheet()->setCellValue('F1', "Factory Code");
$excel->getActiveSheet()->setCellValue('G1', "SKU");
$excel->getActiveSheet()->setCellValue('H1', "Category");
$excel->getActiveSheet()->setCellValue('I1', "Gender");
$excel->getActiveSheet()->setCellValue('J1', "Color");
$excel->getActiveSheet()->setCellValue('K1', "Widht");
$excel->getActiveSheet()->setCellValue('L1', "PPK Code");
$excel->getActiveSheet()->setCellValue('M1', "Dest");
$excel->getActiveSheet()->setCellValue('N1', "Price");
$excel->getActiveSheet()->setCellValue('O1', "Confirm XFD");
$excel->getActiveSheet()->setCellValue('P1', "Ship Date");
$excel->getActiveSheet()->setCellValue('Q1', "PO Release Date");
$excel->getActiveSheet()->setCellValue('R1', "Vendor Code");
$excel->getActiveSheet()->setCellValue('S1', "Ship Mode");

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A1:S1')->applyFromArray($style_col);

// Set height baris ke 1, 2, 3 dan 4
// $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('6')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('7')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('8')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('9')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('10')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('11')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('12')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('13')->setRowHeight(20);
// $excel->getActiveSheet()->getRowDimension('14')->setRowHeight(20);

$numrow = 2;
$all = getDataDate(); $no = 1;
foreach ($all as $data) {

	$excel->getActiveSheet()->setCellValue('A'.$numrow, $data['prod_month']);
	$excel->getActiveSheet()->setCellValue('B'.$numrow, $data['cust_id']);
	$excel->getActiveSheet()->setCellValue('C'.$numrow, $data['man_po']);
	$excel->getActiveSheet()->setCellValue('D'.$numrow, $data['cust_po']);
	$excel->getActiveSheet()->setCellValue('E'.$numrow, $data['po_referance']);
	$excel->getActiveSheet()->setCellValue('F'.$numrow, $data['factory_code']);
	$excel->getActiveSheet()->setCellValue('G'.$numrow, $data['sku']);
	$excel->getActiveSheet()->setCellValue('H'.$numrow, $data['category']);
	$excel->getActiveSheet()->setCellValue('I'.$numrow, $data['gender']);
    $excel->getActiveSheet()->setCellValue('J'.$numrow, $data['color']);
	$excel->getActiveSheet()->setCellValue('K'.$numrow, $data['widht']);
	$excel->getActiveSheet()->setCellValue('L'.$numrow, $data['code']);
	$excel->getActiveSheet()->setCellValue('M'.$numrow, $data['destination']);
	$excel->getActiveSheet()->setCellValue('N'.$numrow, $data['price']);
	$excel->getActiveSheet()->setCellValue('O'.$numrow, $data['xfd']);
	$excel->getActiveSheet()->setCellValue('P'.$numrow, $data['date']);
	$excel->getActiveSheet()->setCellValue('Q'.$numrow, $data['realise']);
	$excel->getActiveSheet()->setCellValue('R'.$numrow, $data['vendor_code']);
	$excel->getActiveSheet()->setCellValue('S'.$numrow, $data['mode']);

	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	$excel->getActiveSheet()->getStyle('A'.$numrow.':S'.$numrow)->applyFromArray($style_row);

	$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
	$no++; // Tambah 1 setiap kali looping
	$numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(16);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(28);
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(7);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(13);
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(39);
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('O')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('P')->setWidth(11);
$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(17);
$excel->getActiveSheet()->getColumnDimension('R')->setWidth(13);
$excel->getActiveSheet()->getColumnDimension('S')->setWidth(11);

// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet()->setTitle("DATA SUMMARY");
$excel->getActiveSheet();

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data Summary.xlsx"');
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
