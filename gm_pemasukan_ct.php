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
                <li class="breadcrumb-item active">Barang Masuk</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- Data CT -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Cek <?= $_GET['LOOP']; ?> CT Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" method="POST">
                        <div class="table-responsive">
                            <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                                <thead>
                                    <tr>
                                        <th width="1%">No.</th>
                                        <th width="1%" style="text-align: center;">
                                            <input type="checkbox">
                                        </th>
                                        <th width="1%">#</th>
                                        <th style="text-align: center;">Kemasan</th>
                                        <th style="text-align: center;">Total Botol</th>
                                        <th style="text-align: center;">Total Liter</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = $dbcon->query("SELECT * FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "' AND ID='" . $_GET['ID'] . "' ORDER BY ID ASC LIMIT 1");
                                    $result = mysqli_fetch_array($data);
                                    $t_exp = explode('X', '', $result['UKURAN'])
                                    ?>
                                    <?php for ($i = 1; $i <= $_GET['LOOP']; $i++) { ?>
                                        <tr>
                                            <td><?= $i ?>.</td>
                                            <td width="1%" style="text-align: center;">
                                                <input type="checkbox">
                                            </td>
                                            <td>
                                                <img src="assets/img/png/box.png" style="width: 70px;" alt="">
                                            </td>
                                            <td style="text-align: center;">
                                                <font><?= $result['UKURAN']; ?></font>
                                            </td>
                                            <td style="text-align: center;">
                                                <?= $t_exp[0]; ?> Botol
                                            </td>
                                            <td style="text-align: center;">
                                                <?= $t_exp[1]; ?> Liter
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
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
    $(".default-select2").select2();
    $(function() {
        $("#IDAJU_PLB").autocomplete({
            source: 'function/autocomplete/nomor_aju_plb.php'
        });
    });
    $(document).ready(function() {
        $('#TableData').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
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