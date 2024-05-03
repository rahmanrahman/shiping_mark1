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
        <table style="font-size:40px; font-weight:bolder; line-height: 45px;">
        <tr>
                <td width="100px">PO#</td>
                <td>:</td>
                <td colspan="15"><?php echo $po ?></td>
            </tr>
            <tr>
                <td width="100px">STYLE#</td>
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
                <td>COLOR</td>
                <td>:</td>
                <td colspan="20"><?= $data['color'];?></td>
            </tr>
            <tr>
                <td>US SIZE</td>
                <td>:</td>
                <td width="100px"><?= $data['size']+0;?></td>
                <td>MEX SIZE</td>
                <td width="20px">:</td>
                <td><?php
                        if($data["gender"] == "Men"){
                            if($data["size"] == "4.00"){ echo "22";}
                            elseif($data["size"] == "4.50"){ echo "22.5";}
                            elseif($data["size"] == "5.00"){ echo "23";}
                            elseif($data["size"] == "5.50"){ echo "23.5";}
                            elseif($data["size"] == "6.00"){ echo "24";}
                            elseif($data["size"] == "6.50"){ echo "24.5";}
                            elseif($data["size"] == "7.00"){ echo "25";}
                            elseif($data["size"] == "7.50"){ echo "25.5";}
                            elseif($data["size"] == "8.00"){ echo "26";}
                            elseif($data["size"] == "8.50"){ echo "26.5";}
                            elseif($data["size"] == "9.00"){ echo "27";}
                            elseif($data["size"] == "9.50"){ echo "27.5";}
                            elseif($data["size"] == "10.00"){ echo "28";}
                            elseif($data["size"] == "10.50"){ echo "28.5";}
                            elseif($data["size"] == "11.00"){ echo "29";}
                            elseif($data["size"] == "11.50"){ echo "29.5";}
                            elseif($data["size"] == "12.00"){ echo "30";}
                            elseif($data["size"] == "12.50"){ echo "30.5";}
                            elseif($data["size"] == "13.00"){ echo "31";}
                            elseif($data["size"] == "14.00"){ echo "32";}
                            else{ echo "33";}
                        }elseif($data["gender"] == "Women" ){
                            if($data["size"] == "4.50"){ echo "21.5";}
                            elseif($data["size"] == "5.00"){ echo "22";}
                            elseif($data["size"] == "5.50"){ echo "22.5";}
                            elseif($data["size"] == "6.00"){ echo "23";}
                            elseif($data["size"] == "6.50"){ echo "23.5";}
                            elseif($data["size"] == "7.00"){ echo "24";}
                            elseif($data["size"] == "7.50"){ echo "24.5";}
                            elseif($data["size"] == "8.00"){ echo "25";}
                            elseif($data["size"] == "8.50"){ echo "25.5";}
                            elseif($data["size"] == "9.00"){ echo "26";}
                            elseif($data["size"] == "9.50"){ echo "26.5";}
                            elseif($data["size"] == "10.00"){ echo "27";}
                            elseif($data["size"] == "10.50"){ echo "27.5";}
                            elseif($data["size"] == "11.00"){ echo "28";}
                            elseif($data["size"] == "11.50"){ echo "28.5";}
                            else{ echo "29";}
                        }elseif($data["gender"] == "Infant"){
                            if($data["size"] == "3.00"){ echo "10";}
                            elseif($data["size"] == "4.00"){ echo "11";}
                            elseif($data["size"] == "4.50"){ echo "11.5";}
                            elseif($data["size"] == "5.00"){ echo "12";}
                            elseif($data["size"] == "5.50"){ echo "12";}
                            elseif($data["size"] == "6.00"){ echo "12.5";}
                            elseif($data["size"] == "6.50"){ echo "13";}
                            elseif($data["size"] == "7.00"){ echo "13.5";}
                            elseif($data["size"] == "8.00"){ echo "14.5";}
                            elseif($data["size"] == "8.50"){ echo "15";}
                            elseif($data["size"] == "9.00"){ echo "15";}
                            elseif($data["size"] == "9.50"){ echo "15.5";}
                            else{ echo "16";}
                        }else{
                            if($data["size"] == "10.50"){ echo "16.5";}
                            elseif($data["size"] == "11.00"){ echo "17";}
                            elseif($data["size"] == "11.50"){ echo "17.5";}
                            elseif($data["size"] == "12.00"){ echo "17.5";}
                            elseif($data["size"] == "12.50"){ echo "18";}
                            elseif($data["size"] == "13.00"){ echo "18.5";}
                            elseif($data["size"] == "13.50"){ echo "19";}
                            elseif($data["size"] == "1.00"){ echo "19";}
                            elseif($data["size"] == "1.50"){ echo "19.5";}
                            elseif($data["size"] == "2.00"){ echo "20";}
                            elseif($data["size"] == "2.50"){ echo "20.5";}
                            elseif($data["size"] == "3.00"){ echo "21";}
                            elseif($data["size"] == "3.50"){ echo "21.5";}
                            elseif($data["size"] == "4.00"){ echo "22";}
                            elseif($data["size"] == "4.50"){ echo "22.5";}
                            elseif($data["size"] == "5.00"){ echo "23";}
                            elseif($data["size"] == "5.50"){ echo "23.5";}
                            elseif($data["size"] == "6.00"){ echo "24";}
                            elseif($data["size"] == "6.50"){ echo "24.5";}
                            else{ echo "25";}
                        } ?></td>
            </tr>
            <tr>
                <td>WIDTH</td>
                <td>:</td>
                <td colspan="15"><?= $data['widht'];?></td>
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