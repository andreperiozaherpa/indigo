<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse slimscrollsidebar">
		<div class="user-profile">
			<div class="dropdown user-pro-body">
				<br>
				<br>
				<div>

					<img src="<?php echo $user_picture = (!empty($this->session->userdata('username'))) ? base_url()."data/user_picture/$user_picture" : $user_picture;?>" alt="user-img" class="img-circle">
				</div>
				<a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $full_name

				?> <span class="caret"></span></a>
				<ul class="dropdown-menu animated flipInY">
					<li><a href="<?php echo base_url();?>logout"><i class="fa fa-power-off"></i> Keluar</a></li>
				</ul>
			</div>
		</div>
		<hr>
		<ul class="nav" id="side-menu">
			<li class="sidebar-search hidden-sm hidden-md hidden-lg">
				<!-- input-group -->
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
						<button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
					</span>
				</div>
				<!-- /input-group -->
			</li>

			<li><a href="<?php echo base_url();?>admin" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu">Dashboard</span></a></li>

			<?php 
			$user_group_menu = explode(";", $this->session->userdata('user_group_menu'));
			$user_privileges = explode(";", $this->session->userdata('user_privileges'));
			?>

			<?php if (in_array('unit_kerja', $user_privileges) && $user_level=='Administrator'): ?>
				<li><a href="<?php echo base_url();?>ref_unit_kerja" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="0"></i> <span class="hide-menu">Ref.Unit Kerja</span></a></li>
                <li><a href="<?php echo base_url();?>berkas_unit_kerja" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="0"></i> <span class="hide-menu">Berkas Tahunan</span></a></li>
            <?php endif ?> 

                <!--
			<?php if (in_array('kategori_berkas', $user_privileges)): ?>
				<li><a href="<?php echo base_url();?>ref_kategori_berkas" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="0"></i> <span class="hide-menu">Ref. Kategori Berkas</span></a></li>
			<?php endif ?> 

        -->


