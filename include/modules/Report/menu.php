<li class="nav-header">Laporan</li>
<li class="has-sub <?= $uriSegments[1] == 'gm_pemasukan.php' ||
                        $uriSegments[1] == 'gm_pengeluaran.php'
                        ? 'active' : '' ?>">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fas fa-paste"></i>
        <span>Laporan </span>
    </a>
    <ul class="sub-menu">
        <li class="<?= $uriSegments[1] == 'gm_pemasukan.php' ? 'active' : '' ?>">
            <a href="gm_pemasukan.php">Laporan </a>
        </li>
    </ul>
</li>