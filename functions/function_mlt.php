<?php

require_once 'koneksi.php';
include_once 'helper.php';

function getData()
{
	global $conn;
	$sql 	= "SELECT 
    a.id_summary, 
    a.prod_month, 
    a.cust_id, 
    a.man_po, 
    a.factory_code, 
    a.sku, 
    b.material_taking_out_date, 
    a.si_date, 
    CONCAT(
        IF(DATEDIFF(a.si_date, b.material_taking_out_date) = 0, 1, DATEDIFF(a.si_date, b.material_taking_out_date)),
        ' day'
    ) AS mlt
FROM 
    tb_summery AS a
JOIN 
    tb_taking_out_material AS b 
ON 
    a.factory_code = b.po_number AND a.prod_month = b.order_month
GROUP BY
    a.prod_month, a.factory_code";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getDataDate()
{
	global $conn;
	$sql 	= "SELECT * FROM tb_new_summery INNER JOIN tb_outstock ON tb_new_summery.factory_code = tb_outstock.factory_order AND tb_new_summery.prod_month = tb_outstock.order_month";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function showData($id_mlt)
{
	global $conn;
	$fixid 	= mysqli_real_escape_string($conn, $id_mlt);
	$sql 	= "SELECT * FROM tb_new_summery INNER JOIN tb_outstock ON tb_new_summery.factory_code = tb_outstock.factory_order AND tb_new_summery.prod_month = tb_outstock.order_month
					WHERE id_mlt='$fixid'";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_close($conn);
}

function editData($id_mlt, $prod_month, $cust_id, $man_po, $cust_po, $po_referance, $factory_code, $sku, $category, $gender, $color, $widht, $code, $destination, $price, $xfd, $date, $vendor_code, $mode)
{
	global $conn;
	$fixid 	= mysqli_real_escape_string($conn, $id_mlt);
	$sql 	= "UPDATE tb_start_produksi SET prod_month='$prod_month', cust_id='$cust_id', man_po='$man_po', cust_po='$cust_po', po_referance='$po_referance', factory_code='$factory_code', sku='$sku', category='$category', gender='$gender', color='$color', widht='$widht', code='$code', destination='$destination', price='$price', xfd='$xfd', date='$date', vendor_code='$vendor_code', mode='$mode'
                    WHERE id_mlt='$fixid'";
	$result	= mysqli_query($conn, $sql);
	return ($result) ? true : false;
	mysqli_close($conn);
}

function deleteData($id_mlt)
{
	global $conn;
	$sql 	= "DELETE FROM tb_start_produksi WHERE id_mlt='$id_mlt'";
	$result	= mysqli_query($conn, $sql);
	return ($result) ? true : false;
	mysqli_close($conn);
}

if (isset($_POST['edit'])) {
	$id_mlt         = mysqli_real_escape_string($conn, $_POST['id_mlt']);
	$prod_month	    = mysqli_real_escape_string($conn, $_POST['prod_month']);
	$cust_id	    = mysqli_real_escape_string($conn, $_POST['cust_id']);
	$man_po	        = mysqli_real_escape_string($conn, $_POST['man_po']);
	$factory_code	= mysqli_real_escape_string($conn, $_POST['factory_code']);
	$sku	    	= mysqli_real_escape_string($conn, $_POST['sku']);
	$category       = mysqli_real_escape_string($conn, $_POST['order_qty']);
	$gender			= mysqli_real_escape_string($conn, $_POST['issue_date']);
	$color	        = mysqli_real_escape_string($conn, $_POST['si_date']);
	session_start();
	unset($_SESSION["message"]);
	if ($edit) {
		$_SESSION['message'] = $edited;
	} else {
		$_SESSION['message'] = $failed;
	}
	header("location:../data_mlt.php");
} elseif (isset($_GET['hapus'])) {
	$id_mlt		= mysqli_real_escape_string($conn, $_GET['hapus']);
	$delete = deleteData($id_mlt);
	session_start();
	unset($_SESSION["message"]);
	if ($delete) {
		$_SESSION['message'] = $deleted;
	} else {
		$_SESSION['message'] = $failed;
	}
	header("location:../data_mlt.php");
}
