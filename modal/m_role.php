<!-- Add Users -->
<a href="#modal-User-Web-System" class="btn btn-primary" data-toggle="modal" title="Tambah Hak Akses"><i class="fas fa-plus-circle"></i>
    <font class="f-action">Tambah Hak Akses</font>
</a>
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
                                    <textarea type="text" class="form-control" name="NameDescription" id="IdDescription" placeholder="Deskripsi ..."></textarea>
                                </div>
                            </div>
                            <!-- Dashboard -->
                            <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                <label for="IDDahboardSummary">Dashboard</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="font-weight: 800;">DASHBOARD</label>
                                    <input type="button" class="for-select-tpb" onclick='seDash()' value="Pilih Semua" />
                                    <input type="button" class="for-unselect-tpb" onclick='deDash()' value="Batalkan" />
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
                            <!-- End Dashboard -->
                            <!-- Data Online -->
                            <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                <label for="IDViewDataOnline">Data Online</label>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label style="font-weight: 800;">GATE MANDIRI</label>
                                    <input type="button" class="for-select-tpb" onclick='seGM()' value="Pilih Semua" />
                                    <input type="button" class="for-unselect-tpb" onclick='deGM()' value="Batalkan" />
                                    <div class="form-group">
                                        <label style="color: transparent;">GATE MANDIRI</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameGateIN" value="Y" id="IDGateIN" class="form-check-input" />
                                                <label class="form-check-label" for="IDGateIN">Gate In</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameGateOUT" value="Y" id="IDGateOUT" class="form-check-input" />
                                                <label class="form-check-label" for="IDGateOUT">Gate Out</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 800;">DOKUMEN PABEAN</label>
                                    <input type="button" class="for-select-tpb" onclick='seBC()' value="Pilih Semua" />
                                    <input type="button" class="for-unselect-tpb" onclick='deBC()' value="Batalkan" />
                                    <div class="form-group">
                                        <label style="color: transparent;">DOKUMEN PABEAN</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameDokumenPLB" value="Y" id="IDDokumenPLB" class="form-check-input" />
                                                <label class="form-check-label" for="IDDokumenPLB">Dokumen PLB</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameDokumenGB" value="Y" id="IDDokumenGB" class="form-check-input" />
                                                <label class="form-check-label" for="IDDokumenGB">Dokumen GB</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label style="font-weight: 800;">DATA</label>
                                    <input type="button" class="for-select-tpb" onclick='seData()' value="Pilih Semua" />
                                    <input type="button" class="for-unselect-tpb" onclick='deData()' value="Batalkan" />
                                    <div class="form-group">
                                        <label style="color: transparent;">DATA</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameKuotaMitra" value="Y" id="IDKuotaMitra" class="form-check-input" />
                                                <label class="form-check-label" for="IDKuotaMitra">Kuota Mitra</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameStokBarang" value="Y" id="IDStokBarang" class="form-check-input" />
                                                <label class="form-check-label" for="IDStokBarang">Stok Barang</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label style="font-weight: 800;">UPLOAD</label>
                                    <input type="button" class="for-select-tpb" onclick='seUpload()' value="Pilih Semua" />
                                    <input type="button" class="for-unselect-tpb" onclick='deUpload()' value="Batalkan" />
                                    <div class="form-group">
                                        <label style="color: transparent;">UPLOAD</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameBC27PLB" value="Y" id="IDUpload" class="form-check-input" />
                                                <label class="form-check-label" for="IDUpload">BC 2.7 PLB</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 800;">SETTINGS</label>
                                    <input type="button" class="for-select-tpb" onclick='seSettings()' value="Pilih Semua" />
                                    <input type="button" class="for-unselect-tpb" onclick='deSettings()' value="Batalkan" />
                                    <div class="form-group">
                                        <label style="color: transparent;">SETTINGS</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="NameSettings" value="Y" id="IDSettings" class="form-check-input" />
                                                <label class="form-check-label" for="IDSettings">Settings</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label style="font-weight: 800;">ADMINISTRATOR</label>
                                    <input type="button" class="for-select-tpb" onclick='seAdm()' value="Pilih Semua" />
                                    <input type="button" class="for-unselect-tpb" onclick='deAdm()' value="Batalkan" />
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
                            <!-- End Data Online -->
                            <!-- Report -->
                            <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                <label for="IDReport">Laporan</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="font-weight: 800;">LAPORAN</label>
                                    <input type="button" class="for-select-tpb" onclick='seLap()' value="Pilih Semua" />
                                    <input type="button" class="for-unselect-tpb" onclick='deLap()' value="Batalkan" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapMasukBarang" value="Y" id="IDLapMasukBarang" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapMasukBarang">Laporan Barang Masuk</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapKeluarBarang" value="Y" id="IDLapKeluarBarang" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapKeluarBarang">Laporan Barang Keluar</label>
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
                                        <input type="checkbox" name="NameLapMutasiBarang" value="Y" id="IDLapMutasiBarang" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapMutasiBarang">Laporan Mutasi Barang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapRealisasi" value="Y" id="IDLapRealisasi" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapRealisasi">Laporan Realisasi Barang</label>
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
                                        <input type="checkbox" name="NameLapDataPLB" value="Y" id="IDLapDataPLB" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapDataPLB">Laporan Data PLB</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="NameLapDataGB" value="Y" id="IDLapDataGB" class="form-check-input" />
                                        <label class="form-check-label" for="IDLapDataGB">Laporan Data GB</label>
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