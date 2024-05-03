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
		             	"defaultContent": "<center><button class='btn btn-warning btn-sm tblKelola'><i>Kelola</i></button></center>" 
		         	}
		        ]
		    });
        $('#invoice tbody').on( 'click', '.tblKelola', function () {
		    var data = table.row( $(this).parents('tr')).data();
		    window.location.href = "kelola_invoice1.php?id_invoice="+ data[3];
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