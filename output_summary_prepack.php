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
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['cust_id'];?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['factory_code'];?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php if (isset($_POST['simpan'])){
                                                            foreach ($_POST['order'] as $value) {
                                                                    echo $value; }
                                                            } ?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php 
                                                                                                    if(substr($data['sku'],-3) == 'NEW'){
                                                                                                        echo substr($data['sku'],0,-4);
                                                                                                    }elseif(substr($data['sku'],-4) == '(PE)') {
                                                                                                        echo substr($data['sku'],0,-5);
                                                                                                    }else{
                                                                                                        echo $data['sku'];
                                                                                                    } ?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['color'];?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['widht'];?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['carton_code'];?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['meas'];?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php foreach (subtotalNW() as $key) { echo $key[0]; }?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php foreach (subtotalGW() as $key) { echo $key[0]; }?></td>
                            <?php $allSize = getSize1();?>
                            <?php foreach ($allSize as $dataSize) { ?>
                            <td colspan="1" style="vertical-align: middle; text-align: center;"><?php echo $dataSize['size']+0;?></td><?php } ?>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['ctn_no'];?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['no_ctn'];?></td>
                            <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['prs_ctn'];?></td>
                        </tr>
                        <tr>
                            <?php $allSize = getSize1();?>
                            <?php foreach ($allSize as $dataSize) { ?>
                            <td style="text-align: center;"><?php
                                                                if($dataSize['cust_id'] == "TURKEY"){
                                                                    if($dataSize["gender"] == "Men"){
                                                                        if($dataSize["size"] == "3.00"){ echo "35";}
                                                                        elseif($dataSize["size"] == "3.00"){ echo "35";}
                                                                        elseif($dataSize["size"] == "3.50"){ echo "35.5";}
                                                                        elseif($dataSize["size"] == "4.00"){ echo "36";}
                                                                        elseif($dataSize["size"] == "4.50"){ echo "37";}
                                                                        elseif($dataSize["size"] == "5.00"){ echo "37.5";}
                                                                        elseif($dataSize["size"] == "5.50"){ echo "38";}
                                                                        elseif($dataSize["size"] == "6.00"){ echo "38.5";}
                                                                        elseif($dataSize["size"] == "6.50"){ echo "39.5";}
                                                                        elseif($dataSize["size"] == "7.00"){ echo "40";}
                                                                        elseif($dataSize["size"] == "7.50"){ echo "40.5";}
                                                                        elseif($dataSize["size"] == "8.00"){ echo "41.5";}
                                                                        elseif($dataSize["size"] == "8.50"){ echo "42";}
                                                                        elseif($dataSize["size"] == "9.00"){ echo "42.5";}
                                                                        elseif($dataSize["size"] == "9.50"){ echo "43";}
                                                                        elseif($dataSize["size"] == "10.00"){ echo "44";}
                                                                        elseif($dataSize["size"] == "10.50"){ echo "44.5";}
                                                                        elseif($dataSize["size"] == "11.00"){ echo "45";}
                                                                        elseif($dataSize["size"] == "11.50"){ echo "45.5";}
                                                                        elseif($dataSize["size"] == "12.00"){ echo "46.5";}
                                                                        elseif($dataSize["size"] == "12.50"){ echo "47";}
                                                                        elseif($dataSize["size"] == "13.00"){ echo "47.5";}
                                                                        elseif($dataSize["size"] == "14.00"){ echo "49";}
                                                                        elseif($dataSize["size"] == "15.00"){ echo "50";}
                                                                        elseif($dataSize["size"] == "16.00"){ echo "51";}
                                                                        elseif($dataSize["size"] == "17.00"){ echo "52";}
                                                                        else{ echo "53";}
                                                                    }elseif($dataSize["gender"] == "Women"){
                                                                        if($dataSize["size"] == "5.00"){ echo "35";}
                                                                        elseif($dataSize["size"] == "5.50"){ echo "36";}
                                                                        elseif($dataSize["size"] == "6.00"){ echo "36.5";}
                                                                        elseif($dataSize["size"] == "6.50"){ echo "37";}
                                                                        elseif($dataSize["size"] == "7.00"){ echo "37.5";}
                                                                        elseif($dataSize["size"] == "7.50"){ echo "38";}
                                                                        elseif($dataSize["size"] == "8.00"){ echo "39";}
                                                                        elseif($dataSize["size"] == "8.50"){ echo "40";}
                                                                        elseif($dataSize["size"] == "9.00"){ echo "40.5";}
                                                                        elseif($dataSize["size"] == "9.50"){ echo "41";}
                                                                        elseif($dataSize["size"] == "10.00"){ echo "41.5";}
                                                                        elseif($dataSize["size"] == "10.50"){ echo "42.5";}
                                                                        elseif($dataSize["size"] == "11.00"){ echo "43";}
                                                                        elseif($dataSize["size"] == "11.50"){ echo "43.5";}
                                                                        elseif($dataSize["size"] == "12.00"){ echo "44";}
                                                                        elseif($dataSize["size"] == "12.50"){ echo "45";}
                                                                        else{ echo "45.5";}
                                                                    }elseif($dataSize["gender"] == "Infant"){
                                                                        if($dataSize["size"] == "2.00"){ echo "17";}
                                                                        elseif($dataSize["size"] == "2.50"){ echo "18";}
                                                                        elseif($dataSize["size"] == "3.00"){ echo "18.5";}
                                                                        elseif($dataSize["size"] == "3.50"){ echo "19";}
                                                                        elseif($dataSize["size"] == "4.00"){ echo "20";}
                                                                        elseif($dataSize["size"] == "4.50"){ echo "20.5";}
                                                                        elseif($dataSize["size"] == "5.00"){ echo "21";}
                                                                        elseif($dataSize["size"] == "5.50"){ echo "21.5";}
                                                                        elseif($dataSize["size"] == "6.00"){ echo "22.5";}
                                                                        elseif($dataSize["size"] == "6.50"){ echo "23";}
                                                                        elseif($dataSize["size"] == "7.00"){ echo "23.5";}
                                                                        elseif($dataSize["size"] == "7.50"){ echo "24";}
                                                                        elseif($dataSize["size"] == "8.00"){ echo "25";}
                                                                        elseif($dataSize["size"] == "8.50"){ echo "25.5";}
                                                                        elseif($dataSize["size"] == "9.00"){ echo "26";}
                                                                        elseif($dataSize["size"] == "9.50"){ echo "26.5";}
                                                                        else{ echo "27.5";}
                                                                    }else{
                                                                        if($dataSize["size"] == "10.50"){ echo "28";}
                                                                        elseif($dataSize["size"] == "11.00"){ echo "28.5";}
                                                                        elseif($dataSize["size"] == "11.50"){ echo "29";}
                                                                        elseif($dataSize["size"] == "12.00"){ echo "30";}
                                                                        elseif($dataSize["size"] == "12.50"){ echo "30.5";}
                                                                        elseif($dataSize["size"] == "13.00"){ echo "31";}
                                                                        elseif($dataSize["size"] == "13.50"){ echo "32";}
                                                                        elseif($dataSize["size"] == "1.00"){ echo "32.5";}
                                                                        elseif($dataSize["size"] == "1.50"){ echo "33";}
                                                                        elseif($dataSize["size"] == "2.00"){ echo "33.5";}
                                                                        elseif($dataSize["size"] == "2.50"){ echo "34.5";}
                                                                        elseif($dataSize["size"] == "3.00"){ echo "35";}
                                                                        elseif($dataSize["size"] == "3.50"){ echo "35.5";}
                                                                        elseif($dataSize["size"] == "4.00"){ echo "36";}
                                                                        elseif($dataSize["size"] == "4.50"){ echo "37";}
                                                                        elseif($dataSize["size"] == "5.00"){ echo "37.5";}
                                                                        elseif($dataSize["size"] == "5.50"){ echo "38";}
                                                                        elseif($dataSize["size"] == "6.00"){ echo "38.5";}
                                                                        elseif($dataSize["size"] == "6.50"){ echo "39";}
                                                                        else{ echo "40";}
                                                                    }
                                                                }else{
                                                                    echo "0";
                                                                }
                                                                ?></td><?php } ?>
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
                        <a href="excel_summary_prepack.php?id_summary=<?php echo $_GET['id_summary']; ?>&po=<?php echo $value;?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
                        <a href="print_summary_prepack.php?id_summary=<?php echo $_GET['id_summary']; ?>&po=<?php echo $value;?>" type="button" target="_BLANK" class="btn btn-info btn-sm">PRINT SUMMARY</a>
                    <?php }
                ?>
                <br>
                <br>   
                    <a href="print_main_turkeyA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                    <a href="print_main_turkeyA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
?>