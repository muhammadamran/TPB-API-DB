<?php
include "include/connection.php";

$key = $_POST['CekBarang'];
foreach ($key as $row) {
    $NOMOR_AJU = $row['NOMOR_AJU'];
}

var_dump($NOMOR_AJU);
exit;

if ($CHE) {
    echo "<script>window.location.href='gm_pemasukan_detail.php?ID=$NOMOR_AJU';'_blank'</script>";
} else {
    echo "<script>window.location.href='gm_pemasukan_detail.php?ID=$NOMOR_AJU'?status=error;'_blank'</script>";
}
