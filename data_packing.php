<?php
    include_once 'layout/header.php';
    require 'functions/function_packing.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Tambah Data</center></h6>
        </div>
        <div class="card-body">
            <form action="functions/function_packing.php" method="POST" enctype="multipart/form-data">
                <div>
                    <div class="input-group input-group-sm mb-3">
                        <select name="id_summary" id="id_summary" class="form-control form-control-sm selectpicker" data-show-subtext="true" data-live-search="true" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <?php $jenis = getSummary(); foreach ($jenis as $jns) { ?>
					            <option value="<?= $jns['id_summary'] ?>"><?= $jns['prod_month'] ?> - <?= $jns['factory_code'] ?></option>
					        <?php } ?>
                        </select>&emsp;
                        <button type="submit" name="add" class="btn btn-primary btn-sm" id="button-addon2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Data Packing</center></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="packing" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Prod Month</th>
                            <th style="text-align: center;">Factory Code</th>
                            <th style="text-align: center;">SKU</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script src="plugin/jquery-2.2.3.min.js"></script>
<script src="plugin/datatables/jquery.dataTables.min.js"></script>
<script src="plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugin/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="plugin/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
		    var table = $('#packing').DataTable( { 
		         "processing": true,
		         "serverSide": true,
		         "ajax": "load_data_packing.php",
		         "columnDefs": 
		         [
		         	{
		         		"targets": -1,
		             	"data": null,
		             	"defaultContent": "<center><button class='btn btn-info btn-sm tblSolid'><span style='font-size : 10px; font-weight : bolder;'>SOLID</span></button> <button class='btn btn-warning btn-sm tblPrepack'><span style='font-size : 10px; font-weight : bolder;'>PREPACK</span></button> <button class='btn btn-danger btn-circle btn-sm tblDelete'><i class='fas fa-trash'></i></button></center>" 
		         	}
		        ]
		    });

        $('#packing tbody').on( 'click', '.tblSolid', function () {
		    var data = table.row( $(this).parents('tr')).data();
		    window.location.href = "data_packing_list.php?id_add_packing="+ data[3];
		});

		$('#packing tbody').on( 'click', '.tblPrepack', function () {
		    var data = table.row( $(this).parents('tr')).data();
                window.location.href = "data_packing_prepack.php?id_add_packing="+ data[3];    
		});

        $('#packing tbody').on( 'click', '.tblDelete', function () {
		    var data = table.row( $(this).parents('tr')).data();
            if(confirm("Apakah anda yakin ingin menghapus data tersebut ? ")){
                window.location.href = "functions/function_packing.php?hapus="+ data[3];
            }else {
                return null;
            }
        });
    });
</script>

<?php
    include_once 'layout/footer.php';
    if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
?>