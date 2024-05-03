<?php

	require_once 'koneksi.php';
	include_once 'helper.php';

	function getData1() {
		global $conn;
		$sql 	= " SELECT * FROM tb_add_packing a
					LEFT JOIN tb_summery b ON a.id_summary = b.id_summary
					LEFT JOIN tb_master c ON b.sku = c.sku
					LEFT JOIN tb_packing_list d ON a.id_add_packing = d.id_add_packing
					GROUP BY factory_code ORDER BY a.id_add_packing";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getData() {
		global $conn;
		$sql 	= " SELECT * FROM tb_add_packing a
					LEFT JOIN tb_summery b ON a.id_summary = b.id_summary
					LEFT JOIN tb_master c ON b.sku = c.sku
					GROUP BY factory_code ORDER BY a.id_add_packing";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getList() {
		global $conn;
		$sql 	= "SELECT factory_code FROM tb_summery";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getSummary() {
		global $conn;
		$sql 	= "SELECT * FROM tb_summery ORDER BY prod_month ASC";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function addData($id_summary) {
		global $conn;
		$cek = mysqli_query($conn, "SELECT * FROM tb_add_packing WHERE id_summary='$id_summary'");
		if(mysqli_num_rows($cek) !== 0 ){
			return false;
		}else{
			$sql 	= "INSERT INTO tb_add_packing (id_summary) VALUES ('$id_summary')";
			$result	= mysqli_query($conn, $sql);
			return ($result) ? true : false;
		}
		
		mysqli_close($conn);
	}

	function showData($id_add_packing) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_add_packing);
		$sql 	= "SELECT * FROM tb_add_packing WHERE id_add_packing='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_close($conn);
	}

    function deleteData($id_add_packing) {
		global $conn;
		$sql 	= "DELETE FROM tb_add_packing WHERE id_add_packing='$id_add_packing'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	if (isset($_POST['add'])) {
		$id_summary	    = mysqli_real_escape_string($conn, $_POST['id_summary']);
		$add 		    = addData($id_summary);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {			
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $duplicated;
		}
		header("location:../data_packing.php");
	}elseif (isset($_GET['hapus'])) {
		$id_add_packing		= mysqli_real_escape_string($conn, $_GET['hapus']);
		$delete = deleteData($id_add_packing);
		session_start();
		unset ($_SESSION["message"]);
		if ($delete) {			
			$_SESSION['message'] = $deleted;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../data_packing.php");
	}

?>