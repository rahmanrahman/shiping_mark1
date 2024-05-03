<?php
    include_once 'layout/header.php';
    require_once 'functions/koneksi.php';
    require 'functions/function_packing_list.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div style="font-size : 11px;" class="card-body">
        <form method="POST">
        <?php
            if (isset($_GET['id_summary'])) {
            $id_summary=trim($_GET['id_summary']);
            $shipMark = mysqli_query($conn, "SELECT * FROM tb_packing_list a
                                    LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                    LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                    LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                    LEFT JOIN tb_master e ON d.sku = e.sku
                                    WHERE d.id_summary='$id_summary' GROUP BY d.man_po ORDER BY d.id_summary");
            while ($data = mysqli_fetch_array($shipMark)) {
        ?>
            <div class="table-responsive">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="order[]" id="inlineRadio1" value="<?php echo $data['man_po'];?>" required>
                    <label class="form-check-label" for="inlineRadio1">Man Po</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="order[]" id="inlineRadio2" value="<?php echo $data['cust_po'];?>" required>
                    <label class="form-check-label" for="inlineRadio2">Customer Po</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="order[]" id="inlineRadio2" value="<?php echo $data['po_referance'];?>" required>
                    <label class="form-check-label" for="inlineRadio2">Po Referance</label>
                </div>
            </div>
            <?php }
            } ?>
            <br>
            <button type="submit" name="simpan" value="Simpan" tyle="font-size: 12px;" class="btn btn-primary btn-sm">Pilih</button>
        </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>PACKING LIST / SHIPPING MARK</center></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Cust Id</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Factory Code</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Order No</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Style No</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Color</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Width</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Carton Code</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Meas</th>
                            <th colspan="2" style="text-align: center;">NW/GW(kgs)</th>
                            <th colspan="<?php foreach (countData() as $key) { echo $key[0]; }?>" style="vertical-align: middle; text-align: center;">Size</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Carton Number</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">total Carton</th>
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
                            if (isset($_GET['id_summary'])) {
                                $id_summary=trim($_GET['id_summary']);
                                
                                $shipMark = mysqli_query($conn, "SELECT * FROM tb_packing_list a
                                                                LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                LEFT JOIN tb_master e ON d.sku = e.sku
                                                                WHERE d.id_summary='$id_summary' ORDER BY b.nw DESC limit 1");
                            while ($data = mysqli_fetch_array($shipMark)) {
                            $negara = $data['cust_id'];
                            
                        ?>
                        <tr>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['cust_id'];?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['factory_code'];?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php if (isset($_POST['simpan'])){
                                                            foreach ($_POST['order'] as $value) {
                                                                    echo $value; }
                                                            } ?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php 
                                                                                                    if(substr($data['sku'],-3) == 'NEW'){
                                                                                                        echo substr($data['sku'],0,-4);
                                                                                                    }elseif(substr($data['sku'],-4) == '(PE)') {
                                                                                                        echo substr($data['sku'],0,-5);
                                                                                                    }else{
                                                                                                        echo $data['sku'];
                                                                                                    } ?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['color'];?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['widht'];?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['carton_code'];?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php 
                                                                                                    if($data['carton_code'] == "NBL1-MZ"){ echo "0.445MX0.330MX0.200M=0.029 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL1.5-MZ"){ echo "0.510MX0.380MX0.230M=0.045 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL2-MZ"){ echo "0.560MX0.420MX0.260M=0.061 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL3-MZ"){ echo "0.583MX0.430MX0.287M=0.072 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL4-MZ"){ echo "0.563MX0.490MX0.325M=0.09 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL5-MZ"){ echo "0.560MX0.520MX0.340M=0.099 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL6-MZ"){ echo "0.614MX0.496MX0.340M=0.104 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL6.5-MZ"){ echo "0.644MX0.536MX0.345M=0.119 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL7-MZ"){ echo "0.690MX0.540MX0.360M=0.134 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL8-MZ"){ echo "0.745MX0.560MX0.390M=0.163 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL8.5-MZ"){ echo "0.865MX0.563MX0.410M=0.2 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL9-MZ"){ echo "0.923MX0.573MX0.430M=0.227 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA1-MX"){ echo "0.300MX0.255MX0.205M=0.016 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA1.5-MX"){ echo "0.345MX0.285MX0.230M=0.023 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA2-MX"){ echo "0.375MX0.315MX0.260M=0.031 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA3-MX"){ echo "0.390MX0.325MX0.287M=0.036 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA4-MX"){ echo "0.375MX0.370MX0.325M=0.045 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA5-MX"){ echo "0.390MX0.385MX0.340M=0.051 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA6-MX"){ echo "0.407MX0.376MX0.340M=0.052 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA6.5-MX"){ echo "0.427MX0.405MX0.345M=0.06 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA7-MX"){ echo "0.477MX0.417MX0.365M=0.073 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA8-MX"){ echo "0.495MX0.425MX0.390M=0.082 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA8.5-MX"){ echo "0.567MX0.440MX0.405M=0.101 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBLA9-MX"){ echo "0.620MX0.450MX0.430M=0.12 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL1-MQ"){ echo "0.450MX0.255MX0.205M=0.024 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL1.5-MQ"){ echo "0.510MX0.285MX0.230M=0.033 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL2-MQ"){ echo "0.560MX0.315MX0.260M=0.046 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL3-MQ"){ echo "0.583MX0.325MX0.287M=0.054 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL4-MQ"){ echo "0.563MX0.370MX0.325M=0.068 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL5-MQ"){ echo "0.560MX0.390MX0.340M=0.074 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL6-MQ"){ echo "0.614MX0.376MX0.340M=0.078 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL6.5-MQ"){ echo "0.644MX0.405MX0.345M=0.09 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL7-MQ"){ echo "0.708MX0.417MX0.365M=0.108 CUMTRS";}
                                                                                                    elseif($data['carton_code'] == "NBL8-MQ"){ echo "0.745MX0.425MX0.390M=0.123 CUMTRS";}
                                                                                                    else{ echo "0.855MX0.428MX0.400M=0.146 CUMTRS";}
                                                                                                ?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php foreach (subtotalNW() as $key) { echo $key[0]; }?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php foreach (subtotalGW() as $key) { echo $key[0]; }?></td>
                            <?php $allSize = getSize1();?>
                            <?php foreach ($allSize as $dataSize) { ?>
                            <td colspan="1" style="vertical-align: middle; text-align: center;"><?php echo $dataSize['size']+0;?></td><?php } ?>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['ctn_no'];?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['no_ctn'];?></td>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['prs_ctn'];?></td>
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
                </table>
                <?php 
                    if (@!$value){
                        ?>
                        <button class="btn btn-success btn-sm" disabled>EXCEL</button>
                        <button class="btn btn-info btn-sm" disabled>PRINT SUMMARY</button>
                    <?php }else{
                        ?>
                        <a href="excel_shipping_prepack.php?id_summary=<?php echo $_GET['id_summary']; ?>&po=<?php echo $value;?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
                        <a href="print_shipping_prepack.php?id_summary=<?php echo $_GET['id_summary']; ?>&po=<?php echo $value;?>" type="button" target="_BLANK" class="btn btn-info btn-sm">PRINT SUMMARY</a>
                    <?php }
                ?>
                <br><br> 
                        <a href="print_prepack_indonesiaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                        <a href="print_prepack.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_prepack_indonesiaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="printA5_prepack.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
?>