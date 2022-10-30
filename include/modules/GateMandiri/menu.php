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
                <!-- <span class="label label-theme">0</span> -->
            </a>
        </li>
        <li class="<?= $uriSegments[1] == 'gm_pengeluaran.php' || $uriSegments[1] == 'gm_pengeluaran_detail.php' ? 'active' : '' ?>">
            <a href="gm_pengeluaran.php">
                Gate Out
                <!-- <span class="label label-theme">0</span> -->
            </a>
        </li>
    </ul>
</li>