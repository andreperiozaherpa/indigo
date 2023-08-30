<section class="data-list-view-header">
	<!-- RW cuti -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Cuti <button type="button" onclick="tambah_cuti();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Jenis Cuti</th>
								<th>Keterangan</th>
								<th>Tanggal Awal</th>
								<th>Tanggal Akhir <span class="fa fa-sort-desc"></span></th>
								<th>Tanggal Aktif</th>
								<th>SK Nomor</th>
								<th>SK Tanggal</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($cuti as $row1): $row = $row1; ?>
								<?php foreach ($dump_cuti['update'] as $row2): ?>
									<?php
									if($row1->id_cuti == $row2->id_cuti) {
										$row = $row2;
										$row->nama_cuti = convert_data($ref_cuti,'kode_cuti',$row->kode_cuti,'nama_cuti');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_cuti['delete'] as $row2): ?>
									<?php
									if($row1->id_cuti == $row2->id_cuti) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_cuti?></td>
									<td><?=$row->keterangan?></td>
									<td><?=tanggal($row->tmt_mulai)?></td>
									<td><?=tanggal($row->tmt_berakhir)?></td>
									<td><?=tanggal($row->tmt_aktif)?></td>
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
										<button type="button" onclick="verifikasi_cuti('<?=$row->id_cuti?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_cuti('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_cuti('<?=$row->id_cuti?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_cuti('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_cuti('<?=$row->id_cuti?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_cuti('<?=$row->id_cuti?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_cuti/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="cuti-<?=$k?>_<?=$row->id_cuti?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_cuti['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_cuti = convert_data($ref_cuti,'kode_cuti',$row->kode_cuti,'nama_cuti');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_cuti?></td>
									<td><?=$row->keterangan?></td>
									<td><?=tanggal($row->tmt_mulai)?></td>
									<td><?=tanggal($row->tmt_berakhir)?></td>
									<td><?=tanggal($row->tmt_aktif)?></td>
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
										<button type="button" onclick="verifikasi_cuti('<?=$row->id_update?>_<?=$row->id_cuti?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_cuti('<?=$row->id_update?>_<?=$row->id_cuti?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_cuti('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_cuti/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="cuti-<?=$k?>_<?=$row->id_update?>_<?=$row->id_cuti?>"><?=$v?></var>
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
		<div class="overlay-bg cuti" onclick="close_sidebar('cuti')"></div>
		<div class="add-new-data cuti fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('cuti')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="cuti-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data cuti" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-cuti" onsubmit="submit_cuti()" enctype="multipart/form-data">
				<input type="hidden" id="cuti-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="cuti-id_update" value="" />
				<input type="hidden" name="id_cuti" id="cuti-id_cuti" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Cuti</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('cuti')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_cuti" id="cuti-kode_bkn_cuti" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Jenis Cuti</label>
								<select class="form-control select2" id="cuti-kode_cuti" name="kode_cuti" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_cuti as $row): ?>
										<option value="<?=$row->kode_cuti?>"><?=$row->nama_cuti?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Keterangan</label>
								<input type="text" name="keterangan" id="cuti-keterangan" class="form-control">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">TMT Awal</label>
								<input type="date" name="tmt_mulai" id="cuti-tmt_mulai" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">TMT Akhir</label>
								<input type="date" name="tmt_berakhir" id="cuti-tmt_berakhir" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">TMT Aktif</label>
								<input type="date" name="tmt_aktif" id="cuti-tmt_aktif" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor SK</label>
								<input type="text" name="sk_nomor" id="cuti-sk_nomor" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tanggal SK</label>
								<input type="date" name="sk_tanggal" id="cuti-sk_tanggal" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="cuti-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="cuti-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="cuti-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="cuti-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="cuti-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="cuti-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="cuti-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#cuti-input-verifikasi').val('')">Simpan</button>
						<button id="cuti-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#cuti-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="cuti-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('cuti')">Batal</button>
						<button id="cuti-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#cuti-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_cuti() {
		var formData = new FormData($('#form-cuti')[0]);
        var _csrfName = $('input#cuti-csrf').attr('name');
        var _csrfValue = $('input#cuti-csrf').val();
        var file_data = $('#cuti-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/cuti")?>",
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
					get_riwayat('absen');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('absen');
				}, 500);
			}
		});
	}
	function edit_cuti(id)
	{
        //alert(id);
        open_fileframe('cuti',$("#cuti-berkas_"+id).html())
        $("#cuti-filelink").html("");
        $("#cuti-filelink").html($("#cuti-berkas_"+id).html());
        $("#cuti-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_cuti/'+$("#cuti-berkas_"+id).html());

        $("#cuti-id_update").val($("#cuti-id_update_"+id).html());
        $("#cuti-id_cuti").val($("#cuti-id_cuti_"+id).html());
        //ambil data
        var kode_bkn_cuti = $("#cuti-kode_bkn_cuti_"+id).html();

        var kode_cuti = $("#cuti-kode_cuti_"+id).html();
        var keterangan = $("#cuti-keterangan_"+id).html();
        var tmt_mulai = $("#cuti-tmt_mulai_"+id).html();
        var tmt_berakhir = $("#cuti-tmt_berakhir_"+id).html();
        var tmt_aktif = $("#cuti-tmt_aktif_"+id).html();
        
        var sk_nomor = $("#cuti-sk_nomor_"+id).html();
        var sk_tanggal = $("#cuti-sk_tanggal_"+id).html();

        //set data
        $("#cuti-kode_bkn_cuti").val(kode_bkn_cuti);

        $("#cuti-kode_cuti").val(kode_cuti).trigger("change");
        $("#cuti-keterangan").val(keterangan);
        $("#cuti-tmt_mulai").val(tmt_mulai);
        $("#cuti-tmt_berakhir").val(tmt_berakhir);
        $("#cuti-tmt_aktif").val(tmt_aktif);

        $("#cuti-sk_nomor").val(sk_nomor);
        $("#cuti-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.cuti").addClass("show");
        $(".overlay-bg.cuti").addClass("show");

        $("#cuti-btn-simpan").removeClass("hidden");
        $("#cuti-btn-batal").removeClass("hidden");

        $("#cuti-input-alasan").addClass("hidden");
        $("#cuti-btn-verifikasi").addClass("hidden");
        $("#cuti-btn-tolak").addClass("hidden");
    }
	function verifikasi_cuti(id)
	{
        //alert(id);
        open_fileframe('cuti',$("#cuti-berkas_"+id).html())
        $("#cuti-filelink").html("");
        $("#cuti-filelink").html($("#cuti-berkas_"+id).html());
        $("#cuti-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_cuti/'+$("#cuti-berkas_"+id).html());

        $("#cuti-id_update").val($("#cuti-id_update_"+id).html());
        $("#cuti-id_cuti").val($("#cuti-id_cuti_"+id).html());
        //ambil data
        var kode_bkn_cuti = $("#cuti-kode_bkn_cuti_"+id).html();

        var kode_cuti = $("#cuti-kode_cuti_"+id).html();
        var keterangan = $("#cuti-keterangan_"+id).html();
        var tmt_mulai = $("#cuti-tmt_mulai_"+id).html();
        var tmt_berakhir = $("#cuti-tmt_berakhir_"+id).html();
        var tmt_aktif = $("#cuti-tmt_aktif_"+id).html();
        
        var sk_nomor = $("#cuti-sk_nomor_"+id).html();
        var sk_tanggal = $("#cuti-sk_tanggal_"+id).html();

        //set data
        $("#cuti-kode_bkn_cuti").val(kode_bkn_cuti);

        $("#cuti-kode_cuti").val(kode_cuti).trigger("change");
        $("#cuti-keterangan").val(keterangan);
        $("#cuti-tmt_mulai").val(tmt_mulai);
        $("#cuti-tmt_berakhir").val(tmt_berakhir);
        $("#cuti-tmt_aktif").val(tmt_aktif);

        $("#cuti-sk_nomor").val(sk_nomor);
        $("#cuti-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.cuti").addClass("show");
        $(".overlay-bg.cuti").addClass("show");

        $("#cuti-btn-simpan").addClass("hidden");
        $("#cuti-btn-batal").addClass("hidden");

        $("#cuti-input-alasan").removeClass("hidden");
        $("#cuti-btn-verifikasi").removeClass("hidden");
        $("#cuti-btn-tolak").removeClass("hidden");
    }
    function hapus_cuti(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/cuti")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#cuti-id_pegawai_"+id).html(),
        				nip_pegawai:$("#cuti-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('absen');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('absen');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_cuti(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/cuti")?>",
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
        					get_riwayat('absen');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('absen');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_cuti(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/cuti")?>",
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
        					get_riwayat('absen');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('absen');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_cuti()
    {
    	$("#cuti-fileframe").attr("src","");
        $("#cuti-filelink").html("");

    	$("#cuti-id_update").val("");
    	$("#cuti-id_cuti").val("");
    	$("#cuti-kode_bkn_cuti").val("");

    	$("#cuti-kode_cuti").val("").trigger("change");
    	$("#cuti-keterangan").val("");
    	$("#cuti-tmt_mulai").val("");
    	$("#cuti-tmt_berakhir").val("");
    	$("#cuti-tmt_aktif").val("");

    	$("#cuti-sk_nomor").val("");
    	$("#cuti-sk_tanggal").val("");

    	$(".add-new-data.cuti").addClass("show");
    	$(".overlay-bg.cuti").addClass("show");

        $("#cuti-btn-simpan").removeClass("hidden");
        $("#cuti-btn-batal").removeClass("hidden");

        $("#cuti-input-alasan").addClass("hidden");
        $("#cuti-btn-verifikasi").addClass("hidden");
        $("#cuti-btn-tolak").addClass("hidden");
    }
</script>


<section class="data-list-view-header">
	<!-- RW hukuman -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Hukuman <button type="button" onclick="tambah_hukuman();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Jenis Hukdis</th>
								<th>Tingkat</th>
								<th>Tanggal Awal</th>
								<th>Tanggal Akhir <span class="fa fa-sort-desc"></span></th>
								<th>Masa Hukuman</th>
								<th>SK Nomor</th>
								<th>SK Tanggal</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($hukuman as $row1): $row = $row1; ?>
								<?php foreach ($dump_hukuman['update'] as $row2): ?>
									<?php
									if($row1->id_hukuman == $row2->id_hukuman) {
										$row = $row2;
										$row->nama_jenishukuman = convert_data($ref_jenishukuman,'kode_jenishukuman',$row->kode_jenishukuman,'nama_jenishukuman');
										$row->tingkat_jenishukuman = convert_data($ref_jenishukuman,'kode_jenishukuman',$row->kode_jenishukuman,'tingkat_jenishukuman');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_hukuman['delete'] as $row2): ?>
									<?php
									if($row1->id_hukuman == $row2->id_hukuman) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_jenishukuman?></td>
									<td><?=$row->tingkat_jenishukuman?></td>
									<td><?=tanggal($row->tmt_mulai)?></td>
									<td><?=tanggal($row->tmt_berakhir)?></td>
									<td><?=$row->masa_tahun?> tahun <?=$row->masa_bulan?> bulan</td>
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
										<button type="button" onclick="verifikasi_hukuman('<?=$row->id_hukuman?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_hukuman('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_hukuman('<?=$row->id_hukuman?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_hukuman('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_hukuman('<?=$row->id_hukuman?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_hukuman('<?=$row->id_hukuman?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_hukuman/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="hukuman-<?=$k?>_<?=$row->id_hukuman?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_hukuman['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_jenishukuman = convert_data($ref_jenishukuman,'kode_jenishukuman',$row->kode_jenishukuman,'nama_jenishukuman');
								$row->tingkat_jenishukuman = convert_data($ref_jenishukuman,'kode_jenishukuman',$row->kode_jenishukuman,'tingkat_jenishukuman');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_jenishukuman?></td>
									<td><?=$row->tingkat_jenishukuman?></td>
									<td><?=tanggal($row->tmt_mulai)?></td>
									<td><?=tanggal($row->tmt_berakhir)?></td>
									<td><?=$row->masa_tahun?> tahun <?=$row->masa_bulan?> bulan</td>
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
										<button type="button" onclick="verifikasi_hukuman('<?=$row->id_update?>_<?=$row->id_hukuman?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_hukuman('<?=$row->id_update?>_<?=$row->id_hukuman?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_hukuman('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_hukuman/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="hukuman-<?=$k?>_<?=$row->id_update?>_<?=$row->id_hukuman?>"><?=$v?></var>
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
		<div class="overlay-bg hukuman" onclick="close_sidebar('hukuman')"></div>
		<div class="add-new-data hukuman fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('hukuman')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="hukuman-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data hukuman" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-hukuman" onsubmit="submit_hukuman()" enctype="multipart/form-data">
				<input type="hidden" id="hukuman-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="hukuman-id_update" value="" />
				<input type="hidden" name="id_hukuman" id="hukuman-id_hukuman" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Hukuman</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('hukuman')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_hukuman" id="hukuman-kode_bkn_hukuman" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tingkat Hukuman</label>
								<select class="form-control select2" id="hukuman-tingkathukuman" onchange="hukuman_select_tingkathukuman()">
									<option value="">-- PILIH --</option>
									<option value="R">Ringan</option>
									<option value="S">Sedang</option>
									<option value="B">Berat</option>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Jenis Hukuman</label>
								<select class="form-control select2" id="hukuman-kode_jenishukuman" name="kode_jenishukuman" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_jenishukuman as $row): ?>
										<option value="<?=$row->kode_jenishukuman?>"><?=$row->nama_jenishukuman?> - <?=$row->tingkat_jenishukuman?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">TMT Awal</label>
								<input type="date" name="tmt_mulai" id="hukuman-tmt_mulai" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">TMT Akhir</label>
								<input type="date" name="tmt_berakhir" id="hukuman-tmt_berakhir" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Masa Hukuman Tahun</label>
								<input type="number" name="masa_tahun" id="hukuman-masa_tahun" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Masa Hukuman Bulan</label>
								<input type="number" name="masa_bulan" id="hukuman-masa_bulan" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor SK</label>
								<input type="text" name="sk_nomor" id="hukuman-sk_nomor" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tanggal SK</label>
								<input type="date" name="sk_tanggal" id="hukuman-sk_tanggal" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="hukuman-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="hukuman-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="hukuman-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="hukuman-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="hukuman-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="hukuman-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="hukuman-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#hukuman-input-verifikasi').val('')">Simpan</button>
						<button id="hukuman-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#hukuman-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="hukuman-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('hukuman')">Batal</button>
						<button id="hukuman-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#hukuman-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script type="text/javascript">
	var jenishukuman = <?=json_encode($ref_jenishukuman)?>;

	function hukuman_select_tingkathukuman() {
		var selected = $('#hukuman-tingkathukuman').val();
		var option = "<option value=\"\">-- PILIH --</option>";
		for (var i = jenishukuman.length - 1; i >= 0; i--) {
			if (jenishukuman[i]['tingkat_jenishukuman'] == selected) {
				option += "<option value=\""+String(jenishukuman[i]['kode_jenishukuman'])+"\">"+String(jenishukuman[i]['nama_jenishukuman'])+" - "+String(jenishukuman[i]['tingkat_jenishukuman'])+"</option>";
			}
		}
		$('#hukuman-kode_jenishukuman').html(option);
		$('#hukuman-kode_jenishukuman').select2();
	}
</script>

<script>
	function submit_hukuman() {
		var formData = new FormData($('#form-hukuman')[0]);
        var _csrfName = $('input#hukuman-csrf').attr('name');
        var _csrfValue = $('input#hukuman-csrf').val();
        var file_data = $('#hukuman-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/hukuman")?>",
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
					get_riwayat('absen');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('absen');
				}, 500);
			}
		});
	}
	function edit_hukuman(id)
	{
        //alert(id);
        open_fileframe('hukuman',$("#hukuman-berkas_"+id).html())
        $("#hukuman-filelink").html("");
        $("#hukuman-filelink").html($("#hukuman-berkas_"+id).html());
        $("#hukuman-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_hukuman/'+$("#hukuman-berkas_"+id).html());

        $("#hukuman-id_update").val($("#hukuman-id_update_"+id).html());
        $("#hukuman-id_hukuman").val($("#hukuman-id_hukuman_"+id).html());
        //ambil data
        var kode_bkn_hukuman = $("#hukuman-kode_bkn_hukuman_"+id).html();

        var kode_jenishukuman = $("#hukuman-kode_jenishukuman_"+id).html();
        var tmt_mulai = $("#hukuman-tmt_mulai_"+id).html();
        var tmt_berakhir = $("#hukuman-tmt_berakhir_"+id).html();
        var masa_tahun = $("#hukuman-masa_tahun_"+id).html();
        var masa_bulan = $("#hukuman-masa_bulan_"+id).html();
        
        var sk_nomor = $("#hukuman-sk_nomor_"+id).html();
        var sk_tanggal = $("#hukuman-sk_tanggal_"+id).html();

        //set data
        $("#hukuman-kode_bkn_hukuman").val(kode_bkn_hukuman);

        $("#hukuman-kode_jenishukuman").val(kode_jenishukuman).trigger("change");
        $("#hukuman-tmt_mulai").val(tmt_mulai);
        $("#hukuman-tmt_berakhir").val(tmt_berakhir);
        $("#hukuman-masa_tahun").val(masa_tahun);
        $("#hukuman-masa_bulan").val(masa_bulan);

        $("#hukuman-sk_nomor").val(sk_nomor);
        $("#hukuman-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.hukuman").addClass("show");
        $(".overlay-bg.hukuman").addClass("show");

        $("#hukuman-btn-simpan").removeClass("hidden");
        $("#hukuman-btn-batal").removeClass("hidden");

        $("#hukuman-input-alasan").addClass("hidden");
        $("#hukuman-btn-verifikasi").addClass("hidden");
        $("#hukuman-btn-tolak").addClass("hidden");
    }
	function verifikasi_hukuman(id)
	{
        //alert(id);
        open_fileframe('hukuman',$("#hukuman-berkas_"+id).html())
        $("#hukuman-filelink").html("");
        $("#hukuman-filelink").html($("#hukuman-berkas_"+id).html());
        $("#hukuman-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_hukuman/'+$("#hukuman-berkas_"+id).html());

        $("#hukuman-id_update").val($("#hukuman-id_update_"+id).html());
        $("#hukuman-id_hukuman").val($("#hukuman-id_hukuman_"+id).html());
        //ambil data
        var kode_bkn_hukuman = $("#hukuman-kode_bkn_hukuman_"+id).html();

        var kode_jenishukuman = $("#hukuman-kode_jenishukuman_"+id).html();
        var tmt_mulai = $("#hukuman-tmt_mulai_"+id).html();
        var tmt_berakhir = $("#hukuman-tmt_berakhir_"+id).html();
        var masa_tahun = $("#hukuman-masa_tahun_"+id).html();
        var masa_bulan = $("#hukuman-masa_bulan_"+id).html();
        
        var sk_nomor = $("#hukuman-sk_nomor_"+id).html();
        var sk_tanggal = $("#hukuman-sk_tanggal_"+id).html();

        //set data
        $("#hukuman-kode_bkn_hukuman").val(kode_bkn_hukuman);

        $("#hukuman-kode_jenishukuman").val(kode_jenishukuman).trigger("change");
        $("#hukuman-tmt_mulai").val(tmt_mulai);
        $("#hukuman-tmt_berakhir").val(tmt_berakhir);
        $("#hukuman-masa_tahun").val(masa_tahun);
        $("#hukuman-masa_bulan").val(masa_bulan);

        $("#hukuman-sk_nomor").val(sk_nomor);
        $("#hukuman-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.hukuman").addClass("show");
        $(".overlay-bg.hukuman").addClass("show");

        $("#hukuman-btn-simpan").addClass("hidden");
        $("#hukuman-btn-batal").addClass("hidden");

        $("#hukuman-input-alasan").removeClass("hidden");
        $("#hukuman-btn-verifikasi").removeClass("hidden");
        $("#hukuman-btn-tolak").removeClass("hidden");
    }
    function hapus_hukuman(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/hukuman")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#hukuman-id_pegawai_"+id).html(),
        				nip_pegawai:$("#hukuman-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('absen');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('absen');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_hukuman(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/hukuman")?>",
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
        					get_riwayat('absen');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('absen');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_hukuman(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/hukuman")?>",
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
        					get_riwayat('absen');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('absen');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_hukuman()
    {
    	$("#hukuman-fileframe").attr("src","");
        $("#hukuman-filelink").html("");

    	$("#hukuman-id_update").val("");
    	$("#hukuman-id_hukuman").val("");
    	$("#hukuman-kode_bkn_hukuman").val("");

        $("#hukuman-kode_jenishukuman").val("").trigger("change");
        $("#hukuman-tmt_mulai").val("");
        $("#hukuman-tmt_berakhir").val("");
        $("#hukuman-masa_tahun").val("");
        $("#hukuman-masa_bulan").val("");

    	$("#hukuman-sk_nomor").val("");
    	$("#hukuman-sk_tanggal").val("");

    	$(".add-new-data.hukuman").addClass("show");
    	$(".overlay-bg.hukuman").addClass("show");

        $("#hukuman-btn-simpan").removeClass("hidden");
        $("#hukuman-btn-batal").removeClass("hidden");

        $("#hukuman-input-alasan").addClass("hidden");
        $("#hukuman-btn-verifikasi").addClass("hidden");
        $("#hukuman-btn-tolak").addClass("hidden");
    }
</script>


