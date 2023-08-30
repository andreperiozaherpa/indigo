<?php 
 
 $id_skpd = null;
 $status = null;
 
 if(isset($_GET['id_skpd'])){
   $id_skpd = $_GET['id_skpd'];
 }

 if(isset($_GET['status'])){
   $status = $_GET['status'];
 }

?>
<div class="container-fluid">

<div class="row bg-title">
  <!-- .page title -->
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Verifikasi ANJAB ABK</h4>
  </div>
  <!-- /.page title -->
  <!-- .breadcrumb -->
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

    <ol class="breadcrumb">
      <li><a href="<?= base_url(); ?>admin">Dashboard</a></li>
      <li class="active">Verifikasi ANJAB ABK</li>
    </ol>
  </div>
  <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  <div class="col-md-12">
    <?php if($this->session->userdata('level') == 'Administrator' or in_array('admin_simanja', $user_privileges)) :?>
  <div class="row">
        <div class="col-md-4 col-xs-12 col-sm-6">
            <div class="white-box text-center bg-purple">
                <h1 class="text-white counter"><?=$count_list?></h1>
                <p class="text-white">Laporan</p>
            </div>
        </div>
        <div class="col-md-4 col-xs-12 col-sm-6">
          <a href="<?=base_url('simanja/verifikasi?status=2,3')?>">
            <div class="white-box text-center" style="background-color: #009457">
                <h1 class="text-white counter"><?=$count_terverifikasi?></h1>
                <p class="text-white">Terverifikasi</p>
            </div>
          </a>
        </div>
        <div class="col-md-4 col-xs-12 col-sm-6">
          <a href="<?=base_url('simanja/verifikasi?status=1,4,5')?>">
            <div class="white-box text-center" style="background-color: #1E88E5">
                <h1 class="text-white counter"><?=$count_belum_terverifikasi?></h1>
                <p class="text-white">Belum / Tidak Terverifikasi</p>
            </div>
          </a>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
            <?php if($this->session->flashdata('status')){ ?>
              <div class="alert alert-success">
                <?=$this->session->flashdata('status')?>
              </div>
            <?php } ?>
              <?php if($this->session->userdata('level') == 'Administrator' or in_array('admin_simanja', $user_privileges)){ ?>
                <div class="row">
                  <div class="col-md-12">
                    <form method="GET">
                      <div class="form-group">
                        <label for="">SKPD</label>
                        <select class="form-control select2" name="id_skpd" onchange="this.form.submit()">
                          <option value=""> Semua SKPD </option>
                          <?php foreach($skpd as $i) { ?>
                            <option value="<?=$i->id_skpd?>" <?=($id_skpd == $i->id_skpd) ? 'selected' : null?>> <?=$i->nama_skpd?> </option>
                            <?php } ?>
                          </select>
                          <input type="hidden" name="status" value="<?=$status?>">
                        </div>
                    </form>
                  </div>
                </div>
              <?php } ?>
              <table class="table color-table dark-table table-hover" id="myTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Jabatan</th>
                    <th>SKPD</th>
                    <th>Pemangku</th>
                    <th>Atasan</th>
                    <th>Status</th>
                    <th>Waktu Pengiriman</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   $no = 1;
                   foreach ($list as $i) {
                   ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $i->namaJabatan ?></td>
                      <td><?= $i->namaSkpd ?></td>
                      <td><?= $i->namaPemangku ?></td>
                      <td><?= $i->namaVerifikator ?></td>
                      <td>
                        <span class="badge" style="background-color: <?=($i->status == 1) ? '#FFC630' : (($i->status == 2 || $i->status == 3) ? '#009457' : '#FF0000') ?> !important"><?=($i->status == 1) ? 'Belum Terverifikasi' : (($i->status == 2) ? '<i class="fa fa-spinner"></i> Menunggu verifikasi Admin Kabupaten' : (($i->status == 3) ? 'Terverifikasi' : (($i->status == 4) ? 'Ditolak Atasan' : 'Ditolak SETDA'))) ?></span>
                        <br>
                      </td>
                      <td><?= date('d, M Y H:i:s', strtotime($i->created_at))?></td>

                      <td style="width:150px">

                        <?php if($i->status == 4) { ?>
                          <a href="javascript:void(0)" onclick="penolakanRef('<?=$i->tolak?>')" class="btn btn-danger btn-sm">Alasan</a>
                        <?php }else if($i->status == 5){ ?>
                          <a href="javascript:void(0)" onclick="penolakanRef('<?=$i->tolak_kabupaten?>')" class="btn btn-danger btn-sm">Alasan</a>
                        <?php } ?>
                        <?php if(!$i->path) { ?>
                          <?php if($i->status == 1) : ?>
                            <?php if($this->session->userdata('id_pegawai') == $i->id_verifikator) : ?>
                                <a href="javascript:void(0)" onclick="editRef(<?= $i->id ?>, <?=$i->status?>)" class="btn btn-info btn-sm">Verifikasi</a>
                            <?php endif; ?>
                          <?php endif; ?>
                          <?php }else{ ?>
                            <?php if($i->status == 2) : ?>
                              <?php if($this->session->userdata('level') == 'Administrator' or in_array('admin_simanja', $user_privileges)) : ?>
                                <a href="javascript:void(0)" onclick="editRef(<?= $i->id ?>, <?=$i->status?>)" class="btn btn-info btn-sm">Verifikasi</a>
                              <?php endif; ?>
                              <a href="<?=base_url('data/simanja/arsip/'.$i->path.'.pdf')?>" target="_blank" class="btn btn-success btn-sm">CETAK</a>
                            <?php endif; ?>
                        <?php } ?>
                      <?php if($i->status == 3) : ?>
                        <?php if($i->path_kabupaten) { ?>
                            <a href="<?=base_url('simanja/analisis_jabatan/export_bkn_ver1f/'.$i->id_analisis_jabatan)?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> CETAK ANJAB </a><br>
                            <a href="<?=base_url('simanja/analisis_beban_kerja/export_pdf_ver1f/'.$i->id_analisis_jabatan)?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> CETAK ABK</a>
                            <!-- <a href="<?=base_url('data/simanja/arsip/'.$i->path_kabupaten.'.pdf')?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> CETAK ANJAB </a><br>
                            <a href="<?=base_url('data/simanja/arsip/abk/'.$i->path_kabupaten.'.pdf')?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i> CETAK ABK</a> -->
                        <?php } ?>
                      <?php endif; ?>
                      </td>
                    </tr>
                  <?php $no++;
                   } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .row -->

