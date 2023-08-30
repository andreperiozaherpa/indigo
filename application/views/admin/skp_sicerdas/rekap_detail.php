<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title"><?= $title ?></h4>
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
  <div class="row">
    <div class="col-md-4 col-xs-12">
      <div class="white-box">
        <div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?php echo base_url(); ?>/data/images/header/header2.jpg">
          <div class="overlay-box">
            <div class="user-content" style="padding-bottom:15px;">
              <a href="javascript:void(0)"><img src="<?php echo $pegawai->foto_pegawai = (!empty($this->session->userdata('username'))) ? base_url() . "data/foto/pegawai/" . $pegawai->foto_pegawai : base_url() . "data/foto/pegawai/user-default.png"; ?>" class="thumb-lg img-circle" style=" object-fit: cover;

							width: 100px;
							height: 100px;border-radius: 50%;
							" alt="img"></a>
              <h5 class="text-white"><b><?= isset($pegawai->nama_lengkap) ? $pegawai->nama_lengkap : '-' ?></b></h5>
              <h6 class="text-white"><?= isset($pegawai->nip) ? $pegawai->nip : '-' ?></h6>
            </div>
          </div>
        </div>
        <div class="user-btm-box">
          <div class="row">
            <div class="col-md-12 b-b text-center">
              <h6><b>SKPD
                </b></h6>
              <h6><?= isset($pegawai->nama_skpd) ? $pegawai->nama_skpd : '-' ?>
              </h6>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 b-r text-center">
              <h6><b>Unit Kerja</b></h6>
              <h6>
                <?= isset($pegawai->nama_unit_kerja) ? $pegawai->nama_unit_kerja : '-' ?>
              </h6>
            </div>
            <div class="col-md-6 text-center">
              <h6><b>Jabatan</b></h6>
              <h6>
                <?= isset($pegawai->jabatan) ? $pegawai->jabatan : '-' ?>
              </h6>
            </div>
          </div>
        </div>
      </div>
      <div class="white-box">
        <h3 class="box-title">Download Rekap Catatan Kerja Pegawai</h3>
        <form method="POST">
          <div class="form-group">
            <label>Bulan</label>
            <select name="bulan" class="form-control" required>
              <option value="">Pilih Bulan</option>
              <?php 
                for($i=1;$i<=12;$i++){
                  $selected = set_value('bulan') == $i ? ' selected' : '';
                  echo '<option value="'.$i.'"'.$selected.'>'.bulan($i).'</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tahun</label>
            <label>Tahun</label>
            <select name="tahun" class="form-control" required>
              <option value="">Pilih Tahun</option>
              <?php 
                for($i=2020;$i<=2025;$i++){
                  $selected = set_value('tahun') == $i ? ' selected' : '';
                  echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                }
              ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary"><i class="ti-download"></i> Download</button>
        </form>
      </div>
    </div>
    <div class="col-md-8">

      <div class="row">
        <div class="col-md-4">
          <div class="white-box text-center bg-white" style="border-top:solid 4px #6003c8">
            <h1 class="text-danger counter"><?= $belum ?></h1>
            <p>Belum Dikerjakan</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="white-box text-center bg-white" style="border-top:solid 4px #6003c8">
            <h1 class="text-warning counter"><?= $proses ?></h1>
            <p>Proses Verifikasi</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="white-box text-center bg-white" style="border-top:solid 4px #6003c8">
            <h1 class="text-success counter"><?= $selesai ?></h1>
            <p>Sudah Selesai</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="white-box">
            <h3 class="box-title">DAFTAR PEKERJAAN</h3>
            <div class="comment-center">
              <?php
              foreach ($list_pekerjaan as $l) {
                if ($l->status_kegiatan == 'SELESAI DIVERIFIKASI') {
                  $color = "success";
                } elseif ($l->status_kegiatan == 'MENUNGGU VERIFIKASI') {
                  $color = "warning";
                } else {
                  $color = "danger";
                }
              ?>
                <div class="comment-body" style="width: 100%">
                  <div class="mail-contnet" style="width: 100%">
                    <h5><?= $l->nama_kegiatan ?></h5>
                    <a href="javascript:void(0)" onclick="showDetail(<?= $l->id_kegiatan_personal ?>)" class="btn btn-primary pull-right btn-rounded"><i class="ti-arrow-circle-right"></i> Detail</a>
                    <span class="mail-desc"><?= $l->deskripsi ?></span> <span class="label label-rouded label-<?= $color ?>"><?= $l->status_kegiatan ?></span>
                    <span class="time pull-right"><i class="icon-calender text-purple"></i> <span><b><?= tanggal($l->tgl_kegiatan_mulai) ?></b></span> s.d. <span><b><?= tanggal($l->tgl_kegiatan_akhir) ?></b></span></span>
                  </div>
                </div>
              <?php } ?>
              <!-- <div class="comment-body b-none">
                <div class="mail-contnet">
                  <h5>Pavan kumar</h5>
                  <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui pellentesque molestie feugiat.</span> <span class="label label-rouded label-warning">PROSES VERIFIKASI</span>
                  <span class="time pull-right">12 April 2020 s.d. 14 April 2020</span>
                </div>
              </div> -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bs-example-modal-lg" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">Detail Pekerjaan
            <span id="xstatus_kegiatan" class="label label-success pull-right">Sudah Dikerjakan</span>
          </h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Kegiatan</label>
            <p style="margin: 0px;padding:0px" id="xnama_kegiatan"></p>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <p style="margin: 0px;padding:0px" id="xdeskripsi">Lorem Pisum</p>
          </div>
          <div class="form-group">
            <label>Lokasi Pengerjaan</label>
            <p style="margin: 0px;padding:0px" id="xlokasi_pengerjaan">Lorem Pisum</p>
          </div>
          <div class="form-group">
            <label>Tanggal Pengerjaan</label>
            <p style="margin: 0px;padding:0px">
              <span id="xtgl_kegiatan_mulai"></span> s.d. <span id="xtgl_kegiatan_akhir"></span>
            </p>
          </div>
          <div class="form-group">
            <label>Target</label>
            <p style="margin: 0px;padding:0px" id="xtarget_kegiatan">Lorem Pisum</p>
          </div>
          <div class="form-group">
            <label>Verifikator</label>
            <p style="margin: 0px;padding:0px" id="xid_pegawai_verifikator">Lorem Pisum <span id="xjabatan_verifikator"></span></p>
          </div>
          <div id="kegiatanSelesai">
            <div class="form-group">
              <label>Deskripsi Hasil</label>
              <p style="margin: 0px;padding:0px" id="xdeskripsi_hasil">Lorem Pisum</p>
            </div>
            <div class="form-group">
              <label>Uraian Aktifitas</label>
              <p style="margin: 0px;padding:0px" id="xuraian_aktifitas">Lorem Pisum</p>
            </div>
            <div class="form-group">
              <label>Lampiran</label>
              <p><a href="" id="xlampiran" class="btn btn-primary btn-sm"><i class="ti-download"></i> Download</a></p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary waves-effect text-left" data-dismiss="modal">Tutup</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <script>
    function showDetail(idKegiatanPersonal) {
      $.getJSON("<?= base_url('kegiatan_personal/kegiatan_json/') ?>/" + idKegiatanPersonal, function(data) {
        $('#xnama_kegiatan').html(data.nama_kegiatan);
        $('#xdeskripsi').html(data.deskripsi);
        $('#xlokasi_pengerjaan').html(data.lokasi_pengerjaan);
        $('#xtgl_kegiatan_mulai').html(data.tgl_kegiatan_mulai);
        $('#xtgl_kegiatan_akhir').html(data.tgl_kegiatan_akhir);
        $('#xtarget_kegiatan').html(data.target_kegiatan);
        $('#xid_pegawai_verifikator').html(data.nama_lengkap_verifikator);
        $('#xjabatan_verifikator').html(data.jabatan_verifikator);
        $('#xstatus_kegiatan').html(data.status_kegiatan);
        if (data.status_kegiatan == 'BELUM DIKERJAKAN') {
          $('#kegiatanSelesai').hide();
          $('#xstatus_kegiatan').removeClass('label-success label-danger label-warning').addClass('label-danger');
        } else {
          if(data.status_kegiatan == 'MENUNGGU VERIFIKASI'){
          $('#xstatus_kegiatan').removeClass('label-success label-danger label-warning').addClass('label-warning');
          }else{
          $('#xstatus_kegiatan').removeClass('label-success label-danger label-warning').addClass('label-success');
          }
          $('#xdeskripsi_hasil').html(data.deskripsi_hasil);
          $('#xuraian_aktifitas').html(data.uraian_aktifitas);
          $('#xlampiran').attr('href','<?=base_url("/data/kegiatan_personal/")?>/'+data.id_pegawai_input+'/'+data.lampiran);
          $('#kegiatanSelesai').show();
        }
        $('#modalDetail').modal('show');
      });
    }
  </script>