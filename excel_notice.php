<?php
    require 'functions/function_output.php';
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=Shipping Notice.xlsx');
    header('Cache-Control: max-age=0');

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
	$sheet->setCellValue('A1', 'Shipping Notice');
    $sheet->getStyle('A1')->getFont()->setUnderline(true);
    $sheet->mergeCells('A1:U2');
	$sheet->getStyle('A1:U2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->getStyle('A1')->getFont()->setBold(true);

	$sheet->getStyle('A3:U3')->getFont()->setBold(true);
    $sheet->setCellValue('A3', 'Prod Month');
    $sheet->setCellValue('B3', 'Cust Id');
    $sheet->setCellValue('C3', 'Man Po');
    $sheet->setCellValue('D3', 'Cust Po');
    $sheet->setCellValue('E3', 'Po Referance');
    $sheet->setCellValue('F3', 'Factory Code');
    $sheet->setCellValue('G3', 'SKU');
    $sheet->setCellValue('H3', 'Category');
    $sheet->setCellValue('I3', 'Gender');
    $sheet->setCellValue('J3', 'Color');
    $sheet->setCellValue('K3', 'Widht');
    $sheet->setCellValue('L3', 'Dest');
    $sheet->setCellValue('M3', 'Qty.');
    $sheet->setCellValue('N3', 'Qty Carton.');
    $sheet->setCellValue('O3', 'NW');
    $sheet->setCellValue('P3', 'GW');
    $sheet->setCellValue('Q3', 'CBM');
    $sheet->setCellValue('R3', 'Ship Mode');
    $sheet->setCellValue('S3', 'Confirm XFD');
    $sheet->setCellValue('T3', 'Ship Date');
    $sheet->setCellValue('U3', 'Vendor Code');

    $totalnw = $totalgw = $totalcbm = 0;
	$i = 4;
	if(isset($_GET['nilai'])) {
		$totalnw = $totalgw = $totalcbm = 0;
		$id_summary = trim($_GET['nilai']);
		$carton = mysqli_query($conn, "SELECT *, SUM(a.no_ctn) as carton, SUM(a.no_ctn * b.cbm) as cbm, SUM(a.no_ctn * b.gw) as gw, SUM(a.no_ctn * b.nw) as nw, SUM(a.qty_prs) as qty, SUM(a.packing_metode1 * b.nw1) as nwpre, SUM(a.packing_metode1 * b.gw1) as gwpre, MAX(b.cbm) as cbmpre
										FROM tb_packing_list a
										LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
										LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
										LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
										LEFT JOIN tb_master e ON d.sku = e.sku
										WHERE d.id_summary IN ('".$id_summary."') GROUP BY d.prod_month, d.factory_code ORDER BY d.factory_code");
		while ($data = mysqli_fetch_array($carton)) {
		$totalnw = $data['no_ctn'] * $data['nwpre'];
		$totalgw = $data['no_ctn'] * $data['gwpre'];
		$totalcbm = $data['cbmpre'] * $data['no_ctn'];

		if($data['packing_metode1'] == 0){
			$qty 	= $data['qty']; 
			$nw 	= $data['nw'];
			$gw 	= $data['gw'];
			$cbm 	= $data['cbm'];
			$coba 	= $data['carton'];
		}else{
			$qty 	= $data['qty_prs'];
			$nw 	= $totalnw;
			$gw 	= $totalgw;
			$coba = $data['no_ctn'];
			$cbm 	= $totalcbm;
		}

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
	    $sheet->setCellValue('L'.$i, $data['destination']);
	    $sheet->setCellValue('M'.$i, $qty);
	    $sheet->setCellValue('N'.$i, $coba);
	    $sheet->setCellValue('O'.$i, $nw);
	    $sheet->setCellValue('P'.$i, $gw);
	    $sheet->setCellValue('Q'.$i, $cbm);
	    $sheet->setCellValue('R'.$i, $data['mode']);
	    $sheet->setCellValue('S'.$i, $data['xfd']);
	    $sheet->setCellValue('T'.$i, $data['date']);
	    $sheet->setCellValue('U'.$i, $data['vendor_code']);
        $i++;
    	}
	}
$spreadsheet->getActiveSheet()->setTitle('Shipping Notice');

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
$sheet->getStyle('A1:U'.$i)->applyFromArray($styleArray);

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
$sheet->getColumnDimension('L')->setWidth(34);
$sheet->getColumnDimension('M')->setWidth(12);
$sheet->getColumnDimension('N')->setWidth(12);
$sheet->getColumnDimension('O')->setWidth(12);
$sheet->getColumnDimension('P')->setWidth(12);
$sheet->getColumnDimension('Q')->setWidth(13);
$sheet->getColumnDimension('R')->setWidth(12);
$sheet->getColumnDimension('S')->setWidth(12);
$sheet->getColumnDimension('T')->setWidth(12);
$sheet->getColumnDimension('U')->setWidth(12);


$sheet->getStyle("A1:U1")->getFont()->setBold( true );

$writer = new Xlsx($spreadsheet);
// $filename = 'Data Summary';
$writer->save('php://output');
?>
