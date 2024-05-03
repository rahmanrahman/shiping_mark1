<?php
    require_once 'functions/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>

</head>
<body style="font-family: calibri, Helvetica, sans-serif;">
<br>
    <div style="font-size : 48px; font-weight:bolder; line-height: 66px;" >
        <?php
            if($_GET['carton'] == 'NBL4'){
                echo "MEAS: 22.2INX19.3INX12.8IN=3.17 CUFT";?><br><?php
                echo "MEAS: 0.563MX0.490MX0.325M=0.090 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBL5'){
                echo "MEAS: 22.0INX20.5INX13.4IN= 3.50 CUFT";?><br><?php
                echo "MEAS: 0.560MX0.520MX0.340M=0.099 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBL6'){
                echo "MEAS: 24.2INX19.5INX13.4IN= 3.66 CUFT";?><br><?php
                echo "MEAS: 0.614MX0.496MX0.340M=0.104 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBL6.5'){
                echo "MEAS: 25.4INX21.1INX13.6IN= 4.21 CUFT";?><br><?php
                echo "MEAS: 0.644MX0.536MX0.345M=0.119 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBL7'){
                echo "MEAS: 27.2INX21.3INX14.2IN= 4.74 CUFT";?><br><?php
                echo "MEAS: 0.690MX0.540MX0.360M= 0.134 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBL8'){
                echo "MEAS: 29.3INX22.0INX15.4IN= 5.75 CUFT";?><br><?php
                echo "MEAS: 0.745MX0.560MX0.390M= 0.163 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBL8.5'){
                echo "MEAS: 34.1INX22.2INX16.1IN= 7.05 CUFT";?><br><?php
                echo "MEAS: 0.865MX0.563MX0.410M= 0.200 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'DENMARK'){
                echo "MEAS: 56.6CMX48.0CMX32.0CM";?><br><?php
                echo "CBM: 0.563MX0.490MX0.325M=0.090 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'DENMARK2'){
                echo "MEAS: 62.0CMX47.7CMX32.5CM";?><br><?php
                echo "CBM:  0.614MX0.496MX0.340M=0.104 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'DENMARK3'){
                echo "MEAS: 64.0CMX52.4CMX34.5CM";?><br><?php
                echo "CBM:  0.644MX0.536MX0.345M=0.119 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'DENMARK4'){
                echo "MEAS: 69.0CMX53.0CMX36.0CM";?><br><?php
                echo "CBM:  0.690MX0.540MX0.360M=0.134 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'DENMARK5'){
                echo "MEAS: 56.0CMX50.5CMX34.0CM";?><br><?php
                echo "CBM: 0.563MX0.490MX0.325M=0.090 CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLDW4-MZ'){
                echo "MEAS: 23.0IN*19.7IN*12.8IN=3.36 CUFT";?><br><?php
                echo "MEAS: 585*500*325MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLDW6-MZ'){
                echo "MEAS: 24.8IN*19.5IN*13.4IN=3.74 CUFT";?><br><?php
                echo "MEAS: 630*495*340MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLDW6.5-MZ'){
                echo "MEAS: 26.0IN*21.5IN*13.8IN=4.45 CUFT";?><br><?php
                echo "MEAS: 660*545*350MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLDW7-MZ'){
                echo "MEAS: 28.7IN*21.9IN*14.4IN=5.24 CUFT";?><br><?php
                echo "MEAS: 730*555*365MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLDW8-MZ'){
                echo "MEAS: 29.9IN*22.4IN*15.7IN=6.09 CUFT";?><br><?php
                echo "MEAS: 760*570*400MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }elseif($_GET['carton'] == 'NBLDW8.5-MZ'){
                echo "MEAS: 34.3IN*23.2IN*16.1IN=7.41 CUFT";?><br><?php
                echo "MEAS: 870*590*410MM CUMTRS";?><br><?php
                echo "MADE IN INDONESIA";
            }
        ?>
    </div>
</body>
    <script>
        window.print();
    </script>
</html>