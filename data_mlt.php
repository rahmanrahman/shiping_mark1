<?php
include_once 'layout/header.php';
require 'functions/function_mlt.php';
?>
<!-- /.container-fluid -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark">
                <center>MLT DATA</center>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="display table table-bordered table-striped" id="mlt" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ORDER MONTH</th>
                            <th style="text-align: center;">MAN PO</th>
                            <th style="text-align: center;">FACTORY CODE</th>
                            <th style="text-align: center;">SKU</th>
                            <th style="text-align: center;">START PRODUCTION</th>
                            <th style="text-align: center;">SI DATE</th>
                            <th style="text-align: center;">MLT</th>
                        </tr>
                    </thead>
                </table>
                <a href="excel_mlt.php" type="button" class="btn btn-success btn-sm">Export to Excel</a>
            </div>
        </div>
    </div>
</div>
<script src="plugin/jquery-2.2.3.min.js"></script>
<script src="plugin/datatables/jquery.dataTables.min.js"></script>
<script src="plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugin/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="plugin/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#mlt').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "load_data_mlt.php",
            "columnDefs": [{
                    "className": "text-center",
                    "targets": "_all"
                } // Menambah kelas text-center ke setiap sel td
            ],
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