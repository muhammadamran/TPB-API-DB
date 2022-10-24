<li class="nav-header">UTILITY</li>
<li class="has-sub <?=
                    // About
                    $uriSegments[1] == 'uti_ak_user.php' ||
                        $uriSegments[1] == 'uti_ak_version.php' ||
                        $uriSegments[1] == 'uti_ak_faq.php' ||
                        $uriSegments[1] == 'uti_ak_about.php' ||
                        // Backup
                        $uriSegments[1] == 'uti_backup_dokumen.php' ||
                        $uriSegments[1] == 'uti_backup_referensi_barang.php' ||
                        // Restore
                        $uriSegments[1] == 'uti_restore_dokumen.php' ||
                        $uriSegments[1] == 'uti_restore_referensi_barang.php' ||
                        // BC27 Pemasukan
                        $uriSegments[1] == 'uti_bc27_tersimpan.php' ||
                        $uriSegments[1] == 'uti_bc_server.php' ||
                        // Restore Data Lama
                        $uriSegments[1] == 'uti_restore_data_lama.php' ||
                        // Hapus Data
                        $uriSegments[1] == 'uti_hapus_data.php' ||
                        // Setting
                        $uriSegments[1] == 'uti_set_notgl_aju.php' ||
                        $uriSegments[1] == 'uti_set_dokumen.php' ||
                        $uriSegments[1] == 'uti_set_database.php' ||
                        $uriSegments[1] == 'uti_set_server.php' ||
                        // User Manajemen
                        $uriSegments[1] == 'uti_user_manajemen_desktop.php' ||
                        // Laporan Dokumen
                        $uriSegments[1] == 'uti_laporan_dokumen.php'
                        ? 'active' : '' ?>">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fab fa-medapps"></i>
        <span>Utility</span>
    </a>
    <ul class="sub-menu">
        <li class="has-sub <?=
                            // About
                            $uriSegments[1] == 'uti_ak_user.php' ||
                                $uriSegments[1] == 'uti_ak_version.php' ||
                                $uriSegments[1] == 'uti_ak_faq.php' ||
                                $uriSegments[1] == 'uti_ak_about.php'
                                ? 'active' : '' ?>">
            <a href="javascript:;"><b class="caret"></b> About</a>
            <ul class="sub-menu">
                <li class="<?= $uriSegments[1] == 'uti_ak_user.php' ? 'active' : '' ?>">
                    <a href="uti_ak_user.php">User</a>
                </li>
                <!-- <li class="<?= $uriSegments[1] == 'uti_ak_version.php' ? 'active' : '' ?>">
                    <a href="uti_ak_version.php">Versions</a>
                </li>
                <li class="<?= $uriSegments[1] == 'uti_ak_faq.php' ? 'active' : '' ?>">
                    <a href="uti_ak_faq.php">FAQ</a>
                </li> -->
                <li class="<?= $uriSegments[1] == 'uti_ak_about.php' ? 'active' : '' ?>">
                    <a href="uti_ak_about.php">About</a>
                </li>
            </ul>
        </li>
        <li class="has-sub <?=
                            // Backup
                            $uriSegments[1] == 'uti_backup_dokumen.php' ||
                                $uriSegments[1] == 'uti_backup_referensi_barang.php'
                                ? 'active' : '' ?>">
            <a href="javascript:;"><b class="caret"></b> Backup</a>
            <ul class="sub-menu">
                <li class="<?= $uriSegments[1] == 'uti_backup_dokumen.php' ? 'active' : '' ?>">
                    <a href="uti_backup_dokumen.php">Backup Dokumen</a>
                </li>
                <li class="<?= $uriSegments[1] == 'uti_backup_referensi_barang.php' ? 'active' : '' ?>">
                    <a href="uti_backup_referensi_barang.php">Backup Ref. Barang</a>
                </li>
            </ul>
        </li>
        <li class="has-sub <?=
                            // Restore
                            $uriSegments[1] == 'uti_restore_dokumen.php' ||
                                $uriSegments[1] == 'uti_restore_referensi_barang.php'
                                ? 'active' : '' ?>">
            <a href="javascript:;"><b class="caret"></b> Restore</a>
            <ul class="sub-menu">
                <li class="<?= $uriSegments[1] == 'uti_restore_dokumen.php' ? 'active' : '' ?>">
                    <a href="uti_restore_dokumen.php">Restore Dokumen</a>
                </li>
                <li class="<?= $uriSegments[1] == 'uti_restore_referensi_barang.php' ? 'active' : '' ?>">
                    <a href="uti_restore_referensi_barang.php">Restore Ref. Barang</a>
                </li>
            </ul>
        </li>
        <li class="<?= $uriSegments[1] == 'uti_restore_data_lama.php' ? 'active' : '' ?>">
            <a href="uti_restore_data_lama.php">Restore Data Lama</a>
        </li>
        <li class="has-sub <?=
                            // BC27 Pemasukan
                            $uriSegments[1] == 'uti_bc27_tersimpan.php' ||
                                $uriSegments[1] == 'uti_bc_server.php'
                                ? 'active' : '' ?>">
            <a href="javascript:;"><b class="caret"></b> BC27 Pemasukan</a>
            <ul class="sub-menu">
                <li class="<?= $uriSegments[1] == 'uti_bc27_tersimpan.php' ? 'active' : '' ?>">
                    <a href="uti_bc27_tersimpan.php">Data Tersimpan di Modul</a>
                </li>
                <li class="<?= $uriSegments[1] == 'uti_bc_server.php' ? 'active' : '' ?>">
                    <a href="uti_bc_server.php">Data Server BC</a>
                </li>
            </ul>
        </li>
        <li class="<?= $uriSegments[1] == 'uti_hapus_data.php' ? 'active' : '' ?>">
            <a href="uti_hapus_data.php">Hapus Data</a>
        </li>
        <li class="has-sub <?=
                            // Setting
                            $uriSegments[1] == 'uti_set_notgl_aju.php' ||
                                $uriSegments[1] == 'uti_set_dokumen.php' ||
                                $uriSegments[1] == 'uti_set_database.php' ||
                                $uriSegments[1] == 'uti_set_server.php'
                                ? 'active' : '' ?>">
            <a href="javascript:;"><b class="caret"></b> Setting</a>
            <ul class="sub-menu">
                <li class="<?= $uriSegments[1] == 'uti_set_notgl_aju.php' ? 'active' : '' ?>">
                    <a href="uti_set_notgl_aju.php">Update No/Tgl Aju</a>
                </li>
                <li class="<?= $uriSegments[1] == 'uti_set_dokumen.php' ? 'active' : '' ?>">
                    <a href="uti_set_dokumen.php">Dokumen</a>
                </li>
                <li class="<?= $uriSegments[1] == 'uti_set_database.php' ? 'active' : '' ?>">
                    <a href="uti_set_database.php">Setting Database</a>
                </li>
                <li class="<?= $uriSegments[1] == 'uti_set_server.php' ? 'active' : '' ?>">
                    <a href="uti_set_server.php">Setting Server</a>
                </li>
            </ul>
        </li>
        <li class="<?= $uriSegments[1] == 'uti_user_manajemen_desktop.php' ? 'active' : '' ?>">
            <a href="uti_user_manajemen_desktop.php">User Manajemen</a>
        </li>
        <li class="<?= $uriSegments[1] == 'uti_laporan_dokumen.php' ? 'active' : '' ?>">
            <a href="uti_laporan_dokumen.php">Laporan Dokumen</a>
        </li>
    </ul>
</li>