<?php
if (
    $resultRoleModules['v_departemen'] == 'none' &&
    $resultRoleModules['v_hak_akses'] == 'none' &&
    $resultRoleModules['v_jabatan'] == 'none' &&
    $resultRoleModules['v_kuota_mitra'] == 'none' &&
    $resultRoleModules['v_pengaturan_tbb'] == 'none' &&
    $resultRoleModules['v_pengaturan_realtime'] == 'none' &&
    $resultRoleModules['v_pengaturan_informasi'] == 'none' &&
    $resultRoleModules['v_user_manajemen'] == 'none'
) {
    $TitleADM = 'none';
} else {
    $TitleADM = 'show';
}
?>
<li class="nav-header" style="display: <?= $TitleADM; ?>;">ADMINISTRATOR</li>
<li class="has-sub <?= $uriSegments[1] == 'adm_api.php' ||
                        $uriSegments[1] == 'adm_user_manajemen_web.php' ||
                        $uriSegments[1] == 'adm_user_manajemen_web_update.php' ||
                        $uriSegments[1] == 'adm_user_manajemen_web_resetpassword.php' ||
                        $uriSegments[1] == 'adm_department.php' ||
                        $uriSegments[1] == 'adm_jabatan.php' ||
                        $uriSegments[1] == 'adm_hak_akses.php' ||
                        $uriSegments[1] == 'adm_setting.php' ||
                        $uriSegments[1] == 'adm_time_reload.php' ||
                        $uriSegments[1] == 'adm_info.php' ||
                        $uriSegments[1] == 'adm_kuota.php' ||
                        $uriSegments[1] == 'adm_module.php'
                        ? 'active' : '' ?>" style="display: <?= $TitleADM; ?>;">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fab fa-adn"></i>
        <span>Administrator Tools</span>
    </a>
    <ul class="sub-menu">
        <li class="<?= $uriSegments[1] == 'adm_api.php' ? 'active' : '' ?>"
            style="display: <?= $resultRoleModules['v_pengaturan_informasi']; ?>;">
            <a href="adm_api.php">API & Database</a>
        </li>
        <li class="<?= $uriSegments[1] == 'adm_department.php' ? 'active' : '' ?>"
            style="display: <?= $resultRoleModules['v_departemen']; ?>;">
            <a href="adm_department.php">Departemen</a>
        </li>
        <li class="<?= $uriSegments[1] == 'adm_hak_akses.php' ? 'active' : '' ?>"
            style="display: <?= $resultRoleModules['v_hak_akses']; ?>;">
            <a href="adm_hak_akses.php">Hak Akses</a>
        </li>
        <li class="<?= $uriSegments[1] == 'adm_jabatan.php' ? 'active' : '' ?>"
            style="display: <?= $resultRoleModules['v_jabatan']; ?>;">
            <a href="adm_jabatan.php">Jabatan</a>
        </li>
        <li class="<?= $uriSegments[1] == 'adm_kuota.php' ? 'active' : '' ?>"
            style="display: <?= $resultRoleModules['v_kuota_mitra']; ?>;">
            <a href="adm_kuota.php">Kuota Mitra</a>
        </li>
        <li class="<?= $uriSegments[1] == 'adm_setting.php' ? 'active' : '' ?>"
            style="display: <?= $resultRoleModules['v_pengaturan_tbb']; ?>;">
            <a href="adm_setting.php">Pengaturan App TPB</a>
        </li>
        <li class="<?= $uriSegments[1] == 'adm_time_reload.php' ? 'active' : '' ?>"
            style="display: <?= $resultRoleModules['v_pengaturan_realtime']; ?>;">
            <a href="adm_time_reload.php">Pengaturan RealTime Reload</a>
        </li>
        <li class="<?= $uriSegments[1] == 'adm_info.php' ? 'active' : '' ?>"
            style="display: <?= $resultRoleModules['v_pengaturan_informasi']; ?>;">
            <a href="adm_info.php">Pengaturan Informasi</a>
        </li>
        <li class="<?= $uriSegments[1] == 'adm_user_manajemen_web.php' || $uriSegments[1] == 'adm_user_manajemen_web_update.php' || $uriSegments[1] == 'adm_user_manajemen_web_resetpassword.php' ? 'active' : '' ?>"
            style="display: <?= $resultRoleModules['v_user_manajemen']; ?>;">
            <a href="adm_user_manajemen_web.php">User Manajemen Web</a>
        </li>
    </ul>
</li>