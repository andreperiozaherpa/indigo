<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Rencana Kerja SKPD</h4>
    </div>
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
              <div class="panel panel-primary">
                <div class="panel-heading"><?= $dt_skpd->nama_skpd; ?> <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td style="width: 120px;">Nama Kepala </td>
                          <td>:</td>
                          <td> <strong><?= $dt_skpd->kepala->nama_lengkap; ?></strong></td>
                        </tr>
                        <tr>
                          <td style="width: 120px;">Alamat SKPD </td>
                          <td>:</td>
                          <td> <strong><?= $dt_skpd->alamat_skpd; ?></strong></td>
                        </tr>
                        <tr>
                          <td style="width: 120px;">Email/tlp </td>
                          <td>:</td>
                          <td> <strong><?= $dt_skpd->email_skpd; ?> / <?= $dt_skpd->telepon_skpd; ?></strong>
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
  </div>
  <div class="row">
    <div class="white-box col-md-12">



      <button type="button" class="btn btn-primary" onclick="add()" >Tambah Sub Kegiatan</button>
      <table class="table" style="margrin-top:20px">
        <thead>
          <tr>
            <th>No
            </th>
            <th>
              Kode
            </th>

            <th>
              Sub Kegiatan
            </th>

            <th>
              Kegiatan
            </th>

            <th>
              Program
            </th>

            <th>
              Sasaran
            </th>

            <th>
              Urusan
            </th>

            <th>
              Unit Kerja
            </th>

            <th>
              Jml. Indikator
            </th>

            <th>
              Opsi
            </th>
          </tr>
        </thead>
        <tbody id="row-data">

        </tbody>
      </table>

    </div>
  </div>

  <div class="row">
		<div class="col-12 text-center">
			<nav class="mt-4 mb-3">
				<ul class="pagination justify-content-center mb-0" id="pagination">
				</ul>
			</nav>
		</div>
	</div>
</div>



