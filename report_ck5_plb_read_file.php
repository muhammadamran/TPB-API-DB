<?php
include 'include/connection.php';
if (!$dbcon) {
	die("Connection failed: " . mysqli_connect_error());
}

require_once "Classes/PHPExcel.php";
$path="files/ck5plb/".$file_name;
$reader= PHPExcel_IOFactory::createReaderForFile($path);
$excel_Obj = $reader->load($path);

// FOR AKTIFITAS
$me = $_POST['username'];
$datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
$resultme = mysqli_fetch_array($datame);

$IDUNIQme             = $resultme['USRIDUNIQ'];
$InputUsername        = $me;
$InputModul           = 'Report/PLB CK5';
$InputDescription     = $me . " Upload Excel PLB CK5 nama file: ".$file_name.", Simpan Data Sebagai Report PLB CK5";
$InputAction          = 'Upload PLB CK5';
$InputDate            = date('Y-m-d h:m:i');

$query = $dbcon->query("INSERT INTO tbl_aktifitas
                       (id,IDUNIQ,username,modul,description,action,date_created)
                       VALUES
                       ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

$dateupload           = date('Y-m-d h:m:i');
$UploadStatus     = 'Success';

$query .= $dbcon->query("INSERT INTO plb_log
                       (ID,username,filename,totalupload,dateupload,status)
                       VALUES
                       ('','$me','$file_name','$size','$dateupload','$UploadStatus')");

//Header
$worksheet=$excel_Obj->getSheet('0');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_header (NOMOR_AJU, KPPBC, PERUSAHAAN, PEMASOK, STATUS, KODE_DOKUMEN_PABEAN, NPPJK, ALAMAT_PEMASOK, ALAMAT_PEMILIK, ALAMAT_PENERIMA_BARANG, ALAMAT_PENGIRIM, ALAMAT_PENGUSAHA, ALAMAT_PPJK, API_PEMILIK, API_PENERIMA, API_PENGUSAHA, ASAL_DATA, ASURANSI, BIAYA_TAMBAHAN, BRUTO, CIF, CIF_RUPIAH, DISKON, FLAG_PEMILIK, URL_DOKUMEN_PABEAN, FOB, FREIGHT, HARGA_BARANG_LDP, HARGA_INVOICE, HARGA_PENYERAHAN, HARGA_TOTAL, ID_MODUL, ID_PEMASOK, ID_PEMILIK, ID_PENERIMA_BARANG, ID_PENGIRIM, ID_PENGUSAHA, ID_PPJK, JABATAN_TTD, JUMLAH_BARANG, JUMLAH_KEMASAN, JUMLAH_KONTAINER, KESESUAIAN_DOKUMEN, KETERANGAN, KODE_ASAL_BARANG, KODE_ASURANSI, KODE_BENDERA, KODE_CARA_ANGKUT, KODE_CARA_BAYAR, KODE_DAERAH_ASAL, KODE_FASILITAS, KODE_FTZ, KODE_HARGA, KODE_ID_PEMASOK, KODE_ID_PEMILIK, KODE_ID_PENERIMA_BARANG, KODE_ID_PENGIRIM, KODE_ID_PENGUSAHA, KODE_ID_PPJK, KODE_JENIS_API, KODE_JENIS_API_PEMILIK, KODE_JENIS_API_PENERIMA, KODE_JENIS_API_PENGUSAHA, KODE_JENIS_BARANG, KODE_JENIS_BC25, KODE_JENIS_NILAI, KODE_JENIS_PEMASUKAN01, KODE_JENIS_PEMASUKAN_02, KODE_JENIS_TPB, KODE_KANTOR_BONGKAR, KODE_KANTOR_TUJUAN, KODE_LOKASI_BAYAR, KODE_NEGARA_PEMASOK, KODE_NEGARA_PENGIRIM, KODE_NEGARA_PEMILIK, KODE_NEGARA_TUJUAN, KODE_PEL_BONGKAR, KODE_PEL_MUAT, KODE_PEL_TRANSIT, KODE_PEMBAYAR, KODE_STATUS_PENGUSAHA, STATUS_PERBAIKAN, KODE_TPS, KODE_TUJUAN_PEMASUKAN, KODE_TUJUAN_PENGIRIMAN, KODE_TUJUAN_TPB, KODE_TUTUP_PU, KODE_VALUTA, KOTA_TTD, NAMA_PEMILIK, NAMA_PENERIMA_BARANG, NAMA_PENGANGKUT, NAMA_PENGIRIM, NAMA_PPJK, NAMA_TTD, NDPBM, NETTO, NILAI_INCOTERM, NIPER_PENERIMA, NOMOR_API, NOMOR_BC11, NOMOR_BILLING, NOMOR_DAFTAR, NOMOR_IJIN_BPK_PEMASOK, NOMOR_IJIN_BPK_PENGUSAHA, NOMOR_IJIN_TPB, NOMOR_IJIN_TPB_PENERIMA, NOMOR_VOYV_FLIGHT, NPWP_BILLING, POS_BC11, SERI, SUBPOS_BC11, SUB_SUBPOS_BC11, TANGGAL_BC11, TANGGAL_BERANGKAT, TANGGAL_BILLING, TANGGAL_DAFTAR, TANGGAL_IJIN_BPK_PEMASOK, TANGGAL_IJIN_BPK_PENGUSAHA, TANGGAL_IJIN_TPB, TANGGAL_NPPPJK, TANGGAL_TIBA, TANGGAL_TTD, TANGGAL_JATUH_TEMPO, TOTAL_BAYAR, TOTAL_BEBAS, TOTAL_DILUNASI, TOTAL_JAMIN, TOTAL_SUDAH_DILUNASI, TOTAL_TANGGUH, TOTAL_TANGGUNG, TOTAL_TIDAK_DIPUNGUT, URL_DOKUMEN_PABEAN_2, VERSI_MODUL, VOLUME, WAKTU_BONGKAR, WAKTU_STUFFING, NOMOR_POLISI, CALL_SIGN, JUMLAH_TANDA_PENGAMAN, KODE_JENIS_TANDA_PENGAMAN, KODE_KANTOR_MUAT, KODE_PEL_TUJUAN, TANGGAL_STUFFING, TANGGAL_MUAT, KODE_GUDANG_ASAL, KODE_GUDANG_TUJUAN) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 1 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}

// BahanBaku
$worksheet=$excel_Obj->getSheet('1');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_bahanbaku (NOMOR_AJU, SERI_BARANG, SERI_BAHAN_BAKU, CIF, CIF_RUPIAH, HARGA_PENYERAHAN, HARGA_PEROLEHAN, JENIS_SATUAN, JUMLAH_SATUAN, KODE_ASAL_BAHAN_BAKU, KODE_BARANG, KODE_FASILITAS, KODE_JENIS_DOK_ASAL, KODE_KANTOR, KODE_SKEMA_TARIF, KODE_STATUS, MERK, NDPBM, NETTO, NOMOR_AJU_DOKUMEN_ASAL, NOMOR_DAFTAR_DOKUMEN_ASAL, POS_TARIF, SERI_BARANG_DOKUMEN_ASAL, SPESIFIKASI_LAIN, TANGGAL_DAFTAR_DOKUMEN_ASAL, TIPE, UKURAN, URAIAN, SERI_IJIN) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 2 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}


