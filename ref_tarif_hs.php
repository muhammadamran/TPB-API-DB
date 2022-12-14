<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Tarif HS (Harmonized System) App Name | Company </title>
<?php } else { ?>
    <title>Tarif HS (Harmonized System) - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-asterisk icon-page"></i>
                <font class="text-page">Referensi</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">Data Online</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Referensi</a></li>
                <li class="breadcrumb-item active">Tarif HS</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- Begin Tambah Tarif HS -->
    <!-- <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title">[Tambah Data] Tarif HS</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" id="myFormDaftarBarang" method="POST">
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No. HS <font style="color: red;">*</font></label>
                                                <input type="number" class="form-control" name="InputNoHS" id="idNoHS" placeholder="No. HS ..." required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Bea Masuk</label>
                                                <select class="form-control" name="InputBeaMasuk" id="idBeaMasuk" placeholder="Bea Masuk ..." required>
                                                    <option value="">--- Pilih ---</option>
                                                    <option value="1">1 - ADVOLORUM</option>
                                                    <option value="2">2 - SPESIFIK</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <label style="color: transparent;">%</label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="number" class="form-control" name="InputBeaPersen" id="idBeaPersen" placeholder="0.00 ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">%</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="ForidBeaMasukLabel" style="display: none;">
                                                <label style="color: transparent;">Label</label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputBeaLabel" id="idBeaLabel" placeholder="Label ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary"><i class="fa fa-search"></i> Label</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <style type="text/css">
                                    #ppn-mobile {
                                        margin-top: 0px;
                                    }

                                    @media (max-width: 575.5px) {
                                        #ppn-mobile {
                                            margin-top: 10px;
                                        }
                                    }
                                </style>
                                <div class="col-sm-6" id="ppn-mobile">
                                    <div class="row">
                                        <div class="col-sm-6">
                                                <label>PPn <font style="color: red;">*</font></label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputPPn" id="idPPn" placeholder="PPn ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">%</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                                <label>PPh <font style="color: red;">*</font></label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputPPh" id="idPPh" placeholder="PPh ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">%</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Cukai</label>
                                                <select class="form-control" name="InputCukai" id="idCukai" placeholder="Cukai ..." required>
                                                    <option value="">--- Pilih ---</option>
                                                    <option value="1">1 - ADVOLORUM</option>
                                                    <option value="2">2 - SPESIFIK</option>
                                                    <option value="3">3 - MANUAL</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <label style="color: transparent;">%</label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputCukaiPersen" id="idCukaiPersen" placeholder="0.00 ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">%</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="ForidCukaiLabel" style="display: none;">
                                                <label style="color: transparent;">Label</label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputCukaiLabel" id="idCukaiLabel" placeholder="Label ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary"><i class="fa fa-search"></i> Label</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="ForidCukaiRp" style="display: none;">
                                                <label style="color: transparent;">Rp.</label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="number" class="form-control" name="InputCukaiRp" id="idCukaiRp" placeholder="0.00 ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">Rp.</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                                <label>PPn BM <font style="color: red;">*</font></label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputPPnBM" id="idPPnBM" placeholder="PPn BM ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">%</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                </div>
                                <hr>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-primary" name="SimpanDaftarBarang"><i class="fa fa-save"></i> Simpan</button>
                                        <button type="button" class="btn btn-sm btn-yellow" onclick="myFunctionIDDaftarBarang()"><i class="fa fa-refresh"></i> Reset</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Tambah Tarif HS -->

    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-tarif-hs">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Referensi] Tarif HS</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">No.</th>
                                    <th class="text-nowrap" style="text-align: center;">No. HS</th>
                                    <th class="text-nowrap" style="text-align: center;">Tarif Bea Masuk</th>
                                    <th class="text-nowrap" style="text-align: center;">Kode Bea Masuk</th>
                                    <th class="text-nowrap" style="text-align: center;">Tarif Cukai</th>
                                    <th class="text-nowrap" style="text-align: center;">Kode Cukai</th>
                                    <th class="text-nowrap" style="text-align: center;">PPn</th>
                                    <th class="text-nowrap" style="text-align: center;">PPn Bea Masuk</th>
                                    <th class="text-nowrap" style="text-align: center;">PPh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT * FROM referensi_pos_tarif ORDER BY ID DESC");
                                if (mysqli_num_rows($dataTable) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($dataTable)) {
                                        $no++;
                                ?>
                                        <tr class="odd gradeX">
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center;">
                                                <?= $row['NOMOR_HS'] ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['TARIF_BM'] == NULL || $row['TARIF_BM'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['TARIF_BM'] ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['KD_SATUAN_BM'] == NULL || $row['KD_SATUAN_BM'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['KD_SATUAN_BM'] ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['TARIF_CUKAI'] == NULL || $row['TARIF_CUKAI'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['TARIF_CUKAI'] ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['KD_SATUAN_CUKAI'] == NULL || $row['KD_SATUAN_CUKAI'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['KD_SATUAN_CUKAI'] ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['TARIF_PPN'] == NULL || $row['TARIF_PPN'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['TARIF_PPN'] ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['TARIF_PPNBM'] == NULL || $row['TARIF_PPNBM'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['TARIF_PPNBM'] ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if ($row['TARIF_PPH'] == NULL || $row['TARIF_PPH'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['TARIF_PPH'] ?>
                                                <?php } ?>
                                            </td>
                                            <!-- <td>
                                                <a href="#updateData<?= $row['ID'] ?>" class="btn btn-sm btn-warning" data-toggle="modal" title="Update Data"><i class="fas fa-edit"></i></a>
                                                <a href="#deleteData<?= $row['ID'] ?>" class="btn btn-sm btn-danger" data-toggle="modal" title="Hapus Data"><i class="fas fa-trash"></i></a>
                                            </td> -->
                                        </tr>
                                        <!-- Update Data -->
                                        <div class="modal fade" id="updateData<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Update Data] Tarif HS - <?= $row['ID'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div style="margin-bottom: 10px;">
                                                                            <font style="font-size: 20px;font-weight: 700;"><i class="fas fa-user-check"></i> Sign In Detail</font>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="IDUsername">Username</label>
                                                                            <input type="text" class="form-control" name="username" id="IDUsername" placeholder="Username ..." value="<?= $row['username'] ?>" readonly />
                                                                            <input type="hidden" name="IDUNIQ" value="<?= $row['USRIDUNIQ'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="IDPassword">Password</label>
                                                                            <input type="password" class="form-control" id="IDPassword" placeholder="Password ..." value="<?= $row['PASSWORD'] ?>" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div style="margin-bottom: 10px;">
                                                                            <font style="font-size: 20px;font-weight: 700;"><i class="fas fa-user-cog"></i> Hak Akses</font>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="IDRole">Hak Akses</label>
                                                                            <select type="text" class="form-control" name="HakAkses" id="IDRole" required>
                                                                                <option value="<?= $row['role'] ?>"><?= $row['role'] ?></option>
                                                                                <option value="">-- Pilih Hak Akses --</option>
                                                                                <?php
                                                                                $resultHakAkses = $dbcon->query("SELECT role FROM tbl_role ORDER BY role ASC");
                                                                                foreach ($resultHakAkses as $rowHakAkses) {
                                                                                ?>
                                                                                    <option value="<?= $rowHakAkses['role'] ?>"><?= $rowHakAkses['role'] ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="col-md-3 col-form-label">Privileges</label>
                                                                        <!-- INSERT_DATA,UPDATE_DATA,DELETE_DATA,KIRIM_DATA,UPDATE_PASSWORD -->
                                                                        <div class="col-md-9">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['INSERT_DATA'] == 'Y') { ?>
                                                                                    <?php $insert_checked = 'checked'; ?>
                                                                                <?php } else if ($row['INSERT_DATA'] == 'N') { ?>
                                                                                    <?php $insert_checked = ''; ?>
                                                                                <?php } ?>
                                                                                <input type="checkbox" name="able_add" value="Y" id="checkbox-inline-c-1" class="form-check-input" <?= $insert_checked; ?> />
                                                                                <label class="form-check-label" for="checkbox-inline-c-1">Insert Data</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['UPDATE_DATA'] == 'Y') { ?>
                                                                                    <?php $update_checked = 'checked'; ?>
                                                                                <?php } else if ($row['UPDATE_DATA'] == 'N') { ?>
                                                                                    <?php $update_checked = ''; ?>
                                                                                <?php } ?>
                                                                                <input type="checkbox" name="able_edit" value="Y" id="checkbox-inline-c-2" class="form-check-input" <?= $update_checked; ?> />
                                                                                <label class="form-check-label" for="checkbox-inline-c-2">Update Data</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['DELETE_DATA'] == 'Y') { ?>
                                                                                    <?php $delete_checked = 'checked'; ?>
                                                                                <?php } else if ($row['DELETE_DATA'] == 'N') { ?>
                                                                                    <?php $delete_checked = ''; ?>
                                                                                <?php } ?>
                                                                                <input type="checkbox" name="able_delete" value="Y" id="checkbox-inline-c-3" class="form-check-input" <?= $delete_checked; ?> />
                                                                                <label class="form-check-label" for="checkbox-inline-c-3">Hapus Data</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['KIRIM_DATA'] == 'Y') { ?>
                                                                                    <?php $send_checked = 'checked'; ?>
                                                                                <?php } else if ($row['KIRIM_DATA'] == 'N') { ?>
                                                                                    <?php $send_checked = ''; ?>
                                                                                <?php } ?>
                                                                                <input type="checkbox" name="able_send" value="Y" id="checkbox-inline-c-4" class="form-check-input" <?= $send_checked; ?> />
                                                                                <label class="form-check-label" for="checkbox-inline-c-4">Kirim Data</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="checkbox checkbox-css m-b-20">
                                                                            <?php if ($row['UPDATE_PASSWORD'] == 'Y') { ?>
                                                                                <?php $pass_checked = 'checked'; ?>
                                                                            <?php } else if ($row['UPDATE_PASSWORD'] == 'N') { ?>
                                                                                <?php $pass_checked = ''; ?>
                                                                            <?php } ?>
                                                                            <input type="checkbox" id="nf_checkbox_css_c_1" name="able_password" value="Y" <?= $pass_checked; ?> />
                                                                            <label for="nf_checkbox_css_c_1">Klik jika User dapat melakukan update password secara mandiri.</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="NUpdateData" class="btn btn-warning"><i class="fas fa-edit"></i> Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Update Data -->

                                        <!-- Delete Data -->
                                        <div class="modal fade" id="deleteData<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Hapus Data] Tarif HS - <?= $row['ID'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger m-b-0">
                                                                <h5><i class="fa fa-info-circle"></i> Anda yakin akan menghapus data ini?</h5>
                                                                <p>Anda tidak akan melihat data ini lagi, data akan di hapus secara permanen pada sistem informasi TPB!<br><i>"Silahkan klik <b>Ya</b> untuk melanjutkan proses penghapusan data."</i></p>
                                                                <input type="hidden" name="IDUNIQ" value="<?= $row['ID'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tidak</button>
                                                            <button type="submit" class="btn btn-danger" name="NDeleteData"><i class="fas fa-check-circle"></i> Ya</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Delete Data -->
                                    <?php } ?>
                                <?php } else { ?>
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
<?php include "include/pusat_bantuan.php"; ?>
<?php include "include/riwayat_aktifitas.php"; ?>
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>

<script type="text/javascript">
    $(function() {
        $("#idBeaMasuk").change(function() {
            if ($(this).val() == "1") {
                $("#ForidBeaMasukLabel").hide();
            } else if ($(this).val() == "2") {
                $("#ForidBeaMasukLabel").show();
            } else {
                $("#ForidBeaMasukLabel").hide();
            }
        });

        $("#idCukai").change(function() {
            if ($(this).val() == "1") {
                $("#ForidCukaiLabel").hide();
                $("#ForidCukaiRp").hide();
            } else if ($(this).val() == "2") {
                $("#ForidCukaiLabel").show();
                $("#ForidCukaiRp").hide();
            } else if ($(this).val() == "3") {
                $("#ForidCukaiRp").show();
                $("#ForidCukaiLabel").hide();
            } else {
                $("#ForidCukaiLabel").hide();
                $("#ForidCukaiRp").hide();
            }
        });
    });

    // AUTOCOMPLATE
    $(function() {
        $("#idBeaLabel").autocomplete({
            source: 'libraries/autocomplete/auto_referensi_satuan.php'
        });
    });

    $(function() {
        $("#idCukaiLabel").autocomplete({
            source: 'libraries/autocomplete/auto_referensi_satuan.php'
        });
    });
</script>