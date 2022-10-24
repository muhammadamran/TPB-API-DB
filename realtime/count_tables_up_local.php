<?php 
include "../api/restapi.php";
include "../include/connection.php";
?>
<div class="card border-0 bg-dark text-white text-truncate mb-3">
    <div class="card-body">
        <div class="mb-3 text-grey">
            <b class="mb-3">COUNT RECORD CHECK</b> 
            <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="COUNT RECORD CHECK" data-placement="top" data-content="Record perbandingan." data-original-title="" title=""></i></span>
        </div>
        <div class="align-items-center mb-1">
            <div style="display: flex;justify-content: space-between;align-items: center;">
                <?php
                $data_jumlah_table = $dbcon->query("SELECT view_tables FROM view_all_tables");
                $djt_query = mysqli_fetch_array($data_jumlah_table);
                ?>
                <div>
                    <h2 class="text-white mb-0"><span data-animation="number" data-value="<?= $djt_query['view_tables'] ?>"><?= $djt_query['view_tables'] ?></span> Tables</h2>
                </div>
                <?php if ($djt_query['view_tables'] == $data_total_tables['result']) { ?>
                    <div style="color: green;">
                        Domian <i class="fas fa-check-circle"></i> Local
                    </div>
                <?php } else { ?>
                    <div style="color: red;">
                        Domian <i class="fas fa-ban"></i> Local
                    </div>
                <?php } ?>
                <div>
                    <h2 class="text-white mb-0"><span data-animation="number" data-value="<?= $data_total_tables['result']; ?>"><?= $data_total_tables['result']; ?></span> Tables</h2>
                </div>
            </div>
            <div class="ml-auto">
                <div id="conversion-rate-sparkline"></div>
            </div>
        </div>
        <hr>
        <!-- aktivasi_aplikasi -->
        <?php
        $cekData_aktivasi_aplikasi = $dbcon->query("SELECT COUNT(*) AS total_aktivasi_aplikasi FROM aktivasi_aplikasi");
        $resultCek_aktivasi_aplikasi = mysqli_fetch_array($cekData_aktivasi_aplikasi);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                aktivasi_aplikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_aktivasi_aplikasi['total_aktivasi_aplikasi'] == $data_aktivasi_aplikasi['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- hasil_validasi_barang -->
        <?php
        $cekData_hasil_validasi_barang = $dbcon->query("SELECT COUNT(*) AS total_hasil_validasi_barang FROM hasil_validasi_barang");
        $resultCek_hasil_validasi_barang = mysqli_fetch_array($cekData_hasil_validasi_barang);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                hasil_validasi_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_hasil_validasi_barang['total_hasil_validasi_barang'] == $data_hasil_validasi_barang['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- hasil_validasi_header -->
        <?php
        $cekData_hasil_validasi_header = $dbcon->query("SELECT COUNT(*) AS total_hasil_validasi_header FROM hasil_validasi_header");
        $resultCek_hasil_validasi_header = mysqli_fetch_array($cekData_hasil_validasi_header);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                hasil_validasi_header
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_hasil_validasi_header['total_hasil_validasi_header'] == $data_hasil_validasi_header['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_asal_barang -->
        <?php
        $cekData_referensi_asal_barang = $dbcon->query("SELECT COUNT(*) AS total_referensi_asal_barang FROM referensi_asal_barang");
        $resultCek_referensi_asal_barang = mysqli_fetch_array($cekData_referensi_asal_barang);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_asal_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_asal_barang['total_referensi_asal_barang'] == $data_referensi_asal_barang['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_asal_data -->
        <?php
        $cekData_referensi_asal_data = $dbcon->query("SELECT COUNT(*) AS total_referensi_asal_data FROM referensi_asal_data");
        $resultCek_referensi_asal_data = mysqli_fetch_array($cekData_referensi_asal_data);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_asal_data
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_asal_data['total_referensi_asal_data'] == $data_referensi_asal_data['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_asuransi -->
        <?php
        $cekData_referensi_asuransi = $dbcon->query("SELECT COUNT(*) AS total_referensi_asuransi FROM referensi_asuransi");
        $resultCek_referensi_asuransi = mysqli_fetch_array($cekData_referensi_asuransi);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_asuransi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_asuransi['total_referensi_asuransi'] == $data_referensi_asuransi['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_cara_angkut -->
        <?php
        $cekData_referensi_cara_angkut = $dbcon->query("SELECT COUNT(*) AS total_referensi_cara_angkut FROM referensi_cara_angkut");
        $resultCek_referensi_cara_angkut = mysqli_fetch_array($cekData_referensi_cara_angkut);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_cara_angkut
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_cara_angkut['total_referensi_cara_angkut'] == $data_referensi_cara_angkut['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_cara_bayar -->
        <?php
        $cekData_referensi_cara_bayar = $dbcon->query("SELECT COUNT(*) AS total_referensi_cara_bayar FROM referensi_cara_bayar");
        $resultCek_referensi_cara_bayar = mysqli_fetch_array($cekData_referensi_cara_bayar);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_cara_bayar
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_cara_bayar['total_referensi_cara_bayar'] == $data_referensi_cara_bayar['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_daerah -->
        <?php
        $cekData_referensi_daerah = $dbcon->query("SELECT COUNT(*) AS total_referensi_daerah FROM referensi_daerah");
        $resultCek_referensi_daerah = mysqli_fetch_array($cekData_referensi_daerah);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_daerah
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_daerah['total_referensi_daerah'] == $data_referensi_daerah['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_dokumen -->
        <?php
        $cekData_referensi_dokumen = $dbcon->query("SELECT COUNT(*) AS total_referensi_dokumen FROM referensi_dokumen");
        $resultCek_referensi_dokumen = mysqli_fetch_array($cekData_referensi_dokumen);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_dokumen['total_referensi_dokumen'] == $data_referensi_dokumen['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_dokumen_pabean -->
        <?php
        $cekData_referensi_dokumen_pabean = $dbcon->query("SELECT COUNT(*) AS total_referensi_dokumen_pabean FROM referensi_dokumen_pabean");
        $resultCek_referensi_dokumen_pabean = mysqli_fetch_array($cekData_referensi_dokumen_pabean);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_dokumen_pabean
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_dokumen_pabean['total_referensi_dokumen_pabean'] == $data_referensi_dokumen_pabean['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_fasilitas -->
        <?php
        $cekData_referensi_fasilitas = $dbcon->query("SELECT COUNT(*) AS total_referensi_fasilitas FROM referensi_fasilitas");
        $resultCek_referensi_fasilitas = mysqli_fetch_array($cekData_referensi_fasilitas);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_fasilitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_fasilitas['total_referensi_fasilitas'] == $data_referensi_fasilitas['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_filter_komunikasi -->
        <?php
        $cekData_referensi_filter_komunikasi = $dbcon->query("SELECT COUNT(*) AS total_referensi_filter_komunikasi FROM referensi_filter_komunikasi");
        $resultCek_referensi_filter_komunikasi = mysqli_fetch_array($cekData_referensi_filter_komunikasi);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_filter_komunikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_filter_komunikasi['total_referensi_filter_komunikasi'] == $data_referensi_filter_komunikasi['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_harga -->
        <?php
        $cekData_referensi_harga = $dbcon->query("SELECT COUNT(*) AS total_referensi_harga FROM referensi_harga");
        $resultCek_referensi_harga = mysqli_fetch_array($cekData_referensi_harga);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_harga
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_harga['total_referensi_harga'] == $data_referensi_harga['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_identitas -->
        <?php
        $cekData_referensi_identitas = $dbcon->query("SELECT COUNT(*) AS total_referensi_identitas FROM referensi_identitas");
        $resultCek_referensi_identitas = mysqli_fetch_array($cekData_referensi_identitas);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_identitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_identitas['total_referensi_identitas'] == $data_referensi_identitas['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_jenis_api -->
        <?php
        $cekData_referensi_jenis_api = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_api FROM referensi_jenis_api");
        $resultCek_referensi_jenis_api = mysqli_fetch_array($cekData_referensi_jenis_api);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_api
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_jenis_api['total_referensi_jenis_api'] == $data_referensi_jenis_api['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_jenis_bc25 -->
        <?php
        $cekData_referensi_jenis_bc25 = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_bc25 FROM referensi_jenis_bc25");
        $resultCek_referensi_jenis_bc25 = mysqli_fetch_array($cekData_referensi_jenis_bc25);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_bc25
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_jenis_bc25['total_referensi_jenis_bc25'] == $data_referensi_jenis_bc25['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_jenis_jaminan -->
        <?php
        $cekData_referensi_jenis_jaminan = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_jaminan FROM referensi_jenis_jaminan");
        $resultCek_referensi_jenis_jaminan = mysqli_fetch_array($cekData_referensi_jenis_jaminan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_jaminan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_jenis_jaminan['total_referensi_jenis_jaminan'] == $data_referensi_jenis_jaminan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_jenis_kendaraan -->
        <?php
        $cekData_referensi_jenis_kendaraan = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_kendaraan FROM referensi_jenis_kendaraan");
        $resultCek_referensi_jenis_kendaraan = mysqli_fetch_array($cekData_referensi_jenis_kendaraan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_kendaraan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_jenis_kendaraan['total_referensi_jenis_kendaraan'] == $data_referensi_jenis_kendaraan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_jenis_nilai -->
        <?php
        $cekData_referensi_jenis_nilai = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_nilai FROM referensi_jenis_nilai");
        $resultCek_referensi_jenis_nilai = mysqli_fetch_array($cekData_referensi_jenis_nilai);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_nilai
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_jenis_nilai['total_referensi_jenis_nilai'] == $data_referensi_jenis_nilai['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_jenis_pemasukan01 -->
        <?php
        $cekData_referensi_jenis_pemasukan01 = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_pemasukan01 FROM referensi_jenis_pemasukan01");
        $resultCek_referensi_jenis_pemasukan01 = mysqli_fetch_array($cekData_referensi_jenis_pemasukan01);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_pemasukan01
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_jenis_pemasukan01['total_referensi_jenis_pemasukan01'] == $data_referensi_jenis_pemasukan01['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_jenis_pemasukan02 -->
        <?php
        $cekData_referensi_jenis_pemasukan02 = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_pemasukan02 FROM referensi_jenis_pemasukan02");
        $resultCek_referensi_jenis_pemasukan02 = mysqli_fetch_array($cekData_referensi_jenis_pemasukan02);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_pemasukan02
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_jenis_pemasukan02['total_referensi_jenis_pemasukan02'] == $data_referensi_jenis_pemasukan02['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_jenis_tanda_pengaman -->
        <?php
        $cekData_referensi_jenis_tanda_pengaman = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_tanda_pengaman FROM referensi_jenis_tanda_pengaman");
        $resultCek_referensi_jenis_tanda_pengaman = mysqli_fetch_array($cekData_referensi_jenis_tanda_pengaman);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_tanda_pengaman
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_jenis_tanda_pengaman['total_referensi_jenis_tanda_pengaman'] == $data_referensi_jenis_tanda_pengaman['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_jenis_tarif -->
        <?php
        $cekData_referensi_jenis_tarif = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_tarif FROM referensi_jenis_tarif");
        $resultCek_referensi_jenis_tarif = mysqli_fetch_array($cekData_referensi_jenis_tarif);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_jenis_tarif['total_referensi_jenis_tarif'] == $data_referensi_jenis_tarif['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_jenis_tpb -->
        <?php
        $cekData_referensi_jenis_tpb = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_tpb FROM referensi_jenis_tpb");
        $resultCek_referensi_jenis_tpb = mysqli_fetch_array($cekData_referensi_jenis_tpb);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_tpb
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_jenis_tpb['total_referensi_jenis_tpb'] == $data_referensi_jenis_tpb['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_kantor_pabean -->
        <?php
        $cekData_referensi_kantor_pabean = $dbcon->query("SELECT COUNT(*) AS total_referensi_kantor_pabean FROM referensi_kantor_pabean");
        $resultCek_referensi_kantor_pabean = mysqli_fetch_array($cekData_referensi_kantor_pabean);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kantor_pabean
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_kantor_pabean['total_referensi_kantor_pabean'] == $data_referensi_kantor_pabean['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_kapal -->
        <?php
        $cekData_referensi_kapal = $dbcon->query("SELECT COUNT(*) AS total_referensi_kapal FROM referensi_kapal");
        $resultCek_referensi_kapal = mysqli_fetch_array($cekData_referensi_kapal);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kapal
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_kapal['total_referensi_kapal'] == $data_referensi_kapal['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_kategori_barang -->
        <?php
        $cekData_referensi_kategori_barang = $dbcon->query("SELECT COUNT(*) AS total_referensi_kategori_barang FROM referensi_kategori_barang");
        $resultCek_referensi_kategori_barang = mysqli_fetch_array($cekData_referensi_kategori_barang);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kategori_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_kategori_barang['total_referensi_kategori_barang'] == $data_referensi_kategori_barang['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_kategori_barangbc25 -->
        <?php
        $cekData_referensi_kategori_barangbc25 = $dbcon->query("SELECT COUNT(*) AS total_referensi_kategori_barangbc25 FROM referensi_kategori_barangbc25");
        $resultCek_referensi_kategori_barangbc25 = mysqli_fetch_array($cekData_referensi_kategori_barangbc25);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kategori_barangbc25
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_kategori_barangbc25['total_referensi_kategori_barangbc25'] == $data_referensi_kategori_barangbc25['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_kemasan -->
        <?php
        $cekData_referensi_kemasan = $dbcon->query("SELECT COUNT(*) AS total_referensi_kemasan FROM referensi_kemasan");
        $resultCek_referensi_kemasan = mysqli_fetch_array($cekData_referensi_kemasan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kemasan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_kemasan['total_referensi_kemasan'] == $data_referensi_kemasan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_kode_barang -->
        <?php
        $cekData_referensi_kode_barang = $dbcon->query("SELECT COUNT(*) AS total_referensi_kode_barang FROM referensi_kode_barang");
        $resultCek_referensi_kode_barang = mysqli_fetch_array($cekData_referensi_kode_barang);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kode_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_kode_barang['total_referensi_kode_barang'] == $data_referensi_kode_barang['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_kode_guna -->
        <?php
        $cekData_referensi_kode_guna = $dbcon->query("SELECT COUNT(*) AS total_referensi_kode_guna FROM referensi_kode_guna");
        $resultCek_referensi_kode_guna = mysqli_fetch_array($cekData_referensi_kode_guna);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kode_guna
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_kode_guna['total_referensi_kode_guna'] == $data_referensi_kode_guna['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_kode_id -->
        <?php
        $cekData_referensi_kode_id = $dbcon->query("SELECT COUNT(*) AS total_referensi_kode_id FROM referensi_kode_id");
        $resultCek_referensi_kode_id = mysqli_fetch_array($cekData_referensi_kode_id);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kode_id
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_kode_id['total_referensi_kode_id'] == $data_referensi_kode_id['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_komoditi -->
        <?php
        $cekData_referensi_komoditi = $dbcon->query("SELECT COUNT(*) AS total_referensi_komoditi FROM referensi_komoditi");
        $resultCek_referensi_komoditi = mysqli_fetch_array($cekData_referensi_komoditi);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_komoditi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_komoditi['total_referensi_komoditi'] == $data_referensi_komoditi['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_kondisi_barang -->
        <?php
        $cekData_referensi_kondisi_barang = $dbcon->query("SELECT COUNT(*) AS total_referensi_kondisi_barang FROM referensi_kondisi_barang");
        $resultCek_referensi_kondisi_barang = mysqli_fetch_array($cekData_referensi_kondisi_barang);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kondisi_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_kondisi_barang['total_referensi_kondisi_barang'] == $data_referensi_kondisi_barang['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_lokasi_bayar -->
        <?php
        $cekData_referensi_lokasi_bayar = $dbcon->query("SELECT COUNT(*) AS total_referensi_lokasi_bayar FROM referensi_lokasi_bayar");
        $resultCek_referensi_lokasi_bayar = mysqli_fetch_array($cekData_referensi_lokasi_bayar);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_lokasi_bayar
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_lokasi_bayar['total_referensi_lokasi_bayar'] == $data_referensi_lokasi_bayar['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_mata_uang -->
        <?php
        $cekData_referensi_mata_uang = $dbcon->query("SELECT COUNT(*) AS total_referensi_mata_uang FROM referensi_mata_uang");
        $resultCek_referensi_mata_uang = mysqli_fetch_array($cekData_referensi_mata_uang);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_mata_uang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_mata_uang['total_referensi_mata_uang'] == $data_referensi_mata_uang['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_negara -->
        <?php
        $cekData_referensi_negara = $dbcon->query("SELECT COUNT(*) AS total_referensi_negara FROM referensi_negara");
        $resultCek_referensi_negara = mysqli_fetch_array($cekData_referensi_negara);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_negara
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_negara['total_referensi_negara'] == $data_referensi_negara['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_npwp_billing -->
        <?php
        $cekData_referensi_npwp_billing = $dbcon->query("SELECT COUNT(*) AS total_referensi_npwp_billing FROM referensi_npwp_billing");
        $resultCek_referensi_npwp_billing = mysqli_fetch_array($cekData_referensi_npwp_billing);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_npwp_billing
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_npwp_billing['total_referensi_npwp_billing'] == $data_referensi_npwp_billing['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_pelabuhan -->
        <?php
        $cekData_referensi_pelabuhan = $dbcon->query("SELECT COUNT(*) AS total_referensi_pelabuhan FROM referensi_pelabuhan");
        $resultCek_referensi_pelabuhan = mysqli_fetch_array($cekData_referensi_pelabuhan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pelabuhan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_pelabuhan['total_referensi_pelabuhan'] == $data_referensi_pelabuhan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_pemasok -->
        <?php
        $cekData_referensi_pemasok = $dbcon->query("SELECT COUNT(*) AS total_referensi_pemasok FROM referensi_pemasok");
        $resultCek_referensi_pemasok = mysqli_fetch_array($cekData_referensi_pemasok);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pemasok
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_pemasok['total_referensi_pemasok'] == $data_referensi_pemasok['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_pembayar -->
        <?php
        $cekData_referensi_pembayar = $dbcon->query("SELECT COUNT(*) AS total_referensi_pembayar FROM referensi_pembayar");
        $resultCek_referensi_pembayar = mysqli_fetch_array($cekData_referensi_pembayar);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pembayar
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_pembayar['total_referensi_pembayar'] == $data_referensi_pembayar['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_pengusaha -->
        <?php
        $cekData_referensi_pengusaha = $dbcon->query("SELECT COUNT(*) AS total_referensi_pengusaha FROM referensi_pengusaha");
        $resultCek_referensi_pengusaha = mysqli_fetch_array($cekData_referensi_pengusaha);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pengusaha
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_pengusaha['total_referensi_pengusaha'] == $data_referensi_pengusaha['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_pilihan_komunikasi -->
        <?php
        $cekData_referensi_pilihan_komunikasi = $dbcon->query("SELECT COUNT(*) AS total_referensi_pilihan_komunikasi FROM referensi_pilihan_komunikasi");
        $resultCek_referensi_pilihan_komunikasi = mysqli_fetch_array($cekData_referensi_pilihan_komunikasi);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pilihan_komunikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_pilihan_komunikasi['total_referensi_pilihan_komunikasi'] == $data_referensi_pilihan_komunikasi['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_pos_tarif -->
        <?php
        $cekData_referensi_pos_tarif = $dbcon->query("SELECT COUNT(*) AS total_referensi_pos_tarif FROM referensi_pos_tarif");
        $resultCek_referensi_pos_tarif = mysqli_fetch_array($cekData_referensi_pos_tarif);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pos_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_pos_tarif['total_referensi_pos_tarif'] == $data_referensi_pos_tarif['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_ppjk -->
        <?php
        $cekData_referensi_ppjk = $dbcon->query("SELECT COUNT(*) AS total_referensi_ppjk FROM referensi_ppjk");
        $resultCek_referensi_ppjk = mysqli_fetch_array($cekData_referensi_ppjk);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_ppjk
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_ppjk['total_referensi_ppjk'] == $data_referensi_ppjk['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_pungutan -->
        <?php
        $cekData_referensi_pungutan = $dbcon->query("SELECT COUNT(*) AS total_referensi_pungutan FROM referensi_pungutan");
        $resultCek_referensi_pungutan = mysqli_fetch_array($cekData_referensi_pungutan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pungutan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_pungutan['total_referensi_pungutan'] == $data_referensi_pungutan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_refeteks -->
        <?php
        $cekData_referensi_refeteks = $dbcon->query("SELECT COUNT(*) AS total_referensi_refeteks FROM referensi_refeteks");
        $resultCek_referensi_refeteks = mysqli_fetch_array($cekData_referensi_refeteks);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_refeteks
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_refeteks['total_referensi_refeteks'] == $data_referensi_refeteks['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_respon -->
        <?php
        $cekData_referensi_respon = $dbcon->query("SELECT COUNT(*) AS total_referensi_respon FROM referensi_respon");
        $resultCek_referensi_respon = mysqli_fetch_array($cekData_referensi_respon);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_respon
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_respon['total_referensi_respon'] == $data_referensi_respon['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_satuan -->
        <?php
        $cekData_referensi_satuan = $dbcon->query("SELECT COUNT(*) AS total_referensi_satuan FROM referensi_satuan");
        $resultCek_referensi_satuan = mysqli_fetch_array($cekData_referensi_satuan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_satuan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_satuan['total_referensi_satuan'] == $data_referensi_satuan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_skema_tarif -->
        <?php
        $cekData_referensi_skema_tarif = $dbcon->query("SELECT COUNT(*) AS total_referensi_skema_tarif FROM referensi_skema_tarif");
        $resultCek_referensi_skema_tarif = mysqli_fetch_array($cekData_referensi_skema_tarif);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_skema_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_skema_tarif['total_referensi_skema_tarif'] == $data_referensi_skema_tarif['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_status -->
        <?php
        $cekData_referensi_status = $dbcon->query("SELECT COUNT(*) AS total_referensi_status FROM referensi_status");
        $resultCek_referensi_status = mysqli_fetch_array($cekData_referensi_status);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_status
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_status['total_referensi_status'] == $data_referensi_status['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_status_pengusaha -->
        <?php
        $cekData_referensi_status_pengusaha = $dbcon->query("SELECT COUNT(*) AS total_referensi_status_pengusaha FROM referensi_status_pengusaha");
        $resultCek_referensi_status_pengusaha = mysqli_fetch_array($cekData_referensi_status_pengusaha);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_status_pengusaha
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_status_pengusaha['total_referensi_status_pengusaha'] == $data_referensi_status_pengusaha['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_tarif_fasilitas -->
        <?php
        $cekData_referensi_tarif_fasilitas = $dbcon->query("SELECT COUNT(*) AS total_referensi_tarif_fasilitas FROM referensi_tarif_fasilitas");
        $resultCek_referensi_tarif_fasilitas = mysqli_fetch_array($cekData_referensi_tarif_fasilitas);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tarif_fasilitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_tarif_fasilitas['total_referensi_tarif_fasilitas'] == $data_referensi_tarif_fasilitas['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_tipe_kontainer -->
        <?php
        $cekData_referensi_tipe_kontainer = $dbcon->query("SELECT COUNT(*) AS total_referensi_tipe_kontainer FROM referensi_tipe_kontainer");
        $resultCek_referensi_tipe_kontainer = mysqli_fetch_array($cekData_referensi_tipe_kontainer);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tipe_kontainer
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_tipe_kontainer['total_referensi_tipe_kontainer'] == $data_referensi_tipe_kontainer['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_tps -->
        <?php
        $cekData_referensi_tps = $dbcon->query("SELECT COUNT(*) AS total_referensi_tps FROM referensi_tps");
        $resultCek_referensi_tps = mysqli_fetch_array($cekData_referensi_tps);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tps
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_tps['total_referensi_tps'] == $data_referensi_tps['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_tujuan_pemasukan -->
        <?php
        $cekData_referensi_tujuan_pemasukan = $dbcon->query("SELECT COUNT(*) AS total_referensi_tujuan_pemasukan FROM referensi_tujuan_pemasukan");
        $resultCek_referensi_tujuan_pemasukan = mysqli_fetch_array($cekData_referensi_tujuan_pemasukan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tujuan_pemasukan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_tujuan_pemasukan['total_referensi_tujuan_pemasukan'] == $data_referensi_tujuan_pemasukan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_tujuan_pengiriman -->
        <?php
        $cekData_referensi_tujuan_pengiriman = $dbcon->query("SELECT COUNT(*) AS total_referensi_tujuan_pengiriman FROM referensi_tujuan_pengiriman");
        $resultCek_referensi_tujuan_pengiriman = mysqli_fetch_array($cekData_referensi_tujuan_pengiriman);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tujuan_pengiriman
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_tujuan_pengiriman['total_referensi_tujuan_pengiriman'] == $data_referensi_tujuan_pengiriman['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_tujuan_tpb -->
        <?php
        $cekData_referensi_tujuan_tpb = $dbcon->query("SELECT COUNT(*) AS total_referensi_tujuan_tpb FROM referensi_tujuan_tpb");
        $resultCek_referensi_tujuan_tpb = mysqli_fetch_array($cekData_referensi_tujuan_tpb);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tujuan_tpb
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_tujuan_tpb['total_referensi_tujuan_tpb'] == $data_referensi_tujuan_tpb['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_tutup_pu -->
        <?php
        $cekData_referensi_tutup_pu = $dbcon->query("SELECT COUNT(*) AS total_referensi_tutup_pu FROM referensi_tutup_pu");
        $resultCek_referensi_tutup_pu = mysqli_fetch_array($cekData_referensi_tutup_pu);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tutup_pu
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_tutup_pu['total_referensi_tutup_pu'] == $data_referensi_tutup_pu['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_ukuran_kontainer -->
        <?php
        $cekData_referensi_ukuran_kontainer = $dbcon->query("SELECT COUNT(*) AS total_referensi_ukuran_kontainer FROM referensi_ukuran_kontainer");
        $resultCek_referensi_ukuran_kontainer = mysqli_fetch_array($cekData_referensi_ukuran_kontainer);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_ukuran_kontainer
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_ukuran_kontainer['total_referensi_ukuran_kontainer'] == $data_referensi_ukuran_kontainer['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_validasi -->
        <?php
        $cekData_referensi_validasi = $dbcon->query("SELECT COUNT(*) AS total_referensi_validasi FROM referensi_validasi");
        $resultCek_referensi_validasi = mysqli_fetch_array($cekData_referensi_validasi);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_validasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_validasi['total_referensi_validasi'] == $data_referensi_validasi['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_validasi_jenis_nilai -->
        <?php
        $cekData_referensi_validasi_jenis_nilai = $dbcon->query("SELECT COUNT(*) AS total_referensi_validasi_jenis_nilai FROM referensi_validasi_jenis_nilai");
        $resultCek_referensi_validasi_jenis_nilai = mysqli_fetch_array($cekData_referensi_validasi_jenis_nilai);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_validasi_jenis_nilai
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_validasi_jenis_nilai['total_referensi_validasi_jenis_nilai'] == $data_referensi_validasi_jenis_nilai['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- referensi_valuta -->
        <?php
        $cekData_referensi_valuta = $dbcon->query("SELECT COUNT(*) AS total_referensi_valuta FROM referensi_valuta");
        $resultCek_referensi_valuta = mysqli_fetch_array($cekData_referensi_valuta);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_valuta
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_referensi_valuta['total_referensi_valuta'] == $data_referensi_valuta['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- setting_aplikasi -->
        <?php
        $cekData_setting_aplikasi = $dbcon->query("SELECT COUNT(*) AS total_setting_aplikasi FROM setting_aplikasi");
        $resultCek_setting_aplikasi = mysqli_fetch_array($cekData_setting_aplikasi);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                setting_aplikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_setting_aplikasi['total_setting_aplikasi'] == $data_setting_aplikasi['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_aktifitas -->
        <?php
        $cekData_tbl_aktifitas = $dbcon->query("SELECT COUNT(*) AS total_tbl_aktifitas FROM tbl_aktifitas");
        $resultCek_tbl_aktifitas = mysqli_fetch_array($cekData_tbl_aktifitas);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_aktifitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_aktifitas['total_tbl_aktifitas'] == $data_tbl_aktifitas['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_department -->
        <?php
        $cekData_tbl_department = $dbcon->query("SELECT COUNT(*) AS total_tbl_department FROM tbl_department");
        $resultCek_tbl_department = mysqli_fetch_array($cekData_tbl_department);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_department
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_department['total_tbl_department'] == $data_tbl_department['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_faq -->
        <?php
        $cekData_tbl_faq = $dbcon->query("SELECT COUNT(*) AS total_tbl_faq FROM tbl_faq");
        $resultCek_tbl_faq = mysqli_fetch_array($cekData_tbl_faq);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_faq
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_faq['total_tbl_faq'] == $data_tbl_faq['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_informasi -->
        <?php
        $cekData_tbl_informasi = $dbcon->query("SELECT COUNT(*) AS total_tbl_informasi FROM tbl_informasi");
        $resultCek_tbl_informasi = mysqli_fetch_array($cekData_tbl_informasi);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_informasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_informasi['total_tbl_informasi'] == $data_tbl_informasi['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_jabatan -->
        <?php
        $cekData_tbl_jabatan = $dbcon->query("SELECT COUNT(*) AS total_tbl_jabatan FROM tbl_jabatan");
        $resultCek_tbl_jabatan = mysqli_fetch_array($cekData_tbl_jabatan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_jabatan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_jabatan['total_tbl_jabatan'] == $data_tbl_jabatan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_log -->
        <?php
        $cekData_tbl_log = $dbcon->query("SELECT COUNT(*) AS total_tbl_log FROM tbl_log");
        $resultCek_tbl_log = mysqli_fetch_array($cekData_tbl_log);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_log
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_log['total_tbl_log'] == $data_tbl_log['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_pegawai -->
        <?php
        $cekData_tbl_pegawai = $dbcon->query("SELECT COUNT(*) AS total_tbl_pegawai FROM tbl_pegawai");
        $resultCek_tbl_pegawai = mysqli_fetch_array($cekData_tbl_pegawai);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_pegawai
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_pegawai['total_tbl_pegawai'] == $data_tbl_pegawai['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_realtime -->
        <?php
        $cekData_tbl_realtime = $dbcon->query("SELECT COUNT(*) AS total_tbl_realtime FROM tbl_realtime");
        $resultCek_tbl_realtime = mysqli_fetch_array($cekData_tbl_realtime);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_realtime
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_realtime['total_tbl_realtime'] == $data_tbl_realtime['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_role -->
        <?php
        $cekData_tbl_role = $dbcon->query("SELECT COUNT(*) AS total_tbl_role FROM tbl_role");
        $resultCek_tbl_role = mysqli_fetch_array($cekData_tbl_role);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_role
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_role['total_tbl_role'] == $data_tbl_role['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_setting -->
        <?php
        $cekData_tbl_setting = $dbcon->query("SELECT COUNT(*) AS total_tbl_setting FROM tbl_setting");
        $resultCek_tbl_setting = mysqli_fetch_array($cekData_tbl_setting);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_setting
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_setting['total_tbl_setting'] == $data_tbl_setting['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tbl_users -->
        <?php
        $cekData_tbl_users = $dbcon->query("SELECT COUNT(*) AS total_tbl_users FROM tbl_users");
        $resultCek_tbl_users = mysqli_fetch_array($cekData_tbl_users);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_users
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tbl_users['total_tbl_users'] == $data_tbl_users['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_bahan_baku -->
        <?php
        $cekData_tpb_bahan_baku = $dbcon->query("SELECT COUNT(*) AS total_tpb_bahan_baku FROM tpb_bahan_baku");
        $resultCek_tpb_bahan_baku = mysqli_fetch_array($cekData_tpb_bahan_baku);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_bahan_baku
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_bahan_baku['total_tpb_bahan_baku'] == $data_tpb_bahan_baku['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_bahan_baku_dokumen -->
        <?php
        $cekData_tpb_bahan_baku_dokumen = $dbcon->query("SELECT COUNT(*) AS total_tpb_bahan_baku_dokumen FROM tpb_bahan_baku_dokumen");
        $resultCek_tpb_bahan_baku_dokumen = mysqli_fetch_array($cekData_tpb_bahan_baku_dokumen);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_bahan_baku_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_bahan_baku_dokumen['total_tpb_bahan_baku_dokumen'] == $data_tpb_bahan_baku_dokumen['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_bahan_baku_tarif -->
        <?php
        $cekData_tpb_bahan_baku_tarif = $dbcon->query("SELECT COUNT(*) AS total_tpb_bahan_baku_tarif FROM tpb_bahan_baku_tarif");
        $resultCek_tpb_bahan_baku_tarif = mysqli_fetch_array($cekData_tpb_bahan_baku_tarif);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_bahan_baku_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_bahan_baku_tarif['total_tpb_bahan_baku_tarif'] == $data_tpb_bahan_baku_tarif['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_barang -->
        <?php
        $cekData_tpb_barang = $dbcon->query("SELECT COUNT(*) AS total_tpb_barang FROM tpb_barang");
        $resultCek_tpb_barang = mysqli_fetch_array($cekData_tpb_barang);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_barang['total_tpb_barang'] == $data_tpb_barang['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_barang_dokumen -->
        <?php
        $cekData_tpb_barang_dokumen = $dbcon->query("SELECT COUNT(*) AS total_tpb_barang_dokumen FROM tpb_barang_dokumen");
        $resultCek_tpb_barang_dokumen = mysqli_fetch_array($cekData_tpb_barang_dokumen);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_barang_dokumen['total_tpb_barang_dokumen'] == $data_tpb_barang_dokumen['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_barang_penerima -->
        <?php
        $cekData_tpb_barang_penerima = $dbcon->query("SELECT COUNT(*) AS total_tpb_barang_penerima FROM tpb_barang_penerima");
        $resultCek_tpb_barang_penerima = mysqli_fetch_array($cekData_tpb_barang_penerima);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang_penerima
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_barang_penerima['total_tpb_barang_penerima'] == $data_tpb_barang_penerima['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_barang_tarif -->
        <?php
        $cekData_tpb_barang_tarif = $dbcon->query("SELECT COUNT(*) AS total_tpb_barang_tarif FROM tpb_barang_tarif");
        $resultCek_tpb_barang_tarif = mysqli_fetch_array($cekData_tpb_barang_tarif);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_barang_tarif['total_tpb_barang_tarif'] == $data_tpb_barang_tarif['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_detil_status -->
        <?php
        $cekData_tpb_detil_status = $dbcon->query("SELECT COUNT(*) AS total_tpb_detil_status FROM tpb_detil_status");
        $resultCek_tpb_detil_status = mysqli_fetch_array($cekData_tpb_detil_status);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_detil_status
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_detil_status['total_tpb_detil_status'] == $data_tpb_detil_status['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_dokumen -->
        <?php
        $cekData_tpb_dokumen = $dbcon->query("SELECT COUNT(*) AS total_tpb_dokumen FROM tpb_dokumen");
        $resultCek_tpb_dokumen = mysqli_fetch_array($cekData_tpb_dokumen);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_dokumen['total_tpb_dokumen'] == $data_tpb_dokumen['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_header -->
        <?php
        $cekData_tpb_header = $dbcon->query("SELECT COUNT(*) AS total_tpb_header FROM tpb_header");
        $resultCek_tpb_header = mysqli_fetch_array($cekData_tpb_header);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_header
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_header['total_tpb_header'] == $data_tpb_header['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_jaminan -->
        <?php
        $cekData_tpb_jaminan = $dbcon->query("SELECT COUNT(*) AS total_tpb_jaminan FROM tpb_jaminan");
        $resultCek_tpb_jaminan = mysqli_fetch_array($cekData_tpb_jaminan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_jaminan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_jaminan['total_tpb_jaminan'] == $data_tpb_jaminan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_kemasan -->
        <?php
        $cekData_tpb_kemasan = $dbcon->query("SELECT COUNT(*) AS total_tpb_kemasan FROM tpb_kemasan");
        $resultCek_tpb_kemasan = mysqli_fetch_array($cekData_tpb_kemasan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_kemasan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_kemasan['total_tpb_kemasan'] == $data_tpb_kemasan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_kontainer -->
        <?php
        $cekData_tpb_kontainer = $dbcon->query("SELECT COUNT(*) AS total_tpb_kontainer FROM tpb_kontainer");
        $resultCek_tpb_kontainer = mysqli_fetch_array($cekData_tpb_kontainer);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_kontainer
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_kontainer['total_tpb_kontainer'] == $data_tpb_kontainer['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_npwp_billing -->
        <?php
        $cekData_tpb_npwp_billing = $dbcon->query("SELECT COUNT(*) AS total_tpb_npwp_billing FROM tpb_npwp_billing");
        $resultCek_tpb_npwp_billing = mysqli_fetch_array($cekData_tpb_npwp_billing);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_npwp_billing
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_npwp_billing['total_tpb_npwp_billing'] == $data_tpb_npwp_billing['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_penerima -->
        <?php
        $cekData_tpb_penerima = $dbcon->query("SELECT COUNT(*) AS total_tpb_penerima FROM tpb_penerima");
        $resultCek_tpb_penerima = mysqli_fetch_array($cekData_tpb_penerima);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_penerima
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_penerima['total_tpb_penerima'] == $data_tpb_penerima['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_pungutan -->
        <?php
        $cekData_tpb_pungutan = $dbcon->query("SELECT COUNT(*) AS total_tpb_pungutan FROM tpb_pungutan");
        $resultCek_tpb_pungutan = mysqli_fetch_array($cekData_tpb_pungutan);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_pungutan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_pungutan['total_tpb_pungutan'] == $data_tpb_pungutan['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- tpb_respon -->
        <?php
        $cekData_tpb_respon = $dbcon->query("SELECT COUNT(*) AS total_tpb_respon FROM tpb_respon");
        $resultCek_tpb_respon = mysqli_fetch_array($cekData_tpb_respon);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_respon
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_tpb_respon['total_tpb_respon'] == $data_tpb_respon['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
        <!-- user_manajemen -->
        <?php
        $cekData_user_manajemen = $dbcon->query("SELECT COUNT(*) AS total_user_manajemen FROM user_manajemen");
        $resultCek_user_manajemen = mysqli_fetch_array($cekData_user_manajemen);
        ?>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                user_manajemen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php if ($resultCek_user_manajemen['total_user_manajemen'] == $data_user_manajemen['result']) { ?>
                    <div style="color: green;"><i class="fas fa-check-circle"></i></div>
                <?php } else { ?>
                    <div style="color: red;"><i class="fas fa-ban"></i></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>