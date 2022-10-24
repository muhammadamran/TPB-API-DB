<?php
$jumlah_table = $dbcon->query("SELECT view_tables FROM view_all_tables");
$jt_query = mysqli_fetch_array($jumlah_table);

if ($resultRoleModules['v_cttpb'] == 'none' && $resultRoleModules['v_filterttpb'] == 'none') {
    $TitleData = 'none';
} else {
    $TitleData = 'show';
}
?>
<li class="nav-header" style="display: <?= $TitleData; ?>;">
    <div style="display: flex;justify-content: space-between;align-items: center;">
        <div>
            DATA
        </div>
        <div>
            <span class="badge pull-right" style="background: #00acac;"><?= $jt_query['view_tables'] ?> Tabel</span>
        </div>
    </div>
</li>
<!-- <li class="<?= $uriSegments[1] == 'tbl_tpb_count.php' ? 'active' : '' ?>"
    style="display: <?= $resultRoleModules['v_cttpb']; ?>">
    <a href="tbl_tpb_count.php">
        <i class="fab fa-contao"></i>
        <span>Count Tabel TPB</span>
    </a>
</li> -->
<li class="<?= $uriSegments[1] == 'tbl_tpb.php' ? 'active' : '' ?>"
    style="display: <?= $resultRoleModules['v_filterttpb']; ?>">
    <a href="tbl_tpb.php">
        <i class="fas fa-database"></i>
        <span>Filter Tabel TPB Module</span>
    </a>
</li>
<li class="<?= $uriSegments[1] == 'tbl_inventory.php' ? 'active' : '' ?>"
    style="display: <?= $resultRoleModules['v_filterttpb']; ?>">
    <a href="tbl_inventory.php">
        <i class="fas fa-database"></i>
        <span>Filter Tabel TPB Inventory</span>
    </a>
</li>