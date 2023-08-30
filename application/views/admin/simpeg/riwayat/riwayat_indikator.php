<section class="data-list-view-header">
	<!-- RW indikator -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Indikator <button type="button" onclick="tambah_indikator();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Tahun <span class="fa fa-sort-desc"></span></th>
								<th>Nilai PPK PNS</th>
								<th>Assestment Kompetensi</th>
								<th>Assestment Potensi</th>
								<th>Wawancara</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($indikator as $row1): $row = $row1; ?>
								<?php foreach ($dump_indikator['update'] as $row2): ?>
									<?php
									if($row1->id_indikator == $row2->id_indikator) {
										$row = $row2;
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_indikator['delete'] as $row2): ?>
									<?php
									if($row1->id_indikator == $row2->id_indikator) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->tahun?></td>
									<td><?=$row->nilai_ppk_pns?></td>
									<td><?=$row->assestment_kompetensi?></td>
									<td><?=$row->assestment_potensi?></td>
									<td><?=$row->wawancara?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_indikator('<?=$row->id_indikator?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_indikator('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_indikator('<?=$row->id_indikator?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_indikator('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_indikator('<?=$row->id_indikator?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_indikator('<?=$row->id_indikator?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_indikator/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="indikator-<?=$k?>_<?=$row->id_indikator?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_indikator['insert'] as $row1): $row = $row1; ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->tahun?></td>
									<td><?=$row->nilai_ppk_pns?></td>
									<td><?=$row->assestment_kompetensi?></td>
									<td><?=$row->assestment_potensi?></td>
									<td><?=$row->wawancara?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_indikator('<?=$row->id_update?>_<?=$row->id_indikator?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_indikator('<?=$row->id_update?>_<?=$row->id_indikator?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_indikator('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_indikator/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="indikator-<?=$k?>_<?=$row->id_update?>_<?=$row->id_indikator?>"><?=$v?></var>
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
		<div class="overlay-bg indikator" onclick="close_sidebar('indikator')"></div>
		<div class="add-new-data indikator fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('indikator')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="indikator-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data indikator" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-indikator" onsubmit="submit_indikator()" enctype="multipart/form-data">
				<input type="hidden" id="indikator-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="indikator-id_update" value="" />
				<input type="hidden" name="id_indikator" id="indikator-id_indikator" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat indikator</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('indikator')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_indikator" id="indikator-kode_bkn_indikator" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tahun</label>
								<input type="number" name="tahun" id="indikator-tahun" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nilai PPK PNS</label>
								<input type="number" step="0.01" name="nilai_ppk_pns" id="indikator-nilai_ppk_pns" class="form-control">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Assestment Kompetensi</label>
								<input type="number" step="0.01" name="assestment_kompetensi" id="indikator-assestment_kompetensi" class="form-control">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Assestment Potensi</label>
								<input type="number" step="0.01" name="assestment_potensi" id="indikator-assestment_potensi" class="form-control">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Wawancara</label>
								<input type="number" step="0.01" name="wawancara" id="indikator-wawancara" class="form-control">
							</div>
							<div class="col-sm-12 data-field-col hidden">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="indikator-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="indikator-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="indikator-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="indikator-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="indikator-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="indikator-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="indikator-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#indikator-input-verifikasi').val('')">Simpan</button>
						<button id="indikator-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#indikator-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="indikator-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('indikator')">Batal</button>
						<button id="indikator-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#indikator-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_indikator() {
		var formData = new FormData($('#form-indikator')[0]);
        var _csrfName = $('input#indikator-csrf').attr('name');
        var _csrfValue = $('input#indikator-csrf').val();
        var file_data = $('#indikator-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/indikator")?>",
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
					get_riwayat('indikator');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('indikator');
				}, 500);
			}
		});
	}
	function edit_indikator(id)
	{
        //alert(id);
        open_fileframe('indikator',$("#indikator-berkas_"+id).html())
        $("#indikator-filelink").html("");
        $("#indikator-filelink").html($("#indikator-berkas_"+id).html());
        $("#indikator-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_indikator/'+$("#indikator-berkas_"+id).html());

        $("#indikator-id_update").val($("#indikator-id_update_"+id).html());
        $("#indikator-id_indikator").val($("#indikator-id_indikator_"+id).html());
        //ambil data
        var kode_bkn_indikator = $("#indikator-kode_bkn_indikator_"+id).html();

        var tahun = $("#indikator-tahun_"+id).html();
        var nilai_ppk_pns = $("#indikator-nilai_ppk_pns_"+id).html();
        var assestment_kompetensi = $("#indikator-assestment_kompetensi_"+id).html();
        var assestment_potensi = $("#indikator-assestment_potensi_"+id).html();
        var wawancara = $("#indikator-wawancara_"+id).html();

        //set data
        $("#indikator-kode_bkn_indikator").val(kode_bkn_indikator);

        $("#indikator-tahun").val(tahun);
        $("#indikator-nilai_ppk_pns").val(nilai_ppk_pns);
        $("#indikator-assestment_kompetensi").val(assestment_kompetensi);
        $("#indikator-assestment_potensi").val(assestment_potensi);
        $("#indikator-wawancara").val(wawancara);

        $(".add-new-data.indikator").addClass("show");
        $(".overlay-bg.indikator").addClass("show");

        $("#indikator-btn-simpan").removeClass("hidden");
        $("#indikator-btn-batal").removeClass("hidden");

        $("#indikator-input-alasan").addClass("hidden");
        $("#indikator-btn-verifikasi").addClass("hidden");
        $("#indikator-btn-tolak").addClass("hidden");
    }
	function verifikasi_indikator(id)
	{
        //alert(id);
        open_fileframe('indikator',$("#indikator-berkas_"+id).html())
        $("#indikator-filelink").html("");
        $("#indikator-filelink").html($("#indikator-berkas_"+id).html());
        $("#indikator-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_indikator/'+$("#indikator-berkas_"+id).html());

        $("#indikator-id_update").val($("#indikator-id_update_"+id).html());
        $("#indikator-id_indikator").val($("#indikator-id_indikator_"+id).html());
        //ambil data
        var kode_bkn_indikator = $("#indikator-kode_bkn_indikator_"+id).html();

        var tahun = $("#indikator-tahun_"+id).html();
        var nilai_ppk_pns = $("#indikator-nilai_ppk_pns_"+id).html();
        var assestment_kompetensi = $("#indikator-assestment_kompetensi_"+id).html();
        var assestment_potensi = $("#indikator-assestment_potensi_"+id).html();
        var wawancara = $("#indikator-wawancara_"+id).html();

        //set data
        $("#indikator-kode_bkn_indikator").val(kode_bkn_indikator);

        $("#indikator-tahun").val(tahun);
        $("#indikator-nilai_ppk_pns").val(nilai_ppk_pns);
        $("#indikator-assestment_kompetensi").val(assestment_kompetensi);
        $("#indikator-assestment_potensi").val(assestment_potensi);
        $("#indikator-wawancara").val(wawancara);

        $(".add-new-data.indikator").addClass("show");
        $(".overlay-bg.indikator").addClass("show");

        $("#indikator-btn-simpan").addClass("hidden");
        $("#indikator-btn-batal").addClass("hidden");

        $("#indikator-input-alasan").removeClass("hidden");
        $("#indikator-btn-verifikasi").removeClass("hidden");
        $("#indikator-btn-tolak").removeClass("hidden");
    }
    function hapus_indikator(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/indikator")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#indikator-id_pegawai_"+id).html(),
        				nip_pegawai:$("#indikator-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('indikator');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('indikator');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_indikator(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/indikator")?>",
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
        					get_riwayat('indikator');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('indikator');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_indikator(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/indikator")?>",
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
        					get_riwayat('indikator');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('indikator');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_indikator()
    {
    	$("#indikator-fileframe").attr("src","");
        $("#indikator-filelink").html("");

    	$("#indikator-id_update").val("");
    	$("#indikator-id_indikator").val("");
    	$("#indikator-kode_bkn_indikator").val("");

        $("#indikator-tahun").val("");
        $("#indikator-nilai_ppk_pns").val("");
        $("#indikator-assestment_kompetensi").val("");
        $("#indikator-assestment_potensi").val("");
        $("#indikator-wawancara").val("");

    	$(".add-new-data.indikator").addClass("show");
    	$(".overlay-bg.indikator").addClass("show");

        $("#indikator-btn-simpan").removeClass("hidden");
        $("#indikator-btn-batal").removeClass("hidden");

        $("#indikator-input-alasan").addClass("hidden");
        $("#indikator-btn-verifikasi").addClass("hidden");
        $("#indikator-btn-tolak").addClass("hidden");
    }
</script>

