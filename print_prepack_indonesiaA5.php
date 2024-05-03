<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_packing_list.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shipping Mark</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif;">
    <?php $po = $_GET['po']; ?>
    <?php $all = getData1(); $no = 1; ?>
    <?php foreach ($all as $data) { ?>
    <?php $total = $data['no_ctn'];?>
    <?php for ($i = 0; $i < $total; $i++){?>
        <table style="font-size: 34px; font-weight:bolder; line-height: 42px;">
            <tr>
                <td width="230px">STYLE NO.</td>
                <td>:</td>
                <td colspan="12"><?php 
                                    if(substr($data['sku'],-3) == 'NEW'){
                                        echo substr($data['sku'],0,-4);
                                    }elseif(substr($data['sku'],-4) == '(PE)') {
                                        echo substr($data['sku'],0,-5);
                                    }else{
                                        echo $data['sku'];
                                    } ?></td>
            </tr>
            <tr>
                <td>CARTON NO.</td>
                <td>:</td>
                <td colspan="12"> <?= $no++ ?> OF <?php echo $total ?></td>
            </tr>
            <tr>
                <td>COLOR</td>
                <td>:</td>
                <td colspan="12"><?= $data['color'];?></td>
            </tr>
            <tr>
                <td>SIZE</td>
                <td>:</td>
                <?php $allSize = getSize1();?>
                <?php foreach ($allSize as $dataSize) { ?>
                <td style="font-size : 28px;" colspan = "1" width="50px"><center><?php echo $dataSize['size']+0;?></center></td><?php } ?>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="<?php foreach (countData() as $key) { echo $key[0]; }?>"><hr size="1" color=yelow;></td>
            </tr>
            <tr>
                <td>QUANTITY</td>
                <td>:</td>
                <?php $allSize = getSize1();?>
                <?php foreach ($allSize as $dataSize) { ?>
                    <td style="font-size : 28px;" colspan = "1"><center><?php echo $dataSize['packing_metode1'];?></center></td><?php } ?>
            </tr>
            <tr>
                <td>N.W</td>
                <td>:</td>
                <td colspan="5"><?php foreach (subtotalNW() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td>G.W</td>
                <td>:</td>
                <td colspan="5"><?php foreach (subtotalGW() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">MEAS</td>
                <td style="vertical-align: top;">:</td>
                <td colspan="12"><?php
                                    if($data['carton_code'] == "NBL1-MZ"){ echo "0.445MX0.330MX0.200M 0.029 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL1.5-MZ"){ echo "0.510MX0.380MX0.230M 0.045 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL2-MZ"){ echo "0.560MX0.420MX0.260M 0.061 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL3-MZ"){ echo "0.583MX0.430MX0.287M 0.072 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL4-MZ"){ echo "0.563MX0.490MX0.325M 0.09 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL5-MZ"){ echo "0.560MX0.520MX0.340M 0.099 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL6-MZ"){ echo "0.614MX0.496MX0.340M 0.104 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL6.5-MZ"){ echo "0.644MX0.536MX0.345M 0.119 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL7-MZ"){ echo "0.690MX0.540MX0.360M 0.134 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL8-MZ"){ echo "0.745MX0.560MX0.390M 0.163 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL8.5-MZ"){ echo "0.865MX0.563MX0.410M 0.2 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL9-MZ"){ echo "0.923MX0.573MX0.430M 0.227 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA1-MX"){ echo "0.300MX0.255MX0.205M 0.016 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA1.5-MX"){ echo "0.345MX0.285MX0.230M 0.023 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA2-MX"){ echo "0.375MX0.315MX0.260M 0.031 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA3-MX"){ echo "0.390MX0.325MX0.287M 0.036 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA4-MX"){ echo "0.375MX0.370MX0.325M 0.045 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA5-MX"){ echo "0.390MX0.385MX0.340M 0.051 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA6-MX"){ echo "0.407MX0.376MX0.340M 0.052 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA6.5-MX"){ echo "0.427MX0.405MX0.345M 0.06 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA7-MX"){ echo "0.477MX0.417MX0.365M 0.073 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA8-MX"){ echo "0.495MX0.425MX0.390M 0.082 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA8.5-MX"){ echo "0.567MX0.440MX0.405M 0.101 CUMTRS";}
                                    elseif($data['carton_code'] == "NBLA9-MX"){ echo "0.620MX0.450MX0.430M 0.12 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL1-MQ"){ echo "0.450MX0.255MX0.205M 0.024 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL1.5-MQ"){ echo "0.510MX0.285MX0.230M 0.033 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL2-MQ"){ echo "0.560MX0.315MX0.260M 0.046 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL3-MQ"){ echo "0.583MX0.325MX0.287M 0.054 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL4-MQ"){ echo "0.563MX0.370MX0.325M 0.068 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL5-MQ"){ echo "0.560MX0.390MX0.340M 0.074 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL6-MQ"){ echo "0.614MX0.376MX0.340M 0.078 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL6.5-MQ"){ echo "0.644MX0.405MX0.345M 0.09 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL7-MQ"){ echo "0.708MX0.417MX0.365M 0.108 CUMTRS";}
                                    elseif($data['carton_code'] == "NBL8-MQ"){ echo "0.745MX0.425MX0.390M 0.123 CUMTRS";}
                                    else{ echo "0.855MX0.428MX0.400M=0.146 CUMTRS";}
                                ?></td>
            </tr>
        </table>
    <?php
        }
    }
    ?>
</body>
    <script>
        window.print();
    </script>
</html>