</div>
</div>

<div id="modalReferensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel1">Detail</h4>
      </div>
      <div class="modal-body">
        <form id="formRef">
          <div id="hiddenRef"></div>
          <div id="messageRef"></div>
          <input type="hidden" name="id_ref" value="">
          <input type="hidden" name="id_analisis_jabatan" value="">
          <input type="hidden" name="verificated_at" value="<?=date('Y-m-d H:is')?>">
          <div>
            <object
              id="object"
              data='https://e-office.sumedangkab.go.id/simanja/analisis_jabatan/export_bkn/4670'
              type="application/pdf"
              width="100%"
              height="678"
            >

              <iframe
                id="iframe"
                src='https://e-office.sumedangkab.go.id/simanja/analisis_jabatan/export_bkn/4670'
                width="100%"
                height="678"
              >
              <p>This browser does not support PDF!</p>
              </iframe>
            </object>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <div id="action_modal" style="all: unset">
          <button type="button" onclick="simpanRef()" id="btnSaveRef" class="btn btn-primary">Verifikasi</button>
          <button type="button" onclick="tolakRef()" id="btnSaveRef" class="btn btn-danger">Tolak</button>
        </div>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div id="modalTolak" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alasan Penolakan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="alasan_penolakan"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var save_method;
  

  function editRef(id, status) {
    save_method = 'update';
    $('#formRef')[0].reset();
    $('#messageRef').html('');
    $('.form-group').removeClass('has-error');
    $('#hiddenRef').html('<input type="hidden" value="" name="id_ref"/>');
    $('.help-block').empty();
    if(status == 4){
      $('#action_modal').hide();
    }else{
      $('#action_modal').show();
    }
    $.ajax({
      url: "<?= base_url() . 'simanja/verifikasi/fetch_ref/' ?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {

        const anjab = data.id_analisis_jabatan
        $('[name="id_ref"]').val(data.id);
        $('[name="id_analisis_jabatan"]').val(anjab);
        $('#object').attr('data', 'https://e-office.sumedangkab.go.id/simanja/analisis_jabatan/export_bkn/'+anjab)
        $('#iframe').attr('data', 'https://e-office.sumedangkab.go.id/simanja/analisis_jabatan/export_bkn/'+anjab)

        $('#modalReferensi').modal('show');
        $('.modal-title').text('Detail ANJAB ABK');

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert("Gagal mendapatkan data");
      }
    });

  }

  function simpanRef() {
    var id_ref = $('[name="id_ref"]').val();

    if(!id_ref){
      alert('Id harus diisi')
    }

    if(id_ref !== ''){
      $('#btnSaveRef').text('Menyimpan...');
      $('#messageRef').html('');
      $('#btnSaveRef').attr('disabled', true);
      var url;
      var formData = new FormData($('#formRef')[0]);
      if (save_method == 'add') {
        url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_ref' ?>";
      } else {
        url = "<?= base_url() . 'simanja/verifikasi/p_update_ref' ?>";
      }
  
      $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data) {
  
          if (data.status) {
            $('#modalReferensi').modal('hide');
            swal("Berhasil", "Data Berhasil Disimpan!", "success");
            location.reload();
          } else {
            $('#messageRef').html('<div class="alert alert-danger">' + data.message + '</div>');
          }
          $('#btnSaveRef').text('Verifikasi');
          $('#btnSaveRef').attr('disabled', false);
  
  
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding / update data');
          $('#btnSaveRef').text('Verifikasi');
          $('#btnSaveRef').attr('disabled', false);
  
        }
      });
    }
  }

  function tolakRef() {
    var id_ref = $('[name="id_ref"]').val();
    swal({
        title: "Tolak ANJAB ?",
        text: "Masukan alasan penolakan:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        inputPlaceholder: "Tulis sesuatu"
      },
      function(inputValue) {
        if (inputValue) {
          let tolak = inputValue;
          $.ajax({
            url: "<?= base_url() . 'simanja/verifikasi/p_tolak_ref/' ?>" + id_ref,
            type: "POST",
            dataType: "JSON",
            data: {tolak: tolak},
            success: function(data) {
              $('#modalReferensi').modal('hide');
              swal("Berhasil", "ANJAB ABK berhasil ditolak!", "success");
              location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Gagal menolak data');
            }
          });
        }else{
          swal.showInputError("Alasan penolakan harus diisi!");
          return false
        }
      });

  }

  function deleteRef(id) {
    swal({
        title: "Hapus Data",
        text: "Apakah anda yakin akan menghapus data ini?",
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
            url: "<?= base_url() . 'simanja/analisis_jabatan/delete_ref/' ?>" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
              $('#modalReferensi').modal('hide');
              swal("Berhasil", "Data Berhasil Dihapus!", "success");
              location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Error deleting data');
            }
          });
        }
      });

  }

  function penolakanRef(alasan){
    $('#alasan_penolakan').html(alasan);
    $('#modalTolak').modal('show');
  }
  
  function showImportExcel()
  {
    document.getElementById('import_excel').click();
  }

  // $.fn.modal.Constructor.prototype.enforceFocus = function () {};
  
</script>