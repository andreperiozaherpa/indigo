<?php
switch ($this->uri->segment(3)) {
  case 'ss':
    $sasaran  = "sasaran_strategis_renstra";
    $iku      = "iku_ss_renstra";
    $anggaran = "anggaran_ss_renstra";
    $update   = "update_indikator_sasaran_strategis";
    break;

  case 'sp':
    $sasaran  = "sasaran_program_renstra";
    $iku      = "iku_sp_renstra";
    $anggaran = "anggaran_sp_renstra";
    $update   = "update_indikator_sasaran_program";
    break;

  case 'sk':
    $sasaran  = "sasaran_kegiatan_renstra";
    $iku      = "iku_sk_renstra";
    $anggaran = "anggaran_sk_renstra";
    $update   = "update_indikator_sasaran_kegiatan";
    break;

  case 'ssk':
    $sasaran  = "sasaran_subkegiatan_renstra";
    $iku      = "iku_ssk_renstra";
    $anggaran = "anggaran_ssk_renstra";
    $update   = "update_indikator_sasaran_subkegiatan";
    break;
  
  default:
    redirect('renstra_perencanaan');
    break;
}

$a_unit_kerja = array();
foreach($iku_unit_kerja as $row){
  $a_unit_kerja[] = $row['id_unit_kerja'];
}
$d_iku_unit_kerja = implode(', ', $a_unit_kerja);
?>
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
        <div class="white-box">
         <div class="row">
            <div class="col-md-3 b-r">
              <center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>
            </div>
            <div class="col-md-9">
              <div class="panel-wrapper collapse in" aria-expanded="true">
               <div class="panel panel-default">
                <div class="panel-body">
                  <table class="table">
                    <tr><td style="width: 120px;">Nama Unit </td><td>:</td><td> <strong></strong></tr>
                      <tr><td style="width: 120px;"></td><td>:</td><td> <strong></strong></tr>
                        <tr><td style="width: 120px;"></td><td>:</td><td> <strong></strong>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>



      <div id="" class="row">
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              Detail Indikator
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">

                <form class="form-horizontal" id="data-form-updateIndikator" action="#!">
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="col-sm-12">Sasaran</label>
                      <div class="col-sm-12">
                        <select name="id_<?=$sasaran?>" class="form-control select2">
                          <option value="">Pilih Sasaran</option>
                          <?php 
                            foreach($list_sasaran as $l){
                              $id_sasaran = "id_".$sasaran;
                              if($l[$id_sasaran]==$detail->$id_sasaran){
                                $selected = ' selected';
                              }else{
                                $selected = '';
                              }
                              echo '<option value="'.$l[$id_sasaran].'"'.$selected.'>'.$l[$sasaran].'</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="col-md-12">Indikator Kerja Utama</label>
                      <div class="col-md-12">
                        <input id="data-iku_sk_renstra" name="<?=$iku?>" type="text" class="form-control" value="<?=$detail->$iku?>" placeholder="placeholder" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="col-md-12">Deskripsi</label>
                      <div class="col-md-12">
                        <textarea name="deskripsi" class="form-control" rows="5"><?=$detail->deskripsi?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6">
                      <label class="col-sm-12">Satuan Pengukuran</label>
                      <div class="col-sm-12">
                        <select name="id_satuan" class="form-control select2" required>
                          <?php foreach ($ref_satuan as $key => $value): $selected = ($value->id_satuan == $detail->id_satuan)?"selected":"";?>
                            <option value="<?=$value->id_satuan?>" <?=$selected?>><?=$value->satuan?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="col-sm-12">Waktu Pengukuran</label>
                      <div class="col-sm-12">
                        <select name="id_waktu" class="form-control" required>
                          <option value="per hari" <?=($detail->id_waktu=="per hari")?"selected":""?>>per hari</option>
                          <option value="per bulan" <?=($detail->id_waktu=="per bulan")?"selected":""?>>per bulan</option>
                          <option value="per semester" <?=($detail->id_waktu=="per semester")?"selected":""?>>per semester</option>
                          <option value="per tahun" <?=($detail->id_waktu=="per tahun")?"selected":""?>>per tahun</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <div class="col-lg-12">
                      <label class="col-sm-12">Polorarisasi</label>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="radio radio-primary">
                          <input type="radio" name="polorarisasi" id="radio103" value="Maximaze" <?=($detail->polorarisasi=="Maximaze")?"checked":""?>>
                          <label for="radio103"> Maximaze </label> <span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="adalah kondisi bila realisasi kinerja harus lebih besar dari pada target, atau semakin besar hasil realisasi kinerja maka nilai capaian dari target tersebut semakin bagus. Contohnya : target jumlah pendapatan daerah (bisa menggunakan maximize)"><i class="ti-info" style="font-size:9px"></i></span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="radio radio-primary">
                          <input type="radio" name="polorarisasi" id="radio113" value="Minimaze" <?=($detail->polorarisasi=="Minimaze")?"checked":""?>>
                          <label for="radio113"> Minimaze </label> <span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="adalah kondisi bila realisasi kinerja harus lebih kecil dari pada target, atau semakin kecil hasil realisasi kinerja maka nilai capaian dari target tersebut semakin bagus. Contohnya : target jumlah kematian bayi (bisa menggunakan minimize)"><i class="ti-info" style="font-size:9px"></i></span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="radio radio-primary">
                          <input type="radio" name="polorarisasi" id="radio123" value="Stabilize" <?=($detail->polorarisasi=="Stabilize")?"checked":""?>>
                          <label for="radio123"> Stabilize </label> <span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="adalah kondisi bila realisasi kinerja harus mendekati nilai dari pada target, atau semakin kecil selisih antara  realisasi dan target, maka capaian tersebut semakin bagus. Contohnya : target penyerapan anggaran (bisa menggunakan stabilize)"><i class="ti-info" style="font-size:9px"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-12">
                      <label class="col-sm-12">Jenis Casecading</label>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="radio radio-primary">
                          <input type="radio" name="jenis_casecading" id="radio133" value="Casecading Peta" <?=($detail->jenis_casecading=="Casecading Peta")?"checked":""?>>
                          <label for="radio133"> Pemilik IKU </label> <span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="Bila kondisi IKU tersebut merupakan bagian dari tugas pokok dari unitkerja tersebut atau memiliki tanggung jawab besar atas ketercapaian target"><i class="ti-info" style="font-size:9px"></i></span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="radio radio-primary">
                          <input type="radio" name="jenis_casecading" id="radio153" value="Non Casecading" <?=($detail->jenis_casecading=="Non Casecading")?"checked":""?>>
                          <label for="radio153"> Bukan Pemilik IKU </label> <span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="Bila kondisi IKU tersebut merupakan tugas tambahan yang diberikan dan bukan bagian dari tugas pokok unitkerja, atau tidak bertanggung jawab secara langsung ata s target kinerja tersebut"><i class="ti-info" style="font-size:9px"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <div class="col-lg-12">
                      <label class="col-sm-12">Metode Casecading</label>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="radio radio-primary">
                          <input type="radio" name="metode_casecading" id="radio163" value="Direct" <?=($detail->metode_casecading=="Direct")?"checked":""?>>
                          <label for="radio163"> Direct </label> <span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="radio radio-primary">
                          <input type="radio" name="metode_casecading" id="radio173" value="In-direct" <?=($detail->metode_casecading=="In-direct")?"checked":""?>>
                          <label for="radio173"> In-direct </label> <span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <?php if ($this->uri->segment(3)=="ss" OR $this->uri->segment(3)=="sp" OR $this->uri->segment(3)=="sk"): ?>
                  <div class="form-group">
                    <div class="col-lg-12">
                     <label class="col-sm-12">Casecading ke Unit Kerja</label>
                     <div class="col-lg-12">
                      <?php foreach ($unit_kerja as $key => $value): 
                        if(array_search($value->id_unit_kerja, array_column($iku_unit_kerja , 'id_unit_kerja'))!==false){
                          $checked = ' checked';
                        }else{
                          $checked = '';
                        }
                        ?>
                        <div class="checkbox checkbox-primary">
                          <input id="checkbox2_<?=$key?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value->id_unit_kerja?>" <?=$checked?>>
                          <label for="checkbox2_<?=$key?>"> <?=$value->nama_unit_kerja?> </label>
                        </div>
                        <?php  
                        $unit_kerja_2 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$value->id_unit_kerja);
                        ?>
                        <?php if(count($unit_kerja_2)!==0){ foreach ($unit_kerja_2 as $key2 => $value2):
                        if(array_search($value2->id_unit_kerja, array_column($iku_unit_kerja , 'id_unit_kerja'))!==false){
                          $checked = ' checked';
                        }else{
                          $checked = '';
                        }?>
                          <div class="checkbox checkbox-primary m-l-20">
                            <input id="checkbox2_<?=$key?>_<?=$key2?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value2->id_unit_kerja?>" <?=$checked?>>
                            <label for="checkbox2_<?=$key?>_<?=$key2?>"> <?=$value2->nama_unit_kerja?> </label>
                          </div>
                          <?php  
                          $unit_kerja_3 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$value2->id_unit_kerja);
                          ?>
                          <?php if(count($unit_kerja_3)!==0){ foreach ($unit_kerja_3 as $key3 => $value3):
                        if(array_search($value3->id_unit_kerja, array_column($iku_unit_kerja , 'id_unit_kerja'))!==false){
                          $checked = ' checked';
                        }else{
                          $checked = '';
                        }?>
                            <div class="checkbox checkbox-primary m-l-30">
                              <input id="checkbox2_<?=$key?>_<?=$key2?>_<?=$key3?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value3->id_unit_kerja?>" <?=$checked?>>
                              <label for="checkbox2_<?=$key?>_<?=$key2?>_<?=$key3?>"> <?=$value3->nama_unit_kerja?> </label>
                            </div>
                            <?php  
                            $unit_kerja_4 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$value3->id_unit_kerja);
                            ?>
                            <?php if(count($unit_kerja_4)!==0){ foreach ($unit_kerja_4 as $key4 => $value4):
                        if(array_search($value4->id_unit_kerja, array_column($iku_unit_kerja , 'id_unit_kerja'))!==false){
                          $checked = ' checked';
                        }else{
                          $checked = '';
                        }?>
                              <div class="checkbox checkbox-primary m-l-40">
                                <input id="checkbox2_<?=$key?>_<?=$key2?>_<?=$key3?>_<?=$key4?>" type="checkbox" name="casecade_unit_kerja[]" value="<?=$value4->id_unit_kerja?>" <?=$checked?>>
                                <label for="checkbox2_<?=$key?>_<?=$key2?>_<?=$key3?>_<?=$key4?>"> <?=$value4->nama_unit_kerja?> </label>
                              </div>
                            <?php endforeach; } ?>
                          <?php endforeach; } ?>
                        <?php endforeach; } ?>
                        <hr style="margin:0;">
                      <?php endforeach ?>
                    </div>
                  </div>
                </div>
                      <?php endif ?>
                  <div class="panel-footer">
                    <div class="pull-right">
                      <button type="submit" id="data-form-submit-updateIndikator" hidden></button>
                      <button type="button" onclick="update_indikator_sasaran();" class="btn btn-primary" style="color:white;"><i class="ti-save"></i> Simpan</button>
                    </div>
                  </div>

            </div>
          </div>
        </div>
      </div>


    <div class="col-md-6">
      <div class="col-sm-12">
        <div class="panel panel-default">
         <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
          <span style="color:#6003C8">KONDISI AWAL</span>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
         <div class="panel-body">
          <div class="row b-r b-b b-t b-l">
           <table class="table table-bordered table-striped">
            <thead>
              <tr><th>Target</th>
              </thead>
              <tr><td><input name="kondisi_awal" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->kondisi_awal?>" required></td></tr>
              </table>

            </div>

          </div>
        </div>
      </div>
    </div>

      <div class="col-sm-6">
        <div class="panel panel-default">
         <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
          <span style="color:#6003C8">TAHUN  2019</span>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
         <div class="panel-body">
          <div class="row b-r b-b b-t b-l">
           <table class="table table-bordered table-striped">
            <thead>
              <tr><th>Target</th>
              </thead>
              <tr><td><input name="target_2019" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->target_2019?>" required></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><input name="anggaran_2019" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->anggaran_2019?>" required></td></tr>
              </table>

            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="col-sm-6">
      <div class="panel panel-default">
       <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
        <span style="color:#6003C8">TAHUN  2020</span>
      </div>
      <div class="panel-wrapper collapse in" aria-expanded="true">
       <div class="panel-body">
        <div class="row b-r b-b b-t b-l">
         <table class="table table-bordered table-striped">
          <thead>
            <tr><th>Target</th>
            </thead>
            <tr><td><input name="target_2020" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->target_2020?>" required></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><input name="anggaran_2020" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->anggaran_2020?>" required></td></tr>
            </table>

          </div>

        </div>
      </div>
    </div>
  </div>


  <div class="col-sm-6">
    <div class="panel panel-default">
     <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
      <span style="color:#6003C8">TAHUN  2021</span>
    </div>
    <div class="panel-wrapper collapse in" aria-expanded="true">
     <div class="panel-body">
      <div class="row b-r b-b b-t b-l">
        <table class="table table-bordered table-striped">
          <thead>
            <tr><th>Target</th>
            </thead>
            <tr><td><input name="target_2021" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->target_2021?>" required></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><input name="anggaran_2021" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->anggaran_2021?>" required></td></tr>
            </table>

          </div>

        </div>
      </div>
    </div>
  </div>



  <div class="col-sm-6">
    <div class="panel panel-default">
     <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
      <span style="color:#6003C8">TAHUN  2022</span>
    </div>
    <div class="panel-wrapper collapse in" aria-expanded="true">
     <div class="panel-body">
      <div class="row b-r b-b b-t b-l">
        <table class="table table-bordered table-striped">
          <thead>
            <tr><th>Target</th>
            </thead>
            <tr><td><input name="target_2022" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->target_2022?>" required></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><input name="anggaran_2022" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->anggaran_2022?>" required></td></tr>
            </table>

          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="panel panel-default">
     <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
      <span style="color:#6003C8">TAHUN  2023</span>
    </div>
    <div class="panel-wrapper collapse in" aria-expanded="true">
     <div class="panel-body">
      <div class="row b-r b-b b-t b-l">
       <table class="table table-bordered table-striped">
        <thead>
          <tr><th>Target</th>
          </thead>
          <tr><td><input name="target_2023" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->target_2023?>" required></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><input name="anggaran_2023" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->anggaran_2023?>" required></td></tr>
          </table>

        </div>

      </div>
    </div>
  </div>
