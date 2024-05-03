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
        <table style="font-size:38px; font-weight:bolder; line-height: 44px;">
            <tr >
                <td width="280px">PO#</td>
                <td width="30px">:</td>
                <td colspan="12"><?php echo $po;?></td>
            </tr>
            <tr>
                <td>STYLE#</td>
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
                <td>COLOR</td>
                <td>:</td>
                <td colspan="12"><?= $data['color'];?></td>
            </tr>
            <tr>
                <td>WIDTH</td>
                <td>:</td>
                <td colspan="12"><?= $data['widht'];?></td>
            </tr>
            <tr>
                <td>SIZE</td>
                <td>:</td>
                <?php $allSize = getSize1();?>
                <?php foreach ($allSize as $dataSize) { ?>
                <td colspan = "1" width="300px"><center><?php echo $dataSize['size']+0;?></center></td><?php } ?>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="<?php foreach (countData() as $key) { echo $key[0]; }?>"><hr size="1" color=yelow;></td>
            </tr>
            <tr>
                <td>QTY/PRS</td>
                <td>:</td>
                <?php $allSize = getSize1();?>
                <?php foreach ($allSize as $dataSize) { ?>
                    <td colspan = "1" width="300px"><center><?php echo $dataSize['packing_metode1'];?></center></td><?php } ?>
            </tr>
            <tr>
                <td>CARTON#</td>
                <td>:</td>
                <td colspan="12"> <?= $no++ ?> OF <?php echo $total ?></td>
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