<?php
    include_once 'layout/header.php';
    require 'functions/function_invoice.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Data Invoice</center></h6>
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
                                    <form action="functions/function_invoice.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Consignee</label>
                                                <input type="text" name="shipto" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Address</label>
                                                <textarea type="text" name="alamat_shipto" class="form-control" id="recipient-name"></textarea>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Notify</label>
                                                <textarea type="text" name="notify" class="form-control" id="recipient-name"></textarea>
                                            </div> 
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Invoice No</label>
                                                <input type="text" name="invoice_no" class="form-control" id="recipient-name" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Date </label>
                                                <input type="text" name="tanggal" class="form-control" id="recipient-name" >
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Payment Term</label>
                                                <input type="text" name="payment_term" class="form-control" id="recipient-name" >
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Port</label>
                                                <input type="text" name="port" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Shipper Per </label>
                                                <input type="text" name="shipper" class="form-control" id="recipient-name">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">On/About </label>
                                                <input type="text" name="about" class="form-control" id="recipient-name">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="formGroupExampleInput" class="form-label">Delivery Term </label>
                                                <input type="text" name="delivery" class="form-control" id="recipient-name" >
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal-footer">
                                            <input type="hidden" name="add">
                                            <button class="btn btn-primary btn-sm">Simpan</button>
                                            <a class="btn btn-outline-secondary btn-sm" href="data_invoice.php">Batal</a>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="display table table-bordered table-striped" id="invoice" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Invoice No</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Payment Term</th>
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
		    var table = $('#invoice').DataTable( { 
		         "processing": true,
		         "serverSide": true,
		         "ajax": "load_data_invoice.php",
		         "columnDefs": 
		         [
		         	{
		         		"targets": -1,
		             	"data": null,
		             	"defaultContent": "<center><button class='btn btn-warning btn-sm tblKelola'><i>Kelola</i></button> <button class='btn btn-info btn-sm tblEdit'><i>Edit</i></button>  <button class='btn btn-danger btn-sm tblDelete'><i>Hapus</i></button> <button class='btn btn-success btn-sm tblPacking'><i>Packing List</i></button></center>" 
		         	}
		        ]
		    });

        $('#invoice tbody').on( 'click', '.tblEdit', function () {
		    var data = table.row( $(this).parents('tr')).data();
		    window.location.href = "edit_invoice.php?id_invoice="+ data[3];
		});

		$('#invoice tbody').on( 'click', '.tblDelete', function () {
		    var data = table.row( $(this).parents('tr')).data();
            if(confirm("Apakah anda yakin ingin menghapus data tersebut ? ")){
                window.location.href = "functions/function_invoice.php?hapus="+ data[3];
            }else {
                return null;
            }
		});

        $('#invoice tbody').on( 'click', '.tblKelola', function () {
		    var data = table.row( $(this).parents('tr')).data();
		    window.location.href = "kelola_invoice.php?id_invoice="+ data[3];
		});

        $('#invoice tbody').on( 'click', '.tblPacking', function () {
		    var data = table.row( $(this).parents('tr')).data();
		    window.location.href = "kelola_packing.php?id_invoice="+ data[3];
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