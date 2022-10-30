<?php
include "include/connection.php";

$key = $_POST['CekBarang'];
foreach ($key as $row) {
    $ID             = $row['ID'];
    $NOMOR_AJU      = $row['NOMOR_AJU'];
    $KODE_BARANG    = $row['KODE_BARANG'];
    $STATUS         = $row['STATUS'];
    $OPERATOR_ONE   = $row['OPERATOR_ONE'];
    $TGL_CEK = $row['TGL_CEK'];
    $CHECKING = $row['CHECKING'];

    $sql = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='$NOMOR_AJU'");

    $STATUS_CT = $row['STATUS_CT'];
    $DATE_CT = $row['DATE_CT'];
    $TOTAL_BOTOL = $row['TOTAL_BOTOL'];
    $TOTAL_BOTOL_AKHIR = $row['TOTAL_BOTOL_AKHIR'];
    $TOTAL_LITER = $row['TOTAL_LITER'];
    $TOTAL_LITER_AKHIR = $row['TOTAL_LITER_AKHIR'];
    $TOTAL_CT = $row['TOTAL_CT'];
    $TOTAL_CT_AKHIR = $row['TOTAL_CT_AKHIR'];
}

$update = $dbcon->query("UPDATE plb_barang SET STATUS='$STATUS',
                                               OPERATOR_ONE='$OPERATOR_ONE',
                                               TGL_CEK='$TGL_CEK',
                                               OPERATOR_ONE='$OPERATOR_ONE',
                                               CHECKING='$CHECKING'
                                            WHERE NOMOR_AJU='$NOMOR_AJU'");


if ($update) {

    $contentBarang = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='$NOMOR_AJU'");
    $dataBarang    = mysqli_fetch_array($contentBarang);
    $jml_pcs = $dataBarang['JUMLAH_SATUAN'];
    $pcs = str_replace(".0000", "", "$jml_pcs");

    // TOTAL BOTOL
    $botol = explode('X', $dataBarang['UKURAN']);
    $t_botol = $botol[0];
    // TOTAL LITER
    $liter =  $botol[1];
    $r_liter = str_replace(['LTR', 'LTr', 'Ltr', 'ltr'], ['', '', '', ''], $liter);
    $t_liter = str_replace(',', '.', $r_liter);

    for ($i = 0; $i < $pcs; $i++) {
        $sql = $dbcon->query("INSERT INTO plb_barang_ct 
                            (ID,NOMOR_AJU,ID_BARANG,KODE_BARANG,TOTAL_BOTOL,TOTAL_LITER)
                            VALUES
                            ('','$dataBarang[NOMOR_AJU]','$ID','$dataBarang[KODE_BARANG]','$t_botol','$t_liter')
                            ");
    }

    if ($sql) {
        echo "<script>window.location.href='gm_pemasukan_ct.php?ID=$ID';'_blank'</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_ct.php?InputIconFailed=true';</script>";
    }

    echo "<script>window.location.href='gm_pemasukan_detail.php?ID=$NOMOR_AJU';'_blank'</script>";
} else {
    echo "<script>window.location.href='gm_pemasukan_detail.php?ID=$NOMOR_AJU'?status=error;'_blank'</script>";
}
