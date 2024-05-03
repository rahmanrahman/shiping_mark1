<?php
    include_once 'layout/header.php';
    require 'functions/function_alamat.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Data Alamat</center></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Factory Code</th>
                                <th style="text-align: center;">Ship to</th>
                                <th style="text-align: center;">Address</th>
                                <th style="text-align: center;">Port Of Loading</th>
                                <th style="text-align: center;">Port Of Entry</th>
                                <th style="text-align: center;">Final Destination</th>
                                <th style="text-align: center;">Vesel/Voyage</th>
                                <th style="text-align: center;">FCL/CFS</th>
                                <th style="text-align: center;">ETD</th>
                                <th style="text-align: center;">ETA</th>
                                <th style="text-align: center;">Container No</th>
                                <th style="text-align: center;">Seal No</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $all = getData(); $no = 1; ?>
                            <?php foreach ($all as $data) { ?>
                            <tr>
                                <td style="text-align: center;"><?= $no++ ?></td>
                                <td style="text-align: center;"><?= $data['factory_code'] ?></td>
                                <td style="text-align: center;"><?= $data['ship_to'] ?></td>
                                <td style="text-align: center;"><?= $data['address'] ?></td>
                                <td style="text-align: center;"><?= $data['port_of_loading'] ?></td>
                                <td style="text-align: center;"><?= $data['port_of_entry'] ?></td>
                                <td style="text-align: center;"><?= $data['final_destination'] ?></td>
                                <td style="text-align: center;"><?= $data['vessel_voyage'] ?></td>
                                <td style="text-align: center;"><?= $data['fcl_cfs'] ?></td>
                                <td style="text-align: center;"><?= $data['etd'] ?></td>
                                <td style="text-align: center;"><?= $data['eta'] ?></td>
                                <td style="text-align: center;"><?= $data['container_no'] ?></td>
                                <td style="text-align: center;"><?= $data['seal_no'] ?></td>
                                <td style="text-align: center;"><a href="<?= 'edit_alamat.php?id_alamat='.$data['id_alamat']; ?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                <a href="<?= 'functions/function_alamat.php?hapus='.$data['id_alamat']; ?>" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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