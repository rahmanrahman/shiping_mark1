<?php
    include_once 'layout/header.php';
    require 'functions/function_booking.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Data Booking Container</center></h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1">Tambah Data</button>
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="functions/function_booking.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Ship To</label>
                                                <input type="text" name="shipto_booking" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Address</label>
                                                <textarea type="text" name="address_booking" class="form-control" id="recipient-name"></textarea>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Notify</label>
                                                <textarea type="text" name="notify_booking" class="form-control" id="recipient-name"></textarea>
                                            </div> 
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Port Of Entry</label>
                                                <input type="text" name="poe_booking" class="form-control" id="recipient-name" >
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Final Destination </label>
                                                <input type="text" name="fd_booking" class="form-control" id="recipient-name" >
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Vessel/Voyage</label>
                                                <input type="text" name="vv_booking" class="form-control" id="recipient-name" >
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">FCL/CFS</label>
                                                <input type="text" name="fc_booking" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">ETD</label>
                                                <input type="text" name="etd_booking" class="form-control" id="recipient-name">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">ETA</label>
                                                <input type="text" name="eta_booking" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Container No</label>
                                                <input type="text" name="cn_booking" class="form-control" id="recipient-name" >
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Seal No</label>
                                                <input type="text" name="sn_booking" class="form-control" id="recipient-name" >
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Note</label>
                                                <input type="text" name="note_booking" class="form-control" id="recipient-name" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal-footer">
                                            <input type="hidden" name="add">
                                            <button class="btn btn-primary btn-sm">Simpan</button>
                                            <a class="btn btn-outline-secondary btn-sm" href="data_booking.php">Batal</a>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="display table table-bordered table-striped" id="booking" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="250px" style="text-align: center;">Ship To</th>
                                <th width="180px" style="text-align: center;">Final Destination</th>
                                <th width="180px" style="text-align: center;">Port Of Entry</th>
                                <th width="180px" style="text-align: center;">Note</th>
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
		    var table = $('#booking').DataTable( { 
		         "processing": true,
		         "serverSide": true,
		         "ajax": "load_data_booking.php",
		         "columnDefs": 
		         [
		         	{
		         		"targets": -1,
		             	"data": null,
		             	"defaultContent": "<center><button class='btn btn-warning btn-sm tblKelola'><i>Kelola</i></button> <button class='btn btn-info btn-sm tblEdit'><i>Edit</i></button>  <button class='btn btn-danger btn-sm tblDelete'><i>Hapus</i></button></center>" 
		         	}
		        ]
		    });

        $('#booking tbody').on( 'click', '.tblEdit', function () {
		    var data = table.row( $(this).parents('tr')).data();
		    window.location.href = "edit_booking.php?id_booking="+ data[4];
		});

		$('#booking tbody').on( 'click', '.tblDelete', function () {
		    var data = table.row( $(this).parents('tr')).data();
            if(confirm("Apakah anda yakin ingin menghapus data tersebut ? ")){
                window.location.href = "functions/function_booking.php?hapus="+ data[4];
            }else {
                return null;
            }
		});

        $('#booking tbody').on( 'click', '.tblKelola', function () {
		    var data = table.row( $(this).parents('tr')).data();
		    window.location.href = "kelola_booking.php?id_booking="+ data[4];
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