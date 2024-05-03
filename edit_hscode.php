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
                    $id_hscode   = $_GET['id_hscode'];
                    $get  = showHscode($id_hscode);
                ?>
                <?php foreach ($get as $data) { ?>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">Factory_code</label>
                            <input type="text" class="form-control form-control-sm" value="<?= $data['factory_code'] ?>" disabled readonly>
                            <input type="hidden" name="id_summary" value="<?= $data['id_summary'] ?>">
                            <input type="hidden" name="id_hscode" value="<?= $data['id_hscode'] ?>">
                            <input type="hidden" name="id_invoice" value="<?= $data['id_invoice'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="formGroupExampleInput" class="form-label">HS CODE</label>
                            <input name="hscode" type="text" class="form-control form-control-sm" value="<?= $data['hscode'] ?>">
                        </div>
                    </div>
                    <br>
                    <?php } ?>
                    <input type="hidden" name="edit1">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                    <?php 
                    $id_invoice = $_GET['id_invoice'];
                    ?> 
                    <a class="btn btn-secondary btn-sm" href="kelola_invoice.php?id_invoice=<?php echo $id_invoice;?>">Batal</a>
                    </form>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
?>