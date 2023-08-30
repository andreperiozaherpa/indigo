<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo title($title) ?></h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<?php echo breadcrumb($this->uri->segment_array()); ?>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12">
				<div class="row">
					<div class="white-box">
						<div class="mb-5">
							<a href="parameter_penilaian_indeks_inovasi/add" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah</a>
							<br><br>
							<?php if ($this->session->flashdata('success')) { ?>
								<div class="alert alert-success">
									<?=$this->session->flashdata('success')?>
								</div>
							<?php } ?>
						</div>
					<div class="table-responsive">
							<table id="inovasi1" class="" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Indikator</th>
										<th>Definisi Operasional</th>
										<th>Bobot</th>
										<th>Parameter 1</th>
										<th>Parameter 2</th>
										<th>Parameter 3</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($list as $key => $v) { ?>
										<tr>
											<td><?=$no?></td>
											<td>
												<?=$v->indikator?>
											</td>
											<td>
												<?=$v->definisi_operasional?>
											</td>
											<td><?=$v->bobot?></td>
											<td>
												<?=$v->parameter_pertama?>
											</td>
											<td>
												<?=$v->parameter_kedua?>
											</td>
											<td>
												<?=$v->parameter_ketiga?>
											</td>
											<td>
												<a href="<?=base_url('parameter_penilaian_indeks_inovasi/edit/'.$v->id)?>" title="Edit Proposal" target="_blank"><i class="text-muted fa fa-edit"></i></a>&nbsp;
												<!-- <a href="<?=base_url('parameter_penilaian_indeks_inovasi/detail/'.$v->id)?>" title="Lihat Proposal" target="_blank"><i class="text-muted fa fa-eye"></i></a>&nbsp; -->
												<a href="<?=base_url('parameter_penilaian_indeks_inovasi/delete/'.$v->id)?>" onclick="return confirm('apakah anda yakin menghapus data ini?')" title="Hapus Proposal"><i class="text-muted fa fa-trash"></i></a>&nbsp;
											</td>
										</tr>
									<?php $no++; } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
		</div>
	</div>


</div>
<script>
	function confirmDelete() {
		if (confirm("Confirm message")) {
		// do stuff
		} else {
			return false;
		}
	}
	</script>
