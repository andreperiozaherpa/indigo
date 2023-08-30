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
                                        <div class="input-daterange input-group" id="date-range">
                                            <input type="text" class="form-control" name="start" />
                                            <span class="input-group-addon bg-info b-0 text-white">s.d</span>
                                            <input type="text" class="form-control" name="end" />
                                        </div>
                                    </div>
									<br>
									<b style="font-size:15px;">Rencana Karir</b>
									<hr>
									<div class="text-center">
									<b><i>Keahlian dan karier seperti apakah yang Saudara bayangkan / harapkan miliki di Kementerian Keuangan dalam 2 tahun ke depan? </i></b>
									</div>
									<br>
									<div class="form-group">
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: Dalam 2 Tahun kedepan. saya membayangkan diri saya dapat mengaplikasikan pengetahuan 	
dan keterampilan di bidang penyusunan anggaran, berada di posisi senior (eselon III atau setara) dan 	
dapat berperan dalam proses pengambilan keputusan, khususnya dalam hal penyusunan anggaran di 	
lingkungan Sekretariat Jenderal."></textarea>
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
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: •	Integrity Lv.3
									•	Drive for Result Lv.3
									•	Team Work and Collaboration Lv.3
									•	Stakeholder Orientation Lv.3
									•	Quality Improvement Lv.3
									"></textarea>
									</div>
									<div class="form-group">
									<label>Profesional</label>
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: "></textarea>
									</div>
									<div class="form-group">
									<label>Sosial Kultural</label>
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: "></textarea>
									</div>
									<div class="form-group">
									<label>Teknis</label>
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: "></textarea>
									</div>
									<div class="text-center">
									<b><i>Kompetensi (Knowledge/Skill/Attitude) atau Sertifikasi/keahlian & Karakter apa yang saat ini sudah memadai ? </i></b>
									</div>
									<br>
									<div class="form-group">
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: "></textarea>
									</div>
									<div class="text-center">
									<b><i>Kompetensi (Knowledge/Skill/Attitude) atau Sertifikasi/keahlian, dan Aspek apa yang perlu dikembangkan ? </i></b>
									</div>
									<br>
									<div class="form-group">
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: "></textarea>
									</div>
									<br>
									<b style="font-size:15px;">Rencana Kegiatan Pengembangan</b>
									<hr>
									<div class="text-center">
									<b><i>Kompetensi Pengembangan </i></b>
									</div>
									<div class="form-group">
									<label>Kompetensi</label>
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: "></textarea>
									</div>
									<div class="form-group">
									<label>Indikator perilaku yang diharapkan muncul</label>
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: "></textarea>
									</div>
									<br>
									<div class="text-center">
									<b><i>Pengembangan Kompetensi</i></b>
									</div>
									<div class="form-group">
									<label>Aktivitas</label>
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: "></textarea>
									</div>
									<div class="form-group">
									<label>Waktu Pelaksanaan</label>
									<div class="input-group">
                                            <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span> </div>
                                    </div>
																		<div class="form-group">
									<label>Keterangan</label>
									<textarea name="" class="textarea_editor form-control" id="" cols="30" rows="10" placeholder="Contoh: "></textarea>
									</div>
									<br>
									<b style="font-size:15px;">Penandatangan</b>
									<hr>
									<div class="form-group">
									<label>Mentor Tetap</label>
									     <select class="form-control">
                                            <option>Nandang Koswara</option>
                                            <option>Khalid Insan Tauhid</option>
                                        </select>
									</div>
									<div class="form-group">
									<label>Atasan Mentor</label>
									     <select class="form-control">
                                            <option>Nandang Koswara</option>
                                            <option>Khalid Insan Tauhid</option>
                                        </select>
									</div>
									<br>
									<div class="pull-right">
										<a href='<?= base_url();?>master_pegawai' class='btn btn-default'>Back</a>
										<button type='submit' class='btn btn-primary'>Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			function change_kepala() {
				if ($('#kepala_skpd').is(':checked') == true){
		      // $('#hide-unit').addClass('hidden');
		      $('#id_unit_kerja').attr('disabled',true);
		      $('#id_jabatan').attr('disabled',true);
		      $('#jenis_pegawai').attr('readonly',true);
		      $('#jenis_pegawai').val("kepala");
		  } else {
		      // $('#hide-unit').removeClass('hidden');
		      $('#id_unit_kerja').attr('disabled',false);
		      $('#id_jabatan').attr('disabled',false);
		      $('#jenis_pegawai').attr('readonly',false);
		  }
		}

	</script>

	<script>


		function getUnitKerja(){
			var id_skpd = $('#id_skpd').val();
			if(id_skpd!=''){
				$.post("<?= base_url();?>master_pegawai/get_unit_kerja_by_skpd/"+id_skpd,{},function(obj){
					$('#id_unit_kerja').html(obj);
				});
			}
		}

		function getJabatan(){
			var id_unit_kerja = $('#id_unit_kerja').val();
			if(id_unit_kerja!=''){
				$.post("<?= base_url();?>master_pegawai/get_jabatan_by_unit_kerja/"+id_unit_kerja,{},function(obj){
					$('#id_jabatan').html(obj);
				});
			}
		}

		function searchPegawai(){
			var nip = $('#nip').val();
			$.ajax({
				url:'<?=base_url('master_pegawai/get_pegawai/')?>/'+nip,
				timeout:false,
				type:'GET',
				dataType:'JSON',
				success:function(hasil){
					$("#nip").removeAttr("disabled","disabled");
					$("#btnSearch").html('<i class="ti-search"></i>');
					if(hasil.result){
						$('[name="nama_lengkap"]').val(hasil.nama_lengkap);
						$('[name="pangkat"]').val(hasil.pangkat);
						$('[name="golongan"]').val(hasil.gol);
						$("#id_skpd option").filter(function() {
						  return $(this).text() == hasil.unitkerja.toUpperCase();
						}).attr('selected', true);
						$("#nip").attr("readonly","readonly");
						$('[name="nama_lengkap"]').attr("readonly","readonly");
						$('[name="pangkat"]').attr("readonly","readonly");
						$('[name="golongan"]').attr("readonly","readonly");
						$("#id_skpd").attr("readonly","readonly");
					}else{
						$('[name="nama_lengkap"]').val('');
						$('[name="pangkat"]').val('');
						$('[name="golongan"]').val('');
						$('#message').html(hasil.message);
					}
					getUnitKerja();
				}
				,error:function(a,b,c)
				{
					$("#nip").removeAttr("disabled","disabled");
					$("#btnSearch").html('<i class="ti-search"></i>');
					$('#message').html(c);
				}
				,beforeSend:function()
				{
					$("#nip").attr("disabled","disabled");
					$("#btnSearch").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
				}
			});
		}

		


	</script>