<?php
require 'functions/koneksi.php';
$table = <<<EOT
 ( SELECT a.id_grade, a.category, a.date, b.factory_code, b.prod_month FROM tb_grade AS a, tb_summery AS b WHERE a.id_summary = b.id_summary) viewData
EOT;

$primaryKey = 'id_grade';
$columns = array(
	array( 'db' => 'prod_month', 'dt' => 0 ),
	array( 'db' => 'factory_code', 'dt' => 1 ),
	array( 'db' => 'category', 'dt' => 2 ),
	array( 'db' => 'date', 'dt' => 3 ),
    array( 'db' => 'id_grade', 'dt' => 4 )
	
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