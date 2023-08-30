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
<div id="titlebar"  style="background: #ffffff fixed;">
	 <div class="container" style="margin-top:10px;">
		<div class="row">
			<div class="col-md-12">

				<h2 class="putih">Berita</h2>
				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul class="color">
						<li><a href="<?php echo base_url();?>">Beranda</a></li>
						<li>Berita</li>
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
			<div class="row">
				<div class="style-1">

						<!-- Tabs Navigation -->
						<ul class="tabs-nav">
							<li class="<?php if ($ch==0) echo 'active'; else echo 'not-active';?>"><a href="<?php echo base_url() ?>blog">Semua Berita</a></li>
							
						</ul>

						<!-- Tabs Content -->
						<div class="tabs-container">
							<div class="tab-content" id="tab1b">

								<?php
									foreach ($posts as $post) :
										$tag = "";
										$tags= $post->tag;
										if ($tags!=""){
											$exp = explode(";", $tags);
											$_tag = array();
											foreach ($Qtag as $r) {
												$_tag[$r->tag_name] = $r->tag_slug;
											}
											
											for ($x=0; $x < (count($exp) - 1) ; $x++)
											{
												$slug = $_tag[$exp[$x]];
												$tag .= "<a href='".base_url()."blog/tag/{$slug}' >$exp[$x]</a>";
												if ($x < (count($exp) - 2)) $tag .=",";
											}
										}
										$content = substr($post->content,0,255);
										if (strlen($post->content)>255) $content .="...";
								?>


								<div class="blog-post">
				
									<!-- Img -->
									<a href="<?php echo base_url()."berita/read/{$post->title_slug}";?>" class="post-img">
										<?php if (!empty($post->picture)) :?>
										<img src="<?php echo base_url()."data/images/featured_image/{$post->picture}";?>" alt="">
										<?php endif;?>
																					</a>
									
									<!-- Content -->
									<div class="post-content">
										<h3><a href="<?php echo base_url()."berita/read/{$post->title_slug}";?>"><?php echo $post->title;?> </a></h3>

										<ul class="post-meta">
											<li><?php echo date('d M Y ',strtotime($post->date)).$post->time;?></li>
											<li><a href="#"><?php echo $post->category_name;?></a></li>
											
										</ul>

										<p>	<?php echo $content;?></p>

										<a href="<?php echo base_url()."berita/read/{$post->title_slug}";?>" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
									</div>

								</div>
								<!-- Blog Post / End -->

								<?php endforeach;?>

							</div>
						</div>
					</div>
				</div>


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

		                        $config['base_url'] = base_url(). 'berita';
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

		<!-- Blog Posts / End -->


		<!-- Widgets -->
		<div class="col-lg-3 col-md-4">
			<div class="sidebar right">

				<!-- Widget -->
				<div class="widget">
					<h3 class="margin-top-0 margin-bottom-25">Cari Berita</h3>
					<div class="search-blog-input">
					<form action="<?php echo base_url();?>berita" method='get'>
						<div class="input">
				
						<input type="text" name='s' value='<?php if (!empty($search)) echo $search;?>' placeholder="Masukan Judul Berita" />
						</div>
					</form>	
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- Widget / End -->


				<!-- Widget -->
				<div class="widget margin-top-40">
					<h3>Kategori</h3>
					
						<ul class="list-1">
								<?php
									foreach ($categories as $row) {
										echo"
										<li>
											<a href='".base_url()."berita/category/$row->category_slug'>$row->category_name</a>
										</li>";
									}
								?>
							</ul>
				
				</div>
				<!-- Widget / End -->





				<!-- Widget -->
				<div class="widget margin-top-40">

					<h3>Berita Teratas</h3>
					<ul class="widget-tabs">
						<?php
									foreach ($popular as $row) {
								echo "		
						
						<li>
							<div class='widget-content'>
									<div class='widget-thumb'>
									<a href='".base_url()."berita/read/{$row->title_slug}'><img src='".base_url()."data/images/featured_image/{$row->picture}' ></a>
								</div>
								
								<div class='widget-text'>
									<h5><a href='".base_url()."berita/read/{$row->title_slug}'>{$row->title}</a></h5>
									<span>".date('d M Y',strtotime($row->date))."</span>
								</div>
								<div class='clearfix'></div>
							</div>
						</li>";
					}
					?>
						
						

					</ul>

				</div>
				<!-- Widget / End-->


				<!-- Widget -->
				<div class="widget margin-top-40">
					<h3 class="margin-bottom-25">Sosial Media</h3>
					<ul class="social-icons rounded">
						<li><a class="facebook" href="<?php echo $p_facebook; ?>"><i class="icon-facebook"></i></a></li>
						<li><a class="twitter" href="<?php echo $p_twitter; ?>"><i class="icon-twitter"></i></a></li>
						<li><a class="instagram" href="<?php echo $p_facebook; ?>"><i class="icon-instagram"></i></a></li>
						<li><a class="youtube" href="<?php echo $p_youtube; ?>"><i class="icon-youtube"></i></a></li>
					</ul>

				</div>
				<!-- Widget / End-->

				<div class="clearfix"></div>
				<div class="margin-bottom-40"></div>
			</div>
		</div>
	</div>
	<!-- Sidebar / End -->


	</div>
</div>