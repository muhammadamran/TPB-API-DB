<?php
// include "include/connection.php";
class Library
{
    public function __construct()
    {
        $host       = "localhost";
        $dbname     = "inxmiles_tpb";
        $username   = "inxmiles_tpb";
        $password   = "Flatrone2241TPB";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
    }

    public function update_trn($table, $dataUpdate, $ID)
    {

        $this->db->where('ID', $ID);
        $this->db->update($table, $dataUpdate);
    }
}

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

        $CHE = $dbcon->query('UPDATE plb_barang SET', $dataUpdate, $ID);
    }
}

var_dump($CHE);
exit;
