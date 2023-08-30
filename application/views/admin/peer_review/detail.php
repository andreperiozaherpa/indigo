<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Isi Penilaian Perilaku</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
        <li><a href="https://e-office.sumedangkab.go.id/kegiatan_personal">Penilaian Perilaku</a></li>
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12">
      <a href="<?=base_url('peer_review?bulan='.$bulan.'&tahun='.$tahun)?>" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali</a>
    </div>
  </div>

  <div class="row">

    <div class="white-box">
      <div class="row">
        <form method="POST">
          <div class="col-md-3 b-r">
            <center><img src="<?= base_url() ?>/data/foto/pegawai/<?= $pegawai->foto_pegawai ?>" alt="user-img" style=" object-fit: cover;
          width: 200px;
          height: 200px;border-radius: 50%;
          "> </center>
          </div>
          <div class="col-md-9">
            <div class="panel panel-primary">
              <div class="panel-heading"> <?= $pegawai->nama_skpd ?> <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
              </div>
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td style="width: 120px;">Nama </td>
                          <td>:</td>
                          <td> <strong><?= $pegawai->nama_lengkap ?></strong></td>
                        </tr>
                        <tr>
                          <td style="width: 120px;">NIP </td>
                          <td>:</td>
                          <td> <strong><?= $pegawai->nip ?> </strong></td>
                        </tr>
                        <tr>
                          <td style="width: 120px;">Jabatan </td>
                          <td>:</td>
                          <td> <strong> <?= $pegawai->jabatan ?> </strong>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>


  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <?php

        if ($penilaian) {
        ?>
          <center>
            <img src="<?= base_url('data/icon/check.png') ?>" width="70px" />
            <h4>Terima Kasih, Anda sudah mengisi penilaian ini.</h4>
          </center>
          <!-- <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Pertanyaan</th>
              <th>Jawaban</th>
            </tr>
            <?php
            $noin = 1;
            foreach ($instrumen as $in) {
            ?>
              <tr>
                <td colspan="3"><?= $in->nama_instrumen ?></td>
              </tr>
              <?php

              $noind = 1;
              $indikator = $this->peer_review_model->get_indikator($in->id_pr_instrumen);
              foreach ($indikator as $ind) {
              ?>
                <tr>
                  <td colspan="3"><?= $ind->nama_indikator ?></td>
                </tr>
                <?php
                // $pertanyaan = $this->peer_review_model->get_pertanyaan($ind->id_pr_indikator);
                $pertanyaan = $this->peer_review_model->get_jawaban($penilaian->id_pr_penilai, $ind->id_pr_indikator);
                $noper = 1;
                foreach ($pertanyaan as $per) {
                ?>
                  <tr>
                    <td><?= "$noin.$noind.$noper" ?></td>
                    <td><?= $per->nama_pertanyaan ?></td>
                    <td><?= $per->jawaban ?></td>
                  </tr>
                  <?php
                  $noper++;
                }
                $noind++;
              }
              $noin++;
            }
                  ?>
          </thead>
        </table> -->
        <?php
        } else {

        ?>
          <div class="alert alert-info">
            <i class="ti-info"></i> Silahkan jawab pertanyaan dibawah ini se-objektif mungkin, identias Anda sebagai penilai akan di <b>rahasiakan</b>.
          </div>
          <!-- <p>&nbsp;</p> -->
          <div id="exampleBasic" class="wizard">
            <ul class="wizard-steps" role="tablist">
              <?php
              $noin = 1;
              foreach ($instrumen as $in) { ?>
                <li role="tab" <?= $noin == 1 ? 'class="active" ' : null ?>>
                  <h4><span><?= $noin ?></span><?= $in->nama_instrumen ?></h4>
                </li>
              <?php $noin++;
              } ?>
            </ul>
            <form id="validation" class="form-horizontal" method="POST">
              <div class="wizard-content">
                <?php
                $noin = 1;
                foreach ($instrumen as $in) {
                  $indikator = $this->peer_review_model->get_indikator($in->id_pr_instrumen);
                ?>
                  <div class="wizard-pane <?= $noin == 1 ? 'active' : null ?>" role="tabpanel">
                    <?php
                    $noind = 1;
                    foreach ($indikator as $ind) {

                      $pertanyaan = $this->peer_review_model->get_pertanyaan($ind->id_pr_indikator);
                    ?>
                      <h4><?= $noind . ". " . $ind->nama_indikator ?></h4>
                      <div style="margin-left:20px">
                        <?php
                        $noper = 1;
                        foreach ($pertanyaan as $per) {
                          $num = count($pertanyaan) > 1 ? strtolower(number_to_alphabet($noper)) . ". " : null;
                          $jenis_jawaban = $per->jenis_jawaban;
                          if($jenis_jawaban=='sesuai'){
                            
                            $list_pilihan = array(1 => 'Tidak Sesuai', 2 => 'Kurang Sesuai', 3 => 'Cukup Sesuai', 4 => 'Sesuai', 5 => 'Sangat Sesuai');
                          }else{
                            $list_pilihan = array(1 => 'Buruk', 2 => 'Kurang', 3 => 'Sedang', 4 => 'Baik', 5 => 'Sangat Baik');

                          }
                        ?>
                          <div>
                            <p><?= $num . $per->nama_pertanyaan ?></p>
                            <div class="row">
                              <div class="col-md-12">
                                <?php foreach ($list_pilihan as $k => $lp) { ?>
                                  <div class="radio radio-primary" style="display: inline-block;margin-right: 10px;margin-right: 10px">
                                    <input type="radio" name="jawaban[<?= $per->id_pr_pertanyaan ?>]" id="radio<?= $per->id_pr_pertanyaan ?><?= $k ?>" value="<?= $k ?>">
                                    <label for="radio<?= $per->id_pr_pertanyaan ?><?= $k ?>"> <?= $lp ?> </label>
                                  </div>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        <?php
                          $noper++;
                        }
                        ?>
                      </div>
                    <?php
                      $noind++;
                    }
                    ?>
                  </div>

                <?php $noin++;
                } ?>

              </div>
            </form>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <!--row -->

</div>

<script src="https://www.jqueryscript.net/demo/Merge-Cells-HTML-Table/jquery.table.marge.js"></script>
<script>
  $('#table').margetable({
    type: 2,
    colindex: [0, {
      index: 1,
      dependent: [0]
    }, {
      index: 2,
      dependent: [0, 1]
    }]
  });
</script>

<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css">
<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js"></script>
<script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js"></script>

<script type="text/javascript">
  (function() {
    var inserted = false;
    $('#exampleBasic').wizard({
      onInit: function() {
        $('#validation').formValidation({
          framework: 'bootstrap',
          fields: {
            <?php

            foreach ($instrumen as $in) {
              $indikator = $this->peer_review_model->get_indikator($in->id_pr_instrumen);
              foreach ($indikator as $ind) {
                $pertanyaan = $this->peer_review_model->get_pertanyaan($ind->id_pr_indikator);
                foreach ($pertanyaan as $per) { ?> 'jawaban[<?= $per->id_pr_pertanyaan ?>]': {
                    validators: {
                      notEmpty: {
                        message: 'Jawaban harus diisi'
                      }
                    }
                  },
            <?php }
              }
            } ?>

          }
        });
      },
      validator: function() {
        var fv = $('#validation').data('formValidation');

        var $this = $(this);

        // Validate the container
        fv.validateContainer($this);

        var isValidStep = fv.isValidContainer($this);
        if (isValidStep === false || isValidStep === null) {
          return false;
        }

        return true;
      },
      onFinish: function() {
        // $('#validation').submit();
        // alert('finish');
        if (!inserted) {
          $('.wizard-buttons').hide();
          $('.wizard-content').append('<hr><button class="btn btn-primary" type="submit">Simpan Penilaian</button>');
          inserted = true;
        }
      }
    });
  })();
</script>