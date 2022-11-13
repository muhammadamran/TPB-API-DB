<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->
<!-- ================== BEGIN BASE JS ================== -->
<script src="assets/js/app.min.js"></script>
<script src="assets/js/theme/default.min.js"></script>
<!-- ================== END BASE JS ================== -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/plugins/d3/d3.min.js"></script>
<script src="assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript">
        // gm_pemasukan_detail.php
        function checkAll(checkId) {
                var inputs = document.getElementsByTagName("input");
                var VarAll = document.getElementById("buttonPilihAll");
                for (var i = 0; i < inputs.length; i++) {
                        if (inputs[i].type == "checkbox" && inputs[i].id == checkId) {
                                if (inputs[i].checked == true) {
                                        inputs[i].checked = false;
                                        VarAll.style.display = "none";
                                } else if (inputs[i].checked == false) {
                                        inputs[i].checked = true;
                                        VarAll.style.display = "block";
                                }
                        }
                }
        }
        // End gm_pemasukan_detail.php

        // RIAWYAT AKTIFITAS
        function showHideRA(ele) {
                var srcElement = document.getElementById(ele);
                if (srcElement != null) {
                        if (srcElement.style.display == "block") {
                                srcElement.style.display = 'none';
                        } else {
                                srcElement.style.display = 'block';
                        }
                        return false;
                }
        }
        // PUSAT BANTUAN
        function showHidePB(ele) {
                var srcElement = document.getElementById(ele);
                if (srcElement != null) {
                        if (srcElement.style.display == "block") {
                                srcElement.style.display = 'none';
                        } else {
                                srcElement.style.display = 'block';
                        }
                        return false;
                }
        }
        // TABLE DEFAULT LENGHT
        $(document).ready(function() {
                $('#TableDefault_L').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                                'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'
                        ],
                        "order": [],
                        lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, 'All'],
                        ],
                        "columnDefs": [{
                                "targets": 'no-sort',
                                "orderable": false,
                        }],
                        // iDisplayLength: -1
                });
        });
        // TABLE DEFAULT
        $(document).ready(function() {
                $('#TableDefault').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                                'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'
                        ],
                        "order": [],
                        lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, 'All'],
                        ],
                        iDisplayLength: -1
                });
        });

        // COPY,PDF
        // TABLE DEFAULT LENGHT
        $(document).ready(function() {
                $('#C_TableDefault_L').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                                'copyHtml5', 'pdfHtml5'
                        ],
                        "order": [],
                        lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, 'All'],
                        ],
                        "columnDefs": [{
                                "targets": 'no-sort',
                                "orderable": true,
                        }],
                        // iDisplayLength: -1
                });
        });
        // TABLE DEFAULT
        $(document).ready(function() {
                $('#C_TableDefault').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                                'copyHtml5', 'pdfHtml5'
                        ],
                        "order": [],
                        lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, 'All'],
                        ],
                        iDisplayLength: -1
                });
        });
</script>
</body>

</html>