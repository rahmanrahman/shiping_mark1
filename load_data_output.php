<?php
require 'functions/koneksi.php';
$table = <<<EOT
 ( SELECT a.id_add_packing, b.factory_code, b.prod_month, c.sku, d.packing_metode1, b.id_summary, b.code, b.cust_id, b.destination FROM tb_add_packing AS a, tb_summery AS b, tb_master AS c, tb_packing_list AS d WHERE a.id_summary = b.id_summary AND b.sku = c.sku AND a.id_add_packing = d.id_add_packing GROUP BY b.id_summary ASC) viewData
EOT;

$primaryKey = 'id_summary';
$columns = array(
	array( 'db' => 'prod_month', 'dt' => 0 ),
	array( 'db' => 'factory_code', 'dt' => 1 ),
	array( 'db' => 'sku', 'dt' => 2 ),
	array( 'db' => 'packing_metode1', 'dt' => 3 ),
	array( 'db' => 'id_summary', 'dt' => 4 ),
	array( 'db' => 'cust_id', 'dt' => 5 ),
	array( 'db' => 'destination', 'dt' => 6 ),
	array( 'db' => 'code', 'dt' => 7 )

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

require( 'ssp.class.php' );
// require '../../config/ssp.class.php';
echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

?>