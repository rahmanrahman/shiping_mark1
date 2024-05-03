<?php

	require_once 'koneksi.php';
	include_once 'helper.php';

	function getData() {
		$id_add_packing=$_GET['id_add_packing'];
		global $conn;
		$sql 	= "SELECT * FROM tb_packing_prepack a 
					LEFT JOIN tb_add_packing b ON b.id_add_packing = a.id_add_packing 
					LEFT JOIN tb_detail_master c ON a.id_detail = c.id_detail 
					WHERE a.id_add_packing='$id_add_packing'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getSize() {
		$id_summary=$_GET['id_summary'];
		global $conn;
		$sql 	= "SELECT size FROM tb_detail_master a LEFT JOIN tb_packing_prepackWHERE id_detail IN (SELECT id_detail FROM `tb_packing_prepack` WHERE id_add_packing='$id_add_packing') GROUP BY size ORDER BY id_detail";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getSize1() {
		global $conn;
		$sql 	= "SELECT size FROM tb_detail_master WHERE id_detail IN (SELECT id_detail FROM tb_packing_prepack a JOIN tb_add_packing b ON a.id_add_packing = b.id_add_packing') GROUP BY size ORDER BY size ASC";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function deleteData($id_packing_prepack) {
		global $conn;
		$sql 	= "DELETE FROM tb_packing_prepack WHERE id_packing_list='$id_packing_prepack'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	if (isset($_GET['hapus'])) {
		$id		= mysqli_real_escape_string($conn, $_GET['hapus']);
		$delete = deleteData($id);
		session_start();
		unset ($_SESSION["message"]);
		if ($delete) {			
			$_SESSION['message'] = $deleted;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../data_master.php");
	}

	function prs() {
		$id_add_packing=$_GET['id_add_packing'];
        global $conn;
        $sql    = "SELECT SUM(no_ctn1) AS total_ctn FROM tb_packing_prepack
					WHERE id_add_packing='$id_add_packing'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result);
        mysqli_free_result($result);
        mysqli_close($conn);
    }

	function qty() {
		$id_add_packing=$_GET['id_add_packing'];
        global $conn;
        $sql    = "SELECT SUM(prs_ctn1) AS total_qty FROM tb_packing_prepack
					WHERE id_add_packing='$id_add_packing'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result);
        mysqli_free_result($result);
        mysqli_close($conn);
    }

	function totalcarton() {
		$id_add_packing=$_GET['id_add_packing'];
        global $conn;
        $sql    = "SELECT SUM(qty_prs1) AS total_prs FROM tb_packing_prepack
					WHERE id_add_packing='$id_add_packing'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result);
        mysqli_free_result($result);
        mysqli_close($conn);
    }

?>