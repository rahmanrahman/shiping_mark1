<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_invoice.php';
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
    header('Content-Type: application/vnd.ms-excel');
    $id_invoice   = $_GET['id_invoice'];
    $get  = showData($id_invoice);
    foreach ($get as $data) {
        $a = $data['invoice_no'];
    header("Content-Disposition: attachment;filename= $a.xlsx"); 
    }
    header('Cache-Control: max-age=0');
    
    $spreadsheet = new Spreadsheet();
    // $spreadsheet->getActiveSheet()->setShowGridlines(false);
    $sheet = $spreadsheet->getActiveSheet();
    $styleHeader = [
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ],
    ];

    $sheet->getStyle('A1:L2')->applyFromArray($styleHeader);
    $sheet->getStyle('B9:E14')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
    $sheet->getStyle('B16:E21')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

    $sheet->getStyle('A1:E2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A1:E2')->getFont()->setSize(20);
    $sheet->setCellValue('A1', 'COMMERCIAL INVOICE');
    $sheet->getStyle('A1')->getFont()->setUnderline(true);
    $sheet->mergeCells('A1:L2');
    $sheet->getStyle('A1')->getFont()->setBold(true);

    foreach ($get as $data) {
        $sheet->setCellValue('A3', 'Shipper :'); $sheet->getStyle('A3')->getFont()->setBold(true);
        $sheet->setCellValue('B3', 'PT METRO PEARL INDONESIA'); $sheet->mergeCells('B3:E3'); $sheet->getStyle('B3')->getFont()->setBold(true);
        $sheet->setCellValue('B4', 'Jl. Pramuka Raya KM.0,99 No.18 Desa Bunder, Kec Jatiluhur'); $sheet->mergeCells('B4:E4');
        $sheet->setCellValue('B5', 'Kab. Purwakarta Jawa Barat, Indonesia.'); $sheet->mergeCells('B5:E5');
        $sheet->setCellValue('B6', 'Telp. 0264(8221643) Fax. (0264)8221642'); $sheet->mergeCells('B6:E6');
        $sheet->setCellValue('I4', 'Invoice No. '); $sheet->getStyle('I4')->getFont()->setBold(true);
        $sheet->setCellValue('J4', $data['invoice_no']); $sheet->mergeCells('J4:L4');
        $sheet->setCellValue('I5', 'Date '); $sheet->getStyle('I5')->getFont()->setBold(true);
        $sheet->setCellValue('J5', $data['tanggal']); $sheet->mergeCells('J5:L5');
        $sheet->setCellValue('I6', 'Payment Term '); $sheet->getStyle('I6')->getFont()->setBold(true);
        $sheet->setCellValue('J6', $data['payment_term']); $sheet->mergeCells('J6:L6');
        $sheet->setCellValue('A8', 'Consignee :'); $sheet->getStyle('A8:E8')->getFont()->setBold(true);
        $sheet->setCellValue('B8', $data['shipto']); $sheet->mergeCells('B8:E8');
        $sheet->setCellValue('A9', 'Address :'); $sheet->getStyle('A9')->getFont()->setBold(true);
        $text = nl2br($data['alamat_shipto']);
        $lines = explode('<br />', $text);
        $z = 9;
        foreach ($lines as $line) {
            $sheet->setCellValue('B'.$z, $line); $sheet->mergeCells('B'.$z.':E'.$z);
            $z++; // Pindah ke baris selanjutnya
        }
        $sheet->setCellValue('I8', 'Buyer '); $sheet->getStyle('I8')->getFont()->setBold(true);
        $sheet->setCellValue('J8', 'GLOBALINK WORLDWIDE LTD.'); $sheet->mergeCells('J8:L8'); $sheet->getStyle('J8:L8')->getFont()->setBold(true);
        $sheet->setCellValue('J9', '7F-1,NO.50'); $sheet->mergeCells('J9:L9');
        $sheet->setCellValue('J10', 'SEC. 4, NANJING E. RD.,'); $sheet->mergeCells('J10:L10');
        $sheet->setCellValue('J11', 'SONGSHAN DIST'); $sheet->mergeCells('J11:L11');
        $sheet->setCellValue('J12', 'TAIPEI CITY, TAIWAN'); $sheet->mergeCells('J12:L12');
        $sheet->setCellValue('A16', 'Notify Party :'); $sheet->getStyle('A16')->getFont()->setBold(true);
        $text1 = nl2br($data['notify']);
        $notifys = explode('<br />', $text1);
        $c = 16;
        foreach ($notifys as $notify) {
            $sheet->setCellValue('B'.$c, $notify); $sheet->mergeCells('B'.$c.':E'.$c);
            $c++; // Pindah ke baris selanjutnya
        }
        $sheet->setCellValue('A23', 'Shipment from Jakarta, Indonesia to '.$data['port']); $sheet->mergeCells('A23:E23');
        $sheet->getStyle('A23')->getFont()->setBold(true);
        $sheet->setCellValue('A24', 'Shipper Per'); $sheet->getStyle('A24')->getFont()->setBold(true);
        $sheet->setCellValue('B24', $data['shipper']); $sheet->mergeCells('B24:E24'); $sheet->getStyle('B24:E24')->getFont()->setBold(true);
        $sheet->setCellValue('A25', 'On/About'); $sheet->getStyle('A25')->getFont()->setBold(true);
        $sheet->setCellValue('B25', $data['about']); $sheet->mergeCells('B25:E25'); $sheet->getStyle('B25:E25')->getFont()->setBold(true);
        $sheet->setCellValue('I24', 'Delivery Term'); $sheet->getStyle('I24')->getFont()->setBold(true);
        $sheet->setCellValue('J24', $data['delivery']); $sheet->mergeCells('J24:L24'); $sheet->getStyle('J24')->getFont()->setBold(true);
        $sheet->setCellValue('I25', 'Country of Origin'); $sheet->getStyle('I25')->getFont()->setBold(true);
        $sheet->setCellValue('J25', 'Indonesia');
        $sheet->mergeCells('J25:L25'); $sheet->getStyle('J25')->getFont()->setBold(true);

    }

    $styleTable = [
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => 'FFDF8F',
            ],
        ],
    ];

    $styleFooter = [
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => 'D9D9D9',
            ],
        ],
    ];
    $sheet->getStyle('A27:L27')->applyFromArray($styleTable);
    $sheet->getStyle('A27:L27')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->setCellValue('A27', 'Factory Code');
    $sheet->setCellValue('B27', 'Man Po');
    $sheet->setCellValue('C27', 'Customer Po');
    $sheet->setCellValue('D27', 'Po Referance');
    $sheet->setCellValue('E27', 'HS Code');
    $sheet->setCellValue('F27', 'Size');
    $sheet->setCellValue('G27', 'SKU');
    $sheet->setCellValue('H27', 'Description');
    $sheet->setCellValue('I27', 'Color');
    $sheet->setCellValue('J27', 'QTY (Prs)');
    $sheet->setCellValue('K27', 'Unit Price (FOB)');
    $sheet->setCellValue('L27', 'TOTAL VALUE (USD)');

    $i = 28;
    $totalQty = $subTotal = $totalValue = $subQTY = $SubtotalQty = $SubtotalValue = 0;
    $all = getData1(); $no = 1;
    foreach ($all as $data) {
        $id_invoice = $data['id_invoice'];
        $low = $data['low']+0;
        $high = $data['high']+0;

        $sheet->setCellValue('A'.$i, $data['factory_code']);
        $sheet->setCellValue('B'.$i, $data['man_po']);
	    $sheet->setCellValue('C'.$i, $data['cust_po']);
	    $sheet->setCellValue('D'.$i, $data['po_referance']);
	    $sheet->setCellValue('E'.$i, $data['hscode']);
        if($data['gender']== 'Youth'){
            $sqlSize = mysqli_query($conn, "SELECT b.size FROM tb_packing_list a
                        LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                        LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                        LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                        LEFT JOIN tb_master e ON d.sku = e.sku
                        WHERE d.id_summary='$data[id_summary]' ORDER BY a.id_detail LIMIT 1");
            while($dataSize = Mysqli_fetch_array($sqlSize)) {
                $Size1 = $dataSize['size']+0;
            };
            $sqlSize1 = mysqli_query($conn, "SELECT b.size FROM tb_packing_list a
                        LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                        LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                        LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                        LEFT JOIN tb_master e ON d.sku = e.sku
                        WHERE d.id_summary='$data[id_summary]' ORDER BY a.id_detail DESC LIMIT 1");
            while($dataSize1 = Mysqli_fetch_array($sqlSize1)) {
                $Size2 = $dataSize1['size']+0;
            };

            $sheet->setCellValue('F'.$i, '#'.$Size1. ' - #'.$Size2);
        }else{
            $sheet->setCellValue('F'.$i, '#'.$low.' - #'.$high);
        }
	    $sheet->setCellValue('G'.$i, $data['sku']);
        $sheet->setCellValue('H'.$i, $data['category']);
        $sheet->setCellValue('I'.$i, $data['color']);
        if ($data['packing_metode1'] ==  0){
            $totalQty = $data['nilai'];
        }else{
            $totalQty = $data['qty_prs'];
        }
        $SubtotalQty += $totalQty;
        $sheet->setCellValue('J'.$i, $totalQty);
        $sheet->setCellValue('K'.$i, $data['price']);
        $totalValue = $totalQty * $data['price']; 
        $SubtotalValue += $totalValue;
        $sheet->setCellValue('L'.$i, $totalValue);
        $i++;
    }
    $sheet->getStyle('K28:L'.$i)
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
    $sheet->getStyle('A28:J'.$i)
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->getStyle('K28:K'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
    $sheet->getStyle('L28:L'.$i)->getNumberFormat()->setFormatCode('$* #,##0.00');
    $sheet->setTitle('Invoice');

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$sheet->getStyle('A28:L'.$i)->applyFromArray($styleArray);
$sheet->getStyle('A'.$i.':L'.$i)->applyFromArray($styleFooter);
$sheet->setCellValue('A'.$i, 'TOTAL'); $sheet->mergeCells('A'.$i.':I'.$i);
$sheet->setCellValue('J'.$i, $SubtotalQty);
$sheet->setCellValue('L'.$i, $SubtotalValue);

// // //ukuran kolom
$sheet->getColumnDimension('A')->setWidth(13);
$sheet->getColumnDimension('B')->setWidth(10);
$sheet->getColumnDimension('C')->setWidth(13);
$sheet->getColumnDimension('D')->setWidth(14);
$sheet->getColumnDimension('E')->setWidth(14);
$sheet->getColumnDimension('F')->setWidth(17);
$sheet->getColumnDimension('G')->setWidth(14);
$sheet->getColumnDimension('H')->setWidth(14);
$sheet->getColumnDimension('I')->setWidth(18);
$sheet->getColumnDimension('J')->setWidth(12);
$sheet->getColumnDimension('K')->setWidth(16);
$sheet->getColumnDimension('L')->setWidth(20);

$sheet->getStyle('A27:L27')->getFont()->setBold( true );
$sheet->getStyle('A'.$i.':L'.$i)->getFont()->setBold( true );

$i = $i + 2;
$sheet->setCellValue('A'.$i, 'SAY TOTAL UNITED STATES DOLLARS : '.terbilang($SubtotalValue).' ONLY');
$sheet->mergeCells('A'.$i.':L'.$i);
$sheet->getStyle('A'.$i.':L'.$i)->getFont()->setBold( true );
$i = $i + 3;
$sheet->setCellValue('K'.$i, 'Sign,'); $sheet->mergeCells('K'.$i.':L'.$i);
$sheet->getStyle('K'.$i.':L'.$i)->getFont()->setBold( true );
$sheet->getStyle('K'.$i,)->applyFromArray($styleHeader);
$i = $i + 6;
$sheet->setCellValue('K'.$i, 'FENNY WIRATNA'); $sheet->mergeCells('K'.$i.':L'.$i);
$sheet->getStyle('K'.$i.':L'.$i)->getFont()->setBold( true );
$sheet->getStyle('K'.$i,)->applyFromArray($styleHeader);
$styleBorder = [
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
        ],
    ],
];

$writer = new Xlsx($spreadsheet);
// $filename = 'Data Summary';
$writer->save('php://output');
?>