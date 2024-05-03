<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MPI BUSINESS SYSTEM</title>
    <link rel="icon" href="img/logo.png" sizes="32x32">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/font.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/toast.css">
    <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/sweetalert2-theme-bootstrap-4/sweetalert2.min.css">
    <script>
        function hapusBySweetAlert(link) {
            Swal.fire({
                title: 'Apakah yakin?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke URL yang diambil dari tautan
                    window.location.href = link;
                }
            });
        }
    </script>

</head>

<body>

    <!-- Begin Page Content -->
    <div class="container mt-5">

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
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/toast.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/select2.js"></script>
    <script src="assets/sweetalert2/sweetalert2.min.js"></script>
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

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>