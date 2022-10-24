<style>
    #message {
        display: none;
        background: #ffffff;
        color: #000;
        position: relative;
        padding: 10px 5px;
        margin-top: 1px;
        /* margin-left: 361px; */
    }

    #message p {
        padding: 0px 20px;
    }

    .valid {
        color: green;
    }

    .valid:before {
        /* position: relative; */
        /* content: "\f121"; */
        /* font-family: "Ionicons"; */
        font-size: 13px;
        font-weight: 800;
    }

    .invalid {
        color: red;
    }

    .invalid:before {
        position: relative;
        /* content: "\f129"; */
        /* font-family: "Ionicons"; */
        font-size: 13px;
        font-weight: 300;
    }
</style>
<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/top-header.php";
include "include/sidebar.php";
$dataSettting = $dbcon->query("SELECT * FROM tbl_setting");
$resultSetting = mysqli_fetch_array($dataSettting);
// <!-- Cek User For Update Password -->
$Get_USER             = $_SESSION['username'];
$CekUserForUpdatePass = $dbcon->query("SELECT * FROM tbl_users WHERE USER_NAME='$Get_USER'");
$v_password = mysqli_fetch_array($CekUserForUpdatePass);
// <!-- End Cek User For Update Password -->

// UPDATE PASSWORD
if (isset($_POST["update_pass"])) {

    $Get_USER       = $_SESSION['username'];
    $pass_lama      = $_POST['pass_lama'];
    $cekValidation = $dbcon->query("SELECT USER_NAME,PASSWORD FROM tbl_users WHERE USER_NAME ='$Get_USER' AND PASSWORD='$pass_lama'");
    $vald_c = mysqli_fetch_array($cekValidation);

    if ($vald_c == NULL) {
        echo "<script>alert('Password Lama anda salah, periksa kembali!');</script>";
        echo "<script>window.location.href='usr_password.php';</script>";
    } else {
        $uid            = $_SESSION['username'];
        $pass_lama      = $_POST['pass_lama'];
        $pass_baru      = $_POST['pass_baru'];
        $new_pass       = 'Y';

        $queryUpdatePass = $dbcon->query("UPDATE tbl_users SET PASSWORD='$pass_baru',
                                                               NEW_USER='$new_pass'
                                                               WHERE USER_NAME='$uid'");

        // FOR AKTIFITAS
        $me = $_SESSION['username'];
        $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
        $resultme = mysqli_fetch_array($datame);

        $IDUNIQme             = $resultme['USRIDUNIQ'];
        $InputUsername        = $me;
        $InputModul           = 'Profile/Ganti Password';
        $InputDescription     = $me . " Ganti Password, Simpan Data Sebagai Log Ganti Password";
        $InputAction          = 'Update';
        $InputDate            = date('Y-m-d h:m:i');

        $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                               (id,IDUNIQ,username,modul,description,action,date_created)
                               VALUES
                               ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

        if ($queryUpdatePass) {
            echo "<script>window.location.href='usr_profile.php?UpdatePasswordSuccess=true';</script>";
        } else {
            echo "<script>window.location.href='usr_password.php?UpdatePasswordFailed=true';</script>";
        }
    }
}
?>

<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-lock icon-page"></i>
                <font class="text-page">Ganti Password</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Ganti Password</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="data-table">
                <div class="panel-heading">
                    <h4 class="panel-title">[Ganti Password] <?= $_SESSION['username'] ?></h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="" method="POST">
                        <fieldset>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Password Lama</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" name="pass_lama" id="password-lama" placeholder="Password Lama ..." required />
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Password Baru</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" name="pass_baru" id="password-baru" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password harus memiliki kombinasi huruf besar, huruf kecil dan angka, minimal memiliki 8 karakter" placeholder="Password Baru ..." required />
                                    <div class="form-group" id="message">
                                        <label class="form-control-label" for="komponen-password">Password harus memiliki kombinasi:</label>
                                        <p id="capital" class="invalid" style="margin: 0 0 0px;font-weight: 300;"> Huruf Besar</p>
                                        <p id="letter" class="invalid" style="margin: 0 0 0px;font-weight: 300;"> Huruf Kecil</p>
                                        <p id="number" class="invalid" style="margin: 0 0 0px;font-weight: 300;"> Angka</p>
                                        <p id="length" class="invalid" style="margin: 0 0 0px;font-weight: 300;"> Minimal 8 Karakter</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-3 col-form-label">Konfirmasi Password Baru</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" id="password-konfirmasi" placeholder="Konfirmasi Password Baru ..." required />
                                    <span id="CheckPasswordMatch" class="checkpassword"></span>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <div class="col-md-7 offset-md-3">
                                    <div class="checkbox checkbox-css">
                                        <input type="checkbox" id="customCheck1" onclick="myFunctionShowPass()" />
                                        <label for="customCheck1">Tampilkan Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7 offset-md-3">
                                    <button type="submit" class="btn btn-primary" name="update_pass" id="btn-ubah-password"><i class="fas fa-check-circle"></i> Update Password</button>
                                    <!-- <a href="javascript:window.open('','_self').close();" class="btn btn-default"><i class="fas fa-times-circle"></i> Batal</a> -->
                                </div>
                            </div>
                        </fieldset>
                    </form>
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
<!-- Add Success -->
<script type="text/javascript">
    // UPDATE FAILED
    if (window?.location?.href?.indexOf('UpdatePasswordFailed') > -1) {
        Swal.fire({
            title: 'Password gagal disimpan!',
            icon: 'error',
            text: 'Password gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './usr_password.php');
    }
</script>
<!-- Script Show Hidden Password -->
<script type="text/javascript">
    function myFunctionShowPass() {
        var x = document.getElementById("password-lama");
        var y = document.getElementById("password-baru");
        var z = document.getElementById("password-konfirmasi");
        // password-lama
        if (x.type === "password" && y.type === "password" && z.type === "password") {
            x.type = "text";
            y.type = "text";
            z.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
            z.type = "password";
        }
    }
</script>
<!-- Combination Password -->
<script type="text/javascript">
    var myInput = document.getElementById("password-baru");
    var capital = document.getElementById("capital");
    var letter = document.getElementById("letter");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
    }
    myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
    }
    myInput.onkeyup = function() {
        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if (myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if (myInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }
        // Validate numbers
        var numbers = /[0-9]/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }
        // Validate length
        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
</script>
<!-- Validate Password And Confirm Password -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#password-konfirmasi").on('keyup', function() {
            var password = $("#password-baru").val();
            var confirmPassword = $("#password-konfirmasi").val();
            if (password != confirmPassword) {
                $("#CheckPasswordMatch").html("Password anda tidak sama, periksa kembali!").css("color", "red");
                $("#btn-ubah-password").prop("disabled", true);
            } else {
                $("#CheckPasswordMatch").html("Password anda sama!").css("color", "green");
                $("#btn-ubah-password").prop("disabled", false);
            }
        });
    });
</script>
<!-- End Validate Password And Confirm Password -->