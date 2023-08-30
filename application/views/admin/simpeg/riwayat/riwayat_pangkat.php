<?php //var_dump($ref_golongan);die(); ?>
<section class="data-list-view-header">
	<!-- RW Pangkat -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Pangkat/Golongan <button type="button" onclick="tambah_pangkat();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Pangkat</th>
								<th>Golongan</th>
								<th>Berlaku TMT <span class="fa fa-sort-desc"></span></th>
								<th>MKG</th>
								<th>SK Nomor</th>
								<th>SK Tanggal</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pangkat as $row1): $row = $row1; ?>
								<?php foreach ($dump_pangkat['update'] as $row2): ?>
									<?php
									if($row1->id_pangkat == $row2->id_pangkat) {
										$row = $row2;
										$row->nama_golongan = convert_data($ref_golongan,'kode_golongan',$row->kode_golongan,'nama_golongan');
										$row->pangkat_golongan = convert_data($ref_golongan,'kode_golongan',$row->kode_golongan,'pangkat_golongan');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_pangkat['delete'] as $row2): ?>
									<?php
									if($row1->id_pangkat == $row2->id_pangkat) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_golongan?></td>
									<td><?=$row->pangkat_golongan?></td>
									<td><?=tanggal($row->tmt_pangkat)?></td>
									<td><?=$row->mkg_tahun?> tahun <?=$row->mkg_bulan?> bulan</td>
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
										<button type="button" onclick="verifikasi_pangkat('<?=$row->id_pangkat?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_pangkat('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_pangkat('<?=$row->id_pangkat?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_pangkat('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_pangkat('<?=$row->id_pangkat?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_pangkat('<?=$row->id_pangkat?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_pangkat/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="pangkat-<?=$k?>_<?=$row->id_pangkat?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_pangkat['insert'] as $row1): $row = $row1; ?>
								<?php
								$row->nama_golongan = convert_data($ref_golongan,'kode_golongan',$row->kode_golongan,'nama_golongan');
								$row->pangkat_golongan = convert_data($ref_golongan,'kode_golongan',$row->kode_golongan,'pangkat_golongan');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_golongan?></td>
									<td><?=$row->pangkat_golongan?></td>
									<td><?=tanggal($row->tmt_pangkat)?></td>
									<td><?=$row->mkg_tahun?> tahun <?=$row->mkg_bulan?> bulan</td>
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
										<button type="button" onclick="verifikasi_pangkat('<?=$row->id_update?>_<?=$row->id_pangkat?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_pangkat('<?=$row->id_update?>_<?=$row->id_pangkat?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_pangkat('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_pangkat/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="pangkat-<?=$k?>_<?=$row->id_update?>_<?=$row->id_pangkat?>"><?=$v?></var>
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
		<div class="overlay-bg pangkat" onclick="close_sidebar('pangkat')"></div>
		<div class="add-new-data pangkat fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('pangkat')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="pangkat-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data pangkat" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-pangkat" onsubmit="submit_pangkat()" enctype="multipart/form-data">
				<input type="hidden" id="pangkat-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="pangkat-id_update" value="" />
				<input type="hidden" name="id_pangkat" id="pangkat-id_pangkat" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Pangkat/Golongan</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('pangkat')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_pangkat" id="pangkat-kode_bkn_pangkat" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Pangkat</label>
								<select class="form-control select2" id="pangkat-kode_golongan" name="kode_golongan" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_golongan as $row): ?>
										<option value="<?=$row->kode_golongan?>"><?=$row->nama_golongan?> - <?=$row->pangkat_golongan?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">TMT Pangkat</label>
								<input type="date" name="tmt_pangkat" id="pangkat-tmt_pangkat" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">MKG Tahun</label>
								<input type="number" name="mkg_tahun" id="pangkat-mkg_tahun" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">MKG Bulan</label>
								<input type="number" name="mkg_bulan" id="pangkat-mkg_bulan" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor SK</label>
								<input type="text" name="sk_nomor" id="pangkat-sk_nomor" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tanggal SK</label>
								<input type="date" name="sk_tanggal" id="pangkat-sk_tanggal" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="pangkat-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="pangkat-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="pangkat-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="pangkat-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="pangkat-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="pangkat-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="pangkat-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#pangkat-input-verifikasi').val('')">Simpan</button>
						<button id="pangkat-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#pangkat-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="pangkat-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('pangkat')">Batal</button>
						<button id="pangkat-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#pangkat-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_pangkat() {
		var formData = new FormData($('#form-pangkat')[0]);
        var _csrfName = $('input#pangkat-csrf').attr('name');
        var _csrfValue = $('input#pangkat-csrf').val();
        var file_data = $('#pangkat-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/pangkat")?>",
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
					get_riwayat('pangkat');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('pangkat');
				}, 500);
			}
		});
	}
	function edit_pangkat(id)
	{
        //alert(id);
        open_fileframe('pangkat',$("#pangkat-berkas_"+id).html())
        $("#pangkat-filelink").html("");
        $("#pangkat-filelink").html($("#pangkat-berkas_"+id).html());
        $("#pangkat-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_pangkat/'+$("#pangkat-berkas_"+id).html());

        $("#pangkat-id_update").val($("#pangkat-id_update_"+id).html());
        $("#pangkat-id_pangkat").val($("#pangkat-id_pangkat_"+id).html());
        //ambil data
        var kode_bkn_pangkat = $("#pangkat-kode_bkn_pangkat_"+id).html();

        var kode_golongan = $("#pangkat-kode_golongan_"+id).html();
        var tmt_pangkat = $("#pangkat-tmt_pangkat_"+id).html();
        var mkg_tahun = $("#pangkat-mkg_tahun_"+id).html();
        var mkg_bulan = $("#pangkat-mkg_bulan_"+id).html();
        
        var sk_nomor = $("#pangkat-sk_nomor_"+id).html();
        var sk_tanggal = $("#pangkat-sk_tanggal_"+id).html();

        //set data
        $("#pangkat-kode_bkn_pangkat").val(kode_bkn_pangkat);

        $("#pangkat-kode_golongan").val(kode_golongan).trigger("change");
        $("#pangkat-tmt_pangkat").val(tmt_pangkat);
        $("#pangkat-mkg_tahun").val(mkg_tahun);
        $("#pangkat-mkg_bulan").val(mkg_bulan);

        $("#pangkat-sk_nomor").val(sk_nomor);
        $("#pangkat-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.pangkat").addClass("show");
        $(".overlay-bg.pangkat").addClass("show");

        $("#pangkat-btn-simpan").removeClass("hidden");
        $("#pangkat-btn-batal").removeClass("hidden");

        $("#pangkat-input-alasan").addClass("hidden");
        $("#pangkat-btn-verifikasi").addClass("hidden");
        $("#pangkat-btn-tolak").addClass("hidden");

    }

	function verifikasi_pangkat(id)
	{
        //alert(id);
        open_fileframe('pangkat',$("#pangkat-berkas_"+id).html())
        $("#pangkat-filelink").html("");
        $("#pangkat-filelink").html($("#pangkat-berkas_"+id).html());
        $("#pangkat-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_pangkat/'+$("#pangkat-berkas_"+id).html());

        $("#pangkat-id_update").val($("#pangkat-id_update_"+id).html());
        $("#pangkat-id_pangkat").val($("#pangkat-id_pangkat_"+id).html());
        //ambil data
        var kode_bkn_pangkat = $("#pangkat-kode_bkn_pangkat_"+id).html();

        var kode_golongan = $("#pangkat-kode_golongan_"+id).html();
        var tmt_pangkat = $("#pangkat-tmt_pangkat_"+id).html();
        var mkg_tahun = $("#pangkat-mkg_tahun_"+id).html();
        var mkg_bulan = $("#pangkat-mkg_bulan_"+id).html();
        
        var sk_nomor = $("#pangkat-sk_nomor_"+id).html();
        var sk_tanggal = $("#pangkat-sk_tanggal_"+id).html();

        //set data
        $("#pangkat-kode_bkn_pangkat").val(kode_bkn_pangkat);

        $("#pangkat-kode_golongan").val(kode_golongan).trigger("change");
        $("#pangkat-tmt_pangkat").val(tmt_pangkat);
        $("#pangkat-mkg_tahun").val(mkg_tahun);
        $("#pangkat-mkg_bulan").val(mkg_bulan);

        $("#pangkat-sk_nomor").val(sk_nomor);
        $("#pangkat-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.pangkat").addClass("show");
        $(".overlay-bg.pangkat").addClass("show");

        $("#pangkat-btn-simpan").addClass("hidden");
        $("#pangkat-btn-batal").addClass("hidden");

        $("#pangkat-input-alasan").removeClass("hidden");
        $("#pangkat-btn-verifikasi").removeClass("hidden");
        $("#pangkat-btn-tolak").removeClass("hidden");
    }

    function hapus_pangkat(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/pangkat")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#pangkat-id_pegawai_"+id).html(),
        				nip_pegawai:$("#pangkat-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('pangkat');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pangkat');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_pangkat(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/pangkat")?>",
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
        					get_riwayat('pangkat');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pangkat');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_pangkat(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/pangkat")?>",
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
        					get_riwayat('pangkat');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pangkat');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_pangkat()
    {
    	$("#pangkat-fileframe").attr("src","");
        $("#pangkat-filelink").html("");

    	$("#pangkat-id_update").val("");
    	$("#pangkat-id_pangkat").val("");
    	$("#pangkat-kode_bkn_pangkat").val("");

    	$("#pangkat-kode_golongan").val("").trigger("change");
    	$("#pangkat-tmt_pangkat").val("");
    	$("#pangkat-mkg_tahun").val("");
    	$("#pangkat-mkg_bulan").val("");

    	$("#pangkat-sk_nomor").val("");
    	$("#pangkat-sk_tanggal").val("");

    	$(".add-new-data.pangkat").addClass("show");
    	$(".overlay-bg.pangkat").addClass("show");

        $("#pangkat-btn-simpan").removeClass("hidden");
        $("#pangkat-btn-batal").removeClass("hidden");

        $("#pangkat-input-alasan").addClass("hidden");
        $("#pangkat-btn-verifikasi").addClass("hidden");
        $("#pangkat-btn-tolak").addClass("hidden");
    }
</script>



<section class="data-list-view-header">

	<!-- RW Kredit -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Angka Kredit <button type="button" onclick="tambah_kredit();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Mulai Penilaian</th>
								<th>Selesai Penilaian <span class="fa fa-sort-desc"></span></th>
								<th>Unsur Utama</th>
								<th>Unsur Penunjang</th>
								<th>Total</th>
								<th>SK/PAK Nomor</th>
								<th>SK/PAK Tanggal</th>
								<th>Opsi</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($kredit as $row1): $row = $row1; ?>
								<?php foreach ($dump_kredit['update'] as $row2): ?>
									<?php
									if($row1->id_kredit == $row2->id_kredit) {
										$row = $row2;
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_kredit['delete'] as $row2): ?>
									<?php
									if($row1->id_kredit == $row2->id_kredit) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=bulan($row->bulan_mulai_penilaian)?> <?=$row->tahun_mulai_penilaian?></td>
									<td><?=bulan($row->bulan_selesai_penilaian)?> <?=$row->tahun_selesai_penilaian?></td>
									<td><?=$row->kredit_utama?></td>
									<td><?=$row->kredit_penunjang?></td>
									<td><?=$row->total_kredit?></td>
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
										<button type="button" onclick="verifikasi_kredit('<?=$row->id_kredit?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_kredit('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_kredit('<?=$row->id_kredit?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_kredit('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_kredit('<?=$row->id_kredit?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_kredit('<?=$row->id_kredit?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_kredit/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="kredit-<?=$k?>_<?=$row->id_kredit?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_kredit['insert'] as $row): ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=bulan($row->bulan_mulai_penilaian)?> <?=$row->tahun_mulai_penilaian?></td>
									<td><?=bulan($row->bulan_selesai_penilaian)?> <?=$row->tahun_selesai_penilaian?></td>
									<td><?=$row->kredit_utama?></td>
									<td><?=$row->kredit_penunjang?></td>
									<td><?=$row->total_kredit?></td>
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
										<button type="button" onclick="verifikasi_kredit('<?=$row->id_update?>_<?=$row->id_kredit?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_kredit('<?=$row->id_update?>_<?=$row->id_kredit?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_kredit('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_kredit/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="kredit-<?=$k?>_<?=$row->id_update?>_<?=$row->id_kredit?>"><?=$v?></var>
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
		<div class="overlay-bg kredit" onclick="close_sidebar('kredit')"></div>
		<div class="add-new-data kredit fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('kredit')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="kredit-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data kredit" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-kredit" onsubmit="submit_kredit()" enctype="multipart/form-data">
				<input type="hidden" id="kredit-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="kredit-id_update" value="" />
				<input type="hidden" name="id_kredit" id="kredit-id_kredit" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Angka Kredit</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('kredit')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_kredit" id="kredit-kode_bkn_kredit" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-8 data-field-col">
								<label for="data-name">Mulai Penilaian</label>
								<select class="form-control" id="kredit-bulan_mulai_penilaian" name="bulan_mulai_penilaian" required="">
									<option value="">-- PILIH --</option>
									<?php $array_bulan = array_bulan(); foreach ($array_bulan as $key => $value): ?>
										<option value="<?=$key?>"><?=$value?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-4 data-field-col">
								<label for="data-name">&nbsp;</label>
								<input type="number" name="tahun_mulai_penilaian" id="kredit-tahun_mulai_penilaian" placeholder="<?=date('Y')?>" class="form-control" required="">
							</div>
							<div class="col-sm-8 data-field-col">
								<label for="data-name">Selesai Penilaian</label>
								<select class="form-control" id="kredit-bulan_selesai_penilaian" name="bulan_selesai_penilaian" required="">
									<option value="">-- PILIH --</option>
									<?php $array_bulan = array_bulan(); foreach ($array_bulan as $key => $value): ?>
										<option value="<?=$key?>"><?=$value?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-4 data-field-col">
								<label for="data-name">&nbsp;</label>
								<input type="number" name="tahun_selesai_penilaian" id="kredit-tahun_selesai_penilaian" placeholder="<?=date('Y')?>" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Unsur Utama</label>
								<input type="number" step="any" name="kredit_utama" id="kredit-kredit_utama" class="form-control" required="" onkeyup="$('#kredit-total_kredit').val(parseFloat($('#kredit-kredit_utama').val()) + parseFloat($('#kredit-kredit_penunjang').val()))">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Unsur Penunjang</label>
								<input type="number" step="any" name="kredit_penunjang" id="kredit-kredit_penunjang" class="form-control" required="" onkeyup="$('#kredit-total_kredit').val(parseFloat($('#kredit-kredit_utama').val()) + parseFloat($('#kredit-kredit_penunjang').val()))">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Total</label>
								<input type="number" step="any" name="total_kredit" id="kredit-total_kredit" class="form-control" required="" readonly="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor SK/PAK</label>
								<input type="text" name="sk_nomor" id="kredit-sk_nomor" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tanggal SK/PAK</label>
								<input type="date" name="sk_tanggal" id="kredit-sk_tanggal" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="kredit-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="kredit-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="kredit-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="kredit-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="kredit-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="kredit-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="kredit-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#kredit-input-verifikasi').val('')">Simpan</button>
						<button id="kredit-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#kredit-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="kredit-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('kredit')">Batal</button>
						<button id="kredit-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#kredit-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_kredit() {
		var formData = new FormData($('#form-kredit')[0]);
        var _csrfName = $('input#kredit-csrf').attr('name');
        var _csrfValue = $('input#kredit-csrf').val();
        var file_data = $('#kredit-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/kredit")?>",
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
					get_riwayat('pangkat');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('pangkat');
				}, 500);
			}
		});
	}
	function edit_kredit(id)
	{
        //alert(id);
        open_fileframe('kredit',$("#kredit-berkas_"+id).html())
        $("#kredit-filelink").html("");
        $("#kredit-filelink").html($("#kredit-berkas_"+id).html());
        $("#kredit-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_kredit/'+$("#kredit-berkas_"+id).html());

        $("#kredit-id_update").val($("#kredit-id_update_"+id).html());
        $("#kredit-id_kredit").val($("#kredit-id_kredit_"+id).html());
        //ambil data
        var kode_bkn_kredit = $("#kredit-kode_bkn_kredit_"+id).html();

        var bulan_mulai_penilaian = $("#kredit-bulan_mulai_penilaian_"+id).html();
        var tahun_mulai_penilaian = $("#kredit-tahun_mulai_penilaian_"+id).html();
        var bulan_selesai_penilaian = $("#kredit-bulan_selesai_penilaian_"+id).html();
        var tahun_selesai_penilaian = $("#kredit-tahun_selesai_penilaian_"+id).html();
        var kredit_utama = $("#kredit-kredit_utama_"+id).html();
        var kredit_penunjang = $("#kredit-kredit_penunjang_"+id).html();
        var total_kredit = $("#kredit-total_kredit_"+id).html();

        var sk_nomor = $("#kredit-sk_nomor_"+id).html();
        var sk_tanggal = $("#kredit-sk_tanggal_"+id).html();

        //set data
        $("#kredit-kode_bkn_kredit").val(kode_bkn_kredit);

        $("#kredit-bulan_mulai_penilaian").val(bulan_mulai_penilaian).trigger("change");
        $("#kredit-tahun_mulai_penilaian").val(tahun_mulai_penilaian);
        $("#kredit-bulan_selesai_penilaian").val(bulan_selesai_penilaian).trigger("change");
        $("#kredit-tahun_selesai_penilaian").val(tahun_selesai_penilaian);
        $("#kredit-kredit_utama").val(kredit_utama);
        $("#kredit-kredit_penunjang").val(kredit_penunjang);
        $("#kredit-total_kredit").val(total_kredit);

        $("#kredit-sk_nomor").val(sk_nomor);
        $("#kredit-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.kredit").addClass("show");
        $(".overlay-bg.kredit").addClass("show");

        $("#kredit-btn-simpan").removeClass("hidden");
        $("#kredit-btn-batal").removeClass("hidden");

        $("#kredit-input-alasan").addClass("hidden");
        $("#kredit-btn-verifikasi").addClass("hidden");
        $("#kredit-btn-tolak").addClass("hidden");
    }

	function verifikasi_kredit(id)
	{
        //alert(id);
        open_fileframe('kredit',$("#kredit-berkas_"+id).html())
        $("#kredit-filelink").html("");
        $("#kredit-filelink").html($("#kredit-berkas_"+id).html());
        $("#kredit-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_kredit/'+$("#kredit-berkas_"+id).html());

        $("#kredit-id_update").val($("#kredit-id_update_"+id).html());
        $("#kredit-id_kredit").val($("#kredit-id_kredit_"+id).html());
        //ambil data
        var kode_bkn_kredit = $("#kredit-kode_bkn_kredit_"+id).html();

        var bulan_mulai_penilaian = $("#kredit-bulan_mulai_penilaian_"+id).html();
        var tahun_mulai_penilaian = $("#kredit-tahun_mulai_penilaian_"+id).html();
        var bulan_selesai_penilaian = $("#kredit-bulan_selesai_penilaian_"+id).html();
        var tahun_selesai_penilaian = $("#kredit-tahun_selesai_penilaian_"+id).html();
        var kredit_utama = $("#kredit-kredit_utama_"+id).html();
        var kredit_penunjang = $("#kredit-kredit_penunjang_"+id).html();
        var total_kredit = $("#kredit-total_kredit_"+id).html();

        var sk_nomor = $("#kredit-sk_nomor_"+id).html();
        var sk_tanggal = $("#kredit-sk_tanggal_"+id).html();

        //set data
        $("#kredit-kode_bkn_kredit").val(kode_bkn_kredit);

        $("#kredit-bulan_mulai_penilaian").val(bulan_mulai_penilaian).trigger("change");
        $("#kredit-tahun_mulai_penilaian").val(tahun_mulai_penilaian);
        $("#kredit-bulan_selesai_penilaian").val(bulan_selesai_penilaian).trigger("change");
        $("#kredit-tahun_selesai_penilaian").val(tahun_selesai_penilaian);
        $("#kredit-kredit_utama").val(kredit_utama);
        $("#kredit-kredit_penunjang").val(kredit_penunjang);
        $("#kredit-total_kredit").val(total_kredit);

        $("#kredit-sk_nomor").val(sk_nomor);
        $("#kredit-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.kredit").addClass("show");
        $(".overlay-bg.kredit").addClass("show");

        $("#kredit-btn-simpan").addClass("hidden");
        $("#kredit-btn-batal").addClass("hidden");

        $("#kredit-input-alasan").removeClass("hidden");
        $("#kredit-btn-verifikasi").removeClass("hidden");
        $("#kredit-btn-tolak").removeClass("hidden");
    }
    function hapus_kredit(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/kredit")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#kredit-id_pegawai_"+id).html(),
        				nip_pegawai:$("#kredit-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('pangkat');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pangkat');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_kredit(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/kredit")?>",
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
        					get_riwayat('pangkat');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pangkat');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_kredit(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/kredit")?>",
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
        					get_riwayat('pangkat');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pangkat');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_kredit()
    {
    	$("#kredit-fileframe").attr("src","");
        $("#kredit-filelink").html("");

    	$("#kredit-id_update").val("");
    	$("#kredit-id_kredit").val("");
    	$("#kredit-kode_bkn_kredit").val("");

        $("#kredit-bulan_mulai_penilaian").val("").trigger("change");
        $("#kredit-tahun_mulai_penilaian").val("");
        $("#kredit-bulan_selesai_penilaian").val("").trigger("change");
        $("#kredit-tahun_selesai_penilaian").val("");
        $("#kredit-kredit_utama").val("");
        $("#kredit-kredit_penunjang").val("");
        $("#kredit-total_kredit").val("");

    	$("#kredit-sk_nomor").val("");
    	$("#kredit-sk_tanggal").val("");

    	$(".add-new-data.kredit").addClass("show");
    	$(".overlay-bg.kredit").addClass("show");

        $("#kredit-btn-simpan").removeClass("hidden");
        $("#kredit-btn-batal").removeClass("hidden");

        $("#kredit-input-alasan").addClass("hidden");
        $("#kredit-btn-verifikasi").addClass("hidden");
        $("#kredit-btn-tolak").addClass("hidden");
    }
</script>