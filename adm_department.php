<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
?>
<?php
// CREATE DEPARTMENT
if (isset($_POST["add_department"])) {

    $CekNameDepartment = $_POST['NameDepartment'];
    $DataCekNameDepartment = $dbcon->query("SELECT department FROM tbl_department WHERE department='$CekNameDepartment'");
    $HasilCekNameDepartment = mysqli_fetch_array($DataCekNameDepartment);

    if ($HasilCekNameDepartment != NULL) {
        echo "<script>window.location.href='adm_department.php?DataAlready=true';</script>";
    } else {
        $NameDepartment     = $_POST['NameDepartment'];
        $NameDescription    = $_POST['NameDescription'];

        $query = $dbcon->query("INSERT INTO tbl_department
                               (id,department,description)
                               VALUES
                               ('','$NameDepartment','$NameDescription')");

        // FOR AKTIFITAS
        $me = $_SESSION['username'];
        $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Administrator Tools/Departemen';
        $InputDescription     = $me . " Insert Data: " .  $NameDepartment . ", Simpan Data Sebagai Log Departemen";
        $InputAction          = 'Insert';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                               (id,IDUNIQ,username,modul,description,action,date_created)
                               VALUES
                               ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");


        if ($query) {
            echo "<script>window.location.href='adm_department.php?InputSuccess=true';</script>";
        } else {
            echo "<script>window.location.href='adm_department.php?InputFailed=true';</script>";
        }
    }
}
// END CREATE DEPARTMENT
// UPDATE DEPARTMENT
if (isset($_POST["NUpdateData"])) {

    $IDUNIQ                   = $_POST['IDUNIQ'];
    $UpdateNameDepartment     = $_POST['UpdateNameDepartment'];
    $UpdateNameDescription    = $_POST['UpdateNameDescription'];

    $query = $dbcon->query("UPDATE tbl_department SET department='$UpdateNameDepartment',
                                                      description='$UpdateNameDescription'
                                                   WHERE id='$IDUNIQ'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Departemen';
    $InputDescription     = $me . " Update Data: " .  $UpdateNameDepartment . ", Simpan Data Sebagai Log Departemen";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_department.php?UpdateSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_department.php?UpdateFailed=true';</script>";
    }
}
// END UPDATE DEPARTMENT

// DELETE DEPARTMENT
if (isset($_POST["NDeleteData"])) {

    $IDUNIQ             = $_POST['IDUNIQ'];
    $NameDepartment     = $_POST['NameDepartment'];

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Departemen';
    $InputDescription     = $me . " Hapus Data: " .  $NameDepartment . ", Simpan Data Sebagai Log Departemen";
    $InputAction          = 'Hapus';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    $query .= $dbcon->query("DELETE FROM tbl_department WHERE id='$IDUNIQ'");

    if ($query) {
        echo "<script>window.location.href='adm_department.php?DeleteSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_department.php?DeleteFailed=true';</script>";
    }
}
// END DELETE DEPARTMENT
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
                <li class="breadcrumb-item active">Departemen</li>
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
        <!-- begin col-6 -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-2">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Administrator Tools] Departemen</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body">
                    <!-- css-button -->
                    <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                        <div class="css-button">
                            <?php include "modal/m_department.php"; ?>
                        </div>
                    <?php } ?>
                    <!-- end css-button -->
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th style="text-align: center;">Departemen</th>
                                    <th class="text-nowrap" style="text-align: center;">Deskripsi</th>
                                    <th class="text-nowrap" style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT * FROM tbl_department ORDER BY department ASC");
                                if (mysqli_num_rows($dataTable) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($dataTable)) {
                                        $no++;
                                ?>
                                        <tr class="odd gradeX">
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center;"><?= $row['department'] ?></td>
                                            <td style="text-align: left;"><?= $row['description'] ?></td>
                                            <td style="text-align: center;">
                                                <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                                    <a href="#updateData<?= $row['id'] ?>" class="btn btn-warning" data-toggle="modal" title="Update Data"><i class="fas fa-edit"></i> Update</a>
                                                <?php } ?>
                                                <?php if ($resultForPrivileges['DELETE_DATA'] == 'Y') { ?>
                                                    <a href="#deleteData<?= $row['id'] ?>" class="btn btn-danger" data-toggle="modal" title="Hapus Data"><i class="fas fa-trash"></i> Hapus</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <!-- Update Data -->
                                        <div class="modal fade" id="updateData<?= $row['id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Update Data] Departemen - <?= $row['id'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="IdDepartment">Departemen</label>
                                                                            <input type="text" class="form-control" name="UpdateNameDepartment" id="IdDepartment" placeholder="Departemen ..." value="<?= $row['department'] ?>" />
                                                                            <input type="hidden" name="IDUNIQ" value="<?= $row['id'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="IdDescription">Deskripsi </label>
                                                                            <textarea type="text" class="form-control" name="UpdateNameDescription" id="IdDescription" placeholder="Deskripsi ..."><?= $row['description'] ?></textarea>
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
                                        <div class="modal fade" id="deleteData<?= $row['id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Hapus Data] Departemen - <?= $row['id'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger m-b-0">
                                                                <h5><i class="fa fa-info-circle"></i> Anda yakin akan menghapus data ini?</h5>
                                                                <p>Anda tidak akan melihat data ini lagi, data akan di hapus secara permanen pada sistem informasi TPB!<br><i>"Silahkan klik <b>Ya</b> untuk melanjutkan proses penghapusan data."</i></p>
                                                                <input type="hidden" name="NameDepartment" value="<?= $row['department'] ?>">
                                                                <input type="hidden" name="IDUNIQ" value="<?= $row['id'] ?>">
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
                                    <tr>
                                        <td colspan="7">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php }
                                mysqli_close($dbcon); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
</div>
<!-- end #content -->
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
<!-- Add Success -->
<script type="text/javascript">
    // DATA ALREADY
    if (window?.location?.href?.indexOf('DataAlready') > -1) {
        Swal.fire({
            title: 'Data sudah terdaftar!',
            icon: 'info',
            text: 'Data sudah terdaftar disistem, Data harus bersifat uniq atau tidak boleh sama!'
        })
        history.replaceState({}, '', './adm_department.php');
    }

    // INSERT SUCCESS
    if (window?.location?.href?.indexOf('InputSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_department.php');
    }
    // INSERT FAILED
    if (window?.location?.href?.indexOf('InputFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_department.php');
    }

    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil diupdate!',
            icon: 'success',
            text: 'Data berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_department.php');
    }
    // UPDATE FAILED
    if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
        Swal.fire({
            title: 'Data gagal diupdate!',
            icon: 'error',
            text: 'Data gagal diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_department.php');
    }

    // DELETE SUCCESS
    if (window?.location?.href?.indexOf('DeleteSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil dihapus!',
            icon: 'success',
            text: 'Data berhasil dihapus didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_department.php');
    }
    // DELETE FAILED
    if (window?.location?.href?.indexOf('DeleteFailed') > -1) {
        Swal.fire({
            title: 'Data gagal dihapus!',
            icon: 'error',
            text: 'Data gagal dihapus didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_department.php');
    }
</script>