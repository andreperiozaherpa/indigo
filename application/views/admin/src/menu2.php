<div class="sidebar-menu">
		
			
		<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="<?php echo base_url();?>admin">
					<img src="<?php echo base_url();?>data/logo/admin_panel.png" width="150" alt="" />
				</a>
			</div>
			
						<!-- logo collapse icon -->
						
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
									
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
			
		</header>
				
		
		
				
		
				
		<ul id="main-menu" class="">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
			<!-- Search Bar 
			<li id="search">
				<form method="get" action="">
					<input type="text" name="q" class="search-input" placeholder="Search something..."/>
					<button type="submit">
						<i class="entypo-search"></i>
					</button>
				</form>
			</li>
		-->
			<li id='dashboard'>
				<a href="<?php echo base_url();?>admin">
					<i class="entypo-gauge"></i>
					<span>Dashboard</span>
				</a>
			</li>
			
			<li id='post'>
				<a href="">
					<i class="entypo-newspaper"></i>
					<span>Post</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url();?>manage_post/add">
							<i class="entypo-plus"></i>
							<span>New post</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_post">
							<i class="entypo-book-open"></i>
							<span>All posts</span>
						</a>
					</li>
				</ul>
			</li>
			
			<li id='category'>
				<a href="">
					<i class="entypo-flag"></i>
					<span>Category</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url();?>manage_category/add">
							<i class="entypo-plus-circled"></i>
							<span>New category</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_category">
							<i class="entypo-book"></i>
							<span>All categories</span>
						</a>
					</li>
				</ul>
			</li>
			
			<li id='tag'>
				<a href="">
					<i class="entypo-tag"></i>
					<span>Tag</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url();?>manage_tag/add">
							<i class="entypo-plus-squared"></i>
							<span>New tag</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_tag">
							<i class="entypo-docs"></i>
							<span>All tags</span>
						</a>
					</li>
				</ul>
			</li>

			<li id='media'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>Media</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url();?>manage_media/gallery">
							<i class="entypo-picture"></i>
							<span>Gallery</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_media/img_header">
							<i class="entypo-docs"></i>
							<span>Header</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_media/banner">
							<i class="entypo-popup"></i>
							<span>Banner</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_media/download">
							<i class="entypo-download"></i>
							<span>Download</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_video">
							<i class="entypo-download"></i>
							<span>video</span>
						</a>
					</li>
				</ul>
			</li>

			<li id='public'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>Departemen</span>
				</a>
				<ul>
					
					<li>
						<a href="<?php echo base_url();?>manage_departemen">
							<i class="entypo-picture"></i>
							<span>Departemen </span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_jabatan">
							<i class="entypo-picture"></i>
							<span>Jabatan</span>
						</a>
					</li>
					
					
				</ul>
			</li>

			<li id='public'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>Services</span>
				</a>
				<ul>
					
					<li>
						<a href="<?php echo base_url();?>manage_services">
							<i class="entypo-picture"></i>
							<span>services </span>
						</a>
					</li>	

					<li>
						<a href="<?php echo base_url();?>manage_sub_services">
							<i class="entypo-picture"></i>
							<span>Sub Services </span>
						</a>
					</li>	

					
				</ul>
			</li>

			<li id='public'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>Testimoni</span>
				</a>
				<ul>
					
					<li>
						<a href="<?php echo base_url();?>manage_testimoni">
							<i class="entypo-picture"></i>
							<span>Testimoni </span>
						</a>
					</li>				
					
				</ul>
			</li>


			<li id='public'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>Partner</span>
				</a>
				<ul>
					
					<li>
						<a href="<?php echo base_url();?>manage_partner">
							<i class="entypo-picture"></i>
							<span>Partner </span>
						</a>
					</li>				
					
				</ul>
			</li>

			<li id='public'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>Portofolio</span>
				</a>
				<ul>
					
					<li>
						<a href="<?php echo base_url();?>manage_portofolio">
							<i class="entypo-picture"></i>
							<span>Portofolio </span>
						</a>
					</li>				
					
				</ul>
			</li>


			<li id='public'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>client</span>
				</a>
				<ul>
					
					<li>
						<a href="<?php echo base_url();?>manage_client">
							<i class="entypo-picture"></i>
							<span>Client </span>
						</a>
					</li>				
					
				</ul>
			</li>



			
			
			<li id='diklat'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>Diklat</span>
				</a>
				<ul>
					
					<li>
						<a href="<?php echo base_url();?>kategori_diklat">
							<i class="entypo-picture"></i>
							<span>Kategori Diklat </span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_diklat">
							<i class="entypo-picture"></i>
							<span>Diklat</span>
						</a>
					</li>
					
					
				</ul>
			</li>
			
			
			
			<li id='potensi'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>Potensi </span>
				</a>
				<ul>
					
					<li>
						<a href="<?php echo base_url();?>manage_category_potensi">
							<i class="entypo-picture"></i>
							<span>Kategori Potensi </span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_potensi">
							<i class="entypo-picture"></i>
							<span>Isi Potensi</span>
						</a>
					</li>
					
					
				</ul>
			</li>
			

			<li id='public'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>Standar Operasional Prosedur</span>
				</a>
				<ul>
					
					
					<li>
						<a href="<?php echo base_url();?>manage_sop">
							<i class="entypo-picture"></i>
							<span>Semua SOP</span>
						</a>
					</li>
					
					
				</ul>
			</li>



			<li id='public'>
				<a href="">
					<i class="entypo-camera"></i>
					<span>Publikasi</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url();?>manage_category_public">
							<i class="entypo-picture"></i>
							<span>Kategori Publikasi</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_public">
							<i class="entypo-docs"></i>
							<span>Publikasi </span>
						</a>
					</li>
					
				</ul>
			</li>
			<li id='agenda'>
				<a href="">
					<i class="entypo-book"></i>
					<span>Agenda</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url();?>manage_agenda/add">
							<i class="entypo-plus-squared"></i>
							<span>Add Agenda</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_agenda">
							<i class="entypo-book"></i>
							<span>All Agenda</span>
						</a>
					</li>
				</ul>
			</li>


			<li id='menu'>
				<a href="">
					<i class="entypo-book"></i>
					<span>Menu</span>
				</a>
				<ul>
					
					<li>
						<a href="<?php echo base_url();?>manage_menu">
							<i class="entypo-book"></i>
							<span>Menu</span>
						</a>
					</li>
				</ul>
			</li>


			<li id='company_profile'>
				<a href="">
					<i class="entypo-flag"></i>
					<span>Company profile</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url();?>manage_company_profile/identity">
							<i class="entypo-right-open"></i>
							<span>Identity</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_company_profile/sambutan">
							<i class="entypo-right-open"></i>
							<span>Sambutan</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_company_profile/visi_misi">
							<i class="entypo-right-open"></i>
							<span>Visi misi</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_company_profile/program_kerja">
							<i class="entypo-right-open"></i>
							<span>Program Kerja</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_company_profile/struktur_organisasi">
							<i class="entypo-right-open"></i>
							<span>Struktur Organisasi</span>
						</a>
					</li>
					
				</ul>
			</li>
			<?php 
			if ($user_level=="Administrator") { ?>
			<li id='user'>
				<a href="">
					<i class="entypo-user"></i>
					<span>User</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url();?>manage_user/add">
							<i class="entypo-user-add"></i>
							<span>Add user</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>manage_user">
							<i class="entypo-users"></i>
							<span>All users</span>
						</a>
					</li>
				</ul>
			</li>
			
			<?php } ?>
	</div>	