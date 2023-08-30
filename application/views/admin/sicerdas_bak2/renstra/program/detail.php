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
                      <p><?=$detail->nama_indikator_program_rpjmd;?></p>
                    </div>

                    <div class="col-md-12 b-b">
                      <h3 class="box-title m-b-0">Sasaran Renstra</h3>
                      <p><?=$detail->nama_sasaran_renstra;?></p>
                    </div>

                    <div class="col-md-12">
                      <h3 class="box-title m-b-0 ">Indikator Sasaran</h3>
                      <p><?=$detail->nama_indikator_sasaran_renstra;?></p>
                    </div>


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
                    <label class="col-md-12">Nama Indikator</label>
                    <div class="col-md-12">
                      <input type="text" name="nama_indikator_program_renstra" id="nama_indikator_program_renstra" class="form-control" placeholder="Masukkan Nama Indikator">
                      <div class="text-danger error" id="err_nama_indikator_program_renstra"></div>
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

                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="col-sm-12">Lokasi</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="lokasi" id="lokasi">
                        <div class="text-danger error" id="err_lokasi"></div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-12">
                      <label class="col-sm-12">Unit Penanggung Jawab</label>
                      <div class="col-lg-12">
                        <?php foreach($dt_unit_kerja as $key=>$value){
                          $margin_left = '0';
                          if($value->level_unit_kerja==2)
                          {
                            $margin_left = '20';
                          }
                          else if($value->level_unit_kerja==3)
                          {
                            $margin_left = '40';
                          }
                          else if($value->level_unit_kerja==4)
                          {
                            $margin_left = '60';
                          }
                          echo '
                            <div class="checkbox checkbox-primary" style="margin-left:'.$margin_left.'px">
                              <input onclick="check('.$value->id_unit_kerja.')" class="checkbox '.$value->class_unit.'" id="checkbox_'.$value->id_unit_kerja.'" type="checkbox" name="ids_unit_kerja[]" value="'.$value->id_unit_kerja.'">
                              <label for="checkbox_'.$value->id_unit_kerja.'"> '.$value->nama_unit_kerja.' </label>
                            </div>
                          ';
                          if($key < (count($dt_unit_kerja) -1 ))
                          {
                            $key_next = $key + 1;
                            $level_unit_kerja_next = $dt_unit_kerja[$key_next]->level_unit_kerja;
                            if($level_unit_kerja_next==1)
                            {
                              echo '<hr style="margin-top:10px; margin-bottom:10px">';
                            }
                          }
                        }
                        ?> 
                        
                        
                        
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



<script type="text/javascript">
  var action = '';
  var id_program_renstra = '<?=$detail->id_program_renstra;?>';;
  var id_indikator = 0;
  var rowData = {};

   function reset_error()
   {
      $(".error").html("");
   }

   function addIndikator()
   {
    $(".modal-title").html("Tambah Indikator");
    $('#formIndikator')[0].reset();
    $("#satuan").val("").trigger("change");
    action = "add";
    id_indikator = 0;
    id_program_renstra = '<?=$detail->id_program_renstra;?>';
    reset_error();
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

    $("#nama_indikator_program_renstra").val(rowData[i].nama_indikator_program_renstra);
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

    $(".checkbox").prop("checked",false);

    for(x in rowData[i].ids_unit_kerja)
    {
      id = rowData[i].ids_unit_kerja[x];
      $("#checkbox_"+id).prop("checked",true);
    }

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

</script>