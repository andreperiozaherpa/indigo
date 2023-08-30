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
      <div class="white-box">
        <div class="row">
          <form method="POST">
            <div class="col-md-3 b-r">
              <center><img style="width: 80%" src="<?= base_url() ?>data/logo/skpd/<?= ($detail->logo_skpd == '') ? 'sumedang.png' : $detail->logo_skpd  ?>" alt="user" class="img-circle" /> </center>
            </div>
            <div class="col-md-9">
              <div class="panel panel-primary">
                <div class="panel-heading"> <?= $detail->nama_skpd ?>
                  <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <table class="table">
                      <tr>
                        <td style="width: 120px;">Nama Kepala </td>
                        <td>:</td>
                        <td> <strong><?= $kepala_skpd->nama_lengkap ?></strong>
                      </tr>
                      <tr>
                        <td style="width: 120px;">Alamat SKPD </td>
                        <td>:</td>
                        <td> <strong><?= $detail->alamat_skpd ?></strong>
                      </tr>
                      <tr>
                        <td style="width: 120px;">Email/tlp </td>
                        <td>:</td>
                        <td> <strong><?= $detail->email_skpd ?> / <?= $detail->telepon_skpd ?></strong>
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
    <div class="col-sm-3">
      <div class="panel panel-primary">
        <div class="panel-heading">
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body">
            <div class="steamline">
              <div class="sl-item">
                <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                <div class="sl-right">
                  <div class="m-l-20"><b>VISI</b>
                    <?php
                    $perencanaan_visi = array();
                    foreach ($perencanaan as $k => $p) {
                      if (!array_key_exists($p['id_visi'], $perencanaan_visi)) {
                        $perencanaan_visi[$p['id_visi']]['name'] = $p['visi'];
                        $perencanaan_visi[$p['id_visi']]['class'] = " perencanaan" . $k;
                      } else {
                        $perencanaan_visi[$p['id_visi']]['class'] .= " perencanaan" . $k;
                      }
                    }
                    ?>
                    <?php $n = 1;
                    foreach ($perencanaan_visi as $value) : ?>
                      <p class="<?= $value['class'] ?>"><?= count($perencanaan_visi) > 1 ? "{$n}. " : ""; ?><?= $value['name'] ?></p>
                    <?php $n++;
                    endforeach ?>
                  </div>
                </div>
              </div>
              <hr>
              <div class="sl-item">
                <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                <div class="sl-right">
                  <div class="m-l-20"><b>MISI</b>
                    <?php
                    $perencanaan_misi = array();
                    foreach ($perencanaan as $k => $p) {
                      if (!array_key_exists($p['id_misi'], $perencanaan_misi)) {
                        $perencanaan_misi[$p['id_misi']]['name'] = $p['misi'];
                        $perencanaan_misi[$p['id_misi']]['class'] = " perencanaan" . $k;
                      } else {
                        $perencanaan_misi[$p['id_misi']]['class'] .= " perencanaan" . $k;
                      }
                    }
                    ?>
                    <?php $n = 1;
                    foreach ($perencanaan_misi as $value) : ?>
                      <p class="<?= $value['class'] ?>"><?= count($perencanaan_misi) > 1 ? "{$n}. " : ""; ?><?= $value['name'] ?></p>
                    <?php $n++;
                    endforeach ?>
                  </div>
                </div>
              </div>
              <hr>
              <div class="sl-item">
                <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                <div class="sl-right">
                  <div class="m-l-20"><b>TUJUAN</b>
                    <?php
                    $perencanaan_tujuan = array();
                    foreach ($perencanaan as $k => $p) {
                      if (!array_key_exists($p['id_tujuan'], $perencanaan_tujuan)) {
                        $perencanaan_tujuan[$p['id_tujuan']]['name'] = $p['tujuan'];
                        $perencanaan_tujuan[$p['id_tujuan']]['class'] = " perencanaan" . $k;
                      } else {
                        $perencanaan_tujuan[$p['id_tujuan']]['class'] .= " perencanaan" . $k;
                      }
                    }
                    ?>
                    <?php $n = 1;
                    foreach ($perencanaan_tujuan as $value) : ?>
                      <p class="<?= $value['class'] ?>"><?= count($perencanaan_tujuan) > 1 ? "{$n}. " : ""; ?><?= $value['name'] ?></p>
                    <?php $n++;
                    endforeach ?>
                  </div>
                </div>
              </div>
              <hr>
              <div class="sl-item">
                <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                <div class="sl-right">
                  <div class="m-l-20"><b>SASARAN</b>
                    <?php
                    $perencanaan_sasaran_rpjmd = array();
                    foreach ($perencanaan as $k => $p) {
                      if (!array_key_exists($p['id_sasaran_rpjmd'], $perencanaan_sasaran_rpjmd)) {
                        $perencanaan_sasaran_rpjmd[$p['id_sasaran_rpjmd']]['name'] = $p['sasaran_rpjmd'];
                        $perencanaan_sasaran_rpjmd[$p['id_sasaran_rpjmd']]['class'] = " perencanaan" . $k;
                      } else {
                        $perencanaan_sasaran_rpjmd[$p['id_sasaran_rpjmd']]['class'] .= " perencanaan" . $k;
                      }
                    }
                    ?>
                    <?php $n = 1;
                    foreach ($perencanaan_sasaran_rpjmd as $value) : ?>
                      <p class="<?= $value['class'] ?>"><?= count($perencanaan_sasaran_rpjmd) > 1 ? "{$n}. " : ""; ?><?= $value['name'] ?></p>
                    <?php $n++;
                    endforeach ?>

                  </div>
                </div>
              </div>
              <hr>
              <div class="sl-item">
                <div class="sl-left"><button type="button" class="btn btn-primary btn-circle  "></button></div>
                <div class="sl-right">
                  <div class="m-l-20"><b>IKU</b>
                    <?php
                    $perencanaan_iku_sasaran_rpjmd = array();
                    foreach ($perencanaan as $k => $p) {
                      if (!array_key_exists($p['id_iku_sasaran_rpjmd'], $perencanaan_iku_sasaran_rpjmd)) {
                        $perencanaan_iku_sasaran_rpjmd[$p['id_iku_sasaran_rpjmd']]['name'] = $p['iku_sasaran_rpjmd'];
                        $perencanaan_iku_sasaran_rpjmd[$p['id_iku_sasaran_rpjmd']]['class'] = " perencanaan" . $k;
                      } else {
                        $perencanaan_iku_sasaran_rpjmd[$p['id_iku_sasaran_rpjmd']]['class'] .= " perencanaan" . $k;
                      }
                    }
                    ?>
                    <?php $n = 1;
                    foreach ($perencanaan_iku_sasaran_rpjmd as $value) : ?>
                      <p class="<?= $value['class'] ?>"><?= count($perencanaan_iku_sasaran_rpjmd) > 1 ? "{$n}. " : ""; ?><?= $value['name'] ?></p>
                    <?php $n++;
                    endforeach ?>
                  </div>
                </div>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="col-sm-9">
      <div class="panel panel-primary col-sm-12">
        <div class="panel-heading text-center"> PERIODE 2019 - 2023
        </div>
      </div>

      <a href="<?= base_url('renstra_perencanaan/view/'.$detail->id_skpd.'/murni') ?>">
        <div class="col-md-6 col-xs-12 col-sm-6">
          <div class="white-box text-center" style="padding: 50px; border: 2px solid #6003c8">
            <h1 class="text-purple">MURNI</h1>
          </div>
        </div>
      </a>

      <a href="<?= base_url('renstra_perencanaan/view/'.$detail->id_skpd.'/perubahan') ?>">
        <div class="col-md-6 col-xs-12 col-sm-6">
          <div class="white-box text-center" style="padding: 50px; border: 2px solid #6003c8">
            <h1 class="text-purple">PERUBAHAN</h1>
          </div>
        </div>
      </a>


    </div>
  </div>
