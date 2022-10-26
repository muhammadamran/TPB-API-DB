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
$DATAAJU = $_GET['AJU'];
// Form Sesuai
if (isset($_POST["FSesuai"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangSesuai&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}
// All Sesuai
if (isset($_POST["All_sesuai"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangSesuaiAll&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}
// Form Kurang
if (isset($_POST["FKurang"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];
    $TGL_CEK           = $_POST['TGL_CEK'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangKurang&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);
}
// All Kurang
if (isset($_POST["All_kurang"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangKurangAll&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}
// Form Lebih
if (isset($_POST["FLebih"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];
    $TGL_CEK           = $_POST['TGL_CEK'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangLebih&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);
}
// All Lebih
if (isset($_POST["All_lebih"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangLebihAll&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}
// Form Pecah
if (isset($_POST["FPecah"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];
    $TGL_CEK           = $_POST['TGL_CEK'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangPecah&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);
}
// All Pecah
if (isset($_POST["All_pecah"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangPecahAll&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}
// Form Rusak
if (isset($_POST["FRusak"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangRusak&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);
}
// All Rusak
if (isset($_POST["All_rusak"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangRusakAll&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}

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
<style>
    .btn-custom {
        font-size: 10px;
        padding: 5px;
    }
</style>
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
                                <span class="d-sm-none">Barang Masuk</span>
                                <span class="d-sm-block d-none">
                                    Total Barang Masuk:
                                    <?php foreach ($dataBarangTotal['result'] as $rowBarangTotal) { ?>
                                        <?= $rowBarangTotal['total']; ?>
                                    <?php } ?>
                                    Barang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#IDBarang" data-toggle="tab" class="nav-link">
                                <?php if ($dataBarangCek['status'] == 200) { ?>
                                    <span class="d-sm-none">Proses Barang Masuk</span>
                                    <span class="d-sm-block d-none">
                                        <font class="blink_me">
                                            Proses Pengecekan Barang:
                                            <?php foreach ($dataBarangCek['result'] as $rowBarangCek) { ?>
                                                <?= $rowBarangCek['total_cek']; ?>
                                            <?php } ?>
                                            Barang DiCek!
                                        </font>
                                    </span>
                                <?php } else { ?>
                                    <span class="d-sm-none">Proses Barang Masuk</span>
                                    <span class="d-sm-block d-none">
                                        <font class="blink_me">Proses pengecekan Proses Barang Masuk!</font>
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
                            <div class="table-responsive">
                                <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" width="1%">No.</th>
                                            <th rowspan="2" class="no-sort" style="text-align: center;">
                                                <div style="width: 135px;">
                                                    Cek Barang Masuk
                                                    <hr>
                                                    <!-- Sesuai ALl -->
                                                    <form action="" method="POST" style="margin-left: 0px;">
                                                        <input type="hidden" name="AJU" value="<?= $DATAAJU; ?>">
                                                        <input type="hidden" name="OPERATOR_ONE" value="<?= $_SESSION['username']; ?>">
                                                        <button type="submit" name="All_sesuai" class="btn btn-sm btn-custom btn-success"><i class="fa-solid fa-check-circle"></i> Pilih Semua Sesuai</button>
                                                    </form>
                                                </div>
                                            </th>
                                            <th rowspan="2" class="no-sort" style="text-align: center;">Status</th>
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
                                                        <a href="#add<?= $row['ID'] ?>" class="btn btn-primary" data-toggle="modal" title="Add">
                                                            <font data-toggle="popover" data-trigger="hover" data-title="Add Nomor Pengajuan GB!" data-placement="top" data-content="Klik untuk menginput Nomor Pengajuan GB!">
                                                                <div>
                                                                    <div style="font-size: 12px;">
                                                                        <i class="fas fa-plus-circle"></i>
                                                                    </div>
                                                                </div>
                                                            </font>
                                                        </a>
                                                        <div style="margin-top: 5px;font-size: 9px;margin-left: -145px;">
                                                            <font><i class="fa-solid fa-clock-rotate-left"></i> <i>Last Update: <?= $rowBarang['TGL_CEK'] ?> </i></font>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: left;">
                                                        <div style="display: grid;font-size: 10px;width: 115px;">
                                                            <?php if ($rowBarang['STATUS'] == NULL) { ?>
                                                                <font><i class="fa-solid fa-user-pen"></i>: Petugas</font>
                                                                <font><i class="fa-solid fa-file-circle-check"></i>: Status</font>
                                                            <?php } else { ?>
                                                                <font><i class="fa-solid fa-user-pen"></i>: <?= $rowBarang['OPERATOR_ONE']; ?></font>
                                                                <?php if ($rowBarang['STATUS'] == 'Sesuai') { ?>
                                                                    <font><i class="fa-solid fa-file-circle-check"></i>: <span class="label label-success"><?= $rowBarang['STATUS']; ?></span></font>
                                                                <?php } else if ($rowBarang['STATUS'] == 'Kurang') { ?>
                                                                    <font><i class="fa-solid fa-file-circle-check"></i>: <span class="label label-danger"><?= $rowBarang['STATUS']; ?></span></font>
                                                                <?php } else if ($rowBarang['STATUS'] == 'Lebih') { ?>
                                                                    <font><i class="fa-solid fa-file-circle-check"></i>: <span class="label label-lime"><?= $rowBarang['STATUS']; ?></span></font>
                                                                <?php } else if ($rowBarang['STATUS'] == 'Pecah') { ?>
                                                                    <font><i class="fa-solid fa-file-circle-check"></i>: <span class="label label-dark"><?= $rowBarang['STATUS']; ?></span></font>
                                                                <?php } else if ($rowBarang['STATUS'] == 'Rusak') { ?>
                                                                    <font><i class="fa-solid fa-file-circle-check"></i>: <span class="label label-warning"><?= $rowBarang['STATUS']; ?></span></font>
                                                                <?php } ?>
                                                            <?php } ?>
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
                                                        <?php if ($rowBarang['JUMLAH_BAHAN_BAKU'] == NULL) { ?>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                            </font>
                                                        <?php } else { ?>
                                                            <?= $rowBarang['JUMLAH_BAHAN_BAKU']; ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <?php if ($rowBarang['JUMLAH_KEMASAN'] == NULL) { ?>
                                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                            </font>
                                                        <?php } else { ?>
                                                            <?= $rowBarang['JUMLAH_KEMASAN']; ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <div style="display: flex;justify-content: space-evenly;align-items:center">
                                                            <font><?= $rowBarang['KODE_SATUAN']; ?></font>
                                                            <font><?= $rowBarang['JUMLAH_SATUAN']; ?></font>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;"><?= $rowBarang['CIF']; ?></td>
                                                    <td style="text-align: center;">
                                                        <div style="width: 155px;">
                                                            <?= Rupiah($rowBarang['HARGA_PENYERAHAN']); ?>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center;"><?= $rowBarang['NETTO']; ?></td>
                                                    <td style="text-align: center;">
                                                        <div style="width: 155px;">
                                                            <?= Rupiah($rowBarang['POS_TARIF']); ?>
                                                        </div>
                                                    </td>
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

    function checkAll(checkId) {
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "checkbox" && inputs[i].id == checkId) {
                if (inputs[i].checked == true) {
                    inputs[i].checked = false;
                } else if (inputs[i].checked == false) {
                    inputs[i].checked = true;
                }
            }
        }
    }

    // SESUAI
    $("#btn-sesuai").click(function() {
        $("#form-submit").attr('action', `<?= $resultAPI['url_api'] ?>gmBarangMasukProses.php?function=PostBarangSesuaiAll?AJU=<?= $DATAAJU ?>&OPERATOR_ONE=<?= $_SESSION['username']; ?>`)
        // $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=sesuai`)
        var confirm = window.confirm("Klik OK jika Barang Masuk sudah Sesuai!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // KURANG
    $("#btn-kurang").click(function() {
        $("#form-submit").attr('action', `<?= $resultAPI['url_api'] ?>gmBarangMasukProses.php?function=PostBarangKurangAll`)
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=kurang`)
        var confirm = window.confirm("Klik OK jika Barang Masuk Kurang!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // LEBIH
    $("#btn-lebih").click(function() {
        $("#form-submit").attr('action', `<?= $resultAPI['url_api'] ?>gmBarangMasukProses.php?function=PostBarangLebihAll`)
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=lebih`)
        var confirm = window.confirm("Klik OK jika Barang Masuk Lebih!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // PECAH
    $("#btn-pecah").click(function() {
        $("#form-submit").attr('action', `<?= $resultAPI['url_api'] ?>gmBarangMasukProses.php?function=PostBarangPecahAll`)
        // $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=pecah`)
        var confirm = window.confirm("Klik OK jika Barang Masuk Pecah!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // RUSAK
    $("#btn-rusak").click(function() {
        $("#form-submit").attr('action', `<?= $resultAPI['url_api'] ?>gmBarangMasukProses.php?function=PostBarangRusakAll?AJU=<?= $DATAAJU ?>&OPERATOR_ONE=<?= $_SESSION['username']; ?>`)
        // $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=rusak`)
        // console.log($("#form-submit").attr('action'))
        // return;
        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });

    // SAVED SUCCESS
    if (window?.location?.href?.indexOf('SaveSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pemasukan_detail.php?AJU=<?= $DATAAJU ?>');
    }
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pemasukan_detail.php');
    }
</script>