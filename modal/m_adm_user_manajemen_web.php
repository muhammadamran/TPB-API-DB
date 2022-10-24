<!-- Add Users -->
<a href="#modal-User-Web-System" class="btn btn-primary" data-toggle="modal" title="Tambah User Manajemen Web"><i class="fas fa-plus-circle"></i> Tambah User Manajemen Web</a>
<div class="modal fade" id="modal-User-Web-System">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="adm_user_manajemen_web.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">[Tambah Data] User Manajemen Web</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="margin-bottom: 10px;">
                                    <font style="font-size: 20px;font-weight: 700;"><i class="fas fa-user-check"></i> Sign In Detail</font>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IDUsername">Username <font style="color: red;">*</font></label>
                                    <input type="text" class="form-control" name="username" id="IDUsername" placeholder="Username ..." required />
                                    <input type="hidden" name="UNIQ" value="USR<?= date('my') ?><?= substr(uniqid(), 5); ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IDPassword">Password</label>
                                    <input type="password" class="form-control" id="IDPassword" placeholder="Password ..." readonly />
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div style="margin-bottom: 10px;">
                                    <font style="font-size: 20px;font-weight: 700;"><i class="fas fa-address-card"></i> Profile</font>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="IDFoto">Foto</label>
                                    <input type="file" class="form-control" id="IDFoto" placeholder="Foto ..." />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IDNIP">NIP</label>
                                    <input type="number" class="form-control" id="IDNIP" placeholder="NIP ..." />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IDNIK">NIK</label>
                                    <input type="number" class="form-control" id="IDNIK" placeholder="NIK ..." />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IDNamaLengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="IDNamaLengkap" placeholder="Nama Lengkap ..." />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="IDTempatLahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="IDTempatLahir" placeholder="Tempat Lahir ..." />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="IDTglLahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="IDTglLahir" placeholder="Tanggal Lahir ..." />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="IDUsia">Usia</label>
                                    <input type="number" class="form-control" id="IDUsia" placeholder="Usia ..." />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IDJenisKelamin">Jenis Kelamin</label>
                                    <select type="text" class="form-control" name="" id="IDJenisKelamin">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IDAgama">Agama</label>
                                    <select type="text" class="form-control" name="" id="IDAgama">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="IDAlamat">Alamat</label>
                                    <textarea type="number" class="form-control" id="IDAlamat" placeholder="Alamat ..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IDTelepon">Telepon</label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">+62</span></div>
                                        <input type="number" class="form-control" id="IDTelepon" placeholder="Telepon ..." />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IDEmail">Email</label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">@</span></div>
                                        <input type="email" class="form-control" id="IDEmail" placeholder="Email ..." />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IDDepartment">Departemen</label>
                                    <select type="text" class="form-control" name="" id="IDDepartment">
                                        <option value="">-- Pilih Departemen --</option>
                                        <?php
                                        $resultDepartment = $dbcon->query("SELECT department FROM tbl_department ORDER BY department ASC");
                                        foreach ($resultDepartment as $RowDepartment) {
                                        ?>
                                            <option value="<?= $RowDepartment['department'] ?>"><?= $RowDepartment['department'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IDJabatan">Jabatan</label>
                                    <select type="text" class="form-control" name="" id="IDJabatan">
                                        <option value="">-- Pilih Jabatan --</option>
                                        <?php
                                        $resultJabatan = $dbcon->query("SELECT jabatan FROM tbl_jabatan ORDER BY jabatan ASC");
                                        foreach ($resultJabatan as $RowJabatan) {
                                        ?>
                                            <option value="<?= $RowJabatan['jabatan'] ?>"><?= $RowJabatan['jabatan'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IDTglBergabung">Tanggal Bergabung</label>
                                    <input type="date" class="form-control" id="IDTglBergabung" placeholder="Tanggal Bergabung ..." />
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div style="margin-bottom: 10px;">
                                    <font style="font-size: 20px;font-weight: 700;"><i class="fas fa-user-cog"></i> Hak Akses</font>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IDRole">Hak Akses <font style="color: red;">*</font></label>
                                    <select type="text" class="form-control" name="HakAkses" id="IDRole" required>
                                        <option value="">-- Pilih Hak Akses --</option>
                                        <?php
                                        $resultHakAkses = $dbcon->query("SELECT role FROM tbl_role ORDER BY role ASC");
                                        foreach ($resultHakAkses as $rowHakAkses) {
                                        ?>
                                            <option value="<?= $rowHakAkses['role'] ?>"><?= $rowHakAkses['role'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-3 col-form-label">Privileges</label>
                                <div class="col-md-9">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="able_add" value="Y" id="checkbox-inline-1" class="form-check-input" />
                                        <label class="form-check-label" for="checkbox-inline-1">Insert Data</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="able_edit" value="Y" id="checkbox-inline-2" class="form-check-input" />
                                        <label class="form-check-label" for="checkbox-inline-2">Update Data</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="able_delete" value="Y" id="checkbox-inline-3" class="form-check-input" />
                                        <label class="form-check-label" for="checkbox-inline-3">Hapus Data</label>
                                    </div>
                                    <!-- <div class="form-check form-check-inline">
                                        <input type="checkbox" name="able_send" value="Y" id="checkbox-inline-4" class="form-check-input" />
                                        <label class="form-check-label" for="checkbox-inline-4">Kirim Data</label>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox checkbox-css m-b-20">
                                    <input type="checkbox" id="nf_checkbox_css_1" name="able_password" value="Y" />
                                    <label for="nf_checkbox_css_1">Klik jika User dapat melakukan update password secara mandiri.</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <font style="color: red;">*</font> <i>Wajib diisi.</i>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                    <button type="submit" name="add_manajemen_user_web" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Users -->