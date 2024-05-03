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
                        <h6 style="font-size : 24px;" class="m-0 font-weight-bold"><center><u>COMMERCIAL INVOICE</u></center></h6>
                    </div>
                    <br><br>
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
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-2 col-form-label">Shipper :</label>
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
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-2 col-form-label">Consignee :</label>
                                        <div class="col-sm-10">
                                            <b><?php echo $data['shipto'] ?></b>
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-2 col-form-label">Address :</label>
                                        <div class="col-sm-10">
                                            <?php echo nl2br($data['alamat_shipto']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-52 col-form-label">Buyer </label>
                                        <div class="col-sm-7">
                                            <b>GLOBALINK WORDLDWIDE LTD.</b><br>
                                            7F-1,NO.50<br>
                                            SEC. 4, NANJING E. RD.,<br>
                                            SONGSHAN DIST<br>
                                            TAIPEI CITY, TAIWAN
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-2 col-form-label">Notify Party :</label>
                                        <div class="col-sm-10">
                                            <?php echo nl2br($data['notify']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            
                        </div>
                        <div class="col-sm-7">
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm- col-form-label"><br></label>
                                        <div class="col-sm-8">
                                                        
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-12 col-form-label">Shipment from Jakarta, Indonesia to <?php echo $data['port'] ?></label>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-35 col-form-label">Shipper Per</label>
                                        <div class="col-sm-9">
                                            <b><?php echo $data['shipper'] ?></b>
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-35 col-form-label">On/About</label>
                                        <div class="col-sm-9">
                                            <b><?php echo $data['about'] ?></b>
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
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-52 col-form-label"><br></label>
                                        <div class="col-sm-7">
                                                    
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-52 col-form-label">Delivery Term</label>
                                        <div class="col-sm-7">
                                            <b><?php echo $data['delivery'] ?></b>
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-52 col-form-label">Country of Origin</label>
                                        <div class="col-sm-7">
                                            <b>Indonesia</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="font-size : 12px;" width="100%" cellspacing="0">
                                <thead class="table table-bordered1">
                                    <tr style="border: 1px black;">
                                        <th style="text-align: center; vertical-align: middle;">FACTORY CODE</th>
                                        <th style="text-align: center; vertical-align: middle;">MAN PO</th>
                                        <th style="text-align: center; vertical-align: middle;">CUST PO</th>
                                        <th style="text-align: center; vertical-align: middle;">PO REFERANCE</th>
                                        <th style="text-align: center; vertical-align: middle;">HS CODE</th>
                                        <th style="text-align: center; vertical-align: middle;">SIZE</th>
                                        <th style="text-align: center; vertical-align: middle;">SKU</th>
                                        <th style="text-align: center; vertical-align: middle;">Description</th>
                                        <th style="text-align: center; vertical-align: middle;">Colour</th>
                                        <th style="text-align: center; vertical-align: middle;">QTY (Prs)</th>
                                        <th style="text-align: center; vertical-align: middle;">Unit Price (FOB)</th>
                                        <th style="text-align: center; vertical-align: middle;">TOTAL VALUE (USD)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;">AS PER PO NO.</td>
                                    </tr>
                                    <tr>
                                        <td><br></td>
                                    </tr>
                                    <?php $totalQty = $subTotal = $totalValue = $subQTY = $SubtotalQty = $SubtotalValue = 0 ?>
                                    <?php $all = getData1(); $no = 1; ?>
                                    <?php foreach ($all as $data) { ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $data['factory_code'] ?></td>
                                        <td width="80px" style="text-align: center;"><?= $data['man_po'] ?></td>
                                        <td style="text-align: center;"><?= $data['cust_po'] ?></td>
                                        <td width="80px" style="text-align: center;"><?= $data['po_referance'] ?></td>
                                        <td style="text-align: center;"><?= $data['hscode']?></td>
                                        <td style="text-align: center;"><?php 
                                                                            if($data['gender']=='Youth'){
                                                                                $sqlSize = mysqli_query($conn, "SELECT b.size FROM tb_packing_list a
                                                                                            LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                                            LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                                            LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                                            LEFT JOIN tb_master e ON d.sku = e.sku
                                                                                            WHERE d.id_summary='$data[id_summary]' ORDER BY a.id_detail LIMIT 1");
                                                                                while($dataSize = Mysqli_fetch_array($sqlSize)) {
                                                                                        echo "#" ?><?= $dataSize['size']+0;
                                                                                }
                                                                                $sqlSize1 = mysqli_query($conn, "SELECT b.size FROM tb_packing_list a
                                                                                            LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                                            LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                                            LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                                            LEFT JOIN tb_master e ON d.sku = e.sku
                                                                                            WHERE d.id_summary='$data[id_summary]' ORDER BY a.id_detail DESC LIMIT 1");
                                                                                while($dataSize1 = Mysqli_fetch_array($sqlSize1)) {
                                                                                        echo "-#" ?><?= $dataSize1['size']+0;
                                                                                }
                                                                            }else{
                                                                                echo "#"?><?=$data['low']+0?>-<?="#"?><?=$data['high']+0 ;
                                                                            }
                                                                        ?></td>
                                        <td style="text-align: center;"><?php 
                                                                            if(substr($data['sku'],-3) == 'NEW'){
                                                                                echo substr($data['sku'],0,-4);
                                                                            }elseif(substr($data['sku'],-4) == '(PE)') {
                                                                                echo substr($data['sku'],0,-5);
                                                                            }else{
                                                                                echo $data['sku'];
                                                                            } ?></td>
                                        <td style="text-align: center;"><?= $data['category'] ?></td>
                                        <td style="text-align: center;"><?= $data['color'] ?></td>
                                        <?php 
                                            if ($data['packing_metode1'] ==  0){
                                                $totalQty = $data['nilai'];
                                            }else{
                                                $totalQty = $data['qty_prs'];
                                            }
                                                $SubtotalQty += $totalQty;
                                        ?>
                                        <td width="65px" style="text-align: center;"><?php echo $totalQty ?></td>
                                        <td width="75px" style="text-align: right;"><?= "$ ".$data['price'] ?></td>
                                        <?php 
                                            $totalValue = $totalQty * $data['price']; 
                                            $SubtotalValue += $totalValue;        
                                        ?>
                                        <td width="100px" style="text-align: right;"><?php echo "$ ".number_format($totalValue,2,".",","); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><br></th>
                                    </tr>
                                    <tr class="table1">
                                        <th colspan="9">&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Total</th>
                                        <th style="text-align: center;"><?php echo $SubtotalQty ?></th>
                                        <th style="text-align: center;"></th>
                                        <th style="text-align: right;"><?php echo "$ ".number_format($SubtotalValue,2,".",","); ?></th>
                                    </tr>
                                    <tr class="table1">
                                        <th colspan="12"><br></th>
                                    </tr>
                                    
                                </tfoot>
                            </table>
                        </div>
                        <div style="font-size: 12px; font-weight: bold;">SAY TOTAL UNITED STATES DOLLARS  : <?php echo terbilang($SubtotalValue);?> ONLY</div>
                        <br><br><br>
                        <div style="font-size : 14px; text-align: right;">
                            Sign,&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            FENNY WIRATNA&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
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