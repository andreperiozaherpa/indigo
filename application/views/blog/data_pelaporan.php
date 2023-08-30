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
	.listing-thumbnail{
		margin: 0;
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%);
	}
	.listing-thumbnail span{
		font-size: 100px;
		color: #f91942;
	}
</style>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Data dan Pelaporan</h2><span>Daftar Data dan Pelaporan</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="<?php echo base_url();?>">Beranda</a></li>
						<li>Data dan Pelaporan</li>
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
		<form action="<?php echo base_url();?>data_pelaporan" method='get' style="width: 100%">
		<!-- Search -->
		<div class="col-md-12">
			<div class="main-search-input gray-style margin-top-0 margin-bottom-10">
				
				<div class="main-search-input-item">
					<input name="s" type="text" placeholder="Masukan Nama Kegiatan atau Deskripsi" value="<?php if (!empty($search)) echo $search;?>"/>
				</div>

				<div class="main-search-input-item">
					<select name="c" data-placeholder="All Categories" class="chosen-select" >
						<option value="">Semua Kategori</option>	
						<?php
							foreach ($categories as $row) {
								$selected = "";
								if ($row->id_kategori_berkas==$this->input->get('c')) {
									$selected = "selected";
								}
								echo "<option value='{$row->id_kategori_berkas}' {$selected}>{$row->kategori_berkas}</option>";
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

              		foreach ($berkas as $row ) :

					$nama_kegiatan = $row->nama_kegiatan;
                    $nama_kegiatan = preg_replace("/<img[^>]+\>/i", "(gambar) ", $nama_kegiatan);
                    $nama_kegiatan = preg_replace("/<table[^>]+\>/i", "(tabel) ", $nama_kegiatan);
                    $nama_kegiatan = preg_replace("/<ol[^>]+\>/i", "", $nama_kegiatan);
                    $nama_kegiatan = preg_replace("/<ul[^>]+\>/i", "", $nama_kegiatan);
                    $nama_kegiatan = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $nama_kegiatan);
                    $nama_kegiatan = character_limiter(auto_typography($nama_kegiatan), 50, '&#8230;');
                    $nama_kegiatan = str_ireplace('<p>','',$nama_kegiatan); $nama_kegiatan=str_ireplace('</p>','',$nama_kegiatan);
                    $nama_kegiatan = str_ireplace('<ol>','',$nama_kegiatan); $nama_kegiatan=str_ireplace('</ol>','',$nama_kegiatan);
                    $nama_kegiatan = str_ireplace('<ul>','',$nama_kegiatan); $nama_kegiatan=str_ireplace('</ul>','',$nama_kegiatan);
                    $nama_kegiatan = str_ireplace('<li>','',$nama_kegiatan); $nama_kegiatan=str_ireplace('</li>','',$nama_kegiatan);

					$keterangan = $row->keterangan;
                    $keterangan = preg_replace("/<img[^>]+\>/i", "(gambar) ", $keterangan);
                    $keterangan = preg_replace("/<table[^>]+\>/i", "(tabel) ", $keterangan);
                    $keterangan = preg_replace("/<ol[^>]+\>/i", "", $keterangan);
                    $keterangan = preg_replace("/<ul[^>]+\>/i", "", $keterangan);
                    $keterangan = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $keterangan);
                    $keterangan = character_limiter(auto_typography($keterangan), 50, '&#8230;');
                    $keterangan = str_ireplace('<p>','',$keterangan); $keterangan=str_ireplace('</p>','',$keterangan);
                    $keterangan = str_ireplace('<ol>','',$keterangan); $keterangan=str_ireplace('</ol>','',$keterangan);
                    $keterangan = str_ireplace('<ul>','',$keterangan); $keterangan=str_ireplace('</ul>','',$keterangan);
                    $keterangan = str_ireplace('<li>','',$keterangan); $keterangan=str_ireplace('</li>','',$keterangan);
                ?>

				<!-- Listing Item -->
				<div class="col-lg-4 col-md-6">
									<div class="carousel-item">
					<a href="<?php echo site_url('data_pelaporan/detail/'.$row->id_berkas.'') ?>" class="listing-item-container">
						<div class="listing-item" style="background: #ccc;">
							<div class="listing-thumbnail">
								<span class="im im-icon-Folder-Archive"></span>
							</div>
							<div class="listing-item-details">
								<ul>
									<li><?php echo tanggal($row->tanggal_input) ?></li>
								</ul>
							</div>
							<div class="listing-item-content">
								<span class="tag"><?php echo $row->kategori_berkas ?></span>
								<h3><?php echo $row->nama_kegiatan ?></h3>
								<span><?php echo $row->nama_unit_kerja ?></span>
							</div>
						</div>
					</a>
				</div>
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

