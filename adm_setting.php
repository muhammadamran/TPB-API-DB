<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/top-header.php";
include "include/sidebar.php";
?>
<?php
// FOR ICON
// Save Icon
if (isset($_POST["SaveIcon"])) {
    $Iconnama = 'icon_' . time() . "." . $_FILES['icon']['name'];
    $file_tmp = $_FILES['icon']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/icon/' . $Iconnama);

    $query = $dbcon->query("UPDATE tbl_setting SET icon='$Iconnama'
                                               WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Insert Data: Icon, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Insert';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?InputIconSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?InputIconFailed=true';</script>";
    }
}

// Update Icon
if (isset($_POST["EditIcon"])) {
    $Iconnama = 'icon_' . time() . "." . $_FILES['icon']['name'];
    $file_tmp = $_FILES['icon']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/icon/' . $Iconnama);

    $query = $dbcon->query("UPDATE tbl_setting SET icon='$Iconnama'
                                               WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Update Data: Icon, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?InputIconSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?InputIconFailed=true';</script>";
    }
}

// FOR LOGO
// Save Logo
if (isset($_POST["SaveLogo"])) {
    $Logonama = 'logo_' . time() . "." . $_FILES['logo']['name'];
    $file_tmp = $_FILES['logo']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/logo/' . $Logonama);

    $query = $dbcon->query("UPDATE tbl_setting SET logo='$Logonama'
                                               WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Insert Data: Icon, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Insert';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?InputLogoSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?InputLogoFailed=true';</script>";
    }
}

// Update Logo
if (isset($_POST["EditLogo"])) {
    $Logonama = 'logo_' . time() . "." . $_FILES['logo']['name'];
    $file_tmp = $_FILES['logo']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/logo/' . $Logonama);

    $query = $dbcon->query("UPDATE tbl_setting SET logo='$Logonama'
                                               WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Update Data: Logo, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?InputLogoSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?InputLogoFailed=true';</script>";
    }
}

// FOR BG SIGN IN
// Save BgSignIn
if (isset($_POST["SaveBgSignIn"])) {
    $BgSignInnama = 'bgSignIn_' . time() . "." . $_FILES['bg_signin']['name'];
    $file_tmp = $_FILES['bg_signin']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/bg-signin/' . $BgSignInnama);

    $query = $dbcon->query("UPDATE tbl_setting SET bg_signin='$BgSignInnama'
                                               WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Insert Data: Background Sign In, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Insert';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?InputBgSignInSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?InputBgSignInFailed=true';</script>";
    }
}

// Update BgSignIn
if (isset($_POST["EditBgSignIn"])) {
    $BgSignInnama = 'bgSignIn_' . time() . "." . $_FILES['bg_signin']['name'];
    $file_tmp = $_FILES['bg_signin']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/bg-signin/' . $BgSignInnama);

    $query = $dbcon->query("UPDATE tbl_setting SET bg_signin='$BgSignInnama'
                                               WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Update Data: Background Sign In, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?InputBgSignInSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?InputBgSignInFailed=true';</script>";
    }
}

// FOR BG SIDEBAR
// Save Sidebar
if (isset($_POST["SaveSidebar"])) {
    $Sidebarnama = 'Sidebar_' . time() . "." . $_FILES['bg_sidebar']['name'];
    $file_tmp = $_FILES['bg_sidebar']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/sidebar/' . $Sidebarnama);

    $query = $dbcon->query("UPDATE tbl_setting SET bg_sidebar='$Sidebarnama'
                                               WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Insert Data: Background Sidebar, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Insert';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?InputSidebarSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?InputSidebarFailed=true';</script>";
    }
}

// Update Sidebar
if (isset($_POST["EditSidebar"])) {
    $Sidebarnama = 'Sidebar_' . time() . "." . $_FILES['bg_sidebar']['name'];
    $file_tmp = $_FILES['bg_sidebar']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/sidebar/' . $Sidebarnama);

    $query = $dbcon->query("UPDATE tbl_setting SET bg_sidebar='$Sidebarnama'
                                               WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Update Data: Background Sidebar, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?InputSidebarSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?InputSidebarFailed=true';</script>";
    }
}

// FOR BG PROFILE
// Save Profile
if (isset($_POST["SaveProfile"])) {
    $Profilenama = 'Profile_' . time() . "." . $_FILES['bg_profile']['name'];
    $file_tmp = $_FILES['bg_profile']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/profile/' . $Profilenama);

    $query = $dbcon->query("UPDATE tbl_setting SET bg_profile='$Profilenama'
                                               WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Insert Data: Background Profile, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Insert';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?InputProfileSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?InputProfileFailed=true';</script>";
    }
}

