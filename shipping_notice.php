<?php
    include_once 'layout/header.php';
    require 'functions/function_output.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
        <form method="POST">
                <div>
                    <div class="input-group input-group-sm mb-3">
                        <select name="id_summary[]" class="form-select js-example-basic-multiple" multiple="multiple" aria-label="Recipient's username" required>
                            <?php 
                                $query = mysqli_query($conn, "SELECT b.prod_month, b.id_summary, b.factory_code
                                                        FROM tb_add_packing a
                                                        JOIN tb_summery b ON a.id_summary = b.id_summary");
                                while ($data = mysqli_fetch_array($query)){
                            ?>
                                <option value="<?=$data['id_summary'];?>"><?= $data['prod_month'];?> - <?= $data['factory_code'];?></option>
                            <?php } ?>
                        </select>&emsp;
                    </div>
                    <button type="submit" name="tampilkan" class="btn btn-success btn-sm">Tampilkan</button>
                    &nbsp;<a href="shipping_notice.php" class="btn btn-success btn-sm"><i class="fas fa fa-retweet"></i></a>
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
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>SHIPPING NOTICE</center></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Prod Month</th>
                            <th style="text-align: center;">Cust Id</th>
                            <th style="text-align: center;">Man PO</th>
                            <th style="text-align: center;">Cust PO</th>
                            <th style="text-align: center;">PO Reference</th>
                            <th style="text-align: center;">Factory Code</th>
                            <th style="text-align: center;">SKU</th>
                            <th style="text-align: center;">Category</th>
                            <th style="text-align: center;">Gender</th>
                            <th style="text-align: center;">Color</th>
                            <th style="text-align: center;">Widht</th>
                            <th style="text-align: center;">Dest</th>
                            <th style="text-align: center;">QTY</th>
                            <th style="text-align: center;">QTY Carton</th>
                            <th style="text-align: center;">NW</th>
                            <th style="text-align: center;">GW</th>
                            <th style="text-align: center;">CBM</th>
                            <th style="text-align: center;">Ship Mode</th>
                            <th style="text-align: center;">Confirm XFD</th>
                            <th style="text-align: center;">Ship Date</th>
                            <th style="text-align: center;">Vendor Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($_POST['tampilkan'])) {
                                $totalnw = $totalgw = $totalcbm = 0;
                                $id_summary = $_POST['id_summary'];
                                $x = implode("','",$id_summary);
                                $carton = mysqli_query($conn, "SELECT *,SUM(a.no_ctn) as totalctn, SUM(a.no_ctn * b.cbm) as cbm, SUM(a.no_ctn * b.gw) as gw, SUM(a.no_ctn * b.nw) as nw, SUM(a.qty_prs) as qty, SUM(a.packing_metode1 * b.nw1) as nwpre, SUM(a.packing_metode1 * b.gw1) as gwpre, MAX(b.cbm) as cbmpre
                                                                FROM tb_packing_list a
                                                                LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                LEFT JOIN tb_master e ON d.sku = e.sku
                                                                WHERE d.id_summary IN ('".$x."') GROUP BY d.prod_month, d.factory_code ORDER BY d.factory_code");                                
                                while ($data = mysqli_fetch_array($carton)) {
                                $totalnw = $data['no_ctn'] * $data['nwpre'];
                                $totalgw = $data['no_ctn'] * $data['gwpre'];
                                $totalcbm = $data['cbmpre'] * $data['no_ctn'];
                        ?>      
                        <tr>
                            <td><?= $data['prod_month'] ?></td>
                            <td><?= $data['cust_id'] ?></td>
                            <td><?= $data['man_po'] ?></td>
                            <td><?= $data['cust_po'] ?></td>
                            <td><?= $data['po_referance'] ?></td>
                            <td><?= $data['factory_code'] ?></td>
                            <td><?= $data['sku'] ?></td>
                            <td><?= $data['category'] ?></td>
                            <td><?= $data['gender'] ?></td>
                            <td><?= $data['color'] ?></td>
                            <td><?= $data['widht'] ?></td>
                            <td><?= $data['destination'] ?></td>
                            <td><?php if($data['packing_metode1'] == 0){echo $data['qty']; }else{ echo $data['qty_prs']; }  ?></td>
                            <td><?php if($data['packing_metode1'] == 0){echo $data['totalctn']; }else{ echo $data['no_ctn']; }  ?></td>
                            <td><?php if($data['packing_metode1'] == 0){echo number_format($data['nw'],2,".","");}else{echo number_format($totalnw,2,".","");} ?></td>
                            <td><?php if($data['packing_metode1'] == 0){echo number_format($data['gw'],2,".","");}else{echo number_format($totalgw,2,".","");} ?></td>
                            <td><?php if($data['packing_metode1'] == 0){echo number_format($data['cbm'],2,".","");}else{echo $totalcbm;} ?></td>
                            <td><?= $data['mode'] ?></td>
                            <td><?= $data['xfd'] ?></td>
                            <td><?= $data['date'] ?></td>
                            <td><?= $data['vendor_code'] ?></td>
                        </tr>                        
                    </tbody>
                    <?php
                        }
                    }   
                    ?>
                </table>
                <a href="excel_notice.php?nilai=<?php echo $x;?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
?>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>