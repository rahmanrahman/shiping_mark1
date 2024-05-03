<?php
include_once 'layout/header.php';
require 'functions/function_summary.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark">
                <center>Edit Data</center>
            </h6>
        </div>
        <div class="card-body">
            <form action="functions/function_summary.php" method="POST" enctype="multipart/form-data">
                <?php
                $id_summary   = $_GET['id_summary'];
                $get  = showData($id_summary);
                ?>
                <?php foreach ($get as $data) { ?>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Prod Month</label>
                            <input name="prod_month" type="text" class="form-control form-control-sm" value="<?= $data['prod_month'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Cust Id</label>
                            <input name="cust_id" type="text" class="form-control form-control-sm" value="<?= $data['cust_id'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Man Po</label>
                            <input name="man_po" type="text" class="form-control form-control-sm" value="<?= $data['man_po'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Cust Po</label>
                            <input name="cust_po" type="text" class="form-control form-control-sm" value="<?= $data['cust_po'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Po Referance</label>
                            <input name="po_referance" type="text" class="form-control form-control-sm" value="<?= $data['po_referance'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Factory Code</label>
                            <input name="factory_code" type="text" class="form-control form-control-sm" value="<?= $data['factory_code'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Category</label>
                            <input name="category" type="text" class="form-control form-control-sm" value="<?= $data['category'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Gender</label>
                            <input name="gender" type="text" class="form-control form-control-sm" value="<?= $data['gender'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Color</label>
                            <input name="color" type="text" class="form-control form-control-sm" value="<?= $data['color'] ?>">
                            <input type="hidden" name="id_summary" value="<?= $data['id_summary'] ?>">
                            <input type="hidden" name="sku" value="<?= $data['sku'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Widht</label>
                            <input name="widht" type="text" class="form-control form-control-sm" value="<?= $data['widht'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">PPK Code</label>
                            <input name="code" type="text" class="form-control form-control-sm" value="<?= $data['code'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Destination</label>
                            <input name="destination" type="text" class="form-control form-control-sm" value="<?= $data['destination'] ?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Price</label>
                            <input name="price" type="text" class="form-control form-control-sm" value="<?= $data['price'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Confirm XFD</label>
                            <input name="xfd" type="text" class="form-control form-control-sm" value="<?= $data['xfd'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Vendor Code</label>
                            <input name="vendor_code" type="text" class="form-control form-control-sm" value="<?= $data['vendor_code'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Ship Mode</label>
                            <input name="mode" type="text" class="form-control form-control-sm" value="<?= $data['mode'] ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">SI Date</label>
                            <input name="si_date" type="date" class="form-control form-control-sm" value="<?= $data['si_date'] ?>">
                        </div>
                    </div>
                    <br>
                <?php } ?>
                <input type="hidden" name="edit">
                <button class="btn btn-primary btn-sm">Simpan</button>
                <a class="btn btn-secondary btn-sm" href="data_summary.php">Batal</a>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include_once 'layout/footer.php';
?>