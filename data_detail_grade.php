<?php
    include_once 'layout/header.php';
    require 'functions/function_grade.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Data Grade </center></h6>
        </div>
        <div style="font-size : 11px;" class="card-body">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Size</th>
                            <?php $allSize = getSize();?>
                            <?php foreach ($allSize as $dataSize) { ?>
                            <th style="text-align: center;"><?php echo $dataSize['size']+0;?></th><?php } ?>
                             <th style="text-align: center;">Aksi</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">Order Qty</th>
                            <?php $allSize = getSize();?>
                            <?php foreach ($allSize as $dataSize) { ?>
                            <th style="text-align: center;"><?php echo "";?></th><?php } ?>
                            <th rowspan="3" style="text-align: center; vertical-align: middle;"><Button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#add">Add</Button></th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">Left</th>
                            <?php $allShow = showSize();?>
                            <?php foreach ($allShow as $data) { ?>
                            <th style="text-align: center;"><?php echo $data['kiri'];?></th><?php } ?>
                        </tr>
                        <tr>
                        <th style="text-align: center;">Right</th>
                            <?php $allShow = showSize();?>
                            <?php foreach ($allShow as $data) { ?>
                            <th style="text-align: center;"><?php echo $data['kanan'];?></th><?php } ?>
                        </tr>
                    </thead>
        
                </table>
                
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
            </div>
            <div class="modal-body">
                <form action="functions/function_grade.php" method="POST">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Size :</label>
                        <select name="id_detail" id="id_detail" class="form-select" aria-label="Default select example">
                            <?php $detail = getSize(); foreach ($detail as $data) { ?>
					            <option value="<?= $data['id_detail'] ?>"><?= $data['size']+0 ?></option>
					        <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                         <label for="message-text" class="col-form-label">Left :</label>
                         <input type="text" name="kiri" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Right :</label>
                         <input type="text" name="kanan" class="form-control" id="recipient-name" required>
                         <input type="hidden" name="id_grade" class="form-control" id="recipient-name" value="<?= $_GET['id_grade']  ?>">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="add1">
                        <button class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-outline-secondary btn-sm" href="data_detail_grade.php?id_grade=<?= $_GET['id_grade']  ?>">Batal</a>
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>




<?php
    include_once 'layout/footer.php';
?>