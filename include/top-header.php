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
                <button type="button" onClick="showHideRA('divRA')" class="btn btn-dark-custom" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Riwayat Aktifitas"><i class="far fa-clock"></i></button>
            </div>
            <div style="margin-left: 5px;">
                <button type="button" onClick="showHideRA('divPB')" class="btn btn-dark-custom" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Pusat Bantuan"><i class="far fa-question-circle"></i></button>
            </div>
            <?php
            ?>
            <!-- Gate In -->
            <div style="margin-left: 5px;">
                <a href="gm_pemasukan.php" class="btn btn-dark-custom" style="width: 125px;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Gate In"><i class="fas fa-door-open"></i> Gate In <span class="badge badge-success" id="R_GateIn"></span></a>
            </div>
            <!-- Gate Out -->
            <div style="margin-left: 5px;">
                <a href="gm_pengeluaran.php" class="btn btn-dark-custom" style="width: 125px;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Gate Out"><i class="fas fa-door-closed"></i> Gate Out <span class="badge badge-success" id="R_GateOut"></span></a>
            </div>
            <!-- API -->
            <div style="margin-left: 5px;">
                <a href="http://api.itinventory-sarinah.com:8091/" target="_blank" class="btn btn-dark-custom" style="width: 63px;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="API"><i class="fas fa-code"></i> API</a>
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
<script>
    // GateIn
    function R_GateIn() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("R_GateIn").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "realtime/sidebar-data.php?function=GateIn", true);
        xhttp.send();
    }
    setInterval(function() {
        R_GateIn();
    }, 1000);
    window.onload = R_GateIn;
    // GateOut
    function R_GateOut() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("R_GateOut").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "realtime/sidebar-data.php?function=GateOut", true);
        xhttp.send();
    }
    setInterval(function() {
        R_GateOut();
    }, 1000);
    window.onload = R_GateOut;
</script>