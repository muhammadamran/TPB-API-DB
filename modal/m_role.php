<!-- Add Users -->
<a href="#modal-User-Web-System" class="btn btn-primary" data-toggle="modal" title="Tambah Hak Akses"><i class="fas fa-plus-circle"></i> Tambah Hak Akses</a>
<div class="modal fade" id="modal-User-Web-System">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="adm_hak_akses.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">[Tambah Data] Hak Akses</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IdHakAkses">Hak Akses <font style="color: red;">*</font></label>
                                    <input type="text" class="form-control" name="NameRole" id="IdHakAkses" placeholder="Hak Akses ..." required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IdDescription">Deskripsi </label>
                                    <textarea type="text" class="form-control" name="NameDescription" id="IdDescription" placeholder="Deskripsi ..." ></textarea>
                                </div>
                            </div>
                            <!-- Dashboard - Summary -->
                            <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                <label for="IDDahboardSummary">Dashboard - Summary</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="font-weight: 800;">DASHBOARD</label>
                                    <input type="button" class="for-select-tpb" onclick='seDash()' value="Pilih Semua"/>
                                    <input type="button" class="for-unselect-tpb" onclick='deDash()' value="Batalkan"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameDashUsers" value="Y" id="IDDashUsers" class="form-check-input" />
                                        <label class="form-check-label" for="IDDashUsers">Dashboard Users</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameDashReferensi" value="Y" id="IDDashReferensi" class="form-check-input" />
                                        <label class="form-check-label" for="IDDashReferensi">Dashboard System</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Dashboard - Summary -->
                            <!-- View Data Online -->
                            <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                <label for="IDViewDataOnline">View Data Online</label>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label style="font-weight: 800;">DOKUMEN PABEAN</label>
                                    <input type="button" class="for-select-tpb" onclick='seBC()' value="Pilih Semua"/>
                                    <input type="button" class="for-unselect-tpb" onclick='deBC()' value="Batalkan"/>
                                    <div class="form-group">
                                        <label style="font-weight: 500;">1. BC</label>
                                        <input type="hidden" name="NameBC">
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameBC23MasterData" value="Y" id="IDBC23MasterData" class="form-check-input" />
                                                <label class="form-check-label" for="IDBC23MasterData">BC 2.7 / Master Data</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label style="font-weight: 800;">DATA</label>
                                    <input type="button" class="for-select-tpb" onclick='seData()' value="Pilih Semua"/>
                                    <input type="button" class="for-unselect-tpb" onclick='deData()' value="Batalkan"/>
                                    <div class="form-group">
                                        <label style="color: transparent;">DATA</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameCountTabelTPB" value="Y" id="IDCountTabelTPB" class="form-check-input" />
                                                <label class="form-check-label" for="IDCountTabelTPB">Count Tabel TPB</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameFilterTableTPB" value="Y" id="IDFilterTableTPB" class="form-check-input" />
                                                <label class="form-check-label" for="IDFilterTableTPB">Filter Tabel TPB</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label style="font-weight: 800;">REFERENSI</label>
                                    <input type="button" class="for-select-tpb" onclick='seRefAll()' value="Pilih Semua"/>
                                    <input type="button" class="for-unselect-tpb" onclick='deRefAll()' value="Batalkan"/>
                                    <div class="form-group">
                                        <label style="font-weight: 500;">1. Referensi</label>
                                        <input type="button" class="for-select-tpb" onclick='seRef()' value="Pilih Semua"/>
                                        <input type="button" class="for-unselect-tpb" onclick='deRef()' value="Batalkan"/>
                                        <input type="hidden" name="NameReferensi">
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameDaftarBarang" value="Y" id="IDDaftarBarang" class="form-check-input" />
                                                <label class="form-check-label" for="IDDaftarBarang">Daftar Barang</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameTarifHS" value="Y" id="IDTarifHS" class="form-check-input" />
                                                <label class="form-check-label" for="IDTarifHS">Tarif HS</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NamePemasok" value="Y" id="IDPemasok" class="form-check-input" />
                                                <label class="form-check-label" for="IDPemasok">Pemasok</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NamePerusahaan" value="Y" id="IDPerusahaan" class="form-check-input" />
                                                <label class="form-check-label" for="IDPerusahaan">Perusahaan</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameAlatAngkut" value="Y" id="IDAlatAngkut" class="form-check-input" />
                                                <label class="form-check-label" for="IDAlatAngkut">Alat Angkut</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameTempatPenimbunan" value="Y" id="IDTempatPenimbunan" class="form-check-input" />
                                                <label class="form-check-label" for="IDTempatPenimbunan">Tempat Penimbunan</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameKantorBeaCukai" value="Y" id="IDKantorBeaCukai" class="form-check-input" />
                                                <label class="form-check-label" for="IDKantorBeaCukai">Kantor Bea Cukai</label>
                                            </div>
                                        </div>
                                        <label style="font-weight: 500;">1.1 Edifact</label>
                                        <input type="button" class="for-select-tpb" onclick='seEdi()' value="Pilih Semua"/>
                                        <input type="button" class="for-unselect-tpb" onclick='deEdi()' value="Batalkan"/>
                                        <input type="hidden" name="Edifact">
                                        <div style="margin-left: 15px;">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="NameNegara" value="Y" id="IDNegara" class="form-check-input" />
                                                    <label class="form-check-label" for="IDNegara">Negara</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="NamePelabuhanDalamNegeri" value="Y" id="IDPelabuhanDalamNegeri" class="form-check-input" />
                                                    <label class="form-check-label" for="IDPelabuhanDalamNegeri">Pelabuhan Dalam Negeri</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="NamePelabuhanLuarNegeri" value="Y" id="IDPelabuhanLuarNegeri" class="form-check-input" />
                                                    <label class="form-check-label" for="IDPelabuhanLuarNegeri">Pelabuhan Luar Negeri</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="NameMataUang" value="Y" id="IDMataUang" class="form-check-input" />
                                                    <label class="form-check-label" for="IDMataUang">Mata Uang</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="NameSatuan" value="Y" id="IDSatuan" class="form-check-input" />
                                                    <label class="form-check-label" for="IDSatuan">Satuan</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="NameKemasan" value="Y" id="IDKemasan" class="form-check-input" />
                                                    <label class="form-check-label" for="IDKemasan">Kemasan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label style="font-weight: 800;">ADMINISTRATOR</label>
                                    <input type="button" class="for-select-tpb" onclick='seAdm()' value="Pilih Semua"/>
                                    <input type="button" class="for-unselect-tpb" onclick='deAdm()' value="Batalkan"/>
                                    <div class="form-group">
                                        <label style="color: transparent;">ADMINISTRATOR</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameDepartemen" value="Y" id="IDDepartemen" class="form-check-input" />
                                                <label class="form-check-label" for="IDDepartemen">Departemen</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameHakAkses" value="Y" id="IDHakAkses" class="form-check-input" />
                                                <label class="form-check-label" for="IDHakAkses">Hak Akses</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameJabatan" value="Y" id="IDJabatan" class="form-check-input" />
                                                <label class="form-check-label" for="IDJabatan">Jabatan</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameKuotaMitra" value="Y" id="IDKuotaMitra" class="form-check-input" />
                                                <label class="form-check-label" for="IDKuotaMitra">Kuota Mitra</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NamePengaturanAppTPB" value="Y" id="IDPengaturanAppTPB" class="form-check-input" />
                                                <label class="form-check-label" for="IDPengaturanAppTPB">Pengaturan App TPB</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NamePengaturanRealTimeReload" value="Y" id="IDPengaturanRealTimeReload" class="form-check-input" />
                                                <label class="form-check-label" for="IDPengaturanRealTimeReload">Pengaturan RealTime Reload</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NamePengaturanInformasi" value="Y" id="IDPengaturanInformasi" class="form-check-input" />
                                                <label class="form-check-label" for="IDPengaturanInformasi">Pengaturan Informasi</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameUserManajemenWeb" value="Y" id="IDUserManajemenWeb" class="form-check-input" />
                                                <label class="form-check-label" for="IDUserManajemenWeb">User Manajemen Web</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End View Data Online -->
                            <!-- Report -->
                            <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                <label for="IDReport">Report</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="font-weight: 800;">LAPORAN</label>
                                    <input type="button" class="for-select-tpb" onclick='seLap()' value="Pilih Semua"/>
                                    <input type="button" class="for-unselect-tpb" onclick='deLap()' value="Batalkan"/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapMasukBarang" value="Y" id="IDLapMasukBarang" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapMasukBarang">Laporan Masuk Barang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapKeluarBarang" value="Y" id="IDLapKeluarBarang" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapKeluarBarang">Laporan Keluar Barang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapMutasiBarang" value="Y" id="IDLapMutasiBarang" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapMutasiBarang">Laporan Mutasi Barang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapPosisiBarang" value="Y" id="IDLapPosisiBarang" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapPosisiBarang">Laporan Posisi Barang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapRealisasi" value="Y" id="IDLapRealisasi" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapRealisasi">Laporan Realisasi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapDataTPB" value="Y" id="IDLapDataTPB" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapDataTPB">Laporan Data TPB</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NamePLBReportCK5" value="Y" id="IDPLBReportCK5" class="form-check-input" />
                                        <label class="form-check-label" for="IDPLBReportCK5">PLB Report CK5</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameGBSarinahReportCK5" value="Y" id="IDGBSarinahReportCK5" class="form-check-input" />
                                        <label class="form-check-label" for="IDGBSarinahReportCK5">GB - Sarinah Report CK5</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapLogSystem" value="Y" id="IDLapLogSystem" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapLogSystem">Laporan Log System</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Report -->
                            <div class="col-md-12">
                                <font style="color: red;">*</font> <i>Wajib diisi.</i>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                    <button type="submit" name="add_hak_akses" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Users -->