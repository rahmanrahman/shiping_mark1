<?php
    include_once 'layout/header.php';
    require 'functions/function_packing.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Data Shipping Mark</center></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
               <table class="display table table-bordered table-striped" id="output" width="100%" cellspacing="0">
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
		    var table = $('#output').DataTable( { 
		         "processing": true,
		         "serverSide": true,
		         "ajax": "load_data_output.php",
		         "columnDefs": 
		         [
		         	{
		         		"targets": -1,
		             	"data": null,
		             	"defaultContent": "<center><button class='btn btn-info btn-sm tblMarking'><i style='font-size : 10px; font-weight : bolder;'>Marking</i></button> <button class='btn btn-success btn-sm tblPacking'><i style='font-size : 10px; font-weight : bolder;'>Packing List</i></button></center>"
                    
		         	}
		        ]
		    });

            $('#output tbody').on( 'click', '.tblMarking', function () {
		        var data = table.row( $(this).parents('tr')).data();
                if(data[5] == 'MEXICO' || data[5] == 'TURKEY'){
                    if(data[3] == 0){
                        window.location.href = "output_summary.php?id_summary="+ data[4];
                    }else{
                        window.location.href = "output_summary_prepack.php?id_summary="+ data[4];
                    }
                }else if(data[5] == 'PANAMA'){
                        window.location.href = "output_summary_panama.php?id_summary="+ data[4];
                }else if(data[5] == 'UNITED STATES'){
                    if(data[3] == 0){
                        window.location.href = "output_shipping_mark.php?id_summary="+ data[4];
                    }else {
                        if(data[6] == 'KOHL`S DEPARTMENT STORE'){
                            window.location.href = "output_summary_usa.php?id_summary="+ data[4];
                        }else{
                            window.location.href = "output_summary_usa1.php?id_summary="+ data[4];
                        }                        
                    }
                }else if(data[5] == 'KOREA, REPUBLIC OF' || data[5] == 'KOREA'){
                    if(data[3] == 0){
                        if(data[6] == 'Foot Locker Korea LLC (For NBSG)'){
                            window.location.href = "output_shipping_mark.php?id_summary="+ data[4];
                        }else{
                            window.location.href = "output_summary.php?id_summary="+ data[4];
                        }
                    }else {
                        if(data[6] == 'Foot Locker Korea LLC (For NBSG)'){
                            window.location.href = "output_packing_prepack.php?id_summary="+ data[4];
                        }else{
                            window.location.href = "output_summary_prepack.php?id_summary="+ data[4];
                        }
                    }
                }else if(data[5] == 'AUSTRALIA'){
                    if(data[3] == 0){
                        window.location.href = "output_shipping_mark.php?id_summary="+ data[4];
                    }else {
                        window.location.href = "output_summary_australia.php?id_summary="+ data[4];
                    }
                }else if(data[5] == 'INDONESIA'){
                    if(data[3] == 0){
                        window.location.href = "output_shipping_mark.php?id_summary="+ data[4];
                    }else {
                        window.location.href = "output_summary_indonesia.php?id_summary="+ data[4];
                    }
                }else if(data[5] == 'BRAZIL'){
                    if(data[3] == 0){
                        window.location.href = "output_shipping_mark.php?id_summary="+ data[4];
                    }else {
                        if(data[7] == ''){
                            window.location.href = "output_shipping_prepack.php?id_summary="+ data[4];
                        }else{
                            window.location.href = "output_shipping_brazil.php?id_summary="+ data[4];
                        }
                    }
                }else{
                    if(data[3] == 0){
                        window.location.href = "output_shipping_mark.php?id_summary="+ data[4];
                    }else {
                        window.location.href = "output_shipping_prepack.php?id_summary="+ data[4];
                    }
                }
                
		    });

		    $('#output tbody').on( 'click', '.tblPacking', function () {
		        var data = table.row( $(this).parents('tr')).data();
                if(data[5] == 'BRAZIL'){
                    if(data[3] == 0){
                        window.location.href = "output_packing_list.php?id_summary="+ data[4];
                    }else {
                        if(data[7] == ''){
                            window.location.href = "output_packing_prepack.php?id_summary="+ data[4];
                        }else{
                            window.location.href = "output_packing_brazil.php?id_summary="+ data[4];
                        }
                    }
                }else{
                    if(data[3] == 0){
                        window.location.href = "output_packing_list.php?id_summary="+ data[4];
                    }else {
                        window.location.href = "output_packing_prepack.php?id_summary="+ data[4];
                    };
                }
		    });
    });
</script>

<?php
    include_once 'layout/footer.php';
?>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>