<?php
$user = $_SESSION['username'];
$role = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$user' ");
$access = mysqli_fetch_array($role);
?>
<div id="header" class="header navbar-default">
    <!-- begin navbar-header -->
    <div class="navbar-header">
        <a href="index.php" class="navbar-brand"><span class="navbar-logo"></span>
            <?php
            $dataSettting = $dbcon->query("SELECT * FROM tbl_setting");
            $resultSetting = mysqli_fetch_array($dataSettting);
            $cekforAppName = $resultSetting['app_name'];
            if ($cekforAppName == NULL) {
                $alertAppName = 'App Name';
            } else {
                $alertAppName = $resultSetting['app_name'];
            }
            ?>
            <?php if ($resultSetting['sd_one'] == NULL || $resultSetting['sd_two'] == NULL) { ?>
                <b>Name 1</b>&nbsp;Name 2
            <?php } else { ?>
                <b><?= $resultSetting['sd_one'] ?></b>&nbsp;<?= $resultSetting['sd_two'] ?>
            <?php } ?>
        </a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="for-header">
            <div>
                <button type="button" onClick="showHideRA('divRA')" class="btn btn-dark" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Riwayat Aktifitas"><i class="far fa-clock"></i></button>
            </div>
            <div style="margin-left: 5px;">
                <a href="" class="btn btn-dark" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Pusat Bantuan"><i class="far fa-question-circle"></i></a>
            </div>
            <?php
            // TOTAL GATE IN
            $gate_in = $dbcon->query("SELECT COUNT(*) AS total_in FROM plb_header AS hdr LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb WHERE upload_beritaAcara_PLB IS NULL");
            $result_in = mysqli_fetch_array($gate_in);
            // TOTAL GATE OUT
            $gate_out = $dbcon->query("SELECT COUNT(*) AS total_out FROM plb_header AS hdr LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb WHERE upload_beritaAcara_GB IS NULL");
            $result_out = mysqli_fetch_array($gate_out);
            ?>
            <!-- Gate In -->
            <div style="margin-left: 5px;">
                <a href="gm_pemasukan.php" class="btn btn-dark" style="width: 125px;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Gate In <?= $result_in['total_in'] ?>"><i class="fas fa-door-open"></i> Gate In <span class="badge badge-success"><?= $result_in['total_in'] ?></span></a>
            </div>
            <!-- Gate Out -->
            <div style="margin-left: 5px;">
                <a href="gm_pengeluaran.php" class="btn btn-dark" style="width: 125px;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Gate Out <?= $result_out['total_out'] ?>"><i class="fas fa-door-closed"></i> Gate Out <span class="badge badge-success"><?= $result_out['total_out'] ?></span></a>
            </div>
        </div>
    </div>
    <!-- end navbar-header -->
    <!-- begin header-nav -->
    <ul class="navbar-nav navbar-right">
        <li class="navbar-form" id="nav-clock">
            <i class="fas fa-clock"></i>&nbsp;
            <span id="ct"></span>
        </li>
        <div class="nav-garis">|</div>
        <li class="navbar-form">
            <form action="" method="POST" name="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Cari Data TPB ..." />
                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </li>
        <li class="dropdown navbar-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if ($access['foto'] == NULL || $access['foto'] == 'default-user-images.jpeg') { ?>
                    <img src="assets/images/users/default-user-images.jpeg" alt="Foto Profile" />
                <?php } else { ?>
                    <img src="assets/images/users/<?= $access['foto'] ?>" alt="Foto Profile" />
                <?php } ?>
                <span class="d-none d-md-inline"><?= $access['USER_NAME'] ?></span> <b class="caret"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="usr_profile.php" class="dropdown-item"><i class="fa-solid fa-user-gear"></i> Profile</a>
                <!-- <a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a> -->
                <?php if ($resultForPrivileges['UPDATE_PASSWORD'] == 'Y') { ?>
                    <a href="usr_password.php" class="dropdown-item"><i class="fa-solid fas fa-lock"></i> Ganti Password</a>
                <?php } ?>
                <!-- <a href="javascript:;" class="dropdown-item">Setting</a> -->
                <div class="dropdown-divider"></div>
                <a href="sign-out.php" class="dropdown-item"><i class="fa-solid fa-power-off"></i> Sign Out</a>
            </div>
        </li>
    </ul>
    <!-- end header-nav -->
</div>
<!-- end #header -->