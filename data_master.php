<?php
    include_once 'layout/header.php';
    require 'functions/function_master.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Data Master</center></h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1">Tambah Data</button>
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="functions/function_master.php" method="POST">
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">SKU :</label>
                                            <input type="text" name="sku" class="form-control" id="recipient-name" required>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="add">
                                            <button class="btn btn-primary btn-sm">Simpan</button>
                                            <a class="btn btn-outline-secondary btn-sm" href="data_master.php">Batal</a>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <form action="import_master.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group input-group-sm mb-3">
                        <input name="import_master" type="file" class="form-control" id="inputGroupfile02" required>&emsp;
                        <button type="submit" name="excel_master" style="font-size: 12px;" class="btn btn-primary btn-sm" for="inputGroup02">Upload</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">SKU</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $all = getData(); $no = 1; ?>
                            <?php foreach ($all as $data) { ?>
                            <tr>
                                <td style="text-align: center;"><?= $no++ ?></td>
                                <td style="text-align: center;"><?= $data['sku'] ?></td>
                                <td style="text-align: center;"><a href="detail_master.php?sku=<?php echo $data['sku']; ?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-plus"></i></a>
                                &nbsp;<a href="<?= 'functions/function_master.php?hapus='.$data['sku']; ?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <a href="excel_master.php" type="button" class="btn btn-success btn-sm">Export Excel Data Master</a>
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