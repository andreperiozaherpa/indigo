<div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Program</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Program</a></li>
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <!-- .row -->
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
            <div class="panel-heading"> Detail Program
              <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-6 b-r">
                    <div class="row">
                      <div class="col-md-12 b-b-">
                        <h3 class="box-title m-b-0">Visi</h3>
                        <p><?=$detail->visi;?></p>
                      </div>
                      <div class="col-md-12 b-b-">
                        <h3 class="box-title m-b-0">Misi</h3>
                        <p><?=$detail->misi;?></p>
                      </div>
                      
                    </div>
                    
                  </div>
                  <div class="col-md-6">

                    <div class="col-md-12 b-b">
                      <h3 class="box-title m-b-0">Program RPJMD</h3>
                      <p><?=$detail->kode_program." - ". $detail->nama_program;?></p>
                    </div>

                    <div class="col-md-12 b-b">
                      <h3 class="box-title m-b-0">Indikator Program RPJMD</h3>
                      <ul>
                      <?php
                        foreach($dt_indikator_rpjmd->result() as $row)
                        {
                          echo '<li>'.$row->nama_indikator_program_rpjmd.'</li>';
                        }
                      ?>
                      </ul>
                    </div>

                    <div class="col-md-12 b-b">
                      <h3 class="box-title m-b-0">Sasaran Renstra</h3>
                      <p><?=$detail->nama_sasaran_renstra;?></p>
                    </div>

                    <div class="col-md-12">
                      <h3 class="box-title m-b-0 ">Indikator Sasaran</h3>
                      <ul>
                      <?php
                        foreach($dt_indikator_sasaran->result() as $row)
                        {
                          echo '<li>'.$row->nama_indikator_sasaran_renstra.'</li>';
                        }
                      ?>
                      </ul>
                    </div>


                  </div>
                  <div class="col-md-12">
                    <button onclick="edit_program()" class="btn btn-primary">Edit</button>
                    <button onclick="hapus_program()" class="btn btn-danger">Hapus</button>
                  </div>

                </div>

              </div>
            </div>
          </div>





          <div class="white-box">
          
            <strong>Program :</strong> <?=$detail->kode_program.' - '. $detail->nama_program;?>
            
            <hr>

            <table class="table table-bordered table-striped table-hover table-responsive " id="row-data">
              
            </table>
          </div>

          <div class="col-md-12 text-right">
            <a class="btn btn-default" href="<?=base_url();?>sicerdas/renstra/program?token=<?= md5("SC".$dt_skpd->id_skpd) ;?>">Kembali</a>
            <button type="button" class="btn btn-primary  full-right" onclick="addIndikator();"><i class="fa fa-plus"></i> Tambah Indikator</button>
          </div>
          <div class="col-12 text-center">
                <nav class="mt-4 mb-3">
                    <ul class="pagination justify-content-center mb-0" id="pagination">
                    </ul>
                </nav>
              </div>
        </div>
        <!-- .row -->

      </div>

      <!-- Modal Tambah -->
      <div id="modal-indikator" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content  panel-primary">
            <div class="panel-heading">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">Tambah Indikator</h4>
            </div>
            <div class="modal-body">

              <form  id="formIndikator" class="form-horizontal">
                <div id="hidden"></div>

                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-sm-12">Indikator RPJMD</label>
                    <div class="col-sm-12">
                      <select id="id_indikator_program" name="id_indikator_program" class="form-control select2 input_select"  >
                      <option value="">Pilih</option>
                      <?php foreach($dt_indikator_rpjmd->result() as $row){
                        echo '<option value="'.$row->id_indikator_program_rpjmd.'">'.$row->nama_indikator_program_rpjmd.'</option>';
                      }
                      ?>
                      </select>
                      <div class="text-danger error" id="err_id_indikator_program"></div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-sm-12">Indikator Sasaran</label>
                    <div class="col-sm-12">
                      <select id="id_indikator_sasaran" name="id_indikator_sasaran" class="form-control select2 input_select"  >
                      <option value="">Pilih</option>
                      <?php foreach($dt_indikator_sasaran->result() as $row){
                        echo '<option value="'.$row->id_indikator_sasaran_renstra.'">'.$row->nama_indikator_sasaran_renstra.'</option>';
                      }
                      ?>
                      </select>
                      <div class="text-danger error" id="err_id_indikator_sasaran"></div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-sm-12">Satuan Pengukuran</label>
                    <div class="col-sm-12">
                      <select name="satuan" id="satuan" class="form-control select2 input_select">
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
                <div class="form-group">
                  <div class="col-md-12">
                    <label class="col-sm-12">Metode Perhitungan</label>
                    <div class="col-sm-12">
                      <select name="metode" id="metode" class="form-control select2 input_select">
                        <?php foreach($this->Globalvar->metode_perhitungan as $metode)
                        {
                          echo '<option value="'.$metode.'">'.$metode.'</option>';
                        }
                        ?>
                      </select>
                      <div class="text-danger error" id="err_metode"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">


                    <div class="col-md-6">
                      <table class="table table-bordered p-t-20">
                        <tr class="active">
                          <td colspan="2" style="text-align: center;"><b>Kondisi Awal</b></td>
                        </tr>
                        <tr>
                          <td style="text-align: center;"><b>Target</b></td>
                          <td style="text-align: center;"><b>Rupiah</b></td>
                        </tr>
                        <tr>
                          <td>
                            <input type="text" name="target_awal" id="target_awal" class="form-control" placeholder="Masukkan Kondisi target">
                            <div class="text-danger error" id="err_target_awal"></div>
                          </td>
                          <td>
                            <input type="number" name="target_awal_rp" id="target_awal_rp" class="form-control" placeholder="Masukkan Rupiah">
                            <div class="text-danger error" id="err_target_awal_rp"></div>
                          </td>
                        </tr>
                      </table>
                    </div>

                    <?php foreach($dt_tahun as $t => $tahun){?>
                      <div class="col-md-6">
                        <table class="table table-bordered p-t-20">
                          <tr class="active">
                            <td colspan="2" style="text-align: center;"><b>Tahun <?=$tahun;?></b></td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"><b>Target</b></td>
                            <td style="text-align: center;"><b>Rupiah</b></td>
                          </tr>
                          <tr>
                            <td>
                              <input type="text" name="target_tahun_<?=($t+1);?>" id="target_tahun_<?=($t+1);?>" class="form-control" placeholder="Masukkan Kondisi target">
                              <div class="text-danger error" id="err_target_tahun_<?=($t+1);?>"></div>
                            </td>
                            <td>
                              <input type="number" name="target_tahun_<?=($t+1);?>_rp" id="target_tahun_<?=($t+1);?>_rp" class="form-control" placeholder="Masukkan Rupiah">
                              <div class="text-danger error" id="err_target_tahun_<?=($t+1);?>_rp"></div>
                            </td>
                          </tr>
                        </table>
                      </div>
                    <?php }?>

                    <div class="col-md-6">
                      <table class="table table-bordered p-t-20">
                        <tr class="active">
                          <td colspan="2" style="text-align: center;"><b>Kondisi Akhir</b></td>
                        </tr>
                        <tr>
                          <td style="text-align: center;"><b>Target</b></td>
                          <td style="text-align: center;"><b>Rupiah</b></td>
                        </tr>
                        <tr>
                          <td>
                            <input type="text" name="target_akhir" id="target_akhir" class="form-control" placeholder="Masukkan Kondisi target">
                            <div class="text-danger error" id="err_target_akhir"></div>
                          </td>
                          <td>
                            <input type="number" name="target_akhir_rp" id="target_akhir_rp" class="form-control" placeholder="Masukkan Rupiah">
                            <div class="text-danger error" id="err_target_akhir_rp"></div>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>

                  <div class="form-group" style="display:none;">
                    <div class="col-md-12">
                      <label class="col-sm-12">Lokasi</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="lokasi" id="lokasi">
                        <div class="text-danger error" id="err_lokasi"></div>
                      </div>
                    </div>
                  </div>

                  <?php foreach($this->Globalvar->get_tahun() as $key => $value) :?>
                 <!--  <div class="form-group">
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
                    
                  </div> -->
                  <?php endforeach;?>
                  <!-- <div class="col-md-12">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="faktor_pendorong" class="control-label">Faktor Pendorong Keberhasilan
                          Pencapaian</label>
                        <textarea name="faktor_pendorong" id="faktor_pendorong" class="form-control"></textarea>
                        <div class="text-danger error" id="err_faktor_pendorong"></div>
                      </div>
                      <div class="form-group">
                        <label for="faktor_penghambat" class="control-label">Faktor Penghambat Pencapaian
                          Kinerja</label>
                        <textarea name="faktor_penghambat" id="faktor_penghambat" class="form-control"></textarea>
                        <div class="text-danger error" id="err_faktor_penghambat"></div>
                      </div>
                      <div class="form-group">
                        <label for="tindak_lanjut_rkpd" class="control-label">Tindak lanjut yang diperlukan dalam RKPD
                          kabupaten/kota berikutnya</label>
                        <textarea name="tindak_lanjut_rkpd" id="tindak_lanjut_rkpd" class="form-control"></textarea>
                        <div class="text-danger error" id="err_tindak_lanjut_rkpd"></div>
                      </div>
                      <div class="form-group">
                        <label for="tindak_lanjut_rpjmd" class="control-label">Tindak lanjut yang diperlukan dalam RPJMD
                          kabupaten/kota berikutnya</label>
                        <textarea name="tindak_lanjut_rpjmd" id="tindak_lanjut_rpjmd" class="form-control"></textarea>
                        <div class="text-danger error" id="err_tindak_lanjut_rpjmd"></div>
                      </div>
                    </div>
                  </div> -->
                
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



