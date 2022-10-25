<?php
// Server Prod
$dbhost = 'localhost';
$dbusername = 'inxmiles_tpb';
$dbpassword = 'Flatrone2241TPB';
$dbname = 'inxmiles_tpb';
$dbcon = new mysqli($dbhost, $dbusername, $dbpassword, $dbname) or die(mysqli_connect_errno());

$searchTerm = $_GET['term']; // Menerima kiriman data dari inputan pengguna

// $dataAPI = $dbcon->query("SELECT * FROM api ORDER BY id ASC LIMIT 1");
// $resultAPI = mysqli_fetch_array($dataAPI);

// function get_content($URL)
// {
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_URL, $URL);
//     $data = curl_exec($ch);
//     curl_close($ch);
//     return $data;
// }

// $content = get_content($resultAPI['url_api'] . 'gmBarangMasuk.php?function=get_auto_noAJU');
// $data = json_decode($content, true);

// foreach ($data['result'] as $row) {
//     $row['NOMOR_AJU'];
// }
// echo json_encode($data['result']);

$sql = "SELECT * FROM referensi_asal_barang WHERE URAIAN_ASAL_BARANG LIKE '%" . $searchTerm . "%' ORDER BY ID ASC"; // query sql untuk menampilkan data mahasiswa dengan operator LIKE

$hasil = mysqli_query($kon, $sql); //Query dieksekusi

//Disajikan dengan menggunakan perulangan
while ($row = mysqli_fetch_array($hasil)) {
    $data[] = $row['URAIAN_ASAL_BARANG'];
}
//Nilainya disimpan dalam bentuk json
echo json_encode($data);
