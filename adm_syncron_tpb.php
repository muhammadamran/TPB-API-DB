<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
// API
include "include/api.php";
// GET BC 2.7
$contentBC      = get_content($resultAPI['url_api'] . 'dataBC27.php');
$dataBC         = json_decode($contentBC, true);
// HEADER
$contentHDR     = get_content($resultAPI['url_api'] . 'dataTPB.php?function=get_Header');
$dataHRD        = json_decode($contentHDR, true);

foreach ($dataBC['result'] as $rowBC) {
    $NOMOR_AJU = $rowBC['NOMOR_AJU'];
}