<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="data-title">Edit Program</h4>
        </div>
        <div class="modal-body">
          <form id="form-data" action="#!">



           <div class="form-group">
            <label for="id_program_rpjmd" class="control-label">Program Dari RPJMD:</label>
            <select id="id_program_rpjmd" name="id_program_rpjmd" class="form-control select2 input_select" onchange="get_indikator_rpjmd()" >
             <option value="">Pilih</option>
             <?php foreach($dt_program_rpjmd as $row){
               $selected = ($row->id_program_rpjmd == $detail->id_program_rpjmd) ? "selected" : "";
              echo '<option '.$selected.' value="'.$row->id_program_rpjmd.'">'.$row->kode_program.' - '.$row->nama_program.'</option>';
            }
            ?>
            </select>
            <div class="text-danger error" id="err_id_program_rpjmd"></div>
          </div>

          <div class="form-group">
            <label for="id_indikator_program_rpjmd" class="control-label">Indikator Program dari RPJMD:</label>
            <select id="id_indikator_program_rpjmd" name="id_indikator_program_rpjmd[]" multiple class="form-control_ select2 input_select">
              <option value="">Pilih</option>
            </select>
            <div class="text-danger error" id="err_id_indikator_program_rpjmd"></div>
          </div>

          <div class="form-group">
            <label for="id_sasaran_renstra" class="control-label">Sasaran dari Renstra:</label>
            <select id="id_sasaran_renstra" name="id_sasaran_renstra" class="form-control select2 input_select" onchange="get_indikator_sasaran()">
              <option value="">Pilih</option>
              <?php foreach($dt_sasaran as $row){
                $selected = ($row->id_sasaran_renstra == $detail->id_sasaran_renstra) ? "selected" : "";
              echo '<option '.$selected.' value="'.$row->id_sasaran_renstra.'">'.$row->nama_sasaran_renstra.'</option>';
            }
            ?>
            </select>
            <div class="text-danger error" id="err_id_sasaran_renstra"></div>
          </div>
          

          <div class="form-group">
            <label for="id_indikator_sasaran_renstra" class="control-label">Indikator Sasaran:</label>
            <select id="id_indikator_sasaran_renstra" name="id_indikator_sasaran_renstra[]" multiple class="form-control_ select2 input_select" >
              <option value="">Pilih</option>
            </select>
            <div class="text-danger error" id="err_id_indikator_sasaran_renstra"></div>
          </div>

          <div class="row" id="row-unit-kerja">
                  
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="data-button" class="btn btn-primary" onclick="save()">Simpan</button>
      </div>
    </div>
    <!-- /#data-content -->
  </div>
  <!-- /#data-dialog -->
