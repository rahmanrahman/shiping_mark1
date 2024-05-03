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
        <table style="font-size:72px; font-weight:bolder; line-height: 83px;">
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
                <td><br></td>
            </tr>
            <tr >
                <td>Kohl's PO#</td>
                <td>:</td>
                <td colspan="15"><?php echo $po ?></td>
            </tr>
            <tr>
                <td>Style No.</td>
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
                <td>Size</td>
                <td>:</td>
                <td colspan="15"><?= $data['size']+0;?></td>
            </tr>
            <tr>
                <td>QTY</td>
                <td>:</td>
                <td><?= $data['packing_metode'];?></td>
                <td>Pairs</td>
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