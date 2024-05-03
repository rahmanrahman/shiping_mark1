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
        <table style="font-size:42px; font-weight:bolder; line-height: 60px;">
            <tr>
                <td style="font-size:50px;" colspan="15">PF FLYER</td>
            </tr>    
            <tr>
                <td width="180px">STYLE#</td>
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
            <tr>
                <td style="vertical-align: top;" >MEAS</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;" colspan="15"><?php if($data['carton_code'] == "NBL1-MZ"){ echo "445X330X200MM";}
                                                                    elseif($data['carton_code'] == "NBL1.5-MZ"){ echo "510X380X230MM";}
                                                                    elseif($data['carton_code'] == "NBL2-MZ"){ echo "560X420X260MM";}
                                                                    elseif($data['carton_code'] == "NBL3-MZ"){ echo "583X430X287MM";}
                                                                    elseif($data['carton_code'] == "NBL4-MZ"){ echo "563X490X325MM";}
                                                                    elseif($data['carton_code'] == "NBL5-MZ"){ echo "560X520X340MM";}
                                                                    elseif($data['carton_code'] == "NBL6-MZ"){ echo "614X496X340MM";}
                                                                    elseif($data['carton_code'] == "NBL6.5-MZ"){ echo "644X536X345MM";}
                                                                    elseif($data['carton_code'] == "NBL7-MZ"){ echo "690X540X360MM";}
                                                                    elseif($data['carton_code'] == "NBL8-MZ"){ echo "745X560X390MM";}
                                                                    elseif($data['carton_code'] == "NBL8.5-MZ"){ echo "865X563X410MM";}
                                                                    elseif($data['carton_code'] == "NBL9-MZ"){ echo "923X573X430MM";}
                                                                    elseif($data['carton_code'] == "NBLA1-MX"){ echo "300X255X205MM";}
                                                                    elseif($data['carton_code'] == "NBLA1.5-MX"){ echo "345X285X230MM";}
                                                                    elseif($data['carton_code'] == "NBLA2-MX"){ echo "375X315X260MM";}
                                                                    elseif($data['carton_code'] == "NBLA3-MX"){ echo "390X325X287MM";}
                                                                    elseif($data['carton_code'] == "NBLA4-MX"){ echo "375X370X325MM";}
                                                                    elseif($data['carton_code'] == "NBLA5-MX"){ echo "390X385X340MM";}
                                                                    elseif($data['carton_code'] == "NBLA6-MX"){ echo "407X376X340MM";}
                                                                    elseif($data['carton_code'] == "NBLA6.5-MX"){ echo "427X405X345MM";}
                                                                    elseif($data['carton_code'] == "NBLA7-MX"){ echo "477X417X365MM";}
                                                                    elseif($data['carton_code'] == "NBLA8-MX"){ echo "495X425X390MM";}
                                                                    elseif($data['carton_code'] == "NBLA8.5-MX"){ echo "567X440X405MM";}
                                                                    elseif($data['carton_code'] == "NBLA9-MX"){ echo "620X450X430MM";}
                                                                    elseif($data['carton_code'] == "NBL1-MQ"){ echo "450X255X205MM";}
                                                                    elseif($data['carton_code'] == "NBL1.5-MQ"){ echo "510X285X230MM";}
                                                                    elseif($data['carton_code'] == "NBL2-MQ"){ echo "560X315X260MM";}
                                                                    elseif($data['carton_code'] == "NBL3-MQ"){ echo "583X325X287MM";}
                                                                    elseif($data['carton_code'] == "NBL4-MQ"){ echo "563X370X325MM";}
                                                                    elseif($data['carton_code'] == "NBL5-MQ"){ echo "560X390X340MM";}
                                                                    elseif($data['carton_code'] == "NBL6-MQ"){ echo "614X376X340MM";}
                                                                    elseif($data['carton_code'] == "NBL6.5-MQ"){ echo "644X405X345MM";}
                                                                    elseif($data['carton_code'] == "NBL7-MQ"){ echo "708X417X365MM";}
                                                                    elseif($data['carton_code'] == "NBL8-MQ"){ echo "745X425X390MM";}
                                                                    else{ echo "855X428X400MM";}
                ?></td>
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