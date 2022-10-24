<?php
include "../include/connection.php";
?>
<div class="card border-0 bg-dark text-white text-truncate mb-3">
    <div class="card-body">
        <div class="mb-3 text-grey">
            <b class="mb-3">COUNT RECORD TABLES DATABASE HELLOS</b> 
            <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="COUNT RECORD TABLES DATABASE HELLOS" data-placement="top" data-content="Record perbandingan." data-original-title="" title=""></i></span>
        </div>
        <div class="d-flex align-items-center mb-1">
            <?php
            $data_jumlah_table = $dbcon->query("SELECT view_tables FROM view_all_tables");
            $djt_query = mysqli_fetch_array($data_jumlah_table);
            ?>
            <h2 class="text-white mb-0"><span data-animation="number" data-value="<?= $djt_query['view_tables'] ?>"><?= $djt_query['view_tables'] ?></span> Tables</h2>
            <div class="ml-auto">
                <div id="conversion-rate-sparkline"></div>
            </div>
        </div>
        <hr>
        <!-- //  aktivasi_aplikasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                aktivasi_aplikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_aktivasi_aplikasi = $dbcon->query("SELECT COUNT(*) AS total_aktivasi_aplikasi FROM aktivasi_aplikasi");
                $resultRecord_aktivasi_aplikasi = mysqli_fetch_array($data_record_aktivasi_aplikasi);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_aktivasi_aplikasi['total_aktivasi_aplikasi']; ?>"><?= $resultRecord_aktivasi_aplikasi['total_aktivasi_aplikasi']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  hasil_validasi_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                hasil_validasi_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_hasil_validasi_barang = $dbcon->query("SELECT COUNT(*) AS total_hasil_validasi_barang FROM hasil_validasi_barang");
                $resultRecord_hasil_validasi_barang = mysqli_fetch_array($data_record_hasil_validasi_barang);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_hasil_validasi_barang['total_hasil_validasi_barang']; ?>"><?= $resultRecord_hasil_validasi_barang['total_hasil_validasi_barang']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  hasil_validasi_header -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                hasil_validasi_header
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_hasil_validasi_header = $dbcon->query("SELECT COUNT(*) AS total_hasil_validasi_header FROM hasil_validasi_header");
                $resultRecord_hasil_validasi_header = mysqli_fetch_array($data_record_hasil_validasi_header);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_hasil_validasi_header['total_hasil_validasi_header']; ?>"><?= $resultRecord_hasil_validasi_header['total_hasil_validasi_header']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_asal_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_asal_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_asal_barang = $dbcon->query("SELECT COUNT(*) AS total_referensi_asal_barang FROM referensi_asal_barang");
                $resultRecord_referensi_asal_barang = mysqli_fetch_array($data_record_referensi_asal_barang);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_asal_barang['total_referensi_asal_barang']; ?>"><?= $resultRecord_referensi_asal_barang['total_referensi_asal_barang']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_asal_data -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_asal_data
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_asal_data = $dbcon->query("SELECT COUNT(*) AS total_referensi_asal_data FROM referensi_asal_data");
                $resultRecord_referensi_asal_data = mysqli_fetch_array($data_record_referensi_asal_data);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_asal_data['total_referensi_asal_data']; ?>"><?= $resultRecord_referensi_asal_data['total_referensi_asal_data']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_asuransi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_asuransi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_asuransi = $dbcon->query("SELECT COUNT(*) AS total_referensi_asuransi FROM referensi_asuransi");
                $resultRecord_referensi_asuransi = mysqli_fetch_array($data_record_referensi_asuransi);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_asuransi['total_referensi_asuransi']; ?>"><?= $resultRecord_referensi_asuransi['total_referensi_asuransi']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_cara_angkut -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_cara_angkut
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_cara_angkut = $dbcon->query("SELECT COUNT(*) AS total_referensi_cara_angkut FROM referensi_cara_angkut");
                $resultRecord_referensi_cara_angkut = mysqli_fetch_array($data_record_referensi_cara_angkut);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_cara_angkut['total_referensi_cara_angkut']; ?>"><?= $resultRecord_referensi_cara_angkut['total_referensi_cara_angkut']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_cara_bayar -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_cara_bayar
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_cara_bayar = $dbcon->query("SELECT COUNT(*) AS total_referensi_cara_bayar FROM referensi_cara_bayar");
                $resultRecord_referensi_cara_bayar = mysqli_fetch_array($data_record_referensi_cara_bayar);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_cara_bayar['total_referensi_cara_bayar']; ?>"><?= $resultRecord_referensi_cara_bayar['total_referensi_cara_bayar']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_daerah -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_daerah
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_daerah = $dbcon->query("SELECT COUNT(*) AS total_referensi_daerah FROM referensi_daerah");
                $resultRecord_referensi_daerah = mysqli_fetch_array($data_record_referensi_daerah);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_daerah['total_referensi_daerah']; ?>"><?= $resultRecord_referensi_daerah['total_referensi_daerah']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_dokumen -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_dokumen = $dbcon->query("SELECT COUNT(*) AS total_referensi_dokumen FROM referensi_dokumen");
                $resultRecord_referensi_dokumen = mysqli_fetch_array($data_record_referensi_dokumen);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_dokumen['total_referensi_dokumen']; ?>"><?= $resultRecord_referensi_dokumen['total_referensi_dokumen']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_dokumen_pabean -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_dokumen_pabean
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_dokumen_pabean = $dbcon->query("SELECT COUNT(*) AS total_referensi_dokumen_pabean FROM referensi_dokumen_pabean");
                $resultRecord_referensi_dokumen_pabean = mysqli_fetch_array($data_record_referensi_dokumen_pabean);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_dokumen_pabean['total_referensi_dokumen_pabean']; ?>"><?= $resultRecord_referensi_dokumen_pabean['total_referensi_dokumen_pabean']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_fasilitas -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_fasilitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_fasilitas = $dbcon->query("SELECT COUNT(*) AS total_referensi_fasilitas FROM referensi_fasilitas");
                $resultRecord_referensi_fasilitas = mysqli_fetch_array($data_record_referensi_fasilitas);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_fasilitas['total_referensi_fasilitas']; ?>"><?= $resultRecord_referensi_fasilitas['total_referensi_fasilitas']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_filter_komunikasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_filter_komunikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_filter_komunikasi = $dbcon->query("SELECT COUNT(*) AS total_referensi_filter_komunikasi FROM referensi_filter_komunikasi");
                $resultRecord_referensi_filter_komunikasi = mysqli_fetch_array($data_record_referensi_filter_komunikasi);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_filter_komunikasi['total_referensi_filter_komunikasi']; ?>"><?= $resultRecord_referensi_filter_komunikasi['total_referensi_filter_komunikasi']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_harga -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_harga
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_harga = $dbcon->query("SELECT COUNT(*) AS total_referensi_harga FROM referensi_harga");
                $resultRecord_referensi_harga = mysqli_fetch_array($data_record_referensi_harga);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_harga['total_referensi_harga']; ?>"><?= $resultRecord_referensi_harga['total_referensi_harga']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_identitas -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_identitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_identitas = $dbcon->query("SELECT COUNT(*) AS total_referensi_identitas FROM referensi_identitas");
                $resultRecord_referensi_identitas = mysqli_fetch_array($data_record_referensi_identitas);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_identitas['total_referensi_identitas']; ?>"><?= $resultRecord_referensi_identitas['total_referensi_identitas']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_jenis_api -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_api
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_jenis_api = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_api FROM referensi_jenis_api");
                $resultRecord_referensi_jenis_api = mysqli_fetch_array($data_record_referensi_jenis_api);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_jenis_api['total_referensi_jenis_api']; ?>"><?= $resultRecord_referensi_jenis_api['total_referensi_jenis_api']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_jenis_bc25 -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_bc25
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_jenis_bc25 = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_bc25 FROM referensi_jenis_bc25");
                $resultRecord_referensi_jenis_bc25 = mysqli_fetch_array($data_record_referensi_jenis_bc25);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_jenis_bc25['total_referensi_jenis_bc25']; ?>"><?= $resultRecord_referensi_jenis_bc25['total_referensi_jenis_bc25']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_jenis_jaminan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_jaminan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_jenis_jaminan = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_jaminan FROM referensi_jenis_jaminan");
                $resultRecord_referensi_jenis_jaminan = mysqli_fetch_array($data_record_referensi_jenis_jaminan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_jenis_jaminan['total_referensi_jenis_jaminan']; ?>"><?= $resultRecord_referensi_jenis_jaminan['total_referensi_jenis_jaminan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_jenis_kendaraan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_kendaraan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_jenis_kendaraan = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_kendaraan FROM referensi_jenis_kendaraan");
                $resultRecord_referensi_jenis_kendaraan = mysqli_fetch_array($data_record_referensi_jenis_kendaraan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_jenis_kendaraan['total_referensi_jenis_kendaraan']; ?>"><?= $resultRecord_referensi_jenis_kendaraan['total_referensi_jenis_kendaraan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_jenis_nilai -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_nilai
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_jenis_nilai = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_nilai FROM referensi_jenis_nilai");
                $resultRecord_referensi_jenis_nilai = mysqli_fetch_array($data_record_referensi_jenis_nilai);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_jenis_nilai['total_referensi_jenis_nilai']; ?>"><?= $resultRecord_referensi_jenis_nilai['total_referensi_jenis_nilai']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_jenis_pemasukan01 -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_pemasukan01
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_jenis_pemasukan01 = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_pemasukan01 FROM referensi_jenis_pemasukan01");
                $resultRecord_referensi_jenis_pemasukan01 = mysqli_fetch_array($data_record_referensi_jenis_pemasukan01);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_jenis_pemasukan01['total_referensi_jenis_pemasukan01']; ?>"><?= $resultRecord_referensi_jenis_pemasukan01['total_referensi_jenis_pemasukan01']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_jenis_pemasukan02 -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_pemasukan02
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_jenis_pemasukan02 = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_pemasukan02 FROM referensi_jenis_pemasukan02");
                $resultRecord_referensi_jenis_pemasukan02 = mysqli_fetch_array($data_record_referensi_jenis_pemasukan02);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_jenis_pemasukan02['total_referensi_jenis_pemasukan02']; ?>"><?= $resultRecord_referensi_jenis_pemasukan02['total_referensi_jenis_pemasukan02']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_jenis_tanda_pengaman -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_tanda_pengaman
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_jenis_tanda_pengaman = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_tanda_pengaman FROM referensi_jenis_tanda_pengaman");
                $resultRecord_referensi_jenis_tanda_pengaman = mysqli_fetch_array($data_record_referensi_jenis_tanda_pengaman);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_jenis_tanda_pengaman['total_referensi_jenis_tanda_pengaman']; ?>"><?= $resultRecord_referensi_jenis_tanda_pengaman['total_referensi_jenis_tanda_pengaman']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_jenis_tarif -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_jenis_tarif = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_tarif FROM referensi_jenis_tarif");
                $resultRecord_referensi_jenis_tarif = mysqli_fetch_array($data_record_referensi_jenis_tarif);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_jenis_tarif['total_referensi_jenis_tarif']; ?>"><?= $resultRecord_referensi_jenis_tarif['total_referensi_jenis_tarif']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_jenis_tpb -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_tpb
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_jenis_tpb = $dbcon->query("SELECT COUNT(*) AS total_referensi_jenis_tpb FROM referensi_jenis_tpb");
                $resultRecord_referensi_jenis_tpb = mysqli_fetch_array($data_record_referensi_jenis_tpb);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_jenis_tpb['total_referensi_jenis_tpb']; ?>"><?= $resultRecord_referensi_jenis_tpb['total_referensi_jenis_tpb']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_kantor_pabean -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kantor_pabean
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_kantor_pabean = $dbcon->query("SELECT COUNT(*) AS total_referensi_kantor_pabean FROM referensi_kantor_pabean");
                $resultRecord_referensi_kantor_pabean = mysqli_fetch_array($data_record_referensi_kantor_pabean);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_kantor_pabean['total_referensi_kantor_pabean']; ?>"><?= $resultRecord_referensi_kantor_pabean['total_referensi_kantor_pabean']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_kapal -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kapal
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_kapal = $dbcon->query("SELECT COUNT(*) AS total_referensi_kapal FROM referensi_kapal");
                $resultRecord_referensi_kapal = mysqli_fetch_array($data_record_referensi_kapal);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_kapal['total_referensi_kapal']; ?>"><?= $resultRecord_referensi_kapal['total_referensi_kapal']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_kategori_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kategori_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_kategori_barang = $dbcon->query("SELECT COUNT(*) AS total_referensi_kategori_barang FROM referensi_kategori_barang");
                $resultRecord_referensi_kategori_barang = mysqli_fetch_array($data_record_referensi_kategori_barang);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_kategori_barang['total_referensi_kategori_barang']; ?>"><?= $resultRecord_referensi_kategori_barang['total_referensi_kategori_barang']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_kategori_barangbc25 -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kategori_barangbc25
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_kategori_barangbc25 = $dbcon->query("SELECT COUNT(*) AS total_referensi_kategori_barangbc25 FROM referensi_kategori_barangbc25");
                $resultRecord_referensi_kategori_barangbc25 = mysqli_fetch_array($data_record_referensi_kategori_barangbc25);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_kategori_barangbc25['total_referensi_kategori_barangbc25']; ?>"><?= $resultRecord_referensi_kategori_barangbc25['total_referensi_kategori_barangbc25']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_kemasan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kemasan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_kemasan = $dbcon->query("SELECT COUNT(*) AS total_referensi_kemasan FROM referensi_kemasan");
                $resultRecord_referensi_kemasan = mysqli_fetch_array($data_record_referensi_kemasan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_kemasan['total_referensi_kemasan']; ?>"><?= $resultRecord_referensi_kemasan['total_referensi_kemasan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_kode_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kode_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_kode_barang = $dbcon->query("SELECT COUNT(*) AS total_referensi_kode_barang FROM referensi_kode_barang");
                $resultRecord_referensi_kode_barang = mysqli_fetch_array($data_record_referensi_kode_barang);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_kode_barang['total_referensi_kode_barang']; ?>"><?= $resultRecord_referensi_kode_barang['total_referensi_kode_barang']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_kode_guna -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kode_guna
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_kode_guna = $dbcon->query("SELECT COUNT(*) AS total_referensi_kode_guna FROM referensi_kode_guna");
                $resultRecord_referensi_kode_guna = mysqli_fetch_array($data_record_referensi_kode_guna);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_kode_guna['total_referensi_kode_guna']; ?>"><?= $resultRecord_referensi_kode_guna['total_referensi_kode_guna']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_kode_id -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kode_id
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_kode_id = $dbcon->query("SELECT COUNT(*) AS total_referensi_kode_id FROM referensi_kode_id");
                $resultRecord_referensi_kode_id = mysqli_fetch_array($data_record_referensi_kode_id);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_kode_id['total_referensi_kode_id']; ?>"><?= $resultRecord_referensi_kode_id['total_referensi_kode_id']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_komoditi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_komoditi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_komoditi = $dbcon->query("SELECT COUNT(*) AS total_referensi_komoditi FROM referensi_komoditi");
                $resultRecord_referensi_komoditi = mysqli_fetch_array($data_record_referensi_komoditi);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_komoditi['total_referensi_komoditi']; ?>"><?= $resultRecord_referensi_komoditi['total_referensi_komoditi']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_kondisi_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kondisi_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_kondisi_barang = $dbcon->query("SELECT COUNT(*) AS total_referensi_kondisi_barang FROM referensi_kondisi_barang");
                $resultRecord_referensi_kondisi_barang = mysqli_fetch_array($data_record_referensi_kondisi_barang);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_kondisi_barang['total_referensi_kondisi_barang']; ?>"><?= $resultRecord_referensi_kondisi_barang['total_referensi_kondisi_barang']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_lokasi_bayar -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_lokasi_bayar
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_lokasi_bayar = $dbcon->query("SELECT COUNT(*) AS total_referensi_lokasi_bayar FROM referensi_lokasi_bayar");
                $resultRecord_referensi_lokasi_bayar = mysqli_fetch_array($data_record_referensi_lokasi_bayar);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_lokasi_bayar['total_referensi_lokasi_bayar']; ?>"><?= $resultRecord_referensi_lokasi_bayar['total_referensi_lokasi_bayar']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_mata_uang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_mata_uang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_mata_uang = $dbcon->query("SELECT COUNT(*) AS total_referensi_mata_uang FROM referensi_mata_uang");
                $resultRecord_referensi_mata_uang = mysqli_fetch_array($data_record_referensi_mata_uang);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_mata_uang['total_referensi_mata_uang']; ?>"><?= $resultRecord_referensi_mata_uang['total_referensi_mata_uang']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_negara -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_negara
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_negara = $dbcon->query("SELECT COUNT(*) AS total_referensi_negara FROM referensi_negara");
                $resultRecord_referensi_negara = mysqli_fetch_array($data_record_referensi_negara);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_negara['total_referensi_negara']; ?>"><?= $resultRecord_referensi_negara['total_referensi_negara']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_npwp_billing -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_npwp_billing
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_npwp_billing = $dbcon->query("SELECT COUNT(*) AS total_referensi_npwp_billing FROM referensi_npwp_billing");
                $resultRecord_referensi_npwp_billing = mysqli_fetch_array($data_record_referensi_npwp_billing);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_npwp_billing['total_referensi_npwp_billing']; ?>"><?= $resultRecord_referensi_npwp_billing['total_referensi_npwp_billing']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_pelabuhan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pelabuhan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_pelabuhan = $dbcon->query("SELECT COUNT(*) AS total_referensi_pelabuhan FROM referensi_pelabuhan");
                $resultRecord_referensi_pelabuhan = mysqli_fetch_array($data_record_referensi_pelabuhan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_pelabuhan['total_referensi_pelabuhan']; ?>"><?= $resultRecord_referensi_pelabuhan['total_referensi_pelabuhan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_pemasok -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pemasok
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_pemasok = $dbcon->query("SELECT COUNT(*) AS total_referensi_pemasok FROM referensi_pemasok");
                $resultRecord_referensi_pemasok = mysqli_fetch_array($data_record_referensi_pemasok);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_pemasok['total_referensi_pemasok']; ?>"><?= $resultRecord_referensi_pemasok['total_referensi_pemasok']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_pembayar -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pembayar
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_pembayar = $dbcon->query("SELECT COUNT(*) AS total_referensi_pembayar FROM referensi_pembayar");
                $resultRecord_referensi_pembayar = mysqli_fetch_array($data_record_referensi_pembayar);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_pembayar['total_referensi_pembayar']; ?>"><?= $resultRecord_referensi_pembayar['total_referensi_pembayar']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_pengusaha -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pengusaha
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_pengusaha = $dbcon->query("SELECT COUNT(*) AS total_referensi_pengusaha FROM referensi_pengusaha");
                $resultRecord_referensi_pengusaha = mysqli_fetch_array($data_record_referensi_pengusaha);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_pengusaha['total_referensi_pengusaha']; ?>"><?= $resultRecord_referensi_pengusaha['total_referensi_pengusaha']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_pilihan_komunikasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pilihan_komunikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_pilihan_komunikasi = $dbcon->query("SELECT COUNT(*) AS total_referensi_pilihan_komunikasi FROM referensi_pilihan_komunikasi");
                $resultRecord_referensi_pilihan_komunikasi = mysqli_fetch_array($data_record_referensi_pilihan_komunikasi);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_pilihan_komunikasi['total_referensi_pilihan_komunikasi']; ?>"><?= $resultRecord_referensi_pilihan_komunikasi['total_referensi_pilihan_komunikasi']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_pos_tarif -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pos_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_pos_tarif = $dbcon->query("SELECT COUNT(*) AS total_referensi_pos_tarif FROM referensi_pos_tarif");
                $resultRecord_referensi_pos_tarif = mysqli_fetch_array($data_record_referensi_pos_tarif);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_pos_tarif['total_referensi_pos_tarif']; ?>"><?= $resultRecord_referensi_pos_tarif['total_referensi_pos_tarif']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_ppjk -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_ppjk
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_ppjk = $dbcon->query("SELECT COUNT(*) AS total_referensi_ppjk FROM referensi_ppjk");
                $resultRecord_referensi_ppjk = mysqli_fetch_array($data_record_referensi_ppjk);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_ppjk['total_referensi_ppjk']; ?>"><?= $resultRecord_referensi_ppjk['total_referensi_ppjk']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_pungutan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pungutan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_pungutan = $dbcon->query("SELECT COUNT(*) AS total_referensi_pungutan FROM referensi_pungutan");
                $resultRecord_referensi_pungutan = mysqli_fetch_array($data_record_referensi_pungutan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_pungutan['total_referensi_pungutan']; ?>"><?= $resultRecord_referensi_pungutan['total_referensi_pungutan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_refeteks -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_refeteks
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_refeteks = $dbcon->query("SELECT COUNT(*) AS total_referensi_refeteks FROM referensi_refeteks");
                $resultRecord_referensi_refeteks = mysqli_fetch_array($data_record_referensi_refeteks);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_refeteks['total_referensi_refeteks']; ?>"><?= $resultRecord_referensi_refeteks['total_referensi_refeteks']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_respon -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_respon
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_respon = $dbcon->query("SELECT COUNT(*) AS total_referensi_respon FROM referensi_respon");
                $resultRecord_referensi_respon = mysqli_fetch_array($data_record_referensi_respon);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_respon['total_referensi_respon']; ?>"><?= $resultRecord_referensi_respon['total_referensi_respon']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_satuan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_satuan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_satuan = $dbcon->query("SELECT COUNT(*) AS total_referensi_satuan FROM referensi_satuan");
                $resultRecord_referensi_satuan = mysqli_fetch_array($data_record_referensi_satuan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_satuan['total_referensi_satuan']; ?>"><?= $resultRecord_referensi_satuan['total_referensi_satuan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_skema_tarif -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_skema_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_skema_tarif = $dbcon->query("SELECT COUNT(*) AS total_referensi_skema_tarif FROM referensi_skema_tarif");
                $resultRecord_referensi_skema_tarif = mysqli_fetch_array($data_record_referensi_skema_tarif);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_skema_tarif['total_referensi_skema_tarif']; ?>"><?= $resultRecord_referensi_skema_tarif['total_referensi_skema_tarif']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_status -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_status
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_status = $dbcon->query("SELECT COUNT(*) AS total_referensi_status FROM referensi_status");
                $resultRecord_referensi_status = mysqli_fetch_array($data_record_referensi_status);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_status['total_referensi_status']; ?>"><?= $resultRecord_referensi_status['total_referensi_status']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_status_pengusaha -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_status_pengusaha
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_status_pengusaha = $dbcon->query("SELECT COUNT(*) AS total_referensi_status_pengusaha FROM referensi_status_pengusaha");
                $resultRecord_referensi_status_pengusaha = mysqli_fetch_array($data_record_referensi_status_pengusaha);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_status_pengusaha['total_referensi_status_pengusaha']; ?>"><?= $resultRecord_referensi_status_pengusaha['total_referensi_status_pengusaha']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_tarif_fasilitas -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tarif_fasilitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_tarif_fasilitas = $dbcon->query("SELECT COUNT(*) AS total_referensi_tarif_fasilitas FROM referensi_tarif_fasilitas");
                $resultRecord_referensi_tarif_fasilitas = mysqli_fetch_array($data_record_referensi_tarif_fasilitas);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_tarif_fasilitas['total_referensi_tarif_fasilitas']; ?>"><?= $resultRecord_referensi_tarif_fasilitas['total_referensi_tarif_fasilitas']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_tipe_kontainer -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tipe_kontainer
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_tipe_kontainer = $dbcon->query("SELECT COUNT(*) AS total_referensi_tipe_kontainer FROM referensi_tipe_kontainer");
                $resultRecord_referensi_tipe_kontainer = mysqli_fetch_array($data_record_referensi_tipe_kontainer);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_tipe_kontainer['total_referensi_tipe_kontainer']; ?>"><?= $resultRecord_referensi_tipe_kontainer['total_referensi_tipe_kontainer']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_tps -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tps
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_tps = $dbcon->query("SELECT COUNT(*) AS total_referensi_tps FROM referensi_tps");
                $resultRecord_referensi_tps = mysqli_fetch_array($data_record_referensi_tps);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_tps['total_referensi_tps']; ?>"><?= $resultRecord_referensi_tps['total_referensi_tps']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_tujuan_pemasukan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tujuan_pemasukan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_tujuan_pemasukan = $dbcon->query("SELECT COUNT(*) AS total_referensi_tujuan_pemasukan FROM referensi_tujuan_pemasukan");
                $resultRecord_referensi_tujuan_pemasukan = mysqli_fetch_array($data_record_referensi_tujuan_pemasukan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_tujuan_pemasukan['total_referensi_tujuan_pemasukan']; ?>"><?= $resultRecord_referensi_tujuan_pemasukan['total_referensi_tujuan_pemasukan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_tujuan_pengiriman -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tujuan_pengiriman
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_tujuan_pengiriman = $dbcon->query("SELECT COUNT(*) AS total_referensi_tujuan_pengiriman FROM referensi_tujuan_pengiriman");
                $resultRecord_referensi_tujuan_pengiriman = mysqli_fetch_array($data_record_referensi_tujuan_pengiriman);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_tujuan_pengiriman['total_referensi_tujuan_pengiriman']; ?>"><?= $resultRecord_referensi_tujuan_pengiriman['total_referensi_tujuan_pengiriman']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_tujuan_tpb -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tujuan_tpb
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_tujuan_tpb = $dbcon->query("SELECT COUNT(*) AS total_referensi_tujuan_tpb FROM referensi_tujuan_tpb");
                $resultRecord_referensi_tujuan_tpb = mysqli_fetch_array($data_record_referensi_tujuan_tpb);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_tujuan_tpb['total_referensi_tujuan_tpb']; ?>"><?= $resultRecord_referensi_tujuan_tpb['total_referensi_tujuan_tpb']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_tutup_pu -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tutup_pu
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_tutup_pu = $dbcon->query("SELECT COUNT(*) AS total_referensi_tutup_pu FROM referensi_tutup_pu");
                $resultRecord_referensi_tutup_pu = mysqli_fetch_array($data_record_referensi_tutup_pu);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_tutup_pu['total_referensi_tutup_pu']; ?>"><?= $resultRecord_referensi_tutup_pu['total_referensi_tutup_pu']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_ukuran_kontainer -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_ukuran_kontainer
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_ukuran_kontainer = $dbcon->query("SELECT COUNT(*) AS total_referensi_ukuran_kontainer FROM referensi_ukuran_kontainer");
                $resultRecord_referensi_ukuran_kontainer = mysqli_fetch_array($data_record_referensi_ukuran_kontainer);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_ukuran_kontainer['total_referensi_ukuran_kontainer']; ?>"><?= $resultRecord_referensi_ukuran_kontainer['total_referensi_ukuran_kontainer']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_validasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_validasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_validasi = $dbcon->query("SELECT COUNT(*) AS total_referensi_validasi FROM referensi_validasi");
                $resultRecord_referensi_validasi = mysqli_fetch_array($data_record_referensi_validasi);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_validasi['total_referensi_validasi']; ?>"><?= $resultRecord_referensi_validasi['total_referensi_validasi']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_validasi_jenis_nilai -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_validasi_jenis_nilai
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_validasi_jenis_nilai = $dbcon->query("SELECT COUNT(*) AS total_referensi_validasi_jenis_nilai FROM referensi_validasi_jenis_nilai");
                $resultRecord_referensi_validasi_jenis_nilai = mysqli_fetch_array($data_record_referensi_validasi_jenis_nilai);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_validasi_jenis_nilai['total_referensi_validasi_jenis_nilai']; ?>"><?= $resultRecord_referensi_validasi_jenis_nilai['total_referensi_validasi_jenis_nilai']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  referensi_valuta -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_valuta
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_referensi_valuta = $dbcon->query("SELECT COUNT(*) AS total_referensi_valuta FROM referensi_valuta");
                $resultRecord_referensi_valuta = mysqli_fetch_array($data_record_referensi_valuta);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_referensi_valuta['total_referensi_valuta']; ?>"><?= $resultRecord_referensi_valuta['total_referensi_valuta']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  setting_aplikasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                setting_aplikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_setting_aplikasi = $dbcon->query("SELECT COUNT(*) AS total_setting_aplikasi FROM setting_aplikasi");
                $resultRecord_setting_aplikasi = mysqli_fetch_array($data_record_setting_aplikasi);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_setting_aplikasi['total_setting_aplikasi']; ?>"><?= $resultRecord_setting_aplikasi['total_setting_aplikasi']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_aktifitas -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_aktifitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_aktifitas = $dbcon->query("SELECT COUNT(*) AS total_tbl_aktifitas FROM tbl_aktifitas");
                $resultRecord_tbl_aktifitas = mysqli_fetch_array($data_record_tbl_aktifitas);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_aktifitas['total_tbl_aktifitas']; ?>"><?= $resultRecord_tbl_aktifitas['total_tbl_aktifitas']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_department -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_department
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_department = $dbcon->query("SELECT COUNT(*) AS total_tbl_department FROM tbl_department");
                $resultRecord_tbl_department = mysqli_fetch_array($data_record_tbl_department);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_department['total_tbl_department']; ?>"><?= $resultRecord_tbl_department['total_tbl_department']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_faq -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_faq
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_faq = $dbcon->query("SELECT COUNT(*) AS total_tbl_faq FROM tbl_faq");
                $resultRecord_tbl_faq = mysqli_fetch_array($data_record_tbl_faq);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_faq['total_tbl_faq']; ?>"><?= $resultRecord_tbl_faq['total_tbl_faq']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_informasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_informasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_informasi = $dbcon->query("SELECT COUNT(*) AS total_tbl_informasi FROM tbl_informasi");
                $resultRecord_tbl_informasi = mysqli_fetch_array($data_record_tbl_informasi);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_informasi['total_tbl_informasi']; ?>"><?= $resultRecord_tbl_informasi['total_tbl_informasi']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_jabatan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_jabatan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_jabatan = $dbcon->query("SELECT COUNT(*) AS total_tbl_jabatan FROM tbl_jabatan");
                $resultRecord_tbl_jabatan = mysqli_fetch_array($data_record_tbl_jabatan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_jabatan['total_tbl_jabatan']; ?>"><?= $resultRecord_tbl_jabatan['total_tbl_jabatan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_log -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_log
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_log = $dbcon->query("SELECT COUNT(*) AS total_tbl_log FROM tbl_log");
                $resultRecord_tbl_log = mysqli_fetch_array($data_record_tbl_log);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_log['total_tbl_log']; ?>"><?= $resultRecord_tbl_log['total_tbl_log']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_pegawai -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_pegawai
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_pegawai = $dbcon->query("SELECT COUNT(*) AS total_tbl_pegawai FROM tbl_pegawai");
                $resultRecord_tbl_pegawai = mysqli_fetch_array($data_record_tbl_pegawai);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_pegawai['total_tbl_pegawai']; ?>"><?= $resultRecord_tbl_pegawai['total_tbl_pegawai']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_realtime -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_realtime
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_realtime = $dbcon->query("SELECT COUNT(*) AS total_tbl_realtime FROM tbl_realtime");
                $resultRecord_tbl_realtime = mysqli_fetch_array($data_record_tbl_realtime);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_realtime['total_tbl_realtime']; ?>"><?= $resultRecord_tbl_realtime['total_tbl_realtime']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_role -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_role
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_role = $dbcon->query("SELECT COUNT(*) AS total_tbl_role FROM tbl_role");
                $resultRecord_tbl_role = mysqli_fetch_array($data_record_tbl_role);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_role['total_tbl_role']; ?>"><?= $resultRecord_tbl_role['total_tbl_role']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_setting -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_setting
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_setting = $dbcon->query("SELECT COUNT(*) AS total_tbl_setting FROM tbl_setting");
                $resultRecord_tbl_setting = mysqli_fetch_array($data_record_tbl_setting);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_setting['total_tbl_setting']; ?>"><?= $resultRecord_tbl_setting['total_tbl_setting']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tbl_users -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_users
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tbl_users = $dbcon->query("SELECT COUNT(*) AS total_tbl_users FROM tbl_users");
                $resultRecord_tbl_users = mysqli_fetch_array($data_record_tbl_users);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tbl_users['total_tbl_users']; ?>"><?= $resultRecord_tbl_users['total_tbl_users']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_bahan_baku -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_bahan_baku
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_bahan_baku = $dbcon->query("SELECT COUNT(*) AS total_tpb_bahan_baku FROM tpb_bahan_baku");
                $resultRecord_tpb_bahan_baku = mysqli_fetch_array($data_record_tpb_bahan_baku);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_bahan_baku['total_tpb_bahan_baku']; ?>"><?= $resultRecord_tpb_bahan_baku['total_tpb_bahan_baku']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_bahan_baku_dokumen -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_bahan_baku_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_bahan_baku_dokumen = $dbcon->query("SELECT COUNT(*) AS total_tpb_bahan_baku_dokumen FROM tpb_bahan_baku_dokumen");
                $resultRecord_tpb_bahan_baku_dokumen = mysqli_fetch_array($data_record_tpb_bahan_baku_dokumen);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_bahan_baku_dokumen['total_tpb_bahan_baku_dokumen']; ?>"><?= $resultRecord_tpb_bahan_baku_dokumen['total_tpb_bahan_baku_dokumen']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_bahan_baku_tarif -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_bahan_baku_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_bahan_baku_tarif = $dbcon->query("SELECT COUNT(*) AS total_tpb_bahan_baku_tarif FROM tpb_bahan_baku_tarif");
                $resultRecord_tpb_bahan_baku_tarif = mysqli_fetch_array($data_record_tpb_bahan_baku_tarif);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_bahan_baku_tarif['total_tpb_bahan_baku_tarif']; ?>"><?= $resultRecord_tpb_bahan_baku_tarif['total_tpb_bahan_baku_tarif']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_barang = $dbcon->query("SELECT COUNT(*) AS total_tpb_barang FROM tpb_barang");
                $resultRecord_tpb_barang = mysqli_fetch_array($data_record_tpb_barang);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_barang['total_tpb_barang']; ?>"><?= $resultRecord_tpb_barang['total_tpb_barang']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_barang_dokumen -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_barang_dokumen = $dbcon->query("SELECT COUNT(*) AS total_tpb_barang_dokumen FROM tpb_barang_dokumen");
                $resultRecord_tpb_barang_dokumen = mysqli_fetch_array($data_record_tpb_barang_dokumen);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_barang_dokumen['total_tpb_barang_dokumen']; ?>"><?= $resultRecord_tpb_barang_dokumen['total_tpb_barang_dokumen']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_barang_penerima -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang_penerima
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_barang_penerima = $dbcon->query("SELECT COUNT(*) AS total_tpb_barang_penerima FROM tpb_barang_penerima");
                $resultRecord_tpb_barang_penerima = mysqli_fetch_array($data_record_tpb_barang_penerima);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_barang_penerima['total_tpb_barang_penerima']; ?>"><?= $resultRecord_tpb_barang_penerima['total_tpb_barang_penerima']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_barang_tarif -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_barang_tarif = $dbcon->query("SELECT COUNT(*) AS total_tpb_barang_tarif FROM tpb_barang_tarif");
                $resultRecord_tpb_barang_tarif = mysqli_fetch_array($data_record_tpb_barang_tarif);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_barang_tarif['total_tpb_barang_tarif']; ?>"><?= $resultRecord_tpb_barang_tarif['total_tpb_barang_tarif']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_detil_status -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_detil_status
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_detil_status = $dbcon->query("SELECT COUNT(*) AS total_tpb_detil_status FROM tpb_detil_status");
                $resultRecord_tpb_detil_status = mysqli_fetch_array($data_record_tpb_detil_status);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_detil_status['total_tpb_detil_status']; ?>"><?= $resultRecord_tpb_detil_status['total_tpb_detil_status']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_dokumen -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_dokumen = $dbcon->query("SELECT COUNT(*) AS total_tpb_dokumen FROM tpb_dokumen");
                $resultRecord_tpb_dokumen = mysqli_fetch_array($data_record_tpb_dokumen);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_dokumen['total_tpb_dokumen']; ?>"><?= $resultRecord_tpb_dokumen['total_tpb_dokumen']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_header -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_header
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_header = $dbcon->query("SELECT COUNT(*) AS total_tpb_header FROM tpb_header");
                $resultRecord_tpb_header = mysqli_fetch_array($data_record_tpb_header);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_header['total_tpb_header']; ?>"><?= $resultRecord_tpb_header['total_tpb_header']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_jaminan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_jaminan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_jaminan = $dbcon->query("SELECT COUNT(*) AS total_tpb_jaminan FROM tpb_jaminan");
                $resultRecord_tpb_jaminan = mysqli_fetch_array($data_record_tpb_jaminan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_jaminan['total_tpb_jaminan']; ?>"><?= $resultRecord_tpb_jaminan['total_tpb_jaminan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_kemasan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_kemasan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_kemasan = $dbcon->query("SELECT COUNT(*) AS total_tpb_kemasan FROM tpb_kemasan");
                $resultRecord_tpb_kemasan = mysqli_fetch_array($data_record_tpb_kemasan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_kemasan['total_tpb_kemasan']; ?>"><?= $resultRecord_tpb_kemasan['total_tpb_kemasan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_kontainer -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_kontainer
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_kontainer = $dbcon->query("SELECT COUNT(*) AS total_tpb_kontainer FROM tpb_kontainer");
                $resultRecord_tpb_kontainer = mysqli_fetch_array($data_record_tpb_kontainer);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_kontainer['total_tpb_kontainer']; ?>"><?= $resultRecord_tpb_kontainer['total_tpb_kontainer']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_npwp_billing -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_npwp_billing
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_npwp_billing = $dbcon->query("SELECT COUNT(*) AS total_tpb_npwp_billing FROM tpb_npwp_billing");
                $resultRecord_tpb_npwp_billing = mysqli_fetch_array($data_record_tpb_npwp_billing);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_npwp_billing['total_tpb_npwp_billing']; ?>"><?= $resultRecord_tpb_npwp_billing['total_tpb_npwp_billing']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_penerima -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_penerima
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_penerima = $dbcon->query("SELECT COUNT(*) AS total_tpb_penerima FROM tpb_penerima");
                $resultRecord_tpb_penerima = mysqli_fetch_array($data_record_tpb_penerima);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_penerima['total_tpb_penerima']; ?>"><?= $resultRecord_tpb_penerima['total_tpb_penerima']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_pungutan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_pungutan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_pungutan = $dbcon->query("SELECT COUNT(*) AS total_tpb_pungutan FROM tpb_pungutan");
                $resultRecord_tpb_pungutan = mysqli_fetch_array($data_record_tpb_pungutan);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_pungutan['total_tpb_pungutan']; ?>"><?= $resultRecord_tpb_pungutan['total_tpb_pungutan']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  tpb_respon -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_respon
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_tpb_respon = $dbcon->query("SELECT COUNT(*) AS total_tpb_respon FROM tpb_respon");
                $resultRecord_tpb_respon = mysqli_fetch_array($data_record_tpb_respon);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_tpb_respon['total_tpb_respon']; ?>"><?= $resultRecord_tpb_respon['total_tpb_respon']; ?></span> Record</div>
            </div>    
        </div>
        <!-- //  user_manajemen -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                user_manajemen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <?php
                $data_record_user_manajemen = $dbcon->query("SELECT COUNT(*) AS total_user_manajemen FROM user_manajemen");
                $resultRecord_user_manajemen = mysqli_fetch_array($data_record_user_manajemen);
                ?>
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $resultRecord_user_manajemen['total_user_manajemen']; ?>"><?= $resultRecord_user_manajemen['total_user_manajemen']; ?></span> Record</div>
            </div>    
        </div>
    </div>
</div>