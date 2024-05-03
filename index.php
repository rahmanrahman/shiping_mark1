<?php
    include_once 'layout/header.php';
    require 'functions/function_home.php';
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

    <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Total PO 2024</div>
                            <div class="h5 mb-0 font-weight-bold text-primary">
                                <?php $all = getPo(); $no = 1; ?>
                                <?php foreach ($all as $data) {                     
                                    $nilaiPo = $data['nilai'];
                                } echo number_format($nilaiPo,0,",",".") ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Total Qty 2024</div>
                            <div class="h5 mb-0 font-weight-bold text-info">
                                <?php
                                $subnilai = 0;
                                $all = getQty(); $no = 1; ?>
                                <?php foreach ($all as $data) {
                                    $nilai = $data['nilai'];
                                    $subnilai += $nilai;                                    
                                    
                                } echo number_format($subnilai,0,",","."); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-3x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $all = getPoOld(); $no = 1; ?>
        <?php foreach ($all as $data) {                     
            $nilaiPoOld = $data['nilai'];
        } $changePo = ($nilaiPo - $nilaiPoOld) / $nilaiPoOld * 100;
        ?>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card <?php if($changePo >=0 ){echo 'border-left-success'; }else{echo 'border-left-danger';} ?> shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">CHANGE PO 2023 - 2024
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold <?php if($changePo >=0 ){echo 'text-success'; }else{echo 'text-danger';}?>">
                                        <?= number_format($changePo,2,",","."); ?>%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas <?php if($changePo >= 0 ){echo 'fa-arrow-circle-up'; }else{echo 'fa-arrow-circle-down';}?> fa-3x <?php if($changePo >=0 ){echo 'text-success'; }else{echo 'text-danger';}?>"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $subnilaiold = 0; 
        $all = getQtyOld(); $no = 1; ?>
        <?php foreach ($all as $data) {
        $nilaiold = $data['nilai'];
        $subnilaiold += $nilaiold;
        } $changeQty = ($subnilai - $subnilaiold) / $subnilaiold * 100; ?>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card <?php if($changeQty >=0 ){echo 'border-left-success'; }else{echo 'border-left-danger';}?> shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                            CHANGE QTY 2023 - 2024</div>
                            <div class="h5 mb-0 font-weight-bold <?php if($changeQty >=0 ){echo 'text-success'; }else{echo 'text-danger';}?> "><?= number_format($changeQty,2,",","."); ?>%</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas <?php if($changeQty >=0 ){echo 'fa-arrow-circle-up'; }else{echo 'fa-arrow-circle-down';}?> fa-3x <?php if($changeQty >=0 ){echo 'text-success'; }else{echo 'text-danger';}?>"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="card">
        <center><img src="img/business.jpg" class="card-img" alt="..."></center>
    </div>
</div>

<?php
    include_once 'layout/footer.php';
    if (isset($_SESSION['message']) == 'logfail') { 
	    echo "
	        <script>
	            $.toast({
                    heading: 'Login Berhasil!',
					text: 'Welcome',
					position: 'top-right',
					hideAfter: 3500,
					textAlign: 'center',
					icon: 'success'
                });
	        </script>
	    ";
	}
	unset($_SESSION['message']);
?>