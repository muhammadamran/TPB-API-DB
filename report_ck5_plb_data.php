<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
// API - 
include "include/api.php";
// HEADER
$contentHeader = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_Header');
$dataHeader = json_decode($contentHeader, true);
// BAHAN BAKU
$contentBahanBaku = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_BahanBaku');
$dataBahanBaku = json_decode($contentBahanBaku, true);
// BAHAN BAKU TARIF
$contentBahanBakuTarif = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_BahanBakuTarif');
$dataBahanBakuTarif = json_decode($contentBahanBakuTarif, true);
// BAHAN BAKU DOKUMEN
$contentBahanBakuDokumen = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_BahanBakuDokumen');
$dataBahanBakuDokumen = json_decode($contentBahanBakuDokumen, true);
// BARANG
$contentBarang = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_Barang');
$dataBarang = json_decode($contentBarang, true);
// BARANG TARIF
$contentBarangTarif = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_BarangTarif');
$dataBarangTarif = json_decode($contentBarangTarif, true);
// BARANG DOKUMEN
$contentBarangDokumen = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_BarangDokumen');
$dataBarangDokumen = json_decode($contentBarangDokumen, true);
// DOKUMEN
$contentDokumen = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_Dokumen');
$dataDokumen = json_decode($contentDokumen, true);
// KEMASAN
$contentKemasan = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_Kemasan');
$dataKemasan = json_decode($contentKemasan, true);
// KONTAINER
$contentKontainer = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_Kontainer');
$dataKontainer = json_decode($contentKontainer, true);
// RESPON
$contentRespon = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_Respon');
$dataRespon = json_decode($contentRespon, true);
// STATUS
$contentStatus = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_Status');
$dataStatus = json_decode($contentStatus, true);
// LOG
$contentLog = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_Log');
$dataLog = json_decode($contentLog, true);
// LOG UPLOAD
$contentLogUpload = get_content($resultAPI['url_api'] . 'reportCK5PLB.php?function=get_LogUpload');
$dataLogUpload = json_decode($contentLogUpload, true);
?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-desktop icon-page"></i>
                <font class="text-page">CK5 / PLB REPORT</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Report</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">CK5</a></li>
                <li class="breadcrumb-item active">PLB Records</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin row -->
    <style>
    .panel {
        margin-bottom: 12px;
        background: #fff;
        border: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    #id-fr {
        background: linear-gradient(45deg, #00acac, #8753de);
        border-radius: 5px;
        /* margin-right: -10px; */
        margin-bottom: 10px;
        padding: 15px;
        font-size: 60px;
        display: grid;
        justify-content: center;
        align-content: center;
        color: #fff;
    }

    #id-fl {
        background: #fff;
        border-radius: 5px;
        /* margin-left: -10px; */
        margin-bottom: 10px;
        padding: 15px;
        font-size: 60px;
        display: grid;
        justify-content: center;
        align-content: center;
        color: #1d2226;
    }
    </style>
    <div class="row">
        <div class="col-xl-6">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <a href="https://itinventory-sarinah.com/report_ck5_plb_data.php" id="id-fr">
                    <i class="fa-solid fa-table"></i>
                    <font style="font-size: 9px; margin-top: 9px">Data CK5 PLB</font>
                </a>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <a href="http://plb.itinventory-sarinah.com:8091/report_ck5_plb.php" id="id-fl">
                    <i class="fa-solid fa-upload"></i>
                    <font style="font-size: 8px; margin-top: 10px">Upload CK5 PLB</font>
                </a>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> CK5 - PLB / Master Data</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div style="display: flex;justify-content: end;margin-bottom: 10px;position: static;">
                        <a href="#baca-panduan-ck5plb" class="btn btn-inverse" data-toggle="modal"><i
                                class="fas fa-book"></i> Baca Panduan</a>
                    </div>
                    <?php include "panduan/panduan_ck5_plb.php"; ?>
                    <div class="line-page-table"></div>
                    <!-- Alert -->
                    <?php if ($dataLogUpload['status'] == 404) { ?>
                    <tr>
                        <td colspan="8">
                            <center>
                                <div style="display: grid;">
                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                </div>
                            </center>
                        </td>
                    </tr>
                    <?php } else { ?>
                    <?php foreach ($dataLogUpload['result'] as $rowLogUpload) { ?>
                    <?php if ($rowLogUpload['username'] != NULL) { ?>
                    <div class="note note-default">
                        <div class="note-icon"><i class="fas fa-history"></i></div>
                        <div class="note-content">
                            <h4><b>Informasi File Upload Excel CK5 PLB!</b></h4>
                            <hr>
                            <p style="display: grid;">
                                <font>Terakhir diupload oleh: <?= $rowLogUpload['username']; ?></font>
                                <font>DateTime upload: <?= $rowLogUpload['dateupload']; ?></font>
                                <font>Nama File: <?= $rowLogUpload['filename']; ?></font>
                                <font>Total Data: <?= decimal($rowLogUpload['totalupload']); ?></font>
                                <font>Status: <?= $rowLogUpload['status']; ?></font>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                    <!-- End Alert -->

                    <!-- Menu -->
                    <ul class="nav nav-pills mb-2">
                        <li class="nav-item">
                            <a href="#IDHeader" data-toggle="tab" class="nav-link active">
                                <span class="d-sm-none">Header</span>
                                <span class="d-sm-block d-none">Header</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDBahanBaku" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Bahan Baku</span>
                                <span class="d-sm-block d-none">Bahan Baku</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDBahanBakuTarif" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Bahan Baku Tarif</span>
                                <span class="d-sm-block d-none">Bahan Baku Tarif</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDBahanBakuDokumen" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Bahan Baku Dokumen</span>
                                <span class="d-sm-block d-none">Bahan Baku Dokumen</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDBarang" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Barang</span>
                                <span class="d-sm-block d-none">Barang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDBarangTarif" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Barang Tarif</span>
                                <span class="d-sm-block d-none">Barang Tarif</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDBarangDokumen" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Barang Dokumen</span>
                                <span class="d-sm-block d-none">Barang Dokumen</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDDokumen" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Dokumen</span>
                                <span class="d-sm-block d-none">Dokumen</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDKemasan" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Kemasan</span>
                                <span class="d-sm-block d-none">Kemasan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDKontainer" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Kontainer</span>
                                <span class="d-sm-block d-none">Kontainer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDRespon" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Respon</span>
                                <span class="d-sm-block d-none">Respon</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDStatus" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Status</span>
                                <span class="d-sm-block d-none">Status</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDLog" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Log</span>
                                <span class="d-sm-block d-none">Log</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Menu -->
                    <!-- Menu Tap -->
                    <div class="tab-content rounded bg-white mb-4">
                        <!-- IDHeader -->
                        <div class="tab-pane fade active show" id="IDHeader">
                            <div class="table-responsive">
                                <table id="TableHeader"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center" width="100%">Detail</th>
                                            <th style="text-align: center">NOMOR AJU</th>
                                            <th style="text-align: center">KPPBC</th>
                                            <th style="text-align: center">PERUSAHAAN</th>
                                            <th style="text-align: center">PEMASOK</th>
                                            <th style="text-align: center">STATUS</th>
                                            <th style="text-align: center">KODE DOKUMEN PABEAN</th>
                                            <th style="text-align: center">NPPJK</th>
                                            <th style="text-align: center">ALAMAT PEMASOK</th>
                                            <th style="text-align: center">ALAMAT PEMILIK</th>
                                            <th style="text-align: center">ALAMAT PENERIMA BARANG</th>
                                            <th style="text-align: center">ALAMAT PENGIRIM</th>
                                            <th style="text-align: center">ALAMAT PENGUSAHA</th>
                                            <th style="text-align: center">ALAMAT PPJK</th>
                                            <th style="text-align: center">API PEMILIK</th>
                                            <th style="text-align: center">API PENERIMA</th>
                                            <th style="text-align: center">API PENGUSAHA</th>
                                            <th style="text-align: center">ASAL DATA</th>
                                            <th style="text-align: center">ASURANSI</th>
                                            <th style="text-align: center">BIAYA TAMBAHAN</th>
                                            <th style="text-align: center">BRUTO</th>
                                            <th style="text-align: center">CIF</th>
                                            <th style="text-align: center">CIF RUPIAH</th>
                                            <th style="text-align: center">DISKON</th>
                                            <th style="text-align: center">FLAG PEMILIK</th>
                                            <th style="text-align: center">URL DOKUMEN PABEAN</th>
                                            <th style="text-align: center">FOB</th>
                                            <th style="text-align: center">FREIGHT</th>
                                            <th style="text-align: center">HARGA BARANG LDP</th>
                                            <th style="text-align: center">HARGA INVOICE</th>
                                            <th style="text-align: center">HARGA PENYERAHAN</th>
                                            <th style="text-align: center">HARGA TOTAL</th>
                                            <th style="text-align: center">ID MODUL</th>
                                            <th style="text-align: center">ID PEMASOK</th>
                                            <th style="text-align: center">ID PEMILIK</th>
                                            <th style="text-align: center">ID PENERIMA BARANG</th>
                                            <th style="text-align: center">ID PENGIRIM</th>
                                            <th style="text-align: center">ID PENGUSAHA</th>
                                            <th style="text-align: center">ID PPJK</th>
                                            <th style="text-align: center">JABATAN Tth</th>
                                            <th style="text-align: center">JUMLAH BARANG</th>
                                            <th style="text-align: center">JUMLAH KEMASAN</th>
                                            <th style="text-align: center">JUMLAH KONTAINER</th>
                                            <th style="text-align: center">KESESUAIAN DOKUMEN</th>
                                            <th style="text-align: center">KETERANGAN</th>
                                            <th style="text-align: center">KODE ASAL BARANG</th>
                                            <th style="text-align: center">KODE ASURANSI</th>
                                            <th style="text-align: center">KODE BENDERA</th>
                                            <th style="text-align: center">KODE CARA ANGKUT</th>
                                            <th style="text-align: center">KODE CARA BAYAR</th>
                                            <th style="text-align: center">KODE DAERAH ASAL</th>
                                            <th style="text-align: center">KODE FASILITAS</th>
                                            <th style="text-align: center">KODE FTZ</th>
                                            <th style="text-align: center">KODE HARGA</th>
                                            <th style="text-align: center">KODE ID PEMASOK</th>
                                            <th style="text-align: center">KODE ID PEMILIK</th>
                                            <th style="text-align: center">KODE ID PENERIMA BARANG</th>
                                            <th style="text-align: center">KODE ID PENGIRIM</th>
                                            <th style="text-align: center">KODE ID PENGUSAHA</th>
                                            <th style="text-align: center">KODE ID PPJK</th>
                                            <th style="text-align: center">KODE JENIS API</th>
                                            <th style="text-align: center">KODE JENIS API PEMILIK</th>
                                            <th style="text-align: center">KODE JENIS API PENERIMA</th>
                                            <th style="text-align: center">KODE JENIS API PENGUSAHA</th>
                                            <th style="text-align: center">KODE JENIS BARANG</th>
                                            <th style="text-align: center">KODE JENIS BC25</th>
                                            <th style="text-align: center">KODE JENIS NILAI</th>
                                            <th style="text-align: center">KODE JENIS PEMASUKAN01</th>
                                            <th style="text-align: center">KODE JENIS PEMASUKAN 02</th>
                                            <th style="text-align: center">KODE JENIS TPB</th>
                                            <th style="text-align: center">KODE KANTOR BONGKAR</th>
                                            <th style="text-align: center">KODE KANTOR TUJUAN</th>
                                            <th style="text-align: center">KODE LOKASI BAYAR</th>
                                            <th style="text-align: center">KODE NEGARA PEMASOK</th>
                                            <th style="text-align: center">KODE NEGARA PENGIRIM</th>
                                            <th style="text-align: center">KODE NEGARA PEMILIK</th>
                                            <th style="text-align: center">KODE NEGARA TUJUAN</th>
                                            <th style="text-align: center">KODE PEL BONGKAR</th>
                                            <th style="text-align: center">KODE PEL MUAT</th>
                                            <th style="text-align: center">KODE PEL TRANSIT</th>
                                            <th style="text-align: center">KODE PEMBAYAR</th>
                                            <th style="text-align: center">KODE STATUS PENGUSAHA</th>
                                            <th style="text-align: center">STATUS PERBAIKAN</th>
                                            <th style="text-align: center">KODE TPS</th>
                                            <th style="text-align: center">KODE TUJUAN PEMASUKAN</th>
                                            <th style="text-align: center">KODE TUJUAN PENGIRIMAN</th>
                                            <th style="text-align: center">KODE TUJUAN TPB</th>
                                            <th style="text-align: center">KODE TUTUP PU</th>
                                            <th style="text-align: center">KODE VALUTA</th>
                                            <th style="text-align: center">KOTA Tth</th>
                                            <th style="text-align: center">NAMA PEMILIK</th>
                                            <th style="text-align: center">NAMA PENERIMA BARANG</th>
                                            <th style="text-align: center">NAMA PENGANGKUT</th>
                                            <th style="text-align: center">NAMA PENGIRIM</th>
                                            <th style="text-align: center">NAMA PPJK</th>
                                            <th style="text-align: center">NAMA Tth</th>
                                            <th style="text-align: center">NDPBM</th>
                                            <th style="text-align: center">NETTO</th>
                                            <th style="text-align: center">NILAI INCOTERM</th>
                                            <th style="text-align: center">NIPER PENERIMA</th>
                                            <th style="text-align: center">NOMOR API</th>
                                            <th style="text-align: center">NOMOR BC11</th>
                                            <th style="text-align: center">NOMOR BILLING</th>
                                            <th style="text-align: center">NOMOR DAFTAR</th>
                                            <th style="text-align: center">NOMOR IJIN BPK PEMASOK</th>
                                            <th style="text-align: center">NOMOR IJIN BPK PENGUSAHA</th>
                                            <th style="text-align: center">NOMOR IJIN TPB</th>
                                            <th style="text-align: center">NOMOR IJIN TPB PENERIMA</th>
                                            <th style="text-align: center">NOMOR VOYV FLIGHT</th>
                                            <th style="text-align: center">NPWP BILLING</th>
                                            <th style="text-align: center">POS BC11</th>
                                            <th style="text-align: center">SERI</th>
                                            <th style="text-align: center">SUBPOS BC11</th>
                                            <th style="text-align: center">SUB SUBPOS BC11</th>
                                            <th style="text-align: center">TANGGAL BC11</th>
                                            <th style="text-align: center">TANGGAL BERANGKAT</th>
                                            <th style="text-align: center">TANGGAL BILLING</th>
                                            <th style="text-align: center">TANGGAL DAFTAR</th>
                                            <th style="text-align: center">TANGGAL IJIN BPK PEMASOK</th>
                                            <th style="text-align: center">TANGGAL IJIN BPK PENGUSAHA</th>
                                            <th style="text-align: center">TANGGAL IJIN TPB</th>
                                            <th style="text-align: center">TANGGAL NPPPJK</th>
                                            <th style="text-align: center">TANGGAL TIBA</th>
                                            <th style="text-align: center">TANGGAL Tth</th>
                                            <th style="text-align: center">TANGGAL JATUH TEMPO</th>
                                            <th style="text-align: center">TOTAL BAYAR</th>
                                            <th style="text-align: center">TOTAL BEBAS</th>
                                            <th style="text-align: center">TOTAL DILUNASI</th>
                                            <th style="text-align: center">TOTAL JAMIN</th>
                                            <th style="text-align: center">TOTAL SUDAH DILUNASI</th>
                                            <th style="text-align: center">TOTAL TANGGUH</th>
                                            <th style="text-align: center">TOTAL TANGGUNG</th>
                                            <th style="text-align: center">TOTAL TIDAK DIPUNGUT</th>
                                            <th style="text-align: center">URL DOKUMEN PABEAN</th>
                                            <th style="text-align: center">VERSI MODUL</th>
                                            <th style="text-align: center">VOLUME</th>
                                            <th style="text-align: center">WAKTU BONGKAR</th>
                                            <th style="text-align: center">WAKTU STUFFING</th>
                                            <th style="text-align: center">NOMOR POLISI</th>
                                            <th style="text-align: center">CALL SIGN</th>
                                            <th style="text-align: center">JUMLAH TANDA PENGAMAN</th>
                                            <th style="text-align: center">KODE JENIS TANDA PENGAMAN</th>
                                            <th style="text-align: center">KODE KANTOR MUAT</th>
                                            <th style="text-align: center">KODE PEL TUJUAN</th>
                                            <th style="text-align: center">TANGGAL STUFFING</th>
                                            <th style="text-align: center">TANGGAL MUAT</th>
                                            <th style="text-align: center">KODE GUDANG ASAL</th>
                                            <th style="text-align: center">KODE GUDANG TUJUAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataHeader['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="149">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noHeader = 0; ?>
                                        <?php foreach ($dataHeader['result'] as $rowHeader) { ?>
                                        <?php $noHeader++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noHeader ?>. </td>
                                            <td style="text-align: center;">
                                                <a href="./report_ck5_plb_hal_1.php?AJU=<?= $rowHeader['NOMOR_AJU']; ?>"
                                                    target="_blank" class="btn btn-primary"
                                                    title="./report_ck5_plb_detail.php?AJU=<?= $rowHeader['NOMOR_AJU']; ?>">
                                                    <i class="fas fa-eye"></i><br>
                                                    <font
                                                        style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
                                                        Lihat Detail
                                                    </font>
                                                </a>
                                            </td>
                                            <td><?= $rowHeader['NOMOR_AJU']; ?></td>
                                            <td><?= $rowHeader['KPPBC']; ?></td>
                                            <td><?= $rowHeader['PERUSAHAAN']; ?></td>
                                            <td><?= $rowHeader['PEMASOK']; ?></td>
                                            <td><?= $rowHeader['STATUS']; ?></td>
                                            <td><?= $rowHeader['KODE_DOKUMEN_PABEAN']; ?></td>
                                            <td><?= $rowHeader['NPPJK']; ?></td>
                                            <td><?= $rowHeader['ALAMAT_PEMASOK']; ?></td>
                                            <td><?= $rowHeader['ALAMAT_PEMILIK']; ?></td>
                                            <td><?= $rowHeader['ALAMAT_PENERIMA_BARANG']; ?></td>
                                            <td><?= $rowHeader['ALAMAT_PENGIRIM']; ?></td>
                                            <td><?= $rowHeader['ALAMAT_PENGUSAHA']; ?></td>
                                            <td><?= $rowHeader['ALAMAT_PPJK']; ?></td>
                                            <td><?= $rowHeader['API_PEMILIK']; ?></td>
                                            <td><?= $rowHeader['API_PENERIMA']; ?></td>
                                            <td><?= $rowHeader['API_PENGUSAHA']; ?></td>
                                            <td><?= $rowHeader['ASAL_DATA']; ?></td>
                                            <td><?= $rowHeader['ASURANSI']; ?></td>
                                            <td><?= $rowHeader['BIAYA_TAMBAHAN']; ?></td>
                                            <td><?= $rowHeader['BRUTO']; ?></td>
                                            <td><?= $rowHeader['CIF']; ?></td>
                                            <td><?= $rowHeader['CIF_RUPIAH']; ?></td>
                                            <td><?= $rowHeader['DISKON']; ?></td>
                                            <td><?= $rowHeader['FLAG_PEMILIK']; ?></td>
                                            <td><?= $rowHeader['URL_DOKUMEN_PABEAN']; ?></td>
                                            <td><?= $rowHeader['FOB']; ?></td>
                                            <td><?= $rowHeader['FREIGHT']; ?></td>
                                            <td><?= $rowHeader['HARGA_BARANG_LDP']; ?></td>
                                            <td><?= $rowHeader['HARGA_INVOICE']; ?></td>
                                            <td><?= $rowHeader['HARGA_PENYERAHAN']; ?></td>
                                            <td><?= $rowHeader['HARGA_TOTAL']; ?></td>
                                            <td><?= $rowHeader['ID_MODUL']; ?></td>
                                            <td><?= $rowHeader['ID_PEMASOK']; ?></td>
                                            <td><?= $rowHeader['ID_PEMILIK']; ?></td>
                                            <td><?= $rowHeader['ID_PENERIMA_BARANG']; ?></td>
                                            <td><?= $rowHeader['ID_PENGIRIM']; ?></td>
                                            <td><?= $rowHeader['ID_PENGUSAHA']; ?></td>
                                            <td><?= $rowHeader['ID_PPJK']; ?></td>
                                            <td><?= $rowHeader['JABATAN_TTD']; ?></td>
                                            <td><?= $rowHeader['JUMLAH_BARANG']; ?></td>
                                            <td><?= $rowHeader['JUMLAH_KEMASAN']; ?></td>
                                            <td><?= $rowHeader['JUMLAH_KONTAINER']; ?></td>
                                            <td><?= $rowHeader['KESESUAIAN_DOKUMEN']; ?></td>
                                            <td><?= $rowHeader['KETERANGAN']; ?></td>
                                            <td><?= $rowHeader['KODE_ASAL_BARANG']; ?></td>
                                            <td><?= $rowHeader['KODE_ASURANSI']; ?></td>
                                            <td><?= $rowHeader['KODE_BENDERA']; ?></td>
                                            <td><?= $rowHeader['KODE_CARA_ANGKUT']; ?></td>
                                            <td><?= $rowHeader['KODE_CARA_BAYAR']; ?></td>
                                            <td><?= $rowHeader['KODE_DAERAH_ASAL']; ?></td>
                                            <td><?= $rowHeader['KODE_FASILITAS']; ?></td>
                                            <td><?= $rowHeader['KODE_FTZ']; ?></td>
                                            <td><?= $rowHeader['KODE_HARGA']; ?></td>
                                            <td><?= $rowHeader['KODE_ID_PEMASOK']; ?></td>
                                            <td><?= $rowHeader['KODE_ID_PEMILIK']; ?></td>
                                            <td><?= $rowHeader['KODE_ID_PENERIMA_BARANG']; ?></td>
                                            <td><?= $rowHeader['KODE_ID_PENGIRIM']; ?></td>
                                            <td><?= $rowHeader['KODE_ID_PENGUSAHA']; ?></td>
                                            <td><?= $rowHeader['KODE_ID_PPJK']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_API']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_API_PEMILIK']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_API_PENERIMA']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_API_PENGUSAHA']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_BARANG']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_BC25']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_NILAI']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_PEMASUKAN01']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_PEMASUKAN_02']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_TPB']; ?></td>
                                            <td><?= $rowHeader['KODE_KANTOR_BONGKAR']; ?></td>
                                            <td><?= $rowHeader['KODE_KANTOR_TUJUAN']; ?></td>
                                            <td><?= $rowHeader['KODE_LOKASI_BAYAR']; ?></td>
                                            <td><?= $rowHeader['KODE_NEGARA_PEMASOK']; ?></td>
                                            <td><?= $rowHeader['KODE_NEGARA_PENGIRIM']; ?></td>
                                            <td><?= $rowHeader['KODE_NEGARA_PEMILIK']; ?></td>
                                            <td><?= $rowHeader['KODE_NEGARA_TUJUAN']; ?></td>
                                            <td><?= $rowHeader['KODE_PEL_BONGKAR']; ?></td>
                                            <td><?= $rowHeader['KODE_PEL_MUAT']; ?></td>
                                            <td><?= $rowHeader['KODE_PEL_TRANSIT']; ?></td>
                                            <td><?= $rowHeader['KODE_PEMBAYAR']; ?></td>
                                            <td><?= $rowHeader['KODE_STATUS_PENGUSAHA']; ?></td>
                                            <td><?= $rowHeader['STATUS_PERBAIKAN']; ?></td>
                                            <td><?= $rowHeader['KODE_TPS']; ?></td>
                                            <td><?= $rowHeader['KODE_TUJUAN_PEMASUKAN']; ?></td>
                                            <td><?= $rowHeader['KODE_TUJUAN_PENGIRIMAN']; ?></td>
                                            <td><?= $rowHeader['KODE_TUJUAN_TPB']; ?></td>
                                            <td><?= $rowHeader['KODE_TUTUP_PU']; ?></td>
                                            <td><?= $rowHeader['KODE_VALUTA']; ?></td>
                                            <td><?= $rowHeader['KOTA_TTD']; ?></td>
                                            <td><?= $rowHeader['NAMA_PEMILIK']; ?></td>
                                            <td><?= $rowHeader['NAMA_PENERIMA_BARANG']; ?></td>
                                            <td><?= $rowHeader['NAMA_PENGANGKUT']; ?></td>
                                            <td><?= $rowHeader['NAMA_PENGIRIM']; ?></td>
                                            <td><?= $rowHeader['NAMA_PPJK']; ?></td>
                                            <td><?= $rowHeader['NAMA_TTD']; ?></td>
                                            <td><?= $rowHeader['NDPBM']; ?></td>
                                            <td><?= $rowHeader['NETTO']; ?></td>
                                            <td><?= $rowHeader['NILAI_INCOTERM']; ?></td>
                                            <td><?= $rowHeader['NIPER_PENERIMA']; ?></td>
                                            <td><?= $rowHeader['NOMOR_API']; ?></td>
                                            <td><?= $rowHeader['NOMOR_BC11']; ?></td>
                                            <td><?= $rowHeader['NOMOR_BILLING']; ?></td>
                                            <td><?= $rowHeader['NOMOR_DAFTAR']; ?></td>
                                            <td><?= $rowHeader['NOMOR_IJIN_BPK_PEMASOK']; ?></td>
                                            <td><?= $rowHeader['NOMOR_IJIN_BPK_PENGUSAHA']; ?></td>
                                            <td><?= $rowHeader['NOMOR_IJIN_TPB']; ?></td>
                                            <td><?= $rowHeader['NOMOR_IJIN_TPB_PENERIMA']; ?></td>
                                            <td><?= $rowHeader['NOMOR_VOYV_FLIGHT']; ?></td>
                                            <td><?= $rowHeader['NPWP_BILLING']; ?></td>
                                            <td><?= $rowHeader['POS_BC11']; ?></td>
                                            <td><?= $rowHeader['SERI']; ?></td>
                                            <td><?= $rowHeader['SUBPOS_BC11']; ?></td>
                                            <td><?= $rowHeader['SUB_SUBPOS_BC11']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_BC11']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_BERANGKAT']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_BILLING']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_DAFTAR']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_IJIN_BPK_PEMASOK']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_IJIN_BPK_PENGUSAHA']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_IJIN_TPB']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_NPPPJK']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_TIBA']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_TTD']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_JATUH_TEMPO']; ?></td>
                                            <td><?= $rowHeader['TOTAL_BAYAR']; ?></td>
                                            <td><?= $rowHeader['TOTAL_BEBAS']; ?></td>
                                            <td><?= $rowHeader['TOTAL_DILUNASI']; ?></td>
                                            <td><?= $rowHeader['TOTAL_JAMIN']; ?></td>
                                            <td><?= $rowHeader['TOTAL_SUDAH_DILUNASI']; ?></td>
                                            <td><?= $rowHeader['TOTAL_TANGGUH']; ?></td>
                                            <td><?= $rowHeader['TOTAL_TANGGUNG']; ?></td>
                                            <td><?= $rowHeader['TOTAL_TIDAK_DIPUNGUT']; ?></td>
                                            <td><?= $rowHeader['URL_DOKUMEN_PABEAN_2']; ?></td>
                                            <td><?= $rowHeader['VERSI_MODUL']; ?></td>
                                            <td><?= $rowHeader['VOLUME']; ?></td>
                                            <td><?= $rowHeader['WAKTU_BONGKAR']; ?></td>
                                            <td><?= $rowHeader['WAKTU_STUFFING']; ?></td>
                                            <td><?= $rowHeader['NOMOR_POLISI']; ?></td>
                                            <td><?= $rowHeader['CALL_SIGN']; ?></td>
                                            <td><?= $rowHeader['JUMLAH_TANDA_PENGAMAN']; ?></td>
                                            <td><?= $rowHeader['KODE_JENIS_TANDA_PENGAMAN']; ?></td>
                                            <td><?= $rowHeader['KODE_KANTOR_MUAT']; ?></td>
                                            <td><?= $rowHeader['KODE_PEL_TUJUAN']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_STUFFING']; ?></td>
                                            <td><?= $rowHeader['TANGGAL_MUAT']; ?></td>
                                            <td><?= $rowHeader['KODE_GUDANG_ASAL']; ?></td>
                                            <td><?= $rowHeader['KODE_GUDANG_TUJUAN']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDHeader -->
                        <!-- IDBahanBaku -->
                        <div class="tab-pane fade" id="IDBahanBaku">
                            <div class="table-responsive">
                                <table id="TableBahanBaku"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center;">NOMOR AJU</th>
                                            <th style="text-align: center;">SERI BARANG</th>
                                            <th style="text-align: center;">SERI BAHAN BAKU</th>
                                            <th style="text-align: center;">CIF</th>
                                            <th style="text-align: center;">CIF RUPIAH</th>
                                            <th style="text-align: center;">HARGA PENYERAHAN</th>
                                            <th style="text-align: center;">HARGA PEROLEHAN</th>
                                            <th style="text-align: center;">JENIS SATUAN</th>
                                            <th style="text-align: center;">JUMLAH SATUAN</th>
                                            <th style="text-align: center;">JUMLAH SATUAN</th>
                                            <th style="text-align: center;">KODE ASAL BAHAN BAKU</th>
                                            <th style="text-align: center;">KODE BARANG</th>
                                            <th style="text-align: center;">KODE FASILITAS</th>
                                            <th style="text-align: center;">KODE JENIS DOK ASAL</th>
                                            <th style="text-align: center;">KODE KANTOR</th>
                                            <th style="text-align: center;">KODE SKEMA TARIF</th>
                                            <th style="text-align: center;">KODE STATUS</th>
                                            <th style="text-align: center;">MERK</th>
                                            <th style="text-align: center;">NDPBM</th>
                                            <th style="text-align: center;">NETTO</th>
                                            <th style="text-align: center;">NOMOR AJU DOKUMEN ASAL</th>
                                            <th style="text-align: center;">NOMOR DAFTAR DOKUMEN ASAL</th>
                                            <th style="text-align: center;">POS TARIF</th>
                                            <th style="text-align: center;">SERI BARANG DOKUMEN ASAL</th>
                                            <th style="text-align: center;">SPESIFIKASI LAIN</th>
                                            <th style="text-align: center;">TANGGAL DAFTAR DOKUMEN ASAL</th>
                                            <th style="text-align: center;">TIPE</th>
                                            <th style="text-align: center;">UKURAN</th>
                                            <th style="text-align: center;">URAIAN</th>
                                            <th style="text-align: center;">SERI IJIN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataBahanBaku['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="30">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noBahanBaku = 0; ?>
                                        <?php foreach ($dataBahanBaku['result'] as $rowBahanBaku) { ?>
                                        <?php $noBahanBaku++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noBahanBaku ?>. </td>
                                            <td><?= $rowBahanBaku['NOMOR_AJU']; ?></td>
                                            <td><?= $rowBahanBaku['SERI_BARANG']; ?></td>
                                            <td><?= $rowBahanBaku['SERI_BAHAN_BAKU']; ?></td>
                                            <td><?= $rowBahanBaku['CIF']; ?></td>
                                            <td><?= $rowBahanBaku['CIF_RUPIAH']; ?></td>
                                            <td><?= $rowBahanBaku['HARGA_PENYERAHAN']; ?></td>
                                            <td><?= $rowBahanBaku['HARGA_PEROLEHAN']; ?></td>
                                            <td><?= $rowBahanBaku['JENIS_SATUAN']; ?></td>
                                            <td><?= $rowBahanBaku['JUMLAH_SATUAN']; ?></td>
                                            <td><?= $rowBahanBaku['JUMLAH_SATUAN']; ?></td>
                                            <td><?= $rowBahanBaku['KODE_ASAL_BAHAN_BAKU']; ?></td>
                                            <td><?= $rowBahanBaku['KODE_BARANG']; ?></td>
                                            <td><?= $rowBahanBaku['KODE_FASILITAS']; ?></td>
                                            <td><?= $rowBahanBaku['KODE_JENIS_DOK_ASAL']; ?></td>
                                            <td><?= $rowBahanBaku['KODE_KANTOR']; ?></td>
                                            <td><?= $rowBahanBaku['KODE_SKEMA_TARIF']; ?></td>
                                            <td><?= $rowBahanBaku['KODE_STATUS']; ?></td>
                                            <td><?= $rowBahanBaku['MERK']; ?></td>
                                            <td><?= $rowBahanBaku['NDPBM']; ?></td>
                                            <td><?= $rowBahanBaku['NETTO']; ?></td>
                                            <td><?= $rowBahanBaku['NOMOR_AJU_DOKUMEN_ASAL']; ?></td>
                                            <td><?= $rowBahanBaku['NOMOR_DAFTAR_DOKUMEN_ASAL']; ?></td>
                                            <td><?= $rowBahanBaku['POS_TARIF']; ?></td>
                                            <td><?= $rowBahanBaku['SERI_BARANG_DOKUMEN_ASAL']; ?></td>
                                            <td><?= $rowBahanBaku['SPESIFIKASI_LAIN']; ?></td>
                                            <td><?= $rowBahanBaku['TANGGAL_DAFTAR_DOKUMEN_ASAL']; ?></td>
                                            <td><?= $rowBahanBaku['TIPE']; ?></td>
                                            <td><?= $rowBahanBaku['UKURAN']; ?></td>
                                            <td><?= $rowBahanBaku['URAIAN']; ?></td>
                                            <td><?= $rowBahanBaku['SERI_IJIN']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBahanBaku -->
                        <!-- IDBahanBakuTarif -->
                        <div class="tab-pane fade" id="IDBahanBakuTarif">
                            <div class="table-responsive">
                                <table id="TableBahanBakuTarif"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center;">NOMOR AJU</th>
                                            <th style="text-align: center;">SERI BARANG</th>
                                            <th style="text-align: center;">SERI BAHAN BAKU</th>
                                            <th style="text-align: center;">JENIS TARIF</th>
                                            <th style="text-align: center;">JUMLAH SATUAN</th>
                                            <th style="text-align: center;">KODE ASAL BAHAN BAKU</th>
                                            <th style="text-align: center;">KODE FASILITAS</th>
                                            <th style="text-align: center;">KODE KOMODITI CUKAI</th>
                                            <th style="text-align: center;">KODE SATUAN</th>
                                            <th style="text-align: center;">KODE TARIF</th>
                                            <th style="text-align: center;">NILAI BAYAR</th>
                                            <th style="text-align: center;">NILAI FASILITAS</th>
                                            <th style="text-align: center;">NILAI SUDAH DILUNASI</th>
                                            <th style="text-align: center;">TARIF</th>
                                            <th style="text-align: center;">TARIF FASILITAS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataBahanBakuTarif['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="16">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noBahanBakuTarif = 0; ?>
                                        <?php foreach ($dataBahanBakuTarif['result'] as $rowBahanBakuTarif) { ?>
                                        <?php $noBahanBakuTarif++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noBahanBakuTarif ?>. </td>
                                            <td><?= $rowBahanBakuTarif['NOMOR_AJU']; ?></td>
                                            <td><?= $rowBahanBakuTarif['SERI_BARANG']; ?></td>
                                            <td><?= $rowBahanBakuTarif['SERI_BAHAN_BAKU']; ?></td>
                                            <td><?= $rowBahanBakuTarif['JENIS_TARIF']; ?></td>
                                            <td><?= $rowBahanBakuTarif['JUMLAH_SATUAN']; ?></td>
                                            <td><?= $rowBahanBakuTarif['KODE_ASAL_BAHAN_BAKU']; ?></td>
                                            <td><?= $rowBahanBakuTarif['KODE_FASILITAS']; ?></td>
                                            <td><?= $rowBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?></td>
                                            <td><?= $rowBahanBakuTarif['KODE_SATUAN']; ?></td>
                                            <td><?= $rowBahanBakuTarif['KODE_TARIF']; ?></td>
                                            <td><?= $rowBahanBakuTarif['NILAI_BAYAR']; ?></td>
                                            <td><?= $rowBahanBakuTarif['NILAI_FASILITAS']; ?></td>
                                            <td><?= $rowBahanBakuTarif['NILAI_SUDAH_DILUNASI']; ?></td>
                                            <td><?= $rowBahanBakuTarif['TARIF']; ?></td>
                                            <td><?= $rowBahanBakuTarif['TARIF_FASILITAS']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBahanBakuTarif -->
                        <!-- IDBahanBakuDokumen -->
                        <div class="tab-pane fade" id="IDBahanBakuDokumen">
                            <div class="table-responsive">
                                <table id="TableBahanBakuDokumen"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center;">NOMOR AJU</th>
                                            <th style="text-align: center;">SERI BARANG</th>
                                            <th style="text-align: center;">SERI BAHAN BAKU</th>
                                            <th style="text-align: center;">SERI DOKUMEN</th>
                                            <th style="text-align: center;">KODE ASAL BAHAN BAKU</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataBahanBakuDokumen['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="6">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noBahanBakuDokumen = 0; ?>
                                        <?php foreach ($dataBahanBakuDokumen['result'] as $rowBahanBakuDokumen) { ?>
                                        <?php $noBahanBakuDokumen++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noBahanBakuDokumen ?>. </td>
                                            <td><?= $rowBahanBakuDokumen['NOMOR_AJU']; ?></td>
                                            <td><?= $rowBahanBakuDokumen['SERI_BARANG']; ?></td>
                                            <td><?= $rowBahanBakuDokumen['SERI_BAHAN_BAKU']; ?></td>
                                            <td><?= $rowBahanBakuDokumen['SERI_DOKUMEN']; ?></td>
                                            <td><?= $rowBahanBakuDokumen['KODE_ASAL_BAHAN_BAKU']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBahanBakuDokumen -->
                        <!-- IDBarang -->
                        <div class="tab-pane fade" id="IDBarang">
                            <div class="table-responsive">
                                <table id="TableBarang"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center;">NOMOR AJU</th>
                                            <th style="text-align: center;">SERI BARANG</th>
                                            <th style="text-align: center;">ASURANSI</th>
                                            <th style="text-align: center;">CIF</th>
                                            <th style="text-align: center;">CIF RUPIAH</th>
                                            <th style="text-align: center;">DISKON</th>
                                            <th style="text-align: center;">FLAG KENDARAAN</th>
                                            <th style="text-align: center;">FOB</th>
                                            <th style="text-align: center;">FREIGHT</th>
                                            <th style="text-align: center;">BARANG BARANG LDP</th>
                                            <th style="text-align: center;">HARGA INVOICE</th>
                                            <th style="text-align: center;">HARGA PENYERAHAN</th>
                                            <th style="text-align: center;">HARGA SATUAN</th>
                                            <th style="text-align: center;">JENIS KENDARAAN</th>
                                            <th style="text-align: center;">JUMLAH BAHAN BAKU</th>
                                            <th style="text-align: center;">JUMLAH KEMASAN</th>
                                            <th style="text-align: center;">JUMLAH SATUAN</th>
                                            <th style="text-align: center;">KAPASITAS SILINDER</th>
                                            <th style="text-align: center;">KATEGORI BARANG</th>
                                            <th style="text-align: center;">KODE_ASAL BARANG</th>
                                            <th style="text-align: center;">KODE BARANG</th>
                                            <th style="text-align: center;">KODE FASILITAS</th>
                                            <th style="text-align: center;">KODE GUNA</th>
                                            <th style="text-align: center;">KODE JENIS NILAI</th>
                                            <th style="text-align: center;">KODE KEMASAN</th>
                                            <th style="text-align: center;">KODE LEBIH DARI 4 TAHUN</th>
                                            <th style="text-align: center;">KODE NEGARA ASAL</th>
                                            <th style="text-align: center;">KODE SATUAN</th>
                                            <th style="text-align: center;">KODE SKEMA TARIF</th>
                                            <th style="text-align: center;">KODE STATUS</th>
                                            <th style="text-align: center;">KONDISI BARANG</th>
                                            <th style="text-align: center;">MERK</th>
                                            <th style="text-align: center;">NETTO</th>
                                            <th style="text-align: center;">NILAI INCOTERM</th>
                                            <th style="text-align: center;">NILAI PABEAN</th>
                                            <th style="text-align: center;">NOMOR MESIN</th>
                                            <th style="text-align: center;">POS TARIF</th>
                                            <th style="text-align: center;">SERI POS TARIF</th>
                                            <th style="text-align: center;">SPESIFIKASI LAIN</th>
                                            <th style="text-align: center;">TAHUN PEMBUATAN</th>
                                            <th style="text-align: center;">TIPE</th>
                                            <th style="text-align: center;">UKURAN</th>
                                            <th style="text-align: center;">URAIAN</th>
                                            <th style="text-align: center;">VOLUME</th>
                                            <th style="text-align: center;">SERI IJIN</th>
                                            <th style="text-align: center;">ID EKSPORTIR</th>
                                            <th style="text-align: center;">NAMA EKSPORTIR</th>
                                            <th style="text-align: center;">ALAMAT EKSPORTIR</th>
                                            <th style="text-align: center;">KODE PERHITUNGAN</th>
                                            <th style="text-align: center;">SERI BARANG DOK ASAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataBarang['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="51">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noBarang = 0; ?>
                                        <?php foreach ($dataBarang['result'] as $rowBarang) { ?>
                                        <?php $noBarang++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noBarang ?>. </td>
                                            <td><?= $rowBarang['NOMOR_AJU']; ?></td>
                                            <td><?= $rowBarang['SERI_BARANG']; ?></td>
                                            <td><?= $rowBarang['ASURANSI']; ?></td>
                                            <td><?= $rowBarang['CIF']; ?></td>
                                            <td><?= $rowBarang['CIF_RUPIAH']; ?></td>
                                            <td><?= $rowBarang['DISKON']; ?></td>
                                            <td><?= $rowBarang['FLAG_KENDARAAN']; ?></td>
                                            <td><?= $rowBarang['FOB']; ?></td>
                                            <td><?= $rowBarang['FREIGHT']; ?></td>
                                            <td><?= $rowBarang['BARANG_BARANG_LDP']; ?></td>
                                            <td><?= $rowBarang['HARGA_INVOICE']; ?></td>
                                            <td><?= $rowBarang['HARGA_PENYERAHAN']; ?></td>
                                            <td><?= $rowBarang['HARGA_SATUAN']; ?></td>
                                            <td><?= $rowBarang['JENIS_KENDARAAN']; ?></td>
                                            <td><?= $rowBarang['JUMLAH_BAHAN_BAKU']; ?></td>
                                            <td><?= $rowBarang['JUMLAH_KEMASAN']; ?></td>
                                            <td><?= $rowBarang['JUMLAH_SATUAN']; ?></td>
                                            <td><?= $rowBarang['KAPASITAS_SILINDER']; ?></td>
                                            <td><?= $rowBarang['KATEGORI_BARANG']; ?></td>
                                            <td><?= $rowBarang['KODE_ASAL_BARANG']; ?></td>
                                            <td><?= $rowBarang['KODE_BARANG']; ?></td>
                                            <td><?= $rowBarang['KODE_FASILITAS']; ?></td>
                                            <td><?= $rowBarang['KODE_GUNA']; ?></td>
                                            <td><?= $rowBarang['KODE_JENIS_NILAI']; ?></td>
                                            <td><?= $rowBarang['KODE_KEMASAN']; ?></td>
                                            <td><?= $rowBarang['KODE_LEBIH_DARI_4_TAHUN']; ?></td>
                                            <td><?= $rowBarang['KODE_NEGARA_ASAL']; ?></td>
                                            <td><?= $rowBarang['KODE_SATUAN']; ?></td>
                                            <td><?= $rowBarang['KODE_SKEMA_TARIF']; ?></td>
                                            <td><?= $rowBarang['KODE_STATUS']; ?></td>
                                            <td><?= $rowBarang['KONDISI_BARANG']; ?></td>
                                            <td><?= $rowBarang['MERK']; ?></td>
                                            <td><?= $rowBarang['NETTO']; ?></td>
                                            <td><?= $rowBarang['NILAI_INCOTERM']; ?></td>
                                            <td><?= $rowBarang['NILAI_PABEAN']; ?></td>
                                            <td><?= $rowBarang['NOMOR_MESIN']; ?></td>
                                            <td><?= $rowBarang['POS_TARIF']; ?></td>
                                            <td><?= $rowBarang['SERI_POS_TARIF']; ?></td>
                                            <td><?= $rowBarang['SPESIFIKASI_LAIN']; ?></td>
                                            <td><?= $rowBarang['TAHUN_PEMBUATAN']; ?></td>
                                            <td><?= $rowBarang['TIPE']; ?></td>
                                            <td><?= $rowBarang['UKURAN']; ?></td>
                                            <td><?= $rowBarang['URAIAN']; ?></td>
                                            <td><?= $rowBarang['VOLUME']; ?></td>
                                            <td><?= $rowBarang['SERI_IJIN']; ?></td>
                                            <td><?= $rowBarang['ID_EKSPORTIR']; ?></td>
                                            <td><?= $rowBarang['NAMA_EKSPORTIR']; ?></td>
                                            <td><?= $rowBarang['ALAMAT_EKSPORTIR']; ?></td>
                                            <td><?= $rowBarang['KODE_PERHITUNGAN']; ?></td>
                                            <td><?= $rowBarang['SERI_BARANG_DOK_ASAL']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBarang -->
                        <!-- IDBarangTarif -->
                        <div class="tab-pane fade" id="IDBarangTarif">
                            <div class="table-responsive">
                                <table id="TableBarangTarif"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center;">NOMOR AJU</th>
                                            <th style="text-align: center;">SERI BARANG</th>
                                            <th style="text-align: center;">JENIS TARIF</th>
                                            <th style="text-align: center;">JUMLAH SATUAN</th>
                                            <th style="text-align: center;">KODE FASILITAS</th>
                                            <th style="text-align: center;">KODE KOMODITI CUKAI</th>
                                            <th style="text-align: center;">TARIF KODE SATUAN</th>
                                            <th style="text-align: center;">TARIF KODE TARIF</th>
                                            <th style="text-align: center;">TARIF NILAI BAYAR</th>
                                            <th style="text-align: center;">TARIF NILAI FASILITAS</th>
                                            <th style="text-align: center;">TARIF NILAI SUDAH DILUNASI</th>
                                            <th style="text-align: center;">TARIF</th>
                                            <th style="text-align: center;">TARIF FASILITAS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataBarangTarif['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="14">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noBarangTarif = 0; ?>
                                        <?php foreach ($dataBarangTarif['result'] as $rowBarangTarif) { ?>
                                        <?php $noBarangTarif++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noBarangTarif ?>. </td>
                                            <td><?= $rowBarangTarif['NOMOR_AJU']; ?></td>
                                            <td><?= $rowBarangTarif['SERI_BARANG']; ?></td>
                                            <td><?= $rowBarangTarif['JENIS_TARIF']; ?></td>
                                            <td><?= $rowBarangTarif['JUMLAH_SATUAN']; ?></td>
                                            <td><?= $rowBarangTarif['KODE_FASILITAS']; ?></td>
                                            <td><?= $rowBarangTarif['KODE_KOMODITI_CUKAI']; ?></td>
                                            <td><?= $rowBarangTarif['TARIF_KODE_SATUAN']; ?></td>
                                            <td><?= $rowBarangTarif['TARIF_KODE_TARIF']; ?></td>
                                            <td><?= $rowBarangTarif['TARIF_NILAI_BAYAR']; ?></td>
                                            <td><?= $rowBarangTarif['TARIF_NILAI_FASILITAS']; ?></td>
                                            <td><?= $rowBarangTarif['TARIF_NILAI_SUDAH_DILUNASI']; ?></td>
                                            <td><?= $rowBarangTarif['TARIF']; ?></td>
                                            <td><?= $rowBarangTarif['TARIF_FASILITAS']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBarangTarif -->
                        <!-- IDBarangDokumen -->
                        <div class="tab-pane fade" id="IDBarangDokumen">
                            <div class="table-responsive">
                                <table id="TableBarangDokumen"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center;">NOMOR AJU</th>
                                            <th style="text-align: center;">SERI BARANG</th>
                                            <th style="text-align: center;">SERI DOKUMEN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataBarangDokumen['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="4">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noBarangDokumen = 0; ?>
                                        <?php foreach ($dataBarangDokumen['result'] as $rowBarangDokumen) { ?>
                                        <?php $noBarangDokumen++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noBarangDokumen ?>. </td>
                                            <td><?= $rowBarangDokumen['NOMOR_AJU']; ?></td>
                                            <td><?= $rowBarangDokumen['SERI_BARANG']; ?></td>
                                            <td><?= $rowBarangDokumen['SERI_DOKUMEN']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBarangDokumen -->
                        <!-- IDDokumen -->
                        <div class="tab-pane fade" id="IDDokumen">
                            <div class="table-responsive">
                                <table id="TableDokumen"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center;">NOMOR AJU</th>
                                            <th style="text-align: center;">SERI DOKUMEN</th>
                                            <th style="text-align: center;">FLAG URL DOKUMEN</th>
                                            <th style="text-align: center;">KODE JENIS DOKUMEN</th>
                                            <th style="text-align: center;">NOMOR DOKUMEN</th>
                                            <th style="text-align: center;">TANGGAL DOKUMEN</th>
                                            <th style="text-align: center;">TIPE DOKUMEN</th>
                                            <th style="text-align: center;">URL DOKUMEN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataDokumen['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="9">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noDokumen = 0; ?>
                                        <?php foreach ($dataDokumen['result'] as $rowDokumen) { ?>
                                        <?php $noDokumen++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noDokumen ?>. </td>
                                            <td><?= $rowDokumen['NOMOR_AJU']; ?></td>
                                            <td><?= $rowDokumen['SERI_DOKUMEN']; ?></td>
                                            <td><?= $rowDokumen['FLAG_URL_DOKUMEN']; ?></td>
                                            <td><?= $rowDokumen['KODE_JENIS_DOKUMEN']; ?></td>
                                            <td><?= $rowDokumen['NOMOR_DOKUMEN']; ?></td>
                                            <td><?= $rowDokumen['TANGGAL_DOKUMEN']; ?></td>
                                            <td><?= $rowDokumen['TIPE_DOKUMEN']; ?></td>
                                            <td><?= $rowDokumen['URL_DOKUMEN']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDDokumen -->
                        <!-- IDKemasan -->
                        <div class="tab-pane fade" id="IDKemasan">
                            <div class="table-responsive">
                                <table id="TableKemasan"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center;">NOMOR AJU</th>
                                            <th style="text-align: center;">SERI KEMASAN</th>
                                            <th style="text-align: center;">JUMLAH KEMASAN</th>
                                            <th style="text-align: center;">KESESUAIAN DOKUMEN</th>
                                            <th style="text-align: center;">KETERANGAN</th>
                                            <th style="text-align: center;">KODE JENIS KEMASAN</th>
                                            <th style="text-align: center;">MEREK KEMASAN</th>
                                            <th style="text-align: center;">NIP GATE IN</th>
                                            <th style="text-align: center;">NIP GATE OUT</th>
                                            <th style="text-align: center;">NOMOR POLISI</th>
                                            <th style="text-align: center;">NOMOR SEGEL</th>
                                            <th style="text-align: center;">WAKTU GATE IN</th>
                                            <th style="text-align: center;">WAKTU GATE OUT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataKemasan['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="14">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noKemasan = 0; ?>
                                        <?php foreach ($dataKemasan['result'] as $rowKemasan) { ?>
                                        <?php $noKemasan++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noKemasan ?>. </td>
                                            <td><?= $rowKemasan['NOMOR_AJU']; ?></td>
                                            <td><?= $rowKemasan['SERI_KEMASAN']; ?></td>
                                            <td><?= $rowKemasan['JUMLAH_KEMASAN']; ?></td>
                                            <td><?= $rowKemasan['KESESUAIAN_DOKUMEN']; ?></td>
                                            <td><?= $rowKemasan['KETERANGAN']; ?></td>
                                            <td><?= $rowKemasan['KODE_JENIS_KEMASAN']; ?></td>
                                            <td><?= $rowKemasan['MEREK_KEMASAN']; ?></td>
                                            <td><?= $rowKemasan['NIP_GATE_IN']; ?></td>
                                            <td><?= $rowKemasan['NIP_GATE_OUT']; ?></td>
                                            <td><?= $rowKemasan['NOMOR_POLISI']; ?></td>
                                            <td><?= $rowKemasan['NOMOR_SEGEL']; ?></td>
                                            <td><?= $rowKemasan['WAKTU_GATE_IN']; ?></td>
                                            <td><?= $rowKemasan['WAKTU_GATE_OUT']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDKemasan -->
                        <!-- IDKontainer -->
                        <div class="tab-pane fade" id="IDKontainer">
                            <div class="table-responsive">
                                <table id="TableKontainer"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center;">NOMOR AJU</th>
                                            <th style="text-align: center;">SERI KONTAINER</th>
                                            <th style="text-align: center;">KESESUAIAN DOKUMEN</th>
                                            <th style="text-align: center;">KETERANGAN</th>
                                            <th style="text-align: center;">KODE STUFFING</th>
                                            <th style="text-align: center;">KODE TIPE KONTAINER</th>
                                            <th style="text-align: center;">KODE UKURAN KONTAINER</th>
                                            <th style="text-align: center;">FLAG GATE IN</th>
                                            <th style="text-align: center;">FLAG GATE OUT</th>
                                            <th style="text-align: center;">NOMOR POLISI</th>
                                            <th style="text-align: center;">NOMOR KONTAINER</th>
                                            <th style="text-align: center;">NOMOR SEGEL</th>
                                            <th style="text-align: center;">WAKTU GATE IN</th>
                                            <th style="text-align: center;">WAKTU GATE OUT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataKontainer['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="15">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noKontainer = 0; ?>
                                        <?php foreach ($dataKontainer['result'] as $rowKontainer) { ?>
                                        <?php $noKontainer++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noKontainer ?>. </td>
                                            <td><?= $rowKontainer['NOMOR_AJU']; ?></td>
                                            <td><?= $rowKontainer['SERI_KONTAINER']; ?></td>
                                            <td><?= $rowKontainer['KESESUAIAN_DOKUMEN']; ?></td>
                                            <td><?= $rowKontainer['KETERANGAN']; ?></td>
                                            <td><?= $rowKontainer['KODE_STUFFING']; ?></td>
                                            <td><?= $rowKontainer['KODE_TIPE_KONTAINER']; ?></td>
                                            <td><?= $rowKontainer['KODE_UKURAN_KONTAINER']; ?></td>
                                            <td><?= $rowKontainer['FLAG_GATE_IN']; ?></td>
                                            <td><?= $rowKontainer['FLAG_GATE_OUT']; ?></td>
                                            <td><?= $rowKontainer['NOMOR_POLISI']; ?></td>
                                            <td><?= $rowKontainer['NOMOR_KONTAINER']; ?></td>
                                            <td><?= $rowKontainer['NOMOR_SEGEL']; ?></td>
                                            <td><?= $rowKontainer['WAKTU_GATE_IN']; ?></td>
                                            <td><?= $rowKontainer['WAKTU_GATE_OUT']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDKontainer -->
                        <!-- IDRespon -->
                        <div class="tab-pane fade" id="IDRespon">
                            <div class="table-responsive">
                                <table id="TableRespon"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center">NOMOR AJU</th>
                                            <th style="text-align: center">KODE RESPON</th>
                                            <th style="text-align: center">NOMOR RESPON</th>
                                            <th style="text-align: center">TANGGAL RESPON</th>
                                            <th style="text-align: center">WAKTU RESPON</th>
                                            <th style="text-align: center">BYTE STRAM PDF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataRespon['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="7">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noRespon = 0; ?>
                                        <?php foreach ($dataRespon['result'] as $rowRespon) { ?>
                                        <?php $noRespon++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noRespon ?>. </td>
                                            <td><?= $rowRespon['NOMOR_AJU']; ?></td>
                                            <td><?= $rowRespon['KODE_RESPON']; ?></td>
                                            <td><?= $rowRespon['NOMOR_RESPON']; ?></td>
                                            <td><?= $rowRespon['TANGGAL_RESPON']; ?></td>
                                            <td><?= $rowRespon['WAKTU_RESPON']; ?></td>
                                            <td><?= $rowRespon['BYTE_STRAM_PDF']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDRespon -->
                        <!-- IDStatus -->
                        <div class="tab-pane fade" id="IDStatus">
                            <div class="table-responsive">
                                <table id="TableStatus"
                                    class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center">NOMOR AJU</th>
                                            <th style="text-align: center">KODE RESPON</th>
                                            <th style="text-align: center">NOMOR RESPON</th>
                                            <th style="text-align: center">Date Submit CK5 PLB</th>
                                            <th style="text-align: center">Date Export CK5 PLB</th>
                                            <th style="text-align: center">Date GB Submit Sarinah</th>
                                            <th style="text-align: center">Date GB Export Sarinah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataStatus['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="4">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noStatus = 0; ?>
                                        <?php foreach ($dataStatus['result'] as $rowStatus) { ?>
                                        <?php $noStatus++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noStatus ?>. </td>
                                            <td><?= $rowStatus['NOMOR_AJU']; ?></td>
                                            <td><?= $rowStatus['KODE_RESPON']; ?></td>
                                            <td><?= $rowStatus['NOMOR_RESPON']; ?></td>
                                            <td><?= $rowStatus['ck5_plb_submit']; ?></td>
                                            <td>
                                                <?php if ($rowStatus['ck5_plb_export'] == '0000-00-00 00:00:00' || $rowStatus['ck5_plb_export'] == NULL) { ?>
                                                <center><i>Belum di Export</i></center>
                                                <?php } else { ?>
                                                <?= $rowStatus['ck5_plb_export']; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($rowStatus['ck5_gb_submit'] == '0000-00-00 00:00:00' || $rowStatus['ck5_gb_submit'] == NULL) { ?>
                                                <center><i>Belum di Submit</i></center>
                                                <?php } else { ?>
                                                <?= $rowStatus['ck5_gb_submit']; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($rowStatus['ck_gb_export'] == '0000-00-00 00:00:00' || $rowStatus['ck_gb_export'] == NULL) { ?>
                                                <center><i>Belum di Export</i></center>
                                                <?php } else { ?>
                                                <?= $rowStatus['ck_gb_export']; ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDStatus -->
                        <!-- IDLog -->
                        <div class="tab-pane fade" id="IDLog">
                            <div class="table-responsive">
                                <table id="TableLog" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th style="text-align: center">USERNAME</th>
                                            <th style="text-align: center">NAMA FILE</th>
                                            <th style="text-align: center">TOTAL DATA</th>
                                            <th style="text-align: center">DATE TIME</th>
                                            <th style="text-align: center">STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataLog['status'] == 404) { ?>
                                        <tr>
                                            <td colspan="6">
                                                <center>
                                                    <div style="display: grid;">
                                                        <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php } else { ?>
                                        <?php $noLog = 0; ?>
                                        <?php foreach ($dataLog['result'] as $rowLog) { ?>
                                        <?php $noLog++ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $noLog ?>. </td>
                                            <td><?= $rowLog['username']; ?></td>
                                            <td><?= $rowLog['filename']; ?></td>
                                            <td><?= $rowLog['totalupload']; ?></td>
                                            <td><?= $rowLog['dateupload']; ?></td>
                                            <td><?= $rowLog['status']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDLog -->
                    </div>
                    <!-- End Menu Tap -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
<?php include "include/jsForm.php"; ?>

<script type="text/javascript">
// UPDATE SUCCESS
if (window?.location?.href?.indexOf('UploadSuccess') > -1) {
    Swal.fire({
        title: 'Data berhasil diupload!',
        icon: 'success',
        text: 'Data berhasil diupload didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './report_ck5_plb_data.php');
}
// UPDATE FAILED
if (window?.location?.href?.indexOf('UploadFailed') > -1) {
    Swal.fire({
        title: 'Data gagal diupload!',
        icon: 'error',
        text: 'Data gagal diupload didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './report_ck5_plb_data.php');
}


// TableHeader
$(document).ready(function() {
    $('#TableHeader').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBahanBaku
$(document).ready(function() {
    $('#TableBahanBaku').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBahanBakuTarif
$(document).ready(function() {
    $('#TableBahanBakuTarif').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBahanBakuDokumen
$(document).ready(function() {
    $('#TableBahanBakuDokumen').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBarang
$(document).ready(function() {
    $('#TableBarang').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBarangTarif
$(document).ready(function() {
    $('#TableBarangTarif').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBarangDokumen
$(document).ready(function() {
    $('#TableBarangDokumen').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableDokumen
$(document).ready(function() {
    $('#TableDokumen').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableKemasan
$(document).ready(function() {
    $('#TableKemasan').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableKontainer
$(document).ready(function() {
    $('#TableKontainer').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableRespon
$(document).ready(function() {
    $('#TableRespon').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableStatus
$(document).ready(function() {
    $('#TableStatus').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableLog
$(document).ready(function() {
    $('#TableLog').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
</script>