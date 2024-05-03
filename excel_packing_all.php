<?php
    require_once 'functions/koneksi.php';
    require 'functions/function_output.php';
    header("Content-type:application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename= Packing List.xls")
?>

<center><h3> PACKING LIST</h3></center>
<?php
    $id_summary   = $_GET['id_summary'];
    $get  = showData($id_summary);
?>
<?php foreach ($get as $data) { ?>
<table>
    <t
        <th style="text-align: left; vertical-align: top;">Shipper :</th>
        <th style="text-align: left; vertical-align: top;">PT METRO PEARL INDONESIA</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: left; vertical-align: top;">Port Of Loading :</th>
        <th style="text-align: left; vertical-align: top;"><?= $data['port_of_loading'] ?></th>
    </tr>
    <tr>
        <th></th>
        <th style="text-align: left; vertical-align: top;">Jl. Pramuka Raya KM.0,99 No.18 Desa Bunder, Kec Jatiluhur</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: left; vertical-align: top;">Port Of Entry :</th>
        <th style="text-align: left; vertical-align: top;"><?= $data['port_of_entry'] ?></th>
    </tr>
    <tr>
        <th></th>
        <th style="text-align: left; vertical-align: top;">Kab. Purwakarta Jawa Barat, Indonesia.</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: left; vertical-align: top;">Final Destination :</th>
        <th style="text-align: left; vertical-align: top;"><?= $data['final_destination'] ?></th>
    </tr>
    <tr>
        <th></th>
        <th style="text-align: left; vertical-align: top;">Telp. 0264(8221643) Fax. (0264)8221642</th>
    </tr>
    <br>
    <tr>
        <th style="text-align: left; vertical-align: top;">Ship To :</th>
        <th style="text-align: left; vertical-align: top;"><?= $data['ship_to'] ?></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: left; vertical-align: top;">Vessel/Voyage :</th>
        <th style="text-align: left; vertical-align: top;"><?= $data['vessel_voyage'] ?></th>
    </tr>
    <tr>
        <th style="text-align: left; vertical-align: top;">Address :</th>
        <th style="text-align: left; vertical-align: top;"><?= $data['address'] ?></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: left; vertical-align: top;">FCL/CFS :</th>
        <th style="text-align: left; vertical-align: top;"><?= $data['fcl_cfs'] ?></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: left; vertical-align: top;">ETD :</th>
        <th style="text-align: left; vertical-align: top;"><?= $data['etd'] ?></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: left; vertical-align: top;">ETA :</th>
        <th style="text-align: left; vertical-align: top;"><?= $data['eta'] ?></th>
    </tr>
</table>
<?php } ?>
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
        <?php
            $subtotalnw = $subtotalgw = $subtotalcbm = $subqty = $subcarton = 0;
            if (isset($_GET['id_summary'])) {
            $id_summary=trim($_GET['id_summary']);
            $subtotalnw = $subtotalgw = $subtotalcbm = $subqty = $subcarton = 0;
            $shipMark = mysqli_query($conn, "SELECT * FROM tb_packing_list a
                                            LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                            LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                            LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                            LEFT JOIN tb_master e ON d.sku = e.sku
                                            WHERE d.factory_code IN ('".$id_summary."') ORDER BY a.id_packing_list");
            while ($data = mysqli_fetch_array($shipMark)) {
            $totalnw = $data['no_ctn'] * $data['nw'];
            $totalgw = $data['no_ctn'] * $data['gw'];
            $totalcbm = $data['no_ctn'] * $data['cbm'];
            $subtotalnw += $totalnw;
            $subtotalgw += $totalgw;
            $subtotalcbm += $totalcbm;
            $subqty += $data['qty_prs'];
            $subcarton += $data['no_ctn'];
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $data['factory_code'];?></td>
            <td style="text-align: center;"><?php echo $data['man_po'];?></td>
            <td style="text-align: center;"><?php echo $data['cust_po'];?></td>
            <td style="text-align: center;"><?php echo $data['po_referance'];?></td>
            <td style="text-align: center;"><?php echo $data['color'];?></td>
            <td style="text-align: center;"><?php 
                                                if(substr($data['sku'],-3) == 'NEW'){
                                                    echo substr($data['sku'],0,-4);
                                                }elseif(substr($data['sku'],-4) == '(PE)') {
                                                    echo substr($data['sku'],0,-5);
                                                }else{
                                                    echo $data['sku'];
                                                } ?></td>
            <td style="text-align: center;"><?php echo $data['widht'];?></td>
            <td style="text-align: center; mso-number-format:\@;"><?php echo $data['size']+0;?></td>
            <td style="text-align: center;"><?php echo $data['qty_prs'];?></td>
            <td style="text-align: center; mso-number-format:\@;"><?php echo $data['ctn_no'];?></td>
            <td style="text-align: center;"><?php echo $data['no_ctn'];?></td>
            <td style="text-align: center;"><?php echo $data['packing_metode'];?></td>
            <td style="text-align: center;"><?php echo number_format($totalnw,4,".",".")?></td>
            <td style="text-align: center;"><?php echo number_format($totalgw,4,".",".")?></td>
            <td style="text-align: center;"><?php echo number_format($totalcbm,4,".",".")?></td>
        </tr>
    </tbody>
    <?php 
        } 
    }
        ?>
    <tfoot>
        <tr>
            <th colspan="8" style="text-align: center;">Total</th>
            <th style="text-align: center;"><?php echo $subqty ?></th>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"><?php echo $subcarton ?></th>
            <th style="text-align: center;"></th>
            <th style="text-align: center;"><?php echo number_format($subtotalnw,4,".",".")?></th>
            <th style="text-align: center;"><?php echo number_format($subtotalgw,4,".",".")?></th>
            <th style="text-align: center;"><?php echo number_format($subtotalcbm,2,".",".")?></th>
        </tr>
    </tfoot>
</table>
<?php
    $id_summary   = $_GET['id_summary'];
    $get  = showData($id_summary);
?>
<?php foreach ($get as $data) { ?>
<table>
    <tr>
        <th style="text-align: left; vertical-align: top;">CONTAINER NO :</th>
        <th><?= $data['container_no'] ?></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: left; vertical-align: top;">SEAL NO :</th>
        <th><?= $data['seal_no'] ?></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: left; vertical-align: top;">Sign,</th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: left; vertical-align: top;">FENNY WIRATNA</th>
        <th></th>
        <th></th>
    </tr>
</table>
<?php } ?>