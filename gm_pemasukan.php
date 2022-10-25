<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";

$AJU_PLB = '';
// API - 
include "include/api.php";

if (isset($_POST['add_'])) {
    $bm_no_aju_plb          = $_POST['bm_aju'];
    $bk_no_aju_sarinah      = $_POST['bk_aju'];
    $bm_tgl_masuk           = $_POST['bm_masuk'];
    $bm_nama_operator       = $_POST['bm_operator'];
    $bm_remarks             = $_POST['bm_remarks'];
    // File
    $filename = $_FILES['uploadBA']['name'];
    $tmpname = $_FILES['uploadBA']['tmp_name'];
    $sizename = $_FILES['uploadBA']['size'];
    $exp = explode('.', $filename);
    $ext = end($exp);
    $uniq_file =  "Berita-Acara-PLB" . '_' . time();
    $newname =  "Berita-Acara-PLB" . '_' . time() . "." . $ext;
    $config['upload_path'] = './files/BA/PLB/';
    $config['allowed_types'] = "jpg|jpeg|png|jfif|gif|pdf";
    $config['max_size'] = '2000000';
    $config['file_name'] = $newname;
    move_uploaded_file($tmpname, "files/BA/PLB/" . $newname);

    var_dump($newname);
    exit;

    $content = get_content($resultAPI['url_api'] . 'gmBarangMasukProses.php?function=PostADD&bm_no_aju_plb=' . $bm_no_aju_plb . '&bk_no_aju_sarinah=' . $bk_no_aju_sarinah . '&bm_tgl_masuk=' . $bm_tgl_masuk . '&bm_nama_operator=' . $bm_nama_operator . '&bm_remarks=' . $bm_remarks . '&newname=' . $newname);
    $data = json_decode($content, true);

    if ($data['status'] == 200) {
        echo "<script>window.location.href='gm_pemasukan_detail.php?AJU=$bm_no_aju_plb;</script>";
    } else {
        echo "<script>window.location.href='gm_pemasukan_detail.php?SaveFailed=true';</script>";
    }
}

// Find
if (isset($_POST['filter'])) {
    if ($_POST["AJU_PLB"] != '') {
        $AJU_PLB   = $_POST['AJU_PLB'];
    }
    $content = get_content($resultAPI['url_api'] . 'gmBarangMasuk.php?function=get_noAJU&AJU_PLB=' . $AJU_PLB);
    $data = json_decode($content, true);
}

if (isset($_POST['show_all'])) {
    $content = get_content($resultAPI['url_api'] . 'gmBarangMasuk.php?function=get_all');
    $data = json_decode($content, true);
}

// NOMOR PENGAJUAN GB
$contentAJUGB = get_content($resultAPI['url_api'] . 'nomor_AJU.php?function=get_AJU_GB');
$dataAJUGB = json_decode($contentAJUGB, true);
?>

