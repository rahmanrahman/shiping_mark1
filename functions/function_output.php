<?php    

    require_once 'koneksi.php';

    function getData() {
		$id_summary=$_GET['id_summary'];
		global $conn;
		$sql 	= "SELECT * FROM tb_packing_list a
                    LEFT JOIN tb_detail_master b ON a.id_detail = b.id_detail
                    LEFT JOIN tb_add_packing c ON a.id_add_packing = c.id_add_packing
                    LEFT JOIN tb_summery d ON c.id_summary = d.id_summary
                    LEFT JOIN tb_master e ON d.sku = e.sku
                    WHERE d.id_summary='$id_summary' ORDER BY d.id_summary";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}
    
    function prs() {
		$id_summary=$_GET['id_summary'];
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

    function totalcbm() {
		$id_summary=$_GET['id_summary'];
        global $conn;
        $sql    = "SELECT SUM(cbm) AS total_cbm FROM tb_packing_list a
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

    function totalcarton() {
		$id_summary=$_GET['id_summary'];
        global $conn;
        $sql    = "SELECT SUM(qty_prs) AS total_prs FROM tb_packing_list a
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
  
    function totalnw() {
		$id_summary=$_GET['id_summary'];
        global $conn;
        $sql    = "SELECT SUM(nw) AS total_nw FROM tb_packing_list a
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

    function totalgw() {
		$id_summary=$_GET['id_summary'];
        global $conn;
        $sql    = "SELECT SUM(gw) AS total_gw FROM tb_packing_list a
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

    function qty() {
		$idadd=$_GET['id_summary'];
        global $conn;
        $sql    = "SELECT SUM(prs_ctn) AS total_prs FROM tb_packing_list
                    WHERE id_add_packing = '$idadd'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result);
        mysqli_free_result($result);
        mysqli_close($conn);
    }

    function showData($id_summary) {
        global $conn;
        $fixid 	= mysqli_real_escape_string($conn, $id_summary);
        $sql 	= "SELECT tb_summery.*, tb_alamat.* FROM tb_summery
                    JOIN tb_alamat ON tb_summery.id_summary = tb_alamat.id_summary WHERE tb_alamat.id_summary='$fixid'";
        $result	= mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($conn);
        
	}

    function showFactory($id_summary) {
        global $conn;
        $fixid 	= mysqli_real_escape_string($conn, $id_summary);
        $sql 	= "SELECT factory_code FROM tb_summery WHERE id_summary='$fixid'";
        $result	= mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($conn);
        
	}

    function getsummary() {
        $id_summary=$_GET['id_summary'];
		global $conn;
		$sql 	= "SELECT * FROM tb_summery WHERE id_summary=$id_summary GROUP BY cust_id";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

    function getSize1() {
		$id_summary = $_GET['id_summary'];
		global $conn;
		$sql 	= "SELECT * FROM tb_packing_list a 
					LEFT JOIN tb_add_packing b ON a.id_add_packing = b.id_add_packing
					LEFT JOIN tb_summery c ON b.id_summary = c.id_summary
					LEFT JOIN tb_detail_master d ON a.id_detail = d.id_detail
					WHERE c.id_summary = '$id_summary' ORDER BY a.id_detail";
		$result	= mysqli_query($conn, $sql);
		return mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
	}

    function countData() {
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

    
?>