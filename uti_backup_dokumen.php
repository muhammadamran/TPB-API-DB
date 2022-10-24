<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";

?>
<style type="text/css">
    #if-mobile {
        margin-top: 0px;
    }

    @media (max-width: 767.5px) {
        #if-mobile {
            margin-top: 10px;
        }
    }
</style>
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
                <li class="breadcrumb-item"><a href="javascript:;">Backup</a></li>
                <li class="breadcrumb-item active">Backup Dokumen</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- begin Search -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-filter"></i> Filter Backup Dokumen</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" id="fformone" method="GET">
                        <fieldset>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Jenis Dokumen</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="fJenisDokumen">
                                        <?php if ($fJenisDokumen == '') { ?>
                                            <option value="">-- Pilih Jenis Dokumen --</option>
                                        <?php } else { ?>
                                            <option value="<?= $fJenisDokumen; ?>"><?= $fJenisDokumen; ?></option>
                                            <option value="">-- Pilih Jenis Dokumen --</option>
                                        <?php } ?>
                                        <?php
                                        $findresultJenisDokumen = $dbcon->query("SELECT * FROM referensi_dokumen_pabean ORDER BY URAIAN_DOKUMEN_PABEAN ASC");
                                        foreach ($findresultJenisDokumen as $findrowJenisDokumen) {
                                        ?>
                                            <option value="<?= $findrowJenisDokumen['KODE_DOKUMEN_PABEAN'] ?>"><?= $findrowJenisDokumen['KODE_DOKUMEN_PABEAN'] ?> - <?= $findrowJenisDokumen['URAIAN_DOKUMEN_PABEAN'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Filter</label>
                                <div class="col-md-4">
                                    <?php if ($fusername == '') { ?>
                                        <input type="text" class="form-control" name="fusername" placeholder="Username ...">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" name="fusername" placeholder="Username ..." value="<?= $fusername; ?>">
                                    <?php } ?>
                                </div>
                                <div class="col-md-4" id="if-mobile">
                                    <?php if ($fusername == '') { ?>
                                        <input type="text" class="form-control" name="fusername" placeholder="Username ...">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" name="fusername" placeholder="Username ..." value="<?= $fusername; ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7 offset-md-3">
                                    <button type="submit" class="btn btn-sm btn-info m-r-5" name="findOne">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                    <a href="adm_user_manajemen_web.php" type="button" class="btn btn-sm btn-yellow m-r-5">
                                        <i class="fa fa-refresh"></i> Reset
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
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-backup-dokumen">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Backup] Backup Dokumen</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th class="text-nowrap" style="text-align: center;">NPWP</th>
                                    <th class="text-nowrap" style="text-align: center;">Nama</th>
                                    <th class="text-nowrap" style="text-align: center;">Alamat</th>
                                    <th class="text-nowrap" style="text-align: center;">No. SKEP</th>
                                    <th class="text-nowrap" style="text-align: center;">API</th>
                                    <th class="text-nowrap" style="text-align: center;">Status</th>
                                    <!-- <th class="text-nowrap">Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT * FROM referensi_pengusaha AS a
                                                            LEFT JOIN referensi_status_pengusaha AS b ON a.KODE_ID=b.KODE_STATUS_PENGUSAHA ORDER BY a.ID DESC");
                                if (mysqli_num_rows($dataTable) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_array($dataTable)) {
                                        $no++;
                                ?>
                                        <tr class="odd gradeX">
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center;">
                                                <?php if ($row['NPWP'] == NULL || $row['NPWP'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= NPWP($row['NPWP']) ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php if ($row['NAMA'] == NULL || $row['NAMA'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['NAMA'] ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php if ($row['ALAMAT'] == NULL || $row['ALAMAT'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['ALAMAT'] ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php if ($row['NOMOR_SKEP'] == NULL || $row['NOMOR_SKEP'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_SKEP'] ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php if ($row['STATUS_IMPORTIR'] == NULL || $row['STATUS_IMPORTIR'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['STATUS_IMPORTIR'] ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: left;">
                                                <?php if ($row['URAIAN_STATUS_PENGUSAHA'] == NULL || $row['URAIAN_STATUS_PENGUSAHA'] == '') { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                                                <?php } else { ?>
                                                    <?= $row['URAIAN_STATUS_PENGUSAHA'] ?>
                                                <?php } ?>
                                            </td>
                                            <!-- <td>
                                                <a href="#updateData<?= $row['ID'] ?>" class="btn btn-sm btn-warning" data-toggle="modal" title="Update Data"><i class="fas fa-edit"></i></a>
                                                <a href="#deleteData<?= $row['ID'] ?>" class="btn btn-sm btn-danger" data-toggle="modal" title="Hapus Data"><i class="fas fa-trash"></i></a>
                                            </td> -->
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="10">
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
        </div>
    </div>
    <!-- end row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>