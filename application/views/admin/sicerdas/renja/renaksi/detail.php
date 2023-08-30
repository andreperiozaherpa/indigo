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
      <h4 class="page-title">Ren. Strategis</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li class="active">Ren. Strategis</li>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <a href="<?=base_url();?>sicerdas/renja/subkegiatan/detail/<?=$back_token;?>" style="margin-bottom: 10px;" class="btn btn-primary btn-outline pull-right"><i
          class="ti-back-left"></i> Kembali</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel panel-heading">
          Detail Sub Kegiatan
        </div>
        <div class="panel panel-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-12">Sub Kegiatan</label>
              <div class="col-md-9">
                <p class="form-control-static"><?=$detail->kode_sub_kegiatan . ' - ' . $detail->nama_sub_kegiatan;?></p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Indikator Sub Kegiatan</label>
              <div class="col-md-9">
                <p class="form-control-static"> <?=$detail->nama_indikator_sub_kegiatan;?> </p>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6" style="padding:0px">
                <label class="col-sm-12">Target</label>
                <div class="col-md-9">
                  <p class="form-control-static"><?=$detail->target;?></p>
                </div>
              </div>
              <div class="col-md-6">
                <label class="col-sm-12">Satuan</label>
                <div class="col-md-9">
                  <p class="form-control-static"> <?=$detail->satuan_desc;?> </p>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6" style="padding:0px">
                <label class="col-sm-12">Pagu Indikatif</label>
                <div class="col-md-9">
                  <p class="form-control-static"><?=number_format($detail->pagu_indikatif);?></p>
                </div>
              </div>
              <div class="col-md-6">
                <label class="col-sm-12">Pagu Prakiraan Maju</label>
                <div class="col-md-9">
                  <p class="form-control-static"> <?=number_format($detail->pagu_prakiraan_maju);?> </p>
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
          <a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right "
            style="position:relative;bottom:6px;color: #6003C8 !important" onclick="tambahRenaksi()"><i
              class="ti-plus"></i> Tambah Renaksi</a>
        </div>
        <div class="panel panel-body " id="row-renaksi">
          
          
        </div>
      </div>
    </div>
  </div>


  <!--Modal Tambah Renaksi-->
  <div id="modal-renaksi" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Rencana Aksi</h4>
          </div>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="form-renaksi">
            <input type="hidden" name="id_renaksi" value="">
            <div class="form-group">
              <label class="col-sm-12">Nama Rencana Aksi</label>
              <div class="col-md-12">
                <input type="text" class="form-control" name="nama_renaksi" id="nama_renaksi" placeholder="Masukkan Nama Rencana Aksi">
                <div class="text-danger error" id="err_nama_renaksi"></div>
              </div>
            </div>
            <label>Jadwal Pelaksanaan</label>
            <div class="table-responsive">
              <table class="table color-table muted-table table-bordered">
                <thead>
                  <tr>
                    <th style="text-align: center" width="30%">Bulan</th>
                    <th style="text-align: center">Status Jadwal</th>
                    <th style="text-align: center" colspan="1">
                      Target
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    for($i=1;$i<=12;$i++){
                      $month_x = "month_".$i;
                      if($detail->$month_x == "Y"){
                      ?>
                  <tr>
                    <td style="text-align: center"><?=bulan($i)?></td>
                    <td style="text-align: center"><input type="checkbox" value="Y" class="js-switch3"
                        data-color="#f96262" data-secondary-color="#6164c1" id="status_<?=$i;?>" name="status[<?=$i?>]"></td>
                    <td style="text-align: center">
                      <input type="number" class="form-control input_target target_renaksi" 
                        id="target_renaksi_<?=$i;?>" name="target_renaksi[<?=$i?>]" placeholder="Target Renaksi">
                    </td>
                   <!--  <td style="text-align: center">
                      <input type="number" class="form-control input_target target_anggaran" 
                        id="target_anggaran_<?=$i;?>" name="target_anggaran[<?=$i?>]" placeholder="Target Anggaran">
                    </td> -->
                  </tr>
                  <?php 
                  }
                } ?>
                </tbody>
              </table>
            </div>

        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-outline waves-effect text-left" data-dismiss="modal"><i
              class="ti-close"></i> Tutup</button>
          <button onclick="saveRenaksi()" type="submit" name="tambah_renaksi" id="btnRenaksi" class="btn btn-primary waves-effect text-left"><i
              class="ti-save"></i> Simpan</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--Modal Edit Renaksi-->
  <!--Modal Edit Detail Renaksi Capaian Bulan-->
  <div id="updateRenaksiDetail" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;"></h4>
          </div>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="form-capaian" enctype='multipart/form-data'>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="col-sm-12">Target</label>
                  <div class="col-md-12">
                    <input type="number" class="form-control" name="target_renaksi"
                      disabled id="target_renaksi">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="col-sm-12">Realisasi</label>
                  <div class="col-md-12">
                    <input type="number" class="form-control" name="realisasi" id="realisasi"
                      placeholder="Masukkan Realisasi">
                      <div class="text-danger error" id="err_realisasi"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="col-sm-12">Capaian (Optional)</label>
                  <div class="col-md-12">
                    <input type="number" id="capaian" placeholder="Capaian manual" class="form-control" name="capaian"  value="">
                    <div class="text-danger error" id="err_capaian"></div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="col-sm-12">Target Anggaran</label>
                  <div class="col-md-12">
                    <input type="number" class="form-control" name="target_anggaran"
                      disabled id="target_anggaran">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="col-sm-12">Realisasi Anggaran</label>
                  <div class="col-md-12">
                    <input type="number" class="form-control" name="realisasi_anggaran" id="realisasi_anggaran"
                      placeholder="Masukkan Realisasi Anggaran">
                      <div class="text-danger error" id="err_realisasi_anggaran"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="col-sm-12">Capaian Anggaran (Optional)</label>
                  <div class="col-md-12">
                    <input type="number" id="capaian_anggaran" placeholder="Capaian manual" class="form-control" name="capaian_anggaran" value="">
                    <div class="text-danger error" id="err_capaian_anggaran"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-12">Dokumen Pendukung</label>
              <div class="col-md-12">
                <input type="file" id="dokumen" data-default-file="" name="dokumen" class="dropify" />
                <div class="text-danger error" id="err_dokumen"></div>
                <small><b>File yang diizinkan</b> : <?= implode(", " ,$file_type_allowed) ;?></small> 
                <small> | <b>Max </b> : <?= ($file_max_size/1000) ;?> Mb</small>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12">Link</label>
              <div class="col-md-12">
                <input type="text" name="link" id="link" class="form-control"
                  placeholder="Masukkan Link Dokumen Pendukung">
                  <div class="text-danger error" id="err_link"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary waves-effect text-left" onclick="updateCapaian()">Simpan</button>
        </div>
      </div>
      
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


