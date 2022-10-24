<?php
include "../include/connection.php";
include "../include/restrict.php";
?>
<style type="text/css">
    .scroll {
        display: block;
        /*border: 1px solid red;*/
        padding: 5px;
        margin-top: 5px;
        width: 100%;
        height: 50px;
        overflow: scroll;
    }

    .auto {
        display: block;
        /*border: 1px solid red;*/
        padding: 5px;
        margin-top: 5px;
        width: 100%;
        height: 135px;
        overflow: auto;
    }

    .text-2 {
        /* background-color: #DBDBDB */
    }

    .text-2::-webkit-scrollbar {
        -webkit-appearance: none;
        width: 5px;
        height: 5px;
    }

    .text-2::-webkit-scrollbar-track {
        background-color: transparent;
    }

    .text-2::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #c1c1c1, #c1c1c1);
        border-radius: 10px;
    }
</style>
<div class="card border-0 bg-dark text-white mb-3">
    <!-- begin card-body -->
    <div class="card-body">
        <!-- begin title -->
        <div class="mb-3 text-grey">
            <b>Log Sign In Pengguna didalam Sistem</b>
            <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Log Sign" data-placement="top" data-content="Log Sign In Pengguna didalam Sistem." data-original-title="" title=""></i></span>
        </div>
        <div class="auto text-2">
            <?php
            $dataTable = $dbcon->query("SELECT log.id,peg.foto,log.log_username AS userUSE,log_agent,log_date,log.log_type,log.out_type,log.log_browser
                FROM tbl_log AS log
                LEFT JOIN tbl_pegawai AS peg ON log.log_username=peg.username
                WHERE log.out_type IS NULL
                AND log.log_username='$user'
                -- AND log.id=(SELECT max(id) FROM tbl_log)
                -- GROUP BY log.log_username
                ORDER BY log.id DESC");
            if (mysqli_num_rows($dataTable) > 0) {
                $no = 0;
                while ($row = mysqli_fetch_array($dataTable)) {
                    $no++;
            ?>
                    <div class="d-flex align-items-center m-b-15">
                        <div class="widget-img rounded-lg width-30 m-r-10 bg-white p-3">
                            <?php if ($row['foto'] == NULL || $row['foto'] == 'default-user-images.jpeg') { ?>
                                <div class="h-100 w-100" style="background: url(assets/images/users/default-user-images.jpeg) center no-repeat; background-size: auto 100%;"></div>
                            <?php } else { ?>
                                <div class="h-100 w-100" style="background: url(assets/images/users/<?= $row['foto'] ?>) center no-repeat; background-size: auto 100%;"></div>
                            <?php } ?>
                        </div>
                        <div class="text-truncate">
                            <div><?= $row['userUSE'] ?></div>
                            <div class="text-grey"><?= $row['log_date'] ?></div>
                        </div>
                        <div class="ml-auto text-center">
                            <?php if ($row['log_agent'] == 'Desktop') { ?>
                                <i class="fas fa-laptop"></i> <?= $row['log_agent'] ?>
                            <?php } else if ($row['log_agent'] == 'Mobile') { ?>
                                <i class="fas fa-mobile-alt"></i> <?= $row['log_agent'] ?>
                            <?php } ?>
                            <!-- <div class="f-s-13"><span data-animation="number" data-value="195">195</span></div> -->
                            <div class="text-grey f-s-10"><?= $row['log_browser'] ?></div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="d-flex align-items-center m-b-15">
                    <center>Tidak ada data</center>
                </div>
            <?php }
            mysqli_close($dbcon); ?>
        </div>
    </div>
</div>
<!-- 
<table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
    <thead>
        <tr>
            <th width="1%">#</th>
            <th width="1%" data-orderable="false"></th>
            <th class="text-nowrap">Username</th>
            <th class="text-nowrap">Perangkat</th>
            <th class="text-nowrap">Sign In Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $dataTable = $dbcon->query("SELECT log.id,peg.foto,log.log_username AS userUSE,log_agent,log_date,log.log_type,log.out_type
            FROM tbl_log AS log
            LEFT JOIN tbl_pegawai AS peg ON log.log_username=peg.username
            WHERE log.out_type IS NULL
            AND log.id=(SELECT max(id) FROM tbl_log)
            GROUP BY log.log_username
            ORDER BY log.id DESC LIMIT 5");
        if (mysqli_num_rows($dataTable) > 0) {
            $no = 0;
            while ($row = mysqli_fetch_array($dataTable)) {
                $no++;
        ?>
                <tr class="odd gradeX">
                    <td width="1%" class="f-s-600 text-inverse"><?= $no ?>. </td>
                    <td width="1%" class="with-img">
                        <?php if ($row['foto'] == NULL || $row['foto'] == 'default-user-images.jpeg') { ?>
                            <img src="assets/images/users/default-user-images.jpeg" class="img-rounded height-30" />
                        <?php } else { ?>
                            <img src="assets/images/users/<?= $row['foto'] ?>" class="img-rounded height-30" />
                        <?php } ?>
                    </td>
                    <td><?= $row['userUSE'] ?></td>
                    <td>
                        <?php if ($row['log_agent'] == 'Desktop') { ?>
                            <i class="fas fa-laptop"></i> <?= $row['log_agent'] ?>
                        <?php } else if ($row['log_agent'] == 'Mobile') { ?>
                            <i class="fas fa-mobile-alt"></i> <?= $row['log_agent'] ?>
                        <?php } ?>
                    </td>
                    <td>
                        <font style="font-size: 8px;"><?= $row['log_date'] ?></font>
                    </td>
                </tr>

            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="7">
                    <center>
                        <div style="display: grid;">
                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                        </div>
                    </center>
                </td>
            </tr>
        <?php }
        mysqli_close($dbcon); ?>
    </tbody>
</table> -->