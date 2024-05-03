<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_invoice.php';
    header("Content-type:application/vnd-ms-excel");
    $id_invoice   = $_GET['id_invoice'];
    $get  = showData($id_invoice);
?>
<?php
    foreach ($get as $data) { 
    $a = $data['invoice_no'];
    header("Content-Disposition: attachment; filename= Packing List $a.xls")
?>

<?php } ?>
<table>
    <th colspan = "15"><h3><u>PACKING LIST</u></h3></th>
</table>
<br>
<br>
<table>
    <thead>
        <tr>
            <td style="text-align: center;" colspan="2"><b>CONTAINER NO:</b></td>
            <td style="text-align: center;" colspan="2"><b>TBA</b></td>
            <td></td>
            <td style="text-align: center;"><b>SEAL NO :</b></td>
            <td style="text-align: center;" colspan="2"><b>TBA</b></td>
            <td colspan="4"></td>
        </tr>
    </thead>
</table>
<table border="1">
	<thead>
        <tr>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Factory Code</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Man Po</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Customer Po</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Po Reference</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Color</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Style No</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Width</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Size</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Qty</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Carton Number</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Total Carton</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">Ctn/Prs</th>
            <th colspan="2" style="text-align: center;">NW/GW(kgs)</th>
            <th rowspan="2" style="vertical-align: middle; text-align: center;">CBM</th>
        </tr>
        <tr>
            <th style="text-align: center;">NW</th>
            <th style="text-align: center;">GW</th>
        </tr>
    </thead>
    <tbody>
        <?php $subtotalnw = $subtotalgw = $subtotalcbm = $subtotalprs = $subtotalctn = 0; ?>
        <?php $grandprs = $grandctn = $grandnw = $grandgw = $grandcbm = $hasilnw = $hasilgw = $anw = $agw = $acbm = $bnw = $bgw = $bcbm = 0; ?>
        <?php $totalhasilnw = $totalhasilgw = $totalhasilcbm = 0; ?>
        <?php $all = getPacking(); $no = 1; ?>
        <?php foreach ($all as $row => $data) { 
            $totalnw = $data['totalnw'];
            $totalgw = $data['totalgw'];
            $totalcbm = $data['totalcbm'];
            $subtotalnw += $totalnw;
            $subtotalgw += $totalgw;
            $subtotalcbm += $totalcbm;
            $subtotalprs += $data['qty_prs'];
            $subtotalctn += $data['no_ctn'];
            $grandprs += $data['qty_prs'];
            $grandctn += $data['no_ctn'];
            $hasilnw = $data['nilainw'] * $data['no_ctn'];
            $hasilgw = $data['nilaigw'] * $data['no_ctn'];
            $hasilcbm = $data['nilaicbm'] * $data['no_ctn'];
            $totalhasilnw += $hasilnw;
            $totalhasilgw += $hasilgw;
            $totalhasilcbm += $hasilcbm;
            $grandnw += $totalnw;
            $grandgw += $totalgw;
            $grandcbm += $totalcbm;
            $anw += $totalhasilnw;
            $agw += $totalhasilgw;
            $acbm += $hasilcbm;
            $bnw = $anw + $grandnw;
            $bgw = $agw + $grandgw;
            $bcbm = $acbm + $grandcbm;
        ?>
        <tr>
            <td style="text-align: center;"><?= $data['factory_code'] ?></td>
            <td style="text-align: center;"><?= $data['man_po'] ?></td>
            <td style="text-align: center;"><?= $data['cust_po'] ?></td>
            <td style="text-align: center;"><?= $data['po_referance'] ?></td>
            <td style="text-align: center;"><?= $data['color']?></td>
            <td style="text-align: center;"><?php 
                                                if(substr($data['sku'],-3) == 'NEW'){
                                                    echo substr($data['sku'],0,-4);
                                                }elseif(substr($data['sku'],-4) == '(PE)') {
                                                    echo substr($data['sku'],0,-5);
                                                }else{
                                                    echo $data['sku'];
                                                } ?></td>
            <td style="text-align: center;"><?= $data['widht'] ?></td>
            <td style="text-align: center; mso-number-format:\@;"><?php 
                                                                    if($data['packing_metode1']== 0){
                                                                        echo $data['size']+0; 
                                                                    }else{
                                                                        if($data['gender']=='Youth'){
                                                                            $sqlSize = mysqli_query($conn, "SELECT b.size FROM tb_packing_list a
                                                                                        LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                                        LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                                        LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                                        LEFT JOIN tb_master e ON d.sku = e.sku
                                                                                        WHERE d.id_summary='$data[id_summary]' ORDER BY a.id_detail LIMIT 1");
                                                                                    while($dataSize = Mysqli_fetch_array($sqlSize)) {
                                                                                        echo $dataSize['size']+0;
                                                                                    };
                                                                            $sqlSize1 = mysqli_query($conn, "SELECT b.size FROM tb_packing_list a
                                                                                        LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                                        LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                                        LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                                        LEFT JOIN tb_master e ON d.sku = e.sku
                                                                                        WHERE d.id_summary='$data[id_summary]' ORDER BY a.id_detail DESC LIMIT 1");
                                                                                    while($dataSize1 = Mysqli_fetch_array($sqlSize1)) {
                                                                                        echo '-'.$dataSize1['size']+0;
                                                                                    }
                                                                        }else{
                                                                            echo $data['minsize']+0; ?> - <?= $data['maxsize']+0;
                                                                        }  
                                                                    }
                                                                ?></td>
            <td style="text-align: center;"><?= $data['qty_prs'] ?></td>
            <td style="text-align: center; mso-number-format:\@;"><?= $data['ctn_no'] ?></td>
            <td style="text-align: center;"><?= $data['no_ctn']?></td>
            <td style="text-align: center;"><?= $data['packing_metode']?></td>
            <td style="text-align: center;"><?php
                                                if($data['packing_metode1']== 0){ ?>
                                                    <?php echo number_format($data['totalnw'],2,".",",") ?>
                                                <?php }else{ ?>
                                                    <?php echo number_format($hasilnw,2,".",",") ?>
                                                <?php } ?></td>
            <td style="text-align: center;"><?php
                                                if($data['packing_metode1']== 0){ ?>
                                                    <?php echo number_format($data['totalgw'],2,".",",") ?>
                                                <?php }else{ ?>
                                                    <?php echo number_format($hasilgw,2,".",",") ?>
                                                <?php } ?></td>
            <td style="text-align: center;"><?php 
                                                if($data['packing_metode1']== 0){ ?>
                                                    <?php echo number_format($data['totalcbm'],2,".",",") ?>
                                                <?php }else{ ?>
                                                    <?php echo number_format($hasilcbm,2,".",",") ?>
                                                <?php } ?></td>
        </tr>
        <?php if (@$all[$row+1]['id_detail_invoice'] != $data['id_detail_invoice']) { ?>
            <tr>
                <td style="text-align: center;" colspan="8"><b>Total</b></td>
                <td style="text-align: center;"><b><?php echo $subtotalprs ?></b></td>
                <td></td>
                <td style="text-align: center;"><b><?php echo $subtotalctn ?></b></td>
                <td></td>
                <td style="text-align: center;"><b><?php 
                                                    if($data['packing_metode1'] == 0){ ?>
                                                        <?php echo $subtotalnw ?>
                                                    <?php }else{ ?>
                                                        <?php echo number_format($totalhasilnw,2,".",",")?>
                                                    <?php } ?></b></td>
                <td style="text-align: center;"><b><?php 
                                                    if($data['packing_metode1'] == 0){ ?>
                                                        <?php echo $subtotalgw ?>
                                                    <?php }else{ ?>
                                                        <?php echo number_format($totalhasilgw,2,".",",")?>
                                                    <?php } ?></b></td>
                <td style="text-align: center;"><b><?php
                                                    if($data['packing_metode1'] == 0){ ?>
                                                        <?php echo $subtotalcbm ?>
                                                    <?php }else{ ?>
                                                        <?php echo $totalhasilcbm ?>
                                                    <?php } ?></b></td>
            </tr>
            <tr>

            </tr>
            <?php $totalhasilnw = $totalhasilgw = $totalhasilcbm = 0; ?>
            <?php $subtotalnw = $subtotalgw = $subtotalprs = $subtotalctn = $subtotalcbm = 0;
            } ?>
        <?php } ?>
    </tbody>
</table>
<table border="1">
    <tfoot>
        <tr>
            <th style="text-align: center; background-color: #d0d3d6;" colspan="8">Grand Total</th>
            <th style="text-align: center; background-color: #d0d3d6;"><?php echo $grandprs ?></th>
            <th style="text-align: center; background-color: #d0d3d6;"></th>
            <th style="text-align: center; background-color: #d0d3d6;"><?php echo $grandctn ?></th>
            <th style="text-align: center; background-color: #d0d3d6;"></th>
            <th style="text-align: center; background-color: #d0d3d6;"><?php echo number_format($bnw,2,".",",")?></th>
            <th style="text-align: center; background-color: #d0d3d6;"><?php echo number_format($bgw,2,".",",")?></th>
            <th style="text-align: center; background-color: #d0d3d6;"><?php echo number_format($acbm,2,".",",")?></th>
        </tr>
    </tfoot>
</table>