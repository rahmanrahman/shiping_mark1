<?php
include_once 'layout/header.php';
require 'functions/function_taking_out.php';
?>


<!-- /.container-fluid -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark">
                <center>TAKING OUT MATERIAL</center>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <input type="text" name="input-add" id="input_add" autofocus style="position: absolute; left: -9999px;">

                <table class="display table table-bordered table-striped" id="taking_out" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">ORDER MONTH</th>
                            <th class="text-center">PO NUMBER</th>
                            <th class="text-center">MAN PO</th>
                            <th class="text-center">SKU</th>
                            <th class="text-center">MATERIAL CODE</th>
                            <th class="text-center">MATERIAL NAME</th>
                            <th class="text-center">COMPONENT</th>
                            <th class="text-center">MATERIAL TAKING DATE</th>
                        </tr>
                    </thead>
                </table>
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
<script src="js/toast.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#taking_out').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "load_data_taking_out.php",
            "columnDefs": [{
                    "className": "text-center",
                    "targets": "_all"
                } // Menambah kelas text-center ke setiap sel td
            ],
        });

        $('#input_add').on('change', function() {
            let value = $(this).val();
            $.ajax({
                url: 'functions/function_taking_out.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    action: 'scan',
                    value: value
                },
                success: function(response) {
                    $.toast({
                        text: response.text,
                        heading: response.heading,
                        position: 'top-right',
                        icon: response.status
                    });
                    $('#input_add').val('');
                    table.ajax.reload();
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                }
            })
        })
    });
</script>

<?php
include_once 'layout/footer.php';
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>