<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
// API - 
include "include/api.php";
$content = get_content($resultAPI['url_api'] . 'reportCK5Sarinah.php');
$data = json_decode($content, true);
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Data Gudang Berikat App Name | Company </title>
<?php } else { ?>
    <title>Laporan Data Gudang Berikat <?= $resultSetting['company']; ?> - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fa-solid fa-school-lock icon-page"></i>
                <font class="text-page">Laporan Data Gudang Berikat <?= $resultSetting['company']; ?></font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Laporan</a></li>
                <li class="breadcrumb-item active">Laporan Data Gudang Berikat <?= $resultSetting['company']; ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i:m A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> BC 2.7 - Gudang Berikat <?= $resultSetting['company']; ?></h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%" style="text-align:center">#</th>
                                    <th rowspan="2" style="text-align:center">Format CK5</th>
                                    <th rowspan="2" style="text-align:center">Packing List</th>
                                    <th rowspan="2" style="text-align:center">Invoice</th>
                                    <th colspan="3" style="text-align:center">PLB</th>
                                    <th colspan="3" style="text-align:center">GB</th>
                                </tr>
                                <tr>
                                    <th style="text-align:center">Nomor Pengajuan</th>
                                    <th style="text-align:center">Asal</th>
                                    <th style="text-align:center">Penerima</th>
                                    <th style="text-align:center">Nomor Pengajuan</th>
                                    <th style="text-align:center">Asal</th>
                                    <th style="text-align:center">Penerima</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $dataTable = $dbcon->query("SELECT hdr.ID AS IDH,hdr.NOMOR_AJU,SUBSTR(hdr.NOMOR_AJU,13,8) AS TGL_AJU_PLB,hdr.PEMASOK,hdr.KODE_NEGARA_PEMASOK,hdr.NOMOR_DAFTAR,hdr.PERUSAHAAN,hdr.JUMLAH_BARANG,
                                                                hdr.NAMA_PENERIMA_BARANG,
                                                                rcd.status,rcd.keterangan,plb.ck5_plb_submit,
                                                                rcd.rcd_id,
                                                                rcd.bm_no_aju_plb,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_remarks,
                                                                rcd.bk_no_aju_sarinah,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_remarks,
                                                                rcd.keterangan,
                                                                rcd.bc_out,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.upload_beritaAcara_GB,
                                                                -- TAMBAHAN
                                                                SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU_GB,
                                                                tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS_GB IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All,
                                                                -- END
                                                                (SELECT COUNT(NOMOR_AJU) FROM plb_barang WHERE STATUS IS NOT NULL AND NOMOR_AJU=hdr.NOMOR_AJU) AS total_All_PLB,
                                                                (SELECT COUNT(STATUS_GB) FROM plb_barang WHERE STATUS='Sesuai' AND NOMOR_AJU=hdr.NOMOR_AJU GROUP BY hdr.NOMOR_AJU) AS STATUS
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb 
                                                                LEFT OUTER JOIN plb_status AS plb ON hdr.NOMOR_AJU=plb.NOMOR_AJU_PLB 
                                                                -- TAMBAHAN
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU 
                                                                -- END
                                                                -- TAMBAHAN
                                                                WHERE rcd.upload_beritaAcara_PLB IS NOT NULL
                                                                -- END
                                                                GROUP BY hdr.NOMOR_AJU ORDER BY hdr.ID DESC LIMIT 100");
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <td style="text-align: center;">
                                                <!-- <a href="report_ck5_sarinah_detail.php?AJU=<?= $row['bm_no_aju_plb']; ?>" target="_blank" class="btn btn-primary"> -->
                                                <a href="report_data_gb_ck5.php?AJU=<?= $row['bm_no_aju_plb']; ?>" target="_blank" class="btn btn-primary">
                                                    <i class="fab fa-wpforms" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Lihat Detil <?= $row['bm_no_aju_plb']; ?>"></i><br>
                                                    <font style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
                                                        CK5
                                                    </font>
                                                </a>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="report_data_gb_packinglist.php?AJU=<?= $row['bm_no_aju_plb']; ?>" target="_blank" class="btn btn-success">
                                                    <i class="fa-solid fa-boxes-stacked" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Packing List <?= $row['bm_no_aju_plb']; ?>"></i><br>
                                                    <font style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
                                                        Packing List
                                                    </font>
                                                </a>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="report_data_gb_invoice.php?AJU=<?= $row['bm_no_aju_plb']; ?>" target="_blank" class="btn btn-default">
                                                    <i class="fa-solid fa-file-invoice" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Invoice <?= $row['bm_no_aju_plb']; ?>"></i><br>
                                                    <font style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
                                                        Invoice
                                                    </font>
                                                </a>
                                            </td>
                                            <!-- PLB -->
                                            <!-- NOMOR AJU PLB & TANGGAL AJU -->
                                            <td style="text-align: left">
                                                <?php
                                                $dataTGLAJU_PLB = $row['TGL_AJU_PLB'];
                                                $dataTGLAJU_PLBY = substr($dataTGLAJU_PLB, 0, 4);
                                                $dataTGLAJU_PLBM = substr($dataTGLAJU_PLB, 4, 2);
                                                $dataTGLAJU_PLBD = substr($dataTGLAJU_PLB, 6, 2);

                                                $datTGLAJU_PLB = $dataTGLAJU_PLBY . '-' . $dataTGLAJU_PLBM . '-' . $dataTGLAJU_PLBD;
                                                ?>
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Nomor Pengajuan & Tanggal Pengajuan">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['bm_no_aju_plb']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= date_indo_s($datTGLAJU_PLB, TRUE) ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- ASAL BARANG & JUMLAH BARANG -->
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;width: 280px;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Asal & Jumlah Barang">
                                                        <i class="fas fa-warehouse"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['PERUSAHAAN']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['JUMLAH_BARANG']; ?> Barang</font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- NAMA PENERIMA BARANG PLB -->
                                            <td style="text-align: left">
                                                <div style="width:200px">
                                                    <?php if ($row['NAMA_PENERIMA_BARANG'] == NULL) { ?>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                        </font>
                                                    <?php } else { ?>
                                                        <?= $row['NAMA_PENERIMA_BARANG']; ?>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <!-- GB -->
                                            <!-- NOMOR AJU GB & TANGGAL AJU -->
                                            <td style="text-align: left">
                                                <?php
                                                $dataTGLAJU_TPB = $row['TGL_AJU_GB'];
                                                $dataTGLAJU_TPBY = substr($dataTGLAJU_TPB, 0, 4);
                                                $dataTGLAJU_TPBM = substr($dataTGLAJU_TPB, 4, 2);
                                                $dataTGLAJU_TPBD =  substr($dataTGLAJU_TPB, 6, 2);

                                                $datTGLAJU_TPB = $dataTGLAJU_TPBY . '-' . $dataTGLAJU_TPBM . '-' . $dataTGLAJU_TPBD;
                                                ?>
                                                <div style="display: flex;justify-content: flex-start;align-items: center;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Nomor Pengajuan & Tanggal Pengajuan">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['bk_no_aju_sarinah']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= date_indo_s($datTGLAJU_TPB, TRUE) ?></font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- ASAL BARANG & JUMLAH BARANG -->
                                            <td style="text-align: left;">
                                                <div style="display: flex;justify-content: flex-start;align-items: center;width: 110px;">
                                                    <div style="font-size: 14px;background: #dadddf;padding: 5px 10px 5px 10px;border-radius: 2px;color: #444445;" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Asal & Jumlah Barang">
                                                        <i class="fas fa-warehouse"></i>
                                                    </div>
                                                    <div style="display: grid;margin-left:5px">
                                                        <div>
                                                            <?= $row['NAMA_PENGUSAHA']; ?>
                                                        </div>
                                                        <div style="margin-top: -5px;">
                                                            <font style="font-size: 9px;font-weight: 300;margin-top:10px"><?= $row['JUMLAH_BARANG']; ?> Barang</font>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <!-- NAMA PENERIMA BARANG GB -->
                                            <td style="text-align: left">
                                                <div style="width:150px">
                                                    <?= $row['NAMA_PENERIMA_BARANG_GB']; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    endforeach ?>
                                <?php endif ?>
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