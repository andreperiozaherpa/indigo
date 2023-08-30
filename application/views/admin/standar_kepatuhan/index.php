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
						<?php if ($user_level == 'Administrator' or (in_array('program', $user_privileges) && $id_skpd == 1)) : ?>
							<div class="col-md-3">
								<label>&nbsp;</label>
								<?php if ($sklm->status == 'Y') { ?>
									<a href="<?=base_url('standar_kepatuhan/update_sklm/'.$sklm->id_standar_kepatuhan_list)?>" class="btn btn-danger btn-block"><i class="ti-arrow-down"></i> Tutup Form</a>
								<?php }else{ ?>
										<a href="<?=base_url('standar_kepatuhan/update_sklm/'.$sklm->id_standar_kepatuhan_list)?>" class="btn btn-primary btn-block"><i class="ti-arrow-up"></i> Buka Form</a>
								<?php } ?>
							</div>
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
											$nilai = 0;
											foreach ($column as $ky => $v) {
												if ($value[$v->name] == 'YA') {
													$nilai += 1;
												}
											}
											?>
											<tr>
												<td><?=$value['nama_lengkap']?></td>
												<td><b><?=$value['nama_skpd']?></b></td>
												<td><i><b><?=$value['nilai_review'] ?? $nilai?></b></i></td>
												<td>
													<?php if ($value['status_review'] == 'Sudah Direview') { ?>
														<span class="badge badge-success">Sudah direview</span></span>
													<?php }else{ ?>
														<span class="badge badge-danger">Belum direview</span>
													<?php } ?>	
												</td>
												<td>
													<a href="<?=base_url('standar_kepatuhan/detail/'.$value['id_standar_kepatuhan'])?>" class="btn btn-primary btn-rounded">
														<i class="fa fa-eye"> Detail</i>
													</a>
													<?php if ($user_level == 'Administrator' or (in_array('program', $user_privileges) && $id_skpd == 1)) : ?>
													<a href="<?=base_url('standar_kepatuhan/delete/'.$value['id_standar_kepatuhan'])?>" onclick="return confirm('Apakah anda yakin menghapus data ini')" class="btn btn-danger btn-rounded">
														<i class="fa fa-trash"> Hapus</i>
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
