<?php
// TOTAL GATE IN
$gate_in = $dbcon->query("SELECT COUNT(NOMOR_AJU) AS total_in FROM plb_header WHERE STATUS_IN IS NULL");
$result_in = mysqli_fetch_array($gate_in);
// TOTAL GATE OUT
$gate_out = $dbcon->query("SELECT COUNT(NOMOR_AJU) AS total_out FROM plb_header WHERE STATUS_IN IS NOT NULL");
$result_out = mysqli_fetch_array($gate_out);
?>
<li class="nav-header">GATE MANDIRI</li>
<li class="has-sub <?= $uriSegments[1] == 'gm_pemasukan.php' ||
                        $uriSegments[1] == 'gm_pemasukan_detail.php' ||
                        $uriSegments[1] == 'gm_pengeluaran.php' ||
                        $uriSegments[1] == 'gm_pengeluaran_detail.php' ? 'active' : '' ?>">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fas fa-door-open"></i>
        <span>
            Gate Mandiri
            <!-- <span class="label label-theme">0</span> -->
        </span>
    </a>
    <ul class="sub-menu">
        <li class="<?= $uriSegments[1] == 'gm_pemasukan.php' || $uriSegments[1] == 'gm_pemasukan_detail.php' ? 'active' : '' ?>">
            <a href="gm_pemasukan.php">
                Gate In
                <span class="label label-theme"><?= $result_in['total_in'] ?></span>
            </a>
        </li>
        <li class="<?= $uriSegments[1] == 'gm_pengeluaran.php' || $uriSegments[1] == 'gm_pengeluaran_detail.php' ? 'active' : '' ?>">
            <a href="gm_pengeluaran.php">
                Gate Out
                <span class="label label-theme"><?= $result_in['total_out'] ?></span>
            </a>
        </li>
    </ul>
</li>