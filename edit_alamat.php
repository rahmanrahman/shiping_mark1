<?php
    include_once 'layout/header.php';
    require 'functions/function_alamat.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Edit Data</center></h6>
            </div>
                <div class="card-body">
                <form action="functions/function_alamat.php" method="POST" enctype="multipart/form-data">
                <?php
                    $id_alamat   = $_GET['id_alamat'];
                    $get  = showAlamat($id_alamat);
                ?>
                <?php foreach ($get as $data) { ?>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Ship To</label>
                            <input name="ship_to" type="text" class="form-control form-control-sm" value="<?= $data['ship_to'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Address</label>
                            <input name="address" type="text" class="form-control form-control-sm" value="<?= $data['address'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Port Of Loading</label>
                            <input name="port_of_loading" type="text" class="form-control form-control-sm" value="<?= $data['port_of_loading'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Port Of Entry</label>
                            <input name="port_of_entry" type="text" class="form-control form-control-sm" value="<?= $data['port_of_entry'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Final Destination</label>
                            <input name="final_destination" type="text" class="form-control form-control-sm" value="<?= $data['final_destination'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Vesel/Voyage</label>
                            <input name="vessel_voyage" type="text" class="form-control form-control-sm" value="<?= $data['vessel_voyage'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">FCL/CFS</label>
                            <input name="fcl_cfs" type="text" class="form-control form-control-sm" value="<?= $data['fcl_cfs'] ?>">
                            <input type="hidden" name="id_summary" value="<?= $data['id_summary'] ?>">
                            <input type="hidden" name="id_alamat" value="<?= $data['id_alamat'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">ETD</label>
                            <input name="etd" type="date" class="form-control form-control-sm" value="<?= $data['etd'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">ETA</label>
                            <input name="eta" type="date" class="form-control form-control-sm" value="<?= $data['eta'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Container No</label>
                            <input name="container_no" type="text" class="form-control form-control-sm" value="<?= $data['container_no'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Seal No</label>
                            <input name="seal_no" type="text" class="form-control form-control-sm" value="<?= $data['seal_no'] ?>">
                        </div>
                    </div>
                    <br>
                    <?php } ?>
                    <input type="hidden" name="edit">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-secondary btn-sm" href="data_alamat.php">Batal</a>
                    </form>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
?>