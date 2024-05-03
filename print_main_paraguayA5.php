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
        <table style="font-size:50px; font-weight:bold; line-height: 70px;">
        <tr>
                <td colspan="15">NEW BALANCE</td>
            </tr>
            <tr>
                <td>PO#</td>
                <td>:</td>
                <td colspan="5"><?php echo $po ?></td>
            </tr>
            <tr>
                <td>SIZE</td>
                <td>:</td>
                <td colspan="5"><?= $data['size']+0 ?></td>
            </tr>
            <tr>
                <td>Q'TY</td>
                <td>:</td>
                <td><?= $data['packing_metode'];?></td>
                <td>PRS</td>
            </tr>
            <tr>
                <td>CARTON#</td>
                <td>:</td>
                <td colspan="12"> <?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
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