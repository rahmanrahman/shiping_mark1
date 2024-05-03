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
        <table style="font-size:75px; font-weight:bolder; line-height: 83px;">
            <tr >
                <td width="320px">PO #</td>
                <td width="30px">:</td>
                <td colspan="15"><?php echo $po ?></td>
            </tr>
            <tr >
                <td>Style #</td>
                <td>:</td>
                <td colspan="15"><?php 
                                    if(substr($data['sku'],-3) == 'NEW'){
                                        echo substr($data['sku'],0,-4);
                                    }elseif(substr($data['sku'],-4) == '(PE)') {
                                        echo substr($data['sku'],0,-5);
                                    }else{
                                        echo $data['sku'];
                                    } ?></td>
            </tr>
            <tr >
                <td>Color</td>
                <td>:</td>
                <td style="font-size: 70px;" colspan="15"><?= $data['color'];?></td>
            </tr>
            <tr >
                <td>Size</td>
                <td>:</td>
                <td colspan="15"><?= $data['size']+0;?></td>
            </tr>
            <tr >
                <td>Width</td>
                <td>:</td>
                <td colspan="15"><?= $data['widht'];?></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td>:</td>
                <td><?= $data['packing_metode'];?></td>
                <td colspan="13">PRS</td>
            </tr>
            <tr>
                <td>N.W.</td>
                <td>:</td>
                <td><?= $data['nw'];?></td>
                <td colspan="13">KGS</td>
            </tr>
            <tr>
                <td>G.W.</td>
                <td>:</td>
                <td><?= $data['gw'];?></td>
                <td colspan="13">KGS</td>
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