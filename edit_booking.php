<?php
    include_once 'layout/header.php';
    require 'functions/function_booking.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Edit Booking</center></h6>
            </div>
                <div class="card-body">
                <form action="functions/function_booking.php" method="POST" enctype="multipart/form-data">
                <?php
                    $id_booking   = $_GET['id_booking'];
                    $get  = showData($id_booking);
                ?>
                <?php foreach ($get as $data) { ?>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Ship To</label>
                            <input type="text" name="shipto_booking" class="form-control" id="recipient-name" value="<?= $data['shipto_booking'] ?>">
                            <input type="hidden" name="id_booking" class="form-control" id="recipient-name" value="<?= $data['id_booking'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Address</label>
                            <textarea type="text" name="address_booking" class="form-control" id="recipient-name"><?= $data['address_booking'] ?></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Notify</label>
                            <textarea type="text" name="notify_booking" class="form-control" id="recipient-name"><?= $data['notify_booking'] ?></textarea>
                        </div> 
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Port Of Entry</label>
                            <input type="text" name="poe_booking" class="form-control" id="recipient-name" value="<?= $data['poe_booking'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Final Destination </label>
                            <input type="text" name="fd_booking" class="form-control" id="recipient-name" value="<?= $data['fd_booking'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Vessel/Voyage</label>
                            <input type="text" name="vv_booking" class="form-control" id="recipient-name" value="<?= $data['vv_booking'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">FCL/CFS</label>
                            <input type="text" name="fc_booking" class="form-control" id="recipient-name" value="<?= $data['fc_booking'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">ETD</label>
                            <input type="text" name="etd_booking" class="form-control" id="recipient-name" value="<?= $data['etd_booking'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">ETA</label>
                            <input type="text" name="eta_booking" class="form-control" id="recipient-name" value="<?= $data['eta_booking'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Container No</label>
                            <input type="text" name="cn_booking" class="form-control" id="recipient-name" value="<?= $data['cn_booking'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Seal No</label>
                            <input type="text" name="sn_booking" class="form-control" id="recipient-name" value="<?= $data['sn_booking'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Note</label>
                            <input type="text" name="note_booking" class="form-control" id="recipient-name" value="<?= $data['note_booking'] ?>">
                        </div>
                    </div>
                    <br>
                    <?php } ?>
                    <input type="hidden" name="edit">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-secondary btn-sm" href="data_booking.php">Batal</a>
                    </form>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
?>