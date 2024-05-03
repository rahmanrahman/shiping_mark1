<?php

	require_once 'koneksi.php';
	include_once 'helper.php';

	function getData() {
		global $conn;
		$sql 	= "SELECT tb_alamat.*, tb_summery.*
					FROM tb_alamat
					JOIN tb_summery ON tb_alamat.id_summary = tb_summery.id_summary";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function addData($ship_to, $address, $port_of_loading, $port_of_entry, $final_destination, $vessel_voyage, $fcl_cfs, $etd, $eta, $container_no, $seal_no, $hs_code, $id_summary) {
		global $conn;
		$sql 	= "INSERT INTO tb_alamat (ship_to, address, port_of_loading, port_of_entry, final_destination, vessel_voyage, fcl_cfs, etd, eta, container_no, seal_no, hs_code, id_summary) 
                    VALUES ('$ship_to','$address','$port_of_loading','$port_of_entry','$final_destination','$vessel_voyage','$fcl_cfs','$etd','$eta','$container_no','$seal_no','$hs_code','$id_summary')";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function showData($id_summary) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_summary);
		$sql 	= "SELECT tb_alamat.*, tb_summery.* FROM tb_alamat JOIN tb_summery ON tb_alamat.id_summary = tb_summery.id_summary
					WHERE id_summary='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_close($conn);
	}

	function showAlamat($id_alamat) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_alamat);
		$sql 	= "SELECT tb_alamat.*, tb_summery.* FROM tb_alamat JOIN tb_summery ON tb_alamat.id_summary = tb_summery.id_summary
					WHERE id_alamat='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_close($conn);
	}

    function editData($id_alamat, $ship_to, $address, $port_of_loading, $port_of_entry, $final_destination, $vessel_voyage, $fcl_cfs, $etd, $eta, $container_no, $seal_no, $hs_code, $id_summary) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_alamat);
		$sql 	= "UPDATE tb_alamat SET ship_to='$ship_to', address='$address', port_of_loading='$port_of_loading', port_of_entry='$port_of_entry', final_destination='$final_destination', vessel_voyage='$vessel_voyage', fcl_cfs='$fcl_cfs', etd='$etd', eta='$eta', container_no='$container_no', seal_no='$seal_no', hs_code='$hs_code', id_summary='$id_summary'
                    WHERE id_alamat='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function deleteData($id_alamat) {
		global $conn;
		$sql 	= "DELETE FROM tb_alamat WHERE id_alamat='$id_alamat'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	if (isset($_POST['add'])) {
		$ship_to	        = mysqli_real_escape_string($conn, $_POST['ship_to']);
        $address	        = mysqli_real_escape_string($conn, $_POST['address']);
        $port_of_loading	= mysqli_real_escape_string($conn, $_POST['port_of_loading']);
        $port_of_entry	    = mysqli_real_escape_string($conn, $_POST['port_of_entry']);
        $final_destination	= mysqli_real_escape_string($conn, $_POST['final_destination']);
        $vessel_voyage	    = mysqli_real_escape_string($conn, $_POST['vessel_voyage']);
        $fcl_cfs	        = mysqli_real_escape_string($conn, $_POST['fcl_cfs']);
        $etd	            = mysqli_real_escape_string($conn, $_POST['etd']);
        $eta	            = mysqli_real_escape_string($conn, $_POST['eta']);
		$container_no       = mysqli_real_escape_string($conn, $_POST['container_no']);
        $seal_no            = mysqli_real_escape_string($conn, $_POST['seal_no']);
		$hs_code            = mysqli_real_escape_string($conn, $_POST['hs_code']);
		$id_summary         = mysqli_real_escape_string($conn, $_POST['id_summary']);
		$add 		        = addData($ship_to, $address, $port_of_loading, $port_of_entry, $final_destination, $vessel_voyage, $fcl_cfs, $etd, $eta, $container_no, $seal_no, $hs_code, $id_summary);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {			
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../output_packing_list.php?id_summary=".$id_summary);
	}elseif (isset($_POST['edit'])) {

		$id_alamat          = mysqli_real_escape_string($conn, $_POST['id_alamat']);
		$ship_to	        = mysqli_real_escape_string($conn, $_POST['ship_to']);
        $address	        = mysqli_real_escape_string($conn, $_POST['address']);
        $port_of_loading	= mysqli_real_escape_string($conn, $_POST['port_of_loading']);
        $port_of_entry	    = mysqli_real_escape_string($conn, $_POST['port_of_entry']);
        $final_destination	= mysqli_real_escape_string($conn, $_POST['final_destination']);
        $vessel_voyage	    = mysqli_real_escape_string($conn, $_POST['vessel_voyage']);
        $fcl_cfs	        = mysqli_real_escape_string($conn, $_POST['fcl_cfs']);
        $etd	            = mysqli_real_escape_string($conn, $_POST['etd']);
        $eta	            = mysqli_real_escape_string($conn, $_POST['eta']);
		$container_no       = mysqli_real_escape_string($conn, $_POST['container_no']);
        $seal_no            = mysqli_real_escape_string($conn, $_POST['seal_no']);
		$hs_code            = mysqli_real_escape_string($conn, $_POST['hs_code']);
		$id_summary         = mysqli_real_escape_string($conn, $_POST['id_summary']);
		$edit 		        = editData($id_alamat, $ship_to, $address, $port_of_loading, $port_of_entry, $final_destination, $vessel_voyage, $fcl_cfs, $etd, $eta, $container_no, $seal_no, $hs_code, $id_summary);
		session_start();
		unset ($_SESSION["message"]);
		if ($edit) {			
			$_SESSION['message'] = $edited;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../data_alamat.php");
    }elseif (isset($_GET['hapus'])){
		$id_alamat	= mysqli_real_escape_string($conn, $_GET['hapus']);
		$delete = deleteData($id_alamat);
		session_start();
		unset ($_SESSION["message"]);
		if ($delete) {			
			$_SESSION['message'] = $deleted;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../data_alamat.php");
	}

?>