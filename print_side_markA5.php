<?php
    require_once 'functions/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>

</head>
<body style="font-family: calibri, Helvetica, sans-serif;">
<br>
    <div style="font-size : 34px; font-weight:bolder; line-height: 50px;" >
        <?php
            if($_GET['carton'] == 'NBLA1'){
                echo "MEAS: 11.8INX10.0INX8.1IN= 0.55 CUFT";?><br><?php
                echo "MEAS: 0.300MX0.255MX0.205M=0.016 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLA1.5'){
                echo "MEAS: 13.6INX11.2INX9.1IN= 0.80 CUFT";?><br><?php
                echo "MEAS: 0.345MX0.285MX0.230M=0.023 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLA2'){
                echo "MEAS: 14.8INX12.4INX10.2IN= 1.08 CUFT";?><br><?php
                echo "MEAS: 0.375MX0.315MX0.260M=0.031 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLA3'){
                echo "MEAS: 15.4INX12.8INX11.3IN= 1.28 CUFT";?><br><?php
                echo "MEAS: 0.390MX0.325MX0.287M=0.036 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLA4'){
                echo "MEAS: 14.8INX14.6INX12.8IN= 1.59 CUFT";?><br><?php
                echo "MEAS: 0.375MX0.370MX0.325M=0.045 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLA5'){
                echo "MEAS: 15.4INX15.2INX13.4IN= 1.80 CUFT";?><br><?php
                echo "MEAS: 0.390MX0.385MX0.340M=0.051 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLA6'){
                echo "MEAS: 16.0INX14.8INX13.4IN= 1.84 CUFT";?><br><?php
                echo "MEAS: 0.407MX0.376MX0.340M=0.052 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLA6.5'){
                echo "MEAS: 16.8INX15.9INX13.6IN= 2.11 CUFT";?><br><?php
                echo "MEAS: 0.427MX0.405MX0.345M=0.060 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLA7'){
                echo "MEAS: 18.8INX16.4INX14.4IN= 2.56 CUFT";?><br><?php
                echo "MEAS: 0.477MX0.417MX0.365M=0.073 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLA8'){
                echo "MEAS: 19.5INX16.7INX15.4IN= 2.90 CUFT";?><br><?php
                echo "MEAS: 0.495MX0.425MX0.390M=0.082 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLA8.5'){
                echo "MEAS: 22.3INX17.3INX15.9IN= 3.57 CUFT";?><br><?php
                echo "MEAS: 0.567MX0.440MX0.405M=0.101 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBL1'){
                echo "MEAS: 17.5INX13.0INX7.9IN=1.04 CUFT";?><br><?php
                echo "MEAS: 0.445MX0.330MX0.200M=0.029 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBL1.5'){
                echo "MEAS: 20.1INX15.0INX9.1IN=1.57 CUFT";?><br><?php
                echo "MEAS: 0.510MX0.380MX0.230M=0.045CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBL2'){
                echo "MEAS: 22.0INX16.5INX10.2IN=2.16 CUFT";?><br><?php
                echo "MEAS: 0.560MX0.420MX0.260M=0.061 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBL3'){
                echo "MEAS: 23.0INX16.9INX11.3IN=2.54 CUFT";?><br><?php
                echo "MEAS: 0.583MX0.430MX0.287M=0.072 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLADW7-MX'){
                echo "MEAS: 19.3IN*16.5IN*14.4IN=2.65 CUFT";?><br><?php
                echo "MEAS: 490*420*365MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLADW8-MX'){
                echo "MEAS: 20.1IN*16.9IN*15.7IN=3.09 CUFT";?><br><?php
                echo "MEAS: 510*430*400MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLADW8.5-MX'){
                echo "MEAS: 22.8IN*17.5IN*16.1IN=3.72 CUFT";?><br><?php
                echo "MEAS: 580*445*410MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLADW6.5-MX'){
                echo "MEAS: 17.3IN*15.7IN*13.8IN=2.18 CUFT";?><br><?php
                echo "MEAS: 440*400*350MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLADW6-MX'){
                echo "MEAS: 16.5IN*15.4IN*13.4IN=1.97 CUFT";?><br><?php
                echo "MEAS: 420*390*340MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLADW4-MX'){
                echo "MEAS: 15.7IN*15.2IN*12.8IN=1.77 CUFT";?><br><?php
                echo "MEAS: 400*385*325MM";?><br><?php
                echo "MADE IN INDONESIA";
            }
        ?>
    </div>
</body>
    <script>
        window.print();
    </script>
</html>