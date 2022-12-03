<?php
// Server Prod
include "../../include/connection.php";

if (function_exists($_GET['function'])) {
    $_GET['function']();
}

function supplier()
{
    global $dbcon;
    $searchTerm = $_GET['term'];
    $sql = $dbcon->query("SELECT NAMA_PENERIMA_BARANG FROM tpb_header  WHERE NAMA_PENERIMA_BARANG LIKE '%" . $searchTerm . "%' GROUP BY NAMA_PENERIMA_BARANG ORDER BY ID ASC");
    while ($row = mysqli_fetch_array($sql)) {
        $data[] = $row['NAMA_PENERIMA_BARANG'];
    }

    $check = json_encode($data);

    if ($check == null || $check == 'null') {
        $data = 'Tidak ada Nomor Pengajuan GB';
    } else {
        echo json_encode($data);
    }
}

function kd_negara()
{
    global $dbcon;
    $searchTerm = $_GET['term'];
    $sql = $dbcon->query("SELECT KODE_NEGARA_PEMASOK FROM tpb_header  WHERE KODE_NEGARA_PEMASOK LIKE '%" . $searchTerm . "%' GROUP BY KODE_NEGARA_PEMASOK ORDER BY ID ASC");
    while ($row = mysqli_fetch_array($sql)) {
        $data[] = $row['KODE_NEGARA_PEMASOK'];
    }

    $check = json_encode($data);

    if ($check == null || $check == 'null') {
        $data = 'Tidak ada Nomor Pengajuan GB';
    } else {
        echo json_encode($data);
    }
}

function nm_negara()
{
    global $dbcon;
    $searchTerm = $_GET['term'];
    $sql = $dbcon->query("SELECT URAIAN_NEGARA FROM referensi_negara  WHERE URAIAN_NEGARA LIKE '%" . $searchTerm . "%'  ORDER BY ID ASC");
    while ($row = mysqli_fetch_array($sql)) {
        $data[] = $row['URAIAN_NEGARA'];
    }

    $check = json_encode($data);

    if ($check == null || $check == 'null') {
        $data = 'Tidak ada Nomor Pengajuan GB';
    } else {
        echo json_encode($data);
    }
}

function mata_uang()
{
    global $dbcon;
    $searchTerm = $_GET['term'];
    $sql = $dbcon->query("SELECT KODE_VALUTA FROM tpb_header  WHERE KODE_VALUTA LIKE '%" . $searchTerm . "%' GROUP BY KODE_VALUTA ORDER BY ID ASC");
    while ($row = mysqli_fetch_array($sql)) {
        $data[] = $row['KODE_VALUTA'];
    }

    $check = json_encode($data);

    if ($check == null || $check == 'null') {
        $data = 'Tidak ada Nomor Pengajuan GB';
    } else {
        echo json_encode($data);
    }
}
