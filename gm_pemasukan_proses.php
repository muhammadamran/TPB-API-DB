<?php
include "include/connection.php";

$key = $_POST['CekBarang'];
foreach ($key as $row) {
    if (@$row['ID']) {
        // ID_BARANG
        $ID             = $row['ID'];
        var_dump($ID);
        exit;
        $NOMOR_AJU      = $row['NOMOR_AJU'];
        $KODE_BARANG    = $row['KODE_BARANG'];
        $STATUS         = $row['STATUS'];
        $OPERATOR_ONE   = $row['OPERATOR_ONE'];
        $TGL_CEK = $row['TGL_CEK'];
        $CHECKING = $row['CHECKING'];
        $meOK         = $_SESSION['username'];

        $STATUS_CT = $row['STATUS_CT'];
        $DATE_CT = $row['DATE_CT'];
        $TOTAL_BOTOL = $row['TOTAL_BOTOL'];
        $TOTAL_BOTOL_AKHIR = $row['TOTAL_BOTOL_AKHIR'];
        $TOTAL_LITER = $row['TOTAL_LITER'];
        $TOTAL_LITER_AKHIR = $row['TOTAL_LITER_AKHIR'];
        $TOTAL_CT = $row['TOTAL_CT'];
        $TOTAL_CT_AKHIR = $row['TOTAL_CT_AKHIR'];

        $sql = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='$NOMOR_AJU'");
        if (mysqli_num_rows($dataTable) > 0) {
            while ($row = mysqli_fetch_array($dataTable)) {

                $sql = $dbcon->query("SELECT * FROM plb_barang WHERE ID='$row[ID]'");
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

                if ($dataCT['ID_BARANG'] == NULL) {

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
                                                  BOTOL='$A_BOTOL',
                                                  TOTAL_BOTOL_AKHIR='$TOTAL_BOTOL',
                                                  LITER='$A_LITER',
                                                  TOTAL_LITER_AKHIR='$TOTAL_LITER',
                                                  TOTAL_CT_AKHIR='$TOTAL_CT'
                            WHERE ID='$ID'");

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
                }
            }
            if ($query) {
                echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertBroken=Success';</script>";
            } else {
                echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID_BARANG&Alert=CekBarangMasuk&AJU=$NOMOR_AJU&AlertBroken=Failed';</script>";
            }
        }
    }
}
