<!-- Add Users -->
<a href="#modal-User-Web-System" class="btn btn-primary" data-toggle="modal" title="Tambah Departemen"><i class="fas fa-plus-circle"></i> Tambah Departemen</a>
<div class="modal fade" id="modal-User-Web-System">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="adm_department.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">[Tambah Data] Departemen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IdDepartment">Departemen <font style="color: red;">*</font></label>
                                    <input type="text" class="form-control" name="NameDepartment" id="IdDepartment" placeholder="Departemen ..." required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IdDescription">Deskripsi </label>
                                    <textarea type="text" class="form-control" name="NameDescription" id="IdDescription" placeholder="Deskripsi ..." ></textarea>
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
                    <button type="submit" name="add_department" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Users -->