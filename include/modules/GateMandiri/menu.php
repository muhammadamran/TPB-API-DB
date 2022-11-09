<li class="nav-header">GATE MANDIRI</li>
<li class="has-sub <?= $uriSegments[1] == 'gm_pemasukan.php' ||
                        $uriSegments[1] == 'gm_pemasukan_detail.php' ||
                        $uriSegments[1] == 'gm_pemasukan_ct.php' ||
                        $uriSegments[1] == 'gm_pemasukan_ct_detail.php' ||
                        $uriSegments[1] == 'gm_pemasukan_proses.php' ||
                        $uriSegments[1] == 'gm_pengeluaran.php' ||
                        $uriSegments[1] == 'gm_pengeluaran_detail.php' ||
                        $uriSegments[1] == 'gm_pengeluaran_ct.php' ||
                        $uriSegments[1] == 'gm_pengeluaran_ct_detail.php' ||
                        $uriSegments[1] == 'gm_pengeluaran_proses.php' ||
                        $uriSegments[1] == 'gm_pengeluaran_detail.php' ? 'active' : '' ?>">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fas fa-door-open icon-page-sidebar"></i>
        <span>
            Gate Mandiri
            <!-- <span class="label label-theme">0</span> -->
        </span>
    </a>
    <ul class="sub-menu">
        <li class="<?= $uriSegments[1] == 'gm_pemasukan.php' || $uriSegments[1] == 'gm_pemasukan_detail.php' || $uriSegments[1] == 'gm_pemasukan_ct.php' || $uriSegments[1] == 'gm_pemasukan_proses.php' || $uriSegments[1] == 'gm_pemasukan_ct_detail.php' ? 'active' : '' ?>">
            <a href="gm_pemasukan.php">
                Gate In
                <span class="label label-theme" id="R_GateIn"></span>
            </a>
        </li>
        <li class="<?= $uriSegments[1] == 'gm_pengeluaran.php' || $uriSegments[1] == 'gm_pengeluaran_detail.php' || $uriSegments[1] == 'gm_pengeluaran_ct.php' || $uriSegments[1] == 'gm_pengeluaran_proses.php' || $uriSegments[1] == 'gm_pengeluaran_ct_detail.php' ? 'active' : '' ?>">
            <a href="gm_pengeluaran.php">
                Gate Out
                <span class="label label-theme" id="R_GateOut"></span>
            </a>
        </li>
    </ul>
</li>

<script>
    // GateIn
    function R_GateIn() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("R_GateIn").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "realtime/sidebar-data.php?function=GateIn", true);
        xhttp.send();
    }
    setInterval(function() {
        R_GateIn();
    }, 1000);
    window.onload = R_GateIn;
    // GateOut
    function R_GateOut() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("R_GateOut").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "realtime/sidebar-data.php?function=GateOut", true);
        xhttp.send();
    }
    setInterval(function() {
        R_GateOut();
    }, 1000);
    window.onload = R_GateOut;
</script>