<li class="nav-header">REPORT</li>
<li class="has-sub <?= $uriSegments[1] == 'gm_pemasukan.php' ||
                        $uriSegments[1] == 'gm_pengeluaran.php'
                        ? 'active' : '' ?>">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fas fa-paste"></i>
        <span>Report </span>
    </a>
    <ul class="sub-menu">
        <li class="<?= $uriSegments[1] == 'gm_pemasukan.php' ? 'active' : '' ?>">
            <a href="gm_pemasukan.php">Report </a>
        </li>
    </ul>
</li>