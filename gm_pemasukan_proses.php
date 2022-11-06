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

    $dataTable = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='$AJU' AND CHECKING IS NULL", 0);
    foreach ($dataTable as $rowLine) {
        if (@$rowLine['ID']) {
            $ID = $rowLine['ID'];

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
                $query .= $dbcon->query("UPDATE plb_barang SET STATUS='Sesuai',
                                                           OPERATOR_ONE='$meOK',
                                                           TGL_CEK='$InputDate',
                                                           CHECKING='DONE',
                                                           STATUS_CT='Complete',
                                                           DATE_CT='$InputDate',
                                                           TOTAL_BOTOL_AKHIR='$total_btl',
                                                           TOTAL_LITER_AKHIR='$total_ltr',
                                                           TOTAL_CT_AKHIR='$pcs',
                                                           BOTOL='$t_botol',
                                                           LITER='$t_liter',                                                      
                                                           NETTO_AKHIR='$total_netto'                                                      
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
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$AJU&AlertSimpan=Success';</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$AJU&AlertSimpan=Failed';</script>";
    }
}

if (isset($_GET["aksi"]) == 'SubmitCT') {
    $AJU            = $_GET['AJU'];
    $InputDate      = date('Y-m-d h:m:i');

    $dataTable = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='$AJU' AND CHECKING IS NULL", 0);
    if (mysqli_num_rows($dataTable) > 0) {
        while ($rowWhile = mysqli_fetch_array($dataTable)) {
            foreach ($rowWhile as $row) {
                if (@$row['ID']) {
                    $keyy      = @$row['ID'];

                    // CEK CT
                    $cekCT     = $dbcon->query("SELECT * FROM plb_barang_ct WHERE ID_BARANG='$keyy'");
                    $dataCT    = mysqli_fetch_array($cekCT);
                    if ($dataCT['ID_BARANG'] == NULL) {
                        $contentBarang   = $dbcon->query("SELECT * FROM plb_barang WHERE ID='$keyy'");
                        $dataBarang      = mysqli_fetch_array($contentBarang);
                        $jml_pcs         = $dataBarang['JUMLAH_SATUAN'];
                        $pcs             = str_replace(".0000", "", "$jml_pcs");
                        // TOTAL BOTOL
                        $botol           = explode('X', $dataBarang['UKURAN']);
                        $t_botol         = $botol[0];
                        // TOTAL LITER
                        $liter           =  $botol[1];
                        $r_liter         = str_replace(['LTR', 'LTr', 'Ltr', 'ltr'], ['', '', '', ''], $liter);
                        $t_liter         = str_replace(',', '.', $r_liter);

                        for ($i = 0; $i < $pcs; $i++) {
                            $query = $dbcon->query("INSERT INTO plb_barang_ct 
                            (ID,NOMOR_AJU,ID_BARANG,KODE_BARANG,TOTAL_BOTOL,TOTAL_LITER)
                            VALUES
                            ('','$dataBarang[NOMOR_AJU]','$keyy','$dataBarang[KODE_BARANG]','$t_botol','$t_liter')
                            ");
                        }
                        $query .= $dbcon->query("UPDATE plb_barang SET CHECKING='Checking Botol'
                                WHERE ID='$keyy'");

                        // FOR AKTIFITAS
                        $me         = $_SESSION['username'];
                        $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
                        $resultme   = mysqli_fetch_array($datame);

                        $IDUNIQme             = $resultme['USRIDUNIQ'];
                        $InputUsername        = $me;
                        $InputModul           = 'Gate In/Detail/CT';
                        $InputDescription     = $me . " Cek Barang Masuk: ID Barang Masuk" . @$_GET['ID_BARANG'];
                        $InputAction          = 'Cek Barang Masuk';
                        $InputDate            = date('Y-m-d h:m:i');

                        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

                        if ($query) {
                            echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=" . $_GET['AJU'] . "&AlertSimpan=Success'</script>";
                        } else {
                            echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=" . $_GET['AJU'] . "&AlertSimpan=Failed';</script>";
                        }
                    } else {
                        // Sudah Ada di plb_barang_ct
                        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=" . $_GET['AJU'] . "'</script>";
                    }
                }
            }
        }
        // CLOSE WHILE
    }
    // CLOSE IF MYSQLI ROW
}
