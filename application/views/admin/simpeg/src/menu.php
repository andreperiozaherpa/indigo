  <!-- BEGIN: Main Menu-->
  <?php
  if(empty($active_menu))
  {
  	$active_menu = "dashboard";
  }
  ?>
  <div class="horizontal-menu-wrapper">
  	<div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
  		<div class="navbar-header">
  			<ul class="nav navbar-nav flex-row">
  				<li class="nav-item mr-auto"><a class="navbar-brand" href="<?=base_url();?>admin">
  					<div class="brand-logo"></div>
  					<h2 class="brand-text mb-0">SIMPEG</h2>
  				</a></li>
  				<li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
  			</ul>
  		</div>
  		<!-- Horizontal menu content-->
  		<div class="navbar-container main-menu-content" data-menu="menu-container">
  			<!-- include <?=base_url();?>asset/kube/includes/mixins-->
  			<ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
  				<li class="nav-item <?=($active_menu=="dashboard") ? "active" : "";?>" ><a class="nav-link" href="<?php echo base_url();?>admin" data-toggle=""><i class="feather icon-home"></i><span data-i18n="Dashboard">Dashboard</span></a></li>
  				<li class="dropdown nav-item <?=($active_menu=="ref") ? "active" : "";?>" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-package"></i><span data-i18n="Apps">Referensi</span></a>
  					<ul class="dropdown-menu">
  						<li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown" data-i18n="Ecommerce"><i class="feather icon-copy"></i>Master</a>

  							<ul class="dropdown-menu">
                  <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>#" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>SKPD</a>
                  </li>
  								<li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>#" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Unit Kerja</a>
  								</li>
  								<li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_eselon" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Eselon</a>
  								</li>
  								<li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_golongan" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Golongan</a>
  								</li>
  								<li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_jabatan" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Jabatan</a>
  								</li>

                  <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_kenaikanpangkat" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Kenaikan Pangkat</a>
                  </li>


                  <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_jenispegawai" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Jenis Pegawai</a>
                  </li>
                  <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_jenispengadaan" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Jenis Pengadaan</a>
                  </li>
                  <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_kpkn" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>KPKN</a>
                  </li>
                  <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_instansi" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Instansi</a>
                  </li>
                  <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_satuankerja" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Satuan Kerja</a>
                  </li>

                </ul>
              </li>

              <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown" data-i18n="Ecommerce"><i class="feather icon-copy"></i>Biodata</a>
               <ul class="dropdown-menu">
                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_agama" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Agama</a>
                </li>
                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_kawin" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Kawin</a>
                </li>
                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_tingkatpendidikan" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Tingkat Pendidikan</a>
                </li>
              

                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_pendidikan" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Pendidikan</a>
                </li>

                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_latihan" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Latihan</a>
                </li>
                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_kompetensi" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Kompetensi</a>
                </li>

                <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_kedudukan" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Kedudukan</a>
                </li>

              </ul>
            </li>

            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown" data-i18n="Ecommerce"><i class="feather icon-copy"></i>Riwayat</a>
             <ul class="dropdown-menu">
              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_jeniskursus" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Jenis Kursus</a>
              </li>

              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_profesi" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Profesi</a>
              </li>

              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_taspen" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Taspen</a>
              </li>






              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_cuti" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Cuti</a>
              </li>

              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_jenishukuman" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Jenis Hukuman</a>
              </li>

              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_penghargaan" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Penghargaan</a>
              </li>


              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_kepanitiaan" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>kepanitiaan</a>
              </li>

              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_pensiun" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Pensiun</a>
              </li>
              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>ref_pemberhentian" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Pemberhentian</a>
              </li>

            </ul>
          </li>
        </ul>
      </li>


      <li class="nav-item <?=($active_menu=="master_pegawai") ? "active" : "";?>" ><a class="nav-link" href="<?php echo base_url();?>master_pegawai" data-toggle=""><i class="feather icon-user"></i><span data-i18n="Dashboard">Master Pegawai</span></a></li>


  				<!-- <li class="dropdown nav-item " data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-navigation"></i><span data-i18n="UI Elements">Laporan</span></a>
  					<ul class="dropdown-menu">

  						 <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>#" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Laporan 1</a>
                  </li>
                  <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>#" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Laporan 2</a>
                  </li>
  					</ul>
  				</li> -->

          <li class="dropdown nav-item " data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-sliders"></i><span data-i18n="UI Elements">Tools</span></a>
            <ul class="dropdown-menu">


              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>#" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Sinkronsisasi</a>
              </li>
              <li data-menu=""><a class="dropdown-item" href="<?php echo base_url();?>#" data-toggle="dropdown" data-i18n="Email"><i class="feather icon-disc"></i>Backup / Restore</a>
              </li>

            </li>
          </ul>
        </li>


        <li class="nav-item " ><a class="nav-link" href="<?php echo base_url();?>manage_user" data-toggle=""><i class="feather icon-slack"></i><span data-i18n="Dashboard">Pengguna</span></a></li>


      </ul>
    </div>
  </div>
</div>
<!-- END: Main Menu-->
