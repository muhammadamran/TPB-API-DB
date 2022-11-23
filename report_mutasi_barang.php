<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";

// FUNCTION SEARCHING
$FindBulan = '';
$FindTahun = '';
$ShowFind  = 'Bulan ' . date('m') . ' Tahun ' . date('Y');

if (isset($_POST['FindFilter'])) {
    $FindBulan = $_POST['FindBulan'];
    $FindTahun = $_POST['FindTahun'];
    $ShowFind  = 'Bulan ' . $_POST['FindBulan'] . ' Tahun ' . $_POST['FindTahun'];
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
                <i class="fa-solid fa-building-circle-exclamation icon-page"></i>
                <font class="text-page">Laporan Mutasi Barang</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Laporan</a></li>
                <li class="breadcrumb-item active">Laporan Mutasi Barang</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('H:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin Search -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-filter"></i> Filter Stok Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Bulan & Tahun</label>
                                <div class="col-md-4">
                                    <select type="text" class="default-select2 form-control" name="FindBulan">
                                        <?php if ($FindBulan == NULL) { ?>
                                            <option value="">Pilih Bulan</option>
                                        <?php } else { ?>
                                            <option value="<?= $FindBulan ?>"><?= $FindBulan ?></option>
                                            <option value="">Pilih Bulan</option>
                                        <?php } ?>
                                        <option value="1">January</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select type="text" class="default-select2 form-control" name="FindTahun">
                                        <?php if ($FindTahun == NULL) { ?>
                                            <option value="">Pilih Tahun</option>
                                        <?php } else { ?>
                                            <option value="<?= $FindTahun ?>"><?= $FindTahun ?></option>
                                            <option value="">Pilih Tahun</option>
                                        <?php } ?>
                                        <?php
                                        for ($year = date('Y'); $year >= date('Y') - 2; $year -= 1) {
                                            echo "<option value='$year'> $year </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7 offset-md-3">
                                    <button type="submit" class="btn btn-info m-r-5" name="FindFilter">
                                        <i class="fa fa-search"></i>
                                        <font class="f-action">Cari</font>
                                    </button>
                                    <a href="report_mutasi_barang.php" type="button" class="btn btn-warning m-r-5">
                                        <i class="fa fa-refresh"></i>
                                        <font class="f-action">Reset</font>
                                    </a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search -->

    <!-- Begin Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-perusahaan">
                <div class="row" style="display: flex;align-items: center;margin-top: 15px;margin-bottom: -0px;padding: 25px;margin: 10px;">
                    <?php if (isset($_POST["FindFilter"])) { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <form action="report_mutasi_barang_pdf.php" target="_blank" method="POST">
                                        <input type="hidden" name="FindBulan" value="<?= $FindBulan ?>">
                                        <input type="hidden" name="FindTahun" value="<?= $FindTahun ?>">
                                        <input type="hidden" name="ShowFind" value="<?= $ShowFind ?>">
                                        <button type="submit" name="FindFilter" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                                    </form>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="report_mutasi_barang_excel.php" target="_blank" method="POST">
                                            <input type="hidden" name="FindBulan" value="<?= $FindBulan ?>">
                                            <input type="hidden" name="FindTahun" value="<?= $FindTahun ?>">
                                            <input type="hidden" name="ShowFind" value="<?= $ShowFind ?>">
                                            <button type="submit" name="FindFilter" class="dropdown-item">Download as XLS</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-12">
                            <div style="display: flex;justify-content: end;">
                                <div>
                                    <a href="report_mutasi_barang_pdf.php" target="_blank" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</a>
                                </div>
                                <div class="btn-group m-r-5 m-b-5">
                                    <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                                    <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="report_mutasi_barang_excel.php" target="_blank" class="dropdown-item">Download as XLS</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-3 m-b-20">
                        <div style="display: flex;justify-content: center;">
                            <?php if ($resultHeadSetting['logo'] == NULL) { ?>
                                <img src="assets/images/logo/logo-default.png" width="30%">
                            <?php } else { ?>
                                <img src="assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="50%">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-9" style="display: grid;justify-content: left;">
                        <font style="font-size: 24px;font-weight: 800;text-transform:uppercase">LAPORAN PERTANGGUNGJAWABAN MUTASI BARANG</font>
                        <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                        <font style="font-size: 14px;font-weight: 800;">
                            Periode: <?= $ShowFind; ?>
                        </font>
                        <div class="line-page-table"></div>
                        <font style="font-size: 18px;font-weight: 800;"><?= $resultHeadSetting['company_t'] ?></font>
                        <font style="font-size: 14px;font-weight: 400;"><i class="fa-solid fa-location-dot"></i> <?= $resultHeadSetting['address'] ?>
                        </font>
                    </div>
                    <div class="col-md-12" style="margin-bottom: -40px;">
                        <hr>
                    </div>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="C_TableDefault_L" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th rowspan="2" style="text-align: center;">Kode<font style="color: #dadddf;">.</font>Barang</th>
                                    <th rowspan="2" style="text-align: center;">Uraian</th>
                                    <th rowspan="2" style="text-align: center;">Spesifikasi<font style="color: #dadddf;">.</font>Lain</th>
                                    <th rowspan="2" style="text-align: center;">Satuan</th>
                                    <th colspan="2" style="text-align: center;">Saldo Awal</th>
                                    <th colspan="2" style="text-align: center;">Mutasi<font style="color: #dadddf;">.</font>Masuk</th>
                                    <th colspan="2" style="text-align: center;">Mutasi<font style="color: #dadddf;">.</font>Keluar</th>
                                    <th colspan="2" style="text-align: center;">Saldo<font style="color: #dadddf;">.</font>Akhir</th>
                                    <th rowspan="2" style="text-align: center;">
                                        <i>Stock<font style="color: #dadddf;">.</font>Opname</i>
                                        <br>
                                        <font style="font-size: 10px;font-weight:400"><i>Berdasarkan<font style="color: #dadddf;">.</font>Botol</i></font>
                                    </th>
                                    <th colspan="2" style="text-align: center;">Selisih</th>
                                    <th colspan="2" style="text-align: center;">Penyesuaian</th>
                                    <th colspan="2" style="text-align: center;">Keterangan</th>
                                    <th colspan="2" style="text-align: center;">Petugas<font style="color: #dadddf;">.</font><?= $resultSetting['company']; ?></th>
                                    <th colspan="2" style="text-align: center;">Petugas<font style="color: transparent;">.</font>BeaCukai</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Carton</th>
                                    <th style="text-align: center;">Botol</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
                                    <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dateMB        = date('m');
                                $dateYB        = date('Y');
                                if (isset($_POST['FindFilter'])) {
                                    $dataTable = $dbcon->query("SELECT 
                                                                stok.kd_barang,
                                                                stok.uraian AS uraian_stok,
                                                                stok.carton AS carton_stok,
                                                                stok.botol AS botol_stok,
                                                                stok.stock_month,
                                                                stok.stock_year,
                                                                brg.ID,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN,
                                                                brg.SPESIFIKASI_LAIN,
                                                                brg.KODE_SATUAN,
                                                                brg.BOTOL,
                                                                brg.SERI_BARANG,
                                                                rcd.bm_nama_operator,
                                                                rcd.bk_nama_operator,
                                                                rcd.bc_in,
                                                                rcd.bc_out,
                                                                -- MUTASI MASUK KONDISI BARANG MASUK (GATE IN)
                                                                (SELECT SUM(TOTAL_CT_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$FindBulan' AND EXTRACT(YEAR FROM DATE_CT)='$FindTahun') AS MUTASI_MASUK_CT,
                                                                (SELECT SUM(TOTAL_BOTOL_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$FindBulan' AND EXTRACT(YEAR FROM DATE_CT)='$FindTahun') AS MUTASI_MASUK_BTL,
                                                                -- END MUTASI MASUK KONDISI BARANG MASUK (GATE IN)
                                                                -- MUTASI KELUAR KONDISI BARANG KELUAR (GATE OUT)
                                                                (SELECT SUM(TOTAL_CT_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS_GB='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$FindBulan' AND EXTRACT(YEAR FROM DATE_CT)='$FindTahun') AS MUTASI_KELUAR_CT,
                                                                (SELECT SUM(TOTAL_BOTOL_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS_GB='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$FindBulan' AND EXTRACT(YEAR FROM DATE_CT)='$FindTahun') AS MUTASI_KELUAR_BTL,
                                                                -- END MUTASI KELUAR KONDISI BARANG KELUAR (GATE OUT)
                                                                -- SALDO AKHIR
                                                                -- STOK KD BARANG + MUTASI_KELUAR
                                                                -- END SALDO AKHIR
                                                                -- STOCK OPNAME
                                                                -- END STOCK OPNAME
                                                                -- STOK BOTOL + BARANG REJECT IN + BARANG REJECT OUT
                                                                -- PENYESUAIAN
                                                                -- IN
                                                                (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS K_IN,
                                                                (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS L_IN,
                                                                (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS P_IN,
                                                                (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS R_IN,
                                                                -- OUT
                                                                (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS K_OUT,
                                                                (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS L_OUT,
                                                                (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS P_OUT,
                                                                (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS R_OUT
                                                                -- PENYESUAIAN
                                                                FROM plb_barang AS brg
                                                                LEFT OUTER JOIN tbl_cust_stock AS stok ON brg.KODE_BARANG=stok.kd_barang AND stok.stock_month='$FindBulan' AND stok.stock_year='$FindTahun'
                                                                LEFT OUTER JOIN rcd_status AS rcd ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                                WHERE EXTRACT(MONTH FROM brg.DATE_CT)='$FindBulan' AND EXTRACT(YEAR FROM brg.DATE_CT)='$FindTahun'
                                                                GROUP BY brg.KODE_BARANG 
                                                                ORDER BY brg.KODE_BARANG ASC, brg.SERI_BARANG ASC", 0);
                                } else {
                                    $dataTable = $dbcon->query("SELECT 
                                                                stok.kd_barang,
                                                                stok.uraian AS uraian_stok,
                                                                stok.carton AS carton_stok,
                                                                stok.botol AS botol_stok,
                                                                stok.stock_month,
                                                                stok.stock_year,
                                                                brg.ID,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN,
                                                                brg.SPESIFIKASI_LAIN,
                                                                brg.KODE_SATUAN,
                                                                brg.BOTOL,
                                                                brg.SERI_BARANG,
                                                                rcd.bm_nama_operator,
                                                                rcd.bk_nama_operator,
                                                                rcd.bc_in,
                                                                rcd.bc_out,
                                                                -- MUTASI MASUK KONDISI BARANG MASUK (GATE IN)
                                                                (SELECT SUM(TOTAL_CT_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM DATE_CT)='$dateYB') AS MUTASI_MASUK_CT,
                                                                (SELECT SUM(TOTAL_BOTOL_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM DATE_CT)='$dateYB') AS MUTASI_MASUK_BTL,
                                                                -- END MUTASI MASUK KONDISI BARANG MASUK (GATE IN)
                                                                -- MUTASI KELUAR KONDISI BARANG KELUAR (GATE OUT)
                                                                (SELECT SUM(TOTAL_CT_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS_GB='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM DATE_CT)='$dateYB') AS MUTASI_KELUAR_CT,
                                                                (SELECT SUM(TOTAL_BOTOL_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS_GB='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM DATE_CT)='$dateYB') AS MUTASI_KELUAR_BTL,
                                                                -- END MUTASI KELUAR KONDISI BARANG KELUAR (GATE OUT)
                                                                -- SALDO AKHIR
                                                                -- STOK KD BARANG + MUTASI_KELUAR
                                                                -- END SALDO AKHIR
                                                                -- STOCK OPNAME
                                                                -- END STOCK OPNAME
                                                                -- STOK BOTOL + BARANG REJECT IN + BARANG REJECT OUT
                                                                -- PENYESUAIAN
                                                                -- IN
                                                                (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS K_IN,
                                                                (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS L_IN,
                                                                (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS P_IN,
                                                                (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS R_IN,
                                                                -- OUT
                                                                (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS K_OUT,
                                                                (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS L_OUT,
                                                                (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS P_OUT,
                                                                (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS R_OUT
                                                                -- PENYESUAIAN
                                                                FROM plb_barang AS brg
                                                                LEFT OUTER JOIN tbl_cust_stock AS stok ON brg.KODE_BARANG=stok.kd_barang AND stok.stock_month='$dateMB' AND stok.stock_year='$dateYB'
                                                                LEFT OUTER JOIN rcd_status AS rcd ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                                WHERE EXTRACT(MONTH FROM brg.DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM brg.DATE_CT)='$dateYB'
                                                                GROUP BY brg.KODE_BARANG 
                                                                ORDER BY brg.KODE_BARANG ASC, brg.SERI_BARANG ASC", 0);
                                }
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                        // PENYESUAIAN IN
                                        $P_IN = $row['K_IN'] + $row['L_IN'] + $row['P_IN'] + $row['R_IN'];
                                        // PENYESUAIAN OUT
                                        $P_OUT = $row['K_OUT'] + $row['L_OUT'] + $row['P_OUT'] + $row['R_OUT'];
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
                                                <?php if ($row['SPESIFIKASI_LAIN'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['SPESIFIKASI_LAIN']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['KODE_SATUAN'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['KODE_SATUAN']; ?>
                                                <?php } ?>
                                            </td>
                                            <!-- Saldo Awal -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['carton_stok'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(SCtn)</font>
                                                <?php } else { ?>
                                                    <?= $row['carton_stok']; ?><font style="font-size: 3px;">(SCtn)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?php if ($row['botol_stok'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(SBtl)</font>
                                                <?php } else { ?>
                                                    <?= $row['botol_stok']; ?><font style="font-size: 3px;">(SBtl)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- End Saldo Awal -->
                                            <!-- Mutasi Masuk -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['MUTASI_MASUK_CT'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(MInBtl)</font>
                                                <?php } else { ?>
                                                    <?= $row['MUTASI_MASUK_CT']; ?><font style="font-size: 3px;">(MInBtl)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?php if ($row['MUTASI_MASUK_BTL'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(MInBtl)</font>
                                                <?php } else { ?>
                                                    <?= $row['MUTASI_MASUK_BTL']; ?><font style="font-size: 3px;">(MInBtl)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- End Mutasi Masuk -->
                                            <!-- Mutasi keluar -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?php if ($row['MUTASI_KELUAR_CT'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(MOutCtn)</font>
                                                <?php } else { ?>
                                                    <?= $row['MUTASI_KELUAR_CT']; ?><font style="font-size: 3px;">(MOutCtn)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?php if ($row['MUTASI_KELUAR_BTL'] == NULL) { ?>
                                                    0<font style="font-size: 3px;">(MOutBtl)</font>
                                                <?php } else { ?>
                                                    <?= $row['MUTASI_KELUAR_BTL']; ?><font style="font-size: 3px;">(MOutBtl)</font>
                                                <?php } ?>
                                            </td>
                                            <!-- End Mutasi keluar -->
                                            <!-- End Penyesuaian -->
                                            <!-- Saldo Akhir -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?= $row['carton_stok'] + $row['MUTASI_KELUAR_CT']; ?><font style="font-size: 3px;">(MSACtn)</font>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?= $row['botol_stok'] + $row['MUTASI_KELUAR_BTL']; ?><font style="font-size: 3px;">(MSABtl)</font>
                                            </td>
                                            <!-- End Saldo Akhir -->
                                            <!-- Stok Opname -->
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?= $row['botol_stok'] + $P_IN + $P_OUT ?><font style="font-size: 3px;">(SO)</font>
                                            </td>
                                            <!-- End Stok Opname -->
                                            <!-- Selisih -->
                                            <!-- CT -->
                                            <td style="text-align: center;">
                                                <?= $row['MUTASI_MASUK_CT'] - $row['MUTASI_KELUAR_CT']; ?><font style="font-size: 3px;">(Selisih)</font>
                                            </td>
                                            <!-- Botol -->
                                            <td style="text-align: center;">
                                                <?= $row['MUTASI_MASUK_BTL'] - $row['MUTASI_KELUAR_BTL']; ?><font style="font-size: 3px;">(Selisih)</font>
                                            </td>
                                            <!-- End Selisih -->
                                            <!-- Penyesuaian -->
                                            <!-- IN -->
                                            <td style="text-align: center;">
                                                <?= $P_IN; ?><font style="font-size: 3px;">(PenyesuaianIN)</font>
                                            </td>
                                            <!-- OUT -->
                                            <td style="text-align: center;">
                                                <?= $P_OUT; ?><font style="font-size: 3px;">(PenyesuaianOUT)</font>
                                            </td>
                                            <!-- END Penyesuaian -->
                                            <!-- Keterangan -->
                                            <!-- IN -->
                                            <td style="text-align: left;">
                                                <?php if ($row['K_IN'] == NULL && $row['L_IN'] == NULL && $row['P_IN'] == NULL && $row['R_IN'] == NULL) { ?>
                                                    <center>
                                                        0
                                                    </center>
                                                <?php } else { ?>
                                                    <div style="display: flex;">
                                                        <?php if ($row['K_IN'] != NULL) { ?>
                                                            <div>
                                                                <span class="label label-sm label-yellow" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Kurang = <?= $row['K_IN']; ?> Botol">
                                                                    <i class="fa-solid fa-minus"></i> <?= $row['K_IN']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['L_IN'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-lime" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Lebih = <?= $row['R_IN']; ?> Botol">
                                                                    <i class="fa-solid fa-plus"></i> <?= $row['L_IN']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['P_IN'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-dark" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Pecah = <?= $row['P_IN']; ?> Botol">
                                                                    <i class="fa-solid fa-tags"></i> <?= $row['P_IN']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['R_IN'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-warning" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Rusak = <?= $row['R_IN']; ?> Botol">
                                                                    <i class="fa-solid fa-magnifying-glass-arrow-right"></i> <?= $row['R_IN']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <!-- OUT -->
                                            <td style="text-align: left;">
                                                <?php if ($row['K_OUT'] == NULL && $row['L_OUT'] == NULL && $row['P_OUT'] == NULL && $row['R_OUT'] == NULL) { ?>
                                                    <center>
                                                        0
                                                    </center>
                                                <?php } else { ?>
                                                    <div style="display: flex;">
                                                        <?php if ($row['K_OUT'] != NULL) { ?>
                                                            <div>
                                                                <span class="label label-sm label-yellow" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Kurang = <?= $row['K_OUT']; ?> Botol">
                                                                    <i class="fa-solid fa-minus"></i> <?= $row['K_OUT']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['L_OUT'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-lime" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Lebih = <?= $row['R_OUT']; ?> Botol">
                                                                    <i class="fa-solid fa-plus"></i> <?= $row['L_OUT']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['P_OUT'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-dark" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Pecah = <?= $row['P_OUT']; ?> Botol">
                                                                    <i class="fa-solid fa-tags"></i> <?= $row['P_OUT']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($row['R_OUT'] != NULL) { ?>
                                                            <div class="m-l-5">
                                                                <span class="label label-sm label-warning" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Rusak = <?= $row['R_OUT']; ?> Botol">
                                                                    <i class="fa-solid fa-magnifying-glass-arrow-right"></i> <?= $row['R_OUT']; ?>
                                                                </span>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <!-- End Keterangan -->
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
                                        </tr>
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="24">
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
                                <?= $resultHeadSetting['website'] ?>
                            </span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i>
                                T:<?= $resultHeadSetting['telp'] ?>
                            </span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>
                                <?= $resultHeadSetting['email'] ?>
                            </span>
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
include "include/pusat_bantuan.php";
include "include/riwayat_aktifitas.php";
include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
include "include/jsForm.php";
?>
<script type="text/javascript">
</script>