// BahanBakuTarif
$worksheet=$excel_Obj->getSheet('2');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_bahanbakutarif (NOMOR_AJU, SERI_BARANG, SERI_BAHAN_BAKU, JENIS_TARIF, JUMLAH_SATUAN, KODE_ASAL_BAHAN_BAKU, KODE_FASILITAS, KODE_KOMODITI_CUKAI, KODE_SATUAN, KODE_TARIF, NILAI_BAYAR, NILAI_FASILITAS, NILAI_SUDAH_DILUNASI, TARIF, TARIF_FASILITAS) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 2 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}

// BahanBakuDokumen
$worksheet=$excel_Obj->getSheet('3');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_bahanbakudokumen (NOMOR_AJU, SERI_BARANG, SERI_BAHAN_BAKU, SERI_DOKUMEN, KODE_ASAL_BAHAN_BAKU) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 2 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}

// Barang
$worksheet=$excel_Obj->getSheet('4');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_barang (NOMOR_AJU, SERI_BARANG, ASURANSI, CIF, CIF_RUPIAH, DISKON, FLAG_KENDARAAN, FOB, FREIGHT, BARANG_BARANG_LDP, HARGA_INVOICE, HARGA_PENYERAHAN, HARGA_SATUAN, JENIS_KENDARAAN, JUMLAH_BAHAN_BAKU, JUMLAH_KEMASAN, JUMLAH_SATUAN, KAPASITAS_SILINDER, KATEGORI_BARANG, KODE_ASAL_BARANG, KODE_BARANG, KODE_FASILITAS, KODE_GUNA, KODE_JENIS_NILAI, KODE_KEMASAN, KODE_LEBIH_DARI_4_TAHUN, KODE_NEGARA_ASAL, KODE_SATUAN, KODE_SKEMA_TARIF, KODE_STATUS, KONDISI_BARANG, MERK, NETTO, NILAI_INCOTERM, NILAI_PABEAN, NOMOR_MESIN, POS_TARIF, SERI_POS_TARIF, SPESIFIKASI_LAIN, TAHUN_PEMBUATAN, TIPE, UKURAN, URAIAN, VOLUME, SERI_IJIN, ID_EKSPORTIR, NAMA_EKSPORTIR, ALAMAT_EKSPORTIR, KODE_PERHITUNGAN, SERI_BARANG_DOK_ASAL) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 2 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}

