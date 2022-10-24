<?php
include "../include/connection.php";

if(isset($_GET['s_mitra'])){
	$s_mitra = $_GET['s_mitra'];
	$dataGetPengusaha = $dbcon->query("SELECT * FROM referensi_pengusaha WHERE NPWP='$s_mitra'");
	$resultGetPengusaha = mysqli_fetch_array($dataGetPengusaha);
	echo "<input type='text' name='ID' class='form-control' value=" . $resultGetPengusaha['ID'] . ">";
	echo "<input type='text' name='NAMA' class='form-control' value=" . $resultGetPengusaha['NAMA'] . ">";
}

if(isset($_GET['c_id'])){
	$c_id = $_GET['c_id'];
	$dataGetPengusaha = $dbcon->query("SELECT * FROM referensi_pengusaha WHERE NPWP='$c_id'");
	$resultGetPengusaha = mysqli_fetch_array($dataGetPengusaha);
	echo "<textarea type='text' class='for-area-one-oke' name='ALAMAT'>" . $resultGetPengusaha['ALAMAT'] . "</textarea>";
}

// E. DATA PEMBERITAHUAN
// Tempat Asal Pemasok
if(isset($_GET['v_tap'])){
	$v_tap = $_GET['v_tap'];
	$dataGetTempatAsalPemasok = $dbcon->query("SELECT a.ID,a.ALAMAT,a.CONTACT_PERSON,a.EMAIL,a.FAX,a.ID_PENGENAL,a.JENISTPB,a.KODE_ID,a.KODE_KANTOR,a.NAMA,a.NOMOR_PENGENAL,a.NOMOR_SKEP,a.NPWP,a.STATUS_IMPORTIR,
                                               a.TANGGAL_SKEP,a.TELEPON,
                                               b.KODE_STATUS_PENGUSAHA,b.URAIAN_STATUS_PENGUSAHA,
                                               c.NPPBKC
                                        FROM referensi_pengusaha AS a
                                        LEFT JOIN referensi_status_pengusaha AS b ON a.KODE_ID=b.KODE_STATUS_PENGUSAHA 
                                        LEFT JOIN tbl_ref_pengusaha AS c ON c.NPWP=a.NPWP
                                        WHERE a.NAMA='$v_tap'
                                        ORDER BY a.NAMA DESC");
	$resultGetTempatAsalPemasok = mysqli_fetch_array($dataGetTempatAsalPemasok);
	echo "<input type='hidden' class='form-control' name='NameNPWPUpdatePemasok' value=" . $resultGetTempatAsalPemasok['NPWP'] . ">";
	echo "<input type='hidden' class='form-control' name='NameNPPBKCUpdatePemasok' value=" . $resultGetTempatAsalPemasok['NPPBKC'] . ">";
	echo "<div class='form-group'>";
	echo "<label>Alamat Tempat Tujuan</label>";
	echo "<textarea type='hidden' class='form-control' name='NameAlamatUpdatePemasok'>" . $resultGetTempatAsalPemasok['ALAMAT'] . "</textarea>";
	echo "</div>";
}

// Tempat Tujuan
if(isset($_GET['v_ttp'])){
	$v_ttp = $_GET['v_ttp'];
	$dataGetTempatAsalPemasok = $dbcon->query("SELECT a.ID,a.ALAMAT,a.CONTACT_PERSON,a.EMAIL,a.FAX,a.ID_PENGENAL,a.JENISTPB,a.KODE_ID,a.KODE_KANTOR,a.NAMA,a.NOMOR_PENGENAL,a.NOMOR_SKEP,a.NPWP,a.STATUS_IMPORTIR,
                                               a.TANGGAL_SKEP,a.TELEPON,
                                               b.KODE_STATUS_PENGUSAHA,b.URAIAN_STATUS_PENGUSAHA,
                                               c.NPPBKC
                                        FROM referensi_pengusaha AS a
                                        LEFT JOIN referensi_status_pengusaha AS b ON a.KODE_ID=b.KODE_STATUS_PENGUSAHA 
                                        LEFT JOIN tbl_ref_pengusaha AS c ON c.NPWP=a.NPWP
                                        WHERE a.NAMA='$v_ttp'
                                        ORDER BY a.NAMA DESC");
	$resultGetTempatAsalPemasok = mysqli_fetch_array($dataGetTempatAsalPemasok);
	echo "<input type='hidden' class='form-control' name='NameNPWPUpdateTempatTujuan' value=" . $resultGetTempatAsalPemasok['NPWP'] . ">";
	echo "<input type='hidden' class='form-control' name='NameNPPBKCUpdateTempatTujuan' value=" . $resultGetTempatAsalPemasok['NPPBKC'] . ">";
	echo "<div class='form-group'>";
	echo "<label>Alamat Tempat Tujuan</label>";
	echo "<textarea type='hidden' class='form-control' name='NameAlamatUpdateTempatTujuan'>" . $resultGetTempatAsalPemasok['ALAMAT'] . "</textarea>";
	echo "</div>";
}


// Nama, Kode Kantor TEMPAT ASAL PEMASOK
if(isset($_GET['c_kode_one'])){
	$c_kode_one = $_GET['c_kode_one'];
	$dataGetPengusaha = $dbcon->query("SELECT * FROM referensi_kantor_pabean WHERE KODE_KANTOR='$c_kode_one'");
	$resultGetPengusaha = mysqli_fetch_array($dataGetPengusaha);
	echo "<input type='text' name='NameKodeKantorPemasok' style='border: transparent;width: 70px' value=" . $resultGetPengusaha['KODE_KANTOR'] . ">";
	echo "<input type='hidden' name='InputKodeOneUraianKantorPemasok' value=" . $resultGetPengusaha['URAIAN_KANTOR'] . ">";
}
// Nama, Kode Kantor TEMPAT TUJUAN PENGGUNA
if(isset($_GET['c_kode_two'])){
	$c_kode_two = $_GET['c_kode_two'];
	$dataGetPengusaha = $dbcon->query("SELECT * FROM referensi_kantor_pabean WHERE KODE_KANTOR='$c_kode_two'");
	$resultGetPengusaha = mysqli_fetch_array($dataGetPengusaha);
	echo "<input type='text' name='NameKodeKantorTujuan' style='border: transparent;width: 70px' value=" . $resultGetPengusaha['KODE_KANTOR'] . ">";
	echo "<input type='hidden' name='InputKodeTwoUraianKantorTujuan' value=" . $resultGetPengusaha['URAIAN_KANTOR'] . ">";
}
?>