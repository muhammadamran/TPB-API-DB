<!-- begin pusat-bantuan -->
<style>
	.pusat-bantuan.pusat-bantuan-lg.active {
		right: 0;
	}

	.pusat-bantuan.pusat-bantuan-lg {
		top: 0;
		bottom: 0;
		/* width: 260px; */
		width: 430px;
		right: -260px;
	}

	.pusat-bantuan.active {
		right: 0;
		-webkit-box-shadow: 0 5px 25px rgb(0 0 0 / 30%);
		box-shadow: 0 5px 25px rgb(0 0 0 / 30%);
	}

	.pusat-bantuan {
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

	.line-page-PB {
		height: 0.5px;
		margin: 10px 0px 15px 0px;
		background: #444e66;
	}

	.PB-x {
		display: flex;
		justify-content: space-between;
		align-content: center;
		align-items: center;
	}

	.btn-PB {
		color: #212529;
		background-color: #f1f3f4;
		border-color: #f1f3f4;
		-webkit-box-shadow: 0;
		box-shadow: 0;
		border-radius: 50%;
	}
</style>
<div class="pusat-bantuan pusat-bantuan-lg active" id="divPB" style="display: none;">
	<div class="pusat-bantuan-content">
		<div class="PB-x">
			<div>
				<h5 style="margin-top: 0px;margin-bottom: 0px;">Pusat Bantuan</h5>
			</div>
			<div>
				<button onClick="showHidePB('divPB')" class="btn btn-PB"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="line-page-PB"></div>
		<div class="row m-t-10">
			<div class="col-md-12">

			</div>
		</div>
	</div>
</div>
<!-- end pusat-bantuan -->