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
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>E-modul</h2><span>Daftar E-Modul</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="<?php echo base_url();?>">Beranda</a></li>
						<li>E-modul</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row">
		<form action="<?php echo base_url();?>modul" method='get' style="width: 100%">
		<!-- Search -->
		<div class="col-md-12">
			<div class="main-search-input gray-style margin-top-0 margin-bottom-10">
				
				<div class="main-search-input-item">
					<input name="s" type="text" placeholder="Masukan Judul atau Nama Modul" value="<?php if (!empty($search)) echo $search;?>"/>
				</div>

				<div class="main-search-input-item">
					<select name="c" data-placeholder="All Categories" class="chosen-select" >
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

				<button class="button">Cari</button>
				
			</div>
		</div>
		<!-- Search Section / End -->

		</form>
		

		<div class="col-md-12">



			<div class="row">

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

				<?php $no = 1;?>
              	<?php 

              		foreach ($download as $row ) :

					$judul = $row->judul;
                    $judul = preg_replace("/<img[^>]+\>/i", "(gambar) ", $judul);
                    $judul = preg_replace("/<table[^>]+\>/i", "(tabel) ", $judul);
                    $judul = preg_replace("/<ol[^>]+\>/i", "", $judul);
                    $judul = preg_replace("/<ul[^>]+\>/i", "", $judul);
                    $judul = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $judul);
                    $judul = character_limiter(auto_typography($judul), 50, '&#8230;');
                    $judul = str_ireplace('<p>','',$judul); $judul=str_ireplace('</p>','',$judul);
                    $judul = str_ireplace('<ol>','',$judul); $judul=str_ireplace('</ol>','',$judul);
                    $judul = str_ireplace('<ul>','',$judul); $judul=str_ireplace('</ul>','',$judul);
                    $judul = str_ireplace('<li>','',$judul); $judul=str_ireplace('</li>','',$judul);

					$detail = $row->detail;
                    $detail = preg_replace("/<img[^>]+\>/i", "(gambar) ", $detail);
                    $detail = preg_replace("/<table[^>]+\>/i", "(tabel) ", $detail);
                    $detail = preg_replace("/<ol[^>]+\>/i", "", $detail);
                    $detail = preg_replace("/<ul[^>]+\>/i", "", $detail);
                    $detail = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $detail);
                    $detail = character_limiter(auto_typography($detail), 50, '&#8230;');
                    $detail = str_ireplace('<p>','',$detail); $detail=str_ireplace('</p>','',$detail);
                    $detail = str_ireplace('<ol>','',$detail); $detail=str_ireplace('</ol>','',$detail);
                    $detail = str_ireplace('<ul>','',$detail); $detail=str_ireplace('</ul>','',$detail);
                    $detail = str_ireplace('<li>','',$detail); $detail=str_ireplace('</li>','',$detail);
                ?>

				<!-- Listing Item -->
				<div class="col-lg-4 col-md-6">
					<a href="<?=base_url()."modul/detail/{$row->id_download}?".$_SERVER['QUERY_STRING']?>" class="listing-item-container compact">
						<div class="listing-item">
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

							<div class="listing-badge now-open"><?=$row->hits?> download</div>

							<div class="listing-item-details">
								<ul>
									<li><?=$row->tgl_posting?></li>
								</ul>
							</div>

							<div class="listing-item-content">
								<span class="tag"><?=$row->category_name?></span>
								<h3><?=$judul?> <i class="verified-icon"></i></h3>
								<span><?=$detail?></span>
							</div>
							<span class="like-icon" data-toggle="tooltip" data-placement="bottom" title="Download" onclick="window.open('<?=base_url()."modul/download/{$row->id_download}"?>', '_blank');"></span>
						</div>
					</a>
				</div>
				<!-- Listing Item / End -->

				<?php 
                	$no++;
                	endforeach;
              	?>

			</div>

		      <!-- Pagination Container -->
		      <div class="row fs-listings">
		        <div class="col-md-12">
					<!-- Pagination -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12">
							<!-- Pagination -->
							<div class="pagination-container margin-bottom-40">
								<nav class="pagination">

									<?php
										$CI =& get_instance();
				                        $CI->load->library('pagination');

				                        $this->config->load('bootstrap_pagination');
		        						$config = $this->config->item('pagination');  

				                        $config['base_url'] = base_url(). 'modul';
				                        $config['total_rows'] = $total_rows;
				                        $config['per_page'] = $per_page;
				                        $config['page_query_string']=TRUE;

				                        $config['reuse_query_string'] = TRUE;

				                        $CI->pagination->initialize($config);
				                        $link = $CI->pagination->create_links();
				                        echo $link;
									?>

								</nav>
							</div>
						</div>
					</div>
					<!-- Pagination / End -->
		        </div>
		      </div>

		</div>

	</div>
</div>

