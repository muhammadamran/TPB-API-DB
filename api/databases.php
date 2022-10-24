<?php
$dbhost = 'localhost';
$dbusername = 'inxmiles_tpb';
$dbpassword = 'Flatrone2241TPB';
$dbname = 'inxmiles_tpb';
$dbcon = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die(mysqli_connect_errno());

$dataDB = $dbcon->query("SELECT * FROM api WHERE id=1 LIMIT 1", 0);
$cek = $dataDB->num_rows;

if ($cek > 0) {
    $data = [];

    while ($result = $dataDB->fetch_assoc()) {
        $data[] = [
            'data' => $result['database_module']
        ];
    }

    echo json_encode([
        'status' => 200,
        'result' => $data
    ]);
} else {
    echo json_encode([
        'status' => 404,
        'result' => 'Data not found'
    ]);
}