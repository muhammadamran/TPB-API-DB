<?php
include "../include/connection.php";
include "../include/restrict.php";
?>
<?php

// DATE
function date_indo_total_tabel($date, $print_day = false)
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

$TotalTabel = $dbcon->query("SELECT view_tables FROM view_all_tables");
$resultTotalTabel = mysqli_fetch_array($TotalTabel);
?>
<div class="widget widget-stats bg-teal">
    <div class="stats-icon stats-icon-lg"><i class="fa fa-database fa-fw"></i></div>
    <div class="stats-content">
        <div class="stats-title">TOTAL TABEL TPB</div>
        <div class="stats-number"><?= $resultTotalTabel['view_tables'] ?> Tabel</div>
        <div class="stats-progress progress">
            <div class="progress-bar" style="width: <?= $jt_query['view_tables'] ?>%;"></div>
        </div>
        <div class="stats-desc">Update Data: <?= date_indo_total_tabel(date('Y-m-d'), TRUE) ?></div>
    </div>
</div>