<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
include "include/cssDatatables.php";

$NomorPengajuan = '';
$NoBC27 = '';
$TanggalMasukOne = '';
$TanggalMasukTwo = '';
$TanggalKeluarOne = '';
$TanggalKeluarTwo = '';
$NamaPenerimaBarang = '';
$KodeNegara = '';
$NamaNegara = '';
$NoContainer = '';
$MataUang = '';

// API - 
include "include/api.php";
if (isset($_POST['FindNomorPengajuan'])) {
    $NomorPengajuan   = $_POST['NomorPengajuan'];

    $content = get_content($resultAPI['url_api'] . 'reportDataTPB.php?function=get_NomorPengajuan&NomorPengajuan=' . $_POST['NomorPengajuan']);
    $data = json_decode($content, true);
}

if (isset($_POST['FindNoBC27'])) {
    $FindNoBC27   = $_POST['FindNoBC27'];

    $content = get_content($resultAPI['url_api'] . 'reportDataTPB.php?function=get_NoBC27&FindNoBC27=' . $_POST['FindNoBC27']);
    $data = json_decode($content, true);
}

if (isset($_POST['FindTglMasuk'])) {
    $TanggalMasukOne   = $_POST['TanggalMasukOne'];
    $TanggalMasukTwo   = $_POST['TanggalMasukTwo'];

    $content = get_content($resultAPI['url_api'] . 'reportDataTPB.php?function=get_TglMasuk&TanggalMasukOne=' . $_POST['TanggalMasukOne'] . '&TanggalMasukTwo=' . $_POST['TanggalMasukTwo']);
    $data = json_decode($content, true);
}

if (isset($_POST['FindTglKeluar'])) {
    $TanggalKeluarOne   = $_POST['TanggalKeluarOne'];
    $TanggalKeluarTwo   = $_POST['TanggalKeluarTwo'];

    $content = get_content($resultAPI['url_api'] . 'reportDataTPB.php?function=get_TglKeluar&TanggalKeluarOne=' . $_POST['TanggalKeluarOne'] . '&TanggalKeluarTwo=' . $_POST['TanggalKeluarTwo']);
    $data = json_decode($content, true);
}

if (isset($_POST['FindNamaPenerimaBarang'])) {
    $NamaPenerimaBarang   = $_POST['NamaPenerimaBarang'];

    $content = get_content($resultAPI['url_api'] . 'reportDataTPB.php?function=get_NamaPenerimaBarang&NamaPenerimaBarang=' . $_POST['NamaPenerimaBarang']);
    $data = json_decode($content, true);
}

if (isset($_POST['FindNegara'])) {
    $KodeNegara   = $_POST['KodeNegara'];
    $NamaNegara   = $_POST['NamaNegara'];

    $content = get_content($resultAPI['url_api'] . 'reportDataTPB.php?function=get_NamaNegara&KodeNegara=' . $_POST['KodeNegara'] . '&NamaNegara=' . $_POST['NamaNegara']);
    $data = json_decode($content, true);
}

if (isset($_POST['FindContainer'])) {
    $NoContainer   = $_POST['NoContainer'];

    $content = get_content($resultAPI['url_api'] . 'reportDataTPB.php?function=get_NoContainer&NoContainer=' . $_POST['NoContainer']);
    $data = json_decode($content, true);
}

