<?php

require_once 'koneksi.php';
include_once 'helper.php';

function getData()
{
	$id_add_packing = $_GET['id_add_packing'];
	global $conn;
	$sql 	= "SELECT * FROM tb_packing_list a 
					LEFT JOIN tb_add_packing b ON b.id_add_packing = a.id_add_packing 
					LEFT JOIN tb_detail_master c ON a.id_detail = c.id_detail 
					WHERE a.id_add_packing='$id_add_packing'";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getPrepack()
{
	$id_add_packing = $_GET['id_add_packing'];
	global $conn;
	$sql 	= "SELECT * FROM tb_packing_list a 
					LEFT JOIN tb_add_packing b ON b.id_add_packing = a.id_add_packing 
					LEFT JOIN tb_detail_master c ON a.id_detail = c.id_detail 
					WHERE a.id_add_packing='$id_add_packing' limit 1";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getData1()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql 	= "SELECT * FROM tb_packing_list a
                    LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                    LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                    LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                    LEFT JOIN tb_master e ON d.sku = e.sku
                    WHERE d.id_summary='$id_summary' ORDER BY b.nw DESC limit 1";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getSize()
{
	$id_add_packing = $_GET['id_add_packing'];
	global $conn;
	$sql 	= "SELECT size FROM tb_detail_master 
			WHERE id_detail IN (SELECT id_detail FROM `tb_packing_list` WHERE id_add_packing='$id_add_packing') GROUP BY size ORDER BY size";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getPacking()
{
	$id_add_packing = $_GET['id_add_packing'];
	global $conn;
	$sql 	= "SELECT * FROM tb_packing_list a 
					LEFT JOIN tb_add_packing b ON a.id_add_packing = b.id_add_packing
					LEFT JOIN tb_detail_master c ON a.id_detail = c.id_detail
					WHERE b.id_add_packing = '$id_add_packing' ORDER BY c.size";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getSize1()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql 	= "SELECT * FROM tb_packing_list a 
					LEFT JOIN tb_add_packing b ON a.id_add_packing = b.id_add_packing
					LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
					LEFT JOIN tb_detail_master d ON a.id_detail = d.id_detail
					WHERE c.id_summary = '$id_summary' ORDER BY d.size";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function countData()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql 	= "SELECT COUNT(c.id_summary) FROM tb_packing_list a 
					LEFT JOIN tb_add_packing b ON a.id_add_packing = b.id_add_packing
					LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
					LEFT JOIN tb_detail_master d ON a.id_detail = d.id_detail
					WHERE c.id_summary = '$id_summary' ORDER BY a.id_detail";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function deleteData1($id_add_packing)
{
	global $conn;
	$sql 	= "DELETE FROM tb_packing_list WHERE id_add_packing='$id_add_packing'";
	$result	= mysqli_query($conn, $sql);
	return ($result) ? true : false;
	mysqli_close($conn);
}

function deleteData2($id_add_packing)
{
	global $conn;
	$sql 	= "DELETE FROM tb_packing_list WHERE id_add_packing='$id_add_packing'";
	$result	= mysqli_query($conn, $sql);
	return ($result) ? true : false;
	mysqli_close($conn);
}

if (isset($_GET['delete'])) {
	$id_add_packing		= mysqli_real_escape_string($conn, $_GET['delete']);
	$delete = deleteData1($id_add_packing);
	session_start();
	unset($_SESSION["message"]);
	if ($delete) {
		$_SESSION['message'] = $deleted;
	} else {
		$_SESSION['message'] = $failed;
	}
	header("location:../data_packing_list.php?id_add_packing=" . $id_add_packing);
}

if (isset($_GET['delete1'])) {
	$id_add_packing		= mysqli_real_escape_string($conn, $_GET['delete1']);
	$delete = deleteData2($id_add_packing);
	session_start();
	unset($_SESSION["message"]);
	if ($delete) {
		$_SESSION['message'] = $deleted;
	} else {
		$_SESSION['message'] = $failed;
	}
	header("location:../data_packing_prepack.php?id_add_packing=" . $id_add_packing);
}

function prs()
{
	$id_add_packing = $_GET['id_add_packing'];
	global $conn;
	$sql    = "SELECT SUM(no_ctn) AS total_ctn FROM tb_packing_list
					WHERE id_add_packing='$id_add_packing'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function qty()
{
	$id_add_packing = $_GET['id_add_packing'];
	global $conn;
	$sql    = "SELECT SUM(prs_ctn) AS total_qty FROM tb_packing_list
					WHERE id_add_packing='$id_add_packing'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function totalcarton()
{
	$id_add_packing = $_GET['id_add_packing'];
	global $conn;
	$sql    = "SELECT SUM(qty_prs) AS total_prs FROM tb_packing_list
					WHERE id_add_packing='$id_add_packing'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function getsummary()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql 	= "SELECT * FROM tb_summery WHERE id_summary=$id_summary GROUP BY cust_id";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function prs1()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT SUM(no_ctn) AS total_ctn FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                    LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                    LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                    LEFT JOIN tb_master e ON d.sku = e.sku
                    WHERE d.id_summary='$id_summary' ORDER BY d.id_summary";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function subtotalNW()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT SUM(a.packing_metode1 * b.nw1) as subtotal FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function subtotalNW1()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT SUM(a.no_ctn * b.nw1) as subtotal FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function subtotalNW2()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT SUM(a.packing_metode1 * b.nw1) as subtotal FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function subtotalGW()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT SUM(a.packing_metode1 * b.gw1) as subtotal FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function subtotalGW1()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT SUM(a.no_ctn * b.gw1) as subtotal FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function subtotalGW2()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT SUM(a.packing_metode1 * b.gw1) as subtotal FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function subtotalCbm()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT SUM(a.no_ctn * b.cbm) as subtotal FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function nilaiMax()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT MAX(b.size) as nilai FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function nilaiAwal()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT b.size FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary' ORDER BY a.id_detail LIMIT 1";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function nilaiAkhir()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT b.size FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary' ORDER BY a.id_detail DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function nilaiMin()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT b.size FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary' ORDER BY id_detail DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function subPrs()
{
	$id_summary = $_GET['id_summary'];
	global $conn;
	$sql    = "SELECT SUM(a.packing_metode1) as subtotal FROM tb_packing_list a
					LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
					LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
					LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
					LEFT JOIN tb_master e ON d.sku = e.sku
					WHERE d.id_summary='$id_summary'";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}

function showData($id_summary)
{
	global $conn;
	$fixid 	= mysqli_real_escape_string($conn, $id_summary);
	$sql 	= "SELECT tb_summery.*, tb_alamat.* FROM tb_summery
                    JOIN tb_alamat ON tb_summery.id_summary = tb_alamat.id_summary WHERE tb_alamat.id_summary='$fixid'";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_close($conn);
}

function showFactory($id_summary)
{
	global $conn;
	$fixid 	= mysqli_real_escape_string($conn, $id_summary);
	$sql 	= "SELECT factory_code FROM tb_summery WHERE id_summary='$fixid'";
	$result	= mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_close($conn);
}
