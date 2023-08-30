<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Rencana Kerja Pemerintah Desa</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li>RKP Desa</li>
				<li class="active">Perencanaan</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>


</div>



<div class="row">
	<div class="col-md-12">
		<?php
		$id_skpd = $this->session->userdata('id_skpd');
		$detail = $this->ref_skpd_model->get_by_id($id_skpd);
		if ($detail && $detail->jenis_skpd == 'kecamatan') {
			$frame = 'kecamatan/' . $id_skpd . '?tahun=2022';
		} else {
			$frame = 'kabupaten?tahun=2022';
		}
		?>
		<iframe src="https://e-officedesa.sumedangkab.go.id/dashboard_sakip/<?= $frame ?>/true" style="border:none" width="100%" height="1200px"></iframe>
	</div>

</div>