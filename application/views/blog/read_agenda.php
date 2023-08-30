<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
	<?php $this->load->view('blog/src/header');?>
	<style type="text/css">
	.marginleft2px{
		margin-left: 2px;
	}
</style>
</head>

<body>
	<div id="container">
		
		<!-- Start Header -->
		<header class="clearfix">
			<?php $this->load->view('blog/src/top_nav');?>
		</header>

		<!-- Start Page Banner -->
    <div class="page-banner">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="putih">Detail Agenda</h2>
           
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href=" <?php echo base_url().'home'; ?> ">Home</a></li>
              <li><a href=" <?php echo base_url().'agenda'; ?> ">Agenda</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End Page Banner -->

		<!-- Start Content -->
    <div id="content">
      <div class="container">
        <div class="row blog-page">

          <!-- Start Blog Posts -->
          <div class="col-md-12 blog-box">
    <h3><?php echo"$tema"; ?> </h3>
       <br>
       <table class='table table-striped   '>
	  
		<tbody><tr><td>Tema </td><td>:</td><td><?php echo"$tema"; ?></td></tr>
			<tr><td>Tempat</td><td>:</td><td><?php echo"$tempat"; ?></td></tr>
			<tr><td>Tanggal Mulai</td><td>:</td><td><?php echo"$tgl_mulai"; ?></td></tr>
			<tr><td>Tanggal Selesai</td><td>:</td><td><?php echo"$tgl_selesai"; ?></td></tr>
			<tr><td>Jam</td><td>:</td><td><?php echo"$jam"; ?></td></tr>     
			<tr><td>isi</td><td>:</td><td><?php echo"$isi_agenda"; ?></td></tr>     
		</tbody></table>
			 

      </div>
    </div>
	</div>
	</div>
    <!-- End Content -->



		<!-- End Content -->
		<footer>
			<?php $this->load->view('blog/src/footer');?>
		</footer>
	</div>
</body>
</html>