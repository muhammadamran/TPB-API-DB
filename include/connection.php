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