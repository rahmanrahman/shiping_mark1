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
        <table style="font-size:64px; font-weight:bolder; line-height: 73px;">
            <tr>
                <td colspan="15">CRC SPORTS CO.,LTD. (WAREHOUSE)</td>
            </tr>
            <tr>
                <td colspan="15">57/4 MOO 7, BANG PLA,</td>
            </tr>
            <tr>
                <td colspan="15">BANG PHLI SAMUTPRAKAN 10540,</td>
            </tr>
            <tr>
                <td colspan="15">THAILAND</td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td width="180px">MEAS</td>
                <td width="50px">:</td>
                <td style="font-size:55px;" colspan="15"><?= $data['meas'];?> CUFT</td>
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