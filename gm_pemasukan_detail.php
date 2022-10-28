<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";

// TOTAL BARANG
$contentBarangTotal = $dbcon->query("SELECT COUNT(*) AS total FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$dataBarangTotal    = mysqli_fetch_array($contentBarangTotal);
// CEK BARANG
$contentBarangCek   = $dbcon->query("SELECT COUNT(*) AS total_cek FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$dataBarangCek      = mysqli_fetch_array($contentBarangCek);

// Data Barang
$contentBarangAll = $dbcon->query("SELECT FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
$dataBarangAll    = mysqli_fetch_array($contentBarangAll);
?>
<style>
    .btn-custom {
        font-size: 10px;
        padding: 5px;
    }

    .sm {
        max-width: 471pxpx;
        margin: 16.75rem auto;
        width: 375px;
    }

    .line-page-cek {
        height: 0.5px;
        margin: 6px 866px 23px 0px;
        background: #444e66;
    }
</style>

<style>
    /* Check Box */
    .form-check-input[type=checkbox] {
        border-radius: 0.25em;
    }

    .form-check-input:checked[type=checkbox] {
        background-image: url('assets/img/svg/download.svg');
    }

    .form-check-input:checked {
        background-color: #348fe2;
        border-color: #348fe2;
    }

    .form-check-input[type=checkbox] {
        border-radius: 0.25em;
    }

    .form-check .form-check-input {
        float: left;
        margin-left: -2em;
    }

    .form-check-input {
        width: 1.5em;
        height: 1.5em;
        margin-top: 0;
        vertical-align: top;
        background-color: #fff;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        border: 2px solid #9e9e9e;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }

    .form-check-input {
        position: inherit;
        margin-top: 0;
        margin-left: -1.25rem;
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
                                    <?= $dataBarangTotal['total']; ?>
                                    Barang
                            </a>
                        </li>
                    </ul>
                    <!-- Menu -->

                    <!-- Menu Tap -->
                    <div class="tab-content rounded bg-white mb-4">
                        <!-- IDBarang -->
                        <div class="tab-pane fade active show" id="IDBarang">
                            <hr>
                            <form id="form-submit" action="" method="POST">
                                <div style="margin-bottom: 10px;">
                                    <font style="font-weight: 800;">Status Barang:</font>
                                </div>
                                <div style="display: flex;justify-content: flex-start;align-content: baseline;">
                                    <?php
                                    $checking = $dbcon->query("SELECT brg.NOMOR_AJU,
                                                            (SELECT COUNT(*) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND CHECKING='Done') AS checking,
                                                            (SELECT COUNT(*) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS barang
                                                            FROM plb_barang AS brg  WHERE brg.NOMOR_AJU='" . $_GET['AJU'] . "' GROUP BY brg.NOMOR_AJU");
                                    $resultChecking = mysqli_fetch_array($checking);
                                    ?>
                                    <?php if ($resultChecking['checking'] == $resultChecking['barang']) { ?>
                                        <button type="submit" id="btn-sesuai" name="PilihSemua" class="btn btn-sm btn-custom btn-success" data-toggle="popover" data-trigger="hover" data-title="Simpan Data Pengecekan Barang" data-placement="top" data-content="Klik untuk Simpan Data Barang Masuk!">
                                            <i class="fa-solid fa-check-circle"></i>
                                            Barang Sudah DiCek!
                                        </button>
                                    <?php } else { ?>
                                        <div class="row">
                                            <div class="col-sm-12" style="display: flex;">
                                                <button type="button" id="btn-tidak" name="All_tidak" class="btn btn-sm btn-custom btn-danger" data-toggle="popover" data-trigger="hover" data-title="Selesaikan Pengecekan Barang" data-placement="top" data-content="Klik untuk selesaikan Barang Masuk!">
                                                    <i class="fa-solid fa-hourglass-start"></i>
                                                    Cek Satuan Botol
                                                </button>
                                                <div id="buttonPilihAll" style="display:none;margin-left: 10px;">
                                                    <button type="submit" id="btn-all" name="All_sesuai" class="btn btn-sm btn-custom btn-success" data-toggle="popover" data-trigger="hover" data-title="Simpan Data Pengecekan Barang" data-placement="top" data-content="Klik untuk Simpan Data Barang Masuk!">
                                                        <i class="fa-solid fa-check-circle"></i>
                                                        Simpan Barang Masuk
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" width="1%">No.</th>
                                                <th rowspan="2" class="no-sort" style="text-align: center;">
                                                    <div style="display: flex;justify-content: space-evenly;align-content: center;width: 130px;">
                                                        <button type="button" class="btn btn-sm btn-info" id="chk_new" onclick="checkAll('chk');" style="font-size: 10px;">
                                                            <i class="fa-solid fa-square-check"></i>
                                                            Pilih Semua Sesuai
                                                        </button>
                                                    </div>
                                                </th>
                                                <th rowspan="2" class="no-sort" style="text-align: center;">
                                                    <div style="display: flex;justify-content: space-evenly;align-content: center;width: 130px;">
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
                                            <?php
                                            $dataTable = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' ORDER BY ID ASC", 0);
                                            if (mysqli_num_rows($dataTable) > 0) {
                                                $noBarang = 0;
                                                while ($rowBarang = mysqli_fetch_array($dataTable)) {
                                                    $noBarang++;
                                                    $jml_pcs = $rowBarang['JUMLAH_SATUAN'];
                                                    $pcs = str_replace(".0000", "", "$jml_pcs");

                                                    // TOTAL BOTOL
                                                    $botol = explode('X', $rowBarang['UKURAN']);
                                                    $t_botol = $botol[0];
                                                    // TOTAL LITER
                                                    $liter =  $botol[1];
                                                    $r_liter = str_replace(['LTR', 'LTr', 'Ltr', 'ltr'], ['', '', '', ''], $liter);
                                                    $t_liter = str_replace(',', '.', $r_liter);
                                            ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $noBarang ?>. </td>
                                                        <td style="text-align: center;">
                                                            <?php if ($rowBarang['CHECKING'] == 'Checking Botol') { ?>
                                                                <span class="btn btn-sm btn-yellow" data-toggle="popover" data-trigger="hover" data-title="Sedang melakukan Pengecekan Barang" data-placement="top" data-content="Sedang melakukan Pengecekan Data Barang Masuk!">
                                                                    <i class="fa-solid fa-hourglass-start"></i>
                                                                </span>
                                                            <?php } else if ($rowBarang['CHECKING'] == 'Botol') { ?>
                                                                <span class="btn btn-sm btn-yellow" data-toggle="popover" data-trigger="hover" data-title="Selesai melakukan Pengecekan Botol" data-placement="top" data-content="Sedang melakukan Pengecekan Data Barang Masuk!">
                                                                    <i class="fa-solid fa-check"></i>
                                                                </span>
                                                            <?php } else if ($rowBarang['CHECKING'] == 'DONE') { ?>
                                                                <span class="btn btn-sm btn-success" data-toggle="popover" data-trigger="hover" data-title="Barang Di Simpan Di GB" data-placement="top" data-content="Barang Di Simpan Di GB!">
                                                                    <i class="fa-solid fa-house-circle-check"></i>
                                                                </span>
                                                            <?php } else { ?>
                                                                <div style="margin-left: 25px;margin-bottom: 15px;margin-top: 15px;">
                                                                    <input type="checkbox" class="form-check-input" id="chk" name="CekBarang[<?= $noBarang - 1; ?>][ID]" value="<?= $rowBarang['ID'] ?>">
                                                                    <!-- PLB_BARANG_CT -->
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][NOMOR_AJU]" value="<?= $rowBarang['NOMOR_AJU'] ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][KODE_BARANG]" value="<?= $rowBarang['KODE_BARANG'] ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][TOTAL_BOTOL]" value="<?= $t_botol ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][TOTAL_LITER]" value="<?= $t_liter ?>">
                                                                    <!-- PLB_BARANG -->
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][STATUS]" value="Complete">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][OPERATOR_ONE]" value="<?= $_SESSION['username'] ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][TGL_CEK]" value="<?= date('Y-m-d H:m:i') ?>">
                                                                    <input type="hidden" class="form-check-input" name="CekBarang[<?= $noBarang - 1; ?>][CHECKING]" value="DONE">
                                                                </div>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <input type="hidden" name="CekBarang[<?= $noBarang - 1; ?>][OPERATOR_ONE]" value="<?= $_SESSION['username']; ?>">
                                                            <input type="hidden" name="CekBarang[<?= $noBarang - 1; ?>][TGL_CEK]" value="<?= date('Y-m-d H:m:i') ?>">
                                                            <?php if ($rowBarang['KODE_BARANG'] != NULL) { ?>
                                                                <?php if ($rowBarang['CHECKING'] == 'DONE') { ?>
                                                                    <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-success">
                                                                        <i class="fas fa-check-circle" style="font-size: 15px;"></i>
                                                                        <br>
                                                                        Cek <?= $pcs ?> CT
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <?php if ($pcs == 0) { ?>
                                                                        <!-- No QTY -->
                                                                        <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-danger">
                                                                            <i class="fas fa-boxes" style="font-size: 22px;"></i>
                                                                            <br>
                                                                            Cek <?= $pcs ?> CT
                                                                        </a>
                                                                    <?php } else { ?>
                                                                        <!-- Check -->
                                                                        <a href="gm_pemasukan_ct.php?ID_BARANG=<?= $rowBarang['ID'] ?>&aksi=SubmitCT" target="_blank" onClick="openWindowReload(this)" class="btn btn-sm btn-custom btn-warning">
                                                                            <i class="fas fa-boxes" style="font-size: 22px;"></i>
                                                                            <br>
                                                                            Cek <?= $pcs ?> CT
                                                                        </a>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <!-- Disabled -->
                                                                <a href="#" data-toggle="modal" class="btn btn-sm btn-custom btn-secondary">
                                                                    <i class="fas fa-boxes" style="font-size: 22px;"></i>
                                                                    <br>
                                                                    Cek <?= $pcs ?> CT
                                                                </a>
                                                            <?php } ?>
                                                            <div style="margin-top: 5px;font-size: 9px;">
                                                                <?php if ($rowBarang['STATUS'] != NULL) { ?>
                                                                    <font><i class="fa-solid fa-clock-rotate-left"></i> <i>Last Update: <?= $rowBarang['TGL_CEK'] ?> </i></font>
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                        <td style="text-align: left;">
                                                            <div style="display: grid;font-size: 10px;width: 115px;">
                                                                <font><i class="fa-solid fa-user-pen"></i>: Petugas</font>
                                                                <font><i class="fa-solid fa-file-circle-check"></i>: Status</font>
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
                            </form>
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
        var VarAll = document.getElementById("buttonPilihAll");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type == "checkbox" && inputs[i].id == checkId) {
                if (inputs[i].checked == true) {
                    inputs[i].checked = false;
                    VarAll.style.display = "none";
                } else if (inputs[i].checked == false) {
                    inputs[i].checked = true;
                    VarAll.style.display = "block";
                }
            }
        }
    }

    function openWindowReload(link) {
        var href = link.href;
        // window.open(href, '_blank');
        document.location.reload(true)
    }

    // function MyCekBotolLewat() {
    //     var checkBox = document.getElementById("CekBotolLewat");
    //     var VarAll = document.getElementById("buttonPilihAll");
    //     if (checkBox.checked == true) {
    //         VarAll.style.display = "block";
    //     } else {
    //         VarAll.style.display = "none";
    //     }
    // }

    // CEK BARANG
    $("#btn-all").click(function() {
        $("#form-submit").attr('action', `gm_pemasukan_proses.php`)
        var confirm = window.confirm("Klik OK jika Barang Masuk sudah Sesuai!");

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