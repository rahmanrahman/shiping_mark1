<?php
require 'functions/koneksi.php';
$table = <<<EOT
 ( SELECT * FROM tb_booking) viewData
EOT;
$primaryKey = 'id_booking';
$columns = array(

	array( 'db' => 'shipto_booking', 'dt' => 0 ),
	array( 'db' => 'fd_booking', 'dt' => 1 ),
    array( 'db' => 'poe_booking', 'dt' => 2 ),
	array( 'db' => 'note_booking', 'dt' => 3 ),
    array( 'db' => 'id_booking', 'dt' => 4 )
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