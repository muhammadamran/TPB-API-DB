<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
?>
<?php
// CREATE KUOTA MITRA
if (isset($_POST["add_kuota"])) {

    $CekNameNPWP = $_POST['NameMitra'];
    $CekNameTahun = $_POST['NameTahun'];

    $DataCekValidasi = $dbcon->query("SELECT tbb_nama,quota_year FROM tbl_cust_quota WHERE tbb_nama='$CekNameNPWP' AND quota_year='$CekNameTahun'");
    $HasilCekValidasi = mysqli_fetch_array($DataCekValidasi);

    if ($HasilCekValidasi != NULL) {
        echo "<script>window.location.href='adm_kuota.php?DataAlready=true';</script>";
    } else {
        $NameMitra              = $_POST['NameMitra'];
        $NameTahun              = $_POST['NameTahun'];
        // Golongan A
        // $NameGol_A              = $_POST['NameGol_A'];
        $NameKuotaCARTON_A      = $_POST['NameKuotaCARTON_A'];
        $NameKuotaLITER_A       = $_POST['NameKuotaLITER_A'];
        // Golongan B
        // $NameGol_B              = $_POST['NameGol_B'];
        $NameKuotaCARTON_B      = $_POST['NameKuotaCARTON_B'];
        $NameKuotaLITER_B       = $_POST['NameKuotaLITER_B'];
        // Golongan C
        // $NameGol_C              = $_POST['NameGol_C'];
        $NameKuotaCARTON_C      = $_POST['NameKuotaCARTON_C'];
        $NameKuotaLITER_C       = $_POST['NameKuotaLITER_C'];

        $query = $dbcon->query("INSERT INTO tbl_cust_quota
                               (quota_id,tbb_nama,gol_a_car,gol_a_ltr,gol_b_car,gol_b_ltr,gol_c_car,gol_c_ltr,quota_year)
                               VALUES
                               ('','$NameMitra','$NameKuotaCARTON_A','$NameKuotaLITER_A','$NameKuotaCARTON_B','$NameKuotaLITER_B','$NameKuotaCARTON_C','$NameKuotaLITER_C','$NameTahun')");

        // FOR AKTIFITAS
        $me = $_SESSION['username'];
        $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Administrator Tools/Kuota Mitra';
        $InputDescription     = $me . " Insert Data: " .  $NameMitra . "-" .  $NameTahun . " ,Simpan Data Sebagai Log Kuota Mitra";
        $InputAction          = 'Insert';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                               (id,IDUNIQ,username,modul,description,action,date_created)
                               VALUES
                               ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");


        if ($query) {
            echo "<script>window.location.href='adm_kuota.php?InputSuccess=true';</script>";
        } else {
            echo "<script>window.location.href='adm_kuota.php?InputFailed=true';</script>";
        }
    }
}
// END CREATE KUOTA MITRA
// 
// UPDATE KUOTA MITRA
if (isset($_POST["NUpdateData"])) {

    // $CekUpdateMitra = $_POST['UpdateMitra'];
    // $CekUpdateTahun = $_POST['UpdateTahun'];

    // $DataCekValidasi = $dbcon->query("SELECT tbb_nama,quota_year FROM tbl_cust_quota WHERE tbb_nama='$CekUpdateMitra' AND quota_year='$CekUpdateTahun'");
    // $HasilCekValidasi = mysqli_fetch_array($DataCekValidasi);

    // if ($HasilCekValidasi != NULL) {
    //     echo "<script>window.location.href='adm_kuota.php?DataAlready=true';</script>";
    // } else {
    $IDUNIQ                   = $_POST['IDUNIQ'];
    $UpdateMitra              = $_POST['UpdateMitra'];
    $UpdateTahun              = $_POST['UpdateTahun'];
    // Golongan A
    // $UpdateGol_A              = $_POST['UpdateGol_A'];
    $UpdateKuotaCARTON_A      = $_POST['UpdateKuotaCARTON_A'];
    $UpdateKuotaLITER_A       = $_POST['UpdateKuotaLITER_A'];
    // Golongan B
    // $UpdateGol_B              = $_POST['UpdateGol_B'];
    $UpdateKuotaCARTON_B      = $_POST['UpdateKuotaCARTON_B'];
    $UpdateKuotaLITER_B       = $_POST['UpdateKuotaLITER_B'];
    // Golongan C
    // $UpdateGol_C              = $_POST['UpdateGol_C'];
    $UpdateKuotaCARTON_C      = $_POST['UpdateKuotaCARTON_C'];
    $UpdateKuotaLITER_C       = $_POST['UpdateKuotaLITER_C'];

    $query = $dbcon->query("UPDATE tbl_cust_quota SET tbb_nama='$UpdateMitra',
                                                          gol_a_car='$UpdateKuotaCARTON_A',
                                                          gol_a_ltr='$UpdateKuotaLITER_A',
                                                          gol_b_car='$UpdateKuotaCARTON_B',
                                                          gol_b_ltr='$UpdateKuotaLITER_B',
                                                          gol_c_car='$UpdateKuotaCARTON_C',
                                                          gol_c_ltr='$UpdateKuotaLITER_C',
                                                          quota_year='$UpdateTahun'
                                                       WHERE quota_id='$IDUNIQ'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Kuota Mitra';
    $InputDescription     = $me . " Update Data: " .  $UpdateMitra . "-" .  $UpdateTahun . ", Simpan Data Sebagai Log Kuota Mitra";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                               (id,IDUNIQ,username,modul,description,action,date_created)
                               VALUES
                               ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_kuota.php?UpdateSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_kuota.php?UpdateFailed=true';</script>";
    }
    // }
}
// END UPDATE KUOTA MITRA

// DELETE KUOTA MITRA
if (isset($_POST["NDeleteData"])) {

    $IDUNIQ             = $_POST['IDUNIQ'];
    $DeleteMitra        = $_POST['DeleteMitra'];
    $DeleteTahun        = $_POST['DeleteTahun'];

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Kuota Mitra';
    $InputDescription     = $me . " Hapus Data: " .  $DeleteMitra . "-" .  $DeleteTahun . ", Simpan Data Sebagai Log Kuota Mitra";
    $InputAction          = 'Hapus';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    $query .= $dbcon->query("DELETE FROM tbl_cust_quota WHERE quota_id='$IDUNIQ'");

    if ($query) {
        echo "<script>window.location.href='adm_kuota.php?DeleteSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_kuota.php?DeleteFailed=true';</script>";
    }
}
// END DELETE KUOTA MITRA
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
                <li class="breadcrumb-item active">Kuota Mitra</li>
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
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Administrator Tools] Kuota Mitra</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body">
                    <!-- css-button -->
                    <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                        <div class="css-button">
                            <?php include "modal/m_adm_kuota.php"; ?>
                        </div>
                    <?php } ?>
                    <!-- end css-button -->
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">#</th>
                                    <th rowspan="2" style="text-align: center;">Tahun</th>
                                    <th colspan="2" style="text-align: center;">Mitra</th>
                                    <th colspan="2" class="text-nowrap" style="text-align: center;">GOL A</th>
                                    <th colspan="2" class="text-nowrap" style="text-align: center;">GOL B</th>
                                    <th colspan="2" class="text-nowrap" style="text-align: center;">GOL C</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Aksi</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">NPWP</th>
                                    <th style="text-align: center;">Nama Mitra</th>
                                    <th style="text-align: center;">CARTON</th>
                                    <th style="text-align: center;">LITER</th>
                                    <th style="text-align: center;">CARTON</th>
                                    <th style="text-align: center;">LITER</th>
                                    <th style="text-align: center;">CARTON</th>
                                    <th style="text-align: center;">LITER</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT * FROM tbl_cust_quota AS a 
                                                            INNER JOIN referensi_pengusaha AS b ON a.tbb_nama=b.ID HAVING a.quota_year ORDER BY a.quota_id DESC");
                                if (mysqli_num_rows($dataTable) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($dataTable)) {
                                        $no++;
                                ?>
                                        <tr class="odd gradeX">
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center;"><?= $row['quota_year'] ?></td>
                                            <td style="text-align: left;"><?= $row['NPWP'] ?></td>
                                            <td style="text-align: left;"><?= $row['NAMA'] ?></td>
                                            <td style="text-align: center;"><?= decimal($row['gol_a_car']) ?></td>
                                            <td style="text-align: center;"><?= decimal($row['gol_a_ltr']) ?></td>
                                            <td style="text-align: center;"><?= decimal($row['gol_b_car']) ?></td>
                                            <td style="text-align: center;"><?= decimal($row['gol_b_ltr']) ?></td>
                                            <td style="text-align: center;"><?= decimal($row['gol_c_car']) ?></td>
                                            <td style="text-align: center;"><?= decimal($row['gol_c_ltr']) ?></td>
                                            <td style="text-align: center;">
                                                <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                                    <a href="#updateData<?= $row['quota_id'] ?>" class="btn btn-warning" data-toggle="modal" title="Update Data"><i class="fas fa-edit"></i> Update</a>
                                                <?php } ?>
                                                <?php if ($resultForPrivileges['DELETE_DATA'] == 'Y') { ?>
                                                    <a href="#deleteData<?= $row['quota_id'] ?>" class="btn btn-danger" data-toggle="modal" title="Hapus Data"><i class="fas fa-trash"></i> Hapus</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <!-- Update Data -->
                                        <div class="modal fade" id="updateData<?= $row['quota_id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Update Data] Kuota Mitra - <?= $row['NPWP'] ?> <?= $row['NAMA'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="IdMitraUpdate<?= $row['quota_id'] ?>">Nama Mitra </label>
                                                                            <input type="hidden" name="IDUNIQ" value="<?= $row['quota_id'] ?>">
                                                                            <select type="text" class="default-select2 form-control" name="UpdateMitra" id="IDMitraUpdate<?= $row['quota_id'] ?>">
                                                                                <option value="<?= $row['tbb_nama'] ?>"><?= $row['tbb_nama'] ?> - <?= $row['NAMA'] ?></option>
                                                                                <option value="">-- Pilih Mitra --</option>
                                                                                <?php
                                                                                $resultMitra = $dbcon->query("SELECT ID,NPWP,NAMA FROM referensi_pengusaha WHERE NAMA IS NOT NULL AND NAMA !='' ORDER BY NAMA ASC");
                                                                                foreach ($resultMitra as $RowMitra) {
                                                                                ?>
                                                                                    <option value="<?= $RowMitra['ID'] ?>"><?= $RowMitra['NPWP'] ?> - <?= $RowMitra['NAMA'] ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdTahunUpdate<?= $row['quota_id'] ?>">Tahun </label>
                                                                            <select type="text" class="default-select2 form-control" name="UpdateTahun" id="IDTahunUpdate<?= $row['quota_id'] ?>">
                                                                                <option value="<?= $row['quota_year'] ?>"><?= $row['quota_year'] ?></option>
                                                                                <option value="">-- Pilih Tahun --</option>
                                                                                <?php
                                                                                for ($i = date('Y'); $i >= date('Y') - 32; $i -= 1) {
                                                                                    echo "<option value='$i'> $i </option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Golongan A -->
                                                                    <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                                                        <label for="IdGol_A_Title">Golongan A</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdGol_A">Golongan A</label>
                                                                            <input type="text" class="form-control" name="UpdateGol_A" value="GOL A" readonly>
                                                                            <!-- <select type="text" class="form-control" name="UpdateGol_A" id="IDGol_A">
                                                                                <option value="">-- Pilih Barang Golongan A --</option>
                                                                                <?php
                                                                                $resultMitra = $dbcon->query("SELECT NAMA FROM referensi_pengusaha ORDER BY NAMA ASC");
                                                                                foreach ($resultMitra as $RowMitra) {
                                                                                ?>
                                                                                    <option value="<?= $RowMitra['ID'] ?>"><?= $RowMitra['ID'] ?> - <?= $RowMitra['NAMA'] ?></option>
                                                                                <?php } ?>
                                                                            </select> -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdCARTON">CARTON </label>
                                                                            <input type="number" class="form-control" name="UpdateKuotaCARTON_A" id="IdKuotaCARTON_A" placeholder="Kuota CARTON" value="<?= $row['gol_a_car'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdLITER">LITER </label>
                                                                            <input type="number" class="form-control" name="UpdateKuotaLITER_A" id="IdKuotaLITER_A" placeholder="Kuota LITER" value="<?= $row['gol_a_ltr'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Golongan A -->
                                                                    <!-- Golongan B -->
                                                                    <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                                                        <label for="IdGol_B_Title">Golongan B</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdGol_B">Golongan B </label>
                                                                            <input type="text" class="form-control" name="UpdateGol_B" value="GOL B" readonly>
                                                                            <!-- <select type="text" class="form-control" name="UpdateGol_B" id="IDGol_B">
                                                                                <option value="">-- Pilih Barang Golongan B --</option>
                                                                                <?php
                                                                                $resultMitra = $dbcon->query("SELECT NAMA FROM referensi_pengusaha ORDER BY NAMA ASC");
                                                                                foreach ($resultMitra as $RowMitra) {
                                                                                ?>
                                                                                    <option value="<?= $RowMitra['ID'] ?>"><?= $RowMitra['ID'] ?> - <?= $RowMitra['NAMA'] ?></option>
                                                                                <?php } ?>
                                                                            </select> -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdCARTON">CARTON </label>
                                                                            <input type="number" class="form-control" name="UpdateKuotaCARTON_B" id="IdKuotaCARTON_B" placeholder="Kuota CARTON" value="<?= $row['gol_b_car'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdLITER">LITER </label>
                                                                            <input type="number" class="form-control" name="UpdateKuotaLITER_B" id="IdKuotaLITER_B" placeholder="Kuota LITER" value="<?= $row['gol_b_ltr'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Golongan B -->
                                                                    <!-- Golongan C -->
                                                                    <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                                                        <label for="IdGol_C_Title">Golongan C</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdGol_C">Golongan C </label>
                                                                            <input type="text" class="form-control" name="UpdateGol_C" value="GOL C" readonly>
                                                                            <!-- <select type="text" class="form-control" name="UpdateGol_C" id="IDGol_C">
                                                                                <option value="">-- Pilih Barang Golongan C --</option>
                                                                                <?php
                                                                                $resultMitra = $dbcon->query("SELECT NAMA FROM referensi_pengusaha ORDER BY NAMA ASC");
                                                                                foreach ($resultMitra as $RowMitra) {
                                                                                ?>
                                                                                    <option value="<?= $RowMitra['ID'] ?>"><?= $RowMitra['ID'] ?> - <?= $RowMitra['NAMA'] ?></option>
                                                                                <?php } ?>
                                                                            </select> -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdCARTON">CARTON </label>
                                                                            <input type="number" class="form-control" name="UpdateKuotaCARTON_C" id="IdKuotaCARTON_C" placeholder="Kuota CARTON" value="<?= $row['gol_c_car'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdLITER">LITER </label>
                                                                            <input type="number" class="form-control" name="UpdateKuotaLITER_C" id="IdKuotaLITER_C" placeholder="Kuota LITER" value="<?= $row['gol_c_ltr'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Golongan C -->
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
                                        <div class="modal fade" id="deleteData<?= $row['quota_id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Hapus Data] Kuota Mitra - <?= $row['NPWP'] ?> <?= $row['NAMA'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger m-b-0">
                                                                <h5><i class="fa fa-info-circle"></i> Anda yakin akan menghapus data ini?</h5>
                                                                <p>Anda tidak akan melihat data ini lagi, data akan di hapus secara permanen pada sistem informasi TPB!<br><i>"Silahkan klik <b>Ya</b> untuk melanjutkan proses penghapusan data."</i></p>
                                                                <input type="hidden" name="DeleteMitra" value="<?= $row['NAMA'] ?>">
                                                                <input type="hidden" name="DeleteTahun" value="<?= $row['quota_year'] ?>">
                                                                <input type="hidden" name="IDUNIQ" value="<?= $row['quota_id'] ?>">
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
                                        <td colspan="11">
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
<?php include "include/jsForm.php"; ?>
<!-- Add Success -->
<script type="text/javascript">
    // DATA ALREADY
    if (window?.location?.href?.indexOf('DataAlready') > -1) {
        Swal.fire({
            title: 'Data sudah terdaftar!',
            icon: 'info',
            text: 'Data sudah terdaftar disistem, Data harus bersifat uniq atau tidak boleh sama!'
        })
        history.replaceState({}, '', './adm_kuota.php');
    }

    // INSERT SUCCESS
    if (window?.location?.href?.indexOf('InputSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_kuota.php');
    }
    // INSERT FAILED
    if (window?.location?.href?.indexOf('InputFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_kuota.php');
    }

    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil diupdate!',
            icon: 'success',
            text: 'Data berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_kuota.php');
    }
    // UPDATE FAILEDú
    if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
        Swal.fire({
            title: 'Data gagal diupdate!',
            icon: 'error',
            text: 'Data gagal diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_kuota.php');
    }

    // DELETE SUCCESS
    if (window?.location?.href?.indexOf('DeleteSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil dihapus!',
            icon: 'success',
            text: 'Data berhasil dihapus didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_kuota.php');
    }
    // DELETE FAILED
    if (window?.location?.href?.indexOf('DeleteFailed') > -1) {
        Swal.fire({
            title: 'Data gagal dihapus!',
            icon: 'error',
            text: 'Data gagal dihapus didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_kuota.php');
    }
</script>