<!-- Add Kuota -->
<a href="#modal-Kuota-Mitra" class="btn btn-primary" data-toggle="modal" title="Tambah Kuota Mitra"><i class="fas fa-plus-circle"></i> Tambah Kuota Mitra</a>
<div class="modal fade" id="modal-Kuota-Mitra">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="adm_kuota.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">[Tambah Data] Kuota Mitra</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="IdMitra">Nama Mitra <font style="color: red;">*</font></label>
                                    <select type="text" class="default-select2 form-control" name="NameMitra" id="IDMitra">
                                        <option value="">-- Pilih Mitra --</option>
                                        <?php
                                        $resultMitra = $dbcon->query("SELECT ID,NPWP,NAMA FROM referensi_pengusaha WHERE NAMA IS NOT NULL AND NAMA !='' ORDER BY NAMA ASC");
                                        foreach ($resultMitra as $RowMitra) {
                                        ?>
                                            <option value="<?= $RowMitra['ID'] ?>"><?= $RowMitra['NPWP'] ?> - <?= $RowMitra['NAMA'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdTahun">Tahun <font style="color: red;">*</font></label>
                                    <select type="text" class="default-select2 form-control" name="NameTahun" id="IDTahun">
                                        <option value="">-- Pilih Tahun --</option>
                                        <?php
                                        for($i=date('Y'); $i>=date('Y')-32; $i-=1) {
                                            echo "<option value='$i'> $i </option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Golongan A -->
                            <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                <label for="IdGol_A_Title">Golongan A</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdGol_A">Golongan A</label>
                                    <input type="text" class="form-control" name="NameGol_A" value="GOL A" readonly>
                                    <!-- <select type="text" class="form-control" name="NameGol_A" id="IDGol_A">
                                        <option value="">-- Pilih Barang Golongan A --</option>
                                        <?php
                                        $resultMitra = $dbcon->query("SELECT NAMA FROM referensi_pengusaha ORDER BY NAMA ASC");
                                        foreach ($resultMitra as $RowMitra) {
                                        ?>
                                            <option value="<?= $RowMitra['ID'] ?>"><?= $RowMitra['ID'] ?> - <?= $RowMitra['NAMA'] ?></option>
                                        <?php } ?>
                                    </select> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdCARTON">CARTON <font style="color: red;">*</font></label>
                                    <input type="number" class="form-control" name="NameKuotaCARTON_A" id="IdKuotaCARTON_A" placeholder="Kuota CARTON" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdLITER">LITER <font style="color: red;">*</font></label>
                                    <input type="number" class="form-control" name="NameKuotaLITER_A" id="IdKuotaLITER_A" placeholder="Kuota LITER" required>
                                </div>
                            </div>
                            <!-- End Golongan A -->
                            <!-- Golongan B -->
                            <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                <label for="IdGol_B_Title">Golongan B</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdGol_B">Golongan B <font style="color: red;">*</font></label>
                                    <input type="text" class="form-control" name="NameGol_B" value="GOL B" readonly>
                                    <!-- <select type="text" class="form-control" name="NameGol_B" id="IDGol_B">
                                        <option value="">-- Pilih Barang Golongan B --</option>
                                        <?php
                                        $resultMitra = $dbcon->query("SELECT NAMA FROM referensi_pengusaha ORDER BY NAMA ASC");
                                        foreach ($resultMitra as $RowMitra) {
                                        ?>
                                            <option value="<?= $RowMitra['ID'] ?>"><?= $RowMitra['ID'] ?> - <?= $RowMitra['NAMA'] ?></option>
                                        <?php } ?>
                                    </select> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdCARTON">CARTON <font style="color: red;">*</font></label>
                                    <input type="number" class="form-control" name="NameKuotaCARTON_B" id="IdKuotaCARTON_B" placeholder="Kuota CARTON" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdLITER">LITER <font style="color: red;">*</font></label>
                                    <input type="number" class="form-control" name="NameKuotaLITER_B" id="IdKuotaLITER_B" placeholder="Kuota LITER" required>
                                </div>
                            </div>
                            <!-- End Golongan B -->
                            <!-- Golongan C -->
                            <div class="col-md-12" style="background: #348fe2;display: flex;justify-content: center;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #fff;font-size: 14px;font-weight: 700;border-radius: 5px;">
                                <label for="IdGol_C_Title">Golongan C</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdGol_C">Golongan C <font style="color: red;">*</font></label>
                                    <input type="text" class="form-control" name="NameGol_C" value="GOL C" readonly>
                                    <!-- <select type="text" class="form-control" name="NameGol_C" id="IDGol_C">
                                        <option value="">-- Pilih Barang Golongan C --</option>
                                        <?php
                                        $resultMitra = $dbcon->query("SELECT NAMA FROM referensi_pengusaha ORDER BY NAMA ASC");
                                        foreach ($resultMitra as $RowMitra) {
                                        ?>
                                            <option value="<?= $RowMitra['ID'] ?>"><?= $RowMitra['ID'] ?> - <?= $RowMitra['NAMA'] ?></option>
                                        <?php } ?>
                                    </select> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdCARTON">CARTON <font style="color: red;">*</font></label>
                                    <input type="number" class="form-control" name="NameKuotaCARTON_C" id="IdKuotaCARTON_C" placeholder="Kuota CARTON" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IdLITER">LITER <font style="color: red;">*</font></label>
                                    <input type="number" class="form-control" name="NameKuotaLITER_C" id="IdKuotaLITER_C" placeholder="Kuota LITER" required>
                                </div>
                            </div>
                            <!-- End Golongan C -->
                            <div class="col-md-12">
                                <font style="color: red;">*</font> <i>Wajib diisi.</i>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                    <button type="submit" name="add_kuota" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Kuota -->