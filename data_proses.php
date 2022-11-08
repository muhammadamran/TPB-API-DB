<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";

if (isset($_GET["a"]) == 'delete' && isset($_GET["m"]) == 'report_ck5_plb') {
    $NOMOR_AJU  = $_GET['NOMOR_AJU'];
    // plb_header
    $query      = $db->query('DELETE FROM plb_header WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_bahanbaku
    $query      .= $db->query('DELETE FROM plb_bahanbaku WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_bahanbakudokumen
    $query      .= $db->query('DELETE FROM plb_bahanbakudokumen WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_bahanbakutarif
    $query      .= $db->query('DELETE FROM plb_bahanbakutarif WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_barang
    $query      .= $db->query('DELETE FROM plb_barang WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_barang_ct
    $query      .= $db->query('DELETE FROM plb_barang_ct WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_barang_ct_botol
    $query      .= $db->query('DELETE FROM plb_barang_ct_botol WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_barangdokumen
    $query      .= $db->query('DELETE FROM plb_barangdokumen WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_barangtarif
    $query      .= $db->query('DELETE FROM plb_barangtarif WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_dokumen
    $query      .= $db->query('DELETE FROM plb_dokumen WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_kemasan
    $query      .= $db->query('DELETE FROM plb_kemasan WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_kontainer
    $query      .= $db->query('DELETE FROM plb_kontainer WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_respon
    $query      .= $db->query('DELETE FROM plb_respon WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_status
    $query      .= $db->query('DELETE FROM plb_status WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_update_log
    $query      .= $db->query('DELETE FROM plb_update_log WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');

    if ($query) {
        echo "<script>window.location.href='report_ck5_plb.php?SaveSuccess=true;</script>";
    } else {
        echo "<script>window.location.href='report_ck5_plb.php?SaveFailed=true;</script>";
    }
}
