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
        <table style="font-size:80px; font-weight:bolder; line-height: 90px;">
            <tr>
                <td style="font-size:70px;" colspan="15">NEW BALANCE NEW ZEALAND</td>
            </tr>
            <tr>
                <td >PO#</td>
                <td>:</td>
                <td colspan="15"><?php echo $po ?></td>
            </tr>
            <tr>
                <td>SIZE</td>
                <td>:</td>
                <td><?= $data['size']+0;?></td>
            </tr>
            <tr>
                <td width="330px">CARTON#</td>
                <td>:</td>
                <td colspan="5"> <?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td colspan="15"><br></td>
            </tr>
            <tr>
                <td colspan="15">MADE IN INDONESIA</td>
            </tr>
            <tr>
                <td colspan="15"><br></td>
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