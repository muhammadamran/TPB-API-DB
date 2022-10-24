<?php
include "../include/connection.php";
include "../include/restrict.php";
?>
<div class="widget widget-stats bg-blue">
    <div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
    <div class="stats-content">
        <div class="stats-title">TOTAL PENGGUNA</div>
        <?php
        $jumlah_pengguna = $dbcon->query("SELECT COUNT(*) pengguna FROM view_privileges");
        $jp_query = mysqli_fetch_array($jumlah_pengguna);
        ?>
        <div class="stats-number"><?= $jp_query['pengguna'] ?> Pengguna</div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width: <?= $jp_query['pengguna'] ?>%;"></div>
        </div>
        <div class="stats-desc">Persentase Pengguna (<?= $jp_query['pengguna'] ?>%)</div>
    </div>
</div>