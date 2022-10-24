<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fa fa-desktop icon-page"></i>
                <font class="text-page">Laporan Realisasi</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Report</a></li>
                <li class="breadcrumb-item active">Laporan Realisasi</li>
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
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Report] Laporan Realisasi</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
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
                                                            INNER JOIN referensi_pengusaha AS b ON a.tbb_nama=b.ID HAVING a.quota_year ORDER BY a.quota_id ASC");
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
                                            <td style="text-align: center;"><?= $row['gol_a_car'] ?></td>
                                            <td style="text-align: center;"><?= $row['gol_a_ltr'] ?></td>
                                            <td style="text-align: center;"><?= $row['gol_b_car'] ?></td>
                                            <td style="text-align: center;"><?= $row['gol_b_ltr'] ?></td>
                                            <td style="text-align: center;"><?= $row['gol_c_car'] ?></td>
                                            <td style="text-align: center;"><?= $row['gol_c_ltr'] ?></td>
                                            <td style="text-align: center;">
                                                <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                                    <a href="#updateData<?= $row['quota_id'] ?>" class="btn btn-sm btn-warning" data-toggle="modal" title="Update Data"><i class="fas fa-edit"></i></a>
                                                <?php } ?>
                                                <?php if ($resultForPrivileges['DELETE_DATA'] == 'Y') { ?>
                                                    <a href="#deleteData<?= $row['quota_id'] ?>" class="btn btn-sm btn-danger" data-toggle="modal" title="Hapus Data"><i class="fas fa-trash"></i></a>
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
                                                                            <label for="IdMitra">Nama Mitra </label>
                                                                            <input type="hidden" name="IDUNIQ" value="<?= $row['quota_id'] ?>">
                                                                            <select type="text" class="default-select2 form-control" name="UpdateMitra" id="IDMitra">
                                                                                <option value="<?= $row['tbb_nama'] ?>"><?= $row['tbb_nama'] ?> - <?= $row['NAMA'] ?></option>
                                                                                <option value="">-- Pilih Mitra --</option>
                                                                                <?php
                                                                                $resultMitra = $dbcon->query("SELECT NPWP,NAMA FROM referensi_pengusaha WHERE NAMA IS NOT NULL AND NAMA !='' ORDER BY NAMA ASC");
                                                                                foreach ($resultMitra as $RowMitra) {
                                                                                ?>
                                                                                    <option value="<?= $RowMitra['NPWP'] ?>"><?= $RowMitra['NPWP'] ?> - <?= $RowMitra['NAMA'] ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="IdTahun">Tahun </label>
                                                                            <select type="text" class="default-select2 form-control" name="UpdateTahun" id="IDTahun">
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
        </div>
    </div>
    <!-- end row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>