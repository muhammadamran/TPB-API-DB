<?php
include "include/connection.php";
include "include/api.php";

$aksi = $_GET['aksi'];

if ($aksi == 'sesuai') {
    $key = $_POST['CekBarang'];
    var_dump(count($key));
    exit;
    foreach ($key as $row) {
        if (@$row['ID']) {
            $ID = $row['ID'];
            $dataUpdate = array(
                'STATUS' => 'Sesuai'
            );

            $update = $dbcon->query('UPDATE plb_barang SET STATUS="' . $FName . '", lname="' . $LName . '" WHERE ID="' . $ID . '"');
        }
    }

    if ($insert) {
        echo '<script>alert("Data has been Added");location.href = "../../index.php?m=user&s=user"</script>';
    } else {
        echo '<script>alert("Data failed Added");history.go(-1)</script>';
    }
} else if ($aksi == 'update') {
    $id = $_GET['id'];
    $FName = $_POST['FName'];
    $LName = $_POST['LName'];
    $Gender = $_POST['Gender'];
    $Email = $_POST['Email'];
    $Role = $_POST['Role'];
    $ExpiredDate = $_POST['ExpiredDate'];

    $update = $db->query('UPDATE tbl_users SET fname="' . $FName . '", lname="' . $LName . '", gender="' . $Gender . '", email="' . $Email . '", role="' . $Role . '", expired_date=' . ($ExpiredDate == '' || empty($ExpiredDate) ? "NULL" : '"' . $ExpiredDate . '"') . ' WHERE id="' . $id . '"');

    if ($update) {
        echo '<script>alert("Data has been Updated");location.href = "../../index.php?m=user&s=user"</script>';
    } else {
        echo '<script>alert("Data failed Updated");history.go(-1)</script>';
    }
} else if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $hapus = $db->query('DELETE FROM tbl_users WHERE id="' . $id . '"');

    if ($hapus) {
        echo '<script>alert("Data has been Deleted");location.href = "../../index.php?m=user&s=user"</script>';
    } else {
        echo '<script>alert("Data failed Deleted");history.go(-1)</script>';
    }
} else if ($aksi == 'update_password') {
    $id = $_GET['id'];
    $password = md5($_POST['password']);

    $change = $db->query('UPDATE tbl_users SET password="' . $password . '" WHERE id="' . $id . '"');

    if ($change) {
        echo '<script>alert("Password has been Changed");location.href = "../../index.php?m=user&s=user"</script>';
    } else {
        echo '<script>alert("Password failed Changed");history.go(-1)</script>';
    }
}
