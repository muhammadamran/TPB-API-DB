<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";

// SEARCH
$TableName = '';
$FindLimit = '';
if (isset($_GET['find'])) {
    $TableName = $_GET['TableName'];
    $FindLimit = $_GET['FindLimit'];
}
// END SEARCH

?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-database icon-page"></i>
                <font class="text-page">Filter Tabel TPB Module</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">View Data Online</a></li>
                <li class="breadcrumb-item active">Filter Tabel TPB Module</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin Select Tabel -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Filter Tabel TPB Module</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="tbl_tpb.php" method="GET">
                        <fieldset>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Pilih Tabel <font style="color: red;">*</font>
                                    </label>
                                <div class="col-md-7">
                                    <select class="default-select2 form-control" name="TableName" required>
                                        <?php if ($TableName == NULL) { ?>
                                        <option value="">-- Pilih Tabel --</option>
                                        <?php
                                            $result = $dbcon->query("SELECT TABLE_NAME FROM view_select_table ORDER BY TABLE_NAME ASC");
                                            foreach ($result as $row) {
                                            ?>
                                        <option value="<?= $row['TABLE_NAME'] ?>"><?= $row['TABLE_NAME'] ?></option>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <option value="<?= $TableName ?>"><?= $TableName ?></option>
                                        <option value="">-- Pilih Tabel --</option>
                                        <?php
                                            $result = $dbcon->query("SELECT TABLE_NAME FROM view_select_table ORDER BY TABLE_NAME ASC");
                                            foreach ($result as $row) {
                                            ?>
                                        <option value="<?= $row['TABLE_NAME'] ?>"><?= $row['TABLE_NAME'] ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Limit Data</label>
                                <div class="col-md-7">
                                    <?php if ($FindLimit == NULL) { ?>
                                    <input type="number" class="form-control" id="IDFindLimit" name="FindLimit"
                                        placeholder="Limit Data ...">
                                    <?php } else { ?>
                                    <input type="number" class="form-control" id="IDFindLimit" name="FindLimit"
                                        placeholder="Limit Data ..." value="<?= $FindLimit ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7 offset-md-3">
                                    <button type="submit" name="find" class="btn btn-info m-r-5">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                    <a href="tbl_tpb.php" type="button" class="btn btn-yellow m-r-5">
                                        <i class="fa fa-refresh"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Select Tabel -->
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Data Tabel]
                        <font style="text-transform: uppercase;"><?= $TableName ?></font>
                    </h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <?php if ($TableName != NULL) { ?>
                    <!-- Alert -->
                    <div class="note note-secondary">
                        <div class="note-icon"><i class="fas fa-info"></i></div>
                        <div class="note-content">
                            <?php
                                $TotalDataAll = $dbcon->query("SELECT COUNT(*) AS total_data_all FROM $TableName");
                                $ResultTotalDataAll = mysqli_fetch_array($TotalDataAll);
                                ?>
                            <h4><b>Total Data Tabel <?= $TableName ?></b></h4>
                            <?php if ($FindLimit == NULL) { ?>
                            <p> Anda menampilkan total data kesuluran <b><?= $ResultTotalDataAll['total_data_all']; ?>
                                    data</b></p>
                            <?php } else { ?>
                            <p> Anda menampilkan total data sebanyak <b><?= $FindLimit ?> data</b> dari total data
                                kesuluran <b><?= $ResultTotalDataAll['total_data_all']; ?> data</b></p>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- End Alert -->
                    <?php } ?>
                    <div class="table-responsive">
                        <table id="data-table-buttons"
                            class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <?php
                                    if (isset($_GET['find'])) { ?>
                                    <th class="text-nowrap">#</th>
                                    <?php
                                        $TableName = $_GET['TableName'];
                                        $columns = $dbcon->query("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_NAME='$TableName'");
                                        foreach ($columns as $columns_name) {
                                        ?>
                                    <th class="text-nowrap"><?= $columns_name['COLUMN_NAME'] ?></th>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <!-- <th class="text-nowrap"></th> -->
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_GET['find'])) { ?>
                                <?php
                                    // For Limit
                                    if ($FindLimit == NULL) {
                                        $forLimit = '';
                                    } else {
                                        $forLimit = 'LIMIT ' . $FindLimit;
                                    }

                                    $TableName = $_GET['TableName'];
                                    $data = $dbcon->query("SELECT * FROM $TableName $forLimit");
                                    ?>
                                <?php if (mysqli_num_rows($data) > 0) {
                                        $no = 0;
                                        while ($row_data = mysqli_fetch_array($data)) {
                                            $no++;
                                    ?>
                                <tr class="odd gradeX">
                                    <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                    <?php
                                                $columns = $dbcon->query("SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_NAME='$TableName'");
                                                foreach ($columns as $columns_name) {
                                                ?>
                                    <?php if ($row_data[$columns_name['COLUMN_NAME']] == NULL || $row_data[$columns_name['COLUMN_NAME']] == '') { ?>
                                    <td class="text-nowrap" style="text-align: left;">
                                        <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                        </font>
                                    </td>
                                    <?php } else { ?>
                                    <td class="text-nowrap"><?= $row_data[$columns_name['COLUMN_NAME']] ?></td>
                                    <?php } ?>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <?php
                                    }
                                    mysqli_close($dbcon);
                                    ?>
                                <?php } else { ?>
                                <?php if (isset($_GET['find'])) { ?>
                                <?php
                                        $count_column = $dbcon->query("SELECT COUNT(COLUMN_NAME) AS total_count_column FROM information_schema.columns WHERE TABLE_NAME='$TableName'");
                                        $result_count_column = mysqli_fetch_array($count_column);
                                        ?>
                                <tr>
                                    <td colspan="<?= $result_count_column['total_count_column'] ?>">
                                        <center>
                                            <div style="display: grid;">
                                                <i class="far fa-times-circle no-data"></i> Tidak ada data
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                <?php } else { ?>
                                <tr>
                                    <td colspan="12">
                                        <center>
                                            <div style="display: grid;">
                                                <i class="far fa-times-circle no-data"></i> Tidak ada data
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>
<?php include "include/jsForm.php"; ?>