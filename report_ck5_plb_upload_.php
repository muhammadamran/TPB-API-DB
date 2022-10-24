<?php
include 'Classes/PHPExcelSheet.php';
// include "include/connection.php";	
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

if (isset($_FILES["file_upload"])) {
	$dir = "files/ck5plb/";
	$timeUpload = date('Y-m-d h:m:i');
	$file_name = $timeUpload."_".$_FILES["file_upload"]["name"];
	$size = $_FILES["file_upload"]["size"];
	$tmp_file_name = $_FILES["file_upload"]["tmp_name"];
	move_uploaded_file($tmp_file_name, $dir . $file_name);

	// For Name Row Excel
	// Header
	$dataHeader = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowHeader = $dataHeader->rowcount($sheet_index=0);
	$NameHeader  			= $RowHeader;
	// BahanBaku
	$dataBahanBaku = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowBahanBaku = $dataBahanBaku->rowcount($sheet_index=1);
	$NameBahanBaku  		= $RowBahanBaku;
	// BahanBakuTarif
	$dataBahanBakuTarif = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowBahanBakuTarif = $dataBahanBakuTarif->rowcount($sheet_index=2);
	$NameBahanBakuTarif  	= $RowBahanBakuTarif;
	// BahanBakuDokumen
	$dataBahanBakuDokumen = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowBahanBakuDokumen = $dataBahanBakuDokumen->rowcount($sheet_index=3);
	$NameBahanBakuDokumen  	= $RowBahanBakuDokumen;
	// Barang
	$dataBarang = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowBarang = $dataBarang->rowcount($sheet_index=4);
	$NameBarang  			= $RowBarang;
	// BarangTarif
	$dataBarangTarif = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowBarangTarif = $dataBarangTarif->rowcount($sheet_index=5);
	$NameBarangTarif  		= $RowBarangTarif;
	// BarangDokumen
	$dataBarangDokumen = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowBarangDokumen = $dataBarangDokumen->rowcount($sheet_index=6);
	$NameBarangDokumen  	= $RowBarangDokumen;
	// Dokumen
	$dataDokumen = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowDokumen = $dataDokumen->rowcount($sheet_index=7);
	$NameDokumen  			= $RowDokumen;
	// Kemasan
	$dataKemasan = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowKemasan = $dataKemasan->rowcount($sheet_index=8);
	$NameKemasan  			= $RowKemasan;
	// Kontainer
	$dataKontainer = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowKontainer = $dataKontainer->rowcount($sheet_index=9);
	$NameKontainer  		= $RowKontainer;
	// Respon
	$dataRespon = new Spreadsheet_Excel_Reader($_FILES["file_upload"]["name"],false);
	$RowRespon = $dataRespon->rowcount($sheet_index=10);
	$NameRespon  			= $RowRespon;

	// $NameStatus  			= $_POST['Status'];
	// End For Name Row Excel
	

	// FOR AKTIFITAS
	// $me = $_POST['username'];
	// $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
	// $resultme = mysqli_fetch_array($datame);

 //    $IDUNIQme             = $resultme['USRIDUNIQ'];
 //    $InputUsername        = $me;
 //    $InputModul           = 'Report/PLB CK5';
 //    $InputDescription     = $me . " Upload Excel PLB CK5 nama file: ".$file_name.", Simpan Data Sebagai Report PLB CK5";
 //    $InputAction          = 'Upload PLB CK5';
 //    $InputDate            = date('Y-m-d h:m:i');

 //    $query = $dbcon->query("INSERT INTO tbl_aktifitas
 //                           (id,IDUNIQ,username,modul,description,action,date_created)
 //                           VALUES
 //                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");
   	// var_dump($query);exit;
	
	include 'report_ck5_plb_read_file.php';
    echo "<script>window.location.href='report_ck5_plb.php?UploadSuccess=true';</script>";
} else {
	echo "File not selected";
    echo "<script>window.location.href='report_ck5_plb.php?UploadFailed=true';</script>";
}
?>