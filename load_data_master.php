<?php
require 'functions/koneksi.php';
$table = <<<EOT
 ( SELECT * FROM tb_master ) viewData
EOT;
$primaryKey = 'sku';
$a = "hai";
$columns = array(

	array( 'db' => 'sku', 'dt' => 0 ),
	array( 'db' => 'sku', 'dt' => 1 )
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