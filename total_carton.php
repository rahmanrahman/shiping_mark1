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
                    &nbsp;<a href="total_carton.php" class="btn btn-success btn-sm"><i class="fas fa fa-retweet"></i></a>
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
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>MPI-NEW BALANCE OUTER CARTON PURCHASE LIST</center></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Cust ID</th>
                            <th style="text-align: center;">Factory Code</th>
                            <th style="text-align: center;">Prod Month</th>
                            <th style="text-align: center;">Material description & Size</th>
                            <th style="text-align: center;">Blank Material Code</th>
                            <th style="text-align: center;">Meas Material Code</th>
                            <th style="text-align: center;">Outer Carton/Outside Carton</th>
                            <th style="text-align: center;">QTY</th>
                            <th style="text-align: center;">Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
				            $subtotal = $total = 0;
                            if(isset($_POST['tampilkan'])) {
                                $subtotal = $total = 0;
                                $id_summary=$_POST['id_summary'];
                                $x=implode("','",$id_summary);
                                $carton = mysqli_query($conn, "SELECT a.no_ctn, d.cust_id, d.prod_month, d.factory_code, b.meas_carton, b.carton_code, b.material_code1, b.material_code2, a.packing_metode1, SUM(if(packing_metode1 = 0 , no_ctn, 0)) AS total_carton, a.qty_prs,  MAX(b.meas_carton) AS nilaiMeas, MAX(b.carton_code) AS nilaiCarton
                                                                FROM tb_packing_list a
                                                                LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                LEFT JOIN tb_master e ON d.sku = e.sku
                                                                WHERE d.id_summary IN ('".$x."') GROUP BY b.carton_code, d.factory_code ORDER BY d.factory_code, a.id_packing_list");                                
                                while ($data = mysqli_fetch_array($carton)) {
                                $carton_code = $data['carton_code'];
                        ?>      
                        <tr>
                            <td style="text-align: center;"><?= $data['cust_id'];?></td>
                            <td style="text-align: center;"><?= $data['factory_code'];?></td>
                            <td style="text-align: center;"><?= $data['prod_month'];?></td>
                            <td style="text-align: center;"><?php 
                                                                if($data['packing_metode1'] == 0){
                                                                    if($data['factory_code'] == 'N11NB0297' || $data['factory_code'] == 'N11NB0298') {
                                                                        echo '427*395*345MM (NBLA6.5-MX)';
                                                                    }else{ ?>
                                                                        <?= $data['meas_carton'];?> (<?= $data['carton_code'];?>)
                                                                <?php }
                                                                }else{ ?>
                                                                    <?= $data['nilaiMeas'];?> (<?= $data['nilaiCarton'];?>)
                                                                <?php } ?></td>
                            <td style="text-align: center;"><?= $data['material_code1']?></td>
                            <td style="text-align: center;"><?= $data['material_code2']?></td>
                            <td style="text-align: center;"><?php if ($carton_code == "NBL1-MZ"){ echo "MC 233-MZ";}
                                                                    elseif($carton_code == "NBL1.5-MZ"){echo "MC 236-MZ";}
                                                                    elseif($carton_code == "NBL2-MZ"){echo "MC 239-MZ";}
                                                                    elseif($carton_code == "NBL3-MZ"){echo "MC 242-MZ";}
                                                                    elseif($carton_code == "NBL4-MZ"){echo "MC 214-MZ";}
                                                                    elseif($carton_code == "NBL5-MZ"){echo "MC 217-MZ";}
                                                                    elseif($carton_code == "NBL6-MZ"){echo "MC 220-MZ";}
                                                                    elseif($carton_code == "NBL6.5-MZ"){echo "MC 223-MZ";}
                                                                    elseif($carton_code == "NBL7-MZ"){echo "MC 371-MZ";}
                                                                    elseif($carton_code == "NBL8-MZ"){echo "MC 231-MZ";}
                                                                    elseif($carton_code == "NBL8.5-MZ"){echo "MC 433-MZ";}
                                                                    elseif($carton_code == "NBL9-MZ"){echo "MC 442-MZ";}
                                                                    elseif($carton_code == "NBLA1-MX"){echo "MC 235-MX";}
                                                                    elseif($carton_code == "NBLA1.5-MX"){echo "MC 238-MX";}
                                                                    elseif($carton_code == "NBLA2-MX"){echo "MC 241-MX";}
                                                                    elseif($carton_code == "NBLA3-MX"){echo "MC 244-MX";}
                                                                    elseif($carton_code == "NBLA4-MX"){echo "MC 216-MX";}
                                                                    elseif($carton_code == "NBLA5-MX"){echo "MC 219-MX";}
                                                                    elseif($carton_code == "NBLA6-MX"){echo "MC 222-MX";}
                                                                    elseif($carton_code == "NBLA6.5-MX"){echo "MC 225-MX";}
                                                                    elseif($carton_code == "NBLA7-MX"){echo "MC 373-MX";}
                                                                    elseif($carton_code == "NBLA8-MX"){echo "MC 229-MX";}
                                                                    elseif($carton_code == "NBLA8.5-MX"){echo "MC 232-MX";}
                                                                    elseif($carton_code == "NBLA9-MX"){echo "MC 246-MX";}
                                                                    elseif($carton_code == "NBL1.5-MQ"){echo "MC 237-MQ";}
                                                                    elseif($carton_code == "NBL2-MQ"){echo "MC 240-MQ";}
                                                                    elseif($carton_code == "NBL3-MQ"){echo "MC 243-MQ";}
                                                                    elseif($carton_code == "NBL4-MQ"){echo "MC 215-MQ";}
                                                                    elseif($carton_code == "NBL6-MQ"){echo "MC 221-MQ";}
                                                                    elseif($carton_code == "NBL6.5-MQ"){echo "MC 224-MQ";}
                                                                    elseif($carton_code == "NBL7-MQ"){echo "MC 372-MQ";}
                                                                    elseif($carton_code == "NBL8-MQ"){echo "MC 230-MQ";}
                                                                    elseif($carton_code == "NBLDW7-MZ"){echo "NBLDW7-MZ";}
                                                                    elseif($carton_code == "NBLADW7-MX"){echo "NBLADW7-MX";}
                                                                    elseif($carton_code == "NBLDW8-MZ"){echo "NBLDW8-MZ";}
                                                                    elseif($carton_code == "NBLADW8-MX"){echo "NBLADW8-MX";}
                                                                    elseif($carton_code == "NBLDW8.5-MZ"){echo "NBLDW8.5-MZ";}
                                                                    elseif($carton_code == "NBLADW8.5-MX"){echo "NBLADW8.5-MX";}
                                                                    elseif($carton_code == "PFB6-MZ"){echo "PFB6-MZ";}
                                                                    elseif($carton_code == "PFB7-MZ"){echo "PFB7-MZ";}
                                                                    elseif($carton_code == "PFB7.5-MZ"){echo "PFB7.5-MZ";}
                                                                    elseif($carton_code == "PFB8-MZ"){echo "PFB8-MZ";}
                                                                    elseif($carton_code == "PFB8.5-MZ"){echo "PFB8.5-MZ";}
                                                                    elseif($carton_code == "PFBA6-MX"){echo "PFBA6-MX";}
                                                                    elseif($carton_code == "PFBA7-MX"){echo "PFBA7-MX";}
                                                                    elseif($carton_code == "PFBA7.5-MX"){echo "PFBA7.5-MX";}
                                                                    elseif($carton_code == "PFBA8-MX"){echo "PFBA8-MX";}
                                                                    elseif($carton_code == "PFBA8.5-MX"){echo "PFBA8.5-MX";}
                                                                    elseif($carton_code == "PFB4-MZ"){echo "PFB4-MZ";}
                                                                    elseif($carton_code == "PFB9-MZ"){echo "PFB9-MZ";}
                                                                    elseif($carton_code == "PFBA4-MX"){echo "PFBA4-MX";}
                                                                    elseif($carton_code == "PFBA9-MX"){echo "PFBA9-MX";}
                                                                    elseif($carton_code == "NBLDW4-MZ"){echo "NBLDW4-MZ";}
                                                                    elseif($carton_code == "NBLADW4-MX"){echo "NBLADW4-MX";}
                                                                    elseif($carton_code == "NBLDW6.5-MZ"){echo "NBLDW6.5-MZ";}
                                                                    elseif($carton_code == "NBLADW6.5-MX"){echo "NBLADW6.5-MX";}
                                                                    elseif($carton_code == "NBL-SP-01-MZ"){echo "NBL-SP-01-MZ";}
                                                                    elseif($carton_code == "NBL-SP-02-MZ"){echo "NBL-SP-02-MZ";}
                                                                    elseif($carton_code == "NBLA-SP-01-MX"){echo "NBLA-SP-01-MX";}
                                                                    elseif($carton_code == "NBLA-SP-02-MX"){echo "NBLA-SP-02-MX";}
                                                                    elseif($carton_code == "NBLDW6-MZ"){echo "NBLDW6-MZ";}
                                                                    elseif($carton_code == "NBLADW6-MX"){echo "NBLADW6-MX";}
                                                                    elseif($carton_code == "NBLDW9-MZ"){echo "NBLADW9-MX";}
                                                                    else{
                                                                        echo "MC 432-MQ";
                                                                    }
                                                            ?></td>
                                                            
                            <td style="text-align: center;"><?php 
                                                                if($data['packing_metode1'] == 0){
                                                                    echo $data['total_carton'];
                                                                }else{
                                                                    echo $data['no_ctn'];
                                                                }
                                                                $total += $data['total_carton'];
                                                                $subtotal = $total + $data['no_ctn'];
                                                            ?></td>
                            <td style="text-align: center;">PCS</td>
                        </tr>                        
                    </tbody>
                    <?php
                        }
                    }   
                    ?>
                    <tfoot>
                        <tr>
                            <th colspan="7" style="text-align: center;">Total</th>
                            <th style="text-align: center;"><?php echo $subtotal ?></th>
                            <th style="text-align: center;"></th>
                        </tr>
                    </tfoot>
                </table>
                <a href="excel_total_carton.php?nilai=<?= $x;?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
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