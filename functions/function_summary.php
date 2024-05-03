<?php

require_once 'koneksi.php';
include_once 'helper.php';

function getData()
{
	global $conn;
	$sql 	= "SELECT tb_summery.*, tb_master.*
                    FROM tb_summery
                    JOIN tb_master ON tb_summery.sku = tb_master.sku";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getDataDate()
{
	global $conn;
	$sql 	= "SELECT tb_summery.*, tb_master.*
                    FROM tb_summery
                    JOIN tb_master ON tb_summery.sku = tb_master.sku
					WHERE tb_summery.date=''";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function showData($id_summary)
{
	global $conn;
	$fixid 	= mysqli_real_escape_string($conn, $id_summary);
	$sql 	= "SELECT tb_summery.*, tb_master.* FROM tb_summery JOIN tb_master ON tb_summery.sku = tb_master.sku
					WHERE id_summary='$fixid'";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_close($conn);
}

function detailData($id_summary)
{
	global $conn;
	$fixid 	= mysqli_real_escape_string($conn, $id_summary);
	$sql 	= "SELECT tb_summery.*, tb_master.* FROM tb_summery JOIN tb_master ON tb_summery.sku = tb_master.sku
					WHERE id_summary='$fixid'";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_close($conn);
}

function editData($id_summary, $prod_month, $cust_id, $man_po, $cust_po, $po_referance, $factory_code, $sku, $category, $gender, $color, $widht, $code, $destination, $price, $xfd, $date, $vendor_code, $mode, $si_date)
{
	global $conn;
	$fixid 	= mysqli_real_escape_string($conn, $id_summary);
	$sql 	= "UPDATE tb_summery SET prod_month='$prod_month', cust_id='$cust_id', man_po='$man_po', cust_po='$cust_po', po_referance='$po_referance', factory_code='$factory_code', sku='$sku', category='$category', gender='$gender', color='$color', widht='$widht', code='$code', destination='$destination', price='$price', xfd='$xfd', date='$date', vendor_code='$vendor_code', mode='$mode', si_date='$si_date'
                    WHERE id_summary='$fixid'";
	$result	= mysqli_query($conn, $sql);
	return ($result) ? true : false;
	mysqli_close($conn);
}

function deleteData($id_summary)
{
	global $conn;
	$sql 	= "DELETE FROM tb_summery WHERE id_summary='$id_summary'";
	$result	= mysqli_query($conn, $sql);
	return ($result) ? true : false;
	mysqli_close($conn);
}

if (isset($_POST['edit'])) {
	$id_summary     = mysqli_real_escape_string($conn, $_POST['id_summary']);
	$prod_month	    = mysqli_real_escape_string($conn, $_POST['prod_month']);
	$cust_id	    = mysqli_real_escape_string($conn, $_POST['cust_id']);
	$man_po	        = mysqli_real_escape_string($conn, $_POST['man_po']);
	$cust_po	    = mysqli_real_escape_string($conn, $_POST['cust_po']);
	$po_referance	= mysqli_real_escape_string($conn, $_POST['po_referance']);
	$factory_code	= mysqli_real_escape_string($conn, $_POST['factory_code']);
	$sku	    	= mysqli_real_escape_string($conn, $_POST['sku']);
	$category       = mysqli_real_escape_string($conn, $_POST['category']);
	$gender			= mysqli_real_escape_string($conn, $_POST['gender']);
	$color	        = mysqli_real_escape_string($conn, $_POST['color']);
	$widht	        = mysqli_real_escape_string($conn, $_POST['widht']);
	$code	        = mysqli_real_escape_string($conn, $_POST['code']);
	$destination	= mysqli_real_escape_string($conn, $_POST['destination']);
	$price	        = mysqli_real_escape_string($conn, $_POST['price']);
	$xfd	        = mysqli_real_escape_string($conn, $_POST['xfd']);
	$date	        = mysqli_real_escape_string($conn, $_POST['date']);
	$vendor_code	= mysqli_real_escape_string($conn, $_POST['vendor_code']);
	$mode	        = mysqli_real_escape_string($conn, $_POST['mode']);
	$si_date	        = mysqli_real_escape_string($conn, $_POST['si_date']);
	$edit 		    = editData($id_summary, $prod_month, $cust_id, $man_po, $cust_po, $po_referance, $factory_code, $sku, $category, $gender, $color, $widht, $code, $destination, $price, $xfd, $date, $vendor_code, $mode, $si_date);
	session_start();
	unset($_SESSION["message"]);
	if ($edit) {
		$_SESSION['message'] = $edited;
	} else {
		$_SESSION['message'] = $failed;
	}
	header("location:../data_summary.php");
} elseif (isset($_GET['hapus'])) {
	$id_summary		= mysqli_real_escape_string($conn, $_GET['hapus']);
	$delete = deleteData($id_summary);
	session_start();
	unset($_SESSION["message"]);
	if ($delete) {
		$_SESSION['message'] = $deleted;
	} else {
		$_SESSION['message'] = $failed;
	}
	header("location:../data_summary.php");
}
