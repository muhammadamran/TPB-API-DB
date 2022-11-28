<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Packing List App Name | Company </title>
<?php } else { ?>
    <title>Laporan Packing List <?= $_GET['AJU']; ?> <?= $resultSetting['company']; ?> - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<?php
// NUMBER
if (isset($_POST['Number_'])) {
    $NUMBER              = $_POST['NUMBER'];
    $TGL_NUMBER          = $_POST['TGL_NUMBER'];
    $NOAJU               = $_POST['NOAJU'];
    $NOAJU_PLB           = $_POST['NOAJU_PLB'];

    $sql = $dbcon->query("UPDATE tpb_header SET NUMBER='$NUMBER',
                                                TGL_NUMBER='$TGL_NUMBER'
                          WHERE NOMOR_AJU='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='report_data_gb_packinglist.php?AJU=$NOAJU_PLB&AlertNumber=true';</script>";
    } else {
        echo "<script>window.location.href='report_data_gb_packinglist.php?AJU=$NOAJU_PLB&AlertNumber=false';</script>";
    }
}
// NO BL
if (isset($_POST['NoBL_'])) {
    $NO_BL               = $_POST['NO_BL'];
    $TGL_NO_BL           = $_POST['TGL_NO_BL'];
    $NOAJU               = $_POST['NOAJU'];
    $NOAJU_PLB           = $_POST['NOAJU_PLB'];

    $sql = $dbcon->query("UPDATE tpb_header SET NO_BL='$NO_BL',
                                                TGL_NO_BL='$TGL_NO_BL'
                          WHERE NOMOR_AJU='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='report_data_gb_packinglist.php?AJU=$NOAJU_PLB&AlertNoBL=true';</script>";
    } else {
        echo "<script>window.location.href='report_data_gb_packinglist.php?AJU=$NOAJU_PLB&AlertNoBL=false';</script>";
    }
}
// WEIGHR
if (isset($_POST['Weight_'])) {
    $WEIGHT              = $_POST['WEIGHT'];
    $WEIGHT_S            = $_POST['WEIGHT_S'];
    $NOAJU               = $_POST['NOAJU'];
    $NOAJU_PLB           = $_POST['NOAJU_PLB'];

    $sql = $dbcon->query("UPDATE tpb_header SET WEIGHT='$WEIGHT',
                                                WEIGHT_S='$WEIGHT_S'
                          WHERE NOMOR_AJU='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='report_data_gb_packinglist.php?AJU=$NOAJU_PLB&AlertOriginal=true';</script>";
    } else {
        echo "<script>window.location.href='report_data_gb_packinglist.php?AJU=$NOAJU_PLB&AlertOriginal=false';</script>";
    }
}
// ORIGINAL
if (isset($_POST['Orginial_'])) {
    $KodeNegara          = $_POST['KodeNegara'];
    $NOAJU               = $_POST['NOAJU'];
    $NOAJU_PLB           = $_POST['NOAJU_PLB'];

    $sql = $dbcon->query("UPDATE tpb_header SET KODE_NEGARA_PEMASOK='$KodeNegara'
                          WHERE NOMOR_AJU='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='report_data_gb_packinglist.php?AJU=$NOAJU_PLB&AlertOriginal=true';</script>";
    } else {
        echo "<script>window.location.href='report_data_gb_packinglist.php?AJU=$NOAJU_PLB&AlertOriginal=false';</script>";
    }
}
// DATA HEADER
$dataHeader = $dbcon->query("SELECT *,
                            SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU,
                            -- PLB
                            plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                            plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_PLB,
                            plb.TANGGAL_DAFTAR AS TANGGAL_DAFTAR_PLB,
                            plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                            plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                            plb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_PLB,
                            plb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_PLB,
                            plb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                            -- TPB
                            tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                            tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_GB,
                            tpb.TANGGAL_DAFTAR AS TANGGAL_DAFTAR_GB,
                            tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                            tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                            tpb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_GB,
                            tpb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_GB,
                            tpb.NUMBER AS NUMBER_GB,
                            tpb.TGL_NUMBER AS TGL_NUMBER_GB,
                            tpb.NO_BL AS NO_BL_GB,
                            tpb.TGL_NO_BL AS TGL_NO_BL_GB,
                            tpb.WEIGHT,
                            tpb.WEIGHT_S,
                            tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                            ngr.URAIAN_NEGARA
                            FROM rcd_status AS rcd
                            LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                            LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                            LEFT OUTER JOIN referensi_negara AS ngr ON tpb.KODE_NEGARA_PEMASOK=ngr.KODE_NEGARA
                            WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "'
                            ORDER BY rcd.rcd_id DESC");
$resultdataHeader = mysqli_fetch_array($dataHeader);
?>
<div id="content" class="nav-top-content">
    <div class="header-laporan">
        <form action="" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <a href="report_data_gb.php" class="btn btn-dark"><i class="fas fa-caret-square-left"></i> Kembali</a>
                </div>
                <div class="col-sm-6" id="p-e">
                    <div style="display: flex;justify-content: end;">
                        <div>
                            <form action="report_data_packinglist_pdf.php" target="_blank" method="POST">
                                <input type="hidden" name="S_RTU" value="<?= $S_RTU ?>">
                                <input type="hidden" name="E_RTU" value="<?= $E_RTU ?>">
                                <input type="hidden" name="ShowField_RTU" value="<?= $ShowField_RTU ?>">
                                <button type="submit" name="Find_RTU" class="btn btn-secondary" style="border-radius: 5px 0 0 5px;border-right-color: #545b62;"><i class="fas fa-print"></i> Print</button>
                            </form>
                        </div>
                        <div class="btn-group m-r-5 m-b-5">
                            <a href="javascript:;" class="btn btn-secondary" style="border-radius: 0 0 0 0 ;"><i class=" fas fa-file-export"></i> Export File</a>
                            <a href="#" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle"><b class="caret"></b></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <form action="report_data_packinglist_excel.php" target="_blank" method="POST">
                                    <input type="hidden" name="S_RTU" value="<?= $S_RTU ?>">
                                    <input type="hidden" name="E_RTU" value="<?= $E_RTU ?>">
                                    <input type="hidden" name="ShowField_RTU" value="<?= $ShowField_RTU ?>">
                                    <button type="submit" name="Find_RTU" class="dropdown-item">Download as XLS</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="invoice">
        <div class="line-page-table-n"></div>
        <div class="row" style="display: flex;align-items: center;margin-bottom: -5px;">
            <div class="col-md-3">
                <div style="display: flex;justify-content: center;">
                    <?php if ($resultHeadSetting['logo'] == NULL) { ?>
                        <img src="assets/images/logo/logo-default.png" width="30%">
                    <?php } else { ?>
                        <img src="assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="50%">
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-9">
                <div style="display: grid;">
                    <font style="font-size: 24px;font-weight: 800;">Laporan Data Gudang Berikat</font>
                    <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                    <font style="font-size: 12px;font-weight: 800;">No. Pengajuan PLB: <?= $resultdataHeader['NOMOR_AJU_PLB']; ?></font>
                    <font style="font-size: 12px;font-weight: 800;">No. Pengajuan GB: <?= $resultdataHeader['NOMOR_AJU_GB']; ?></font>
                    <font style="font-size: 18px;font-weight: 800;"><?= $resultHeadSetting['company_t'] ?></font>
                    <div class="line-page-table"></div>
                    <font style="font-size: 14px;font-weight: 400;"><i class="fa-solid fa-location-dot"></i> <?= $resultHeadSetting['address'] ?></font>
                </div>
            </div>
            <div class="col-md-12">
                <div>
                    <hr>
                    <p><span style="color: #404040; font-family: Arial Black; font-size: xx-large;">PACKING LIST</span></p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row" style="font-size: 14px;">
            <div class="col-sm-6">
                <div class="row">
                    <!-- DUTY-FREE NAME -->
                    <div class="col-3" style="font-weight: 900;">
                        DUTY-FREE NAME
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <p><?= $resultdataHeader['NAMA_PENERIMA_BARANG_GB']; ?></p>
                    </div>
                    <!-- NPWP -->
                    <div class="col-3" style="font-weight: 900;">
                        NPWP
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <p><?= NPWP($resultdataHeader['ID_PENERIMA_BARANG_GB']); ?></p>
                    </div>
                    <!-- STREET ADDRESS -->
                    <div class="col-3" style="font-weight: 900;">
                        STREET ADDRESS
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <p><?= $resultdataHeader['ALAMAT_PENERIMA_BARANG_GB']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <!-- NUMBER -->
                    <div class="col-3" style="font-weight: 900;">
                        NUMBER
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $resultdataHeader['NUMBER_GB']; ?>
                                <a href="#M_NUMBER" class="label label-default" data-toggle="modal"><i class="fas fa-edit"></i></a>
                            </div>
                            <div class="col-sm-6">
                                <?php if ($resultdataHeader['TGL_NUMBER_GB'] != NULL) { ?>
                                    <?= date_indo($resultdataHeader['TGL_NUMBER_GB']); ?>
                                <?php } ?>
                            </div>
                        </div>
                        <br>
                    </div>
                    <!-- NUMBER -->
                    <div class="modal fade" id="M_NUMBER">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h4 class="modal-title">[Edit Data] Number</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Number <small style="color:red">*</small></label>
                                                    <input type="text" id="input-Number" name="NUMBER" class="form-control" value="<?= $resultdataHeader['NUMBER_GB']; ?>" placeholder="Number ..." required>
                                                    <input type="hidden" name="NOAJU" value="<?= $resultdataHeader['NOMOR_AJU_GB']; ?>" readonly>
                                                    <input type="hidden" name="NOAJU_PLB" value="<?= $resultdataHeader['NOMOR_AJU_PLB']; ?>" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Tanggal Number <small style="color:red">*</small></label>
                                                    <input type="date" name="TGL_NUMBER" class="form-control" value="<?= $resultdataHeader['TGL_NUMBER_GB']; ?>" required>
                                                </div>
                                                <div class="col-md-12" style="font-size: 12px;">
                                                    <br>
                                                    <br>
                                                    <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                        <button type="submit" name="Number_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End NUMBER -->
                    <!-- EX BILL OF LADING -->
                    <div class="col-3" style="font-weight: 900;">
                        EX BILL OF LADING
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $resultdataHeader['NO_BL_GB']; ?>
                                <a href="#M_NO_BL" class="label label-default" data-toggle="modal"><i class="fas fa-edit"></i></a>
                            </div>
                            <div class="col-sm-6">
                                <?php if ($resultdataHeader['TGL_NO_BL_GB'] != NULL) { ?>
                                    <?= date_indo($resultdataHeader['TGL_NO_BL_GB']); ?>
                                <?php } ?>
                            </div>
                        </div>
                        <br>
                    </div>
                    <!-- NO BL -->
                    <div class="modal fade" id="M_NO_BL">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h4 class="modal-title">[Edit Data] Ex Bill of Lading</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Ex Bill of Lading <small style="color:red">*</small></label>
                                                    <input type="text" id="input-NoBL" name="NO_BL" class="form-control" value="<?= $resultdataHeader['NO_BL_GB']; ?>" placeholder="Ex Bill of Lading ..." required>
                                                    <input type="hidden" name="NOAJU" value="<?= $resultdataHeader['NOMOR_AJU_GB']; ?>" readonly>
                                                    <input type="hidden" name="NOAJU_PLB" value="<?= $resultdataHeader['NOMOR_AJU_PLB']; ?>" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Tanggal Ex Bill of Lading <small style="color:red">*</small></label>
                                                    <input type="date" name="TGL_NO_BL" class="form-control" value="<?= $resultdataHeader['TGL_NO_BL_GB']; ?>" required>
                                                </div>
                                                <div class="col-md-12" style="font-size: 12px;">
                                                    <br>
                                                    <br>
                                                    <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                        <button type="submit" name="NoBL_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End NO BL -->
                    <!-- NO. DOKUMEN -->
                    <div class="col-3" style="font-weight: 900;">
                        NO. DOKUMEN
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <?php
                            // PLB
                            $dataNoDokumen = $dbcon->query("SELECT 
                                                            dok.NOMOR_AJU,dok.NOMOR_DOKUMEN,dok.TANGGAL_DOKUMEN,
                                                            ref.URAIAN_DOKUMEN
                                                            FROM plb_dokumen AS dok 
                                                            LEFT OUTER JOIN referensi_dokumen AS ref ON ref.KODE_DOKUMEN=dok.KODE_JENIS_DOKUMEN
                                                            WHERE dok.NOMOR_AJU='" . $_GET['AJU'] . "'");
                            foreach ($dataNoDokumen as $resultNoDokumen) {
                            ?>
                                <div class="col-sm-6">
                                    <?= $resultNoDokumen['NOMOR_DOKUMEN'] ?>
                                    <font style="font-size: 8px;">(<?= $resultNoDokumen['URAIAN_DOKUMEN'] ?>)</font>
                                </div>
                                <div class="col-sm-6"><?= $resultNoDokumen['TANGGAL_DOKUMEN'] ?></div>
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <!-- WEIGHT -->
                    <div class="col-3" style="font-weight: 900;">
                        WEIGHT
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <p>
                            <?= decimal($resultdataHeader['WEIGHT']); ?> <?= $resultdataHeader['WEIGHT_S']; ?>
                            <a href="#M_WEIGHT" class="label label-default" data-toggle="modal"><i class="fas fa-edit"></i></a>
                        </p>
                    </div>
                    <!-- Weight -->
                    <div class="modal fade" id="M_WEIGHT">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h4 class="modal-title">[Edit Data] Weight</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Weight <small style="color:red">*</small></label>
                                                    <div class="input-group m-b-10">
                                                        <input type="number" name="WEIGHT" class="form-control" placeholder="Weight ..." value="<?= $resultdataHeader['WEIGHT']; ?>" required />
                                                        <div class="input-group-append">
                                                            <select name="WEIGHT_S" class="btn btn-default form-control" name="">
                                                                <?php if ($resultdataHeader['WEIGHT'] != NULL) { ?>
                                                                    <option value="<?= $resultdataHeader['WEIGHT_S']; ?>"><?= $resultdataHeader['WEIGHT_S']; ?></option>
                                                                <?php } ?>
                                                                <option value="">Pilih Satuan</option>
                                                                <option value="kg">kg</option>
                                                                <option value="hg (ons)">hg (ons)</option>
                                                                <option value="dag">dag</option>
                                                                <option value="g">g</option>
                                                                <option value="dg">dg</option>
                                                                <option value="cg">cg</option>
                                                                <option value="mg">mg</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="NOAJU" value="<?= $resultdataHeader['NOMOR_AJU_GB']; ?>" readonly>
                                                    <input type="hidden" name="NOAJU_PLB" value="<?= $resultdataHeader['NOMOR_AJU_PLB']; ?>" readonly>
                                                </div>
                                                <div class="col-md-12" style="font-size: 12px;">
                                                    <br>
                                                    <br>
                                                    <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                        <button type="submit" name="Weight_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Weight -->
                    <!-- ORIGINAL -->
                    <div class="col-3" style="font-weight: 900;">
                        ORIGINAL
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <p>
                            <?= $resultdataHeader['URAIAN_NEGARA']; ?>
                            <a href="#M_ORIGINAL" class="label label-default" data-toggle="modal"><i class="fas fa-edit"></i></a>
                        </p>
                    </div>
                    <!-- Original -->
                    <div class="modal fade" id="M_ORIGINAL">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h4 class="modal-title">[Edit Data] Original</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Original <small style="color:red">*</small></label>
                                                    <select name="KodeNegara" class="default-select2 form-control" required>
                                                        <?php if ($resultdataHeader['KODE_NEGARA'] != NULL) { ?>
                                                            <option value="<?= $resultdataHeader['KODE_NEGARA']; ?>"><?= $resultdataHeader['KODE_NEGARA']; ?> - <?= $resultdataHeader['URAIAN_NEGARA']; ?></option>
                                                            <option value="">Pilih Original</option>
                                                        <?php } ?>
                                                        <option value="">Pilih Original</option>
                                                        <?php
                                                        $dataKDN = $dbcon->query("SELECT * FROM referensi_negara");
                                                        foreach ($dataKDN as $rowKDN) { ?>
                                                            <option value="<?= $rowKDN['KODE_NEGARA']; ?>"><?= $rowKDN['KODE_NEGARA']; ?> - <?= $rowKDN['URAIAN_NEGARA']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" name="NOAJU" value="<?= $resultdataHeader['NOMOR_AJU_GB']; ?>" readonly>
                                                    <input type="hidden" name="NOAJU_PLB" value="<?= $resultdataHeader['NOMOR_AJU_PLB']; ?>" readonly>
                                                </div>
                                                <div class="col-md-12" style="font-size: 12px;">
                                                    <br>
                                                    <br>
                                                    <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                        <button type="submit" name="Orginial_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Original -->
                    <!-- NO. DAFTAR -->
                    <div class="col-3" style="font-weight: 900;">
                        NO. DAFTAR
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <?php if ($resultdataHeader['TANGGAL_DAFTAR_GB'] != NULL) { ?>
                                <div class="col-sm-6"><?= substr($resultdataHeader['NOMOR_DAFTAR_GB'], 20, 27); ?></div>
                            <?php } else { ?>
                                <div class="col-sm-6">-</div>
                            <?php } ?>
                            <?php if ($resultdataHeader['TANGGAL_DAFTAR_GB'] != NULL) { ?>
                                <?php
                                $dataTGLAJU = $resultdataHeader['TANGGAL_DAFTAR_GB'];
                                $dataTGLAJUY = substr($dataTGLAJU, 0, 4);
                                $dataTGLAJUM = substr($dataTGLAJU, 4, 2);
                                $dataTGLAJUD =  substr($dataTGLAJU, 6, 2);

                                $datTGLAJU = $dataTGLAJUY . '-' . $dataTGLAJUM . '-' . $dataTGLAJUD;
                                ?>
                                <div class="col-sm-6"><?= date_indo($datTGLAJU); ?></div>
                            <?php } else { ?>
                                <div class="col-sm-6">-</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="invoice-content" style="font-size: 12px;">
            <div class="table-responsive">
                <table id="TableData" class="table table-striped table-bordered first" style="width:100%">
                    <thead>
                        <tr>
                            <th rowspan="2" width="1%">NO.</th>
                            <th rowspan="2" style="text-align:center">DESCRIPTION</th>
                            <th rowspan="2" colspan="4" style="text-align:center">QUANTITY</th>
                            <th colspan="4" style="text-align:center">REMARKS</th>
                        </tr>
                        <tr>
                            <th style="text-align:center">Pack(s)</th>
                            <th style="text-align:center">Can(s)</th>
                            <th style="text-align:center">Bottle</th>
                            <th style="text-align:center">Litre(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dataTable = $dbcon->query("SELECT *,
                                                    SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU,
                                                    -- PLB
                                                    plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                                                    plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                                                    plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                                                    plb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_PLB,
                                                    plb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_PLB,
                                                    plb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                                                    -- TPB
                                                    tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                                                    tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                    tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                    tpb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_GB,
                                                    tpb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_GB,
                                                    tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                                                    ngr.URAIAN_NEGARA
                                                    FROM rcd_status AS rcd
                                                    LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                                                    LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                                    LEFT OUTER JOIN plb_barang AS brg ON plb.NOMOR_AJU=brg.NOMOR_AJU
                                                    LEFT OUTER JOIN referensi_negara AS ngr ON tpb.KODE_NEGARA_PEMASOK=ngr.KODE_NEGARA
                                                    WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "'
                                                    GROUP BY brg.KODE_BARANG
                                                    ORDER BY brg.ID,brg.SERI_BARANG ASC");
                        if ($dataTable) : $no = 1;
                            foreach ($dataTable as $row) :
                        ?>
                                <tr>
                                    <td><?= $no ?>.</td>
                                    <td><?= $row['URAIAN']; ?></td>
                                    <td style="text-align: center;"><?= $row['BOTOL']; ?></td>
                                    <td style="text-align: center;">x</td>
                                    <td style="text-align: center;"><?= $row['LITER']; ?></td>
                                    <td style="text-align: right;"><?= $row['TOTAL_CT_AKHIR']; ?> Ctn(s)</td>
                                    <td style="text-align: center;">-</td>
                                    <td style="text-align: center;">-</td>
                                    <td style="text-align: right;"><?= $row['TOTAL_BOTOL_AKHIR']; ?> Btl(s)</td>
                                    <td style="text-align: right;"><?= $row['TOTAL_LITER_AKHIR']; ?> Ltr(s)</td>
                                </tr>
                            <?php
                                $no++;
                            endforeach
                            ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="10">
                                    <center>
                                        <div style="display: grid;">
                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                    <tfoot>
                        <?php
                        $dataFooter = $dbcon->query("SELECT *,
                                                    SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU,
                                                    -- PLB
                                                    plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                                                    plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                                                    plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                                                    plb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_PLB,
                                                    plb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_PLB,
                                                    plb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                                                    -- TPB
                                                    tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                                                    tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                    tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                    tpb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_GB,
                                                    tpb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_GB,
                                                    tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                                                    ngr.URAIAN_NEGARA,
                                                    (SELECT SUM(BOTOL) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_botol,
                                                    (SELECT SUM(LITER) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_liter,
                                                    (SELECT SUM(TOTAL_CT_AKHIR) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_ct,
                                                    (SELECT SUM(CIF) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_cif,
                                                    (SELECT SUM(TOTAL_BOTOL_AKHIR) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_botol_akhir,
                                                    (SELECT SUM(TOTAL_LITER_AKHIR) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_liter_akhir
                                                    FROM rcd_status AS rcd
                                                    LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                                                    LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                                    LEFT OUTER JOIN plb_barang AS brg ON plb.NOMOR_AJU=brg.NOMOR_AJU
                                                    LEFT OUTER JOIN referensi_negara AS ngr ON tpb.KODE_NEGARA_PEMASOK=ngr.KODE_NEGARA
                                                    WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "'
                                                    GROUP BY brg.KODE_BARANG
                                                    ORDER BY brg.ID,brg.SERI_BARANG ASC");
                        $resultFooter = mysqli_fetch_array($dataFooter);
                        ?>
                        <tr>
                            <th colspan="2" style="text-align:center">TOTAL</th>
                            <th style="text-align:center"><?= $resultFooter['c_botol']; ?></th>
                            <th style="text-align:center">x</th>
                            <th style="text-align:center"><?= round($resultFooter['c_liter']); ?></th>
                            <th style="text-align:right"><?= $resultFooter['c_ct']; ?> Ctn(s)</th>
                            <th colspan="2" style="text-align:left"></th>
                            <th style="text-align:right"><?= $resultFooter['c_botol_akhir']; ?> Btl(s)</th>
                            <th style="text-align:right"><?= round($resultFooter['c_liter_akhir']); ?> Ltr(s)</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="invoice-footer">
            <p class="text-center m-b-5 f-w-600">
                Packing List | IT Inventory <?= $resultHeadSetting['company'] ?>
            </p>
            <p class="text-center">
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>
                    <?= $resultHeadSetting['website'] ?></span>
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i>
                    T:<?= $resultHeadSetting['telp'] ?></span>
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>
                    <?= $resultHeadSetting['email'] ?></span>
            </p>
        </div>
    </div>
</div>
<?php include "include/pusat_bantuan.php"; ?>
<?php include "include/riwayat_aktifitas.php"; ?>
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
<?php include "include/jsForm.php"; ?>
<script src="assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#TableData').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5', 'pdfHtml5'
            ],
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }],
            iDisplayLength: -1
        });
    });

    // NUMBER 001/GB-BGR/XI/2022
    $("#input-Number").mask("999/**-***/**/<?= date('Y') ?>");
    // NO BL STA/SINJKT11010
    $("#input-NoBL").mask("***/******99999");
    // $("#masked-input-date").mask("99/99/9999");
</script>