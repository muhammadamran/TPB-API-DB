<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";

if (isset($_GET["aksi"]) == 'SubmitCT') {
    $AJU            = $_GET['AJU'];
    $InputDate      = date('Y-m-d h:m:i');

    // // ID_BARANG
    // $ID                 = $row['ID'];
    // // <!-- PLB_BARANG_CT -->
    // $NOMOR_AJU          = $_POST['NOMOR_AJU'];
    // $KODE_BARANG        = $_POST['KODE_BARANG'];
    // // <!-- PLB_BARANG -->
    // // <!-- STATUS,OPERATOR_ONE,TGL_CEK -->
    // $STATUS             = $_POST['STATUS'];
    // $OPERATOR_ONE       = $_POST['OPERATOR_ONE'];
    // $TGL_CEK            = $_POST['TGL_CEK'];
    // $CHECKING           = $_POST['CHECKING'];
    // // <!-- STATUS_CT,DATE_CT,TOTAL_BOTOL_AKHIR,TOTAL_LITER_AKHIR,TOTAL_CT_AKHIR -->
    // $STATUS_CT          = $_POST['STATUS_CT'];
    // $DATE_CT            = $_POST['DATE_CT'];
    // $TOTAL_BOTOL        = $_POST['TOTAL_BOTOL'];
    // $TOTAL_BOTOL_AKHIR  = $_POST['TOTAL_BOTOL_AKHIR'];
    // $TOTAL_LITER        = $_POST['TOTAL_LITER'];
    // $TOTAL_LITER_AKHIR  = $_POST['TOTAL_LITER_AKHIR'];
    // $TOTAL_CT           = $_POST['TOTAL_CT'];
    // $TOTAL_CT_AKHIR     = $_POST['TOTAL_CT_AKHIR'];

    var_dump($AJU);

    $dataTable = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='$AJU' AND CHECKING IS NULL", 0);
    var_dump($dataTable);
    exit;
    if (mysqli_num_rows($dataTable) > 0) {
        while ($rowWhile = mysqli_fetch_array($dataTable)) {
            echo $rowWhile['ID'];
            var_dump($rowWhile['ID']);
            exit;
        }
        // CLOSE WHILE
    }
    // CLOSE IF MYSQLI ROW
}
