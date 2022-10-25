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
// TOTAL BARANG
$contentBarangTotal = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_BarangTotal&AJU=' . $_GET['AJU']);
$dataBarangTotal = json_decode($contentBarangTotal, true);
// CEK BARANG
$contentBarangCek = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_BarangCek&AJU=' . $_GET['AJU']);
$dataBarangCek = json_decode($contentBarangCek, true);
// BARANG
$contentBarang = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_Barang&AJU=' . $_GET['AJU']);
$dataBarang = json_decode($contentBarang, true);
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
                <li class="breadcrumb-item active">Detail Nomor AJU: <?= $_GET['AJU'] ?></li>
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
                    <h4 class="panel-title">[Detail] Pengecekan Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">

                    <!-- Menu -->
                    <ul class="nav nav-pills mb-2">
                        <li class="nav-item">
                            <a href="#IDBarang" data-toggle="tab" class="nav-link active">
                                <span class="d-sm-none">
                                    Total Barang Masuk:
                                    <?php foreach ($dataBarangTotal['result'] as $rowBarangTotal) { ?>
                                        <?= $rowBarangTotal['total']; ?>
                                    <?php } ?>
                                    Barang
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDBarang" data-toggle="tab" class="nav-link">
                                <?php if ($dataBarangCek['status'] == 200) { ?>
                                    <span class="d-sm-none">
                                        Proses Pengecekan Barang:
                                        <?php foreach ($dataBarangCek['result'] as $rowBarangCek) { ?>
                                            <?= $rowBarangCek['total_cek']; ?>
                                        <?php } ?>
                                        Barang DiCek!
                                    </span>
                                <?php } else { ?>
                                    <span class="d-sm-none">
                                        Progress pengecekan Barang Masuk!
                                    </span>
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                    <!-- Menu -->

                    <!-- Menu Tap -->
                    <div class="tab-content rounded bg-white mb-4">
                        <!-- IDBarang -->
                        <div class="tab-pane fade active show" id="IDBarang">
                            <hr>
                            <div style="margin-bottom: 10px;">
                                <font style="font-weight: 800;">Status Barang:</font>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-success"><i class="fa-solid fa-check-circle"></i> Sesuai</button>
                                <button class="btn btn-sm btn-danger"><i class="fa-solid fa-minus"></i> Kurang</button>
                                <button class="btn btn-sm btn-lime"><i class="fa-solid fa-plus"></i> Lebih</button>
                                <button class="btn btn-sm btn-dark"><i class="fa-solid fa-tags"></i> Pecah</button>
                                <button class="btn btn-sm btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> Rusak</button>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" width="1%">No.</th>
                                            <th rowspan="2" style="text-align: center;">
                                                Ceklis Semua<br>
                                                <hr>
                                                <input type="checkbox">
                                            </th>
                                            <th rowspan="2" style="text-align: center;">Status</th>
                                            <th colspan="6" style="text-align: center;">Barang</th>
                                            <th colspan="3" style="text-align: center;">Jumlah</th>
                                            <th rowspan="2" style="text-align: center;">CIF</th>
                                            <th rowspan="2" style="text-align: center;">Harga Penyerahan</th>
                                            <th rowspan="2" style="text-align: center;">NETTO</th>
                                            <th rowspan="2" style="text-align: center;">Pos Tarif</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center;">Kode</th>
                                            <th style="text-align: center;">Seri Barang</th>
                                            <th style="text-align: center;">Uraian</th>
                                            <th style="text-align: center;">Tipe</th>
                                            <th style="text-align: center;">Ukuran</th>
                                            <th style="text-align: center;">Spesifikasi Barang</th>
                                            <th style="text-align: center;">Jumlah Bahan Baku</th>
                                            <th style="text-align: center;">Jumlah Kemasan</th>
                                            <th style="text-align: center;">Jumlah Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($dataBarang['status'] == 200) { ?>
                                            <?php $noBarang = 0; ?>
                                            <?php foreach ($dataBarang['result'] as $rowBarang) { ?>
                                                <?php $noBarang++ ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $noBarang ?>. </td>
                                                    <td style="text-align: center;">
                                                        <input type="checkbox">
                                                    </td>
                                                    <td style="text-align: left;">
                                                        <div style="display: grid;">
                                                            <font><i class="fa-solid fa-user-pen"></i>: Petugas</font>
                                                            <font><i class="fa-solid fa-file-circle-check"></i>: Status</font>
                                                        </div>
                                                    </td>
                                                    <td style=" text-align: center;"><?= $rowBarang['KODE_BARANG']; ?>
                                                    </td>
                                                    <td style="text-align: center;"><?= $rowBarang['SERI_BARANG']; ?></td>
                                                    <td style="text-align: left;"><?= $rowBarang['URAIAN']; ?></td>
                                                    <td style="text-align: center;"><?= $rowBarang['TIPE']; ?></td>
                                                    <td style="text-align: center;"><?= $rowBarang['UKURAN']; ?></td>
                                                    <td style="text-align: center;"><?= $rowBarang['SPESIFIKASI_LAIN']; ?></td>
                                                    <td style="text-align: center">
                                                        <?php if ($row['JUMLAH_BAHAN_BAKU'] == NULL) { ?>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                            </font>
                                                        <?php } else { ?>
                                                            <?= $row['JUMLAH_BAHAN_BAKU']; ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <?php if ($row['JUMLAH_KEMASAN'] == NULL) { ?>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                            </font>
                                                        <?php } else { ?>
                                                            <?= $row['JUMLAH_KEMASAN']; ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div style="display: flex;justify-content: space-evenly;align-items:center">
                                                            <font><?= $rowBarang['KODE_SATUAN']; ?></font>
                                                            <font><?= $rowBarang['JUMLAH_SATUAN']; ?></font>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;"><?= $rowBarang['CIF']; ?></td>
                                                    <td style="text-align: center;"><?= Rupiah($rowBarang['HARGA_PENYERAHAN']); ?></td>
                                                    <td style="text-align: center;"><?= $rowBarang['NETTO']; ?></td>
                                                    <td style="text-align: center;"><?= Rupiah($rowBarang['POS_TARIF']); ?></td>
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
                    </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#TableData').DataTable({
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