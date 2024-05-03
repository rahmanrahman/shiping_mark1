<?php
require 'functions/koneksi.php';
$table = <<<EOT
 ( SELECT a.id_add_packing, b.factory_code, c.sku, b.prod_month FROM tb_add_packing AS a, tb_summery AS b, tb_master AS c WHERE a.id_summary = b.id_summary AND b.sku = c.sku ) viewData
EOT;

$primaryKey = 'id_add_packing';
$columns = array(
	array( 'db' => 'prod_month', 'dt' => 0 ),
	array( 'db' => 'factory_code', 'dt' => 1 ),
	array( 'db' => 'sku', 'dt' => 2 ),
	array( 'db' => 'id_add_packing', 'dt' => 3 )
	
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