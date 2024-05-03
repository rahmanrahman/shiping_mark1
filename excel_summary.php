<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_summary.php';
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=Data Summary.xlsx');
    header('Cache-Control: max-age=0');
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Prod Month');
    $sheet->setCellValue('B1', 'Cust Id');
    $sheet->setCellValue('C1', 'Man Po');
    $sheet->setCellValue('D1', 'Cust Po');
    $sheet->setCellValue('E1', 'Po Referance');
    $sheet->setCellValue('F1', 'Factory Code');
    $sheet->setCellValue('G1', 'SKU');
    $sheet->setCellValue('H1', 'Category');
    $sheet->setCellValue('I1', 'Gender');
    $sheet->setCellValue('J1', 'Color');
    $sheet->setCellValue('K1', 'Widht');
    $sheet->setCellValue('L1', 'PPK Code');
    $sheet->setCellValue('M1', 'Dest.');
    $sheet->setCellValue('N1', 'Price');
    $sheet->setCellValue('O1', 'Confirm XFD');
    $sheet->setCellValue('P1', 'Ship Date');
    $sheet->setCellValue('Q1', 'PO Release Date');
    $sheet->setCellValue('R1', 'Vendor Code');
    $sheet->setCellValue('S1', 'Ship Mode');

    $all = getData(); $no = 1;
    $i = 2;
    foreach ($all as $data) {
        $sheet->setCellValue('A'.$i, $data['prod_month']);
	    $sheet->setCellValue('B'.$i, $data['cust_id']);
	    $sheet->setCellValue('C'.$i, $data['man_po']);
	    $sheet->setCellValue('D'.$i, $data['cust_po']);
	    $sheet->setCellValue('E'.$i, $data['po_referance']);
	    $sheet->setCellValue('F'.$i, $data['factory_code']);
	    $sheet->setCellValue('G'.$i, $data['sku']);
	    $sheet->setCellValue('H'.$i, $data['category']);
	    $sheet->setCellValue('I'.$i, $data['gender']);
	    $sheet->setCellValue('J'.$i, $data['color']);
	    $sheet->setCellValue('K'.$i, $data['widht']);
	    $sheet->setCellValue('L'.$i, $data['code']);
	    $sheet->setCellValue('M'.$i, $data['destination']);
	    $sheet->setCellValue('N'.$i, $data['price']);
	    $sheet->setCellValue('O'.$i, $data['xfd']);
	    $sheet->setCellValue('P'.$i, $data['date']);
	    $sheet->setCellValue('Q'.$i, $data['realise']);
	    $sheet->setCellValue('R'.$i, $data['vendor_code']);
	    $sheet->setCellValue('S'.$i, $data['mode']);
        $i++;
    }
$spreadsheet->getActiveSheet()->setTitle('Data Summary');

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
];
$i = $i - 1;
$sheet->getStyle('A1:R'.$i)->applyFromArray($styleArray);

//ukuran kolom
$sheet->getColumnDimension('A')->setWidth(12);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(10);
$sheet->getColumnDimension('D')->setWidth(12);
$sheet->getColumnDimension('E')->setWidth(13);
$sheet->getColumnDimension('F')->setWidth(15);
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(17);
$sheet->getColumnDimension('I')->setWidth(10);
$sheet->getColumnDimension('J')->setWidth(27);
$sheet->getColumnDimension('K')->setWidth(8);
$sheet->getColumnDimension('L')->setWidth(13);
$sheet->getColumnDimension('M')->setWidth(39);
$sheet->getColumnDimension('N')->setWidth(8);
$sheet->getColumnDimension('O')->setWidth(12);
$sheet->getColumnDimension('P')->setWidth(12);
$sheet->getColumnDimension('Q')->setWidth(17);
$sheet->getColumnDimension('R')->setWidth(13);
$sheet->getColumnDimension('S')->setWidth(12);


$sheet->getStyle("A1:R1")->getFont()->setBold( true );

$writer = new Xlsx($spreadsheet);
// $filename = 'Data Summary';
$writer->save('php://output');
?>