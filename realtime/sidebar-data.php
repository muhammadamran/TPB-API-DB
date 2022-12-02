<?php
include "../include/connection.php";
if (function_exists($_GET['function'])) {
    $_GET['function']();
}

// TOTAL GATE IN
function GateIn()
{
    global $dbcon;
    $gate_in = $dbcon->query("SELECT COUNT(*) AS total_in FROM plb_header AS hdr LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb WHERE rcd.upload_beritaAcara_PLB IS NULL");
    $result_in = mysqli_fetch_array($gate_in);
    echo $result_in['total_in'];
}

// TOTAL GATE OUT
function GateOut()
{
    global $dbcon;
    $gate_out = $dbcon->query("SELECT COUNT(*) AS total_out FROM plb_header AS hdr LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb WHERE rcd.upload_beritaAcara_PLB IS NOT NULL AND rcd.upload_beritaAcara_GB IS NULL");
    $result_out = mysqli_fetch_array($gate_out);
    echo $result_out['total_out'];
}
