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
        <table style="font-size:38px; font-weight:bolder; line-height: 42px;">
            <tr >
                <td colspan="15">FOOTWEAR</td>
            </tr>
            <tr >
                <td width="230px">SHIPPER</td>
                <td width="15px">:</td>
                <td colspan="15">PT. Metro Pearl Indonesia</td>
            </tr>
            <tr>
                <td>CARTON NO</td>
                <td>:</td>
                <td colspan="15"><?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr >
                <td>STYLE CODE</td>
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
                <td>QUANTITY</td>
                <td>:</td>
                <td width="100px"><?= $data['packing_metode'];?></td>
                <td colspan="2">PRS</td>
            </tr>
            <tr>
                <td>SIZE</td>
                <td>:</td>
                <td colspan="15"><?= $data['size']+0;?></td>
            </tr>
            <tr>
                <td>SHIP TO</td>
                <td>:</td>
                <td colspan="15">Map Active Philippines Inc.</td>
            </tr>
            <tr>
                <td colspan="3">COUNTRY OF ORIGIN</td>
                <td>:</td>
                <td>INDONESIA</td>
            </tr>
            <tr>
                <td>GW</td>
                <td>:</td>
                <td><?= $data['gw'];?></td>
                <td colspan="2">KGS</td>
            </tr>
            <tr>
                <td>NW</td>
                <td>:</td>
                <td><?= $data['nw'];?></td>
                <td colspan="2">KGS</td>
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