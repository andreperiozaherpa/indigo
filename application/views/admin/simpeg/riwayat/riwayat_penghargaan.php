<section class="data-list-view-header">
	<!-- RW penghargaan -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Penghargaan <button type="button" onclick="tambah_penghargaan();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Jenis Penghargaan</th>
								<th>Nomor</th>
								<th>Nama Penghargaan</th>
								<th>Tahun </th>
								<th>SK Nomor</th>
								<th>SK Tanggal <span class="fa fa-sort-desc"></span></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($penghargaan as $row1): $row = $row1; ?>
								<?php foreach ($dump_penghargaan['update'] as $row2): ?>
									<?php
									if($row1->id_penghargaan == $row2->id_penghargaan) {
										$row = $row2;
										$row->nama_ref_penghargaan = convert_data($ref_penghargaan,'kode_penghargaan',$row->kode_penghargaan,'nama_penghargaan');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_penghargaan['delete'] as $row2): ?>
									<?php
									if($row1->id_penghargaan == $row2->id_penghargaan) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_ref_penghargaan?></td>
									<td><?=$row->nomor_penghargaan?></td>
									<td><?=$row->nama_penghargaan?></td>
									<td><?=$row->tahun?></td>
									<td><?=$row->sk_nomor?></td>
									<td><?=tanggal($row->sk_tanggal)?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_penghargaan('<?=$row->id_penghargaan?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_penghargaan('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_penghargaan('<?=$row->id_penghargaan?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_penghargaan('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_penghargaan('<?=$row->id_penghargaan?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_penghargaan('<?=$row->id_penghargaan?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_penghargaan/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="penghargaan-<?=$k?>_<?=$row->id_penghargaan?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_penghargaan['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_ref_penghargaan = convert_data($ref_penghargaan,'kode_penghargaan',$row->kode_penghargaan,'nama_penghargaan');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_ref_penghargaan?></td>
									<td><?=$row->nomor_penghargaan?></td>
									<td><?=$row->nama_penghargaan?></td>
									<td><?=$row->tahun?></td>
									<td><?=$row->sk_nomor?></td>
									<td><?=tanggal($row->sk_tanggal)?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_penghargaan('<?=$row->id_update?>_<?=$row->id_penghargaan?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_penghargaan('<?=$row->id_update?>_<?=$row->id_penghargaan?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_penghargaan('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_penghargaan/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="penghargaan-<?=$k?>_<?=$row->id_update?>_<?=$row->id_penghargaan?>"><?=$v?></var>
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
		<div class="overlay-bg penghargaan" onclick="close_sidebar('penghargaan')"></div>
		<div class="add-new-data penghargaan fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('penghargaan')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="penghargaan-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data penghargaan" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-penghargaan" onsubmit="submit_penghargaan()" enctype="multipart/form-data">
				<input type="hidden" id="penghargaan-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="penghargaan-id_update" value="" />
				<input type="hidden" name="id_penghargaan" id="penghargaan-id_penghargaan" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat penghargaan</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('penghargaan')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_penghargaan" id="penghargaan-kode_bkn_penghargaan" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Jenis Penghargaan</label>
								<select class="form-control select2" id="penghargaan-kode_penghargaan" name="kode_penghargaan" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_penghargaan as $row): ?>
										<option value="<?=$row->kode_penghargaan?>"><?=$row->nama_penghargaan?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor</label>
								<input type="text" name="nomor_penghargaan" id="penghargaan-nomor_penghargaan" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nama Penghargaan</label>
								<input type="text" name="nama_penghargaan" id="penghargaan-nama_penghargaan" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tahun</label>
								<input type="number" name="tahun" id="penghargaan-tahun" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor SK</label>
								<input type="text" name="sk_nomor" id="penghargaan-sk_nomor" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tanggal SK</label>
								<input type="date" name="sk_tanggal" id="penghargaan-sk_tanggal" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="penghargaan-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="penghargaan-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="penghargaan-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="penghargaan-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="penghargaan-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="penghargaan-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="penghargaan-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#penghargaan-input-verifikasi').val('')">Simpan</button>
						<button id="penghargaan-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#penghargaan-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="penghargaan-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('penghargaan')">Batal</button>
						<button id="penghargaan-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#penghargaan-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_penghargaan() {
		var formData = new FormData($('#form-penghargaan')[0]);
        var _csrfName = $('input#penghargaan-csrf').attr('name');
        var _csrfValue = $('input#penghargaan-csrf').val();
        var file_data = $('#penghargaan-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/penghargaan")?>",
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
					get_riwayat('penghargaan');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('penghargaan');
				}, 500);
			}
		});
	}
	function edit_penghargaan(id)
	{
        //alert(id);
        open_fileframe('penghargaan',$("#penghargaan-berkas_"+id).html())
        $("#penghargaan-filelink").html("");
        $("#penghargaan-filelink").html($("#penghargaan-berkas_"+id).html());
        $("#penghargaan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_penghargaan/'+$("#penghargaan-berkas_"+id).html());

        $("#penghargaan-id_update").val($("#penghargaan-id_update_"+id).html());
        $("#penghargaan-id_penghargaan").val($("#penghargaan-id_penghargaan_"+id).html());
        //ambil data
        var kode_bkn_penghargaan = $("#penghargaan-kode_bkn_penghargaan_"+id).html();

        var kode_penghargaan = $("#penghargaan-kode_penghargaan_"+id).html();
        var nomor_penghargaan = $("#penghargaan-nomor_penghargaan_"+id).html();
        var nama_penghargaan = $("#penghargaan-nama_penghargaan_"+id).html();
        var tahun = $("#penghargaan-tahun_"+id).html();
        
        var sk_nomor = $("#penghargaan-sk_nomor_"+id).html();
        var sk_tanggal = $("#penghargaan-sk_tanggal_"+id).html();

        //set data
        $("#penghargaan-kode_bkn_penghargaan").val(kode_bkn_penghargaan);

        $("#penghargaan-kode_penghargaan").val(kode_penghargaan).trigger("change");
        $("#penghargaan-nomor_penghargaan").val(nomor_penghargaan);
        $("#penghargaan-nama_penghargaan").val(nama_penghargaan);
        $("#penghargaan-tahun").val(tahun);

        $("#penghargaan-sk_nomor").val(sk_nomor);
        $("#penghargaan-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.penghargaan").addClass("show");
        $(".overlay-bg.penghargaan").addClass("show");

        $("#penghargaan-btn-simpan").removeClass("hidden");
        $("#penghargaan-btn-batal").removeClass("hidden");

        $("#penghargaan-input-alasan").addClass("hidden");
        $("#penghargaan-btn-verifikasi").addClass("hidden");
        $("#penghargaan-btn-tolak").addClass("hidden");
    }
	function verifikasi_penghargaan(id)
	{
        //alert(id);
        open_fileframe('penghargaan',$("#penghargaan-berkas_"+id).html())
        $("#penghargaan-filelink").html("");
        $("#penghargaan-filelink").html($("#penghargaan-berkas_"+id).html());
        $("#penghargaan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_penghargaan/'+$("#penghargaan-berkas_"+id).html());

        $("#penghargaan-id_update").val($("#penghargaan-id_update_"+id).html());
        $("#penghargaan-id_penghargaan").val($("#penghargaan-id_penghargaan_"+id).html());
        //ambil data
        var kode_bkn_penghargaan = $("#penghargaan-kode_bkn_penghargaan_"+id).html();

        var kode_penghargaan = $("#penghargaan-kode_penghargaan_"+id).html();
        var nomor_penghargaan = $("#penghargaan-nomor_penghargaan_"+id).html();
        var nama_penghargaan = $("#penghargaan-nama_penghargaan_"+id).html();
        var tahun = $("#penghargaan-tahun_"+id).html();
        
        var sk_nomor = $("#penghargaan-sk_nomor_"+id).html();
        var sk_tanggal = $("#penghargaan-sk_tanggal_"+id).html();

        //set data
        $("#penghargaan-kode_bkn_penghargaan").val(kode_bkn_penghargaan);

        $("#penghargaan-kode_penghargaan").val(kode_penghargaan).trigger("change");
        $("#penghargaan-nomor_penghargaan").val(nomor_penghargaan);
        $("#penghargaan-nama_penghargaan").val(nama_penghargaan);
        $("#penghargaan-tahun").val(tahun);

        $("#penghargaan-sk_nomor").val(sk_nomor);
        $("#penghargaan-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.penghargaan").addClass("show");
        $(".overlay-bg.penghargaan").addClass("show");

        $("#penghargaan-btn-simpan").addClass("hidden");
        $("#penghargaan-btn-batal").addClass("hidden");

        $("#penghargaan-input-alasan").removeClass("hidden");
        $("#penghargaan-btn-verifikasi").removeClass("hidden");
        $("#penghargaan-btn-tolak").removeClass("hidden");
    }
    function hapus_penghargaan(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/penghargaan")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#penghargaan-id_pegawai_"+id).html(),
        				nip_pegawai:$("#penghargaan-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('penghargaan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('penghargaan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_penghargaan(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/penghargaan")?>",
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
        					get_riwayat('penghargaan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('penghargaan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_penghargaan(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/penghargaan")?>",
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
        					get_riwayat('penghargaan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('penghargaan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_penghargaan()
    {
    	$("#penghargaan-fileframe").attr("src","");
        $("#penghargaan-filelink").html("");

    	$("#penghargaan-id_update").val("");
    	$("#penghargaan-id_penghargaan").val("");
    	$("#penghargaan-kode_bkn_penghargaan").val("");

    	$("#penghargaan-kode_penghargaan").val("").trigger("change");
    	$("#penghargaan-nomor_penghargaan").val("");
    	$("#penghargaan-nama_penghargaan").val("");
    	$("#penghargaan-tahun").val("");

    	$("#penghargaan-sk_nomor").val("");
    	$("#penghargaan-sk_tanggal").val("");

    	$(".add-new-data.penghargaan").addClass("show");
    	$(".overlay-bg.penghargaan").addClass("show");

        $("#penghargaan-btn-simpan").removeClass("hidden");
        $("#penghargaan-btn-batal").removeClass("hidden");

        $("#penghargaan-input-alasan").addClass("hidden");
        $("#penghargaan-btn-verifikasi").addClass("hidden");
        $("#penghargaan-btn-tolak").addClass("hidden");
    }
</script>


<section class="data-list-view-header">
	<!-- RW prestasi -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Prestasi <button type="button" onclick="tambah_prestasi();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Nama Prestasi</th>
								<th>Kelas Prestasi</th>
								<th>Prestasi</th>
								<th>Tahun <span class="fa fa-sort-desc"></span></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($prestasi as $row1): $row = $row1; ?>
								<?php foreach ($dump_prestasi['update'] as $row2): ?>
									<?php
									if($row1->id_prestasi == $row2->id_prestasi) {
										$row = $row2;
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_prestasi['delete'] as $row2): ?>
									<?php
									if($row1->id_prestasi == $row2->id_prestasi) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_prestasi?></td>
									<td><?=$row->kelas_prestasi?></td>
									<td><?=$row->medali?></td>
									<td><?=$row->tahun?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_prestasi('<?=$row->id_prestasi?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_prestasi('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_prestasi('<?=$row->id_prestasi?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_prestasi('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_prestasi('<?=$row->id_prestasi?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_prestasi('<?=$row->id_prestasi?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_prestasi/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="prestasi-<?=$k?>_<?=$row->id_prestasi?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_prestasi['insert'] as $row1): $row = $row1; ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_prestasi?></td>
									<td><?=$row->kelas_prestasi?></td>
									<td><?=$row->medali?></td>
									<td><?=$row->tahun?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_prestasi('<?=$row->id_update?>_<?=$row->id_prestasi?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_prestasi('<?=$row->id_update?>_<?=$row->id_prestasi?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_prestasi('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_prestasi/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="prestasi-<?=$k?>_<?=$row->id_update?>_<?=$row->id_prestasi?>"><?=$v?></var>
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
		<div class="overlay-bg prestasi" onclick="close_sidebar('prestasi')"></div>
		<div class="add-new-data prestasi fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('prestasi')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="prestasi-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data prestasi" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-prestasi" onsubmit="submit_prestasi()" enctype="multipart/form-data">
				<input type="hidden" id="prestasi-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="prestasi-id_update" value="" />
				<input type="hidden" name="id_prestasi" id="prestasi-id_prestasi" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat prestasi</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('prestasi')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_prestasi" id="prestasi-kode_bkn_prestasi" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nama Prestasi</label>
								<input type="text" name="nama_prestasi" id="prestasi-nama_prestasi" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Kelas Prestasi</label>
								<select class="form-control" id="prestasi-kelas_prestasi" name="kelas_prestasi" required="">
									<option value="">-- PILIH --</option>
									<option value="PD">Tingkat OPD</option>
									<option value="KB">Tingkat Kab/Kota</option>
									<option value="PR">Tingkat Provinsi</option>
									<option value="NS">Tingkat Nasional</option>
									<option value="IN">Tingkat Internasional</option>
								</select>
							</div>
							<div class="col-sm-6 data-field-col">
                                <div class="vs-radio-con">
                                    <input type="radio" name="medali" id="prestasi-nominator" value="Nominator">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="">Nominator</span>
                                </div>
							</div>
							<div class="col-sm-6 data-field-col">
                                <div class="vs-radio-con">
                                    <input type="radio" name="medali" id="prestasi-meraih" value="Meraih">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="">Meraih</span>
                                </div>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tahun</label>
								<input type="number" name="tahun" id="prestasi-tahun" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="prestasi-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="prestasi-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="prestasi-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="prestasi-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="prestasi-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="prestasi-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="prestasi-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#prestasi-input-verifikasi').val('')">Simpan</button>
						<button id="prestasi-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#prestasi-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="prestasi-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('prestasi')">Batal</button>
						<button id="prestasi-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#prestasi-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_prestasi() {
		var formData = new FormData($('#form-prestasi')[0]);
        var _csrfName = $('input#prestasi-csrf').attr('name');
        var _csrfValue = $('input#prestasi-csrf').val();
        var file_data = $('#prestasi-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/prestasi")?>",
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
					get_riwayat('penghargaan');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('penghargaan');
				}, 500);
			}
		});
	}
	function edit_prestasi(id)
	{
        //alert(id);
        open_fileframe('prestasi',$("#prestasi-berkas_"+id).html())
        $("#prestasi-filelink").html("");
        $("#prestasi-filelink").html($("#prestasi-berkas_"+id).html());
        $("#prestasi-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_prestasi/'+$("#prestasi-berkas_"+id).html());

        $("#prestasi-id_update").val($("#prestasi-id_update_"+id).html());
        $("#prestasi-id_prestasi").val($("#prestasi-id_prestasi_"+id).html());
        //ambil data
        var kode_bkn_prestasi = $("#prestasi-kode_bkn_prestasi_"+id).html();

        var nama_prestasi = $("#prestasi-nama_prestasi_"+id).html();
        var kelas_prestasi = $("#prestasi-kelas_prestasi_"+id).html();
        var medali = $("#prestasi-medali_"+id).html();
        var tahun = $("#prestasi-tahun_"+id).html();
        
        var sk_nomor = $("#prestasi-sk_nomor_"+id).html();
        var sk_tanggal = $("#prestasi-sk_tanggal_"+id).html();

        //set data
        $("#prestasi-kode_bkn_prestasi").val(kode_bkn_prestasi);

        $("#prestasi-nama_prestasi").val(nama_prestasi);
        $("#prestasi-kelas_prestasi").val(kelas_prestasi).trigger("change");
        $("#prestasi-"+medali.toLowerCase()).trigger("click");
        $("#prestasi-tahun").val(tahun);

        $("#prestasi-sk_nomor").val(sk_nomor);
        $("#prestasi-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.prestasi").addClass("show");
        $(".overlay-bg.prestasi").addClass("show");

        $("#prestasi-btn-simpan").removeClass("hidden");
        $("#prestasi-btn-batal").removeClass("hidden");

        $("#prestasi-input-alasan").addClass("hidden");
        $("#prestasi-btn-verifikasi").addClass("hidden");
        $("#prestasi-btn-tolak").addClass("hidden");
    }
	function verifikasi_prestasi(id)
	{
        //alert(id);
        open_fileframe('prestasi',$("#prestasi-berkas_"+id).html())
        $("#prestasi-filelink").html("");
        $("#prestasi-filelink").html($("#prestasi-berkas_"+id).html());
        $("#prestasi-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_prestasi/'+$("#prestasi-berkas_"+id).html());

        $("#prestasi-id_update").val($("#prestasi-id_update_"+id).html());
        $("#prestasi-id_prestasi").val($("#prestasi-id_prestasi_"+id).html());
        //ambil data
        var kode_bkn_prestasi = $("#prestasi-kode_bkn_prestasi_"+id).html();

        var nama_prestasi = $("#prestasi-nama_prestasi_"+id).html();
        var kelas_prestasi = $("#prestasi-kelas_prestasi_"+id).html();
        var medali = $("#prestasi-medali_"+id).html();
        var tahun = $("#prestasi-tahun_"+id).html();
        
        var sk_nomor = $("#prestasi-sk_nomor_"+id).html();
        var sk_tanggal = $("#prestasi-sk_tanggal_"+id).html();

        //set data
        $("#prestasi-kode_bkn_prestasi").val(kode_bkn_prestasi);

        $("#prestasi-nama_prestasi").val(nama_prestasi);
        $("#prestasi-kelas_prestasi").val(kelas_prestasi).trigger("change");
        $("#prestasi-"+medali.toLowerCase()).trigger("click");
        $("#prestasi-tahun").val(tahun);

        $("#prestasi-sk_nomor").val(sk_nomor);
        $("#prestasi-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.prestasi").addClass("show");
        $(".overlay-bg.prestasi").addClass("show");

        $("#prestasi-btn-simpan").addClass("hidden");
        $("#prestasi-btn-batal").addClass("hidden");

        $("#prestasi-input-alasan").removeClass("hidden");
        $("#prestasi-btn-verifikasi").removeClass("hidden");
        $("#prestasi-btn-tolak").removeClass("hidden");
    }
    function hapus_prestasi(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/prestasi")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#prestasi-id_pegawai_"+id).html(),
        				nip_pegawai:$("#prestasi-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('penghargaan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('penghargaan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_prestasi(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/prestasi")?>",
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
        					get_riwayat('penghargaan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('penghargaan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_prestasi(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/prestasi")?>",
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
        					get_riwayat('penghargaan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('penghargaan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_prestasi()
    {
    	$("#prestasi-fileframe").attr("src","");
        $("#prestasi-filelink").html("");

    	$("#prestasi-id_update").val("");
    	$("#prestasi-id_prestasi").val("");
    	$("#prestasi-kode_bkn_prestasi").val("");

        $("#prestasi-nama_prestasi").val("");
        $("#prestasi-kelas_prestasi").val("").trigger("change");
        $("#prestasi-tahun").val("");

    	$("#prestasi-sk_nomor").val("");
    	$("#prestasi-sk_tanggal").val("");

    	$(".add-new-data.prestasi").addClass("show");
    	$(".overlay-bg.prestasi").addClass("show");

        $("#prestasi-btn-simpan").removeClass("hidden");
        $("#prestasi-btn-batal").removeClass("hidden");

        $("#prestasi-input-alasan").addClass("hidden");
        $("#prestasi-btn-verifikasi").addClass("hidden");
        $("#prestasi-btn-tolak").addClass("hidden");
    }
</script>

