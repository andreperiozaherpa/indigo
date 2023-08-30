
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Individual Development Plan</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>


<div class="row">
	<div class="col-md-12">
		<div class="white-box">
			<div class="row">
				<form method="POST">
					<div class="col-md-10">
                    <div class="col-md-4">
							<div class="form-group">
								<label>NIP</label>
										<input type="number" max-length="18" class="form-control" placeholder="Cari berdasarkan NIP" name="nip" value="<?= !empty($nip) ? $nip : ''?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Nama Lengkap</label>
										<input type="text" class="form-control" placeholder="Cari berdasarkan Nama Lengkap" name="nama_lengkap" value="<?=!empty($nama_lengkap) ? $nama_lengkap : ''?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">SKPD</label>
								<select name="id_skpd" class="form-control select2">
									<option value="">Pilih SKPD</option>
									<?php
									foreach($dt_skpd as $s){
										if($filter){
											if($id_skpd==$s->id_skpd){
												$selected = ' selected';
											}else{
												$selected = '';
											}
										}else{
											$selected = '';
										}
										echo'<option value="'.$s->id_skpd.'"'.$selected.'>'.$s->nama_skpd.'</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-2">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                <?php
                if($filter){
                  ?>
                  <a href="" class="btn btn-default m-t-5"><i class="ti-back-left"></i> Reset</a>
                  <?php
                }
                ?>
              </div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<?php
		$color = "";
		$color_code = "";
		$icon = "";
		$status = "";
		foreach($dt_idp as $row) { ?>
			<div class="col-md-4 col-sm-6">
				<div class="verify-data-status <?=$color?>">
				<i class="<?=$icon?>"></i> <?=$status?>
				</div>
				<div class="white-box" style="height:300px;width:auto;">
					<div class="row b-b" style="height:120px;">
						<div class="col-md-4 col-xs-4 b-r text-center" style="height:120px;">
							<br>
							<img src="<?=base_url('data/foto/pegawai/user_default.png')?>" alt="user" style=" object-fit: cover;
				  width: 80px;
				  height: 80px;border-radius: 50%;
				  ">
						</div>
						<div class="col-md-8  col-xs-8">
							<br>
							<h5><b><?=$row->nama_lengkap;?></b></h5>
							<h5><small><?=$row->nip;?></small></h5>
						</div>
					</div>
					<div class="row b-b" style="height:85px;">
						<div class="text-center">
							<br>
							<b><i class="fa fa-users"></i> SKPD</b>
							<br>
							<small><?=$row->nama_skpd;?></small>
						</div>
					</div>
					<div class="row">
						<br>
						<a href="<?=base_url();?>talenta/idp/detail/<?=$row->id_pegawai;?>">
							<button class="btn btn-primary btn-block btn btn-<?=$color?> btn-outline btn-1b btn-block">Formulir IDP</button>
						</a>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>


<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

					<div class="row">
						<div class="col-md-12 pager">
							<?php
							
								echo make_pagination($pages,$current);
							
							?>
						</div>
					</div>

		</div>

	</div> 
</div>
