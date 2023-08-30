<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Daftar Kegiatan Personal</h4>
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
      <div class="white-box">
        <div class="row">
          <div class="col-md-4 mb-small">
            <br>
            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTambahKegiatan" data-lat='21.03' data-lng='105.85'>Tambah Rencana Pekerjaan Personal</a>
          </div>
          <!-- modal tambah kegiatan -->
          <div id="modalTambahKegiatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <!-- modal-content -->
              <div class="modal-content">
                <div class="modal-header" style="background-color:#6003c8">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel" style="color:white">Tambah Rencana Pekerjaan Personal</h4>
                </div>
                <div class="modal-body">
                  <form method="post">

                    <div class="form-group">
                      <label class="control-label">Unit Kerja</label>
                      <select onchange="getSasaran()" name="id_unit_kerja" id="id_unit_kerja" class="form-control select2">
                        <option value="">Pilih Unit Kerja</option>
                        <?php
                        foreach ($unit_kerja as $u) {
                          $selected = ($u->id_unit_kerja == $this->session->userdata('id_unit_kerja')) ? ' selected' : '';
                          echo '<option value="' . $u->id_unit_kerja . '"' . $selected . '>' . $u->nama_unit_kerja . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-10">
                          <label class="control-label">Berdasarkan PK</label>
                        </div>
                        <div class="col-md-2">
                          <input type="checkbox" id="tIKU" class="js-switch" data-color="#6003c8" onchange="toggleIKU()" />
                        </div>
                      </div>
                      <div id="divIKU" style="display: none;background-color: #f1e7fe;padding: 15px 10px;margin-bottom: 10px;">
                        <div class="form-group">
                          <label class="control-label">Sasaran</label>
                          <select onchange="getIKU()" name="id_sasaran" id="id_sasaran" class="form-control">
                            <option value="">Pilih Sasaran</option>
                            <?= $sasaran ?>
                          </select>
                        </div>
                        <input type="hidden" id="jenis_sasaran">
                        <div class="form-group">
                          <label class="control-label">IKU</label>
                          <select onchange="getRenaksi()" name="id_iku" id="id_iku" class="form-control">
                            <option value="">Tidak ada IKU</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Renaksi</label>
                          <select name="id_renaksi" id="id_renaksi" class="form-control">
                            <option value="">Tidak ada Renaksi</option>
                          </select>
                        </div>
                        <div class="row">
                          <div class="col-md-10">
                            <label class="control-label">Memerlukan Anggaran</label>
                          </div>
                          <div class="col-md-2">
                            <input type="checkbox" id="tRKA" class="js-switch" data-color="#6003c8" onchange="toggleRKA()" />
                          </div>
                        </div>
                        <div id="divRKA" style="display: none;background-color: #f1e7fe;padding: 15px 10px;margin-bottom: 10px;">
                          <div class="form-group">
                            <label class="control-label">DPA</label>
                            <select onchange="getRKA()" name="" id="id_dka" class="form-control">
                              <option value="">Pilih DPA</option>
                              <?= $sasaran ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group" style="margin-top: 10px">
                        <div class="row">
                          <div class="col-md-10">
                            <label class="control-label">Berdasarkan SKP</label>
                          </div>
                          <div class="col-md-2">
                            <input type="checkbox" id="tSKP" class="js-switch" data-color="#6003c8" onchange="toggleSKP()" />
                          </div>
                        </div>
                      </div>
                      <div id="divSKP" style="display: none;background-color: #f1e7fe;padding: 15px 10px;margin-bottom: 10px;">
                        <div class="form-group">
                          <label class="control-label">Sasaran</label>
                          <select  name="jenis_skp" id="jenis skp" class="form-control">
                            <option value="">Pilih Jenis</option>
                            <option value="">Tugas Jabatan</option>
                            <option value="">Tugas Tambahan</option>
                            <option value="">Tugas Kreatifitas</option>
                          </select>
                        </div>
                        <input type="hidden" id="jenis_sasaran">
                        <div class="form-group">
                          <label class="control-label">Nama Kegiatan</label>
                          <select  name="" id="" class="form-control">
                            <option value="">Kegiatan 1</option>
                            <option value="">Kegiatan 2</option>
                            <option value="">Kegiatan 3</option>

                          </select>
                        </div>
                      </div>


                      <div class="form-group" style="margin-top: -15px;">
                        <div class="row">
                          <div class="col-md-10">
                            <label class="control-label">Berdasarkan IKI</label>
                          </div>
                          <div class="col-md-2">
                            <input type="checkbox" id="tIKI" class="js-switch" data-color="#6003c8" onchange="toggleIKI()" />
                          </div>
                        </div>
                      </div>
                      <div id="divIKI" style="display: none;background-color: #f1e7fe;padding: 15px 10px;margin-bottom: 10px;">
                        <div class="form-group">
                          <label class="control-label">Nama IKI</label>
                          <select  name="id_iki" id="jenis skp" class="form-control">
                            <?php foreach ($iki as $sasaran) {?>
                              <optgroup label="Sasaran: <?=$sasaran['sasaran']?>">
                              <?php foreach ($sasaran['iki'] as $row) {?>
                                <option value="<?=$row['id_iki']?>">Indikator: <?=$row['indikator']?></option>
                              <?php }?>
                              </optgroup>
                            <?php }?>
                          </select>
                        </div>
                        <input type="hidden" id="jenis_sasaran">

                      </div>

                      <div class="form-group" style="margin-top: -15px;">
                        <div class="row">
                          <div class="col-md-10">
                            <label class="control-label">Berdasarkan Instruksi Langsung</label>
                          </div>
                          <div class="col-md-2">
                            <input type="checkbox" id="tInstruksi" class="js-switch" data-color="#6003c8" onchange="toggleInstruksi()" />
                          </div>
                        </div>
                      </div>
                      <div id="divInstruksi" style="display: none;background-color: #f1e7fe;padding: 15px 10px;margin-bottom: 10px;">
                        <div class="form-group">
                          <label class="control-label">Nama Instukrsi</label>
                          <select  name="jenis_skp" id="jenis skp" class="form-control">
                            <option value="">Instruksi 1</option>
                            <option value="">Instruksi 2</option>
                            <option value="">Instruksi 3</option>
                          </select>
                        </div>
                        <input type="hidden" id="jenis_sasaran">

                      </div>



                      <div class="form-group">
                        <label for="">Lokasi Pengerjaan</label>
                        <?php echo form_error('lokasi'); ?>
                        <select class="form-control select2" id="lokasi_pengerjaan" name="lokasi_pengerjaan" onchange="toggleLokasi()">
                          <option value="">Pilih Lokasi Pengerjaan</option>
                          <?php
                          $a_lokasi = array('kantor', 'luar_kantor', 'rumah');
                          foreach ($a_lokasi as $a) {
                            echo '<option value="' . $a . '">' . normal_string($a) . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                      <div id="formRefIzin" style="display: none">
                        <div class="form-group">
                          <label>Ref. Izin Kerja Luar Kantor</label>
                          <select class="form-control select2" name="id_kerja_luar_kantor" onchange="getDetailIzin()">
                            <option value="">Pilih Referensi Izin</option>
                            <?php
                            foreach ($ref_izin as $r) {
                              echo '<option value="' . $r->id_kerja_luar_kantor . '">' . $r->nama_kegiatan . ' - No. Surat : ' . $r->nomer_surat . '</option>';
                            }
                            ?>
                          </select>
                          <p id="loadingText" style="display:none">Mengambil data ... </p>
                        </div>

                        <div class="form-group">
                          <label for="">Koordinat Tempat Pengerjaan</label>

                          <h4>Detail Lokasi</h4>
                          <p>Address: <input type="text" name="alamat" class="form-control search_addr" id="adr" size="45"></p>
                          <p>Latitude: <input type="text" name="lat" class="form-control search_latitude" id="lat" size="30"></p>
                          <p>Longitude: <input type="text" name="lng" class="form-control search_longitude" id="long" size="30"></p>

                          <input type="text" id="pac-input" class="form-control" name="lokasi" value="" placeholder="Cari lokasi ...">
                          <div class="location-map" id="location-map">
                            <div id="map" class="gmaps"></div>
                          </div>
                          <div class="hidden">
                            <div class="" id="infowindow-content">
                              <img src="" width="16" height="16" id="place-icon">
                              <span id="place-name" class="title"></span><br>
                              <span id="place-address"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">Nama Kegiatan</label>
                        <?php echo form_error('nama_kegiatan'); ?>
                        <input type="text" class="form-control" name="nama_kegiatan" value="" placeholder="Masukan Nama Kegiatan">
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Tanggal Kegiatan</label>
                          <?php echo form_error('tgl_kegiatan_mulai'); ?>
                          <input type="text" id="datepicker" class="form-control" name="tgl_kegiatan_mulai" value="" placeholder="YYYY-MM-DD">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Sampai Tanggal</label>
                          <?php echo form_error('tgl_kegiatan_akhir'); ?>
                          <input type="text" id="datepicker" class="form-control" name="tgl_kegiatan_akhir" value="" placeholder="YYYY-MM-DD">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">Deskripsi Kegiatan</label>
                        <?php echo form_error('deskripsi'); ?>
                        <textarea class="form-control" rows="15" name="deskripsi" placeholder=""></textarea>
                      </div>
                      <div class="form-group">
                        <label for="">Target Kegiatan</label>
                        <?php echo form_error('target_kegiatan'); ?>
                        <input type="text" class="form-control" name="target_kegiatan" value="" placeholder="Masukan Target Kegiatan">
                      </div>
                      <div class="form-group">
                        <label for="">Verifikator Kegiatan</label>
                        <?php echo form_error('id_verifikator'); ?>
                        <select class="form-control" name="id_verifikator">
                          <?php foreach ($verifikator_kegiatan as $vk) : ?>
                            <option value="<?= $vk['id_pegawai']; ?>"><?= $vk['nama_lengkap']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary waves-effect" name="tambah_kegiatan">Tambah</button>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
            </div>
          </div>
            <!-- /.modal-dialog -->
            <form method="POST">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="">Nama Kegiatan</label>
                  <input type="text" class="form-control" name="nama_kegiatan_filter" value="<?= isset($nama) ? $nama : '' ?>" placeholder="Enter text ...">
                </div>
              </div>
              <div class="col-md-3">
                <label for="">Tanggal Kegiatan</label>
                <input type="text" class="form-control" id="datepicker" name="tgl_filter" value="<?= isset($tgl) ? $tgl : '' ?>" placeholder="MM-DD-YYYY">
              </div>
              <div class="col-md-2">
                <div class="form-group text-center">
                  <br>
                  <button type="submit" class="btn btn-primary btn-outline m-t-5" name="filter_kegiatan"><i class="ti-search"></i> Filter Kegiatan</button>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>

    </div>
    <div class="row">
      <?php if ($daftar_kegiatan == false) : ?>
        <div class="col-md-12">
          <div class="alert alert-info">
            <p class="text-center">Belum Ada Pekerjaan</p>
          </div>
        </div>
        <?php else : ?>
          <div class="col-md-4 b-l p-b-20">
            <div class="box-title text-center bg-white m-b-15">
              <label class="btn btn-success" style="cursor:default !important; width: 100%">Daftar Pekerjaan </label>
            </div>
            <?php if ($belum_dikerjakan == false) : ?>
              <div class="alert alert-success">
                <p class="text-center">Belum Ada Pekerjaan</p>
              </div>
              <?php elseif ($belum_dikerjakan == true) : ?>
                <?php foreach ($belum_dikerjakan as $bk) : ?>
                  <div class="col-md-12">
                    <div class="white-box">
                      <?php if ($bk->catatan_verifikator == NULL) { ?>
                        <span class="label label-success label-rounded pull-right">Belum Dikerjakan <?= isset($bk->catatan_verifikator) ? '<i class="icon-refresh"></i>' : NULL; ?> </span>
                        <?php } else { ?>
                        <span class="label label-inverse label-rounded pull-right">Perlu Revisi <?= isset($bk->catatan_verifikator) ? '<i class="icon-refresh"></i>' : NULL; ?> </span>
                          <?php } ?>
                        <br>
                      <?php
                      if ($bk->id_kerja_luar_kantor) {
                        $lk = true;
                        $dlk = $this->kerja_luar_kantor_model->get_by_id_verifered($bk->id_kerja_luar_kantor);
                      } else {
                        $lk = false;
                      }
                      ?>

                      <?php
                      if ($lk) {
                        ?>
                        <h4 style="margin-bottom: 0px;margin-top:0px"><?php echo $bk->nama_kegiatan; ?></h4>
                        <small style="margin-bottom:10px;display: block">No. Surat Izin : <?= $dlk->nomer_surat ?></small>
                        <?php
                      } else {
                        ?>
                        <h4 style="margin-bottom: 10px"><?php echo $bk->nama_kegiatan; ?></h4>
                        <?php
                      }
                      ?>

                      <div class="col-md-5">
                        <i class="fa fa-calendar text-success"></i> <small><?= tanggal($bk->tgl_kegiatan_mulai) ?> </small>
                      </div>
                      <div class="col-md-5">
                        <!-- <i class="fa fa-calendar text-success"></i> -->
                      </div>
                      <div class="col-md-2">
                        <div class="pull-right">
                          <a href="" class="icon-options-vertical" data-toggle="dropdown" style="font-size:20px;color:grey"></a>
                          <ul role="menu" class="dropdown-menu">
                            <li>
                              <a href="#" data-toggle="modal" data-target="#modalUpdateKegiatan<?= $bk->id_kegiatan_personal ?>"> <i class="icon-pencil"></i> Edit</a>
                            </li>
                            <li>
                              <a href="# " data-toggle="modal" data-target="#modalHapusKegiatan<?= $bk->id_kegiatan_personal ?>"><i class="icon-trash"></i> Hapus</a>
                            </li>
                          </ul>
                          <!-- modal update kegiatan -->
                          <div id="modalUpdateKegiatan<?= $bk->id_kegiatan_personal ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <!-- modal-content -->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color:#6003c8">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="myModalLabel" style="color:white">Tambah Kegiatan</h4>
                                </div>
                                <div class="modal-body">
                                  <form method="post">
                                    <input type="hidden" name="id_kegiatan_personal" value="<?= $bk->id_kegiatan_personal ?>">
                                    <div class="form-group">
                                      <label for="">Nama Kegiatan</label>
                                      <?php echo form_error('nama_kegiatan'); ?>
                                      <input type="text" class="form-control" name="nama_kegiatan" value="<?= $bk->nama_kegiatan ?>" placeholder="Enter text ...">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Tanggal Kegiatan</label>
                                        <?php echo form_error('tgl_kegiatan_mulai'); ?>
                                        <input type="text" id="datepicker" class="form-control" name="tgl_kegiatan_mulai" value="<?= $bk->tgl_kegiatan_mulai ?>" placeholder="YYYY-MM-DD">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="">Sampai Tanggal</label>
                                        <?php echo form_error('tgl_kegiatan_akhir'); ?>
                                        <input type="text" id="datepicker" class="form-control" name="tgl_kegiatan_akhir" value="<?= $bk->tgl_kegiatan_akhir ?>" placeholder="YYYY-MM-DD">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="">Deskripsi Kegiatan</label>
                                      <?php echo form_error('deskripsi'); ?>
                                      <textarea class="form-control" rows="15" name="deskripsi" placeholder="Enter text ..."><?= $bk->deskripsi ?></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="">Target Kegiatan</label>
                                      <?php echo form_error('target_kegiatan'); ?>
                                      <input type="text" class="form-control" name="target_kegiatan" value="<?= $bk->target_kegiatan ?>" placeholder="Enter text ...">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Verifikator Kegiatan</label>
                                      <?php echo form_error('id_verifikator'); ?>
                                      <select class="form-control" name="id_verifikator">
                                        <option value="<?= $bk->id_pegawai_verifikator ?>"><?= $bk->nama_lengkap ?></option>
                                        <?php foreach ($verifikator_kegiatan as $vk) : ?>
                                          <option value="<?= $vk['id_pegawai']; ?>"><?= $vk['nama_lengkap']; ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary waves-effect" name="update_kegiatan">Simpan</button>
                                  </div>
                                </form>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                          </div>
                          <!-- /.modal-dialog -->
                          <!-- modal update kegiatan -->
                          <div id="modalHapusKegiatan<?= $bk->id_kegiatan_personal ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <!-- modal-content -->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color:#6003c8">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="myModalLabel" style="color:white">Hapus Kegiatan</h4>
                                </div>
                                <div class="modal-body">
                                  <form method="post">
                                    <input type="hidden" name="id_kegiatan_personal" value="<?= $bk->id_kegiatan_personal ?>">
                                    <p> Apakah anda yakin ingin menghapus kegiatan ?? </p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger waves-effect" name="hapus_kegiatan">Hapus</button>
                                  </div>
                                </form>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="row">
                        <?php if ($bk->catatan_verifikator == NULL) : ?>
                          <div class="col-md-12">
                            <a href="#" class="btn btn-outline btn-success btn-block" data-toggle="modal" data-target="#modalKerjakan">Laporkan</a>
                          </div>
                          <!-- modal tambah kegiatan -->
                          <div id="modalKerjakan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <!-- modal-content -->
                              <div class="modal-content">
                                <div class="modal-header" style="background-color:#6003c8">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="myModalLabel" style="color:white">Laporan Kinerja Harian</h4>
                                </div>
                                <div class="modal-body">
                                  <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_kegiatan_personal" value="<?= $bk->id_kegiatan_personal ?>">
                                    <div class="form-group">
                                      <label for="">Tanggal Selesai Pekerjaan</label>
                                      <?php echo form_error('tgl_selesai_kegiatan'); ?>
                                      <input type="text" id="datepicker" class="form-control" name="tgl_selesai_kegiatan" value="<?= isset($bk->tgl_selesai_kegiatan) ? $bk->tgl_selesai_kegiatan : NULL ?>" placeholder="Pilih Tanggal Selesai Pekerjaan" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Uraian Aktifitas Kerja Harian</label>
                                      <?php echo form_error('uraian_aktifitas'); ?>
                                      <textarea class="textarea_editor form-control" rows="8" name="uraian_aktifitas" placeholder="Masukkan Uraian Aktifitas Kerja Harian"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="">Output / Hasil Pekerjaan</label>
                                      <?php echo form_error('deskripsi_hasil'); ?>
                                      <textarea class="textarea_editor form-control" rows="8" name="deskripsi_hasil" placeholder="Masukkan Deskripsi Hasil Pekerjaan"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="">Lampiran / Evidence</label>
                                      <small style="display: block">Apabila lampiran lebih dari 1 file, silahkan compress ke dalam bentuk <b>.zip</b> / <b>.rar</b></small>
                                      <?php echo form_error('lampiran'); ?>
                                      <input type="file" id="input-file-max-fs" name="lampiran" class="dropify" data-max-file-size="20M" />
                                      <input type="hidden" name="lampiran_lama" value="<?= $bk->lampiran ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Realisasi Anggaran yang dikeluarkan</label>
                                      <?php echo form_error(''); ?>
                                      <input type="text" class="form-control" name="" value="" placeholder="Realisasi anggaran yang dikeluarkan" autocomplete="off">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary waves-effect" name="kerjakan_pekerjaan">Simpan</button>
                                  </div>
                                </form>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                          </div>
                          <!-- /.modal-dialog -->
                          <?php else : ?>
                            <div class="col-md-12">
                              <a href="#" class="btn btn-outline btn-inverse btn-block" data-toggle="modal" data-target="#modalRevisi">Revisi</a>
                            </div>
                            <!-- modal revisi kegiatan -->
                            <div id="modalRevisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <!-- modal-content -->
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color:#6003c8">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel" style="color:white">Revisi Kegiatan</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                      <h4 class="alert-heading">Catatan !</h4>
                                      <p><?= $bk->catatan_verifikator ?></p>
                                    </div>
                                    <form method="post" enctype="multipart/form-data">
                                      <input type="hidden" name="id_kegiatan_personal" value="<?= $bk->id_kegiatan_personal ?>">
                                      <div class="form-group">
                                        <label for="">Deskripsi Hasil Pekerjaan</label>
                                        <?php echo form_error('deskripsi_hasil'); ?>
                                        <textarea class="form-control" rows="8" name="deskripsi_hasil" placeholder="Enter text ..."><?= $bk->deskripsi_hasil ?></textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="">Lampiran</label>
                                        <?php echo form_error('lampiran'); ?>
                                        <input type="file" id="input-file-max-fs" name="lampiran" class="dropify" data-max-file-size="2M" data-default-file="<?= base_url('data/kegiatan_personal/' . $bk->id_pegawai_input . '/' . $bk->lampiran); ?>" />
                                        <input type="hidden" name="lampiran_lama" value="<?= $bk->lampiran ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Tanggal Kegiatan</label>
                                        <?php echo form_error('tgl_selesai_kegiatan'); ?>
                                        <input type="text" id="datepicker" class="form-control" name="tgl_selesai_kegiatan" value="<?= isset($bk->tgl_selesai_kegiatan) ? $bk->tgl_selesai_kegiatan : NULL ?>" placeholder="YYYY-MM-DD">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Realisasi Anggaran yang dikeluarkan</label>
                                        <?php echo form_error(''); ?>
                                        <input type="text" class="form-control" name="" value="" placeholder="Realisasi anggaran yang dikeluarkan" autocomplete="off">
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                                      <button type="submit" class="btn btn-primary waves-effect" name="revisi_pekerjaan">Revisi</button>
                                    </div>
                                  </form>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                            </div>
                            <!-- /.modal-dialog -->
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
              <div class="col-md-4 b-l b-r p-b-20">
                <div class="box-title text-center bg-white m-b-15">
                  <label class="btn btn-warning" style="cursor:default !important; width: 100%">Pekerjaan Selesai</label>
                </div>
                <?php if ($menunggu_verifikasi == false) : ?>
                  <div class="alert alert-warning">
                    <p class="text-center">Belum Ada Pekerjaan yang Selesai</p>
                  </div>
                  <?php elseif ($menunggu_verifikasi == true) : ?>
                    <?php foreach ($menunggu_verifikasi as $mv) : ?>
                      <div class="col-md-12">
                        <div class="white-box">
                          <span class="label label-warning label-rounded pull-right">Menunggu Verifikasi</span>
                          <br>
                          <?php
                          if ($mv->id_kerja_luar_kantor) {
                            $lk = true;
                            $dlk = $this->kerja_luar_kantor_model->get_by_id_verifered($mv->id_kerja_luar_kantor);
                          } else {
                            $lk = false;
                          }
                          ?>

                          <?php
                          if ($lk) {
                            ?>
                            <h4 style="margin-bottom: 0px;margin-top:0px"><?php echo $mv->nama_kegiatan; ?></h4>
                            <small style="margin-bottom:10px;display: block">No. Surat Izin : <?= $dlk->nomer_surat ?></small>
                            <?php
                          } else {
                            ?>
                            <h4 style="margin-bottom: 10px"><?php echo $mv->nama_kegiatan; ?></h4>
                            <?php
                          }
                          ?>
                          <div class="col-md-5">
                            <i class="fa fa-calendar text-warning"></i> <small><?= tanggal($mv->tgl_kegiatan_mulai) ?></small>
                          </div>
                          <div class="col-md-5">
                            <i class="fa fa-calendar-check-o text-warning"></i> <small><?= tanggal($mv->tgl_selesai_kegiatan) ?></small>
                          </div>
                          <div class="col-md-2">
                          </div>
                          <br>
                          <br>
                          <div class="row">
                            <div class="col-md-12">
                              <a href="<?= base_url('kegiatan_personal/detail_kegiatan/' . $mv->id_pegawai_input . '/' . $mv->id_kegiatan_personal); ?>" class="btn btn-outline btn-warning btn-block">Detail Pekerjakan</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>

                  <?php endif; ?>

                </div>
                <div class="col-md-4 b-r p-b-20">
                  <div class="box-title text-center bg-white m-b-15">
                    <label class="btn btn-primary" style="cursor:default !important; width: 100%">Selesai Diverifikasi</label>
                  </div>
                  <?php if ($selesai_diverifikasi == false) : ?>
                    <div class="alert alert-primary">
                      <p class="text-center">Belum Ada Pekerjaan</p>
                    </div>
                    <?php elseif ($selesai_diverifikasi == true) : ?>
                      <?php foreach ($selesai_diverifikasi as $sd) : ?>
                        <div class="col-md-12">
                          <div class="white-box">
                            <span class="label label-primary label-rounded pull-right">Terverifikasi</span>
                            <br>
                            <?php
                            if ($sd->id_kerja_luar_kantor) {
                              $lk = true;
                              $dlk = $this->kerja_luar_kantor_model->get_by_id_verifered($sd->id_kerja_luar_kantor);
                            } else {
                              $lk = false;
                            }
                            ?>

                            <?php
                            if ($lk) {
                              ?>
                              <h4 style="margin-bottom: 0px;margin-top:0px"><?php echo $sd->nama_kegiatan; ?></h4>
                              <small style="margin-bottom:10px;display: block">No. Surat Izin : <?= $dlk->nomer_surat ?></small>
                              <?php
                            } else {
                              ?>
                              <h4 style="margin-bottom: 10px"><?php echo $sd->nama_kegiatan; ?></h4>
                              <?php
                            }
                            ?>

                            <div class="col-md-4">
                              <i class="fa fa-calendar text-primary"></i> <small><?= tanggal($sd->tgl_kegiatan_mulai) ?></small>
                            </div>
                            <div class="col-md-4">
                              <i class="fa fa-calendar-check-o text-primary"></i> <small><?= tanggal($sd->tgl_selesai_kegiatan) ?></small>
                            </div>
                            <div class="col-md-4">
                              <i class="fa fa-check-square-o text-primary"></i> <small><?= tanggal($sd->tgl_verifikasi) ?></small>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                              <div class="col-md-12">
                                <a href="<?= base_url('kegiatan_personal/detail_kegiatan/' . $sd->id_pegawai_input . '/' . $sd->id_kegiatan_personal); ?>" class="btn btn-outline btn-primary btn-block">Detail Pekerjakan</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    <?php endif; ?>

                  </div>
                <?php endif; ?>
                <div class="row">
                  <div class="col-md-12 pager">
                    <?php
                    if (!$filter) {
                      echo make_pagination($pages, $current);
                    }
                    ?>
                  </div>
                </div>


              </div>

              <script type="text/javascript">
                function getSasaran() {
                  var id = $('#id_unit_kerja').val();
                  $.post("<?= base_url('kegiatan/get_sasaran/') ?>" + id, {}, function(obj) {
                    $('#id_sasaran').html(obj);
                  });
                }

                function getIKU() {
                  var id = $('#id_unit_kerja').val();
                  var s = $('#id_sasaran').val();
                  var sid = s.split("_");
                  var jenis = sid[0];
                  var id_s = sid[1];

                  $.post("<?= base_url('kegiatan/get_iku/') ?>" + id_s + "/" + id + "/" + jenis, {}, function(obj) {
                    $('#id_iku').html(obj);
                  });
                }

                function getRenaksi() {
                  var id = $('#id_iku').val();

                  var s = $('#id_sasaran').val();
                  var sid = s.split("_");
                  var jenis = sid[0];

                  $.post("<?= base_url('kegiatan/get_renaksi_by_id_iku/') ?>" + id + "/" + jenis, {}, function(obj) {
                    $('#id_renaksi').html(obj);
                  });
                }

                function toggleIKU() {
                  var tIku = $('#tIKU').prop('checked');
                  if (tIku == true) {
                    $('#divIKU').show();
                  } else {
                    $('#divIKU').hide();
                  }
                }

                function toggleRKA() {
                  var tRKA = $('#tRKA').prop('checked');
                  if (tRKA == true) {
                    $('#divRKA').show();
                  } else {
                    $('#divRKA').hide();
                  }
                }

                function toggleSKP() {
                  var tSKP = $('#tSKP').prop('checked');
                  if (tSKP == true) {
                    $('#divSKP').show();
                  } else {
                    $('#divSKP').hide();
                  }
                }

                function toggleIKI() {
                  var tIKI = $('#tIKI').prop('checked');
                  if (tIKI == true) {
                    $('#divIKI').show();
                    $('[name="id_iki"]').attr("disabled",false);
                  } else {
                    $('#divIKI').hide();
                    $('[name="id_iki"]').attr("disabled",true);
                  }
                }

                function toggleInstruksi() {
                  var tInstruksi = $('#tInstruksi').prop('checked');
                  if (tInstruksi == true) {
                    $('#divInstruksi').show();
                  } else {
                    $('#divInstruksi').hide();
                  }
                }


                function toggleLokasi() {
                  var lokasi = $('#lokasi_pengerjaan').val();
                  if (lokasi == 'luar_kantor' || lokasi == 'rumah') {
                    $('#formRefIzin').show();
                  } else {
                    $('#formRefIzin').hide();
                  }
                }

                function getDetailIzin() {
                  var id_kerja_luar_kantor = $('[name="id_kerja_luar_kantor"]').val();
                  $('#loadingText').show();
                  $.getJSON("<?= base_url('kerja_luar_kantor/get_json') ?>" + id_kerja_luar_kantor, function(json) {

                    $('[name="nama_kegiatan"]').val(json.nama_kegiatan);
                    $('[name="tgl_kegiatan_mulai"]').val(json.tanggal_awal);
                    $('[name="tgl_kegiatan_akhir"]').val(json.tanggal_akhir);
                    $('[name="deskripsi"]').val(json.deskripsi_kegiatan);
                    $('[name="target_kegiatan"]').val(json.target_kegiatan);
                    $('[name="id_verifikator"]').val(json.id_pegawai_verifikator_kegiatan);
                    $('[name="nama_kegiatan"]').attr('readonly', 'readonly');
                    $('[name="tgl_kegiatan_mulai"]').attr('readonly', 'readonly');
                    $('[name="tgl_kegiatan_akhir"]').attr('readonly', 'readonly');
                    $('[name="deskripsi"]').attr('readonly', 'readonly');
                    $('[name="target_kegiatan"]').attr('readonly', 'readonly');
                    $('[name="id_verifikator"]').attr('readonly', 'readonly');
                    $('#loadingText').hide();
                  });
                }
              </script>


              <script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initMap() {


      var map = new google.maps.Map(document.getElementById('map'), {
        center: {
          lat: -6.838118799999999,
          lng: 107.9275324
        },
        zoom: 13
      });

      var infowindow = new google.maps.InfoWindow();
      var infowindowContent = document.getElementById('infowindow-content');
      infowindow.setContent(infowindowContent);
      var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
      });
      var geocoder = new google.maps.Geocoder();
      google.maps.event.addListener(map, 'click', function(event) {
        geocoder.geocode({
          'latLng': event.latLng
        }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
              $('#adr').val(results[0].formatted_address);
            }
          }
        });
        marker.setPosition(event.latLng);
        console.log(event.latLng.lat());
        console.log(event.latLng.lng());

        $('#lat').val(event.latLng.lat().toString());
        $('#long').val(event.latLng.lng().toString());
      });

      var input = document.getElementById('pac-input');


      var autocomplete = new google.maps.places.Autocomplete(input);

      // Bind the map's bounds (viewport) property to the autocomplete object,
      // so that the autocomplete requests use the current map bounds for the
      // bounds option in the request.
      autocomplete.bindTo('bounds', map);

      // Set the data fields to return when the user selects a place.
      autocomplete.setFields(
        ['address_components', 'geometry', 'icon', 'name']);

      autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          // User entered the name of a Place that was not suggested and
          // pressed the Enter key, or the Place Details request failed.
          window.alert("No details available for input: '" + place.name + "'");
          return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          map.setZoom(17); // Why 17? Because it looks good.
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
          address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
          ].join(' ');
        }

        infowindowContent.children['place-icon'].src = place.icon;
        infowindowContent.children['place-name'].textContent = place.name;
        infowindowContent.children['place-address'].textContent = address;
        infowindow.open(map, marker);
        console.log(place.geometry.location.lat() + ":" + place.geometry.location.lng());


      });




    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF-EKYJaTXFn5AsQudXlemdxuzApgTTjw&libraries=places&callback=initMap" async defer></script>