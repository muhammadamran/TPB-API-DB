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
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id="ct"></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-upload"></i> Upload Data CK5 PLB</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="report_ck5_plb_upload.php" method="post" enctype="multipart/form-data">
                        <div class="row" style="display: flex;align-items: center;">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <div style="margin-bottom: 10px;justify-content: center;align-items: center;display: flex;">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Microsoft_Office_Excel_%282019%E2%80%93present%29.svg/826px-Microsoft_Office_Excel_%282019%E2%80%93present%29.svg.png" style="width: 15%;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Upload Excel File CK5 PLB:</label>
                                    <input type="hidden" class="form-control" name="username" value="<?= $_SESSION['username'] ?>" required>
                                    <input type="file" class="form-control" name="file_upload" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <button type="submit" class="btn btn-block btn-primary" value="Upload"><i class="fas fa-upload"></i> Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> CK5 - PLB / Master Data</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div style="display: flex;justify-content: end;margin-bottom: 10px;position: static;">
                        <a href="#baca-panduan-ck5plb" class="btn btn-inverse" data-toggle="modal"><i class="fas fa-book"></i> Baca Panduan</a>
                    </div>
                    <?php include "panduan/panduan_ck5_plb.php"; ?>
                    <div class="line-page-table"></div>
                    <!-- Alert -->
                    <?php
                    $dataLogUpload = $dbcon->query("SELECT * FROM plb_log ORDER BY ID DESC LIMIT 1");
                    $rowLogUpload = mysqli_fetch_array($dataLogUpload);
                    ?>
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
                                <table id="TableHeader" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th Width="1%">No.</th>
                                            <th style="text-align: center" Width="100%">Detail</th>
                                            <th style="text-align: center">Nomor Pengajuan</th>
                                            <th style="text-align: center">KPPBC</th>
                                            <th style="text-align: center">Perusahaan</th>
                                            <th style="text-align: center">Pemasok</th>
                                            <th style="text-align: center">Status</th>
                                            <th style="text-align: center">Kode Dokumen Pabean</th>
                                            <th style="text-align: center">NPPJK</th>
                                            <th style="text-align: center">Alamat Pemasok</th>
                                            <th style="text-align: center">Alamat Pemilik</th>
                                            <th style="text-align: center">Alamat Penerima Barang</th>
                                            <th style="text-align: center">Alamat Pengirim</th>
                                            <th style="text-align: center">Alamat Pengusaha</th>
                                            <th style="text-align: center">Alamat PPJK</th>
                                            <th style="text-align: center">API Pemilik</th>
                                            <th style="text-align: center">API Penerima</th>
                                            <th style="text-align: center">API Pengusaha</th>
                                            <th style="text-align: center">Asal Data</th>
                                            <th style="text-align: center">Asuransi</th>
                                            <th style="text-align: center">Biaya Tambahan</th>
                                            <th style="text-align: center">Bruto</th>
                                            <th style="text-align: center">CIF</th>
                                            <th style="text-align: center">CIF Rp.</th>
                                            <th style="text-align: center">Diskon</th>
                                            <th style="text-align: center">Flag Pemilik</th>
                                            <th style="text-align: center">URL Dokumen Pabean</th>
                                            <th style="text-align: center">Fob</th>
                                            <th style="text-align: center">Freight</th>
                                            <th style="text-align: center">Harga Barang Ldp</th>
                                            <th style="text-align: center">Harga Invoice</th>
                                            <th style="text-align: center">Harga Penyerahan</th>
                                            <th style="text-align: center">Harga Total</th>
                                            <th style="text-align: center">ID Modul</th>
                                            <th style="text-align: center">ID Pemasok</th>
                                            <th style="text-align: center">ID Pemilik</th>
                                            <th style="text-align: center">ID Penerima Barang</th>
                                            <th style="text-align: center">ID Pengirim</th>
                                            <th style="text-align: center">ID Pengusaha</th>
                                            <th style="text-align: center">ID PPJK</th>
                                            <th style="text-align: center">Jabatan Tth</th>
                                            <th style="text-align: center">Jumlah Barang</th>
                                            <th style="text-align: center">Jumlah Kemasan</th>
                                            <th style="text-align: center">Jumlah Kontainer</th>
                                            <th style="text-align: center">Kesesuaian Dokumen</th>
                                            <th style="text-align: center">Keterangan</th>
                                            <th style="text-align: center">Kode Asal Barang</th>
                                            <th style="text-align: center">Kode Asuransi</th>
                                            <th style="text-align: center">Kode Bendera</th>
                                            <th style="text-align: center">Kode Cara Angkut</th>
                                            <th style="text-align: center">Kode Cara Bayar</th>
                                            <th style="text-align: center">Kode Daerah Asal</th>
                                            <th style="text-align: center">Kode Fasilitas</th>
                                            <th style="text-align: center">Kode FTZ</th>
                                            <th style="text-align: center">Kode Harga</th>
                                            <th style="text-align: center">Kode ID Pemasok</th>
                                            <th style="text-align: center">Kode ID Pemilik</th>
                                            <th style="text-align: center">Kode ID Penerima Barang</th>
                                            <th style="text-align: center">Kode ID Pengirim</th>
                                            <th style="text-align: center">Kode ID Pengusaha</th>
                                            <th style="text-align: center">Kode ID PPJK</th>
                                            <th style="text-align: center">Kode Jenis API</th>
                                            <th style="text-align: center">Kode Jenis API Pemilik</th>
                                            <th style="text-align: center">Kode Jenis API Penerima</th>
                                            <th style="text-align: center">Kode Jenis API Pengusaha</th>
                                            <th style="text-align: center">Kode Jenis Barang</th>
                                            <th style="text-align: center">Kode Jenis BC25</th>
                                            <th style="text-align: center">Kode Jenis Nilai</th>
                                            <th style="text-align: center">Kode Jenis Pemasukan01</th>
                                            <th style="text-align: center">Kode Jenis Pemasukan 02</th>
                                            <th style="text-align: center">Kode Jenis TPB</th>
                                            <th style="text-align: center">Kode Kantor Bongkar</th>
                                            <th style="text-align: center">Kode Kantor Tujuan</th>
                                            <th style="text-align: center">Kode Lokasi Bayar</th>
                                            <th style="text-align: center">Kode Negara Pemasok</th>
                                            <th style="text-align: center">Kode Negara Pengirim</th>
                                            <th style="text-align: center">Kode Negara Pemilik</th>
                                            <th style="text-align: center">Kode Negara Tujuan</th>
                                            <th style="text-align: center">Kode Pel. Bongkar</th>
                                            <th style="text-align: center">Kode Pel. Muat</th>
                                            <th style="text-align: center">Kode Pel. Transit</th>
                                            <th style="text-align: center">Kode Pembayar</th>
                                            <th style="text-align: center">Kode Status Pengusaha</th>
                                            <th style="text-align: center">Status Perbaikan</th>
                                            <th style="text-align: center">Kode TPS</th>
                                            <th style="text-align: center">Kode Tujuan Pemasukan</th>
                                            <th style="text-align: center">Kode Tujuan Pengiriman</th>
                                            <th style="text-align: center">Kode Tujuan Tpb</th>
                                            <th style="text-align: center">Kode Tutup Pu</th>
                                            <th style="text-align: center">Kode Valuta</th>
                                            <th style="text-align: center">Kota TTH</th>
                                            <th style="text-align: center">Nama Pemilik</th>
                                            <th style="text-align: center">Nama Penerima Barang</th>
                                            <th style="text-align: center">Nama Pengangkut</th>
                                            <th style="text-align: center">Nama Pengirim</th>
                                            <th style="text-align: center">Nama PPJK</th>
                                            <th style="text-align: center">Nama TTH</th>
                                            <th style="text-align: center">Ndpbm</th>
                                            <th style="text-align: center">Netto</th>
                                            <th style="text-align: center">Nilai Incoterm</th>
                                            <th style="text-align: center">Niper Penerima</th>
                                            <th style="text-align: center">Nomor API</th>
                                            <th style="text-align: center">Nomor BC11</th>
                                            <th style="text-align: center">Nomor Billing</th>
                                            <th style="text-align: center">Nomor Daftar</th>
                                            <th style="text-align: center">Nomor Ijin BPK Pemasok</th>
                                            <th style="text-align: center">Nomor Ijin BPK Pengusaha</th>
                                            <th style="text-align: center">Nomor Ijin TPB</th>
                                            <th style="text-align: center">Nomor Ijin TPB Penerima</th>
                                            <th style="text-align: center">Nomor Voyv Flight</th>
                                            <th style="text-align: center">Npwp Billing</th>
                                            <th style="text-align: center">Pos BC11</th>
                                            <th style="text-align: center">Seri</th>
                                            <th style="text-align: center">Subpos BC11</th>
                                            <th style="text-align: center">Sub Subpos BC11</th>
                                            <th style="text-align: center">Tanggal BC11</th>
                                            <th style="text-align: center">Tanggal Berangkat</th>
                                            <th style="text-align: center">Tanggal Billing</th>
                                            <th style="text-align: center">Tanggal Daftar</th>
                                            <th style="text-align: center">Tanggal Ijin BPK Pemasok</th>
                                            <th style="text-align: center">Tanggal Ijin BPK Pengusaha</th>
                                            <th style="text-align: center">Tanggal Ijin TPB</th>
                                            <th style="text-align: center">Tanggal NPPJK</th>
                                            <th style="text-align: center">Tanggal Tiba</th>
                                            <th style="text-align: center">Tanggal TTH</th>
                                            <th style="text-align: center">Tanggal Jatuh Tempo</th>
                                            <th style="text-align: center">Total Bayar</th>
                                            <th style="text-align: center">Total Bebas</th>
                                            <th style="text-align: center">Total Dilunasi</th>
                                            <th style="text-align: center">Total Jamin</th>
                                            <th style="text-align: center">Total Sudah Dilunasi</th>
                                            <th style="text-align: center">Total Tangguh</th>
                                            <th style="text-align: center">Total Tanggung</th>
                                            <th style="text-align: center">Total Tidak Dipungut</th>
                                            <th style="text-align: center">URL Dokumen Pabean</th>
                                            <th style="text-align: center">Versi Modul</th>
                                            <th style="text-align: center">Volume</th>
                                            <th style="text-align: center">Waktu Bongkar</th>
                                            <th style="text-align: center">Waktu Stuffing</th>
                                            <th style="text-align: center">Nomor Polisi</th>
                                            <th style="text-align: center">Call Sign</th>
                                            <th style="text-align: center">Jumlah Tanda Pengaman</th>
                                            <th style="text-align: center">Kode Jenis Tanda Pengaman</th>
                                            <th style="text-align: center">Kode Kantor Muat</th>
                                            <th style="text-align: center">Kode Pel Tujuan</th>
                                            <th style="text-align: center">Tanggal Stuffing</th>
                                            <th style="text-align: center">Tanggal Muat</th>
                                            <th style="text-align: center">Kode Gudang Asal</th>
                                            <th style="text-align: center">Kode Gudang Tujuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_header ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noHeader = 0;
                                            while ($rowHeader = mysqli_fetch_array($dataTable)) {
                                                $noHeader++;
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $noHeader ?>. </td>
                                                    <td style="text-align: center;">
                                                        <a href="./report_ck5_plb_hal_1.php?AJU=<?= $rowHeader['NOMOR_AJU']; ?>" target="_blank" class="btn btn-primary" title="./report_ck5_plb_detail.php?AJU=<?= $rowHeader['NOMOR_AJU']; ?>">
                                                            <i class="fas fa-eye"></i><br>
                                                            <font style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
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
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="149">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDHeader -->
                        <!-- IDBahanBaku -->
                        <div class="tab-pane fade" id="IDBahanBaku">
                            <div class="table-responsive">
                                <table id="TableBahanBaku" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center;">Nomor Pengajuan</th>
                                            <th style="text-align: center;">Seri Barang</th>
                                            <th style="text-align: center;">Seri Bahan Baku</th>
                                            <th style="text-align: center;">CIF</th>
                                            <th style="text-align: center;">CIF Rp.</th>
                                            <th style="text-align: center;">Harga Penyerahan</th>
                                            <th style="text-align: center;">Harga Perolehan</th>
                                            <th style="text-align: center;">Jenis Satuan</th>
                                            <th style="text-align: center;">Jumlah Satuan</th>
                                            <th style="text-align: center;">Jumlah Satuan</th>
                                            <th style="text-align: center;">Kode Asal Bahan Baku</th>
                                            <th style="text-align: center;">Kode Barang</th>
                                            <th style="text-align: center;">Kode Fasilitas</th>
                                            <th style="text-align: center;">Kode Jenis Dok. Asal</th>
                                            <th style="text-align: center;">Kode Kantor</th>
                                            <th style="text-align: center;">Kode Skema Tarif</th>
                                            <th style="text-align: center;">Kode Status</th>
                                            <th style="text-align: center;">MERK</th>
                                            <th style="text-align: center;">NDPBM</th>
                                            <th style="text-align: center;">NETTO</th>
                                            <th style="text-align: center;">No. AJU Dok. Asal</th>
                                            <th style="text-align: center;">No. Daftar Dok. Asal</th>
                                            <th style="text-align: center;">Pos Tarif</th>
                                            <th style="text-align: center;">Seri Barang Dok. Asal</th>
                                            <th style="text-align: center;">Spesifikasi Lain</th>
                                            <th style="text-align: center;">Tanggal Daftar Dok. Asal</th>
                                            <th style="text-align: center;">Tipe</th>
                                            <th style="text-align: center;">Ukuran</th>
                                            <th style="text-align: center;">Uraian</th>
                                            <th style="text-align: center;">Seri Ijin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_bahanbaku ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noBahanBaku = 0;
                                            while ($rowBahanBaku = mysqli_fetch_array($dataTable)) {
                                                $noBahanBaku++;
                                        ?>
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
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="30">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBahanBaku -->
                        <!-- IDBahanBakuTarif -->
                        <div class="tab-pane fade" id="IDBahanBakuTarif">
                            <div class="table-responsive">
                                <table id="TableBahanBakuTarif" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center;">Nomor Pengajuan</th>
                                            <th style="text-align: center;">Seri Barang</th>
                                            <th style="text-align: center;">Seri Bahan Baku</th>
                                            <th style="text-align: center;">Jenis Tarif</th>
                                            <th style="text-align: center;">Jumlah Satuan</th>
                                            <th style="text-align: center;">Kode Asal Bahan Baku</th>
                                            <th style="text-align: center;">Kode Fasilitas</th>
                                            <th style="text-align: center;">Kode Komoditi Cukai</th>
                                            <th style="text-align: center;">Kode Satuan</th>
                                            <th style="text-align: center;">Kode Tarif</th>
                                            <th style="text-align: center;">Nilai Bayar</th>
                                            <th style="text-align: center;">Nilai Fasilitas</th>
                                            <th style="text-align: center;">Nilai Sudah Dilunasi</th>
                                            <th style="text-align: center;">Tarif</th>
                                            <th style="text-align: center;">Tarif Fasilitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_bahanbakutarif ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noBahanBakuTarif = 0;
                                            while ($rowBahanBakuTarif = mysqli_fetch_array($dataTable)) {
                                                $noBahanBakuTarif++;
                                        ?>
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
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="16">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBahanBakuTarif -->
                        <!-- IDBahanBakuDokumen -->
                        <div class="tab-pane fade" id="IDBahanBakuDokumen">
                            <div class="table-responsive">
                                <table id="TableBahanBakuDokumen" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center;">Nomor Pengajuan</th>
                                            <th style="text-align: center;">Seri Barang</th>
                                            <th style="text-align: center;">Seri Bahan Baku</th>
                                            <th style="text-align: center;">Seri Dokumen</th>
                                            <th style="text-align: center;">Kode Asal Bahan Baku</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_bahanbakudokumen ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noBahanBakuDokumen = 0;
                                            while ($rowBahanBakuDokumen = mysqli_fetch_array($dataTable)) {
                                                $noBahanBakuDokumen++;
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $noBahanBakuDokumen ?>. </td>
                                                    <td><?= $rowBahanBakuDokumen['NOMOR_AJU']; ?></td>
                                                    <td><?= $rowBahanBakuDokumen['SERI_BARANG']; ?></td>
                                                    <td><?= $rowBahanBakuDokumen['SERI_BAHAN_BAKU']; ?></td>
                                                    <td><?= $rowBahanBakuDokumen['SERI_DOKUMEN']; ?></td>
                                                    <td><?= $rowBahanBakuDokumen['KODE_ASAL_BAHAN_BAKU']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="6">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBahanBakuDokumen -->
                        <!-- IDBarang -->
                        <div class="tab-pane fade" id="IDBarang">
                            <div class="table-responsive">
                                <table id="TableBarang" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center;">Nomor Pengajuan</th>
                                            <th style="text-align: center;">Seri Barang</th>
                                            <th style="text-align: center;">Asuransi</th>
                                            <th style="text-align: center;">CIF</th>
                                            <th style="text-align: center;">CIF Rp.</th>
                                            <th style="text-align: center;">Diskon</th>
                                            <th style="text-align: center;">Flag Kendaraan</th>
                                            <th style="text-align: center;">FOB</th>
                                            <th style="text-align: center;">FREIGHT</th>
                                            <th style="text-align: center;">Barang Barang LDP</th>
                                            <th style="text-align: center;">Harga Invoice</th>
                                            <th style="text-align: center;">Harga Penyerahan</th>
                                            <th style="text-align: center;">Harga Satuan</th>
                                            <th style="text-align: center;">Jenis Kendaraan</th>
                                            <th style="text-align: center;">Jumlah Bahan Baku</th>
                                            <th style="text-align: center;">Jumlah KEMASAN</th>
                                            <th style="text-align: center;">Jumlah Satuan</th>
                                            <th style="text-align: center;">Kapasitas Silinder</th>
                                            <th style="text-align: center;">Kategori Barang</th>
                                            <th style="text-align: center;">Kode Asa; Barang</th>
                                            <th style="text-align: center;">Kode Barang</th>
                                            <th style="text-align: center;">Kode Fasilitas</th>
                                            <th style="text-align: center;">Kode Guna</th>
                                            <th style="text-align: center;">Kode Jenis Nilai</th>
                                            <th style="text-align: center;">Kode Kemasan</th>
                                            <th style="text-align: center;">Kode Lebih Dari 4 Tahun</th>
                                            <th style="text-align: center;">Kode Negara Asal</th>
                                            <th style="text-align: center;">Kode Satuan</th>
                                            <th style="text-align: center;">Kode Skema Tarif</th>
                                            <th style="text-align: center;">Kode Status</th>
                                            <th style="text-align: center;">Kondisi Barang</th>
                                            <th style="text-align: center;">Merk</th>
                                            <th style="text-align: center;">NETTO</th>
                                            <th style="text-align: center;">Nilai Incoterm</th>
                                            <th style="text-align: center;">Nilai Pabean</th>
                                            <th style="text-align: center;">No. Mesin</th>
                                            <th style="text-align: center;">Pos Tarif</th>
                                            <th style="text-align: center;">Seri Pos Tarif</th>
                                            <th style="text-align: center;">Spesifikasi Lain</th>
                                            <th style="text-align: center;">Tahun Pembuatan</th>
                                            <th style="text-align: center;">Tipe</th>
                                            <th style="text-align: center;">Ukuran</th>
                                            <th style="text-align: center;">Uraian</th>
                                            <th style="text-align: center;">Volume</th>
                                            <th style="text-align: center;">Seri Ijin</th>
                                            <th style="text-align: center;">ID Eksportir</th>
                                            <th style="text-align: center;">Nama Eksportir</th>
                                            <th style="text-align: center;">Alamat Eksportir</th>
                                            <th style="text-align: center;">Kode Perhitungan</th>
                                            <th style="text-align: center;">Seri Barang Dok. Asal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_barang ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noBarang = 0;
                                            while ($rowBarang = mysqli_fetch_array($dataTable)) {
                                                $noBarang++;
                                        ?>
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
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="51">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBarang -->
                        <!-- IDBarangTarif -->
                        <div class="tab-pane fade" id="IDBarangTarif">
                            <div class="table-responsive">
                                <table id="TableBarangTarif" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center;">Nomor Pengajuan</th>
                                            <th style="text-align: center;">Seri Barang</th>
                                            <th style="text-align: center;">Jenis Tarif</th>
                                            <th style="text-align: center;">Jumlah Satuan</th>
                                            <th style="text-align: center;">Kode Fasilitas</th>
                                            <th style="text-align: center;">Kode Komoditi Cukai</th>
                                            <th style="text-align: center;">Tarif Kode Satuan</th>
                                            <th style="text-align: center;">Tarif Kode Tarif</th>
                                            <th style="text-align: center;">Tarif NILAI BAYAR</th>
                                            <th style="text-align: center;">Tarif NILAI Fasilitas</th>
                                            <th style="text-align: center;">Tarif NILAI SUDAH DILUNASI</th>
                                            <th style="text-align: center;">Tarif</th>
                                            <th style="text-align: center;">Tarif Fasilitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_barangtarif ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noBarangTarif = 0;
                                            while ($rowBarangTarif = mysqli_fetch_array($dataTable)) {
                                                $noBarangTarif++;
                                        ?>
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
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="14">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBarangTarif -->
                        <!-- IDBarangDokumen -->
                        <div class="tab-pane fade" id="IDBarangDokumen">
                            <div class="table-responsive">
                                <table id="TableBarangDokumen" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center;">Nomor Pengajuan</th>
                                            <th style="text-align: center;">Seri Barang</th>
                                            <th style="text-align: center;">Seri Dokumen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_barangdokumen ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noBarangDokumen = 0;
                                            while ($rowBarangDokumen = mysqli_fetch_array($dataTable)) {
                                                $noBarangDokumen++;
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $noBarangDokumen ?>. </td>
                                                    <td><?= $rowBarangDokumen['NOMOR_AJU']; ?></td>
                                                    <td><?= $rowBarangDokumen['SERI_BARANG']; ?></td>
                                                    <td><?= $rowBarangDokumen['SERI_DOKUMEN']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="4">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDBarangDokumen -->
                        <!-- IDDokumen -->
                        <div class="tab-pane fade" id="IDDokumen">
                            <div class="table-responsive">
                                <table id="TableDokumen" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center;">Nomor Pengajuan</th>
                                            <th style="text-align: center;">Seri Dokumen</th>
                                            <th style="text-align: center;">Flag URL Dokumen</th>
                                            <th style="text-align: center;">Kode Jenis Dokumen</th>
                                            <th style="text-align: center;">No. Dokumen</th>
                                            <th style="text-align: center;">Tanggal Dokumen</th>
                                            <th style="text-align: center;">Tipe Dokumen</th>
                                            <th style="text-align: center;">URL Dokumen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_dokumen ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noDokumen = 0;
                                            while ($rowDokumen = mysqli_fetch_array($dataTable)) {
                                                $noDokumen++;
                                        ?>
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
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="9">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDDokumen -->
                        <!-- IDKemasan -->
                        <div class="tab-pane fade" id="IDKemasan">
                            <div class="table-responsive">
                                <table id="TableKemasan" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center;">Nomor Pengajuan</th>
                                            <th style="text-align: center;">Seri Kemasan</th>
                                            <th style="text-align: center;">Jumlah Kemasan</th>
                                            <th style="text-align: center;">Kesesuaian Dokumen</th>
                                            <th style="text-align: center;">Ket.</th>
                                            <th style="text-align: center;">Kode Jenis Kemasan</th>
                                            <th style="text-align: center;">Merek Kemasan</th>
                                            <th style="text-align: center;">NIP Gate IN</th>
                                            <th style="text-align: center;">NIP Gate OUT</th>
                                            <th style="text-align: center;">No. Polisi</th>
                                            <th style="text-align: center;">No. Segel</th>
                                            <th style="text-align: center;">Waktu Gate IN</th>
                                            <th style="text-align: center;">Waktu Gate OUT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_kemasan ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noKemasan = 0;
                                            while ($rowKemasan = mysqli_fetch_array($dataTable)) {
                                                $noKemasan++;
                                        ?>
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
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="14">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDKemasan -->
                        <!-- IDKontainer -->
                        <div class="tab-pane fade" id="IDKontainer">
                            <div class="table-responsive">
                                <table id="TableKontainer" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center;">Nomor Pengajuan</th>
                                            <th style="text-align: center;">Seri Kontainer</th>
                                            <th style="text-align: center;">Kesesuaian Dokumen</th>
                                            <th style="text-align: center;">Ket.</th>
                                            <th style="text-align: center;">Kode Stuffing</th>
                                            <th style="text-align: center;">Kode Tipe Kontainer</th>
                                            <th style="text-align: center;">Kode Ukuran Kontainer</th>
                                            <th style="text-align: center;">Flag Gate IN</th>
                                            <th style="text-align: center;">Flag Gate OUT</th>
                                            <th style="text-align: center;">No. Polisi</th>
                                            <th style="text-align: center;">No. Kontainer</th>
                                            <th style="text-align: center;">No. Segel</th>
                                            <th style="text-align: center;">Waktu Gate IN</th>
                                            <th style="text-align: center;">Waktu Gate OUT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_kontainer ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noKontainer = 0;
                                            while ($rowKontainer = mysqli_fetch_array($dataTable)) {
                                                $noKontainer++;
                                        ?>
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
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="15">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDKontainer -->
                        <!-- IDRespon -->
                        <div class="tab-pane fade" id="IDRespon">
                            <div class="table-responsive">
                                <table id="TableRespon" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center">Nomor Pengajuan</th>
                                            <th style="text-align: center">Kode Respon</th>
                                            <th style="text-align: center">No. Respon</th>
                                            <th style="text-align: center">Tanggal Respon</th>
                                            <th style="text-align: center">Waktu Respon</th>
                                            <th style="text-align: center">BYTE STRAM PDF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_respon ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noRespon = 0;
                                            while ($rowRespon = mysqli_fetch_array($dataTable)) {
                                                $noRespon++;
                                        ?>
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
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="7">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End IDRespon -->
                        <!-- IDStatus -->
                        <div class="tab-pane fade" id="IDStatus">
                            <div class="table-responsive">
                                <table id="TableStatus" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th style="text-align: center">Nomor Pengajuan</th>
                                            <th style="text-align: center">Kode Respon</th>
                                            <th style="text-align: center">No. Respon</th>
                                            <th style="text-align: center">Date Submit CK5 PLB</th>
                                            <th style="text-align: center">Date Export CK5 PLB</th>
                                            <th style="text-align: center">Date GB Submit Sarinah</th>
                                            <th style="text-align: center">Date GB Export Sarinah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_status ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noStatus = 0;
                                            while ($rowStatus = mysqli_fetch_array($dataTable)) {
                                                $noStatus++;
                                        ?>
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
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="8">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
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
                                            <th width="1%">No.</th>
                                            <th style="text-align: center">USERNAME</th>
                                            <th style="text-align: center">NAMA FILE</th>
                                            <th style="text-align: center">TOTAL DATA</th>
                                            <th style="text-align: center">DATE TIME</th>
                                            <th style="text-align: center">STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dataTable = $dbcon->query("SELECT * FROM plb_log ORDER BY ID DESC");
                                        if (mysqli_num_rows($dataTable) > 0) {
                                            $noLog = 0;
                                            while ($rowLog = mysqli_fetch_array($dataTable)) {
                                                $noLog++;
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $noLog ?>. </td>
                                                    <td><?= $rowLog['username']; ?></td>
                                                    <td><?= $rowLog['filename']; ?></td>
                                                    <td><?= $rowLog['totalupload']; ?></td>
                                                    <td><?= $rowLog['dateupload']; ?></td>
                                                    <td><?= $rowLog['status']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="6">
                                                    <center>
                                                        <div style="display: grid;">
                                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
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
        history.replaceState({}, '', './report_ck5_plb.php');
    }
    // UPDATE FAILED
    if (window?.location?.href?.indexOf('UploadFailed') > -1) {
        Swal.fire({
            title: 'Data gagal diupload!',
            icon: 'error',
            text: 'Data gagal diupload didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './report_ck5_plb.php');
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