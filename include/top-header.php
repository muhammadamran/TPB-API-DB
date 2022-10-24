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
    </div>
    <!-- end navbar-header -->
    <style>
    #nav-clock {
        margin-top: 18px;
        font-size: 10px;
    }

    .nav-garis {
        font-size: 35px;
        font-weight: 100;
        color: #c3c3c3;
    }

    @media (max-width: 996.5px) {
        #nav-clock {
            margin-top: 18px;
            font-size: 0px;
        }

        .nav-garis {
            font-size: 0px;
            font-weight: 0;
            color: #c3c3c3;
        }
    }
    </style>
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