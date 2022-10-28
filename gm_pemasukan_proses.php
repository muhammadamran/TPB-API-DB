<?php
include "include/connection.php";

$key = $_POST['CekBarang'];
var_dump(@$row['PengajuanID']);
exit;
foreach ($key as $row) {
    if (@$row['PengajuanID']) {
        // TABEL simak_trn_pengajuan
        $PengajuanID = $row['PengajuanID'];
        $dataUpdate = array(
            'app_BAUK' => '10',
            'Date_app_BAUK' => date('Y-m-d h:m:i'),
            'status' => 'Terima BAUK - Generate VA - Pengajuan Mengulang Reguler',
            'proses' => 'Terima BAUK - Generate VA',
            'submit' => 'Terima BAUK - Generate VA',
            'VA' => $row['VA']
        );

        // TABEL simak_trn_log
        $dataLog = array(
            'user_name' => $this->session->userdata('user_name'),
            'transaksi' => 'Terima - BAUK - Generate VA - Pengajuan Mengulang Reguler ' . $row['MhswID'] . '-' . $row['NamaMhsw'],
            'modul' => 'Mengulang Reguler',
            'created_date' => date('Y-m-d h:m:i')
        );

        $this->Pengajuan_model->update_trn('simak_trn_pengajuan', $dataUpdate, $PengajuanID);
        $this->db->insert('simak_trn_log', $dataLog);
    }
}
