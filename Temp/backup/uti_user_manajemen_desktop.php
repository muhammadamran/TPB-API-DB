<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fab fa-medapps icon-page"></i>
                <font class="text-page">Utility</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Utility</a></li>
                <li class="breadcrumb-item active">User Manajemen</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id="ct"></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="data-user-manajemen">
                <div class="panel-heading">
                    <h4 class="panel-title">[Utility] User Manajemen</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <?php
                    $data = $dbcon->query("SELECT * FROM aktivasi_aplikasi");
                    $row = mysqli_fetch_array($data);
                    ?>
                    <form action="/" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Username Portal</label>
                                <div class="col-md-7">
                                    <input type="text" id="UsernamePortal" class="form-control" value="<?= $row['USERNAME']; ?>" placeholder="Username Portal ..." />
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Password Portal</label>
                                <div class="col-md-7">
                                    <input type="password" id="PasswordPortal" class="form-control" value="<?= $row['PASSWORD']; ?>" placeholder="Password Portal ..." />
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <div class="col-md-7 offset-md-3">
                                    <div class="checkbox checkbox-css">
                                        <input type="checkbox" id="ckb1" onclick="myFunction()" />
                                        <label for="ckb1">Lihat Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Nomor Skep</label>
                                <div class="col-md-7">
                                    <input type="text" id="NomorSkep" class="form-control" value="<?= $row['NOMOR_SKEP']; ?>" placeholder="Nomor Skep ..." />
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Tanggal Skep</label>
                                <div class="col-md-7">
                                    <input type="text" id="TanggalSkep" class="form-control" value="<?= $row['TANGGAL_SKEP']; ?>" placeholder="Tanggal Skep ..." />
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