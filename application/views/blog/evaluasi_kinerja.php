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

<section class="banner_area" style="min-height: unset;">
			<div class="banner_inner d-flex align-items-center">
				<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background="" style="transform: translateY(-37.7529px);"></div>
				<div class="container">
					<div class="banner_content text-left">
				<span style="color:#FFFFFF;display:block;margin-bottom:10px;font-size:15px">E-SAKIP Kabupaten Sumedang</span>
				<span style="color:#FFFFFF;font-size:16px;background-color:#6441EB;padding:5px 15px;border-radius:30px;margin-bottom:300px">MAUTI (Mari Unjuk Kinerja untuk Sumedang Simpati)</span>
				<!-- <div class="page_link">
							<a href="<?php echo base_url() ?>home">Home</a>
							<a href="<?php echo base_url() ?>perencanaan_kinerja">Perencaan Kinerja</a>
						</div> -->
				<h2 style="margin-top:5px">Evaluasi Kinerja, Tarik Siiiisss !!</h2>
					</div>
				</div>
			</div>
		</section>




<section class="">

<!-- Content
	================================================== -->
	<div class="container">
		<div class="add-listing-section margin-top-45">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3><i class="sl sl-icon-book-open"></i> Evaluasi Kinerja <?=$tahun_?> <div class="pull-right"><select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class=""><?php
        $current_year = date("Y");
        $array_year = array();
        foreach($tahun as $r){
          if ($r->tahun_berkas>0) {
            array_push($array_year, $r->tahun_berkas);
          }
        }
        rsort($array_year);
        $min_year = ($array_year[0]<$current_year-5) ? $array_year[0] : $current_year-5;
        $max_year = ($array_year[count($array_year)-1]>$current_year+5) ? $array_year[count($array_year)-1] : $current_year+5;
        for ($i=$min_year; $i < $max_year; $i++) {
          array_push($array_year, $i);
        }
        $array_year = array_unique($array_year);
        rsort($array_year);
        foreach ($array_year as $year) {
        	$selected = "";
        	if ($tahun_ == $year) {
        		$selected = "selected";
        	}
          echo'<option value="'.base_url("evaluasi_kinerja/index/".$year).'" '.$selected.'>'.$year.'</option>';
        }
        ?></select></div></h3>
			</div>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table style="margin-top: 20px" class="basic-table" >
								<thead>
									<tr>
										<th>NO</th>
										<th>SKPD</th>
										<th>Kategori <?=$tahun_?></th>
									</tr>
								</thead>
								<tbody>
										<tr>
											<?php $no = 1; ?>
										<?php foreach($list as $l){
										?>
											<td><?php echo $no;?></td>
											<td><?=$l['nama_skpd'];?></td>
											<td style="text-align: center; background-color: rgba(255,255,0,0.3); ">
												<span title="Lihat Cascading" style="color: black;text-transform:uppercase"><?=isset($l['nilai'])? $l['nilai'] : "<i>-</i>" ?></span></td>
										</tr>
										<?php $no++ ;?>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
				<!-- Switcher ON-OFF Content / End -->

			</div>
			<!-- Section / End -->
		</div>




</section>

<!-- Resntra Modal -->
