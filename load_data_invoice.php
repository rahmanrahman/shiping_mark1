<?php
require 'functions/koneksi.php';
$table = <<<EOT
 ( SELECT * FROM tb_invoice ) viewData
EOT;
$primaryKey = 'invoice_no';
$columns = array(

	array( 'db' => 'invoice_no', 'dt' => 0 ),
	array( 'db' => 'tanggal', 'dt' => 1 ),
    array( 'db' => 'payment_term', 'dt' => 2 ),
	array( 'db' => 'id_invoice', 'dt' => 3 )
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