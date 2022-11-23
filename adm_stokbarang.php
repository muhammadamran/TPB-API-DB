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
$dateMB        = date('m');
$dateYB        = date('Y');
// CREATE Stok Barang
if (isset($_POST["add_"])) {

    $CekKD          = $_POST['NameBarang'];
    $CekM           = $_POST['NameBulan'];
    $CekY           = $_POST['NameTahun'];

    $DataCekValidasi = $dbcon->query("SELECT kd_barang,stock_month,stock_year FROM tbl_cust_stock WHERE kd_barang='$CekKD' AND stock_month='$CekM' AND stock_year='$CekY'");
    $HasilCekValidasi = mysqli_fetch_array($DataCekValidasi);

    if ($HasilCekValidasi != NULL) {
        echo "<script>window.location.href='adm_stokbarang.php?DataAlready=true';</script>";
    } else {
        $dataBarang     = $dbcon->query("SELECT KODE_BARANG,URAIAN FROM plb_barang WHERE KODE_BARANG='$CekKD' GROUP BY KODE_BARANG ORDER BY URAIAN ASC");
        $resultBarang   = mysqli_fetch_array($dataBarang);

        $NameKD                 = $resultBarang['KODE_BARANG'];
        $NameUraian             = $resultBarang['URAIAN'];
        $NameCarton             = $_POST['NameCarton'];
        $NameBotol              = $_POST['NameBotol'];
        $NameBulan              = $_POST['NameBulan'];
        $NameTahun              = $_POST['NameTahun'];

        $query = $dbcon->query("INSERT INTO tbl_cust_stock
                               (id,kd_barang,uraian,carton,botol,stock_month,stock_year)
                               VALUES
                               ('','$NameKD','$NameUraian','$NameCarton','$NameBotol','$NameBulan','$NameTahun')");

        // FOR AKTIFITAS
        $me = $_SESSION['username'];
        $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Stok Barang';
        $InputDescription     = $me . " Insert Data: " .  $NameMitra . "-" .  $NameTahun . " ,Simpan Data Sebagai Log Stok Barang";
        $InputAction          = 'Insert';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                               (id,IDUNIQ,username,modul,description,action,date_created)
                               VALUES
                               ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");


        if ($query) {
            echo "<script>window.location.href='adm_stokbarang.php?InputSuccess=true';</script>";
        } else {
            echo "<script>window.location.href='adm_stokbarang.php?InputFailed=true';</script>";
        }
    }
}
// END CREATE Stok Barang

// UPDATE Stok Barang
if (isset($_POST["NUpdateData"])) {

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
                                                       WHERE id='$IDUNIQ'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Stok Barang';
    $InputDescription     = $me . " Update Data: " .  $UpdateMitra . "-" .  $UpdateTahun . ", Simpan Data Sebagai Log Stok Barang";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                               (id,IDUNIQ,username,modul,description,action,date_created)
                               VALUES
                               ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_stokbarang.php?UpdateSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_stokbarang.php?UpdateFailed=true';</script>";
    }
    // }
}
// END UPDATE Stok Barang

// DELETE Stok Barang
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
    $InputModul           = 'Stok Barang';
    $InputDescription     = $me . " Hapus Data: " .  $DeleteMitra . "-" .  $DeleteTahun . ", Simpan Data Sebagai Log Stok Barang";
    $InputAction          = 'Hapus';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    $query .= $dbcon->query("DELETE FROM tbl_cust_quota WHERE id='$IDUNIQ'");

    if ($query) {
        echo "<script>window.location.href='adm_stokbarang.php?DeleteSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_stokbarang.php?DeleteFailed=true';</script>";
    }
}
// END DELETE Stok Barang

// FUNCTION SEARCHING
$FindBulan = '';
$FindTahun = '';
// END FUNCTION SEARCHING

