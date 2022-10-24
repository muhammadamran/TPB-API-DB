<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
	<div class="page-title-css">
		<div>
			<h1 class="page-header-css">
				<i class="fas fa-tasks icon-page"></i>
				<font class="text-page">Summary</font>
			</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Summary</li>
			</ol>
		</div>
		<div>
			<button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('h:m:i a') ?></font></span></button>
		</div>
	</div>
	<div class="line-page"></div>
	<?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php 
// include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
?>