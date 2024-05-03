<?php
require 'functions/koneksi.php';
$table = <<<EOT
(SELECT 
    a.id_summary, 
    a.prod_month, 
    a.cust_id, 
    a.man_po, 
    a.factory_code, 
    a.sku, 
    b.material_taking_out_date, 
    a.si_date, 
    CONCAT(
        IF(DATEDIFF(a.si_date, b.material_taking_out_date) = 0, 1, DATEDIFF(a.si_date, b.material_taking_out_date)),
        ' day'
    ) AS mlt
FROM 
    tb_summery AS a
JOIN 
    tb_taking_out_material AS b 
ON 
    a.factory_code = b.po_number AND a.prod_month = b.order_month
GROUP BY
    a.prod_month, a.factory_code    
) viewData
EOT;

$primaryKey = 'sku';
$columns = array(
    array('db' => 'prod_month', 'dt' => 0),
    array('db' => 'man_po', 'dt' => 1),
    array('db' => 'factory_code', 'dt' => 2),
    array('db' => 'sku', 'dt' => 3),
    array(
        'db' => 'material_taking_out_date', 'dt' => 4,
        'formatter' => function ($d, $row) {
            return date('d/m/Y', strtotime($d));
        }
    ),
    array(
        'db' => 'si_date',
        'dt' => 5
    ),
    array('db' => 'mlt', 'dt' => 6)
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
