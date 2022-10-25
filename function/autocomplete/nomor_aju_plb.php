<?php
include "include/connection.php";
include "include/api.php";

$content = get_content($resultAPI['url_api'] . 'gmBarangMasuk.php?function=get_auto_noAJU');
$data = json_decode($content, true);

var_dump($data);
exit;
