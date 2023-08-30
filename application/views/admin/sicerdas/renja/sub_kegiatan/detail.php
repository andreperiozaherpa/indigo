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
			<h4 class="page-title">Detail Rencana Kerja SKPD</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="https://e-office.sumedangkab.go.id/renja_perencanaan">Rencana Kerja</a></li>				
          <li class="active">Detail</li>       
        </ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>

<div class="row">

    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
        <form method="POST">
            <div class="col-md-3 b-r">
              <center><img style="width: 80%" src="https://e-office.sumedangkab.go.id//data/logo/skpd/sumedang.png" alt="user" class="img-circle"> </center>
            </div>
            <div class="col-md-9">
              <div class="panel panel-default">
                <div class="panel-heading"><?=$dt_skpd->nama_skpd;?> <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td style="width: 120px;">Nama Kepala </td>
                          <td>:</td>
                          <td> <strong><?=$dt_skpd->kepala->nama_lengkap;?></strong></td>
                        </tr>
                        <tr>
                          <td style="width: 120px;">Alamat SKPD </td>
                          <td>:</td>
                          <td> <strong><?=$dt_skpd->alamat_skpd;?></strong></td>
                        </tr>
                        <tr>
                          <td style="width: 120px;">Email/tlp </td>
                          <td>:</td>
                          <td> <strong><?=$dt_skpd->email_skpd;?> / <?=$dt_skpd->telepon_skpd;?></strong>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
     </div>


    <div class="col-md-12">



      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <div class="panel panel-default block6">
            <div class="panel-heading"> Detail Sub Kegiatan
              <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-6 b-r">
                    <div class="row">
                      <div class="col-md-12 b-b-">
                        <h3 class="box-title m-b-0">Sub Kegiatan</h3>
                        <p><?=$detail->kode_sub_kegiatan.' - ' . $detail->nama_sub_kegiatan;?></p>
                      </div>
                      <div class="col-md-12 b-b-">
                        <h3 class="box-title m-b-0">Kegiatan</h3>
                        <p><?=$detail->kode_kegiatan.' - ' . $detail->nama_kegiatan;?></p>
                      </div>
                      
                    </div>
                    
                  </div>
                  <div class="col-md-6">

                    <div class="col-md-12 b-b">
                      <h3 class="box-title m-b-0">Program </h3>
                      <p><?=$detail->kode_program.' - ' . $detail->nama_program;?></p>
                    </div>

                    <div class="col-md-12 b-b">
                      <h3 class="box-title m-b-0">Indikator Program </h3>
                      <!-- <ul>
                        <?php foreach($dt_indikator_sasaran->result() as $row)
                        {
                          echo '<li>'.$row->nama_indikator_sasaran_renstra.'</li>';
                        }
                        ?>
                      </ul> -->
                      <p><?=$detail->nama_indikator_program_rpjmd;?></p>
                    </div>

                    <div class="col-md-12 b-b">
                      <h3 class="box-title m-b-0">Sasaran </h3>
                      <p><?=$detail->nama_sasaran_renstra;?></p>
                    </div>

                    <div class="col-md-12">
                      <h3 class="box-title m-b-0 ">Indikator Sasaran</h3>
                      <!-- <ul>
                        <?php foreach($dt_indikator_rpjmd->result() as $row)
                        {
                          echo '<li>'.$row->nama_indikator_program_rpjmd.'</li>';
                        }
                        ?>
                      </ul> -->
                      <p><?=$detail->nama_indikator_sasaran_renstra;?>
                    </div>


                  </div>
                  <div class="col-md-12">
                    
                    <button data-toggle="modal" data-target="#modal-sub-kegiatan" class="btn btn-primary">Edit</button>
                    <button onclick="hapus(<?=$detail->id_sub_kegiatan_renja;?>)" class="btn btn-danger">Hapus</button>
                  </div>

                </div>

              </div>
            </div>
          </div>





          <div class="white-box">

            <strong>Sub Kegiatan : </strong> <?=$detail->kode_sub_kegiatan.' - ' . $detail->nama_sub_kegiatan;?>
            <hr>

            <table class="table table-bordered table-striped table-hover table-responsive ">
              <thead>
                <tr style="">
                  <th rowspan="2" style="text-align: center;vertical-align:middle">#</th>
                  <th rowspan="2" style="text-align: center;vertical-align:middle">Indikator</th>
                  <th rowspan="2" style="text-align: center;vertical-align:middle">Target</th>
                  <th rowspan="2" style="text-align: center;vertical-align:middle">Satuan</th>
                  <th colspan="12" style="text-align: center;vertical-align:middle">Bulan Pelaksanaan</th>
                  <!--<th rowspan="2" style="text-align: center;vertical-align:middle">Renaksi</th>-->
                  <th rowspan="2" style="text-align: center;vertical-align:middle">Opsi</th>
                </tr>

                <tr>
                  <th>Jan</th>
                  <th>Feb</th>
                  <th>Mar</th>
                  <th>Apr</th>
                  <th>Mei</th>
                  <th>Jun</th>
                  <th>Jul</th>
                  <th>Ags</th>
                  <th>Sep</th>
                  <th>Okt</th>
                  <th>Nov</th>
                  <th>Des</th>
                </tr>
              </thead>
              <tbody id="row-data">
              </tbody>
            </table>
          </div>

          <div class="col-md-12 text-right">
            <a class="btn btn-default" href="<?=base_url();?>sicerdas/renja/subkegiatan?token=<?=$back_token;?>">Kembali</a>
            <button type="button" class="btn btn-primary" onclick="addIndikator()" data-toggle="modal" data-target="#modal-indikator">Tambah Indikator</button>
          </div>
          <div class="col-12 text-center">
                <nav class="mt-4 mb-3">
                    <ul class="pagination justify-content-center mb-0" id="pagination"></ul>
                </nav>
              </div>
        </div>
        <!-- .row -->

      </div>

      <!-- Modal Tambah -->
      <div class="modal fade" id="modal-indikator" tabindex="-1" role="dialog" aria-labelledby="modal-indikatorLabel1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content  panel-primary">
            <div class="panel-heading">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">Indikator</h4>
            </div>
            <div class="modal-body">

              <form id="formIndikator" class="form-horizontal">
                <div id="hidden"></div>
                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-12">Nama Indikator</label>
                    <div class="col-md-12">
                      <input type="text" name="nama_indikator_sub_kegiatan" id="nama_indikator_sub_kegiatan" class="form-control input-text" placeholder="Masukkan Nama Indikator">
                      <div class="text-danger error" id="err_nama_indikator_sub_kegiatan"></div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-12">Target</label>
                    <div class="col-md-12">
                      <input type="number" name="target" id="target" class="form-control input-text" placeholder="Masukkan target">
                      <div class="text-danger error" id="err_target"></div>
                    </div>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-12">Target Anggaran</label>
                    <div class="col-md-12">
                      <input type="number" name="target_anggaran" id="target_anggaran" class="form-control input-text" placeholder="Masukkan target">
                      <div class="text-danger error" id="err_target_anggaran"></div>
                    </div>
                  </div>
                </div> -->

                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-sm-12">Satuan Pengukuran</label>
                    <div class="col-sm-12">
                      <select name="satuan" id="satuan" class="form-control select2 input_select ">
                        <option value="">Pilih Satuan Pengukuran</option>
                        <?php foreach($dt_satuan as $row)
                        {
                          echo '<option value="'.$row->id_satuan.'">'.$row->satuan.'</option>';
                        }
                        ?>
                      </select>
                      <div class="text-danger error" id="err_satuan"></div>
                    </div>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-12">Pagu indikatif</label>
                    <div class="col-md-12">
                      <input type="number" name="pagu_indikatif" id="pagu_indikatif" class="form-control input-text" placeholder="">
                      <div class="text-danger error" id="err_pagu_indikatif"></div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-12">Pagu prakiraan maju</label>
                    <div class="col-md-12">
                      <input type="number" name="pagu_prakiraan_maju" id="pagu_prakiraan_maju" class="form-control input-text" placeholder="">
                      <div class="text-danger error" id="err_pagu_prakiraan_maju"></div>
                    </div>
                  </div>
                </div> -->

                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-12">Lokasi Kegiatan</label>
                    <div class="col-md-12">
                      <input type="text" name="lokasi_kegiatan" id="lokasi_kegiatan" class="form-control input-text" placeholder="Masukkan lokasi kegiatan">
                      <div class="text-danger error" id="err_lokasi_kegiatan"></div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-12">Teknik Penghitungan</label>
                    <div class="col-md-12">
                      <select class="form-control input_select select2" name="metode" id="metode" onchange="setMetode()">
                        <option value="">Pilih</option>
                        <option value="Maximize">Maximize</option>
                        <option value="Minimize">Minimize</option>
                        <option value="Optimize">Optimize</option>
                      </select>
                      <div class="text-danger error" id="err_metode"></div>
                    </div>
                  </div>
                </div>

                <div class="form-group Metode Metode-Minimize">
                  <div class="col-md-12">
                    <label class="col-md-12">Target Minimum</label>
                    <div class="col-md-12">
                      <input type="number" name="target_min" id="target_min" class="form-control input-text" placeholder="">
                      <div class="text-danger error" id="err_target_min"></div>
                    </div>
                  </div>
                </div>

                <div class="form-group Metode Metode-Minimize">
                  <div class="col-md-12">
                    <label class="col-md-12">Target Minimum Anggaran</label>
                    <div class="col-md-12">
                      <input type="number" name="target_anggaran_min" id="target_anggaran_min" class="form-control input-text" placeholder="">
                      <div class="text-danger error" id="err_target_anggaran_min"></div>
                    </div>
                  </div>
                </div>

                <?php foreach($this->Globalvar->get_tahun() as $key => $value) :?>
                  <div class="form-group">
                  <div class="col-md-12">
                      <label class="col-sm-12">Cascading Tahun <?= $value ;?> : </label>
                      <div class="col-sm-12">
                        <select name="cascading[<?= ($key+1);?>][]" id="cascading_<?= ($key+1);?>" class="form-control_ select2 input_select" multiple>
                          <?php foreach($dt_pegawai as $row)
                          {
                            echo '<option value="'.$row->id_pegawai.'">'.$row->nama_lengkap.' - '.$row->jabatan.'</option>';
                          }
                          ?>
                        </select>
                        <div class="text-danger error" id="err_cascading_<?= ($key+1);?>"></div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach;?>

                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-md-12">Jadwal Pelaksanaan</label>
                    <div class="col-md-12">
                    <table class="table color-table muted-table table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align: center" width="30%">Bulan</th>
                      <th style="text-align: center">Status Jadwal</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    for($i=1;$i<=12;$i++){
                      ?>
                      <tr>
                        <td style="text-align: center"><?=bulan($i)?></td>
                        <td style="text-align: center"><input type="checkbox" value="Y" class="js-switch3 cek" data-color="#f96262" data-secondary-color="#6164c1" id="month_<?=$i;?>" name="month[<?=$i?>]"></td>
                        
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                    </div>
                  </div>
                </div>

           
                
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary waves-effect text-left" onclick="saveIndikator()">Simpan</button>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

    </div>
  </div>
</div>


<div class="modal fade" id="modal-sub-kegiatan" tabindex="-1" role="dialog" aria-labelledby="modal-sub-kegiatanLabel1">
  <div class="modal-dialog modal-lg_" role="document" style="">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="modal-sub-kegiatanLabel1">Edit Sub Kegiatan</h4>
      </div>
      <div class="modal-body">
        <form id="form-data">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="recipient-name" class="control-label">Tahun:</label>
                <select name="tahun" id="tahun" class="form-control select2 input_select">
                  <?php for ($i=2022; $i <= date("Y"); $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                  }
                  ?>
                </select>
                <div class="text-danger error" id="err_tahun"></div>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Urusan:</label>
                <select name="id_urusan" id="id_urusan" onchange="get_sub_urusan()" class="form-control select2 input_select">
                  <option value="">Pilih</option>
                  <?php foreach($dt_urusan as $row)
                  {
                    echo '<option  value="'.$row->id_urusan.'">'.$row->kode_urusan.' - '.$row->nama_urusan.'</option>';
                  }
                  ?>
                </select>
                <div class="text-danger error" id="err_id_urusan"></div>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Sub Urusan:</label>
                <select class="form-control select2 input_select" id="id_sub_urusan" name="id_sub_urusan" onchange="get_sasaran()">
                  <option value="">Pilih</option>
                </select>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="control-label">Sasaran:</label>
                <select class="form-control select2 input_select" id="id_sasaran_renstra" name="id_sasaran_renstra" onchange="get_program()">
                  <option value="">Pilih</option>
                </select>
              </div>

              <!-- <div class="form-group">
                <label for="recipient-name" class="control-label">Indikator Sasaran:x</label>
                <select class="form-control select2 input_select" id="id_indikator_sasaran_renstra" name="id_indikator_sasaran_renstra" onchange="get_program()">
                  <option value="">Pilih</option>
                </select>
              </div> -->


              <div class="form-group">
                <label for="recipient-name" class="control-label">Program:</label>
                <select class="form-control select2 input_select" id="id_program_renstra" name="id_program_renstra" onchange="get_indikator_program()">
                  <option value="">Pilih</option>
                </select>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="control-label">Indikator Program:</label>
                <select class="form-control select2 input_select" id="id_indikator_program_renstra" name="id_indikator_program_renstra" onchange="get_kegiatan()">
                  <option value="">Pilih</option>
                </select>
              </div>


              <div class="form-group">
                <label for="recipient-name" class="control-label">Kegiatan:</label>
                <select class="form-control select2 input_select" id="id_kegiatan" name="id_kegiatan" onchange="get_indikator_kegiatan()">
                  <option value="">Pilih</option>
                </select>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="control-label">Indikator Kegiatan:</label>
                <select class="form-control select2 input_select" id="id_indikator_kegiatan" name="id_indikator_kegiatan">
                  <option value="">Pilih</option>
                </select>
                <div class="text-danger error" id="err_id_indikator_kegiatan"></div>
              </div>



              <div class="form-group">
                <label for="recipient-name" class="control-label">Sub Kegiatan:</label>
                <select class="form-control select2 input_select" id="id_sub_kegiatan" name="id_sub_kegiatan" >
                  <option value="">Pilih</option>
                </select>
                <div class="text-danger error" id="err_id_sub_kegiatan"></div>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="control-label">Sumber Anggaran:</label>
                <select name="id_sumber_anggaran" id="id_sumber_anggaran"  class="form-control select2 input_select">
                  <option value="">Pilih</option>
                  <?php foreach($dt_sumber_anggaran as $row)
                  {
                    echo '<option value="'.$row->id_sumber_anggaran.'">'.$row->nama_sumber_anggaran.'</option>';
                  }
                  ?>
                </select>
                <div class="text-danger error" id="err_id_sumber_anggaran"></div>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="control-label">Prioritas Daerah:</label>
                <select name="id_prioritas_daerah" id="id_prioritas_daerah"  class="form-control select2 input_select">
                  <option value="">Pilih</option>
                  <?php foreach($dt_prioritas_daerah as $row)
                  {
                    echo '<option value="'.$row->id_prioritas_daerah.'">'.$row->nama_prioritas_daerah.'</option>';
                  }
                  ?>
                </select>
                <div class="text-danger error" id="err_id_prioritas_daerah"></div>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="control-label">Prioritas nasional:</label>
                <select name="id_prioritas_nasional" id="id_prioritas_nasional"  class="form-control select2 input_select">
                  <option value="">Pilih</option>
                  <?php foreach($dt_prioritas_nasional as $row)
                  {
                    echo '<option value="'.$row->id_prioritas_nasional.'">'.$row->nama_prioritas_nasional.'</option>';
                  }
                  ?>
                </select>
                <div class="text-danger error" id="err_id_prioritas_nasional"></div>
              </div>


            </div>
          
            <div class="col-md-12">
              <div class="row" id="row-unit-kerja">
                  
              </div>
            </div>

        </form>
      </div>
      <div class="modal-footer" style="border-top:none;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="save()">Simpan</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  
   var id_sub_urusan = <?=$detail->id_sub_urusan?>;
   var id_sasaran_renstra = <?=$detail->id_sasaran_renstra?>;
   var id_program_renstra = <?=$detail->id_program_renstra?>;
   var id_indikator_program_renstra = <?=$detail->id_indikator_program_renstra?>;
   var id_kegiatan=<?=$detail->id_kegiatan?>;
   var id_indikator_kegiatan = <?=$detail->id_indikator_kegiatan?>;
   var id_sub_kegiatan=<?=$detail->id_sub_kegiatan?>;
   var dt_tahun = JSON.parse('<?= json_encode($this->Globalvar->get_tahun()) ;?>');
   var page=1;

   setTimeout(() => {
    init(); 
   }, 500);

   function init()
   {
     $("#id_urusan").val(<?=$detail->id_urusan?>).trigger("change");
     $("#id_sumber_anggaran").val(<?=$detail->id_sumber_anggaran?>).trigger("change");
     $("#id_prioritas_daerah").val(<?=$detail->prioritas_daerah?>).trigger("change");
     $("#id_prioritas_nasional").val(<?=$detail->prioritas_nasional?>).trigger("change");
     $("#tahun").val(<?=$detail->tahun?>).trigger("change");

/*      $(".checkbox").prop("checked",false);

    var ids_unit_kerja = JSON.parse('<?= json_encode($ids_unit_kerja) ;?>');

    for(x in ids_unit_kerja)
    {
      id = ids_unit_kerja[x];
      $("#checkbox_"+id).prop("checked",true);
    } */

    
   }

   function get_sub_urusan()
    {
      $("#id_sub_urusan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renja/subkegiatan/get_sub_urusan/",
         type: 'post',
         dataType: 'json',
         data: {
            id_urusan : $("#id_urusan").val(),
            id_sub_urusan : id_sub_urusan,
         },
         success: function (data) {
            $("#id_sub_urusan").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    function get_sasaran()
    {
      $("#id_sasaran_renstra").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renja/subkegiatan/get_sasaran/",
         type: 'post',
         dataType: 'json',
         data: {
            id_sub_urusan : $("#id_sub_urusan").val(),
            id_sasaran_renstra : id_sasaran_renstra,
         },
         success: function (data) {
            $("#id_sasaran_renstra").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }


    /* function get_indikator_sasaran()
    {
      $("#id_indikator_sasaran_renstra").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renstra/sasaran_indikator/get_indikator_by_sasaran/",
         type: 'post',
         dataType: 'json',
         data: {
            id_sasaran_renstra : $("#id_sasaran_renstra").val(),
            id_indikator_sasaran_renstra:id_indikator_sasaran_renstra
         },
         success: function (data) {
            $("#id_indikator_sasaran_renstra").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    } */

    function get_program()
    {
      $("#id_program_renstra").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renja/subkegiatan/get_program/",
         type: 'post',
         dataType: 'json',
         data: {
          //id_indikator_sasaran_renstra : $("#id_indikator_sasaran_renstra").val(),
          id_sasaran_renstra : $("#id_sasaran_renstra").val(),
          id_program_renstra:id_program_renstra
         },
         success: function (data) {
            $("#id_program_renstra").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    function get_indikator_program()
   {
      $("#id_indikator_program_renstra").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renstra/program_indikator/get_indikator_by_program/",
         type: 'post',
         dataType: 'json',
         data: {
            id_program_renstra : $("#id_program_renstra").val(),
            id_skpd : '<?=$dt_skpd->id_skpd;?>',
            id_indikator_program_renstra : id_indikator_program_renstra,
         },
         success: function (data) {
           /* console.log(id_indikator_program_renstra);
           console.log(data); */
            $("#id_indikator_program_renstra").html(data.content).trigger("change");
            
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    function get_kegiatan()
    {
      $("#id_kegiatan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renja/subkegiatan/get_kegiatan/",
         type: 'post',
         dataType: 'json',
         data: {
          id_indikator_program_renstra : $("#id_indikator_program_renstra").val(),
          id_kegiatan : id_kegiatan,
         },
         success: function (data) {
            $("#id_kegiatan").html(data.content).trigger("change");
            
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });

      get_unit_kerja();
    }


    function get_indikator_kegiatan()
    {
      $("#id_indikator_kegiatan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renja/subkegiatan/get_indikator_kegiatan/",
         type: 'post',
         dataType: 'json',
         data: {
          id_kegiatan : $("#id_kegiatan").val(),
          id_indikator_kegiatan : id_indikator_kegiatan,
         },
         success: function (data) {
            $("#id_indikator_kegiatan").html(data.content).trigger("change");
            get_sub_kegiatan();
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    function get_sub_kegiatan()
    {
      $("#id_sub_kegiatan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renja/subkegiatan/get_sub_kegiatan/",
         type: 'post',
         dataType: 'json',
         data: {
          id_kegiatan : $("#id_kegiatan").val(),
          id_sub_kegiatan : id_sub_kegiatan,
         },
         success: function (data) {
            $("#id_sub_kegiatan").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }


    function check(id)
    {
      var is_checked = $("#checkbox_"+id).prop("checked");
      $(".unit-"+id).prop("checked",is_checked);
    }

    function reset_error()
   {
    $(".error").html("");
   }

    function save()
   {
      reset_error();
      var formdata = new FormData(document.getElementById('form-data'));
      formdata.append("action","edit");
      formdata.append("id_sub_kegiatan_renja","<?=$detail->id_sub_kegiatan_renja;?>");
       
      $.ajax({
         url        : "<?=base_url()?>sicerdas/renja/subkegiatan/save",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){
          //console.log(data);
            if(data.status){
               $('#modal-sub-kegiatan').modal('toggle');
               swal(
               'Berhasil',
               data.message,
               'success'
               );
               setTimeout(() => {
                 location.reload();
               }, 1000);
            }
            else{
               for(err in data.errors)
               {
                  $("#err_"+err).html(data.errors[err]);
               }
               if(data.errors.length==0){
                  swal(
                  'Opps',
                  data.message,
                  'warning');
               }
            }
         },
         error: function(xhr, status, error) {
            console.log(xhr);
         }
      });
   }

   function hapus(id) {
    swal({
      title: "Hapus sub kegiatan ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      closeOnConfirm: false
    },
    function(isConfirm) {
      if (isConfirm) {
        $.ajax({
          url        : "<?=base_url()?>sicerdas/renja/subkegiatan//delete",
          type       : 'post',
          dataType   : 'json',
          data       : {
            id      : id,
          },
          success    : function(data){
            if(data.status==true)
            {
              swal({
                type: 'success',
                title: 'Berhasil',
                text: data.message,
                showConfirmButton: false,
                timer: 1500
              });

              window.location = "<?=base_url().'sicerdas/renja/subkegiatan?token='.$back_token;?>";
            }
            else{
              swal("Opps",data.message,"error");
            }
          },
          error: function(xhr, status, error) {
            console.log(xhr);
          }
        });
      }
    });   
   }
   var rowData = [];
   
   function loadPagination(page_num) {
    page = page_num;

    $.ajax({
      url: "<?=base_url()?>sicerdas/renja/subkegiatan_indikator/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
        id_sub_kegiatan_renja : '<?= $detail->id_sub_kegiatan_renja;?>',
      },
      success: function (data) {
        rowData = data.result;
        $("#row-data").html(data.content);
        $("#pagination").html(data.pagination);
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
   }

   var action = "";
   var id_indikator_sub_kegiatan="";
   function addIndikator()
   {
     action = "add";
     id_indikator_sub_kegiatan = "";
     $(".input-text").val("");
     $(".input_select").val("").trigger("change");
     $(".cek").prop("checked",false);
     
     for(i=1;i<=dt_tahun.length;i++)
      {
        $("#cascading_"+i).val([]).trigger("change");
      }

      
     $(".error").html("");
   }

   function editIndikator(i)
   {
     action = "edit";
     $(".error").html("");
     $("#nama_indikator_sub_kegiatan").val(rowData[i].nama_indikator_sub_kegiatan);
     $("#target").val(rowData[i].target);
     $("#target_anggaran").val(rowData[i].target_anggaran);
     $("#satuan").val(rowData[i].satuan).trigger("change");
     $("#pagu_indikatif").val(rowData[i].pagu_indikatif);
     $("#pagu_prakiraan_maju").val(rowData[i].pagu_prakiraan_maju);
     $("#lokasi_kegiatan").val(rowData[i].lokasi_kegiatan);
     
     $("#metode").val(rowData[i].metode).trigger("change");
     $("#target_min").val(rowData[i].target_min);

  

     id_indikator_sub_kegiatan = rowData[i].id_indikator_sub_kegiatan;

     $(".cek").prop("checked",false);
     
     for(x=1;x<=12;x++)
     {
       var month_x = "month_"+x;
       
       if(rowData[i][month_x]=="Y")
       {
         $("#"+month_x).prop("checked",true);
       }
     }
     
     for(x=1;x<=dt_tahun.length;x++)
      {
        $("#cascading_"+x).val([]).trigger("change");
      }

      for(x in rowData[i].cascading)
      {
        //console.log(x);
        $("#cascading_"+x).val(rowData[i].cascading[x]).trigger("change");
      }
      console.log(rowData[i]);
     $('#modal-indikator').modal();
   }
   
   function saveIndikator()
   {
      reset_error();
      var formdata = new FormData(document.getElementById('formIndikator'));
      formdata.append("action",action);
      formdata.append("id_sub_kegiatan_renja","<?=$detail->id_sub_kegiatan_renja;?>");
      formdata.append("id_indikator_sub_kegiatan",id_indikator_sub_kegiatan);
      
      $.ajax({
         url        : "<?=base_url()?>sicerdas/renja/subkegiatan_indikator/save",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){
          //console.log(data);
            if(data.status){
               $('#modal-indikator').modal('toggle');
               swal(
               'Berhasil',
               data.message,
               'success'
               );
               loadPagination(page);
            }
            else{
               for(err in data.errors)
               {
                  $("#err_"+err).html(data.errors[err]);
               }
               if(data.errors.length==0){
                  swal(
                  'Opps',
                  data.message,
                  'warning');
               }
            }
         },
         error: function(xhr, status, error) {
            console.log(xhr);
         }
      });
   }

   function hapusIndikator(id) {
    swal({
      title: "Hapus indikator ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      closeOnConfirm: false
    },
    function(isConfirm) {
      if (isConfirm) {
        $.ajax({
          url        : "<?=base_url()?>sicerdas/renja/subkegiatan_indikator/delete",
          type       : 'post',
          dataType   : 'json',
          data       : {
            id      : id,
          },
          success    : function(data){
            if(data.status==true)
            {
              swal({
                type: 'success',
                title: 'Berhasil',
                text: data.message,
                showConfirmButton: false,
                timer: 1500
              });

              loadPagination(1);
            }
            else{
              swal("Opps",data.message,"error");
            }
          },
          error: function(xhr, status, error) {
            console.log(xhr);
          }
        });
      }
    });   
   }

   function setMetode()
   {
     var metode = $("#metode").val();
     $(".Metode").hide();
     $(".Metode-"+metode).show();
   }

   function get_unit_kerja()
    {
     
      $("#row-unit-kerja").html("");
      
        $.ajax({
           url: "<?=base_url()?>sicerdas/renja/subkegiatan/get_unit_kerja/",
           type: 'post',
           dataType: 'json',
           data: {
            id_kegiatan : "<?=$detail->id_kegiatan;?>",
              id_skpd : '<?=$dt_skpd->id_skpd;?>',
              id_sub_kegiatan_renja : "<?=$detail->id_sub_kegiatan_renja;?>"
           },
           success: function (data) {
              $("#row-unit-kerja").html(data.content);
           },
           error: function (xhr, status, error) {
              console.log(xhr.responseText);
              //swal("Opps", "Terjadi kesalahan", "error");
           }
        });
      

    }
</script>