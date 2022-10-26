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

// All Sesuai
if (isset($_POST["update_"])) {
    $ID                = $_POST['ID'];
    $AJU               = $_POST['AJU'];
    $STATUS            = 'Sudah DiCek!';
    $OPERATOR_ONE      = $_SESSION['username'];
    $Sesuai            = $_POST['Sesuai'];
    $Kurang            = $_POST['Kurang'];
    $Lebih             = $_POST['Lebih'];
    $Pecah             = $_POST['Pecah'];
    $Rusak             = $_POST['Rusak'];
    $Total             = $_POST['Total'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostBarangUpdate&ID=' . $ID . '&AJU=' . $AJU . '&STATUS=' . $STATUS . '&OPERATOR_ONE=' . $OPERATOR_ONE . '&Sesuai=' . $Sesuai . '&Kurang=' . $Kurang . '&Lebih=' . $Lebih . '&Pecah=' . $Pecah . '&Rusak=' . $Rusak . '&Total=' . $Total);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU;</script>";
    } else if ($data['status'] == 402) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$DATAAJU&Alert=NULL;</script>";
    } else if ($data['status'] == 404) {
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

    .line-page-cek {
        height: 0.5px;
        margin: 6px 866px 23px 0px;
        background: #444e66;
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
                            <?php if ($_GET['Alert'] == 'NULL') { ?>
                                <div class="note note-warning">
                                    <div class="note-icon"><i class="fas fa-times-circle"></i></div>
                                    <div class="note-content">
                                        <h4><b>Gagal Submit!</b></h4>
                                        <p> Data gagal disimpan!, <b>Jumlah Status</b> dan <b>Jumlah Total Tidak Sesuai!</b></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="table-responsive">
                                <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" width="1%">No.</th>
                                            <th rowspan="2" class="no-sort" style="text-align: center;">
                                                <div style="width: 135px;">
                                                    Cek Barang Masuk
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
                                                <?php $jml_pcs = $rowBarang['NETTO']; ?>
                                                <?php $pcs = str_replace(".0000", "", "$jml_pcs"); ?>
                                                <?php $noBarang++ ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $noBarang ?>. </td>
                                                    <td style="text-align: center;">
                                                        <a href="#cekPCS<?= $rowBarang['ID'] ?>" class="btn btn-warning" data-toggle="modal" title="Cek Jumlah Barang Masuk. Kode Barang:<?= $rowBarang['KODE_BARANG']; ?> - Total: <?= $pcs; ?> Pcs">
                                                            <font data-toggle="popover" data-trigger="hover" data-title="Cek Jumlah Barang Masuk Berdasarkan Ketegori Sesuai, Kurang, Lebih, Pecah, Rusak" data-placement="top" data-content="Klik untuk melakukan pengecekan Barang Masuk pada Kode Barang: <?= $rowBarang['KODE_BARANG']; ?>.">
                                                                <div>
                                                                    <div style="font-size: 12px;">
                                                                        <i class="fas fa-clipboard-check"></i>
                                                                    </div>
                                                                </div>
                                                            </font>
                                                        </a>
                                                        <?php if ($rowBarang['STATUS'] != NULL) { ?>
                                                            <div style="margin-top: 5px;font-size: 9px;">
                                                                <font><i class="fa-solid fa-clock-rotate-left"></i> <i>Last Update: <?= $rowBarang['TGL_CEK'] ?> </i></font>
                                                            </div>
                                                        <?php } ?>
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
                                                <!-- cekPCS -->
                                                <div class="modal fade" id="cekPCS<?= $rowBarang['ID'] ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="" method="POST" enctype="multipart/form-data">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">[Barang] Cek Data Barang Masuk</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <fieldset>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div style="display: flex;justify-content: flex-start;align-content: center;">
                                                                                    <div style="font-size: 40px;">
                                                                                        <i class="fas fa-info"></i>
                                                                                    </div>
                                                                                    <div style="font-size: 15px;font-weight: 600;text-transform: uppercase;margin-left: 10px;margin-top: 10px;">
                                                                                        <font>Pengecekan Kode Barang: <?= $rowBarang['KODE_BARANG'] ?></font>
                                                                                        <br>
                                                                                        <font>Jumlah Satuan: <?= $pcs ?> <?= $rowBarang['KODE_SATUAN'] ?></font>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12">
                                                                                <div class="line-page-cek"></div>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <div class="form-group">
                                                                                    <label>Sesuai</label>
                                                                                    <input type="number" name="Sesuai" class="form-control" placeholder="Sesuai ..." value="<?= $rowBarang['SESUAI'] ?>" required>
                                                                                    <input type="hidden" name="ID" value="<?= $rowBarang['ID']; ?>">
                                                                                    <input type="hidden" name="AJU" value="<?= $rowBarang['NOMOR_AJU']; ?>">
                                                                                    <input type="hidden" name="Total" value="<?= $pcs; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <div class="form-group">
                                                                                    <label>Kurang</label>
                                                                                    <input type="number" name="Kurang" class="form-control" placeholder="Kurang ..." value="<?= $rowBarang['KURANG'] ?>" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <div class="form-group">
                                                                                    <label>Lebih</label>
                                                                                    <input type="number" name="Lebih" class="form-control" placeholder="Lebih ..." value="<?= $rowBarang['LEBIH'] ?>" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <div class="form-group">
                                                                                    <label>Pecah</label>
                                                                                    <input type="number" name="Pecah" class="form-control" placeholder="Pecah ..." value="<?= $rowBarang['PECAH'] ?>" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <div class="form-group">
                                                                                    <label>Rusak</label>
                                                                                    <input type="number" name="Rusak" class="form-control" placeholder="Rusak ..." value="<?= $rowBarang['RUSAK'] ?>" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <div class="form-group">
                                                                                    <div style="margin-top: 26px;">
                                                                                        <button type="submit" name="update_" class="btn btn-block btn-warning"><i class="fas fa-clipboard-check"></i> Status</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End cekPCS -->
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