// Update Profile
if (isset($_POST["EditProfile"])) {
    $Profilenama = 'Profile_' . time() . "." . $_FILES['bg_profile']['name'];
    $file_tmp = $_FILES['bg_profile']['tmp_name'];

    move_uploaded_file($file_tmp, './assets/images/profile/' . $Profilenama);

    $query = $dbcon->query("UPDATE tbl_setting SET bg_profile='$Profilenama'
                                               WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Update Data: Background Profile, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?InputProfileSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?InputProfileFailed=true';</script>";
    }
}

// FOR SETTING TEXT
// Save Setting Text
if (isset($_POST["SimpanSetting"])) {

    $title                 = $_POST['title'];
    $app_name              = $_POST['app_name'];
    $company               = $_POST['company'];
    $address               = $_POST['address'];
    $text_signin_one       = $_POST['text_signin_one'];
    $text_signin_two       = $_POST['text_signin_two'];
    $text_signin_detail    = $_POST['text_signin_detail'];
    $sd_one                = $_POST['sd_one'];
    $sd_two                = $_POST['sd_two'];
    $version               = $_POST['version'];
    $type                  = $_POST['type'];
    $dev_by                = $_POST['dev_by'];
    $dev_url               = $_POST['dev_url'];

    $query = $dbcon->query("INSERT INTO tbl_setting
                                        (id,title,app_name,company,address,text_signin_one,text_signin_two,text_signin_detail,sd_one,sd_two,version,type,dev_by,dev_url)
                                        VALUES
                                        ('','$title','$app_name','$company','$address','$text_signin_one','$text_signin_two','$text_signin_detail','$sd_one','$sd_two','$version','$release','$dev_by','$dev_url')");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Insert Data: Pengaturan App, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Insert';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?SaveSettingTextSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?SaveSettingTextFailed=true';</script>";
    }
}

