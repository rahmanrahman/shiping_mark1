<?php
    include_once 'layout/header.php';
    require 'functions/function_invoice.php';   
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center><u>GLOBALINK WORLDWIDE LTD</u></center></h6>
                <br>
                <h6 style="font-size : 14px;" class="m-0 font-weight-bold text-dark"><center>Purchase Order</center></h6>
            </div>
            <div class="card-body">
                <?php
                    $id_invoice   = $_GET['id_invoice'];
                    $get  = showData($id_invoice);
                ?>
                <?php foreach ($get as $data) { ?>
                    <div style="font-size:12px;" class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <b>From :</b>
                                    <p class="card-text">GLOBALINK WORLDWIDE LTD.<br>
                                    No.241, Sec.2, Anhe RD<br>
                                    Da'an Dist.<br>
                                    Taipei<br>
                                    TWN<br>
                                    <br></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <b>To :</b>
                                    <p class="card-text">PT. METRO PEARL INDONESIA<br>
                                    JLN. PRAMUKA RAYA NO. 18 KM 0.99<br>
                                    DESA BUNDER KEC. JATILUHUR<br>
                                    PURWAKARTA, JAWA BARAT<br>
                                    INDONESIA<br>
                                    41152</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <b>Ship To:</b>
                                    <p class="card-text"><b><?= $data['shipto'] ?></b><br>
                                    <?= nl2br($data['alamat_shipto']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <br>
                    <?php $all = getPurchase(); $no = 1; ?>
                    <?php foreach ($all as $data) { ?>
                    <div style="font-size:12px;" class="row">
                        <div class="col-sm-4">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="text-align: center;">Vendor Code</th>
                                    <th style="text-align: center;">PO Release Date</th>
                                </tr>
                                <tr>
                                    <td style="text-align: center;"><?= $data['vendor_code']?></td>
                                    <td style="text-align: center;"><?= $data['realise']?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="text-align: center;">Ship Via</th>
                                </tr>
                                <tr>
                                    <td style="text-align: center;"><?= $data['mode']?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="text-align: center;">Payment Term</th>
                                    <td style="text-align: center;">75days AFTER ON BOARD</td>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">Shipment Term</th>
                                    <td style="text-align: center;">FCA JAKARTA</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center;">MAN PO</th>
                                <th style="text-align: center;">Factory Code</th>
                                <th style="text-align: center;">SKU</th>
                                <th style="text-align: center;">Gender</th>
                                <th style="text-align: center;">Confirm XF date</th>
                                <th style="text-align: center;">PO Release Date</th>
                                <th style="text-align: center;">Order QTY</th>
                                <th style="text-align: center;">Price</th>
                                <th style="text-align: center;">Amount</th>
                                <?php $allSize = getSize();?>
                                <?php foreach ($allSize as $dataSize) { 
                                   $nilaiSize = $dataSize['size']+0;
                                    ?>
                                <th style="text-align: center;"><?php echo $nilaiSize ?></th><?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalQty = $subTotal = $totalValue =  0 ?>
                            <?php $all = getPurchase1(); $no = 1; ?>
                            <?php foreach ($all as $data) { ?>
                            <?php
                                $totalQty += $data['nilai'];
                                $totalValue = $data['nilai']*$data['price'];
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
                        <a href="excel_purchase.php?id_invoice=<?= $_GET['id_invoice']; ?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
    if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
?>