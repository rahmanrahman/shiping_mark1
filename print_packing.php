<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_invoice.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shipping Mark | PT Metro Pearl Indonesia</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/font.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top" style="font-size : 14px">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div>
                <!-- DataTales Example -->
                <div class="">
                    <div class="">
                        <br>
                        <h6 style="font-size : 24px;" class="m-0 font-weight-bold"><center><u>PACKING LIST</u></center></h6>
                    </div>
                    <div class="card-body">
                    <?php
                        $id_invoice   = $_GET['id_invoice'];
                        $get  = showData($id_invoice);
                    ?>
                    <?php foreach ($get as $data) { ?>
                        <div class="row">
                        <div class="col-sm-7">
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-2 col-form-label">Shipper</label>
                                        <div class="col-sm-8">
                                            <b>PT. METRO PEARL INDONESIA</b><br>
                                            Jl. Pramuka Raya KM.0,99 No.18 Desa Bunder, Kec Jatiluhur <br>
                                            Kab. Purwakarta Jawa Barat, Indonesia<br>
                                            Telp. 0264 (8221643) Fax. (0264) 8221642
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-52 col-form-label"><br></label>
                                        <div class="col-sm-7">
                                                        
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-52 col-form-label">Invoice No.</label>
                                        <div class="col-sm-7">
                                            <b><?php echo $data['invoice_no'] ?></b>
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-52 col-form-label">Date</label>
                                        <div class="col-sm-7">
                                            <b><?php echo $data['tanggal'] ?></b>
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-52 col-form-label">Payment Term</label>
                                        <div class="col-sm-7">
                                            <b><?php echo $data['payment_term'] ?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-2 col-form-label">Consignee</label>
                                        <div class="col-sm-10">
                                            <b><?php echo $data['shipto'] ?></b>
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <?php echo nl2br($data['alamat_shipto']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <br>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th width="250px" style="text-align: center;" colspan="2">CONTAINER NO:</th>
                                    <th width="250px" style="text-align: left;" colspan="2">TBA</th>
                                    <th width="250px" style="text-align: center;" colspan="2">SEAL NO:</th>
                                    <th width="250px" style="text-align: left;" colspan="2">TBA</th>
                                </tr>
                            </thead>
                        </table>
                        <table border="1" style="font-size : 12px;" width="100%" cellspacing="0">
                            <thead>
                                <tr style="border: 1px black;">
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Factory Code</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Man Po</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Customer Po</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Po Reference</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Color</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Style No</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Width</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Size</th>
                                    <th width ="50px" rowspan="2" style="vertical-align: middle; text-align: center;">Qty</th>
                                    <th width ="65px" rowspan="2" style="vertical-align: middle; text-align: center;">Carton Number</th>
                                    <th width ="65px" rowspan="2" style="vertical-align: middle; text-align: center;">Total Carton</th>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center;">Ctn/Prs</th>
                                    <th width ="130px" colspan="2" style="text-align: center;">NW/GW(kgs)</th>
                                    <th width ="50px" rowspan="2" style="vertical-align: middle; text-align: center;">CBM</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">NW</th>
                                    <th style="text-align: center;">GW</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $subtotalnw = $subtotalgw = $subtotalcbm = $subtotalprs = $subtotalctn = 0; ?>
                                <?php $grandprs = $grandctn = $grandnw = $grandgw = $grandcbm = $hasilnw = $hasilgw = $anw = $agw = $acbm = $bnw = $bgw = $bcbm = 0; ?>
                                <?php $totalhasilnw = $totalhasilgw = $totalhasilcbm = 0; ?>
                                <?php $all = getPacking(); $no = 1; ?>
                                <?php foreach ($all as $row => $data) { 
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
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?= $data['factory_code'] ?></td>
                                    <td style="text-align: center;"><?= $data['man_po'] ?></td>
                                    <td style="text-align: center;"><?= $data['cust_po'] ?></td>
                                    <td style="text-align: center;"><?= $data['po_referance'] ?></td>
                                    <td style="text-align: center;"><?= $data['color']?></td>
                                    <td style="text-align: center;"><?php 
                                                                        if(substr($data['sku'],-3) == 'NEW'){
                                                                            echo substr($data['sku'],0,-4);
                                                                        }elseif(substr($data['sku'],-4) == '(PE)') {
                                                                            echo substr($data['sku'],0,-5);
                                                                        }else{
                                                                            echo $data['sku'];
                                                                        } ?></td>
                                    <td style="text-align: center;"><?= $data['widht'] ?></td>
                                    <td style="text-align: center;"><?php 
                                                                    if($data['packing_metode1']== 0){
                                                                        echo $data['size']+0; 
                                                                    }else{
                                                                        if($data['gender']=='Youth'){
                                                                            $sqlSize = mysqli_query($conn, "SELECT b.size FROM tb_packing_list a
                                                                                        LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                                        LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                                        LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                                        LEFT JOIN tb_master e ON d.sku = e.sku
                                                                                        WHERE d.id_summary='$data[id_summary]' ORDER BY a.id_detail LIMIT 1");
                                                                                    while($dataSize = Mysqli_fetch_array($sqlSize)) {
                                                                                        echo $dataSize['size']+0;
                                                                                    };
                                                                            $sqlSize1 = mysqli_query($conn, "SELECT b.size FROM tb_packing_list a
                                                                                        LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                                        LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                                        LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                                        LEFT JOIN tb_master e ON d.sku = e.sku
                                                                                        WHERE d.id_summary='$data[id_summary]' ORDER BY a.id_detail DESC LIMIT 1");
                                                                                    while($dataSize1 = Mysqli_fetch_array($sqlSize1)) {
                                                                                        echo '-'.$dataSize1['size']+0;
                                                                                    }
                                                                        }else{
                                                                            echo $data['minsize']+0; ?> - <?= $data['maxsize']+0;
                                                                        }  
                                                                    }
                                                                ?></td>
                                    <td style="text-align: center;"><?= $data['qty_prs'] ?></td>
                                    <td style="text-align: center;"><?= $data['ctn_no'] ?></td>
                                    <td style="text-align: center;"><?= $data['no_ctn']?></td>
                                    <td style="text-align: center;"><?= $data['packing_metode']?></td>
                                    <td style="text-align: center;"><?php
                                                                        if($data['packing_metode1']== 0){ ?>
                                                                            <?php echo number_format($data['totalnw'],2,".",",") ?>
                                                                        <?php }else{ ?>
                                                                            <?php echo number_format($hasilnw,2,".",",") ?>
                                                                        <?php } ?></td>
                                    <td style="text-align: center;"><?php
                                                                        if($data['packing_metode1']== 0){ ?>
                                                                            <?php echo number_format($data['totalgw'],2,".",",") ?>
                                                                        <?php }else{ ?>
                                                                            <?php echo number_format($hasilgw,2,".",",") ?>
                                                                        <?php } ?></td>
                                    <td style="text-align: center;"><?php
                                                                        if($data['packing_metode1']== 0){ ?>
                                                                            <?php echo number_format($data['totalcbm'],2,".",",") ?>
                                                                        <?php }else{ ?>
                                                                            <?php echo number_format($hasilcbm,2,".",",") ?>
                                                                        <?php } ?></td>
                                </tr>
                                <?php if (@$all[$row+1]['id_detail_invoice'] != $data['id_detail_invoice']) { ?>
                                <tr>
                                    <td style="text-align: center;" colspan="8"><b>Total</b></td>
                                    <td style="text-align: center;"><b><?php echo $subtotalprs ?></b></td>
                                    <td></td>
                                    <td style="text-align: center;"><b><?php echo $subtotalctn ?></b></td>
                                    <td></td>
                                    <td style="text-align: center;"><b><?php 
                                                                        if($data['packing_metode1'] == 0){ ?>
                                                                            <?php echo $subtotalnw ?>
                                                                        <?php }else{ ?>
                                                                            <?php echo number_format($totalhasilnw,2,".",",")?>
                                                                        <?php } ?></b></td>
                                    <td style="text-align: center;"><b><?php 
                                                                        if($data['packing_metode1'] == 0){ ?>
                                                                            <?php echo $subtotalgw ?>
                                                                        <?php }else{ ?>
                                                                            <?php echo number_format($totalhasilgw,2,".",",")?>
                                                                        <?php } ?></b></td>
                                    <td style="text-align: center;"><b><?php
                                                                        if($data['packing_metode1'] == 0){ ?>
                                                                            <?php echo $subtotalcbm ?>
                                                                        <?php }else{ ?>
                                                                            <?php echo $totalhasilcbm ?>
                                                                        <?php } ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="15"><br></td>
                                </tr>
                                    <?php $totalhasilnw = $totalhasilgw = $totalhasilcbm = 0; ?>
                                    <?php $subtotalnw = $subtotalgw = $subtotalprs = $subtotalctn = $subtotalcbm = 0;
                                } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: center;" colspan="8">Grand Total</th>
                                    <th style="text-align: center;"><?php echo $grandprs ?></th>
                                    <th style="text-align: center;"></th>
                                    <th style="text-align: center;"><?php echo $grandctn ?></th>
                                    <th style="text-align: center;"></th>
                                    <th style="text-align: center;"><?php echo number_format($bnw,2,".",",") ?></th>
                                    <th style="text-align: center;"><?php echo number_format($bgw,2,".",",")?></th>
                                    <th style="text-align: center;"><?php echo number_format($acbm,2,".",",")?></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                <!-- /.container-fluid -->
                </div>
            <!-- End of Main Content -->
        <script>
            window.print();
        </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    
</body>

</html>