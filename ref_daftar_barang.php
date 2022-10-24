<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
// FUNCTION SEARCHING
$fusername = '';
if (isset($_GET['findOne'])) {
    $fusername = $_GET['fusername'];
}

$fHakAkses = '';
if (isset($_GET['findTwo'])) {
    $fHakAkses = $_GET['fHakAkses'];
}

$startdate = '';
$enddate = '';
if (isset($_GET['findThree'])) {
    $startdate = $_GET['startdate'];
    $enddate = $_GET['enddate'];
}
// END FUNCTION SEARCHING

if (isset($_GET['findOne']) != '') {
    $displayOne = 'show';
    $displayTwo = 'none';
    $displayThree = 'none';

    $selectOne = 'selected';
    $selectTwo = '';
    $selectThree = '';
} else if (isset($_GET['findTwo']) != '') {
    $displayOne = 'none';
    $displayTwo = 'show';
    $displayThree = 'none';

    $selectOne = '';
    $selectTwo = 'selected';
    $selectThree = '';
} else if (isset($_GET['findThree']) != '') {
    $displayOne = 'none';
    $displayTwo = 'none';
    $displayThree = 'show';

    $selectOne = '';
    $selectTwo = '';
    $selectThree = 'selected';
} else {
    $displayOne = 'show';
    $displayTwo = 'none';
    $displayThree = 'none';

    $selectOne = 'selected';
    $selectTwo = '';
    $selectThree = '';
}
// API - 
include "include/api.php";
$content = get_content($resultAPI['url_api'] . 'refDaftarBarang.php');
$data = json_decode($content, true);
?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-book icon-page"></i>
                <font class="text-page">Referensi</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">View Data Online</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Referensi</a></li>
                <li class="breadcrumb-item active">Daftar Barang</li>
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
            <div class="panel panel-inverse" data-sortable-id="ui-daftar-barang">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Referensi] Daftar Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="data-table-buttons"
                            class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th class="text-nowrap" style="text-align: center;">No. HS</th>
                                    <th class="text-nowrap" style="text-align: center;">Uraian Barang</th>
                                    <th class="text-nowrap" style="text-align: center;">Merk</th>
                                    <th class="text-nowrap" style="text-align: center;">Tipe</th>
                                    <th class="text-nowrap" style="text-align: center;">Spesifikasi Lain</th>
                                    <th class="text-nowrap" style="text-align: center;">Kode Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['status'] == 404) { ?>
                                <tr>
                                    <td colspan="7">
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
                                <tr class="odd gradeX">
                                    <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                    <td style="text-align: center;">
                                        <?php if ($row['NOHS'] == NULL || $row['NOHS'] == '') { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Belum memiliki Tarif
                                                HS</i></font>
                                        <?php } else { ?>
                                        <?= $row['NOHS'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php if ($row['URAIAN_BARANG'] == NULL || $row['URAIAN_BARANG'] == '') { ?>
                                        <center>
                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                            </font>
                                        </center>
                                        <?php } else { ?>
                                        <?= $row['URAIAN_BARANG'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php if ($row['MERK'] == NULL || $row['MERK'] == '') { ?>
                                        <center>
                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                            </font>
                                        </center>
                                        <?php } else { ?>
                                        <?= $row['MERK'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php if ($row['TIPE'] == NULL || $row['TIPE'] == '') { ?>
                                        <center>
                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                            </font>
                                        </center>
                                        <?php } else { ?>
                                        <?= $row['TIPE'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php if ($row['SPESIFIKASI_LAIN'] == NULL || $row['SPESIFIKASI_LAIN'] == '') { ?>
                                        <center>
                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                            </font>
                                        </center>
                                        <?php } else { ?>
                                        <?= $row['SPESIFIKASI_LAIN'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['KODE_BARANG'] == NULL || $row['KODE_BARANG'] == '') { ?>
                                        <center>
                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                            </font>
                                        </center>
                                        <?php } else { ?>
                                        <?= $row['KODE_BARANG'] ?>
                                        <?php } ?>
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
<?php include "include/jsDatatables.php"; ?>

<script type="text/javascript">
// <!-- Reset Form -->
function myFunctionIDDaftarBarang() {
    document.getElementById("myFormDaftarBarang").reset();
}
// <!-- End Reset Form -->

// DATA ALREADY
if (window?.location?.href?.indexOf('DataAlready') > -1) {
    Swal.fire({
        title: 'Kode Barang sudah terdaftar!',
        icon: 'info',
        text: 'Kode Barang sudah terdaftar disistem, Kode Barang harus bersifat uniq atau tidak boleh sama!'
    })
    history.replaceState({}, '', './ref_daftar_barang.php');
}

// INSERT SUCCESS
if (window?.location?.href?.indexOf('InputSuccess') > -1) {
    Swal.fire({
        title: 'Data berhasil disimpan!',
        icon: 'success',
        text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './ref_daftar_barang.php');
}
// INSERT FAILED
if (window?.location?.href?.indexOf('InputFailed') > -1) {
    Swal.fire({
        title: 'Data gagal disimpan!',
        icon: 'error',
        text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './ref_daftar_barang.php');
}

// DELETE SUCCESS
if (window?.location?.href?.indexOf('DeleteSuccess') > -1) {
    Swal.fire({
        title: 'Data berhasil dihapus!',
        icon: 'success',
        text: 'Data berhasil dihapus didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './ref_daftar_barang.php');
}
// DELETE FAILED
if (window?.location?.href?.indexOf('DeleteFailed') > -1) {
    Swal.fire({
        title: 'Data gagal dihapus!',
        icon: 'error',
        text: 'Data gagal dihapus didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './ref_daftar_barang.php');
}
</script>

<script type="text/javascript">
$(function() {
    $("#findby").change(function() {
        if ($(this).val() == "opone") {
            $("#fformone").show();
            $("#fformtwo").hide();
            $("#fformthree").hide();
        } else if ($(this).val() == "optwo") {
            $("#fformtwo").show();
            $("#fformone").hide();
            $("#fformthree").hide();
        } else if ($(this).val() == "opthree") {
            $("#fformthree").show();
            $("#fformone").hide();
            $("#fformtwo").hide();
        } else {
            $("#fformone").hide();
            $("#fformtwo").hide();
            $("#fformthree").hide();
        }
    });
});
</script>