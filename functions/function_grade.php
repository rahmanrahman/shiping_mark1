<?php

	require_once 'koneksi.php';
	include_once 'helper.php';

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
	function getSize() {
		$id_grade = $_GET['id_grade'];
		global $conn;
		$sql 	= "SELECT e.size, e.id_detail FROM tb_grade AS a LEFT JOIN tb_summery AS b ON b.id_summary = a.id_summary LEFT JOIN tb_add_packing AS c ON c.id_summary = b.id_summary LEFT JOIN tb_packing_list AS d ON d.id_add_packing = c.id_add_packing LEFT JOIN tb_detail_master AS e ON e.id_detail = d.id_detail WHERE a.id_grade = $id_grade GROUP BY e.size ORDER BY e.size;";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}
	function showSize() {
		$id_grade = $_GET['id_grade'];
		global $conn;
		$sql 	= "SELECT a.kiri, a.kanan, b.size FROM tb_detail_grade AS a
		LEFT JOIN tb_detail_master AS b ON b.id_detail = a.id_detail
		WHERE a.id_grade=$id_grade ORDER BY b.size;";
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

	function addData($id_summary,$category,$date) {
		global $conn;
		$cek = mysqli_query($conn, "SELECT * FROM tb_grade WHERE id_summary='$id_summary'");
		if(mysqli_num_rows($cek) !== 0 ){
			return false;
		}else{
			$sql 	= "INSERT INTO tb_grade (id_summary, category, date) VALUES ('$id_summary','$category','$date')";
			$result	= mysqli_query($conn, $sql);
			return ($result) ? true : false;
		}
		
		mysqli_close($conn);
	}

	function addData1($id_detail,$kanan,$kiri,$id_grade) {
		global $conn;
		$cek = mysqli_query($conn, "SELECT * FROM tb_detail_grade WHERE id_grade='$id_grade' AND id_detail='$id_detail'");
		if(mysqli_num_rows($cek) !== 0 ){
			return false;
		}else{
			$sql 	= "INSERT INTO tb_detail_grade (id_detail, kanan, kiri, id_grade) VALUES ('$id_detail','$kanan','$kiri','$id_grade')";
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
		$category	    = mysqli_real_escape_string($conn, $_POST['category']);
		$date	   	    = mysqli_real_escape_string($conn, $_POST['date']);
		$add 		    = addData($id_summary,$category,$date);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {			
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $duplicated;
		}
		header("location:../menugrade.php");

	}elseif (isset($_POST['add1'])) {
			$id_detail	    = mysqli_real_escape_string($conn, $_POST['id_detail']);
			$kanan	        = mysqli_real_escape_string($conn, $_POST['kanan']);
			$kiri	   	    = mysqli_real_escape_string($conn, $_POST['kiri']);
			$id_grade	   	= mysqli_real_escape_string($conn, $_POST['id_grade']);
			$add 		    = addData1($id_detail,$kanan,$kiri,$id_grade);
			session_start();
			unset ($_SESSION["message"]);
			if ($add) {			
				$_SESSION['message'] = $added;
			}else {
				$_SESSION['message'] = $duplicated;
			}
			header("location:../data_detail_grade.php?id_grade=$id_grade");

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
		header("location:../menugrade.php");
	}

?>