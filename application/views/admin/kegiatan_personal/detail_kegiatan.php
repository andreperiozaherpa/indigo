<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Kegiatan</h4>
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
    <div class="col-md-12">
      <a style="margin-bottom: 10px" href="<?= base_url('kegiatan_personal') ?>" class="btn btn-primary btn-outline pull-right"><i class="icon-arrow-left-circle"></i> Kembali</a><br><br>
    </div>
    <div class="col-md-8">
      <div class="white-box">
        <div class="row">
          <div class="col-md-2 b-r">
            <h1><strong style="color: #6003c8"><?= tgl_hungkul($kegiatan->tgl_selesai_kegiatan); ?></strong></h1>
            <h1 style="margin-top:-30px;"><small class="muted"><?= bln_hungkul($kegiatan->tgl_selesai_kegiatan); ?> <sup style="font-size:10px;font-weight: bold;"><?= thn_hungkul($kegiatan->tgl_selesai_kegiatan); ?></sup> </small> </h1>
          </div>
          <div class="col-md-7">
            <h3><small><strong><?= $kegiatan->nama_kegiatan ?></strong> </small></h3>
          </div>
          <div class="col-md-3">
            <span class="label label-<?= $kegiatan->status_kegiatan == "MENUNGGU VERIFIKASI" ? 'warning' : 'success' ?>"><?= $kegiatan->status_kegiatan ?></span>
          </div>
        </div>
      </div>
      <div class="white-box">
        <div class="row">
          <h3><strong>Deskripsi Pekerjaan</strong> </h3>
          <?= $kegiatan->deskripsi ?>
        </div>
      </div>
      <div class="white-box">
        <div class="row">
          <h3><strong>Uraian Aktifitas Kerja Harian</strong> </h3>
          <?= $kegiatan->uraian_aktifitas ?>
        </div>
      </div>
      <div class="white-box">
        <div class="row">
          <h3><strong>Hasil Pekerjaan / Output</strong> </h3>
          <?= $kegiatan->deskripsi_hasil ?>
        </div>
      </div>
      <div class="white-box">
        <div class="row">
          <h3><strong>Verifikator</strong> </h3>
          <?= $kegiatan->nama_lengkap ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="<?= base_url('data/kegiatan_personal/' . $kegiatan->id_pegawai_input . '/' . $kegiatan->lampiran); ?>"><span class="btn btn-primary"><i class="ti-clip"> </i> Download Lampiran</span></a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <?php if ($kegiatan->jenis_sasaran_tautan or true) { ?>
          <div class="col-md-12">
            <div class="white-box" style="border-top:solid 3px #6003c8">
              <h4 class="box-title">
                <i class="icon-link text-purple" style="font-size: 11px"></i> Berdasarkan PK
              </h4>
              <hr class="m-t-0 m-b-0">
              <ul style="list-style-type: none;padding: 0px">
                <li style="margin-top: 5px;position: relative;">
                  <div style="padding-left: 0px" class="message-center">
                    <a href="#!">
                      <div class="mail-contnet">
                        <h5>Sasaran</h5>
                        <span class="mail-desc">Meningkatnya kualitas pelayanan Sekretariat Daerah</span>
                        <!-- <span class="time">7 hari yang lalu</span>  -->
                      </div>
                    </a>
                  </div>
                </li>
                <li style="margin-top: 5px;position: relative;">
                  <div style="padding-left: 0px" class="message-center">
                    <a href="#!">
                      <div class="mail-contnet">
                        <h5>IKU</h5>
                        <span class="mail-desc">Persentase Perangkat Daerah yang capaian target kinerja tahunannya berkategori "Baik"</span>
                      </div>
                    </a>
                  </div>
                </li>
                <li style="margin-top: 5px;position: relative;">
                  <div style="padding-left: 0px" class="message-center">
                    <a href="#!">
                      <div class="mail-contnet">
                        <h5>Renaksi</h5>
                        <span class="mail-desc">Membuat Perencanaan</span>
                      </div>
                    </a>
                  </div>
                </li>
                <!-- <span class="mytooltip tooltip-effect-4"><span class="tooltip-item" style="background:unset;padding:unset;width:100%;">
                    <li style="margin-top: 5px;position: relative;">
                      <div style="padding-left: 0px" class="message-center">
                        <a href="#!">
                          <div class="mail-contnet">
                            <h5>Anggaran</h5>
                            <span class="mail-desc" style="font-weight:300">Contoh RKA 3</span>
                          </div>
                        </a>
                      </div>
                    </li>
                  </span>
                  <span class="tooltip-content light clearfix">
                    <span class="tooltip-text">
                      <div class="panel-body row" style="padding-top:0px; padding-bottom:0px">
                        <div class="col-md-12 row-in">
                          <div class="row">
                            <div class="col-md-4"> 123.45.8 <h5 class="text-muted vb">Contoh RKA 3</h5>
                            </div>
                            <div class="col-md-8">
                              <h4 class="text-right m-t-15 text-primary">Rp<strong class="counter">345,000,000</strong></h4>
                            </div>
                            <div class="col-md-12">
                              <div class="progress">
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"> <span class="sr-only">87% Anggaran (left)</span> </div>
                              </div>
                              <div class="pull-left">
                                <h5 class="text-muted vb">Anggaran yg digunakan: </h5>
                              </div>
                              <div class="pull-right">
                                <h4 class="text-right text-primary">Rp<strong class="counter">45,000,000</strong></h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </span>
                  </span>
                </span> -->
              </ul>
              <div class="">
                <div class="panel-body row" style="padding-top:0px; padding-bottom:0px">
                  <div class="col-md-12 row-in">
                    <h5 style="font-weight: 400">Anggaran</h5>
                    <div class="row">
                      <div class="col-md-4"> 123.45.8 <h5 class="text-muted vb">Contoh RKA 3</h5>
                      </div>
                      <div class="col-md-8">
                        <h4 class="text-right m-t-15 text-primary">Rp<strong class="counter">345,000,000</strong></h4>
                      </div>
                      <div class="col-md-12">
                        <div class="progress">
                          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"> <span class="sr-only">87% Anggaran (left)</span> </div>
                        </div>
                        <div class="pull-left">
                          <h5 class="text-muted vb">Anggaran yg digunakan: </h5>
                        </div>
                        <div class="pull-right">
                          <h4 class="text-right text-primary">Rp<strong class="counter">45,000,000</strong></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

        <div class="col-md-12">
          <div class="white-box" style="border-top:solid 3px #6003c8">
            <h4 class="box-title">
              <i class="icon-link text-purple" style="font-size: 11px"></i> Berdasarkan SKP
            </h4>
            <hr class="m-t-0 m-b-0">
            <ul style="list-style-type: none;padding: 0px">
              <li style="margin-top: 5px;position: relative;">
                <div style="padding-left: 0px" class="message-center">
                  <a href="#!">
                    <div class="mail-contnet">
                      <h5>Sasaran</h5>
                      <span class="mail-desc">Meningkatnya kualitas pelayanan Sekretariat Daerah</span>
                    </div>
                  </a>
                </div>
              </li>
              <li style="margin-top: 5px;position: relative;">
                <div style="padding-left: 0px" class="message-center">
                  <a href="#!">
                    <div class="mail-contnet">
                      <h5>Nama Kegiatan</h5>
                      <span class="mail-desc">Persentase Perangkat Daerah yang capaian target kinerja tahunannya berkategori "Baik"</span>
                    </div>
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <?php if ($kegiatan->id_iki) { ?>
          <div class="col-md-12">
            <div class="white-box" style="border-top:solid 3px #6003c8">
              <h4 class="box-title">
                <i class="icon-link text-purple" style="font-size: 11px"></i> Berdasarkan IKI
              </h4>
              <hr class="m-t-0 m-b-0">
              <ul style="list-style-type: none;padding: 0px">
                <li style="margin-top: 5px;position: relative;">
                  <div style="padding-left: 0px" class="message-center">
                    <a href="#!">
                      <div class="mail-contnet">
                        <h5>Sasaran</h5>
                        <span class="mail-desc"><?= $kegiatan->sasaran ?></span>
                      </div>
                    </a>
                  </div>
                </li>
                <span class="mytooltip tooltip-effect-4"><span class="tooltip-item" style="background:unset;padding:unset;width:100%;">
                    <li style="margin-top: 5px;position: relative;">
                      <div style="padding-left: 0px" class="message-center">
                        <a href="#!">
                          <div class="mail-contnet">
                            <h5>Indikator</h5>
                            <span class="mail-desc" style="font-weight:300"><?= $kegiatan->indikator ?></span>
                          </div>
                        </a>
                      </div>
                    </li>
                  </span>
                  <span class="tooltip-content light clearfix">
                    <img />
                    <span class="tooltip-text">
                      <p><strong>Formula:</strong> <?= $kegiatan->formula ?></p>
                      <p><strong>Sumber data:</strong> <?= $kegiatan->sumber_data ?></p>
                    </span>
                  </span>
                </span>
              </ul>
            </div>
          </div>
        <?php } ?>

        <div class="col-md-12">
          <div class="white-box" style="border-top:solid 3px #6003c8">
            <h4 class="box-title">
              <i class="icon-link text-purple" style="font-size: 11px"></i> Berdasarkan Instruksi Langsung
            </h4>
            <hr class="m-t-0 m-b-0">
            <ul style="list-style-type: none;padding: 0px">
              <li style="margin-top: 5px;position: relative;">
                <div style="padding-left: 0px" class="message-center">
                  <a href="#!">
                    <div class="mail-contnet">
                      <h5>Instruksi</h5>
                      <span class="mail-desc">Meningkatnya kualitas pelayanan Sekretariat Daerah</span>
                    </div>
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-md-12">
          <div class="white-box">
            <div class="row text-center">
              <b>Log Aktivitas Pekerjaan</b>
            </div>
            <br>
            <div class="steamline">
              <?php foreach ($logs as $log) : ?>
                <div class="sl-item">
                  <div class="sl-left"> <img class="img-circle" alt="user" src="<?= base_url('data/foto/pegawai/' . $log->foto_pegawai); ?>" style="-webkit-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);border:2px solid white;"> </div>
                  <div class="sl-right">
                    <div><b><?= $log->full_name; ?></b></div>
                    <p><?= $log->status; ?></p>
                    <span class="sl-date"><?= poee(date('N', strtotime($log->date))); ?>, <?= tanggal($log->date); ?></span>
                    <span class="sl-date"><?= date('H:i', strtotime($log->time)); ?> WIB</span>
                  </div>
                </div>
              <?php endforeach; ?>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>