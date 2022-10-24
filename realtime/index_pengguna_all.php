<?php
include "../include/connection.php";
include "../include/restrict.php";
// DATE
function date_indo_pengguna($date, $print_day = false)
{
    $day = array(
        1 =>
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );
    $month = array(
        1 =>
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split    = explode('-', $date);
    $tgl_indo = $split[2] . ' ' . $month[(int)$split[1]] . ' ' . $split[0];

    if ($print_day) {
        $num = date('N', strtotime($date));
        return $day[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}
?>
<style>
    @media (max-width: 1157px) {
        #bg-all-record {
            background-image: url('assets/images/users/92ru.gif');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            color: #fff;
        }

        .all-record {
            display: grid;
            justify-content: space-between;
            align-items: center;
        }

        .all-record-detail {
            display: grid;
            margin-bottom: 15px;
        }
    }
</style>
<div class="card-box" id="bg-all-record">
    <div class="all-record">
        <div class="all-record-detail">
            <font style="font-size: 25px;font-weight: 600;"><i class="fas fa-users" style="font-weight: 800;"></i> Total Data</font>
            <!-- QUERY -->
            <?php
            $q_count_total = $dbcon->query("SELECT COUNT(*) AS total_qct FROM tbl_users AS usr
                                            LEFT JOIN tbl_pegawai AS peg ON usr.USER_NAME=peg.username
                                            ORDER BY usr.ID DESC");
            $result_qct = mysqli_fetch_array($q_count_total);
            ?>
            <font style="font-size: 16px;font-weight: 300;"><?= $result_qct['total_qct'] ?> User Manajemen Web</font>
        </div>
        <div class="all-record-detail">
            <font style="font-size: 16px;font-weight: 600;"><?= date('Y') ?></font>
            <div class="card_divider"></div>
            <font style="font-size: 10px;font-weight: 300;"><?= date_indo_pengguna(date('Y-m-d'), TRUE); ?></font>
        </div>
        <div class="all-record-detail">
            <font style="font-size: 25px;font-weight: 600;"><i class="fas fa-user-check" style="font-weight: 800;"></i> Aktif</font>
            <!-- QUERY -->
            <?php
            $q_count_aktif = $dbcon->query("SELECT COUNT(*) AS total_qca FROM tbl_users AS usr
                                            LEFT JOIN tbl_pegawai AS peg ON usr.USER_NAME=peg.username
                                            WHERE peg.status='0'
                                            ORDER BY usr.ID DESC");
            $result_qca = mysqli_fetch_array($q_count_aktif);
            ?>
            <font style="font-size: 16px;font-weight: 300;"><?= $result_qca['total_qca'] ?> User Manajemen Web</font>
        </div>
        <div class="all-record-detail">
            <font style="font-size: 25px;font-weight: 600;"><i class="fas fa-user-slash" style="font-weight: 800;"></i> Non-Aktif</font>
            <!-- QUERY -->
            <?php
            $q_count_nonaktif = $dbcon->query("SELECT COUNT(*) AS total_qcn FROM tbl_users AS usr
                                            LEFT JOIN tbl_pegawai AS peg ON usr.USER_NAME=peg.username
                                            WHERE peg.status='1'
                                            ORDER BY usr.ID DESC");
            $result_qcn = mysqli_fetch_array($q_count_nonaktif);
            ?>
            <font style="font-size: 16px;font-weight: 300;"><?= $result_qcn['total_qcn'] ?> User Manajemen Web</font>
        </div>
        <div class="all-record-detail">
            <font style="font-size: 25px;font-weight: 600;"><i class="fas fa-user-minus" style="font-weight: 800;"></i> Resign</font>
            <?php
            $q_count_resign = $dbcon->query("SELECT COUNT(*) AS total_qcr FROM tbl_users AS usr
                                            LEFT JOIN tbl_pegawai AS peg ON usr.USER_NAME=peg.username
                                            WHERE peg.status='2'
                                            ORDER BY usr.ID DESC");
            $result_qcr = mysqli_fetch_array($q_count_resign);
            ?>
            <font style="font-size: 16px;font-weight: 300;"><?= $result_qcr['total_qcr'] ?> User Manajemen Web</font>
        </div>
    </div>
</div>