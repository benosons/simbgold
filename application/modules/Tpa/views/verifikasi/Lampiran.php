<?php
//isset($tpa) ? $data['DataTpa'] = $tpa->row() : $data['DataTpa'] = '';
//isset($pendidikan) ? $data['DataPendidikan'] = $pendidikan : $data['DataPendidikan'] = '';
//isset($keahlian) ? $data['DataKeahlian'] = $keahlian : $data['DataKeahlian'] = '';
//isset($pengalaman) ? $data['DataPengalaman'] = $pengalaman : $data['DataPengalaman'] = '';
?>
<form action="<?php echo site_url(''); ?>" class="form-horizontal" role="form" method="post">
	<div class="modal-body"></div>
</form>
<!--MODAL HAPUS-->

<script type="text/javascript">
	function cek_tugas(kuy, ip) {
		if (document.getElementById(kuy).checked) {
			$.ajax({
				url: '<?php echo base_url('tpa/cek_tugas/' . $this->uri->segment(3)) ?>/' + ip + '/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		} else {
			$.ajax({
				url: '<?php echo base_url('tpa/uncek_tugas/' . $this->uri->segment(3)) ?>/' + ip + '/',
				type: 'POST',
				dataType: 'html',
				cache: false,
				success: function(response) {
					$('div#detail_personal').html('');
					$('div#detail_personal').html(response);
				}
			});
		}
	}
</script>