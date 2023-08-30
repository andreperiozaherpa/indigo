<div class="container-fluid">
	
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo title($title) ?></h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<form method='post' enctype="multipart/form-data" >
						<div class="x_content">
							<div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
								<button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<label id='status'></label>
							</div>
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										Formulir Individual Development Plan (IDP)
									</div>
									<div class="panel-body">
									<div class="form-group">	
										<label>Periode</label>
                                        <div class="input-daterange input-group" id="">
                                            <input type="text" class="form-control mydatepicker" value="<?= (!empty($tanggal_mulai)) ? $tanggal_mulai : "" ;?>" name="tanggal_mulai" />
                                            <span class="input-group-addon bg-info b-0 text-white">s.d</span>
                                            <input type="text" class="form-control mydatepicker" value="<?= (!empty($tanggal_akhir)) ? $tanggal_akhir : "" ;?>" name="tanggal_akhir" />
                                        </div>
                                        <?= form_error("tanggal_mulai",'<p class="text-info">','</p>');?>
                                        <?= form_error("tanggal_akhir",'<p class="text-info">','</p>');?>
                                    </div>
									<br>
									<b style="font-size:15px;">Rencana Karir</b>
									<hr>
									<div class="text-center">
									<b><i>Keahlian dan karier seperti apakah yang Saudara bayangkan / harapkan miliki di Pemerintah Kab. Sumedang dalam 2 tahun ke depan? </i></b>
									</div>
									<br>
									<div class="form-group">
									<textarea name="rencana_karir" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: Dalam 2 Tahun kedepan. saya membayangkan diri saya dapat mengaplikasikan pengetahuan 	
dan keterampilan di bidang penyusunan anggaran, berada di posisi senior (eselon III atau setara) dan 	
dapat berperan dalam proses pengambilan keputusan, khususnya dalam hal penyusunan anggaran di 	
lingkungan Sekretariat Jenderal."><?= (!empty($rencana_karir)) ? $rencana_karir : "" ;?></textarea>
									</div>
									<b style="font-size:15px;">Kekuatan dan Area Pengembangan</b>
									<hr>
									<div class="text-center">
									<b><i>Kompetensi apa yang Saudara perlukan untuk mencapai Aspirasi Karir Tersebut? 
(lihat 'Daflar Kompetensi' pada Pedoman Pengembangan) </i></b>
									</div>  
									<br>
									<div class="form-group">
									<label>Inti</label>
									<textarea name="kompetensi_inti" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: •	Integrity Lv.3
									•	Drive for Result Lv.3
									•	Team Work and Collaboration Lv.3
									•	Stakeholder Orientation Lv.3
									•	Quality Improvement Lv.3
									"><?= (!empty($kompetensi_inti)) ? $kompetensi_inti : "" ;?></textarea>
									</div>
									<div class="form-group">
									<label>Profesional</label>
									<textarea name="kompetensi_profesional" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: ">
                                    <?= (!empty($kompetensi_profesional)) ? $kompetensi_profesional : "" ;?>
                                    </textarea>
									</div>
									<div class="form-group">
									<label>Sosial Kultural</label>
									<textarea name="kompetensi_sosial" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: ">
                                    <?= (!empty($kompetensi_sosial)) ? $kompetensi_sosial : "" ;?>
                                    </textarea>
									</div>
									<div class="form-group">
									<label>Teknis</label>
									<textarea name="kompetensi_teknis" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: ">
                                    <?= (!empty($kompetensi_teknis)) ? $kompetensi_teknis : "" ;?>
                                    </textarea>
									</div>
									<div class="text-center">
									<b><i>Kompetensi (Knowledge/Skill/Attitude) atau Sertifikasi/keahlian & Karakter apa yang saat ini sudah memadai ? </i></b>
									</div>
									<br>
									<div class="form-group">
									<textarea name="kompetensi_memadai" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: ">
                                    <?= (!empty($kompetensi_memadai)) ? $kompetensi_memadai : "" ;?>
                                    </textarea>
									</div>
									<div class="text-center">
									<b><i>Kompetensi (Knowledge/Skill/Attitude) atau Sertifikasi/keahlian, dan Aspek apa yang perlu dikembangkan ? </i></b>
									</div>
									<br>
									<div class="form-group">
									<textarea name="kompetensi_dikembangkan" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: ">
                                    <?= (!empty($kompetensi_dikembangkan)) ? $kompetensi_dikembangkan : "" ;?>
                                    </textarea>
									</div>
									<br>
									<b style="font-size:15px;">Rencana Kegiatan Pengembangan</b>
									<hr>
									<div class="text-center">
									<b><i>Kompetensi Pengembangan </i></b>
									</div>
									<div class="form-group">
									<label>Kompetensi</label>
									<textarea name="rencana_pengembangan_kompetensi" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: ">
                                    <?= (!empty($rencana_pengembangan_kompetensi)) ? $rencana_pengembangan_kompetensi : "" ;?>
                                    </textarea>
									</div>
									<div class="form-group">
									<label>Indikator perilaku yang diharapkan muncul</label>
									<textarea name="rencana_indikator_perilaku" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: ">
                                    <?= (!empty($rencana_indikator_perilaku)) ? $rencana_indikator_perilaku : "" ;?>
                                    </textarea>
									</div>
									<br>
									<div class="text-center">
									<b><i>Pengembangan Kompetensi</i></b>
									</div>
									<div class="form-group">
									<label>Aktivitas</label>
									<textarea name="rencana_aktivitas" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: ">
                                    <?= (!empty($rencana_aktivitas)) ? $rencana_aktivitas : "" ;?>
                                    </textarea>
									</div>
									<div class="form-group">
									<label>Waktu Pelaksanaan</label>
									<div class="input-group">
                                            <input type="text" name="rencana_waktu" value="<?= (!empty($rencana_waktu)) ? $rencana_waktu : "" ;?>" class="form-control mydatepicker" placeholder="yyyy-mm-dd">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                    </div>
																		<div class="form-group">
									<label>Keterangan</label>
									<textarea name="rencana_keterangan" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: ">
                                    <?= (!empty($rencana_keterangan)) ? $rencana_keterangan : "" ;?>
                                    </textarea>
									</div>
									<br>
									<b style="font-size:15px;">Penandatangan</b>
									<hr>
									<div class="form-group">
									<label>Mentor Tetap</label>
									     <select class="form-control select2" name="rencana_mentor_tetap">
                                            <option value="">Pilih</option>
                                            <?php 
                                            foreach($dt_pegawai as $row)
                                            {
                                                $selected = (!empty($rencana_mentor_tetap) && $rencana_mentor_tetap==$row->id_pegawai) ? "selected" : "";
                                                echo "<option $selected value='".$row->id_pegawai."'>".$row->nama_lengkap."</option>";
                                            }
                                            ?>
                                        </select>
									</div>
									<div class="form-group">
									<label>Atasan Mentor</label>
                                        <select class="form-control select2" name="rencana_atasan_mentor">
                                            <option value="">Pilih</option>
                                            <?php 
                                            foreach($dt_pegawai as $row)
                                            {
                                                $selected = (!empty($rencana_atasan_mentor) && $rencana_atasan_mentor==$row->id_pegawai) ? "selected" : "";
                                                echo "<option $selected value='".$row->id_pegawai."'>".$row->nama_lengkap."</option>";
                                            }
                                            ?>
                                        </select>
									</div>
									<br>
									<div class="pull-right">
										<a href='<?= base_url();?>talenta/idp/detail/<?= $this->session->userdata("id_pegawai") ;?>' class='btn btn-default'>Back</a>
										<button type='submit' class='btn btn-primary'>Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		