</div>


<script type="text/javascript">
  var action = '';
  var id_program_renstra = '<?=$detail->id_program_renstra;?>';;
  var id_indikator = 0;
  var rowData = {};
  var dt_tahun = JSON.parse('<?= json_encode($this->Globalvar->get_tahun()) ;?>');
   function reset_error()
   {
      $(".error").html("");
   }

   function addIndikator()
   {
    $(".modal-title").html("Tambah Indikator");
    $('#formIndikator')[0].reset();
    $("#satuan").val("").trigger("change");
    $("#id_indikator_program").val("").trigger("change");
    $("#id_indikator_sasaran").val("").trigger("change");
    action = "add";
    id_indikator = 0;
    id_program_renstra = '<?=$detail->id_program_renstra;?>';
    reset_error();
    
    /* for(i=1;i<=dt_tahun.length;i++)
    {
      $("#cascading_"+i).val([]).trigger("change");
    }
 */
    $("#modal-indikator").modal();
   }

   function editIndikator(i)
   {
    $(".modal-title").html("Edit Indikator");
    $('#formIndikator')[0].reset();
    action = "edit";
    id_indikator = rowData[i].id_indikator_program_renstra;
    id_sasaran = '<?=$detail->id_sasaran_renstra;?>';
    reset_error();

    $("#id_indikator_program").val(rowData[i].id_indikator_program_rpjmd).trigger("change");
    $("#id_indikator_sasaran").val(rowData[i].id_indikator_sasaran_renstra).trigger("change");
    $("#satuan").val(rowData[i].satuan).trigger("change");
    $("#target_awal").val(rowData[i].target_awal);
    $("#target_akhir").val(rowData[i].target_akhir);
    $("#target_tahun_1").val(rowData[i].target_tahun_1);
    $("#target_tahun_2").val(rowData[i].target_tahun_2);
    $("#target_tahun_3").val(rowData[i].target_tahun_3);
    $("#target_tahun_4").val(rowData[i].target_tahun_4);
    $("#target_tahun_5").val(rowData[i].target_tahun_5);

    $("#target_awal_rp").val(rowData[i].target_awal_rp);
    $("#target_akhir_rp").val(rowData[i].target_akhir_rp);
    $("#target_tahun_1_rp").val(rowData[i].target_tahun_1_rp);
    $("#target_tahun_2_rp").val(rowData[i].target_tahun_2_rp);
    $("#target_tahun_3_rp").val(rowData[i].target_tahun_3_rp);
    $("#target_tahun_4_rp").val(rowData[i].target_tahun_4_rp);
    $("#target_tahun_5_rp").val(rowData[i].target_tahun_5_rp);

    $("#lokasi").val(rowData[i].lokasi);

    $("#metode").val(rowData[i].metode).trigger("change");

    /* $("#faktor_pendorong").val(rowData[i].faktor_pendorong);
    $("#faktor_penghambat").val(rowData[i].faktor_penghambat);
    $("#tindak_lanjut_rkpd").val(rowData[i].tindak_lanjut_rkpd);
    $("#tindak_lanjut_rpjmd").val(rowData[i].tindak_lanjut_rpjmd); */

    /* $(".checkbox").prop("checked",false);

    for(x in rowData[i].ids_unit_kerja)
    {
      id = rowData[i].ids_unit_kerja[x];
      $("#checkbox_"+id).prop("checked",true);
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
     */
    
    $("#modal-indikator").modal();
    //console.log(rowData[i]);
   }

   function reset_error()
   {
    $(".error").html("");
   }


   function loadPagination(page_num) {
    page = page_num;

    $.ajax({
      url: "<?=base_url()?>sicerdas/renstra/program_indikator/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
        id_program_renstra : id_program_renstra,
      },
      success: function (data) {
        $("#row-data").html(data.content);
        $("#pagination").html(data.pagination);
        rowData = data.result;
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
   }


   function saveIndikator()
   {
      reset_error();
      var formdata = new FormData(document.getElementById('formIndikator'));
      formdata.append("action",action);
      formdata.append("id_program_renstra",id_program_renstra);
      formdata.append("id_indikator",id_indikator);
      
      $.ajax({
         url        : "<?=base_url()?>sicerdas/renstra/program_indikator/save",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){
          console.log(data);
            if(data.status){
               $('#modal-indikator').modal('toggle');
               swal(
               'Berhasil',
               data.message,
               'success'
               );
               loadPagination(1);
            }
            else{
               for(err in data.errors)
               {
                let er = err.replaceAll('[','');
                 er = er.replaceAll(']','');
                  $("#err_"+er).html(data.errors[err]);
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
      title: "Hapus Indikator ?",
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
          url        : "<?=base_url()?>sicerdas/renstra/program_indikator/delete",
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


    function check(id)
    {
      var is_checked = $("#checkbox_"+id).prop("checked");
      $(".unit-"+id).prop("checked",is_checked);
    }

    function edit_program()
    {
      reset_error();
      $("#data-modal").modal();
    }


    setTimeout(() => {
      let id_indikator_program_rpjmd = [];
      <?php 
        foreach($dt_indikator_rpjmd->result() as $row)
        {
          echo 'id_indikator_program_rpjmd.push('.$row->id_indikator_program_rpjmd.');';
        }
      ?>
      get_indikator_rpjmd(id_indikator_program_rpjmd);
    }, 500);

    function get_indikator_rpjmd(id_indikator_program_rpjmd=[])
   {
     //console.log(id_indikator_program_rpjmd);
      $("#id_indikator_program_rpjmd").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/program_indikator/get_indikator_by_program/",
         type: 'post',
         dataType: 'json',
         data: {
            id_program_rpjmd : $("#id_program_rpjmd").val(),
            id_skpd : '<?=$dt_skpd->id_skpd;?>',
            id_indikator_program_rpjmd : id_indikator_program_rpjmd
         },
         success: function (data) {
           //console.log(data.content);
            $("#id_indikator_program_rpjmd").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    setTimeout(() => {
      let id_indikator_sasaran_renstra = [];
      <?php 
        foreach($dt_indikator_sasaran->result() as $row)
        {
          echo 'id_indikator_sasaran_renstra.push('.$row->id_indikator_sasaran_renstra.');';
        }
      ?>
      get_indikator_sasaran(id_indikator_sasaran_renstra);
    }, 500);

    function get_indikator_sasaran(id_indikator_sasaran_renstra=[])
    {
      console.log(id_indikator_sasaran_renstra);
      $("#id_indikator_sasaran_renstra").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renstra/sasaran_indikator/get_indikator_by_sasaran/",
         type: 'post',
         dataType: 'json',
         data: {
            id_sasaran_renstra : $("#id_sasaran_renstra").val(),
            id_indikator_sasaran_renstra : id_indikator_sasaran_renstra,
         },
         success: function (data) {
           //console.log(data);
            $("#id_indikator_sasaran_renstra").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });

      get_unit_kerja();
    }

    function save()
   {
      reset_error();
      var formdata = new FormData(document.getElementById('form-data'));
      formdata.append("action","edit");
      formdata.append("id_program_renstra","<?=$detail->id_program_renstra;?>");
      
      $.ajax({
         url        : "<?=base_url()?>sicerdas/renstra/program/save",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){

            if(data.status){
               $('#data-modal').modal('toggle');
               swal(
               'Berhasil',
               data.message,
               'success'
               );
               setTimeout(function(){
                location.reload();
               },500)
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


   function hapus_program() {
   	swal({
   		title: "Hapus program ?",
			//text: "Apakah anda yakin akan menghapus data ini?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Ya',
			cancelButtonText: "Tidak",
			closeOnConfirm: false
		},
		function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					url: "<?=base_url()?>sicerdas/renstra/program/delete",
					type: 'post',
					dataType: 'json',
					data: {
						id: '<?=$detail->id_program_renstra;?>',
					},
					success: function (data) {
						//console.log(data);
						if (data.status == true) {
							swal({
								type: 'success',
								title: 'Berhasil',
								text: data.message,
								showConfirmButton: false,
								timer: 1500
							});

							window.location = '<?=base_url();?>sicerdas/renstra/program?token=<?= md5("SC".$dt_skpd->id_skpd) ;?>';
						} else {
							swal("Opps", data.message, "error");
						}
					},
					error: function (xhr, status, error) {
						//swal("Opps","Error","error");
						console.log(xhr);
					}
				});
			}
		});
   }

   function check(id)
    {
      var is_checked = $("#checkbox_"+id).prop("checked");
      $(".unit-"+id).prop("checked",is_checked);
    }
    
    function get_unit_kerja()
    {
      /* var id_sasaran_renstra = $("#id_sasaran_renstra").val();
      $("#row-unit-kerja").html("");
      if(id_sasaran_renstra != "")
      {
        
        $.ajax({
           url: "<?=base_url()?>sicerdas/renstra/program/get_unit_kerja/",
           type: 'post',
           dataType: 'json',
           data: {
              id_sasaran_renstra : $("#id_sasaran_renstra").val(),
              id_skpd : '<?=$dt_skpd->id_skpd;?>',
              id_program_renstra : '<?=$detail->id_program_renstra;?>'
           },
           success: function (data) {
              $("#row-unit-kerja").html(data.content);
           },
           error: function (xhr, status, error) {
              console.log(xhr.responseText);
              swal("Opps", "Terjadi kesalahan", "error");
           }
        });
      } */

    }
</script>