<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";

if (isset($_GET["aksi"]) == 'SubmitCT') {
    $NOMOR_AJU      = $_GET['AJU'];
    $meOK           = $_SESSION['username'];
    $InputDate      = date('Y-m-d h:m:i');

    $dataTable = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND CHECKING IS NULL");
    if (mysqli_num_rows($dataTable) > 0) {
        while ($row = mysqli_fetch_array($dataTable)) {

            $sql    = $dbcon->query("SELECT * FROM plb_barang WHERE ID='$row[ID]'");
            $row_ct = mysqli_fetch_array($sql);
            $jml_pcs         = $row_ct['JUMLAH_SATUAN'];
            $pcs             = str_replace(".0000", "", "$jml_pcs");
            // TOTAL BOTOL
            $botol           = explode('X', $row_ct['UKURAN']);
            $t_botol         = $botol[0];
            // TOTAL LITER
            $liter           =  $botol[1];
            $r_liter         = str_replace(['LTR', 'LTr', 'Ltr', 'ltr'], ['', '', '', ''], $liter);
            $t_liter         = str_replace(',', '.', $r_liter);

            // TOTAL BOTOL AKHIR (BOTOL * CT)
            $tb_a = $tb_a * $pcs;
            // TOTAL LITER AKHIR (TOTAL BOTOL * LITER)
            $tb_a = $tb_a * $pcs;
            // TOTAL CT


            if ($row_ct['ID_BARANG'] == NULL) {
                // INSERT TO PLB_BARANG_CT
                for ($i = 0; $i < $pcs; $i++) {

                    $query = $dbcon->query("INSERT INTO plb_barang_ct 
                            (ID,NOMOR_AJU,ID_BARANG,KODE_BARANG,TOTAL_BOTOL,TOTAL_LITER)
                            VALUES
                            ('','$row_ct[NOMOR_AJU]','$keyy','$row_ct[KODE_BARANG]','$t_botol','$t_liter')
                            ");
                }

                $query .= $dbcon->query("UPDATE plb_barang SET STATUS='Sesuai',
                                                  OPERATOR_ONE='$meOK',
                                                  TGL_CEK='$InputDate',
                                                  CHECKING='DONE',
                                                  STATUS_CT='Complete',
                                                  DATE_CT='$InputDate',
                                                  BOTOL='$t_botol',
                                                  TOTAL_BOTOL_AKHIR='$TOTAL_BOTOL_AKHIR',
                                                  LITER='$t_liter',
                                                  TOTAL_LITER_AKHIR='$TOTAL_LITER_AKHIR',
                                                  TOTAL_CT_AKHIR='$TOTAL_CT'
                            WHERE ID='$ID'");

                // FOR AKTIFITAS
                $me         = $_SESSION['username'];
                $datame     = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
                $resultme   = mysqli_fetch_array($datame);

                $IDUNIQme             = $resultme['USRIDUNIQ'];
                $InputUsername        = $me;
                $InputModul           = 'Gate In/Detail/CT';
                $InputDescription     = $me . " Simpan Data Barang Masuk: Semua Sesuai";
                $InputAction          = 'Simpan Barang Masuk';
                $InputDate            = date('Y-m-d h:m:i');

                $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

                if ($query) {
                    echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$NOMOR_AJU&AlertSimpan=Success';</script>";
                } else {
                    echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$NOMOR_AJU&AlertSimpan=Failed';</script>";
                }
            } else {
                echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$NOMOR_AJU&AlertSimpan=Success';</script>";
            }
        }
    }
}
