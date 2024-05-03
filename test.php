<?php
    include_once 'layout/header.php';
    require 'functions/function_master.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Test</center></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Factory Code</th>
                                <th style="text-align: center;">CBM</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $sqlPrs = mysqli_query($conn, "SELECT d.factory_code, a.packing_metode1 ,SUM(IF(a.packing_metode1=0, a.no_ctn * b.cbm, 0)) AS nilai1, IF(a.packing_metode1>0, MAX(b.cbm) * a.no_ctn, 0) AS nilai2 FROM tb_packing_list a LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing LEFT JOIN tb_summery d ON c.id_summary = d.id_summary LEFT JOIN tb_master e ON d.sku = e.sku GROUP BY d.factory_code");
                            while($data = Mysqli_fetch_array($sqlPrs)){
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $data['factory_code']?></td>
                                <td style="text-align: center;"><?php if($data['packing_metode1'] == 0){
                                                                            echo $data['nilai1'];
                                                                        }else{
                                                                            echo $data['nilai2'];
                                                                        } ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <a href="excel_test.php" type="button" class="btn btn-success btn-sm">EXCEL</a>
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