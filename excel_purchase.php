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
    header("Content-Disposition: attachment; filename=$a.xls")
?>

<?php } ?>
<table>
    <th colspan = "12"><h3><u>GLOBALINK WORLDWIDE LTD</u></h3></th>
</table>
<table>
    <th colspan="12" style="font-size: 20px;">Purchase Order</th>
</table>
<table>
    <th><br></th>
</table>
<?php
    $id_invoice   = $_GET['id_invoice'];
    $get  = showData($id_invoice);
?>
<?php foreach ($get as $data) { ?>
<table border="1">
    <tr>
        <td colspan="4" rowspan="8" style="text-align: left; vertical-align: top;"><b>From :</b><br>
            GLOBALINK WORLDWIDE LTD.<br>
            No.241, Sec.2, Anhe RD<br>
            Da'an Dist.<br>
            Taipei<br>
            TWN<br>
        </td>
        <td colspan="4" rowspan="8" style="text-align: left; vertical-align: top;"><b>To :</b><br>
            PT. METRO PEARL INDONESIA<br>
            JLN. PRAMUKA RAYA NO. 18 KM 0.99<br>
            DESA BUNDER KEC. JATILUHUR<br>
            PURWAKARTA, JAWA BARAT<br>
            INDONESIA<br>
            41152<br>
        </td>
        <td colspan="4" rowspan="8" style="text-align: left; vertical-align: top;"><b>Ship To :</b><br>
            <b><?= $data['shipto'] ?></b><br>
            <?= nl2br($data['alamat_shipto']) ?>    
        </td>
    </tr>
    <?php } ?>
</table>
<table>
    <th><br></th>
</table>
<table border="1">
    <?php $all = getPurchase(); $no = 1; ?>
    <?php foreach ($all as $data) { ?>
    <tr>
        <th colspan="2" style="text-align: center; vertical-align: top;">Vendor Code</th>
        <th colspan="2" style="text-align: center; vertical-align: top;">PO Release Date</th>
        <th colspan="4" style="text-align: center; vertical-align: top;">Ship Via</th>
        <th colspan="2" style="text-align: center; vertical-align: top;">Payment Term</th>
        <td colspan="2" style="text-align: center; vertical-align: top;">75days AFTER ON BOARD</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; vertical-align: top;"><?= $data['vendor_code']?></td>
        <td colspan="2" style="text-align: center; vertical-align: top;"><?= $data['realise']?></td>
        <td colspan="4" style="text-align: center; vertical-align: top;"><?= $data['mode']?></td>
        <th colspan="2" style="text-align: center; vertical-align: top;">Shipment Term</th>
        <td colspan="2" style="text-align: center; vertical-align: top;">FCA JAKARTA</td>
    </tr>
    <?php } ?>
</table>
<table>
    <th><br></th>
</table>
<table border="1">
	<thead>
        <tr>
            <th style="text-align: center; background-color: #ffdf8f;">MAN PO</th>
            <th style="text-align: center; background-color: #ffdf8f;">Factory Code</th>
            <th style="text-align: center; background-color: #ffdf8f;">SKU</th>
            <th style="text-align: center; background-color: #ffdf8f;">Gender</th>
            <th style="text-align: center; background-color: #ffdf8f;">Confirm XF date</th>
            <th style="text-align: center; background-color: #ffdf8f;">PO Release Date</th>
            <th style="text-align: center; background-color: #ffdf8f;">Order QTY</th>
            <th style="text-align: center; background-color: #ffdf8f;">Price</th>
            <th style="text-align: center; background-color: #ffdf8f;">Amount</th>
            <?php $allSize = getSize();?>
            <?php foreach ($allSize as $dataSize) { 
                $nilaiSize = $dataSize['size']+0;
                ?>
            <th style="text-align: center; background-color: #ffdf8f;"><?= $nilaiSize ?></th><?php } ?>
        </tr>
    </thead>
    <tbody>
    <?php $totalQty = $subTotal = $totalValue =  0 ?>
    <?php $all = getPurchase1(); $no = 1; ?>
    <?php foreach ($all as $data) { ?>
    <?php
        $totalQty += $data['nilai'];
        $totalValue = $data['nilai'] * $data['price'];
        $subTotal += $totalValue;
        $id_invoice = $data['id_invoice'];
    ?>
    <tr>
        <td style="text-align: center;"><?= $data['man_po'] ?></td>
        <td style="text-align: center;"><?= $data['factory_code'] ?></td>
        <td style="text-align: center;"><?php 
                                            if(substr($data['sku'],-3) == 'NEW'){
                                                echo substr($data['sku'],0,-4);
                                            }elseif(substr($data['sku'],-4) == '(PE)') {
                                                echo substr($data['sku'],0,-5);
                                            }else{
                                                echo $data['sku'];
                                            } ?></td>
        <td style="text-align: center;"><?= $data['gender'] ?></td>
        <td style="text-align: center;"><?= $data['xfd'] ?></td>
        <td style="text-align: center;"><?= $data['realise'] ?></td>
        <td style="text-align: center;"><?= $data['nilai'] ?></td>
        <td style="text-align: center;"><?= "$ ".$data['price'] ?></td>
        <td style="text-align: center;"><?php echo "$ ".number_format($totalValue,2,".",","); ?></td>
        <?php
            $data_size1 = array();
            $data_size2 = array();
            $data_prs = array();
            foreach ($allSize as $dataSize) {
                $data_size1[] = $dataSize['size']+0;
            }
            
            $sqlPrs = mysqli_query($conn, "SELECT SUM(qty_prs) AS nilai_qty, b.size 
                                            FROM tb_packing_list a 
                                            JOIN tb_detail_master b ON a.id_detail = b.id_detail 
                                            WHERE id_add_packing = '$data[id_add_packing]' 
                                            GROUP BY b.size");
            while ($row = mysqli_fetch_assoc($sqlPrs)) {
                $data_size2[] = $row['size']+0;
                $data_prs[] = $row['nilai_qty'];
            }

            $hasil = array();
            // Perulangan pada size pertama
            foreach ($data_size1 as $x ) {
                // Cek apakah elemen ada dalam size kedua
                if (in_array($x, $data_size2)) {
                    $indeks = array_search($x, $data_size2);
                    $hasil[] = $data_prs[$indeks];
                } else {
                    $hasil[] = "";
                }
            }
            foreach($hasil as $datahasil){
        ?>
        <td style="text-align: center;"><?= $datahasil ?></td><?php } ?>
    </tr>
    <?php } ?>
    </tbody>
    <tfoot>
    <tr>
        <th style="text-align: center;" colspan="6">Total</th>
        <th style="text-align: center;"><?= $totalQty ?></th>
        <th style="text-align: center;"></th>
        <th style="text-align: center;"><?= "$ ".number_format($subTotal,2,".",","); ?></th>
        <?php $allSize = getSize();?>
            <?php foreach ($allSize as $dataSize) { 
                $totalprs = $dataSize['nilaiprs'];
            ?>
        <th style="text-align: center;"><?= $totalprs ?></th><?php } ?>
    </tr>
    </tfoot>
</table>