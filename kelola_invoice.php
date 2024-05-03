<?php
    include_once 'layout/header.php';
    require 'functions/function_invoice.php';
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Tambah Data</center></h6>
            </div>
            <div class="card-body">
                <form action="functions/function_invoice.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <div class="input-group input-group-sm mb-3">
                            <input type="hidden" name="id_invoice" class="input" value="<?php echo $_GET['id_invoice'] ?>">
                            <select name="id_summary" id="id_summary" class="form-control form-control-sm selectpicker" data-show-subtext="true" data-live-search="true" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <?php $jenis = getSummary(); foreach ($jenis as $jns) { ?>
                                    <option value="<?= $jns['id_summary'] ?>"><?= $jns['prod_month'] ?> - <?= $jns['factory_code']?></option>
                                <?php } ?>
                            </select>&emsp;
                            <button type="submit" name="add1" class="btn btn-primary btn-sm" id="button-addon2">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>COMMERCIAL INVOICE</center></h6>
            </div>
            <div class="card-body">
                <?php
                    $id_invoice   = $_GET['id_invoice'];
                    $get  = showData($id_invoice);
                ?>
                <?php foreach ($get as $data) { ?>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div style="font-size:14px;" class="card-body-footer">
                            <div class="mb-3 row">
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-3 col-form-label">Shipper :</label>
                                <div class="col-sm-9">
                                    <b>PT. METRO PEARL INDONESIA</b><br>
                                    Jl. Pramuka Raya KM.0,99 No.18 Desa Bunder, Kec Jatiluhur <br>
                                    Kab. Purwakarta Jawa Barat, Indonesia<br>
                                    Telp. 0264 (8221643) Fax. (0264) 8221642
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                    
                    </div>
                    <div class="col">
                        <div style="font-size:14px;" class="card-body-footer">
                            <div class="mb-3 row">
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label"><br></label>
                                <div class="col-sm-8">
                                                
                                </div>
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">Invoice No. </label>
                                <div class="col-sm-8">
                                    <b><?php echo $data['invoice_no'] ?></b>
                                </div>
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">Date  </label>
                                <div class="col-sm-8">
                                    <b><?php echo $data['tanggal'] ?></b>
                                </div>
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">Payment Term  </label>
                                <div class="col-sm-8">
                                    <b><?php echo $data['payment_term'] ?></b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div style="font-size:14px;" class="card-body-footer">
                            <div class="mb-3 row">
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-3 col-form-label">Consignee :</label>
                                <div class="col-sm-9">
                                    <b><?php echo $data['shipto'] ?></b>
                                </div>
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <?php echo nl2br($data['alamat_shipto']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        
                    </div>
                    <div class="col">
                        <div style="font-size:14px;" class="card-body-footer">
                            <div class="mb-3 row">
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label">Buyer </label>
                                <div class="col-sm-8">
                                    <b>GLOBALINK WORDLDWIDE LTD.</b><br>
                                    7F-1,NO.50<br>
                                    SEC. 4, NANJING E. RD.,<br>
                                    SONGSHAN DIST<br>
                                    TAIPEI CITY, TAIWAN
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div style="font-size:14px;" class="card-body-footer">
                            <div class="mb-3 row">
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-3 col-form-label">Notify Party</label>
                                <div class="col-sm-9">
                                    <?php echo nl2br($data['notify']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        
                    </div>
                    <div class="col">
                        
                    </div>
                    <div class="col">
                        <div style="font-size:14px;" class="card-body-footer">
                            <div class="mb-3 row">
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm- col-form-label"><br></label>
                                <div class="col-sm-8">
                                                
                                </div>
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-12 col-form-label">Shipment from Jakarta, Indonesia to <?php echo $data['port'] ?></label>
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-3 col-form-label">Shipper Per</label>
                                <div class="col-sm-9">
                                    <b><?php echo $data['shipper'] ?></b>
                                </div>
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-3 col-form-label">On/About</label>
                                <div class="col-sm-9">
                                    <b><?php echo $data['about'] ?></b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        
                    </div>
                    <div class="col">
                        <div style="font-size:14px;" class="card-body-footer">
                            <div class="mb-3 row">
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label"><br></label>
                                <div class="col-sm-8">
                                                
                                </div>
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-4 col-form-label"><br></label>
                                <div class="col-sm-8">
                                            
                                </div>
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-5 col-form-label">Delivery Term</label>
                                <div class="col-sm-7">
                                    <b><?php echo $data['delivery'] ?></b>
                                </div>
                                <label style="font-weight : bolder;" for="staticEmail" class="col-sm-5 col-form-label">Country of Origin</label>
                                <div class="col-sm-7">
                                    <b>Indonesia</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="d-grid gap-2 d-md-flex ">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="fas fa-plus"></i> HS CODE</button>
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="functions/function_invoice.php" method="POST">
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Factory Code :</label>
                                            <select name="id_summary" id="id_summary" class="form-select" aria-label="Default select example">
                                                <?php $jenis = getdata1(); foreach ($jenis as $jns) { ?>
                                                    <option value="<?= $jns['id_summary'] ?>"><?= $jns['factory_code']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">HS CODE :</label>
                                            <input type="text" name="hscode" class="form-control" id="recipient-name" required>
                                            <input type="hidden" name="id_invoice" class="input" value="<?php echo $_GET['id_invoice'] ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="add2">
                                            <button class="btn btn-primary btn-sm">Simpan</button>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Factory Code</th>
                                <th style="text-align: center;">MAN PO</th>
                                <th style="text-align: center;">CUST PO</th>
                                <th style="text-align: center;">PO REFERANCE</th>
                                <th style="text-align: center;">HS CODE</th>
                                <th style="text-align: center;">SIZE</th>
                                <th style="text-align: center;">SKU</th>
                                <th style="text-align: center;">Description</th>
                                <th style="text-align: center;">Colour</th>
                                <th style="text-align: center;">QTY (Prs)</th>
                                <th style="text-align: center;">Unit Price (FOB)</th>
                                <th style="text-align: center;">TOTAL VALUE (USD)</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalQty = $subTotal = $totalValue = $subQTY = $SubtotalQty = $SubtotalValue = 0 ?>
                            <?php $all = getData1(); $no = 1; ?>
                            <?php foreach ($all as $data) { ?>
                            <?php
                                $id_invoice = $data['id_invoice'];
                            ?>
                            <tr>
                                <td style="text-align: center;"><?= $data['factory_code'] ?></td>
                                <td style="text-align: center;"><?= $data['man_po'] ?></td>
                                <td style="text-align: center;"><?= $data['cust_po'] ?></td>
                                <td style="text-align: center;"><?= $data['po_referance'] ?></td>
                                <td style="text-align: center;"><?= $data['hscode']?></td>
                                <td style="text-align: center;"><?php 
                                                                    if($data['gender']=='Youth'){
                                                                        $sqlSize = mysqli_query($conn, "SELECT b.size FROM tb_packing_list a
                                                                                    LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                                    LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                                    LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                                    LEFT JOIN tb_master e ON d.sku = e.sku
                                                                                    WHERE d.id_summary='$data[id_summary]' ORDER BY a.id_detail LIMIT 1");
                                                                        while($dataSize = Mysqli_fetch_array($sqlSize)) {
                                                                                echo "#" ?><?= $dataSize['size']+0;
                                                                        }
                                                                        $sqlSize1 = mysqli_query($conn, "SELECT b.size FROM tb_packing_list a
                                                                                    LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                                    LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                                    LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                                    LEFT JOIN tb_master e ON d.sku = e.sku
                                                                                    WHERE d.id_summary='$data[id_summary]' ORDER BY a.id_detail DESC LIMIT 1");
                                                                        while($dataSize1 = Mysqli_fetch_array($sqlSize1)) {
                                                                                echo "-#" ?><?= $dataSize1['size']+0;
                                                                        }
                                                                    }else{
                                                                        echo "#"?><?=$data['low']+0?>-<?="#"?><?=$data['high']+0 ;
                                                                    }
                                                                ?></td>
                                <td style="text-align: center;"><?php 
                                                                    if(substr($data['sku'],-3) == 'NEW'){
                                                                        echo substr($data['sku'],0,-4);
                                                                    }elseif(substr($data['sku'],-4) == '(PE)') {
                                                                        echo substr($data['sku'],0,-5);
                                                                    }else{
                                                                        echo $data['sku'];
                                                                    } ?></td>
                                <td style="text-align: center;"><?= $data['category'] ?></td>
                                <td style="text-align: center;"><?= $data['color'] ?></td>
                                <?php if ($data['packing_metode1'] ==  0){
                                            $totalQty = $data['nilai'];
                                        }else{
                                            $totalQty = $data['qty_prs'];
                                        }
                                        $SubtotalQty += $totalQty;
                                ?>
                                <td style="text-align: center;"><?php echo $totalQty ?></td>
                                <td style="text-align: center;"><?= "$ ".$data['price'] ?></td>
                                <?php $totalValue = $totalQty * $data['price']; 
                                    $SubtotalValue += $totalValue;        
                                ?>
                                <td style="text-align: center;"><?php echo "$ ".number_format($totalValue,2,".",","); ?></td>
                                <?php $id_invoice = $_GET['id_invoice']; ?>
                                <td style="text-align: center;"><a href="<?='edit_hscode.php?id_hscode='.$data['id_hscode'];?>&id_invoice=<?php echo $id_invoice;?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                &nbsp;<a href="<?='functions/function_invoice.php?hapus1='.$data['id_detail_invoice'];?>&id_invoice=<?php echo $id_invoice;?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center;" colspan="9">Total</th>
                                <th style="text-align: center;"><?php echo $SubtotalQty ?></th>
                                <th style="text-align: center;"></th>
                                <th style="text-align: center;"><?php echo "$ ".number_format($SubtotalValue,2,".",","); ?></th>
                                <th style="text-align: center;"></th>
                            </tr>
                        </tfoot>
                    </table>
                        <a href="excel_invoice.php?id_invoice=<?php echo $id_invoice;?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
                        <a href="print_invoice_alfi.php?id_invoice=<?php echo $_GET['id_invoice']; ?>" type="button" target="_BLANK" class="btn btn-info btn-sm">PRINT</a>
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