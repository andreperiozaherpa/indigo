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
                                        <p><?= tanggal($detail->tanggal_mulai) ." s.d. " . tanggal($detail->tanggal_akhir) ;?></p>
                                        
                                    </div>
									<br>
									<b style="font-size:15px;">Rencana Karir</b>
									<hr>
									<div class="text-center">
									<b><i>Keahlian dan karier seperti apakah yang Saudara bayangkan / harapkan miliki di Pemerintah Kab. Sumedang dalam 2 tahun ke depan? </i></b>
									</div>
									<br>
									<div class="form-group">
									<blockquote><?=$detail->rencana_karir;?></blockquote>
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
									<blockquote><?=$detail->kompetensi_inti;?></blockquote>
									</div>
									<div class="form-group">
									<label>Profesional</label>
									<blockquote><?=$detail->kompetensi_profesional;?></blockquote>
									</div>
									<div class="form-group">
									<label>Sosial Kultural</label>
									<blockquote><?=$detail->kompetensi_sosial;?></blockquote>
                                    </div>
									<div class="form-group">
									<label>Teknis</label>
									<blockquote><?=$detail->kompetensi_teknis;?></blockquote>
                                    </div>
									<div class="text-center">
									<b><i>Kompetensi (Knowledge/Skill/Attitude) atau Sertifikasi/keahlian & Karakter apa yang saat ini sudah memadai ? </i></b>
									</div>
									<br>
									<div class="form-group">
									<blockquote><?=$detail->kompetensi_memadai;?></blockquote>
                                    </div>
									<div class="text-center">
									<b><i>Kompetensi (Knowledge/Skill/Attitude) atau Sertifikasi/keahlian, dan Aspek apa yang perlu dikembangkan ? </i></b>
									</div>
									<br>
									<div class="form-group">
									<blockquote><?=$detail->kompetensi_dikembangkan;?></blockquote>
                                    </div>
									<br>
									<b style="font-size:15px;">Rencana Kegiatan Pengembangan</b>
									<hr>
									<div class="text-center">
									<b><i>Kompetensi Pengembangan </i></b>
									</div>
									<div class="form-group">
									<label>Kompetensi</label>
									<blockquote><?=$detail->rencana_pengembangan_kompetensi;?></blockquote>
                                    </div>
									<div class="form-group">
									<label>Indikator perilaku yang diharapkan muncul</label>
									<blockquote><?=$detail->rencana_indikator_perilaku;?></blockquote>
                                    </div>
									<br>
									<div class="text-center">
									<b><i>Pengembangan Kompetensi</i></b>
									</div>
									<div class="form-group">
									<label>Aktivitas</label>
									<blockquote><?=$detail->rencana_aktivitas;?></blockquote>
                                    </div>
									<div class="form-group">
									<label>Waktu Pelaksanaan</label>
                                        <p><?= tanggal($detail->rencana_waktu) ;?></p>
                                    </div>
																		<div class="form-group">
									<label>Keterangan</label>
									<blockquote><?=$detail->rencana_keterangan;?></blockquote>
                                    </div>
									<br>
									<b style="font-size:15px;">Penandatangan</b>
									<hr>
									<div class="form-group">
									<label>Mentor Tetap</label>
                                    <p><?=$detail->nama_mentor_tetap;?></p>
									</div>
									<div class="form-group">
									<label>Atasan Mentor</label>
									    <p><?=$detail->nama_atasan_mentor;?></p>
									</div>
									<br>
									
								</div>
							</div>
						</form>
					</div>
                    <div class="pull-right">
                        <?php if($level!="Administrator"){?>
						    <a href='<?= base_url();?>talenta/idp/form/' class='btn btn-primary'>Update Formulir IDP</a>
                        <?php } else{?>
                            <a href='<?= base_url();?>talenta/idp/' class='btn btn-primary'>Kembali</a>
                        <?php } ?>				
					</div>
				</div>
			</div>
		</div>
