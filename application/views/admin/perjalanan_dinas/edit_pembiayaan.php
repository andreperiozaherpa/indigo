<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Perjalanan Dinas</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
        <li><a href="https://e-office.sumedangkab.go.id/kegiatan_personal">Perjalanan Dinas</a></li>
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12">
      <a href="<?= isset($verifikasi) ? base_url('perjalanan_dinas/verifikasi_detail/' . $detail->id_perjalanan_dinas) : base_url('perjalanan_dinas/detail/' . $detail->id_perjalanan_dinas) ?>" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali ke Detail Perdin</a>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <h3 class="box-title">PEMBIAYAAN</h3>
        <form method="POST">
        <?php 
          if(isset($verifikasi)){
        ?>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Nomor BKU</label>
                <input type="text" name="no_bku" value="<?= $detail->no_bku ?>" class="form-control" placeholder="Masukkan Nomor BKU" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Kode Rekening</label>
                <input type="text" name="kode_rekening" value="<?= $detail->kode_rekening ?>" class="form-control" placeholder="Masukkan Kode Rekening" required>
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Biaya Transport</label>
                <input type="text" name="biaya_transport" value="<?= $detail->biaya_transport ?>" class="form-control" placeholder="Masukkan Biaya Transport" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Jenis Transportasi</label>
                <select name="jenis_transportasi" class="form-control select2" required>
                  <option value="">Pilih Jenis Transportasi</option>
                  <?php
                  $ljenisperjalanan = array('mobil', 'pesawat_terbang', 'bus', 'kereta', 'sepeda_motor', 'taksi', 'kapal_feri');
                  foreach ($ljenisperjalanan as $lj) {
                    $selected = $lj == $detail->jenis_transportasi ? ' selected' : null;
                    echo "<option value=\"$lj\"$selected>" . normal_string($lj) . "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Uang Refresentasi</label>
                <input type="text" name="uang_refresentasi" value="<?= $detail->uang_refresentasi ?>" class="form-control" placeholder="Masukkan Uang Refresentasi" required>
              </div>
            </div>
          </div>
          <table class="table table-bordered color-table primary-table" id="tablePegawai">
            <thead>
              <tr>
                <th rowspan="2" style="vertical-align: middle;text-align:center;width:25%">Nama Pegawai</th>
                <th rowspan="2" style="vertical-align: middle;text-align:center;">Surat Perintah</th>
                <th colspan="2" style="vertical-align: middle;text-align:center">Uang Harian</th>
                <th colspan="2" style="vertical-align: middle;text-align:center">Biaya Penginapan</th>
                <th rowspan="2" style="vertical-align: middle;text-align:center;"></th>
              </tr>
              <tr>
                <th style="vertical-align: middle;text-align:center;width:7.5%">Vol</th>
                <th style="vertical-align: middle;text-align:center">Rp</th>
                <th style="vertical-align: middle;text-align:center;width:7.5%">Vol</th>
                <th style="vertical-align: middle;text-align:center">Rp</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($pembiayaan as $k => $p) {
              ?>
                <tr>
                  <td style="vertical-align: middle">
                    <div id="divPegawaiOption">
                      <div id="checkboxJenis" class="checkbox checkbox-primary" style="display: inline-block;margin-top:0px">
                        <input id="jenis_pegawai" type="checkbox" class="jenisPegawai" value="Y" <?= $p->jenis_pegawai_p == "non_pns" ? ' checked' : null ?>>
                        <label for="jenis_pegawai"> Non PNS </label>
                        <input type="hidden" name="jenis_pegawai[]" value="<?= $p->jenis_pegawai_p == "non_pns" ? 'Y' : 'N' ?>">
                      </div>
                      <div id="checkboxKoor" class="checkbox checkbox-primary" style="display: inline-block;margin-left:15px;margin-top:0px">
                        <input id="koordinator" type="checkbox" class="koordinator" value="Y" <?= $p->is_koordinator == "Y" ? ' checked' : null ?>>
                        <label for="koordinator"> Koordinator </label>
                        <input type="hidden" name="koordinator[]" value="<?= $p->is_koordinator ?>">
                      </div>
                    </div>
                    <div id="divPegawaiName">
                      <?php
                      if ($p->jenis_pegawai_p == "pns") {
                      ?>
                        <input type="text" id="pegawai<?= $k ?>" class="form-control pegawaiSelect" placeholder="Pilih Pegawai" name="id_pegawai[]" required>
                        <input type="hidden" name="nama_jabatan[]" value="N"><input type="hidden" name="id_pegawai_atasan[]" value="N">
                      <?php } else {
                      ?><input type="text" class="form-control" value="<?= $p->nama_pegawai ?>" placeholder="Masukkan Nama Pegawai" name="id_pegawai[]" required>
                        <input type="text" class="form-control m-t-10" value="<?= $p->nama_jabatan ?>" placeholder="Masukkan Jabatan" name="nama_jabatan[]" required>
                        <input type="text" class="form-control m-t-10" id="atasan_<?= $k ?>" placeholder="Masukkan Nama Atasan" name="id_pegawai_atasan[]" required>
                      <?php
                      } ?>
                    </div>
                  </td>
                  <td style="vertical-align: middle">
                    <input type="text" class="form-control" value="<?= $p->no_sp ?>" name="no_sp[]" placeholder="Nomor SP">
                    <input style="margin-top: 10px;" type="date" class="form-control" value="<?= $p->tanggal_sp ?>" autocomplete="off" name="tanggal_sp[]" placeholder="Tanggal">
                  </td>
                  <td style="vertical-align: middle">
                    <input type="text" class="form-control" value="<?= $p->volume_uh ?>" name="volume_uh[]" placeholder="Masukkan Volume">
                  </td>
                  <td style="vertical-align: middle">
                    <div class="input-group">
                      <span class="input-group-addon">Rp.</span>
                      <input type="text" class="form-control" value="<?= $p->nominal_uh ?>" name="nominal_uh[]" placeholder="Masukkan Nominal">
                    </div>
                  </td>
                  <td style="vertical-align: middle">
                    <input type="text" class="form-control" value="<?= $p->volume_bp ?>" name="volume_bp[]" placeholder="Masukkan Vol">
                  </td>
                  <td style="vertical-align: middle">
                    <div class="input-group">
                      <span class="input-group-addon">Rp.</span>
                      <input type="text" class="form-control" value="<?= $p->nominal_bp ?>" name="nominal_bp[]" placeholder="Masukkan Nominal">
                    </div>
                  </td>
                  <td style="vertical-align: middle">
                    <button type="button" class="btn btn-danger btn-circle deletePegawai"><i class="ti-trash"></i></button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="row">
            <div class="col-md-12">
              <button type="button" id="addPegawai" class="btn btn-primary pull-right"><i class="ti-plus"></i> Tambah Pegawai</button>
            </div>
          </div>
          <hr>

          <button type="submit" name="type" value="pembiayaan" class="btn btn-primary"><i class="ti-save"></i> Simpan Pembiayaan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function toggleWaktu() {
    var jenis_waktu = $('input[name="jenis_waktu"]:checked').val();
    if (jenis_waktu == 'multi') {
      $('#divMulti').show();
      $('#divSingle').hide();
    } else {
      $('#divMulti').hide();
      $('#divSingle').show();
    }
  }

  function toggleSubJenis() {
    var jenis = $('[name="jenis_perjalanan"]').val();
    if (jenis == 'biasa') {
      $('[name="sub_jenis_perjalanan"]').removeAttr('disabled');
      $('#divSubJenis').show();
    } else {
      $('[name="sub_jenis_perjalanan"]').attr('disabled', 'disabled');
      $('#divSubJenis').hide();
    }
  }
</script>

<script>
  $(document).ready(function() {

    $('#divTerhitung').hide();
    $('#divPeriode').hide();

    <?php
    foreach ($pembiayaan as $k => $p) {
      if($p->jenis_pegawai_p=='pns'){
    ?>
      $('#pegawai<?=$k?>').select2({
        minimumInputLength: 2,
        allowClear: true,
        placeholder: 'Pilih Pegawai',
        ajax: {
          dataType: 'json',
          url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
          data: function(term, page) {
            return {
              search: term, //search term
            };
          },
          results: function(data, page) {
            return {
              results: data
            };
          },
        }
      });

      
      var ALL_OPTION<?=$k?> = {
        id: '<?= $p->id_pegawai ?>',
        text: '<?= $p->nama_lengkap ?>'
      };

			$('#pegawai<?=$k?>').select2('data', ALL_OPTION<?=$k?>);

    <?php }else{
      ?>
      $('#atasan_<?=$k?>').select2({
        minimumInputLength: 2,
        allowClear: true,
        placeholder: 'Pilih Pegawai',
        ajax: {
          dataType: 'json',
          url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
          data: function(term, page) {
            return {
              search: term, //search term
            };
          },
          results: function(data, page) {
            return {
              results: data
            };
          },
        }
      });
      
      var ALL_OPTION<?=$k?> = {
        id: '<?= $p->id_pegawai_atasan ?>',
        text: '<?= $p->nama_lengkap_atasan ?>'
      };

			$('#atasan_<?=$k?>').select2('data', ALL_OPTION<?=$k?>);
      <?php
    } } ?>


  });
</script>


<script>
  $('#addPegawai').click(function() {
    $("#tablePegawai tbody tr:last").find('.pegawaiSelect').select2('destroy');
    var append = $("#tablePegawai tbody tr:last").clone();
    var jumlah = $("#tablePegawai tbody tr").length;
    append.find('input:text').val('');
    append.find('input:checkbox').prop('checked', false);
    append.find('input:radio').prop('checked', false);
    append.find('textarea').text('');
    append.find('textarea').val('');
    append.find('#checkboxKoor input').attr('id', 'koor' + jumlah);
    append.find('#checkboxKoor label').attr('for', 'koor' + jumlah);
    append.find('#checkboxJenis input').attr('id', 'jenis' + jumlah);
    append.find('#checkboxJenis label').attr('for', 'jenis' + jumlah);
    append.find('select').val('');
    append.find('select').trigger('change');
    $("#tablePegawai tbody").append(append);
    $('.pegawaiSelect').select2({
      minimumInputLength: 2,
      allowClear: true,
      placeholder: 'Pilih Pegawai',
      ajax: {
        dataType: 'json',
        url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
        data: function(term, page) {
          return {
            search: term, //search term
          };
        },
        results: function(data, page) {
          return {
            results: data
          };
        },
      }
    });

  })
  $("#tablePegawai").on('click', '.deletePegawai', function() {
    var table = document.getElementById('tablePegawai');
    var rowCount = table.rows.length;
    // alert(rowCount);
    if (rowCount > 2) {
      $(this).parent().parent().remove();
    }
  });
  $(document).on('click', '.jenisPegawai', function() {
    var jenisPegawai = $(this).is(":checked");
    var divPegawai = $(this).closest('#divPegawaiOption').next();
    var inputJenis = $(this).closest('#checkboxJenis').find('[name="jenis_pegawai[]"]');
    if (jenisPegawai == true) {
      var rand = Math.floor(Math.random() * 1001);
      divPegawai.html('<input type="text" class="form-control" placeholder="Masukkan Nama Pegawai" name="id_pegawai[]" required><input type="text" class="form-control m-t-10" placeholder="Masukkan Jabatan" name="nama_jabatan[]" required><input type="text" class="form-control m-t-10" id="atasan_' + rand + '" placeholder="Masukkan Nama Atasan" name="id_pegawai_atasan[]" required>');
      inputJenis.val('Y');
      $('#atasan_' + rand).select2({
        minimumInputLength: 2,
        allowClear: true,
        placeholder: 'Pilih Pegawai',
        ajax: {
          dataType: 'json',
          url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
          data: function(term, page) {
            return {
              search: term, //search term
            };
          },
          results: function(data, page) {
            return {
              results: data
            };
          },
        }
      });
    } else {
      inputJenis.val('N');
      var rand = Math.floor(Math.random() * 1001);
      divPegawai.html('<input type="text" id="pegawai_' + rand + '" class="form-control pegawaiSelect" placeholder="Pilih Pegawai" name="id_pegawai[]" required><input type="hidden" name="nama_jabatan[]" value="N"><input type="hidden" name="id_pegawai_atasan[]" value="N">');
      $('#pegawai_' + rand).select2({
        minimumInputLength: 2,
        allowClear: true,
        placeholder: 'Pilih Pegawai',
        ajax: {
          dataType: 'json',
          url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
          data: function(term, page) {
            return {
              search: term, //search term
            };
          },
          results: function(data, page) {
            return {
              results: data
            };
          },
        }
      });
    }
  });
  $(document).on('click', '.koordinator', function() {
    var koordinator = $(this).is(":checked");
    var inputKoor = $(this).closest('#checkboxKoor').find('[name="koordinator[]"]');
    if (koordinator == true) {
      inputKoor.val('Y');
    } else {
      inputKoor.val('N');
    }
  });
</script>