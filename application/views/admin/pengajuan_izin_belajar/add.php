<!-- page content -->

<form method="post" enctype="multipart/form-data" >

            <div class="row">
				
              <div class="col-md-12 col-sm-12 col-xs-12">
			  <?php
				$tipe = (empty($error))? "info" : "warning";
				if (!empty($message)){
			?>
				<div class="alert alert-<?= $tipe;?> alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <?= $message;?>
                  </div>
				  <?php }?>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pengajuan izin belajar <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <!-- Smart Wizard -->
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Langkah 1<br />
                                              <small>Pencarian Data Pegawai</small>
                                          </span>
                          </a>
                        </li>

                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Langkah 2<br />
                                              <small>Form Pengajuan izin belajar</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Langkah 3<br />
                                              <small>Upload Berkas</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      
                      <div id="step-1">
                        
						<div class="form-group" style='text-align:center'>
							<button id="btn_cari" type="button" data-toggle="modal" data-target=".search-from-master" class="btn btn-success btn-lg btn-block">Cari data</button>
						</div>
						<div class="modal fade search-from-master" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-sm">
							  <div class="modal-content">

								<div class="modal-header">
								  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
								  </button>
								  <h4 class="modal-title" id="myModalLabel2">Masukan NIP</h4>
								</div>
								<div class="modal-body">
									<input class="form-control" name="nip_master" id='nip_master'>
								</div>
								<div class="modal-footer">
								  <button type="button" onclick='getFromMaster()' class="btn btn-default" data-dismiss="modal">Cari</button>
								</div>

							  </div>
							</div>
						</div>
                        
						<div id='detail' style='display:block'>

							<div class="col-md-2 col-sm-2 col-xs-12 profile_left">
							  <div class="profile_img">							   
								  <img id='foto' class="img-responsive avatar-view" src="<?php echo base_url()."data/user_picture/user_default.png" ?>" alt="Avatar" title="Change the avatar">	   
							  </div>
							  <h4 id='label_nama'>Nama</h4>
							  <ul class="list-unstyled user_data">
								<li id='label_nip'>NIP :</li>
								<li id='label_skpd'>SKPD :</li>							  
							  </ul>
							  <!--<a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>-->
							  <br />
							</div>
							
                    <div class="col-md-10 col-sm-9 col-xs-12">


                      
                        


                      <div class="panel panel-default">
                        <div class="panel-heading">
                            Nomor Induk Pegawai (NIP)
							<input type='hidden' id='id_pegawai' name="id_pegawai" >
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Lama</label>
                                            <input disabled id='nip_lama' class="form-control" name="NIPLama" required value=" ">
                                        </div>
                               </div>
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Baru</label>
                                            <input disabled id='nip_baru' class="form-control"required name="NIPBaru" value="" >
                                        </div>
                                </div>  
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Karpeg</label>
                                            <input disabled id='karpeg' class="form-control" required name="Karpeg" value="">
                                        </div>
                                 </div>
                            </div>
                        </div>
					</div>
						<div class="panel panel-default">
                          <div class="panel-heading">
                                        Nama Lengkap & Gelar
                                    </div>
                                    <div class="panel-body">
                                       <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Gelar di depan nama</label>
                                                    <input disabled id='nama_gelardepan' class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-md-4">                
                  
                                                <div class="form-group">
                                                    <label>Nama lengkap</label>
                                                       <input disabled id='nama_lengkap' class="form-control" name="NamaLengkap" value="">
                                                </div>
                                            </div>

                                           <div class="col-md-4">                
                                          <div class="form-group">
                                            <label>Gelar di belakang nama</label>
                                            <input disabled id='nama_gelarbelakang' class="form-control" >
                                          </div>
                                        </div>
                                     </div>
                                  </div>
                              </div>    


						<div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input disabled id='tempat_lahir' class="form-control" >
                                        </div>
                                </div>
                                <div class="col-lg-4">
                                 <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input disabled id='tgl_lahir' class="form-control" >
                                        </div>
                               </div>
                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Agama</label>
                                           <input disabled id='nama_agama' class="form-control" >
                                     </div>
								</div>
								<div class="col-lg-6">
               
								<div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <label class="radio-inline">
                                                <input type="radio" disabled name="JenisKelamin" id="jk1" value="Laki-laki"  />Laki-laki
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" disabled name="JenisKelamin" id="jk2" value="Perempuan"  />Perempuan
                                            </label>
                                        </div>
								</div>
							</div>
                      </div>
                  </div>    
              

              <div class="panel panel-default">
                        <div class="panel-heading">
                            Alamat
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alamat </label>
                                            <textarea name="Alamat" class="form-control" rows="6" disabled id='alamat'></textarea>
                                        </div>  
                                </div>
                                 <div class="col-md-4">
                                  <div class="form-group">
                                            <label>RT</label>
                                            <input disabled id='RT' class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input disabled id='RW' class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>Kode POS</label>
                                            <input disabled id='kode_pos' class="form-control" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input disabled id='telepon' class="form-control" >
                                        </div>
                                 </div>
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kelurahan/Desa</label>
                                            <input disabled id='desa' class="form-control" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input disabled id='kecamatan' class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>Kabupaten/Kota</label>
                                            <input disabled id='kabupaten' class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <input disabled id='provinsi' class="form-control" >
                                        </div>                                    
                                       </div>  
                                    </div>
                                  </div>
                            </div>  
                          
                      
                    
                </div>
				
				
						</div>

					  </div>
                         
                      <div id="step-2">
                        <h2 class="StepTitle">Form pengajuan</h2>
                         <div class="row">
                            
                            <div class="col-md-12">
                               <div class="panel panel-default">
                                  <div class="panel-heading">  </div>
                                    <div class="panel-body">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenjang pendidikan *</label>
										 
											<select class="form-control" name="id_jenjangpendidikan" id="id_jenjangpendidikan">
											  <option value="">Pilih</option>
											  <?php
												foreach($jenjang as $row)
												{
													echo "<option value='$row->id_jenjangpendidikan'>$row->nama_jenjangpendidikan</option>";
												}
											  ?>
											</select>
									  
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat pendidikan *</label>
										 
											<select class="form-control" name="id_tempatpendidikan" id="id_tempatpendidikan">
											  <option value="">Pilih</option>
											  <?php
												foreach($sekolah as $row)
												{
													echo "<option value='$row->id_tempatpendidikan'>$row->nama_tempatpendidikan</option>";
												}
											  ?>
											</select>
									  
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Jurusan *</label>
										 
											<select class="form-control" name="id_jurusan" id="id_jurusan">
											  <option value="">Pilih</option>
											  <?php
												foreach($jurusan as $row)
												{
													echo "<option value='$row->id_jurusan'>$row->nama_jurusan</option>";
												}
											  ?>
											</select>
									  
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12"> NIM </label>
											  <input  class="form-control" name="nim" id="nim"/>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12"> Keterangan izin_belajar *</label>
											
											  <textarea  class="form-control" name="keterangan_pengajuan" id="keterangan_pengajuan"></textarea>
										  
										</div>
                                     </div>
                                  </div>
                            
                          </div>
                          </div>
                          
                         
                       </div>



                      <div id="step-3">
                        <h2 class="StepTitle">Upload Berkas</h2>
                        
                          <div class="panel panel-default">
                          <div class="panel-heading">
                                  
                                    </div>
                                    <div class="panel-body">
                                       <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Upload Berkas *</label>
                                                    
										<input type="file" class="form-control" name="userfile" placeholder="Tidak ada File"> 
										<p>Ukuran : maksimal <?= $max_size."KB"?>
														<br>
														Tipe : .zip atau .rar
													</p>
                                                </div>
                                            </div>

                                          

                                           <div class="col-md-5">                
                                          <div class="form-group">
                                            <label>Keterangan Isi Berkas</label>
                                           <input class="form-control" id="keterangan_berkas" name="keterangan_berkas"/>
                                                
                                          </div>
                                        </div>
                                     </div>
                                  </div>
                              </div>    
                      </div>

                    </div>
                   
				   <div>
					<a href="<?= base_url();?>pengajuan_izin_belajar" class="btn btn-warning">Kembali</a>
				   </div>
