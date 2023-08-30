<section class="data-list-view-header">
	<!-- RW pendidikan -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Pendidikan <button type="button" onclick="tambah_pendidikan();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>No. Ijazah</th>
								<th>Sekolah/PT</th>
								<th>Jenjang</th>
								<th>Jurusan</th>
								<th>Tahun Lulus <span class="fa fa-sort-desc"></span></th>
								<th>IPK</th>
								<th>Akreditasi</th>
								<th>Gelar Depan</th>
								<th>Gelar Belakang</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pendidikan as $row1): $row = $row1; ?>
								<?php foreach ($dump_pendidikan['update'] as $row2): ?>
									<?php
									if($row1->id_pendidikan == $row2->id_pendidikan) {
										$row = $row2;
										$row->nama_tingkatpendidikan = convert_data($ref_tingkatpendidikan,'kode_tingkatpendidikan',$row->kode_tingkatpendidikan,'nama_tingkatpendidikan');
										$row->nama_pendidikan = convert_data($ref_pendidikan,'kode_pendidikan',$row->kode_pendidikan,'nama_pendidikan');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_pendidikan['delete'] as $row2): ?>
									<?php
									if($row1->id_pendidikan == $row2->id_pendidikan) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->no_ijazah?></td>
									<td><?=$row->nama_instansi?></td>
									<td><?=$row->nama_tingkatpendidikan?></td>
									<td><?=$row->nama_pendidikan?></td>
									<td><?=$row->tahun_lulus?></td>
									<td><?=$row->nilai_ipk?></td>
									<td><?=$row->akreditasi?></td>
									<td><?=$row->gelar_depan?></td>
									<td><?=$row->gelar_belakang?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_pendidikan('<?=$row->id_pendidikan?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_pendidikan('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_pendidikan('<?=$row->id_pendidikan?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_pendidikan('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_pendidikan('<?=$row->id_pendidikan?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_pendidikan('<?=$row->id_pendidikan?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_pendidikan/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="pendidikan-<?=$k?>_<?=$row->id_pendidikan?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_pendidikan['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_tingkatpendidikan = convert_data($ref_tingkatpendidikan,'kode_tingkatpendidikan',$row->kode_tingkatpendidikan,'nama_tingkatpendidikan');
								$row->nama_pendidikan = convert_data($ref_pendidikan,'kode_pendidikan',$row->kode_pendidikan,'nama_pendidikan');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->no_ijazah?></td>
									<td><?=$row->nama_instansi?></td>
									<td><?=$row->nama_tingkatpendidikan?></td>
									<td><?=$row->nama_pendidikan?></td>
									<td><?=$row->tahun_lulus?></td>
									<td><?=$row->nilai_ipk?></td>
									<td><?=$row->akreditasi?></td>
									<td><?=$row->gelar_depan?></td>
									<td><?=$row->gelar_belakang?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_pendidikan('<?=$row->id_update?>_<?=$row->id_pendidikan?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_pendidikan('<?=$row->id_update?>_<?=$row->id_pendidikan?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_pendidikan('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_pendidikan/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="pendidikan-<?=$k?>_<?=$row->id_update?>_<?=$row->id_pendidikan?>"><?=$v?></var>
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
		<div class="overlay-bg pendidikan" onclick="close_sidebar('pendidikan')"></div>
		<div class="add-new-data pendidikan fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('pendidikan')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="pendidikan-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data pendidikan" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-pendidikan" onsubmit="submit_pendidikan()" enctype="multipart/form-data">
				<input type="hidden" id="pendidikan-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="pendidikan-id_update" value="" />
				<input type="hidden" name="id_pendidikan" id="pendidikan-id_pendidikan" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Pendidikann</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('pendidikan')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_pendidikan" id="pendidikan-kode_bkn_pendidikan" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">No. Ijazah</label>
								<input type="text" name="no_ijazah" id="pendidikan-no_ijazah" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Sekolah/Perguruan Tinggi</label>
								<input type="text" name="nama_instansi" id="pendidikan-nama_instansi" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nama Penandatanganan Ijazah</label>
								<input type="text" name="nama_kepala_instansi" id="pendidikan-nama_kepala_instansi" class="form-control">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Jenjang Pendidikan</label>
								<select class="form-control select2" id="pendidikan-kode_tingkatpendidikan" name="kode_tingkatpendidikan" required="" onchange="pendidikan_select_tingkatpendidikan()">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_tingkatpendidikan as $row): ?>
										<option value="<?=$row->kode_tingkatpendidikan?>"><?=$row->nama_tingkatpendidikan?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Jurusan</label>
								<select class="form-control select2" id="pendidikan-kode_pendidikan" name="kode_pendidikan" required="">
									<option value="">-- PILIH --</option>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tahun Lulus</label>
								<input type="number" name="tahun_lulus" id="pendidikan-tahun_lulus" class="form-control" required="">
							</div>
							<div id="pendidikan-kuliah">
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Nilai IPK</label>
								<input type="number" step="0.01" max="4" name="nilai_ipk" id="pendidikan-nilai_ipk" class="form-control">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Akreditasi</label>
								<select name="akreditasi" id="pendidikan-akreditasi" class="form-control">
									<option value="">-- PILIH --</option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
									<option value="LN">Luar Negeri</option>
									<option value="-">Belum Terakreditasi</option>
								</select>
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Gelar Depan</label>
								<input type="text" name="gelar_depan" id="pendidikan-gelar_depan" class="form-control">
							</div>
							<div class="col-sm-6 data-field-col">
								<label for="data-name">Gelar Belakang</label>
								<input type="text" name="gelar_belakang" id="pendidikan-gelar_belakang" class="form-control">
							</div>
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="pendidikan-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="pendidikan-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="pendidikan-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="pendidikan-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="pendidikan-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="pendidikan-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="pendidikan-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#pendidikan-input-verifikasi').val('')">Simpan</button>
						<button id="pendidikan-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#pendidikan-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="pendidikan-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('pendidikan')">Batal</button>
						<button id="pendidikan-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#pendidikan-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script type="text/javascript">
	var pendidikan = <?=json_encode($ref_pendidikan)?>;

	function pendidikan_select_tingkatpendidikan() {
		var selected = $('#pendidikan-kode_tingkatpendidikan').val();
		var option = "<option value=\"\">-- PILIH --</option>";
		for (var i = pendidikan.length - 1; i >= 0; i--) {
			if (pendidikan[i]['kode_tingkatpendidikan'] == selected) {
				option += "<option value=\""+String(pendidikan[i]['kode_pendidikan'])+"\">"+String(pendidikan[i]['nama_pendidikan'])+"</option>";
			}
		}
		$('#pendidikan-kode_pendidikan').html(option);
		$('#pendidikan-kode_pendidikan').select2();

		if (selected >= 20) {
			$('#pendidikan-kuliah').removeClass("hidden");
			$('#pendidikan-nilai_ipk').attr("disabled",false);
			$('#pendidikan-akreditasi').attr("disabled",false);
			$('#pendidikan-gelar_depan').attr("disabled",false);
			$('#pendidikan-gelar_belakang').attr("disabled",false);
		} else {
			$('#pendidikan-kuliah').addClass("hidden");
			$('#pendidikan-nilai_ipk').attr("disabled",true);
			$('#pendidikan-akreditasi').attr("disabled",true);
			$('#pendidikan-gelar_depan').attr("disabled",true);
			$('#pendidikan-gelar_belakang').attr("disabled",true);
		}
	}
</script>

<script>
	function submit_pendidikan() {
		var formData = new FormData($('#form-pendidikan')[0]);
        var _csrfName = $('input#pendidikan-csrf').attr('name');
        var _csrfValue = $('input#pendidikan-csrf').val();
        var file_data = $('#pendidikan-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/pendidikan")?>",
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
					get_riwayat('pendidikan');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('pendidikan');
				}, 500);
			}
		});
	}
	function edit_pendidikan(id)
	{
        //alert(id);
        open_fileframe('pendidikan',$("#pendidikan-berkas_"+id).html())
        $("#pendidikan-filelink").html("");
        $("#pendidikan-filelink").html($("#pendidikan-berkas_"+id).html());
        $("#pendidikan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_pendidikan/'+$("#pendidikan-berkas_"+id).html());

        $("#pendidikan-id_update").val($("#pendidikan-id_update_"+id).html());
        $("#pendidikan-id_pendidikan").val($("#pendidikan-id_pendidikan_"+id).html());
        //ambil data
        var kode_bkn_pendidikan = $("#pendidikan-kode_bkn_pendidikan_"+id).html();

        var no_ijazah = $("#pendidikan-no_ijazah_"+id).html();
        var nama_instansi = $("#pendidikan-nama_instansi_"+id).html();
        var nama_kepala_instansi = $("#pendidikan-nama_kepala_instansi_"+id).html();
        var kode_tingkatpendidikan = $("#pendidikan-kode_tingkatpendidikan_"+id).html();
        var kode_pendidikan = $("#pendidikan-kode_pendidikan_"+id).html();
        var tahun_lulus = $("#pendidikan-tahun_lulus_"+id).html();
        var nilai_ipk = $("#pendidikan-nilai_ipk_"+id).html();
        var akreditasi = $("#pendidikan-akreditasi_"+id).html();
        var gelar_depan = $("#pendidikan-gelar_depan_"+id).html();
        var gelar_belakang = $("#pendidikan-gelar_belakang_"+id).html();

        //set data
        $("#pendidikan-kode_bkn_pendidikan").val(kode_bkn_pendidikan);

        $("#pendidikan-no_ijazah").val(no_ijazah);
        $("#pendidikan-nama_instansi").val(nama_instansi);
        $("#pendidikan-nama_kepala_instansi").val(nama_kepala_instansi);
        $("#pendidikan-kode_tingkatpendidikan").val(kode_tingkatpendidikan).trigger("change");
        $("#pendidikan-kode_pendidikan").val(kode_pendidikan).trigger("change");
        $("#pendidikan-tahun_lulus").val(tahun_lulus);
        $("#pendidikan-nilai_ipk").val(nilai_ipk);
        $("#pendidikan-akreditasi").val(akreditasi).trigger("change");
        $("#pendidikan-gelar_depan").val(gelar_depan);
        $("#pendidikan-gelar_belakang").val(gelar_belakang);

        $(".add-new-data.pendidikan").addClass("show");
        $(".overlay-bg.pendidikan").addClass("show");

        $("#pendidikan-btn-simpan").removeClass("hidden");
        $("#pendidikan-btn-batal").removeClass("hidden");

        $("#pendidikan-input-alasan").addClass("hidden");
        $("#pendidikan-btn-verifikasi").addClass("hidden");
        $("#pendidikan-btn-tolak").addClass("hidden");
    }
	function verifikasi_pendidikan(id)
	{
        //alert(id);
        open_fileframe('pendidikan',$("#pendidikan-berkas_"+id).html())
        $("#pendidikan-filelink").html("");
        $("#pendidikan-filelink").html($("#pendidikan-berkas_"+id).html());
        $("#pendidikan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_pendidikan/'+$("#pendidikan-berkas_"+id).html());

        $("#pendidikan-id_update").val($("#pendidikan-id_update_"+id).html());
        $("#pendidikan-id_pendidikan").val($("#pendidikan-id_pendidikan_"+id).html());
        //ambil data
        var kode_bkn_pendidikan = $("#pendidikan-kode_bkn_pendidikan_"+id).html();

        var no_ijazah = $("#pendidikan-no_ijazah_"+id).html();
        var nama_instansi = $("#pendidikan-nama_instansi_"+id).html();
        var nama_kepala_instansi = $("#pendidikan-nama_kepala_instansi_"+id).html();
        var kode_tingkatpendidikan = $("#pendidikan-kode_tingkatpendidikan_"+id).html();
        var kode_pendidikan = $("#pendidikan-kode_pendidikan_"+id).html();
        var tahun_lulus = $("#pendidikan-tahun_lulus_"+id).html();
        var nilai_ipk = $("#pendidikan-nilai_ipk_"+id).html();
        var akreditasi = $("#pendidikan-akreditasi_"+id).html();
        var gelar_depan = $("#pendidikan-gelar_depan_"+id).html();
        var gelar_belakang = $("#pendidikan-gelar_belakang_"+id).html();

        //set data
        $("#pendidikan-kode_bkn_pendidikan").val(kode_bkn_pendidikan);

        $("#pendidikan-no_ijazah").val(no_ijazah);
        $("#pendidikan-nama_instansi").val(nama_instansi);
        $("#pendidikan-nama_kepala_instansi").val(nama_kepala_instansi);
        $("#pendidikan-kode_tingkatpendidikan").val(kode_tingkatpendidikan).trigger("change");
        $("#pendidikan-kode_pendidikan").val(kode_pendidikan).trigger("change");
        $("#pendidikan-tahun_lulus").val(tahun_lulus);
        $("#pendidikan-nilai_ipk").val(nilai_ipk);
        $("#pendidikan-akreditasi").val(akreditasi).trigger("change");
        $("#pendidikan-gelar_depan").val(gelar_depan);
        $("#pendidikan-gelar_belakang").val(gelar_belakang);

        $(".add-new-data.pendidikan").addClass("show");
        $(".overlay-bg.pendidikan").addClass("show");

        $("#pendidikan-btn-simpan").addClass("hidden");
        $("#pendidikan-btn-batal").addClass("hidden");

        $("#pendidikan-input-alasan").removeClass("hidden");
        $("#pendidikan-btn-verifikasi").removeClass("hidden");
        $("#pendidikan-btn-tolak").removeClass("hidden");
    }
    function hapus_pendidikan(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/pendidikan")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#pendidikan-id_pegawai_"+id).html(),
        				nip_pegawai:$("#pendidikan-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('pendidikan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pendidikan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_pendidikan(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/pendidikan")?>",
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
        					get_riwayat('pendidikan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pendidikan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_pendidikan(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/pendidikan")?>",
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
        					get_riwayat('pendidikan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pendidikan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_pendidikan()
    {
    	$("#pendidikan-fileframe").attr("src","");
        $("#pendidikan-filelink").html("");

    	$("#pendidikan-id_update").val("");
    	$("#pendidikan-id_pendidikan").val("");
    	$("#pendidikan-kode_bkn_pendidikan").val("");

    	$("#pendidikan-no_ijazah").val("");
    	$("#pendidikan-nama_instansi").val("");
    	$("#pendidikan-nama_kepala_instansi").val("");
    	$("#pendidikan-kode_tingkatpendidikan").val("").trigger("change");
    	$("#pendidikan-kode_pendidikan").val("").trigger("change");
    	$("#pendidikan-tahun_lulus").val("");
    	$("#pendidikan-nilai_ipk").val("");
    	$("#pendidikan-akreditasi").val("").trigger("change");
    	$("#pendidikan-gelar_depan").val("");
    	$("#pendidikan-gelar_belakang").val("");

    	$(".add-new-data.pendidikan").addClass("show");
    	$(".overlay-bg.pendidikan").addClass("show");

        $("#pendidikan-btn-simpan").removeClass("hidden");
        $("#pendidikan-btn-batal").removeClass("hidden");

        $("#pendidikan-input-alasan").addClass("hidden");
        $("#pendidikan-btn-verifikasi").addClass("hidden");
        $("#pendidikan-btn-tolak").addClass("hidden");
    }
</script>



<section class="data-list-view-header">
	<!-- RW profesi -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Profesi <button type="button" onclick="tambah_profesi();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>No. Sertifikat</th>
								<th>Instansi</th>
								<th>Profesi</th>
								<th>Tahun Lulus <span class="fa fa-sort-desc"></span></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($profesi as $row1): $row = $row1; ?>
								<?php foreach ($dump_profesi['update'] as $row2): ?>
									<?php
									if($row1->id_profesi == $row2->id_profesi) {
										$row = $row2;
										$row->nama_profesi = convert_data($ref_profesi,'kode_profesi',$row->kode_profesi,'nama_profesi');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_profesi['delete'] as $row2): ?>
									<?php
									if($row1->id_profesi == $row2->id_profesi) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->no_sertifikat?></td>
									<td><?=$row->nama_instansi?></td>
									<td><?=$row->nama_profesi?></td>
									<td><?=$row->tahun_lulus?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_profesi('<?=$row->id_profesi?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_profesi('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_profesi('<?=$row->id_profesi?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_profesi('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_profesi('<?=$row->id_profesi?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_profesi('<?=$row->id_profesi?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_profesi/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="profesi-<?=$k?>_<?=$row->id_profesi?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_profesi['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_profesi = convert_data($ref_profesi,'kode_profesi',$row->kode_profesi,'nama_profesi');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->no_sertifikat?></td>
									<td><?=$row->nama_instansi?></td>
									<td><?=$row->nama_profesi?></td>
									<td><?=$row->tahun_lulus?></td>
									<td><div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div></td>
									<td>
										<?php if (@$row->status_verifikasi == "Ditolak"): ?>	
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_profesi('<?=$row->id_update?>_<?=$row->id_profesi?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_profesi('<?=$row->id_update?>_<?=$row->id_profesi?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_profesi('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_profesi/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="profesi-<?=$k?>_<?=$row->id_update?>_<?=$row->id_profesi?>"><?=$v?></var>
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
		<div class="overlay-bg profesi" onclick="close_sidebar('profesi')"></div>
		<div class="add-new-data profesi fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('profesi')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="profesi-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data profesi" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-profesi" onsubmit="submit_profesi()" enctype="multipart/form-data">
				<input type="hidden" id="profesi-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="profesi-id_update" value="" />
				<input type="hidden" name="id_profesi" id="profesi-id_profesi" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Profesi</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('profesi')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_profesi" id="profesi-kode_bkn_profesi" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">No. Sertifikat</label>
								<input type="text" name="no_sertifikat" id="profesi-no_sertifikat" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Instansi</label>
								<input type="text" name="nama_instansi" id="profesi-nama_instansi" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Profesi</label>
								<select class="form-control select2" id="profesi-kode_profesi" name="kode_profesi" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_profesi as $row): ?>
										<option value="<?=$row->kode_profesi?>"><?=$row->nama_profesi?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tahun Lulus</label>
								<input type="number" name="tahun_lulus" id="profesi-tahun_lulus" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="profesi-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="profesi-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="profesi-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="profesi-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="profesi-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="profesi-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="profesi-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#profesi-input-verifikasi').val('')">Simpan</button>
						<button id="profesi-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#profesi-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="profesi-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('profesi')">Batal</button>
						<button id="profesi-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#profesi-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_profesi() {
		var formData = new FormData($('#form-profesi')[0]);
        var _csrfName = $('input#profesi-csrf').attr('name');
        var _csrfValue = $('input#profesi-csrf').val();
        var file_data = $('#profesi-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/profesi")?>",
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
					get_riwayat('pendidikan');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('pendidikan');
				}, 500);
			}
		});
	}
	function edit_profesi(id)
	{
        //alert(id);
        open_fileframe('profesi',$("#profesi-berkas_"+id).html())
        $("#profesi-filelink").html("");
        $("#profesi-filelink").html($("#profesi-berkas_"+id).html());
        $("#profesi-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_profesi/'+$("#profesi-berkas_"+id).html());

        $("#profesi-id_update").val($("#profesi-id_update_"+id).html());
        $("#profesi-id_profesi").val($("#profesi-id_profesi_"+id).html());
        //ambil data
        var kode_bkn_profesi = $("#profesi-kode_bkn_profesi_"+id).html();

        var no_sertifikat = $("#profesi-no_sertifikat_"+id).html();
        var nama_instansi = $("#profesi-nama_instansi_"+id).html();
        var kode_profesi = $("#profesi-kode_profesi_"+id).html();
        var tahun_lulus = $("#profesi-tahun_lulus_"+id).html();

        //set data
        $("#profesi-kode_bkn_profesi").val(kode_bkn_profesi);

        $("#profesi-no_sertifikat").val(no_sertifikat);
        $("#profesi-nama_instansi").val(nama_instansi);
        $("#profesi-kode_profesi").val(kode_profesi).trigger("change");
        $("#profesi-tahun_lulus").val(tahun_lulus);

        $(".add-new-data.profesi").addClass("show");
        $(".overlay-bg.profesi").addClass("show");

        $("#profesi-btn-simpan").removeClass("hidden");
        $("#profesi-btn-batal").removeClass("hidden");

        $("#profesi-input-alasan").addClass("hidden");
        $("#profesi-btn-verifikasi").addClass("hidden");
        $("#profesi-btn-tolak").addClass("hidden");
    }
	function verifikasi_profesi(id)
	{
        //alert(id);
        open_fileframe('profesi',$("#profesi-berkas_"+id).html())
        $("#profesi-filelink").html("");
        $("#profesi-filelink").html($("#profesi-berkas_"+id).html());
        $("#profesi-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_profesi/'+$("#profesi-berkas_"+id).html());

        $("#profesi-id_update").val($("#profesi-id_update_"+id).html());
        $("#profesi-id_profesi").val($("#profesi-id_profesi_"+id).html());
        //ambil data
        var kode_bkn_profesi = $("#profesi-kode_bkn_profesi_"+id).html();

        var no_sertifikat = $("#profesi-no_sertifikat_"+id).html();
        var nama_instansi = $("#profesi-nama_instansi_"+id).html();
        var kode_profesi = $("#profesi-kode_profesi_"+id).html();
        var tahun_lulus = $("#profesi-tahun_lulus_"+id).html();

        //set data
        $("#profesi-kode_bkn_profesi").val(kode_bkn_profesi);

        $("#profesi-no_sertifikat").val(no_sertifikat);
        $("#profesi-nama_instansi").val(nama_instansi);
        $("#profesi-kode_profesi").val(kode_profesi).trigger("change");
        $("#profesi-tahun_lulus").val(tahun_lulus);

        $(".add-new-data.profesi").addClass("show");
        $(".overlay-bg.profesi").addClass("show");

        $("#profesi-btn-simpan").addClass("hidden");
        $("#profesi-btn-batal").addClass("hidden");

        $("#profesi-input-alasan").removeClass("hidden");
        $("#profesi-btn-verifikasi").removeClass("hidden");
        $("#profesi-btn-tolak").removeClass("hidden");
    }
    function hapus_profesi(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/profesi")?>",
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
        					get_riwayat('pendidikan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pendidikan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_profesi(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/profesi")?>",
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
        					get_riwayat('pendidikan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pendidikan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_profesi(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/profesi")?>",
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
        					get_riwayat('pendidikan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('pendidikan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_profesi()
    {
    	$("#profesi-fileframe").attr("src","");
        $("#profesi-filelink").html("");

    	$("#profesi-id_update").val("");
    	$("#profesi-id_profesi").val("");
    	$("#profesi-kode_bkn_profesi").val("");

    	$("#profesi-no_sertifikat").val("");
    	$("#profesi-nama_instansi").val("");
    	$("#profesi-kode_profesi").val("").trigger("change");
    	$("#profesi-tahun_lulus").val("");

    	$(".add-new-data.profesi").addClass("show");
    	$(".overlay-bg.profesi").addClass("show");

        $("#profesi-btn-simpan").removeClass("hidden");
        $("#profesi-btn-batal").removeClass("hidden");

        $("#profesi-input-alasan").addClass("hidden");
        $("#profesi-btn-verifikasi").addClass("hidden");
        $("#profesi-btn-tolak").addClass("hidden");
    }
</script>