<div class="modal fade" id="modal-sub-kegiatan" tabindex="-1" role="dialog" aria-labelledby="modal-sub-kegiatanLabel1">
  <div class="modal-dialog modal-lg_" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="modal-sub-kegiatanLabel1">Tambah Sub Kegiatan</h4>
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
                  <?php foreach ($dt_urusan as $row) {
                    echo '<option value="' . $row->id_urusan . '">' . $row->kode_urusan . ' - ' . $row->nama_urusan . '</option>';
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
                <label for="recipient-name" class="control-label">Indikator Sasaran:</label>
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
                <select class="form-control select2 input_select" id="id_sub_kegiatan" name="id_sub_kegiatan">
                  <option value="">Pilih</option>
                </select>
                <div class="text-danger error" id="err_id_sub_kegiatan"></div>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="control-label">Sumber Anggaran:</label>
                <select name="id_sumber_anggaran" id="id_sumber_anggaran" class="form-control select2 input_select">
                  <option value="">Pilih</option>
                  <?php foreach ($dt_sumber_anggaran as $row) {
                    echo '<option value="' . $row->id_sumber_anggaran . '">' . $row->nama_sumber_anggaran . '</option>';
                  }
                  ?>
                </select>
                <div class="text-danger error" id="err_id_sumber_anggaran"></div>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="control-label">Prioritas Daerah:</label>
                <select name="id_prioritas_daerah" id="id_prioritas_daerah" class="form-control select2 input_select">
                  <option value="">Pilih</option>
                  <?php foreach ($dt_prioritas_daerah as $row) {
                    echo '<option value="' . $row->id_prioritas_daerah . '">' . $row->nama_prioritas_daerah . '</option>';
                  }
                  ?>
                </select>
                <div class="text-danger error" id="err_id_prioritas_daerah"></div>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="control-label">Prioritas nasional:</label>
                <select name="id_prioritas_nasional" id="id_prioritas_nasional" class="form-control select2 input_select">
                  <option value="">Pilih</option>
                  <?php foreach ($dt_prioritas_nasional as $row) {
                    echo '<option value="' . $row->id_prioritas_nasional . '">' . $row->nama_prioritas_nasional . '</option>';
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
  var action = "";
  var page = 1;
  var id_kegiatan = 0;
  var rowData = [];
  var id_indikator_program_renstra = 0;
  var id_ref_kegiatan = 0;


  function add()
   {
      $('#form-data')[0].reset();
      $(".modal-title").html("Tambah Sub Kegiatan");
      $(".input_text").val("");
      $(".input_select").val("").trigger("change");
      action = "add";
      id_kegiatan = 0;
      reset_error();
      $("#modal-sub-kegiatan").modal();
   }

  function loadPagination(page_num) {
    page = page_num;

    $.ajax({
      url: "<?= base_url() ?>sicerdas/renja/subkegiatan/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
        search: $("#search").val(),
        id_skpd: '<?= $dt_skpd->id_skpd; ?>',
      },
      success: function(data) {
        rowData = data.result;
        $("#row-data").html(data.content);
        $("#pagination").html(data.pagination);
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
  }

  var id_sub_urusan = 0;
  var id_sasaran_renstra = 0;
  var id_indikator_sasaran_renstra = 0;
  var id_program_renstra = 0;
  var id_indikator_program_renstra = 0;
  var id_kegiatan = 0;
  var id_indikator_kegiatan = 0;
  var id_sub_kegiatan = 0;

  function get_sub_urusan() {
    $("#id_sub_urusan").html("");
    $.ajax({
      url: "<?= base_url() ?>sicerdas/renja/subkegiatan/get_sub_urusan/",
      type: 'post',
      dataType: 'json',
      data: {
        id_urusan: $("#id_urusan").val(),
        id_sub_urusan: id_sub_urusan,
      },
      success: function(data) {
        $("#id_sub_urusan").html(data.content).trigger("change");
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
  }

  function get_sasaran() {
    $("#id_sasaran_renstra").html("");
    $.ajax({
      url: "<?= base_url() ?>sicerdas/renja/subkegiatan/get_sasaran/",
      type: 'post',
      dataType: 'json',
      data: {
        id_sub_urusan: $("#id_sub_urusan").val(),
        id_sasaran_renstra: id_sasaran_renstra,
      },
      success: function(data) {
        $("#id_sasaran_renstra").html(data.content).trigger("change");
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
  }


/*   function get_indikator_sasaran() {
    $("#id_indikator_sasaran_renstra").html("");
    $.ajax({
      url: "<?= base_url() ?>sicerdas/renstra/sasaran_indikator/get_indikator_by_sasaran/",
      type: 'post',
      dataType: 'json',
      data: {
        id_sasaran_renstra: $("#id_sasaran_renstra").val(),
        id_indikator_sasaran_renstra: id_indikator_sasaran_renstra
      },
      success: function(data) {
        $("#id_indikator_sasaran_renstra").html(data.content).trigger("change");
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
  }
 */
  function get_program() {
    $("#id_program_renstra").html("");
    $.ajax({
      url: "<?= base_url() ?>sicerdas/renja/subkegiatan/get_program/",
      type: 'post',
      dataType: 'json',
      data: {
        //id_indikator_sasaran_renstra: $("#id_indikator_sasaran_renstra").val(),
        id_sasaran_renstra : $("#id_sasaran_renstra").val(),
        id_program_renstra: id_program_renstra
      },
      success: function(data) {
        $("#id_program_renstra").html(data.content).trigger("change");
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
  }

  function get_indikator_program() {
    $("#id_indikator_program_renstra").html("");
    $.ajax({
      url: "<?= base_url() ?>sicerdas/renstra/program_indikator/get_indikator_by_program/",
      type: 'post',
      dataType: 'json',
      data: {
        id_program_renstra: $("#id_program_renstra").val(),
        id_skpd: '<?= $dt_skpd->id_skpd; ?>',
        id_indikator_program_renstra: id_indikator_program_renstra,
      },
      success: function(data) {
        /* console.log(id_indikator_program_renstra);
        console.log(data); */
        $("#id_indikator_program_renstra").html(data.content).trigger("change");

      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
  }

  function get_kegiatan() {
    $("#id_kegiatan").html("");
    $.ajax({
      url: "<?= base_url() ?>sicerdas/renja/subkegiatan/get_kegiatan/",
      type: 'post',
      dataType: 'json',
      data: {
        id_indikator_program_renstra: $("#id_indikator_program_renstra").val(),
        id_kegiatan: id_kegiatan,
      },
      success: function(data) {
        $("#id_kegiatan").html(data.content).trigger("change");

      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
  }


  function get_indikator_kegiatan() {
    $("#id_indikator_kegiatan").html("");
    $.ajax({
      url: "<?= base_url() ?>sicerdas/renja/subkegiatan/get_indikator_kegiatan/",
      type: 'post',
      dataType: 'json',
      data: {
        id_kegiatan: $("#id_kegiatan").val(),
        id_indikator_kegiatan: id_indikator_kegiatan,
      },
      success: function(data) {
        $("#id_indikator_kegiatan").html(data.content).trigger("change");
        get_sub_kegiatan();
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });

    get_unit_kerja();
  }

  function get_sub_kegiatan() {
    $("#id_sub_kegiatan").html("");
    $.ajax({
      url: "<?= base_url() ?>sicerdas/renja/subkegiatan/get_sub_kegiatan/",
      type: 'post',
      dataType: 'json',
      data: {
        id_kegiatan: $("#id_kegiatan").val(),
        id_sub_kegiatan: id_sub_kegiatan,
      },
      success: function(data) {
        $("#id_sub_kegiatan").html(data.content).trigger("change");
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
  }


  function check(id) {
    var is_checked = $("#checkbox_" + id).prop("checked");
    $(".unit-" + id).prop("checked", is_checked);
  }

  function reset_error() {
    $(".error").html("");
  }

  function save() {
    reset_error();
    var formdata = new FormData(document.getElementById('form-data'));
    formdata.append("action", "add");

    $.ajax({
      url: "<?= base_url() ?>sicerdas/renja/subkegiatan/save",
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
          $('#modal-sub-kegiatan').modal('toggle');
          swal(
            'Berhasil',
            data.message,
            'success'
          );
          loadPagination(page);
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

    function get_unit_kerja()
    {
      var id_kegiatan = $("#id_kegiatan").val();
      $("#row-unit-kerja").html("");
      if(id_kegiatan != "")
      {
        
        $.ajax({
           url: "<?=base_url()?>sicerdas/renja/subkegiatan/get_unit_kerja/",
           type: 'post',
           dataType: 'json',
           data: {
            id_kegiatan : $("#id_kegiatan").val(),
              id_skpd : '<?=$dt_skpd->id_skpd;?>',
              jenis_skpd : '<?=$dt_skpd->jenis_skpd;?>',
              nama_skpd_alias : '<?=$dt_skpd->nama_skpd_alias;?>',
              id_sub_kegiatan_renja : id_sub_kegiatan
           },
           success: function (data) {
             console.log(data);
              $("#row-unit-kerja").html(data.content);
           },
           error: function (xhr, status, error) {
              console.log(xhr.responseText);
              //swal("Opps", "Terjadi kesalahan", "error");
           }
        });
      }

    }
</script>