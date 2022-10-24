<?php include "../api/restapi.php"; ?>
<div class="card border-0 bg-dark text-white text-truncate mb-3">
    <div class="card-body">
        <div class="mb-3 text-grey">
            <b class="mb-3">COUNT RECORD TABLES DATABASE TPB LOCAL (RESTAPI)</b> 
            <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="COUNT RECORD TABLES DATABASE TPB LOCAL (RESTAPI)" data-placement="top" data-content="Record perbandingan." data-original-title="" title=""></i></span>
        </div>
        <div class="d-flex align-items-center mb-1">
            <h2 class="text-white mb-0"><span data-animation="number" data-value="<?= $data_total_tables['result']; ?>"><?= $data_total_tables['result']; ?></span> Tables</h2>
            <div class="ml-auto">
                <div id="conversion-rate-sparkline"></div>
            </div>
        </div>
        <hr>
        <!-- aktivasi_aplikasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                aktivasi_aplikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_aktivasi_aplikasi['result']; ?>"><?= $data_aktivasi_aplikasi['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- hasil_validasi_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                hasil_validasi_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_hasil_validasi_barang['result']; ?>"><?= $data_hasil_validasi_barang['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- hasil_validasi_header -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                hasil_validasi_header
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_hasil_validasi_header['result']; ?>"><?= $data_hasil_validasi_header['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_asal_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_asal_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_asal_barang['result']; ?>"><?= $data_referensi_asal_barang['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_asal_data -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_asal_data
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_asal_data['result']; ?>"><?= $data_referensi_asal_data['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_asuransi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_asuransi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_asuransi['result']; ?>"><?= $data_referensi_asuransi['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_cara_angkut -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_cara_angkut
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_cara_angkut['result']; ?>"><?= $data_referensi_cara_angkut['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_cara_bayar -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_cara_bayar
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_cara_bayar['result']; ?>"><?= $data_referensi_cara_bayar['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_daerah -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_daerah
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_daerah['result']; ?>"><?= $data_referensi_daerah['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_dokumen -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_dokumen['result']; ?>"><?= $data_referensi_dokumen['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_dokumen_pabean -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_dokumen_pabean
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_dokumen_pabean['result']; ?>"><?= $data_referensi_dokumen_pabean['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_fasilitas -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_fasilitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_fasilitas['result']; ?>"><?= $data_referensi_fasilitas['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_filter_komunikasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_filter_komunikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_filter_komunikasi['result']; ?>"><?= $data_referensi_filter_komunikasi['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_harga -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_harga
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_harga['result']; ?>"><?= $data_referensi_harga['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_identitas -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_identitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_identitas['result']; ?>"><?= $data_referensi_identitas['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_jenis_api -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_api
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_jenis_api['result']; ?>"><?= $data_referensi_jenis_api['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_jenis_bc25 -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_bc25
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_jenis_bc25['result']; ?>"><?= $data_referensi_jenis_bc25['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_jenis_jaminan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_jaminan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_jenis_jaminan['result']; ?>"><?= $data_referensi_jenis_jaminan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_jenis_kendaraan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_kendaraan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_jenis_kendaraan['result']; ?>"><?= $data_referensi_jenis_kendaraan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_jenis_nilai -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_nilai
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_jenis_nilai['result']; ?>"><?= $data_referensi_jenis_nilai['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_jenis_pemasukan01 -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_pemasukan01
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_jenis_pemasukan01['result']; ?>"><?= $data_referensi_jenis_pemasukan01['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_jenis_pemasukan02 -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_pemasukan02
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_jenis_pemasukan02['result']; ?>"><?= $data_referensi_jenis_pemasukan02['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_jenis_tanda_pengaman -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_tanda_pengaman
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_jenis_tanda_pengaman['result']; ?>"><?= $data_referensi_jenis_tanda_pengaman['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_jenis_tarif -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_jenis_tarif['result']; ?>"><?= $data_referensi_jenis_tarif['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_jenis_tpb -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_jenis_tpb
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_jenis_tpb['result']; ?>"><?= $data_referensi_jenis_tpb['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_kantor_pabean -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kantor_pabean
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_kantor_pabean['result']; ?>"><?= $data_referensi_kantor_pabean['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_kapal -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kapal
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_kapal['result']; ?>"><?= $data_referensi_kapal['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_kategori_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kategori_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_kategori_barang['result']; ?>"><?= $data_referensi_kategori_barang['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_kategori_barangbc25 -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kategori_barangbc25
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_kategori_barangbc25['result']; ?>"><?= $data_referensi_kategori_barangbc25['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_kemasan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kemasan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_kemasan['result']; ?>"><?= $data_referensi_kemasan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_kode_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kode_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_kode_barang['result']; ?>"><?= $data_referensi_kode_barang['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_kode_guna -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kode_guna
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_kode_guna['result']; ?>"><?= $data_referensi_kode_guna['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_kode_id -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kode_id
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_kode_id['result']; ?>"><?= $data_referensi_kode_id['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_komoditi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_komoditi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_komoditi['result']; ?>"><?= $data_referensi_komoditi['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_kondisi_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_kondisi_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_kondisi_barang['result']; ?>"><?= $data_referensi_kondisi_barang['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_lokasi_bayar -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_lokasi_bayar
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_lokasi_bayar['result']; ?>"><?= $data_referensi_lokasi_bayar['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_mata_uang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_mata_uang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_mata_uang['result']; ?>"><?= $data_referensi_mata_uang['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_negara -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_negara
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_negara['result']; ?>"><?= $data_referensi_negara['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_npwp_billing -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_npwp_billing
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_npwp_billing['result']; ?>"><?= $data_referensi_npwp_billing['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_pelabuhan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pelabuhan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_pelabuhan['result']; ?>"><?= $data_referensi_pelabuhan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_pemasok -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pemasok
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_pemasok['result']; ?>"><?= $data_referensi_pemasok['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_pembayar -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pembayar
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_pembayar['result']; ?>"><?= $data_referensi_pembayar['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_pengusaha -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pengusaha
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_pengusaha['result']; ?>"><?= $data_referensi_pengusaha['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_pilihan_komunikasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pilihan_komunikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_pilihan_komunikasi['result']; ?>"><?= $data_referensi_pilihan_komunikasi['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_pos_tarif -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pos_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_pos_tarif['result']; ?>"><?= $data_referensi_pos_tarif['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_ppjk -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_ppjk
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_ppjk['result']; ?>"><?= $data_referensi_ppjk['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_pungutan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_pungutan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_pungutan['result']; ?>"><?= $data_referensi_pungutan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_refeteks -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_refeteks
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_refeteks['result']; ?>"><?= $data_referensi_refeteks['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_respon -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_respon
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_respon['result']; ?>"><?= $data_referensi_respon['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_satuan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_satuan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_satuan['result']; ?>"><?= $data_referensi_satuan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_skema_tarif -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_skema_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_skema_tarif['result']; ?>"><?= $data_referensi_skema_tarif['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_status -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_status
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_status['result']; ?>"><?= $data_referensi_status['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_status_pengusaha -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_status_pengusaha
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_status_pengusaha['result']; ?>"><?= $data_referensi_status_pengusaha['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_tarif_fasilitas -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tarif_fasilitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_tarif_fasilitas['result']; ?>"><?= $data_referensi_tarif_fasilitas['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_tipe_kontainer -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tipe_kontainer
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_tipe_kontainer['result']; ?>"><?= $data_referensi_tipe_kontainer['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_tps -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tps
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_tps['result']; ?>"><?= $data_referensi_tps['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_tujuan_pemasukan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tujuan_pemasukan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_tujuan_pemasukan['result']; ?>"><?= $data_referensi_tujuan_pemasukan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_tujuan_pengiriman -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tujuan_pengiriman
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_tujuan_pengiriman['result']; ?>"><?= $data_referensi_tujuan_pengiriman['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_tujuan_tpb -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tujuan_tpb
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_tujuan_tpb['result']; ?>"><?= $data_referensi_tujuan_tpb['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_tutup_pu -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_tutup_pu
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_tutup_pu['result']; ?>"><?= $data_referensi_tutup_pu['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_ukuran_kontainer -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_ukuran_kontainer
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_ukuran_kontainer['result']; ?>"><?= $data_referensi_ukuran_kontainer['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_validasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_validasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_validasi['result']; ?>"><?= $data_referensi_validasi['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_validasi_jenis_nilai -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_validasi_jenis_nilai
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_validasi_jenis_nilai['result']; ?>"><?= $data_referensi_validasi_jenis_nilai['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- referensi_valuta -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                referensi_valuta
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_referensi_valuta['result']; ?>"><?= $data_referensi_valuta['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- setting_aplikasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                setting_aplikasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_setting_aplikasi['result']; ?>"><?= $data_setting_aplikasi['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_aktifitas -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_aktifitas
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_aktifitas['result']; ?>"><?= $data_tbl_aktifitas['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_department -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_department
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_department['result']; ?>"><?= $data_tbl_department['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_faq -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_faq
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_faq['result']; ?>"><?= $data_tbl_faq['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_informasi -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_informasi
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_informasi['result']; ?>"><?= $data_tbl_informasi['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_jabatan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_jabatan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_jabatan['result']; ?>"><?= $data_tbl_jabatan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_log -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_log
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_log['result']; ?>"><?= $data_tbl_log['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_pegawai -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_pegawai
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_pegawai['result']; ?>"><?= $data_tbl_pegawai['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_realtime -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_realtime
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_realtime['result']; ?>"><?= $data_tbl_realtime['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_role -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_role
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_role['result']; ?>"><?= $data_tbl_role['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_setting -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_setting
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_setting['result']; ?>"><?= $data_tbl_setting['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tbl_users -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tbl_users
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tbl_users['result']; ?>"><?= $data_tbl_users['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_bahan_baku -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_bahan_baku
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_bahan_baku['result']; ?>"><?= $data_tpb_bahan_baku['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_bahan_baku_dokumen -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_bahan_baku_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_bahan_baku_dokumen['result']; ?>"><?= $data_tpb_bahan_baku_dokumen['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_bahan_baku_tarif -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_bahan_baku_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_bahan_baku_tarif['result']; ?>"><?= $data_tpb_bahan_baku_tarif['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_barang -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_barang['result']; ?>"><?= $data_tpb_barang['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_barang_dokumen -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_barang_dokumen['result']; ?>"><?= $data_tpb_barang_dokumen['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_barang_penerima -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang_penerima
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_barang_penerima['result']; ?>"><?= $data_tpb_barang_penerima['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_barang_tarif -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_barang_tarif
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_barang_tarif['result']; ?>"><?= $data_tpb_barang_tarif['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_detil_status -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_detil_status
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_detil_status['result']; ?>"><?= $data_tpb_detil_status['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_dokumen -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_dokumen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_dokumen['result']; ?>"><?= $data_tpb_dokumen['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_header -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_header
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_header['result']; ?>"><?= $data_tpb_header['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_jaminan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_jaminan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_jaminan['result']; ?>"><?= $data_tpb_jaminan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_kemasan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_kemasan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_kemasan['result']; ?>"><?= $data_tpb_kemasan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_kontainer -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_kontainer
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_kontainer['result']; ?>"><?= $data_tpb_kontainer['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_npwp_billing -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_npwp_billing
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_npwp_billing['result']; ?>"><?= $data_tpb_npwp_billing['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_penerima -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_penerima
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_penerima['result']; ?>"><?= $data_tpb_penerima['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_pungutan -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_pungutan
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_pungutan['result']; ?>"><?= $data_tpb_pungutan['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- tpb_respon -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                tpb_respon
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_tpb_respon['result']; ?>"><?= $data_tpb_respon['result']; ?></span> Record</div>
            </div>
        </div>
        <!-- user_manajemen -->
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                user_manajemen
            </div>
            <div class="d-flex align-items-center ml-auto">
                <div class="text-right pl-2 f-w-600"><span data-animation="number" data-value="<?= $data_user_manajemen['result']; ?>"><?= $data_user_manajemen['result']; ?></span> Record</div>
            </div>
        </div>
    </div>
</div>