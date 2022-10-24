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

$Month = '';
$Year = '';

if (isset($_POST['filter_date'])) {
    if ($_POST["Month"] != '') {
        $Month = $_POST['Month'];
    }

    if ($_POST["Year"] != '') {
        $Year = $_POST['Year'];
    }
}
// API - 
include "include/api.php";
$content = get_content($resultAPI['url_api'] . 'reportMutasiBarang.php?Month=' . $Month . '&Years=' . $Year);
$data = json_decode($content, true);
?>
?>

<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-desktop icon-page"></i>
                <font class="text-page">Laporan Mutasi Barang</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Report</a></li>
                <li class="breadcrumb-item active">Laporan Mutasi Barang</li>
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
                                <a href="./report_mutasi_barang.php" class="btn btn-yellow m-b-10" title="Reset"
                                    style="padding: 7px;">
                                    <div style="display: flex;justify-content: space-between;align-items: end;">
                                        <i class="fas fa-refresh"
                                            style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Reset
                                    </div>
                                </a>
                                <?php } ?>
                                <!-- For Filter Periode -->
                                <a href="#modal-Filter-periode" class="btn btn-sm btn-default m-b-10"
                                    data-toggle="modal" title="Filter Periode" style="padding: 7px;">
                                    <div style="display: flex;justify-content: space-between;align-items: end;">
                                        <i class="fas fa-filter"
                                            style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Filter Periode
                                    </div>
                                </a>
                                <div class="modal fade" id="modal-Filter-periode">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="POST">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">[Laporan Mutasi Barang] Filter Periode</h4>
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
                                                                <select type="text" class="default-select2 form-control"
                                                                    name="Month" id="IDBulan">
                                                                    <?php if ($Month != NULL) { ?>
                                                                    <option value="<?= $Month ?>"><?= $Month ?></option>
                                                                    <option value="">-- Pilih Bulan --</option>
                                                                    <?php } else { ?>
                                                                    <option value="">-- Pilih Bulan --</option>
                                                                    <?php } ?>
                                                                    <!-- <option value="All">Semua Bulan</option> -->
                                                                    <option value="01">Januari</option>
                                                                    <option value="02">Februari</option>
                                                                    <option value="03">Maret</option>
                                                                    <option value="04">April</option>
                                                                    <option value="05">Mei</option>
                                                                    <option value="06">Juni</option>
                                                                    <option value="07">Juli</option>
                                                                    <option value="08">Agustus</option>
                                                                    <option value="09">September</option>
                                                                    <option value="10">Oktober</option>
                                                                    <option value="11">November</option>
                                                                    <option value="12">Desember</option>
                                                                </select>
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
                                                                <select type="text" class="default-select2 form-control"
                                                                    name="Year" id="IDTahun">
                                                                    <?php if ($Year != NULL) { ?>
                                                                    <option value="<?= $Year ?>"><?= $Year ?></option>
                                                                    <option value="">-- Pilih Tahun --</option>
                                                                    <?php } else { ?>
                                                                    <option value="">-- Pilih Tahun --</option>
                                                                    <?php } ?>
                                                                    <?php
                                                                    for ($i = date('Y'); $i >= date('Y') - 32; $i -= 1) {
                                                                        echo "<option value='$i'> $i </option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i
                                                            class="fas fa-times-circle"></i> Tutup</a>
                                                    <button type="submit" name="filter_date" class="btn btn-default"><i
                                                            class="fas fa-filter"></i> Filter Periode</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End For Filter Periode -->
                                <?php if (isset($_POST['filter_date'])) { ?>
                                <form action="./export/excel_report_mutasi_barang.php" target="_blank" method="POST"
                                    style="display: inline-block;">
                                    <input type="hidden" name="Month" value="<?= $Month; ?>">
                                    <input type="hidden" name="Year" value="<?= $Year; ?>">
                                    <button type="submit" name="find_" class="btn btn-sm btn-white m-b-10">
                                        <img src="assets/img/favicon/excel.png" class="icon-primary-excel" alt="Excel"
                                            data-toggle="popover" data-trigger="hover" data-title="Export File Excel"
                                            data-placement="top"
                                            data-content="Klik untuk mengexport data dalam file Excel"> Export Excel
                                    </button>
                                </form>
                                <!-- <a href="javascript:;" class="btn btn-sm btn-white m-b-10">
                                        <img src="assets/img/favicon/pdf.png" class="icon-primary-pdf" alt="PDF" data-toggle="popover" data-trigger="hover" data-title="Export File PDF" data-placement="top" data-content="Klik untuk mengexport data dalam file PDF"> Export PDF
                                    </a> -->
                                <form action="./export/pdf_report_mutasi_barang.php" target="_blank" method="POST"
                                    style="display: inline-block;">
                                    <input type="hidden" name="Month" value="<?= $Month; ?>">
                                    <input type="hidden" name="Year" value="<?= $Year; ?>">
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
                                <font style="font-size: 24px;font-weight: 800;">LAPORAN PERTANGGUNGJAWABAN MUTASI BARANG
                                </font>
                                <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?>
                                </font>
                                <?php if (isset($_POST['filter_date'])) { ?>
                                <?php
                                    if ($Month == '01') {
                                        $DecMont = 'Januari';
                                    } else if ($Month == '02') {
                                        $DecMont = 'Februari';
                                    } else if ($Month == '03') {
                                        $DecMont = 'Maret';
                                    } else if ($Month == '04') {
                                        $DecMont = 'April';
                                    } else if ($Month == '05') {
                                        $DecMont = 'Mei';
                                    } else if ($Month == '06') {
                                        $DecMont = 'Juni';
                                    } else if ($Month == '07') {
                                        $DecMont = 'Juli';
                                    } else if ($Month == '08') {
                                        $DecMont = 'Agustus';
                                    } else if ($Month == '09') {
                                        $DecMont = 'September';
                                    } else if ($Month == '10') {
                                        $DecMont = 'Oktober';
                                    } else if ($Month == '11') {
                                        $DecMont = 'November';
                                    } else if ($Month == '12') {
                                        $DecMont = 'Desember';
                                    }
                                    ?>
                                <font style="font-size: 14px;font-weight: 800;">Periode: <?= $DecMont ?> / <?= $Year ?>
                                </font>
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
                        <table id="table-mutasi-barang"
                            class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th style="text-align: center;">Kode Barang (No. HS)</th>
                                    <th style="text-align: center;">Barang</th>
                                    <th style="text-align: center;">Jenis</th>
                                    <th style="text-align: center;">Golongan</th>
                                    <th style="text-align: center;">Satuan</th>
                                    <th style="text-align: center;">Saldo Awal</th>
                                    <th style="text-align: center;">Mutasi Masuk</th>
                                    <th style="text-align: center;">Mutasi Keluar</th>
                                    <th style="text-align: center;">Penyesuaian</th>
                                    <th style="text-align: center;">Saldo Akhir</th>
                                    <th style="text-align: center;">Stock Opname</th>
                                    <th style="text-align: center;">Selisih</th>
                                    <th style="text-align: center;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['status'] == 404) { ?>
                                <tr>
                                    <td colspan="14">
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
                                    <td style="text-align: center;">
                                        <?php if ($row['KODE_BARANG'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['KODE_BARANG']; ?>
                                        <?php } ?>
                                    </td>
                                    <td><?= $row['URAIAN']; ?></td>
                                    <td><?= $row['UKURAN']; ?></td>
                                    <td><?= $row['TIPE']; ?></td>
                                    <td>
                                        <div style="display: flex;justify-content: space-between;align-items: center">
                                            <font><?= $row['KODE_SATUAN']; ?></font>
                                            <font><?= $row['JUMLAH_SATUAN']; ?></font>
                                        </div>
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>-</td>
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
                            Laporan Mutasi Barang | IT Inventory <?= $resultHeadSetting['company'] ?>
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
include "include/jsForm.php";
?>
<script type="text/javascript">
// TableBarangTarif
$(document).ready(function() {
    $('#table-mutasi-barang').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     'copyHtml5',
        //     'excelHtml5',
        //     'csvHtml5',
        //     'pdfHtml5'
        // ]
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'
        ],
        "order": [],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        iDisplayLength: -1
    });
});
</script>