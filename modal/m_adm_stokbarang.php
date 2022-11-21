<!-- Add Kuota -->
<a href="#modal-Stok-Barang" class="btn btn-primary" data-toggle="modal" title="Tambah Stok Barang"><i class="fas fa-plus-circle"></i>
    <font class="f-action">Tambah Stok Barang</font>
</a>
<div class="modal fade" id="modal-Stok-Barang">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="adm_stokbarang.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">[Tambah Data] Stok Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IDBarang">Barang <font style="color: red;">*</font></label>
                                    <select type="text" class="default-select2 form-control" name="NameBarang" id="IDBarang" required>
                                        <option value="">-- Pilih Barang --</option>
                                        <?php
                                        $dataBarang = $dbcon->query("SELECT KODE_BARANG,URAIAN FROM plb_barang GROUP BY KODE_BARANG ORDER BY KODE_BARANG ASC");
                                        foreach ($dataBarang as $rowBarang) {
                                        ?>
                                            <option value="<?= $rowBarang['KODE_BARANG'] ?>"><?= $rowBarang['KODE_BARANG'] ?> - <?= $rowBarang['URAIAN'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IDBulan">Bulan <font style="color: red;">*</font></label>
                                    <select type="text" class="default-select2 form-control" name="NameBulan" id="IDBulan" required>
                                        <option value="">-- Pilih Bulan --</option>
                                        <option value="1">January</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="IDTahun">Tahun <font style="color: red;">*</font></label>
                                    <select type="text" class="default-select2 form-control" name="NameTahun" id="IDTahun" required>
                                        <option value="">-- Pilih Tahun --</option>
                                        <?php
                                        for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
                                            echo "<option value='$i'> $i </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IDJumlahCarton">Jumlah Carton <font style="color: red;">*</font></label>
                                    <input type="number" class="form-control" name="NameCarton" id="IDJumlahCarton" placeholder="Jumlah Carton" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="IDJumlahBotol">Jumlah Botol <font style="color: red;">*</font></label>
                                    <input type="number" class="form-control" name="NameBotol" id="IDJumlahBotol" placeholder="Jumlah Botol" required>
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
                    <button type="submit" name="add_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Kuota -->