</div>

<div style="position: fixed;top: 20%;right: 0px;padding: 0px;">
  <div>
    <a class=" btn btn-xs btn-default btn-outline" href="<?= base_url('renstra_perencanaan/view/'.$detail->id_skpd.'/murni') ?>" style="writing-mode: vertical-lr; padding: 5px;">
      Murni
    </a>
  </div>
  <div>
    <a class=" btn btn-xs btn-default btn-outline" href="<?= base_url('renstra_perencanaan/view/'.$detail->id_skpd.'/perubahan') ?>" style="writing-mode: vertical-lr; padding: 5px;">
      Perubahan
    </a>
  </div>
  <div>
    <a class=" btn btn-xs btn-link" href="#!" style="writing-mode: vertical-lr; padding: 5px;">
      &nbsp;
    </a>
  </div>
</div>

<script type="text/javascript">
  function delete_ss_(id) {
    swal({
        title: "Apakah anda yakin menghapus sasaran strategis?",
        text: "jika data dihapus maka indikator dari sasaran tersebut akan terhapus juga.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Hapus",
        closeOnConfirm: false
      }

      ,
      function() {
        window.location = "<?php echo base_url(); ?>renstra_perencanaan/hapus_ss/<?= $this->uri->segment(3) ?>/" + id;
        swal("Berhasil!", "Data telah dihapus.", "success");
      }

    );
  }

  function delete_sp_(id) {
    swal({
        title: "Apakah anda yakin menghapus sasaran program?",
        text: "jika data dihapus maka indikator dari sasaran tersebut akan terhapus juga.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Hapus",
        closeOnConfirm: false
      }

      ,
      function() {
        window.location = "<?php echo base_url(); ?>renstra_perencanaan/hapus_sp/<?= $this->uri->segment(3) ?>/" + id;
        swal("Berhasil!", "Data telah dihapus.", "success");
      }

    );
  }

  function delete_sk_(id) {
    swal({
        title: "Apakah anda yakin menghapus sasaran kegiatan?",
        text: "jika data dihapus maka indikator dari sasaran tersebut akan terhapus juga.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Hapus",
        closeOnConfirm: false
      }

      ,
      function() {
        window.location = "<?php echo base_url(); ?>renstra_perencanaan/hapus_sk/<?= $this->uri->segment(3) ?>/" + id;
        swal("Berhasil!", "Data telah dihapus.", "success");
      }

    );
  }
