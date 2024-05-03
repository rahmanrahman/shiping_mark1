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
<br><br><br><br><br>
    <?php $po = $_GET['po']; ?>
    <?php $all = getData(); $no = 1; ?>
    <?php foreach ($all as $data) { ?>
    <?php $total = $data['no_ctn'];?>
    <?php for ($i = 0; $i < $total; $i++){?>
        <table style="font-size:39px; font-weight:bolder; line-height: 60px;">
            <tr>
                <td colspan="15">MAP ACTIVE ADIPERKASA LTD (THAILAND)</td>
            </tr>
            <tr>
                <td width="320px">CUSTOMER PO NO.</td>
                <td>:</td>
                <td colspan="12"><?= $po ?></td>
            </tr>
            <tr>
                <td>Q'TY</td>
                <td>:</td>
                <td width="70px"><?= $data['packing_metode'];?></td>
                <td>PRS</td>
            </tr>
            <tr>
                <td>CARTON NO</td>
                <td>:</td>
                <td colspan="13"><?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
        </table>
        <?php if($no == $key[0] + 1){
            echo "";
        }else{
            ?>
            <br><br><br><br><br><br><br><br><br><br><br>
        <?php }
        
        }
    }
    ?>
</body>
    <script>
        window.print();
    </script>
</html>