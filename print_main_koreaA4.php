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
        <table style="font-size:60px; font-weight:bolder; line-height: 113px;">
            <tr>
                <td style="font-size:70px;" colspan="15">NEW BALANCE</td>
                
            </tr>
            <tr>
                <td width="280px">PO#</td>
                <td width="30px">:</td>
                <td colspan="5"><?php echo $po;?></td>
            </tr>
            <tr>
                <td>STYLE#</td>
                <td>:</td>
                <td colspan="5"><?php 
                                    if(substr($data['sku'],-3) == 'NEW'){
                                        echo substr($data['sku'],0,-4);
                                    }elseif(substr($data['sku'],-4) == '(PE)') {
                                        echo substr($data['sku'],0,-5);
                                    }else{
                                        echo $data['sku'];
                                    } ?></td>
            </tr>
            <tr>
                <td>SIZE</td>
                <td>:</td>
                <td width="130px"><?= $data['size']+0;?></td>
                <td width="370px" colspan="2">AND KOREA</td> 
                <td width="30px">:</td>
                <td><?php 
                        if($data["gender"] == "Men"){
                            if($data["size"] == "4.00"){ echo "220";}
                            elseif($data["size"] == "4.50"){ echo "225";}
                            elseif($data["size"] == "5.00"){ echo "230";}
                            elseif($data["size"] == "5.50"){ echo "235";}
                            elseif($data["size"] == "6.00"){ echo "240";}
                            elseif($data["size"] == "6.50"){ echo "245";}
                            elseif($data["size"] == "7.00"){ echo "250";}
                            elseif($data["size"] == "7.50"){ echo "255";}
                            elseif($data["size"] == "8.00"){ echo "260";}
                            elseif($data["size"] == "8.50"){ echo "265";}
                            elseif($data["size"] == "9.00"){ echo "270";}
                            elseif($data["size"] == "9.50"){ echo "275";}
                            elseif($data["size"] == "10.00"){ echo "280";}
                            elseif($data["size"] == "10.50"){ echo "285";}
                            elseif($data["size"] == "11.00"){ echo "290";}
                            elseif($data["size"] == "11.50"){ echo "295";}
                            elseif($data["size"] == "12.00"){ echo "300";}
                            else{ echo "310";}
                        }elseif($data["gender"] == "Women" ){
                            if($data["size"] == "5.00"){ echo "220";}
                            elseif($data["size"] == "5.50"){ echo "225";}
                            elseif($data["size"] == "6.00"){ echo "230";}
                            elseif($data["size"] == "6.50"){ echo "235";}
                            elseif($data["size"] == "7.00"){ echo "240";}
                            elseif($data["size"] == "7.50"){ echo "245";}
                            elseif($data["size"] == "8.00"){ echo "250";}
                            elseif($data["size"] == "8.50"){ echo "255";}
                            elseif($data["size"] == "9.00"){ echo "260";}
                            elseif($data["size"] == "9.50"){ echo "265";}
                            elseif($data["size"] == "10.00"){ echo "270";}
                            elseif($data["size"] == "10.50"){ echo "275";}
                            elseif($data["size"] == "11.00"){ echo "280";}
                            elseif($data["size"] == "11.50"){ echo "285";}
                            else{ echo "290";}
                        }elseif($data["gender"] == "Infant"){
                            if($data["size"] == "2.00"){ echo "80";}                                                                        elseif($data["size"] == "3.00"){ echo "90";}
                            elseif($data["size"] == "4.00"){ echo "100";}
                            elseif($data["size"] == "4.50"){ echo "105";}
                            elseif($data["size"] == "5.00"){ echo "110";}
                            elseif($data["size"] == "5.50"){ echo "115";}
                            elseif($data["size"] == "6.00"){ echo "120";}
                            elseif($data["size"] == "6.50"){ echo "125";}
                            elseif($data["size"] == "7.00"){ echo "130";}
                            elseif($data["size"] == "7.50"){ echo "135";}
                            elseif($data["size"] == "8.00"){ echo "140";}
                            elseif($data["size"] == "8.50"){ echo "145";}
                            elseif($data["size"] == "9.00"){ echo "150";}
                            elseif($data["size"] == "9.50"){ echo "155";}
                            else{ echo "160";}
                        }else{
                            if($data["size"] == "10.50"){ echo "165";}
                            elseif($data["size"] == "11.00"){ echo "170";}
                            elseif($data["size"] == "11.50"){ echo "175";}                                                                        elseif($data["size"] == "12.00"){ echo "180";}
                            elseif($data["size"] == "12.50"){ echo "185";}
                            elseif($data["size"] == "13.00"){ echo "190";}
                            elseif($data["size"] == "13.50"){ echo "195";}
                            elseif($data["size"] == "1.00"){ echo "200";}
                            elseif($data["size"] == "1.50"){ echo "205";}
                            elseif($data["size"] == "2.00"){ echo "210";}
                            elseif($data["size"] == "2.50"){ echo "215";}
                            elseif($data["size"] == "3.00"){ echo "220";}
                            elseif($data["size"] == "3.50"){ echo "225";}
                            elseif($data["size"] == "4.00"){ echo "230";}
                            elseif($data["size"] == "4.50"){ echo "235";}
                            elseif($data["size"] == "5.00"){ echo "235";}
                            elseif($data["size"] == "5.50"){ echo "240";}
                            elseif($data["size"] == "6.00"){ echo "240";}
                            elseif($data["size"] == "6.50"){ echo "245";}
                            else{ echo "250";} 
                        } ?></td>
            </tr>
            <tr>
                <td>CARTON#</td>
                <td>:</td>
                <td colspan="5"> <?= $no++ ?> OF <?php foreach (prs() as $key) { echo $key[0]; }?></td>
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