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
        <table style="font-size:56px; font-weight:bolder; line-height: 63px;">
            <tr>
                <td width="280px">PO. NO</td>
                <td width="30px">:</td>
                <td colspan="15"><?php echo $po ?></td>
            </tr>
            <tr >
                <td>Style No</td>
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
                <td>Size</td>
                <td>:</td>
                <td><?= $data['size']+0;?></td>
                <td width="140px">Width</td>
                <td width="40px">:</td>
                <td><?= $data['widht'];?></td>
            </tr>
            <tr>
                <td>QTY</td>
                <td>:</td>
                <td><?= $data['packing_metode'];?></td>
                <td>PRS</td>
            </tr>
            <tr>
                <td>Carton No.</td>
                <td>:</td>
                <td colspan="15"><?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr >
                <td>N.W.</td>
                <td>:</td>
                <td><?= $data['nw'];?></td>
                <td>KGS</td>
            </tr>
            <tr >
                <td>G.W.</td>
                <td>:</td>
                <td width="140px"><?= $data['gw'];?></td>
                <td>KGS</td>
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