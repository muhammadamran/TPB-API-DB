<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
// API - 
include "include/api.php";
// BAHAN BAKU
$contentBahanBaku = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_BahanBaku&AJU=' . $_GET['AJU']);
$dataBahanBaku = json_decode($contentBahanBaku, true);
// BAHAN BAKU TARIF
$contentBahanBakuTarif = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_BahanBakuTarif&AJU=' . $_GET['AJU']);
$dataBahanBakuTarif = json_decode($contentBahanBakuTarif, true);
// BAHAN BAKU DOKUMEN
$contentBahanBakuDokumen = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_BahanBakuDokumen&AJU=' . $_GET['AJU']);
$dataBahanBakuDokumen = json_decode($contentBahanBakuDokumen, true);
// BARANG
$contentBarang = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_Barang&AJU=' . $_GET['AJU']);
$dataBarang = json_decode($contentBarang, true);
// BARANG TARIF
$contentBarangTarif = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_BarangTarif&AJU=' . $_GET['AJU']);
$dataBarangTarif = json_decode($contentBarangTarif, true);
// BARANG DOKUMEN
$contentBarangDokumen = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_BarangDokumen&AJU=' . $_GET['AJU']);
$dataBarangDokumen = json_decode($contentBarangDokumen, true);
// DOKUMEN
$contentDokumen = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_Dokumen&AJU=' . $_GET['AJU']);
$dataDokumen = json_decode($contentDokumen, true);
// KEMASAN
$contentKemasan = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_Kemasan&AJU=' . $_GET['AJU']);
$dataKemasan = json_decode($contentKemasan, true);
// KONTAINER
$contentKontainer = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_Kontainer&AJU=' . $_GET['AJU']);
$dataKontainer = json_decode($contentKontainer, true);
?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-door-open icon-page"></i>
                <font class="text-page">Gate Mandiri</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Gate Mandiri</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Barang Masuk</a></li>
                <li class="breadcrumb-item active">Detail Nomor AJU <?= $_GET['AJU'] ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title">[Gate Mandiri] Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">

                    <!-- Menu -->
                    <ul class="nav nav-pills mb-2">
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
                    </ul>
                    <!-- Menu -->

                    <!-- Menu Tap -->
                    <div class="tab-content rounded bg-white mb-4">
                        <!-- IDBahanBaku -->
                        <div class="tab-pane fade" id="IDBahanBaku">
                            <div class="table-responsive">
                                <table id="TableBahanBaku" class="table table-striped table-bordered table-td-valign-middle">
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
                                <table id="TableBahanBakuTarif" class="table table-striped table-bordered table-td-valign-middle">
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
                                <table id="TableBahanBakuDokumen" class="table table-striped table-bordered table-td-valign-middle">
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
                                <table id="TableBarang" class="table table-striped table-bordered table-td-valign-middle">
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
                                <table id="TableBarangTarif" class="table table-striped table-bordered table-td-valign-middle">
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
                                <table id="TableBarangDokumen" class="table table-striped table-bordered table-td-valign-middle">
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
                                <table id="TableDokumen" class="table table-striped table-bordered table-td-valign-middle">
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
                                <table id="TableKemasan" class="table table-striped table-bordered table-td-valign-middle">
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
                                <table id="TableKontainer" class="table table-striped table-bordered table-td-valign-middle">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php include "include/jsDatatables.php"; ?>
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>