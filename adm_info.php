<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/top-header.php";
include "include/sidebar.php";
?>
<link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
<link href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
<link href="assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
<link href="assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
<link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
<link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
<link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
<?php
// Saved
if (isset($_POST["SaveInfo"])) {

    $InputBackground          = $_POST['InputBackground'];
    $InputColor               = $_POST['InputColor'];
    $InputIcon                = $_POST['InputIcon'];
    $InputTitle               = $_POST['InputTitle'];
    $InputIsi                 = $_POST['InputIsi'];
    $InputType                = $_POST['InputType'];

    $query = $dbcon->query("UPDATE tbl_informasi SET info_bg='$InputBackground',
                                                     info_color='$InputColor',
                                                     info_icon='$InputIcon',
                                                     info_title='$InputTitle',
                                                     info_isi='$InputIsi',
                                                     info_tipe='$InputType'
                                                     WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan Informasi';
    $InputDescription     = $me . " Update Data Pengaturan Informasi, Simpan Data Sebagai Log Pengaturan Informasi";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_info.php?SaveSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_info.php?SaveFailed=true';</script>";
    }
}
?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fab fa-adn icon-page"></i>
                <font class="text-page">Administrator Tools</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">View Data Online</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Administrator Tools</a></li>
                <li class="breadcrumb-item active">Pengaturan Informasi</li>
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
            <div class="panel panel-inverse" data-sortable-id="data-table">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Administrator Tools] Pengaturan Informasi</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <?php
                    $data = $dbcon->query("SELECT * FROM tbl_informasi");
                    $row = mysqli_fetch_array($data);
                    ?>
                    <form action="" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Background</label>
                                <div class="col-md-7">
                                    <div class="input-group bootstrap-timepicker">
                                        <input type="text" class="form-control" name="InputBackground" id="colorpicker" value="<?= $row['info_bg'] ?>" placeholder="Background ..." />
                                        <span class="input-group-addon"><i class="fas fa-fill-drip"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Color Text</label>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <input class="form-control" name="InputColor" data-id="color-palette-1" value="<?= $row['info_color'] ?>" placeholder="Color Text ..." />
                                        <div class="input-group-append">
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <div id="color-palette-1"></div>
                                                </li>
                                            </ul>
                                            <span href="#" class="btn btn-grey text-black-lighter" data-toggle="dropdown"><i class="fa fa-tint fa-lg"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Icon</label>
                                <div class="col-md-7">
                                    <div class="input-group bootstrap-timepicker">
                                        <?php if ($row['info_icon'] == NULL) { ?>
                                            <input type="text" class="form-control" name="InputIcon" id="input-icon" value="<?= $row['info_icon'] ?>" placeholder="Icon ... (fa fa-bullhorn)" />
                                            <span class="input-group-addon"><i class="fa fa-bullhorn"></i></span>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" name="InputIcon" id="input-icon" value="<?= $row['info_icon'] ?>" placeholder="Icon ... (<?= $row['info_icon'] ?>)" />
                                            <span class="input-group-addon"><i class="<?= $row['info_icon'] ?>"></i></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Title</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="InputTitle" id="input-title" value="<?= $row['info_title'] ?>" placeholder="Title ...">
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Isi</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" name="InputIsi" id="input-isi" placeholder="Isi ..."><?= $row['info_isi'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Type</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="InputType" id="input-type">
                                        <?php if ($row['info_tipe'] == NULL) { ?>
                                            <option value="">-- Pilih Type --</option>
                                        <?php } else { ?>
                                            <option value="<?= $row['info_tipe'] ?>"><?= $row['info_tipe'] ?></option>
                                            <option value="">-- Pilih Type --</option>
                                        <?php } ?>
                                        <option value="Text Berjalan">Text Berjalan</option>
                                        <option value="Blink">Blink</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7 offset-md-3">
                                    <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                        <button type="submit" class="btn btn-warning m-r-5" name="SaveInfo"><i class="fa fa-edit"></i> Update</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </fieldset>
                    </form>
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
<script src="assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<script src="assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
<script src="assets/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
<script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="assets/plugins/tag-it/js/tag-it.min.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
<script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
<script src="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
<script src="assets/plugins/clipboard/dist/clipboard.min.js"></script>
<script src="assets/js/demo/form-plugins.demo.js"></script>
<script type="text/javascript">
    // SAVED SUCCESS
    if (window?.location?.href?.indexOf('SaveSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_info.php');
    }
    // SAVED FAILED
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_info.php');
    }
</script>