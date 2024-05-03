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
                        <select name="factory_code[]" class="form-control js-example-basic-multiple" multiple="multiple" aria-label="Recipient's username">
                            <?php 
                                $query = mysqli_query($conn, "SELECT tb_add_packing.*, tb_summery.*
                                                        FROM tb_add_packing
                                                        JOIN tb_summery ON tb_add_packing.id_summary = tb_summery.id_summary
                                                        GROUP BY factory_code ORDER BY factory_code");
                                while ($data = mysqli_fetch_array($query)){
                            ?>
                                <option value="<?=$data['factory_code'];?>"><?php echo $data['factory_code'];?></option>
                            <?php } ?>
                        </select>&emsp;
                        <button type="submit" name="tampilkan" class="btn btn-success btn-sm">Tampilkan</button>
                        &nbsp;<a href="total_carton.php" class="btn btn-success btn-sm">Refresh</a>
                    </div>
                </div>
            </form>
            <form method="POST">
                <?php
                    if(isset($_POST['tampilkan'])) {
                        $factory_code=$_POST['factory_code'];
                        $x = $factory_code[0];
                    $shipMark = mysqli_query($conn, "SELECT * FROM tb_packing_list a
                                        LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                        LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                        LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                        LEFT JOIN tb_master e ON d.sku = e.sku
                                        WHERE d.factory_code='$x' GROUP BY b.material_code1 AND b.material_code2 ORDER BY d.factory_code");
                    while ($data = mysqli_fetch_array($shipMark)) {
                ?>
                <div class="table-responsive">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="material[]" id="inlineRadio1" value="<?php echo $data['material_code1'];?>">
                        <label class="form-check-label" for="inlineRadio1">Blank Material Code</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="material[]" id="inlineRadio2" value="<?php echo $data['material_code2'];?>">
                        <label class="form-check-label" for="inlineRadio2">Meas Material Code</label>
                    </div>
                </div>
                <br>
                <button type="submit" name="simpan" value="Simpan" tyle="font-size: 12px;" class="btn btn-primary btn-sm">Pilih</button>
                <?php } }
                ?>
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
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>MPI-NEW BALANCE OUTER CARTON PURCHASE LIST</center></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Cust ID</th>
                            <th style="text-align: center;">Factory Code</th>
                            <th style="text-align: center;">Material description & Size</th>
                            <th style="text-align: center;">Material Code</th>
                            <th style="text-align: center;">QTY</th>
                            <th style="text-align: center;">Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $subtotal = 0;
                            if(isset($_POST['tampilkan'])) {
                                $factory_code=$_POST['factory_code'];
                                foreach ($factory_code as $nilai){
                                    echo $nilai;
                                $subtotal = 0;
                                $carton = mysqli_query($conn, "SELECT *, SUM(no_ctn) AS total_carton FROM tb_packing_list a
                                                                LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                LEFT JOIN tb_master e ON d.sku = e.sku
                                                                WHERE d.factory_code='$nilai' OR d.factory_code='$nilai'
                                                                GROUP BY d.factory_code, b.carton_code ORDER BY d.factory_code");
                                };
                                
                                
                                
                                while ($data = mysqli_fetch_array($carton)) {
                                $subtotal += $data['total_carton'];
                        ?>      
                        <tr>
                            <td style="text-align: center;"><?php echo $data['cust_id'];?></td>
                            <td style="text-align: center;"><?php echo $data['factory_code'];?></td>
                            <td style="text-align: center;"><?php echo $data['meas_carton'];?> (<?php echo substr($data['carton_code'],0,4);?>)</td>
                            <td style="text-align: center;"><?php echo $data['material_code1'] ?></td>
                            <td style="text-align: center;"><?php echo $data['total_carton'];?></td>
                            <td style="text-align: center;">PCS</td>
                        </tr>                        
                    </tbody>
                    <?php
                        }
                    }   
                    ?>
                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align: center;">Total</th>
                            <th style="text-align: center;"><?php echo $subtotal ?></th>
                            <th style="text-align: center;"></th>
                        </tr>
                    </tfoot>
                </table>
                <a href="excel_total_carton.php?factory_code=<?php echo $_GET['factory_code'];?>&material=<?php echo $value;?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
                <a href="print_total_carton.php?factory_code=<?php echo $_GET['factory_code'];?>&material=<?php echo $value;?>" type="button" target="_BLANK" class="btn btn-info btn-sm">CETAK</a>
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
