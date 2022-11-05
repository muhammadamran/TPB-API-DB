<?php
// API
function get_content($URL)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $URL);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

$content = get_content('https://itinventory-sarinah.com/api/databases.php');
$data = json_decode($content, true);

foreach ($data['result'] as $row) {

    if ($data['status'] == 404) {
        echo $apiDB = 'tpbdb?';
    } else {
        echo $apiDB = $row['data'];
    }
}
