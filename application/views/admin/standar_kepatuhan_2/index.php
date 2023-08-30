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
				<div class="col-md-12">
					<div class="white-box">
						<div class="row">
							<form method="post">
						<?php if (in_array('admin_standar_kepatuhan', $user_privileges) || in_array('standar_kepatuhan', $user_privileges) || $user_level == 'Administrator') : ?>
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-12">
										<label>&nbsp;</label>
											<?php 
												$date = date('Y-m-d');
												if ($this->session->userdata('id_skpd') == 16 || ($date > $status_form->tanggal_mulai && $date < $status_form->tanggal_tutup)) { ?>
													<a href="<?= base_url('standar_kepatuhan/add') ?>" style="vertical-align:middle" class="btn btn-info btn-block"><i class="fa fa-plus-circle"></i> Tambah Standar Kepatuhan</a>
												<?php
												}
												?>
									</div>
								</div>
							</div>
							<?php endif ?>
							<?php if (in_array('admin_standar_kepatuhan', $user_privileges) || $user_level == 'Administrator') : ?>
								<div class="col-md-3 b-l">
									<label>SKPD</label>
									<select name="id_skpd" class="form-control select2" id="">
										<option value="">-- Pilih SKPD --</option>
										<?php foreach ($skpd as $key => $value) { ?>
											<option value="<?=$value->id_skpd?>" <?=(set_value('id_skpd') == $value->id_skpd) ? 'selected' : null;?>><?=$value->nama_skpd?></option>
										<?php } ?>
									</select>
								</div>
								<?php endif ?>
								<div class="col-md-4">
									<label>Periode Waktu</label>
									<div class="input-group">
                                            <input type="date" value="<?=set_value('start')?>" class="form-control" name="start" /> <span class="input-group-addon bg-primary b-0 text-white">to</span>
                                            <input type="date" value="<?=set_value('end')?>" class="form-control" name="end" /> 
									</div>
								</div>
								<div class="col-md-2">
									<label>&nbsp;</label>
									<button type="submit" name="filter" class="btn btn-primary btn-block btn-outline"><i class="ti-filter"></i> Filter</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<?php
					if(!empty($this->session->flashdata('message'))){
						echo '<div class="alert alert-'.$this->session->flashdata('type').'">'.$this->session->flashdata('message').'</div>';
					}
					?>
					<?php if ($this->session->flashdata('success')) { ?>
						<div class="alert alert-success">
							<?= $this->session->flashdata('success') ?>
						</div>
					<?php } ?>
				</div>
				<?php
				if(empty($list)){
					?>
					<center>
						<i class="icon-hourglass" style="font-size: 60px;color: #6003c8"></i>
						<p>Belum ada data</p>
					</center>
					<?php

				}else{ ?>
					<div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">RESPONDEN STANDAR KEPATUHAN</h3>
							<div class="row">
								<div class="col-md-12 text-right mb-5">
									<?php if (in_array('admin_standar_kepatuhan', $user_privileges) || $user_level == 'Administrator') { ?>
										<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#tutupForm">
											<i class="fa fa-cog"></i> Setting Form
										</button>
									<?php } ?>
								</div>
								<br><br>
							</div>
								<div class="modal fade" id="tutupForm" tabindex="-1" role="dialog" aria-labelledby="tutupFormLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="tutupFormLabel">Apakah anda yakin untuk menutup Form ?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form method="POST">
													<div class="form-group">
														<label for="">Tanggal dibuka pengipuntan</label>
														<input type="date" name="tanggal_mulai" value="<?= $status_form->tanggal_mulai ?>" class="form-control" required>
													</div>
													<div class="form-group">
														<label for="">Tanggal ditutup penginputan</label>
														<input type="date" name="tanggal_tutup" value="<?= $status_form->tanggal_tutup ?>" class="form-control" required>
													</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" name="setting-form" class="btn btn-primary">Simpan</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							<div class="row">
								<div class="table-responsive">
									<table id="example23" class="display nowrap" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>Nama Responden</th>
												<th>SKPD YANG DINILAI</th>
												<th>Nilai</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($list as $key => $value) {
												?>
												<tr>
													<td><?=$value['nama_lengkap']?></td>
													<td><b><?=$value['nama_skpd']?></b></td>
													<td><i><b><?=$value['nilai'] ? number_format($value['nilai'], 1) : $value['nilai_sistem']?></b></i></td>
													<td>
														<?php if ($value['status'] == 'Y') { ?>
															<span class="badge badge-success">Sudah direview</span></span>
														<?php }else{ ?>
															<span class="badge badge-danger">Belum direview</span>
														<?php } ?>	
													</td>
													<td>
														<a href="<?=base_url('standar_kepatuhan/detail/'.$value['id_standar_kepatuhan'])?>" class="btn btn-info btn-xs">
														<i class="fa fa-eye"></i> Detail
														</a>
														<?php if ($user_level == 'Administrator' or (in_array('program', $user_privileges) && $id_skpd == 1) && $value['status'] == 'N') : ?>
														<a href="<?=base_url('standar_kepatuhan/delete/'.$value['id_standar_kepatuhan'])?>" onclick="return confirm('Apakah anda yakin menghapus data ini')" class="btn btn-danger btn-xs">
															<i class="fa fa-trash"></i> Hapus
														</a>
														<?php endif ?>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
                            	</div>
							</div>
                        </div>
                    </div>
				<?php } ?>
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
