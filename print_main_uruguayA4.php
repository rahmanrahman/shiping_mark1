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
        <table style="font-size:62px; font-weight:bolder; line-height: 95px;">
            <tr>
                <td colspan="20">N.B.A.S.</td>
            </tr>
            <tr>
                <td>Carton #</td>
                <td>:</td>
                <td colspan="12"><?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td>P.O.#</td>
                <td>:</td>
                <td colspan="12"><?php echo $po ?></td>
            </tr>
            <tr >
                <td>Style #</td>
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
                <td style="font-size: 52px;" colspan="3">Color / Color Code </td>
                <td width="20px">:</td>
                <td colspan="12" style="font-size: 52px;"><?= $data['color'];?></td>
            </tr>
            <tr >
                <td colspan="3">Size / Width</td>
                <td>:</td>
                <td><?= $data['size']+0;?> / <?= $data['widht'];?></td>
            </tr>
            <tr>
                <td width="230px">QTY</td>
                <td width="20px">:</td>
                <td colspan="2"><?= $data['packing_metode'];?></td>
                <td>PAIRS</td>
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