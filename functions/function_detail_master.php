<?php

	require_once 'koneksi.php';
	include_once 'helper.php';

	function getData() {
		$sku=$_GET['sku'];
		global $conn;
		$sql 	= "SELECT * FROM tb_detail_master a
                    LEFT JOIN tb_master b ON b.sku = a.sku
					WHERE a.sku='$sku'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function addData($carton_code, $packing_metode, $meas, $meas_carton, $size, $nw, $gw, $cbm, $material_code1, $material_code2, $nw1, $gw1, $sku) {
		global $conn;
		$sql 	= "INSERT INTO tb_detail_master (carton_code, packing_metode, meas, meas_carton,size, nw, gw, cbm, material_code1, material_code2, nw1, gw1, sku) 
                    VALUES ('$carton_code', '$packing_metode', '$meas','$meas_carton','$size', '$nw', '$gw','$cbm', '$material_code1', '$material_code2', '$nw1', '$gw1', '$sku')";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function showData($id_detail) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_detail);
		$sql 	= "SELECT * FROM tb_detail_master WHERE id_detail='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_close($conn);
	}

    function editData($id_detail, $carton_code, $packing_metode, $meas, $meas_carton, $size, $nw, $gw, $cbm, $material_code1, $material_code2, $nw1, $gw1, $sku) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_detail);
		$sql 	= "UPDATE tb_detail_master SET carton_code='$carton_code', packing_metode='$packing_metode', meas='$meas', meas_carton='$meas_carton', size='$size', nw='$nw', gw='$gw', cbm='$cbm', material_code1='$material_code1', material_code2='$material_code2', nw1='$nw1', gw1='$gw1', sku='$sku'
                    WHERE id_detail='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function deleteData($id_detail) {
		global $conn;
		$sql 	= "DELETE FROM tb_detail_master WHERE id_detail='$id_detail'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function deleteData1($sku) {
		global $conn;
		$sql 	= "DELETE FROM tb_detail_master WHERE sku='$sku'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	if (isset($_POST['add'])) {
		$carton_code	    = mysqli_real_escape_string($conn, $_POST['carton_code']);
        $packing_metode	    = mysqli_real_escape_string($conn, $_POST['packing_metode']);
        $meas	            = mysqli_real_escape_string($conn, $_POST['meas']);
		$meas_carton        = mysqli_real_escape_string($conn, $_POST['meas_carton']);
        $size	            = mysqli_real_escape_string($conn, $_POST['size']);
        $nw	                = mysqli_real_escape_string($conn, $_POST['nw']);
        $gw	                = mysqli_real_escape_string($conn, $_POST['gw']);
		$cbm	            = mysqli_real_escape_string($conn, $_POST['cbm']);
		$material_code1	    = mysqli_real_escape_string($conn, $_POST['material_code1']);
        $material_code2	    = mysqli_real_escape_string($conn, $_POST['material_code2']);
        $nw1	            = $nw / $packing_metode ;
		$gw1	            = $gw / $packing_metode ;
        $sku		        = mysqli_real_escape_string($conn, $_POST['sku']);
		$add 		        = addData($carton_code, $packing_metode, $meas, $meas_carton, $size, $nw, $gw, $cbm, $material_code1, $material_code2, $nw1, $gw1, $sku);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {			
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../detail_master.php?sku=".$sku);
	}elseif (isset($_POST['edit'])) {
		$id_detail	        = mysqli_real_escape_string($conn, $_POST['id_detail']);
		$carton_code	    = mysqli_real_escape_string($conn, $_POST['carton_code']);
        $packing_metode	    = mysqli_real_escape_string($conn, $_POST['packing_metode']);
        $meas	            = mysqli_real_escape_string($conn, $_POST['meas']);
		$meas_carton        = mysqli_real_escape_string($conn, $_POST['meas_carton']);
        $size	            = mysqli_real_escape_string($conn, $_POST['size']);
        $nw	                = mysqli_real_escape_string($conn, $_POST['nw']);
        $gw	                = mysqli_real_escape_string($conn, $_POST['gw']);
		$cbm	            = mysqli_real_escape_string($conn, $_POST['cbm']);
		$material_code1	    = mysqli_real_escape_string($conn, $_POST['material_code1']);
        $material_code2	    = mysqli_real_escape_string($conn, $_POST['material_code2']);
        $nw1	            = $nw / $packing_metode ;
		$gw1	            = $gw / $packing_metode ;
        $sku	       		= mysqli_real_escape_string($conn, $_POST['sku']);
		$edit 		        = editData($id_detail, $carton_code, $packing_metode, $meas, $meas_carton, $size, $nw, $gw, $cbm, $material_code1, $material_code2, $nw1, $gw1, $sku);
		session_start();
		unset ($_SESSION["message"]);
		if ($edit) {			
			$_SESSION['message'] = $edited;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../detail_master.php?sku=".$sku);
    }elseif (isset($_GET['hapus'])){
		$sku=$_GET['sku'];
		$id_detail	= mysqli_real_escape_string($conn, $_GET['hapus']);
		$delete = deleteData($id_detail);
		session_start();
		unset ($_SESSION["message"]);
		if ($delete) {			
			$_SESSION['message'] = $deleted;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../detail_master.php?sku=".$sku);
	}

	if (isset($_GET['delete'])) {
		$sku	= mysqli_real_escape_string($conn, $_GET['delete']);
		$delete = deleteData1($sku);
		session_start();
		unset ($_SESSION["message"]);
		if ($delete) {			
			$_SESSION['message'] = $deleted;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../detail_master.php?sku=".$sku);
	}

?>