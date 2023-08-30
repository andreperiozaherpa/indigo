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
							<div class="col-md-3">
								<label>&nbsp;</label>
								<a href="<?=base_url('helpdesk/add')?>" class="btn btn-primary btn-block"><i class="ti-plus"></i> Buat Baru</a>
							</div>
							<form method="post">
								<div class="col-md-4 b-l">
									<label>Subjek</label>
									<input type="text" name="subjek" class="form-control" placeholder="Cari berdasarkan Subjek ..." value="<?=isset($_POST['subjek']) ? $_POST['subjek'] : NULL ?>">
								</div>
								<div class="col-md-3">
									<label>Status Bantuan</label>
									<select name="status" class="form-control">
										<option value="">Semua Status</option>
										<option value="menunggu_respon" <?php if(isset($_POST['status']) && $_POST['status'] == 'menunggu_respon')
									          echo ' selected="selected"';
									    ?>>Menunggu Respon</option>
										<option value="sedang_diproses" <?php if(isset($_POST['status']) && $_POST['status'] == 'sedang_diproses')
									          echo ' selected="selected"';
									    ?>>Sedang diproses</option>
										<option value="selesai" <?php if(isset($_POST['status']) && $_POST['status'] == 'selesai')
									          echo ' selected="selected"';
									    ?>>Selesai</option>
									</select>
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

				}else{
					foreach($list as $l){
						if($l->status=='selesai'){
							$color = 'success';
							$icon = 'ti-check';
						}elseif($l->status=='sedang_diproses'){
							$color = 'info';
							$icon = 'icon-options';
						}elseif($l->status=='tutup'){
							$color = 'danger';
							$icon = 'icon-shield';
						}else{
							$color = 'warning';
							$icon = 'ti-time';
						}
						$page = isset($_GET['page']) ? '?page='.$_GET['page'] : '';
						?>
						<div class="col-md-4">
							<div class="white-box">
								<div class="row">
									<div class="col-md-4" style="border-bottom: solid 2px #6003c8;padding-bottom: 5px">
										<span class="label label-primary">ID Bantuan #<?=$l->no_bantuan?></span>
									</div>
									<div class="col-md-8">
										<span class="label label-<?=$color?> pull-right"><i class="<?=$icon?>"></i> <?=normal_string($l->status)?></span>
									</div>
								</div>
								<div class="row" style="margin-top: 13px">
									<h4 style="font-size: 12px;line-height: 1;font-weight: 500;margin-bottom: 0;"><i class="fa fa-paper-plane"></i> SUBJEK</h4>
									<p><?=$l->subjek?></p>
									<h4 style="font-size: 12px;line-height: 1;font-weight: 500;margin-bottom: 0;margin-top: 2px"><i class="ti-calendar"></i> DIBUAT PADA</h4>
									<p><?=tanggal($l->tgl_laporan)?> <?=stime($l->jam_laporan)?></p>
									<form method="post">
										<a href="<?=base_url('helpdesk/detail/'.$l->id_helpdesk.$page)?>" type="submit" name="baca" class="btn btn-primary pull-right"><i class="ti-arrow-circle-right"></i> Detail</a>
									</form>
								</div>
							</div>
						</div>
					<?php }
				} ?>
			</div>
		</div>
	</div>

	
	<div class="row">
					<div class="col-md-12 pager">
						<?php
						if(!$filter){
							echo make_pagination($pages,$current);
						}
						?>
					</div>
				</div>


</div>