</script>
<script type="text/javascript">
  function get_tujuan(id_misi = null) {
    if (id_misi == null) {
      var id_misi = $("#data-id_misi").val();
    }

    $("#data-id_tujuan").attr("readonly", true);

    $.ajax({
        url: "<?php echo base_url('renja_perencanaan/get_tujuan_by_misi'); ?>",
        type: "GET",
        data: "id_misi=" + id_misi,
        dataType: "text",

        success: function(resp) {
            $("#data-id_tujuan").attr("readonly", false);
            $("#data-id_tujuan").html(resp);
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#data-modal").unblock();
          $("#data-id_tujuan").html("");
          $("#data-id_tujuan").attr("readonly", true);
        }
      }

    )
  }


  function hoverByClass(classname, colorover, colorout = "transparent") {
    var elms = document.getElementsByClassName(classname);

    for (var i = 0; i < elms.length; i++) {
      elms[i].onmouseover = function() {
        for (var k = 0; k < elms.length; k++) {
          elms[k].style.backgroundColor = colorover;
        }
      }

      ;

      elms[i].onmouseout = function() {
        for (var k = 0; k < elms.length; k++) {
          elms[k].style.backgroundColor = colorout;
        }
      }

      ;
    }
  }

  <?php foreach ($perencanaan as $key => $value) : ?>hoverByClass("perencanaan<?= $key ?>", "yellow");

  <?php endforeach ?>function block_ui(element) {
    $(element).block({

        message: '<h4><img src="<?= base_url('asset/pixel'); ?>/plugins/images/busy.gif" /> We are processing your request.</h4>',
        css: {
          border: '1px solid #fff'
        }
      }

    );
  }

  //sasaran strategis
  function new_sasaran_strategis_renstra() {
    $("#tambahSasaran").modal();
    $("#data-title-tambahSasaran").text("Tambah Sasaran Strategis");
    // $("#data-sub-title").text("");
    $("#data-form-tambahSasaran")[0].reset();
    $("#data-button-tambahSasaran").text("Simpan Data");
    $("#data-button-tambahSasaran").attr("onclick", "add_sasaran_strategis_renstra();");
  }

  function edit_sasaran_strategis_renstra(id) {
    block_ui("#main-content");
    block_ui("#tambahSasaran");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/get_sasaran_strategis_renstra'); ?>/" + id,
        type: "GET",
        dataType: "json",
        cache: false,

        success: function(resp) {
            $("#main-content").unblock();
            $("#tambahSasaran").unblock();

            if (resp == false) {
              $("#data-title-tambahSasaran").text("Data tidak ditemukan!");
              $("#data-button-tambahSasaran").attr("onclick", "");
              swal("Sorry!", "Data tidak ditemukan!", "error");
            } else {
              $("#data-form-tambahSasaran")[0].reset();
              $("#data-title-tambahSasaran").text("Ubah Data");
              $("#data-button-tambahSasaran").text("Simpan Data");
              $("#data-button-tambahSasaran").attr("onclick", "save_sasaran_strategis_renstra(" + id + ");");
              $("#data-id_iku_sasaran_rpjmd").val(resp.id_iku_sasaran_rpjmd);
              $("#data-id_iku_sasaran_rpjmd").select2();

              if (resp.sasaran_strategis_renstra) {
                $("#data-sasaran_strategis_renstra").val(resp.sasaran_strategis_renstra);
              }

              $("#tambahSasaran").modal();
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#main-content").unblock();
          $("#tambahSasaran").unblock();
        }
      }

    )
  }

  function add_sasaran_strategis_renstra() {
    block_ui("#tambahSasaran");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/add_sasaran_strategis_renstra/' . $detail->id_skpd); ?>",
        type: "POST",
        data: $('#data-form-tambahSasaran').serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data baru telah ditambahkan.", "success");
              window.location.reload(false);
            } else if (resp == false) {
              $("#tambahSasaran").unblock();
              $("#data-form-submit-tambahSasaran").click();
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahSasaran").unblock();
        }
      }

    )
  }

  function save_sasaran_strategis_renstra(id) {
    block_ui("#tambahSasaran");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/update_sasaran_strategis_renstra'); ?>/" + id,
        type: "POST",
        data: $('#data-form-tambahSasaran').serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data telah berhasil diubah.", "success");
              window.location.reload(false);
            } else if (resp == "not found") {
              $("#tambahSasaran").unblock();
              swal("Sorry", "Data tidak ditemukan!", "error");
            } else if (resp == false) {
              $("#tambahSasaran").unblock();
              $("#data-form-submit-tambahSasaran").click();
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahSasaran").unblock();
        }
      }

    )
  }

  function add_indikator_sasaran_strategis() {
    block_ui("#tambahIndikator1");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/add_indikator_sasaran_strategis/' . $detail->id_skpd); ?>",
        type: "POST",
        data: $('#data-form-tambahIndikator1').serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data baru telah ditambahkan.", "success");
              window.location.reload(false);
            } else if (resp == false) {
              $("#tambahIndikator1").unblock();
              $("#data-form-submit-tambahIndikator1").click();
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahIndikator1").unblock();
        }
      }

    )
  }

  function lakukan_pembobotan_ss(id_iku) {
    block_ui("#lakukanPembobotanss" + id_iku);

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/lakukan_pembobotan_ss/' . $detail->id_skpd); ?>",
        type: "POST",
        data: $('#data-form-bobotss' + id_iku).serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data baru telah ditambahkan.", "success");
              window.location.reload(false);
            } else if (resp == false) {
              $("#lakukanPembobotanss" + id_iku).unblock();
              $("#data-form-submit-bobotss" + id_iku).click();
            } else if (resp == "nothing") {
              $("#lakukanPembobotanss" + id_iku).unblock();
              swal("Sorry :(", "Jumlah bobot harus 100%.", "warning");
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#lakukanPembobotanss" + id_iku).unblock();
        }
      }

    )
  }

  //sasaran program
  function get_iku_ss(id = null, selected = null) {
    if (id == null) {
      var id = $("#data-id_unit_kerja").val();
    }

    $("#data-id_iku_ss_renstra").attr("readonly", true);

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/get_iku_ss_by_unit_kerja'); ?>",
        type: "GET",
        data: "id_unit_kerja=" + id,
        dataType: "text",

        success: function(resp) {
            $("#data-id_iku_ss_renstra").attr("readonly", false);
            $("#data-id_iku_ss_renstra").html(resp);

            if (selected) {
              $("#data-id_iku_ss_renstra").val(selected);
            }

            $("#data-id_iku_ss_renstra").select2();
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahSasaran2").unblock();
          $("#data-id_iku_ss_renstra").html("");
          $("#data-id_iku_ss_renstra").attr("readonly", true);
        }
      }

    )
  }

  function new_sasaran_program_renstra() {
    $("#tambahSasaran2").modal();
    $("#data-title-tambahSasaran2").text("Tambah Sasaran Program");
    // $("#data-sub-title").text("");
    $("#data-form-tambahSasaran2")[0].reset();
    $("#data-button-tambahSasaran2").text("Simpan Data");
    $("#data-button-tambahSasaran2").attr("onclick", "add_sasaran_program_renstra();");
    get_iku_ss('<?= ($unit_kerja_ss) ? $unit_kerja_ss[0]["id_unit_kerja"] : "" ?>');
  }

  function edit_sasaran_program_renstra(id) {
    block_ui("#main-content");
    block_ui("#tambahSasaran2");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/get_sasaran_program_renstra'); ?>/" + id,
        type: "GET",
        dataType: "json",
        cache: false,

        success: function(resp) {
            $("#main-content").unblock();
            $("#tambahSasaran2").unblock();

            if (resp == false) {
              $("#data-title-tambahSasaran2").text("Data tidak ditemukan!");
              $("#data-button-tambahSasaran2").attr("onclick", "");
              swal("Sorry!", "Data tidak ditemukan!", "error");
            } else {
              $("#data-form-tambahSasaran2")[0].reset();
              $("#data-title-tambahSasaran2").text("Ubah Data");
              $("#data-button-tambahSasaran2").text("Simpan Data");
              $("#data-button-tambahSasaran2").attr("onclick", "save_sasaran_program_renstra(" + id + ");");
              // $("#data-id_unit_kerja").val(resp.id_unit_kerja);
              $("#data-id_unit_kerja").select2('val', resp.id_unit_kerja.split(","));
              get_iku_ss(resp.id_unit_kerja, resp.id_iku_ss_renstra);

              if (resp.sasaran_program_renstra) {
                $("#data-sasaran_program_renstra").val(resp.sasaran_program_renstra);
              }

              $("#tambahSasaran2").modal();
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#main-content").unblock();
          $("#tambahSasaran2").unblock();
        }
      }

    )
  }

  function add_sasaran_program_renstra() {
    block_ui("#tambahSasaran2");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/add_sasaran_program_renstra/' . $detail->id_skpd); ?>",
        type: "POST",
        data: $('#data-form-tambahSasaran2').serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data baru telah ditambahkan.", "success");
              window.location.reload(false);
            } else if (resp == false) {
              $("#tambahSasaran2").unblock();
              $("#data-form-submit-tambahSasaran2").click();
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahSasaran2").unblock();
        }
      }

    )
  }

  function save_sasaran_program_renstra(id) {
    block_ui("#tambahSasaran2");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/update_sasaran_program_renstra'); ?>/" + id,
        type: "POST",
        data: $('#data-form-tambahSasaran2').serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data telah berhasil diubah.", "success");
              window.location.reload(false);
            } else if (resp == "not found") {
              $("#tambahSasaran2").unblock();
              swal("Sorry", "Data tidak ditemukan!", "error");
            } else if (resp == false) {
              $("#tambahSasaran2").unblock();
              $("#data-form-submit-tambahSasaran2").click();
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahSasaran2").unblock();
        }
      }

    )
  }

  function add_indikator_sasaran_program() {
    block_ui("#tambahIndikator2");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/add_indikator_sasaran_program/' . $detail->id_skpd); ?>",
        type: "POST",
        data: $('#data-form-tambahIndikator2').serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data baru telah ditambahkan.", "success");
              window.location.reload(false);
            } else if (resp == false) {
              $("#tambahIndikator2").unblock();
              $("#data-form-submit-tambahIndikator2").click();
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahIndikator2").unblock();
        }
      }

    )
  }

  function lakukan_pembobotan_sp(id_iku) {
    block_ui("#lakukanPembobotansp" + id_iku);

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/lakukan_pembobotan_sp/' . $detail->id_skpd); ?>",
        type: "POST",
        data: $('#data-form-bobotsp' + id_iku).serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data baru telah ditambahkan.", "success");
              window.location.reload(false);
            } else if (resp == false) {
              $("#lakukanPembobotansp" + id_iku).unblock();
              $("#data-form-submit-bobotsp" + id_iku).click();
            } else if (resp == "nothing") {
              $("#lakukanPembobotansp" + id_iku).unblock();
              swal("Sorry :(", "Jumlah bobot harus 100%.", "warning");
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#lakukanPembobotansp" + id_iku).unblock();
        }
      }

    )
  }

  //sasaran kegiatan
  function get_iku_sp(id = null, selected = null) {
    if (id == null) {
      var id = $("#data-id_unit_kerja2").val();
    }

    $("#data-id_iku_sp_renstra").attr("readonly", true);

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/get_iku_sp_by_unit_kerja'); ?>",
        type: "GET",
        data: "id_unit_kerja=" + id,
        dataType: "text",

        success: function(resp) {
            $("#data-id_iku_sp_renstra").attr("readonly", false);
            $("#data-id_iku_sp_renstra").html(resp);

            if (selected) {
              $("#data-id_iku_sp_renstra").val(selected);
            }

            $("#data-id_iku_sp_renstra").select2();
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahSasaran3").unblock();
          $("#data-id_iku_sp_renstra").html("");
          $("#data-id_iku_sp_renstra").attr("readonly", true);
        }
      }

    )
  }

  function new_sasaran_kegiatan_renstra() {
    $("#tambahSasaran3").modal();
    $("#data-title-tambahSasaran3").text("Tambah Sasaran Kegiatan");
    // $("#data-sub-title").text("");
    $("#data-form-tambahSasaran3")[0].reset();
    $("#data-button-tambahSasaran3").text("Simpan Data");
    $("#data-button-tambahSasaran3").attr("onclick", "add_sasaran_kegiatan_renstra();");
    get_iku_sp('<?= ($unit_kerja_sp) ? $unit_kerja_sp[0]["id_unit_kerja"] : "" ?>');
  }

  function edit_sasaran_kegiatan_renstra(id) {
    block_ui("#main-content");
    block_ui("#tambahSasaran3");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/get_sasaran_kegiatan_renstra'); ?>/" + id,
        type: "GET",
        dataType: "json",
        cache: false,

        success: function(resp) {
            $("#main-content").unblock();
            $("#tambahSasaran3").unblock();

            if (resp == false) {
              $("#data-title-tambahSasaran3").text("Data tidak ditemukan!");
              $("#data-button-tambahSasaran3").attr("onclick", "");
              swal("Sorry!", "Data tidak ditemukan!", "error");
            } else {
              $("#data-form-tambahSasaran3")[0].reset();
              $("#data-title-tambahSasaran3").text("Ubah Data");
              $("#data-button-tambahSasaran3").text("Simpan Data");
              $("#data-button-tambahSasaran3").attr("onclick", "save_sasaran_kegiatan_renstra(" + id + ");");
              // $("#data-id_unit_kerja2").val(resp.id_unit_kerja);
              // $("#data-id_unit_kerja2").select2();
              $("#data-id_unit_kerja2").select2('val', resp.id_unit_kerja.split(","));
              get_iku_sp(resp.id_unit_kerja, resp.id_iku_sp_renstra);

              if (resp.sasaran_kegiatan_renstra) {
                $("#data-sasaran_kegiatan_renstra").val(resp.sasaran_kegiatan_renstra);
              }

              $("#tambahSasaran3").modal();
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#main-content").unblock();
          $("#tambahSasaran3").unblock();
        }
      }

    )
  }

  function add_sasaran_kegiatan_renstra() {
    block_ui("#tambahSasaran3");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/add_sasaran_kegiatan_renstra/' . $detail->id_skpd); ?>",
        type: "POST",
        data: $('#data-form-tambahSasaran3').serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data baru telah ditambahkan.", "success");
              window.location.reload(false);
            } else if (resp == false) {
              $("#tambahSasaran3").unblock();
              $("#data-form-submit-tambahSasaran3").click();
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahSasaran3").unblock();
        }
      }

    )
  }

  function save_sasaran_kegiatan_renstra(id) {
    block_ui("#tambahSasaran3");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/update_sasaran_kegiatan_renstra'); ?>/" + id,
        type: "POST",
        data: $('#data-form-tambahSasaran3').serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data telah berhasil diubah.", "success");
              window.location.reload(false);
            } else if (resp == "not found") {
              $("#tambahSasaran3").unblock();
              swal("Sorry", "Data tidak ditemukan!", "error");
            } else if (resp == false) {
              $("#tambahSasaran3").unblock();
              $("#data-form-submit-tambahSasaran3").click();
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahSasaran3").unblock();
        }
      }

    )
  }

  function add_indikator_sasaran_kegiatan() {
    block_ui("#tambahIndikator3");

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/add_indikator_sasaran_kegiatan/' . $detail->id_skpd); ?>",
        type: "POST",
        data: $('#data-form-tambahIndikator3').serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data baru telah ditambahkan.", "success");
              window.location.reload(false);
            } else if (resp == false) {
              $("#tambahIndikator3").unblock();
              $("#data-form-submit-tambahIndikator3").click();
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#tambahIndikator3").unblock();
        }
      }

    )
  }

  function lakukan_pembobotan_sk(id_iku) {
    block_ui("#lakukanPembobotansk" + id_iku);

    $.ajax({
        url: "<?php echo base_url('renstra_perencanaan/lakukan_pembobotan_sk/' . $detail->id_skpd); ?>",
        type: "POST",
        data: $('#data-form-bobotsk' + id_iku).serialize(),

        success: function(resp) {
            if (resp == true) {
              swal("Success!", "Data baru telah ditambahkan.", "success");
              window.location.reload(false);
            } else if (resp == false) {
              $("#lakukanPembobotansk" + id_iku).unblock();
              $("#data-form-submit-bobotsk" + id_iku).click();
            } else if (resp == "nothing") {
              $("#lakukanPembobotansk" + id_iku).unblock();
              swal("Sorry :(", "Jumlah bobot harus 100%.", "warning");
            } else {
              alert('Error Message: ' + resp);
            }
          }

          ,
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#lakukanPembobotansk" + id_iku).unblock();
        }
      }

    )
  }
</script>