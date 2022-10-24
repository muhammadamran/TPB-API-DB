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
$content = get_content($resultAPI['url_api'] . 'refTarifHS.php');
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
                <li class="breadcrumb-item active">Tarif HS</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- Begin Tambah Tarif HS -->
    <!-- <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title">[Tambah Data] Tarif HS</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" id="myFormDaftarBarang" method="POST">
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No. HS <font style="color: red;">*</font></label>
                                                <input type="number" class="form-control" name="InputNoHS" id="idNoHS" placeholder="No. HS ..." required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Bea Masuk</label>
                                                <select class="form-control" name="InputBeaMasuk" id="idBeaMasuk" placeholder="Bea Masuk ..." required>
                                                    <option value="">--- Pilih ---</option>
                                                    <option value="1">1 - ADVOLORUM</option>
                                                    <option value="2">2 - SPESIFIK</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <label style="color: transparent;">%</label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="number" class="form-control" name="InputBeaPersen" id="idBeaPersen" placeholder="0.00 ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">%</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="ForidBeaMasukLabel" style="display: none;">
                                                <label style="color: transparent;">Label</label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputBeaLabel" id="idBeaLabel" placeholder="Label ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary"><i class="fa fa-search"></i> Label</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <style type="text/css">
                                    #ppn-mobile {
                                        margin-top: 0px;
                                    }

                                    @media (max-width: 575.5px) {
                                        #ppn-mobile {
                                            margin-top: 10px;
                                        }
                                    }
                                </style>
                                <div class="col-sm-6" id="ppn-mobile">
                                    <div class="row">
                                        <div class="col-sm-6">
                                                <label>PPn <font style="color: red;">*</font></label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputPPn" id="idPPn" placeholder="PPn ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">%</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                                <label>PPh <font style="color: red;">*</font></label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputPPh" id="idPPh" placeholder="PPh ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">%</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Cukai</label>
                                                <select class="form-control" name="InputCukai" id="idCukai" placeholder="Cukai ..." required>
                                                    <option value="">--- Pilih ---</option>
                                                    <option value="1">1 - ADVOLORUM</option>
                                                    <option value="2">2 - SPESIFIK</option>
                                                    <option value="3">3 - MANUAL</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                                <label style="color: transparent;">%</label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputCukaiPersen" id="idCukaiPersen" placeholder="0.00 ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">%</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="ForidCukaiLabel" style="display: none;">
                                                <label style="color: transparent;">Label</label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputCukaiLabel" id="idCukaiLabel" placeholder="Label ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary"><i class="fa fa-search"></i> Label</a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="ForidCukaiRp" style="display: none;">
                                                <label style="color: transparent;">Rp.</label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="number" class="form-control" name="InputCukaiRp" id="idCukaiRp" placeholder="0.00 ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">Rp.</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                                <label>PPn BM <font style="color: red;">*</font></label>
                                                <div class="input-group bootstrap-secondary bootstrap-touchspin-injected">
                                                <input type="text" class="form-control" name="InputPPnBM" id="idPPnBM" placeholder="PPn BM ..." required>
                                                <span class="input-group-btn input-group-append">
                                                    <a href="#!" class="btn btn-secondary">%</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                </div>
                                <hr>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-primary" name="SimpanDaftarBarang"><i class="fa fa-save"></i> Simpan</button>
                                        <button type="button" class="btn btn-sm btn-yellow" onclick="myFunctionIDDaftarBarang()"><i class="fa fa-refresh"></i> Reset</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Tambah Tarif HS -->

    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-tarif-hs">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Referensi] Tarif HS</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="data-table-buttons"
                            class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th class="text-nowrap" style="text-align: center;">No. HS</th>
                                    <th class="text-nowrap" style="text-align: center;">Tarif Bea Masuk</th>
                                    <th class="text-nowrap" style="text-align: center;">Kode Bea Masuk</th>
                                    <th class="text-nowrap" style="text-align: center;">Tarif Cukai</th>
                                    <th class="text-nowrap" style="text-align: center;">Kode Cukai</th>
                                    <th class="text-nowrap" style="text-align: center;">PPn</th>
                                    <th class="text-nowrap" style="text-align: center;">PPn Bea Masuk</th>
                                    <th class="text-nowrap" style="text-align: center;">PPh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['status'] == 404) { ?>
                                <tr>
                                    <td colspan="9">
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
                                    <td style="text-align: center;">
                                        <?= $row['NOMOR_HS'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['TARIF_BM'] == NULL || $row['TARIF_BM'] == '') { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TARIF_BM'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['KD_SATUAN_BM'] == NULL || $row['KD_SATUAN_BM'] == '') { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['KD_SATUAN_BM'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['TARIF_CUKAI'] == NULL || $row['TARIF_CUKAI'] == '') { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TARIF_CUKAI'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['KD_SATUAN_CUKAI'] == NULL || $row['KD_SATUAN_CUKAI'] == '') { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['KD_SATUAN_CUKAI'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['TARIF_PPN'] == NULL || $row['TARIF_PPN'] == '') { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TARIF_PPN'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['TARIF_PPNBM'] == NULL || $row['TARIF_PPNBM'] == '') { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TARIF_PPNBM'] ?>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ($row['TARIF_PPH'] == NULL || $row['TARIF_PPH'] == '') { ?>
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                        <?php } else { ?>
                                        <?= $row['TARIF_PPH'] ?>
                                        <?php } ?>
                                    </td>
                                </tr>
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

<script type="text/javascript">
$(function() {
    $("#idBeaMasuk").change(function() {
        if ($(this).val() == "1") {
            $("#ForidBeaMasukLabel").hide();
        } else if ($(this).val() == "2") {
            $("#ForidBeaMasukLabel").show();
        } else {
            $("#ForidBeaMasukLabel").hide();
        }
    });

    $("#idCukai").change(function() {
        if ($(this).val() == "1") {
            $("#ForidCukaiLabel").hide();
            $("#ForidCukaiRp").hide();
        } else if ($(this).val() == "2") {
            $("#ForidCukaiLabel").show();
            $("#ForidCukaiRp").hide();
        } else if ($(this).val() == "3") {
            $("#ForidCukaiRp").show();
            $("#ForidCukaiLabel").hide();
        } else {
            $("#ForidCukaiLabel").hide();
            $("#ForidCukaiRp").hide();
        }
    });
});

// AUTOCOMPLATE
$(function() {
    $("#idBeaLabel").autocomplete({
        source: 'libraries/autocomplete/auto_referensi_satuan.php'
    });
});

$(function() {
    $("#idCukaiLabel").autocomplete({
        source: 'libraries/autocomplete/auto_referensi_satuan.php'
    });
});
</script>