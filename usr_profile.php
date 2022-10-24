<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
?>
<link rel="stylesheet" href="assets/profile/css/profile.css">
<?php if ($resultSetting['bg_profile'] == NULL) { ?>
    <style>
        .bg-profile-css {
            min-height: 489px;
            background-image: url('assets/images/profile/profile-default.png');
            background-size: cover;
            background-position: center top;
            margin-top: -20px;
            margin-left: -30px;
            margin-right: -30px;
        }
    </style>
<?php } else { ?>
    <style>
        .bg-profile-css {
            min-height: 489px;
            background-image: url('assets/images/profile/<?= $resultSetting['bg_profile']  ?>');
            background-size: cover;
            background-position: center top;
            margin-top: -20px;
            margin-left: -30px;
            margin-right: -30px;
        }
    </style>
<?php } ?>
<style>
    @media (max-width: 767.5px) {
        .bg-profile-css {
            margin-top: -20px;
            margin-left: -20px;
            margin-right: -20px;
        }
    }
</style>
<?php
// Change Prictures
if (isset($_POST["ChangePictures"])) {

    $ID                     = $_SESSION['username'];

    $nama = 'users_' . time() . "." . $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/users/' . $nama);

    $query = $dbcon->query("UPDATE tbl_pegawai SET foto='$nama'
                                               WHERE username='$ID'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Profile';
    $InputDescription     = $me . " Update Pictures Profile, Simpan Data Sebagai Log Profile";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='usr_profile.php?PicturesSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='usr_profile.php?PicturesFailed=true';</script>";
    }
}

// Save Input
if (isset($_POST["SaveInput"])) {

    $tahunLahir = $_POST['InputTanggalLahir'];
    $unixTimeSaatIni = time();
    $unixTimeTahunLahir= strtotime($tahunLahir);
    $unixTimeDalamSetahun = 31536000;
    $hitungUsia = ($unixTimeSaatIni - $unixTimeTahunLahir) / $unixTimeDalamSetahun;
    $DataUsia = floor($hitungUsia);

    $ID                      = $_SESSION['username'];
    $InputNoHP               = $_POST['InputNoHP'];
    $InputEmail              = $_POST['InputEmail'];
    $InputNIK                = $_POST['InputNIK'];
    $InputNIP                = $_POST['InputNIP'];
    $InputNamaLengkap        = $_POST['InputNamaLengkap'];
    $InputTempatLahir        = $_POST['InputTempatLahir'];
    $InputTanggalLahir       = $_POST['InputTanggalLahir'];
    $InputUsia               = $DataUsia;
    $InputJenisKelamin       = $_POST['InputJenisKelamin'];
    $InputAgama              = $_POST['InputAgama'];
    $InputAlamat             = $_POST['InputAlamat'];
    $InputDepartemen         = $_POST['InputDepartemen'];
    $InputJabatan            = $_POST['InputJabatan'];

    $query = $dbcon->query("UPDATE tbl_pegawai SET NIP='$InputNIP',
                                                   NIK='$InputNIK',
                                                   nama_lengkap='$InputNamaLengkap',
                                                   tempat_lahir='$InputTempatLahir',
                                                   tgl_lahir='$InputTanggalLahir',
                                                   usia='$InputUsia',
                                                   jenis_kelamin='$InputJenisKelamin',
                                                   agama='$InputAgama',
                                                   alamat='$InputAlamat',
                                                   no_hp='$InputNoHP',
                                                   email='$InputEmail',
                                                   departemen='$InputDepartemen',
                                                   jabatan='$InputJabatan'
                                                   WHERE username='$ID'");
    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Profile';
    $InputDescription     = $me . " Update Data Profile, Simpan Data Sebagai Log Profile";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='usr_profile.php?SaveInputSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='usr_profile.php?SaveInputFailed=true';</script>";
    }
}

