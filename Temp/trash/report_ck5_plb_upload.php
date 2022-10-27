<?php
include 'Classes/PHPExcel.php';
include "include/connection.php";
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

if (isset($_FILES["file_upload"])) {
	$dir = "files/ck5plb/";
	$timeUpload = date('Y-m-d-h-m-i');
	$file_name = $timeUpload . "_" . $_FILES["file_upload"]["name"];
	$size = $_FILES["file_upload"]["size"];
	$tmp_file_name = $_FILES["file_upload"]["tmp_name"];
	move_uploaded_file($tmp_file_name, $dir . $file_name);

	include 'report_ck5_plb_read_file.php';
	echo "<script>window.location.href='report_ck5_plb.php?UploadSuccess=true';</script>";
} else {
	echo "File not selected";
	echo "<script>window.location.href='report_ck5_plb.php?UploadFailed=true';</script>";
}
