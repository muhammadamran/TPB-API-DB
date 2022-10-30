<?php
// TOTAL GATE IN
$gate_in = $dbcon->query("SELECT COUNT(*) AS total_in FROM plb_header AS hdr LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb WHERE upload_beritaAcara_PLB IS NULL");
$result_in = mysqli_fetch_array($gate_in);
// TOTAL GATE OUT
$gate_out = $dbcon->query("SELECT COUNT(*) AS total_out FROM plb_header AS hdr LEFT OUTER JOIN rcd_status AS rcd ON hdr.NOMOR_AJU=rcd.bm_no_aju_plb WHERE upload_beritaAcara_PLB IS NOT NULL");
$result_out = mysqli_fetch_array($gate_out);
?>
<li class="nav-header">GATE MANDIRI</li>
<li class="has-sub <?= $uriSegments[1] == 'gm_pemasukan.php' ||
                        $uriSegments[1] == 'gm_pemasukan_detail.php' ||
                        $uriSegments[1] == 'gm_pemasukan_ct.php' ||
                        $uriSegments[1] == 'gm_pemasukan_ct_detail.php' ||
                        $uriSegments[1] == 'gm_pemasukan_proses.php' ||
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
        <li class="<?= $uriSegments[1] == 'gm_pemasukan.php' || $uriSegments[1] == 'gm_pemasukan_detail.php' || $uriSegments[1] == 'gm_pemasukan_ct.php' || $uriSegments[1] == 'gm_pemasukan_proses.php' || $uriSegments[1] == 'gm_pemasukan_ct_detail.php' ? 'active' : '' ?>">
            <a href="gm_pemasukan.php">
                Gate In
                <?php if ($result_in['total_in'] == NULL) { ?>
                    <span class="label label-theme">0</span>
                <?php } else { ?>
                    <span class="label label-theme"><?= $result_in['total_in'] ?></span>
                <?php } ?>
            </a>
        </li>
        <li class="<?= $uriSegments[1] == 'gm_pengeluaran.php' || $uriSegments[1] == 'gm_pengeluaran_detail.php' ? 'active' : '' ?>">
            <a href="gm_pengeluaran.php">
                Gate Out
                <?php if ($result_out['total_out'] == NULL) { ?>
                    <span class="label label-theme">0</span>
                <?php } else { ?>
                    <span class="label label-theme"><?= $result_out['total_out'] ?></span>
                <?php } ?>
            </a>
        </li>
    </ul>
</li>