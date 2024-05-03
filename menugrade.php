<?php
    include_once 'layout/header.php';
    require 'functions/function_grade.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Tambah Data</center></h6>
        </div>
        <div class="card-body">
        <form action="functions/function_grade.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <?php date_default_timezone_set('Asia/Jakarta');
                                                $date = date('d-m-Y');
                                                ?>
            
                                                <label for="formGroupExampleInput" class="form-label">Category</label>
                                                <select class ="form-control" name ="category">
                                                    <option value = "">Pilih</option>
                                                    <option value = "Bgrade">B Grade</option>
                                                    <option value = "Cgrade">C Grade</option>
                                                </select>
                                                <input type="hidden" name="date" value="<?= $date ?>">
                                            </div>
                                            <div class="col-md-9">
                                                <label for="formGroupExampleInput" class="form-label">Factory Code</label>
                                                <div class = "input-group input-group-sm mb-3">
                                                <select name="id_summary" id="id_summary" class="form-control form-control-sm selectpicker" data-show-subtext="true" data-live-search="true" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <?php $jenis = getSummary(); foreach ($jenis as $jns) { ?>
					                              <option value="<?= $jns['id_summary'] ?>"><?= $jns['prod_month'] ?> - <?= $jns['factory_code'] ?></option>
					                            <?php } ?>
                                                </select>&emsp;
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal-footer">
                                            <input type="hidden" name="add">
                                            <button class="btn btn-primary btn-sm">Simpan</button>
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
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Data Grade</center></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="table-grade" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Prod Month</th>
                            <th style="text-align: center;">Factory Code</th>
                            <th style="text-align: center;">Category</th>
                            <th style="text-align: center;">Date</th>

                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- /.container-fluid -->
<script src="plugin/jquery-2.2.3.min.js"></script>
<script src="plugin/datatables/jquery.dataTables.min.js"></script>
<script src="plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugin/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="plugin/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
		    var table = $('#table-grade').DataTable( { 
		         "processing": true,
		         "serverSide": true,
		         "ajax": "load_data_grade.php",
		         "columnDefs": 
		         [
		         	{
		         		"targets": -1,
		             	"data": null,
		             	"defaultContent": "<center><button class='btn btn-info btn-sm tblgrade'><span style='font-size : 10px; font-weight : bolder;'>DETAIL</span></button>" 
		         	}
		        ]
		    });

        $('#table-grade tbody').on( 'click', '.tblgrade', function () {
		    var data = table.row( $(this).parents('tr')).data();
		    window.location.href = "data_detail_grade.php?id_grade="+ data[4];
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