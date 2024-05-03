<?php

	require_once 'koneksi.php';
	include_once 'helper.php';

	function getData() {
		global $conn;
		$sql 	= "SELECT * FROM tb_master";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getAll() {
		global $conn;
		$sql 	= "SELECT * FROM tb_detail_master a
                    LEFT JOIN tb_master b ON b.sku = a.sku";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function addData($sku) {
		global $conn;
		$cek = mysqli_query($conn, "SELECT * FROM tb_master WHERE sku='$sku'");
		if(mysqli_num_rows($cek) !== 0 ){
			return false;
		}else{
			$sql 	= "INSERT INTO tb_master (sku) VALUES ('$sku')";
			$result	= mysqli_query($conn, $sql);
			return ($result) ? true : false;
		}
		mysqli_close($conn);
	}

	function showData($sku) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $sku);
		$sql 	= "SELECT * FROM tb_master WHERE id_master='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_close($conn);
	}

	function deleteData($sku) {
		global $conn;
		$sql 	= "DELETE FROM tb_master WHERE sku='$sku'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	if (isset($_POST['add'])) {
		$sku	    = mysqli_real_escape_string($conn, $_POST['sku']);
		$add 		= addData($sku);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {	
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $duplicated;
		}
		header("location:../data_master.php");
	}elseif (isset($_GET['hapus'])) {
		$sku		= mysqli_real_escape_string($conn, $_GET['hapus']);
		$delete = deleteData($sku);
		session_start();
		unset ($_SESSION["message"]);
		if ($delete) {			
			$_SESSION['message'] = $deleted;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../data_master.php");
	}

?>