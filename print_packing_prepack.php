<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_packing_list.php';
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
                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- DataTales Example -->
                <div class="">
                    <div class="">
                        <br>
                        <h6 style="font-size : 24px;" class="m-0 font-weight-bold text-dark"><center><u>PACKING LIST</u></center></h6>
                    </div>
                    <br>
                    <br>
                    <div style="font-size : 10px;" class="">
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php
                            $id_summary   = $_GET['id_summary'];
                            $get  = showData($id_summary);
                        ?>
                        <?php foreach ($get as $data) { ?>
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-2 col-form-label">Shipper :</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext-bold" id="staticEmail" value="PT METRO PEARL INDONESIA"><span>Jl. Pramuka Raya KM.0,99 No.18 Desa Bunder, Kec Jatiluhur <br>
                                            Kab. Purwakarta Jawa Barat, Indonesia<br>
                                        Telp. 0264 (8221643) Fax. (0264) 8221642</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">Port Of Loading :</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data['port_of_loading'] ?>">
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">Port Of Entry :</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data['port_of_entry'] ?>">
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">Final Destination :</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data['final_destination'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-2 col-form-label">Ship to :</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext-bold" id="staticEmail" value="<?= $data['ship_to'] ?>">
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-2 col-form-label">Address :</label>
                                        <div class="col-sm-10">
                                            <div><?php echo nl2br($data['address']); ?> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">Vessel/Voyage :</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data['vessel_voyage'] ?>">
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">FCL/CFS :</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data['fcl_cfs'] ?>">
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">ETD :</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data['etd'] ?>">
                                        </div>
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">ETA :</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data['eta'] ?>">
                                            <input type="hidden" name="id" value="<?= $data['id_summary'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="table-responsive">
                            <table class="display table table-bordered table-striped" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Factory Code</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Man Po</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Customer Po</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Po Reference</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Style No</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Width</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Size</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Qty</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Carton Number</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Total Carton</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Ctn/Prs</th>
                                        <th colspan="2" style="text-align: center;">NW/GW(kgs)</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">CBM</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">NW</th>
                                        <th style="text-align: center;">GW</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $totalqty = $totalcarton = 0;
                                        if (isset($_GET['id_summary'])) {
                                            $id_summary=trim($_GET['id_summary']);
                                           
                                            $shipMark = mysqli_query($conn, "SELECT *, MIN(b.size) as low, MAX(b.size) as high, MAX(b.cbm) AS nilaicbm FROM tb_packing_list a
                                                                            LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                            LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                            LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                            LEFT JOIN tb_master e ON d.sku = e.sku
                                                                            WHERE d.id_summary='$id_summary' ORDER BY b.size DESC limit 1");
                                            while ($data = mysqli_fetch_array($shipMark)) {
                                            $totalqty = $data['qty_prs'];
                                            $totalcarton = $data['no_ctn'];
                                            $totalcbm = $data['no_ctn'] * $data['cbm'];
                                            $nilaicbm = $data['nilaicbm'] * $data['no_ctn'];
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $data['factory_code'];?></td>
                                        <td style="text-align: center;"><?php echo $data['man_po'];?></td>
                                        <td style="text-align: center;"><?php echo $data['cust_po'];?></td>
                                        <td style="text-align: center;"><?php echo $data['po_referance'];?></td>
                                        <td style="text-align: center;"><?php 
                                                                            if(substr($data['sku'],-3) == 'NEW'){
                                                                                echo substr($data['sku'],0,-4);
                                                                            }elseif(substr($data['sku'],-4) == '(PE)') {
                                                                                echo substr($data['sku'],0,-5);
                                                                            }else{
                                                                                echo $data['sku'];
                                                                            } ?></td>
                                        <td style="text-align: center;"><?php if($data['gender']=='Youth'){
                                                                                foreach (nilaiAwal() as $key) { echo $key[0]+0; } ?> - <?php foreach (nilaiAkhir() as $key) { echo $key[0]+0; }
                                                                            }else{
                                                                               echo $data['low']+0;?> - <?= $data['high']+0;
                                                                            } ?></td>
                                        <td style="text-align: center;"><?php echo $data['size']+0;?></td>
                                        <td style="text-align: center;"><?php echo $data['qty_prs'];?></td>
                                        <td style="text-align: center;"><?php echo $data['ctn_no'];?></td>
                                        <td style="text-align: center;"><?php echo $data['no_ctn'];?></td>
                                        <td style="text-align: center;"><?php foreach (subPrs() as $key) { echo $key[0]; }?></td>
                                        <td style="text-align: center;"><?php foreach (subtotalNW2() as $key) { $a = $totalcarton * $key[0]; echo number_format($a,2,".",","); }?></td>
                                        <td style="text-align: center;"><?php foreach (subtotalGW2() as $key) { $b = $totalcarton * $key[0]; echo number_format($b,2,".",","); }?></td>
                                        <td style="text-align: center;"><?php echo $nilaicbm ?></td>
                                    </tr>
                                </tbody>
                                <?php
                                    }
                                }   
                                ?>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" style="text-align: center;">Total</th>
                                        <th style="text-align: center;"><?php echo $totalqty ?></th>
                                        <th style="text-align: center;"></th>
                                        <th style="text-align: center;"><?php echo $totalcarton ?></th>
                                        <th style="text-align: center;"></th>
                                        <th style="text-align: center;"><?php foreach (subtotalNW2() as $key) { $a = $totalcarton * $key[0]; echo number_format($a,2,".",","); }?></th>
                                        <th style="text-align: center;"><?php foreach (subtotalGW2() as $key) { $b = $totalcarton * $key[0]; echo number_format($b,2,".",","); }?></th>
                                        <th style="text-align: center;"><?php echo $nilaicbm ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php
                            $id_summary   = $_GET['id_summary'];
                            $get  = showData($id_summary);
                        ?>
                        <?php foreach ($get as $data) { ?>
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">CONTAINER NO :</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data['container_no'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div style="font-size:14px;" class="card-body-footer">
                                    <div class="mb-3 row">
                                        <label style="font-weight : bolder;" for="staticEmail" class="col-sm-3 col-form-label">SEAL NO :</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $data['seal_no'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                        <?php } ?>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <div class="col">
                                
                            </div>
                            <div class="col">

                            </div>
                            <div style="font-size : 14px;" class="col">
                                <div class="card-body">
                                    <div class="card-title"><center>Sign,</center>

                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <p class="card-text"><center>FENNY WIRATNA</center></p>
                                </div>
                            </div>
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