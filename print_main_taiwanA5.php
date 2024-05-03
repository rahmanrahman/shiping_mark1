<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_output.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shipping Mark</title>
</head>
<body style="font-family: Book Antiqua, Helvetica, sans-serif;">
    <?php $po = $_GET['po']; ?>
    <?php $all = getData(); $no = 1; ?>
    <?php foreach ($all as $data) { ?>
    <?php $total = $data['no_ctn'];?>
    <?php for ($i = 0; $i < $total; $i++){?>
        <table style="font-size:50px; font-weight:bolder; line-height: 63px;">
            <tr >
                <td colspan="15" style="text-align: center;" width="1200px"><img src="img/persegi.png" width="550px"></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right;" width="400px">Carton #</td>
                <td style="text-align: right;"><?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td style="text-align: right;" colspan="15">Made In Indonesia</td>
            </tr>
            <tr>
                <td style="text-align: right;" colspan="15">Keelung, Taiwan</td>
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