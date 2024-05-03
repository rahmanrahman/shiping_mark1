<?php
	require_once 'koneksi.php';


    function getPo() {
		global $conn;
		$sql 	= "SELECT COUNT(factory_code) AS nilai FROM `tb_summery` WHERE prod_month LIKE '2024%'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getPoOld() {
		global $conn;
		$sql 	= "SELECT COUNT(factory_code) AS nilai FROM `tb_summery` WHERE prod_month LIKE '2023%'";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

    function getQty() {
		global $conn;
		$sql 	= "SELECT SUM(qty_prs) AS nilai
                    FROM `tb_packing_list` a
                    LEFT JOIN tb_add_packing b ON a.id_add_packing = b.id_add_packing
                    LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
                    WHERE c.prod_month LIKE '2024%' GROUP BY c.factory_code, a.ctn_no";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

	function getQtyOld() {
		global $conn;
		$sql 	= "SELECT SUM(qty_prs) AS nilai
                    FROM `tb_packing_list` a
                    LEFT JOIN tb_add_packing b ON a.id_add_packing = b.id_add_packing
                    LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
                    WHERE c.prod_month LIKE '2023%' GROUP BY c.factory_code, a.ctn_no";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}
?>