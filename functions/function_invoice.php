<?php

	require_once 'koneksi.php';
	include_once 'helper.php';

	function getData() {
		global $conn;
		$sql 	= "SELECT * FROM tb_invoice";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getSize() {
		global $conn;
		$id_invoice=$_GET['id_invoice'];
		$sql 	= "SELECT a.id_invoice, e.size, g.qty_prs, SUM(g.qty_prs) as nilaiprs FROM tb_invoice a
					LEFT JOIN tb_detail_invoice b ON a.id_invoice = b.id_invoice
					LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
					LEFT JOIN tb_add_packing f ON c.id_summary = f.id_summary
					LEFT JOIN tb_packing_list g ON f.id_add_packing = g.id_add_packing
					JOIN tb_detail_master e ON g.id_detail = e.id_detail
					WHERE a.id_invoice='$id_invoice' GROUP BY e.size";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getData1() {
		$id_invoice=$_GET['id_invoice'];
		global $conn;
		$sql 	= "SELECT a.id_invoice, b.id_detail_invoice, c.id_summary, c.factory_code, c.cust_po, c.man_po, c.po_referance, MIN(e.size) AS low, MAX(e.size) AS high, d.sku, c.category, c.gender, c.color, c.price, g.packing_metode1, g.qty_prs, SUM(qty_prs) AS nilai, h.hscode, h.id_hscode FROM tb_invoice a
					LEFT JOIN tb_detail_invoice b ON a.id_invoice = b.id_invoice
					LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
					LEFT JOIN tb_master d ON c.sku = d.sku
					LEFT JOIN tb_add_packing f ON c.id_summary = f.id_summary
					LEFT JOIN tb_packing_list g ON f.id_add_packing = g.id_add_packing
					LEFT JOIN tb_detail_master e ON g.id_detail = e.id_detail
					LEFT JOIN tb_hscode h ON c.id_summary = h.id_summary
					WHERE a.id_invoice='$id_invoice' GROUP BY c.factory_code ORDER BY b.id_detail_invoice";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getPurchase() {
		$id_invoice=$_GET['id_invoice'];
		global $conn;
		$sql 	= "SELECT c.vendor_code, c.realise, c.mode FROM tb_invoice a
					LEFT JOIN tb_detail_invoice b ON a.id_invoice = b.id_invoice
					LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
					LEFT JOIN tb_master d ON c.sku = d.sku
					LEFT JOIN tb_add_packing f ON c.id_summary = f.id_summary
					LEFT JOIN tb_packing_list g ON f.id_add_packing = g.id_add_packing
					LEFT JOIN tb_detail_master e ON g.id_detail = e.id_detail
					LEFT JOIN tb_hscode h ON c.id_summary = h.id_summary
					WHERE a.id_invoice='$id_invoice' GROUP BY c.vendor_code ORDER BY b.id_detail_invoice";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getPacking() {
        $id_invoice=$_GET['id_invoice'];
		global $conn;        
		$sql 	= "SELECT *, MIN(size) AS minsize, MAX(size) AS maxsize, SUM(packing_metode1 * nw1) AS nilainw, SUM(packing_metode1 * gw1) AS nilaigw, max(cbm) AS nilaicbm, SUM(if( packing_metode1 = 0, no_ctn * nw, 0)) AS totalnw, SUM(if( packing_metode1 = 0, no_ctn * gw, 0)) AS totalgw, SUM(if( packing_metode1 = 0, no_ctn * cbm, 0)) AS totalcbm FROM tb_invoice a
                    LEFT JOIN tb_detail_invoice b ON a.id_invoice = b.id_invoice
                    LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
					LEFT JOIN tb_master d ON c.sku = d.sku
					LEFT JOIN tb_add_packing f ON c.id_summary = f.id_summary
					LEFT JOIN tb_packing_list g ON f.id_add_packing = g.id_add_packing
					LEFT JOIN tb_detail_master e ON g.id_detail = e.id_detail
					LEFT JOIN tb_hscode h ON c.id_summary = h.id_summary
					WHERE a.id_invoice='$id_invoice' GROUP BY factory_code, ctn_no ORDER BY id_detail_invoice, id_packing_list";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getPurchase1() {
		$id_invoice=$_GET['id_invoice'];
		global $conn;
		$sql 	= "SELECT a.id_invoice, f.id_add_packing, c.gender, c.id_summary, c.man_po, c.factory_code, d.sku, c.xfd, c.realise, SUM(qty_prs) AS nilai, c.price, e.size FROM tb_invoice a
					LEFT JOIN tb_detail_invoice b ON a.id_invoice = b.id_invoice
					LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
					LEFT JOIN tb_master d ON c.sku = d.sku
					LEFT JOIN tb_add_packing f ON c.id_summary = f.id_summary
					LEFT JOIN tb_packing_list g ON f.id_add_packing = g.id_add_packing
					LEFT JOIN tb_detail_master e ON g.id_detail = e.id_detail
					LEFT JOIN tb_hscode h ON c.id_summary = h.id_summary
					WHERE a.id_invoice='$id_invoice' GROUP BY c.factory_code ORDER BY b.id_detail_invoice";
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

	function addData($shipto, $alamat_shipto, $invoice_no, $tanggal, $payment_term, $notify, $port, $shipper, $about, $delivery) {
		global $conn;
		$cek = mysqli_query($conn, "SELECT * FROM tb_invoice WHERE invoice_no='$invoice_no'");
		if(mysqli_num_rows($cek) !== 0 ){
			return false;
		}else{
			$sql 	= "INSERT INTO tb_invoice (shipto, alamat_shipto, invoice_no, tanggal, payment_term, notify, port, shipper, about, delivery) VALUES ('$shipto','$alamat_shipto','$invoice_no','$tanggal','$payment_term','$notify','$port','$shipper','$about','$delivery')";
			$result	= mysqli_query($conn, $sql);
			return ($result) ? true : false;
		}
		mysqli_close($conn);
	}

	function addData1($id_invoice, $id_summary) {
		global $conn;
		$sql 	= "INSERT INTO tb_detail_invoice (id_invoice, id_summary) VALUES ('$id_invoice','$id_summary')";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function addData2($id_summary, $hscode, $id_invoice) {
		global $conn;
		$cek = mysqli_query($conn, "SELECT * FROM tb_hscode WHERE id_invoice='$id_invoice' AND id_summary='$id_summary'");
		if(mysqli_num_rows($cek) !== 0 ){
			return false;
		}else{
			$sql 	= "INSERT INTO tb_hscode (id_summary, hscode, id_invoice) VALUES ('$id_summary','$hscode','$id_invoice')";
			$result	= mysqli_query($conn, $sql);
			return ($result) ? true : false;
		}
		mysqli_close($conn);
	}

	function showData($id_invoice) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_invoice);
		$sql 	= "SELECT * FROM tb_invoice WHERE id_invoice='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_close($conn);
	}

	function showHscode($id_hscode) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_hscode);
		$sql 	= "SELECT * FROM tb_hscode a
					LEFT JOIN tb_summery b ON a.id_summary = b.id_summary WHERE id_hscode='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_close($conn);
	}

    function editData($id_invoice, $shipto, $alamat_shipto, $invoice_no, $tanggal, $payment_term, $notify, $port, $shipper, $about, $delivery) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_invoice);
		$sql 	= "UPDATE tb_invoice SET shipto='$shipto', alamat_shipto='$alamat_shipto', invoice_no='$invoice_no', tanggal='$tanggal', payment_term='$payment_term', notify='$notify', port='$port', shipper='$shipper', about='$about', delivery='$delivery'
					WHERE id_invoice='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function editHscode($id_hscode, $id_summary, $hscode, $id_invoice) {
		global $conn;
		$fixid 	= mysqli_real_escape_string($conn, $id_hscode);
		$sql 	= "UPDATE tb_hscode SET id_summary='$id_summary', hscode='$hscode', id_invoice='$id_invoice'
					WHERE id_hscode='$fixid'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function deleteData($id_invoice) {
		global $conn;
		$sql 	= "DELETE FROM tb_invoice WHERE id_invoice='$id_invoice'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	function deleteData1($id_detail_invoice) {
		global $conn;
		$sql 	= "DELETE FROM tb_detail_invoice WHERE id_detail_invoice='$id_detail_invoice'";
		$result	= mysqli_query($conn, $sql);
		return ($result) ? true : false;
		mysqli_close($conn);
	}

	if (isset($_POST['add'])) {
		$shipto	    	= mysqli_real_escape_string($conn, $_POST['shipto']);
        $alamat_shipto	= mysqli_real_escape_string($conn, $_POST['alamat_shipto']);
		$invoice_no	    = mysqli_real_escape_string($conn, $_POST['invoice_no']);
        $tanggal	    = mysqli_real_escape_string($conn, $_POST['tanggal']);
        $payment_term	= mysqli_real_escape_string($conn, $_POST['payment_term']);
		$notify	    	= mysqli_real_escape_string($conn, $_POST['notify']);
		$port	    	= mysqli_real_escape_string($conn, $_POST['port']);
        $shipper	    = mysqli_real_escape_string($conn, $_POST['shipper']);
        $about			= mysqli_real_escape_string($conn, $_POST['about']);
		$delivery		= mysqli_real_escape_string($conn, $_POST['delivery']);
		$add 			= addData($shipto, $alamat_shipto, $invoice_no, $tanggal, $payment_term, $notify, $port, $shipper, $about, $delivery);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {	
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $duplicated;
		}
		header("location:../data_invoice.php");
	}elseif (isset($_POST['add1'])) {
		$id_invoice	    = mysqli_real_escape_string($conn, $_POST['id_invoice']);
        $id_summary	    = mysqli_real_escape_string($conn, $_POST['id_summary']);
		$add 			= addData1($id_invoice, $id_summary);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {	
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $duplicated;
		}
		header("location:../kelola_invoice.php?id_invoice=".$id_invoice);
	}elseif (isset($_POST['add2'])) {
		$id_summary	    = mysqli_real_escape_string($conn, $_POST['id_summary']);
        $hscode	    	= mysqli_real_escape_string($conn, $_POST['hscode']);
		$id_invoice	    = mysqli_real_escape_string($conn, $_POST['id_invoice']);
		$add 			= addData2($id_summary, $hscode, $id_invoice);
		session_start();
		unset ($_SESSION["message"]);
		if ($add) {	
			$_SESSION['message'] = $added;
		}else {
			$_SESSION['message'] = $duplicated;
		}
		header("location:../kelola_invoice.php?id_invoice=".$id_invoice);
    }elseif (isset($_POST['edit'])) {
		$id_invoice	    = mysqli_real_escape_string($conn, $_POST['id_invoice']);
		$shipto	    	= mysqli_real_escape_string($conn, $_POST['shipto']);
        $alamat_shipto	= mysqli_real_escape_string($conn, $_POST['alamat_shipto']);
		$invoice_no	    = mysqli_real_escape_string($conn, $_POST['invoice_no']);
        $tanggal	    = mysqli_real_escape_string($conn, $_POST['tanggal']);
        $payment_term	= mysqli_real_escape_string($conn, $_POST['payment_term']);
		$notify	    	= mysqli_real_escape_string($conn, $_POST['notify']);
		$port	    	= mysqli_real_escape_string($conn, $_POST['port']);
        $shipper	    = mysqli_real_escape_string($conn, $_POST['shipper']);
        $about			= mysqli_real_escape_string($conn, $_POST['about']);
		$delivery		= mysqli_real_escape_string($conn, $_POST['delivery']);
		$edit 		    = editData($id_invoice, $shipto, $alamat_shipto, $invoice_no, $tanggal, $payment_term, $notify, $port, $shipper, $about, $delivery);
		session_start();
		unset ($_SESSION["message"]);
		if ($edit) {			
			$_SESSION['message'] = $edited;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../data_invoice.php");
	}elseif (isset($_POST['edit1'])) {
		$id_hscode    	= mysqli_real_escape_string($conn, $_POST['id_hscode']);
		$id_summary	    = mysqli_real_escape_string($conn, $_POST['id_summary']);
        $hscode			= mysqli_real_escape_string($conn, $_POST['hscode']);
		$id_invoice	    = mysqli_real_escape_string($conn, $_POST['id_invoice']);
		$edit 		    = editHscode($id_hscode, $id_summary, $hscode, $id_invoice);
		session_start();
		unset ($_SESSION["message"]);
		if ($edit) {			
			$_SESSION['message'] = $edited;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../kelola_invoice.php?id_invoice=".$id_invoice);
	}elseif (isset($_GET['hapus'])){
		$invoice_no	= mysqli_real_escape_string($conn, $_GET['hapus']);
		$delete = deleteData($invoice_no);
		session_start();
		unset ($_SESSION["message"]);
		if ($delete) {			
			$_SESSION['message'] = $deleted;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../data_invoice.php");
	}elseif (isset($_GET['hapus1'])){
		$id_invoice = $_GET['id_invoice'];
		$id_detail_invoice	= mysqli_real_escape_string($conn, $_GET['hapus1']);
		$delete = deleteData1($id_detail_invoice);
		session_start();
		unset ($_SESSION["message"]);
		if ($delete) {			
			$_SESSION['message'] = $deleted;
		}else {
			$_SESSION['message'] = $failed;
		}
		header("location:../kelola_invoice.php?id_invoice=".$id_invoice);
	}

	function penyebut($subTotal){
		$subTotal = abs($subTotal);
		$huruf = array("", "ONE","TWO","THREE","FOUR","FIVE","SIX","SEVEN","EIGHT","NINE");
		$temp = "";
		if($subTotal < 10){
			$temp = " ".$huruf[$subTotal];
		}elseif($subTotal < 11){
			$temp = "TEN";
		}elseif($subTotal < 12){
			$temp = "ELEVEN";
		}elseif($subTotal < 13){
			$temp = "TWELVE";
		}elseif($subTotal < 14){
			$temp = "THIRTEEN";
		}elseif($subTotal < 20){
			$temp = penyebut($subTotal - 10)."TEEN";
		}elseif($subTotal < 30){
			$temp = "TWENTY ".penyebut($subTotal - 20);
		}elseif($subTotal < 40){
			$temp = "THIRTY ".penyebut($subTotal - 30);
		}elseif($subTotal < 50){
			$temp = "FORTY ".penyebut($subTotal - 40);
		}elseif($subTotal < 60){
			$temp = "FIFTY ".penyebut($subTotal - 50);
		}elseif($subTotal < 100){
			$temp = penyebut($subTotal / 10)."TY ".penyebut($subTotal % 10);
		}elseif($subTotal < 1000){
			$temp = penyebut($subTotal / 100)." HUNDRED ".penyebut($subTotal % 100);
		}elseif($subTotal < 1000000){
			$temp = penyebut($subTotal / 1000)." THOUSAND ".penyebut($subTotal % 1000);
		}elseif($subTotal < 1000000000){
			$temp = penyebut($subTotal / 1000000)." BILLION ".penyebut($subTotal % 1000000);
		}return $temp;		
	}

	function terbilang($subTotal, $style=1){
		if($subTotal < 0){
			$hasil = "MINUS ". trim(penyebut($subTotal));
		}else{
			$poin = trim(koma($subTotal));
			$hasil = trim(penyebut($subTotal));
		}
			switch ($style) {
				case 1:
					if($poin){
						$hasil = strtoupper($hasil).' POINT '.strtoupper($poin).' CENTS ';
					}else{
						$hasil = strtoupper($hasil);
					}
					break;
			}
		return $hasil;
	}

	function koma($subTotal){
		$subTotal = stristr($subTotal,'.');
		$pos  = 1;
		$char = substr($subTotal, $pos,1);

		if($char == 0){
			$angka = array("ZERO","ONE","TWO","THREE","FOUR","FIVE","SIX","SEVEN","EIGHT","NINE");

			$temp = " ";
			$pjg  = strlen($subTotal);

			while ($pos < $pjg){
				$char = substr($subTotal, $pos,1);
				$pos++;
				$temp .=" ".$angka[$char];
			}
			return $temp;
		}else{
			$angka = array("","ONE","TWO","THREE","FOUR","FIVE","SIX","SEVEN","EIGHT","NINE","TEN",
			"ELEVEN","TWELVE","THIRTEEN","FOURTEEN","FIVETEEN","SIXTEEN","SEVENTEEN","EIGHTEEN","NINETEEN","TWENTY",
			"TWENTY ONE","TWENTY TWO","TWENTY THREE","TWENTY FOUR","TWENTY FIVE","TWENTY SIX","TWENTY SEVEN","TWENTY EIGHT","TWENTY NINE","THIRTY",
			"THIRTY ONE","THIRTY TWO","THIRTY THREE","THIRTY FOUR","THIRTY FIVE","THIRTY SIX","THIRTY SEVEN","THIRTY EIGHT","THIRTY NINE","FORTY",
			"FORTY ONE","FORTY TWO","FORTY THREE","FORTY FOUR","FORTY FIVE","FORTY SIX","FORTY SEVEN","FORTY EIGHT","FORTY NINE","FIFTY",
			"FIFTY ONE","FIFTY TWO","FIFTY THREE","FIFTY FOUR","FIFTY FIVE","FIFTY SIX","FIFTY SEVEN","FIFTY EIGHT","FIFTY NINE","SIXTY",
			"SIXTY ONE","SIXTY TWO","SIXTY THREE","SIXTY FOUR","SIXTY FIVE","SIXTY SIX","SIXTY SEVEN","SIXTY EIGHT","SIXTY NINE","SEVENTY",
			"SEVENTY ONE","SEVENTY TWO","SEVENTY THREE","SEVENTY FOUR","SEVENTY FIVE","SEVENTY SIX","SEVENTY SEVEN","SEVENTY EIGHT","SEVENTY NINE","EIGHTY",
			"EIGHTY ONE","EIGHTY TWO","EIGHTY THREE","EIGHTY FOUR","EIGHTY FIVE","EIGHTY SIX","EIGHTY SEVEN","EIGHTY EIGHT","EIGHTY NINE","NINETY",
			"NINETY ONE","NINETY TWO","NINETY THREE","NINETY FOUR","NINETY FIVE","NINETY SIX","NINETY SEVEN","NINETY EIGHT","NINETY NINE");
			
			$temp = " ";
			$char = substr($subTotal,1,2);
			$temp .=" ".$angka[$char];
			return $temp;
		}
	}
?>