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
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">US Size</th>
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
                            <th colspan="13" style="text-align: center;">Total</th>
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
                            $kategori = $data['category'];
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data['cust_id'];?></td>
                            <td style="text-align: center;"><?php echo $data['factory_code'];?></td>
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
                            <td style="text-align: center;"><?php echo $data['color'];?></td>
                            <td style="text-align: center;"><?php echo $data['widht'];?></td>
                            <td style="text-align: center;"><?php echo $data['carton_code'];?></td>
                            <td style="text-align: center;"><?php
                                                                if($data['cust_id'] == "KOREA, REPUBLIC OF"){
                                                                    if($data['carton_code'] == "NBL1-MZ"){ echo "445X330X200MM";}
                                                                    elseif($data['carton_code'] == "NBL1.5-MZ"){ echo "510X380X230MM";}
                                                                    elseif($data['carton_code'] == "NBL2-MZ"){ echo "560X420X260MM";}
                                                                    elseif($data['carton_code'] == "NBL3-MZ"){ echo "583X430X287MM";}
                                                                    elseif($data['carton_code'] == "NBL4-MZ"){ echo "563X490X325MM";}
                                                                    elseif($data['carton_code'] == "NBL5-MZ"){ echo "560X520X340MM";}
                                                                    elseif($data['carton_code'] == "NBL6-MZ"){ echo "614X496X340MM";}
                                                                    elseif($data['carton_code'] == "NBL6.5-MZ"){ echo "644X536X345MM";}
                                                                    elseif($data['carton_code'] == "NBL7-MZ"){ echo "690X540X360MM";}
                                                                    elseif($data['carton_code'] == "NBL8-MZ"){ echo "745X560X390MM";}
                                                                    elseif($data['carton_code'] == "NBL8.5-MZ"){ echo "865X563X410MM";}
                                                                    elseif($data['carton_code'] == "NBL9-MZ"){ echo "923X573X430MM";}
                                                                    elseif($data['carton_code'] == "NBLA1-MX"){ echo "300X255X205MM";}
                                                                    elseif($data['carton_code'] == "NBLA1.5-MX"){ echo "345X285X230MM";}
                                                                    elseif($data['carton_code'] == "NBLA2-MX"){ echo "375X315X260MM";}
                                                                    elseif($data['carton_code'] == "NBLA3-MX"){ echo "390X325X287MM";}
                                                                    elseif($data['carton_code'] == "NBLA4-MX"){ echo "375X370X325MM";}
                                                                    elseif($data['carton_code'] == "NBLA5-MX"){ echo "390X385X340MM";}
                                                                    elseif($data['carton_code'] == "NBLA6-MX"){ echo "407X376X340MM";}
                                                                    elseif($data['carton_code'] == "NBLA6.5-MX"){ echo "427X405X345MM";}
                                                                    elseif($data['carton_code'] == "NBLA7-MX"){ echo "477X417X365MM";}
                                                                    elseif($data['carton_code'] == "NBLA8-MX"){ echo "495X425X390MM";}
                                                                    elseif($data['carton_code'] == "NBLA8.5-MX"){ echo "567X440X405MM";}
                                                                    elseif($data['carton_code'] == "NBLA9-MX"){ echo "620X450X430MM";}
                                                                    elseif($data['carton_code'] == "NBL1-MQ"){ echo "450X255X205MM";}
                                                                    elseif($data['carton_code'] == "NBL1.5-MQ"){ echo "510X285X230MM";}
                                                                    elseif($data['carton_code'] == "NBL2-MQ"){ echo "560X315X260MM";}
                                                                    elseif($data['carton_code'] == "NBL3-MQ"){ echo "583X325X287MM";}
                                                                    elseif($data['carton_code'] == "NBL4-MQ"){ echo "563X370X325MM";}
                                                                    elseif($data['carton_code'] == "NBL5-MQ"){ echo "560X390X340MM";}
                                                                    elseif($data['carton_code'] == "NBL6-MQ"){ echo "614X376X340MM";}
                                                                    elseif($data['carton_code'] == "NBL6.5-MQ"){ echo "644X405X345MM";}
                                                                    elseif($data['carton_code'] == "NBL7-MQ"){ echo "708X417X365MM";}
                                                                    elseif($data['carton_code'] == "NBL8-MQ"){ echo "745X425X390MM";}
                                                                    else{ echo "855X428X400MM";}
                                                                }else{
                                                                    echo $data['meas'];
                                                                } ?></td>
                            <td style="text-align: center;"><?php echo $data['nw'];?></td>
                            <td style="text-align: center;"><?php echo $data['gw'];?></td>
                            <td style="text-align: center;"><?php echo $data['size']+0;?></td>
                            <td style="text-align: center;"><?php 
                                                                if($data['cust_id'] == "MEXICO"){
                                                                    if($data["gender"] == "Men"){
                                                                        if($data["size"] == "4.00"){ echo "22";}
                                                                        elseif($data["size"] == "4.50"){ echo "22.5";}
                                                                        elseif($data["size"] == "5.00"){ echo "23";}
                                                                        elseif($data["size"] == "5.50"){ echo "23.5";}
                                                                        elseif($data["size"] == "6.00"){ echo "24";}
                                                                        elseif($data["size"] == "6.50"){ echo "24.5";}
                                                                        elseif($data["size"] == "7.00"){ echo "25";}
                                                                        elseif($data["size"] == "7.50"){ echo "25.5";}
                                                                        elseif($data["size"] == "8.00"){ echo "26";}
                                                                        elseif($data["size"] == "8.50"){ echo "26.5";}
                                                                        elseif($data["size"] == "9.00"){ echo "27";}
                                                                        elseif($data["size"] == "9.50"){ echo "27.5";}
                                                                        elseif($data["size"] == "10.00"){ echo "28";}
                                                                        elseif($data["size"] == "10.50"){ echo "28.5";}
                                                                        elseif($data["size"] == "11.00"){ echo "29";}
                                                                        elseif($data["size"] == "11.50"){ echo "29.5";}
                                                                        elseif($data["size"] == "12.00"){ echo "30";}
                                                                        elseif($data["size"] == "12.50"){ echo "30.5";}
                                                                        elseif($data["size"] == "13.00"){ echo "31";}
                                                                        elseif($data["size"] == "14.00"){ echo "32";}
                                                                        else{ echo "33";}
                                                                    }elseif($data["gender"] == "Women" ){
                                                                        if($data["size"] == "4.50"){ echo "21.5";}
                                                                        elseif($data["size"] == "5.00"){ echo "22";}
                                                                        elseif($data["size"] == "5.50"){ echo "22.5";}
                                                                        elseif($data["size"] == "6.00"){ echo "23";}
                                                                        elseif($data["size"] == "6.50"){ echo "23.5";}
                                                                        elseif($data["size"] == "7.00"){ echo "24";}
                                                                        elseif($data["size"] == "7.50"){ echo "24.5";}
                                                                        elseif($data["size"] == "8.00"){ echo "25";}
                                                                        elseif($data["size"] == "8.50"){ echo "25.5";}
                                                                        elseif($data["size"] == "9.00"){ echo "26";}
                                                                        elseif($data["size"] == "9.50"){ echo "26.5";}
                                                                        elseif($data["size"] == "10.00"){ echo "27";}
                                                                        elseif($data["size"] == "10.50"){ echo "27.5";}
                                                                        elseif($data["size"] == "11.00"){ echo "28";}
                                                                        elseif($data["size"] == "11.50"){ echo "28.5";}
                                                                        else{ echo "29";}
                                                                    }elseif($data["gender"] == "Infant"){
                                                                        if($data["size"] == "3.00"){ echo "10";}
                                                                        elseif($data["size"] == "4.00"){ echo "11";}
                                                                        elseif($data["size"] == "4.50"){ echo "11.5";}
                                                                        elseif($data["size"] == "5.00"){ echo "12";}
                                                                        elseif($data["size"] == "5.50"){ echo "12";}
                                                                        elseif($data["size"] == "6.00"){ echo "12.5";}
                                                                        elseif($data["size"] == "6.50"){ echo "13";}
                                                                        elseif($data["size"] == "7.00"){ echo "13.5";}
                                                                        elseif($data["size"] == "8.00"){ echo "14.5";}
                                                                        elseif($data["size"] == "8.50"){ echo "15";}
                                                                        elseif($data["size"] == "9.00"){ echo "15";}
                                                                        elseif($data["size"] == "9.50"){ echo "15.5";}
                                                                        else{ echo "16";}
                                                                    }else{
                                                                        if($data["size"] == "10.50"){ echo "16.5";}
                                                                        elseif($data["size"] == "11.00"){ echo "17";}
                                                                        elseif($data["size"] == "11.50"){ echo "17.5";}
                                                                        elseif($data["size"] == "12.00"){ echo "17.5";}
                                                                        elseif($data["size"] == "12.50"){ echo "18";}
                                                                        elseif($data["size"] == "13.00"){ echo "18.5";}
                                                                        elseif($data["size"] == "13.50"){ echo "19";}
                                                                        elseif($data["size"] == "1.00"){ echo "19";}
                                                                        elseif($data["size"] == "1.50"){ echo "19.5";}
                                                                        elseif($data["size"] == "2.00"){ echo "20";}
                                                                        elseif($data["size"] == "2.50"){ echo "20.5";}
                                                                        elseif($data["size"] == "3.00"){ echo "21";}
                                                                        elseif($data["size"] == "3.50"){ echo "21.5";}
                                                                        elseif($data["size"] == "4.00"){ echo "22";}
                                                                        elseif($data["size"] == "4.50"){ echo "22.5";}
                                                                        elseif($data["size"] == "5.00"){ echo "23";}
                                                                        elseif($data["size"] == "5.50"){ echo "23.5";}
                                                                        elseif($data["size"] == "6.00"){ echo "24";}
                                                                        elseif($data["size"] == "6.50"){ echo "24.5";}
                                                                        else{ echo "25";}
                                                                    }
                                                                
                                                                }else{
                                                                    if($data["gender"] == "Men"){
                                                                        if($data["size"] == "4.00"){ echo "220";}
                                                                        elseif($data["size"] == "4.50"){ echo "225";}
                                                                        elseif($data["size"] == "5.00"){ echo "230";}
                                                                        elseif($data["size"] == "5.50"){ echo "235";}
                                                                        elseif($data["size"] == "6.00"){ echo "240";}
                                                                        elseif($data["size"] == "6.50"){ echo "245";}
                                                                        elseif($data["size"] == "7.00"){ echo "250";}
                                                                        elseif($data["size"] == "7.50"){ echo "255";}
                                                                        elseif($data["size"] == "8.00"){ echo "260";}
                                                                        elseif($data["size"] == "8.50"){ echo "265";}
                                                                        elseif($data["size"] == "9.00"){ echo "270";}
                                                                        elseif($data["size"] == "9.50"){ echo "275";}
                                                                        elseif($data["size"] == "10.00"){ echo "280";}
                                                                        elseif($data["size"] == "10.50"){ echo "285";}
                                                                        elseif($data["size"] == "11.00"){ echo "290";}
                                                                        elseif($data["size"] == "11.50"){ echo "295";}
                                                                        elseif($data["size"] == "12.00"){ echo "300";}
                                                                        else{ echo "310";}
                                                                    }elseif($data["gender"] == "Women" ){
                                                                        if($data["size"] == "5.00"){ echo "220";}
                                                                        elseif($data["size"] == "5.50"){ echo "225";}
                                                                        elseif($data["size"] == "6.00"){ echo "230";}
                                                                        elseif($data["size"] == "6.50"){ echo "235";}
                                                                        elseif($data["size"] == "7.00"){ echo "240";}
                                                                        elseif($data["size"] == "7.50"){ echo "245";}
                                                                        elseif($data["size"] == "8.00"){ echo "250";}
                                                                        elseif($data["size"] == "8.50"){ echo "255";}
                                                                        elseif($data["size"] == "9.00"){ echo "260";}
                                                                        elseif($data["size"] == "9.50"){ echo "265";}
                                                                        elseif($data["size"] == "10.00"){ echo "270";}
                                                                        elseif($data["size"] == "10.50"){ echo "275";}
                                                                        elseif($data["size"] == "11.00"){ echo "280";}
                                                                        elseif($data["size"] == "11.50"){ echo "285";}
                                                                        else{ echo "290";}
                                                                    }elseif($data["gender"] == "Infant"){
                                                                        if($data["size"] == "2.00"){ echo "80";}                                                                        elseif($data["size"] == "3.00"){ echo "90";}
                                                                        elseif($data["size"] == "4.00"){ echo "100";}
                                                                        elseif($data["size"] == "4.50"){ echo "105";}
                                                                        elseif($data["size"] == "5.00"){ echo "110";}
                                                                        elseif($data["size"] == "5.50"){ echo "115";}
                                                                        elseif($data["size"] == "6.00"){ echo "120";}
                                                                        elseif($data["size"] == "6.50"){ echo "125";}
                                                                        elseif($data["size"] == "7.00"){ echo "130";}
                                                                        elseif($data["size"] == "7.50"){ echo "135";}
                                                                        elseif($data["size"] == "8.00"){ echo "140";}
                                                                        elseif($data["size"] == "8.50"){ echo "145";}
                                                                        elseif($data["size"] == "9.00"){ echo "150";}
                                                                        elseif($data["size"] == "9.50"){ echo "155";}
                                                                        else{ echo "160";}
                                                                    }else{
                                                                        if($data["size"] == "10.50"){ echo "165";}
                                                                        elseif($data["size"] == "11.00"){ echo "170";}
                                                                        elseif($data["size"] == "11.50"){ echo "175";}                                                                        elseif($data["size"] == "12.00"){ echo "180";}
                                                                        elseif($data["size"] == "12.50"){ echo "185";}
                                                                        elseif($data["size"] == "13.00"){ echo "190";}
                                                                        elseif($data["size"] == "13.50"){ echo "195";}
                                                                        elseif($data["size"] == "1.00"){ echo "200";}
                                                                        elseif($data["size"] == "1.50"){ echo "205";}
                                                                        elseif($data["size"] == "2.00"){ echo "210";}
                                                                        elseif($data["size"] == "2.50"){ echo "215";}
                                                                        elseif($data["size"] == "3.00"){ echo "220";}
                                                                        elseif($data["size"] == "3.50"){ echo "225";}
                                                                        elseif($data["size"] == "4.00"){ echo "230";}
                                                                        elseif($data["size"] == "4.50"){ echo "235";}
                                                                        elseif($data["size"] == "5.00"){ echo "235";}
                                                                        elseif($data["size"] == "5.50"){ echo "240";}
                                                                        elseif($data["size"] == "6.00"){ echo "240";}
                                                                        elseif($data["size"] == "6.50"){ echo "245";}
                                                                        else{ echo "250";} 
                                                                    }
                                                                } ?></td>
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
                            if($negara == "KOREA, REPUBLIC OF" || $negara == "KOREA"){
                                ?>
                                <a href="excel_summary_korea.php?id_summary=<?php echo $_GET['id_summary']; ?>&po=<?php echo $value;?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
                                <a href="print_summary_korea.php?id_summary=<?php echo $_GET['id_summary']; ?>&po=<?php echo $value;?>" type="button" target="_BLANK" class="btn btn-info btn-sm">PRINT SUMMARY</a>
                            <?php }else{
                                ?>
                                <a href="excel_summary_mexico.php?id_summary=<?php echo $_GET['id_summary']; ?>&po=<?php echo $value;?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
                                <a href="print_summary_mexico.php?id_summary=<?php echo $_GET['id_summary']; ?>&po=<?php echo $value;?>" type="button" target="_BLANK" class="btn btn-info btn-sm">PRINT SUMMARY</a>
                            <?php }
                    }
                ?>
                <br><br>                
                <?php 
                    if($negara == "KOREA, REPUBLIC OF" || $negara == "KOREA"){
                        if($kategori == 'PF Flyer'){?>
                                <a href="print_main_koreaPFA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                                <a href="print_side_koreaPFA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                                <a href="print_main_koreaPFA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                                <a href="print_side_koreaPFA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                        <?php }else{ ?>
                                <a href="print_side_koreaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT SIDE MARK A4</a>
                                <a href="print_main_koreaA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                                <a href="print_side_koreaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT SIDE MARK A5</a>
                                <a href="print_main_koreaA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
                        <?php }
                    }else{ ?>
                        <a href="print_main_mexicoA4.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-dark btn-sm">PRINT MAIN MARK A4</a>
                        <a href="print_main_mexicoA5.php?id_summary=<?php echo $_GET['id_summary'];?>&po=<?php echo $value;?>" target="_BLANK" type="button" class="btn btn-danger btn-sm">PRINT MAIN MARK A5</a>
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