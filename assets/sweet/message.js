const flashData = $ ('.flash-data').data('flashdata');

if (flashData) {
    Swal.fire({
        title:'Anda Berhasil Login!',
        text:'Username anda adalah ' + flashData,
		imageUrl: '<?= base_url('assets/vendors/images/v-gagal-login.png') ?>',
		imageWidth: 400,
		imageHeight: 250,
		imageAlt: 'Custom image',
    });
}