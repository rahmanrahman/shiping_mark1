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
        <table style="font-size: 34px; font-weight:bolder; line-height: 56px;">
            <tr>
                <td colspan="2" width="250px">STYLE CODE</td>
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
            <tr>
                <td colspan="2">COLOR</td>
                <td>:</td>
                <td colspan="12"><?= $data['color'];?></td>
            </tr>
            <tr>
                <td>SIZE</td>
                <?php $allSize = getSize1();?>
                <?php foreach ($allSize as $dataSize) { ?>
                <td style="font-size : 26px;" colspan = "1" width="50px"><center><?php echo $dataSize['size']+0;?></center></td><?php } ?>
            </tr>
            <tr>
                <td></td>
                <td colspan="<?php foreach (countData() as $key) { echo $key[0]; }?>"><hr size="1" color=yelow;></td>
            </tr>
            <tr>
                <td>QTY</td>
                <?php $allSize = getSize1();?>
                <?php foreach ($allSize as $dataSize) { ?>
                <td style="font-size : 26px;" colspan = "1" width="50px"><center><?php echo $dataSize['packing_metode1'];?></center></td><?php } ?>
            </tr>
            <tr>
                <td colspan="2">CARTON NO</td>
                <td>:</td>
                <td colspan="12"> <?= $no++ ?> OF <?php echo $total ?></td>
            </tr>
            <tr>
                <td colspan="15">MADE IN INDONESIA</td>
            </tr>
            <tr>
                <td colspan="15">SPORT ICON S.A</td>
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