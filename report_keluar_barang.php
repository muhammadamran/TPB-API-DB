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
        $StartTanggal   = $_POST['StartTanggal'];
        // $rStartTanggal  = str_replace("-", "", $_POST['StartTanggal']);
    }

    if ($_POST["EndTanggal"] != '') {
        $EndTanggal     = $_POST['EndTanggal'];
        // $rEndTanggal  = str_replace("-", "", $_POST['EndTanggal']);
    }

    $Filter = 'work';
}

// API - 
include "include/api.php";
$content = get_content($resultAPI['url_api'] . 'reportKeluarBarang.php?function=get_lap&StartTanggal=' . $StartTanggal . '&EndTanggal=' . $EndTanggal . '&Filter=' . $Filter);
$data = json_decode($content, true);
?>

<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-desktop icon-page"></i>
                <font class="text-page">Laporan Keluar Barang</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Report</a></li>
                <li class="breadcrumb-item active">Laporan Keluar Barang</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;">
                        <?= date('h:m:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- begin Select Tabel -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Filter Data Keluar Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" method="POST">
                        <div style="display: flex;justify-content: center;align-items: center;">
                            <div style="display: flex;justify-content: center;align-items: center;">
                                <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="50%">
                            </div>
                            <div class="row">
                                <div class="col-xl-5">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="StartTanggal" class="form-control" value="<?= $StartTanggal; ?>" required>
                                    </div>
                                </div>
                                <div class="col-xl-2" style="display: flex;justify-content: center;align-self: center;margin-top: 25px;">
                                    <div class="form-group">
                                        S.D
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" name="EndTanggal" class="form-control" value="<?= $EndTanggal; ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" name="filter_date" class="btn btn-info m-r-5"><i class="fas fa-filter"></i>
                                        Filter Tanggal</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Select Tabel -->

    <?php if (isset($_POST['filter_date'])) { ?>
        <div class="row" style="display: flex;justify-content: end;">
            <div class="col-xl-3">
                <div class="panel panel-inverse" data-sortable-id="ui-perusahaan" style="padding: 15px;display: flex;justify-content: space-evenly;">
                    <?php if (isset($_POST['filter_date'])) { ?>
                        <a href="./report_keluar_barang.php" class="btn btn-yellow" title="Reset" style="padding: 7px;">
                            <div style="display: flex;justify-content: space-between;align-items: end;">
                                <i class="fas fa-refresh" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Reset
                            </div>
                        </a>
                    <?php } ?>
                    <?php if (isset($_POST['filter_date'])) { ?>
                        <form action="./export/excel_report_keluar_barang.php" target="_blank" method="POST" style="display: inline-block;">
                            <input type="hidden" name="StartTanggal" value="<?= $StartTanggal; ?>">
                            <input type="hidden" name="EndTanggal" value="<?= $EndTanggal; ?>">
                            <button type="submit" name="find_" class="btn btn-sm btn-white">
                                <img src="assets/img/favicon/excel.png" class="icon-primary-excel" alt="Excel" data-toggle="popover" data-trigger="hover" data-title="Export File Excel" data-placement="top" data-content="Klik untuk mengexport data dalam file Excel"> Export
                                Excel
                            </button>
                        </form>
                        <form action="./export/pdf_report_keluar_barang.php" target="_blank" method="POST" style="display: inline-block;">
                            <input type="hidden" name="StartTanggal" value="<?= $StartTanggal; ?>">
                            <input type="hidden" name="EndTanggal" value="<?= $EndTanggal; ?>">
                            <button type="submit" name="find_" class="btn btn-sm btn-white">
                                <img src="assets/img/favicon/print.png" class="icon-primary-print" alt="Print" data-toggle="popover" data-trigger="hover" data-title="Print File" data-placement="top" data-content="Klik untuk Print File"> Print
                            </button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-perusahaan">
                <div class="row">
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
                                <font style="font-size: 24px;font-weight: 800;">LAPORAN PENGELUARAN BARANG PER DOKUMEN
                                    PABEAN</font>
                                <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?>
                                </font>
                                <?php if (isset($_POST['filter_date'])) { ?>
                                    <font style="font-size: 14px;font-weight: 800;"><i class="fas fa-calendar-check"></i> Tanggal: <?= $StartTanggal ?> S.D
                                        <?= $EndTanggal ?></font>
                                <?php } ?>
                                <div class="line-page-table"></div>
                                <font style="font-size: 14px;font-weight: 400;"><i class="fa-solid fa-location-dot"></i> <?= $resultHeadSetting['address'] ?>
                                </font>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body text-inverse">
                    <div style="background: #4c4747;height: 4px;width: 100%;margin: 15px -1px;box-sizing: border-box;">
                    </div>
                    <div class="table-responsive">
                        <table id="table-keluar-barang" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th colspan="3" style="text-align: center;">Dokumen Pabean</th>
                                    <th colspan="2" style="text-align: center;">Bukti Pengeluaran</th>
                                    <th rowspan="2" style="text-align: center;">Tujuan / Penerima</th>
                                    <th rowspan="2" style="text-align: center;">Kode Barang</th>
                                    <th rowspan="2" style="text-align: center;">Barang</th>
                                    <th rowspan="2" style="text-align: center;">Jumlah</th>
                                    <th rowspan="2" style="text-align: center;">Nilai Barang</th>
                                    <th rowspan="2" style="text-align: center;">Tanggal & Waktu Masuk</th>
                                    <th colspan="2" style="text-align: center;">Petugas Penerima</th>
                                    <th rowspan="2" style="text-align: center;">Dokumen Upload</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">Jenis Dok. Pabean</th>
                                    <th style="text-align: center;">Nomor Pengajuan</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">No. Daftar</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Sarinah</th>
                                    <th style="text-align: center;">BC</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT *,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            ORDER BY plb.ID ASC", 0);
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <!-- 9 -->
                                            <!-- NO -->
                                            <td><?= $no ?>.</td>
                                            <!-- BC -->
                                            <td style="text-align: center;">BC <?= $row['KODE_DOKUMEN_PABEAN']; ?></td>
                                            <!-- AJU -->
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_AJU'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- TGL AJU (FILTER) -->
                                            <?php
                                            $dataTGLAJU = $row['TGL_AJU'];
                                            $dataTGLAJUY = substr($dataTGLAJU, 0, 4);
                                            $dataTGLAJUM = substr($dataTGLAJU, 4, 2);
                                            $dataTGLAJUD =  substr($dataTGLAJU, 6, 2);

                                            $datTGLAJU = $dataTGLAJUY . '-' . $dataTGLAJUM . '-' . $dataTGLAJUD;
                                            ?>
                                            <td><?= $datTGLAJU; ?></td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_DAFTAR'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_DAFTAR']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- NOMOR BC 11 -->
                                            <td style="text-align: center">
                                                <?php if ($row['TANGGAL_DAFTAR'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['TANGGAL_DAFTAR']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- NAMA PEMASOK -->
                                            <td style="text-align: center">
                                                <?php if ($row['NAMA_PEMASOK'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NAMA_PEMASOK']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- HS -->
                                            <td style="text-align: center">
                                                <?php
                                                if ($row['KODE_BARANG'] == NULL) {
                                                    $KDBRG = "<font style='font-size: 8px;font-weight: 600;color: red'><i>Data Kosong!</i></font>";
                                                } else {
                                                    $KDBRG = $row['KODE_BARANG'];
                                                }
                                                if ($row['POS_TARIF'] == NULL) {
                                                    $POSTARIF = "<font style='font-size: 8px;font-weight: 600;color: red'><i>Data Kosong!</i></font>";
                                                } else {
                                                    $POSTARIF = $row['POS_TARIF'];
                                                }
                                                ?>
                                                <?= $KDBRG ?>
                                            </td>
                                            <!-- BARANG -->
                                            <td><?= $row['URAIAN']; ?></td>
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
                                            <td style="text-align: center">
                                                -
                                            </td>
                                            <td>
                                                Petugas Sarinah
                                            </td>
                                            <td>
                                                Petugas BC
                                            </td>
                                            <td style="text-align: center">
                                                -
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="15">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="invoice-footer">
                        <p class="text-center m-b-5 f-w-600">
                            Laporan Keluar Barang | IT Inventory <?= $resultHeadSetting['company'] ?>
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
        $('#table-keluar-barang').DataTable({
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