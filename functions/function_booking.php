<?php

	require_once 'koneksi.php';
	include_once 'helper.php';

	function getData() {
		global $conn;
		$sql 	= "SELECT * FROM tb_booking";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

    function getPacking() {
        $id_booking=$_GET['id_booking'];
		global $conn;        
		$sql 	= "SELECT *, c.id_summary, MIN(size) AS minsize, MAX(size) AS maxsize, SUM(packing_metode1 * nw1) AS nilainw, SUM(packing_metode1 * gw1) AS nilaigw, max(cbm) AS nilaicbm, SUM(if( packing_metode1 = 0, no_ctn * nw, 0)) AS totalnw, SUM(if( packing_metode1 = 0, no_ctn * gw, 0)) AS totalgw, SUM(if( packing_metode1 = 0, no_ctn * cbm, 0)) AS totalcbm FROM tb_booking a
                    LEFT JOIN tb_detail_booking b ON a.id_booking = b.id_booking
                    LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
					LEFT JOIN tb_master d ON c.sku = d.sku
					LEFT JOIN tb_add_packing f ON c.id_summary = f.id_summary
					LEFT JOIN tb_packing_list g ON f.id_add_packing = g.id_add_packing
					LEFT JOIN tb_detail_master e ON g.id_detail = e.id_detail
					LEFT JOIN tb_hscode h ON c.id_summary = h.id_summary
					WHERE a.id_booking='$id_booking' GROUP BY factory_code, ctn_no ORDER BY id_detail_booking, id_packing_list";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

    function getsummary() {
		global $conn;
		$sql 	= "SELECT * FROM tb_summery";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function addData($shipto_booking, $address_booking, $notify_booking, $poe_booking, $fd_booking, $vv_booking, $fc_booking, $etd_booking, $eta_booking, $cn_booking, $sn_booking, $note_booking) {
		global $conn;
		$sql 	= "INSERT INTO tb_booking (shipto_booking, address_booking, notify_booking, poe_booking, fd_booking, vv_booking, fc_booking, etd_booking, eta_booking, cn_booking, sn_booking, note_booking) 
                    VALUES ('$shipto_booking','$address_booking','$notify_booking','$poe_booking','$fd_booking','$vv_booking','$fc_booking','$etd_booking','$eta_booking','$cn_booking','$sn_booking','$note_booking')";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

    function addData1($id_booking, $id_summary) {
		global $conn;
        $cek = mysqli_query($conn, "SELECT * FROM tb_detail_booking WHERE id_booking='$id_booking' AND id_summary='$id_summary'");
		if(mysqli_num_rows($cek) !== 0 ){
			return false;
		}else{
			$sql 	= "INSERT INTO tb_detail_booking (id_booking, id_summary) VALUES ('$id_booking','$id_summary')";
		    $result	= mysqli_query($conn, $sql);
		    return ($result) ? true : false;
		}
		mysqli_close($conn);
	}
	
	function showData($id_booking) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_booking);
		$sql 	= "SELECT * FROM tb_booking WHERE id_booking='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_close($conn);
	}

    function editData($id_booking, $shipto_booking, $address_booking, $notify_booking, $poe_booking, $fd_booking, $vv_booking, $fc_booking, $etd_booking, $eta_booking, $cn_booking, $sn_booking, $note_booking) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_booking);
		$sql 	= "UPDATE tb_booking SET shipto_booking='$shipto_booking', address_booking='$address_booking', notify_booking='$notify_booking', poe_booking='$poe_booking', fd_booking='$fd_booking', vv_booking='$vv_booking', fc_booking='$fc_booking', etd_booking='$etd_booking', eta_booking='$eta_booking', cn_booking='$cn_booking', sn_booking='$sn_booking', note_booking='$note_booking'
					WHERE id_booking='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function deleteData($id_booking) {
		global $conn;
		$sql 	= "DELETE FROM tb_booking WHERE id_booking='$id_booking'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

    function deletePacking($id_detail_booking) {
		global $conn;
		$sql 	= "DELETE FROM tb_detail_booking WHERE id_detail_booking='$id_detail_booking'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	if (isset($_POST['add'])) {
		$shipto_booking	    = mysqli_real_escape_string($conn, $_POST['shipto_booking']);
        $address_booking    = mysqli_real_escape_string($conn, $_POST['address_booking']);
		$notify_booking	    = mysqli_real_escape_string($conn, $_POST['notify_booking']);
        $poe_booking	    = mysqli_real_escape_string($conn, $_POST['poe_booking']);
        $fd_booking	        = mysqli_real_escape_string($conn, $_POST['fd_booking']);
		$vv_booking	        = mysqli_real_escape_string($conn, $_POST['vv_booking']);
		$fc_booking	    	= mysqli_real_escape_string($conn, $_POST['fc_booking']);
        $etd_booking	    = mysqli_real_escape_string($conn, $_POST['etd_booking']);
        $eta_booking		= mysqli_real_escape_string($conn, $_POST['eta_booking']);
		$cn_booking		    = mysqli_real_escape_string($conn, $_POST['cn_booking']);
        $sn_booking 		= mysqli_real_escape_string($conn, $_POST['sn_booking']);
		$note_booking		= mysqli_real_escape_string($conn, $_POST['note_booking']);
		$add 			    = addData($shipto_booking, $address_booking, $notify_booking, $poe_booking, $fd_booking, $vv_booking, $fc_booking, $etd_booking, $eta_booking, $cn_booking, $sn_booking, $note_booking);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {	
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../data_booking.php");
    }elseif (isset($_POST['add1'])) {
		$id_booking	    = mysqli_real_escape_string($conn, $_POST['id_booking']);
        $id_summary	    = mysqli_real_escape_string($conn, $_POST['id_summary']);
		$add 			= addData1($id_booking, $id_summary);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {	
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $duplicated;
		}
		header("location:../kelola_booking.php?id_booking=".$id_booking);
    }elseif (isset($_POST['edit'])) {
		$id_booking 	    = mysqli_real_escape_string($conn, $_POST['id_booking']);
		$shipto_booking	    = mysqli_real_escape_string($conn, $_POST['shipto_booking']);
        $address_booking    = mysqli_real_escape_string($conn, $_POST['address_booking']);
		$notify_booking	    = mysqli_real_escape_string($conn, $_POST['notify_booking']);
        $poe_booking	    = mysqli_real_escape_string($conn, $_POST['poe_booking']);
        $fd_booking	        = mysqli_real_escape_string($conn, $_POST['fd_booking']);
		$vv_booking	        = mysqli_real_escape_string($conn, $_POST['vv_booking']);
		$fc_booking	    	= mysqli_real_escape_string($conn, $_POST['fc_booking']);
        $etd_booking	    = mysqli_real_escape_string($conn, $_POST['etd_booking']);
        $eta_booking		= mysqli_real_escape_string($conn, $_POST['eta_booking']);
		$cn_booking		    = mysqli_real_escape_string($conn, $_POST['cn_booking']);
        $sn_booking 		= mysqli_real_escape_string($conn, $_POST['sn_booking']);
		$note_booking		= mysqli_real_escape_string($conn, $_POST['note_booking']);
		$edit 		        = editData($id_booking, $shipto_booking, $address_booking, $notify_booking, $poe_booking, $fd_booking, $vv_booking, $fc_booking, $etd_booking, $eta_booking, $cn_booking, $sn_booking, $note_booking);
		session_start();
		unset ($_SESSION["message"]);
		if ($edit) {			
			$_SESSION['message'] = $edited;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../data_booking.php");
	}elseif (isset($_GET['hapus'])){
		$id_booking	= mysqli_real_escape_string($conn, $_GET['hapus']);
		$delete = deleteData($id_booking);
		session_start();
		unset ($_SESSION["message"]);
		if ($delete) {			
			$_SESSION['message'] = $deleted;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../data_booking.php");
    }elseif (isset($_GET['hapusPacking'])){
        $id_booking = $_GET['id_booking'];
		$id_detail_booking	= mysqli_real_escape_string($conn, $_GET['hapusPacking']);
		$delete = deletePacking($id_detail_booking);
		session_start();
		unset ($_SESSION["message"]);
		if ($delete) {			
			$_SESSION['message'] = $deleted;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../kelola_booking.php?id_booking=".$id_booking);
    }
?>