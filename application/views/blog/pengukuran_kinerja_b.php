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

					<h2>Pengukuran Kinerja</h2><span>Daftar Pengukuran Kinerja</span>

					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a href="<?php echo base_url();?>">Beranda</a></li>
							<li>Pengukuran Kinerja</li>
						</ul>
					</nav>

				</div>
			</div>
		</div>
	</div>


<!-- Content
	================================================== -->
	<div class="container">
		<div class="add-listing-section margin-top-45">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3><i class="sl sl-icon-book-open"></i> Pengukuran Kinerja <?=$this->uri->segment(3)?> <div class="pull-right">
				<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class=""><?php
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
        	if ($this->uri->segment(3) == $year) {
        		$selected = "selected";
        	}
          echo'<option value="'.base_url("pengukuran_kinerja/index/".$year).'" '.$selected.'>'.$year.'</option>';
        }
        ?></select></div></h3>
			</div>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">
						<?php
						if($level!=1){
							if($level==2){
								$link = 1;
							}else{
								$this->ref_unit_kerja_model->id_unit_kerja = $id_induk;
								$aa = $this->ref_unit_kerja_model->get_by_id();
								$n = $level-1;
								$link = $n.'/'.$aa->id_induk;
							}
							?>
							<a href="<?=base_url('pengukuran_kinerja/index/'.$tahun_.'/'.$link.'')?>" class="button border pull-right">Kembali</a>
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">

						<div class="table-responsive">
							<table style="margin-top: 20px" class="basic-table" >
								<thead>
									<tr>
										<th>NO</th>
										<th>NAMA UNIT KERJA</th>
										<th width="7%" style="text-align: center; ">TW1</th>
										<th width="7%" style="text-align: center; ">TW2</th>
										<th width="7%" style="text-align: center; ">TW3</th>
										<th width="7%" style="text-align: center; ">TW4</th>
										<?php if($level<4){?>
											<th width="10%">CASCADING</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php
										$CI = & get_instance();
										$CI->load->model("pencapaian_model");

										$no=1;
										foreach($unit_kerja as $uk){

											$tw1 = $CI->pencapaian_model->getCapaianTriwulan($uk->id_unit_kerja,$tahun_,1,3);
											$tw2 = $CI->pencapaian_model->getCapaianTriwulan($uk->id_unit_kerja,$tahun_,4,6);
											$tw3 = $CI->pencapaian_model->getCapaianTriwulan($uk->id_unit_kerja,$tahun_,7,9);
											$tw4 = $CI->pencapaian_model->getCapaianTriwulan($uk->id_unit_kerja,$tahun_,10,12);
											$level_n = $level+1;
										?>
										<tr class="odd gradeX" id="tr_1">
											<td><?=$no?></td>
											<td><?=$uk->nama_unit_kerja?></td>
											<td style="text-align: right;background: #<?= ($tw1>0) ? warna($tw1) : ""?>; color: white;
											"><?= ($tw1>0) ? $tw1 : "" ?></td>
											<td style="text-align: right;background: #<?= ($tw2>0) ? warna($tw2) : ""?>; color: white;
											"><?=($tw2>0) ? $tw2 : ""?></td>
											<td style="text-align: right;background: #<?=($tw3>0) ? warna($tw3) : ""?>; color: white;
											"><?=($tw3>0) ? $tw3 : ""?></td>
											<td style="text-align: right;background: #<?=($tw4>0) ? warna($tw4) : ""?>; color: white;
											"><?=($tw4>0) ? $tw4 : ""?></td>

											<?php if($level<4){?>
												<td style="text-align: center; "><a href="<?=base_url().'pengukuran_kinerja/index/'.$tahun_.'/'.$level_n.'/'.$uk->id_unit_kerja.''?>" title="Lihat Cascading"><i class="fa fa-search"></i></a></td>
											</tr>
										<?php } ?>
										<?php $no++; } ?>
									</tbody>
								</table>
							</div>
							<div class="row" style="margin-top: 40px">
								<div class="col-md-4">
									PENJELASAN WARNA
                                <table class="table">
                                    <thead>
            							<tr>
            								<th width="1%" style="text-align: center;">NO</th>
                                            <th width="2%" style="text-align: center;">WARNA</th>
                                            <th>KETERANGAN</th>
            							</tr>
            						</thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center;">1</td>
                                            <td style="text-align: center;                     background: #008000; color: white;
                "></td>
                                            <td>Baik ( Skor >= 100 )</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">2</td>
                                            <td style="text-align: center;                     background: #FFD700; color: black;
                "></td>
                                            <td>Hati-hati ( 80 <= Skor < 100 )</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">3</td>
                                            <td style="text-align: center;                     background: #FF0000; color: white;
                "></td>
                                            <td>Buruk ( Skor < 80 )</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">4</td>
                                            <td style="text-align: center;                     background: #fff; color: white;
                "></td>
                                            <td>Belum Ada Skor</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div></div>
						</div>
					</div>

				</div>
				<!-- Switcher ON-OFF Content / End -->

			</div>
			<!-- Section / End -->
		</div>
