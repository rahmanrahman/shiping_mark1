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
        <th rowspan="2" style="vertical-align: middle; text-align: center;">Size</th>
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
                                                if($destination = "New Balance Singapore Pte Ltd"){
                                                    echo $data['meas_carton'];
                                                }else{
                                                    echo $data['meas'];
                                                }
                                            }elseif($data['factory_code'] == 'N11NB0297' || $data['factory_code'] == 'N11NB0298'){
                                                echo '16.8IN*15.9IN*13.6IN=2.11';
                                            }else{
                                                echo $data['meas'];
                                            } ?></td>
        <td style="text-align: center; mso-number-format:\@;"><?php echo $data['nw'];?></td>
        <td style="text-align: center; mso-number-format:\@;"><?php echo $data['gw'];?></td>
        <td style="text-align: center; mso-number-format:\@;"><?php echo $data['size']+0;?></td>
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