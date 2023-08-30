<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Verifikasi Pendaftar</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <?php echo breadcrumb($this->uri->segment_array()); ?>
                </ol>
        </div>
	</div>
	<!-- .row -->
	<div class="row">
		<div class="col-sm-12">
			<a href="<?=base_url('talenta/pendaftar')?>" class="btn btn-primary btn-outline pull-right">Kembali</a>
			<br><br><br>
            <div class="white-box">
				<div class="text-center">
					<small><b style="color: #6003c8" >SELEKSI UNTUK</b></small>
					<br>

					<span style="margin-right: 10px;"><i style="color: #6003c8" class="ti-pulse "></i> Eselon <?= $dt_pendaftaran->eselon;?></span>
					<span style="margin-right: 10px;"><i style="color: #6003c8" data-icon="&#xe030;" class="linea-icon linea-aerrow "></i> <?= $dt_pendaftaran->nama_skpd;?></span>
					<span><i style="color: #6003c8" class="ti-bar-chart"></i> <?= $dt_pendaftaran->nama_jabatan;?></span>
				</div>
			</div>
			<div class="white-box">
				<div class="user-bg"> <img width="100%" height="100%" alt="user" src="https://e-office.sumedangkab.go.id/data/images/header/header2.jpg">
					<div class="overlay-box">
						<div class="col-md-3">
							<div class="user-content"> <a href="javascript:void(0)"><img src="https://e-office.sumedangkab.go.id/data/foto/pegawai/<?= $pegawai['foto_pegawai'];?>" class="thumb-lg img-circle" style=" object-fit: cover;
							width: 80px;
							height: 80px;border-radius: 50%;
							" alt="img">
							<h5 class="text-white"><b><?= $pegawai['nama_lengkap'];?> </b></h5>
							<h6 class="text-white"><?= $pegawai['nip'];?></h6>
						</div>
					</div>
					<div class="col-md-3" style="border-right: 1px solid grey;border-left: 1px solid grey;">
						<br>
						<div class="user-content" style="padding-bottom:15px;">
							<h5 class="text-white"><b>SKPD</b></h5>
							<h6 class="text-white"><?= $pegawai['nama_skpd'];?></h6>
						</div>
					</div>
					<div class="col-md-3" style="border-right: 1px solid grey;">
						<br>
						<div class="user-content" style="padding-bottom:15px;">
							<h5 class="text-white"><b>Unit Kerja</b></h5>
							<h6 class="text-white"><?= $pegawai['nama_unit_kerja'];?></h6>
						</div>
					</div>
					<div class="col-md-3">
						<br>
						<div class="user-content" style="padding-bottom:15px;">
							<h5 class="text-white"><b>Jabatan</b></h5>
							<h6 class="text-white"><?= $pegawai['nama_jabatan'];?></h6>
						</div>
					</div>

				</div>
			</div>
        </div>
        <?php echo form_open_multipart() ?>
        
        <div class="col-md-12">
            <?php 
            $x = 1;
            foreach($dt_verifikasi as $row){
                $heading = "heading".$x;
                $collapse = "collapse".$x;
                $name = "kriteria_".$row->id_variabel; 
                ?>
                        
                        <div class="panel-group" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="<?=$heading;?>">
                                    <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?=$collapse;?>" aria-expanded="true" aria-controls="<?=$collapse;?>" class="font-bold"> 
                                    <?= $row->variabel;?> </a> </h4>
                                    
                                </div>
                                <div id="<?=$collapse;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="<?=$heading;?>">
                                    
                                    <div class="panel-body">
                                    <?= form_error($name,'<p class="text-danger">','</p>');?>
                                        <table class="table" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kriteria</th>
                                                <th>Skor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=1;
                                        foreach($row->kriteria as $k){
                                             
                                            $id = "kriteria_".$k->id_kriteria;   
                                            $checked = (!empty($input[$name]) && $input[$name]==$k->id_kriteria) ? "checked" : "";
                                        ?>
                                            <tr>
                                                <td width="5px"><label for="<?=$id;?>"><?=$i;?></label></td>
                                                <td>
                                                <div class="radio">
                                                    <input <?= $checked;?> id="<?=$id;?>" type="radio" value="<?=$k->id_kriteria;?>" name="<?=$name;?>">
                                                    <label for="<?=$id;?>"><?=$k->kriteria;?></label>
                                                </div>
                                                </td>
                                                <td width="5px"><?=$k->skor;?></td>
                                            </tr>
                                        <?php $i++; } ?>    
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <?php $x++; } 
                        
                        $checked = (!empty($input["lolos"]) && $input["lolos"]=="1") ? "checked" : "";

                        ?>

                        <div class="white-box">
                            <h3 class="box-title m-b-0">Nilai Assessment</h3>
                            <small>Digunakan untuk pemetaan 9 Box</small>
                            <br>
                            <table class="table">
                                <thead>
                                            <tr>
                                                <th width='30%'>Parameter</th>
                                                <th width='40%'>Nilai</th>
                                                <th width='30%'>File lampiran</th>
                                            </tr>
                                </thead>
                                <tbody>
                                            <tr>
                                                <td>Nilai Kompetensi</td>
                                                <td>
                                                <select class="form-control select2" name="kompetensi">
													<?php
													$param_kompetensi = array(
														1 => 'Belum memenuhi syarat',
														2 => 'Masih memenuhi syarat',
														3 => 'Memenuhi syarat'
													);
													foreach($param_kompetensi as $key=>$value)
													{
														$selected = (!empty($dt_pendaftaran) && $dt_pendaftaran->kompetensi==$key) ? "selected" : "";
														echo "<option $selected value='$key'>$value</option>";
													}
													?>
												</select>
                                                </td>
                                                <td>
                                                    <?php if($dt_pendaftaran->file_kompetensi){?>
                                                    <a target="_blank" href='<?=base_url()."data/talent/berkas/kompetensi/".$dt_pendaftaran->file_kompetensi;?>' class="btn btn-sm btn-primary">Download</a>
                                                    <?php }
                                                    else{?>
                                                    User belum melampirkan file
                                                    <?php }?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nilai Potensi</td>
                                                <td>
                                                <select class="form-control select2" name="potensi">
													<?php
													$param_potensi = array(
														1 => 'Kurang',
														2 => 'Cukup',
														3 => 'Baik'
													);
													foreach($param_potensi as $key=>$value)
													{
														$selected = (!empty($dt_pendaftaran) && $dt_pendaftaran->potensi==$key) ? "selected" : "";
														echo "<option $selected value='$key'>$value</option>";
													}
													?>
												</select>
                                                </td>
                                                <td>
                                                    <?php if($dt_pendaftaran->file_potensi){?>
                                                    <a target="_blank" href='<?=base_url()."data/talent/berkas/potensi/".$dt_pendaftaran->file_potensi;?>' class="btn btn-sm btn-primary">Download</a>
                                                    <?php }
                                                    else{?>
                                                    User belum melampirkan file
                                                    <?php }?>
                                                </td>
                                            </tr>
                                </tbody>
                            </table>    
                        </div>


                        <div class="white-box">
                            <h3 class="box-title m-b-0">Verifikasi</h3>
                            <small>Centang jika peserta telah lolos verifikasi</small>
                            <hr>
                            <div class="checkbox checkbox-primary">
                            <input  <?=$checked;?> id="checkbox" type="checkbox" value="1" name="lolos">
                            <label for="checkbox">Peserta ini telah lolos verifikasi</label>
                        </div>
                <br>
                <input type="hidden" name="submit" value="1" />
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>
        </form>
    </div>
</div>