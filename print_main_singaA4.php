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
        <table style="font-size:70px; font-weight:bolder; line-height: 95px;">
            <tr >
                <td colspan="15">NBSG</td>
            </tr>
            <tr>
                <td>Carton #</td>
                <td>:&nbsp;</td>
                <td colspan="12"><?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td>P.O. #</td>
                <td>:&nbsp;</td>
                <td colspan="12"><?= $po ?></td>
            </tr>
            <tr>
                <td>Style #</td>
                <td>:&nbsp;</td>
                <td colspan="12"><?php 
                                    if(substr($data['sku'],-3) == 'NEW'){
                                        echo substr($data['sku'],0,-4);
                                    }elseif(substr($data['sku'],-4) == '(PE)') {
                                        echo substr($data['sku'],0,-5);
                                    }else{
                                        echo $data['sku'];
                                    } ?></td>
            </tr>
            <tr >
                <td>Color Code</td>
                <td>:&nbsp;</td>
                <td colspan="12"><?= $data['color'];?></td>
            </tr>
            <tr >
                <td>Size</td>
                <td>:&nbsp;</td>
                <td colspan="12"><?= $data['size']+0;?></td>
            </tr>
            <tr>
                <td>QTY</td>
                <td>:</td>
                <td><?= $data['packing_metode'];?></td>
                <td>PRS</td>
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