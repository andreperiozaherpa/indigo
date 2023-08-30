<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Indikator Kinerja Individu</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <?php echo breadcrumb($this->uri->segment_array()); ?>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <?php
  $tipe = (empty($error)) ? "info" : "danger";
  if (!empty($message)) {
  ?>
    <div class="alert alert-<?= $tipe; ?> alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <?= $message; ?>
    </div>
  <?php } ?>
  <div class="row">
    <div class="white-box">
      <div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?= base_url('data/images/header/header2.jpg') ?>">
        <div class="overlay-box">
          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12">
                <div class="user-content" <a="" href="javascript:void(0)"><img src="<?= base_url('data/foto/pegawai/' . $detail->foto_pegawai . '') ?>" class="thumb-lg img-circle" style=" object-fit: cover;
                width: 80px;
                height: 80px;border-radius: 50%;
                " alt="img">
                  <h5 class="text-white"><b><?= $detail->nama_lengkap ?></b></h5>
                  <h6 class="text-white"><?= $detail->nip ?></h6>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3" style="border-right: 1px solid grey;border-left: 1px solid grey;">
            <br>
            <div class="user-content" style="padding-bottom:15px;">
              <h5 class="text-white"><b>SKPD</b></h5>
              <h6 class="text-white"><?= $detail->nama_skpd ?></h6>
            </div>
          </div>
          <div class="col-md-3" style="border-right: 1px solid grey;">
            <br>
            <div class="user-content" style="padding-bottom:15px;">
              <h5 class="text-white"><b>Unit Kerja</b></h5>
              <h6 class="text-white"><?= $detail->nama_unit_kerja ?></h6>
            </div>
          </div>
          <div class="col-md-3">
            <br>
            <div class="user-content" style="padding-bottom:15px;">
              <h5 class="text-white"><b>Jabatan</b></h5>
              <h6 class="text-white"><?= $detail->nama_jabatan ?></h6>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="white-box" style="border-top:solid 3px #6003c8;">
      <h4 class="box-title text-center">
        Tugas Pokok dan Fungsi Jabatan
      </h4>
      <hr class="m-t-0 m-b-0">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center">Tugas Pokok</th>
            <th class="text-center">Fungsi Jabatan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-justify b-r"><?= $detail->tugas_jabatan ?></td>
            <td class="text-justify"><?= $detail->fungsi_jabatan ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">

    <div class="white-box">
      <h3 class="box-title">DAFTAR SASARAN <button type="button" class="btn btn-primary pull-right" onclick="addRef()" style="margin-bottom: 20px">Tambah Sasaran</button></h3>
    </div>

    <?php if ($sasaran) : foreach ($sasaran as $row) : ?>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <?= $row['sasaran'] ?>

            <div class="pull-right">
              <a href="" class="icon-options-vertical" data-toggle="dropdown" style="font-size:20px;color:white"></a>
              <ul role="menu" class="dropdown-menu" style="top: unset;">
                <li>
                  <a href="#!" onclick="editRef('<?= $row['id_sasaran_iki'] ?>')" style="color: #000;"> <i class="icon-pencil"></i> Edit</a>
                </li>
                <li>
                  <a href="#!" onclick="deleteRef('<?= $row['id_sasaran_iki'] ?>')" style="color: #000;"><i class="icon-trash"></i> Hapus</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="panel-body" style="padding: 0px">

            <?php $i = 0;
            foreach ($row['iki'] as $iki) : $i++; ?>
              <div class="col-md-12 b-b">
                <div class="col-in row">
                  <div class="col-sm-1"> <span class="btn btn-xs btn-circle btn-primary btn-outline"><?= $i ?></span> </div>
                  <div class="col-sm-11">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="pull-right">
                          <button onclick="listTautan('<?= $iki['id_iki'] ?>')" class="btn btn-xs btn-default btn-outline"><i class="fa fa-link"></i> Tautan</button>
                          <a href="#!" onclick="editRef2('<?= $iki['id_iki'] ?>')" class="btn btn-xs btn-primary btn-outline"><i class="fa fa-pencil"></i> Ubah</a>
                          <button onclick="deleteRef2('<?= $iki['id_iki'] ?>')" class="btn btn-xs btn-danger btn-outline"><i class="fa fa-trash"></i> Hapus</button>
                        </div>
                        <p class="text-muted">Indikator: </p>
                        <p style="line-height: 0px"><strong><?= $iki['indikator'] ?> </strong></p>
                      </div>
                      <div class="col-md-6">
                        <p style="line-height: 40px; margin-bottom: -15px;">Formula:</p>
                        <h5 class="text-justify text-muted vb"><?= $iki['formula'] ?></h5>
                      </div>
                      <div class="col-md-6">
                        <p style="line-height: 40px; margin-bottom: -15px;">Sumber Data:</p>
                        <h5 class="text-justify text-muted vb"><?= $iki['sumber_data'] ?></h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>

            <div class="col-md-12 b-b">
              <div class="col-in">
                <button type="button" class="btn btn-primary pull-right" onclick="addRef2('<?= $row['id_sasaran_iki'] ?>')" style="margin-bottom: 20px">Tambah Indikator</button>
              </div>
            </div>



          </div>
        </div>
    <?php endforeach;
    endif; ?>

  </div>




  <div id="modalTautan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Timeline Tautan</h4>
        </div>
        <div class="modal-body">
          <div>
            <?php $CI=&get_instance(); $CI->load->view('admin/tautan');?>
          </div>
        </div>
        <div class="modal-footer">

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <script type="text/javascript">
    function listTautan() {
      $('#modalTautan').modal('show');
    }
  </script>


  <div id="modalReferensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel1">Sasaran</h4>
        </div>
        <div class="modal-body">
          <form id="formRef">
            <div id="hiddenRef"></div>
            <div id="messageRef"></div>

            <input type="hidden" name="id_pegawai" value="<?= $detail->id_pegawai ?>">

            <div class="form-group">
              <label class="control-label">Nama Sasaran</label>
              <input type="text" name="sasaran" class="form-control">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="simpanRef()" id="btnSaveRef" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <script type="text/javascript">
    var save_method;

    function addRef() {
      save_method = 'add';
      $('#formRef')[0].reset();
      $('#messageRef').html('');
      $('#modalReferensi').modal('show');
      $('.modal-title').text('Tambah Sasaran');
    }

    function editRef(id) {
      save_method = 'update';
      $('#formRef')[0].reset();
      $('#messageRef').html('');
      $('.form-group').removeClass('has-error');
      $('#hiddenRef').html('<input type="hidden" value="" name="id_ref"/>');
      $('.help-block').empty();
      $.ajax({
        url: "<?= base_url() . 'iki/fetch_sasaran/' ?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('[name="id_ref"]').val(data.id_sasaran_iki);
          $('[name="sasaran"]').val(data.sasaran);
          $('#modalReferensi').modal('show');
          $('.modal-title').text('Ubah Jabatan');

        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("Gagal mendapatkan data");
        }
      });

    }

    function simpanRef() {
      $('#btnSaveRef').text('Menyimpan...');
      $('#messageRef').html('');
      $('#btnSaveRef').attr('disabled', true);
      var url;
      var formData = new FormData($('#formRef')[0]);
      if (save_method == 'add') {
        url = "<?= base_url() . 'iki/p_add_sasaran' ?>";
      } else {
        url = "<?= base_url() . 'iki/p_update_sasaran' ?>";
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
          $('#btnSaveRef').text('Simpan');
          $('#btnSaveRef').attr('disabled', false);


        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding / update dataeeS');
          $('#btnSaveRef').text('Simpan');
          $('#btnSaveRef').attr('disabled', false);

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
              url: "<?= base_url() . 'iki/delete_sasaran/' ?>" + id,
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
  </script>


  <div id="modalReferensi2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel2">Indikator</h4>
        </div>
        <div class="modal-body">
          <form id="formRef2">
            <div id="hiddenRef2"></div>
            <div id="messageRef2"></div>

            <input type="hidden" name="id_pegawai" value="<?= $detail->id_pegawai ?>">
            <input type="hidden" name="id_sasaran_iki" value="">

            <div class="form-group">
              <label class="control-label">Nama Indikator</label>
              <input type="text" name="indikator" class="form-control">
            </div>

            <div class="form-group">
              <label class="control-label">Formula Perhitungan</label>
              <textarea name="formula" class="textarea_editor form-control" rows="10"></textarea>
            </div>

            <div class="form-group">
              <label class="control-label">Sumber Data</label>
              <textarea name="sumber_data" class="textarea_editor form-control" rows="10"></textarea>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="simpanRef2()" id="btnSaveRef2" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <script type="text/javascript">
    var save_method;

    function addRef2(id) {
      save_method = 'add';
      $('#formRef2')[0].reset();
      $('[name="id_sasaran_iki"]').val(id);
      $('#messageRef2').html('');
      $('#modalReferensi2').modal('show');
      $('.modal-title').text('Tambah Indikator');
    }

    function editRef2(id) {
      save_method = 'update';
      $('#formRef2')[0].reset();
      $('#messageRef2').html('');
      $('.form-group').removeClass('has-error');
      $('#hiddenRef2').html('<input type="hidden" value="" name="id_ref"/>');
      $('.help-block').empty();
      $.ajax({
        url: "<?= base_url() . 'iki/fetch_indikator/' ?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('[name="id_ref"]').val(data.id_iki);
          $('[name="id_sasaran_iki"]').val(data.id_sasaran_iki);
          $('[name="indikator"]').val(data.indikator);
          $('[name="formula"]').data("wysihtml5").editor.setValue(data.formula);
          $('[name="sumber_data"]').data("wysihtml5").editor.setValue(data.sumber_data);
          $('#modalReferensi2').modal('show');
          $('.modal-title').text('Ubah Jabatan');

        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("Gagal mendapatkan data");
        }
      });

    }

    function simpanRef2() {
      $('#btnSaveRef2').text('Menyimpan...');
      $('#messageRef2').html('');
      $('#btnSaveRef2').attr('disabled', true);
      var url;
      var formData = new FormData($('#formRef2')[0]);
      if (save_method == 'add') {
        url = "<?= base_url() . 'iki/p_add_indikator' ?>";
      } else {
        url = "<?= base_url() . 'iki/p_update_indikator' ?>";
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
            $('#modalReferensi2').modal('hide');
            swal("Berhasil", "Data Berhasil Disimpan!", "success");
            location.reload();
          } else {
            $('#messageRef2').html('<div class="alert alert-danger">' + data.message + '</div>');
          }
          $('#btnSaveRef2').text('Simpan');
          $('#btnSaveRef2').attr('disabled', false);


        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding / update dataeeS');
          $('#btnSaveRef2').text('Simpan');
          $('#btnSaveRef2').attr('disabled', false);

        }
      });
    }

    function deleteRef2(id) {
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
              url: "<?= base_url() . 'iki/delete_indikator/' ?>" + id,
              type: "POST",
              dataType: "JSON",
              success: function(data) {
                $('#modalReferensi2').modal('hide');
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
  </script>