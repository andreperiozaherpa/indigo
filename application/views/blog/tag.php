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
<div id="titlebar"  style="background: url('data/images/bg_hello.png') #29333e fixed;">
	 <div class="container" style="margin-top:10px;">
		<div class="row">
			<div class="col-md-12">

				<h2 class="putih">Blog</h2><span class="color">Latest News</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul class="color">
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<li>Blog</li>
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
									<a href="<?php echo base_url()."blog/read/{$post->title_slug}";?>" class="post-img">
										<?php if (!empty($post->picture)) :?>
										<img src="<?php echo base_url()."data/images/featured_image/{$post->picture}";?>" alt="">
										<?php endif;?>
																					</a>
									
									<!-- Content -->
									<div class="post-content">
										<h3><a href="pages-blog-post.html"><?php echo $post->title;?> </a></h3>

										<ul class="post-meta">
											<li><?php echo date('d M Y ',strtotime($post->date)).$post->time;?></li>
											<li><a href="#"><?php echo $post->category_name;?></a></li>
											
										</ul>

										<p>	<?php echo $content;?></p>

										<a href="pages-blog-post.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
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

		                        $config['base_url'] = base_url(). 'blog';
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
					<h3 class="margin-top-0 margin-bottom-25">Search Blog</h3>
					<div class="search-blog-input">
					<form action="<?php echo base_url();?>blog" method='get'>
						<div class="input">
				
						<input type="text" name='s' value='<?php if (!empty($search)) echo $search;?>' placeholder="Type and hit enter" />
						</div>
					</form>	
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- Widget / End -->


				<!-- Widget -->
				<div class="widget margin-top-40">
					<h3>Got any questions?</h3>
					<div class="info-box margin-bottom-10">
						<p>Having any questions? Feel free to ask!</p>
						<a href="<?php echo base_url().'welcome' ;?>" class="button fullwidth margin-top-20"><i class="fa fa-envelope-o"></i> Drop Us a Line</a>
					</div>
				</div>
				<!-- Widget / End -->

				<!-- Widget -->
				<div class="widget margin-top-40">
					<h3>Categories</h3>
					
						<ul class="list-1">
								<?php
									foreach ($categories as $row) {
										echo"
										<li>
											<a href='".base_url()."blog/category/$row->category_slug'>$row->category_name</a>
										</li>";
									}
								?>
							</ul>
				
				</div>
				<!-- Widget / End -->


				<!-- Widget -->
				<div class="widget margin-top-40">
					<h3>Tags</h3>
					
						<?php
									foreach ($tags_ as $row) {
										echo "<a class='button' href='".base_url()."blog/tag/$row->tag_slug'>$row->tag_name</a> ";
									}
								?>
				
				</div>
				<!-- Widget / End -->



				<!-- Widget -->
				<div class="widget margin-top-40">

					<h3>Popular Posts</h3>
					<ul class="widget-tabs">
						<?php
									foreach ($popular as $row) {
								echo "		
						
						<li>
							<div class='widget-content'>
									<div class='widget-thumb'>
									<a href='".base_url()."blog/read/{$row->title_slug}'><img src='".base_url()."data/images/featured_image/{$row->picture}' ></a>
								</div>
								
								<div class='widget-text'>
									<h5><a href='".base_url()."blog/read/{$row->title_slug}'>{$row->title}</a></h5>
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
					<h3 class="margin-bottom-25">Social</h3>
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