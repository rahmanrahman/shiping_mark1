<?php
include "functions/koneksi.php";
$sku = $_GET['sku'];
$id_detail = $_POST['id_detail'];
$query = "DELETE FROM tb_detail_master WHERE id_detail IN(".implode(",", $id_detail).")";
$sql = $pdo->prepare($query);
$sql->execute(); 
header("location: detail_master.php?sku=".$sku); 
?>