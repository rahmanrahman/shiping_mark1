<?php
    $id_summary=$_GET['id_summary'];
    require_once 'functions/koneksi.php';
    require 'functions/function_packing_list.php';
    header("Content-type:application/vnd-ms-excel");
    $id_summary   = $_GET['id_summary'];
    $get  = showFactory($id_summary);
?>
<?php
    foreach ($get as $data) { 
    $a = $data['factory_code'];
    header("Content-Disposition: attachment; filename=$a.xls")
?>
<?php } ?>

<center>
<h3> PACKING LIST / SHIPPING MARK</h3>
</center>
<table border="1">
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
        <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['cust_id'];?></td>
        <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $data['factory_code'];?></td>
        <td rowspan="3" style="vertical-align: middle; text-align: center;"><?php echo $po;?></td>
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
        <td rowspan="3" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php foreach (subtotalNW() as $key) { echo $key[0]; }?></td>
        <td rowspan="3" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php foreach (subtotalGW() as $key) { echo $key[0]; }?></td>
        <?php $allSize = getSize1();?>
        <?php foreach ($allSize as $dataSize) { ?>
        <td colspan="1" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php echo $dataSize['size']+0;?></td><?php } ?>
        <td rowspan="3" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php echo $data['ctn_no'];?></td>
        <td rowspan="3" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php echo $data['no_ctn'];?></td>
        <td rowspan="3" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php echo $data['packing_metode'];?></td>
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
            }elseif($dataSize['cust_id'] == "MEXICO"){
                if($dataSize["gender"] == "Men"){
                    if($dataSize["size"] == "4.00"){ echo "22";}
                    elseif($dataSize["size"] == "4.50"){ echo "22.5";}
                    elseif($dataSize["size"] == "5.00"){ echo "23";}
                    elseif($dataSize["size"] == "5.50"){ echo "23.5";}
                    elseif($dataSize["size"] == "6.00"){ echo "24";}
                    elseif($dataSize["size"] == "6.50"){ echo "24.5";}
                    elseif($dataSize["size"] == "7.00"){ echo "25";}
                    elseif($dataSize["size"] == "7.50"){ echo "25.5";}
                    elseif($dataSize["size"] == "8.00"){ echo "26";}
                    elseif($dataSize["size"] == "8.50"){ echo "26.5";}
                    elseif($dataSize["size"] == "9.00"){ echo "27";}
                    elseif($dataSize["size"] == "9.50"){ echo "27.5";}
                    elseif($dataSize["size"] == "10.00"){ echo "28";}
                    elseif($dataSize["size"] == "10.50"){ echo "28.5";}
                    elseif($dataSize["size"] == "11.00"){ echo "29";}
                    elseif($dataSize["size"] == "11.50"){ echo "29.5";}
                    elseif($dataSize["size"] == "12.00"){ echo "30";}
                    elseif($dataSize["size"] == "12.50"){ echo "30.5";}
                    elseif($dataSize["size"] == "13.00"){ echo "31";}
                    elseif($dataSize["size"] == "14.00"){ echo "32";}
                    else{ echo "33";}
                }elseif($dataSize["gender"] == "Women" ){
                    if($dataSize["size"] == "4.50"){ echo "21.5";}
                    elseif($dataSize["size"] == "5.00"){ echo "22";}
                    elseif($dataSize["size"] == "5.50"){ echo "22.5";}
                    elseif($dataSize["size"] == "6.00"){ echo "23";}
                    elseif($dataSize["size"] == "6.50"){ echo "23.5";}
                    elseif($dataSize["size"] == "7.00"){ echo "24";}
                    elseif($dataSize["size"] == "7.50"){ echo "24.5";}
                    elseif($dataSize["size"] == "8.00"){ echo "25";}
                    elseif($dataSize["size"] == "8.50"){ echo "25.5";}
                    elseif($dataSize["size"] == "9.00"){ echo "26";}
                    elseif($dataSize["size"] == "9.50"){ echo "26.5";}
                    elseif($dataSize["size"] == "10.00"){ echo "27";}
                    elseif($dataSize["size"] == "10.50"){ echo "27.5";}
                    elseif($dataSize["size"] == "11.00"){ echo "28";}
                    elseif($dataSize["size"] == "11.50"){ echo "28.5";}
                    else{ echo "29";}
                }elseif($dataSize["gender"] == "Infant"){
                    if($dataSize["size"] == "3.00"){ echo "10";}
                    elseif($dataSize["size"] == "4.00"){ echo "11";}
                    elseif($dataSize["size"] == "4.50"){ echo "11.5";}
                    elseif($dataSize["size"] == "5.00"){ echo "12";}
                    elseif($dataSize["size"] == "5.50"){ echo "12";}
                    elseif($dataSize["size"] == "6.00"){ echo "12.5";}
                    elseif($dataSize["size"] == "6.50"){ echo "13";}
                    elseif($dataSize["size"] == "7.00"){ echo "13.5";}
                    elseif($dataSize["size"] == "8.00"){ echo "14.5";}
                    elseif($dataSize["size"] == "8.50"){ echo "15";}
                    elseif($dataSize["size"] == "9.00"){ echo "15";}
                    elseif($dataSize["size"] == "9.50"){ echo "15.5";}
                    else{ echo "16";}
                }else{
                    if($dataSize["size"] == "10.50"){ echo "16.5";}
                    elseif($dataSize["size"] == "11.00"){ echo "17";}
                    elseif($dataSize["size"] == "11.50"){ echo "17.5";}
                    elseif($dataSize["size"] == "12.00"){ echo "17.5";}
                    elseif($dataSize["size"] == "12.50"){ echo "18";}
                    elseif($dataSize["size"] == "13.00"){ echo "18.5";}
                    elseif($dataSize["size"] == "13.50"){ echo "19";}
                    elseif($dataSize["size"] == "1.00"){ echo "19";}
                    elseif($dataSize["size"] == "1.50"){ echo "19.5";}
                    elseif($dataSize["size"] == "2.00"){ echo "20";}
                    elseif($dataSize["size"] == "2.50"){ echo "20.5";}
                    elseif($dataSize["size"] == "3.00"){ echo "21";}
                    elseif($dataSize["size"] == "3.50"){ echo "21.5";}
                    elseif($dataSize["size"] == "4.00"){ echo "22";}
                    elseif($dataSize["size"] == "4.50"){ echo "22.5";}
                    elseif($dataSize["size"] == "5.00"){ echo "23";}
                    elseif($dataSize["size"] == "5.50"){ echo "23.5";}
                    elseif($dataSize["size"] == "6.00"){ echo "24";}
                    elseif($dataSize["size"] == "6.50"){ echo "24.5";}
                    else{ echo "25";}
                }
            }else{
                if($dataSize["gender"] == "Men"){
                    if($dataSize["size"] == "4.00"){ echo "220";}
                    elseif($dataSize["size"] == "4.50"){ echo "225";}
                    elseif($dataSize["size"] == "5.00"){ echo "230";}
                    elseif($dataSize["size"] == "5.50"){ echo "235";}
                    elseif($dataSize["size"] == "6.00"){ echo "240";}
                    elseif($dataSize["size"] == "6.50"){ echo "245";}
                    elseif($dataSize["size"] == "7.00"){ echo "250";}
                    elseif($dataSize["size"] == "7.50"){ echo "255";}
                    elseif($dataSize["size"] == "8.00"){ echo "260";}
                    elseif($dataSize["size"] == "8.50"){ echo "265";}
                    elseif($dataSize["size"] == "9.00"){ echo "270";}
                    elseif($dataSize["size"] == "9.50"){ echo "275";}
                    elseif($dataSize["size"] == "10.00"){ echo "280";}
                    elseif($dataSize["size"] == "10.50"){ echo "285";}
                    elseif($dataSize["size"] == "11.00"){ echo "290";}
                    elseif($dataSize["size"] == "11.50"){ echo "295";}
                    elseif($dataSize["size"] == "12.00"){ echo "300";}
                    else{ echo "310";}
                }elseif($dataSize["gender"] == "Women" ){
                    if($dataSize["size"] == "5.00"){ echo "220";}
                    elseif($dataSize["size"] == "5.50"){ echo "225";}
                    elseif($dataSize["size"] == "6.00"){ echo "230";}
                    elseif($dataSize["size"] == "6.50"){ echo "235";}
                    elseif($dataSize["size"] == "7.00"){ echo "240";}
                    elseif($dataSize["size"] == "7.50"){ echo "245";}
                    elseif($dataSize["size"] == "8.00"){ echo "250";}
                    elseif($dataSize["size"] == "8.50"){ echo "255";}
                    elseif($dataSize["size"] == "9.00"){ echo "260";}
                    elseif($dataSize["size"] == "9.50"){ echo "265";}
                    elseif($dataSize["size"] == "10.00"){ echo "270";}
                    elseif($dataSize["size"] == "10.50"){ echo "275";}
                    elseif($dataSize["size"] == "11.00"){ echo "280";}
                    elseif($dataSize["size"] == "11.50"){ echo "285";}
                    else{ echo "290";}
                }elseif($dataSize["gender"] == "Infant"){
                    if($dataSize["size"] == "2.00"){ echo "80";}
                    elseif($dataSize["size"] == "3.00"){ echo "90";}
                    elseif($dataSize["size"] == "4.00"){ echo "100";}
                    elseif($dataSize["size"] == "4.50"){ echo "105";}
                    elseif($dataSize["size"] == "5.00"){ echo "110";}
                    elseif($dataSize["size"] == "5.50"){ echo "115";}
                    elseif($dataSize["size"] == "6.00"){ echo "120";}
                    elseif($dataSize["size"] == "6.50"){ echo "125";}
                    elseif($dataSize["size"] == "7.00"){ echo "130";}
                    elseif($dataSize["size"] == "7.50"){ echo "135";}
                    elseif($dataSize["size"] == "8.00"){ echo "140";}
                    elseif($dataSize["size"] == "8.50"){ echo "145";}
                    elseif($dataSize["size"] == "9.00"){ echo "150";}
                    elseif($dataSize["size"] == "9.50"){ echo "155";}
                    else{ echo "160";}
                }else{
                    if($dataSize["size"] == "10.50"){ echo "165";}
                    elseif($dataSize["size"] == "11.00"){ echo "170";}
                    elseif($dataSize["size"] == "11.50"){ echo "175";}
                    elseif($dataSize["size"] == "12.00"){ echo "180";}
                    elseif($dataSize["size"] == "12.50"){ echo "185";}
                    elseif($dataSize["size"] == "13.00"){ echo "190";}
                    elseif($dataSize["size"] == "13.50"){ echo "195";}
                    elseif($dataSize["size"] == "1.00"){ echo "200";}
                    elseif($dataSize["size"] == "1.50"){ echo "205";}
                    elseif($dataSize["size"] == "2.00"){ echo "210";}
                    elseif($dataSize["size"] == "2.50"){ echo "215";}
                    elseif($dataSize["size"] == "3.00"){ echo "220";}
                    elseif($dataSize["size"] == "3.50"){ echo "225";}
                    elseif($dataSize["size"] == "4.00"){ echo "230";}
                    elseif($dataSize["size"] == "4.50"){ echo "235";}
                    elseif($dataSize["size"] == "5.00"){ echo "235";}
                    elseif($dataSize["size"] == "5.50"){ echo "240";}
                    elseif($dataSize["size"] == "6.00"){ echo "240";}
                    elseif($dataSize["size"] == "6.50"){ echo "245";}
                    else{ echo "250";}
                }
            } ?></td><?php } ?>
    </tr>
    <tr>
        <?php $allSize = getSize1();?>
        <?php foreach ($allSize as $dataSize) { ?>
        <td style="vertical-align: middle; text-align: center;"><?php echo $dataSize['packing_metode1'];?></td><?php } ?>
    </tr>
	<?php 
        } }
        ?>
	</tbody>
    <tfoot>
        <tr>
            <?php $totalsize = count($allSize) + 11; ?>
            <th colspan="<?php echo $totalsize; ?>" style="text-align: center;">Total</th>
            <th style="text-align: center;"><?php echo $total ?></th>
            <th style="text-align: center;"></th>
        </tr>
    </tfoot>
</table>