// Save Edit
if (isset($_POST["SaveEdit"])) {

    $tahunLahir = $_POST['EditTanggalLahir'];
    $unixTimeSaatIni = time();
    $unixTimeTahunLahir= strtotime($tahunLahir);
    $unixTimeDalamSetahun = 31536000;
    $hitungUsia = ($unixTimeSaatIni - $unixTimeTahunLahir) / $unixTimeDalamSetahun;
    $DataUsia = floor($hitungUsia);

    $ID                     = $_SESSION['username'];
    $EditNoHP               = $_POST['EditNoHP'];
    $EditEmail              = $_POST['EditEmail'];
    $EditNIK                = $_POST['EditNIK'];
    $EditNIP                = $_POST['EditNIP'];
    $EditNamaLengkap        = $_POST['EditNamaLengkap'];
    $EditTempatLahir        = $_POST['EditTempatLahir'];
    $EditTanggalLahir       = $_POST['EditTanggalLahir'];
    $EditUsia               = $DataUsia;
    $EditJenisKelamin       = $_POST['EditJenisKelamin'];
    $EditAgama              = $_POST['EditAgama'];
    $EditAlamat             = $_POST['EditAlamat'];
    $EditDepartemen         = $_POST['EditDepartemen'];
    $EditJabatan            = $_POST['EditJabatan'];

    $query = $dbcon->query("UPDATE tbl_pegawai SET NIP='$EditNIP',
                                                   NIK='$EditNIK',
                                                   nama_lengkap='$EditNamaLengkap',
                                                   tempat_lahir='$EditTempatLahir',
                                                   tgl_lahir='$EditTanggalLahir',
                                                   usia='$EditUsia',
                                                   jenis_kelamin='$EditJenisKelamin',
                                                   agama='$EditAgama',
                                                   alamat='$EditAlamat',
                                                   no_hp='$EditNoHP',
                                                   email='$EditEmail',
                                                   departemen='$EditDepartemen',
                                                   jabatan='$EditJabatan'
                                                   WHERE username='$ID'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Profile';
    $InputDescription     = $me . " Update Profile, Simpan Data Sebagai Log Profile";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='usr_profile.php?SaveEditSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='usr_profile.php?SaveEditFailed=true';</script>";
    }
}
?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- Profile Content -->
    <div class="header-profile pb-6 d-flex align-items-center bg-profile-css">
        <span class="mask bg-gradient-default opacity-8"></span>
        <div class="container-fluid d-flex align-items-center">
            <div class="hello">
                <?php if ($access['nama_lengkap'] == NULL) { ?>
                    <h1 class="display-2 text-white">Hi, Belum dilengkapi!</h1>
                <?php } else { ?>
                    <h1 class="display-2 text-white">Hi, <?= $access['nama_lengkap'] ?>!</h1>
                <?php } ?>
                <?php if ($resultSetting['app_name'] == NULL) { ?>
                    <p class="text-white mt-0 mb-5">Ini adalah tampilan halaman profile anda. Di halaman profile, anda dapat melihat biodata dan status pengguna anda pada <br><b><i>App Name</i></b>.</p>
                <?php } else { ?>
                    <p class="text-white mt-0 mb-5">Ini adalah tampilan halaman profile anda. Di halaman profile, anda dapat melihat biodata dan status pengguna anda pada <br><b><i><?= $resultSetting['app_name'] ?></i></b>.</p>
                <?php } ?>
                <a href="#!" class="btn btn-neutral-tf"><i class="fas fa-calendar-alt"></i> <span id="ct"></span></a>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">
                    <img src="assets/images/users/6tnE.gif" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center" style="margin-top: -40px;">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <?php if ($accessSidebar['foto'] == NULL || $accessSidebar['foto'] == 'default-user-images.jpeg') { ?>
                                        <img src="assets/images/users/default-user-images.jpeg" class="rounded-circle" alt="Foto Profile" />
                                    <?php } else { ?>
                                        <img src="assets/images/users/<?= $accessSidebar['foto'] ?>" class="rounded-circle" alt="Foto Profile" />
                                    <?php } ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <?php if ($resultForPrivileges['UPDATE_PASSWORD'] == 'Y') { ?>
                                <a href="usr_password.php" class="btn btn-sm btn-info-profile mr-4" target="_blank"><i class="fas fa-lock"></i> Ganti Password</a>
                            <?php } else { ?>
                                <a href="#!NoAccess" class="btn btn-sm btn-info-profile mr-4" disabled><i class="fas fa-lock"></i> Ganti Password</a>
                            <?php } ?>
                            <a href="#modal-profile" class="btn btn-sm btn-default float-right" data-toggle="modal" title="Change Pictures"><i class="fas fa-user-circle"></i> Pictures</a>
                            <div class="modal fade" id="modal-profile">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h4 class="modal-title">[Pictures] Profile</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php if ($access['foto'] == NULL) { ?>
                                                                <img src="assets/images/users/default-user-images.jpeg" class="rounded-circle" style="width: 165px;height: 165px;background: transparent;border-style: groove;margin-bottom: 10px" alt="Foto Profile" />
                                                            <?php } else { ?>
                                                                <img src="assets/images/users/<?= $access['foto'] ?>" class="rounded-circle" style="width: 165px;height: 165px;background: transparent;border-style: groove;margin-bottom: 10px" alt="Foto Profile" />
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="file" class="form-control" name="foto" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                <button type="submit" name="ChangePictures" class="btn btn-default float-right"><i class="fas fa-user-circle"></i> Pictures</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="text-center">
                            <div class="garis-bio"></div>
                            <?php if ($access['nama_lengkap'] == NULL) { ?>
                                <h5 class="h3">Belum dilengkapi!</h5>
                            <?php } else { ?>
                                <h5 class="h3"><?= $access['nama_lengkap'] ?></h5>
                            <?php } ?>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>Jakarta, Indonesia
                            </div>
                            <div class="garis-bio"></div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>...
                            </div>
                            <div>
                                <i class="fas fa-building"></i>
                                <?php if ($resultSetting['company'] == NULL) { ?>
                                    Perusahaan
                                <?php } else { ?>
                                    <?= $resultSetting['company'] ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">
                                    <font style="font-weight: 200;">Perbarui</font> Profile
                                </h3>
                            </div>
                            <div class="col-4 text-right">
                                <!-- <a href="#!" class="btn btn-sm btn-primary-profile"><i class="fas fa-edit"></i> Edit</a> -->
                                <?php if ($access['nama_lengkap']  == NULL) { ?>
                                    <a href="#LengkapiProfileAnda!" class="btn btn-sm btn-danger-pdf"><i class="fas fa-file-pdf"></i> PDF</a>
                                <?php } else { ?>
                                    <a href="usr_profile_pdf.php?USER=<?= $_SESSION['username'] ?>" class="btn btn-sm btn-danger-pdf" target="_blank"><i class="fas fa-file-pdf"></i> PDF</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Alert -->
                                <?php if ($access['nama_lengkap'] == NULL) { ?>
                                    <div class="note note-danger">
                                        <div class="note-icon"><i class="fas fa-id-badge"></i></div>
                                        <div class="note-content">
                                            <h4><b>Lengkapi Profile Anda!</b></h4>
                                            <p> Anda belum melengkapi profile anda!</p>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="note note-success">
                                        <div class="note-icon"><i class="fas fa-id-badge"></i></div>
                                        <div class="note-content">
                                            <h4><b>Profile telah dilengkapi!</b></h4>
                                            <p> Anda telah melengkapi profile anda!</p>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- End Alert -->
                            </div>
                        </div>
                        <?php if ($access['nama_lengkap'] == NULL) { ?>
                            <form action="" method="POST">
                                <h6 class="heading-small text-muted mb-4">Informasi Pengguna</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text" class="form-control" placeholder="Username" id="input-username" value="<?= $access['USER_NAME'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-akses-tpb">Hak Akses TPB</label>
                                            <input type="text" class="form-control" placeholder="Hak Akses TPB ..." id="input-akses-tpb" value="<?= $access['role'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">No. Handphone <font style="color: red;">*</font></label>
                                            <div class="input-group bootstrap-NULL bootstrap-touchspin-injected">
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary" type="button" data-toggle="tooltip" data-placement="top" title="Isi No. Handphone">+62</a>
                                                </span>
                                                <input type="text" class="form-control" name="InputNoHP" id="input-no-handphone" placeholder="No. Handphone ..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email <font style="color: red;">*</font></label>
                                            <div class="input-group bootstrap-NULL bootstrap-touchspin-injected">
                                                <input type="email" class="form-control" name="InputEmail" id="input-email" placeholder="Email ..." value="<?= $access['email'] ?>" required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-warning bootstrap-touchspin-profil" data-toggle="tooltip" data-placement="top" title="Silahkan verifikasi link diemail anda"><i class="fas fa-paper-plane"></i></a>
                                                </span>
                                            </div>
                                            <p class="email-wait"><i>* Silahkan verifikasi link di email anda</i></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-NIK">NIK <font style="color: red;">*</font></label>
                                            <input type="text" class="form-control" name="InputNIK" id="input-NIK" placeholder="NIK ..." required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-NIP">NIP <font style="color: red;">*</font></label>
                                            <input type="text" class="form-control" name="InputNIP" id="input-NIP" placeholder="NIP ..." required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-nama-lengkap">Nama Lengkap <font style="color: red;">*</font></label>
                                            <input type="text" class="form-control" name="InputNamaLengkap" id="input-nama-lengkap" placeholder="Nama Lengkap ..." required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-tempat-lahir">Tempat Lahir <font style="color: red;">*</font></label>
                                            <input type="text" class="form-control" name="InputTempatLahir" id="input-tempat-lahir" placeholder="Tempat Lahir ..." required>
                                        </div>
                                    </div>
                                    <div class=" col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-tanggal-lahir">Tanggal Lahir <font style="color: red;">*</font></label>
                                            <input type="date" class="form-control" name="InputTanggalLahir" id="input-tanggal-lahir" placeholder="Tanggal Lahir ..." required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-usia">Usia <font style="color: red;">*</font></label>
                                            <input type="text" class="form-control" name="InputUsia" id="input-usia" placeholder="Usia" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-jenis-kelamin">Jenis Kelamin <font style="color: red;">*</font></label>
                                            <select class="form-control" name="InputJenisKelamin" id="input-jenis-kelamin" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="Pria">Pria</option>
                                                <option value="Wanita">Wanita</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-agama">Agama <font style="color: red;">*</font></label>
                                            <select class="form-control" name="InputAgama" id="input-agama" required>
                                                <option value="">-- Pilih Agama --</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-alamat">Alamat <font style="color: red;">*</font></label>
                                            <textarea type="text" class="form-control" name="InputAlamat" id="input-alamat" placeholder="Alamat ..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-departmen">Departmen <font style="color: red;">*</font></label>
                                            <select class="form-control" name="InputDepartemen" id="input-departmen" required>
                                                <option value="">-- Pilih Departemen --</option>
                                                <?php
                                                $resultDepartment = $dbcon->query("SELECT department FROM tbl_department ORDER BY department ASC");
                                                foreach ($resultDepartment as $RowDepartment) {
                                                ?>
                                                    <option value="<?= $RowDepartment['department'] ?>"><?= $RowDepartment['department'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-jabatan">Jabatan <font style="color: red;">*</font></label>
                                            <select class="form-control" name="InputJabatan" id="input-jabatan" required>
                                                <option value="">-- Pilih Jabatan --</option>
                                                <?php
                                                $resultJabatan = $dbcon->query("SELECT jabatan FROM tbl_jabatan ORDER BY jabatan ASC");
                                                foreach ($resultJabatan as $RowJabatan) {
                                                ?>
                                                    <option value="<?= $RowJabatan['jabatan'] ?>"><?= $RowJabatan['jabatan'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="SaveInput" id="btn-sisi"><i class="fa fa-save"></i> Simpan</button>
                            </form>
                        <?php } else { ?>
                            <form action="" method="POST">
                                <h6 class="heading-small text-muted mb-4">Informasi Pengguna</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text" class="form-control" placeholder="Username" id="edit-username" value="<?= $access['USER_NAME'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-akses-tpb">Hak Akses TPB</label>
                                            <input type="text" class="form-control" placeholder="Hak Akses TPB ..." id="edit-akses-tpb" value="<?= $access['role'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">No. Handphone</label>
                                            <div class="input-group bootstrap-NULL bootstrap-touchspin-injected">
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary" type="button" data-toggle="tooltip" data-placement="top" title="Isi No. Handphone">+62</a>
                                                </span>
                                                <input type="text" class="form-control" name="EditNoHP" id="edit-no-handphone" placeholder="No. Handphone ..." value="<?= $access['no_hp'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email</label>
                                            <div class="input-group bootstrap-NULL bootstrap-touchspin-injected">
                                                <input type="email" class="form-control" name="EditEmail" id="edit-email" placeholder="Email ..." value="<?= $access['email'] ?>">
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-warning bootstrap-touchspin-profil" data-toggle="tooltip" data-placement="top" title="Silahkan verifikasi link diemail anda"><i class="fas fa-paper-plane"></i></a>
                                                </span>
                                            </div>
                                            <p class="email-wait"><i>* Silahkan verifikasi link di email anda</i></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-NIK">NIK</label>
                                            <input type="text" class="form-control" name="EditNIK" id="edit-NIK" placeholder="NIK ..." value="<?= $access['NIK'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-NIP">NIP</label>
                                            <input type="text" class="form-control" name="EditNIP" id="edit-NIP" placeholder="NIP ..." value="<?= $access['NIP'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-nama-lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="EditNamaLengkap" id="edit-nama-lengkap" placeholder="Nama Lengkap ..." value="<?= $access['nama_lengkap'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-tempat-lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="EditTempatLahir" id="edit-tempat-lahir" placeholder="Tempat Lahir ..." value="<?= $access['tempat_lahir'] ?>">
                                        </div>
                                    </div>
                                    <div class=" col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-tanggal-lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="EditTanggalLahir" id="edit-tanggal-lahir" placeholder="Tanggal Lahir ..." value="<?= $access['tgl_lahir'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-usia">Usia</label>
                                            <input type="text" class="form-control" name="EditUsia" id="edit-usia" placeholder="Usia" value="<?= $access['usia'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-jenis-kelamin">Jenis Kelamin</label>
                                            <select class="form-control" name="EditJenisKelamin" id="edit-jenis-kelamin">
                                                <option value="<?= $access['jenis_kelamin'] ?>"><?= $access['jenis_kelamin'] ?></option>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="Pria">Pria</option>
                                                <option value="Wanita">Wanita</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-agama">Agama</label>
                                            <select class="form-control" name="EditAgama" id="edit-agama">
                                                <option value="<?= $access['agama'] ?>"><?= $access['agama'] ?></option>
                                                <option value="">-- Pilih Agama --</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-alamat">Alamat</label>
                                            <textarea type="text" class="form-control" name="EditAlamat" id="edit-alamat" placeholder="Alamat ..."><?= $access['alamat'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-departmen">Departmen</label>
                                            <select class="form-control" name="EditDepartemen" id="edit-departmen">
                                                <option value="<?= $access['departemen'] ?>"><?= $access['departemen'] ?></option>
                                                <option value="">-- Pilih Departemen --</option>
                                                <?php
                                                $resultDepartment = $dbcon->query("SELECT department FROM tbl_department ORDER BY department ASC");
                                                foreach ($resultDepartment as $RowDepartment) {
                                                ?>
                                                    <option value="<?= $RowDepartment['department'] ?>"><?= $RowDepartment['department'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="edit-jabatan">Jabatan</label>
                                            <select class="form-control" name="EditJabatan" id="edit-jabatan">
                                                <option value="<?= $access['jabatan'] ?>"><?= $access['jabatan'] ?></option>
                                                <option value="">-- Pilih Jabatan --</option>
                                                <?php
                                                $resultJabatan = $dbcon->query("SELECT jabatan FROM tbl_jabatan ORDER BY jabatan ASC");
                                                foreach ($resultJabatan as $RowJabatan) {
                                                ?>
                                                    <option value="<?= $RowJabatan['jabatan'] ?>"><?= $RowJabatan['jabatan'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning" name="SaveEdit" id="btn-sisi"><i class="fa fa-edit"></i> Edit</button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Profile Content -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->

<!-- Cek Usia -->
<!-- <link href="assets/otomatic/jquery-ui.css" rel="stylesheet"> -->
<!-- <script src="assets/otomatic/jquery-ui.js"></script> -->
<script type="text/javascript">
    $(function() {
        $("#input-tanggal-lahir").date({
            changeMonth: true,
            changeYear: true
        });
    });
    window.onload = function() {
        $('#input-tanggal-lahir').on('change', function() {

            var dob = new Date(this.value);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#input-usia').val(age);
        });
    }

    $(function() {
        $("#edit-tanggal-lahir").date({
            changeMonth: true,
            changeYear: true
        });
    });
    window.onload = function() {
        $('#edit-tanggal-lahir').on('change', function() {

            var dobb = new Date(this.value);
            var todayy = new Date();
            var agee = Math.floor((todayy - dobb) / (365.25 * 24 * 60 * 60 * 1000));
            $('#edit-usia').val(agee);
        });
    }
</script>
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<script type="text/javascript">
    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdatePasswordSuccess') > -1) {
        Swal.fire({
            title: 'Password berhasil disimpan!',
            icon: 'success',
            text: 'Password berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './usr_profile.php');
    }
    // SAVE INPUT SUCCESS
    if (window?.location?.href?.indexOf('SaveInputSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './usr_profile.php');
    }
    // SAVE INPUT FAILED
    if (window?.location?.href?.indexOf('SaveInputFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './usr_profile.php');
    }

    // SAVE EDIT SUCCESS
    if (window?.location?.href?.indexOf('SaveEditSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil diupdate!',
            icon: 'success',
            text: 'Data berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './usr_profile.php');
    }
    // SAVE EDIT FAILED
    if (window?.location?.href?.indexOf('SaveEditFailed') > -1) {
        Swal.fire({
            title: 'Data gagal diupdate!',
            icon: 'error',
            text: 'Data gagal diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './usr_profile.php');
    }

    // PicturesSuccess
    if (window?.location?.href?.indexOf('PicturesSuccess') > -1) {
        Swal.fire({
            title: 'Pictures berhasil diupdate!',
            icon: 'success',
            text: 'Pictures berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './usr_profile.php');
    }
    // PicturesFailed
    if (window?.location?.href?.indexOf('PicturesFailed') > -1) {
        Swal.fire({
            title: 'Pictures gagal diupdate!',
            icon: 'error',
            text: 'Pictures gagal diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './usr_profile.php');
    }
</script>