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
                <li class="breadcrumb-item active">About</li>
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
            <div class="panel panel-inverse" data-sortable-id="ui-about">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Utility] About</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <fieldset>
                        <div class="form-group row m-b-15">
                            <label class="col-md-3 col-form-label">Apache Version</label>
                            <label class="col-md-7 col-form-label">2.4.53</label>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-3 col-form-label">PHP Version</label>
                            <label class="col-md-7 col-form-label">7.2.34</label>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-3 col-form-label">MySQL Version</label>
                            <label class="col-md-7 col-form-label">5.7.37-cll-lve</label>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-3 col-form-label">Architecture</label>
                            <label class="col-md-7 col-form-label">x86_64</label>
                        </div>
                    </fieldset>
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