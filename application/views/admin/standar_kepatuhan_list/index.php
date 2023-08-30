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
								<a href="<?=base_url('standar_kepatuhan_list/add')?>" class="btn btn-primary btn-block"><i class="ti-plus"></i> Buat Baru</a>
							</div>
							<form method="post">
								<div class="col-md-4 b-l">
									<label>Judul</label>
									<input type="text" name="judul" class="form-control" placeholder="Cari berdasarkan Judul ..." value="<?=isset($_POST['judul']) ? $_POST['judul'] : NULL ?>">
								</div>
								<div class="col-md-3">
									<label>Tahun</label>
									<select name="tahun" class="form-control" id="">
										<?php for ($i=date('Y')-1; $i < date('Y') + 2; $i++) {  ?>
											<option value="<?=$i?>"><?=$i?></option>
										<?php } ?>
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
						if($l->status=='Y'){
							$color = 'success';
							$status = 'Aktif';
							$icon = 'ti-check';
						}else{
							$color = 'warning';
							$status = 'Non Aktif';
							$icon = 'ti-time';
						}
						?>
						<div class="col-md-4">
							<div class="white-box">
								<div class="row">
									<div class="col-md-4" style="border-bottom: solid 2px #6003c8;padding-bottom: 5px">
										<span class="label label-primary"><?=$l->judul?></span>
									</div>
									<div class="col-md-8">
										<span class="label label-<?=$color?> pull-right"><i class="<?=$icon?>"></i> <?=$status?></span>
									</div>
								</div>
								<div class="row" style="margin-top: 13px">
									<form method="post">
										<a href="<?=base_url('standar_kepatuhan_list/detail/'.$l->id_standar_kepatuhan_list.$page)?>" type="submit" name="baca" class="btn btn-primary pull-right"><i class="ti-arrow-circle-right"></i> Detail</a>
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
