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
        <table style="font-size:36px; font-weight:bold; line-height: 74px;">
            <tr >
                <td style="font-size:32px;" colspan="12">NEW BRASIL ARTIGOS ESPORTIVOS LTDA</td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr >
                <td width="280px">PO#</td>
                <td width="30px">:</td>
                <td colspan="12"><?php echo $po;?></td>
            </tr>
            <tr>
                <td>SIZE</td>
                <td>:</td>
                <td><?= $data['size']+0;?></td>
            </tr>
            <tr>
                <td>CARTON#</td>
                <td>:</td>
                <td colspan="12"> <?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td colspan="12">MADE IN INDONESIA</td>
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