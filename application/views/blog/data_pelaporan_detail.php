<?php
  $CI =& get_instance();
  $CI->load->model('company_profile_model');
  $CI->company_profile_model->set_identity();
  $p_nama = $CI->company_profile_model->nama;
  $p_tentang = $CI->company_profile_model->tentang;
  $p_alamat = $CI->company_profile_model->alamat;
  $p_logo = $CI->company_profile_model->logo;
  $p_email = $CI->company_profile_model->email;
  $p_facebook = $CI->company_profile_model->facebook;
  $p_twitter = $CI->company_profile_model->twitter;
  $p_telepon = $CI->company_profile_model->telepon;
  $p_youtube = $CI->company_profile_model->youtube;
  $p_gmap = $CI->company_profile_model->gmap;
  $p_tentang = $CI->company_profile_model->tentang;
  $p_instagram = $CI->company_profile_model->instagram;
?>

<style type="text/css">
	.overlay {
	  position: absolute;
	  top: 0;
	  bottom: 0;
	  left: 0;
	  right: 0;
	  height: 100%;
	  width: 100%;
	  opacity: 1;
	  transition: .3s ease;
	  background-color: black;
	}

	.icon {
	  color: #f3103c;
	  font-size: 100px;
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  text-align: center;
	}
</style>
<style type="text/css">
	.listing-thumbnail{
		margin: 0;
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%);
	}
	.listing-thumbnail span{
		font-size: 100px;
		/*color: #fff;*/
	}
</style>

<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Data dan Pelaporan</h2><span>Detail Data dan Pelaporan</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="<?php echo base_url();?>">Beranda</a></li>
						<li><a href="<?php echo base_url('data_pelaporan');?>">Data dan Pelaporan</a></li>
						<li><?=$row->nama_kegiatan?></li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>

<!-- Content
================================================== -->
<div class="container">

	<!-- Blog Posts -->
	<div class="blog-page">
	<div class="row">
		<div class="col-lg-9 col-md-8 padding-right-30">

			<!-- Blog Post -->
			<div class="blog-post">
				
				
				<!-- Content -->
				<div class="post-content">
					<h3><?=$row->nama_kegiatan?></h3>

					<ul class="post-meta">
						<li><?=tanggal($row->tanggal_input)?></li>
						<li><?=$row->kategori_berkas?></li>
					</ul>

									<div class="style-1">
					<!-- Tabs Navigation -->
					<ul class="tabs-nav">
						<li class="active"><a href="#tab1a"><i class="im im-icon-Bulleted-List"></i> Detail</a></li>
						<li><a href="#tab2a"><i class="im im-icon-Box-withFolders"></i> Daftar Berkas</a></li>
					</ul>

					<!-- Tabs Content -->
					<div class="tabs-container">
						<div class="tab-content" id="tab1a">
							<table class="table table-stripped">
								<tr>
									<td><h5><b>Unit Kerja</b></h5></td>
									<td><?=$uk1_nama?></td>
								</tr>
								<tr>
									<td><h5><b>Sub Unit Kerja 1</b></h5></td>
									<td><?=$uk2_nama?></td>
								</tr>
								<tr>
									<td><h5><b>Sub Unit Kerja 2</b></h5></td>
									<td><?=$uk3_nama?></td>
								</tr>
								<tr>
									<td><h5><b>Sub Unit Kerja 3</b></h5></td>
									<td><?=$uk4_nama?></td>
								</tr>
								<tr>
									<td><h5><b>Nama Kegiatan</b></h5></td>
									<td><?php echo $detail->nama_kegiatan ?></td>
								</tr>
								<tr>
									<td><h5><b>Kategori Berkas</b></h5></td>
									<td><?php echo $detail->kategori_berkas ?></td>
								</tr>
								<tr>
									<td><h5><b>Tanggal Input</b></h5></td>
									<td><?php echo tanggal($detail->tanggal_input) ?></td>
								</tr>
								<tr>
									<td><h5><b>Jam Input</b></h5></td>
									<td><?php echo stime($detail->waktu_input) ?></td>
								</tr>
								<tr>
									<td><h5><b>Keterangan</b></h5></td>
									<td><?php echo $detail->keterangan ?></td>
								</tr>
							</table>
						</div>

						<div class="tab-content" id="tab2a">

            <?php 
            if(empty($files)){
              ?>  
              <div style="text-align: center"> 
      <i style="font-size: 50px" class="im im-icon-File-Block"></i>
        <h4>Belum Ada File Terupload</h4>
      </div>
              <?php
            }else{
            foreach($files as $f){

            $type_file = $f->type_file;
            $type_file = explode('/', $type_file);
            $type_file = $type_file[0];
            if($type_file=='application'){
                $ext = $f->eks_file;
                $ext = ltrim($ext, '.');
                if($ext=='xls'||$ext=='xlsx'){
                	$icon = 'Excel';
                }elseif($ext=='pdf'){
                	$icon = 'TextImage';
                }elseif($ext=='doc'||$ext=='docx'){
                	$icon = 'Word';
                }else{
                	$icon = '';
                }
            }elseif($type_file=='image'){
            	$icon = 'Pictures';
            }else{
            	$icon = '';
            }
             ?>                 
				<div class="col-lg-4 col-md-6">
				<div class="carousel-item">
					<a href="<?php echo base_url()."data_pelaporan/download_file/".$f->id_berkas_file.'_'.$f->hash_file?>" class="listing-item-container">
						<div class="listing-item" style="background: #ccc;">
							<div class="listing-thumbnail">
								<span class="im im-icon-File<?php echo $icon!=='' ? '-'.$icon : ''  ?>"></span>
							</div>
							<div class="listing-item-content">
								<h4 style="color: #fff"><?php echo $f->nama_file ?></h4>
							</div>
						</div>
					</a>
				</div>
				</div>


                <?php }
                    } ?>  
			</div>
					</div>
				</div>
			</div>

			</div>
			<!-- Blog Post / End -->


		</div>

	<!-- Blog Posts / End -->


	<!-- Widgets -->
	<div class="col-lg-3 col-md-4">
		<div class="sidebar right">
			<form action="<?php echo base_url();?>data_pelaporan" method='get' style="width: 100%">
			<!-- Widget -->
			<div class="widget margin-bottom-40">
				<h3 class="margin-top-0 margin-bottom-30">Cari</h3>

				<!-- Row -->
				<div class="row with-forms">
					<!-- Cities -->
					<div class="col-md-12">
						<input name="s" type="text" placeholder="Masukan Nama Kegiatan" value="<?php if (!empty($search)) echo $search;?>"/>
					</div>
				</div>
				<!-- Row / End -->


				<!-- Row -->
				<div class="row with-forms">
					<!-- Type -->
					<div class="col-md-12">
						<select name="c" data-placeholder="Semua Kategori" class="chosen-select" >
							<option value="">Semua Kategori</option>	
							<?php
								foreach ($categories as $row) {
									$selected = "";
									if ($row->category_id==$this->input->get('c')) {
										$selected = "selected";
									}
									echo "<option value='{$row->category_id}' {$selected}>{$row->category_name}</option>";
								}
							?>
						</select>
					</div>
				</div>
				<!-- Row / End -->

			

				

				<button class="button fullwidth margin-top-25">Cari</button>

			</div>
			<!-- Widget / End -->

			</form>

			<div class="clearfix"></div>
			<div class="margin-bottom-40"></div>
		</div>
	</div>
	</div>
	<!-- Sidebar / End -->


</div>
</div>