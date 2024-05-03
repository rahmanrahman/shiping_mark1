<?php
    include_once 'layout/header.php';
    require_once 'functions/koneksi.php';
    require 'functions/function_output.php';
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
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Size</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Carton Number</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">total Carton</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Pairs</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">NW</th>
                            <th style="text-align: center;">GW</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="12" style="text-align: center;">Total</th>
                            <th style="text-align: center;"><?php foreach (prs() as $key) { echo $key[0]; }?></th>
                            <th style="text-align: center;"></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            if (isset($_GET['id_summary'])) {
                                $id_summary=trim($_GET['id_summary']);
                                
                                $shipMark = mysqli_query($conn, "SELECT * FROM tb_packing_list a
                                                                LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                LEFT JOIN tb_master e ON d.sku = e.sku
                                                                WHERE d.id_summary='$id_summary' ORDER BY d.id_summary");
                            while ($data = mysqli_fetch_array($shipMark)) {
                            $negara = $data['cust_id'];
                            $destination = $data['destination'];
                        ?>
                        <tr>
                            <td style="text-align: center;"><?= $data['cust_id'];?></td>
                            <td style="text-align: center;"><?= $data['factory_code'];?></td>
                            <td style="text-align: center;"><?php if (isset($_POST['simpan'])){
                                                            foreach ($_POST['order'] as $value) {
                                                                    echo $value; }
                                                            } ?></td>
                            <td style="text-align: center;"><?php 
                                                                if(substr($data['sku'],-3) == 'NEW'){
                                                                    echo substr($data['sku'],0,-4);
                                                                }elseif(substr($data['sku'],-4) == '(PE)') {
                                                                    echo substr($data['sku'],0,-5);
                                                                }else{
                                                                    echo $data['sku'];
                                                                } ?></td>
                            <td style="text-align: center;"><?= $data['color'];?></td>
                            <td style="text-align: center;"><?= $data['widht'];?></td>
                            <td style="text-align: center;"><?php if($data['factory_code'] == 'N11NB0297' || $data['factory_code'] == 'N11NB0298'){
                                                                    echo 'NBLA6.5-MX';
                                                                }else{
                                                                    echo $data['carton_code'];
                                                                }?></td>
                            <td style="text-align: center;"><?php 
                                                                if($data['cust_id'] == "CHILE" || $data['cust_id'] == "PERU" || $data['cust_id'] == "INDONESIA" || $data['cust_id'] == "SERBIA" || $data['cust_id'] == "URUGUAY"){
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
                                                                }elseif($data['cust_id'] == 'PAKISTAN'){
                                                                    if($data['carton_code'] == "NBL1-MZ"){ echo "44.5CMX33CMX20CM";}
                                                                    elseif($data['carton_code'] == "NBL1.5-MZ"){ echo "51CMX38CMX23CM";}
                                                                    elseif($data['carton_code'] == "NBL2-MZ"){ echo "56CMX42CMX26CM";}
                                                                    elseif($data['carton_code'] == "NBL3-MZ"){ echo "58.3CMX43CMX28.7CM";}
                                                                    elseif($data['carton_code'] == "NBL4-MZ"){ echo "56.3CMX49CMX32.5CM";}
                                                                    elseif($data['carton_code'] == "NBL5-MZ"){ echo "56CMX52CMX34CM";}
                                                                    elseif($data['carton_code'] == "NBL6-MZ"){ echo "61.4CMX49.6CMX34CM";}
                                                                    elseif($data['carton_code'] == "NBL6.5-MZ"){ echo "64.4CMX53.6CMX34.5CM";}
                                                                    elseif($data['carton_code'] == "NBL7-MZ"){ echo "69CMX54CMX36CM";}
                                                                    elseif($data['carton_code'] == "NBL8-MZ"){ echo "74.5CMX56CMX39CM";}
                                                                    elseif($data['carton_code'] == "NBL8.5-MZ"){ echo "86.5CMX56.3CMX41CM";}
                                                                    elseif($data['carton_code'] == "NBL9-MZ"){ echo "92.3CMX57.3CMX43CM";}
                                                                    elseif($data['carton_code'] == "NBLA1-MX"){ echo "30CMX25.5CMX20.5CM";}
                                                                    elseif($data['carton_code'] == "NBLA1.5-MX"){ echo "34.5CMX28.5CMX23CM";}
                                                                    elseif($data['carton_code'] == "NBLA2-MX"){ echo "37.5CMX31.5CMX26CM";}
                                                                    elseif($data['carton_code'] == "NBLA3-MX"){ echo "39CMX32.5CMX28.7CM";}
                                                                    elseif($data['carton_code'] == "NBLA4-MX"){ echo "37.5CMX37CMX32.5CM";}
                                                                    elseif($data['carton_code'] == "NBLA5-MX"){ echo "39CMX38.5CMX34CM";}
                                                                    elseif($data['carton_code'] == "NBLA6-MX"){ echo "40.7CMX37.6CMX34CM";}
                                                                    elseif($data['carton_code'] == "NBLA6.5-MX"){ echo "42.7CMX40.5CMX34.5CM";}
                                                                    elseif($data['carton_code'] == "NBLA7-MX"){ echo "47.7CMX41.7CMX36.5CM";}
                                                                    elseif($data['carton_code'] == "NBLA8-MX"){ echo "49.5CMX42.5CMX39CM";}
                                                                    elseif($data['carton_code'] == "NBLA8.5-MX"){ echo "56.7CMX44CMX40.5CM";}
                                                                    elseif($data['carton_code'] == "NBLA9-MX"){ echo "62CMX45CMX43CM";}
                                                                    elseif($data['carton_code'] == "NBL1-MQ"){ echo "45CMX25.5CMX20.5CM";}
                                                                    elseif($data['carton_code'] == "NBL1.5-MQ"){ echo "51CMX28.5CMX23CM";}
                                                                    elseif($data['carton_code'] == "NBL2-MQ"){ echo "56CMX31.5CMX26CM";}
                                                                    elseif($data['carton_code'] == "NBL3-MQ"){ echo "58.3CMX32.5CMX28.7CM";}
                                                                    elseif($data['carton_code'] == "NBL4-MQ"){ echo "56.3CMX37CMX32.5CM";}
                                                                    elseif($data['carton_code'] == "NBL5-MQ"){ echo "56CMX39CMX34CM";}
                                                                    elseif($data['carton_code'] == "NBL6-MQ"){ echo "61.4CMX37.6CMX34CM";}
                                                                    elseif($data['carton_code'] == "NBL6.5-MQ"){ echo "64.4CMX40.5CMX34.5CM";}
                                                                    elseif($data['carton_code'] == "NBL7-MQ"){ echo "70.8CMX41.7CMX36.5CM";}
                                                                    elseif($data['carton_code'] == "NBL8-MQ"){ echo "74.5CMX42.5CMX39CM";}
                                                                    else{ echo "85.5CMX42.8CMX40CM";}
                                                                }elseif($data['cust_id'] == "SINGAPORE"){
                                                                    if($destination == "New Balance Singapore Pte Ltd"){
                                                                        echo $data['meas_carton'];
                                                                    }else{
                                                                        echo $data['meas'];
                                                                    }
                                                                }elseif($data['factory_code'] == 'N11NB0297' || $data['factory_code'] == 'N11NB0298'){
                                                                    echo '16.8IN*15.9IN*13.6IN=2.11';
                                                                }else{
                                                                    echo $data['meas'];
                                                                } ?></td>
                            <td style="text-align: center;"><?php echo $data['nw'];?></td>
                            <td style="text-align: center;"><?php echo $data['gw'];?></td>
                            <td style="text-align: center;"><?php echo $data['size']+0;?></td>
                            <td style="text-align: center;"><?php echo $data['ctn_no'];?></td>
                            <td style="text-align: center;"><?php echo $data['no_ctn'];?></td>
                            <td style="text-align: center;"><?php echo $data['packing_metode'];?></td>
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
                        <a href="excel_shipping_mark.php?id_summary=<?php echo $_GET['id_summary']; ?>&po=<?php echo $value;?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
                        <a href="print_shipping_mark.php?id_summary=<?php echo $_GET['id_summary']; ?>&po=<?php echo $value;?>" type="button" target="_BLANK" class="btn btn-info btn-sm">PRINT SUMMARY</a>
                    <?php }
                ?>
                <br><br>                
                <?php 
                    if ($negara == "BRAZIL"){
                        ?>
                        <a href="print_side_brazilA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                        <a href="print_main_brazilA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_side_brazilA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_brazilA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "ARGENTINA"){
                        ?>
                        <a href="print_shipping_argenA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SHIPPING A4</a>
                        <a href="print_shipping_argenA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SHIPPING A5</a>
                    <?php }elseif($negara == "CHILE"){
                        ?>
                        <a href="print_side_chileA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_chileA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "PERU"){
                            if($destination == "KS DEPOR S.A."){ ?>
                                <a href="print_side_peruA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                                <a href="print_side_peruA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                                <a href="print_main_peruA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                                <a href="print_main_peruA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                            <?php }else{ ?>
                                <a href="print_side_peruA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                                <a href="print_main_peruA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                            <?php } ?>
                    <?php }elseif($negara == "CHINA"){
                            if($destination == "New Balance UAE c/o"){ ?>
                                <a href="print.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SHIPPING A4</a>
                                <a href="printA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SHIPPING A5</a>
                            <?php }else{ ?>
                                <a href="print_shipping_chinaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SHIPPING A4</a>
                                <a href="print_shipping_chinaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SHIPPING A5</a>
                            <?php }
                        ?>
                    <?php }elseif($negara == "DENMARK"){
                        ?>
                        <button class="btn btn-warning btn-sm" disabled>SIDE MARK A4</button>
                        <button class="btn btn-warning btn-sm" disabled>MAIN MARK A4</button>
                        <button class="btn btn-warning btn-sm" disabled>SIDE MARK A5</button>
                        <button class="btn btn-warning btn-sm" disabled>MAIN MARK A5</button>
                    <?php }elseif($negara == "HONG KONG"){
                        ?>
                        <a href="print_side_hongkongA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                        <a href="print_main_hongkongA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_side_hongkongA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_hongkongA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "INDONESIA"){
                        ?>
                        <a href="print_side_indonesiaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                        <a href="print_main_indonesiaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_side_indonesiaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_indonesiaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "NEW ZEALAND"){
                        ?>
                        <a href="print_side_newA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                        <a href="print_main_newA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_side_newA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_newA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "PAKISTAN"){
                        ?>
                        <a href="print_side_pakistanA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                        <a href="print_main_pakistanA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_side_pakistanA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_pakistanA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "PARAGUAY"){
                        ?>
                        <a href="print_side_paraguayA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_paraguayA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "PHILIPPINES"){
                        ?>
                        <a href="print_side_philipA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                        <a href="print_main_philipA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_side_philipA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_philipA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "RUSSIAN"){
                        ?>
                        <a href="print_main_russianA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_main_russianA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "SERBIA"){
                        ?>
                        <a href="print_side_serbiaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                        <a href="print_main_serbiaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_side_serbiaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_serbiaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "TAIWAN"){
                        ?>
                        <a href="print_side_taiwanA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                        <a href="print_main_taiwanA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_side_taiwanA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_taiwanA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "THAILAND"){
                            if($destination == "MAP ACTIVE ADIPERKASA LTD"){ ?>
                                <a href="print_main_thailandmapA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                                <a href="print_main_thailandmapA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                            <?php }elseif($destination == "JD Thailand (For Malaysia)"){ ?>
                                <a href="print.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SOLID A4</a>
                                <a href="printA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-warning btn-sm">PRINT SOLID A5</a>
                            <?php }else{ ?>
                                <a href="print_side_thailandA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                                <a href="print_main_thailandA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                                <a href="print_side_thailandA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                                <a href="print_main_thailandA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                            <?php } ?>
                    <?php }elseif($negara == "UKRAINE"){
                        ?>
                        <a href="print_main_ukraineA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_main_ukraineA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "URUGUAY"){
                        ?>
                        <a href="print_side_uruguayA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                        <a href="print_main_uruguayA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_side_uruguayA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <a href="print_main_uruguayA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "UNITED STATES"){
                        ?>
                        <a href="print_main_usaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_main_usaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "KAZAKHSTAN"){
                        ?>
                        <a href="print_main_kazakA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_main_kazakA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-warning btn-sm">PRINT MAIN MARK A5</a>
                    <?php }elseif($negara == "SINGAPORE"){
                            if($destination == "New Balance Singapore Pte Ltd" || $destination == "New Balance Singapore Pte Ltd c/o"){ ?>
                                <a href="print_main_singaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                                <a href="print_side_singaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                                <a href="print_main_singaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-warning btn-sm">PRINT MAIN MARK A5</a>
                                <a href="print_side_singaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-warning btn-sm">PRINT SIDE MARK A5</a>
                            <?php }else{ ?>
                                <a href="print.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SOLID A4</a>
                                <a href="printA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-warning btn-sm">PRINT SOLID A5</a>
                            <?php }?>
                    <?php }else{
                        ?>
                        <a href="print.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SOLID A4</a>
                        <a href="printA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-warning btn-sm">PRINT SOLID A5</a>
                    <?php }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
?>