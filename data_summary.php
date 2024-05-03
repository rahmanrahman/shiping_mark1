<?php
include_once 'layout/header.php';
require 'functions/function_summary.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div style="font-size : 11px;" class="card-body">
            <div class="table-responsive">
                <h6><i style="color : red; font-weight: bold;">Pastikan Format Upload Summary sudah Sesuai!!</i></h6>
                <h7><i>Download Disini untuk Melihat Format Upload Summary</i></h7>&emsp;<button onclick="JavaScript:window.location.href='download.php?file=sample-summary-update.xlsx';" style="font-size: 12px;" class="btn btn-primary btn-sm"> Download</button><br />
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark">
                <center>Data summary</center>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="import_summary.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group input-group-sm mb-3">
                        <input name="import_summary" type="file" class="form-control" id="inputGroupfile02" required>&emsp;
                        <button type="submit" name="excel_summary" style="font-size: 12px;" class="btn btn-primary btn-sm" for="inputGroup02">Upload</button>
                    </div>
                </form>
                <form action="import_update_summary.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group input-group-sm mb-3 ">
                        <input name="update_summary" type="file" class="form-control" id="inputGroupfile02" required>&emsp;
                        <button type="submit" name="update_summary" style="font-size: 12px;" class="btn btn-danger btn-sm" for="inputGroup02">Update</button>
                    </div>
                </form>
                <table class="display table table-bordered table-striped" id="summary" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Prod Month</th>
                            <th style="text-align: center;">Cust Id</th>
                            <th style="text-align: center;">Man Po</th>
                            <th style="text-align: center;">Cust Po</th>
                            <th style="text-align: center;">Po Referance</th>
                            <th style="text-align: center;">Factory Code</th>
                            <th style="text-align: center;">SKU</th>
                            <th style="text-align: center;">Category</th>
                            <th style="text-align: center;">Gender</th>
                            <th style="text-align: center;">Color</th>
                            <th style="text-align: center;">Widht</th>
                            <th style="text-align: center;">PPK Code</th>
                            <th style="text-align: center;">Dest.</th>
                            <th style="text-align: center;">Price</th>
                            <th style="text-align: center;">Confirm XFD</th>
                            <th style="text-align: center;">Ship Date</th>
                            <th style="text-align: center;">PO Release Date</th>
                            <th style="text-align: center;">Vendor Code</th>
                            <th style="text-align: center;">Ship Mode</th>
                            <th style="text-align: center;">SI Date</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                </table>
                <a href="excel_summary.php" type="button" class="btn btn-success btn-sm">EXCEL</a>
                <a href="excel_summary_date.php" type="button" class="btn btn-success btn-sm">EXCEL NO SHIP DATE</a>
                <a href="test.php" type="button" class="btn btn-primary btn-sm">CBM</a>
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
        var table = $('#summary').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "load_data_summary.php",
            "columnDefs": [{
                "targets": -1,
                "data": null,
                "defaultContent": "<center><button class='btn btn-info btn-circle btn-sm tblEdit'><i class='fas fa-pen'></i></button> <button class='btn btn-danger btn-circle btn-sm tblDelete'><i class='fas fa-trash'></i></button></center>"
            }]
        });

        $('#summary tbody').on('click', '.tblEdit', function() {
            var data = table.row($(this).parents('tr')).data();
            window.location.href = "edit_summary.php?id_summary=" + data[20];
        });

        $('#summary tbody').on('click', '.tblDelete', function() {
            var data = table.row($(this).parents('tr')).data();
            let link = "functions/function_summary.php?hapus=" + data[20];
            hapusBySweetAlert(link);
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