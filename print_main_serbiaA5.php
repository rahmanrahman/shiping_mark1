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
        <table style="font-size:60px; font-weight:bolder; line-height: 63px;">
            <tr >
                <td width="280px">P.O. #</td>
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
                <td>Width</td>
                <td>:</td>
                <td><?= $data['widht'];?></td>
            </tr>
            <tr >
                <td>Size</td>
                <td>:</td>
                <td><?= $data['size']+0;?></td>
            </tr>
            <tr>
                <td>CARTON #</td>
                <td>:</td>
                <td colspan="15"><?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td>QTY</td>
                <td>:</td>
                <td><?= $data['packing_metode'];?></td>
                <td>PRS</td>
            </tr>
            <tr>
                <td colspan="15">MADE IN INDONESIA</td>
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