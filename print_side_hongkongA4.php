<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_output.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shipping Mark</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif;">
    <?php $po = $_GET['po']; ?>
    <?php $all = getData(); $no = 1; ?>
    <?php foreach ($all as $data) { ?>
    <?php $total = $data['no_ctn'];?>
    <?php for ($i = 0; $i < $total; $i++){?>
        <br>
        <table style="font-size:64px; font-weight:bold; line-height: 100px;">
            <tr>
                <td>STYLE#</td>
                <td>:</td>
                <td colspan="5"><?php 
                                    if(substr($data['sku'],-3) == 'NEW'){
                                        echo substr($data['sku'],0,-4);
                                    }elseif(substr($data['sku'],-4) == '(PE)') {
                                        echo substr($data['sku'],0,-5);
                                    }else{
                                        echo $data['sku'];
                                    } ?></td>
            </tr>
            <tr>
                <td>WIDTH</td>
                <td>:</td>
                <td colspan="5"><?= $data['widht'];?></td>
            </tr>
            <tr>
                <td>Q'TY</td>
                <td>:</td>
                <td><?= $data['packing_metode'];?></td>
            </tr>
            <tr>
                <td>N.W</td>
                <td>:</td>
                <td><?= $data['nw'];?></td>
                <td>KGS</td>
            </tr>
            <tr>
                <td>G.W</td>
                <td>:</td>
                <td><?= $data['gw'];?></td>
                <td>KGS</td>
            </tr>
            <tr>
                <td>MEAS</td>
                <td>:</td>
                <td style="font-size:46px; "colspan="12"><?= $data['meas'];?> CUFT</td>
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