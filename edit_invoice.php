<?php
    include_once 'layout/header.php';
    require 'functions/function_invoice.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Edit User</center></h6>
            </div>
                <div class="card-body">
                <form action="functions/function_invoice.php" method="POST" enctype="multipart/form-data">
                <?php
                    $id_invoice   = $_GET['id_invoice'];
                    $get  = showData($id_invoice);
                ?>
                <?php foreach ($get as $data) { ?>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Ship to </label>
                            <input name="shipto" type="text" class="form-control form-control-sm" value="<?= $data['shipto'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Address</label>
                            <textarea name="alamat_shipto" class="form-control form-control-sm" ><?php echo $data['alamat_shipto'] ?></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Notify</label>
                            <textarea name="notify" class="form-control form-control-sm"><?php echo $data['notify'] ?></textarea>
                        </div> 
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Invoice No</label>
                            <input name="invoice_no" type="text" class="form-control form-control-sm" value="<?= $data['invoice_no'] ?>">
                        </div>                   
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Date</label>
                            <input name="tanggal" type="text" class="form-control form-control-sm" value="<?= $data['tanggal'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Payment Term</label>
                            <input name="payment_term" type="text" class="form-control form-control-sm" value="<?= $data['payment_term'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Port</label>
                            <input name="port" type="text" class="form-control form-control-sm" value="<?= $data['port'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Shipper Per</label>
                            <input name="shipper" type="text" class="form-control form-control-sm" value="<?= $data['shipper'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">On/About</label>
                            <input name="about" type="text" class="form-control form-control-sm" value="<?= $data['about'] ?>">
                            <input type="hidden" name="id_invoice" value="<?= $data['id_invoice'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Delivery Term</label>
                            <input name="delivery" type="text" class="form-control form-control-sm" value="<?= $data['delivery'] ?>">
                        </div>
                    </div>
                    <br>
                    <?php } ?>
                    <input type="hidden" name="edit">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-secondary btn-sm" href="data_invoice.php">Batal</a>
                    </form>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
?>