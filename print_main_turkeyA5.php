<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_packing_list.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shipping Mark</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif;">
    <?php $po = $_GET['po']; ?>
    <?php $all = getData1(); $no = 1; ?>
    <?php foreach ($all as $data) { ?>
    <?php $total = $data['no_ctn'];?>
    <?php for ($i = 0; $i < $total; $i++){?>
        <table style="font-size:34px; font-weight:bolder; line-height: 43px;">
            <tr >
                <td width="280px">PO#</td>
                <td width="30px">:</td>
                <td colspan="12"><?php echo $po;?></td>
            </tr>
            <tr>
                <td>STYLE#</td>
                <td>:</td>
                <td colspan="12"><?php 
                                    if(substr($data['sku'],-3) == 'NEW'){
                                        echo substr($data['sku'],0,-4);
                                    }elseif(substr($data['sku'],-4) == '(PE)') {
                                        echo substr($data['sku'],0,-5);
                                    }else{
                                        echo $data['sku'];
                                    } ?></td>
            </tr>
            <tr>
                <td>WIDTH</td>
                <td>:</td>
                <td colspan="12"><?= $data['widht'];?></td>
            </tr>
            <tr>
                <td>US SIZE</td>
                <td>:</td>
                <?php $allSize = getSize1();?>
                <?php foreach ($allSize as $dataSize) { ?>
                <td style="font-size:26px;" colspan = "1"><center><?php echo $dataSize['size']+0;?></center></td><?php } ?>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="<?php foreach (countData() as $key) { echo $key[0]; }?>"><hr size="1" color=yelow;></td>
            </tr>
            <tr>
                <td>EU SIZE</td>
                <td>:</td>
                <?php $allSize = getSize1();?>
                <?php foreach ($allSize as $dataSize) { ?>
                <td style="font-size:26px;" colspan = "1" width="300px"><center><?php if($dataSize['cust_id'] == "TURKEY"){
                                                                    if($dataSize["gender"] == "Men"){
                                                                        if($dataSize["size"] == "3.00"){ echo "35";}
                                                                        elseif($dataSize["size"] == "3.00"){ echo "35";}
                                                                        elseif($dataSize["size"] == "3.50"){ echo "35.5";}
                                                                        elseif($dataSize["size"] == "4.00"){ echo "36";}
                                                                        elseif($dataSize["size"] == "4.50"){ echo "37";}
                                                                        elseif($dataSize["size"] == "5.00"){ echo "37.5";}
                                                                        elseif($dataSize["size"] == "5.50"){ echo "38";}
                                                                        elseif($dataSize["size"] == "6.00"){ echo "38.5";}
                                                                        elseif($dataSize["size"] == "6.50"){ echo "39.5";}
                                                                        elseif($dataSize["size"] == "7.00"){ echo "40";}
                                                                        elseif($dataSize["size"] == "7.50"){ echo "40.5";}
                                                                        elseif($dataSize["size"] == "8.00"){ echo "41.5";}
                                                                        elseif($dataSize["size"] == "8.50"){ echo "42";}
                                                                        elseif($dataSize["size"] == "9.00"){ echo "42.5";}
                                                                        elseif($dataSize["size"] == "9.50"){ echo "43";}
                                                                        elseif($dataSize["size"] == "10.00"){ echo "44";}
                                                                        elseif($dataSize["size"] == "10.50"){ echo "44.5";}
                                                                        elseif($dataSize["size"] == "11.00"){ echo "45";}
                                                                        elseif($dataSize["size"] == "11.50"){ echo "45.5";}
                                                                        elseif($dataSize["size"] == "12.00"){ echo "46.5";}
                                                                        elseif($dataSize["size"] == "12.50"){ echo "47";}
                                                                        elseif($dataSize["size"] == "13.00"){ echo "47.5";}
                                                                        elseif($dataSize["size"] == "14.00"){ echo "49";}
                                                                        elseif($dataSize["size"] == "15.00"){ echo "50";}
                                                                        elseif($dataSize["size"] == "16.00"){ echo "51";}
                                                                        elseif($dataSize["size"] == "17.00"){ echo "52";}
                                                                        else{ echo "53";}
                                                                    }elseif($dataSize["gender"] == "Women"){
                                                                        if($dataSize["size"] == "5.00"){ echo "35";}
                                                                        elseif($dataSize["size"] == "5.50"){ echo "36";}
                                                                        elseif($dataSize["size"] == "6.00"){ echo "36.5";}
                                                                        elseif($dataSize["size"] == "6.50"){ echo "37";}
                                                                        elseif($dataSize["size"] == "7.00"){ echo "37.5";}
                                                                        elseif($dataSize["size"] == "7.50"){ echo "38";}
                                                                        elseif($dataSize["size"] == "8.00"){ echo "39";}
                                                                        elseif($dataSize["size"] == "8.50"){ echo "40";}
                                                                        elseif($dataSize["size"] == "9.00"){ echo "40.5";}
                                                                        elseif($dataSize["size"] == "9.50"){ echo "41";}
                                                                        elseif($dataSize["size"] == "10.00"){ echo "41.5";}
                                                                        elseif($dataSize["size"] == "10.50"){ echo "42.5";}
                                                                        elseif($dataSize["size"] == "11.00"){ echo "43";}
                                                                        elseif($dataSize["size"] == "11.50"){ echo "43.5";}
                                                                        elseif($dataSize["size"] == "12.00"){ echo "44";}
                                                                        elseif($dataSize["size"] == "12.50"){ echo "45";}
                                                                        else{ echo "45.5";}
                                                                    }elseif($dataSize["gender"] == "Infant"){
                                                                        if($dataSize["size"] == "2.00"){ echo "17";}
                                                                        elseif($dataSize["size"] == "2.50"){ echo "18";}
                                                                        elseif($dataSize["size"] == "3.00"){ echo "18.5";}
                                                                        elseif($dataSize["size"] == "3.50"){ echo "19";}
                                                                        elseif($dataSize["size"] == "4.00"){ echo "20";}
                                                                        elseif($dataSize["size"] == "4.50"){ echo "20.5";}
                                                                        elseif($dataSize["size"] == "5.00"){ echo "21";}
                                                                        elseif($dataSize["size"] == "5.50"){ echo "21.5";}
                                                                        elseif($dataSize["size"] == "6.00"){ echo "22.5";}
                                                                        elseif($dataSize["size"] == "6.50"){ echo "23";}
                                                                        elseif($dataSize["size"] == "7.00"){ echo "23.5";}
                                                                        elseif($dataSize["size"] == "7.50"){ echo "24";}
                                                                        elseif($dataSize["size"] == "8.00"){ echo "25";}
                                                                        elseif($dataSize["size"] == "8.50"){ echo "25.5";}
                                                                        elseif($dataSize["size"] == "9.00"){ echo "26";}
                                                                        elseif($dataSize["size"] == "9.50"){ echo "26.5";}
                                                                        else{ echo "27.5";}
                                                                    }else{
                                                                        if($dataSize["size"] == "10.50"){ echo "28";}
                                                                        elseif($dataSize["size"] == "11.00"){ echo "28.5";}
                                                                        elseif($dataSize["size"] == "11.50"){ echo "29";}
                                                                        elseif($dataSize["size"] == "12.00"){ echo "30";}
                                                                        elseif($dataSize["size"] == "12.50"){ echo "30.5";}
                                                                        elseif($dataSize["size"] == "13.00"){ echo "31";}
                                                                        elseif($dataSize["size"] == "13.50"){ echo "32";}
                                                                        elseif($dataSize["size"] == "1.00"){ echo "32.5";}
                                                                        elseif($dataSize["size"] == "1.50"){ echo "33";}
                                                                        elseif($dataSize["size"] == "2.00"){ echo "33.5";}
                                                                        elseif($dataSize["size"] == "2.50"){ echo "34.5";}
                                                                        elseif($dataSize["size"] == "3.00"){ echo "35";}
                                                                        elseif($dataSize["size"] == "3.50"){ echo "35.5";}
                                                                        elseif($dataSize["size"] == "4.00"){ echo "36";}
                                                                        elseif($dataSize["size"] == "4.50"){ echo "37";}
                                                                        elseif($dataSize["size"] == "5.00"){ echo "37.5";}
                                                                        elseif($dataSize["size"] == "5.50"){ echo "38";}
                                                                        elseif($dataSize["size"] == "6.00"){ echo "38.5";}
                                                                        elseif($dataSize["size"] == "6.50"){ echo "39";}
                                                                        else{ echo "40";}
                                                                    }

                                                                } ?></center></td><?php } ?>
            </tr>
            <tr>
                <td>QTY/PRS</td>
                <td>:</td>
                <?php $allSize = getSize1();?>
                <?php foreach ($allSize as $dataSize) { ?>
                <td style="font-size:26px;" colspan = "1" width="300px"><center><?php echo $dataSize['packing_metode1'];?></center></td><?php } ?>
                <td style="font-size:26px;">PRS</td>
            </tr>
            <tr>
                <td>CARTON#</td>
                <td>:</td>
                <td colspan="12"> <?= $no++ ?> OF <?php echo $total ?></td>
            </tr>
            <tr>
                <td>N.W</td>
                <td>:</td>
                <td colspan="5"><?php foreach (subtotalNW() as $key) { echo $key[0]; }?></td>
            </tr>
            <tr>
                <td>G.W</td>
                <td>:</td>
                <td colspan="5"><?php foreach (subtotalGW() as $key) { echo $key[0]; }?></td>
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