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
<br><br><br><br>
    <?php $po = $_GET['po']; ?>
    <?php $all = getData(); $no = 1; ?>
    <?php foreach ($all as $data) { ?>
    <?php $total = $data['no_ctn'];?>
    <?php for ($i = 0; $i < $total; $i++){?>
        <table style="font-size:48px; font-weight:bolder; line-height: 70px;">
            <tr>
                <td colspan="15" style="font-size:60px;">NBSG</td>
            </tr>
            <tr>
                <td width="350px">Ship To</td>
                <td>:&nbsp;</td>
                <td colspan="12" style="font-size:44px;"> <?= $data['destination']; ?></td>
            </tr>
            <tr>
                <td>Gross Weight</td>
                <td>:</td>
                <td> <?= $data['gw'];?></td>
                <td>KGS</td>
            </tr>
            <tr>
                <td>Net Weight</td>
                <td>:</td>
                <td> <?= $data['nw'];?></td>
                <td>KGS</td>
            </tr>
            <tr>
                <td>Cubic Measure</td>
                <td>:</td>
                <td colspan="12"><?= $data['meas_carton'];?></td>
            </tr>
            <tr>
                <td>Country of Origin</td>
                <td>:</td>
                <td colspan="12">Indonesia</td>
            </tr>
        </table>
        <?php foreach (prs() as $key) { $key[0]; }?>
        <?php $no++; if($no == $key[0] + 1 ){
            echo "";
        }else{
            ?>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <?php }
        
        }
    }
    ?>
</body>
    <script>
        window.print();
    </script>
</html>