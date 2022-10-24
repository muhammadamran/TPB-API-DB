<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
// API - 
include "include/api.php";
$content = get_content($resultAPI['url_api'] . 'refPerusahaan.php');
$data = json_decode($content, true);
?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-book icon-page"></i>
                <font class="text-page">Referensi</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">View Data Online</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Referensi</a></li>
                <li class="breadcrumb-item active">Perusahaan</li>
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
            <div class="panel panel-inverse" data-sortable-id="ui-perusahaan">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Referensi] Perusahaan</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="data-table-buttons"
                            class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th class="text-nowrap" style="text-align: center;">NPWP</th>
                                    <th class="text-nowrap" style="text-align: center;">Nama</th>
                                    <th class="text-nowrap" style="text-align: center;">Alamat</th>
                                    <th class="text-nowrap" style="text-align: center;">No. SKEP</th>
                                    <th class="text-nowrap" style="text-align: center;">NPPBKC</th>
                                    <th class="text-nowrap" style="text-align: center;">API</th>
                                    <th class="text-nowrap" style="text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['status'] == 404) { ?>
                                <tr>
                                    <td colspan="8">
                                        <center>
                                            <div style="display: grid;">
                                                <i class="far fa-times-circle no-data"></i> Tidak ada data
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                <?php } else { ?>
                                <?php $no = 0; ?>
                                <?php foreach ($data['result'] as $row) { ?>
                                <?php $no++ ?>
                                <tr class="odd gradeX">
                                    <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                    <td style="text-align: left;">
                                        <?php if ($row['NPWP'] == NULL || $row['NPWP'] == '') { ?>
                                        <center>
                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                            </font>
                                        </center>
                                        <?php } else { ?>
                                        <?= $row['NPWP'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php if ($row['NAMA'] == NULL || $row['NAMA'] == '') { ?>
                                        <center>
                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                            </font>
                                        </center>
                                        <?php } else { ?>
                                        <?= $row['NAMA'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['ALAMAT'] == NULL || $row['ALAMAT'] == '') { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                        <?php } else { ?>
                                        <a href="#AlamatMitra<?= $row['ID'] ?>" class="btn btn-sm btn-info"
                                            data-toggle="modal" title="Alamat Mitra"><i class="fas fa-map"></i> Detail
                                            Alamat</a>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php if ($row['NOMOR_SKEP'] == NULL || $row['NOMOR_SKEP'] == '') { ?>
                                        <center>
                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                            </font>
                                        </center>
                                        <?php } else { ?>
                                        <?= $row['NOMOR_SKEP'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                        <?php if ($row['NPPBKC'] == NULL || $row['NPPBKC'] == '') { ?>
                                        <!-- <a href="#AddNPPBKC<?= $row['ID'] ?>" class="btn btn-sm btn-warning"
                                            data-toggle="modal" title="Tambah NPPBKC"><i class="fas fa-plus-circle"></i>
                                            NPPBKC</a> -->
                                        <a href="refPerusahaanNPPBKC.php?id=<?= $row['ID'] ?>&NPWP=<?= $row['NPWP']; ?>"
                                            class="btn btn-sm btn-warning" target="_blank" title="Tambah NPPBKC"><i
                                                class="fas fa-plus-circle"></i>NPPBKC</a>
                                        <?php } else { ?>
                                        <div style="display: flex;justify-content: space-evenly;align-content: center;">
                                            <div>
                                                <?= $row['NPPBKC'] ?>
                                            </div>
                                            <div style="margin: -2px;">
                                                <a href="refPerusahaanNPPBKC.php?id=<?= $row['ID'] ?>&NPWP=<?= $row['NPWP']; ?>"
                                                    class="label label-sm label-warning" target="_blank"
                                                    title="Tambah NPPBKC"><i class="fas fa-edit"></i></a>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak ada akses!</i>
                                        </font>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php if ($row['STATUS_IMPORTIR'] == NULL || $row['STATUS_IMPORTIR'] == '') { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['STATUS_IMPORTIR'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?php if ($row['URAIAN_STATUS_PENGUSAHA'] == NULL || $row['URAIAN_STATUS_PENGUSAHA'] == '') { ?>
                                        <center>
                                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                            </font>
                                        </center>
                                        <?php } else { ?>
                                        <?= $row['URAIAN_STATUS_PENGUSAHA'] ?>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <!-- Tambah NPPBKC -->
                                <div class="modal fade" id="AddNPPBKC<?= $row['ID'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="POST">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">[NPPBKC] Mitra - <?= $row['NAMA'] ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <fieldset>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="IdCARTON">NPWP</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="NPWP" value="<?= $row['NPWP']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="IdLITER">Nama</label>
                                                                    <input type="text" class="form-control"
                                                                        value="<?= $row['NAMA'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="IdLITER">NPPBKC <font
                                                                            style="color: red;">*</font></label>
                                                                    <input type="text" class="form-control"
                                                                        name="NameNPPBKC" id="IDNPPBKC"
                                                                        placeholder="NPPBKC" required>
                                                                    <input type="hidden" class="form-control"
                                                                        name="UNIQID" value="<?= $row['ID'] ?>">
                                                                    <input type="hidden" class="form-control"
                                                                        name="UNIQNWPW" value="<?= $row['NPWP'] ?>">
                                                                    <input type="hidden" class="form-control"
                                                                        name="UNIQNAMA" value="<?= $row['NAMA'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i
                                                            class="fas fa-times-circle"></i> Tutup</a>
                                                    <button type="submit" name="add_nppbkc" class="btn btn-warning"><i
                                                            class="fas fa-plus-circle"></i> NPPBKC</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tambah NPPBKC -->

                                <!-- Alamat -->
                                <div class="modal fade" id="AlamatMitra<?= $row['ID'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="POST">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">[Alamat] Mitra - <?= $row['NAMA'] ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-secondary m-b-0">
                                                        <h5><i class="fa fa-map"></i> Detail Alamat:</h5>
                                                        <p><?= $row['ALAMAT'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i
                                                            class="fas fa-times-circle"></i> Tutup</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Alamat -->
                                <?php } ?>
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
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
// NO KK
var numberMask = IMask(
    document.getElementById('IDNPPBKC'), {
        mask: '0000.000000',
    });

// UPDATE SUCCESS
if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
    Swal.fire({
        title: 'Data berhasil diupdate!',
        icon: 'success',
        text: 'Data berhasil diupdate didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './ref_perusahaan.php');
}
// UPDATE FAILED
if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
    Swal.fire({
        title: 'Data gagal diupdate!',
        icon: 'error',
        text: 'Data gagal diupdate didalam <?= $alertAppName ?>!'
    })
    history.replaceState({}, '', './ref_perusahaan.php');
}
</script>