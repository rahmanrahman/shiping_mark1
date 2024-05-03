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
                        <h6 style="font-size : 18px;"><center><u>PACKING LIST / SHIPPING MARK</u></center></h6>
                    </div>
                    <?php $all = getsummary(); $no = 1; ?>
                    <?php foreach ($all as $data) { ?>
                    <span style="font-size : 12px;" class="m-0 font-weight-bold"><?= $data['cust_id'] ?></span>
                    <?php } ?>
                    <br>
                    <div>
                        <div style="font-size : 12px;" >
                            <table border='1' width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Factory Code</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Prepacked</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Order No</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Style No</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Color</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Width</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Carton Code</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Meas</th>
                                        <th colspan="2" style="text-align: center;">NW/GW(kgs)</th>
                                        <th colspan="<?php foreach (countData() as $key) { echo $key[0]; }?>" style="vertical-align: middle; text-align: center;">Size</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Carton Number</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Total Carton</th>
                                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Pairs</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">NW</th>
                                        <th style="text-align: center;">GW</th>
                                        <th colspan="<?php foreach (countData() as $key) { echo $key[0]; }?>" style="text-align: center;">QTY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $total = 0;
                                        $po = $_GET['po'];
                                        if (isset($_GET['id_summary'])) {
                                            $id_summary=trim($_GET['id_summary']);
                                            
                                            $shipMark = mysqli_query($conn, "SELECT * FROM tb_packing_list a
                                                                            LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                            LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                            LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                            LEFT JOIN tb_master e ON d.sku = e.sku
                                                                            WHERE d.id_summary='$id_summary' ORDER BY b.nw DESC limit 1");
                                            while ($data = mysqli_fetch_array($shipMark)) {
                                            $total += $data['no_ctn'];
                                    ?>
                                    <tr>
                                        <td rowspan="2" style="text-align: center;"><?php echo $data['factory_code'];?></td>
                                        <td rowspan="2" style="text-align: center;"><?php echo $data['code'];?></td>
                                        <td rowspan="2" style="text-align: center;"><?php echo $po;?></td>
                                        <td rowspan="2" style="text-align: center;"><?php 
                                                                                        if(substr($data['sku'],-3) == 'NEW'){
                                                                                            echo substr($data['sku'],0,-4);
                                                                                        }elseif(substr($data['sku'],-4) == '(PE)') {
                                                                                            echo substr($data['sku'],0,-5);
                                                                                        }else{
                                                                                            echo $data['sku'];
                                                                                        } ?></td>
                                        <td rowspan="2" style="text-align: center;"><?php echo $data['color'];?></td>
                                        <td rowspan="2" style="text-align: center;"><?php echo $data['widht'];?></td>
                                        <td rowspan="2" style="text-align: center;"><?php echo $data['carton_code'];?></td>
                                        <td rowspan="2" style="text-align: center;"><?php echo $data['meas'];?></td>
                                        <td rowspan="2" style="text-align: center;"><?php foreach (subtotalNW() as $key) { echo $key[0]; }?></td>
                                        <td rowspan="2" style="text-align: center;"><?php foreach (subtotalGW() as $key) { echo $key[0]; }?></td>
                                        <?php $allSize = getSize1();?>
                                        <?php foreach ($allSize as $dataSize) { ?>
                                        <td colspan="1" style="vertical-align: middle; text-align: center;"><?php echo $dataSize['size']+0;?></td><?php } ?>
                                        <td rowspan="2" style="text-align: center;"><?php echo $data['ctn_no'];?></td>
                                        <td rowspan="2" style="text-align: center;"><?php echo $data['no_ctn'];?></td>
                                        <td rowspan="2" style="text-align: center;"><?php echo $data['prs_ctn'];?></td>
                                    </tr>
                                    <tr>
                                        <?php $allSize = getSize1();?>
                                        <?php foreach ($allSize as $dataSize) { ?>
                                        <td style="text-align: center;"><?php echo $dataSize['packing_metode1'];?></td><?php } ?>
                                    </tr>
                                </tbody>
                                <?php
                                    }
                                }   
                                ?>
                                <tfoot>
                                    <tr>
                                        <?php $totalsize = count($allSize) + 11; ?>
                                        <th colspan="<?php echo $totalsize; ?>" style="text-align: center;">Total</th>
                                        <th style="text-align: center;"><?php echo $total ?></th>
                                        <th style="text-align: center;"></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <br>
                            <span style="font-weight:bolder; font-size : 12px;">Remark :</span><br>
                            <span style="font-weight:bolder; font-size : 12px;">1. Tolong lihat data di atas untuk menempel Shipping mark</span><br>
                            <span style="font-weight:bolder; font-size : 12px;">2. Tempel Main Mark di 2 Sisi Panjang </span><br>
                            <span style="font-weight:bolder; font-size : 12px;">3. Tempel Side Mark di 2 Sisi Pendek</span>
                        </div>
                        <br><br><br><br><br><br>
                        <?php $waktu = date('m/d/Y'); ?>
                        <table style="font-size : 12px;">
                            <thead>
                                <tr>
                                    <th>Producer : Ratih <?php echo $waktu ?></th>
                                    <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
                                    <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
                                    <th>Verify : .................</th>
                                    <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
                                    <th>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</th>
                                    <th>Approved : ................</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                </div>
                <!-- /.container-fluid -->
                </div>
            <!-- End of Main Content -->
        <script>
            window.print();
        </script>

</body>

</html>