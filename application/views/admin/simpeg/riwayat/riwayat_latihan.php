<section class="data-list-view-header">
	<!-- RW diklat -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Diklat Kepemimpinan <button type="button" onclick="tambah_diklat();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Jenis Diklat</th>
								<th>Nomor</th>
								<th>Nama Diklat</th>
								<th>Tanggal Mulai Diklat</th>
								<th>Tanggal Akhir Diklat <span class="fa fa-sort-desc"></span></th>
								<th>Tahun STTPL</th>
								<th>Jumlah JP</th>
								<th>Jenis Kompetensi</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($diklat as $row1): $row = $row1; ?>
								<?php foreach ($dump_diklat['update'] as $row2): ?>
									<?php
									if($row1->id_diklat == $row2->id_diklat) {
										$row = $row2;
										$row->nama_latihan = convert_data($ref_latihan,'kode_latihan',$row->kode_latihan,'nama_latihan');
										$row->nama_kompetensi = convert_data($ref_kompetensi,'kode_kompetensi',$row->kode_kompetensi,'nama_kompetensi');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_diklat['delete'] as $row2): ?>
									<?php
									if($row1->id_diklat == $row2->id_diklat) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_latihan?></td>
									<td><?=$row->no_sertifikat?></td>
									<td><?=$row->nama_diklat ?></td>
									<td><?=tanggal($row->tmt_mulai)?></td>
									<td><?=tanggal($row->tmt_berakhir)?></td>
									<td><?=$row->tahun_sptl?></td>
									<td><?=$row->bobot_kompetensi?></td>
									<td><?=$row->nama_kompetensi?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_diklat('<?=$row->id_diklat?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_diklat('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_diklat('<?=$row->id_diklat?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_diklat('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_diklat('<?=$row->id_diklat?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_diklat('<?=$row->id_diklat?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_diklat/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="diklat-<?=$k?>_<?=$row->id_diklat?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_diklat['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_latihan = convert_data($ref_latihan,'kode_latihan',$row->kode_latihan,'nama_latihan');
								$row->nama_kompetensi = convert_data($ref_kompetensi,'kode_kompetensi',$row->kode_kompetensi,'nama_kompetensi');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_latihan?></td>
									<td><?=$row->no_sertifikat?></td>
									<td><?=$row->nama_diklat ?></td>
									<td><?=tanggal($row->tmt_mulai)?></td>
									<td><?=tanggal($row->tmt_berakhir)?></td>
									<td><?=$row->tahun_sptl?></td>
									<td><?=$row->bobot_kompetensi?></td>
									<td><?=$row->nama_kompetensi?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_diklat('<?=$row->id_update?>_<?=$row->id_diklat?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_diklat('<?=$row->id_update?>_<?=$row->id_diklat?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_diklat('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_diklat/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="diklat-<?=$k?>_<?=$row->id_update?>_<?=$row->id_diklat?>"><?=$v?></var>
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
		<div class="overlay-bg diklat" onclick="close_sidebar('diklat')"></div>
		<div class="add-new-data diklat fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('diklat')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="diklat-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data diklat" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-diklat" onsubmit="submit_diklat()" enctype="multipart/form-data">
				<input type="hidden" id="diklat-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="diklat-id_update" value="" />
				<input type="hidden" name="id_diklat" id="diklat-id_diklat" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Pelatihan</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('diklat')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_diklat" id="diklat-kode_bkn_diklat" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Jenis Diklat</label>
								<select class="form-control select2" id="diklat-kode_latihan" name="kode_latihan" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_latihan as $row): ?>
										<option value="<?=$row->kode_latihan?>"><?=$row->nama_latihan?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor Sertifikat/STTPL/STTPP</label>
								<input type="text" name="no_sertifikat" id="diklat-no_sertifikat" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nama Diklat/Pelatihan</label>
								<input type="text" name="nama_diklat" id="diklat-nama_diklat" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tempat Diklat/Pelatihan</label>
								<input type="text" name="tempat_diklat" id="diklat-tempat_diklat" class="form-control" required="" placeholder="lembaga penyelenggara pelatihan">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">TMT Mulai</label>
								<input type="date" name="tmt_mulai" id="diklat-tmt_mulai" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">TMT Berakhir</label>
								<input type="date" name="tmt_berakhir" id="diklat-tmt_berakhir" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Tahun Sertifikat STTPL/STTPP</label>
								<input type="number" name="tahun_sptl" id="diklat-tahun_sptl" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Jumlah Jam Pelajaran Diklat/Pelatihan</label>
								<input type="number" name="bobot_kompetensi" id="diklat-bobot_kompetensi" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Jenis Kompetensi</label>
								<select class="form-control select2" id="diklat-kode_kompetensi" name="kode_kompetensi" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_kompetensi as $row): ?>
										<option value="<?=$row->kode_kompetensi?>"><?=$row->nama_kompetensi?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="diklat-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="diklat-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="diklat-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="diklat-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="diklat-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="diklat-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="diklat-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#diklat-input-verifikasi').val('')">Simpan</button>
						<button id="diklat-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#diklat-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="diklat-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('diklat')">Batal</button>
						<button id="diklat-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#diklat-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_diklat() {
		var formData = new FormData($('#form-diklat')[0]);
        var _csrfName = $('input#diklat-csrf').attr('name');
        var _csrfValue = $('input#diklat-csrf').val();
        var file_data = $('#diklat-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/diklat")?>",
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
					get_riwayat('latihan');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('latihan');
				}, 500);
			}
		});
	}
	function edit_diklat(id)
	{
        //alert(id);
        open_fileframe('diklat',$("#diklat-berkas_"+id).html())
        $("#diklat-filelink").html("");
        $("#diklat-filelink").html($("#diklat-berkas_"+id).html());
        $("#diklat-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_diklat/'+$("#diklat-berkas_"+id).html());

        $("#diklat-id_update").val($("#diklat-id_update_"+id).html());
        $("#diklat-id_diklat").val($("#diklat-id_diklat_"+id).html());
        //ambil data
        var kode_bkn_diklat = $("#diklat-kode_bkn_diklat_"+id).html();

        var kode_latihan = $("#diklat-kode_latihan_"+id).html();
        var no_sertifikat = $("#diklat-no_sertifikat_"+id).html();
        var nama_diklat = $("#diklat-nama_diklat_"+id).html();
        var tempat_diklat = $("#diklat-tempat_diklat_"+id).html();
        var tmt_mulai = $("#diklat-tmt_mulai_"+id).html();
        var tmt_berakhir = $("#diklat-tmt_berakhir_"+id).html();
        var tahun_sptl = $("#diklat-tahun_sptl_"+id).html();
        var bobot_kompetensi = $("#diklat-bobot_kompetensi_"+id).html();
        var kode_kompetensi = $("#diklat-kode_kompetensi_"+id).html();

        //set data
        $("#diklat-kode_bkn_diklat").val(kode_bkn_diklat);

        $("#diklat-kode_latihan").val(kode_latihan).trigger("change");
        $("#diklat-no_sertifikat").val(no_sertifikat);
        $("#diklat-nama_diklat").val(nama_diklat);
        $("#diklat-tempat_diklat").val(tempat_diklat);
        $("#diklat-tmt_mulai").val(tmt_mulai);
        $("#diklat-tmt_berakhir").val(tmt_berakhir);
        $("#diklat-tahun_sptl").val(tahun_sptl);
        $("#diklat-bobot_kompetensi").val(bobot_kompetensi);
        $("#diklat-kode_kompetensi").val(kode_kompetensi).trigger("change");

        $(".add-new-data.diklat").addClass("show");
        $(".overlay-bg.diklat").addClass("show");

        $("#diklat-btn-simpan").removeClass("hidden");
        $("#diklat-btn-batal").removeClass("hidden");

        $("#diklat-input-alasan").addClass("hidden");
        $("#diklat-btn-verifikasi").addClass("hidden");
        $("#diklat-btn-tolak").addClass("hidden");
    }
	function verifikasi_diklat(id)
	{
        //alert(id);
        open_fileframe('diklat',$("#diklat-berkas_"+id).html())
        $("#diklat-filelink").html("");
        $("#diklat-filelink").html($("#diklat-berkas_"+id).html());
        $("#diklat-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_diklat/'+$("#diklat-berkas_"+id).html());

        $("#diklat-id_update").val($("#diklat-id_update_"+id).html());
        $("#diklat-id_diklat").val($("#diklat-id_diklat_"+id).html());
        //ambil data
        var kode_bkn_diklat = $("#diklat-kode_bkn_diklat_"+id).html();

        var kode_latihan = $("#diklat-kode_latihan_"+id).html();
        var no_sertifikat = $("#diklat-no_sertifikat_"+id).html();
        var nama_diklat = $("#diklat-nama_diklat_"+id).html();
        var tempat_diklat = $("#diklat-tempat_diklat_"+id).html();
        var tmt_mulai = $("#diklat-tmt_mulai_"+id).html();
        var tmt_berakhir = $("#diklat-tmt_berakhir_"+id).html();
        var tahun_sptl = $("#diklat-tahun_sptl_"+id).html();
        var bobot_kompetensi = $("#diklat-bobot_kompetensi_"+id).html();
        var kode_kompetensi = $("#diklat-kode_kompetensi_"+id).html();

        //set data
        $("#diklat-kode_bkn_diklat").val(kode_bkn_diklat);

        $("#diklat-kode_latihan").val(kode_latihan).trigger("change");
        $("#diklat-no_sertifikat").val(no_sertifikat);
        $("#diklat-nama_diklat").val(nama_diklat);
        $("#diklat-tempat_diklat").val(tempat_diklat);
        $("#diklat-tmt_mulai").val(tmt_mulai);
        $("#diklat-tmt_berakhir").val(tmt_berakhir);
        $("#diklat-tahun_sptl").val(tahun_sptl);
        $("#diklat-bobot_kompetensi").val(bobot_kompetensi);
        $("#diklat-kode_kompetensi").val(kode_kompetensi).trigger("change");

        $(".add-new-data.diklat").addClass("show");
        $(".overlay-bg.diklat").addClass("show");

        $("#diklat-btn-simpan").addClass("hidden");
        $("#diklat-btn-batal").addClass("hidden");

        $("#diklat-input-alasan").removeClass("hidden");
        $("#diklat-btn-verifikasi").removeClass("hidden");
        $("#diklat-btn-tolak").removeClass("hidden");
    }
    function hapus_diklat(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/diklat")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#diklat-id_pegawai_"+id).html(),
        				nip_pegawai:$("#diklat-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('latihan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('latihan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_diklat(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/diklat")?>",
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
        					get_riwayat('latihan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('latihan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_diklat(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/diklat")?>",
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
        					get_riwayat('latihan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('latihan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_diklat()
    {
    	$("#diklat-fileframe").attr("src","");
        $("#diklat-filelink").html("");

    	$("#diklat-id_update").val("");
    	$("#diklat-id_diklat").val("");
    	$("#diklat-kode_bkn_diklat").val("");

    	$("#diklat-kode_latihan").val("").trigger("change");
    	$("#diklat-no_sertifikat").val("");
    	$("#diklat-nama_diklat").val("");
    	$("#diklat-tempat_diklat").val("");
    	$("#diklat-tmt_mulai").val("");
    	$("#diklat-tmt_berakhir").val("");
    	$("#diklat-tahun_sptl").val("");
    	$("#diklat-bobot_kompetensi").val("");
    	$("#diklat-kode_kompetensi").val("").trigger("change");

    	$(".add-new-data.diklat").addClass("show");
    	$(".overlay-bg.diklat").addClass("show");

        $("#diklat-btn-simpan").removeClass("hidden");
        $("#diklat-btn-batal").removeClass("hidden");

        $("#diklat-input-alasan").addClass("hidden");
        $("#diklat-btn-verifikasi").addClass("hidden");
        $("#diklat-btn-tolak").addClass("hidden");
    }
</script>

<section class="data-list-view-header">
	<!-- RW kursus -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Diklat Fungsional/Umum/Tertentu <button type="button" onclick="tambah_kursus();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<h5>Kursus/Workshop/Seminar/Sejenis</h5>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>Jenis Kursus</th>
								<th>Nomor</th>
								<th>Instansi</th>
								<th>Nama/Tema</th>
								<th>Tanggal Mulai Kursus</th>
								<th>Tanggal Akhir Kursus <span class="fa fa-sort-desc"></span></th>
								<th>Jumlah Jam</th>
								<th>Jenis Sertifikat</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($kursus as $row1): $row = $row1; ?>
								<?php foreach ($dump_kursus['update'] as $row2): ?>
									<?php
									if($row1->id_kursus == $row2->id_kursus) {
										$row = $row2;
										$row->nama_jeniskursus = convert_data($ref_jeniskursus,'kode_jeniskursus',$row->kode_jeniskursus,'nama_jeniskursus');
										$row->nama_instansi = convert_data($ref_instansi,'kode_instansi',$row->kode_instansi,'nama_instansi');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_kursus['delete'] as $row2): ?>
									<?php
									if($row1->id_kursus == $row2->id_kursus) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_jeniskursus?></td>
									<td><?=$row->no_sertifikat?></td>
									<td><?=$row->nama_instansi?></td>
									<td><?=$row->nama_kursus?></td>
									<td><?=tanggal($row->tmt_mulai)?></td>
									<td><?=tanggal($row->tmt_berakhir)?></td>
									<td><?=$row->jumlah_jam?></td>
									<td><?=$row->jenis_sertifikat?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_kursus('<?=$row->id_kursus?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_kursus('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_kursus('<?=$row->id_kursus?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_kursus('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_kursus('<?=$row->id_kursus?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_kursus('<?=$row->id_kursus?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_kursus/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="kursus-<?=$k?>_<?=$row->id_kursus?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_kursus['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_jeniskursus = convert_data($ref_jeniskursus,'kode_jeniskursus',$row->kode_jeniskursus,'nama_jeniskursus');
								$row->nama_instansi = convert_data($ref_instansi,'kode_instansi',$row->kode_instansi,'nama_instansi');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_jeniskursus?></td>
									<td><?=$row->no_sertifikat?></td>
									<td><?=$row->nama_instansi?></td>
									<td><?=$row->nama_kursus?></td>
									<td><?=tanggal($row->tmt_mulai)?></td>
									<td><?=tanggal($row->tmt_berakhir)?></td>
									<td><?=$row->jumlah_jam?></td>
									<td><?=$row->jenis_sertifikat?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_kursus('<?=$row->id_update?>_<?=$row->id_kursus?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_kursus('<?=$row->id_update?>_<?=$row->id_kursus?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_kursus('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_kursus/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="kursus-<?=$k?>_<?=$row->id_update?>_<?=$row->id_kursus?>"><?=$v?></var>
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
		<div class="overlay-bg kursus" onclick="close_sidebar('kursus')"></div>
		<div class="add-new-data kursus fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('kursus')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="kursus-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data kursus" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-kursus" onsubmit="submit_kursus()" enctype="multipart/form-data">
				<input type="hidden" id="kursus-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="kursus-id_update" value="" />
				<input type="hidden" name="id_kursus" id="kursus-id_kursus" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Kursus/ Workshop/ Seminar/ Sejenis </h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('kursus')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="chiddenol-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_kursus" id="kursus-kode_bkn_kursus" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Jenis Kursus/Diklat</label>
								<select class="form-control" id="kursus-jeniskursus" name="jeniskursus" required="">
									<option value="">-- PILIH --</option>
									<option value="F">Diklat Fungsional</option>
									<option value="T">Diklat Teknis</option>
									<option value="SW">Seminar/Workshop</option>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Kategori <small>(*boleh dikosongkan)</small></label>
								<select class="form-control select2" id="kursus-kode_jeniskursus" name="kode_jeniskursus">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_jeniskursus as $row): ?>
										<option value="<?=$row->kode_jeniskursus?>"><?=$row->nama_jeniskursus?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor Sertifikat</label>
								<input type="text" name="no_sertifikat" id="kursus-no_sertifikat" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Instansi/Lembaga Penyelenggara</label>
								<select class="form-control select2" id="kursus-kode_instansi" name="kode_instansi" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_instansi as $row): ?>
										<option value="<?=$row->kode_instansi?>"><?=$row->nama_instansi?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nama/Tema (Kursus/Diklat)</label>
								<input type="text" name="nama_kursus" id="kursus-nama_kursus" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Institusi Penyelenggara Kursus/Diklat</label>
								<input type="text" name="tempat_kursus" id="kursus-tempat_kursus" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">TMT Mulai</label>
								<input type="date" name="tmt_mulai" id="kursus-tmt_mulai" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">TMT Berakhir</label>
								<input type="date" name="tmt_berakhir" id="kursus-tmt_berakhir" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Jumlah Jam</label>
								<input type="number" name="jumlah_jam" id="kursus-jumlah_jam" class="form-control" required="">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Jenis Sertifikat</label>
								<select class="form-control" id="kursus-jenis_sertifikat" name="jenis_sertifikat" required="">
									<option value="">-- PILIH --</option>
									<option value="K">Kursus</option>
									<option value="S">Sertifikasi</option>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="kursus-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="kursus-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="kursus-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="kursus-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="kursus-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="kursus-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="kursus-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#kursus-input-verifikasi').val('')">Simpan</button>
						<button id="kursus-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#kursus-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="kursus-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('kursus')">Batal</button>
						<button id="kursus-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#kursus-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_kursus() {
		var formData = new FormData($('#form-kursus')[0]);
        var _csrfName = $('input#kursus-csrf').attr('name');
        var _csrfValue = $('input#kursus-csrf').val();
        var file_data = $('#kursus-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/kursus")?>",
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
					get_riwayat('latihan');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('latihan');
				}, 500);
			}
		});
	}
	function edit_kursus(id)
	{
        //alert(id);
        open_fileframe('kursus',$("#kursus-berkas_"+id).html())
        $("#kursus-filelink").html("");
        $("#kursus-filelink").html($("#kursus-berkas_"+id).html());
        $("#kursus-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_kursus/'+$("#kursus-berkas_"+id).html());

        $("#kursus-id_update").val($("#kursus-id_update_"+id).html());
        $("#kursus-id_kursus").val($("#kursus-id_kursus_"+id).html());
        //ambil data
        var kode_bkn_kursus = $("#kursus-kode_bkn_kursus_"+id).html();

        var jeniskursus = $("#kursus-jeniskursus_"+id).html();
        var kode_jeniskursus = $("#kursus-kode_jeniskursus_"+id).html();
        var no_sertifikat = $("#kursus-no_sertifikat_"+id).html();
        var kode_instansi = $("#kursus-kode_instansi_"+id).html();
        var nama_kursus = $("#kursus-nama_kursus_"+id).html();
        var tempat_kursus = $("#kursus-tempat_kursus_"+id).html();
        var tmt_mulai = $("#kursus-tmt_mulai_"+id).html();
        var tmt_berakhir = $("#kursus-tmt_berakhir_"+id).html();
        var jumlah_jam = $("#kursus-jumlah_jam_"+id).html();
        var jenis_sertifikat = $("#kursus-jenis_sertifikat_"+id).html();

        //set data
        $("#kursus-kode_bkn_kursus").val(kode_bkn_kursus);

        $("#kursus-jeniskursus").val(jeniskursus).trigger("change");
        $("#kursus-kode_jeniskursus").val(kode_jeniskursus).trigger("change");
        $("#kursus-no_sertifikat").val(no_sertifikat);
        $("#kursus-kode_instansi").val(kode_instansi).trigger("change");
        $("#kursus-nama_kursus").val(nama_kursus);
        $("#kursus-tempat_kursus").val(tempat_kursus);
        $("#kursus-tmt_mulai").val(tmt_mulai);
        $("#kursus-tmt_berakhir").val(tmt_berakhir);
        $("#kursus-jumlah_jam").val(jumlah_jam);
        $("#kursus-jenis_sertifikat").val(jenis_sertifikat).trigger("change");

        $(".add-new-data.kursus").addClass("show");
        $(".overlay-bg.kursus").addClass("show");

        $("#kursus-btn-simpan").removeClass("hidden");
        $("#kursus-btn-batal").removeClass("hidden");

        $("#kursus-input-alasan").addClass("hidden");
        $("#kursus-btn-verifikasi").addClass("hidden");
        $("#kursus-btn-tolak").addClass("hidden");
    }
	function verifikasi_kursus(id)
	{
        //alert(id);
        open_fileframe('kursus',$("#kursus-berkas_"+id).html())
        $("#kursus-filelink").html("");
        $("#kursus-filelink").html($("#kursus-berkas_"+id).html());
        $("#kursus-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_kursus/'+$("#kursus-berkas_"+id).html());

        $("#kursus-id_update").val($("#kursus-id_update_"+id).html());
        $("#kursus-id_kursus").val($("#kursus-id_kursus_"+id).html());
        //ambil data
        var kode_bkn_kursus = $("#kursus-kode_bkn_kursus_"+id).html();

        var jeniskursus = $("#kursus-jeniskursus_"+id).html();
        var kode_jeniskursus = $("#kursus-kode_jeniskursus_"+id).html();
        var no_sertifikat = $("#kursus-no_sertifikat_"+id).html();
        var kode_instansi = $("#kursus-kode_instansi_"+id).html();
        var nama_kursus = $("#kursus-nama_kursus_"+id).html();
        var tempat_kursus = $("#kursus-tempat_kursus_"+id).html();
        var tmt_mulai = $("#kursus-tmt_mulai_"+id).html();
        var tmt_berakhir = $("#kursus-tmt_berakhir_"+id).html();
        var jumlah_jam = $("#kursus-jumlah_jam_"+id).html();
        var jenis_sertifikat = $("#kursus-jenis_sertifikat_"+id).html();

        //set data
        $("#kursus-kode_bkn_kursus").val(kode_bkn_kursus);

        $("#kursus-jeniskursus").val(jeniskursus).trigger("change");
        $("#kursus-kode_jeniskursus").val(kode_jeniskursus).trigger("change");
        $("#kursus-no_sertifikat").val(no_sertifikat);
        $("#kursus-kode_instansi").val(kode_instansi).trigger("change");
        $("#kursus-nama_kursus").val(nama_kursus);
        $("#kursus-tempat_kursus").val(tempat_kursus);
        $("#kursus-tmt_mulai").val(tmt_mulai);
        $("#kursus-tmt_berakhir").val(tmt_berakhir);
        $("#kursus-jumlah_jam").val(jumlah_jam);
        $("#kursus-jenis_sertifikat").val(jenis_sertifikat).trigger("change");

        $(".add-new-data.kursus").addClass("show");
        $(".overlay-bg.kursus").addClass("show");

        $("#kursus-btn-simpan").addClass("hidden");
        $("#kursus-btn-batal").addClass("hidden");

        $("#kursus-input-alasan").removeClass("hidden");
        $("#kursus-btn-verifikasi").removeClass("hidden");
        $("#kursus-btn-tolak").removeClass("hidden");
    }
    function hapus_kursus(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/kursus")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#kursus-id_pegawai_"+id).html(),
        				nip_pegawai:$("#kursus-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('latihan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('latihan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_kursus(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/kursus")?>",
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
        					get_riwayat('latihan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('latihan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_kursus(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/kursus")?>",
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
        					get_riwayat('latihan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('latihan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_kursus()
    {
    	$("#kursus-fileframe").attr("src","");
        $("#kursus-filelink").html("");

    	$("#kursus-id_update").val("");
    	$("#kursus-id_kursus").val("");
    	$("#kursus-kode_bkn_kursus").val("");

        $("#kursus-jeniskursus").val("").trigger("change");
        $("#kursus-kode_jeniskursus").val("").trigger("change");
        $("#kursus-no_sertifikat").val("");
        $("#kursus-kode_instansi").val("").trigger("change");
        $("#kursus-nama_kursus").val("");
        $("#kursus-tempat_kursus").val("");
        $("#kursus-tmt_mulai").val("");
        $("#kursus-tmt_berakhir").val("");
        $("#kursus-jumlah_jam").val("");
        $("#kursus-jenis_sertifikat").val("").trigger("change");

    	$(".add-new-data.kursus").addClass("show");
    	$(".overlay-bg.kursus").addClass("show");

        $("#kursus-btn-simpan").removeClass("hidden");
        $("#kursus-btn-batal").removeClass("hidden");

        $("#kursus-input-alasan").addClass("hidden");
        $("#kursus-btn-verifikasi").addClass("hidden");
        $("#kursus-btn-tolak").addClass("hidden");
    }
</script>
