<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";

$AJU_PLB = '';
// API - 
include "include/api.php";

if (isset($_POST['add_'])) {
    $bm_no_aju_plb          = $_POST['bm_aju'];
    $bk_no_aju_sarinah      = $_POST['bk_aju'];
    $bm_tgl_masuk           = $_POST['bm_masuk'];
    $bm_nama_operator       = $_POST['bm_operator'];

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostADD&bm_no_aju_plb=' . $bm_no_aju_plb . '&bk_no_aju_sarinah=' . $bk_no_aju_sarinah . '&bm_tgl_masuk=' . $bm_tgl_masuk . '&bm_nama_operator=' . $bm_nama_operator);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan.php?SaveSuccess=true;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?SaveFailed=true';</script>";
    }
}

if (isset($_POST['edit_'])) {
    $rcd_id                 = $_POST['rcd_id'];
    $bm_no_aju_plb          = $_POST['bm_aju'];
    $bk_no_aju_sarinah      = $_POST['bk_aju'];
    $bm_tgl_masuk           = $_POST['bm_masuk'];
    $bm_nama_operator       = $_POST['bm_operator'];
    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostEDIT&bm_no_aju_plb=' . $bm_no_aju_plb . '&bk_no_aju_sarinah=' . $bk_no_aju_sarinah . '&bm_tgl_masuk=' . $bm_tgl_masuk . '&bm_nama_operator=' . $bm_nama_operator . '&rcd_id=' . $rcd_id);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan.php?SaveSuccess=true;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?SaveFailed=true';</script>";
    }
}

if (isset($_POST['upload_'])) {
    $rcd_id                 = $_POST['rcd_id'];
    // File
    $filename = $_FILES['uploadBA']['name'];
    $tmpname = $_FILES['uploadBA']['tmp_name'];
    $sizename = $_FILES['uploadBA']['size'];
    $exp = explode('.', $filename);
    $ext = end($exp);
    $uniq_file =  "Berita-Acara-PLB" . '_' . time();
    $newname =  "Berita-Acara-PLB" . '_' . time() . "." . $ext;
    $config['upload_path'] = './files/ck5plb/BA/PLB/';
    $config['allowed_types'] = "jpg|jpeg|png|jfif|gif|pdf";
    $config['max_size'] = '2000000';
    $config['file_name'] = $newname;
    move_uploaded_file($tmpname, "files/ck5plb/BA/PLB/" . $newname);

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostUPLOAD&newname=' . $newname . '&rcd_id=' . $rcd_id);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan.php?SaveSuccess=true;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan.php?SaveFailed=true';</script>";
    }
}

// Find
if (isset($_POST['filter'])) {
    if ($_POST["AJU_PLB"] != '') {
        $AJU_PLB   = $_POST['AJU_PLB'];
    }
}

if (isset($_POST['show_all'])) {
}
?>
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
                <li class="breadcrumb-item"><a href="javascript:;">Detail Nomor AJU: <?= $_GET['AJU'] ?></a></li>
                <li class="breadcrumb-item active">Cek <?= $_GET['LOOP'] ?> CT Data Barang Masuk</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <?php
    $list = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID='" . $_GET['ID'] . "' ORDER BY ID ASC LIMIT 1");
    $resultList = mysqli_fetch_array($list);
    ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card border-0">
                <div class="card-body">
                    <h4 class="card-title">Detail Tipe Barang: <?= $resultList['KODE_BARANG'] ?> - <?= $resultList['TIPE'] ?></h4>
                    <h6 class="card-subtitle mb-10px text-muted">Harga Penyerahan <?= Rupiah($resultList['HARGA_PENYERAHAN']) ?></h6>
                    <a href="javascript:;" class="card-link">Ukuran <?= $resultList['UKURAN'] ?></a>
                    <a href="javascript:;" class="card-link">Golongan <?= $resultList['SPESIFIKASI_LAIN'] ?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Data CT -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Cek <?= $_GET['LOOP']; ?> CT Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th class="no-sort" style="text-align: center;">
                                        <div style="display: flex;justify-content: center;align-content: center;width: 150px;">
                                            <div>
                                                <button type="button" class="btn btn-sm btn-info" id="chk_new" onclick="checkAll('chk');" style="font-size: 10px;">
                                                    <i class="fa-solid fa-square-check"></i>
                                                    Check
                                                </button>
                                            </div>
                                            <div style="margin-left: 5px;">
                                                <button type="button" class="btn btn-sm btn-danger" id="chk_new" onclick="checkAllDel('chk');" style="font-size: 10px;">
                                                    <i class="fa-solid fa-rectangle-xmark"></i>
                                                    Uncheck
                                                </button>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="1%" style="text-align: center;">#</th>
                                    <th style="text-align: center;">Ukuran</th>
                                    <th style="text-align: center;">Total Botol</th>
                                    <th style="text-align: center;">Total Liter</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID='" . $_GET['ID'] . "' ORDER BY ID ASC LIMIT 1");
                                $result = mysqli_fetch_array($data);
                                $t_botol = explode('X', $result['UKURAN']);
                                $t_liter = str_replace('Ltr', '', $t_botol[1]);
                                ?>
                                <?php for ($i = 1; $i <= $_GET['LOOP']; $i++) { ?>
                                    <tr>
                                        <td><?= $i ?>.</td>
                                        <td width="1%" style="text-align: center;">
                                            <div style="margin-left: 25px;margin-bottom: 15px;margin-top: 15px;">
                                                <input type="checkbox" class="form-check-input" id="chk" name="pengajuankrs[<?= $no - 1; ?>][JadwalID]" value="<?= $row_rencana_studi['JadwalID'] ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <img src="assets/img/png/box.png" style="width: 70px;" alt="">
                                        </td>
                                        <td style="text-align: center;">
                                            <font><?= $result['UKURAN']; ?></font>
                                        </td>
                                        <td style="text-align: center;">
                                            <?= $t_botol[0]; ?> Botol
                                        </td>
                                        <td style="text-align: center;">
                                            <?= $t_liter; ?> Liter
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Data CT -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
<?php include "include/jsForm.php"; ?>
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

    function checkAllDel(checkId) {
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
        history.replaceState({}, '', './gm_pemasukan.php');
    }
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './gm_pemasukan.php');
    }
</script>