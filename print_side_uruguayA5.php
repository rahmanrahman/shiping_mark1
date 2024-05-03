<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_output.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shipping Mark</title>
</head>
<body style="font-family: calibri, Helvetica, sans-serif;">
    <?php $po = $_GET['po']; ?>
    <?php $all = getData(); $no = 1; ?>
    <?php foreach ($all as $data) { ?>
    <?php $total = $data['no_ctn'];?>
    <?php for ($i = 0; $i < $total; $i++){?>
        <table style="font-size:42px; font-weight:bolder; line-height: 62px;">
            <tr>
                <td colspan="15">N.B.A.S.</td>
            </tr>
            <tr>
                <td width="265">Ship To</td>
                <td width="20px">:</td>
                <td colspan="15"><?= $data['destination'];?></td>
            </tr>
            <tr>
                <td>Gross Weight</td>
                <td>:</td>
                <td colspan="15"><?= $data['gw'];?></td>
            </tr>
            <tr>
                <td>Net Weight</td>
                <td>:</td>
                <td colspan="15"><?= $data['nw'];?></td>
            </tr>
            <tr>
                <td>Cubic Measure</td>
                <td>:</td>
                <td colspan="15"><?php
                                    if($data['carton_code'] == "NBL1-MZ"){ echo "0.029 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL1.5-MZ"){ echo "0.045 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL2-MZ"){ echo "0.061 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL3-MZ"){ echo "0.072 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL4-MZ"){ echo "0.09 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL5-MZ"){ echo "0.099 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL6-MZ"){ echo "0.104 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL6.5-MZ"){ echo "0.119 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL7-MZ"){ echo "0.134 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL8-MZ"){ echo "0.163 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL8.5-MZ"){ echo "0.2 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL9-MZ"){ echo "0.227 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA1-MX"){ echo "0.016 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA1.5-MX"){ echo "0.023 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA2-MX"){ echo "0.031 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA3-MX"){ echo "0.036 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA4-MX"){ echo "0.045 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA5-MX"){ echo "0.051 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA6-MX"){ echo "0.052 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA6.5-MX"){ echo "0.06 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA7-MX"){ echo "0.073 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA8-MX"){ echo "0.082 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA8.5-MX"){ echo "0.101 CU MTRS";}
                                    elseif($data['carton_code'] == "NBLA9-MX"){ echo "0.12 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL1-MQ"){ echo "0.024 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL1.5-MQ"){ echo "0.033 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL2-MQ"){ echo "0.046 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL3-MQ"){ echo "0.054 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL4-MQ"){ echo "0.068 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL5-MQ"){ echo "0.074 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL6-MQ"){ echo "0.078 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL6.5-MQ"){ echo "0.09 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL7-MQ"){ echo "0.108 CU MTRS";}
                                    elseif($data['carton_code'] == "NBL8-MQ"){ echo "0.123 CU MTRS";}
                                    else{ echo "0.855MX0.428MX0.400M 0.146 CU MTRS";}
                                ?></td>
            </tr>
            <tr>
                <td colspan="15">MADE IN INDONESIA</td>
            </tr>
            <tr>
                <td>Dimensions</td>
                <td>:</td>
                <td colspan="15" style="font-size : 38px;"><?php
                                    if($data['carton_code'] == "NBL1-MZ"){ echo "0.445MX0.330MX0.200M";}
                                    elseif($data['carton_code'] == "NBL1.5-MZ"){ echo "0.510MX0.380MX0.230M";}
                                    elseif($data['carton_code'] == "NBL2-MZ"){ echo "0.560MX0.420MX0.260M";}
                                    elseif($data['carton_code'] == "NBL3-MZ"){ echo "0.583MX0.430MX0.287M";}
                                    elseif($data['carton_code'] == "NBL4-MZ"){ echo "0.563MX0.490MX0.325M";}
                                    elseif($data['carton_code'] == "NBL5-MZ"){ echo "0.560MX0.520MX0.340M";}
                                    elseif($data['carton_code'] == "NBL6-MZ"){ echo "0.614MX0.496MX0.340M";}
                                    elseif($data['carton_code'] == "NBL6.5-MZ"){ echo "0.644MX0.536MX0.345M";}
                                    elseif($data['carton_code'] == "NBL7-MZ"){ echo "0.690MX0.540MX0.360M";}
                                    elseif($data['carton_code'] == "NBL8-MZ"){ echo "0.745MX0.560MX0.390M";}
                                    elseif($data['carton_code'] == "NBL8.5-MZ"){ echo "0.865MX0.563MX0.410M";}
                                    elseif($data['carton_code'] == "NBL9-MZ"){ echo "0.923MX0.573MX0.430M";}
                                    elseif($data['carton_code'] == "NBLA1-MX"){ echo "0.300MX0.255MX0.205M";}
                                    elseif($data['carton_code'] == "NBLA1.5-MX"){ echo "0.345MX0.285MX0.230M";}
                                    elseif($data['carton_code'] == "NBLA2-MX"){ echo "0.375MX0.315MX0.260M";}
                                    elseif($data['carton_code'] == "NBLA3-MX"){ echo "0.390MX0.325MX0.287M";}
                                    elseif($data['carton_code'] == "NBLA4-MX"){ echo "0.375MX0.370MX0.325M";}
                                    elseif($data['carton_code'] == "NBLA5-MX"){ echo "0.390MX0.385MX0.340M";}
                                    elseif($data['carton_code'] == "NBLA6-MX"){ echo "0.407MX0.376MX0.340M";}
                                    elseif($data['carton_code'] == "NBLA6.5-MX"){ echo "0.427MX0.405MX0.345M";}
                                    elseif($data['carton_code'] == "NBLA7-MX"){ echo "0.477MX0.417MX0.365M";}
                                    elseif($data['carton_code'] == "NBLA8-MX"){ echo "0.495MX0.425MX0.390M";}
                                    elseif($data['carton_code'] == "NBLA8.5-MX"){ echo "0.567MX0.440MX0.405M";}
                                    elseif($data['carton_code'] == "NBLA9-MX"){ echo "0.620MX0.450MX0.430M";}
                                    elseif($data['carton_code'] == "NBL1-MQ"){ echo "0.450MX0.255MX0.205M";}
                                    elseif($data['carton_code'] == "NBL1.5-MQ"){ echo "0.510MX0.285MX0.230M";}
                                    elseif($data['carton_code'] == "NBL2-MQ"){ echo "0.560MX0.315MX0.260M";}
                                    elseif($data['carton_code'] == "NBL3-MQ"){ echo "0.583MX0.325MX0.287M";}
                                    elseif($data['carton_code'] == "NBL4-MQ"){ echo "0.563MX0.370MX0.325M";}
                                    elseif($data['carton_code'] == "NBL5-MQ"){ echo "0.560MX0.390MX0.340M";}
                                    elseif($data['carton_code'] == "NBL6-MQ"){ echo "0.614MX0.376MX0.340M";}
                                    elseif($data['carton_code'] == "NBL6.5-MQ"){ echo "0.644MX0.405MX0.345M";}
                                    elseif($data['carton_code'] == "NBL7-MQ"){ echo "0.708MX0.417MX0.365M";}
                                    elseif($data['carton_code'] == "NBL8-MQ"){ echo "0.745MX0.425MX0.390M";}
                                    else{ echo "0.855MX0.428MX0.400M";}
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