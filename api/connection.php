<?php
// Server Prod
$dbhost = 'localhost';
// // DOMAIN
// $dbusername = 'inxmiles_tpb';
// $dbpassword = 'Flatrone2241TPB';
// $dbname = 'inxmiles_tpb';

// LOCAL
$dbusername = 'root';
$dbpassword = '';
$dbname = 'tpb';
$dbcon = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die(mysqli_connect_errno());
