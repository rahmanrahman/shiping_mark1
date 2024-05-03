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
        <table style="font-size:64px; font-weight:bolder; line-height: 93px;">
            <tr>
                <td width="460px">STYLE CODE</td>
                <td width="40px">:</td>
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
                <td>COLOR</td>
                <td>:</td>
                <td colspan="5"><?= $data['color'];?></td>
            </tr>
            <tr>
                <td>SIZE</td>
                <td>:</td>
                <td colspan="5"><?= $data['size']+0;?></td>
            </tr>
            <tr>
                <td>QTY</td>
                <td>:</td>
                <td><?= $data['packing_metode'];?></td>
            </tr>
            <tr>
                <td>CARTON NO</td>
                <td>:</td>
                <td colspan="12"> <?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td colspan="15">MADE IN INDONESIA</td>
            </tr>
            <tr>
                <td colspan="15">SPORT DESIGN S.A</td>
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