<?php
    include_once 'layout/header.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
                $nama = ['Selected','NBLA1','NBLA1.5','NBLA2','NBLA3','NBLA4','NBLA5','NBLA6','NBLA6.5','NBLA7','NBLA8','NBLA8.5','NBL1','NBL1.5','NBL2','NBL3','NBL4','NBL5','NBL6','NBL6.5','NBL7','NBL8','NBL8.5','DENMARK','DENMARK2','DENMARK3','DENMARK4','DENMARK5','NBLDW4-MZ','NBLADW4-MX','NBLDW6-MZ','NBLADW6-MX','NBLDW6.5-MZ','NBLADW6.5-MX','NBLDW7-MZ','NBLDW8-MZ','NBLDW8.5-MZ','NBLADW7-MX','NBLADW8-MX','NBLADW8.5-MX'];
            ?>
            <form action="" method="POST">
                <div>
                    <div class="input-group input-group-sm mb-3">
                        <select name="carton" id="carton" class="form-control form-control-sm selectpicker" data-show-subtext="true" data-live-search="true" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" onchange="this.form.submit()">
					            <?php foreach($nama as $data){ ?>
                                    <option value="<?= $data ?>"
                                    <?php
                                    if(isset($_POST['carton'])){
                                        if($_POST['carton'] == $data ){
                                            echo "selected";
                                        }
                                    } ?>
                                    ><?= $data ?></option>
                                <?php } ?>
                        </select>&emsp;
                        &nbsp;<a href="meas_side_mark.php" class="btn btn-success btn-sm"><i class="fas fa fa-retweet"></i></a>
                    </div>
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
            <h6 style="font-size : 18px;" class="m-0 font-weight-bold text-dark"><center>MEAS SIDE MARK INTERNATIONAL</center></h6>
        </div>
        <div class="card-body" style="font-size : 28px; font-weight:800;" >
            <?php
                if(isset($_POST['carton'])) {
                    if($_POST['carton'] == 'NBLA1'){
                        echo "MEAS: 11.8INX10.0INX8.1IN= 0.55 CUFT";?><br><?php
                        echo "MEAS: 0.300MX0.255MX0.205M=0.016 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLA1.5'){
                        echo "MEAS: 13.6INX11.2INX9.1IN= 0.80 CUFT";?><br><?php
                        echo "MEAS: 0.345MX0.285MX0.230M=0.023 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLA2'){
                        echo "MEAS: 14.8INX12.4INX10.2IN= 1.08 CUFT";?><br><?php
                        echo "MEAS: 0.375MX0.315MX0.260M=0.031 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLA3'){
                        echo "MEAS: 15.4INX12.8INX11.3IN= 1.28 CUFT";?><br><?php
                        echo "MEAS: 0.390MX0.325MX0.287M=0.036 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLA4'){
                        echo "MEAS: 14.8INX14.6INX12.8IN= 1.59 CUFT";?><br><?php
                        echo "MEAS: 0.375MX0.370MX0.325M=0.045 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLA5'){
                        echo "MEAS: 15.4INX15.2INX13.4IN= 1.80 CUFT";?><br><?php
                        echo "MEAS: 0.390MX0.385MX0.340M=0.051 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLA6'){
                        echo "MEAS: 16.0INX14.8INX13.4IN= 1.84 CUFT";?><br><?php
                        echo "MEAS: 0.407MX0.376MX0.340M=0.052 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLA6.5'){
                        echo "MEAS: 16.8INX15.9INX13.6IN= 2.11 CUFT";?><br><?php
                        echo "MEAS: 0.427MX0.405MX0.345M=0.060 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLA7'){
                        echo "MEAS: 18.8INX16.4INX14.4IN= 2.56 CUFT";?><br><?php
                        echo "MEAS: 0.477MX0.417MX0.365M=0.073 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLA8'){
                        echo "MEAS: 19.5INX16.7INX15.4IN= 2.90 CUFT";?><br><?php
                        echo "MEAS: 0.495MX0.425MX0.390M=0.082 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLA8.5'){
                        echo "MEAS: 22.3INX17.3INX15.9IN= 3.57 CUFT";?><br><?php
                        echo "MEAS: 0.567MX0.440MX0.405M=0.101 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL1'){
                        echo "MEAS: 17.5INX13.0INX7.9IN=1.04 CUFT";?><br><?php
                        echo "MEAS: 0.445MX0.330MX0.200M=0.029 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL1.5'){
                        echo "MEAS: 20.1INX15.0INX9.1IN=1.57 CUFT";?><br><?php
                        echo "MEAS: 0.510MX0.380MX0.230M=0.045CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL2'){
                        echo "MEAS: 22.0INX16.5INX10.2IN=2.16 CUFT";?><br><?php
                        echo "MEAS: 0.560MX0.420MX0.260M=0.061 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL3'){
                        echo "MEAS: 23.0INX16.9INX11.3IN=2.54 CUFT";?><br><?php
                        echo "MEAS: 0.583MX0.430MX0.287M=0.072 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL4'){
                        echo "MEAS: 22.2INX19.3INX12.8IN=3.17 CUFT";?><br><?php
                        echo "MEAS: 0.563MX0.490MX0.325M=0.090 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL5'){
                        echo "MEAS: 22.0INX20.5INX13.4IN= 3.50 CUFT";?><br><?php
                        echo "MEAS: 0.560MX0.520MX0.340M=0.099 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL6'){
                        echo "MEAS: 24.2INX19.5INX13.4IN= 3.66 CUFT";?><br><?php
                        echo "MEAS: 0.614MX0.496MX0.340M=0.104 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL6.5'){
                        echo "MEAS: 25.4INX21.1INX13.6IN= 4.21 CUFT";?><br><?php
                        echo "MEAS: 0.644MX0.536MX0.345M=0.119 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL7'){
                        echo "MEAS: 27.2INX21.3INX14.2IN= 4.74 CUFT";?><br><?php
                        echo "MEAS: 0.690MX0.540MX0.360M= 0.134 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL8'){
                        echo "MEAS: 29.3INX22.0INX15.4IN= 5.75 CUFT";?><br><?php
                        echo "MEAS: 0.745MX0.560MX0.390M= 0.163 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBL8.5'){
                        echo "MEAS: 34.1INX22.2INX16.1IN= 7.05 CUFT";?><br><?php
                        echo "MEAS: 0.865MX0.563MX0.410M= 0.200 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'DENMARK'){
                        echo "MEAS: 56.6CMX48.0CMX32.0CM";?><br><?php
                        echo "CBM: 0.563MX0.490MX0.325M=0.090 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'DENMARK2'){
                        echo "MEAS: 62.0CMX47.7CMX32.5CM";?><br><?php
                        echo "CBM:  0.614MX0.496MX0.340M=0.104 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'DENMARK3'){
                        echo "MEAS: 64.0CMX52.4CMX34.5CM";?><br><?php
                        echo "CBM:  0.644MX0.536MX0.345M=0.119 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'DENMARK4'){
                        echo "MEAS: 69.0CMX53.0CMX36.0CM";?><br><?php
                        echo "CBM:  0.690MX0.540MX0.360M=0.134 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'DENMARK5'){
                        echo "MEAS: 56.0CMX50.5CMX34.0CM";?><br><?php
                        echo "CBM: 0.563MX0.490MX0.325M=0.090 CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLDW4-MZ'){
                        echo "MEAS: 23.0IN*19.7IN*12.8IN=3.36 CUFT";?><br><?php
                        echo "MEAS: 585*500*325MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLADW4-MX'){
                        echo "MEAS: 15.7IN*15.2IN*12.8IN=1.77 CUFT";?><br><?php
                        echo "MEAS: 400*385*325MM";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLDW6-MZ'){
                        echo "MEAS: 24.8IN*19.5IN*13.4IN=3.74 CUFT";?><br><?php
                        echo "MEAS: 630*495*340MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLADW6-MX'){
                        echo "MEAS: 16.5IN*15.4IN*13.4IN=1.97 CUFT";?><br><?php
                        echo "MEAS: 420*390*340MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLDW6.5-MZ'){
                        echo "MEAS: 26.0IN*21.5IN*13.8IN=4.45 CUFT";?><br><?php
                        echo "MEAS: 660*545*350MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLADW6.5-MX'){
                        echo "MEAS: 17.3IN*15.7IN*13.8IN=2.18 CUFT";?><br><?php
                        echo "MEAS: 440*400*350MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLDW7-MZ'){
                        echo "MEAS: 28.7IN*21.9IN*14.4IN=5.24 CUFT";?><br><?php
                        echo "MEAS: 730*555*365MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLDW8-MZ'){
                        echo "MEAS: 29.9IN*22.4IN*15.7IN=6.09 CUFT";?><br><?php
                        echo "MEAS: 760*570*400MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLDW8.5-MZ'){
                        echo "MEAS: 34.3IN*23.2IN*16.1IN=7.41 CUFT";?><br><?php
                        echo "MEAS: 870*590*410MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLADW7-MX'){
                        echo "MEAS: 19.3IN*16.5IN*14.4IN=2.65 CUFT";?><br><?php
                        echo "MEAS: 490*420*365MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLADW8-MX'){
                        echo "MEAS: 20.1IN*16.9IN*15.7IN=3.09 CUFT";?><br><?php
                        echo "MEAS: 510*430*400MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }elseif($_POST['carton'] == 'NBLADW8.5-MX'){
                        echo "MEAS: 22.8IN*17.5IN*16.1IN=3.72 CUFT";?><br><?php
                        echo "MEAS: 580*445*410MM CUMTRS";?><br><?php
                        echo "MADE IN INDONESIA";
                    }
                }
            ?>
            <br>
            <?php
                if(isset($_POST['carton'])){
                    if($_POST['carton'] == 'Selected'){

                    }elseif($_POST['carton'] == "NBLA1" || $_POST['carton'] == "NBLA1.5" || $_POST['carton'] == "NBLA2" || $_POST['carton'] == "NBLA3" || $_POST['carton'] == "NBLA4" || $_POST['carton'] == "NBLA5" || $_POST['carton'] == "NBLA6" || $_POST['carton'] == "NBLA6.5" || $_POST['carton'] == "NBLA7" || $_POST['carton'] == "NBLA8" || $_POST['carton'] == "NBLA8.5" || $_POST['carton'] == "NBL1" || $_POST['carton'] == "NBL1.5" || $_POST['carton'] == "NBL2" || $_POST['carton'] == "NBL3" || $_POST['carton'] == "NBLADW4-MX" || $_POST['carton'] == "NBLADW6.5-MX" || $_POST['carton'] == "NBLADW7-MX" || $_POST['carton'] == "NBLADW8-MX" || $_POST['carton'] == "NBLADW8.5-MX"){
                        $carton = $_POST['carton']; ?>
                        <a href="print_side_markA5.php?carton=<?= $carton ?>" type="button" target="_BLANK" class="btn btn-info btn-sm">PRINT A5 <i class="fas fa-fw fa-print"></i></a>
                    <?php }else{
                        $carton = $_POST['carton']; ?>
                        <a href="print_side_markA4.php?carton=<?= $carton ?>" type="button" target="_BLANK" class="btn btn-info btn-sm">PRINT A4 <i class="fas fa-fw fa-print"></i></a>
                <?php } }?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php
                $nama = ['Selected','','NBLA1.5','NBLA2','NBLA3','NBLA4','NBLA5','NBLA6','NBLA6.5','NBLA7','NBLA8','NBLA8.5','NBL1','NBL1.5','NBL2','NBL3','NBL4','NBL5','NBL6','NBL6.5','NBL7','NBL8','NBL8.5','DENMARK','DENMARK2','DENMARK3','DENMARK4','DENMARK5','NBLAXRONE7-MX','NBLAXRONE8-MX','NBLAXRONE8.5-MX','NBLXRONE7-MZ','NBLXRONE7-MZ2','NBLXRONE8-MZ','NBLXRONE8.5-MZ'];
            ?>
<?php
    include_once 'layout/footer.php';
?>