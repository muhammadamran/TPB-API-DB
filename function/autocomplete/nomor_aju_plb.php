<?php
// Server Prod
$dbhost = 'localhost';
$dbusername = 'inxmiles_tpb';
$dbpassword = 'Flatrone2241TPB';
$dbname = 'inxmiles_tpb';
$dbcon = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die(mysqli_connect_errno());

// QUERY SETTING API
$dataAPI = $dbcon->query("SELECT * FROM api ORDER BY id ASC LIMIT 1");
$resultAPI = mysqli_fetch_array($dataAPI);

// API
function get_content($URL)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $URL);
    // curl_setopt($ch, CURLOPT_PORT, 8091);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

$content = get_content($resultAPI['url_api'] . 'gmBarangMasuk.php?function=get_auto_noAJU');
$data = json_decode($content, true);

foreach ($data['result'] as $row) {
    $row['NOMOR_AJU'];
}
echo json_encode($row['NOMOR_AJU']);
