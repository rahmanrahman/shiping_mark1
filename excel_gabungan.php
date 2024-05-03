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

    //Style
    $styleHeader = [
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ],
    ];
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
    $styleTable2 = [
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
                'argb' => 'BFBFBF',
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
    $styleFooter2 = [
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
                'argb' => '8EA9DB',
            ],
        ],
    ];
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
    $styleBorder = [
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            ],
        ],
    ];

    //sheet 1
    $spreadsheet = new Spreadsheet();
    // $spreadsheet->getActiveSheet()->setShowGridlines(false);
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->getStyle('A1:L2')->applyFromArray($styleHeader);
    $sheet->getStyle('B9:E14')
    ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
    $sheet->getStyle('B16:E21')
    ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

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
        $sheet->setCellValue('B9', $data['alamat_shipto']); $sheet->mergeCells('B9:E14');
        $sheet->getStyle('B9:E14')->getAlignment()->setWrapText(true);
        $sheet->setCellValue('I8', 'Buyer '); $sheet->getStyle('I8')->getFont()->setBold(true);
        $sheet->setCellValue('J8', 'GLOBALINK WORLDWIDE LTD.'); $sheet->mergeCells('J8:L8');
        $sheet->setCellValue('J9', '7F-1,NO.50'); $sheet->mergeCells('J9:L9');
        $sheet->setCellValue('J10', 'SEC. 4, NANJING E. RD.,'); $sheet->mergeCells('J10:L10');
        $sheet->setCellValue('J11', 'SONGSHAN DIST'); $sheet->mergeCells('J11:L11');
        $sheet->setCellValue('J12', 'TAIPEI CITY, TAIWAN'); $sheet->mergeCells('J12:L12');
        $sheet->setCellValue('A16', 'Notify Party :'); $sheet->getStyle('A16')->getFont()->setBold(true);
        $sheet->setCellValue('B16', $data['notify']); $sheet->mergeCells('B16:E21');
        $sheet->getStyle('B16:E21')->getAlignment()->setWrapText(true);
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
	    $sheet->setCellValue('F'.$i, '#'.$low.' - #'.$high);
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
    $sheet->getStyle('K28:K'.$i)->getNumberFormat()->setFormatCode('$ #,##0.00');
    $sheet->getStyle('L28:L'.$i)->getNumberFormat()->setFormatCode('$ #,##0.00');

    $sheet->getStyle('A28:L'.$i)->applyFromArray($styleArray);
    $sheet->getStyle('A'.$i.':L'.$i)->applyFromArray($styleFooter);
    $sheet->setCellValue('A'.$i, 'TOTAL'); $sheet->mergeCells('A'.$i.':I'.$i);
    $sheet->setCellValue('J'.$i, $SubtotalQty);
    $sheet->setCellValue('L'.$i, $SubtotalValue);
    $sheet->getStyle('M'.$i.':L'.$i)->getNumberFormat()->setFormatCode('$ #,##0.00');

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
    $sheet->setCellValue('K'.$i, 'FENNY WIRATNA,'); $sheet->mergeCells('K'.$i.':L'.$i);
    $sheet->getStyle('K'.$i.':L'.$i)->getFont()->setBold( true );
    $sheet->getStyle('K'.$i,)->applyFromArray($styleHeader);
    
    $i = $i + 2;
    $sheet->getStyle('A1:L'.$i,)->applyFromArray($styleBorder);

    //Nama Sheet
    $sheet->setTitle('Invoice');

    //Sheet 2
    $spreadsheet->createSheet();
    $sheet2 = $spreadsheet->setActiveSheetIndex(1);
    $sheet2->getStyle('A1:O2')->applyFromArray($styleHeader);

    $sheet2->getStyle('A1:E2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet2->getStyle('A1:E2')->getFont()->setSize(20);
    $sheet2->setCellValue('A1', "PACKING LIST");
    $sheet2->getStyle('A1')->getFont()->setUnderline(true);
    $sheet2->mergeCells('A1:O2');
    $sheet2->getStyle('A1')->getFont()->setBold(true);
    $sheet2->setCellValue('A3', "Shipper :"); $sheet2->getStyle('A3')->getFont()->setBold(true);
    $sheet2->setCellValue('B3', "PT METRO PEARL INDONESIA"); $sheet2->mergeCells('B3:E3'); $sheet2->getStyle('B3')->getFont()->setBold(true);
    $sheet2->setCellValue('B4', "Jl. Pramuka Raya KM.0,99 No.18 Desa Bunder, Kec Jatiluhur"); $sheet2->mergeCells('B4:E4');
    $sheet2->setCellValue('B5', "Kab. Purwakarta Jawa Barat, Indonesia."); $sheet2->mergeCells('B5:E5');
    $sheet2->setCellValue('B6', "Telp. 0264(8221643) Fax. (0264)8221642"); $sheet2->mergeCells('B6:E6');
    $sheet2->setCellValue('K3', "Port Of Loading :");
    $sheet2->setCellValue('L3', "JAKARTA, INDONESIA"); $sheet2->mergeCells('L3:N3'); $sheet2->getStyle('K3:L3')->getFont()->setBold(true);
    $sheet2->setCellValue('K4', "Port Of Entry :"); $sheet2->getStyle('K4')->getFont()->setBold(true);
    $sheet2->setCellValue('K5', "Final Destination :"); $sheet2->getStyle('K5')->getFont()->setBold(true);
    $sheet2->setCellValue('A8', "Ship To :"); $sheet2->getStyle('A8')->getFont()->setBold(true);
    $sheet2->setCellValue('A9', "Address :"); $sheet2->getStyle('A9')->getFont()->setBold(true);
    $sheet2->setCellValue('K8', "Vessel/Voyage :"); $sheet2->getStyle('K8')->getFont()->setBold(true);
    $sheet2->setCellValue('K9', "ETD :"); $sheet2->getStyle('K9')->getFont()->setBold(true);
    $sheet2->setCellValue('K10', "ETA :"); $sheet2->getStyle('K10')->getFont()->setBold(true);
    $sheet2->setCellValue('A12', "Notify :"); $sheet2->getStyle('A12')->getFont()->setBold(true);
    $sheet2->setCellValue('A14', "CONTAINER NO :"); $sheet2->mergeCells('A14:B14'); $sheet2->getStyle('A14')->getFont()->setBold(true);
    $sheet2->setCellValue('C14', "TBA"); $sheet2->getStyle('C14')->getFont()->setBold(true);
    $sheet2->setCellValue('G14', "SEAL NO :"); $sheet2->mergeCells('G14:H14'); $sheet2->getStyle('G14')->getFont()->setBold(true);
    $sheet2->setCellValue('I14', "TBA"); $sheet2->getStyle('I14')->getFont()->setBold(true);

    $sheet2->getStyle('A15:O16')->applyFromArray($styleTable2);
    $sheet2->getStyle('A15:O16')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet2->setCellValue('A15', 'Factory Code'); $sheet2->mergeCells('A15:A16');
    $sheet2->setCellValue('B15', 'Man Po'); $sheet2->mergeCells('B15:B16');
    $sheet2->setCellValue('C15', 'Customer Po'); $sheet2->mergeCells('C15:C16');
    $sheet2->setCellValue('D15', 'Po Referance'); $sheet2->mergeCells('D15:D16');
    $sheet2->setCellValue('E15', 'Color'); $sheet2->mergeCells('E15:E16');
    $sheet2->setCellValue('F15', 'Style No'); $sheet2->mergeCells('F15:F16');
    $sheet2->setCellValue('G15', 'Width'); $sheet2->mergeCells('G15:G16');
    $sheet2->setCellValue('H15', 'Size'); $sheet2->mergeCells('H15:H16');
    $sheet2->setCellValue('I15', 'Qty'); $sheet2->mergeCells('I15:I16');
    $sheet2->setCellValue('J15', 'Carton Number'); $sheet2->mergeCells('J15:J16');
    $sheet2->setCellValue('K15', 'Total Carton'); $sheet2->mergeCells('K15:K16');
    $sheet2->setCellValue('L15', 'Ctn/Prs'); $sheet2->mergeCells('L15:L16');
    $sheet2->setCellValue('M15', 'NW/GW(kgs)'); $sheet2->mergeCells('M15:N15');
    $sheet2->setCellValue('M16', 'NW'); $sheet2->mergeCells('M16');
    $sheet2->setCellValue('N16', 'GW'); $sheet2->mergeCells('N16');
    $sheet2->setCellValue('O15', 'CBM'); $sheet2->mergeCells('O15:O16');

    $subtotalnw = $subtotalgw = $subtotalcbm = $subtotalprs = $subtotalctn = 0;
    $grandprs = $grandctn = $grandnw = $grandgw = $grandcbm = $hasilnw = $hasilgw = $anw = $agw = $acbm = $bnw = $bgw = $bcbm = 0;
    $totalhasilnw = $totalhasilgw = $totalhasilcbm = 0;
    $i = 17;
    $all = getPacking(); $no = 1;
    foreach ($all as $row => $data) {

        $totalnw = $data['totalnw'];
        $totalgw = $data['totalgw'];
        $totalcbm = $data['totalcbm'];
        $subtotalnw += $totalnw;
        $subtotalgw += $totalgw;
        $subtotalcbm += $totalcbm;
        $subtotalprs += $data['qty_prs'];
        $subtotalctn += $data['no_ctn'];
        $grandprs += $data['qty_prs'];
        $grandctn += $data['no_ctn'];
        $hasilnw = $data['nilainw'] * $data['no_ctn'];
        $hasilgw = $data['nilaigw'] * $data['no_ctn'];
        $hasilcbm = $data['nilaicbm'] * $data['no_ctn'];
        $totalhasilnw += $hasilnw;
        $totalhasilgw += $hasilgw;
        $totalhasilcbm += $hasilcbm;
        $grandnw += $totalnw;
        $grandgw += $totalgw;
        $grandcbm += $totalcbm;
        $anw += $totalhasilnw;
        $agw += $totalhasilgw;
        $acbm += $hasilcbm;
        $bnw = $anw + $grandnw;
        $bgw = $agw + $grandgw;
        $bcbm = $acbm + $grandcbm;
        $sizemin = $data['minsize']+0;
        $sizemax = $data['maxsize']+0;


        $sheet2->setCellValue('A'.$i, $data['factory_code']);
        $sheet2->setCellValue('B'.$i, $data['man_po']);
	    $sheet2->setCellValue('C'.$i, $data['cust_po']);
	    $sheet2->setCellValue('D'.$i, $data['po_referance']);
	    $sheet2->setCellValue('E'.$i, $data['color']);
	    $sheet2->setCellValue('F'.$i, $data['sku']);
	    $sheet2->setCellValue('G'.$i, $data['widht']);
        if($data['packing_metode1']== 0){
	        $sheet2->setCellValue('H'.$i, $data['size']+0);
        }else{
            $sheet2->setCellValue('H'.$i, $sizemin. ' - ' .$sizemax);
        }
	    $sheet2->setCellValue('I'.$i, $data['qty_prs']);
	    $sheet2->setCellValue('J'.$i, $data['ctn_no']);
	    $sheet2->setCellValue('K'.$i, $data['no_ctn']);
	    $sheet2->setCellValue('L'.$i, $data['packing_metode']);
        if($data['packing_metode1']== 0){
	        $sheet2->setCellValue('M'.$i, $data['totalnw']);
            $sheet2->setCellValue('N'.$i, $data['totalgw']);
            $sheet2->setCellValue('O'.$i, $data['totalcbm']);
        }else{
            $sheet2->setCellValue('M'.$i, $hasilnw);
            $sheet2->setCellValue('N'.$i, $hasilgw);
            $sheet2->setCellValue('O'.$i, $hasilcbm);
        }
        if (@$all[$row+1]['id_detail_invoice'] != $data['id_detail_invoice']) {
            $i = $i + 1;
            $sheet2->getStyle('A'.$i.':O'.$i)->applyFromArray($styleTable2);
            $sheet2->getStyle('A'.$i.':O'.$i)->getFont()->setBold(true);
            $sheet2->setCellValue('A'.$i, 'Total'); $sheet2->mergeCells('A'.$i.':H'.$i);
            $sheet2->setCellValue('I'.$i, $subtotalprs);
            $sheet2->setCellValue('K'.$i, $subtotalctn);
            if($data['packing_metode1'] == 0){ 
                $sheet2->setCellValue('M'.$i, $subtotalnw);
                $sheet2->setCellValue('N'.$i, $subtotalgw);
                $sheet2->setCellValue('O'.$i, $subtotalcbm);
            }else{
                $sheet2->setCellValue('M'.$i, $totalhasilnw);
                $sheet2->setCellValue('N'.$i, $totalhasilgw);
                $sheet2->setCellValue('O'.$i, $totalhasilcbm);
            }
            $totalhasilnw = $totalhasilgw = $totalhasilcbm = 0;
            $subtotalnw = $subtotalgw = $subtotalprs = $subtotalctn = $subtotalcbm = 0;
        }
        $i++;
    }
    $sheet2->getStyle('M17:M'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
    $sheet2->getStyle('N17:N'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
    $sheet2->getStyle('O17:O'.$i)->getNumberFormat()->setFormatCode('#,##0.00');

    $i = $i - 1;
    $sheet2->getStyle('A15:O'.$i)->applyFromArray($styleArray);
    $i = $i + 3;
    $sheet2->getStyle('A'.$i.':O'.$i)->applyFromArray($styleFooter2);
    $sheet2->setCellValue('A'.$i, 'GRAND TOTAL'); $sheet2->mergeCells('A'.$i.':H'.$i);
    $sheet2->setCellValue('I'.$i, $grandprs);
    $sheet2->setCellValue('K'.$i, $grandctn);
    $sheet2->setCellValue('M'.$i, $bnw);
    $sheet2->setCellValue('N'.$i, $bgw);
    $sheet2->setCellValue('O'.$i, $acbm);
    $sheet2->getStyle('M'.$i.':O'.$i)->getNumberFormat()->setFormatCode('#,##0.00');

    $sheet2->getStyle('A15:O16')->getFont()->setBold( true );
    $sheet2->getStyle('A'.$i.':O'.$i)->getFont()->setBold( true );

    //Nama Sheet
    $sheet2->setTitle('Packing List');

    //ukuran kolom sheet 1
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

    //ukuran kolom sheet 2
    $sheet2->getColumnDimension('A')->setWidth(13);
    $sheet2->getColumnDimension('B')->setWidth(10);
    $sheet2->getColumnDimension('C')->setWidth(13);
    $sheet2->getColumnDimension('D')->setWidth(13);
    $sheet2->getColumnDimension('E')->setWidth(23);
    $sheet2->getColumnDimension('F')->setWidth(14);
    $sheet2->getColumnDimension('G')->setWidth(12);
    $sheet2->getColumnDimension('H')->setWidth(10);
    $sheet2->getColumnDimension('I')->setWidth(10);
    $sheet2->getColumnDimension('J')->setWidth(15);
    $sheet2->getColumnDimension('K')->setWidth(16);
    $sheet2->getColumnDimension('L')->setWidth(9);
    $sheet2->getColumnDimension('M')->setWidth(11);
    $sheet2->getColumnDimension('N')->setWidth(11);
    $sheet2->getColumnDimension('O')->setWidth(11);

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
?>