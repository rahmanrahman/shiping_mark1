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
        <table style="font-size:54px; font-weight:bolder; line-height: 82px;">
            <tr>
                <td width="280px">PO#</td>
                <td width="30px">:</td>
                <td colspan="5"><?php echo $po;?></td>
            </tr>
            <tr>
                <td>STYLE#</td>
                <td>:</td>
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
                <td width="300px"><?= $data['size']+0;?></td>
                <td width="250px" >WIDTH</td> 
                <td width="30px">:</td>
                <td><?= $data['widht'];?></td>
                <td width="500px"></td>
            </tr>
            <tr>
                <td>QTY</td>
                <td>:</td>
                <td><?= $data['packing_metode'];?></td>
                <td>PRS</td>
            </tr>
            <tr>
                <td>CARTON#</td>
                <td>:</td>
                <td colspan="5"> <?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td>N.W</td>
                <td>:</td>
                <td><?= $data['nw'];?></td>
                <td>KGS</td>
            </tr>
            <tr>
                <td>G.W</td>
                <td>:</td>
                <td><?= $data['gw'];?></td>
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