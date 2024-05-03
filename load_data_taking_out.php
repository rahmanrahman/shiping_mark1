<?php
require 'functions/koneksi.php';
$table = <<<EOT
(SELECT t.material_taking_out_date, t.id_taking_out_material, t.order_month, t.po_number, s.man_po, s.sku, t.material_code FROM tb_taking_out_material AS t INNER JOIN tb_summery AS s ON t.order_month=s.prod_month AND t.po_number=s.factory_code ORDER BY t.material_taking_out_date) viewData
EOT;

$primaryKey = 'id_taking_out_material';
$columns = array(
    array('db' => 'order_month', 'dt' => 0),
    array('db' => 'po_number', 'dt' => 1),
    array('db' => 'man_po', 'dt' => 2),
    array('db' => 'sku', 'dt' => 3),
    array('db' => 'material_code', 'dt' => 4),
    array('db' => 'material_taking_out_date', 'dt' => 5)
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