</form>
<script>
	function getFromMaster(){
		var nip_master = $('#nip_master').val();
		$.post("<?= base_url();?>master_pegawai/get_pegawai_for_pengajuan",{'nip_baru':nip_master},function(response){
			var data = JSON.parse(response);
			//console.log(data[0]);
			if (data[0]!=undefined){
				$('#nip_lama').val(data[0].nip_lama);
				$('#nip_baru').val(data[0].nip_baru);
				$('#karpeg').val(data[0].karpeg);
				$('#nama_gelardepan').val(data[0].nama_gelardepan);
				$('#nama_lengkap').val(data[0].nama_lengkap);
				$('#nama_gelarbelakang').val(data[0].nama_gelarbelakang);
				$('#tempat_lahir').val(data[0].tempat_lahir);
				$('#tgl_lahir').val(data[0].tgl_lahir);
				$('#nama_agama').val(data[0].nama_agama);
				$('#alamat').html(data[0].alamat);
				$('#RT').val(data[0].RT);
				$('#RW').val(data[0].RW);
				$('#kode_pos').val(data[0].kode_pos);
				$('#telepon').val(data[0].telepon);
				$('#jk'+data[0].jenis_kelamin).attr('checked',true);
				$('#desa').val(data[0].desa);
				$('#kecamatan').val(data[0].kecamatan);
				$('#kabupaten').val(data[0].kabupaten);
				$('#provinsi').val(data[0].provinsi);
				$('#label_nama').html("<b>"+data[0].nama_lengkap+"</b>");
				$('#label_nip').html("<b>NIP: </b>"+data[0].nip_baru);
				$('#label_skpd').html("<b>SKPD:</b><br>"+data[0].nama_skpd);
				$('#id_pegawai').val(data[0].id_pegawai);
				var foto = "user_default.png";
				if (data[0].foto!="") foto = data[0].foto;
				$("#foto").attr("src","<?=base_url();?>data/user_picture/"+foto);
				$("#btn_cari").html("Ubah data");
				
			}
			else{
				alert('data tidak ditemukan');
				
			}
		});
	}
	
	function selesaiCallBack()
	{
		var cek = validate();
		if (cek[0]==1){
			$('form').submit();
		}
		else{
			alert(cek[1]);
		}
	}
	function validate(){
		var cek = new Array(0,"Data belum lengkap");
		var id_pegawai = $("#id_pegawai").val();
		var id_jenjangpendidikan = $("#id_jenjangpendidikan").val();
		var id_tempatpendidikan = $("#id_tempatpendidikan").val();
		var id_jurusan = $("#id_jurusan").val();
		var keterangan_pengajuan = $("#keterangan_pengajuan").val();
		if (id_pegawai!="" && id_jenjangpendidikan!="" && id_tempatpendidikan!="" && id_jurusan!="" && keterangan_pengajuan!="")
			cek[0]=1;
		return cek;
	}
</script>