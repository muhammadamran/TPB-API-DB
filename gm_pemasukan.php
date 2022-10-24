<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";

$AJU_PLB = '';

if (isset($_POST['filter'])) {
    if ($_POST["AJU_PLB"] != '') {
        $AJU_PLB   = $_POST['AJU_PLB'];
    }
}

// API - 
include "include/api.php";
$content = get_content($resultAPI['url_api'] . 'gmBarangMasuk.php?AJU_PLB=' . $AJU_PLB);
$data = json_decode($content, true);
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
                <li class="breadcrumb-item"><a href="javascript:;">Gate</a></li>
                <li class="breadcrumb-item active">Barang Masuk</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- Search AJU PLB -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Find Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" method="POST">

                        <div class="row">
                            <div class="col-sm-3">
                                <img src="assets/img/svg/filter-animate.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="50%">
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label>Nomor Pengajuan PLB</label>
                                            <input type="number" name="AJU_PLB" class="form-control" value="<?= $AJU_PLB; ?>" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-sm-12">
                                        <button type="submit" name="filter" class="btn btn-info m-r-5"><i class="fas fa-filter"></i>
                                            Find! </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search AJU PLB -->

    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title">[Content] Coming Soon</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th class="text-nowrap" style="text-align: center;">Nomor Pengajuan</th>
                                    <th class="text-nowrap" style="text-align: center;">Tanggal AJU</th>
                                    <th class="text-nowrap" style="text-align: center;">Nama Supplier</th>
                                    <th class="text-nowrap" style="text-align: center;">KD Negara</th>
                                    <th class="text-nowrap" style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['status'] == 404) { ?>
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
                                    <?php $no = 0; ?>
                                    <?php foreach ($data['result'] as $row) { ?>
                                        <?php $no++ ?>
                                        <tr>
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_AJU'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU']; ?>
                                                <?php } ?>
                                            </td>
                                            <?php
                                            $dataTGLAJU = $row['TGL_AJU'];
                                            $dataTGLAJUY = substr($dataTGLAJU, 0, 4);
                                            $dataTGLAJUM = substr($dataTGLAJU, 4, 2);
                                            $dataTGLAJUD =  substr($dataTGLAJU, 6, 2);

                                            $datTGLAJU = $dataTGLAJUY . '-' . $dataTGLAJUM . '-' . $dataTGLAJUD;
                                            ?>
                                            <td style="text-align: center;"><?= $datTGLAJU ?></td>
                                            <td style="text-align: center">
                                                <?php if ($row['PEMASOK'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['PEMASOK']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['KODE_NEGARA_PEMASOK'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['KODE_NEGARA_PEMASOK']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="gm_pemasukan_detail?AJU=<?= $row['NOMOR_AJU'] ?>" class="btn btn-info"><i class="fas fa-book"></i> Details</a>
                                                <a href="#add<?= $row['ID'] ?>" class="btn btn-primary" data-toggle="modal" title="Add"><i class="fas fa-plus-circle"></i> Add</a>
                                            </td>
                                        </tr>
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