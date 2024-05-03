<?php
    include_once 'layout/header.php';
    require 'functions/function_detail_master.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Data Detail Master</center></h6>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1">Tambah Data</button>
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                            </div>
                            <div class="modal-body">
                                <form action="functions/function_detail_master.php" method="POST">
                                    <div class="row">    
                                        <div class="col-md-3">
                                            <label for="formGroupExampleInput" class="form-label">Carton Code</label>
                                            <input name="carton_code" type="text" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="formGroupExampleInput" class="form-label">Packing Metode</label>
                                            <input name="packing_metode" type="text" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="formGroupExampleInput" class="form-label">Meas</label>
                                            <input name="meas" type="text" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="formGroupExampleInput" class="form-label">Meas Carton</label>
                                            <input name="meas_carton" type="text" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="formGroupExampleInput" class="form-label">Size</label>
                                            <input name="size" type="text" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="formGroupExampleInput" class="form-label">NW</label>
                                            <input name="nw" type="text" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="formGroupExampleInput" class="form-label">GW</label>
                                            <input name="gw" type="text" class="form-control form-control-sm" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="formGroupExampleInput" class="form-label">Blank Material Code</label>
                                            <input name="material_code1" type="text" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="formGroupExampleInput" class="form-label">Meas Material Code</label>
                                            <input name="material_code2" type="text" class="form-control form-control-sm" required>
                                            <input type="hidden" name="sku" class="input" value="<?php echo $_GET['sku'] ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="formGroupExampleInput" class="form-label">CBM</label>
                                            <input name="cbm" type="text" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <input type="hidden" name="add">
                                        <button class="btn btn-primary btn-sm">Simpan</button>
                                        <a class="btn btn-outline-secondary btn-sm" href="detail_master.php?sku=<?php echo $_GET['sku'] ?>">Batal</a>
                                    </div>
                                </form>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <form action="import_detail_master.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="sku" class="input" value="<?php echo $_GET['sku'] ?>">
                    <div class="input-group input-group-sm mb-3">
                        <input name="import_detail_master" type="file" class="form-control" id="inputGroupfile02" required>&emsp;
                        <button type="submit" name="excel_detail_master" style="font-size: 12px;" class="btn btn-primary btn-sm" for="inputGroup02">Upload</button>
                    </div>
                </form>
                <form action="update_detail_master.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="sku" class="input" value="<?php echo $_GET['sku'] ?>">
                    <div class="input-group input-group-sm mb-3">
                        <input name="update_master" type="file" class="form-control" id="inputGroupfile02" required>&emsp;
                        <button type="submit" name="update_master" style="font-size: 12px;" class="btn btn-info btn-sm" for="inputGroup02">Update</button>
                    </div>
                </form>
                <form action="functions/function_detail_master.php" method="POST">
                    <table class="display table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center;">SKU</th>
                                <th style="text-align: center;">Carton Code</th>
                                <th style="text-align: center;">Packing Metode</th>
                                <th style="text-align: center;">Meas</th>
                                <th style="text-align: center;">Meas Carton</th>
                                <th style="text-align: center;">size</th>
                                <th style="text-align: center;">NW</th>
                                <th style="text-align: center;">GW</th>
                                <th style="text-align: center;">Blank Material Code</th>
                                <th style="text-align: center;">Meas Material Code</th>
                                <th style="text-align: center;">NW/PRS</th>
                                <th style="text-align: center;">GW/PRS</th>
                                <th style="text-align: center;">CBM</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $all = getData(); $no = 1; ?>
                            <?php foreach ($all as $data) { ?>
                            <tr>
                                <td style="text-align: center;"><?= $data['sku'] ?></td>
                                <td style="text-align: center;"><?= $data['carton_code'] ?></td>
                                <td style="text-align: center;"><?= $data['packing_metode'] ?></td>
                                <td style="text-align: center;"><?= $data['meas'] ?></td>
                                <td style="text-align: center;"><?= $data['meas_carton'] ?></td>
                                <td style="text-align: center;"><?= $data['size']+0 ?></td>
                                <td style="text-align: center;"><?= $data['nw'] ?></td>
                                <td style="text-align: center;"><?= $data['gw'] ?></td>
                                <td style="text-align: center;"><?= $data['material_code1'] ?></td>
                                <td style="text-align: center;"><?= $data['material_code2'] ?></td>
                                <td style="text-align: center;"><?= $data['nw1'] ?></td>
                                <td style="text-align: center;"><?= $data['gw1'] ?></td>
                                <td style="text-align: center;"><?= $data['cbm'] ?></td>
                                <td style="text-align: center;"><a href="<?= 'edit_detail_master.php?id_detail='.$data['id_detail']; ?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                &nbsp;<a href="<?= 'functions/function_detail_master.php?hapus='.$data['id_detail'];?>&sku=<?php echo $_GET['sku'] ?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div>
                    <a href="<?= 'functions/function_detail_master.php?delete='.$_GET['sku']; ?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm"><i>Delete All</i></a></td>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include_once 'layout/footer.php';
    if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
?>