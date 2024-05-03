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
        <br>
        <table style="font-size:64px; font-weight:bolder; line-height: 100px;">
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
                <td>PRS</td>
            </tr>
            <tr>
                <td>N.W</td>
                <td>:</td>
                <td><?php foreach (subtotalNW() as $key) { echo $key[0]; }?></td>
                <td>KGS</td>
            </tr>
            <tr>
                <td>G.W</td>
                <td>:</td>
                <td><?php foreach (subtotalGW() as $key) { echo $key[0]; }?></td>
                <td>KGS</td>
            </tr>
            <tr>
                <td>MEAS</td>
                <td>:</td>
                <td colspan="12"><?= $data['meas'];?></td>
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