<section class="data-list-view-header">
	<!-- RW jabatan -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Jabatan <button type="button" onclick="tambah_jabatan();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>SKPD</th>
								<th>Unit Kerja</th>
								<th>Jabatan</th>
								<th>Eselon</th>
								<th>Berlaku TMT <span class="fa fa-sort-desc"></span></th>
								<th>Berakhir TMT</th>
								<th>SK Nomor</th>
								<th>SK Tanggal</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($jabatan as $row1): $row = $row1; ?>
								<?php foreach ($dump_jabatan['update'] as $row2): ?>
									<?php
									if($row1->id_jabatan == $row2->id_jabatan) {
										$row = $row2;
										$row->nama_jabatan = convert_data($ref_jabatan,'id_jabatan',$row->id_ref_jabatan,'nama_jabatan');
										// $row->id_skpd = convert_data($ref_jabatan,'id_jabatan',$row->id_ref_jabatan,'id_skpd');
										// $row->id_unit_kerja = convert_data($ref_jabatan,'id_jabatan',$row->id_ref_jabatan,'id_unit_kerja');
										$row->nama_skpd = convert_data($ref_skpd,'id_skpd',$row->id_skpd,'nama_skpd');
										$row->nama_unit_kerja = convert_data($ref_unit_kerja,'id_unit_kerja',$row->id_unit_kerja,'nama_unit_kerja');
										$row->nama_eselon = $row->id_ref_eselon > 0 ? convert_data($ref_eselon,'id_eselon',$row->id_ref_eselon,'nama_eselon') : '';
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_jabatan['delete'] as $row2): ?>
									<?php
									if($row1->id_jabatan == $row2->id_jabatan) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=($row->id_skpd>0)?$row->nama_skpd:$row->skpd_lainnya?></td>
									<td><?=($row->id_unit_kerja>0)?$row->nama_unit_kerja:$row->unit_kerja_lainnya?></td>
									<td>
										<?=($row->id_ref_jabatan>0)?$row->nama_jabatan:$row->ref_jabatan_lainnya?>
										<?php if ($row->plt == "Y"): ?>
											<span class="badge badge-secondary">PLT</span>
										<?php endif ?>
									</td>
									<td><?=$row->nama_eselon?></td>
									<td><?=tanggal($row->tmt_berlaku)?></td>
									<td><?=($row->tmt_berakhir) ? tanggal($row->tmt_berakhir) : "Sampai sekarang"?></td>
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
										<button type="button" onclick="verifikasi_jabatan('<?=$row->id_jabatan?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_jabatan('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_jabatan('<?=$row->id_jabatan?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_jabatan('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_jabatan('<?=$row->id_jabatan?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_jabatan('<?=$row->id_jabatan?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_jabatan/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="jabatan-<?=$k?>_<?=$row->id_jabatan?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_jabatan['insert'] as $row1): $row = $row1; ?>
								<?php
								$row->nama_jabatan = convert_data($ref_jabatan,'id_jabatan',$row->id_ref_jabatan,'nama_jabatan');
								// $row->id_skpd = convert_data($ref_jabatan,'id_jabatan',$row->id_ref_jabatan,'id_skpd');
								// $row->id_unit_kerja = convert_data($ref_jabatan,'id_jabatan',$row->id_ref_jabatan,'id_unit_kerja');
								$row->nama_skpd = convert_data($ref_skpd,'id_skpd',$row->id_skpd,'nama_skpd');
								$row->nama_unit_kerja = convert_data($ref_unit_kerja,'id_unit_kerja',$row->id_unit_kerja,'nama_unit_kerja');
								$row->nama_eselon = convert_data($ref_eselon,'id_eselon',$row->id_ref_eselon,'nama_eselon');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=($row->id_skpd>0)?$row->nama_skpd:$row->skpd_lainnya?></td>
									<td><?=($row->id_unit_kerja>0)?$row->nama_unit_kerja:$row->unit_kerja_lainnya?></td>
									<td>
										<?php if ($row->plt == "Y"): ?>
											<span class="badge badge-secondary">PLT</span>
										<?php endif ?>
										<?=($row->id_ref_jabatan>0)?$row->nama_jabatan:$row->ref_jabatan_lainnya?>
									</td>
									<td><?=$row->nama_eselon?></td>
									<td><?=tanggal($row->tmt_berlaku)?></td>
									<td><?=($row->tmt_berakhir) ? tanggal($row->tmt_berakhir) : "Sampai sekarang"?></td>
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
										<button type="button" onclick="verifikasi_jabatan('<?=$row->id_update?>_<?=$row->id_jabatan?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_jabatan('<?=$row->id_update?>_<?=$row->id_jabatan?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_jabatan('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_jabatan/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="jabatan-<?=$k?>_<?=$row->id_update?>_<?=$row->id_jabatan?>"><?=$v?></var>
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
		<div class="overlay-bg jabatan" onclick="close_sidebar('jabatan')"></div>
		<div class="add-new-data jabatan fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('jabatan')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="jabatan-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data jabatan" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-jabatan" onsubmit="submit_jabatan()" enctype="multipart/form-data">
				<input type="hidden" id="jabatan-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="jabatan-id_update" value="" />
				<input type="hidden" name="id_jabatan" id="jabatan-id_jabatan" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Jabatan</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('jabatan')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_jabatan" id="jabatan-kode_bkn_jabatan" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">SKPD</label>
								<select class="form-control select2" id="jabatan-id_skpd" name="id_skpd" onchange="jabatan_select_skpd()">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_skpd as $row): ?>
										<option value="<?=$row->id_skpd?>"><?=$row->nama_skpd?></option>
									<?php endforeach ?>
								</select>
								<label class="pull-right"><input type="checkbox" onchange="$('#jabatan-id_skpd').attr('disabled', $(this).is(':checked'));$('#jabatan-skpd_lainnya').attr('hidden', !$(this).is(':checked'));" name="id_skpd" value="0"> Lainnya</label>
								<input type="text" name="skpd_lainnya" id="jabatan-skpd_lainnya" class="form-control" hidden>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Unit Kerja</label>
								<select class="form-control select2" id="jabatan-id_unit_kerja" name="id_unit_kerja" onchange="jabatan_select_unit_kerja()">
									<option value="">-- PILIH --</option>
								</select>
								<label class="pull-right"><input type="checkbox" onchange="$('#jabatan-id_unit_kerja').attr('disabled', $(this).is(':checked'));$('#jabatan-unit_kerja_lainnya').attr('hidden', !$(this).is(':checked'));" name="id_unit_kerja" value="0"> Lainnya</label>
								<input type="text" name="unit_kerja_lainnya" id="jabatan-unit_kerja_lainnya" class="form-control" hidden>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Jabatan</label>
								<select class="form-control select2" id="jabatan-id_ref_jabatan" name="id_ref_jabatan" required="" onchange="jabatan_select_jabatan();">
									<option value="">-- PILIH --</option>
								</select>
								<label class="pull-right"><input type="checkbox" onchange="$('#jabatan-id_ref_jabatan').attr('disabled', $(this).is(':checked'));$('#jabatan-ref_jabatan_lainnya').attr('hidden', !$(this).is(':checked'));" name="id_ref_jabatan" value="0"> Lainnya</label>
								<input type="text" name="ref_jabatan_lainnya" id="jabatan-ref_jabatan_lainnya" class="form-control" hidden>
							</div>
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode Jabatan</label> -->
								<input type="hidden" name="kode_jabatan" id="jabatan-kode_jabatan" class="form-control">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Eselon</label>
								<select class="form-control select2" id="jabatan-id_ref_eselon" name="id_ref_eselon" required="" onchange="jabatan_select_eselon();">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_eselon as $row): ?>
										<option value="<?=$row->id_eselon?>">(<?=$row->nama_eselon?>) <?=$row->jabatan_asn?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col" id="jabatan-plt-hidden" hidden>
	                            <div class="custom-control custom-checkbox">
	                                <input type="hidden" name="plt" value="">
	                                <input type="checkbox" class="custom-control-input" id="jabatan-plt" name="plt" value="Y" disabled>
	                                <label class="custom-control-label" for="jabatan-plt">Pelatihan Tugas (PLT)</label>
	                            </div>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">TMT Berlaku</label>
								<input type="date" name="tmt_berlaku" id="jabatan-tmt_berlaku" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">TMT Berakhir</label>
								<label class="pull-right"><input type="checkbox" onchange="$('#jabatan-tmt_berakhir').attr('disabled', $(this).is(':checked'));" name="tmt_berakhir" value=""> Sampai sekarang</label>
								<input type="date" name="tmt_berakhir" id="jabatan-tmt_berakhir" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor SK</label>
								<input type="text" name="sk_nomor" id="jabatan-sk_nomor" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tanggal SK</label>
								<input type="date" name="sk_tanggal" id="jabatan-sk_tanggal" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="jabatan-berkas" accept="application/pdf" required="">
                                        <label class="custom-file-label" for="jabatan-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="jabatan-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="jabatan-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="jabatan-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="jabatan-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="jabatan-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#jabatan-input-verifikasi').val('')">Simpan</button>
						<button id="jabatan-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#jabatan-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="jabatan-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('jabatan')">Batal</button>
						<button id="jabatan-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#jabatan-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script type="text/javascript">
	var unit_kerja = <?=json_encode($ref_unit_kerja)?>;
	var jabatan = <?=json_encode($ref_jabatan)?>;
	var eselon = <?=json_encode($ref_eselon)?>;

	function jabatan_select_skpd() {
		var selected = $('#jabatan-id_skpd').val();
		var option = "<option value=\"\">-- PILIH --</option>";
		for (var i = unit_kerja.length - 1; i >= 0; i--) {
			if (unit_kerja[i]['id_skpd'] == selected) {
				option += "<option value=\""+String(unit_kerja[i]['id_unit_kerja'])+"\">"+String(unit_kerja[i]['nama_unit_kerja'])+"</option>";
			}
		}
		$('#jabatan-id_unit_kerja').html(option);
		$('#jabatan-id_unit_kerja').select2();
		jabatan_select_unit_kerja();
	}

	function jabatan_select_unit_kerja() {
		var selected = $('#jabatan-id_skpd').val();
		var selected2 = $('#jabatan-id_unit_kerja').val();
		var option = "<option value=\"\">-- PILIH --</option>";
		if (selected || selected2) {
			for (var i = jabatan.length - 1; i >= 0; i--) {
				if (jabatan[i]['id_unit_kerja'] == selected2 && selected2) {
					option += "<option value=\""+String(jabatan[i]['id_jabatan'])+"\">"+String(jabatan[i]['nama_jabatan'])+" - "+String(jabatan[i]['jenis_jabatan'])+"</option>";
				} else if (jabatan[i]['id_skpd'] == selected && !selected2) {
					option += "<option value=\""+String(jabatan[i]['id_jabatan'])+"\">"+String(jabatan[i]['nama_jabatan'])+" - "+String(jabatan[i]['jenis_jabatan'])+"</option>";
				}
			}
		}
		$('#jabatan-id_ref_jabatan').html(option);
		$('#jabatan-id_ref_jabatan').select2();
	}

	function jabatan_select_jabatan() {
		var selected = jabatan.find(x => x.id_jabatan === $('#jabatan-id_ref_jabatan').val());
		if (selected) {
			$('#jabatan-kode_jabatan').val(selected['kode_jabatan']);
		}
	}

	function jabatan_select_eselon() {
		var selected = eselon.find(x => x.id_eselon === $('#jabatan-id_ref_eselon').val());
		if (selected) {
			if (selected['kode_eselon'] < 60) {
				$('#jabatan-plt-hidden').attr('hidden', false);
				$('#jabatan-plt').attr('disabled', false);
			} else {
				$('#jabatan-plt-hidden').attr('hidden', true);
				$('#jabatan-plt').attr('disabled', true);
			}
		}
	}