<!--                     <?php if (in_array('notice', $user_privileges)): ?>
                    <li><a href="<?php echo base_url();?>berkas" class="waves-effect"> <i class="icon-note linea-basic fa-fw"></i> <span class="hide-menu">Data dan Berkas</span></a></li>
                <?php endif ?>  -->

                    <!--
                <?php if (in_array('berkas', $user_privileges)): ?>
                	<li> <a href="#" class="waves-effect"><i class="icon-note fa-fw"></i> <span class="hide-menu">Data & Berkas<span class="fa arrow"></span></span></a>
                		<ul class="nav nav-second-level">
                			<li> <a href="<?php echo base_url();?>berkas">Kelola Data & Berkas</a> </li>
                			<li> <a href="<?php echo base_url();?>quick_view">Quick View</a> </li>
                		</ul>
                	</li>
                <?php endif ?> 

            -->

            <?php if (in_array('mn_front_end', $user_group_menu)): ?>
               <li>
                  <a href="#" class="waves-effect"><i data-icon="q" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Front End Media<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                     <?php if (in_array('menu', $user_privileges)): ?>
                        <li> <a href="<?php echo base_url();?>manage_menu">Menu</a></li>
                    <?php endif ?>
                    <?php if (in_array('header', $user_privileges)): ?>
                        <li> <a href="<?php echo base_url();?>manage_media/img_header">Header</a></li>
                    <?php endif ?>
                    <?php if (in_array('banner', $user_privileges)): ?>
                        <li> <a href="<?php echo base_url();?>manage_media/banner">Banner</a></li>
                    <?php endif ?>
                    <?php if (in_array('video', $user_privileges)): ?>
                        <li> <a href="<?php echo base_url();?>manage_video">Video</a></li>
                    <?php endif ?>
                    <?php if (in_array('video_category', $user_privileges)): ?>
                        <li> <a href="<?php echo base_url();?>manage_category_video">Kategori Video</a></li> 
                    <?php endif ?>
                </ul>
            </li>
        <?php endif ?>


        <?php if (in_array('mn_front_end', $user_group_menu)): ?>
           <li>
              <a href="#" class="waves-effect"><i data-icon="q" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Ref. Kepegawaian<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level">
                 <?php if (in_array('header', $user_privileges)): ?>

                    <li><a href="<?php echo base_url(). "ref_jabatan" ;?>">Jabatan</a></li>
              <!--       <li><a href="<?php echo base_url(). "ref_agama" ;?>">Agama</a></li>
                    <li><a href="<?php echo base_url(). "ref_statusmenikah" ;?>">Status Pernikahan</a></li>
                    <li><a href="<?php echo base_url(). "ref_pendidikan" ;?>">Jenjang Pendidikan</a></li>
                    <li><a href="<?php echo base_url(). "ref_tempatpendidikan" ;?>">Sekolah</a></li>
                    <li><a href="<?php echo base_url(). "ref_jurusan" ;?>">Jurusan</a></li>
                    <li><a href="<?php echo base_url(). "ref_gelarbelakang" ;?>">Gelar Belakang</a></li>
                    <li><a href="<?php echo base_url(). "ref_gelardepan" ;?>">Gelar Depan</a></li>
                    <li><a href="<?php echo base_url(). "ref_bahasa" ;?>">Bahasa Lokal</a></li>
                    <li><a href="<?php echo base_url(). "ref_bahasa_asing" ;?>">Bahasa Asing</a></li>
                    <li><a href="<?php echo base_url(). "ref_diklat" ;?>">Jenis Diklat</a></li>
                    <li><a href="<?php echo base_url(). "ref_seminar" ;?>">Jenis Seminar</a></li>
                    <li><a href="<?php echo base_url(). "ref_kursus" ;?>">Jenis Kursus</a> <li>
                       <li><a href="<?php echo base_url(). "ref_cuti" ;?>">Jenis Cuti</a> <li>
                          <li><a href="<?php echo base_url(). "ref_penghargaan" ;?>">Jenis Penghargaan</a> <li>
                             <li><a href="<?php echo base_url(). "ref_jenispenugasan" ;?>">Jenis Penugasan</a> <li>
                                <li><a href="<?php echo base_url(). "ref_hukumandisiplin" ;?>">Jenis Hukuman Disiplin</a> <li> -->

                                <?php endif ?>

                            </ul>
                        </li>
                    <?php endif ?>

                    

                    <?php if (in_array('unit_kerja', $user_privileges) && $user_level=='Administrator'): ?>
                      <li><a href="<?php echo base_url();?>master_pegawai" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="0"></i> <span class="hide-menu">Master Pegawai</span></a></li>
                  <?php endif ?> 
 <!--
                					<?php if (in_array('mn_front_end', $user_group_menu)): ?>
                						<li>
                							<a href="#" class="waves-effect"><i data-icon="r" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Absensi<span class="fa arrow"></span></a>
                							<ul class="nav nav-second-level">
                								<?php if (in_array('header', $user_privileges)): ?>
                									<li><a href='<?php echo base_url();?>ref_hari_libur'>Ref. Hari Libur</a></li>
                									<li><a href='<?php echo base_url();?>ref_absensi'>Ref. Absensi</a></li>
                									<li><a href='<?php echo base_url();?>pengajuan_absensi'>Pengajuan Absensi</a></li>
                									<li><a href='<?php echo base_url();?>laporan_absensi'>Laporan Absensi</a></li>

                								<?php endif ?>

                							</ul>
                						</li>
                					<?php endif ?>

                                -->


                                <?php if ($user_level=='Administrator' OR ($user_level=='User' AND $this->session->userdata('unit_kerja_id') > 0)): ?>
                                  <li>
                                     <a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Rencana Strategis<span class="fa arrow"></span></a>
                                     <ul class="nav nav-second-level">
                                        <?php /*if (in_array('header', $user_privileges)):*/ ?>
                                        <li><a href='<?php echo base_url();?>ref_visi_misi'>Visi Misi </a></li> 
                                        <li><a href='<?php echo base_url();?>sasaran_strategis'>Sasaran Strategis </a></li> 
                                        <li><a href='<?php echo base_url();?>sasaran_program'>Sasaran Program </a></li>
                                        <li><a href='<?php echo base_url();?>sasaran_kegiatan'>Sasaran Kegiatan </a></li> 
                                        <?php /*endif*/ ?>

                                    </ul>
                                </li>
                            <?php endif ?>


                            <?php if (in_array('mn_front_end', $user_group_menu)): ?>
                              <li>
                                 <a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Rencana Kerja Tahunan<span class="fa arrow"></span></a>
                                 <ul class="nav nav-second-level">
                                    <?php if (in_array('header', $user_privileges)): ?>
                                        <li><a href='<?php echo base_url();?>ref_rka'>Rencana Kerja Anggaran</a></li>
                                        <li><a href='<?php echo base_url();?>rencana_kerja_tahunan'>Rencana Kerja Tahunan</a></li>
                                        <li><a href='<?php echo base_url();?>perjanjian_kinerja'>Perjanjian Kinerja</a></li>

                                    <?php endif ?>

                                </ul>
                            </li>
                        <?php endif ?>

                        <?php if (in_array('mn_front_end', $user_group_menu)): ?>
                            <li>
                                <a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Capaian Kinerja<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if (in_array('header', $user_privileges)): ?>
                                        <li><a href='<?php echo base_url();?>data_capaian'>Data Capaian</a></li>
                                        

                                    <?php endif ?>

                                </ul>
                            </li>
                        <?php endif ?>

                        <?php if (in_array('mn_front_end', $user_group_menu)): ?>
                            <li>
                                <a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Evaluasi Capaian<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <?php if (in_array('header', $user_privileges)): ?>
                                        <li><a href='<?php echo base_url();?>evaluasi_capaian'>Evaluasi Capaian</a></li>
                                        

                                    <?php endif ?>

                                </ul>
                            </li>
                        <?php endif ?>


                                        <!--

                					<?php if (in_array('mn_front_end', $user_group_menu)): ?>
                						<li>
                							<a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Realisasi Renstra<span class="fa arrow"></span></a>
                							<ul class="nav nav-second-level">
                								<?php if (in_array('header', $user_privileges)): ?>
                									<li><a href='<?php echo base_url();?>realisasi_sr'>Sasaran Strategis</a></li>
                									<li><a href='<?php echo base_url();?>realisasi_sp'>Sasaran Program</a></li>
                									<li><a href='<?php echo base_url();?>realisasi_sk'>Sasaran Kegiatan</a></li>
               									<?php endif ?>

                							</ul>
                						</li>
                					<?php endif ?>


                					<?php if (in_array('mn_front_end', $user_group_menu)): ?>
                						<li>
                							<a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Realisasi RKT<span class="fa arrow"></span></a>
                							<ul class="nav nav-second-level">
                								<?php if (in_array('header', $user_privileges)): ?>
                									<li><a href='<?php echo base_url();?>realisasi_rkt'>Realisasi RKT</a></li>
               									<?php endif ?>
                							</ul>
                						</li>
                					<?php endif ?>





                					<?php if (in_array('mn_front_end', $user_group_menu)): ?>
                						<li>
                							<a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Kegiatan Unit Kerja<span class="fa arrow"></span></a>
                							<ul class="nav nav-second-level">
                								<?php if (in_array('header', $user_privileges)): ?>
                									<!-- <li><a href='<?php echo base_url();?>ref_kode_kegiatan'>Rencana Kerja </a></li>
                									<li><a href='<?php echo base_url();?>kegiatan'>Kegiatan Unit Kerja</a></li>
                									<li><a href='<?php echo base_url();?>realisasi_kegiatan'>Realisasi Kegiatan</a></li>


                								<?php endif ?>

                							</ul>
                						</li>
                					<?php endif ?>



                					<?php if (in_array('mn_front_end', $user_group_menu)): ?>
                						<li>
                							<a href="#" class="waves-effect"><i data-icon="Q" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Kegiatan Personal<span class="fa arrow"></span></a>
                							<ul class="nav nav-second-level">
                								<?php if (in_array('header', $user_privileges)): ?>
                									<li><a href='<?php echo base_url();?>ref_pekerjaan'>Kategori Pekerjaan</a></li>
                									<li><a href='<?php echo base_url();?>target_pekerjaan'>Target Pekerjaan</a></li>
                									<li><a href='<?php echo base_url();?>realisasi_pekerjaan'>Realisasi Pekerjaan</a></li>

                								<?php endif ?>

                							</ul>
                						</li>
                					<?php endif ?>


                					<?php if (in_array('mn_front_end', $user_group_menu)): ?>
                						<li>
                							<a href="#" class="waves-effect"><i data-icon="&#xe020;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Verifikasi Pekerjaan<span class="fa arrow"></span></a>
                							<ul class="nav nav-second-level">
                								<?php if (in_array('header', $user_privileges)): ?>
                									<li><a href='<?php echo base_url();?>verifikasi_pekerjaan'>Daftar Verifikasi</a></li>

                								<?php endif ?>

                							</ul>
                						</li>
                					<?php endif ?>

                					<?php if (in_array('unit_kerja', $user_privileges) && $user_level=='Administrator'): ?>
                						<li><a href="<?php echo base_url();?>penilaian_kinerja" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon=";"></i> <span class="hide-menu">Penilaian Kinerja</span></a></li>
                					<?php endif ?> 


                					<?php if (in_array('mn_front_end', $user_group_menu)): ?>
                						<li>
                							<a href="#" class="waves-effect"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Laporan Kinerja<span class="fa arrow"></span></a>
                							<ul class="nav nav-second-level">
                								<?php if (in_array('header', $user_privileges)): ?>
                									<li><a href='<?php echo base_url();?>kinerja_lembaga'>Kinerja Lembaga</a></li>
                									<li><a href='<?php echo base_url();?>kinerja_pegawai'>Kinerja Pegawai</a></li>	
                								<?php endif ?>

                							</ul>
                						</li>
                					<?php endif ?>




                					<?php if (in_array('mn_blog', $user_group_menu)): ?>
                						<li>
                							<a href="#" class="waves-effect"><i data-icon="2" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Berita<span class="fa arrow"></span></a>
                							<ul class="nav nav-second-level">
                								<?php if (in_array('post', $user_privileges)): ?>
                									<li> <a href="<?php echo base_url();?>manage_post">Berita </a></li>
                								<?php endif ?>
                								<?php if (in_array('blog_category', $user_privileges)): ?>
                									<li> <a href="<?php echo base_url();?>manage_category/">Kategori</a></li> 
                								<?php endif ?>
                							</ul>
                						</li>
                					<?php endif ?>

                                -->


                                <?php if (in_array('mn_company', $user_group_menu) || $this->session->userdata('user_level') == 0): ?>
                                  <li>
                                     <a href="#" class="waves-effect"><i data-icon="K" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Profil Lembaga<span class="fa arrow"></span></a>
                                     <ul class="nav nav-second-level">
                                        <?php if (in_array('company', $user_privileges) || $this->session->userdata('user_level') == 0): ?>
                                           <li> <a href="<?php echo base_url();?>manage_company_profile/identity">Identitas</a></li>
                                       <?php endif ?>

                                   </ul>
                               </li>
                           <?php endif ?>

                           <?php if (in_array('user', $user_privileges)): ?>
                              <li><a href="<?php echo base_url();?>manage_user" class="waves-effect"> <i class="icon-user linea-basic fa-fw"></i> <span class="hide-menu">Pengguna</span></a></li>
                          <?php endif ?> 

                          <li><a href="<?php echo base_url();?>logout" class="waves-effect"> <i class="icon-logout linea-basic fa-fw"></i> <span class="hide-menu">Keluar</span></a></li>

                      </ul>
                  </div>
              </div>