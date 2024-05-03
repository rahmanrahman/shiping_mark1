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

$excel->getActiveSheet()->setCellValue('A1', "Factory Code");
$excel->getActiveSheet()->setCellValue('B1', "CBM");

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($style_col);

$numrow = 2;
$no = 1;
$sqlPrs = mysqli_query($conn, "SELECT d.factory_code, a.packing_metode1 ,SUM(IF(a.packing_metode1=0, a.no_ctn * b.cbm, 0)) AS nilai1, IF(a.packing_metode1>0, MAX(b.cbm) * a.no_ctn, 0) AS nilai2 FROM tb_packing_list a LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing LEFT JOIN tb_summery d ON c.id_summary = d.id_summary LEFT JOIN tb_master e ON d.sku = e.sku GROUP BY d.factory_code");
        while($data = Mysqli_fetch_array($sqlPrs)){
	$excel->getActiveSheet()->setCellValue('A'.$numrow, $data['factory_code']);
    if($data['packing_metode1'] == 0){
        $hasil = $data['nilai1'];
    }else{
        $hasil = $data['nilai2'];
    }
	$excel->getActiveSheet()->setCellValue('B'.$numrow, $hasil);

	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	$excel->getActiveSheet()->getStyle('A'.$numrow.':B'.$numrow)->applyFromArray($style_row);

	$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
	$no++; // Tambah 1 setiap kali looping
	$numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet()->setTitle("DATA CBM");
$excel->getActiveSheet();

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data Cbm.xlsx"');
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
