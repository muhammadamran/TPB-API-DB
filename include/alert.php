<style>
	.swal2-styled.swal2-confirm {
		border: 0;
		border-radius: 0.25em;
		background: initial;
		background-color: #00acac;
		color: #fff;
		font-size: 1.0625em;
	}
</style>
<script type="text/javascript">
	if (window?.location?.href?.indexOf('SignInsuccess') > -1) {
		Swal.fire({
			imageUrl: 'assets/images/welcome/welcome.svg',
			imageWidth: 350,
			imageHeight: 345,
			imageAlt: 'Custom image',
			title: 'Sign In berhasil!',
			html: '<font style="font-size: 14px;font-weight: 500;">Anda berhasil masuk dan memulai <b><i>session</i></b> anda!</font>',
		})
		history.replaceState({}, '', './index.php');
	}
</script>