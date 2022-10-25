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
// TOTAL BARANG
$contentBarangTotal = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_BarangTotal&AJU=' . $_GET['AJU']);
$dataBarangTotal = json_decode($contentBarangTotal, true);
// CEK BARANG
$contentBarangCek = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_BarangCek&AJU=' . $_GET['AJU']);
$dataBarangCek = json_decode($contentBarangCek, true);
// BARANG
$contentBarang = get_content($resultAPI['url_api'] . 'BarangCK5PLB.php?function=get_Barang&AJU=' . $_GET['AJU']);
$dataBarang = json_decode($contentBarang, true);

// Form Sesuai
if (isset($_POST["FSesuai"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangSesuai&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);
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
// Form Rusak
if (isset($_POST["FRusak"])) {
    $AJU               = $_POST['AJU'];
    $ID                = $_POST['ID'];
    $STATUS            = $_POST['STATUS'];
    $OPERATOR_ONE      = $_POST['OPERATOR_ONE'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangRusak&ID=' . $ID . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&AJU=' . $AJU);
    $data = json_decode($content, true);
}


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
                            <!-- <form id="form-submit" action="" method="POST"> -->
                            <hr>
                            <div style="margin-bottom: 10px;">
                                <font style="font-weight: 800;">Status Barang:</font>
                            </div>
                            <div>
                                <!-- <button id="btn-sesuai" class="btn btn-sm btn-success"><i class="fa-solid fa-check-circle"></i> Sesuai</button>
                                    <button id="btn-kurang" class="btn btn-sm btn-danger"><i class="fa-solid fa-minus"></i> Kurang</button>
                                    <button id="btn-lebih" class="btn btn-sm btn-lime"><i class="fa-solid fa-plus"></i> Lebih</button>
                                    <button id="btn-pecah" class="btn btn-sm btn-dark"><i class="fa-solid fa-tags"></i> Pecah</button>
                                    <button id="btn-rusak" class="btn btn-sm btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> Rusak</button> -->
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" width="1%">No.</th>
                                            <th rowspan="2" class="no-sort" style="text-align: center;">
                                                <!-- <div style="width: 110px;">
                                                    <button type="button" class="btn btn-sm btn-info" id="chk_new" onclick="checkAll('chk');">
                                                        <i class="fa-solid fa-list-check"></i>
                                                        <font style="font-size: 10px;font-weight: 300;">Barang Masuk</font>
                                                    </button>
                                                </div> -->
                                                Cek Barang Masuk
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
                                                        <!-- MAIN -->
                                                        <!-- <input type="checkbox" id="chk" name="CekBarang[<?= $noBarang - 1; ?>][ID]" value="<?= $row['ID'] ?>"> -->
                                                        <!-- END MAIN -->
                                                        <!-- <input type="hidden" name="CekBarang[<?= $noBarang - 1; ?>][OPERATOR_ONE]" value="<?= $_SESSION['username']; ?>"> -->
                                                        <!-- <input type="hidden" name="CekBarang[<?= $noBarang - 1; ?>][TGL_CEK]" value="<?= date('Y-m-d H:m:i') ?>"> -->
                                                        <div style="display: flex;justify-content: space-evenly;align-content: center;width: 315px;">
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="AJU" value="<?= $_GET['AJU'] ?>">
                                                                <input type="hidden" name="ID" value="<?= $rowBarang['ID']; ?>">
                                                                <input type="hidden" name="STATUS" value="Sesuai">
                                                                <input type="hidden" name="OPERATOR_ONE" value="<?= $_SESSION['username']; ?>">
                                                                <input type="hidden" name="TGL_CEK" value="<?= date('Y-m-d H:m:i') ?>">
                                                                <button type="submit" name="FSesuai" class="btn btn-sm btn-custom btn-success"><i class="fa-solid fa-check-circle"></i> Sesuai</button>
                                                            </form>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="AJU" value="<?= $_GET['AJU'] ?>">
                                                                <input type="hidden" name="ID" value="<?= $rowBarang['ID']; ?>">
                                                                <input type="hidden" name="STATUS" value="Kurang">
                                                                <input type="hidden" name="OPERATOR_ONE" value="<?= $_SESSION['username']; ?>">
                                                                <input type="hidden" name="TGL_CEK" value="<?= date('Y-m-d H:m:i') ?>">
                                                                <button type="submit" name="FKurang" class="btn btn-sm btn-custom btn-danger"><i class="fa-solid fa-minus"></i> Kurang</button>
                                                            </form>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="AJU" value="<?= $_GET['AJU'] ?>">
                                                                <input type="hidden" name="ID" value="<?= $rowBarang['ID']; ?>">
                                                                <input type="hidden" name="STATUS" value="Lebih">
                                                                <input type="hidden" name="OPERATOR_ONE" value="<?= $_SESSION['username']; ?>">
                                                                <input type="hidden" name="TGL_CEK" value="<?= date('Y-m-d H:m:i') ?>">
                                                                <button type="submit" name="FLebih" class="btn btn-sm btn-custom btn-lime"><i class="fa-solid fa-plus"></i> Lebih</button>
                                                            </form>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="AJU" value="<?= $_GET['AJU'] ?>">
                                                                <input type="hidden" name="ID" value="<?= $rowBarang['ID']; ?>">
                                                                <input type="hidden" name="STATUS" value="Pecah">
                                                                <input type="hidden" name="OPERATOR_ONE" value="<?= $_SESSION['username']; ?>">
                                                                <input type="hidden" name="TGL_CEK" value="<?= date('Y-m-d H:m:i') ?>">
                                                                <button type="submit" name="FPecah" class="btn btn-sm btn-custom btn-dark"><i class="fa-solid fa-tags"></i> Pecah</button>
                                                            </form>
                                                            <form action="" method="POST">
                                                                <input type="hidden" name="AJU" value="<?= $_GET['AJU'] ?>">
                                                                <input type="hidden" name="ID" value="<?= $rowBarang['ID']; ?>">
                                                                <input type="hidden" name="STATUS" value="Rusak">
                                                                <input type="hidden" name="OPERATOR_ONE" value="<?= $_SESSION['username']; ?>">
                                                                <input type="hidden" name="TGL_CEK" value="<?= date('Y-m-d H:m:i') ?>">
                                                                <button type="submit" name="FRusak" class="btn btn-sm btn-custom btn-warning"><i class="fa-solid fa-magnifying-glass-arrow-right"></i> Rusak</button>
                                                            </form>
                                                        </div>
                                                        <div style="margin-top: 5px;font-size: 9px;margin-left: -145px;">
                                                            <?php if ($rowBarang['STATUS'] != NULL) { ?>
                                                                <font><i class="fa-solid fa-clock-rotate-left"></i> <i>Last Update: <?= $rowBarang['TGL_CEK'] ?> </i></font>
                                                            <?php } ?>
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
                            <!-- </form> -->
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
        // $("#form-submit").attr('action', `<?= $resultAPI['url_api'] ?>gmBarangMasukProses.php?function=PostBarangSesuai`)
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=sesuai`)
        var confirm = window.confirm("Klik OK jika Barang Masuk sudah Sesuai!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // KURANG
    $("#btn-kurang").click(function() {
        // $("#form-submit").attr('action', `<?= $resultAPI['url_api'] ?>gmBarangMasukProses.php?function=PostBarangKurang`)
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=kurang`)
        var confirm = window.confirm("Klik OK jika Barang Masuk Kurang!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // LEBIH
    $("#btn-lebih").click(function() {
        // $("#form-submit").attr('action', `<?= $resultAPI['url_api'] ?>gmBarangMasukProses.php?function=PostBarangLebih`)
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=lebih`)
        var confirm = window.confirm("Klik OK jika Barang Masuk Lebih!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // PECAH
    $("#btn-pecah").click(function() {
        // $("#form-submit").attr('action', `<?= $resultAPI['url_api'] ?>gmBarangMasukProses.php?function=PostBarangPecah`)
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=pecah`)
        var confirm = window.confirm("Klik OK jika Barang Masuk Pecah!");

        if (confirm)
            $("#form-submit").submit();
        else
            return false;
    });
    // RUSAK
    $("#btn-rusak").click(function() {
        // $("#form-submit").attr('action', `<?= $resultAPI['url_api'] ?>gmBarangMasukProses.php?function=PostBarangRusak`)
        $("#form-submit").attr('action', `gm_pemasukan_proses.php?aksi=rusak`)
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