<script type="text/javascript">
  var action = "";
  var id_renaksi = 0;
  var id_skpd = "<?=$detail->id_skpd;?>";
  var id_indikator_sub_kegiatan = "<?=$detail->id_indikator_sub_kegiatan;?>";

  var dt_renaksi = [];


  function reset_error() {
    $(".error").html("");
  }
  function saveRenaksi() {
    reset_error();
    var formdata = new FormData(document.getElementById('form-renaksi'));
    formdata.append("action", action);
    formdata.append("id_renaksi", id_renaksi);
    formdata.append("id_skpd", id_skpd);
    formdata.append("id_indikator_sub_kegiatan", id_indikator_sub_kegiatan);

    $.ajax({
      url: "<?= base_url() ?>sicerdas/renja/renaksi/save",
      type: 'post',
      dataType: 'json',
      data: formdata,
      processData: false,
      contentType: false,
      cache: false,
      async: false,
      success: function(data) {
        //console.log(data);
        if (data.status) {
          $('#modal-renaksi').modal('toggle');
          swal(
            'Berhasil',
            data.message,
            'success'
          );

          get_renaksi();
          
        } else {
          for (err in data.errors) {
            $("#err_" + err).html(data.errors[err]);
          }
          if (data.errors.length == 0) {
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

      function tambahRenaksi(){
        id_renaksi = 0;
        action = "add";
        $('#modal-renaksi .modal-title').html('Tambah Rencana Aksi');
        $('#modal-renaksi #btnRenaksi').attr('name','tambah_renaksi');
        $(".input_target").val('');
        $('#modal-renaksi input[type=checkbox]').each(function(){
          var checked = $(this).prop("checked");
          if(!checked){
            $(this).next().trigger('click');
          }
        })

        $(".target_anggaran").val('<?=$detail->target_anggaran;?>');
        $(".target_renaksi").val('<?=$detail->target;?>');

        $('#modal-renaksi').modal('show'); 
      }

      function editRenaksi(id){
        id_renaksi = id;
        action = "edit";
        $('#modal-renaksi .modal-title').html('Ubah Rencana Aksi');
        $(".input_target").val('');
        $('#modal-renaksi input[type=checkbox]').each(function(){
          var checked = $(this).prop("checked");
          if(checked){
            $(this).next().trigger('click');
          }
        })

        $("#nama_renaksi").val(dt_renaksi[id].nama_renaksi);
        
        var detail = dt_renaksi[id].detail;
        for(i in detail)
        {
          var month = detail[i].month;
          if(detail[i].status=="Y")
          {
            $("#status_"+month).next().trigger('click');
          }
          $("#target_renaksi_"+month).val(detail[i].target_renaksi);
          $("#target_anggaran_"+month).val(detail[i].target_anggaran);
        } 
        $('#modal-renaksi').modal('show'); 
      }

  function hapusRenaksi(id) {
    swal({
      title: "Hapus renaksi ?",
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
          url        : "<?=base_url()?>sicerdas/renja/renaksi/delete",
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

              get_renaksi();
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

   var id_renaksi_detail = 0;
   function showUpdate(id_renaksi,key,bln)
   {
      var detail = dt_renaksi[id_renaksi].detail[key];
      id_renaksi_detail = detail.id_renaksi_detail;
      $("#target_renaksi").val(detail.target_renaksi);
      $("#realisasi").val(detail.realisasi);
      $("#capaian").val("");
      $("#target_anggaran").val(detail.target_anggaran);
      $("#realisasi_anggaran").val(detail.realisasi_anggaran);
      $("#link").val(detail.link);
      //console.log(id_renaksi_detail);
      $(".modal-title").html("Edit Capaian Bulan " + bln);
      $("#updateRenaksiDetail").modal();
   }


   function updateCapaian() {
    reset_error();
    var formdata = new FormData(document.getElementById('form-capaian'));
    formdata.append("id_renaksi_detail", id_renaksi_detail);

    $.ajax({
      url: "<?= base_url() ?>sicerdas/renja/renaksi/update_capaian",
      type: 'post',
      dataType: 'json',
      data: formdata,
      processData: false,
      contentType: false,
      cache: false,
      async: false,
      success: function(data) {
        //console.log(data);
        if (data.status) {
          $('#updateRenaksiDetail').modal('toggle');
          swal(
            'Berhasil',
            data.message,
            'success'
          );

          get_renaksi();
          
        } else {
          for (err in data.errors) {
            $("#err_" + err).html(data.errors[err]);
          }
          if (data.errors.length == 0) {
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

    setTimeout(() => {
      get_renaksi();
    }, 500);
    function get_renaksi()
    {
      
      $.ajax({
          url        : "<?=base_url()?>sicerdas/renja/renaksi/get_renaksi",
          type       : 'post',
          dataType   : 'json',
          data       : {
            id_indikator_sub_kegiatan      : '<?=$detail->id_indikator_sub_kegiatan;?>',
          },
          success    : function(data){
            dt_renaksi = data.dt_renaksi;
            //console.log(data);
            $("#row-renaksi").html(data.content);
          },
          error: function(xhr, status, error) {
            console.log(xhr);
          }
        });
    }
      
    </script>