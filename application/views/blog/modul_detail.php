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

  foreach ($download as $row) {
  	# code...
  }
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


<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>E-modul</h2><span>Detail Modul</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="<?php echo base_url();?>">Beranda</a></li>
						<li><a href="<?php echo base_url('modul');?>">E-modul</a></li>
						<li><?=$row->judul?></li>
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
				
				<!-- Img -->
				<a href="<?=base_url()."modul/download/{$row->id_download}"?>" target="_blank" class="post-img" style="min-height: 265px;">
					<img src="<?=base_url()."data/download/{$row->nama_file}"?>" alt="">
					<?php
						if (strpos(get_mime_by_extension($row->nama_file), 'image/') === false) :
							if (strpos(get_mime_by_extension($row->nama_file), 'text/') !== false) {
								$file_type = "im-icon-File-TextImage";
							} elseif (strpos(get_mime_by_extension($row->nama_file), 'audio/') !== false) {
								$file_type = "im-icon-File-Music";
							} elseif (strpos(get_mime_by_extension($row->nama_file), 'video/') !== false) {
								$file_type = "im-icon-File-Video";
							} else {
								$file_type = "im-icon-File";
							}
					?>
						<div class="overlay">
						      <i class="icon im <?=$file_type?>"></i>
						</div>
					<?php
						endif;
					?>
				</a>
				
				<!-- Content -->
				<div class="post-content">
					<h3><a href="<?=base_url()."modul/download/{$row->id_download}"?>"><?=$row->judul?> </a></h3>

					<ul class="post-meta">
						<li><?=$row->tgl_posting?></li>
						<li><?=$row->category_name?></li>
						<li><?=$row->hits?> download</li>
					</ul>

					<p><?=$row->detail?></p>

					<a href="<?=base_url()."modul/download/{$row->id_download}"?>" target="_blank" class="read-more">Download <i class="fa fa-download"></i></a>
				</div>

			</div>
			<!-- Blog Post / End -->


		</div>

	<!-- Blog Posts / End -->


	<!-- Widgets -->
	<div class="col-lg-3 col-md-4">
		<div class="sidebar right">
			<form action="<?php echo base_url();?>modul" method='get' style="width: 100%">
			<!-- Widget -->
			<div class="widget margin-bottom-40">
				<h3 class="margin-top-0 margin-bottom-30">Cari</h3>

				<!-- Row -->
				<div class="row with-forms">
					<!-- Cities -->
					<div class="col-md-12">
						<input name="s" type="text" placeholder="Masukan Nama Modul" value="<?php if (!empty($search)) echo $search;?>"/>
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