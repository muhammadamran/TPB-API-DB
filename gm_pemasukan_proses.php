<?php
include "include/connection.php";

$key = $_POST['CekBarang'];
foreach ($key as $row) {
    if (@$row['ID']) {
        $ID = $row['ID'];
        $NOMOR_AJU = $row['NOMOR_AJU'];
        $KODE_BARANG = $row['KODE_BARANG'];
        $TOTAL_BOTOL = $row['TOTAL_BOTOL'];
        $TOTAL_LITER = $row['TOTAL_LITER'];
        $STATUS = $row['STATUS'];
        $OPERATOR_ONE = $row['OPERATOR_ONE'];
        $TGL_CEK = $row['TGL_CEK'];
        $CHECKING = $row['CHECKING'];

        $dataUpdate = array(
            'STATUS' => $row['STATUS'],
            'OPERATOR_ONE' => $row['OPERATOR_ONE'],
            'TGL_CEK' => $row['TGL_CEK'],
            'CHECKING' => $row['CHECKING']
        );

        $CHE = $dbcon->query("UPDATE plb_barang SET STATUS='$STATUS',
                                                    OPERATOR_ONE='$OPERATOR_ONE',
                                                    TGL_CEK='$TGL_CEK',
                                                    CHECKING='$CHECKING'
                              WHERE ID='$ID'");
    }
}
