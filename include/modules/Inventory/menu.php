<li class="nav-header">Inventory</li>
<?php
if ($resultRoleModules['da_one'] == 'none' && $resultRoleModules['da_two'] == 'none') {
    $TitleDashboard = 'none';
} else {
    $TitleDashboard = 'show';
}
?>
<li class="<?= $uriSegments[1] == 'adm_kuota.php' ? 'active' : '' ?>" style="display: <?= $TitleDashboard ?>;">
    <a href="adm_kuota.php"><i class="fas fa-digital-tachograph icon-page-sidebar"></i> <span>Kuota Mitra</span></a>
</li>
<li class="<?= $uriSegments[1] == 'adm_stokbarang.php' ? 'active' : '' ?>" style="display: <?= $TitleDashboard ?>;">
    <a href="adm_stokbarang.php"><i class="fas fa-cubes icon-page-sidebar"></i> <span>Stok Barang</span></a>
</li>
<li class="<?= $uriSegments[1] == 'adm_penyesuaian.php' ? 'active' : '' ?>" style="display: <?= $TitleDashboard ?>;">
    <a href="adm_penyesuaian.php"><i class="fas fa-sliders-h icon-page-sidebar"></i> <span>Penyesuaian</span></a>
</li>