</script>

<script>
	function submit_jabatan() {
		var formData = new FormData($('#form-jabatan')[0]);
        var _csrfName = $('input#jabatan-csrf').attr('name');
        var _csrfValue = $('input#jabatan-csrf').val();
        var file_data = $('#jabatan-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/jabatan")?>",
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
					get_riwayat('jabatan');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('jabatan');
				}, 500);
			}
		});
	}
	function edit_jabatan(id)
	{
        //alert(id);
        open_fileframe('jabatan',$("#jabatan-berkas_"+id).html())
        $("#jabatan-filelink").html("");
        $("#jabatan-filelink").html($("#jabatan-berkas_"+id).html());
        $("#jabatan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_jabatan/'+$("#jabatan-berkas_"+id).html());
        if ($("#jabatan-filelink").html() != "") {
        	$("#jabatan-berkas").attr("required",false);
        } else {
        	$("#jabatan-berkas").attr("required",true);
        }

        $("#jabatan-id_update").val($("#jabatan-id_update_"+id).html());
        $("#jabatan-id_jabatan").val($("#jabatan-id_jabatan_"+id).html());
        //ambil data
        var kode_bkn_jabatan = $("#jabatan-kode_bkn_jabatan_"+id).html();

        var id_skpd = $("#jabatan-id_skpd_"+id).html();
        var skpd_lainnya = $("#jabatan-skpd_lainnya_"+id).html();
        var id_unit_kerja = $("#jabatan-id_unit_kerja_"+id).html();
        var unit_kerja_lainnya = $("#jabatan-unit_kerja_lainnya_"+id).html();
        var id_ref_jabatan = $("#jabatan-id_ref_jabatan_"+id).html();
        var ref_jabatan_lainnya = $("#jabatan-ref_jabatan_lainnya_"+id).html();
        var kode_jabatan = $("#jabatan-kode_jabatan_"+id).html();
        var id_ref_eselon = $("#jabatan-id_ref_eselon_"+id).html();
        var plt = $("#jabatan-plt_"+id).html();
        var tmt_berlaku = $("#jabatan-tmt_berlaku_"+id).html();
        var tmt_berakhir = $("#jabatan-tmt_berakhir_"+id).html();

        var sk_nomor = $("#jabatan-sk_nomor_"+id).html();
        var sk_tanggal = $("#jabatan-sk_tanggal_"+id).html();

        //set data
        $("#jabatan-kode_bkn_jabatan").val(kode_bkn_jabatan);

        if(($('input[type=checkbox][name=id_skpd]').is(':checked') && id_skpd > 0) || (!$('input[type=checkbox][name=id_skpd]').is(':checked') && id_skpd == 0)) { $('input[type=checkbox][name=id_skpd]').click(); }
        if(($('input[type=checkbox][name=id_unit_kerja]').is(':checked') && id_unit_kerja > 0) || (!$('input[type=checkbox][name=id_unit_kerja]').is(':checked') && id_unit_kerja == 0)) { $('input[type=checkbox][name=id_unit_kerja]').click(); }
        if(($('input[type=checkbox][name=id_ref_jabatan]').is(':checked') && id_ref_jabatan > 0) || (!$('input[type=checkbox][name=id_ref_jabatan]').is(':checked') && id_ref_jabatan == 0)) { $('input[type=checkbox][name=id_ref_jabatan]').click(); }

    	$("#jabatan-id_skpd").val(id_skpd).trigger("change");
        $("#jabatan-skpd_lainnya").val(skpd_lainnya);
    	$("#jabatan-id_unit_kerja").val(id_unit_kerja).trigger("change");
        $("#jabatan-unit_kerja_lainnya").val(unit_kerja_lainnya);
        $("#jabatan-id_ref_jabatan").val(id_ref_jabatan).trigger("change");
        $("#jabatan-ref_jabatan_lainnya").val(ref_jabatan_lainnya);
        $("#jabatan-kode_jabatan").val(kode_jabatan);
        $("#jabatan-id_ref_eselon").val(id_ref_eselon).trigger("change");
        if(($('#jabatan-plt').is(':checked') && plt != "Y") || (!$('#jabatan-plt').is(':checked') && plt == "Y")) { $('#jabatan-plt').click(); }
        $("#jabatan-tmt_berlaku").val(tmt_berlaku);
        $("#jabatan-tmt_berakhir").val(tmt_berakhir);

        $("#jabatan-sk_nomor").val(sk_nomor);
        $("#jabatan-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.jabatan").addClass("show");
        $(".overlay-bg.jabatan").addClass("show");

        $("#jabatan-btn-simpan").removeClass("hidden");
        $("#jabatan-btn-batal").removeClass("hidden");

        $("#jabatan-input-alasan").addClass("hidden");
        $("#jabatan-btn-verifikasi").addClass("hidden");
        $("#jabatan-btn-tolak").addClass("hidden");
    }
	function verifikasi_jabatan(id)
	{
        //alert(id);
        open_fileframe('jabatan',$("#jabatan-berkas_"+id).html())
        $("#jabatan-filelink").html("");
        $("#jabatan-filelink").html($("#jabatan-berkas_"+id).html());
        $("#jabatan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_jabatan/'+$("#jabatan-berkas_"+id).html());
        if ($("#jabatan-filelink").html() != "") {
        	$("#jabatan-berkas").attr("required",false);
        } else {
        	$("#jabatan-berkas").attr("required",true);
        }

        $("#jabatan-id_update").val($("#jabatan-id_update_"+id).html());
        $("#jabatan-id_jabatan").val($("#jabatan-id_jabatan_"+id).html());
        //ambil data
        var kode_bkn_jabatan = $("#jabatan-kode_bkn_jabatan_"+id).html();

        var id_skpd = $("#jabatan-id_skpd_"+id).html();
        var skpd_lainnya = $("#jabatan-skpd_lainnya_"+id).html();
        var id_unit_kerja = $("#jabatan-id_unit_kerja_"+id).html();
        var unit_kerja_lainnya = $("#jabatan-unit_kerja_lainnya_"+id).html();
        var id_ref_jabatan = $("#jabatan-id_ref_jabatan_"+id).html();
        var ref_jabatan_lainnya = $("#jabatan-ref_jabatan_lainnya_"+id).html();
        var kode_jabatan = $("#jabatan-kode_jabatan_"+id).html();
        var id_ref_eselon = $("#jabatan-id_ref_eselon_"+id).html();
        var plt = $("#jabatan-plt_"+id).html();
        var tmt_berlaku = $("#jabatan-tmt_berlaku_"+id).html();
        var tmt_berakhir = $("#jabatan-tmt_berakhir_"+id).html();

        var sk_nomor = $("#jabatan-sk_nomor_"+id).html();
        var sk_tanggal = $("#jabatan-sk_tanggal_"+id).html();

        //set data
        $("#jabatan-kode_bkn_jabatan").val(kode_bkn_jabatan);

        if(($('input[type=checkbox][name=id_skpd]').is(':checked') && id_skpd > 0) || (!$('input[type=checkbox][name=id_skpd]').is(':checked') && id_skpd == 0)) { $('input[type=checkbox][name=id_skpd]').click(); }
        if(($('input[type=checkbox][name=id_unit_kerja]').is(':checked') && id_unit_kerja > 0) || (!$('input[type=checkbox][name=id_unit_kerja]').is(':checked') && id_unit_kerja == 0)) { $('input[type=checkbox][name=id_unit_kerja]').click(); }
        if(($('input[type=checkbox][name=id_ref_jabatan]').is(':checked') && id_ref_jabatan > 0) || (!$('input[type=checkbox][name=id_ref_jabatan]').is(':checked') && id_ref_jabatan == 0)) { $('input[type=checkbox][name=id_ref_jabatan]').click(); }

    	$("#jabatan-id_skpd").val(id_skpd).trigger("change");
        $("#jabatan-skpd_lainnya").val(skpd_lainnya);
    	$("#jabatan-id_unit_kerja").val(id_unit_kerja).trigger("change");
        $("#jabatan-unit_kerja_lainnya").val(unit_kerja_lainnya);
        $("#jabatan-id_ref_jabatan").val(id_ref_jabatan).trigger("change");
        $("#jabatan-ref_jabatan_lainnya").val(ref_jabatan_lainnya);
        $("#jabatan-kode_jabatan").val(kode_jabatan);
        $("#jabatan-id_ref_eselon").val(id_ref_eselon).trigger("change");
        if(($('#jabatan-plt').is(':checked') && plt != "Y") || (!$('#jabatan-plt').is(':checked') && plt == "Y")) { $('#jabatan-plt').click(); }
        $("#jabatan-tmt_berlaku").val(tmt_berlaku);
        $("#jabatan-tmt_berakhir").val(tmt_berakhir);

        $("#jabatan-sk_nomor").val(sk_nomor);
        $("#jabatan-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.jabatan").addClass("show");
        $(".overlay-bg.jabatan").addClass("show");

        $("#jabatan-btn-simpan").addClass("hidden");
        $("#jabatan-btn-batal").addClass("hidden");

        $("#jabatan-input-alasan").removeClass("hidden");
        $("#jabatan-btn-verifikasi").removeClass("hidden");
        $("#jabatan-btn-tolak").removeClass("hidden");
    }
    function hapus_jabatan(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/jabatan")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#jabatan-id_pegawai_"+id).html(),
        				nip_pegawai:$("#jabatan-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('jabatan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('jabatan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_jabatan(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/jabatan")?>",
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
        					get_riwayat('jabatan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('jabatan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_jabatan(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/jabatan")?>",
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
        					get_riwayat('jabatan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('jabatan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_jabatan()
    {
    	$("#jabatan-fileframe").attr("src","");
        $("#jabatan-filelink").html("");
        if ($("#jabatan-filelink").html() != "") {
        	$("#jabatan-berkas").attr("required",false);
        } else {
        	$("#jabatan-berkas").attr("required",true);
        }

    	$("#jabatan-id_update").val("");
    	$("#jabatan-id_jabatan").val("");
    	$("#jabatan-kode_bkn_jabatan").val("");

        if($('input[type=checkbox][name=id_skpd]').is(':checked')) { $('input[type=checkbox][name=id_skpd]').click(); }
        if($('input[type=checkbox][name=id_unit_kerja]').is(':checked')) { $('input[type=checkbox][name=id_unit_kerja]').click(); }
        if($('input[type=checkbox][name=id_ref_jabatan]').is(':checked')) { $('input[type=checkbox][name=id_ref_jabatan]').click(); }

    	$("#jabatan-id_skpd").val("").trigger("change");
    	$("#jabatan-skpd_lainnya").val("");
    	$("#jabatan-id_unit_kerja").val("").trigger("change");
    	$("#jabatan-unit_kerja_lainnya").val("");
    	$("#jabatan-id_ref_jabatan").val("").trigger("change");
    	$("#jabatan-ref_jabatan_lainnya").val("");
    	$("#jabatan-kode_jabatan").val("");
    	$("#jabatan-id_ref_eselon").val("").trigger("change");
        if($('#jabatan-plt').is(':checked')) { $('#jabatan-plt').click(); }
    	$("#jabatan-tmt_berlaku").val("");
    	$("#jabatan-tmt_berakhir").val("");

    	$("#jabatan-sk_nomor").val("");
    	$("#jabatan-sk_tanggal").val("");

    	$(".add-new-data.jabatan").addClass("show");
    	$(".overlay-bg.jabatan").addClass("show");

        $("#jabatan-btn-simpan").removeClass("hidden");
        $("#jabatan-btn-batal").removeClass("hidden");

        $("#jabatan-input-alasan").addClass("hidden");
        $("#jabatan-btn-verifikasi").addClass("hidden");
        $("#jabatan-btn-tolak").addClass("hidden");
    }
</script>

<section class="data-list-view-header">
	<!-- RW mutasi -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Mutasi <button type="button" onclick="tambah_mutasi();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>SKPD</th>
								<th>Unit Kerja</th>
								<th>SKPD Asal</th>
								<th>Unit Kerja Asal</th>
								<th>Jenis Mutasi</th>
								<th>SK Nomor</th>
								<th>SK Tanggal <span class="fa fa-sort-desc"></span></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($mutasi as $row1): $row = $row1; ?>
								<?php foreach ($dump_mutasi['update'] as $row2): ?>
									<?php
									if($row1->id_mutasi == $row2->id_mutasi) {
										$row = $row2;
										$row->nama_skpd = convert_data($ref_skpd,'id_skpd',$row->id_skpd,'nama_skpd');
										$row->nama_unit_kerja = convert_data($ref_unit_kerja,'id_unit_kerja',$row->id_unit_kerja,'nama_unit_kerja');
										$row->nama_skpd_asal = convert_data($ref_skpd,'id_skpd',$row->id_skpd_asal,'nama_skpd');
										$row->nama_unit_kerja_asal = convert_data($ref_unit_kerja,'id_unit_kerja',$row->id_unit_kerja_asal,'nama_unit_kerja');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_mutasi['delete'] as $row2): ?>
									<?php
									if($row1->id_mutasi == $row2->id_mutasi) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=($row->id_skpd>0)?$row->nama_skpd:$row->skpd_lainnya?></td>
									<td><?=($row->id_unit_kerja>0)?$row->nama_unit_kerja:$row->unit_kerja_lainnya?></td>
									<td><?=($row->id_skpd_asal>0)?$row->nama_skpd_asal:$row->skpd_asal_lainnya?></td>
									<td><?=($row->id_unit_kerja_asal>0)?$row->nama_unit_kerja_asal:$row->unit_kerja_asal_lainnya?></td>
									<td><?=$row->jenis_mutasi?></td>
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
										<button type="button" onclick="verifikasi_mutasi('<?=$row->id_mutasi?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_mutasi('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_mutasi('<?=$row->id_mutasi?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_mutasi('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_mutasi('<?=$row->id_mutasi?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_mutasi('<?=$row->id_mutasi?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_mutasi/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="mutasi-<?=$k?>_<?=$row->id_mutasi?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_mutasi['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_skpd = convert_data($ref_skpd,'id_skpd',$row->id_skpd,'nama_skpd');
								$row->nama_unit_kerja = convert_data($ref_unit_kerja,'id_unit_kerja',$row->id_unit_kerja,'nama_unit_kerja');
								$row->nama_skpd_asal = convert_data($ref_skpd,'id_skpd',$row->id_skpd_asal,'nama_skpd');
								$row->nama_unit_kerja_asal = convert_data($ref_unit_kerja,'id_unit_kerja',$row->id_unit_kerja_asal,'nama_unit_kerja');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=($row->id_skpd>0)?$row->nama_skpd:$row->skpd_lainnya?></td>
									<td><?=($row->id_unit_kerja>0)?$row->nama_unit_kerja:$row->unit_kerja_lainnya?></td>
									<td><?=($row->id_skpd_asal>0)?$row->nama_skpd_asal:$row->skpd_asal_lainnya?></td>
									<td><?=($row->id_unit_kerja_asal>0)?$row->nama_unit_kerja_asal:$row->unit_kerja_asal_lainnya?></td>
									<td><?=$row->jenis_mutasi?></td>
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
										<button type="button" onclick="verifikasi_mutasi('<?=$row->id_update?>_<?=$row->id_mutasi?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_mutasi('<?=$row->id_update?>_<?=$row->id_mutasi?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_mutasi('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_mutasi/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="mutasi-<?=$k?>_<?=$row->id_update?>_<?=$row->id_mutasi?>"><?=$v?></var>
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
		<div class="overlay-bg mutasi" onclick="close_sidebar('mutasi')"></div>
		<div class="add-new-data mutasi fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('mutasi')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="mutasi-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data mutasi" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-mutasi" onsubmit="submit_mutasi()" enctype="multipart/form-data">
				<input type="hidden" id="mutasi-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="mutasi-id_update" value="" />
				<input type="hidden" name="id_mutasi" id="mutasi-id_mutasi" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat Mutasi</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('mutasi')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_mutasi" id="mutasi-kode_bkn_mutasi" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">SKPD</label>
								<select class="form-control select2" id="mutasi-id_skpd" name="id_skpd" onchange="mutasi_select_skpd()" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_skpd as $row): ?>
										<option value="<?=$row->id_skpd?>"><?=$row->nama_skpd?></option>
									<?php endforeach ?>
								</select>
								<label class="pull-right"><input type="checkbox" onchange="$('#mutasi-id_skpd').attr('disabled', $(this).is(':checked'));$('#mutasi-skpd_lainnya').attr('hidden', !$(this).is(':checked'));" name="id_skpd" value="0"> Lainnya</label>
								<input type="text" name="skpd_lainnya" id="mutasi-skpd_lainnya" class="form-control" hidden>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Unit Kerja</label>
								<select class="form-control select2" id="mutasi-id_unit_kerja" name="id_unit_kerja">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_unit_kerja as $row): ?>
										<option value="<?=$row->id_unit_kerja?>"><?=$row->nama_unit_kerja?></option>
									<?php endforeach ?>
								</select>
								<label class="pull-right"><input type="checkbox" onchange="$('#mutasi-id_unit_kerja').attr('disabled', $(this).is(':checked'));$('#mutasi-unit_kerja_lainnya').attr('hidden', !$(this).is(':checked'));" name="id_unit_kerja" value="0"> Lainnya</label>
								<input type="text" name="unit_kerja_lainnya" id="mutasi-unit_kerja_lainnya" class="form-control" hidden>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">SKPD Asal</label>
								<select class="form-control select2" id="mutasi-id_skpd_asal" name="id_skpd_asal" onchange="mutasi_select_skpd_asal()" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_skpd as $row): ?>
										<option value="<?=$row->id_skpd?>"><?=$row->nama_skpd?></option>
									<?php endforeach ?>
								</select>
								<label class="pull-right"><input type="checkbox" onchange="$('#mutasi-id_skpd_asal').attr('disabled', $(this).is(':checked'));$('#mutasi-skpd_asal_lainnya').attr('hidden', !$(this).is(':checked'));" name="id_skpd_asal" value="0"> Lainnya</label>
								<input type="text" name="skpd_asal_lainnya" id="mutasi-skpd_asal_lainnya" class="form-control" hidden>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Unit Kerja Asal</label>
								<select class="form-control select2" id="mutasi-id_unit_kerja_asal" name="id_unit_kerja_asal">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_unit_kerja as $row): ?>
										<option value="<?=$row->id_unit_kerja?>"><?=$row->nama_unit_kerja?></option>
									<?php endforeach ?>
								</select>
								<label class="pull-right"><input type="checkbox" onchange="$('#mutasi-id_unit_kerja_asal').attr('disabled', $(this).is(':checked'));$('#mutasi-unit_kerja_asal_lainnya').attr('hidden', !$(this).is(':checked'));" name="id_unit_kerja_asal" value="0"> Lainnya</label>
								<input type="text" name="unit_kerja_asal_lainnya" id="mutasi-unit_kerja_asal_lainnya" class="form-control" hidden>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Jenis Mutasi</label>
								<select class="form-control" id="mutasi-jenis_mutasi" name="jenis_mutasi" required="">
									<option value="">-- PILIH --</option>
									<option value="PI">Pindah Instansi</option>
									<option value="DPB">Diperbantukan</option>
									<option value="DPK">Dipekerjakan</option>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor SK</label>
								<input type="text" name="sk_nomor" id="mutasi-sk_nomor" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tanggal SK</label>
								<input type="date" name="sk_tanggal" id="mutasi-sk_tanggal" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="mutasi-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="mutasi-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="mutasi-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="mutasi-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="mutasi-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="mutasi-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="mutasi-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#mutasi-input-verifikasi').val('')">Simpan</button>
						<button id="mutasi-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#mutasi-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="mutasi-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('mutasi')">Batal</button>
						<button id="mutasi-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#mutasi-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script type="text/javascript">
	var unit_kerja = <?=json_encode($ref_unit_kerja)?>;

	function mutasi_select_skpd() {
		var selected = $('#mutasi-id_skpd').val();
		var option = "<option value=\"\">-- PILIH --</option>";
		for (var i = unit_kerja.length - 1; i >= 0; i--) {
			if (unit_kerja[i]['id_skpd'] == selected) {
				option += "<option value=\""+String(unit_kerja[i]['id_unit_kerja'])+"\">"+String(unit_kerja[i]['nama_unit_kerja'])+"</option>";
			}
		}
		$('#mutasi-id_unit_kerja').html(option);
		$('#mutasi-id_unit_kerja').select2();
	}

	function mutasi_select_skpd_asal() {
		var selected = $('#mutasi-id_skpd_asal').val();
		var option = "<option value=\"\">-- PILIH --</option>";
		for (var i = unit_kerja.length - 1; i >= 0; i--) {
			if (unit_kerja[i]['id_skpd'] == selected) {
				option += "<option value=\""+String(unit_kerja[i]['id_unit_kerja'])+"\">"+String(unit_kerja[i]['nama_unit_kerja'])+"</option>";
			}
		}
		$('#mutasi-id_unit_kerja_asal').html(option);
		$('#mutasi-id_unit_kerja_asal').select2();
	}

</script>

<script>
	function submit_mutasi() {
		var formData = new FormData($('#form-mutasi')[0]);
        var _csrfName = $('input#mutasi-csrf').attr('name');
        var _csrfValue = $('input#mutasi-csrf').val();
        var file_data = $('#mutasi-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/mutasi")?>",
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
					get_riwayat('jabatan');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('jabatan');
				}, 500);
			}
		});
	}
	function edit_mutasi(id)
	{
        //alert(id);
        open_fileframe('mutasi',$("#mutasi-berkas_"+id).html())
        $("#mutasi-filelink").html("");
        $("#mutasi-filelink").html($("#mutasi-berkas_"+id).html());
        $("#mutasi-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_mutasi/'+$("#mutasi-berkas_"+id).html());

        $("#mutasi-id_update").val($("#mutasi-id_update_"+id).html());
        $("#mutasi-id_mutasi").val($("#mutasi-id_mutasi_"+id).html());
        //ambil data
        var kode_bkn_mutasi = $("#mutasi-kode_bkn_mutasi_"+id).html();

        var id_skpd = $("#mutasi-id_skpd_"+id).html();
        var skpd_lainnya = $("#mutasi-skpd_lainnya_"+id).html();
        var id_unit_kerja = $("#mutasi-id_unit_kerja_"+id).html();
        var unit_kerja_lainnya = $("#mutasi-unit_kerja_lainnya_"+id).html();
        var id_skpd_asal = $("#mutasi-id_skpd_asal_"+id).html();
        var skpd_asal_lainnya = $("#mutasi-skpd_asal_lainnya_"+id).html();
        var id_unit_kerja_asal = $("#mutasi-id_unit_kerja_asal_"+id).html();
        var unit_kerja_asal_lainnya = $("#mutasi-unit_kerja_asal_lainnya_"+id).html();
        var jenis_mutasi = $("#mutasi-jenis_mutasi_"+id).html();

        var sk_nomor = $("#mutasi-sk_nomor_"+id).html();
        var sk_tanggal = $("#mutasi-sk_tanggal_"+id).html();

        //set data
        $("#mutasi-kode_bkn_mutasi").val(kode_bkn_mutasi);

        if(($('input[type=checkbox][name=id_skpd]').is(':checked') && id_skpd > 0) || (!$('input[type=checkbox][name=id_skpd]').is(':checked') && id_skpd == 0)) { $('input[type=checkbox][name=id_skpd]').click(); }
        if(($('input[type=checkbox][name=id_unit_kerja]').is(':checked') && id_unit_kerja > 0) || (!$('input[type=checkbox][name=id_unit_kerja]').is(':checked') && id_unit_kerja == 0)) { $('input[type=checkbox][name=id_unit_kerja]').click(); }
        if(($('input[type=checkbox][name=id_skpd_asal]').is(':checked') && id_skpd_asal > 0) || (!$('input[type=checkbox][name=id_skpd_asal]').is(':checked') && id_skpd_asal == 0)) { $('input[type=checkbox][name=id_skpd_asal]').click(); }
        if(($('input[type=checkbox][name=id_unit_kerja_asal]').is(':checked') && id_unit_kerja_asal > 0) || (!$('input[type=checkbox][name=id_unit_kerja_asal]').is(':checked') && id_unit_kerja_asal == 0)) { $('input[type=checkbox][name=id_unit_kerja_asal]').click(); }

        $("#mutasi-id_skpd").val(id_skpd).trigger("change");
        $("#mutasi-skpd_lainnya").val(skpd_lainnya);
        $("#mutasi-id_unit_kerja").val(id_unit_kerja).trigger("change");
        $("#mutasi-unit_kerja_lainnya").val(unit_kerja_lainnya);
        $("#mutasi-id_skpd_asal").val(id_skpd_asal).trigger("change");
        $("#mutasi-skpd_asal_lainnya").val(skpd_asal_lainnya);
        $("#mutasi-id_unit_kerja_asal").val(id_unit_kerja_asal).trigger("change");
        $("#mutasi-unit_kerja_asal_lainnya").val(unit_kerja_asal_lainnya);
        $("#mutasi-jenis_mutasi").val(jenis_mutasi).trigger("change");

        $("#mutasi-sk_nomor").val(sk_nomor);
        $("#mutasi-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.mutasi").addClass("show");
        $(".overlay-bg.mutasi").addClass("show");

        $("#mutasi-btn-simpan").removeClass("hidden");
        $("#mutasi-btn-batal").removeClass("hidden");

        $("#mutasi-input-alasan").addClass("hidden");
        $("#mutasi-btn-verifikasi").addClass("hidden");
        $("#mutasi-btn-tolak").addClass("hidden");
    }
	function verifikasi_mutasi(id)
	{
        //alert(id);
        open_fileframe('mutasi',$("#mutasi-berkas_"+id).html())
        $("#mutasi-filelink").html("");
        $("#mutasi-filelink").html($("#mutasi-berkas_"+id).html());
        $("#mutasi-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_mutasi/'+$("#mutasi-berkas_"+id).html());

        $("#mutasi-id_update").val($("#mutasi-id_update_"+id).html());
        $("#mutasi-id_mutasi").val($("#mutasi-id_mutasi_"+id).html());
        //ambil data
        var kode_bkn_mutasi = $("#mutasi-kode_bkn_mutasi_"+id).html();

        var id_skpd = $("#mutasi-id_skpd_"+id).html();
        var skpd_lainnya = $("#mutasi-skpd_lainnya_"+id).html();
        var id_unit_kerja = $("#mutasi-id_unit_kerja_"+id).html();
        var unit_kerja_lainnya = $("#mutasi-unit_kerja_lainnya_"+id).html();
        var id_skpd_asal = $("#mutasi-id_skpd_asal_"+id).html();
        var skpd_asal_lainnya = $("#mutasi-skpd_asal_lainnya_"+id).html();
        var id_unit_kerja_asal = $("#mutasi-id_unit_kerja_asal_"+id).html();
        var unit_kerja_asal_lainnya = $("#mutasi-unit_kerja_asal_lainnya_"+id).html();
        var jenis_mutasi = $("#mutasi-jenis_mutasi_"+id).html();

        var sk_nomor = $("#mutasi-sk_nomor_"+id).html();
        var sk_tanggal = $("#mutasi-sk_tanggal_"+id).html();

        //set data
        $("#mutasi-kode_bkn_mutasi").val(kode_bkn_mutasi);
        
        if(($('input[type=checkbox][name=id_skpd]').is(':checked') && id_skpd > 0) || (!$('input[type=checkbox][name=id_skpd]').is(':checked') && id_skpd == 0)) { $('input[type=checkbox][name=id_skpd]').click(); }
        if(($('input[type=checkbox][name=id_unit_kerja]').is(':checked') && id_unit_kerja > 0) || (!$('input[type=checkbox][name=id_unit_kerja]').is(':checked') && id_unit_kerja == 0)) { $('input[type=checkbox][name=id_unit_kerja]').click(); }
        if(($('input[type=checkbox][name=id_skpd_asal]').is(':checked') && id_skpd_asal > 0) || (!$('input[type=checkbox][name=id_skpd_asal]').is(':checked') && id_skpd_asal == 0)) { $('input[type=checkbox][name=id_skpd_asal]').click(); }
        if(($('input[type=checkbox][name=id_unit_kerja_asal]').is(':checked') && id_unit_kerja_asal > 0) || (!$('input[type=checkbox][name=id_unit_kerja_asal]').is(':checked') && id_unit_kerja_asal == 0)) { $('input[type=checkbox][name=id_unit_kerja_asal]').click(); }

        $("#mutasi-id_skpd").val(id_skpd).trigger("change");
        $("#mutasi-skpd_lainnya").val(skpd_lainnya);
        $("#mutasi-id_unit_kerja").val(id_unit_kerja).trigger("change");
        $("#mutasi-unit_kerja_lainnya").val(unit_kerja_lainnya);
        $("#mutasi-id_skpd_asal").val(id_skpd_asal).trigger("change");
        $("#mutasi-skpd_asal_lainnya").val(skpd_asal_lainnya);
        $("#mutasi-id_unit_kerja_asal").val(id_unit_kerja_asal).trigger("change");
        $("#mutasi-unit_kerja_asal_lainnya").val(unit_kerja_asal_lainnya);
        $("#mutasi-jenis_mutasi").val(jenis_mutasi).trigger("change");

        $("#mutasi-sk_nomor").val(sk_nomor);
        $("#mutasi-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.mutasi").addClass("show");
        $(".overlay-bg.mutasi").addClass("show");

        $("#mutasi-btn-simpan").addClass("hidden");
        $("#mutasi-btn-batal").addClass("hidden");

        $("#mutasi-input-alasan").removeClass("hidden");
        $("#mutasi-btn-verifikasi").removeClass("hidden");
        $("#mutasi-btn-tolak").removeClass("hidden");
    }
    function hapus_mutasi(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/mutasi")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#mutasi-id_pegawai_"+id).html(),
        				nip_pegawai:$("#mutasi-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('jabatan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('jabatan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_mutasi(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/mutasi")?>",
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
        					get_riwayat('jabatan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('jabatan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_mutasi(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/mutasi")?>",
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
        					get_riwayat('jabatan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('jabatan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_mutasi()
    {
    	$("#mutasi-fileframe").attr("src","");
        $("#mutasi-filelink").html("");

    	$("#mutasi-id_update").val("");
    	$("#mutasi-id_mutasi").val("");
    	$("#mutasi-kode_bkn_mutasi").val("");
        
        if($('input[type=checkbox][name=id_skpd]').is(':checked')) { $('input[type=checkbox][name=id_skpd]').click(); }
        if($('input[type=checkbox][name=id_unit_kerja]').is(':checked')) { $('input[type=checkbox][name=id_unit_kerja]').click(); }
        if($('input[type=checkbox][name=id_skpd_asal]').is(':checked')) { $('input[type=checkbox][name=id_skpd_asal]').click(); }
        if($('input[type=checkbox][name=id_unit_kerja_asal]').is(':checked')) { $('input[type=checkbox][name=id_unit_kerja_asal]').click(); }

        $("#mutasi-id_skpd").val("").trigger("change");
        $("#mutasi-skpd_lainnya").val("");
        $("#mutasi-id_unit_kerja").val("").trigger("change");
        $("#mutasi-unit_kerja_lainnya").val("");
        $("#mutasi-id_skpd_asal").val("").trigger("change");
        $("#mutasi-skpd_asal_lainnya").val("");
        $("#mutasi-id_unit_kerja_asal").val("").trigger("change");
        $("#mutasi-unit_kerja_asal_lainnya").val("");
    	$("#mutasi-jenis_mutasi").val("").trigger("change");

    	$("#mutasi-sk_nomor").val("");
    	$("#mutasi-sk_tanggal").val("");

    	$(".add-new-data.mutasi").addClass("show");
    	$(".overlay-bg.mutasi").addClass("show");

        $("#mutasi-btn-simpan").removeClass("hidden");
        $("#mutasi-btn-batal").removeClass("hidden");

        $("#mutasi-input-alasan").addClass("hidden");
        $("#mutasi-btn-verifikasi").addClass("hidden");
        $("#mutasi-btn-tolak").addClass("hidden");
    }
</script>

<section class="data-list-view-header">
	<!-- RW pwk -->
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<h4 class="card-title">Riwayat Pindah Wilayah Kerja <button type="button" onclick="tambah_pwk();" class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
				<hr/>
				<div class="table-responsive">
					<table class="table table-striped datatable">
						<thead>
							<tr>
								<th>KPKN</th>
								<th>SKPD</th>
								<th>Unit Kerja</th>
								<th>TMT PWK <span class="fa fa-sort-desc"></span></th>
								<th>SK Nomor</th>
								<th>SK Tanggal</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pwk as $row1): $row = $row1; ?>
								<?php foreach ($dump_pwk['update'] as $row2): ?>
									<?php
									if($row1->id_pwk == $row2->id_pwk) {
										$row = $row2;
										$row->nama_kpkn = convert_data($ref_kpkn,'kode_kpkn',$row->kode_kpkn,'nama_kpkn');
									}
									?>
								<?php endforeach ?>
								<?php foreach ($dump_pwk['delete'] as $row2): ?>
									<?php
									if($row1->id_pwk == $row2->id_pwk) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
								<?php endforeach ?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_kpkn?></td>
									<td><?=$row->nama_skpd?></td>
									<td><?=$row->nama_unit_kerja?></td>
									<td><?=tanggal($row->tmt_pwk)?></td>
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
										<button type="button" onclick="verifikasi_pwk('<?=$row->id_pwk?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>	
										<button type="button" onclick="verifikasi_hapus_pwk('<?=$row->id_update?>');" class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
										<div class="alert alert-primary alert-validation-msg" role="alert" style="padding: 0; font-weight: unset;">
                                            <i class="feather icon-info align-middle"></i>
                                            <span><?=$row->alasan?></span>
                                        </div>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>	
										<button type="button" onclick="edit_pwk('<?=$row->id_pwk?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_pwk('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (@!$row->id_update): ?>	
										<button type="button" onclick="hapus_pwk('<?=$row->id_pwk?>');" class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
										<?php endif ?>
										<?php if ($row->status != "Y"): ?>	
											<!-- <button type="button" onclick="aktif_pwk('<?=$row->id_pwk?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_pwk/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="pwk-<?=$k?>_<?=$row->id_pwk?>"><?=$v?></var>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php foreach ($dump_pwk['insert'] as $row1): $row = $row1; ?>
								<?php 
								$row->nama_kpkn = convert_data($ref_kpkn,'kode_kpkn',$row->kode_kpkn,'nama_kpkn');
								?>
								<tr class="<?=get_status_riwayat_simpeg($row)?>">
									<td><?=$row->nama_kpkn?></td>
									<td><?=$row->nama_skpd?></td>
									<td><?=$row->nama_unit_kerja?></td>
									<td><?=tanggal($row->tmt_pwk)?></td>
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
										<button type="button" onclick="verifikasi_pwk('<?=$row->id_update?>_<?=$row->id_pwk?>');" class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima"): ?>	
										<button type="button" onclick="edit_pwk('<?=$row->id_update?>_<?=$row->id_pwk?>');" class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
										<?php endif ?>

										<?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>	
										<button type="button" onclick="batal_pwk('<?=$row->id_update?>');" class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
										<?php endif ?>

										<?php if (isset($row->berkas)): ?>	
										<a href="<?=base_url()?>data/simpeg/riwayat_pwk/<?=$row->berkas?>" target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
										<?php endif ?>
									</td>
								</tr>
								<?php foreach ($row as $k => $v): ?>
									<var class="hidden" id="pwk-<?=$k?>_<?=$row->id_update?>_<?=$row->id_pwk?>"><?=$v?></var>
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
		<div class="overlay-bg pwk" onclick="close_sidebar('pwk')"></div>
		<div class="add-new-data pwk fileframe hide">
			<button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('pwk')" style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
		    <iframe id="pwk-fileframe" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
		</div>
		<div class="add-new-data pwk" style="overflow-y: auto;">
			<form action="javascript: void(0)" id="form-pwk" onsubmit="submit_pwk()" enctype="multipart/form-data">
				<input type="hidden" id="pwk-csrf" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
				<input type="hidden" name="id_update" id="pwk-id_update" value="" />
				<input type="hidden" name="id_pwk" id="pwk-id_pwk" value="" />
				<input type="hidden" name="id_pegawai" value="<?=$id?>" />
				<input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
				<div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
					<div>
						<h4 class="text-uppercase">Riwayat PWK</h4>
					</div>
					<div class="hide-data-sidebar" onclick="close_sidebar('pwk')">
						<i class="feather icon-x"></i>
					</div>
				</div>
				<div class="data-items pb-3">
					<div class="data-fields px-2">
						<div class="row">
							<!-- <div class="col-sm-12 data-field-col"> -->
								<!-- <label for="data-name">Kode BKN</label> -->
								<input type="hidden" name="kode_bkn_pwk" id="pwk-kode_bkn_pwk" class="form-control" placeholder="diisi oleh admin simpeg">
							<!-- </div> -->
							<div class="col-sm-12 data-field-col">
								<label for="data-name">KPKN</label>
								<select class="form-control select2" id="pwk-kode_kpkn" name="kode_kpkn" required="">
									<option value="">-- PILIH --</option>
									<?php foreach ($ref_kpkn as $row): ?>
										<option value="<?=$row->kode_kpkn?>"><?=$row->nama_kpkn?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">SKPD</label>
								<input type="text" name="nama_skpd" id="pwk-nama_skpd" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Unit Kerja</label>
								<input type="text" name="nama_unit_kerja" id="pwk-nama_unit_kerja" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">TMT PWK</label>
								<input type="date" name="tmt_pwk" id="pwk-tmt_pwk" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Nomor SK</label>
								<input type="text" name="sk_nomor" id="pwk-sk_nomor" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
								<label for="data-name">Tanggal SK</label>
								<input type="date" name="sk_tanggal" id="pwk-sk_tanggal" class="form-control" required="">
							</div>
							<div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="pwk-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="pwk-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="pwk-filelink" href="" target="_blank"></a>
                                </fieldset>
							</div>
							<div id="pwk-input-alasan" class="col-sm-12 data-field-col">
								<label for="data-name">Alasan Penolakan</label>
								<textarea name="alasan" id="pwk-alasan" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
					<input type="hidden" id="pwk-input-verifikasi" name="verifikasi">
					<div class="add-data-btn">
						<button id="pwk-btn-simpan" type="submit" class="btn btn-primary" onclick="$('#pwk-input-verifikasi').val('')">Simpan</button>
						<button id="pwk-btn-verifikasi" type="submit" class="btn btn-primary" onclick="$('#pwk-input-verifikasi').val('verifikasi')">Verifikasi</button>
					</div>
					<div class="cancel-data-btn">
						<button id="pwk-btn-batal" type="button" class="btn btn-outline-danger" onclick="close_sidebar('pwk')">Batal</button>
						<button id="pwk-btn-tolak" type="submit" class="btn btn-outline-danger" onclick="$('#pwk-input-verifikasi').val('tolak')">Tolak</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<!-- add new sidebar ends -->

<script>
	function submit_pwk() {
		var formData = new FormData($('#form-pwk')[0]);
        var _csrfName = $('input#pwk-csrf').attr('name');
        var _csrfValue = $('input#pwk-csrf').val();
        var file_data = $('#pwk-berkas').prop('files')[0];
        formData.append('berkas', file_data);
        formData.append(_csrfName, _csrfValue);

        block_ui("body");
		$.ajax({
			url :"<?php echo base_url("simpeg/submit_riwayat/pwk")?>",
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
					get_riwayat('jabatan');
				}, 500);
			},
			error: function(xhr, status, error) {
				swal("Opps","Error","error");
				console.log(xhr);

				setTimeout(function() {
					get_riwayat('jabatan');
				}, 500);
			}
		});
	}
	function edit_pwk(id)
	{
        //alert(id);
        open_fileframe('pwk',$("#pwk-berkas_"+id).html())
        $("#pwk-filelink").html("");
        $("#pwk-filelink").html($("#pwk-berkas_"+id).html());
        $("#pwk-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_pwk/'+$("#pwk-berkas_"+id).html());

        $("#pwk-id_update").val($("#pwk-id_update_"+id).html());
        $("#pwk-id_pwk").val($("#pwk-id_pwk_"+id).html());
        //ambil data
        var kode_bkn_pwk = $("#pwk-kode_bkn_pwk_"+id).html();

        var kode_kpkn = $("#pwk-kode_kpkn_"+id).html();
        var nama_skpd = $("#pwk-nama_skpd_"+id).html();
        var nama_unit_kerja = $("#pwk-nama_unit_kerja_"+id).html();
        var tmt_pwk = $("#pwk-tmt_pwk_"+id).html();

        var sk_nomor = $("#pwk-sk_nomor_"+id).html();
        var sk_tanggal = $("#pwk-sk_tanggal_"+id).html();

        //set data
        $("#pwk-kode_bkn_pwk").val(kode_bkn_pwk);

        $("#pwk-kode_kpkn").val(kode_kpkn).trigger("change");
        $("#pwk-nama_skpd").val(nama_skpd);
        $("#pwk-nama_unit_kerja").val(nama_unit_kerja);
        $("#pwk-tmt_pwk").val(tmt_pwk);

        $("#pwk-sk_nomor").val(sk_nomor);
        $("#pwk-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.pwk").addClass("show");
        $(".overlay-bg.pwk").addClass("show");

        $("#pwk-btn-simpan").removeClass("hidden");
        $("#pwk-btn-batal").removeClass("hidden");

        $("#pwk-input-alasan").addClass("hidden");
        $("#pwk-btn-verifikasi").addClass("hidden");
        $("#pwk-btn-tolak").addClass("hidden");
    }
	function verifikasi_pwk(id)
	{
        //alert(id);
        open_fileframe('pwk',$("#pwk-berkas_"+id).html())
        $("#pwk-filelink").html("");
        $("#pwk-filelink").html($("#pwk-berkas_"+id).html());
        $("#pwk-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_pwk/'+$("#pwk-berkas_"+id).html());

        $("#pwk-id_update").val($("#pwk-id_update_"+id).html());
        $("#pwk-id_pwk").val($("#pwk-id_pwk_"+id).html());
        //ambil data
        var kode_bkn_pwk = $("#pwk-kode_bkn_pwk_"+id).html();

        var kode_kpkn = $("#pwk-kode_kpkn_"+id).html();
        var nama_skpd = $("#pwk-nama_skpd_"+id).html();
        var nama_unit_kerja = $("#pwk-nama_unit_kerja_"+id).html();
        var tmt_pwk = $("#pwk-tmt_pwk_"+id).html();

        var sk_nomor = $("#pwk-sk_nomor_"+id).html();
        var sk_tanggal = $("#pwk-sk_tanggal_"+id).html();

        //set data
        $("#pwk-kode_bkn_pwk").val(kode_bkn_pwk);

        $("#pwk-kode_kpkn").val(kode_kpkn).trigger("change");
        $("#pwk-nama_skpd").val(nama_skpd);
        $("#pwk-nama_unit_kerja").val(nama_unit_kerja);
        $("#pwk-tmt_pwk").val(tmt_pwk);

        $("#pwk-sk_nomor").val(sk_nomor);
        $("#pwk-sk_tanggal").val(sk_tanggal);

        $(".add-new-data.pwk").addClass("show");
        $(".overlay-bg.pwk").addClass("show");

        $("#pwk-btn-simpan").addClass("hidden");
        $("#pwk-btn-batal").addClass("hidden");

        $("#pwk-input-alasan").removeClass("hidden");
        $("#pwk-btn-verifikasi").removeClass("hidden");
        $("#pwk-btn-tolak").removeClass("hidden");
    }
    function hapus_pwk(id)
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
        			url :"<?php echo base_url("simpeg/delete_riwayat/pwk")?>",
        			type:'post',
        			data:{
        				id:id,
        				id_pegawai:$("#pwk-id_pegawai_"+id).html(),
        				nip_pegawai:$("#pwk-nip_pegawai_"+id).html(),
        				"<?=$this->security->get_csrf_token_name();?>" : "<?= $this->security->get_csrf_hash();?>",
        			},
        			success    : function(data){
        				console.log(data);

        				swal("Data berhasil dihapus", {
        					icon: "success",
        				});

        				setTimeout(function() {
        					get_riwayat('jabatan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('jabatan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function verifikasi_hapus_pwk(id)
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
        			url :"<?php echo base_url("simpeg/verif_delete_riwayat/pwk")?>",
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
        					get_riwayat('jabatan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('jabatan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function batal_pwk(id)
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
        			url :"<?php echo base_url("simpeg/cancel_riwayat/pwk")?>",
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
        					get_riwayat('jabatan');
        				}, 500);
        			},
        			error: function(xhr, status, error) {
                      //swal("Opps","Error","error");
                      console.log(xhr);

                      setTimeout(function() {
                      	get_riwayat('jabatan');
                      }, 500);
                  }
              });

        	}
        });
    }
    function tambah_pwk()
    {
    	$("#pwk-fileframe").attr("src","");
        $("#pwk-filelink").html("");

    	$("#pwk-id_update").val("");
    	$("#pwk-id_pwk").val("");
    	$("#pwk-kode_bkn_pwk").val("");

    	$("#pwk-kode_kpkn").val("").trigger("change");
    	$("#pwk-nama_skpd").val("");
    	$("#pwk-nama_unit_kerja").val("");
    	$("#pwk-tmt_pwk").val("");

    	$("#pwk-sk_nomor").val("");
    	$("#pwk-sk_tanggal").val("");

    	$(".add-new-data.pwk").addClass("show");
    	$(".overlay-bg.pwk").addClass("show");

        $("#pwk-btn-simpan").removeClass("hidden");
        $("#pwk-btn-batal").removeClass("hidden");

        $("#pwk-input-alasan").addClass("hidden");
        $("#pwk-btn-verifikasi").addClass("hidden");
        $("#pwk-btn-tolak").addClass("hidden");
    }
</script>

