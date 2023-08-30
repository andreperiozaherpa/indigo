<?php
if (isset($u)) {
  foreach ($u as $k => $v) {
    $$k = $v;
    $info[$k] = $v;
  }
}

$status_cuti = status_cuti($detail->status_pengajuan, $detail->status_verifikasi_kepegawaian, $detail->status_verifikasi_bkd, $detail->verifikasi_bkd);
?>

<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title"><?php echo title($title) ?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <?php echo breadcrumb($this->uri->segment_array()); ?>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <?php
      if (!empty($message)) {
      ?>
        <div class="alert alert-<?= $type; ?> alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <?= $message; ?>
        </div>
      <?php } ?>
      <div class="x_panel">
        <div class="x_content">
          <div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
            <button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <label id='status'></label>
          </div>
          <div class="col-md-4">

            <div class="white-box">
              <div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?php echo base_url(); ?>/data/images/header/header2.jpg">
                <div class="overlay-box">
                  <div class="user-content" style="padding-top:1px;">
                    <a href="javascript:void(0)"><img src="<?= base_url('data/foto/pegawai/' . $detail->foto_pegawai . '') ?>" class="thumb-lg img-circle" style=" object-fit: cover;width: 75px;height: 75px;border-radius: 50%;" alt="img"></a>
                    <h5 class="text-white"><b><?= $detail->nama_lengkap ?></b></h5>
                    <h6 class="text-white"><?= isset($detail->nip) ? $detail->nip : '-' ?></h6>
                  </div>
                </div>
              </div>
              <div class="user-btm-box">
                <div class="row">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>SKPD
                      </b></h6>
                    <h6><?= isset($detail->nama_skpd) ? ($detail->nama_skpd) : "-"; ?>
                    </h6>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 b-r text-center">
                    <h6><b>Unit Kerja</b></h6>
                    <h6>
                      <?= isset($detail->nama_unit_kerja) ? ($detail->nama_unit_kerja) : "-"; ?>
                    </h6>
                  </div>
                  <div class="col-md-6 text-center">
                    <h6><b>Jabatan</b></h6>
                    <h6>
                      <?= isset($detail->nama_jabatan) ? ($detail->nama_jabatan) : "-"; ?>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
            <?php
            if ($status_cuti == 'belum_diajukan') {
            ?>
              <a href="<?= base_url('permintaan_cuti/edit/' . $detail->id_permintaan_cuti) ?>" class="btn btn-info btn-block"><i class="ti-pencil"></i> Edit Permintaan</a>
            <?php } ?>
            <a onclick="return confirm('Apakah Anda yakin?')" href="<?= base_url('permintaan_cuti/delete/' . $detail->id_permintaan_cuti) ?>" class="btn btn-danger btn-block"><i class="ti-trash"></i> Hapus Permintaan</a>
            <?php
            if ($status_cuti == 'belum_diajukan') {
            ?>
              <a onclick="return confirm('Apakah Anda yakin akan mengajukan permintaan cuti? setelah diajukan maka Anda tidak dapat lagi mengubah data dan berkas')" href="<?= base_url('permintaan_cuti/ajukan_permintaan/' . $detail->id_permintaan_cuti) ?>" class="btn btn-success btn-block"><i class="ti-check"></i> Ajukan Permintaan</a>
            <?php } ?>
            <div class="white-box" style="border-top:10px solid #6003c8;margin-top: 15px;">
              <div class="row">
                <div class="col-md-12 b-b text-center">
                  <h6><b>Masa Kerja</b></h6>
                  <h6>
                    <?php
                    $awal = new DateTime(isset($detail->tmtcpns) ? $detail->tmtcpns : date("Y-m-d"));
                    $skrng = new DateTime(date("Y-m-d"));
                    $hasil = $skrng->diff($awal);
                    $tahun = $hasil->y;
                    $bulan = $hasil->m;
                    $hari = $hasil->d;
                    echo $tahun . ' Tahun ' . $bulan . ' Bulan ' . $hari . ' Hari ';
                    ?>
                  </h6>
                </div>
              </div>
              <div class="row b-b">
                <div class="col-md-6 b-r text-center">
                  <h6><b>TMT CPNS</b></h6>
                  <h6>
                    <?= isset($detail->tmtcpns) ? tanggal($detail->tmtcpns) : "-"; ?>
                  </h6>
                </div>
                <div class="col-md-6 text-center">
                  <h6><b>TMT PNS</b></h6>
                  <h6>
                    <?= isset($detail->tmtpns) ? tanggal($detail->tmtpns) : "-"; ?>
                  </h6>
                </div>
              </div>
              <div class="row b-b">
                <div class="col-md-6 b-r text-center">
                  <h6><b>NIP</b></h6>
                  <h6>
                    <?= isset($detail->nip) ? $detail->nip : "-"; ?>
                  </h6>
                </div>
                <div class="col-md-6 text-center">
                  <h6><b>Agama</b></h6>
                  <h6>
                    <?= isset($detail->agama) ? $detail->agama : "-"; ?>
                  </h6>
                </div>
              </div>
              <div class="row b-b">
                <div class="col-md-6 b-r text-center">
                  <h6><b>Tempat Lahir</b></h6>
                  <h6>
                    <?= isset($detail->temlahir) ? $detail->temlahir : "-"; ?>
                  </h6>
                </div>
                <div class="col-md-6 text-center">
                  <h6><b>Tgl Lahir</b></h6>
                  <h6>
                    <?= isset($detail->tgllahir) ? tanggal($detail->tgllahir) : "-"; ?>
                  </h6>
                </div>
              </div>
              <div class="row b-b">
                <div class="col-md-6 b-r text-center">
                  <h6><b>Jenis Kelamin</b></h6>
                  <h6>
                    <?= isset($detail->kelamin) ? $detail->kelamin : "-"; ?>
                  </h6>
                </div>
                <div class="col-md-6 text-center">
                  <h6><b>Pendidikan</b></h6>
                  <h6>
                    <?= isset($detail->pendidikan) ? $detail->pendidikan : "-"; ?>
                  </h6>
                </div>
              </div>
              <div class="row b-b">
                <div class="col-md-6 b-r text-center">
                  <h6><b>Pangkat / Golongan</b></h6>
                  <h6>
                    <?= isset($detail->pangkat) ? $detail->pangkat : "-"; ?><?= isset($detail->gol) ? $detail->gol : "-"; ?>
                  </h6>
                </div>
                <div class="col-md-6 text-center">
                  <h6><b>TMT Pangkat</b></h6>
                  <h6>
                    <?= isset($detail->tmtpang) ? tanggal($detail->tmtpang) : "-"; ?>
                  </h6>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="white-box">
              <span style="border-right: solid 2px #6003c8;padding-right: 7px;margin-right: 10px"><i style="background-color: #6003c8;color: #fff;padding: 5px;" class="ti-list-ol"></i> #<?= str_pad($detail->id_permintaan_cuti, 4, '0', STR_PAD_LEFT) ?></span>
              <span style="border-right: solid 2px #6003c8;padding-right: 7px;margin-right: 10px"><i style="background-color: #6003c8;color: #fff;padding: 5px;" class="ti-comment-alt"></i> <?= $detail->nama_jenis_cuti ?></span>
              <span><i style="background-color: #6003c8;color: #fff;padding: 5px;" class="ti-calendar"></i> <?= tanggal($detail->tanggal_pengajuan) ?></span>
              <?= color_status_cuti(status_cuti($detail->status_pengajuan, $detail->status_verifikasi_kepegawaian, $detail->status_verifikasi_bkd, $detail->verifikasi_bkd), 'pull-right') ?>
              <hr>

              <?php
              if ($status_cuti == "belum_diajukan") {
                $class = "warning";
                $text = "Pengajuan belum diajukan, silahkan pastikan data dan berkas Anda sudah benar. untuk mengajukan klik tombol Ajukan di menu sebelah kiri.";
              } elseif ($status_cuti == "menunggu_verifikasi_kepegawaian") {
                $class = "info";
                $text = "Pengajuan sudah diajukan, pemintaan Anda sedang diverifikasi oleh bagian Kepegawaian.";
              } elseif ($status_cuti == "ditolak_kepegawaian") {
                $class = "danger";
                $text = "Pengajuan ditolak oleh bagian Kepegawaian.";
              } elseif ($status_cuti == "selesai_kepegawaian") {
                $class = "success";
                $text = "Pengajuan sudah diterima oleh bagian Kepegawaian.";
              }
              ?>
              <div class="alert alert-<?= $class ?>">
                <?= $text ?>
                <?= isset($alasan) ? "<br> <b>Alasan Penolakan</b> : " . $alasan : '' ?>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Jenis Cuti</label>
                  <p><?= $detail->nama_jenis_cuti ?></p>
                </div>
                <div class="col-md-6">
                  <label>Tanggal Pengajuan</label>
                  <p><?= tanggal($detail->tanggal_pengajuan) ?></p>
                </div>
                <div class="col-md-6">
                  <label>Periode Cuti</label>
                  <p><?= tanggal($detail->tanggal_awal) ?><?= !empty($detail->tanggal_akhir) && $detail->tanggal_akhir !== '0000-00-00' ? ' s.d. ' . tanggal($detail->tanggal_akhir) : null ?></p>
                </div>
                <div class="col-md-6">
                  <label>Alamat Selama Menjalankan Cuti</label>
                  <p><?= $detail->alamat ?></p>
                </div>
                <div class="col-md-12">
                  <label>Keterangan</label>
                  <p><?= $detail->keterangan ?></p>
                </div>
              </div>
            </div>

            <?php
            if ($status_cuti == 'selesai_kepegawaian') {
            ?>

              <div class="panel panel-default">
                <div class="panel-heading">
                  SURAT IZIN CUTI
                </div>
                <div class="panel-body">
                  <?php if ($detail->id_surat_keluar == '') {
                  ?>
                    <center>
                      <h4>Surat Izin Cuti belum dibuat</h4>
                      <p>Surat Izin Cuti sedang dalam proses pembuatan oleh Bagian Kepegawaian, silahkan cek secara berkala untuk update selanjutnya</p>
                    </center>
                    <?php
                  } else {
                    $surat_keluar = $this->surat_keluar_model->get_detail_by_id($detail->id_surat_keluar);
                    if ($surat_keluar->status_ttd !== 'sudah_ditandatangani') {
                      ?>
                        <center>
                          <h4>Surat Izin Cuti dalam proses</h4>
                          <p>Surat Izin Cuti sudah dibuat dan sedang dalam proses verifikasi, silahkan cek secara berkala untuk update selanjutnya</p>
                        </center>
                        <?php
                    } else {
                    ?>

                      <?php
                      if ($surat_keluar->status_ttd == "sudah_ditandatangani") {
                        $viewer = "https://docs.google.com/viewer?url=" . base_url('data/surat_internal/ttd/' . $surat_keluar->file_ttd . '');
                        $m_icon = "ti-check";
                        $m_alert = "success";
                        $m_text = "Surat Izin Cuti Anda telah selesai, silahkan pergunakan surat ini sebagaimana mestinya.";
                      } else {
                        $viewer = "https://view.officeapps.live.com/op/embed.aspx?src=" . base_url('data/surat_internal/keluar/' . $surat_keluar->file_draft_surat . '');
                        $m_icon = "ti-info";
                        $m_alert = "danger";
                        $m_text = "Dokumen dibawah ini hanya versi preview (pratinjau), untuk melihat dokumen asli silahkan download surat ini.";
                      }
                      ?>
                      <div class="alert alert-<?= $m_alert ?>">
                        <i class="<?= $m_icon ?>"></i> <?= $m_text ?>
                      </div>
                      <a href="<?=base_url('data/surat_internal/ttd/' . $surat_keluar->file_ttd . '')?>" class="btn btn-primary"><i class="ti-download"></i> Download Surat Izin</a>
                      <hr>

                      <iframe src="<?= $viewer ?>&embedded=true" width="100%" height="700" style="border: none;"></iframe>
                  <?php
                    }
                  }
                  ?>
                </div>
              </div>
            <?php
            }
            ?>

            <div class="panel panel-default">
              <div class="panel-heading">
                DAFTAR BERKAS PERSYARATAN
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <?php
                    echo form_open_multipart();
                    $n = 1;
                    foreach ($persyaratan as $p) {
                      $ext = explode(".", $p->file);
                      $ext = end($ext);
                      if ($ext == "docx" || $ext == "doc" || $ext == "pdf") {
                        $tag = "iframe";
                        $url = base_url('data/berkas_cuti/' . $p->file);
                        // if($ext=="pdf"){
                        $url = "https://docs.google.com/viewer?url=" . $url . "&embedded=true";
                        // }else{
                        // $url = "https://view.officeapps.live.com/op/embed.aspx?src=".$url."&embedded=true";
                        // }
                        // echo $url;
                      } else {
                        $tag = "img";
                        $url = base_url('data/berkas_cuti/' . $p->file);
                      }
                    ?>
                      <div class="form-group">
                        <label style="margin-bottom: 20px"><span style="background-color: #6003c8;color: #fff;padding: 5px;border-radius: 2px;margin-right: 5px"><?= $n ?></span><?= $p->nama_persyaratan ?> </label>
                        <p><span style="font-weight: 500" class="text-primary">Nama File</span> : <?= $p->file ?></p>
                        <?php
                        if ($status_cuti !== 'belum_diajukan') {
                        ?>
                          <p><span class="label label-<?= $p->status_verifikasi == 'sudah_diverifikasi' ? 'success' : ($p->status_verifikasi == 'ditolak' ? 'danger' : 'warning') ?>"><?= normal_string($p->status_verifikasi) ?></span></p>
                          <?php
                          if ($p->status_verifikasi == 'ditolak') {
                          ?>
                            <p>Alasan Penolakan : <span class="text-danger"><?= $p->alasan_penolakan ?></span></p>
                        <?php
                          }
                        }
                        ?>

                        <a href="<?= base_url('data/berkas_cuti/' . $p->file) ?>" class="btn btn-primary"><i class="ti-download"></i> Download</a>
                        <a href="javascript:void(0)" onclick="lihat('<?= $tag ?>','<?= $ext ?>','<?= $url ?>')" class="btn btn-info"><i class="ti-eye"></i> Lihat</a>
                        <?php
                        if ($status_cuti == 'belum_diajukan') {
                        ?>
                          <a href="javascript:void(0)" onclick="showUploadUlang(<?= $p->id_permintaan_cuti_persyaratan ?>)" class="btn btn-warning"><i class="ti-reload"></i> Upload Ulang</a>
                        <?php } ?>
                      </div>
                      <hr>
                    <?php $n++;
                    } ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function lihat(tag, ext, url) {
    if (tag == 'iframe') {
      $("#frameLihat").attr('src', url);
      $("#frameLihat").show();
      $("#imgLihat").hide();
    } else {
      $("#imgLihat").attr('src', url);
      $("#imgLihat").show();
      $("#frameLihat").hide();
    }
    $('#modalLihat').modal('show');
  }

  function showUploadUlang(id_permintaan_cuti_persyaratan) {
    $.getJSON("<?= base_url('permintaan_cuti/getDetailPersyaratanByID') ?>/" + id_permintaan_cuti_persyaratan, function(data) {
      $('#namaFile').html(data.nama_persyaratan);
      $('[name="id_permintaan_cuti_persyaratan"]').val(id_permintaan_cuti_persyaratan);
      $('#modalUploadUlang').modal('show');
    });
  }
</script>

<div class="modal fade bs-example-modal-lg" id="modalLihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myLargeModalLabel">Pratinjau File</h4>
      </div>
      <div class="modal-body">
        <iframe id="frameLihat" src="" width="100%" height="700" style="border: none;display: none;"></iframe>
        <img id="imgLihat" src="" class="img-responsive" style="display: none;"></img>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="modal fade bs-example-modal-lg" id="modalUploadUlang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myLargeModalLabel">Upload Ulang</h4>
      </div>
      <div class="modal-body">
        <?= form_open_multipart() ?>
        <input type="hidden" name="id_permintaan_cuti_persyaratan" />
        <label id="namaFile">Nama File</label>
        <input type="file" name="file_persyaratan" class="dropify">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-outline waves-effect text-left" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary waves-effect text-left"><i class="ti-save"></i> Simpan</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>