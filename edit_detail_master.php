<?php
    include_once 'layout/header.php';
    require 'functions/function_detail_master.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Edit Data</center></h6>
            </div>
                <div class="card-body">
                <form action="functions/function_detail_master.php" method="POST" enctype="multipart/form-data">
                <?php
                    $id_detail   = $_GET['id_detail'];
                    $get  = showData($id_detail);
                ?>
                <?php foreach ($get as $data) { ?>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Carton Code</label>
                            <input name="carton_code" type="text" class="form-control form-control-sm" value="<?= $data['carton_code'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Packing Metode</label>
                            <input name="packing_metode" type="text" class="form-control form-control-sm" value="<?= $data['packing_metode'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Meas</label>
                            <input name="meas" type="text" class="form-control form-control-sm" value="<?= $data['meas'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Meas Carton</label>
                            <input name="meas_carton" type="text" class="form-control form-control-sm" value="<?= $data['meas_carton'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Size</label>
                            <input name="size" type="text" class="form-control form-control-sm" value="<?= $data['size']+0 ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">NW</label>
                            <input name="nw" type="text" class="form-control form-control-sm" value="<?= $data['nw'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">GW</label>
                            <input name="gw" type="text" class="form-control form-control-sm" value="<?= $data['gw'] ?>">
                            <input type="hidden" name="sku" value="<?= $data['sku'] ?>">
                            <input type="hidden" name="id_detail" value="<?= $data['id_detail'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Blank Material Code</label>
                            <input name="material_code1" type="text" class="form-control form-control-sm" value="<?= $data['material_code1'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Meas Material Code</label>
                            <input name="material_code2" type="text" class="form-control form-control-sm" value="<?= $data['material_code2'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">CBM</label>
                            <input name="cbm" type="text" class="form-control form-control-sm" value="<?= $data['cbm'] ?>">
                        </div>
                    </div>
                    <br>
                    <?php } ?>
                    <input type="hidden" name="edit">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-secondary btn-sm" href="detail_master.php?sku=<?=$data['sku']?>">Batal</a>
                    </form>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
?>