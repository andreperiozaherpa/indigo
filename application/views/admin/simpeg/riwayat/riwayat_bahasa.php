<section class="data-list-view-header">
	<!-- RW bahasa daerah -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Bahasa Daerah <button type="button" onclick="tambah_bahasa('daerah');" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Bahasa <span class="fa fa-sort-asc"></span></th>
								<th>Kemampuan</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($bahasa as $row1): $row = $row1; ?>
								<?php foreach ($dump_bahasa['update'] as $row2): ?>
									<?php
									if($row1->id_bahasa == $row2->id_bahasa) {
										$row = $row2;
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_bahasa['delete'] as $row2): ?>
									<?php
									if($row1->id_bahasa == $row2->id_bahasa) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<?php if ($row->jenis_bahasa == "daerah"): ?>
									<tr class="<?=get_status_riwayat_simpeg($row)?>">
										<td><?=$row->bahasa?></td>
										<td><?=$row->kemampuan?></td>
										<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
										<td>
											<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
											<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
	                                            <i class="feather icon-info align-middle"></i>
	                                            <span><?=$row->alasan?></span>
	                                        </div>
											<?php endif ?>

											<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
											<button type="button" onclick="verifikasi_bahasa('<?=$row->id_bahasa?>','daerah');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
											<?php endif ?>

											<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
											<button type="button" onclick="verifikasi_hapus_bahasa('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
											<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
	                                            <i class="feather icon-info align-middle"></i>
	                                            <span><?=$row->alasan?></span>
	                                        </div>
											<?php endif ?>

											<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
											<button type="button" onclick="edit_bahasa('<?=$row->id_bahasa?>','daerah');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
											<?php endif ?>

											<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
											<button type="button" onclick="batal_bahasa('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
											<?php endif ?>

											<?php if (@!$row->id_update): ?>	
											<button type="button" onclick="hapus_bahasa('<?=$row->id_bahasa?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
											<?php endif ?>
											<?php if ($row->status != "Y"): ?>	
												<!-- <button type="button" onclick="aktif_bahasa('<?=$row->id_bahasa?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
											<?php endif ?>

											<?php if (isset($row->berkas)): ?>	
											<a href="<?=base_url()?>data/simpeg/riwayat_bahasa/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
											<?php endif ?>
										</td>
									</tr>
									<?php foreach ($row as $k => $v): ?>
										<var class="hidden" id="bahasa-<?=$k?>_<?=$row->id_bahasa?>"><?=$v?></var>
									<?php endforeach ?>
								<?php endif ?>
							<?php endforeach ?>
							<?php foreach ($dump_bahasa['insert'] as $row1): $row = $row1; ?>
								<?php if ($row->jenis_bahasa == "daerah"): ?>
									<tr class="<?=get_status_riwayat_simpeg($row)?>">
										<td><?=$row->bahasa?></td>
										<td><?=$row->kemampuan?></td>
										<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
										<td>
											<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
											<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
	                                            <i class="feather icon-info align-middle"></i>
	                                            <span><?=$row->alasan?></span>
	                                        </div>
											<?php endif ?>

											<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
											<button type="button" onclick="verifikasi_bahasa('<?=$row->id_update?>_<?=$row->id_bahasa?>','daerah');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
											<?php endif ?>

											<?php if (@$row->status_verifikasi != "Diterima"): ?>	
											<button type="button" onclick="edit_bahasa('<?=$row->id_update?>_<?=$row->id_bahasa?>','daerah');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
											<?php endif ?>

											<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
											<button type="button" onclick="batal_bahasa('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
											<?php endif ?>

											<?php if (isset($row->berkas)): ?>	
											<a href="<?=base_url()?>data/simpeg/riwayat_bahasa/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
											<?php endif ?>
										</td>
									</tr>
									<?php foreach ($row as $k => $v): ?>
										<var class="hidden" id="bahasa-<?=$k?>_<?=$row->id_update?>_<?=$row->id_bahasa?>"><?=$v?></var>
									<?php endforeach ?>
								<?php endif ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- RW bahasa asing -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Bahasa Asing <button type="button" onclick="tambah_bahasa('asing');" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Bahasa <span class="fa fa-sort-asc"></span></th>
								<th>Kemampuan</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($bahasa as $row1): $row = $row1; ?>
								<?php foreach ($dump_bahasa['update'] as $row2): ?>
									<?php
									if($row1->id_bahasa == $row2->id_bahasa) {
										$row = $row2;
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_bahasa['delete'] as $row2): ?>
									<?php
									if($row1->id_bahasa == $row2->id_bahasa) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<?php if ($row->jenis_bahasa == "asing"): ?>
									<tr class="<?=get_status_riwayat_simpeg($row)?>">
										<td><?=$row->bahasa?></td>
										<td><?=$row->kemampuan?></td>
										<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
										<td>
											<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
											<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
	                                            <i class="feather icon-info align-middle"></i>
	                                            <span><?=$row->alasan?></span>
	                                        </div>
											<?php endif ?>

											<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
											<button type="button" onclick="verifikasi_bahasa('<?=$row->id_bahasa?>','asing');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
											<?php endif ?>

											<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
											<button type="button" onclick="verifikasi_hapus_bahasa('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
											<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
	                                            <i class="feather icon-info align-middle"></i>
	                                            <span><?=$row->alasan?></span>
	                                        </div>
											<?php endif ?>

											<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
											<button type="button" onclick="edit_bahasa('<?=$row->id_bahasa?>','asing');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
											<?php endif ?>

											<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
											<button type="button" onclick="batal_bahasa('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
											<?php endif ?>

											<?php if (@!$row->id_update): ?>	
											<button type="button" onclick="hapus_bahasa('<?=$row->id_bahasa?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
											<?php endif ?>
											<?php if ($row->status != "Y"): ?>	
												<!-- <button type="button" onclick="aktif_bahasa('<?=$row->id_bahasa?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
											<?php endif ?>

											<?php if (isset($row->berkas)): ?>	
											<a href="<?=base_url()?>data/simpeg/riwayat_bahasa/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
											<?php endif ?>
										</td>
									</tr>
									<?php foreach ($row as $k => $v): ?>
										<var class="hidden" id="bahasa-<?=$k?>_<?=$row->id_bahasa?>"><?=$v?></var>
									<?php endforeach ?>
								<?php endif ?>
							<?php endforeach ?>
							<?php foreach ($dump_bahasa['insert'] as $row1): $row = $row1; ?>
								<?php if ($row->jenis_bahasa == "asing"): ?>
									<tr class="<?=get_status_riwayat_simpeg($row)?>">
										<td><?=$row->bahasa?></td>
										<td><?=$row->kemampuan?></td>
										<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
										<td>
											<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
											<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
	                                            <i class="feather icon-info align-middle"></i>
	                                            <span><?=$row->alasan?></span>
	                                        </div>
											<?php endif ?>

											<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
											<button type="button" onclick="verifikasi_bahasa('<?=$row->id_update?>_<?=$row->id_bahasa?>','asing');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
											<?php endif ?>

											<?php if (@$row->status_verifikasi != "Diterima"): ?>	
											<button type="button" onclick="edit_bahasa('<?=$row->id_update?>_<?=$row->id_bahasa?>','asing');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
											<?php endif ?>

											<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
											<button type="button" onclick="batal_bahasa('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
											<?php endif ?>

											<?php if (isset($row->berkas)): ?>	
											<a href="<?=base_url()?>data/simpeg/riwayat_bahasa/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
											<?php endif ?>
										</td>
									</tr>
									<?php foreach ($row as $k => $v): ?>
										<var class="hidden" id="bahasa-<?=$k?>_<?=$row->id_update?>_<?=$row->id_bahasa?>"><?=$v?></var>
									<?php endforeach ?>
								<?php endif ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<!-- add new sidebar starts -->
	<div class="add-new-data-sidebar">
		<div class="overlay-bg bahasa" onclick="close_sidebar('bahasa')"></div>
		<div class="add-new-data bahasa fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('bahasa')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="bahasa-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data bahasa" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-bahasa" onsubmit="submit_bahasa()" enctype="multipart/form-data">
				<input type="hidden" id="bahasa-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="bahasa-id_update" value="" />
				<input type="hidden" name="id_bahasa" id="bahasa-id_bahasa" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<input type="hidden" name="jenis_bahasa" id="bahasa-jenis_bahasa" value="" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase" id="bahasa-titleform">Riwayat Bahasa</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('bahasa')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_bahasa" id="bahasa-kode_bkn_bahasa" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Bahasa</label>
								<input type="text" name="bahasa" id="bahasa-bahasa" class="form-control">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Kemampuan</label>
								<select class="form-control" id="bahasa-kemampuan" name="kemampuan" required="">
									<option value="">-- PILIH --</option>
									<option value="Dasar">Dasar</option>
									<option value="Mahir">Mahir</option>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="bahasa-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="bahasa-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="bahasa-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="bahasa-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="bahasa-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="bahasa-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="bahasa-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#bahasa-input-verifikasi').val('')">Simpan</button>
						<button id="bahasa-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#bahasa-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="bahasa-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('bahasa')">Batal</button>
						<button id="bahasa-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#bahasa-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_bahasa() {
		var formData = new FormData($('#form-bahasa')[0]);
        var _csrfName = $('input#bahasa-csrf').attr('name');
        var _csrfValue = $('input#bahasa-csrf').val();
        var file_data = $('#bahasa-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/bahasa")?>",
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
					get_riwayat('bahasa');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('bahasa');
				}, 500);
			}
		});
	}
	function edit_bahasa(id,jenis)
	{
        //alert(id);
        open_fileframe('bahasa',$("#bahasa-berkas_"+id).html())
        $("#bahasa-filelink").html("");
        $("#bahasa-filelink").html($("#bahasa-berkas_"+id).html());
        $("#bahasa-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_bahasa/'+$("#bahasa-berkas_"+id).html());

        $("#bahasa-id_update").val($("#bahasa-id_update_"+id).html());
        $("#bahasa-id_bahasa").val($("#bahasa-id_bahasa_"+id).html());
        //ambil data
        var kode_bkn_bahasa = $("#bahasa-kode_bkn_bahasa_"+id).html();

        var bahasa = $("#bahasa-bahasa_"+id).html();
        var kemampuan = $("#bahasa-kemampuan_"+id).html();
        
        var sk_nomor = $("#bahasa-sk_nomor_"+id).html();
        var sk_tanggal = $("#bahasa-sk_tanggal_"+id).html();

        //set data
        $("#bahasa-kode_bkn_bahasa").val(kode_bkn_bahasa);

        $("#bahasa-jenis_bahasa").val(jenis);

        $("#bahasa-kemampuan").val(kemampuan).trigger("change");
        $("#bahasa-bahasa").val(bahasa);

        $("#bahasa-sk_nomor").val(sk_nomor);
        $("#bahasa-sk_tanggal").val(sk_tanggal);

        $("#bahasa-titleform").text("Riwayat Bahasa "+jenis);

        $(".add-new-data.bahasa").addClass("show");
        $(".overlay-bg.bahasa").addClass("show");

        $("#bahasa-btn-simpan").removeClass("hidden");
        $("#bahasa-btn-batal").removeClass("hidden");

        $("#bahasa-input-alasan").addClass("hidden");
        $("#bahasa-btn-verifikasi").addClass("hidden");
        $("#bahasa-btn-tolak").addClass("hidden");
    }
	function verifikasi_bahasa(id,jenis)
	{
        //alert(id);
        open_fileframe('bahasa',$("#bahasa-berkas_"+id).html())
        $("#bahasa-filelink").html("");
        $("#bahasa-filelink").html($("#bahasa-berkas_"+id).html());
        $("#bahasa-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_bahasa/'+$("#bahasa-berkas_"+id).html());

        $("#bahasa-id_update").val($("#bahasa-id_update_"+id).html());
        $("#bahasa-id_bahasa").val($("#bahasa-id_bahasa_"+id).html());
        //ambil data
        var kode_bkn_bahasa = $("#bahasa-kode_bkn_bahasa_"+id).html();

        var bahasa = $("#bahasa-bahasa_"+id).html();
        var kemampuan = $("#bahasa-kemampuan_"+id).html();
        
        var sk_nomor = $("#bahasa-sk_nomor_"+id).html();
        var sk_tanggal = $("#bahasa-sk_tanggal_"+id).html();

        //set data
        $("#bahasa-kode_bkn_bahasa").val(kode_bkn_bahasa);

        $("#bahasa-jenis_bahasa").val(jenis);

        $("#bahasa-kemampuan").val(kemampuan).trigger("change");
        $("#bahasa-bahasa").val(bahasa);

        $("#bahasa-sk_nomor").val(sk_nomor);
        $("#bahasa-sk_tanggal").val(sk_tanggal);

        $("#bahasa-titleform").text("Riwayat Bahasa "+jenis);

        $(".add-new-data.bahasa").addClass("show");
        $(".overlay-bg.bahasa").addClass("show");

        $("#bahasa-btn-simpan").addClass("hidden");
        $("#bahasa-btn-batal").addClass("hidden");

        $("#bahasa-input-alasan").removeClass("hidden");
        $("#bahasa-btn-verifikasi").removeClass("hidden");
        $("#bahasa-btn-tolak").removeClass("hidden");
    }
    function hapus_bahasa(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/bahasa")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#bahasa-id_pegawai_"+id).html(),
        				nip_pegawai:$("#bahasa-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('bahasa');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('bahasa');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_bahasa(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/bahasa")?>",
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
        					get_riwayat('bahasa');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('bahasa');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_bahasa(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/bahasa")?>",
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
        					get_riwayat('bahasa');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('bahasa');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_bahasa(jenis)
    {
    	$("#bahasa-fileframe").attr("src","");
        $("#bahasa-filelink").html("");

    	$("#bahasa-id_update").val("");
    	$("#bahasa-id_bahasa").val("");
    	$("#bahasa-kode_bkn_bahasa").val("");

    	$("#bahasa-jenis_bahasa").val(jenis);

    	$("#bahasa-bahasa").val("");
    	$("#bahasa-kemampuan").val("").trigger("change");

    	$("#bahasa-sk_nomor").val("");
    	$("#bahasa-sk_tanggal").val("");

    	$("#bahasa-titleform").text("Riwayat Bahasa "+jenis);

    	$(".add-new-data.bahasa").addClass("show");
    	$(".overlay-bg.bahasa").addClass("show");

        $("#bahasa-btn-simpan").removeClass("hidden");
        $("#bahasa-btn-batal").removeClass("hidden");

        $("#bahasa-input-alasan").addClass("hidden");
        $("#bahasa-btn-verifikasi").addClass("hidden");
        $("#bahasa-btn-tolak").addClass("hidden");
    }
</script>
