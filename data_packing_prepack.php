<?php
    include_once 'layout/header.php';
    require 'functions/function_packing_list.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div style="font-size : 11px;" class="card-body">
            <div class="table-responsive">
                <h6><i style="color : red; font-weight: bold;">Pastikan Format Upload packing List sudah Sesuai!!</i></h6>
                <h7><i>Download Disini untuk Melihat Format Upload Packing List</i></h7>&emsp;<button onclick="JavaScript:window.location.href='download.php?file=Example Packing List.xlsx';" style="font-size: 12px;" class="btn btn-primary btn-sm"> Download</button><br />
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Data Packing List PrePack</center></h6>
        </div>
        <div style="font-size : 11px;" class="card-body">
            <div class="table-responsive">
                <?php
                    $a = $_GET['id_add_packing'];
                    $cek = mysqli_query($conn, "SELECT * FROM tb_packing_list a 
                                                LEFT JOIN tb_add_packing b ON b.id_add_packing = a.id_add_packing 
                                                LEFT JOIN tb_detail_master c ON a.id_detail = c.id_detail 
                                                WHERE a.id_add_packing='$a'");
                    $b =  mysqli_num_rows($cek);

                    if($b == 0){ ?>
                        <form action="import_packing_prepack.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_add_packing" class="input" value="<?php echo $_GET['id_add_packing'] ?>">
                            <input type="hidden" name="userLogin" class="input" value="<?php echo $_SESSION['username'] ?>">
                            <div class="input-group input-group-sm mb-3">
                                <input name="import_packing_prepack" type="file" class="form-control" id="inputGroupfile02" required>&emsp;
                                <button type="submit" name="excel_packing_prepack" style="font-size: 12px;" class="btn btn-primary btn-sm" for="inputGroup02">Upload</button>
                            </div>
                        </form>
                    <?php }
                ?>
                <table class="display table table-bordered table-striped" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Carton Number</th>
                            <?php $allSize = getSize();?>
                            <?php foreach ($allSize as $dataSize) { ?>
                            <th style="text-align: center;"><?php echo $dataSize['size']+0;?></th><?php } ?>
                            <th style="text-align: center;">PRS Ctn</th>
                            <th style="text-align: center;">QTY (PRS)</th>
                            <th style="text-align: center;">Total Carton</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $all = getPrepack(); $no = 1; ?>
                        <?php foreach ($all as $data) {
                            ?>
                        <tr>
                            <td style="text-align: center;"><?= $data['ctn_no'] ?></td>
                            <?php $allSize = getpacking();?>
                            <?php foreach ($allSize as $dataSize) { ?>
                            <td style="text-align: center;"><?php echo $dataSize['packing_metode1'];?></td><?php } ?>
                            <td style="text-align: center;"><?= $data['prs_ctn'] ?></td>
                            <td style="text-align: center;"><?= $data['qty_prs'] ?></td>
                            <td style="text-align: center;"><?= $data['no_ctn'] ?></td>
                        </tr>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <?php $totalsize = count($allSize) + 1; ?>   
                            <th colspan="<?php echo $totalsize; ?>" style="text-align: center;">Total</th>
                            <th style="text-align: center;"><?= $data['prs_ctn'] ?></th>
                            <th style="text-align: center;"><?= $data['qty_prs'] ?></th>
                            <th style="text-align: center;"><?= $data['no_ctn'] ?></th>
                        </tr>
                    </tfoot>
                    <?php } ?>
                </table>
                <?php
                    $a = $_GET['id_add_packing'];
                    $cek = mysqli_query($conn, "SELECT * FROM tb_packing_list a
                                                LEFT JOIN tb_add_packing b ON b.id_add_packing = a.id_add_packing 
                                                LEFT JOIN tb_detail_master c ON a.id_detail = c.id_detail 
                                                WHERE a.id_add_packing='$a'");
                    $b =  mysqli_num_rows($cek);

                    if($b == 0){
                       
                    }else{ ?>
                        <a href="<?= 'functions/function_packing_list.php?delete1='.$_GET['id_add_packing']; ?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm"><i>Delete All</i></a>
                        <?php 
                        $a = $_GET['id_add_packing'];
                        $sqluser = mysqli_query($conn, "SELECT updateuser, tgl_update FROM tb_packing_list a
                                                    LEFT JOIN tb_add_packing b ON b.id_add_packing = a.id_add_packing 
                                                    LEFT JOIN tb_detail_master c ON a.id_detail = c.id_detail 
                                                    WHERE a.id_add_packing='$a' GROUP BY updateuser");
                        while($datauser = Mysqli_fetch_array($sqluser)){
                        ?>
                        <span style="font-weight:bolder;" class="d-md-flex justify-content-md-end">Update : 
                            <?php if($datauser['updateuser'] == ""){
                                echo "The Past";
                            }else{
                                echo $datauser['updateuser']; echo " - "; echo $datauser['tgl_update'];
                            } ?>
                        </span>
                    <?php } }
                ?>
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