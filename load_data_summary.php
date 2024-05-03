<?php
require 'functions/koneksi.php';
$table = <<<EOT
 ( SELECT a.id_summary, a.prod_month, a.cust_id, a.man_po, a.cust_po, a.po_referance, a.factory_code, a.category, a.gender, a.color, a.widht, a.code, a.destination, a.price, a.xfd, a.date, a.realise, a.vendor_code, a.mode, a.si_date, b.sku
 FROM tb_summery AS a, tb_master AS b WHERE a.sku = b.sku) viewData
EOT;
$primaryKey = 'id_summary';
$columns = array(
	array('db' => 'prod_month', 'dt' => 0),
	array('db' => 'cust_id', 'dt' => 1),
	array('db' => 'man_po', 'dt' => 2),
	array('db' => 'cust_po', 'dt' => 3),
	array('db' => 'po_referance', 'dt' => 4),
	array('db' => 'factory_code', 'dt' => 5),
	array('db' => 'sku', 'dt' => 6),
	array('db' => 'category', 'dt' => 7),
	array('db' => 'gender', 'dt' => 8),
	array('db' => 'color', 'dt' => 9),
	array('db' => 'widht', 'dt' => 10),
	array('db' => 'code', 'dt' => 11),
	array('db' => 'destination', 'dt' => 12),
	array('db' => 'price', 'dt' => 13),
	array('db' => 'xfd', 'dt' => 14),
	array('db' => 'date', 'dt' => 15),
	array('db' => 'realise', 'dt' => 16),
	array('db' => 'vendor_code', 'dt' => 17),
	array('db' => 'mode', 'dt' => 18),
	array('db' => 'si_date', 'dt' => 19),
	array('db' => 'id_summary', 'dt' => 20),
);

// SQL server connection information
$sql_details = array(
	'user' => $uname,
	'pass' => $pass,
	'db'   => $db,
	'host' => $host
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require('ssp.class.php');
// require '../../config/ssp.class.php';
echo json_encode(
	SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