if (isset($_POST['FindMataUang'])) {
    $MataUang   = $_POST['MataUang'];

    $content = get_content($resultAPI['url_api'] . 'reportDataTPB.php?function=get_Matauang&MataUang=' . $_POST['MataUang']);
    $data = json_decode($content, true);
}
?>
<style>
@media (max-width: 767.5px) {
    #OKEBTN {
        margin-top: 10px;
    }
}
</style>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-desktop icon-page"></i>
                <font class="text-page">Data TPB / Sarinah</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Report</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Data TPB</a></li>
                <li class="breadcrumb-item active">Sarinah Records</li>
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
                    <h4 class="panel-title">
                        <i class="fas fa-filter"></i> Filter Data TPB Sarinah
                    </h4>
                    <a href="report_data_tpb.php" type="button" class="label label-default"
                        style="padding: 2px;margin-top: 2px;margin-right: 5px;">
                        <i class="fa fa-refresh"></i> Reset
                    </a>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class=" panel-body text-inverse">
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <!-- Nomor Pengajuan Sarinah (NOMOR_AJUAJU) -->
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Nomor Pengajuan</label>
                                <div class="col-md-1">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="NomorPengajuan"
                                        placeholder="Nomor Pengajuan ..." value="<?= $NomorPengajuan ?>">
                                </div>
                                <div class="col-md-2" id="OKEBTN">
                                    <button type="submit" class="btn btn-white m-r-5" name="FindNomorPengajuan">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <!-- Nomor BC 2.7 -->
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">No. BC. 27</label>
                                <div class="col-md-1">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="NoBC27" placeholder="No. BC. 27 ..."
                                        value="<?= $NoBC27 ?>">
                                </div>
                                <div class="col-md-2" id="OKEBTN">
                                    <button type="submit" class="btn btn-white m-r-5" name="FindNoBC27">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <!-- Tanggal Masuk -->
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Tanggal Masuk</label>
                                <div class="col-md-1">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control" name="TanggalMasukOne"
                                        placeholder="Tanggal Masuk ..." value="<?= $TanggalMasukOne ?>">
                                </div>
                                <div class="col-md-2" style="display: flex;justify-content: center;">
                                    <font>s.d</font>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control" name="TanggalMasukTwo"
                                        placeholder="Tanggal Masuk ..." value="<?= $TanggalMasukTwo ?>">
                                </div>
                                <div class="col-md-2" id="OKEBTN">
                                    <button type="submit" class="btn btn-white m-r-5" name="FindTglMasuk">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <!-- Tanngall Keluar -->
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Tanggal Keluar</label>
                                <div class="col-md-1">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control" name="TanggalKeluarOne"
                                        placeholder="Tanggal Keluar ..." value="<?= $TanggalKeluarOne ?>">
                                </div>
                                <div class="col-md-2" style="display: flex;justify-content: center;">
                                    <font>s.d</font>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control" name="TanggalKeluarTwo"
                                        placeholder="Tanggal Keluar ..." value="<?= $TanggalKeluarTwo ?>">
                                </div>
                                <div class="col-md-2" id="OKEBTN">
                                    <button type="submit" class="btn btn-white m-r-5" name="FindTglKeluar">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Nama Penerima Barang</label>
                                <div class="col-md-1">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="NamaPenerimaBarang"
                                        placeholder="Nama Penerima Barang ..." value="<?= $NamaPenerimaBarang ?>">
                                </div>
                                <div class="col-md-2" id="OKEBTN">
                                    <button type="submit" class="btn btn-white m-r-5" name="FindNamaPenerimaBarang">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Kode Negara / Nama Negara Supplier</label>
                                <div class="col-md-1">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="KodeNegara"
                                        placeholder="Kode Negara ..." value="<?= $KodeNegara ?>">
                                </div>
                                <div class="col-md-2" style="display: flex;justify-content: center;">
                                    <font>/</font>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="NamaNegara"
                                        placeholder="Nama Negara ..." value="<?= $NamaNegara ?>">
                                </div>
                                <div class="col-md-2" id="OKEBTN">
                                    <button type="submit" class="btn btn-white m-r-5" name="FindNegara">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">No. Container</label>
                                <div class="col-md-1">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="NoContainer"
                                        placeholder="No. Container ..." value="<?= $NoContainer ?>">
                                </div>
                                <div class="col-md-2" id="OKEBTN">
                                    <button type="submit" class="btn btn-white m-r-5" name="FindContainer">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <form action="" id="F-MataUang" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15" style="align-items: center;">
                                <label class="col-md-3 col-form-label">Mata Uang</label>
                                <div class="col-md-1">
                                    <font class="titik-dua">:</font>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="MataUang" placeholder="Mata Uang ..."
                                        value="<?= $MataUang ?>">
                                </div>
                                <div class="col-md-2" id="OKEBTN">
                                    <button type="submit" class="btn btn-white m-r-5" name="FindMataUang">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div style="background: #1d222691;height: 2px;width: 100%;margin: 2px 0px;box-sizing: border-box;">
                    </div>
                    <div class="form-group row m-b-15" style="align-items: center;justify-content: center;">
                        <div class="col-md-3" id="OKEBTN" style="margin-top: 10px;margin-bottom: -15px;">
                            <a href="report_data_tpb.php" class="btn btn-block btn-secondary m-r-5">
                                <i class="fa fa-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Data TPB - Sarinah / Master Data</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="TableDataTPB" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th colspan="4" style="text-align:center">BC 2.7 PLB</th>
                                    <th colspan="4" style="text-align:center">BC 2.7 Sarinah</th>
                                    <th rowspan="2" style="text-align:center">KD / Negara</th>
                                    <th rowspan="2" style="text-align:center">Supplier</th>
                                    <th rowspan="2" style="text-align:center">Jumlah Barang</th>
                                    <th rowspan="2" style="text-align:center">Party</th>
                                    <th rowspan="2" style="text-align:center">Valas</th>
                                    <th rowspan="2" style="text-align:center">Nilai Total</th>
                                    <th colspan="3" style="text-align:center">Tujuan</th>
                                    <th rowspan="2" style="text-align:center">Origin</th>
                                    <th rowspan="2" style="text-align:center">Tgl Masuk Barang</th>
                                    <th rowspan="2" style="text-align:center">Tgl Keluar Barang</th>
                                    <th rowspan="2" style="text-align:center">Cont. Details</th>
                                </tr>
                                <tr>
                                    <!-- PLB -->
                                    <th style="text-align:center">No. Pengajuan</th>
                                    <th style="text-align:center">Tgl Input</th>
                                    <th style="text-align:center">No. Daftar</th>
                                    <th style="text-align:center">Tgl Daftar</th>
                                    <!-- Sarinah -->
                                    <th style="text-align:center">No. Pengajuan</th>
                                    <th style="text-align:center">Tgl Input</th>
                                    <th style="text-align:center">No. Daftar</th>
                                    <th style="text-align:center">Tanggal Daftar</th>
                                    <!-- Tujuan -->
                                    <th style="text-align:center">NPWP</th>
                                    <th style="text-align:center">Nama</th>
                                    <th style="text-align:center">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['status'] == 404) { ?>
                                <tr>
                                    <td colspan="20">
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
                                <?php $no++; ?>
                                <tr>
                                    <td><?= $no ?>.</td>
                                    <!-- PLB -->
                                    <td style="text-align: center">
                                        <?php if ($row['NOMOR_AJU_DOK_ASAL'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['NOMOR_AJU_DOK_ASAL']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($row['ck5_plb_submit'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['ck5_plb_submit']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($row['NOMOR_DAFTAR_DOK_ASAL'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['NOMOR_DAFTAR_DOK_ASAL']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($row['TANGGAL_DAFTAR_DOK_ASAL'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TANGGAL_DAFTAR_DOK_ASAL']; ?>
                                        <?php } ?>
                                    </td>
                                    <!-- Sarinah GB -->
                                    <td><?= $row['NOMOR_AJU']; ?></td>
                                    <?php
                                            // FOR TANGGAL INPUT TPB
                                            $TPB_YYMMDD = SUBSTR($row['NOMOR_AJU'], 12, 8);
                                            $TPB_YY = SUBSTR($TPB_YYMMDD, 0, 4);
                                            $TPB_MM = SUBSTR($TPB_YYMMDD, 4, 2);
                                            $TPB_DD = SUBSTR($TPB_YYMMDD, 6, 2);
                                            ?>
                                    <td style="text-align: center">
                                        <?= $TPB_YY . "-" . $TPB_MM . "-" . $TPB_DD; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($row['TANGGAL_DAFTAR'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TANGGAL_DAFTAR']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($row['NOMOR_DAFTAR'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['NOMOR_DAFTAR']; ?>
                                        <?php } ?>
                                    </td>
                                    <!-- Lainnya -->
                                    <td style="text-align: center">
                                        <?php if ($row['KODE_NEGARA'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['KODE_NEGARA']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($row['NAMA_PEMASOK'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['NAMA_PEMASOK']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($row['JUMLAH_BARANG'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['JUMLAH_BARANG']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($row['UKURAN'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['UKURAN']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($row['KODE_VALUTA'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['KODE_VALUTA']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($row['CIF'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['CIF']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left">
                                        <?php if ($row['NPWP'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['NPWP']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left">
                                        <?php if ($row['NAMA_PENERIMA_BARANG'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['NAMA_PENERIMA_BARANG']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left">
                                        <?php if ($row['ALAMAT_PENERIMA_BARANG'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <a href="#AlamatTujuan<?= $row['ID_HDR'] ?>" class="btn btn-sm btn-info"
                                            data-toggle="modal" title="Alamat Tujuan"><i class="fas fa-map"></i> Detail
                                            Alamat</a>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left">
                                        <?php if ($row['KODE_NEGARA_PEMASOK'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['KODE_NEGARA_PEMASOK']; ?>
                                        <?php } ?>
                                    </td>
                                    <!-- Tgl Masuk -->
                                    <td style="text-align: left">
                                        <?php if ($row['ck5_plb_export'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['ck5_plb_export']; ?>
                                        <?php } ?>
                                    </td>
                                    <!-- Tanggal Keluar -->
                                    <td style="text-align: left">
                                        <?php if ($row['ck_gb_export'] == NULL) { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['ck_gb_export']; ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="report_data_tpb_detail_con.php?ID=<?= $row['ID_HDR']; ?>&AJU=<?= $row['NOMOR_AJU'] ?>"
                                            class="btn btn-primary" target="_blank" title="Cont. Details"><i
                                                class="fas fa-box"></i>
                                            Cont.
                                            Details</a>
                                    </td>
                                </tr>
                                <!-- Alamat -->
                                <div class="modal fade" id="AlamatTujuan<?= $row['ID_HDR'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="POST">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">[Detail Alamat Tujuan]
                                                        <?= $row['NAMA_PENERIMA_BARANG'] ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-secondary m-b-0">
                                                        <h5><i class="fa fa-map"></i> Detail Alamat:</h5>
                                                        <p><?= $row['ALAMAT_PENERIMA_BARANG'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i
                                                            class="fas fa-times-circle"></i> Tutup</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Alamat -->
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
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
// UPDATE SUCCESS
if (window?.location?.href?.indexOf('UploadSuccess') > -1) {
    Swal.fire({
        title: 'Data berhasil diupload!',
        icon: 'success',
        text: 'Data berhasil diupload didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './report_ck5_tpb.php');
}
// UPDATE FAILED
if (window?.location?.href?.indexOf('UploadFailed') > -1) {
    Swal.fire({
        title: 'Data gagal diupload!',
        icon: 'error',
        text: 'Data gagal diupload didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './report_ck5_tpb.php');
}

// TableDataTPB
$(document).ready(function() {
    $('#TableDataTPB').DataTable({
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