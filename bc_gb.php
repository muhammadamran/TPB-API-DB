<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";

// FUNCTION SEARCHING
$FindBC = '';

if (isset($_POST['FindFilter']) != '') {
    if (isset($_POST['FindBC'])) {
        $FindBC = $_POST['FindBC'];
    }
}
// END FUNCTION SEARCHING
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Dokumen GB BC App Name | Company </title>
<?php } else { ?>
    <title>Dokumen GB BC - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> - <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="far fa-dot-circle icon-page"></i>
                <font class="text-page">Dokumen GB</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">Data Online</a></li>
                <li class="breadcrumb-item active">Dokumen GB <?= $FindBC ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i:m A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin Search -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-filter"></i> Filter Dokumen BC</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" id="fformone" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Dokumen BC</label>
                                <div class="col-md-7">
                                    <select type="text" class="default-select2 form-control" name="FindBC">
                                        <?php if ($FindBC == NULL) { ?>
                                            <option value="">Pilih Dokumen BC</option>
                                        <?php } else { ?>
                                            <option value="<?= $FindBC ?>"><?= $FindBC ?></option>
                                            <option value="">Pilih Dokumen</option>
                                        <?php } ?>
                                        <option value="23">23</option>
                                        <option value="25">25</option>
                                        <option value="261">261</option>
                                        <option value="27">27</option>
                                        <option value="40">40</option>
                                        <option value="41">41</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7 offset-md-3">
                                    <button type="submit" class="btn btn-info m-r-5" name="FindFilter">
                                        <i class="fa fa-search"></i>
                                        <font class="f-action">Cari</font>
                                    </button>
                                    <a href="bc_gb.php" type="button" class="btn btn-warning m-r-5">
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
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Dokumen GB] <?= $FindBC ?></h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="C_TableDefault_L" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">No. Pengajuan & Tgl</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Asal</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Tujuan</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Kantor Asal & Tujuan</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Negara Pemasok</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Kode Valuta</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Pengangkut</th>
                                    <th class="text-nowrap" colspan="5" style="text-align: center;">Jumlah</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">TTD</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Status</th>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" style="text-align: center;">Barang</th>
                                    <th class="text-nowrap" style="text-align: center;">BRUTO</th>
                                    <th class="text-nowrap" style="text-align: center;">CIF</th>
                                    <th class="text-nowrap" style="text-align: center;">Harga Penyerahan</th>
                                    <th class="text-nowrap" style="text-align: center;">NETTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataTable = $dbcon->query("SELECT
                                                            hdr.NOMOR_AJU,
                                                            SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU,
                                                            hdr.NAMA_PENGUSAHA,
                                                            hdr.NAMA_PENERIMA_BARANG,
                                                            hdr.NOMOR_IJIN_TPB,
                                                            hdr.NOMOR_IJIN_TPB_PENERIMA,
                                                            hdr.BRUTO,
                                                            hdr.CIF,
                                                            hdr.HARGA_PENYERAHAN,
                                                            hdr.JUMLAH_BARANG,
                                                            hdr.KODE_KANTOR,
                                                            hdr.KODE_KANTOR_TUJUAN,
                                                            hdr.KODE_NEGARA_PEMASOK,
                                                            hdr.KODE_VALUTA,
                                                            hdr.NAMA_PENGANGKUT,
                                                            hdr.NETTO,
                                                            hdr.TANGGAL_TTD,
                                                            hdr.NAMA_TTD,
                                                            hdr.KOTA_TTD,
                                                            hdr.KODE_JENIS_TPB,
                                                            sts.URAIAN_STATUS,
                                                            ngr.URAIAN_NEGARA,
                                                            jns.URAIAN_JENIS_TPB,
                                                            ktr_a.URAIAN_KANTOR AS KANTOR_ASAL,
                                                            ktr_b.URAIAN_KANTOR AS KANTOR_TUJUAN
                                                            FROM tpb_header AS hdr 
                                                            LEFT OUTER JOIN referensi_status AS sts ON sts.KODE_STATUS=hdr.KODE_STATUS 
                                                            LEFT OUTER JOIN referensi_negara AS ngr ON ngr.KODE_NEGARA=hdr.KODE_NEGARA_PEMASOK
                                                            LEFT OUTER JOIN referensi_jenis_tpb AS jns ON jns.KODE_JENIS_TPB=hdr.KODE_JENIS_TPB
                                                            LEFT OUTER JOIN referensi_kantor_pabean AS ktr_a ON ktr_a.KODE_KANTOR=hdr.KODE_KANTOR
                                                            LEFT OUTER JOIN referensi_kantor_pabean AS ktr_b ON ktr_b.KODE_KANTOR=hdr.KODE_KANTOR_TUJUAN
                                                            WHERE hdr.KODE_DOKUMEN_PABEAN=$FindBC GROUP BY hdr.NOMOR_AJU ORDER BY hdr.NOMOR_AJU", 0);
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: left">
                                                <?php
                                                $dataTGLAJU = $row['TGL_AJU'];
                                                $dataTGLAJUY = substr($dataTGLAJU, 0, 4);
                                                $dataTGLAJUM = substr($dataTGLAJU, 4, 2);
                                                $dataTGLAJUD =  substr($dataTGLAJU, 6, 2);

                                                $datTGLAJU = $dataTGLAJUY . '-' . $dataTGLAJUM . '-' . $dataTGLAJUD;
                                                ?>
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Nomor Pengajuan & Tanggal Pengajuan">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['NOMOR_AJU']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= date_indo_s($datTGLAJU, TRUE) ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- ASAL BARANG & JUMLAH BARANG -->
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;width:200px">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Asal & No. Ijin TPB">
                                                        <i class="fas fa-warehouse"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['NAMA_PENGUSAHA']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['NOMOR_IJIN_TPB']; ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;width:200px">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Penerima & No. Ijin TPB">
                                                        <i class="fas fa-building"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['NAMA_PENERIMA_BARANG']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['NOMOR_IJIN_TPB_PENERIMA']; ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;width:150px">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Kantor Asal & Tujuan">
                                                        <i class="far fa-building"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:12px"><?= $row['KANTOR_ASAL']; ?></font>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:12px"><?= $row['KANTOR_TUJUAN']; ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Negara Pemasok">
                                                        <i class="fas fa-globe"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['URAIAN_NEGARA']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['KODE_NEGARA_PEMASOK']; ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center;"><?= $row['KODE_VALUTA'] ?></td>
                                            <td style="text-align: center;"><?= $row['NAMA_PENGANGKUT'] ?></td>
                                            <td style="text-align: center;"><?= $row['JUMLAH_BARANG'] ?></td>
                                            <td style="text-align: left;"><?= $row['BRUTO'] ?></td>
                                            <td style="text-align: left;"><?= $row['CIF'] ?></td>
                                            <td style="text-align: right;"><?= $row['HARGA_PENYERAHAN'] ?></td>
                                            <td style="text-align: right;"><?= $row['NETTO'] ?></td>
                                            <?php
                                            $alldate = $row['TANGGAL_TTD'];
                                            $tgl = substr($alldate, 0, 10);
                                            $time = substr($alldate, 10, 20);
                                            ?>
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;width:250px">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Tanda Tangan">
                                                        <i class="fas fa-file-signature"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['NAMA_TTD']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['KOTA_TTD']; ?>-<?= date_indo_s($tgl, TRUE) ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center;"><?= $row['URAIAN_STATUS'] ?></td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="17">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
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