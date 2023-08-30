<section class="data-list-view-header">
	<!-- RW kedudukan -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat kedudukan <button type="button" onclick="tambah_kedudukan();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Kedudukan</th>
								<th>Berlaku TMT <span class="fa fa-sort-desc"></span></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($kedudukan as $row1): $row = $row1; ?>
								<?php foreach ($dump_kedudukan['update'] as $row2): ?>
									<?php
									if($row1->id_kedudukan == $row2->id_kedudukan) {
										$row = $row2;
										$row->nama_kedudukan = convert_data($ref_kedudukan,'kode_kedudukan',$row->kode_kedudukan,'nama_kedudukan');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_kedudukan['delete'] as $row2): ?>
									<?php
									if($row1->id_kedudukan == $row2->id_kedudukan) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_kedudukan?></td>
									<td><?=tanggal($row->tmt_kedudukan)?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_kedudukan('<?=$row->id_kedudukan?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_kedudukan('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_kedudukan('<?=$row->id_kedudukan?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_kedudukan('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_kedudukan('<?=$row->id_kedudukan?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_kedudukan('<?=$row->id_kedudukan?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_kedudukan/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="kedudukan-<?=$k?>_<?=$row->id_kedudukan?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_kedudukan['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_kedudukan = convert_data($ref_kedudukan,'kode_kedudukan',$row->kode_kedudukan,'nama_kedudukan');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_kedudukan?></td>
									<td><?=tanggal($row->tmt_kedudukan)?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_kedudukan('<?=$row->id_update?>_<?=$row->id_kedudukan?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_kedudukan('<?=$row->id_update?>_<?=$row->id_kedudukan?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_kedudukan('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_kedudukan/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="kedudukan-<?=$k?>_<?=$row->id_update?>_<?=$row->id_kedudukan?>"><?=$v?></var>
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
		<div class="overlay-bg kedudukan" onclick="close_sidebar('kedudukan')"></div>
		<div class="add-new-data kedudukan fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('kedudukan')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="kedudukan-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data kedudukan" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-kedudukan" onsubmit="submit_kedudukan()" enctype="multipart/form-data">
				<input type="hidden" id="kedudukan-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="kedudukan-id_update" value="" />
				<input type="hidden" name="id_kedudukan" id="kedudukan-id_kedudukan" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat kedudukan</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('kedudukan')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_kedudukan" id="kedudukan-kode_bkn_kedudukan" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Kedudukan</label>
								<select class="form-control select2" id="kedudukan-kode_kedudukan" name="kode_kedudukan" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_kedudukan as $row): ?>
										<option value="<?=$row->kode_kedudukan?>"><?=$row->nama_kedudukan?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Berlaku TMT</label>
								<input type="date" name="tmt_kedudukan" id="kedudukan-tmt_kedudukan" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="kedudukan-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="kedudukan-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="kedudukan-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="kedudukan-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="kedudukan-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="kedudukan-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="kedudukan-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#kedudukan-input-verifikasi').val('')">Simpan</button>
						<button id="kedudukan-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#kedudukan-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="kedudukan-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('kedudukan')">Batal</button>
						<button id="kedudukan-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#kedudukan-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_kedudukan() {
		var formData = new FormData($('#form-kedudukan')[0]);
        var _csrfName = $('input#kedudukan-csrf').attr('name');
        var _csrfValue = $('input#kedudukan-csrf').val();
        var file_data = $('#kedudukan-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/kedudukan")?>",
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
					get_riwayat('kedudukan');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('kedudukan');
				}, 500);
			}
		});
	}
	function edit_kedudukan(id)
	{
        //alert(id);
        open_fileframe('kedudukan',$("#kedudukan-berkas_"+id).html())
        $("#kedudukan-filelink").html("");
        $("#kedudukan-filelink").html($("#kedudukan-berkas_"+id).html());
        $("#kedudukan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_kedudukan/'+$("#kedudukan-berkas_"+id).html());

        $("#kedudukan-id_update").val($("#kedudukan-id_update_"+id).html());
        $("#kedudukan-id_kedudukan").val($("#kedudukan-id_kedudukan_"+id).html());
        //ambil data
        var kode_bkn_kedudukan = $("#kedudukan-kode_bkn_kedudukan_"+id).html();

        var kode_kedudukan = $("#kedudukan-kode_kedudukan_"+id).html();
        var tmt_kedudukan = $("#kedudukan-tmt_kedudukan_"+id).html();
        
        var sk_nomor = $("#kedudukan-sk_nomor_"+id).html();
        var sk_tanggal = $("#kedudukan-sk_tanggal_"+id).html();

        //set data
        $("#kedudukan-kode_bkn_kedudukan").val(kode_bkn_kedudukan);

        $("#kedudukan-kode_kedudukan").val(kode_kedudukan).trigger("change");
        $("#kedudukan-tmt_kedudukan").val(tmt_kedudukan);

        $("#kedudukan-sk_nomor").val(sk_nomor);
        $("#kedudukan-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.kedudukan").addClass("show");
        $(".overlay-bg.kedudukan").addClass("show");

        $("#kedudukan-btn-simpan").removeClass("hidden");
        $("#kedudukan-btn-batal").removeClass("hidden");

        $("#kedudukan-input-alasan").addClass("hidden");
        $("#kedudukan-btn-verifikasi").addClass("hidden");
        $("#kedudukan-btn-tolak").addClass("hidden");
    }
	function verifikasi_kedudukan(id)
	{
        //alert(id);
        open_fileframe('kedudukan',$("#kedudukan-berkas_"+id).html())
        $("#kedudukan-filelink").html("");
        $("#kedudukan-filelink").html($("#kedudukan-berkas_"+id).html());
        $("#kedudukan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_kedudukan/'+$("#kedudukan-berkas_"+id).html());

        $("#kedudukan-id_update").val($("#kedudukan-id_update_"+id).html());
        $("#kedudukan-id_kedudukan").val($("#kedudukan-id_kedudukan_"+id).html());
        //ambil data
        var kode_bkn_kedudukan = $("#kedudukan-kode_bkn_kedudukan_"+id).html();

        var kode_kedudukan = $("#kedudukan-kode_kedudukan_"+id).html();
        var tmt_kedudukan = $("#kedudukan-tmt_kedudukan_"+id).html();
        
        var sk_nomor = $("#kedudukan-sk_nomor_"+id).html();
        var sk_tanggal = $("#kedudukan-sk_tanggal_"+id).html();

        //set data
        $("#kedudukan-kode_bkn_kedudukan").val(kode_bkn_kedudukan);

        $("#kedudukan-kode_kedudukan").val(kode_kedudukan).trigger("change");
        $("#kedudukan-tmt_kedudukan").val(tmt_kedudukan);

        $("#kedudukan-sk_nomor").val(sk_nomor);
        $("#kedudukan-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.kedudukan").addClass("show");
        $(".overlay-bg.kedudukan").addClass("show");

        $("#kedudukan-btn-simpan").addClass("hidden");
        $("#kedudukan-btn-batal").addClass("hidden");

        $("#kedudukan-input-alasan").removeClass("hidden");
        $("#kedudukan-btn-verifikasi").removeClass("hidden");
        $("#kedudukan-btn-tolak").removeClass("hidden");
    }
    function hapus_kedudukan(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/kedudukan")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#kedudukan-id_pegawai_"+id).html(),
        				nip_pegawai:$("#kedudukan-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('kedudukan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('kedudukan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_kedudukan(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/kedudukan")?>",
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
        					get_riwayat('kedudukan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('kedudukan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_kedudukan(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/kedudukan")?>",
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
        					get_riwayat('kedudukan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('kedudukan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_kedudukan()
    {
    	$("#kedudukan-fileframe").attr("src","");
        $("#kedudukan-filelink").html("");

    	$("#kedudukan-id_update").val("");
    	$("#kedudukan-id_kedudukan").val("");
    	$("#kedudukan-kode_bkn_kedudukan").val("");

    	$("#kedudukan-kode_kedudukan").val("").trigger("change");
    	$("#kedudukan-tmt_kedudukan").val("");

    	$("#kedudukan-sk_nomor").val("");
    	$("#kedudukan-sk_tanggal").val("");

    	$(".add-new-data.kedudukan").addClass("show");
    	$(".overlay-bg.kedudukan").addClass("show");

        $("#kedudukan-btn-simpan").removeClass("hidden");
        $("#kedudukan-btn-batal").removeClass("hidden");

        $("#kedudukan-input-alasan").addClass("hidden");
        $("#kedudukan-btn-verifikasi").addClass("hidden");
        $("#kedudukan-btn-tolak").addClass("hidden");
    }
</script>

