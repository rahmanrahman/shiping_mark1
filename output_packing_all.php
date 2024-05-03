<?php
    include_once 'layout/header.php';
    require_once 'functions/koneksi.php';
    require 'functions/function_output.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>Tambah Data Alamat</center></h6>
        </div>
            <div class="card-body">
            <form action="functions/function_alamat.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">Ship To</label>
                        <input name="ship_to" type="text" class="form-control form-control-sm" >
                        <input type="hidden" name="id_summary" class="input" value="<?php echo implode($_POST['id_summary'],','); ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">Address</label>
                        <textarea style="white-space: pre-line;" name="address" type="text" class="form-control form-control-sm" ></textarea>
                    </div>
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">Port Of Loading</label>
                        <input name="port_of_loading" type="text" class="form-control form-control-sm" >
                    </div>
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">Port Of Entry</label>
                        <input name="port_of_entry" type="text" class="form-control form-control-sm" >
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">Final Destination</label>
                        <input name="final_destination" type="text" class="form-control form-control-sm" >
                    </div>
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">Vessel/Voyage</label>
                        <input name="vessel_voyage" type="text" class="form-control form-control-sm" >
                    </div>
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">FCL/CFS</label>
                        <input name="fcl_cfs" type="text" class="form-control form-control-sm" >
                    </div>
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">ETD</label>
                        <input name="etd" type="date" class="form-control form-control-sm" >
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">ETA</label>
                        <input name="eta" type="date" class="form-control form-control-sm" >
                    </div>
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">Container No</label>
                        <input name="container_no" type="text" class="form-control form-control-sm" >
                    </div>
                    <div class="col-md-3">
                        <label for="formGroupExampleInput" class="form-label">Seal No</label>
                        <input name="seal_no" type="text" class="form-control form-control-sm" >
                    </div>
                </div>
                <br>
                    <button type="submit" name="add" value="Apply" class="btn btn-primary btn-sm">Simpan </button>
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
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>PACKING LIST</center></h6>
        </div>
        <div style="font-size : 10px;" class="card-body">
            <div class="table-responsive">
                <table class="display table table-bordered table-striped" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Factory Code</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Man Po</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Customer Po</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Po Reference</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Color</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Style No</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Width</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Size</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Qty</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Carton Number</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Total Carton</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">Ctn/Prs</th>
                            <th colspan="2" style="text-align: center;">NW/GW(kgs)</th>
                            <th rowspan="2" style="vertical-align: middle; text-align: center;">CBM</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">NW</th>
                            <th style="text-align: center;">GW</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $subtotalnw = $subtotalgw = $subtotalcbm = $subqty = $subcarton = 0;
                            if (isset($_POST['factory_code'])) {
                                $id_summary=$_POST['factory_code'];
                                $a=implode("','",$id_summary);
                                $subtotalnw = $subtotalgw = $subtotalcbm = $subqty = $subcarton = 0;
                                $shipMark = mysqli_query($conn, "SELECT * FROM tb_packing_list a
                                                                LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                                                                LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                                                                LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                                                                LEFT JOIN tb_master e ON d.sku = e.sku
                                                                WHERE d.factory_code IN ('".$a."') ORDER BY a.id_packing_list");
                                while ($data = mysqli_fetch_array($shipMark)) {
                                $totalnw = $data['no_ctn'] * $data['nw'];
                                $totalgw = $data['no_ctn'] * $data['gw'];
                                $totalcbm = $data['no_ctn'] * $data['cbm'];
                                $subtotalnw += $totalnw;
                                $subtotalgw += $totalgw;
                                $subtotalcbm += $totalcbm;
                                $subqty += $data['qty_prs'];
                                $subcarton += $data['no_ctn'];
                                ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $data['factory_code'];?></td>
                            <td style="text-align: center;"><?php echo $data['man_po'];?></td>
                            <td style="text-align: center;"><?php echo $data['cust_po'];?></td>
                            <td style="text-align: center;"><?php echo $data['po_referance'];?></td>
                            <td style="text-align: center;"><?php echo $data['color'];?></td>
                            <td style="text-align: center;"><?php 
                                                                if(substr($data['sku'],-3) == 'NEW'){
                                                                    echo substr($data['sku'],0,-4);
                                                                }elseif(substr($data['sku'],-4) == '(PE)') {
                                                                    echo substr($data['sku'],0,-5);
                                                                }else{
                                                                    echo $data['sku'];
                                                                } ?></td>
                            <td style="text-align: center;"><?php echo $data['widht'];?></td>
                            <td style="text-align: center;"><?php echo $data['size']+0;?></td>
                            <td style="text-align: center;"><?php echo $data['qty_prs'];?></td>
                            <td style="text-align: center;"><?php echo $data['ctn_no'];?></td>
                            <td style="text-align: center;"><?php echo $data['no_ctn'];?></td>
                            <td style="text-align: center;"><?php echo $data['packing_metode'];?></td>
                            <td style="text-align: center;"><?php echo $totalnw ?></td>
                            <td style="text-align: center;"><?php echo $totalgw ?></td>
                            <td style="text-align: center;"><?php echo $totalcbm ?></td>
                        </tr>
                    </tbody>
                    <?php
                        }
                    }
                    ?>
                    <tfoot>
                        <tr>
                            <th colspan="8" style="text-align: center;">Total</th>
                            <th style="text-align: center;"><?php echo $subqty ?></th>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;"><?php echo $subcarton ?></th>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;"><?php echo $subtotalnw ?></th>
                            <th style="text-align: center;"><?php echo $subtotalgw ?></th>
                            <th style="text-align: center;"><?php echo $subtotalcbm ?></th>
                        </tr>
                    </tfoot>
                </table>
                <a href="excel_packing_all.php?id_summary=<?php echo $a;?>" type="button" class="btn btn-success btn-sm">EXCEL</a>
                <a href="print_packing_all.php?id_summary=<?php echo $a;?>" type="button" target="_BLANK" class="btn btn-info btn-sm">CETAK</a>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
    include_once 'layout/footer.php';
?>