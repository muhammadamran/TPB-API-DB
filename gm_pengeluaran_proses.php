<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";

if (isset($_GET["aksi"]) == 'SubmitCTT') {
    $AJU            = $_GET['AJU'];
    $InputDate      = date('Y-m-d h:m:i');
    $meOK           = $_SESSION['username'];

    $dataTable = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='$AJU' AND CHECKING_GB IS NULL", 0);
    foreach ($dataTable as $rowLine) {
        if (@$rowLine['ID']) {
            $ID = $rowLine['ID'];
            var_dump($ID);
            exit;
            // CEK CT
            $cekCT     = $dbcon->query("SELECT * FROM plb_barang_ct WHERE ID_BARANG='$ID'");
            $dataCT    = mysqli_fetch_array($cekCT);

            if ($dataCT['ID_BARANG'] == NULL) {
                $contentBarang   = $dbcon->query("SELECT * FROM plb_barang WHERE ID='$ID'");
                $dataBarang      = mysqli_fetch_array($contentBarang);
                $jml_pcs         = $dataBarang['JUMLAH_SATUAN'];
                $pcs             = str_replace(".0000", "", "$jml_pcs");
                // BOTOL
                $botol           = explode('X', $dataBarang['UKURAN']);
                $t_botol         = $botol[0];
                // LITER
                $liter           =  $botol[1];
                $r_liter         = str_replace(['LTR', 'LTr', 'Ltr', 'ltr'], ['', '', '', ''], $liter);
                $t_liter         = str_replace(',', '.', $r_liter);
                // TOTAL BOTOL
                $total_btl = $t_botol * $pcs;
                // TOTAL NETTO
                $total_netto = $t_botol * $t_liter * $total_btl;
                // TOTAL LITER
                $total_ltr = $t_liter * $total_btl;

                for ($i = 0; $i < $pcs; $i++) {
                    $query = $dbcon->query("INSERT INTO plb_barang_ct 
                                    (ID,NOMOR_AJU,ID_BARANG,KODE_BARANG,TOTAL_BOTOL,LITER,TOTAL_LITER)
                                    VALUES
                                    ('','$dataBarang[NOMOR_AJU]','$ID','$dataBarang[KODE_BARANG]','$t_botol','$t_liter','$total_ltr')
                                    ");
                }

                $query .= $dbcon->query("UPDATE plb_barang SET STATUS_GB='Sesuai'                                                     
                                     WHERE NOMOR_AJU='$AJU' AND ID='$ID'");

                // FOR AKTIFITAS
                $me         = $_SESSION['username'];
                $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
                $resultme   = mysqli_fetch_array($datame);

                $IDUNIQme             = $resultme['USRIDUNIQ'];
                $InputUsername        = $me;
                $InputModul           = 'Gate In/Detail/CT';
                $InputDescription     = $me . " Cek Barang Masuk: ID Barang Masuk" . @$_GET['ID_BARANG'];
                $InputAction          = 'Simpan Barang Masuk';
                $InputDate            = date('Y-m-d h:m:i');

                $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");
            }
        }
    }
    if ($query) {
        echo "<script>window.location.href='gm_pengeluaran_detail.php?AJU=$AJU&AlertSimpan=Success';</script>";
    } else {
        echo "<script>window.location.href='gm_pengeluaran_detail.php?AJU=$AJU&AlertSimpan=Failed';</script>";
    }
}
