<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";

$StartTanggal = '';
$EndTanggal = '';

if (isset($_POST['filter_date'])) {
    if ($_POST["StartTanggal"] != '') {
        $StartTanggal = $_POST['StartTanggal'];
    }

    if ($_POST["EndTanggal"] != '') {
        $EndTanggal = $_POST['EndTanggal'];
    }
}

// API - 
include "include/api.php";
$content = get_content($resultAPI['url_api'] . 'reportPosisiBarang.php?StartTanggal=' . $StartTanggal . '&EndTanggal=' . $EndTanggal);
$data = json_decode($content, true);
?>

<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-desktop icon-page"></i>
                <font class="text-page">Laporan Posisi Barang</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Report</a></li>
                <li class="breadcrumb-item active">Laporan Posisi Barang</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span
                    id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;">
                        <?= date('h:m:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- Begin Row -->

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-perusahaan">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="report-button-filter">
                            <span class="pull-right hidden-print">
                                <?php if (isset($_POST['filter_date'])) { ?>
                                <a href="./report_posisi_barang.php" class="btn btn-yellow m-b-10" title="Reset"
                                    style="padding: 7px;">
                                    <div style="display: flex;justify-content: space-between;align-items: end;">
                                        <i class="fas fa-refresh"
                                            style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Reset
                                    </div>
                                </a>
                                <?php } ?>
                                <!-- For Filter Tanggal -->
                                <a href="#modal-Filter-tanggal" class="btn btn-sm btn-default m-b-10"
                                    data-toggle="modal" title="Filter Tanggal" style="padding: 7px;">
                                    <div style="display: flex;justify-content: space-between;align-items: end;">
                                        <i class="fas fa-filter"
                                            style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Filter Tanggal
                                    </div>
                                </a>
                                <div class="modal fade" id="modal-Filter-tanggal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="POST">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">[Laporan Posisi Barang] Filter Tanggal</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row"
                                                        style="display: grid;justify-content: center;align-items: center;">
                                                        <div class="col-12"
                                                            style="display: flex;justify-content: center;">
                                                            <img src="assets/img/svg/realisasi_b.svg"
                                                                alt="Laporan Realisasi Mitra Per Tahun" class="image"
                                                                width="50%">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row" style="display: flex;align-items: center;">
                                                        <div class="col-xl-5">
                                                            <div class="form-group">
                                                                <input type="date" name="StartTanggal"
                                                                    class="form-control" value="<?= $StartTanggal; ?>"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-2"
                                                            style="display: flex;justify-content: center;">
                                                            <div class="form-group">
                                                                s.d
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-5">
                                                            <div class="form-group">
                                                                <input type="date" name="EndTanggal"
                                                                    class="form-control" value="<?= $EndTanggal; ?>"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i
                                                            class="fas fa-times-circle"></i> Tutup</a>
                                                    <button type="submit" name="filter_date" class="btn btn-default"><i
                                                            class="fas fa-filter"></i> Filter Tanggal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End For Filter Tanggal -->
                                <?php if (isset($_POST['filter_date'])) { ?>
                                <form action="./export/excel_report_posisi_barang.php" target="_blank" method="POST"
                                    style="display: inline-block;">
                                    <input type="hidden" name="StartTanggal" value="<?= $StartTanggal; ?>">
                                    <input type="hidden" name="EndTanggal" value="<?= $EndTanggal; ?>">
                                    <button type="submit" name="find_" class="btn btn-sm btn-white m-b-10">
                                        <img src="assets/img/favicon/excel.png" class="icon-primary-excel" alt="Excel"
                                            data-toggle="popover" data-trigger="hover" data-title="Export File Excel"
                                            data-placement="top"
                                            data-content="Klik untuk mengexport data dalam file Excel"> Export Excel
                                    </button>
                                </form>
                                <!-- <a href="javascript:;" class="btn btn-sm btn-white m-b-10">
                                        <img src="assets/img/favicon/pdf.png" class="icon-primary-pdf" alt="PDF" data-toggle="popover" data-trigger="hover" data-title="Export File PDF" data-placement="top" data-content="Klik untuk mengexport data dalam file PDF"> Export PDF
                                    </a>
                                    <a href="report_ck5_plb_detail_print.php" class="btn btn-sm btn-white m-b-10">
                                        <img src="assets/img/favicon/print.png" class="icon-primary-print" alt="Print" data-toggle="popover" data-trigger="hover" data-title="Print File" data-placement="top" data-content="Klik untuk Print File"> Print
                                    </a> -->
                                <form action="./export/pdf_report_posisi_barang.php" target="_blank" method="POST"
                                    style="display: inline-block;">
                                    <input type="hidden" name="StartTanggal" value="<?= $StartTanggal; ?>">
                                    <input type="hidden" name="EndTanggal" value="<?= $EndTanggal; ?>">
                                    <button type="submit" name="find_" class="btn btn-sm btn-white m-b-10">
                                        <img src="assets/img/favicon/print.png" class="icon-primary-print" alt="Print"
                                            data-toggle="popover" data-trigger="hover" data-title="Print File"
                                            data-placement="top" data-content="Klik untuk Print File"> Print
                                    </button>
                                </form>
                                <?php } ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="line-page-table"></div>
                    </div>
                    <div style="display: flex;align-items: center;margin-top: 15px;margin-bottom: -0px;">
                        <div class="col-md-3">
                            <div style="display: flex;justify-content: center;">
                                <?php if ($resultHeadSetting['logo'] == NULL) { ?>
                                <img src="assets/images/logo/logo-default.png" width="30%">
                                <?php } else { ?>
                                <img src="assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="50%">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div style="display: grid;justify-content: left;">
                                <font style="font-size: 24px;font-weight: 800;">LAPORAN POSISI BARANG PER DOKUMEN PABEAN
                                </font>
                                <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?>
                                </font>
                                <?php if (isset($_POST['filter_date'])) { ?>
                                <font style="font-size: 14px;font-weight: 800;">Tanggal Masuk: <?= $StartTanggal ?> S.D
                                    <?= $EndTanggal ?></font>
                                <?php } ?>
                                <div class="line-page-table"></div>
                                <font style="font-size: 14px;font-weight: 400;"><?= $resultHeadSetting['address'] ?>
                                </font>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body text-inverse">
                    <div style="background: #4c4747;height: 4px;width: 100%;margin: 15px -1px;box-sizing: border-box;">
                    </div>
                    <div class="table-responsive">
                        <table id="table-posisi-barang"
                            class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">#</th>
                                    <th colspan="3" style="text-align: center;">Dokumen Pabean Masuk</th>
                                    <th rowspan="2" style="text-align: center;">Tanggal Masuk</th>
                                    <th rowspan="2" style="text-align: center;">Kode Barang (No. HS)</th>
                                    <th rowspan="2" style="text-align: center;">Seri Barang</th>
                                    <th rowspan="2" style="text-align: center;">Barang</th>
                                    <th rowspan="2" style="text-align: center;">Jumlah</th>
                                    <th rowspan="2" style="text-align: center;">Nilai Barang</th>
                                    <th colspan="3" style="text-align: center;">Dokumen Pabean Keluar</th>
                                    <th rowspan="2" style="text-align: center;">Tanggal Keluar</th>
                                    <th rowspan="2" style="text-align: center;">Kode Barang (No. HS)</th>
                                    <th rowspan="2" style="text-align: center;">Seri Barang</th>
                                    <th rowspan="2" style="text-align: center;">Barang</th>
                                    <th rowspan="2" style="text-align: center;">Jumlah</th>
                                    <th rowspan="2" style="text-align: center;">Nilai Barang</th>
                                    <th colspan="2" style="text-align: center;">Saldo Barang</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">Jenis</th>
                                    <th style="text-align: center;">No.</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Jenis</th>
                                    <th style="text-align: center;">No.</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Jumlah</th>
                                    <th style="text-align: center;">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['status'] == 404) { ?>
                                <tr>
                                    <td colspan="21">
                                        <center>
                                            <div style="display: flex;justify-content: center; align-items: center">
                                                <i class="fas fa-filter"></i>&nbsp;&nbsp;Filter Data
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                <?php } else { ?>
                                <?php $no = 0; ?>
                                <?php foreach ($data['result'] as $row) { ?>
                                <?php $no++ ?>
                                <tr>
                                    <!-- 9 -->
                                    <td><?= $no ?>.</td>
                                    <!-- PLB -->
                                    <td style="text-align: center;">
                                        <?php if ($row['KODE_JENIS_DOK_ASAL'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        BC <?= $row['KODE_JENIS_DOK_ASAL']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['NOMOR_AJU_DOK_ASAL'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['NOMOR_AJU_DOK_ASAL']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['TANGGAL_DAFTAR_DOK_ASAL'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TANGGAL_DAFTAR_DOK_ASAL']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['TANGGAL_DAFTAR_DOK_ASAL'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TANGGAL_DAFTAR_DOK_ASAL']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['KODE_BARANG'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['KODE_BARANG']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['SERI_BARANG'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['SERI_BARANG']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php if ($row['URAIAN'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['URAIAN']; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div style="display: flex;justify-content: space-between;align-items: center">
                                            <font><?= $row['KODE_SATUAN']; ?></font>
                                            <font><?= $row['JUMLAH_SATUAN']; ?></font>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex;justify-content: space-between;align-items: center">
                                            <font><?= $row['KODE_VALUTA']; ?></font>
                                            <font><?= $row['CIF']; ?></font>
                                        </div>
                                    </td>
                                    <!-- SARINAH -->
                                    <td style="text-align: center;">
                                        <?php if ($row['KODE_DOKUMEN_PABEAN'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        BC <?= $row['KODE_DOKUMEN_PABEAN']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['NOMOR_AJU'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['NOMOR_AJU']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['TANGGAL_DAFTAR'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TANGGAL_DAFTAR']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['TANGGAL_DAFTAR'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TANGGAL_DAFTAR']; ?>
                                        <?php } ?>
                                    </td>

                                    <td style="text-align: center;">
                                        <?php if ($row['KODE_BARANG'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['KODE_BARANG']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['SERI_BARANG'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['SERI_BARANG']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php if ($row['URAIAN'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['URAIAN']; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div style="display: flex;justify-content: space-between;align-items: center">
                                            <font><?= $row['KODE_SATUAN']; ?></font>
                                            <font><?= $row['JUMLAH_SATUAN']; ?></font>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex;justify-content: space-between;align-items: center">
                                            <font><?= $row['KODE_VALUTA']; ?></font>
                                            <font><?= $row['CIF']; ?></font>
                                        </div>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="invoice-footer">
                        <p class="text-center m-b-5 f-w-600">
                            Laporan Masuk Barang | IT Inventory <?= $resultHeadSetting['company'] ?>
                        </p>
                        <p class="text-center">
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>
                                <?= $resultHeadSetting['website'] ?></span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i>
                                T:<?= $resultHeadSetting['telp'] ?></span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>
                                <?= $resultHeadSetting['email'] ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Begin Row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php
// include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
?>
<script type="text/javascript">
// TableBarangTarif
$(document).ready(function() {
    $('#table-posisi-barang').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
        // dom: 'Bfrtip',
        // buttons: [
        //     'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'
        // ],
        // "order": [],
        // "columnDefs": [{
        //     "targets": 'no-sort',
        //     "orderable": false,
        // }],
        // iDisplayLength: -1
    });
});
</script>