</div>

  <div class="col-sm-6">
    <div class="panel panel-default">
     <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
      <span style="color:#6003C8">KONDISI AKHIR</span>
    </div>
    <div class="panel-wrapper collapse in" aria-expanded="true">
     <div class="panel-body">
      <div class="row b-r b-b b-t b-l">
       <table class="table table-bordered table-striped">
        <thead>
          <tr><th>Target</th>
          </thead>
          <tr><td><input name="kondisi_akhir_target" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->kondisi_akhir_target?>" required></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><input name="kondisi_akhir_anggaran" type="text" class="form-control" placeholder="placeholder" value="<?=$detail->kondisi_akhir_anggaran?>" required></td></tr>
          </table>

        </div>

      </div>
    </div>
  </div>
</div>
</div>



</div>
              </form>


<script type="text/javascript">
  

  function block_ui(element) {
    $(element).block({
      message: '<h4><img src="<?=base_url('asset/pixel');?>/plugins/images/busy.gif" /> We are processing your request.</h4>',
      css: {
        border: '1px solid #fff'
      }
    });
  }

  function update_indikator_sasaran() {
    block_ui("#updateIndikator");

    $.ajax({
      url:"<?php echo base_url('renstra_perencanaan/'.$update.'/'.$this->uri->segment(5));?>",
      type:"POST",
      data: $('#data-form-updateIndikator').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data telah diupdate.", "success");
          window.location.href = "<?php echo base_url('renstra_perencanaan/detail/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>";
        } else if (resp == false) {
          swal("error!", "", "error");
          $("#updateIndikator").unblock();
          $("#data-form-submit-updateIndikator").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#updateIndikator").unblock();
      }
    })
  }
</script>