if (isset($_POST['FindFilter']) != '') {
    if (isset($_POST['FindBulan'])) {
        $FindBulan = $_POST['FindBulan'];
    }
    if (isset($_POST['FindTahun'])) {
        $FindTahun = $_POST['FindTahun'];
    }
}
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Stok Barang App Name | Company </title>
<?php } else { ?>
    <title>Stok Barang - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fa-solid fa-cubes icon-page"></i>
                <font class="text-page">Stok Barang</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">Data Online</a></li>
                <li class="breadcrumb-item active">Stok Barang</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- begin Search -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-filter"></i> Filter Stok Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Bulan & Tahun</label>
                                <div class="col-md-4">
                                    <select type="text" class="default-select2 form-control" name="FindBulan">
                                        <?php if ($FindBulan == NULL) { ?>
                                            <option value="">Pilih Bulan</option>
                                        <?php } else { ?>
                                            <option value="<?= $FindBulan ?>"><?= $FindBulan ?></option>
                                            <option value="">Pilih Bulan</option>
                                        <?php } ?>
                                        <option value="1">January</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select type="text" class="default-select2 form-control" name="FindTahun">
                                        <?php if ($FindTahun == NULL) { ?>
                                            <option value="">Pilih Tahun</option>
                                        <?php } else { ?>
                                            <option value="<?= $FindTahun ?>"><?= $FindTahun ?></option>
                                            <option value="">Pilih Tahun</option>
                                        <?php } ?>
                                        <?php
                                        for ($year = date('Y'); $year >= date('Y') - 2; $year -= 1) {
                                            echo "<option value='$year'> $year </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7 offset-md-3">
                                    <button type="submit" class="btn btn-info m-r-5" name="FindFilter">
                                        <i class="fa fa-search"></i>
                                        <font class="f-action">Cari</font>
                                    </button>
                                    <a href="adm_stokbarang.php" type="button" class="btn btn-warning m-r-5">
                                        <i class="fa fa-refresh"></i>
                                        <font class="f-action">Reset</font>
                                    </a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="ui-modal-notification-2">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Data Stok Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body">
                    <!-- css-button -->
                    <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                        <div class="css-button">
                            <?php include "modal/m_adm_stokbarang.php"; ?>
                        </div>
                    <?php } ?>
                    <!-- end css-button -->
                    <div class="table-responsive">
                        <table id="TableDefault_L" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th rowspan="2" style="text-align: center;">Bulan</th>
                                    <th rowspan="2" style="text-align: center;">Tahun</th>
                                    <th colspan="2" style="text-align: center;">Barang</th>
                                    <th rowspan="2" style="text-align: center;">Carton</th>
                                    <th rowspan="2" style="text-align: center;">Botol</th>
                                    <th rowspan="2" class="text-nowrap no-sort" style="text-align: center;">Aksi</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">Kode Barang</th>
                                    <th style="text-align: center;">Uraian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['FindFilter'])) {
                                    $dataTable = $dbcon->query("SELECT 
                                                                stock.id,
                                                                stock.kd_barang,
                                                                stock.uraian,
                                                                stock.carton,
                                                                stock.botol,
                                                                stock.stock_month,
                                                                stock.stock_year,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN AS U_BRG
                                                                FROM tbl_cust_stock AS stock 
                                                                LEFT OUTER JOIN plb_barang AS brg ON brg.KODE_BARANG=stock.kd_barang
                                                                WHERE stock.stock_month='$FindBulan' AND stock.stock_year='$FindTahun' GROUP BY stock.kd_barang HAVING stock.stock_month AND stock.stock_year ORDER BY stock.id DESC");
                                } else {
                                    $dataTable = $dbcon->query("SELECT 
                                                                stock.id,
                                                                stock.kd_barang,
                                                                stock.uraian,
                                                                stock.carton,
                                                                stock.botol,
                                                                stock.stock_month,
                                                                stock.stock_year,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN AS U_BRG
                                                                FROM tbl_cust_stock AS stock 
                                                                LEFT OUTER JOIN plb_barang AS brg ON brg.KODE_BARANG=stock.kd_barang
                                                                WHERE stock.stock_month='$dateMB' AND stock.stock_year='$dateYB' GROUP BY stock.kd_barang HAVING stock.stock_month AND stock.stock_year ORDER BY stock.id DESC");
                                }
                                if (mysqli_num_rows($dataTable) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($dataTable)) {
                                        $no++;
                                ?>
                                        <tr class="odd gradeX">
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center;"><?= $row['stock_month'] ?></td>
                                            <td style="text-align: left;"><?= $row['stock_year'] ?></td>
                                            <td style="text-align: left;"><?= $row['kd_barang'] ?></td>
                                            <td style="text-align: left;"><?= $row['uraian'] ?></td>
                                            <td style="text-align: center;"><?= $row['carton'] ?></td>
                                            <td style="text-align: center;"><?= $row['botol'] ?></td>
                                            <td style="text-align: center;">
                                                <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                                    <a href="#updateData<?= $row['id'] ?>" class="btn btn-warning" data-toggle="modal" title="Update Data"><i class="fas fa-edit"></i>
                                                        <font class="f-action">Update</font>
                                                    </a>
                                                <?php } ?>
                                                <?php if ($resultForPrivileges['DELETE_DATA'] == 'Y') { ?>
                                                    <a href="#deleteData<?= $row['id'] ?>" class="btn btn-danger" data-toggle="modal" title="Hapus Data"><i class="fas fa-trash"></i>
                                                        <font class="f-action">Hapus</font>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <!-- Update Data -->
                                        <div class="modal fade" id="updateData<?= $row['id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Update Data] Stok Barang - <?= $row['kd_barang'] ?> <?= $row['uraian'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IDEBarang">Barang</label>
                                                                            <select type="text" class="default-select2 form-control" name="NameBarang" id="IDEBarang" required>
                                                                                <option value="">-- Pilih Barang --</option>
                                                                                <?php
                                                                                $dataBarang = $dbcon->query("SELECT KODE_BARANG,URAIAN FROM plb_barang GROUP BY KODE_BARANG ORDER BY KODE_BARANG ASC");
                                                                                foreach ($dataBarang as $rowBarang) {
                                                                                ?>
                                                                                    <option value="<?= $rowBarang['KODE_BARANG'] ?>"><?= $rowBarang['KODE_BARANG'] ?> - <?= $rowBarang['URAIAN'] ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IDEBulan">Bulan</label>
                                                                            <select type="text" class="default-select2 form-control" name="NameBulan" id="IDEBulan" required>
                                                                                <option value=""><?= $row['stock_month']; ?></option>
                                                                                <option value="">-- Pilih Bulan --</option>
                                                                                <option value="1">January</option>
                                                                                <option value="2">Februari</option>
                                                                                <option value="3">Maret</option>
                                                                                <option value="4">April</option>
                                                                                <option value="5">Mei</option>
                                                                                <option value="6">Juni</option>
                                                                                <option value="7">Juli</option>
                                                                                <option value="8">Agustus</option>
                                                                                <option value="9">September</option>
                                                                                <option value="10">Oktober</option>
                                                                                <option value="11">November</option>
                                                                                <option value="12">Desember</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IDETahun">Tahun</label>
                                                                            <select type="text" class="default-select2 form-control" name="NameTahun" id="IDETahun" required>
                                                                                <option value=""><?= $row['stock_year']; ?></option>
                                                                                <option value="">-- Pilih Tahun --</option>
                                                                                <?php
                                                                                for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                                                                                    echo "<option value='$i'> $i </option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="IDEJumlahCarton">Jumlah Carton</label>
                                                                            <input type="number" class="form-control" name="NameCarton" id="IDEJumlahCarton" placeholder="Jumlah Carton" value="<?= $row['carton']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="IDEJumlahBotol">Jumlah Botol</label>
                                                                            <input type="number" class="form-control" name="NameBotol" id="IDEJumlahBotol" placeholder="Jumlah Botol" value="<?= $row['botol']; ?>">
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
                                                            <h4 class="modal-title">[Hapus Data] Stok Barang - <?= $row['NPWP'] ?> <?= $row['NAMA'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger m-b-0">
                                                                <h5><i class="fa fa-info-circle"></i> Anda yakin akan menghapus data ini?</h5>
                                                                <p>Anda tidak akan melihat data ini lagi, data akan di hapus secara permanen pada aplikasi!<br><i>"Silahkan klik <b>Ya</b> untuk melanjutkan proses penghapusan data."</i></p>
                                                                <input type="hidden" name="DeleteMitra" value="<?= $row['NAMA'] ?>">
                                                                <input type="hidden" name="DeleteTahun" value="<?= $row['quota_year'] ?>">
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
                                        <td colspan="8">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <?php
                                if (isset($_POST['FindFilter'])) {
                                    $dataCT      = $dbcon->query("SELECT SUM(carton) AS t_ct FROM tbl_cust_stock WHERE stock_month='$FindBulan' AND stock_year='$FindTahun'");
                                    $resutlCT    = mysqli_fetch_array($dataCT);
                                    $dataBTL     = $dbcon->query("SELECT SUM(botol) AS t_btl FROM tbl_cust_stock WHERE stock_month='$FindBulan' AND stock_year='$FindTahun'");
                                    $resutlBTL   = mysqli_fetch_array($dataBTL);
                                } else {
                                    $dataCT      = $dbcon->query("SELECT SUM(carton) AS t_ct FROM tbl_cust_stock WHERE stock_month='$dateMB' AND stock_year='$dateYB'");
                                    $resutlCT    = mysqli_fetch_array($dataCT);
                                    $dataBTL     = $dbcon->query("SELECT SUM(botol) AS t_btl FROM tbl_cust_stock WHERE stock_month='$dateMB' AND stock_year='$dateYB'");
                                    $resutlBTL   = mysqli_fetch_array($dataBTL);
                                }
                                ?>
                                <tr>
                                    <th colspan="5" style="text-align: center;">TOTAL</th>
                                    <th style="text-align: center;"><?= $resutlCT['t_ct']; ?></th>
                                    <th style="text-align: center;"><?= $resutlBTL['t_btl']; ?></th>
                                    <th style="text-align: center;"></th>
                                </tr>
                            </tfoot>
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
<?php include "include/pusat_bantuan.php"; ?>
<?php include "include/riwayat_aktifitas.php"; ?>
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
<?php include "include/jsForm.php"; ?>
<!-- Add Success -->
<script type="text/javascript">
    // DATA ALREADY
    if (window?.location?.href?.indexOf('DataAlready') > -1) {
        Swal.fire({
            title: 'Data Sudah Terdaftar!',
            icon: 'info',
            text: 'Data sudah terdaftar disistem, Data harus bersifat uniq atau tidak boleh sama!'
        })
        history.replaceState({}, '', './adm_stokbarang.php');
    }

    // INSERT SUCCESS
    if (window?.location?.href?.indexOf('InputSuccess') > -1) {
        Swal.fire({
            title: 'Sukses!',
            icon: 'success',
            text: 'Data berhasil disimpan!'
        })
        history.replaceState({}, '', './adm_stokbarang.php');
    }
    // INSERT FAILED
    if (window?.location?.href?.indexOf('InputFailed') > -1) {
        Swal.fire({
            title: 'Gagal!',
            icon: 'error',
            text: 'Data gagal disimpan!'
        })
        history.replaceState({}, '', './adm_stokbarang.php');
    }

    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
        Swal.fire({
            title: 'Sukses!',
            icon: 'success',
            text: 'Data berhasil diupdate!'
        })
        history.replaceState({}, '', './adm_stokbarang.php');
    }
    // UPDATE FAILEDú
    if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
        Swal.fire({
            title: 'Gagal!',
            icon: 'error',
            text: 'Data gagal diupdate!'
        })
        history.replaceState({}, '', './adm_stokbarang.php');
    }

    // DELETE SUCCESS
    if (window?.location?.href?.indexOf('DeleteSuccess') > -1) {
        Swal.fire({
            title: 'Sukses!',
            icon: 'success',
            text: 'Data berhasil dihapus!'
        })
        history.replaceState({}, '', './adm_stokbarang.php');
    }
    // DELETE FAILED
    if (window?.location?.href?.indexOf('DeleteFailed') > -1) {
        Swal.fire({
            title: 'Gagal!',
            icon: 'error',
            text: 'Data gagal dihapus!'
        })
        history.replaceState({}, '', './adm_stokbarang.php');
    }
</script>