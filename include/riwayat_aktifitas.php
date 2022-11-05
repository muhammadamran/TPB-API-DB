<!-- begin riwayat-aktifitas -->
<style>
	.riwayat-aktifitas.riwayat-aktifitas-lg.active {
		right: 0;
	}

	.riwayat-aktifitas.riwayat-aktifitas-lg {
		top: 0;
		bottom: 0;
		width: 260px;
		right: -260px;
	}

	.riwayat-aktifitas.active {
		right: 0;
		-webkit-box-shadow: 0 5px 25px rgb(0 0 0 / 30%);
		box-shadow: 0 5px 25px rgb(0 0 0 / 30%);
	}

	.riwayat-aktifitas {
		position: fixed;
		right: -175px;
		top: 150px;
		z-index: 1020;
		background: #fff;
		padding: 15px;
		width: 175px;
		-webkit-transition: right .2s linear;
		-moz-transition: right .2s linear;
		-ms-transition: right .2s linear;
		-o-transition: right .2s linear;
		transition: right .2s linear;
		-webkit-border-radius: 4px 0 0 4px;
		border-radius: 4px 0 0 4px;
	}

	.line-page-RA {
		height: 0.5px;
		margin: 10px 0px 15px 0px;
		background: #444e66;
	}

	.RA-x {
		display: flex;
		justify-content: space-between;
		align-content: center;
		align-items: center;
	}

	.btn-RA {
		color: #212529;
		background-color: #f1f3f4;
		border-color: #f1f3f4;
		-webkit-box-shadow: 0;
		box-shadow: 0;
		border-radius: 50%;
	}
</style>
<div class="riwayat-aktifitas riwayat-aktifitas-lg active" id="divRA" style="display: none;">
	<div class="riwayat-aktifitas-content">
		<div class="RA-x">
			<div>
				<h5 style="margin-top: 0px;margin-bottom: 0px;">Riwayat Aktifitas</h5>
			</div>
			<div>
				<button onClick="showHideRA('divRA')" class="btn btn-RA"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="line-page-RA"></div>
		<div class="row m-t-10">
			<div class="col-md-12">
				<a href="javascript:;" class="btn btn-default btn-block btn-rounded" data-click="reset-local-storage"><b>Reset Local Storage</b></a>
			</div>
		</div>
		<div class="divider"></div>
		<div class="row m-t-10">
			<div class="col-md-12">
				<div class="panel-hellos">
					<a href="http://hellos-id.com" target="_blank">
						<img src="http://hellos-id.com/images/hellos.png" alt="Hellos-ID" style="width: 130px;">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end riwayat-aktifitas -->