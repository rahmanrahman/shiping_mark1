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
        <table style="font-size:32px; font-weight:bolder; line-height: 46px;">
            <tr>
                <td colspan="15">"Kohl's Department Stores"</td>
            </tr>
            <tr>
                <td colspan="15">New Balance</td>
            </tr>
            <tr>
                <td colspan="15">INDONESIA</td>
            </tr>
            <tr>
                <td width="260px">Kohl's PO#</td>
                <td>:</td>
                <td colspan="15"><?php echo $po ?></td>
            </tr>
            <tr>
                <td>Style No. </td>
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
                <td>Prepack No.</td>
                <td>:</td>
                <td colspan="15"><?= $data['code'];?></td>
            </tr>
            <tr>
                <td>SIZE</td>
                <td>:</td>
                <?php $allSize = getSize1();?>
                <?php foreach ($allSize as $dataSize) { ?>
                <td style="font-size : 24px;" colspan="1" width="65px"><center><?php echo $dataSize['size']+0;?></center></td><?php } ?>
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
                    <td style="font-size : 26px;" colspan="1"><center><?php echo $dataSize['packing_metode1'];?></center></td><?php } ?>
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