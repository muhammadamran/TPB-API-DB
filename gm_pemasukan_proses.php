<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";

if (isset($_GET["aksi"]) == 'SubmitCTT') {

    // $arr = $_POST['chk_id'];
    // foreach ($arr as $id) {
    // $query = mysql_query("DELETE FROM tb_user WHERE user_id='$id'");
    // }

    $AJU            = $_GET['AJU'];
    $InputDate      = date('Y-m-d h:m:i');
    $meOK           = $_SESSION['username'];

    $dataTable = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='$AJU' AND CHECKING IS NULL", 0);
    if (mysqli_num_rows($dataTable) > 0) {
        while ($rowWhile = mysqli_fetch_array($dataTable)) {

            $arr = $rowWhile['ID'];
            foreach ($arr as $ID) {

                $contentBarang   = $dbcon->query("SELECT * FROM plb_barang WHERE ID='$ID'");
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

                $query = $dbcon->query("UPDATE plb_barang SET STATUS='Sesuai',
                                                           OPERATOR_ONE='$meOK',
                                                           TGL_CEK='$InputDate',
                                                           CHECKING='DONE',
                                                           STATUS_CT='Complete',
                                                           DATE_CT='$InputDate',
                                                           TOTAL_BOTOL='$t_botol',
                                                           TOTAL_BOTOL_AKHIR='Complete',
                                                           TOTAL_LITER='$t_liter',
                                                           TOTAL_LITER_AKHIR='Complete',
                                                           TOTAL_CT_AKHIR='$pcs'
                                     WHERE NOMOR_AJU='$AJU' AND CHECKING IS NULL");
            }
        }
        if ($query) {
            echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$AJU&AlertSimpan=Success';</script>";
        } else {
            echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$AJU&AlertSimpan=Failed';</script>";
        }
    }
}

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
