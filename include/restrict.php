<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // redirect ke halaman sign-in
    header("location:./sign-in.php?NoAccess=true");
    // header("location:../tpb/sign-in.php");
}
$user = $_SESSION['username'];

// CEK ALREADY UPDATE PASSWORD OR NOT
$cekUpdatePass = $dbcon->query("SELECT USER_NAME,NEW_USER FROM tbl_users WHERE USER_NAME='$user'");
$valdation_password = mysqli_fetch_array($cekUpdatePass);

// Cek Modules Show/None
$cekRole = $dbcon->query("SELECT * FROM tbl_pegawai WHERE username='$user'");
$resultRole = mysqli_fetch_array($cekRole);
$dataRole = $resultRole['role'];

$cekRoleModules = $dbcon->query("SELECT * FROM tbl_role WHERE role='$dataRole'");
$resultRoleModules = mysqli_fetch_array($cekRoleModules);

if ($valdation_password['NEW_USER'] == NULL) {
    $GetUSR = $valdation_password['USER_NAME'];
    echo "<script>window.location.href='adm_user_manajemen_web_update.php?USER=$GetUSR';</script>";
} else {
}