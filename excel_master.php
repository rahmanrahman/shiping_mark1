<?php

require 'functions/function_master.php';
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

$excel->getActiveSheet()->setCellValue('A1', "SKU");
$excel->getActiveSheet()->setCellValue('B1', "Carton Code");
$excel->getActiveSheet()->setCellValue('C1', "Packing Metode");
$excel->getActiveSheet()->setCellValue('D1', "Meas");
$excel->getActiveSheet()->setCellValue('E1', "Meas Carton");
$excel->getActiveSheet()->setCellValue('F1', "Size");
$excel->getActiveSheet()->setCellValue('G1', "NW");
$excel->getActiveSheet()->setCellValue('H1', "GW");
$excel->getActiveSheet()->setCellValue('I1', "Blank Material Code");
$excel->getActiveSheet()->setCellValue('J1', "Meas Material Code");
$excel->getActiveSheet()->setCellValue('K1', "NW/PRS");
$excel->getActiveSheet()->setCellValue('L1', "GW/PRS");
$excel->getActiveSheet()->setCellValue('M1', "CBM");

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($style_col);

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
$all = getAll(); $no = 1;
foreach ($all as $data) {

	$excel->getActiveSheet()->setCellValue('A'.$numrow, $data['sku']);
	$excel->getActiveSheet()->setCellValue('B'.$numrow, $data['carton_code']);
	$excel->getActiveSheet()->setCellValue('C'.$numrow, $data['packing_metode']);
	$excel->getActiveSheet()->setCellValue('D'.$numrow, $data['meas']);
	$excel->getActiveSheet()->setCellValue('E'.$numrow, $data['meas_carton']);
	$excel->getActiveSheet()->setCellValue('F'.$numrow, $data['size']);
	$excel->getActiveSheet()->setCellValue('G'.$numrow, $data['nw']);
	$excel->getActiveSheet()->setCellValue('H'.$numrow, $data['gw']);
	$excel->getActiveSheet()->setCellValue('I'.$numrow, $data['material_code1']);
    $excel->getActiveSheet()->setCellValue('J'.$numrow, $data['material_code2']);
	$excel->getActiveSheet()->setCellValue('K'.$numrow, $data['nw1']);
	$excel->getActiveSheet()->setCellValue('L'.$numrow, $data['gw1']);
	$excel->getActiveSheet()->setCellValue('M'.$numrow, $data['cbm']);

	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	$excel->getActiveSheet()->getStyle('A'.$numrow.':M'.$numrow)->applyFromArray($style_row);

	$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
	$no++; // Tambah 1 setiap kali looping
	$numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(26);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(17);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(6);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(6);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(7);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(19);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(19);
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(8);

// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet()->setTitle("DATA MASTER ALL");
$excel->getActiveSheet();

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="DATA MASTER.xlsx"');
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
