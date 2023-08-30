<div class="container-fluid">

<div class="row bg-title">
  <!-- .page title -->
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Referensi Upaya Fisik</h4>
  </div>
  <!-- /.page title -->
  <!-- .breadcrumb -->
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

    <ol class="breadcrumb">
      <li><a href="<?= base_url(); ?>admin">Dashboard</a></li>
      <li class="active">Ref. Upaya Fisik</li>
    </ol>
  </div>
  <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  <div class="col-md-12">



    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">Upaya Fisik 
            <span class="label label-primary pull-right m-l-10"> <button type="button" class="btn btn-primary btn-sm" onclick="addRef()"><i class="fa fa-plus"></i> Tambah</button></span>
            <?php if($this->session->userdata('level') == 'Administrator'):?>
           <span class="label label-success pull-right m-l-10"><button class="btn btn-success btn-sm" onclick="showImportExcel()" > <i class="fa fa-download"></i> Import Excel</button></span></div>
           <form method="POST" enctype="multipart/form-data" style="display:none">
              <input type="file" name="fileExcel" id="import_excel" onchange="this.form.submit()">
              <button type="submit" name="excel"></button>
           </form>
           <?php endif;?>
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
            <?php if($this->session->flashdata('status')){ ?>
              <div class="alert alert-success">
                <?=$this->session->flashdata('status')?>
              </div>
            <?php } ?>
              <table class="table color-table dark-table table-hover" id="myTable">

                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Arti</th>
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
                      <td><?= $i->kode ?></td>
                      <td><?= $i->arti ?></td>

                      <td style="width:150px">
                        <a href="javascript:void(0)" onclick="editRef(<?= $i->id ?>)" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="javascript:void(0)" onclick="deleteRef(<?= $i->id ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
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
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
      </div>
      <div class="modal-body">
        <form id="formRef">
          <div id="hiddenRef"></div>
          <div id="messageRef"></div>
          <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
          <div class="form-group">
            <label for="message-text" class="control-label">Kode</label>
            <input type="text" name="kode" class="form-control" placeholder=" Masukkan Kode Upaya Fisik" >
          </div>
          <div class="form-group">
            <label class="control-label">Arti</label>
            <textarea class="form-control" name="arti"></textarea>
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
    $('.modal-title').text('Tambah');
  }

  function editRef(id) {
    save_method = 'update';
    $('#formRef')[0].reset();
    $('#messageRef').html('');
    $('.form-group').removeClass('has-error');
    $('#hiddenRef').html('<input type="hidden" value="" name="id_ref"/>');
    $('.help-block').empty();
    $.ajax({
      url: "<?= base_url() . 'simanja/ref_upaya_fisik/fetch_ref/' ?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id_ref"]').val(data.id);
        $('[name="kode"]').val(data.kode);
        $('[name="arti"]').val(data.arti);
        $('#modalReferensi').modal('show');
        $('.modal-title').text('Ubah');

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
      url = "<?= base_url() . 'simanja/ref_upaya_fisik/p_add_ref' ?>";
    } else {
      url = "<?= base_url() . 'simanja/ref_upaya_fisik/p_update_ref' ?>";
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
        alert('Error adding / update data');
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
            url: "<?= base_url() . 'simanja/ref_upaya_fisik/delete_ref/' ?>" + id,
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
    function showImportExcel()
    {
      document.getElementById('import_excel').click();
    }
</script>