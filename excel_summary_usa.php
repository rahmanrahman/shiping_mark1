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
        <th rowspan="2" style="vertical-align: middle; text-align: center;">Prepack No</th>
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
        <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['cust_id'];?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['factory_code'];?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $po;?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php 
                                                                                if(substr($data['sku'],-3) == 'NEW'){
                                                                                    echo substr($data['sku'],0,-4);
                                                                                }elseif(substr($data['sku'],-4) == '(PE)') {
                                                                                    echo substr($data['sku'],0,-5);
                                                                                }else{
                                                                                    echo $data['sku'];
                                                                                } ?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php echo $data['code'];?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['color'];?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['widht'];?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['carton_code'];?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $data['meas'];?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php foreach (subtotalNW() as $key) { echo $key[0]; }?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php foreach (subtotalGW() as $key) { echo $key[0]; }?></td>
        <?php $allSize = getSize1();?>
        <?php foreach ($allSize as $dataSize) { ?>
        <td colspan="1" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php echo $dataSize['size']+0;?></td><?php } ?>
        <td rowspan="2" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php echo $data['ctn_no'];?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php echo $data['no_ctn'];?></td>
        <td rowspan="2" style="vertical-align: middle; text-align: center; mso-number-format:\@;"><?php echo $data['packing_metode'];?></td>
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
            <?php $totalsize = count($allSize) + 12; ?>
            <th colspan="<?php echo $totalsize; ?>" style="text-align: center;">Total</th>
            <th style="text-align: center;"><?php echo $total ?></th>
            <th style="text-align: center;"></th>
        </tr>
    </tfoot>
</table>