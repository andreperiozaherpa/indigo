
<section class="data-list-view-header">
	<!-- RW orangtua -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Orang Tua<button type="button" onclick="tambah_orangtua();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Hubungan <span class="fa fa-sort-asc"></span></th>
								<th>Tempat Lahir</th>
								<th>Tanggal Lahir</th>
								<th>Jenis Kelamin</th>
								<th>Pendidikan</th>
								<th>Pekerjaan</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($orangtua as $row1): $row = $row1; ?>
								<?php foreach ($dump_orangtua['update'] as $row2): ?>
									<?php
									if($row1->id_orangtua == $row2->id_orangtua) {
										$row = $row2;
										$row->nama_lengkap = convert_data($master_orang,'id_orang',$row->id_orang,'nama_lengkap');
										$row->id_tempat_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'id_tempat_lahir');
										$row->nama_kelahiran = convert_data($ref_kelahiran,'kode_kelahiran',$row->id_tempat_lahir,'nama_kelahiran');
										$row->tanggal_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'tanggal_lahir');
										$row->jenis_kelamin = convert_data($master_orang,'id_orang',$row->id_orang,'jenis_kelamin');
										$row->id_tingkat_pendidikan = convert_data($master_orang,'id_orang',$row->id_orang,'id_tingkat_pendidikan');
										$row->nama_tingkatpendidikan = convert_data($ref_tingkatpendidikan,'kode_tingkatpendidikan',$row->id_tingkat_pendidikan,'nama_tingkatpendidikan');
										$row->pekerjaan = convert_data($master_orang,'id_orang',$row->id_orang,'pekerjaan');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_orangtua['delete'] as $row2): ?>
									<?php
									if($row1->id_orangtua == $row2->id_orangtua) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_lengkap?></td>
									<td><?=$row->hubungan_orangtua?></td>
									<td><?=$row->nama_kelahiran?></td>
									<td><?=tanggal($row->tanggal_lahir)?></td>
									<td><?=$row->jenis_kelamin?></td>
									<td><?=$row->nama_tingkatpendidikan?></td>
									<td><?=$row->pekerjaan?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_orangtua('<?=$row->id_orangtua?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_orangtua('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_orangtua('<?=$row->id_orangtua?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_orangtua('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_orangtua('<?=$row->id_orangtua?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_orangtua('<?=$row->id_orangtua?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_orangtua/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="orangtua-<?=$k?>_<?=$row->id_orangtua?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_orangtua['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_lengkap = convert_data($master_orang,'id_orang',$row->id_orang,'nama_lengkap');
								$row->id_tempat_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'id_tempat_lahir');
								$row->nama_kelahiran = convert_data($ref_kelahiran,'kode_kelahiran',$row->id_tempat_lahir,'nama_kelahiran');
								$row->tanggal_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'tanggal_lahir');
								$row->jenis_kelamin = convert_data($master_orang,'id_orang',$row->id_orang,'jenis_kelamin');
								$row->id_tingkat_pendidikan = convert_data($master_orang,'id_orang',$row->id_orang,'id_tingkat_pendidikan');
								$row->nama_tingkatpendidikan = convert_data($ref_tingkatpendidikan,'kode_tingkatpendidikan',$row->id_tingkat_pendidikan,'nama_tingkatpendidikan');
								$row->pekerjaan = convert_data($master_orang,'id_orang',$row->id_orang,'pekerjaan');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_lengkap?></td>
									<td><?=$row->hubungan_orangtua?></td>
									<td><?=$row->nama_kelahiran?></td>
									<td><?=tanggal($row->tanggal_lahir)?></td>
									<td><?=$row->jenis_kelamin?></td>
									<td><?=$row->nama_tingkatpendidikan?></td>
									<td><?=$row->pekerjaan?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_orangtua('<?=$row->id_update?>_<?=$row->id_orangtua?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_orangtua('<?=$row->id_update?>_<?=$row->id_orangtua?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_orangtua('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_orangtua/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="orangtua-<?=$k?>_<?=$row->id_update?>_<?=$row->id_orangtua?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<!-- add new sidebar starts -->
	<div class="add-new-data-sidebar">
		<div class="overlay-bg orangtua" onclick="close_sidebar('orangtua')"></div>
		<div class="add-new-data orangtua fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('orangtua')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="orangtua-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data orangtua" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-orangtua" onsubmit="submit_orangtua()" enctype="multipart/form-data">
				<input type="hidden" id="orangtua-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="orangtua-id_update" value="" />
				<input type="hidden" name="id_orangtua" id="orangtua-id_orangtua" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Orang Tua</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('orangtua')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_orangtua" id="orangtua-kode_bkn_orangtua" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Hubungan dengan Orang Tua</label>
								<select class="form-control" id="orangtua-hubungan_orangtua" name="hubungan_orangtua" required="">
									<option value="">-- PILIH --</option>
									<option value="Ayah Kandung">Ayah Kandung</option>
									<option value="Ibu Kandung">Ibu Kandung</option>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nama Orang Tua</label>
								<select class="form-control select2_wizard" id="orangtua-id_orang" name="id_orang" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($master_orang as $row): ?>
										<option value="<?=$row->id_orang?>"><?=$row->nama_lengkap?><?=($row->no_ktp)?" (KTP:{$row->no_ktp})":""?><?=($row->no_paspor)?" (PASPOR:{$row->no_paspor})":""?><?=($row->no_sim)?" (SIM:{$row->no_sim})":""?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="orangtua-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="orangtua-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="orangtua-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="orangtua-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="orangtua-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="orangtua-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="orangtua-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#orangtua-input-verifikasi').val('')">Simpan</button>
						<button id="orangtua-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#orangtua-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="orangtua-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('orangtua')">Batal</button>
						<button id="orangtua-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#orangtua-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_orangtua() {
		var formData = new FormData($('#form-orangtua')[0]);
        var _csrfName = $('input#orangtua-csrf').attr('name');
        var _csrfValue = $('input#orangtua-csrf').val();
        var file_data = $('#orangtua-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/orangtua")?>",
			type:'post',
			data: formData,
			dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
			success    : function(data){
				console.log(data);

				swal("Data berhasil diupdate", data.error, {
					icon: "success",
				});

				setTimeout(function() {
					get_riwayat('keluarga');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('keluarga');
				}, 500);
			}
		});
	}
	function edit_orangtua(id)
	{
        //alert(id);
        open_fileframe('orangtua',$("#orangtua-berkas_"+id).html())
        $("#orangtua-filelink").html("");
        $("#orangtua-filelink").html($("#orangtua-berkas_"+id).html());
        $("#orangtua-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_orangtua/'+$("#orangtua-berkas_"+id).html());

        $("#orangtua-id_update").val($("#orangtua-id_update_"+id).html());
        $("#orangtua-id_orangtua").val($("#orangtua-id_orangtua_"+id).html());
        //ambil data
        var kode_bkn_orangtua = $("#orangtua-kode_bkn_orangtua_"+id).html();

        var hubungan_orangtua = $("#orangtua-hubungan_orangtua_"+id).html();
        var id_orang = $("#orangtua-id_orang_"+id).html();

        //set data
        $("#orangtua-kode_bkn_orangtua").val(kode_bkn_orangtua);

        $("#orangtua-hubungan_orangtua").val(hubungan_orangtua).trigger("change");
        $("#orangtua-id_orang").val(id_orang).trigger("change");

        $(".add-new-data.orangtua").addClass("show");
        $(".overlay-bg.orangtua").addClass("show");

        $("#orangtua-btn-simpan").removeClass("hidden");
        $("#orangtua-btn-batal").removeClass("hidden");

        $("#orangtua-input-alasan").addClass("hidden");
        $("#orangtua-btn-verifikasi").addClass("hidden");
        $("#orangtua-btn-tolak").addClass("hidden");
    }
	function verifikasi_orangtua(id)
	{
        //alert(id);
        open_fileframe('orangtua',$("#orangtua-berkas_"+id).html())
        $("#orangtua-filelink").html("");
        $("#orangtua-filelink").html($("#orangtua-berkas_"+id).html());
        $("#orangtua-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_orangtua/'+$("#orangtua-berkas_"+id).html());

        $("#orangtua-id_update").val($("#orangtua-id_update_"+id).html());
        $("#orangtua-id_orangtua").val($("#orangtua-id_orangtua_"+id).html());
        //ambil data
        var kode_bkn_orangtua = $("#orangtua-kode_bkn_orangtua_"+id).html();

        var hubungan_orangtua = $("#orangtua-hubungan_orangtua_"+id).html();
        var id_orang = $("#orangtua-id_orang_"+id).html();

        //set data
        $("#orangtua-kode_bkn_orangtua").val(kode_bkn_orangtua);

        $("#orangtua-hubungan_orangtua").val(hubungan_orangtua).trigger("change");
        $("#orangtua-id_orang").val(id_orang).trigger("change");

        $(".add-new-data.orangtua").addClass("show");
        $(".overlay-bg.orangtua").addClass("show");

        $("#orangtua-btn-simpan").addClass("hidden");
        $("#orangtua-btn-batal").addClass("hidden");

        $("#orangtua-input-alasan").removeClass("hidden");
        $("#orangtua-btn-verifikasi").removeClass("hidden");
        $("#orangtua-btn-tolak").removeClass("hidden");
    }
    function hapus_orangtua(id)
    {
        //alert(id);
        swal({
        	title: "Hapus data?",
          //icon: "info",
          buttons: true,
          dangerMode: false,
      })
        .then((isConfirm) => {
        	if (isConfirm) {

        		block_ui("body");
        		$.ajax({
        			url :"<?php echo base_url("simpeg/delete_riwayat/orangtua")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#orangtua-id_pegawai_"+id).html(),
        				nip_pegawai:$("#orangtua-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('keluarga');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('keluarga');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_orangtua(id)
    {
        //alert(id);
        swal({
        	title: "Hapus data?",
          //icon: "info",
          buttons: true,
          dangerMode: false,
      })
        .then((isConfirm) => {
        	if (isConfirm) {

        		block_ui("body");
        		$.ajax({
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/orangtua")?>",
        			type:'post',
        			data:{
        				id:id,
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('keluarga');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('keluarga');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_orangtua(id)
    {
        //alert(id);
        swal({
        	title: "Batalkan Pembaruan?",
          //icon: "info",
          buttons: true,
          dangerMode: false,
      })
        .then((isConfirm) => {
        	if (isConfirm) {

        		block_ui("body");
        		$.ajax({
        			url :"<?php echo base_url("simpeg/cancel_riwayat/orangtua")?>",
        			type:'post',
        			data:{
        				id:id,
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('keluarga');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('keluarga');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_orangtua()
    {
    	$("#orangtua-fileframe").attr("src","");
        $("#orangtua-filelink").html("");

    	$("#orangtua-id_update").val("");
    	$("#orangtua-id_orangtua").val("");
    	$("#orangtua-kode_bkn_orangtua").val("");

        $("#orangtua-hubungan_orangtua").val("").trigger("change");
        $("#orangtua-id_orang").val("").trigger("change");

    	$(".add-new-data.orangtua").addClass("show");
    	$(".overlay-bg.orangtua").addClass("show");

        $("#orangtua-btn-simpan").removeClass("hidden");
        $("#orangtua-btn-batal").removeClass("hidden");

        $("#orangtua-input-alasan").addClass("hidden");
        $("#orangtua-btn-verifikasi").addClass("hidden");
        $("#orangtua-btn-tolak").addClass("hidden");
    }
</script>


<section class="data-list-view-header">
	<!-- RW pernikahan -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Pernikahan<button type="button" onclick="tambah_pernikahan();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Hubungan</th>
								<th>Suami/Istri ke- <span class="fa fa-sort-asc"></span></th>
								<th>Tempat Lahir</th>
								<th>Tanggal Lahir</th>
								<th>Jenis Kelamin</th>
								<th>Pendidikan</th>
								<th>Pekerjaan</th>
								<th>Status PNS</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pernikahan as $row1): $row = $row1; ?>
								<?php foreach ($dump_pernikahan['update'] as $row2): ?>
									<?php
									if($row1->id_pernikahan == $row2->id_pernikahan) {
										$row = $row2;
										$row->nama_lengkap = convert_data($master_orang,'id_orang',$row->id_orang,'nama_lengkap');
										$row->id_tempat_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'id_tempat_lahir');
										$row->nama_kelahiran = convert_data($ref_kelahiran,'kode_kelahiran',$row->id_tempat_lahir,'nama_kelahiran');
										$row->tanggal_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'tanggal_lahir');
										$row->jenis_kelamin = convert_data($master_orang,'id_orang',$row->id_orang,'jenis_kelamin');
										$row->id_tingkat_pendidikan = convert_data($master_orang,'id_orang',$row->id_orang,'id_tingkat_pendidikan');
										$row->nama_tingkatpendidikan = convert_data($ref_tingkatpendidikan,'kode_tingkatpendidikan',$row->id_tingkat_pendidikan,'nama_tingkatpendidikan');
										$row->pekerjaan = convert_data($master_orang,'id_orang',$row->id_orang,'pekerjaan');
										$row->id_orang = convert_data($master_orang,'id_orang',$row->id_orang,'id_orang');
										$row->status_cpns_pns = convert_data($master_pegawai,'id_orang',$row->id_orang,'status_cpns_pns');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_pernikahan['delete'] as $row2): ?>
									<?php
									if($row1->id_pernikahan == $row2->id_pernikahan) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_lengkap?></td>
									<td><?=$row->hubungan_pernikahan?></td>
									<td><?=$row->posisi?></td>
									<td><?=$row->nama_kelahiran?></td>
									<td><?=tanggal($row->tanggal_lahir)?></td>
									<td><?=$row->jenis_kelamin?></td>
									<td><?=$row->nama_tingkatpendidikan?></td>
									<td><?=$row->pekerjaan?></td>
									<td><?=($row->status_cpns_pns)? "Aktif" : "Tidak Aktif"?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_pernikahan('<?=$row->id_pernikahan?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_pernikahan('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_pernikahan('<?=$row->id_pernikahan?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_pernikahan('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_pernikahan('<?=$row->id_pernikahan?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_pernikahan('<?=$row->id_pernikahan?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_pernikahan/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="pernikahan-<?=$k?>_<?=$row->id_pernikahan?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_pernikahan['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_lengkap = convert_data($master_orang,'id_orang',$row->id_orang,'nama_lengkap');
								$row->id_tempat_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'id_tempat_lahir');
								$row->nama_kelahiran = convert_data($ref_kelahiran,'kode_kelahiran',$row->id_tempat_lahir,'nama_kelahiran');
								$row->tanggal_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'tanggal_lahir');
								$row->jenis_kelamin = convert_data($master_orang,'id_orang',$row->id_orang,'jenis_kelamin');
								$row->id_tingkat_pendidikan = convert_data($master_orang,'id_orang',$row->id_orang,'id_tingkat_pendidikan');
								$row->nama_tingkatpendidikan = convert_data($ref_tingkatpendidikan,'kode_tingkatpendidikan',$row->id_tingkat_pendidikan,'nama_tingkatpendidikan');
								$row->pekerjaan = convert_data($master_orang,'id_orang',$row->id_orang,'pekerjaan');
								$row->id_orang = convert_data($master_orang,'id_orang',$row->id_orang,'id_orang');
								$row->status_cpns_pns = convert_data($master_pegawai,'id_orang',$row->id_orang,'status_cpns_pns');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_lengkap?></td>
									<td><?=$row->hubungan_pernikahan?></td>
									<td><?=$row->posisi?></td>
									<td><?=$row->nama_kelahiran?></td>
									<td><?=tanggal($row->tanggal_lahir)?></td>
									<td><?=$row->jenis_kelamin?></td>
									<td><?=$row->nama_tingkatpendidikan?></td>
									<td><?=$row->pekerjaan?></td>
									<td><?=($row->status_cpns_pns)? "Aktif" : "Tidak Aktif"?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_pernikahan('<?=$row->id_update?>_<?=$row->id_pernikahan?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_pernikahan('<?=$row->id_update?>_<?=$row->id_pernikahan?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_pernikahan('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_pernikahan/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="pernikahan-<?=$k?>_<?=$row->id_update?>_<?=$row->id_pernikahan?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<!-- add new sidebar starts -->
	<div class="add-new-data-sidebar">
		<div class="overlay-bg pernikahan" onclick="close_sidebar('pernikahan')"></div>
		<div class="add-new-data pernikahan fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('pernikahan')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="pernikahan-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data pernikahan" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-pernikahan" onsubmit="submit_pernikahan()" enctype="multipart/form-data">
				<input type="hidden" id="pernikahan-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="pernikahan-id_update" value="" />
				<input type="hidden" name="id_pernikahan" id="pernikahan-id_pernikahan" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Pernikahan</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('pernikahan')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_pernikahan" id="pernikahan-kode_bkn_pernikahan" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Hubungan Pernikahan</label>
								<select class="form-control" id="pernikahan-hubungan_pernikahan" name="hubungan_pernikahan" required="">
									<option value="">-- PILIH --</option>
									<option value="Menikah">Menikah</option>
									<option value="Bercerai">Bercerai</option>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nama Suami/Istri</label>
								<select class="form-control select2_wizard" id="pernikahan-id_orang" name="id_orang" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($master_orang as $row): ?>
										<option value="<?=$row->id_orang?>"><?=$row->nama_lengkap?><?=($row->no_ktp)?" (KTP:{$row->no_ktp})":""?><?=($row->no_paspor)?" (PASPOR:{$row->no_paspor})":""?><?=($row->no_sim)?" (SIM:{$row->no_sim})":""?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Suami/Istri ke-</label>
								<input type="number" name="posisi" id="pernikahan-posisi" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="pernikahan-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="pernikahan-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="pernikahan-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="pernikahan-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="pernikahan-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="pernikahan-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="pernikahan-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#pernikahan-input-verifikasi').val('')">Simpan</button>
						<button id="pernikahan-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#pernikahan-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="pernikahan-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('pernikahan')">Batal</button>
						<button id="pernikahan-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#pernikahan-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_pernikahan() {
		var formData = new FormData($('#form-pernikahan')[0]);
        var _csrfName = $('input#pernikahan-csrf').attr('name');
        var _csrfValue = $('input#pernikahan-csrf').val();
        var file_data = $('#pernikahan-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/pernikahan")?>",
			type:'post',
			data: formData,
			dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
			success    : function(data){
				console.log(data);

				swal("Data berhasil diupdate", data.error, {
					icon: "success",
				});

				setTimeout(function() {
					get_riwayat('keluarga');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('keluarga');
				}, 500);
			}
		});
	}
	function edit_pernikahan(id)
	{
        //alert(id);
        open_fileframe('pernikahan',$("#pernikahan-berkas_"+id).html())
        $("#pernikahan-filelink").html("");
        $("#pernikahan-filelink").html($("#pernikahan-berkas_"+id).html());
        $("#pernikahan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_pernikahan/'+$("#pernikahan-berkas_"+id).html());

        $("#pernikahan-id_update").val($("#pernikahan-id_update_"+id).html());
        $("#pernikahan-id_pernikahan").val($("#pernikahan-id_pernikahan_"+id).html());
        //ambil data
        var kode_bkn_pernikahan = $("#pernikahan-kode_bkn_pernikahan_"+id).html();

        var hubungan_pernikahan = $("#pernikahan-hubungan_pernikahan_"+id).html();
        var id_orang = $("#pernikahan-id_orang_"+id).html();
        var posisi = $("#pernikahan-posisi_"+id).html();

        //set data
        $("#pernikahan-kode_bkn_pernikahan").val(kode_bkn_pernikahan);

        $("#pernikahan-hubungan_pernikahan").val(hubungan_pernikahan).trigger("change");
        $("#pernikahan-id_orang").val(id_orang).trigger("change");
        $("#pernikahan-posisi").val(posisi);

        $(".add-new-data.pernikahan").addClass("show");
        $(".overlay-bg.pernikahan").addClass("show");

        $("#pernikahan-btn-simpan").removeClass("hidden");
        $("#pernikahan-btn-batal").removeClass("hidden");

        $("#pernikahan-input-alasan").addClass("hidden");
        $("#pernikahan-btn-verifikasi").addClass("hidden");
        $("#pernikahan-btn-tolak").addClass("hidden");
    }
	function verifikasi_pernikahan(id)
	{
        //alert(id);
        open_fileframe('pernikahan',$("#pernikahan-berkas_"+id).html())
        $("#pernikahan-filelink").html("");
        $("#pernikahan-filelink").html($("#pernikahan-berkas_"+id).html());
        $("#pernikahan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_pernikahan/'+$("#pernikahan-berkas_"+id).html());

        $("#pernikahan-id_update").val($("#pernikahan-id_update_"+id).html());
        $("#pernikahan-id_pernikahan").val($("#pernikahan-id_pernikahan_"+id).html());
        //ambil data
        var kode_bkn_pernikahan = $("#pernikahan-kode_bkn_pernikahan_"+id).html();

        var hubungan_pernikahan = $("#pernikahan-hubungan_pernikahan_"+id).html();
        var id_orang = $("#pernikahan-id_orang_"+id).html();
        var posisi = $("#pernikahan-posisi_"+id).html();

        //set data
        $("#pernikahan-kode_bkn_pernikahan").val(kode_bkn_pernikahan);

        $("#pernikahan-hubungan_pernikahan").val(hubungan_pernikahan).trigger("change");
        $("#pernikahan-id_orang").val(id_orang).trigger("change");
        $("#pernikahan-posisi").val(posisi);

        $(".add-new-data.pernikahan").addClass("show");
        $(".overlay-bg.pernikahan").addClass("show");

        $("#pernikahan-btn-simpan").addClass("hidden");
        $("#pernikahan-btn-batal").addClass("hidden");

        $("#pernikahan-input-alasan").removeClass("hidden");
        $("#pernikahan-btn-verifikasi").removeClass("hidden");
        $("#pernikahan-btn-tolak").removeClass("hidden");
    }
    function hapus_pernikahan(id)
    {
        //alert(id);
        swal({
        	title: "Hapus data?",
          //icon: "info",
          buttons: true,
          dangerMode: false,
      })
        .then((isConfirm) => {
        	if (isConfirm) {

        		block_ui("body");
        		$.ajax({
        			url :"<?php echo base_url("simpeg/delete_riwayat/pernikahan")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#pernikahan-id_pegawai_"+id).html(),
        				nip_pegawai:$("#pernikahan-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('keluarga');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('keluarga');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_pernikahan(id)
    {
        //alert(id);
        swal({
        	title: "Hapus data?",
          //icon: "info",
          buttons: true,
          dangerMode: false,
      })
        .then((isConfirm) => {
        	if (isConfirm) {

        		block_ui("body");
        		$.ajax({
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/pernikahan")?>",
        			type:'post',
        			data:{
        				id:id,
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('keluarga');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('keluarga');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_pernikahan(id)
    {
        //alert(id);
        swal({
        	title: "Batalkan Pembaruan?",
          //icon: "info",
          buttons: true,
          dangerMode: false,
      })
        .then((isConfirm) => {
        	if (isConfirm) {

        		block_ui("body");
        		$.ajax({
        			url :"<?php echo base_url("simpeg/cancel_riwayat/pernikahan")?>",
        			type:'post',
        			data:{
        				id:id,
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('keluarga');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('keluarga');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_pernikahan()
    {
    	$("#pernikahan-fileframe").attr("src","");
        $("#pernikahan-filelink").html("");

    	$("#pernikahan-id_update").val("");
    	$("#pernikahan-id_pernikahan").val("");
    	$("#pernikahan-kode_bkn_pernikahan").val("");

        $("#pernikahan-hubungan_pernikahan").val("").trigger("change");
        $("#pernikahan-id_orang").val("").trigger("change");
        $("#pernikahan-posisi").val("");

    	$(".add-new-data.pernikahan").addClass("show");
    	$(".overlay-bg.pernikahan").addClass("show");

        $("#pernikahan-btn-simpan").removeClass("hidden");
        $("#pernikahan-btn-batal").removeClass("hidden");

        $("#pernikahan-input-alasan").addClass("hidden");
        $("#pernikahan-btn-verifikasi").addClass("hidden");
        $("#pernikahan-btn-tolak").addClass("hidden");
    }
</script>


<section class="data-list-view-header">
	<!-- RW anak -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Anak<button type="button" onclick="tambah_anak();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Hubungan</th>
								<th>Anak ke- <span class="fa fa-sort-asc"></span></th>
								<th>Tempat Lahir</th>
								<th>Tanggal Lahir</th>
								<th>Jenis Kelamin</th>
								<th>Pendidikan</th>
								<th>Pekerjaan</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($anak as $row1): $row = $row1; ?>
								<?php foreach ($dump_anak['update'] as $row2): ?>
									<?php
									if($row1->id_anak == $row2->id_anak) {
										$row = $row2;
										$row->nama_lengkap = convert_data($master_orang,'id_orang',$row->id_orang,'nama_lengkap');
										$row->id_tempat_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'id_tempat_lahir');
										$row->nama_kelahiran = convert_data($ref_kelahiran,'kode_kelahiran',$row->id_tempat_lahir,'nama_kelahiran');
										$row->tanggal_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'tanggal_lahir');
										$row->jenis_kelamin = convert_data($master_orang,'id_orang',$row->id_orang,'jenis_kelamin');
										$row->id_tingkat_pendidikan = convert_data($master_orang,'id_orang',$row->id_orang,'id_tingkat_pendidikan');
										$row->nama_tingkatpendidikan = convert_data($ref_tingkatpendidikan,'kode_tingkatpendidikan',$row->id_tingkat_pendidikan,'nama_tingkatpendidikan');
										$row->pekerjaan = convert_data($master_orang,'id_orang',$row->id_orang,'pekerjaan');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_anak['delete'] as $row2): ?>
									<?php
									if($row1->id_anak == $row2->id_anak) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_lengkap?></td>
									<td><?=$row->hubungan_anak?></td>
									<td><?=$row->posisi?></td>
									<td><?=$row->nama_kelahiran?></td>
									<td><?=tanggal($row->tanggal_lahir)?></td>
									<td><?=$row->jenis_kelamin?></td>
									<td><?=$row->nama_tingkatpendidikan?></td>
									<td><?=$row->pekerjaan?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_anak('<?=$row->id_anak?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_anak('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_anak('<?=$row->id_anak?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_anak('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_anak('<?=$row->id_anak?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_anak('<?=$row->id_anak?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_anak/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="anak-<?=$k?>_<?=$row->id_anak?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_anak['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_lengkap = convert_data($master_orang,'id_orang',$row->id_orang,'nama_lengkap');
								$row->id_tempat_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'id_tempat_lahir');
								$row->nama_kelahiran = convert_data($ref_kelahiran,'kode_kelahiran',$row->id_tempat_lahir,'nama_kelahiran');
								$row->tanggal_lahir = convert_data($master_orang,'id_orang',$row->id_orang,'tanggal_lahir');
								$row->jenis_kelamin = convert_data($master_orang,'id_orang',$row->id_orang,'jenis_kelamin');
								$row->id_tingkat_pendidikan = convert_data($master_orang,'id_orang',$row->id_orang,'id_tingkat_pendidikan');
								$row->nama_tingkatpendidikan = convert_data($ref_tingkatpendidikan,'kode_tingkatpendidikan',$row->id_tingkat_pendidikan,'nama_tingkatpendidikan');
								$row->pekerjaan = convert_data($master_orang,'id_orang',$row->id_orang,'pekerjaan');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_lengkap?></td>
									<td><?=$row->hubungan_anak?></td>
									<td><?=$row->posisi?></td>
									<td><?=$row->nama_kelahiran?></td>
									<td><?=tanggal($row->tanggal_lahir)?></td>
									<td><?=$row->jenis_kelamin?></td>
									<td><?=$row->nama_tingkatpendidikan?></td>
									<td><?=$row->pekerjaan?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_anak('<?=$row->id_update?>_<?=$row->id_anak?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_anak('<?=$row->id_update?>_<?=$row->id_anak?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_anak('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_anak/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="anak-<?=$k?>_<?=$row->id_update?>_<?=$row->id_anak?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<!-- add new sidebar starts -->
	<div class="add-new-data-sidebar">
		<div class="overlay-bg anak" onclick="close_sidebar('anak')"></div>
		<div class="add-new-data anak fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('anak')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="anak-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data anak" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-anak" onsubmit="submit_anak()" enctype="multipart/form-data">
				<input type="hidden" id="anak-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="anak-id_update" value="" />
				<input type="hidden" name="id_anak" id="anak-id_anak" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat anak</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('anak')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_anak" id="anak-kode_bkn_anak" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Hubungan Anak</label>
								<select class="form-control" id="anak-hubungan_anak" name="hubungan_anak" required="">
									<option value="">-- PILIH --</option>
									<option value="Anak Kandung">Anak Kandung</option>
									<option value="Anak Tiri">Anak Tiri</option>
									<option value="Anak Angkat">Anak Angkat</option>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nama Anak</label>
								<select class="form-control select2_wizard" id="anak-id_orang" name="id_orang" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($master_orang as $row): ?>
										<option value="<?=$row->id_orang?>"><?=$row->nama_lengkap?><?=($row->no_ktp)?" (KTP:{$row->no_ktp})":""?><?=($row->no_paspor)?" (PASPOR:{$row->no_paspor})":""?><?=($row->no_sim)?" (SIM:{$row->no_sim})":""?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Anak ke-</label>
								<input type="number" name="posisi" id="anak-posisi" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="anak-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="anak-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="anak-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="anak-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="anak-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="anak-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="anak-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#anak-input-verifikasi').val('')">Simpan</button>
						<button id="anak-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#anak-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="anak-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('anak')">Batal</button>
						<button id="anak-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#anak-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_anak() {
		var formData = new FormData($('#form-anak')[0]);
        var _csrfName = $('input#anak-csrf').attr('name');
        var _csrfValue = $('input#anak-csrf').val();
        var file_data = $('#anak-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/anak")?>",
			type:'post',
			data: formData,
			dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
			success    : function(data){
				console.log(data);

				swal("Data berhasil diupdate", data.error, {
					icon: "success",
				});

				setTimeout(function() {
					get_riwayat('keluarga');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('keluarga');
				}, 500);
			}
		});
	}
	function edit_anak(id)
	{
        //alert(id);
        open_fileframe('anak',$("#anak-berkas_"+id).html())
        $("#anak-filelink").html("");
        $("#anak-filelink").html($("#anak-berkas_"+id).html());
        $("#anak-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_anak/'+$("#anak-berkas_"+id).html());

        $("#anak-id_update").val($("#anak-id_update_"+id).html());
        $("#anak-id_anak").val($("#anak-id_anak_"+id).html());
        //ambil data
        var kode_bkn_anak = $("#anak-kode_bkn_anak_"+id).html();

        var hubungan_anak = $("#anak-hubungan_anak_"+id).html();
        var id_orang = $("#anak-id_orang_"+id).html();
        var posisi = $("#anak-posisi_"+id).html();

        //set data
        $("#anak-kode_bkn_anak").val(kode_bkn_anak);

        $("#anak-hubungan_anak").val(hubungan_anak).trigger("change");
        $("#anak-id_orang").val(id_orang).trigger("change");
        $("#anak-posisi").val(posisi);

        $(".add-new-data.anak").addClass("show");
        $(".overlay-bg.anak").addClass("show");

        $("#anak-btn-simpan").removeClass("hidden");
        $("#anak-btn-batal").removeClass("hidden");

        $("#anak-input-alasan").addClass("hidden");
        $("#anak-btn-verifikasi").addClass("hidden");
        $("#anak-btn-tolak").addClass("hidden");
    }
	function verifikasi_anak(id)
	{
        //alert(id);
        open_fileframe('anak',$("#anak-berkas_"+id).html())
        $("#anak-filelink").html("");
        $("#anak-filelink").html($("#anak-berkas_"+id).html());
        $("#anak-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_anak/'+$("#anak-berkas_"+id).html());

        $("#anak-id_update").val($("#anak-id_update_"+id).html());
        $("#anak-id_anak").val($("#anak-id_anak_"+id).html());
        //ambil data
        var kode_bkn_anak = $("#anak-kode_bkn_anak_"+id).html();

        var hubungan_anak = $("#anak-hubungan_anak_"+id).html();
        var id_orang = $("#anak-id_orang_"+id).html();
        var posisi = $("#anak-posisi_"+id).html();

        //set data
        $("#anak-kode_bkn_anak").val(kode_bkn_anak);

        $("#anak-hubungan_anak").val(hubungan_anak).trigger("change");
        $("#anak-id_orang").val(id_orang).trigger("change");
        $("#anak-posisi").val(posisi);

        $(".add-new-data.anak").addClass("show");
        $(".overlay-bg.anak").addClass("show");

        $("#anak-btn-simpan").addClass("hidden");
        $("#anak-btn-batal").addClass("hidden");

        $("#anak-input-alasan").removeClass("hidden");
        $("#anak-btn-verifikasi").removeClass("hidden");
        $("#anak-btn-tolak").removeClass("hidden");
    }
    function hapus_anak(id)
    {
        //alert(id);
        swal({
        	title: "Hapus data?",
          //icon: "info",
          buttons: true,
          dangerMode: false,
      })
        .then((isConfirm) => {
        	if (isConfirm) {

        		block_ui("body");
        		$.ajax({
        			url :"<?php echo base_url("simpeg/delete_riwayat/anak")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#anak-id_pegawai_"+id).html(),
        				nip_pegawai:$("#anak-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('keluarga');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('keluarga');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_anak(id)
    {
        //alert(id);
        swal({
        	title: "Hapus data?",
          //icon: "info",
          buttons: true,
          dangerMode: false,
      })
        .then((isConfirm) => {
        	if (isConfirm) {

        		block_ui("body");
        		$.ajax({
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/anak")?>",
        			type:'post',
        			data:{
        				id:id,
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('keluarga');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('keluarga');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_anak(id)
    {
        //alert(id);
        swal({
        	title: "Batalkan Pembaruan?",
          //icon: "info",
          buttons: true,
          dangerMode: false,
      })
        .then((isConfirm) => {
        	if (isConfirm) {

        		block_ui("body");
        		$.ajax({
        			url :"<?php echo base_url("simpeg/cancel_riwayat/anak")?>",
        			type:'post',
        			data:{
        				id:id,
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('keluarga');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('keluarga');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_anak()
    {
    	$("#anak-fileframe").attr("src","");
        $("#anak-filelink").html("");

    	$("#anak-id_update").val("");
    	$("#anak-id_anak").val("");
    	$("#anak-kode_bkn_anak").val("");

        $("#anak-hubungan_anak").val("").trigger("change");
        $("#anak-id_orang").val("").trigger("change");
        $("#anak-posisi").val("");

    	$(".add-new-data.anak").addClass("show");
    	$(".overlay-bg.anak").addClass("show");

        $("#anak-btn-simpan").removeClass("hidden");
        $("#anak-btn-batal").removeClass("hidden");

        $("#anak-input-alasan").addClass("hidden");
        $("#anak-btn-verifikasi").addClass("hidden");
        $("#anak-btn-tolak").addClass("hidden");
    }
</script>

