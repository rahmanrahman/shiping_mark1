<?php
    $id_summary=$_GET['id_summary'];
    require_once 'functions/koneksi.php';
    require 'functions/function_output.php';
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
        <th rowspan="2" style="vertical-align: middle; text-align: center;">US Size</th>
        <th rowspan="2" style="vertical-align: middle; text-align: center;">Size Mexico</th>
        <th rowspan="2" style="vertical-align: middle; text-align: center;">Carton Number</th>
        <th rowspan="2" style="vertical-align: middle; text-align: center;">Total Carton</th>
        <th rowspan="2" style="vertical-align: middle; text-align: center;">Pairs</th>
    </tr>
    <tr>
        <th style="text-align: center;">NW</th>
        <th style="text-align: center;">GW</th>
    </tr>
	</thead>
	<tbody>
	    <?php
            $po = $_GET['po'];
            if (isset($_GET['id_summary'])) {
            $id_summary=trim($_GET['id_summary']);
            $shipMark = mysqli_query($conn, "SELECT * FROM tb_packing_list a
                                            LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                            LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                            LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                            LEFT JOIN tb_master e ON d.sku = e.sku
                                            WHERE d.id_summary='$id_summary' ORDER BY d.id_summary");
            while ($data = mysqli_fetch_array($shipMark)) {
        ?>
	<tr>
        <td style="text-align: center;"><?php echo $data['cust_id'];?></td>
        <td style="text-align: center;"><?php echo $data['factory_code'];?></td>
        <td style="text-align: center;"><?php echo $po;?></td>
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
        <td style="text-align: center;"><?php echo $data['meas'];?></td>
        <td style="text-align: center; mso-number-format:\@;"><?php echo $data['nw'];?></td>
        <td style="text-align: center; mso-number-format:\@;"><?php echo $data['gw'];?></td>
        <td style="text-align: center; mso-number-format:\@;"><?php echo $data['size']+0;?></td>
        <td style="text-align: center; mso-number-format:\@;"><?php 
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
                                                                    } ?></td>
        <td style="text-align: center; mso-number-format:\@;"><?php echo $data['ctn_no'];?></td>
        <td style="text-align: center; mso-number-format:\@;"><?php echo $data['no_ctn'];?></td>
        <td style="text-align: center; mso-number-format:\@;"><?php echo $data['packing_metode'];?></td>
	</tr>
	<?php 
        } }
        ?>
	</tbody>
    <tfoot>
        <tr>
            <th colspan="12" style="text-align: center;">Total</th>
            <th style="text-align: center;"><?php foreach (prs() as $key) { echo $key[0]; }?></th>
            <th style="text-align: center;"></th>
        </tr>
    </tfoot>
</table>