// BarangTarif
$worksheet=$excel_Obj->getSheet('5');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_barangtarif (NOMOR_AJU, SERI_BARANG, JENIS_TARIF, JUMLAH_SATUAN, KODE_FASILITAS, KODE_KOMODITI_CUKAI, TARIF_KODE_SATUAN, TARIF_KODE_TARIF, TARIF_NILAI_BAYAR, TARIF_NILAI_FASILITAS, TARIF_NILAI_SUDAH_DILUNASI, TARIF, TARIF_FASILITAS) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 2 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}

// BarangDokumen
$worksheet=$excel_Obj->getSheet('6');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_barangdokumen (NOMOR_AJU, SERI_BARANG, SERI_DOKUMEN) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 2 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}

// Dokumen
$worksheet=$excel_Obj->getSheet('7');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_dokumen (NOMOR_AJU, SERI_DOKUMEN, FLAG_URL_DOKUMEN, KODE_JENIS_DOKUMEN, NOMOR_DOKUMEN, TANGGAL_DOKUMEN, TIPE_DOKUMEN, URL_DOKUMEN) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 2 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}

// Kemasan
$worksheet=$excel_Obj->getSheet('8');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_kemasan (NOMOR_AJU, SERI_KEMASAN, JUMLAH_KEMASAN, KESESUAIAN_DOKUMEN, KETERANGAN, KODE_JENIS_KEMASAN, MEREK_KEMASAN, NIP_GATE_IN, NIP_GATE_OUT, NOMOR_POLISI, NOMOR_SEGEL, WAKTU_GATE_IN, WAKTU_GATE_OUT) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 2 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}

// Kontainer
$worksheet=$excel_Obj->getSheet('9');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_kontainer (NOMOR_AJU, SERI_KONTAINER, KESESUAIAN_DOKUMEN, KETERANGAN, KODE_STUFFING, KODE_TIPE_KONTAINER, KODE_UKURAN_KONTAINER, FLAG_GATE_IN, FLAG_GATE_OUT, NOMOR_POLISI, NOMOR_KONTAINER, NOMOR_SEGEL, WAKTU_GATE_IN, WAKTU_GATE_OUT) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 2 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}

// Respon
$worksheet=$excel_Obj->getSheet('10');
$colomncount = $worksheet->getHighestDataColumn();
$rowcount = $worksheet->getHighestRow();
$colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
$insertquery='INSERT INTO plb_respon (NOMOR_AJU, KODE_RESPON, NOMOR_RESPON, TANGGAL_RESPON, WAKTU_RESPON, BYTE_STRAM_PDF) VALUES ';
$subquery='';
for($row=2;$row<=$rowcount;$row++){
	$subquery=$subquery.' (';
	for($col=0;$col<$colomncount_number;$col++){
		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
	}
	$subquery = substr($subquery, 0, strlen($subquery) - 1);
	$subquery=$subquery.')'.' , ';
}
$insertquery=$insertquery.$subquery;
$insertquery= substr($insertquery,0,strlen($insertquery)-2);

if (mysqli_query($dbcon, $insertquery)) {
	// echo "Sheet 2 Uploaded <br>";
} else {
	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
}

// // Status
// $worksheet=$excel_Obj->getSheet('0');
// $colomncount = $worksheet->getHighestDataColumn();
// $rowcount = $worksheet->getHighestRow();
// $colomncount_number=PHPExcel_Cell::columnIndexFromString($colomncount);
// $insertquery='INSERT INTO plb_status (NOMOR_AJU, KODE_RESPON, NOMOR_RESPON) VALUES ';
// $subquery='';
// for($row=2;$row<=2;$row++){
// 	$subquery=$subquery.' (';
// 	for($col=0;$col<$colomncount_number;$col++){
// 		$subquery=$subquery.'\''.$worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col).$row)->getValue().'\',';
// 	}
// 	$subquery = substr($subquery, 0, strlen($subquery) - 1);
// 	$subquery=$subquery.')'.' , ';
// }
// $insertquery=$insertquery.$subquery;
// $insertquery= substr($insertquery,0,strlen($insertquery)-2);

// if (mysqli_query($dbcon, $insertquery)) {
// 	// echo "Sheet 2 Uploaded <br>";
// } else {
// 	echo "Error: " . $insertquery . "<br>" . mysqli_error($dbcon);
// }
 
$cekRespon = $dbcon->query("SELECT NOMOR_AJU,KODE_RESPON,NOMOR_RESPON FROM plb_respon ORDER BY ID DESC LIMIT 1");
$resultcekRespon = mysqli_fetch_array($cekRespon);

$inputNoAJU    = $resultcekRespon['NOMOR_AJU'];
$inputKDRespon = $resultcekRespon['KODE_RESPON'];
$inputNoRespon = $resultcekRespon['NOMOR_RESPON'];
$inputck5_plb_submit = date('Y-m-d h:m:i');

$query .= $dbcon->query("INSERT INTO plb_status
                       (ID,NOMOR_AJU,KODE_RESPON,NOMOR_RESPON,ck5_plb_submit)
                       VALUES
                       ('','$inputNoAJU','$inputKDRespon','$inputNoRespon','$inputck5_plb_submit')");

mysqli_close($dbcon);
?>