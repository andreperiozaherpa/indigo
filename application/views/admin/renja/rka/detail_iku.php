<?php
$viewonly = (isset($_GET['viewonly'])) ? "hidden" : "" ;
?>
<style type="text/css">
  .alert-default{
    border: solid 1px #6003c8;
    color: #6003c8;
    font-weight: 400;
  }
  .switchery > span {
    margin-left: 45px;
    margin-right: 30px;
    line-height: 28px;
    color: #6003c8;
    text-align: left !important;
  }
  .switchery small i{
    color: #6003c8;
    line-height: 28px;
    margin-left: 0px;
  }
</style>
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Ren. Strategis</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Ren. Strategis</li>				</ol>
       </div>
       <!-- /.col-lg-12 -->
     </div>

     <div class="row">
       <div class="col-md-12">
        <a href="<?=base_url('renja_perencanaan/detail/'.$id_skpd.'/'.$detail->tahun_renja.'')?>" style="margin-bottom: 10px;" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali</a>
      </div>
    </div>

    <div class="row">
     <div class="col-md-12">
      <div class="white-box">
       <div class="row">
        <form method="POST">
          <div class="col-md-3 b-r text-center">
            <strong style="color:#3F0090;"><?=$nama_jenis?></strong>
            <br>
            <br>
            <?php $total_capaian = 0; $count_total_capaian = 0; ?>
            <p>
              <div id="grafik-capaian" data-label="0%" class="css-bar css-bar-0 css-bar-lg"></div>
            </p>
          </div>
          <div class="col-md-9">
            <div class="panel-wrapper collapse in" aria-expanded="true">
             <div class="panel panel-primary">
              <div class="panel panel-heading">
                <?=$detail->nama_unit_kerja?>
              </div>
              <div class="panel-body">
                <table class="table">
                  <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <?=$kepala->nama_lengkap?><strong></strong></tr>
                    <tr><td style="width: 120px;">Jumlah Staf</td><td>:</td><td> <?=($staff)?> Org<strong></strong></tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel panel-heading">
          Detail IKU
        </div>
        <div class="panel panel-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-12">Sasaran</label>
              <div class="col-md-9">
                <p class="form-control-static"> <?=$detail->$tSasaran?> </p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Indikator Kerja Utama</label>
              <div class="col-md-9">
                <p class="form-control-static"> <?=$detail->$tIku?> </p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Deskripsi</label>
              <div class="col-md-9">
                <p class="form-control-static"> <?=$detail->deskripsi?> </p>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6">
                <label class="col-sm-12">Satuan Pengukuran</label>
                <div class="col-md-9">
                  <p class="form-control-static"><?= $detail->satuan ?></p>
                </div>
              </div>
              <div class="col-md-6">
                <label class="col-sm-12">Waktu Pengukuran</label>
                <div class="col-md-9">
                  <p class="form-control-static"> <?= ucwords($detail->id_waktu) ?> </p>
                </div>
              </div>
            </div>
            <div class="form-group">

              <div class="col-md-6">
                <label class="col-sm-12">Anggaran</label>
                <div class="col-md-9">
                  <p class="form-control-static"> <?=rupiah($detail->$aIkuRenja)?> </p>
                </div>
              </div>
              <div class="col-md-6">
                <label class="col-sm-12">Target</label>
                <div class="col-md-9">
                  <p class="form-control-static"> <?=($detail->$taIkuRenja)?> </p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6">
                <label class="col-sm-12">Tingkat Kendali IKU</label>
                <div class="col-md-9">
                  <p class="form-control-static"><?=$detail->t_kendali_indikator?></p>
                </div>
              </div>
              <div class="col-md-6">
                <label class="col-sm-12">Tingkat Validitas Iku</label>
                <div class="col-md-9">
                  <p class="form-control-static"> <?=$detail->t_validitas_indikator?> </p>
                </div>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <div class="col-md-6">
                <label class="col-sm-12">Jenis Konsolidasi.</label>
                <div class="col-md-9">
                  <p class="form-control-static"><?=$detail->jenis_konsolidasi?></p>
                </div>
              </div>
              <div class="col-md-6">
                <label class="col-sm-12">Polorarisasi</label>
                <div class="col-md-9">
                  <p class="form-control-static"> <?=$detail->polorarisasi?> </p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6">
                <label class="col-sm-12">Jenis Casecading</label>
                <div class="col-md-9">
                  <p class="form-control-static"><?=$detail->jenis_casecading?></p>
                </div>
              </div>
              <div class="col-md-6">
                <label class="col-sm-12">Metode Casecading</label>
                <div class="col-md-9">
                  <p class="form-control-static"> <?=$detail->metode_casecading?> </p>
                </div>
              </div>
            </div>
            <div class="panel-footer">
              <!-- <div class="pull-right">
                <a href="<?php echo base_url('renstra_perencanaan/edit');?>" class="btn btn-primary" style="color:white;"><i class="ti-pencil"></i> Edit</a><a href="#" class="btn btn-danger" style="color:white;"><i class="ti-trash"></i> Hapus</a>
              </div> -->
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="panel panel-primary">
        <div class="panel panel-heading">
          Rencana Aksi
          <a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right <?=$viewonly?>" style="position:relative;bottom:6px;color: #6003C8 !important" onclick="tambahRenaksi()"><i class="ti-plus"></i> Tambah Renaksi</a>
        </div>
        <div class="panel panel-body ">
          <?php 
          if(empty($renaksi)){
            ?>
            <div class="alert alert-default"><i class="ti-alert"></i> Belum ada renaksi</div>
            <?php
          }else{
            $no=1; foreach($renaksi as $r){
              $target = $this->renja_perencanaan_model->get_target_renaksi($jenis,$r->$cRenaksi);
              ?>
              <div class="row b-t m-t-50" style="margin-top: 0px;padding-top: 30px">
               <p><strong style="padding-top:20px;">Rencana Aksi <?=$no?>.</strong> <?=$r->$tRenaksi?><a style="margin-left: 10px;color:white;" href="javascript:void(0)" onclick="hapusRenaksi(<?=$r->$cRenaksi?>)" class="btn btn-danger pull-right <?=$viewonly?>"><i class="ti-trash"></i> Hapus</a><a href="javascript:void(0)" class="btn btn-primary pull-right <?=$viewonly?>" style="color:white;" onclick="editRenaksi('<?=$jenis?>',<?=$r->$cRenaksi?>)"><i class="ti-pencil"></i> Edit</a></p>
               <br>
               <div class="table-responsive">
                <table class="table color-table muted-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">Bulan</th>
                      <th style="text-align: center">Status Jadwal</th>
                      <th style="text-align: center">Target</th>
                      <th style="text-align: center">Realisasi</th>
                      <th style="text-align: center">Capaian</th>
                      <th style="text-align: center">Lampiran</th>
                      <th class=" <?=$viewonly?>" style="text-align: center">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach($target as $t){

                      if($t->status_jadwal=='dijadwalkan'){
                        $icon = 'ti-check';
                        $color = 'primary';
                        $tcolor = '';
                        $disabled = '';

                        // $capaian = get_capaian($t->target,$t->realisasi,$detail->polorarisasi);
                        $capaian = $t->capaian;
                        $total_capaian += $capaian;
                        $count_total_capaian++;
                      }else{
                        $icon = 'ti-close';
                        $color = 'danger';
                        $tcolor = 'danger';
                        $disabled = ' disabled';

                        $capaian = 0;
                      }
                      ?>
                      <tr>
                        <td style="text-align: center"><?=bulan($t->bulan)?></td>
                        <td style="text-align: center"><span class="label label-<?=$color?>"><i class="<?=$icon?>"></i> <?=normal_string($t->status_jadwal)?></span></td>
                        <td style="text-align: center" class="<?=$tcolor?>"><?=$t->target?></td>
                        <td style="text-align: center" class="<?=$tcolor?>"><?=$t->realisasi?></td>
                        <td style="text-align: center" class="<?=$tcolor?>"><?=$capaian?></td>
                        <td style="text-align: center" class="<?=$tcolor?>">
                          <?php if(!empty($t->dokumen_pendukung)) {
                            ?>

                            <a href="<?=base_url().'data/dokumen_renaksi/'.$t->dokumen_pendukung;?>" target="_blank" >Download</a>
                          <?php } else  echo "-" ;?>

                        </td>
                        <td class=" <?=$viewonly?>" style="text-align: center">
                          <?php 
                          if($t->status_jadwal=='dijadwalkan'){
                            ?>
                            <a href="javascript:void(0)" class="btn btn-primary" style="color:white;" onclick="updateRenaksiDetail('<?=$jenis?>',<?=$t->$cTaRenaksi?>)"><i class="ti-eye"></i> Update Capaian</a>
                            <?php
                          }else{
                            ?>
                            <button class="btn btn-default" disabled><i class="ti-eye"></i> Update Capaian</button>
                            <?php
                          }
                          ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <?php $no++; } } ?>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      document.getElementById("grafik-capaian").setAttribute("data-label","<?=round($total_capaian/$count_total_capaian,1)?>%");
      document.getElementById("grafik-capaian").classList.remove("css-bar-0");
      document.getElementById("grafik-capaian").classList.add("css-bar-<?=roundfive($total_capaian/$count_total_capaian)?>");
    </script>

    <!--Modal Tambah Renaksi-->
    <div id="tambahRenaksi" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Tambah Rencana Aksi</h4>
            </div>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST">
              <input type="hidden" name="id_renaksi" value="">
              <div class="form-group">
                <label class="col-sm-12">Nama Rencana Aksi</label>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="renaksi" placeholder="Masukkan Nama Rencana Aksi">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-12">Perhitungan ke atasan</label>
                <div class="col-md-12">
                  <select class="form-control" name="perhitungan_atasan">
                    <option value="">Tidak dihitung</option>
                    <option value="akumulasi">Akumulasi</option>
                    <option value="rata_rata">Rata-rata</option>
                  </select>
                </div>
              </div>
              <label>Jadwal Pelaksanaan</label>
              <div class="table-responsive">
                <table class="table color-table muted-table table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align: center" width="30%">Bulan</th>
                      <th style="text-align: center">Status Jadwal</th>
                      <th style="text-align: center">
                        Target<br>
                        <small style="font-weight: 300">(Target Tahun Ini : <?=$detail->$taIkuRenja?>)</small>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    for($i=1;$i<=12;$i++){
                      ?>
                      <tr>
                        <td style="text-align: center"><?=bulan($i)?></td>
                        <td style="text-align: center"><input type="checkbox" value="dijadwalkan" class="js-switch3" data-color="#f96262" data-secondary-color="#6164c1" name="status_jadwal_<?=$i?>"></td>
                        <td style="text-align: center">
                          <input type="text" class="form-control input_target" onchange="cekTarget(<?=$i?>)" id="input_target" name="target_<?=$i?>" placeholder="Masukkan Target Renaksi" disabled>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-outline waves-effect text-left" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
              <button type="submit" name="tambah_renaksi" id="btnRenaksi" class="btn btn-primary waves-effect text-left"><i class="ti-save"></i> Simpan</button>
            </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Modal Edit Renaksi-->
    <!--Modal Edit Detail Renaksi Capaian Bulan-->
    <div id="updateRenaksiDetail" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Edit Capaian Bulan ...</h4>
            </div>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST" enctype='multipart/form-data'>
              <input type="hidden" name="id_target_renaksi">
              <div class="form-group">
                <label class="col-sm-12">Target</label>
                <div class="col-md-12">
                  <p class="form-control-static" id="target_renaksi"></p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-12">Realisasi</label>
                <div class="col-md-12">
                  <input type="text" onchange="cekRealisasi()" class="form-control" name="realisasi_target" placeholder="Masukkan Realisasi">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="checkbox" name="perhitungan_capaian_renaksi" id="rPerhitungan" value="otomatis" checked class="js-switch" onchange="toggleCapaian()" data-color="#6003c8" data-size="small" /> Hitung Capaian Otomatis
                </div>
              </div>
              <div class="form-group" id="formCapaian" style="display: none;">
                <label class="col-sm-12">Capaian</label>
                <div class="col-md-12">
                  <input type="text" id="txtCapaian" class="form-control" name="capaian" value="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-12">Dokumen Pendukung</label>
                <div class="col-md-12">
                  <input type="file" id="input-file-now" data-default-file="" name="dokumen_pendukung" class="dropify" />
                  <small>*<b>File yang diizinkan</b> : .docx, .doc, .xls, .xlsx, .pdf, .jpg, .jpeg, .png, .gif, .rar, .zip, .ppt, .pptx</small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-12">Link</label>
                <div class="col-md-12">
                  <input type="text" name="link_dokumen_pendukung" class="form-control" placeholder="Masukkan Link Dokumen Pendukung">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary waves-effect text-left" name="update_target_renaksi">Simpan</button>
            </div>
          </div>
        </form>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>



    <div id="hapusRenaksi" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Hapus Rencana Aksi</h4>
            </div>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="hidden" name="id_renaksi">
              Apakah anda yakin akan menghapus Rencana Aksi Ini?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-outline waves-effect text-left" data-dismiss="modal">Tidak</button>
              <button type="submit" name="hapus_renaksi" id="btnHapusRenaksi" class="btn btn-primary waves-effect text-left">Ya</button>
            </div>
          </div>
        </form>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


    <script type="text/javascript">
      function tambahRenaksi(){
        $('#tambahRenaksi .modal-title').html('Tambah Rencana Aksi');
        $('#tambahRenaksi #btnRenaksi').attr('name','tambah_renaksi');
        $('#tambahRenaksi input[type=text]').each(function(){
          $(this).val('');
        })
        $('#tambahRenaksi input[type=checkbox]').each(function(){
          $(this).prop('checked',true);
          $(this).next().trigger('click');
        })
        $('#tambahRenaksi').modal('show'); 
      }
      function hapusRenaksi(id_renaksi){
        $('#hapusRenaksi input[name="id_renaksi"]').val(id_renaksi);
        $('#hapusRenaksi').modal('show'); 

      }
      function editRenaksi(jenis,id_renaksi){
        $('#tambahRenaksi .modal-title').html('Ubah Rencana Aksi');
        $('#tambahRenaksi #btnRenaksi').attr('name','ubah_renaksi');
        $.getJSON( "<?=base_url('renja_perencanaan/get_renaksi/')?>/"+jenis+"/"+id_renaksi, function(data) {
          $('input[name=renaksi]').val(data.renaksi);
          $('input[name=id_renaksi]').val(data.id_renaksi);
          var i;
          for(i=1;i<=12;i++){
            var target = 'data.target_'+i;
            var status = 'data.status_jadwal_'+i;
            status = eval(status);
            if(status=='dijadwalkan'){
              $('input[name=target_'+i+']').removeAttr('disabled');
              $('input[name=status_jadwal_'+i+']').prop('checked',false);
              $('input[name=status_jadwal_'+i+']').next().trigger('click');
            }
            $('input[name=target_'+i+']').val(eval(target));
          }

          $('#tambahRenaksi').modal('show'); 
        });
      }
      function updateRenaksiDetail(jenis,id_target_renaksi){
        var id_kepala = "<?=$id_kepala?>";

        if(id_kepala==0){
          alert('Kepala SKPD/Unit Kerja tidak ditemukan');
        }else{
          $.getJSON( "<?=base_url('renja_perencanaan/get_target_renaksi/')?>/"+jenis+"/"+id_target_renaksi, function(data) {
            $('input[name=id_target_renaksi]').val(id_target_renaksi);
            $('input[name=realisasi_target]').val(data.realisasi);
            $('input[name=realisasi_target]').attr('onchange','cekRealisasi('+data.target+')');
            $('#target_renaksi').html(data.target);

            if(data.perhitungan_capaian_renaksi=='manual'){
              $('#rPerhitungan').prop('checked',true);
              $('#rPerhitungan').next().trigger('click');
              $('#formCapaian').show();
            }else{
              $('#rPerhitungan').prop('checked',false);
              $('#rPerhitungan').next().trigger('click');
              $('#formCapaian').hide();
            }
            $('#txtCapaian').val(data.capaian_renaksi);
            $('input[name=link_dokumen_pendukung]').val(data.link_dokumen_pendukung);
            if(data.dokumen_pendukung){
              var imagenUrl = '<?=base_url('data/dokumen_renaksi')?>/'+data.dokumen_pendukung;
              var drEvent = $('.dropify').dropify(
              {
                defaultFile: imagenUrl
              });
              drEvent = drEvent.data('dropify');
              drEvent.resetPreview();
              drEvent.clearElement();
              drEvent.settings.defaultFile = imagenUrl;
              drEvent.destroy();
              drEvent.init();
            }else{
              var imagenUrl = '';
              var drEvent = $('.dropify').dropify(
              {
                defaultFile: imagenUrl
              });
              drEvent = drEvent.data('dropify');
              drEvent.resetPreview();
              drEvent.clearElement();
              drEvent.settings.defaultFile = imagenUrl;
              drEvent.destroy();
              drEvent.init();
            }
            $('#updateRenaksiDetail').modal('show'); 
          });
        }
      }
      function cekTarget(id){
        var total = 0;
        var target = <?=str_replace(',', '.', $detail->$taIkuRenja)?>;
        $('.input_target').each(function (key,value){
          if($(this).val()!==''){
            v = parseInt($(this).val());
          }else{
            v = 0;
          }
          total += v;
        });
        if(total>target){
          alert('Maksimal total target adalah '+target);
          $('[name="target_'+id+'"]').val('');
        }
      }
      function cekRealisasi(target){
        var realisasi = $('input[name=realisasi_target]').val();
        if(realisasi>target){
          alert('Realisasi tidak boleh melebihi target');
          $('input[name=realisasi_target]').val(target);
        }
      }
      function toggleCapaian(){
        $('#formCapaian').toggle();
      }
    </script>