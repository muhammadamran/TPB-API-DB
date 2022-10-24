<?php
if ($resultRoleModules['v_daftar_barang'] == 'none' && 
    $resultRoleModules['v_tarif_hs'] == 'none' && 
    $resultRoleModules['v_pemasok'] == 'none' && 
    $resultRoleModules['v_perusahaan'] == 'none' && 
    $resultRoleModules['v_alat_angkut'] == 'none' && 
    $resultRoleModules['v_tempat_penimbunan'] == 'none' && 
    $resultRoleModules['v_kantor_bea_cukai'] == 'none' && 
    $resultRoleModules['v_negara'] == 'none' && 
    $resultRoleModules['v_pelabuhan_dn'] == 'none' && 
    $resultRoleModules['v_pelabuhan_ln'] == 'none' && 
    $resultRoleModules['v_mata_uang'] == 'none' && 
    $resultRoleModules['v_satuan'] == 'none' && 
    $resultRoleModules['v_kemasan'] == 'none') {
    $TitleReferensi = 'none';
} else {
    $TitleReferensi = 'show';
}
?>
<li class="nav-header" style="display: <?= $TitleReferensi; ?>;">REFERENSI</li>
<li class="has-sub <?= $uriSegments[1] == 'ref_daftar_barang.php' ||
                        $uriSegments[1] == 'ref_tarif_hs.php' ||
                        $uriSegments[1] == 'ref_pemasok.php' ||
                        $uriSegments[1] == 'ref_perusahaan.php' ||
                        $uriSegments[1] == 'ref_alat_angkut.php' ||
                        $uriSegments[1] == 'ref_tempat_penimbunan.php' ||
                        $uriSegments[1] == 'ref_kantor_beacukai.php' ||
                        $uriSegments[1] == 'ref_edifact_negara.php' ||
                        $uriSegments[1] == 'ref_edifact_dalam_negeri.php' ||
                        $uriSegments[1] == 'ref_edifact_luar_negeri.php' ||
                        $uriSegments[1] == 'ref_edifact_mata_uang.php' ||
                        $uriSegments[1] == 'ref_edifact_satuan.php' ||
                        $uriSegments[1] == 'ref_edifact_kemasan.php'
                        ? 'active' : '' ?>" style="display: <?= $TitleReferensi; ?>;">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fas fa-book"></i>
        <span>Referensi</span>
    </a>
    <ul class="sub-menu">
        <li class="<?= $uriSegments[1] == 'ref_daftar_barang.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_daftar_barang']; ?>;">
            <a href="ref_daftar_barang.php">Daftar Barang</a>
        </li>
        <li class="<?= $uriSegments[1] == 'ref_tarif_hs.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_tarif_hs']; ?>;">
            <a href="ref_tarif_hs.php">Tarif HS</a>
        </li>
        <li class="<?= $uriSegments[1] == 'ref_pemasok.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_pemasok']; ?>;">
            <a href="ref_pemasok.php">Pemasok</a>
        </li>
        <li class="<?= $uriSegments[1] == 'ref_perusahaan.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_perusahaan']; ?>;">
            <a href="ref_perusahaan.php">Perusahaan</a>
        </li>
        <li class="<?= $uriSegments[1] == 'ref_alat_angkut.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_alat_angkut']; ?>;">
            <a href="ref_alat_angkut.php">Alat Angkut</a>
        </li>
        <li class="<?= $uriSegments[1] == 'ref_tempat_penimbunan.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_tempat_penimbunan']; ?>;">
            <a href="ref_tempat_penimbunan.php">Tempat Penimbunan</a>
        </li>
        <li class="<?= $uriSegments[1] == 'ref_kantor_beacukai.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_kantor_bea_cukai']; ?>;">
            <a href="ref_kantor_beacukai.php">Kantor Bea Cukai</a>
        </li>
        <?php
        if ($resultRoleModules['v_negara'] == 'none' && 
            $resultRoleModules['v_pelabuhan_dn'] == 'none' && 
            $resultRoleModules['v_pelabuhan_ln'] == 'none' && 
            $resultRoleModules['v_mata_uang'] == 'none' && 
            $resultRoleModules['v_satuan'] == 'none' && 
            $resultRoleModules['v_kemasan'] == 'none') {
            $TitleReferensiSub = 'none';
        } else {
            $TitleReferensiSub = 'show';
        }
        ?>
        <li class="has-sub <?=
                            // Edifact
                            $uriSegments[1] == 'ref_edifact_negara.php' ||
                                $uriSegments[1] == 'ref_edifact_dalam_negeri.php' ||
                                $uriSegments[1] == 'ref_edifact_luar_negeri.php' ||
                                $uriSegments[1] == 'ref_edifact_mata_uang.php' ||
                                $uriSegments[1] == 'ref_edifact_satuan.php' ||
                                $uriSegments[1] == 'ref_edifact_kemasan.php'
                                ? 'active' : '' ?>" style="display: <?= $TitleReferensiSub; ?>;">
            <a href="javascript:;"><b class="caret"></b> Edifact</a>
            <ul class="sub-menu">
                <li class="<?= $uriSegments[1] == 'ref_edifact_negara.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_negara']; ?>;">
                    <a href="ref_edifact_negara.php">Negara</a>
                </li>
                <li class="<?= $uriSegments[1] == 'ref_edifact_dalam_negeri.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_pelabuhan_dn']; ?>;">
                    <a href="ref_edifact_dalam_negeri.php">Pelabuhan Dalam Negeri</a>
                </li>
                <li class="<?= $uriSegments[1] == 'ref_edifact_luar_negeri.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_pelabuhan_ln']; ?>;">
                    <a href="ref_edifact_luar_negeri.php">Pelabuhan Luar Negeri</a>
                </li>
                <li class="<?= $uriSegments[1] == 'ref_edifact_mata_uang.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_mata_uang']; ?>;">
                    <a href="ref_edifact_mata_uang.php">Mata Uang</a>
                </li>
                <li class="<?= $uriSegments[1] == 'ref_edifact_satuan.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_satuan']; ?>;">
                    <a href="ref_edifact_satuan.php">Satuan</a>
                </li>
                <li class="<?= $uriSegments[1] == 'ref_edifact_kemasan.php' ? 'active' : '' ?>" style="display: <?= $resultRoleModules['v_kemasan']; ?>;">
                    <a href="ref_edifact_kemasan.php">Kemasan</a>
                </li>
            </ul>
        </li>
    </ul>
</li>