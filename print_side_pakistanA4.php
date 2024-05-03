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
        <table style="font-size:66px; font-weight:bolder; line-height: 112px;">
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td width="370">N.WT</td>
                <td width="30px">:</td>
                <td colspan="15"><?= $data['nw'];?></td>
            </tr>
            <tr>
                <td>G.WT</td>
                <td>:</td>
                <td colspan="15"><?= $data['gw'];?></td>
            </tr>
            <tr>
                <td>DIMENSION</td>
                <td>:</td>
                <td style="font-size:58px;" colspan="15"><?php
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
                                ?></td>
            </tr>
            <tr>
                <td>CARTON NO.</td>
                <td>:</td>
                <td colspan="15"> <?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td><br></td>
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