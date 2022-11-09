<?php
include "../include/connection.php";
if (function_exists($_GET['function'])) {
    $_GET['function']();
}

// TOTAL GATE IN
function totalHP_awal()
{
    global $dbcon;
    $data = $dbcon->query("SELECT SUM(brg.HARGA_PENYERAHAN) AS total FROM plb_barang AS brg 
                          LEFT OUTER JOIN rcd_status AS rcd ON brg.NOMOR_AJU=rcd.bm_no_aju_plb WHERE upload_beritaAcara_PLB IS NULL");
    $result = mysqli_fetch_array($data);
?>
    Rp.<span data-animation="number" data-value="<?= $result['total']; ?>">0.00</span>

<?php }

// TOTAL GATE OUT
function totalHP_akhir()
{
    global $dbcon;
    $data = $dbcon->query("SELECT SUM(*) AS total FROM plb_barang AS brg LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb WHERE upload_beritaAcara_PLB IS NOT NULL");
    $result = mysqli_fetch_array($data);
    echo $result['total'];
}
