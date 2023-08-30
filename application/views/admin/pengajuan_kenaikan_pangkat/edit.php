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
                    <h2>Edit Pengajuan kenaikan pangkat <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <div class="col-md-12 col-sm-9 col-xs-12">


                      
                        


                      <div class="panel panel-default">
                        <div class="panel-heading">
                            Nomor Induk Pegawai (NIP)
							<input type='hidden' id='id_pegawai' name="id_pegawai" value="<?=$data_pegawai->id_pegawai;?>" >
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Lama</label>
                                            <input disabled id='nip_lama' class="form-control" name="NIPLama" required value="<?=$data_pegawai->nip_lama;?>">
                                        </div>
                               </div>
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Baru</label>
                                            <input disabled id='nip_baru' class="form-control"required name="NIPBaru" value="<?=$data_pegawai->nip_baru;?>" >
                                        </div>
                                </div>  
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Karpeg</label>
                                            <input disabled id='karpeg' class="form-control" required name="Karpeg" value="<?=$data_pegawai->karpeg;?>">
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
                                                    <input disabled id='nama_gelardepan' class="form-control" value="<?=$data_pegawai->nama_gelardepan;?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4">                
                  
                                                <div class="form-group">
                                                    <label>Nama lengkap</label>
                                                       <input disabled id='nama_lengkap' class="form-control" name="NamaLengkap" value="<?=$data_pegawai->nama_lengkap;?>">
                                                </div>
                                            </div>

                                           <div class="col-md-4">                
                                          <div class="form-group">
                                            <label>Gelar di belakang nama</label>
                                            <input disabled id='nama_gelarbelakang' class="form-control" value="<?=$data_pegawai->nama_gelarbelakang;?>">
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
                                            <input disabled id='tempat_lahir' class="form-control" value="<?=$data_pegawai->tempat_lahir;?>">
                                        </div>
                                </div>
                                <div class="col-lg-4">
                                 <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input disabled id='tgl_lahir' class="form-control" value="<?=$data_pegawai->tgl_lahir;?>">
                                        </div>
                               </div>
                                <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Agama</label>
                                           <input disabled id='nama_agama' class="form-control" value="<?=$data_pegawai->nama_agama;?>">
                                     </div>
								</div>
								<div class="col-lg-6">
               
								<div class="form-group">
                                            <label>Jenis Kelamin</label>
											<?php
												$checked1 = $data_pegawai->jenis_kelamin==1 ? "checked" : "";
												$checked2 = $data_pegawai->jenis_kelamin==2 ? "checked" : "";
											?>
                                            <label class="radio-inline">
                                                <input type="radio" disabled name="JenisKelamin" id="jk1" value="Laki-laki" <?=$checked1;?>  />Laki-laki
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" disabled name="JenisKelamin" id="jk2" value="Perempuan"  <?=$checked2;?> />Perempuan
                                            </label>
                                        </div>
								</div>
							</div>
                      </div>
                  </div>    
              <!--

              <div class="panel panel-default">
                        <div class="panel-heading">
                            Alamat
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alamat </label>
                                            <textarea name="Alamat" class="form-control" rows="6" disabled id='alamat'><?=$data_pegawai->alamat;?></textarea>
                                        </div>  
                                </div>
                                 <div class="col-md-4">
                                  <div class="form-group">
                                            <label>RT</label>
                                            <input disabled id='RT' class="form-control" value="<?=$data_pegawai->RT;?>">
                                        </div>
                                        <div class="form-group">
                                            <label>RW</label>
                                            <input disabled id='RW' class="form-control" value="<?=$data_pegawai->RW;?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Kode POS</label>
                                            <input disabled id='kode_pos' class="form-control" value="<?=$data_pegawai->kode_pos;?>" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input disabled id='telepon' class="form-control" value="<?=$data_pegawai->telepon;?>" >
                                        </div>
                                 </div>
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kelurahan/Desa</label>
                                            <input disabled id='desa' class="form-control" value="<?=$data_pegawai->desa;?>" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <input disabled id='kecamatan' class="form-control" value="<?=$data_pegawai->kecamatan;?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>Kabupaten/Kota</label>
                                            <input disabled id='kabupaten' class="form-control" value="<?=$data_pegawai->kabupaten;?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <input disabled id='provinsi' class="form-control" value="<?=$data_pegawai->provinsi;?>">
                                        </div>                                    
                                       </div>  
                                    </div>
                                  </div>
                            </div>  
                          
                      
                    -->
                
						
                        <div class="panel panel-default">
									 
									<div class="panel-body">
										<div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Dari Gol. Ruang</label>
                                                    <select class='form-control' name='id_golongan1' id="id_golongan1" onchange="getGol2()">
														<option value='' selected='selected'>Pilih</option>
														<?php
															foreach($golongan as $row){
																$selected = $data_pengajuan->id_golongan1==$row->id_golongan? "selected" : "";
																echo "<option value='$row->id_golongan' $selected>$row->golongan</option>";
															}
														?>
													</select>
                                                </div>
                                            </div>
											<div class="col-md-4">                
											  <div class="form-group">
												<label>Ke Gol. Ruang</label>
												<select class='form-control' name='id_golongan2' id='id_golongan2'>
													<option value='<?=$data_pengajuan->id_golongan2;?>' selected='selected'><?=$data_pengajuan->golongan2;?></option>
												</select>
											  </div>
											</div>
											<div class="col-md-4">                
											  <div class="form-group">
												<label>Keterangan </label>
											   <input class="form-control" id="keterangan_pengajuan" name="keterangan_pengajuan" value="<?=$data_pengajuan->keterangan_pengajuan;?>"/>
													
											  </div>
											</div>
                                     </div>
                                  </div>
									<div class="panel-body">
										<div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Upload Berkas</label>
                                                    
										<input type="file" class="form-control" name="userfile" placeholder=""> 
										<p>Ukuran : maksimal <?= $max_size."KB"?>
														<br>
														Tipe : .zip atau .rar
													</p>
                                                </div>
                                            </div>

                                          

                                           <div class="col-md-6">                
                                          <div class="form-group">
                                            <label>Keterangan Isi Berkas</label>
                                           <input class="form-control" id="keterangan_berkas" name="keterangan_berkas" value="<?=$data_pengajuan->keterangan_berkas;?>"/>
                                                
                                          </div>
                                        </div>
										</div>
                                     </div>
									 <div class="panel-body">
									  <div class="row">
										<div class="col-md-12">  
											<a href="<?= base_url();?>pengajuan_kenaikan_pangkat" class="btn btn-warning">Kembali</a>
											<input type="hidden" value="<?=$data_pengajuan->id;?>" name="id" />
											<input type="submit" class="btn btn-primary" value="Update" />
									   </div>
									  </div>
									  </div>
                                  </div>
                              </div>    
                      </div>

                    
				  
</form>
<script>
	
	
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
		var id_golongan1 = $("#id_golongan1").val();
		var id_golongan2 = $("#id_golongan2").val();
		var keterangan_pengajuan = $("#keterangan_pengajuan").val();
		if (id_pegawai!="" && id_golongan1!="" && id_golongan2!="" &&  keterangan_pengajuan!="")
			cek[0]=1;
		return cek;
	}
	function getGol2()
	{
		var id_golongan = $("#id_golongan1").val();
		if (id_golongan==""){
			$("#id_golongan2").html("<option value=''>Pilih</option>");
		}
		else{
			$.post("<?=base_url();?>pengajuan_kenaikan_pangkat/get_golongan2",{'id_golongan':id_golongan},
			function(obj){
				$("#id_golongan2").html(obj);
				console.log(obj);
			});
		}
		
	}
</script>