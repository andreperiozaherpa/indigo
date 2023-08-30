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


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1281033678674520";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
						<li><a href="<?php echo base_url();?>berita">Berita</a></li>
						<li class="active">Detail</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>
<?php
	$tag = "";
?>

<!-- Content
================================================== -->
<div class="container">

	<!-- Blog Posts -->
	<div class="blog-page">
	<div class="row">


		<!-- Post Content -->
		<div class="col-lg-9 col-md-8 padding-right-30">


			<!-- Blog Post -->
			<div class="blog-post single-post">
				
				<?php if (!empty($picture)) :?>
				<!-- Img -->
				<img class="post-img" src='<?php echo base_url()."data/images/featured_image/{$picture}";?>' alt="">
				<?php endif;?>

				
				<!-- Content -->
				<div class="post-content">

					<h3><?php echo $title;?></h3>

					<ul class="post-meta">
						<li><?php echo date('d M Y ',strtotime($date)).$time;?></li>
						<li><a href='<?php echo base_url()."berita/category/{$category_slug}";?>'><?php echo $category_name;?></a></li>
					</ul>

					<p><?php echo $content;?></p>

					<!-- Share Buttons -->
					<ul class="share-buttons margin-top-40 margin-bottom-0">
						<li><a class="fb-share" href="#!" onclick="window.open('<?php echo base_url('share/facebook?link=').current_url() ?>','<?php echo $title;?>','width=600,height=400')"><i class="fa fa-facebook"></i> Share</a></li>
						<li><a class="twitter-share" href="#!" onclick="window.open('<?php echo base_url('share/twitter?link=').current_url().'&title='.$title.'&hashtags='.$this->uri->segment(3) ?>','<?php echo $title;?>','width=600,height=400')"><i class="fa fa-twitter"></i> Tweet</a></li>
						<li><a class="gplus-share" href="#!" onclick="window.open('<?php echo base_url('share/gplus?link=').current_url() ?>','<?php echo $title;?>','width=600,height=400')"><i class="fa fa-google-plus"></i> Share</a></li>
						<li><a class="pinterest-share" href="#!" onclick="window.open('<?php echo base_url('share/pinterest?link=').current_url() ?>','<?php echo $title;?>','width=600,height=400')"><i class="fa fa-pinterest-p"></i> Pin</a></li>
					</ul>
					<div class="clearfix"></div>

				</div>
			</div>
			<!-- Blog Post / End -->




		


			<!-- Related Posts -->
			<div class="clearfix"></div>
			
			<div class="row">
				

			</div>
			<!-- Related Posts / End -->


			<div class="margin-top-50"></div>

			<!-- Reviews -->
			<section class="comments margin-bottom-35">
			<h4 class="headline">Facebook Comments</h4>
				<div class="fb-comments" data-href="<?php echo current_url() ?>" data-numposts="2" data-width="100%"></div>
				<!--ul>
					<li>
						<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
						<div class="comment-content"><div class="arrow-comment"></div>
							<div class="comment-by">Kathy Brown<span class="date">22 August 2017</span>
								<a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
							</div>
							<p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>
						</div>

						<ul>
							<li>
								<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
								<div class="comment-content"><div class="arrow-comment"></div>
									<div class="comment-by">Tom Smith<span class="date">22 August 2017</span>
										<a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
									</div>
									<p>Rrhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque.</p>
								</div>
							</li>
							<li>
								<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
								<div class="comment-content"><div class="arrow-comment"></div>
									<div class="comment-by">Kathy Brown<span class="date">20 August 2017</span>
										<a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
									</div>
									<p>Nam posuere tristique sem, eu ultricies tortor.</p>
								</div>

								<ul>
									<li>
										<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
										<div class="comment-content"><div class="arrow-comment"></div>
											<div class="comment-by">John Doe<span class="date">18 August 2017</span>
												<a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
											</div>
											<p>Great template!</p>
										</div>
									</li>
								</ul>

							</li>
						</ul>

					</li>

					<li>
						<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /> </div>
						<div class="comment-content"><div class="arrow-comment"></div>
							<div class="comment-by">John Doe<span class="date">18 August 2017</span>
								<a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
							</div>
							<p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
						</div>

					</li>
				 </ul-->

			</section>
			<div class="clearfix"></div>

		</div>
		<!-- Content / End -->



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
