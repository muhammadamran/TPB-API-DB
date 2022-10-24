<li class="nav-header">KOMUNIKASI</li>
<li class="has-sub <?= $uriSegments[1] == 'kom_kirim_data.php' ||
                        $uriSegments[1] == 'kom_kirim_dokumen.php' ||
                        $uriSegments[1] == 'kom_respon_perdokumen.php' ||
                        $uriSegments[1] == 'kom_respon_semua.php' ||
                        $uriSegments[1] == 'kom_transfer_data.php'
                        ? 'active' : '' ?>">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fas fa-paper-plane"></i>
        <span>Data</span>
    </a>
    <ul class="sub-menu">
        <li class="<?= $uriSegments[1] == 'kom_kirim_data.php' ? 'active' : '' ?>">
            <a href="kom_kirim_data.php">Kirim Data <i class="fa fa-paper-plane text-theme"></i></a>
        </li>
        <li class="<?= $uriSegments[1] == 'kom_kirim_dokumen.php' ? 'active' : '' ?>">
            <a href="kom_kirim_dokumen.php">Kirim Dokumen <i class="far fa-file-alt text-theme"></i></a>
        </li>
        <li class="<?= $uriSegments[1] == 'kom_respon_perdokumen.php' ? 'active' : '' ?>">
            <a href="kom_respon_perdokumen.php">Respon Per Dok. <i class="fas fa-reply text-theme"></i></a>
        </li>
        <li class="<?= $uriSegments[1] == 'kom_respon_semua.php' ? 'active' : '' ?>">
            <a href="kom_respon_semua.php">Respon Semua <i class="fas fa-reply-all text-theme"></i></a>
        </li>
        <li class="<?= $uriSegments[1] == 'kom_transfer_data.php' ? 'active' : '' ?>">
            <a href="kom_transfer_data.php">Transfer Data <i class="fas fa-exchange-alt text-theme"></i></a>
        </li>
    </ul>
</li>