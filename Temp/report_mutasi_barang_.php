<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
include "include/cssDatatables.php";

$StartTanggal = '';
$EndTanggal = '';

if (isset($_POST['filter_date'])) {
    if ($_POST["StartTanggal"] != '') {
        $StartTanggal   = $_POST['StartTanggal'];
    }

    if ($_POST["EndTanggal"] != '') {
        $EndTanggal     = $_POST['EndTanggal'];
    }
}

?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Mutasi Barang App Name | Company </title>
<?php } else { ?>
    <title>Laporan Mutasi Barang - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
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
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('H:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- begin Select Tabel -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Filter Data Mutasi Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <!-- <form action="" method="POST">
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
                    </form> -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Select Tabel -->

    <!-- Begin Row -->
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
                                <font style="font-size: 24px;font-weight: 800;">LAPORAN PERTANGGUNGJAWABAN MUTASI BARANG</font>
                                <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                                <?php if (isset($_POST['filter_date'])) { ?>
                                    <font style="font-size: 14px;font-weight: 800;"><i class="fas fa-calendar-check"></i> Tanggal: <?= $StartTanggal ?> S.D
                                        <?= $EndTanggal ?></font>
                                <?php } ?>
                                <div class="line-page-table"></div>
                                <font style="font-size: 18px;font-weight: 800;"><?= $resultHeadSetting['company_t'] ?></font>
                                <font style="font-size: 14px;font-weight: 400;"><i class="fa-solid fa-location-dot"></i> <?= $resultHeadSetting['address'] ?>
                                </font>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .bar {
                        display: flex;
                        justify-content: end;
                        background: transparent;
                    }
                </style>
                <div class="panel-body text-inverse">
                    <div style="background: #4c4747;height: 4px;width: 100%;margin: 15px -1px;box-sizing: border-box;">
                    </div>
                    <?php if (isset($_POST['filter_date'])) { ?>
                        <div class="bar">
                            <div style="padding: 5px;">
                                <a href="./report_masuk_barang.php" class="btn btn-warning" title="Reset" style="padding: 8px;">
                                    <div style="display: flex;justify-content: space-between;align-items: end;">
                                        <i class="fas fa-refresh" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Reset
                                    </div>
                                </a>
                            </div>
                            <div style="padding: 5px;">
                                <form action="./export/excel_report_masuk_barang.php" target="_blank" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="StartTanggal" value="<?= $StartTanggal; ?>">
                                    <input type="hidden" name="EndTanggal" value="<?= $EndTanggal; ?>">
                                    <button type="submit" name="find_" class="btn btn-secondary">
                                        <img src="assets/img/favicon/excel.png" class="icon-primary-excel" alt="Excel" data-toggle="popover" data-trigger="hover" data-title="Export File Excel" data-placement="top" data-content="Klik untuk mengexport data dalam file Excel">
                                        Export
                                        Excel
                                    </button>
                                </form>
                            </div>
                            <div style="padding: 5px;">
                                <form action="./export/pdf_report_masuk_barang.php" target="_blank" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="StartTanggal" value="<?= $StartTanggal; ?>">
                                    <input type="hidden" name="EndTanggal" value="<?= $EndTanggal; ?>">
                                    <button type="submit" name="find_" class="btn btn-secondary">
                                        <img src="assets/img/favicon/print.png" class="icon-primary-print" alt="Print" data-toggle="popover" data-trigger="hover" data-title="Print File" data-placement="top" data-content="Klik untuk Print File">
                                        Print
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div style="background: #4c4747;height: 4px;width: 100%;margin: 15px -1px;box-sizing: border-box;">
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table id="C_TableDefault_L" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th rowspan="2" style="text-align: center;">Kode Barang</th>
                                    <th rowspan="2" style="text-align: center;">Uraian Barang</th>
                                    <th rowspan="2" style="text-align: center;">TIPE</th>
                                    <th rowspan="2" style="text-align: center;">Golongan</th>
                                    <th rowspan="2" class="text-nowsrap no-sort" style="text-align: center;">Satuan</th>
                                    <th colspan="2" style="text-align: center;">Saldo Awal</th>
                                    <th colspan="2" style="text-align: center;">Mutasi Masuk</th>
                                    <th colspan="2" style="text-align: center;">Mutasi Keluar</th>
                                    <th rowspan="2" style="text-align: center;">Penyesuaian</th>
                                    <th colspan="2" style="text-align: center;">Saldo Akhir</th>
                                    <th colspan="2" style="text-align: center;">Stock Opname</th>
                                    <th colspan="2" style="text-align: center;">Selisih</th>
                                    <th colspan="2" style="text-align: center;">Petugas Sarinah</th>
                                    <th colspan="2" style="text-align: center;">Petugas BC</th>
                                    <th colspan="4" style="text-align: center;background: #f59c1a">Ket. Gate In</th>
                                    <th colspan="4" style="text-align: center;background: #90ca4b">Ket. Gate Out</th>
                                </tr>
                                <tr>
                                    <!-- <th style="text-align: center;">CT</th>
                                    <th style="text-align: center;">Botol</th> -->
                                    <th style="text-align: center;">CT</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">CT</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">CT</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">CT</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">CT</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">CT</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">In</th>
                                    <th style="text-align: center;">Out</th>
                                    <th style="text-align: center;">In</th>
                                    <th style="text-align: center;">Out</th>
                                    <!-- Gate In -->
                                    <th style="text-align: center;">Kurang</th>
                                    <th style="text-align: center;">Lebih</th>
                                    <th style="text-align: center;">Pecah</th>
                                    <th style="text-align: center;">Rusak</th>
                                    <!-- Gate Out -->
                                    <th style="text-align: center;">Kurang</th>
                                    <th style="text-align: center;">Lebih</th>
                                    <th style="text-align: center;">Pecah</th>
                                    <th style="text-align: center;">Rusak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT brg.ID,ct.ID_BARANG,brg.KODE_BARANG,brg.URAIAN,brg.TIPE,brg.SPESIFIKASI_LAIN,brg.KODE_SATUAN,brg.JUMLAH_SATUAN,
                                                            rcd.bm_nama_operator,rcd.bk_nama_operator,rcd.bc_in,rcd.bc_out,
                                                            (SELECT SUM(TOTAL_CT_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG) AS MUTASI_MASUK_CT,
                                                            (SELECT SUM(TOTAL_BOTOL_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG) AS MUTASI_MASUK_BTL,
                                                            (SELECT SUM(TOTAL_CT_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG) AS MUTASI_KELUAR_CT,
                                                            (SELECT SUM(TOTAL_BOTOL_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG) AS MUTASI_KELUAR_BTL,
                                                            -- IN
                                                            (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='IN') AS K_IN,
                                                            (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='IN') AS L_IN,
                                                            (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='IN') AS P_IN,
                                                            (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='IN') AS R_IN,
                                                            -- OUT
                                                            (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='OUT') AS K_OUT,
                                                            (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='OUT') AS L_OUT,
                                                            (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='OUT') AS P_OUT,
                                                            (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND POSISI='OUT') AS R_OUT,
                                                            -- STOCK OPNAME
                                                            (
                                                            (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG) + 
                                                            (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG ) +
                                                            (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG )
                                                            ) 
                                                            AS BTL_SO
                                                            FROM plb_barang AS brg
                                                            LEFT OUTER JOIN plb_barang_ct AS ct ON ct.ID_BARANG=brg.ID
                                                            LEFT OUTER JOIN rcd_status AS rcd ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                            WHERE rcd.upload_beritaAcara_GB IS NOT NULL
                                                            GROUP BY brg.ID 
                                                            ORDER BY brg.ID DESC", 0);
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <!-- Kode Barang -->
                                            <td style="text-align: left;">
                                                <?php if ($row['KODE_BARANG'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['KODE_BARANG']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- Barang -->
                                            <td style="text-align: left;">
                                                <?php if ($row['URAIAN'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['URAIAN']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['TIPE'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['TIPE']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['SPESIFIKASI_LAIN'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['SPESIFIKASI_LAIN']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <div style="display: flex;justify-content: space-between;align-items: center">
                                                    <font><?= $row['KODE_SATUAN']; ?></font>
                                                    <font><?= $row['JUMLAH_SATUAN']; ?></font>
                                                </div>
                                            </td>
                                            <!-- Saldo Awal -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                0
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                0
                                            </td>
                                            <!-- End Saldo Awal -->

                                            <!-- Mutasi Masuk -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?= $row['MUTASI_MASUK_CT']; ?> <font style="font-size: 3px;">(M In Ctn)</font>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?= $row['MUTASI_MASUK_BTL']; ?> <font style="font-size: 3px;">(M In Btl)</font>
                                            </td>
                                            <!-- End Mutasi Masuk -->

                                            <!-- Mutasi keluar -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?= $row['MUTASI_KELUAR_CT']; ?> <font style="font-size: 3px;">(M Out Ctn)</font>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?= $row['MUTASI_KELUAR_BTL']; ?> <font style="font-size: 3px;">(M Out Btl)</font>
                                            </td>
                                            <!-- End Mutasi keluar -->

                                            <!-- Penyesuaian -->
                                            <td style="text-align: center;">
                                                <?= $row['K_IN'] + $row['K_OUT'] + $row['P_IN'] + $row['P_OUT'] + $row['R_IN'] + $row['R_OUT']; ?>
                                            </td>
                                            <!-- End Penyesuaian -->

                                            <!-- Saldo Akhir -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?= $row['MUTASI_KELUAR_CT']; ?> <font style="font-size: 3px;">(M SA Ctn)</font>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?= $row['MUTASI_KELUAR_BTL']; ?> <font style="font-size: 3px;">(M SA Btl)</font>
                                            </td>
                                            <!-- End Saldo Akhir -->
                                            <!-- Stok Opname -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                0
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                0
                                            </td>
                                            <!-- End Stok Opname -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?= $row['MUTASI_MASUK_CT'] - $row['MUTASI_KELUAR_CT']; ?> <font style="font-size: 3px;">(M SO Ctn)</font>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?= $row['MUTASI_MASUK_BTL'] - $row['MUTASI_KELUAR_BTL']; ?> <font style="font-size: 3px;">(M SO Btl)</font>
                                            </td>
                                            <!-- End Selisih -->
                                            <!-- Petugas Sarinah-->
                                            <!-- IN -->
                                            <td style="text-align: center;">
                                                <?php if ($row['bm_nama_operator'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['bm_nama_operator']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- OUT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['bk_nama_operator'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['bk_nama_operator']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- Petugas BC -->
                                            <!-- IN -->
                                            <td style="text-align: center;">
                                                <?php if ($row['bc_in'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['bc_in']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- OUT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['bc_out'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['bc_out']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- IN -->
                                            <!-- KURANG -->
                                            <td style="text-align: center;">
                                                <?php if ($row['K_IN'] == NULL) { ?>
                                                    0
                                                <?php } else { ?>
                                                    <?= $row['K_IN']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- LEBIH -->
                                            <td style="text-align: center;">
                                                <?php if ($row['L_IN'] == NULL) { ?>
                                                    0
                                                <?php } else { ?>
                                                    <?= $row['L_IN']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- PECAH -->
                                            <td style="text-align: center;">
                                                <?php if ($row['P_IN'] == NULL) { ?>
                                                    0
                                                <?php } else { ?>
                                                    <?= $row['P_IN']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- RUSAK -->
                                            <td style="text-align: center;">
                                                <?php if ($row['R_IN'] == NULL) { ?>
                                                    0
                                                <?php } else { ?>
                                                    <?= $row['R_IN']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- OUT -->
                                            <!-- KURANG -->
                                            <td style="text-align: center;">
                                                <?php if ($row['K_OUT'] == NULL) { ?>
                                                    0
                                                <?php } else { ?>
                                                    <?= $row['K_OUT']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- LEBIH -->
                                            <td style="text-align: center;">
                                                <?php if ($row['L_OUT'] == NULL) { ?>
                                                    0
                                                <?php } else { ?>
                                                    <?= $row['L_OUT']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- PECAH -->
                                            <td style="text-align: center;">
                                                <?php if ($row['P_OUT'] == NULL) { ?>
                                                    0
                                                <?php } else { ?>
                                                    <?= $row['P_OUT']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- RUSAK -->
                                            <td style="text-align: center;">
                                                <?php if ($row['R_OUT'] == NULL) { ?>
                                                    0
                                                <?php } else { ?>
                                                    <?= $row['R_OUT']; ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="35">
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
include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
?>
<script type="text/javascript">
    $(function() {
        $("#input-filter").change(function() {
            if ($(this).val() == "TGL") {
                $("#form_tgl").show();
                $("#form_aju").hide();
            } else if ($(this).val() == "AJU") {
                $("#form_tgl").hide();
                $("#form_aju").show();
            } else {
                $("#form_tgl").hide();
                $("#form_aju").hide();
            }
        });
    });
</script>