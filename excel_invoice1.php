<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_invoice.php';
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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

    $sheet->getStyle('A1:J2')->applyFromArray($styleHeader);
    $sheet->getStyle('B9:E14')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
    $sheet->getStyle('B16:E21')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

    $sheet->getStyle('A1:E2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $spreadsheet->getActiveSheet()->getStyle('A1:E2')->getFont()->setSize(20);
    $sheet->setCellValue('A1', 'COMMERCIAL INVOICE');
    $sheet->getStyle('A1')->getFont()->setUnderline(true);
    $sheet->mergeCells('A1:J2');
    $sheet->getStyle('A1')->getFont()->setBold(true);

    foreach ($get as $data) {
        $sheet->setCellValue('A3', 'Shipper :'); $sheet->getStyle('A3')->getFont()->setBold(true);
        $sheet->setCellValue('B3', 'PT METRO PEARL INDONESIA'); $sheet->mergeCells('B3:E3'); $sheet->getStyle('B3')->getFont()->setBold(true);
        $sheet->setCellValue('B4', 'Jl. Pramuka Raya KM.0,99 No.18 Desa Bunder, Kec Jatiluhur'); $sheet->mergeCells('B4:E4');
        $sheet->setCellValue('B5', 'Kab. Purwakarta Jawa Barat, Indonesia.'); $sheet->mergeCells('B5:E5');
        $sheet->setCellValue('B6', 'Telp. 0264(8221643) Fax. (0264)8221642'); $sheet->mergeCells('B6:E6');
        $sheet->setCellValue('G4', 'Invoice No. '); $sheet->getStyle('G4')->getFont()->setBold(true);
        $sheet->setCellValue('H4', $data['invoice_no']); $sheet->mergeCells('H4:J4'); $sheet->getStyle('H4:J4')->getFont()->setBold(true);
        $sheet->setCellValue('G5', 'Date '); $sheet->getStyle('G5')->getFont()->setBold(true);
        $sheet->setCellValue('H5', $data['tanggal']); $sheet->mergeCells('H5:J5');$sheet->getStyle('H5:J5')->getFont()->setBold(true);
        $sheet->setCellValue('G6', 'Payment Term '); $sheet->getStyle('G6')->getFont()->setBold(true);
        $sheet->setCellValue('H6', $data['payment_term']); $sheet->mergeCells('H6:J6');$sheet->getStyle('H6:J6')->getFont()->setBold(true);
        $sheet->setCellValue('A8', 'Consignee :'); $sheet->getStyle('A8:E8')->getFont()->setBold(true);
        $sheet->setCellValue('B8', $data['shipto']); $sheet->mergeCells('B8:E8');
        $sheet->setCellValue('A9', 'Address :'); $sheet->getStyle('A9')->getFont()->setBold(true);
        $sheet->setCellValue('B9', $data['alamat_shipto']); $sheet->mergeCells('B9:E14');
        $sheet->getStyle('B9:E14')->getAlignment()->setWrapText(true);
        $sheet->setCellValue('G8', 'Buyer '); $sheet->getStyle('G8')->getFont()->setBold(true);
        $sheet->setCellValue('H8', 'GLOBALINK WORLDWIDE LTD.'); $sheet->mergeCells('H8:J8'); $sheet->getStyle('H8:J8')->getFont()->setBold(true);
        $sheet->setCellValue('H9', '7F-1,NO.50'); $sheet->mergeCells('H9:J9');
        $sheet->setCellValue('H10', 'SEC. 4, NANJING E. RD.,'); $sheet->mergeCells('H10:J10');
        $sheet->setCellValue('H11', 'SONGSHAN DIST'); $sheet->mergeCells('H11:J11');
        $sheet->setCellValue('H12', 'TAIPEI CITY, TAIWAN'); $sheet->mergeCells('H12:J12');
        $sheet->setCellValue('A16', 'Notify Party :'); $sheet->getStyle('A16')->getFont()->setBold(true);
        $sheet->setCellValue('B16', $data['notify']); $sheet->mergeCells('B16:E21');
        $sheet->getStyle('B16:E21')->getAlignment()->setWrapText(true);
        $sheet->setCellValue('A23', 'Shipment from Jakarta, Indonesia to '.$data['port']); $sheet->mergeCells('A23:E23');
        $sheet->getStyle('A23')->getFont()->setBold(true);
        $sheet->setCellValue('A24', 'Shipper Per'); $sheet->getStyle('A24')->getFont()->setBold(true);
        $sheet->setCellValue('B24', $data['shipper']); $sheet->mergeCells('B24:E24'); $sheet->getStyle('B24:E24')->getFont()->setBold(true);
        $sheet->setCellValue('A25', 'On/About'); $sheet->getStyle('A25')->getFont()->setBold(true);
        $sheet->setCellValue('B25', $data['about']); $sheet->mergeCells('B25:E25'); $sheet->getStyle('B25:E25')->getFont()->setBold(true);
        $sheet->setCellValue('G24', 'Delivery Term'); $sheet->getStyle('G24')->getFont()->setBold(true);
        $sheet->setCellValue('H24', $data['delivery']); $sheet->mergeCells('H24:J24'); $sheet->getStyle('H24')->getFont()->setBold(true);
        $sheet->setCellValue('G25', 'Country of Origin'); $sheet->getStyle('G25')->getFont()->setBold(true);
        $sheet->setCellValue('H25', 'Indonesia');
        $sheet->mergeCells('H25:J25'); $sheet->getStyle('H25')->getFont()->setBold(true);

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
    $sheet->getStyle('A27:J27')->applyFromArray($styleTable);
    $sheet->getStyle('A27:J27')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
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
        $i++;
    }
    $sheet->setTitle('Invoice');

    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    $sheet->getStyle('A28:J'.$i)->applyFromArray($styleArray);

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

    $sheet->getStyle('A27:J27')->getFont()->setBold( true );

    $styleBorder = [
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            ],
        ],
    ];
    $i = $i + 2;
    $sheet->getStyle('A1:J'.$i,)->applyFromArray($styleBorder);

    $writer = new Xlsx($spreadsheet);
    // $filename = 'Data Summary';
    $writer->save('php://output');
?>