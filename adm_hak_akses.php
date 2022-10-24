<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
?>
<?php
// CREATE HAK AKSES
if (isset($_POST["add_hak_akses"])) {

    $CekRole = $_POST['NameRole'];
    $DataCekRole = $dbcon->query("SELECT role FROM tbl_role WHERE role='$CekRole'");
    $HasilCekRoleOne = mysqli_fetch_array($DataCekRole);

    if ($HasilCekRoleOne['role'] == NULL) {
        $NameRole           = $_POST['NameRole'];
        $NameDescription    = $_POST['NameDescription'];

        // Modules Show/None
        // Dahboard
        if ($_POST['NameDashUsers'] != 'Y') {
            $NameDashUsers = 'none';
        } else {
            $NameDashUsers = 'show';
        }
        if ($_POST['NameDashReferensi'] != 'Y') {
            $NameDashReferensi = 'none';
        } else {
            $NameDashReferensi = 'show';
        }
        // BC
        if ($_POST['NameBC23MasterData'] != 'Y') {
            $NameBC23MasterData = 'none';
        } else {
            $NameBC23MasterData = 'show';
        }
        // DATA
        if ($_POST['NameCountTabelTPB'] != 'Y') {
            $NameCountTabelTPB = 'none';
        } else {
            $NameCountTabelTPB = 'show';
        }

        if ($_POST['NameFilterTableTPB'] != 'Y') {
            $NameFilterTableTPB = 'none';
        } else {
            $NameFilterTableTPB = 'show';
        }
        // REFERENSI
        if ($_POST['NameDaftarBarang'] != 'Y') {
            $NameDaftarBarang = 'none';
        } else {
            $NameDaftarBarang = 'show';
        }

        if ($_POST['NameTarifHS'] != 'Y') {
            $NameTarifHS = 'none';
        } else {
            $NameTarifHS = 'show';
        }

        if ($_POST['NamePemasok'] != 'Y') {
            $NamePemasok = 'none';
        } else {
            $NamePemasok = 'show';
        }

        if ($_POST['NamePerusahaan'] != 'Y') {
            $NamePerusahaan = 'none';
        } else {
            $NamePerusahaan = 'show';
        }

        if ($_POST['NameAlatAngkut'] != 'Y') {
            $NameAlatAngkut = 'none';
        } else {
            $NameAlatAngkut = 'show';
        }

        if ($_POST['NameTempatPenimbunan'] != 'Y') {
            $NameTempatPenimbunan = 'none';
        } else {
            $NameTempatPenimbunan = 'show';
        }

        if ($_POST['NameKantorBeaCukai'] != 'Y') {
            $NameKantorBeaCukai = 'none';
        } else {
            $NameKantorBeaCukai = 'show';
        }

        if ($_POST['NameNegara'] != 'Y') {
            $NameNegara = 'none';
        } else {
            $NameNegara = 'show';
        }

        if ($_POST['NamePelabuhanDalamNegeri'] != 'Y') {
            $NamePelabuhanDalamNegeri = 'none';
        } else {
            $NamePelabuhanDalamNegeri = 'show';
        }

        if ($_POST['NamePelabuhanLuarNegeri'] != 'Y') {
            $NamePelabuhanLuarNegeri = 'none';
        } else {
            $NamePelabuhanLuarNegeri = 'show';
        }

        if ($_POST['NameMataUang'] != 'Y') {
            $NameMataUang = 'none';
        } else {
            $NameMataUang = 'show';
        }

        if ($_POST['NameSatuan'] != 'Y') {
            $NameSatuan = 'none';
        } else {
            $NameSatuan = 'show';
        }

        if ($_POST['NameKemasan'] != 'Y') {
            $NameKemasan = 'none';
        } else {
            $NameKemasan = 'show';
        }
        // ADMINISTRATOR
        if ($_POST['NameDepartemen'] != 'Y') {
            $NameDepartemen = 'none';
        } else {
            $NameDepartemen = 'show';
        }

        if ($_POST['NameHakAkses'] != 'Y') {
            $NameHakAkses = 'none';
        } else {
            $NameHakAkses = 'show';
        }

        if ($_POST['NameJabatan'] != 'Y') {
            $NameJabatan = 'none';
        } else {
            $NameJabatan = 'show';
        }

        if ($_POST['NameKuotaMitra'] != 'Y') {
            $NameKuotaMitra = 'none';
        } else {
            $NameKuotaMitra = 'show';
        }

        if ($_POST['NamePengaturanAppTPB'] != 'Y') {
            $NamePengaturanAppTPB = 'none';
        } else {
            $NamePengaturanAppTPB = 'show';
        }

        if ($_POST['NamePengaturanRealTimeReload'] != 'Y') {
            $NamePengaturanRealTimeReload = 'none';
        } else {
            $NamePengaturanRealTimeReload = 'show';
        }

        if ($_POST['NamePengaturanInformasi'] != 'Y') {
            $NamePengaturanInformasi = 'none';
        } else {
            $NamePengaturanInformasi = 'show';
        }

        if ($_POST['NameUserManajemenWeb'] != 'Y') {
            $NameUserManajemenWeb = 'none';
        } else {
            $NameUserManajemenWeb = 'show';
        }
        // LAPORAN
        if ($_POST['NameLapMasukBarang'] != 'Y') {
            $NameLapMasukBarang = 'none';
        } else {
            $NameLapMasukBarang = 'show';
        }

        if ($_POST['NameLapKeluarBarang'] != 'Y') {
            $NameLapKeluarBarang = 'none';
        } else {
            $NameLapKeluarBarang = 'show';
        }

        if ($_POST['NameLapMutasiBarang'] != 'Y') {
            $NameLapMutasiBarang = 'none';
        } else {
            $NameLapMutasiBarang = 'show';
        }

        if ($_POST['NameLapPosisiBarang'] != 'Y') {
            $NameLapPosisiBarang = 'none';
        } else {
            $NameLapPosisiBarang = 'show';
        }

        if ($_POST['NameLapRealisasi'] != 'Y') {
            $NameLapRealisasi = 'none';
        } else {
            $NameLapRealisasi = 'show';
        }

        if ($_POST['NameLapDataTPB'] != 'Y') {
            $NameLapDataTPB = 'none';
        } else {
            $NameLapDataTPB = 'show';
        }

        if ($_POST['NamePLBReportCK5'] != 'Y') {
            $NamePLBReportCK5 = 'none';
        } else {
            $NamePLBReportCK5 = 'show';
        }

        if ($_POST['NameGBSarinahReportCK5'] != 'Y') {
            $NameGBSarinahReportCK5 = 'none';
        } else {
            $NameGBSarinahReportCK5 = 'show';
        }

        if ($_POST['NameLapLogSystem'] != 'Y') {
            $NameLapLogSystem = 'none';
        } else {
            $NameLapLogSystem = 'show';
        }

        $query = $dbcon->query("INSERT INTO tbl_role
         (id,role,description,v_bc,v_cttpb,v_filterttpb,v_daftar_barang,v_tarif_hs,v_pemasok,v_perusahaan,v_alat_angkut,v_tempat_penimbunan,v_kantor_bea_cukai,v_negara,v_pelabuhan_dn,v_pelabuhan_ln,v_mata_uang,v_satuan,v_kemasan,v_departemen,v_hak_akses,v_jabatan,v_kuota_mitra,v_pengaturan_tbb,v_pengaturan_realtime,v_pengaturan_informasi,v_user_manajemen,re_masuk_barang,re_keluar_barang,re_mutasi_barang,re_posisi_barang,re_realisasi,re_data_tpb,re_ck_plb,re_ck_sarinah,re_log,da_one,da_two)
         VALUES
         ('','$NameRole','$NameDescription','$NameBC23MasterData','$NameCountTabelTPB','$NameFilterTableTPB','$NameDaftarBarang','$NameTarifHS','$NamePemasok','$NamePerusahaan','$NameAlatAngkut','$NameTempatPenimbunan','$NameKantorBeaCukai','$NameNegara','$NamePelabuhanDalamNegeri','$NamePelabuhanLuarNegeri','$NameMataUang','$NameSatuan','$NameKemasan','$NameDepartemen','$NameHakAkses','$NameJabatan','$NameKuotaMitra','$NamePengaturanAppTPB','$NamePengaturanRealTimeReload','$NamePengaturanInformasi','$NameUserManajemenWeb','$NameLapMasukBarang','$NameLapKeluarBarang','$NameLapMutasiBarang','$NameLapPosisiBarang','$NameLapRealisasi','$NameLapDataTPB','$NamePLBReportCK5','$NameGBSarinahReportCK5','$NameLapLogSystem','$NameDashUsers','$NameDashReferensi')");

        // FOR AKTIFITAS
        $me = $_SESSION['username'];
        $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Administrator Tools/Hak Akses';
        $InputDescription     = $me . " Insert Data: " .  $NameRole . ", Simpan Data Sebagai Log Hak Akses";
        $InputAction          = 'Insert';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
         (id,IDUNIQ,username,modul,description,action,date_created)
         VALUES
         ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

        if ($query) {
            echo "<script>window.location.href='adm_hak_akses.php?InputSuccess=true';</script>";
        } else {
            echo "<script>window.location.href='adm_hak_akses.php?InputFailed=true';</script>";
        }
    } else {
        echo "<script>window.location.href='adm_hak_akses.php?DataAlready=true';</script>";
    }
}
// END CREATE HAK AKSES
// UPDATE HAK AKSES
if (isset($_POST["NUpdateData"])) {

    $IDUNIQ                   = $_POST['IDUNIQ'];
    $UpdateRole               = $_POST['UpdateRole'];
    $UpdateNameDescription    = $_POST['UpdateNameDescription'];

    // Modules Show/None
    // Dashboard
    if ($_POST['UpdateDashUsers'] != 'Y') {
        $UpdateDashUsers = 'none';
    } else {
        $UpdateDashUsers = 'show';
    }
    if ($_POST['UpdateDashReferensi'] != 'Y') {
        $UpdateDashReferensi = 'none';
    } else {
        $UpdateDashReferensi = 'show';
    }
    // BC
    if ($_POST['UpdateBC23MasterData'] != 'Y') {
        $UpdateBC23MasterData = 'none';
    } else {
        $UpdateBC23MasterData = 'show';
    }
    // DATA
    if ($_POST['UpdateCountTabelTPB'] != 'Y') {
        $UpdateCountTabelTPB = 'none';
    } else {
        $UpdateCountTabelTPB = 'show';
    }

    if ($_POST['UpdateFilterTableTPB'] != 'Y') {
        $UpdateFilterTableTPB = 'none';
    } else {
        $UpdateFilterTableTPB = 'show';
    }
    // REFERENSI
    if ($_POST['UpdateDaftarBarang'] != 'Y') {
        $UpdateDaftarBarang = 'none';
    } else {
        $UpdateDaftarBarang = 'show';
    }

    if ($_POST['UpdateTarifHS'] != 'Y') {
        $UpdateTarifHS = 'none';
    } else {
        $UpdateTarifHS = 'show';
    }

    if ($_POST['UpdatePemasok'] != 'Y') {
        $UpdatePemasok = 'none';
    } else {
        $UpdatePemasok = 'show';
    }

    if ($_POST['UpdatePerusahaan'] != 'Y') {
        $UpdatePerusahaan = 'none';
    } else {
        $UpdatePerusahaan = 'show';
    }

    if ($_POST['UpdateAlatAngkut'] != 'Y') {
        $UpdateAlatAngkut = 'none';
    } else {
        $UpdateAlatAngkut = 'show';
    }

    if ($_POST['UpdateTempatPenimbunan'] != 'Y') {
        $UpdateTempatPenimbunan = 'none';
    } else {
        $UpdateTempatPenimbunan = 'show';
    }

    if ($_POST['UpdateKantorBeaCukai'] != 'Y') {
        $UpdateKantorBeaCukai = 'none';
    } else {
        $UpdateKantorBeaCukai = 'show';
    }

    if ($_POST['UpdateNegara'] != 'Y') {
        $UpdateNegara = 'none';
    } else {
        $UpdateNegara = 'show';
    }

    if ($_POST['UpdatePelabuhanDalamNegeri'] != 'Y') {
        $UpdatePelabuhanDalamNegeri = 'none';
    } else {
        $UpdatePelabuhanDalamNegeri = 'show';
    }

    if ($_POST['UpdatePelabuhanLuarNegeri'] != 'Y') {
        $UpdatePelabuhanLuarNegeri = 'none';
    } else {
        $UpdatePelabuhanLuarNegeri = 'show';
    }

    if ($_POST['UpdateMataUang'] != 'Y') {
        $UpdateMataUang = 'none';
    } else {
        $UpdateMataUang = 'show';
    }

    if ($_POST['UpdateSatuan'] != 'Y') {
        $UpdateSatuan = 'none';
    } else {
        $UpdateSatuan = 'show';
    }

    if ($_POST['UpdateKemasan'] != 'Y') {
        $UpdateKemasan = 'none';
    } else {
        $UpdateKemasan = 'show';
    }
    // ADMINISTRATOR
    if ($_POST['UpdateDepartemen'] != 'Y') {
        $UpdateDepartemen = 'none';
    } else {
        $UpdateDepartemen = 'show';
    }

    if ($_POST['UpdateHakAkses'] != 'Y') {
        $UpdateHakAkses = 'none';
    } else {
        $UpdateHakAkses = 'show';
    }

    if ($_POST['UpdateJabatan'] != 'Y') {
        $UpdateJabatan = 'none';
    } else {
        $UpdateJabatan = 'show';
    }

    if ($_POST['UpdateKuotaMitra'] != 'Y') {
        $UpdateKuotaMitra = 'none';
    } else {
        $UpdateKuotaMitra = 'show';
    }

    if ($_POST['UpdatePengaturanAppTPB'] != 'Y') {
        $UpdatePengaturanAppTPB = 'none';
    } else {
        $UpdatePengaturanAppTPB = 'show';
    }

    if ($_POST['UpdatePengaturanRealTimeReload'] != 'Y') {
        $UpdatePengaturanRealTimeReload = 'none';
    } else {
        $UpdatePengaturanRealTimeReload = 'show';
    }

    if ($_POST['UpdatePengaturanInformasi'] != 'Y') {
        $UpdatePengaturanInformasi = 'none';
    } else {
        $UpdatePengaturanInformasi = 'show';
    }

    if ($_POST['UpdateUserManajemenWeb'] != 'Y') {
        $UpdateUserManajemenWeb = 'none';
    } else {
        $UpdateUserManajemenWeb = 'show';
    }
    // LAPORAN
    if ($_POST['UpdateLapMasukBarang'] != 'Y') {
        $UpdateLapMasukBarang = 'none';
    } else {
        $UpdateLapMasukBarang = 'show';
    }

    if ($_POST['UpdateLapKeluarBarang'] != 'Y') {
        $UpdateLapKeluarBarang = 'none';
    } else {
        $UpdateLapKeluarBarang = 'show';
    }

    if ($_POST['UpdateLapMutasiBarang'] != 'Y') {
        $UpdateLapMutasiBarang = 'none';
    } else {
        $UpdateLapMutasiBarang = 'show';
    }

    if ($_POST['UpdateLapPosisiBarang'] != 'Y') {
        $UpdateLapPosisiBarang = 'none';
    } else {
        $UpdateLapPosisiBarang = 'show';
    }

    if ($_POST['UpdateLapRealisasi'] != 'Y') {
        $UpdateLapRealisasi = 'none';
    } else {
        $UpdateLapRealisasi = 'show';
    }

    if ($_POST['UpdateLapDataTPB'] != 'Y') {
        $UpdateLapDataTPB = 'none';
    } else {
        $UpdateLapDataTPB = 'show';
    }

    if ($_POST['UpdatePLBReportCK5'] != 'Y') {
        $UpdatePLBReportCK5 = 'none';
    } else {
        $UpdatePLBReportCK5 = 'show';
    }

    if ($_POST['UpdateGBSarinahReportCK5'] != 'Y') {
        $UpdateGBSarinahReportCK5 = 'none';
    } else {
        $UpdateGBSarinahReportCK5 = 'show';
    }

    if ($_POST['UpdateLapLogSystem'] != 'Y') {
        $UpdateLapLogSystem = 'none';
    } else {
        $UpdateLapLogSystem = 'show';
    }

    $query = $dbcon->query("UPDATE tbl_role SET role='$UpdateRole',
                                                description='$UpdateNameDescription',
                                                v_bc='$UpdateBC23MasterData',
                                                v_cttpb='$UpdateCountTabelTPB',
                                                v_filterttpb='$UpdateFilterTableTPB',
                                                v_daftar_barang='$UpdateDaftarBarang',
                                                v_tarif_hs='$UpdateTarifHS',
                                                v_pemasok='$UpdatePemasok',
                                                v_perusahaan='$UpdatePerusahaan',
                                                v_alat_angkut='$UpdateAlatAngkut',
                                                v_tempat_penimbunan='$UpdateTempatPenimbunan',
                                                v_kantor_bea_cukai='$UpdateKantorBeaCukai',
                                                v_negara='$UpdateNegara',
                                                v_pelabuhan_dn='$UpdatePelabuhanDalamNegeri',
                                                v_pelabuhan_ln='$UpdatePelabuhanLuarNegeri',
                                                v_mata_uang='$UpdateMataUang',
                                                v_satuan='$UpdateSatuan',
                                                v_kemasan='$UpdateKemasan',
                                                v_departemen='$UpdateDepartemen',
                                                v_hak_akses='$UpdateHakAkses',
                                                v_jabatan='$UpdateJabatan',
                                                v_kuota_mitra='$UpdateKuotaMitra',
                                                v_pengaturan_tbb='$UpdatePengaturanAppTPB',
                                                v_pengaturan_realtime='$UpdatePengaturanRealTimeReload',
                                                v_pengaturan_informasi='$UpdatePengaturanInformasi',
                                                v_user_manajemen='$UpdateUserManajemenWeb',
                                                re_masuk_barang='$UpdateLapMasukBarang',
                                                re_keluar_barang='$UpdateLapKeluarBarang',
                                                re_mutasi_barang='$UpdateLapMutasiBarang',
                                                re_posisi_barang='$UpdateLapPosisiBarang',
                                                re_realisasi='$UpdateLapRealisasi',
                                                re_data_tpb='$UpdateLapDataTPB',
                                                re_ck_plb='$UpdatePLBReportCK5',
                                                re_ck_sarinah='$UpdateGBSarinahReportCK5',
                                                re_log='$UpdateLapLogSystem',
                                                da_one='$UpdateDashUsers',
                                                da_two='$UpdateDashReferensi'
                                                WHERE id='$IDUNIQ'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Hal Akses';
    $InputDescription     = $me . " Update Data: " .  $UpdateRole . ", Simpan Data Sebagai Log Hal Akses";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
     (id,IDUNIQ,username,modul,description,action,date_created)
     VALUES
     ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_hak_akses.php?UpdateSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_hak_akses.php?UpdateFailed=true';</script>";
    }
}
// END UPDATE HAK AKSES

// DELETE HAK AKSES
if (isset($_POST["NDeleteData"])) {

    $IDUNIQ             = $_POST['IDUNIQ'];
    $NameRole           = $_POST['NameRole'];

    $CheckBefore = $dbcon->query("SELECT COUNT(*) AS check_role FROM tbl_pegawai WHERE role='$NameRole'");
    $resultCheckBefore = mysqli_fetch_array($CheckBefore);

    // var_dump($resultCheckBefore['check_role']);exit;
    if ($resultCheckBefore['check_role'] == 0) {
        // FOR AKTIFITAS
        $me = $_SESSION['username'];
        $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Administrator Tools/Hak Akses';
        $InputDescription     = $me . " Hapus Data: " .  $NameRole . ", Simpan Data Sebagai Log Hak Akses";
        $InputAction          = 'Hapus';
        $InputDate            = date('Y-m-d h:m:i');

        $query = $dbcon->query("INSERT INTO tbl_aktifitas
         (id,IDUNIQ,username,modul,description,action,date_created)
         VALUES
         ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

        $query .= $dbcon->query("DELETE FROM tbl_role WHERE id='$IDUNIQ'");

        if ($query) {
            echo "<script>window.location.href='adm_hak_akses.php?DeleteSuccess=true';</script>";
        } else {
            echo "<script>window.location.href='adm_hak_akses.php?DeleteFailed=true';</script>";
        }
    } else {
        echo "<script>window.location.href='adm_hak_akses.php?InUse=true';</script>";
    }
}
// END DELETE HAK AKSES
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
                <li class="breadcrumb-item active">Hak Akses</li>
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
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Administrator Tools] Hak Akses</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body">
                    <!-- css-button -->
                    <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                        <div class="css-button">
                            <?php include "modal/m_role.php"; ?>
                        </div>
                    <?php } ?>
                    <!-- end css-button -->
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th style="text-align: center;">Hak Akses</th>
                                    <th class="text-nowrap" style="text-align: center;">Deskripsi</th>
                                    <th class="text-nowrap" style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT * FROM tbl_role ORDER BY role ASC");
                                if (mysqli_num_rows($dataTable) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($dataTable)) {
                                        $no++;
                                ?>
                                        <tr class="odd gradeX">
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center;"><?= $row['role'] ?></td>
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
                                                            <h4 class="modal-title">[Update Data] Hak Akses - <?= $row['id'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="IdHakAkses">Hak Akses</label>
                                                                            <input type="text" class="form-control" name="UpdateRole" id="IdUpdateHakAkses" placeholder="Hak Akses ..." value="<?= $row['role'] ?>" />
                                                                            <input type="hidden" name="IDUNIQ" value="<?= $row['id'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="IdDescription">Deskripsi </label>
                                                                            <textarea type="text" class="form-control" name="UpdateNameDescription" id="IdUpdateDescription" placeholder="Deskripsi ..."><?= $row['description'] ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Dashboard - Summary -->
                                                                    <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                                                        <label for="IDDahboardSummary">Dashboard - Summary</label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['da_one'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdateDashUsers" value="Y" id="IDUpdateDashUsers<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdateDashUsers<?= $row['id']; ?>">Laporan Masuk Barang</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['da_two'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdateDashReferensi" value="Y" id="IDUpdateDashReferensi<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdateDashReferensi<?= $row['id']; ?>">Laporan Keluar Barang</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Dashboard - Summary -->
                                                                    <!-- View Data Online -->
                                                                    <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                                                        <label for="IDViewDataOnline">View Data Online</label>
                                                                    </div>
                                                                    <div class="col-xl-3">
                                                                        <div class="form-group">
                                                                            <label style="font-weight: 800;">DOKUMEN PABEAN</label>
                                                                            <div class="form-group">
                                                                                <label style="font-weight: 500;">1. BC</label>
                                                                                <input type="hidden" name="NameBC">
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_bc'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateBC23MasterData" value="Y" id="IDUpdateBC23MasterData<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateBC23MasterData<?= $row['id']; ?>">BC 2.7 / Master Data</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3">
                                                                        <div class="form-group">
                                                                            <label style="font-weight: 800;">DATA</label>
                                                                            <div class="form-group">
                                                                                <label style="color: transparent;">DATA</label>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_cttpb'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateCountTabelTPB" value="Y" id="IDUpdateCountTabelTPB<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateCountTabelTPB<?= $row['id']; ?>">Count Tabel TPB</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_filterttpb'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateFilterTableTPB" value="Y" id="IDUpdateFilterTableTPB<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateFilterTableTPB<?= $row['id']; ?>">Filter Tabel TPB</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3">
                                                                        <div class="form-group">
                                                                            <label style="font-weight: 800;">REFERENSI</label>
                                                                            <div class="form-group">
                                                                                <label style="font-weight: 500;">1. Referensi</label>
                                                                                <input type="hidden" name="UpdateReferensi">
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_daftar_barang'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateDaftarBarang" value="Y" id="IDUpdateDaftarBarang<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateDaftarBarang<?= $row['id']; ?>">Daftar Barang</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_tarif_hs'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateTarifHS" value="Y" id="IDUpdateTarifHS<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateTarifHS<?= $row['id']; ?>">Tarif HS</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_pemasok'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdatePemasok" value="Y" id="IDUpdatePemasok<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdatePemasok<?= $row['id']; ?>">Pemasok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_perusahaan'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdatePerusahaan" value="Y" id="IDUpdatePerusahaan<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdatePerusahaan<?= $row['id']; ?>">Perusahaan</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_alat_angkut'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateAlatAngkut" value="Y" id="IDUpdateAlatAngkut<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateAlatAngkut<?= $row['id']; ?>">Alat Angkut</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_tempat_penimbunan'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateTempatPenimbunan" value="Y" id="IDUpdateTempatPenimbunan<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateTempatPenimbunan<?= $row['id']; ?>">Tempat Penimbunan</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_kantor_bea_cukai'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateKantorBeaCukai" value="Y" id="IDUpdateKantorBeaCukai<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateKantorBeaCukai<?= $row['id']; ?>">Kantor Bea Cukai</label>
                                                                                    </div>
                                                                                </div>
                                                                                <label style="font-weight: 500;">1.1 Edifact</label>
                                                                                <input type="hidden" name="Edifact">
                                                                                <div style="margin-left: 15px;">
                                                                                    <div class="form-group">
                                                                                        <div class="form-check form-check-inline">
                                                                                            <?php if ($row['v_negara'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                            <input type="checkbox" name="UpdateNegara" value="Y" id="IDUpdateNegara<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                            <label class="form-check-label" for="IDUpdateNegara<?= $row['id']; ?>">Negara</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="form-check form-check-inline">
                                                                                            <?php if ($row['v_pelabuhan_dn'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                            <input type="checkbox" name="UpdatePelabuhanDalamNegeri" value="Y" id="IDUpdatePelabuhanDalamNegeri<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                            <label class="form-check-label" for="IDUpdatePelabuhanDalamNegeri<?= $row['id']; ?>">Pelabuhan Dalam Negeri</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="form-check form-check-inline">
                                                                                            <?php if ($row['v_pelabuhan_ln'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                            <input type="checkbox" name="UpdatePelabuhanLuarNegeri" value="Y" id="IDUpdatePelabuhanLuarNegeri<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                            <label class="form-check-label" for="IDUpdatePelabuhanLuarNegeri<?= $row['id']; ?>">Pelabuhan Luar Negeri</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="form-check form-check-inline">
                                                                                            <?php if ($row['v_mata_uang'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                            <input type="checkbox" name="UpdateMataUang" value="Y" id="IDUpdateMataUang<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                            <label class="form-check-label" for="IDUpdateMataUang<?= $row['id']; ?>">Mata Uang</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="form-check form-check-inline">
                                                                                            <?php if ($row['v_satuan'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                            <input type="checkbox" name="UpdateSatuan" value="Y" id="IDUpdateSatuan<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                            <label class="form-check-label" for="IDUpdateSatuan<?= $row['id']; ?>">Satuan</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="form-check form-check-inline">
                                                                                            <?php if ($row['v_kemasan'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                            <input type="checkbox" name="UpdateKemasan" value="Y" id="IDUpdateKemasan<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                            <label class="form-check-label" for="IDUpdateKemasan<?= $row['id']; ?>">Kemasan</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3">
                                                                        <div class="form-group">
                                                                            <label style="font-weight: 800;">ADMINISTRATOR</label>
                                                                            <div class="form-group">
                                                                                <label style="color: transparent;">ADMINISTRATOR</label>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_departemen'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateDepartemen" value="Y" id="IDUpdateDepartemen<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateDepartemen<?= $row['id']; ?>">Departemen</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_hak_akses'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateHakAkses" value="Y" id="IDUpdateHakAkses<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateHakAkses<?= $row['id']; ?>">Hak Akses</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_jabatan'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateJabatan" value="Y" id="IDUpdateJabatan<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateJabatan<?= $row['id']; ?>">Jabatan</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_kuota_mitra'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateKuotaMitra" value="Y" id="IDUpdateKuotaMitra<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateKuotaMitra<?= $row['id']; ?>">Kuota Mitra</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_pengaturan_tbb'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdatePengaturanAppTPB" value="Y" id="IDUpdatePengaturanAppTPB<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdatePengaturanAppTPB<?= $row['id']; ?>">Pengaturan App TPB</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_pengaturan_realtime'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdatePengaturanRealTimeReload" value="Y" id="IDUpdatePengaturanRealTimeReload<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdatePengaturanRealTimeReload<?= $row['id']; ?>">Pengaturan RealTime Reload</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_pengaturan_informasi'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdatePengaturanInformasi" value="Y" id="IDUpdatePengaturanInformasi<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdatePengaturanInformasi<?= $row['id']; ?>">Pengaturan Informasi</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <?php if ($row['v_user_manajemen'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                        <input type="checkbox" name="UpdateUserManajemenWeb" value="Y" id="IDUpdateUserManajemenWeb<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                        <label class="form-check-label" for="IDUpdateUserManajemenWeb<?= $row['id']; ?>">User Manajemen Web</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End View Data Online -->
                                                                    <!-- Report -->
                                                                    <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                                                        <label for="IDReport">Report</label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['re_masuk_barang'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdateLapMasukBarang" value="Y" id="IDUpdateLapMasukBarang<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdateLapMasukBarang<?= $row['id']; ?>">Laporan Masuk Barang</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['re_keluar_barang'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdateLapKeluarBarang" value="Y" id="IDUpdateLapKeluarBarang<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdateLapKeluarBarang<?= $row['id']; ?>">Laporan Keluar Barang</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['re_mutasi_barang'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdateLapMutasiBarang" value="Y" id="IDUpdateLapMutasiBarang<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdateLapMutasiBarang<?= $row['id']; ?>">Laporan Mutasi Barang</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['re_posisi_barang'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdateLapPosisiBarang" value="Y" id="IDUpdateLapPosisiBarang<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdateLapPosisiBarang<?= $row['id']; ?>">Laporan Posisi Barang</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['re_realisasi'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdateLapRealisasi" value="Y" id="IDUpdateLapRealisasi<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdateLapRealisasi<?= $row['id']; ?>">Laporan Realisasi</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['re_data_tpb'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdateLapDataTPB" value="Y" id="IDUpdateLapDataTPB<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdateLapDataTPB<?= $row['id']; ?>">Laporan Data TPB</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['re_ck_plb'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdatePLBReportCK5" value="Y" id="IDUpdatePLBReportCK5<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdatePLBReportCK5<?= $row['id']; ?>">PLB Report CK5</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['re_ck_sarinah'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdateGBSarinahReportCK5" value="Y" id="IDUpdateGBSarinahReportCK5<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdateGBSarinahReportCK5<?= $row['id']; ?>">GB - Sarinah Report CK5</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <div class="form-check form-check-inline">
                                                                                <?php if ($row['re_log'] == 'show') { ?> <?php $roleCheck = 'checked'; ?> <?php } else { ?> <?php $roleCheck = ''; ?> <?php } ?>
                                                                                <input type="checkbox" name="UpdateLapLogSystem" value="Y" id="IDUpdateLapLogSystem<?= $row['id']; ?>" class="form-check-input" <?= $roleCheck; ?> />
                                                                                <label class="form-check-label" for="IDUpdateLapLogSystem<?= $row['id']; ?>">Laporan Log System</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Report -->
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
                                                            <h4 class="modal-title">[Hapus Data] Hak Akses - <?= $row['id'] ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger m-b-0">
                                                                <h5><i class="fa fa-info-circle"></i> Anda yakin akan menghapus data ini?</h5>
                                                                <p>Anda tidak akan melihat data ini lagi, data akan di hapus secara permanen pada sistem informasi TPB!<br><i>"Silahkan klik <b>Ya</b> untuk melanjutkan proses penghapusan data."</i></p>
                                                                <input type="hidden" name="NameRole" value="<?= $row['role'] ?>">
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
        history.replaceState({}, '', './adm_hak_akses.php');
    }

    // INSERT SUCCESS
    if (window?.location?.href?.indexOf('InputSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_hak_akses.php');
    }
    // INSERT FAILED
    if (window?.location?.href?.indexOf('InputFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_hak_akses.php');
    }

    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil diupdate!',
            icon: 'success',
            text: 'Data berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_hak_akses.php');
    }
    // UPDATE FAILED
    if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
        Swal.fire({
            title: 'Data gagal diupdate!',
            icon: 'error',
            text: 'Data gagal diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_hak_akses.php');
    }

    // DELETE SUCCESS
    if (window?.location?.href?.indexOf('DeleteSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil dihapus!',
            icon: 'success',
            text: 'Data berhasil dihapus didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_hak_akses.php');
    }
    // DELETE FAILED
    if (window?.location?.href?.indexOf('DeleteFailed') > -1) {
        Swal.fire({
            title: 'Data gagal dihapus!',
            icon: 'error',
            text: 'Data gagal dihapus didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_hak_akses.php');
    }
    // HAK AKSES MASIH DIGUNAKAN
    if (window?.location?.href?.indexOf('InUse') > -1) {
        Swal.fire({
            title: 'Hak Akses masih digunakan!',
            icon: 'error',
            text: 'Data gagal dihapus didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_hak_akses.php');
    }

    function seDash() {
        var refalla = document.getElementsByName('NameDashUsers');
        var refallb = document.getElementsByName('NameDashReferensi');

        for (var i = 0; i < refalla.length && refallb.length; i++) {
            if (refalla[i].type == 'checkbox' && refallb[i].type == 'checkbox')
                refalla[i].checked = true;
            refallb[i].checked = true;

        }
    }

    function deDash() {
        var refalla = document.getElementsByName('NameDashUsers');
        var refallb = document.getElementsByName('NameDashReferensi');

        for (var i = 0; i < refalla.length && refallb.length; i++) {
            if (refalla[i].type == 'checkbox' && refallb[i].type == 'checkbox')
                refalla[i].checked = false;
            refallb[i].checked = false;

        }
    }

    function seBC() {
        var refalla = document.getElementsByName('NameBC23MasterData');

        for (var i = 0; i < refalla.length; i++) {
            if (refalla[i].type == 'checkbox')
                refalla[i].checked = true;

        }
    }

    function deBC() {
        var refalla = document.getElementsByName('NameBC23MasterData');

        for (var i = 0; i < refalla.length; i++) {
            if (refalla[i].type == 'checkbox')
                refalla[i].checked = false;

        }
    }

    function seData() {
        var refalla = document.getElementsByName('NameCountTabelTPB');
        var refallb = document.getElementsByName('NameFilterTableTPB');

        for (var i = 0; i < refalla.length && refallb.length; i++) {
            if (refalla[i].type == 'checkbox' && refallb[i].type == 'checkbox')
                refalla[i].checked = true;
            refallb[i].checked = true;

        }
    }

    function deData() {
        var refalla = document.getElementsByName('NameCountTabelTPB');
        var refallb = document.getElementsByName('NameFilterTableTPB');

        for (var i = 0; i < refalla.length && refallb.length; i++) {
            if (refalla[i].type == 'checkbox' && refallb[i].type == 'checkbox')
                refalla[i].checked = false;
            refallb[i].checked = false;

        }
    }

    // Checked All Referensi
    function seRefAll() {
        var refalla = document.getElementsByName('NameDaftarBarang');
        var refallb = document.getElementsByName('NameTarifHS');
        var refallc = document.getElementsByName('NamePemasok');
        var refalld = document.getElementsByName('NamePerusahaan');
        var refalle = document.getElementsByName('NameAlatAngkut');
        var refallf = document.getElementsByName('NameTempatPenimbunan');
        var refallg = document.getElementsByName('NameKantorBeaCukai');
        // Eddifact
        var edialla = document.getElementsByName('NameNegara');
        var ediallb = document.getElementsByName('NamePelabuhanDalamNegeri');
        var ediallc = document.getElementsByName('NamePelabuhanLuarNegeri');
        var edialld = document.getElementsByName('NameMataUang');
        var edialle = document.getElementsByName('NameSatuan');
        var ediallf = document.getElementsByName('NameKemasan');

        for (var i = 0; i < refalla.length && refallb.length && refallc.length && refalld.length && refalle.length && refallf.length && refallg.length && edialla.length && ediallb.length && ediallc.length && edialld.length && edialle.length && ediallf.length; i++) {
            if (refalla[i].type == 'checkbox' && refallb[i].type == 'checkbox' && refallc[i].type == 'checkbox' && refalld[i].type == 'checkbox' && refalle[i].type == 'checkbox' && refallf[i].type == 'checkbox' && refallg[i].type == 'checkbox' &&
                edialla[i].type == 'checkbox' && ediallb[i].type == 'checkbox' && ediallc[i].type == 'checkbox' && edialld[i].type == 'checkbox' && edialle[i].type == 'checkbox' && ediallf[i].type == 'checkbox')
                refalla[i].checked = true;
            refallb[i].checked = true;
            refallc[i].checked = true;
            refalld[i].checked = true;
            refalle[i].checked = true;
            refallf[i].checked = true;
            refallg[i].checked = true;
            // Eddifact
            edialla[i].checked = true;
            ediallb[i].checked = true;
            ediallc[i].checked = true;
            edialld[i].checked = true;
            edialle[i].checked = true;
            ediallf[i].checked = true;

        }
    }

    // Unchecked All Referensi
    function deRefAll() {
        var refalla = document.getElementsByName('NameDaftarBarang');
        var refallb = document.getElementsByName('NameTarifHS');
        var refallc = document.getElementsByName('NamePemasok');
        var refalld = document.getElementsByName('NamePerusahaan');
        var refalle = document.getElementsByName('NameAlatAngkut');
        var refallf = document.getElementsByName('NameTempatPenimbunan');
        var refallg = document.getElementsByName('NameKantorBeaCukai');
        // Eddifact
        var edialla = document.getElementsByName('NameNegara');
        var ediallb = document.getElementsByName('NamePelabuhanDalamNegeri');
        var ediallc = document.getElementsByName('NamePelabuhanLuarNegeri');
        var edialld = document.getElementsByName('NameMataUang');
        var edialle = document.getElementsByName('NameSatuan');
        var ediallf = document.getElementsByName('NameKemasan');

        for (var i = 0; i < refalla.length && refallb.length && refallc.length && refalld.length && refalle.length && refallf.length && refallg.length && edialla.length && ediallb.length && ediallc.length && edialld.length && edialle.length && ediallf.length; i++) {
            if (refalla[i].type == 'checkbox' && refallb[i].type == 'checkbox' && refallc[i].type == 'checkbox' && refalld[i].type == 'checkbox' && refalle[i].type == 'checkbox' && refallf[i].type == 'checkbox' && refallg[i].type == 'checkbox' && edialla[i].type == 'checkbox' && ediallb[i].type == 'checkbox' && ediallc[i].type == 'checkbox' && edialld[i].type == 'checkbox' && edialle[i].type == 'checkbox' && ediallf[i].type == 'checkbox')
                refalla[i].checked = false;
            refallb[i].checked = false;
            refallc[i].checked = false;
            refalld[i].checked = false;
            refalle[i].checked = false;
            refallf[i].checked = false;
            refallg[i].checked = false;
            // Eddifact
            edialla[i].checked = false;
            ediallb[i].checked = false;
            ediallc[i].checked = false;
            edialld[i].checked = false;
            edialle[i].checked = false;
            ediallf[i].checked = false;

        }
    }

    // `Checked All 1. Referensi
    function seRef() {
        var refa = document.getElementsByName('NameDaftarBarang');
        var refb = document.getElementsByName('NameTarifHS');
        var refc = document.getElementsByName('NamePemasok');
        var refd = document.getElementsByName('NamePerusahaan');
        var refe = document.getElementsByName('NameAlatAngkut');
        var reff = document.getElementsByName('NameTempatPenimbunan');
        var refg = document.getElementsByName('NameKantorBeaCukai');

        for (var i = 0; i < refa.length && refb.length && refc.length && refd.length && refe.length && reff.length && refg.length; i++) {
            if (refa[i].type == 'checkbox' && refb[i].type == 'checkbox' && refc[i].type == 'checkbox' && refd[i].type == 'checkbox' && refe[i].type == 'checkbox' && reff[i].type == 'checkbox' && refg[i].type == 'checkbox')
                refa[i].checked = true;
            refb[i].checked = true;
            refc[i].checked = true;
            refd[i].checked = true;
            refe[i].checked = true;
            reff[i].checked = true;
            refg[i].checked = true;
        }
    }

    // Unchecked All 1. Referensi
    function deRef() {
        var refa = document.getElementsByName('NameDaftarBarang');
        var refb = document.getElementsByName('NameTarifHS');
        var refc = document.getElementsByName('NamePemasok');
        var refd = document.getElementsByName('NamePerusahaan');
        var refe = document.getElementsByName('NameAlatAngkut');
        var reff = document.getElementsByName('NameTempatPenimbunan');
        var refg = document.getElementsByName('NameKantorBeaCukai');

        for (var i = 0; i < refa.length && refb.length && refc.length && refd.length && refe.length && reff.length && refg.length; i++) {
            if (refa[i].type == 'checkbox' && refb[i].type == 'checkbox' && refc[i].type == 'checkbox' && refd[i].type == 'checkbox' && refe[i].type == 'checkbox' && reff[i].type == 'checkbox' && refg[i].type == 'checkbox')
                refa[i].checked = false;
            refb[i].checked = false;
            refc[i].checked = false;
            refd[i].checked = false;
            refe[i].checked = false;
            reff[i].checked = false;
            refg[i].checked = false;
        }
    }

    // `Checked All 1. Edifact
    function seEdi() {
        var edia = document.getElementsByName('NameNegara');
        var edib = document.getElementsByName('NamePelabuhanDalamNegeri');
        var edic = document.getElementsByName('NamePelabuhanLuarNegeri');
        var edid = document.getElementsByName('NameMataUang');
        var edie = document.getElementsByName('NameSatuan');
        var edif = document.getElementsByName('NameKemasan');

        for (var i = 0; i < edia.length && edib.length && edic.length && edid.length && edie.length && edif.length; i++) {
            if (edia[i].type == 'checkbox' && edib[i].type == 'checkbox' && edic[i].type == 'checkbox' && edid[i].type == 'checkbox' && edie[i].type == 'checkbox' && edif[i].type == 'checkbox')
                edia[i].checked = true;
            edib[i].checked = true;
            edic[i].checked = true;
            edid[i].checked = true;
            edie[i].checked = true;
            edif[i].checked = true;
        }
    }

    // Unchecked All 1. Edifact
    function deEdi() {
        var edia = document.getElementsByName('NameNegara');
        var edib = document.getElementsByName('NamePelabuhanDalamNegeri');
        var edic = document.getElementsByName('NamePelabuhanLuarNegeri');
        var edid = document.getElementsByName('NameMataUang');
        var edie = document.getElementsByName('NameSatuan');
        var edif = document.getElementsByName('NameKemasan');

        for (var i = 0; i < edia.length && edib.length && edic.length && edid.length && edie.length && edif.length; i++) {
            if (edia[i].type == 'checkbox' && edib[i].type == 'checkbox' && edic[i].type == 'checkbox' && edid[i].type == 'checkbox' && edie[i].type == 'checkbox' && edif[i].type == 'checkbox')
                edia[i].checked = false;
            edib[i].checked = false;
            edic[i].checked = false;
            edid[i].checked = false;
            edie[i].checked = false;
            edif[i].checked = false;
        }
    }

    function seAdm() {
        var refalla = document.getElementsByName('NameDepartemen');
        var refallb = document.getElementsByName('NameHakAkses');
        var refallc = document.getElementsByName('NameJabatan');
        var refalld = document.getElementsByName('NameKuotaMitra');
        var refalle = document.getElementsByName('NamePengaturanAppTPB');
        var refallf = document.getElementsByName('NamePengaturanRealTimeReload');
        var refallg = document.getElementsByName('NamePengaturanInformasi');
        var refallh = document.getElementsByName('NameUserManajemenWeb');

        for (var i = 0; i < refalla.length && refallb.length && refallc.length && refalld.length && refalle.length && refallf.length && refallg.length && refallh.length; i++) {
            if (refalla[i].type == 'checkbox' && refallb[i].type == 'checkbox' && refallc[i].type == 'checkbox' && refalld[i].type == 'checkbox' && refalle[i].type == 'checkbox' && refallf[i].type == 'checkbox' && refallg[i].type == 'checkbox' &&
                refallh[i].type == 'checkbox')
                refalla[i].checked = true;
            refallb[i].checked = true;
            refallc[i].checked = true;
            refalld[i].checked = true;
            refalle[i].checked = true;
            refallf[i].checked = true;
            refallg[i].checked = true;
            refallh[i].checked = true;

        }
    }

    function deAdm() {
        var refalla = document.getElementsByName('NameDepartemen');
        var refallb = document.getElementsByName('NameHakAkses');
        var refallc = document.getElementsByName('NameJabatan');
        var refalld = document.getElementsByName('NameKuotaMitra');
        var refalle = document.getElementsByName('NamePengaturanAppTPB');
        var refallf = document.getElementsByName('NamePengaturanRealTimeReload');
        var refallg = document.getElementsByName('NamePengaturanInformasi');
        var refallh = document.getElementsByName('NameUserManajemenWeb');

        for (var i = 0; i < refalla.length && refallb.length && refallc.length && refalld.length && refalle.length && refallf.length && refallg.length && refallh.length; i++) {
            if (refalla[i].type == 'checkbox' && refallb[i].type == 'checkbox' && refallc[i].type == 'checkbox' && refalld[i].type == 'checkbox' && refalle[i].type == 'checkbox' && refallf[i].type == 'checkbox' && refallg[i].type == 'checkbox' &&
                refallh[i].type == 'checkbox')
                refalla[i].checked = false;
            refallb[i].checked = false;
            refallc[i].checked = false;
            refalld[i].checked = false;
            refalle[i].checked = false;
            refallf[i].checked = false;
            refallg[i].checked = false;
            refallh[i].checked = false;

        }
    }

    function seLap() {
        var refalla = document.getElementsByName('NameLapMasukBarang');
        var refallb = document.getElementsByName('NameLapKeluarBarang');
        var refallc = document.getElementsByName('NameLapMutasiBarang');
        var refalld = document.getElementsByName('NameLapPosisiBarang');
        var refalle = document.getElementsByName('NameLapRealisasi');
        var refallf = document.getElementsByName('NameLapDataTPB');
        var refallg = document.getElementsByName('NamePLBReportCK5');
        var refallh = document.getElementsByName('NameGBSarinahReportCK5');
        var refalli = document.getElementsByName('NameLapLogSystem');

        for (var i = 0; i < refalla.length && refallb.length && refallc.length && refalld.length && refalle.length && refallf.length && refallg.length && refallh.length; i++) {
            if (refalla[i].type == 'checkbox' && refallb[i].type == 'checkbox' && refallc[i].type == 'checkbox' && refalld[i].type == 'checkbox' && refalle[i].type == 'checkbox' && refallf[i].type == 'checkbox' && refallg[i].type == 'checkbox' &&
                refallh[i].type == 'checkbox')
                refalla[i].checked = true;
            refallb[i].checked = true;
            refallc[i].checked = true;
            refalld[i].checked = true;
            refalle[i].checked = true;
            refallf[i].checked = true;
            refallg[i].checked = true;
            refallh[i].checked = true;
            refalli[i].checked = true;

        }
    }

    function deLap() {
        var refalla = document.getElementsByName('NameLapMasukBarang');
        var refallb = document.getElementsByName('NameLapKeluarBarang');
        var refallc = document.getElementsByName('NameLapMutasiBarang');
        var refalld = document.getElementsByName('NameLapPosisiBarang');
        var refalle = document.getElementsByName('NameLapRealisasi');
        var refallf = document.getElementsByName('NameLapDataTPB');
        var refallg = document.getElementsByName('NamePLBReportCK5');
        var refallh = document.getElementsByName('NameGBSarinahReportCK5');
        var refalli = document.getElementsByName('NameLapLogSystem');

        for (var i = 0; i < refalla.length && refallb.length && refallc.length && refalld.length && refalle.length && refallf.length && refallg.length && refallh.length && refalli.length; i++) {
            if (refalla[i].type == 'checkbox' && refallb[i].type == 'checkbox' && refallc[i].type == 'checkbox' && refalld[i].type == 'checkbox' && refalle[i].type == 'checkbox' && refallf[i].type == 'checkbox' && refallg[i].type == 'checkbox' &&
                refallh[i].type == 'checkbox' && refalli[i].type == 'checkbox')
                refalla[i].checked = false;
            refallb[i].checked = false;
            refallc[i].checked = false;
            refalld[i].checked = false;
            refalle[i].checked = false;
            refallf[i].checked = false;
            refallg[i].checked = false;
            refallh[i].checked = false;
            refalli[i].checked = false;

        }
    }
</script>