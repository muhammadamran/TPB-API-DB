<?php
include "../../../include/connection.php";
include "../../../api.php";

$dataSetRealTime = $dbcon->query("SELECT * FROM tbl_realtime ORDER BY id DESC LIMIT 1");
$resultSetRealTime = mysqli_fetch_array($dataSetRealTime);
echo $SetTime = $resultSetRealTime['reload'];
