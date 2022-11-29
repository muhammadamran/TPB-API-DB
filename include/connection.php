<?php
// Server Prod
$dbhost = 'localhost';
// DOMAIN
$dbusername = 'inxmiles_tpb';
$dbpassword = 'Flatrone2241TPB';
$dbname = 'inxmiles_tpb';

// LOCAL
// $dbusername = 'root';
// $dbpassword = '';
// $dbname = 'tpb';
$dbcon = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die(mysqli_connect_errno());

// QUERY SETTING API
$dataAPI = $dbcon->query("SELECT * FROM api ORDER BY id ASC LIMIT 1");
$resultAPI = mysqli_fetch_array($dataAPI);
// QUERY SETTING 
$dataHeadSettting = $dbcon->query("SELECT * FROM tbl_setting");
$resultHeadSetting = mysqli_fetch_array($dataHeadSettting);
// QUERY REAL TIME
$dataSetRealTime = $dbcon->query("SELECT * FROM tbl_realtime ORDER BY id DESC LIMIT 1");
$resultSetRealTime = mysqli_fetch_array($dataSetRealTime);
$SetTime = $resultSetRealTime['reload'];