<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-door-open icon-page"></i>
                <font class="text-page">Gate Mandiri</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Gate Mandiri</a></li>
                <li class="breadcrumb-item active">Barang Masuk</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <!-- Search AJU PLB -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Find Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" method="POST">

                        <div style="display: flex;justify-content: center;align-items: center;">
                            <div style="display: flex;justify-content: center;">
                                <img src="assets/img/svg/filter-animate.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="80%">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>CK5 PLB (Nomor Pengajuan)</label>
                                        <input type="text" id="IDAJU_PLB" name="AJU_PLB" class="form-control" placeholder="CK5 PLB (Nomor Pengajuan) ..." value="<?= $AJU_PLB; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" name="filter" class="btn btn-info m-r-5"><i class="fas fa-search"></i> Cari</button>
                                    <a href="gm_pemasukan.php" class="btn btn-warning m-r-5"><i class="fas fa-refresh"></i> Reset</a>
                                    <button type="submit" name="show_all" class="btn btn-default m-r-5"><i class="fas fa-calendar-check"></i> Tampilkan Semua</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search AJU PLB -->

    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title">[Gate Mandiri] Data Masuk Barang</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <?php if (isset($_POST['filter'])) { ?>
                        <div class="card text-white border-0 bg-blue text-center mb-2">
                            <div class="card-body">
                                <div>
                                    <h4>
                                        <i class="fas fa-search"></i> Hasil Pencarian.
                                    </h4>
                                    <hr>
                                    <div>
                                        <p class="mb-2">Nomor Pengajuan CK5 PLB: <?= $AJU_PLB; ?></p>
                                    </div>
                                </div>
                                <figcaption class="blockquote-footer mt-n2 mb-1 text-white text-opacity-75">
                                    Time <cite title="Source Title"> <?= date('H:m:i A'); ?></cite>
                                </figcaption>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_POST['show_all'])) { ?>
                        <div class="card text-white border-0 bg-blue text-center mb-2">
                            <div class="card-body">
                                <div>
                                    <h4>
                                        <i class="fas fa-info"></i> Hasil Pencarian
                                    </h4>
                                    <hr>
                                    <div>
                                        <p class="mb-2">Anda menampilkan semua data!</p>
                                    </div>
                                </div>
                                <figcaption class="blockquote-footer mt-n2 mb-1 text-white text-opacity-75">
                                    Time <cite title="Source Title"> <?= date('H:m:i A'); ?></cite>
                                </figcaption>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">No.</th>
                                    <th colspan="3" class="text-nowrap" style="text-align: center;">Nomor Pengajuan PLB</th>
                                    <th colspan="6" class="text-nowrap" style="text-align: center;">Jumlah Barang</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Asal PLB</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Kode Negara</th>
                                    <th rowspan="2" class="text-nowrap" style="text-align: center;">Aksi</th>
                                </tr>
                                <tr>
                                    <!-- Nomor Pengajuan PLB -->
                                    <th class="text-nowrap" style="text-align: center;">Nomor Pengajuan</th>
                                    <th class="text-nowrap" style="text-align: center;">Tanggal</th>
                                    <th class="text-nowrap" style="text-align: center;">Tanggal Submit/Upload CK5 PLB</th>
                                    <!-- Jumlah Barang -->
                                    <th class="text-nowrap" style="text-align: center;">Total Barang PLB</th>
                                    <th class="text-nowrap" style="text-align: center;">Barang "Sesuai"</th>
                                    <th class="text-nowrap" style="text-align: center;">Barang "Kurang"</th>
                                    <th class="text-nowrap" style="text-align: center;">Barang "Lebih"</th>
                                    <th class="text-nowrap" style="text-align: center;">Barang "Pecah"</th>
                                    <th class="text-nowrap" style="text-align: center;">Barang "Rusak"</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['status'] == 200) { ?>
                                    <?php $no = 0; ?>
                                    <?php foreach ($data['result'] as $row) { ?>
                                        <?php $no++ ?>
                                        <tr>
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center">
                                                <?php if ($row['NOMOR_AJU'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['NOMOR_AJU']; ?>
                                                <?php } ?>
                                            </td>
                                            <?php
                                            $dataTGLAJU = $row['TGL_AJU'];
                                            $dataTGLAJUY = substr($dataTGLAJU, 0, 4);
                                            $dataTGLAJUM = substr($dataTGLAJU, 4, 2);
                                            $dataTGLAJUD =  substr($dataTGLAJU, 6, 2);

                                            $datTGLAJU = $dataTGLAJUY . '-' . $dataTGLAJUM . '-' . $dataTGLAJUD;
                                            ?>
                                            <td style="text-align: center;">
                                                <div style="width: 85px;">
                                                    <i class="fas fa-calendar-alt"></i> <?= $datTGLAJU ?>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['ck5_plb_submit'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?php
                                                    $alldate = $row['ck5_plb_submit'];
                                                    $tgl = substr($alldate, 0, 10);
                                                    $time = substr($alldate, 10, 20);
                                                    ?>
                                                    <div style="display: grid;">
                                                        <font><i class="fa-solid fa-calendar-days"></i> <?= $tgl ?></font>
                                                        <font style="margin-left: -26px;"><i class="fa-solid fa-clock"></i> <?= $time ?></font>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <!-- Total Barang PLB -->
                                            <td style="text-align: center;">
                                                <?php if ($row['JUMLAH_BARANG'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    </center>
                                                <?php } else { ?>
                                                    <?= $row['JUMLAH_BARANG']; ?> Barang
                                                <?php } ?>
                                            </td>
                                            <!-- Total Barang "Sesuai" -->
                                            <td style="text-align: center;">
                                                <?php if ($row['total_Sesuai'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    </center>
                                                <?php } else { ?>
                                                    <span class="label label-success"><?= $row['total_Sesuai']; ?> Barang</span>
                                                <?php } ?>
                                            </td>
                                            <!-- Total Barang "Kurang" -->
                                            <td style="text-align: center;">
                                                <?php if ($row['total_Kurang'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    </center>
                                                <?php } else { ?>
                                                    <span class="label label-danger"><?= $row['total_Kurang']; ?> Barang</span>
                                                <?php } ?>
                                            </td>
                                            <!-- Total Barang "Lebih" -->
                                            <td style="text-align: center;">
                                                <?php if ($row['total_Lebih'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    </center>
                                                <?php } else { ?>
                                                    <span class="label label-lime"><?= $row['total_Lebih']; ?> Barang</span>
                                                <?php } ?>
                                            </td>
                                            <!-- Total Barang "Pecah" -->
                                            <td style="text-align: center;">
                                                <?php if ($row['total_Pecah'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    </center>
                                                <?php } else { ?>
                                                    <span class="label label-danger"><?= $row['total_Pecah']; ?> Barang</span>
                                                <?php } ?>
                                            </td>
                                            <!-- Total Barang "Rusak" -->
                                            <td style="text-align: center;">
                                                <?php if ($row['total_Rusak'] == NULL) { ?>
                                                    <center>
                                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                    </center>
                                                <?php } else { ?>
                                                    <span class="label label-warning"><?= $row['total_Rusak']; ?> Barang</span>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['PERUSAHAAN'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['PERUSAHAAN']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($row['KODE_NEGARA_PEMASOK'] == NULL) { ?>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                                    </font>
                                                <?php } else { ?>
                                                    <?= $row['KODE_NEGARA_PEMASOK']; ?>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <div style="display: flex;justify-content: center;align-items: center;width: 300px;">
                                                    <?php if ($row['JUMLAH_BARANG'] == $row['total_All']) { ?>
                                                        <div>
                                                            <a href="#!" class="btn btn-success" target="_blank">
                                                                <font data-toggle="popover" data-trigger="hover" data-title="Barang Masuk Total: <?= $row['JUMLAH_BARANG']; ?> Barang! - Barang diCek: <?= $row['total_All']; ?> Barang!" data-placement="top" data-content="Anda sudah melakukan pengecekan Barang Masuk!">
                                                                    <i class="fas fa-check-circle"></i> Barang Masuk Sudah diCek!
                                                                </font>
                                                            </a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div>
                                                            <a href="gm_pemasukan_detail.php?AJU=<?= $row['NOMOR_AJU'] ?>" class="btn btn-yellow" target="_blank">
                                                                <font data-toggle="popover" data-trigger="hover" data-title="Cek Barang Masuk Total: <?= $row['JUMLAH_BARANG']; ?> Barang!" data-placement="top" data-content="Klik untuk melakukan pengecekan Barang Masuk.">
                                                                    <i class="fas fa-warning"></i> Cek Barang Masuk
                                                                </font>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                    <div style="margin-left: 10px;">
                                                        <a href="#add<?= $row['ID'] ?>" class="btn btn-primary" data-toggle="modal" title="Add"><i class="fas fa-plus-circle"></i> Add</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="add<?= $row['ID'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Add] Data Barang Masuk</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="row">
                                                                    <!-- Barang Masuk -->
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>PLB</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan PLB</label>
                                                                                    <input type="number" name="bm_aju" class="form-control" placeholder="Nomor Pengajuan PLB ..." value="<?= $row['NOMOR_AJU']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan GB <small style="color:red">*</small></label>
                                                                                    <select name="bk_aju" class="default-select2 form-control" required>
                                                                                        <option value="">-- Nomor Pengajuan GB --</option>
                                                                                        <?php foreach ($dataAJUGB['result'] as $rowAJUGB) { ?>
                                                                                            <option value="<?= $rowAJUGB['NOMOR_AJU']; ?>"><?= $rowAJUGB['NOMOR_AJU']; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Masuk</label>
                                                                                    <input type="date" name="bm_masuk" class="form-control" placeholder="Tanggal Masuk ...">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Petugas</label>
                                                                                    <input type="text" name="bm_operator" class="form-control" placeholder="Nama Operator ..." value="<?= $_SESSION['username']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Remarks Barang Masuk</label>
                                                                                    <textarea name="bm_remarks" class="form-control" placeholder="Remarks Barang Masuk ..."></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Upload Berita Acara</label>
                                                                                    <input type="file" name="uploadBA" class="form-control" placeholder="Upload Berita Acara ...">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <small style="color: red"><i>(*) Harus diisi</i></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Barang Masuk -->
                                                                    <!-- Barang Keluar -->
                                                                    <!-- <div class="col-6">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <h4>Sarinah</h4>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Pengajuan GB</label>
                                                                                    <input type="number" name="bk_aju" class="form-control" placeholder="Nomor Pengajuan GB ...">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Tanggal Masuk</label>
                                                                                    <input type="date" name="bk_masuk" class="form-control" placeholder="Tanggal Keluar ...">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Petugas</label>
                                                                                    <input type="text" name="bk_operator" class="form-control" placeholder="Nama Operator ...">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Remarks Barang Keluar</label>
                                                                                    <textarea name="bk_remarks" class="form-control" placeholder="Remarks Barang Keluar ..."></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->
                                                                    <!-- End Barang Keluar -->
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                                            <button type="submit" name="add_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="13">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
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
<?php include "include/jsForm.php"; ?>
<script type="text/javascript">
    $(".default-select2").select2();
    $(function() {
        $("#IDAJU_PLB").autocomplete({
            source: 'function/autocomplete/nomor_aju_plb.php'
        });
    });
    $(document).ready(function() {
        $('#TableData').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>