// Update Setting Text
if (isset($_POST["EditSetting"])) {

    $title                 = $_POST['title'];
    $app_name              = $_POST['app_name'];
    $company               = $_POST['company'];
    $address               = $_POST['address'];
    $text_signin_one       = $_POST['text_signin_one'];
    $text_signin_two       = $_POST['text_signin_two'];
    $text_signin_detail    = $_POST['text_signin_detail'];
    $sd_one                = $_POST['sd_one'];
    $sd_two                = $_POST['sd_two'];
    $version               = $_POST['version'];
    $type                  = $_POST['type'];
    $pic_name              = $_POST['pic_name'];
    $pic_title             = $_POST['pic_title'];
    $dev_by                = $_POST['dev_by'];
    $dev_url               = $_POST['dev_url'];

    $query = $dbcon->query("UPDATE tbl_setting SET title='$title',
                                                   app_name='$app_name',
                                                   company='$company',
                                                   address='$address',
                                                   pic_name='$pic_name',
                                                   pic_title='$pic_title',
                                                   text_signin_one='$text_signin_one',
                                                   text_signin_two='$text_signin_two',
                                                   text_signin_detail='$text_signin_detail',
                                                   sd_one='$sd_one',
                                                   sd_two='$sd_two',
                                                   version='$version',
                                                   type='$type',
                                                   dev_by='$dev_by',
                                                   dev_url='$dev_url'
                                                   WHERE id='1'");
    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengaturan App TPB';
    $InputDescription     = $me . " Update Data: Pengaturan App, Simpan Data Sebagai Log Pengaturan App TPB";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_setting.php?UpdateSettingTextSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_setting.php?UpdateSettingTextFailed=true';</script>";
    }
}
// END FOR SETTING TEXT
?>
<!-- End Save Setting Text -->
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
                <li class="breadcrumb-item active">Pengaturan App TPB</li>
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
        <div class="col-xl-5">
            <div class="panel panel-inverse" data-sortable-id="data-pictures">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Administrator Tools] Pictures</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <?php
                    $data = $dbcon->query("SELECT * FROM tbl_setting");
                    $row = mysqli_fetch_array($data);
                    ?>
                    <!-- Icon -->
                    <?php if ($row['icon'] == NULL) { ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label>Icon</label>
                                    <div style="display: flex;justify-content:center;">
                                        <img src="assets/images/icon/icon-default.png" alt="Icon">
                                    </div>
                                    <input type="file" class="form-control" name="icon" required />
                                </div>
                                <div class="form-group">
                                    <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                                        <button type="submit" name="SaveIcon" class="btn btn-primary"><i class="fa fa-images"></i> Upload Icon</button>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php } else { ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label>Icon</label>
                                    <div style="display: flex;justify-content:center;">
                                        <img src="assets/images/icon/<?= $row['icon'] ?>" style="width: 230px;margin-bottom: 10px;" alt="Icon">
                                    </div>
                                    <input type="file" class="form-control" name="icon" value="<?= $row['icon'] ?>" />
                                </div>
                                <div class="form-group">
                                    <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                        <button type="submit" name="EditIcon" class="btn btn-warning"><i class="fa fa-edit"></i> Update Icon</button>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php } ?>
                    <!-- End Icon -->
                    <!-- Logo -->
                    <?php if ($row['logo'] == NULL) { ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label>Logo</label>
                                    <div style="display: flex;justify-content:center">
                                        <img src="assets/images/logo/logo-default.png" alt="Logo">
                                    </div>
                                    <input type="file" class="form-control" name="logo" required />
                                </div>
                                <div class="form-group">
                                    <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                                        <button type="submit" name="SaveLogo" class="btn btn-primary"><i class="fa fa-images"></i> Upload Logo</button>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php } else { ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label>Logo</label>
                                    <div style="display: flex;justify-content:center">
                                        <img src="assets/images/logo/<?= $row['logo'] ?>" style="width: 300px;margin-bottom: 10px;border-color: #000;padding: 10px;background: transparent;border: outset;" alt="Logo">
                                    </div>
                                    <input type="file" class="form-control" name="logo" value="<?= $row['logo'] ?>" />
                                </div>
                                <div class="form-group">
                                    <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                        <button type="submit" name="EditLogo" class="btn btn-warning"><i class="fa fa-edit"></i> Update Logo</button>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php } ?>
                    <!-- End Logo -->
                    <!-- Background Sign IN -->
                    <?php if ($row['bg_signin'] == NULL) { ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label>Background Sign In</label>
                                    <div style="display: flex;justify-content:center; margin-bottom: 5px;">
                                        <img src="assets/images/bg-signin/signin-default.png" style="width: 160px;" alt="Background Sign In">
                                    </div>
                                    <input type="file" class="form-control" name="bg_signin" required />
                                </div>
                                <div class="form-group">
                                    <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                                        <button type="submit" name="SaveBgSignIn" class="btn btn-primary"><i class="fa fa-images"></i> Upload Background Sign In</button>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php } else { ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label>Background Sign In</label>
                                    <div style="display: flex;justify-content:center; margin-bottom: 5px;">
                                        <img src="assets/images/bg-signin/<?= $row['bg_signin'] ?>" style="width: 160px;" alt="Background Sign In">
                                    </div>
                                    <input type="file" class="form-control" name="bg_signin" value="<?= $row['bg_signin'] ?>" />
                                </div>
                                <div class="form-group">
                                    <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                        <button type="submit" name="EditBgSignIn" class="btn btn-warning"><i class="fa fa-edit"></i> Update Background Sign In</button>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php } ?>
                    <!-- End Background Sign IN -->
                    <!-- Background Sidebar -->
                    <?php if ($row['bg_sidebar'] == NULL) { ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label>Background Sidebar</label>
                                    <div style="display: flex;justify-content:center; margin-bottom: 5px;">
                                        <img src="assets/images/sidebar/sidebar-default.png" style="width: 160px;" alt="Background Sidebar">
                                    </div>
                                    <input type="file" class="form-control" name="bg_sidebar" required />
                                </div>
                                <div class="form-group">
                                    <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                                        <button type="submit" name="SaveSidebar" class="btn btn-primary"><i class="fa fa-images"></i> Upload Background Sidebar</button>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php } else { ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label>Background Sidebar</label>
                                    <div style="display: flex;justify-content:center; margin-bottom: 5px;">
                                        <img src="assets/images/sidebar/<?= $row['bg_sidebar'] ?>" style="width: 160px;" alt="Background Sidebar">
                                    </div>
                                    <input type="file" class="form-control" name="bg_sidebar" value="<?= $row['bg_sidebar'] ?>" />
                                </div>
                                <div class="form-group">
                                    <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                        <button type="submit" name="EditSidebar" class="btn btn-warning"><i class="fa fa-edit"></i> Update Background Sidebar</button>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php } ?>
                    <!-- End Background Profile -->
                    <!-- Background Profile -->
                    <?php if ($row['bg_profile'] == NULL) { ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label>Background Profile</label>
                                    <div style="display: flex;justify-content:center; margin-bottom: 5px;">
                                        <img src="assets/images/profile/profile-default.png" style="width: 160px;" alt="Background Profile">
                                    </div>
                                    <input type="file" class="form-control" name="bg_profile" required />
                                </div>
                                <div class="form-group">
                                    <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                                        <button type="submit" name="SaveProfile" class="btn btn-primary"><i class="fa fa-images"></i> Upload Background Profile</button>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php } else { ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <label>Background Profile</label>
                                    <div style="display: flex;justify-content:center; margin-bottom: 5px;">
                                        <img src="assets/images/profile/<?= $row['bg_profile'] ?>" style="width: 160px;" alt="Background Profile">
                                    </div>
                                    <input type="file" class="form-control" name="bg_profile" value="<?= $row['bg_profile'] ?>" />
                                </div>
                                <div class="form-group">
                                    <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                        <button type="submit" name="EditProfile" class="btn btn-warning"><i class="fa fa-edit"></i> Update Background Profile</button>
                                    <?php } ?>
                                </div>
                            </fieldset>
                        </form>
                    <?php } ?>
                    <!-- End Background Profile -->
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <div class="panel panel-inverse" data-sortable-id="data-table">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Administrator Tools] Pengaturan App TPB</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <?php
                    $dataTwo = $dbcon->query("SELECT * FROM tbl_setting");
                    $rowTwo = mysqli_fetch_array($dataTwo);
                    ?>
                    <?php if ($rowTwo['id'] == NULL) { ?>
                        <form action="" method="POST">
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="Title ..." required />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>App Name</label>
                                            <input type="text" class="form-control" name="app_name" placeholder="App Name ..." required />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Nama Perusahaan</label>
                                            <input type="text" class="form-control" name="company" placeholder="Nama Perusahaan ..." required />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Alamat Perusahaan</label>
                                            <textarea type="text" class="form-control" name="address" placeholder="Alamat Perusahaan ..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sign Name 1</label>
                                            <input type="text" class="form-control" name="text_signin_one" placeholder="Sign Name 1 ..." required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sign Name 2</label>
                                            <input type="text" class="form-control" name="text_signin_two" placeholder="Sign Name 2 ..." required />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Text Detail Sign In</label>
                                            <textarea type="text" class="form-control" name="text_signin_detail" placeholder="Text Detail Sign In ..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sidebar Name 1</label>
                                            <input type="text" class="form-control" name="sd_one" placeholder="Sidebar Name 1 ..." required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sidebar Name 2</label>
                                            <input type="text" class="form-control" name="sd_two" placeholder="Sidebar Name 2 ..." required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Version</label>
                                            <input type="text" class="form-control" name="version" placeholder="Version ..." required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control" name="type" required>
                                                <option value="">-- Pilih Type --</option>
                                                <option value="Alpha">Alpha</option>
                                                <option value="Beta">Beta</option>
                                                <option value="Release candidate (RC)">Release candidate (RC)</option>
                                                <option value="Stable">Stable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="dev_by" value="HellosID" required />
                                    <input type="hidden" class="form-control" name="dev_url" value="https://hellos-id.com/" required />
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                                                <button type="submit" class="btn btn-primary" name="SimpanSetting"><i class="fa fa-save"></i> Simpan</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    <?php } else { ?>
                        <form action="" method="POST">
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="Title ..." value="<?= $rowTwo['title'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>App Name</label>
                                            <input type="text" class="form-control" name="app_name" placeholder="App Name ..." value="<?= $rowTwo['app_name'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Nama Perusahaan</label>
                                            <input type="text" class="form-control" name="company" placeholder="Nama Perusahaan ..." value="<?= $rowTwo['company'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>PIC Name</label>
                                            <input type="text" class="form-control" name="pic_name" placeholder="Nama PIC Perusahaan ..." value="<?= $rowTwo['pic_name'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>PIC Title</label>
                                            <input type="text" class="form-control" name="pic_title" placeholder="Title PIC Perusahaan ..." value="<?= $rowTwo['pic_title'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Alamat Perusahaan</label>
                                            <textarea type="text" class="form-control" name="address" placeholder="Alamat Perusahaan ..."><?= $rowTwo['address'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sign Name 1</label>
                                            <input type="text" class="form-control" name="text_signin_one" placeholder="Sign Name 1 ..." value="<?= $rowTwo['text_signin_one'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sign Name 2</label>
                                            <input type="text" class="form-control" name="text_signin_two" placeholder="Sign Name 2 ..." value="<?= $rowTwo['text_signin_two'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Text Detail Sign In</label>
                                            <textarea type="text" class="form-control" name="text_signin_detail" placeholder="Text Detail Sign In ..."><?= $rowTwo['text_signin_detail'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sidebar Name 1</label>
                                            <input type="text" class="form-control" name="sd_one" placeholder="Sidebar Name 1 ..." value="<?= $rowTwo['sd_one'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sidebar Name 2</label>
                                            <input type="text" class="form-control" name="sd_two" placeholder="Sidebar Name 2 ..." value="<?= $rowTwo['sd_two'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Version</label>
                                            <input type="text" class="form-control" name="version" placeholder="Version ..." value="<?= $rowTwo['version'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control" name="type" value="">
                                                <option value="<?= $rowTwo['type'] ?>"><?= $rowTwo['type'] ?></option>
                                                <option value="">-- Pilih Type --</option>
                                                <option value="Alpha">Alpha</option>
                                                <option value="Beta">Beta</option>
                                                <option value="Release candidate (RC)">Release candidate (RC)</option>
                                                <option value="Stable">Stable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="dev_by" value="HellosID" />
                                    <input type="hidden" class="form-control" name="dev_url" value="https://hellos-id.com/" />
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                                <button type="submit" class="btn btn-warning" name="EditSetting"><i class="fa fa-edit"></i> Update Setting <?= $resultHeadSetting['app_name'] ?></button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    <?php } ?>
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
<script type="text/javascript">
    // SAVED ICON SUCCESS
    if (window?.location?.href?.indexOf('InputIconSuccess') > -1) {
        Swal.fire({
            title: 'Icon berhasil disimpan!',
            icon: 'success',
            text: 'Icon berhasil disimpan didalam sistem TPB!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED ICON FAILED
    if (window?.location?.href?.indexOf('InputIconFailed') > -1) {
        Swal.fire({
            title: 'Icon gagal disimpan!',
            icon: 'error',
            text: 'Icon gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED LOGO SUCCESS
    if (window?.location?.href?.indexOf('InputLogoSuccess') > -1) {
        Swal.fire({
            title: 'Logo berhasil disimpan!',
            icon: 'success',
            text: 'Logo berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED LOGO FAILED
    if (window?.location?.href?.indexOf('InputLogoFailed') > -1) {
        Swal.fire({
            title: 'Logo gagal disimpan!',
            icon: 'error',
            text: 'Logo gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED BG SIGN IN SUCCESS
    if (window?.location?.href?.indexOf('InputBgSignInSuccess') > -1) {
        Swal.fire({
            title: 'Background Sign In berhasil disimpan!',
            icon: 'success',
            text: 'Background Sign In berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED BG SIGN IN FAILED
    if (window?.location?.href?.indexOf('InputBgSignInFailed') > -1) {
        Swal.fire({
            title: 'Background Sign In gagal disimpan!',
            icon: 'error',
            text: 'Background Sign In gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED SIDEBAR SUCCESS
    if (window?.location?.href?.indexOf('InputSidebarSuccess') > -1) {
        Swal.fire({
            title: 'Background Sidebar berhasil disimpan!',
            icon: 'success',
            text: 'Background Sidebar berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED SIDEBAR FAILED
    if (window?.location?.href?.indexOf('InputSidebarFailed') > -1) {
        Swal.fire({
            title: 'Background Sidebar gagal disimpan!',
            icon: 'error',
            text: 'Background Sidebar gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED PROFILE SUCCESS
    if (window?.location?.href?.indexOf('InputProfileSuccess') > -1) {
        Swal.fire({
            title: 'Background Profile berhasil disimpan!',
            icon: 'success',
            text: 'Background Profile berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED PROFILE FAILED
    if (window?.location?.href?.indexOf('InputProfileFailed') > -1) {
        Swal.fire({
            title: 'Background Profile gagal disimpan!',
            icon: 'error',
            text: 'Background Profile gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED SETTING TEXT SUCCESS
    if (window?.location?.href?.indexOf('SaveSettingTextSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // SAVED SETTING TEXT FAILED
    if (window?.location?.href?.indexOf('SaveSettingTextFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }

    // UPDATE SETTING TEXT SUCCESS
    if (window?.location?.href?.indexOf('UpdateSettingTextSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil diupdate!',
            icon: 'success',
            text: 'Data berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
    // UPDATE SETTING TEXT FAILED
    if (window?.location?.href?.indexOf('UpdateSettingTextFailed') > -1) {
        Swal.fire({
            title: 'Data gagal diupdate!',
            icon: 'error',
            text: 'Data gagal diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_setting.php');
    }
</script>