<?php
include "../../../include/connection.php";
include "../../../include/api.php";

$dataSetRealTime = $dbcon->query("SELECT * FROM tbl_realtime ORDER BY id DESC LIMIT 1");
$resultSetRealTime = mysqli_fetch_array($dataSetRealTime);
echo $SetTime = $resultSetRealTime['reload'];

$content = get_content($resultAPI['url_api'] . 'gmBarangMasuk.php?function=get_auto_noAJU');
$data = json_decode($content, true);

var_dump($data);
exit;
