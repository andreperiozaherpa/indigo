<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Sasaran Kinerja Pegawai</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url(); ?>/skp_perencanaan">Sasaran Kinerja Pegawai</a></li>
        <li class="active">List</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
    <div class="white-box">
      <div class="user-bg"> <img width="100%" height="100%" alt="user" src="https://e-office.sumedangkab.go.id/data/images/header/header2.jpg">
        <div class="overlay-box">
          <div class="col-md-3">
            <div class="user-content"><img src="https://e-office.sumedangkab.go.id/data/foto/pegawai/<?= $pegawai->foto_pegawai ?>" class="thumb-lg img-circle" style=" object-fit: cover;
            width: 80px;
            height: 80px;border-radius: 50%;
            " alt="img">
            <h5 class="text-white"><b><?= $pegawai->nama_lengkap ?></b></h5>
            <h6 class="text-white"><?= $pegawai->nip ?></h6>
          </div>
        </div>
        <div class="col-md-3" style="border-right: 1px solid grey;border-left: 1px solid grey;">
          <br>
          <div class="user-content" style="padding-bottom:15px;">
            <h5 class="text-white"><b>SKPD</b></h5>
            <h6 class="text-white"><?= $pegawai->nama_skpd ?></h6>
          </div>
        </div>
        <div class="col-md-3" style="border-right: 1px solid grey;">
          <br>
          <div class="user-content" style="padding-bottom:15px;">
            <h5 class="text-white"><b>Unit Kerja</b></h5>
            <h6 class="text-white"><?= $pegawai->nama_unit_kerja ?></h6>
          </div>
        </div>
        <div class="col-md-3">
          <br>
          <div class="user-content" style="padding-bottom:15px;">
            <h5 class="text-white"><b>Jabatan</b></h5>
            <h6 class="text-white"><?= $pegawai->jabatan ?></h6>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<div class="row">

  <div class="white-box">
    <h3 class="box-title">DAFTAR SUB KEGIATAN TAHUN <?=$this->uri->segment(3)?> <a href="<?=base_url('skp_perencanaan/detail/'.$this->uri->segment(3))?>" class="btn btn-primary btn-outline pull-right" style="margin-right: -7px"><i class="fa fa-folder"></i> Rincian SKP Tahunan</a></h3>
  </div>

      <?php
      $bulan = array_bulan();
      foreach ($bulan as $a => $b) {
        $induk = $this->db->group_by('id_urtug')->get_where('iku_urtug_bulanan',array('id_pegawai_input' => $id_pegawai,'tahun' => $tahun,'bulan' => $a))->result();
          ?>
        <div class="white-box">
          <div class="row p-b-20" style="position: relative;">
            <i style="position:absolute;display:inline-block;font-size:15px;color:#fff;background-color:#6003c8;padding:17px;border-radius: 50% 0px 0px 50%;line-height: 18px" class="ti-target"></i>
            <div style="margin-left:48px;display:inline-block;border: solid 1px #E4E7EA;padding: 15px;width: 90%" id="skp_<?=$a?>">
              <span style="font-weight: 450;text-transform: uppercase;"><?= $b ?></span>
              <button class="btn btn-primary btn-sm btn-rounded pull-right" data-toggle="modal" data-target="#AddModal<?=$a?>" style="position: absolute; right: 120px; top: 11px"><i class="fa fa-plus"></i> Tambah Kegiatan</button>
              <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary dropdown-toggle pull-right" type="button" style="position: absolute; right: 0; top: 8.5px"><i class="fa fa-print"></i> Cetak SKP</button>
              <ul role="menu" class="dropdown-menu" style="right: 0; left: unset; top: 70%;">
                  <li><a href="<?=base_url('skp_perencanaan/cetak_bulanan/'.$this->uri->segment(3).'/'.$a)?>">Perencanaan</a></li>
                  <li><a href="<?=base_url('skp_perencanaan/cetak_bulanan/'.$this->uri->segment(3).'/'.$a.'/penilaian')?>">Penilaian</a></li>
              </ul>
            </div>
          </div>
          <?php
          $no = 1;
          if ($induk) {
            ?>

                <div class="table-responsive">
                  <table class="table color-table muted-table">
                      <?php
                      $n = 1;
                      foreach ($induk as $k) {
                        $i = $this->db->get_where('iku_urtug',array('id_urtug' => $k->id_urtug))->row();

                        $urtug = $this->db->get_where('iku_urtug_bulanan',array('id_pegawai_input' => $id_pegawai,'tahun' => $tahun,'bulan' => $a,'id_urtug' => $k->id_urtug))->result();
                        ?>
                    <thead>
                      <tr>
                        <th style="vertical-align: middle;text-align: center;width:71px">Indeks Capaian</th>
                        <th style="vertical-align: middle;text-align: center;width:50px">Kode</th>
                        <th style="vertical-align: middle;text-align: center;" colspan="2">Indikator Kegiatan</th>
                        <th style="vertical-align: middle;text-align: center;width:68px">Satuan</th>
                        <th style="vertical-align: middle;text-align: center;width:76px">Target</th>
                        <th style="vertical-align: middle;text-align: center;width:76px">Realisasi</th>
                        <th style="vertical-align: middle;text-align: center;width:100px">Waktu</th>
                        <th style="vertical-align: middle;text-align: center;width:100px">Biaya</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr id="iku_<?= $i->id_urtug ?>">
                          <td><span class="badge badge-warning" style="min-width:50px"><?=round($i->capaian,2)?></span></td>
                          <td class="text-center"><?= $n ?></td>
                          <td class="text-left" colspan="2"><?= $i->kegiatan_tugas_jabatan ?></td>
                          <td class="text-center"><?= convert_satuan($i->kuantitas_satuan) ?></td>
                          <td class="text-right"><?= $i->kuantitas_target ?></td>
                          <td class="text-right"><?= $i->kuantitas_realisasi ?></td>
                          <td class="text-center"><?= $i->waktu_target ?> <?= convert_satuan($i->waktu_satuan) ?></td>
                          <td class="text-right">Rp<?= number_format(round($i->biaya_target)) ?></td>
                        </tr>

                        <tr>
                          <td colspan="2">
                          </td>
                          <td class="" colspan="6"><h4 style="margin: 5px 0;">SUB KEGIATAN TUGAS JABATAN</h4></td>
                          <td>
                              <!-- <button type="button" class="btn btn-primary btn-block btn-sm"><i class="fa fa-print"></i> Cetak SKP</button> -->
                          </td>
                        </tr>

                        

                        <?php $nu=1; foreach ($urtug as $u): ?>
                        <tr id="urtug_<?= $u->id_urtug_bulanan ?>">
                          <td rowspan="5"><span class="badge badge-warning" style="min-width:50px"><?=round($u->capaian,2)?></span></td>
                          <td rowspan="5" class="text-center"><?= $n ?>.<?= $nu ?></td>
                          <td rowspan="5"><?= $u->kegiatan_tugas_jabatan ?></td>
                          <td class="text-right"><b>Kuantitas</b></td>
                          <td class="text-center"><?= convert_satuan($u->kuantitas_satuan) ?></td>
                          <td class="text-right"><?= $u->kuantitas_target ?></td>
                          <td class="text-right"><?= $u->kuantitas_realisasi ?></td>
                          <td rowspan="5" colspan="2">
                            <blockquote><?= $u->status_kegiatan ?></blockquote>
                            <form method="post" action="#urtug_<?= $u->id_urtug_bulanan ?>">
                              <input type="hidden" name="id_urtug_bulanan" value="<?=$u->id_urtug_bulanan?>">
                            <?php if ($u->status_kegiatan == "Perencanaan"): ?>
                              <button type="button" class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#EditModal<?=$u->id_urtug_bulanan?>"><i class="fa fa-pencil"></i> Ubah Target</button>
                              <button type="button" class="btn btn-primary btn-block btn-sm" onclick="simpan_perencanaan(<?=$u->id_urtug_bulanan?>)"><i class="fa fa-check"></i> Simpan Perencanaan</button>
                              <button type="button" class="btn btn-danger btn-block btn-sm" onclick="hapus_kegiatan(<?=$u->id_urtug_bulanan?>)"><i class="fa fa-trash"></i> Hapus Kegiatan</button>
                              <button type="submit" class="hidden" name="set" id="submit_set<?=$u->id_urtug_bulanan?>"></button>
                              <button type="submit" class="hidden" name="delete" id="submit_delete<?=$u->id_urtug_bulanan?>"></button>
                            <?php elseif ($u->status_kegiatan == "Realisasi"): ?>
                              <button type="button" class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#UpdateModal<?=$u->id_urtug_bulanan?>"><i class="fa fa-edit"></i> Update Realisasi</button>
                              <?php if ($u->kuantitas_realisasi!=''): ?>
                              <button type="button" class="btn btn-success btn-block btn-sm" onclick="simpan_skp(<?=$u->id_urtug_bulanan?>)"><i class="fa fa-location-arrow"></i> Simpan SKP</button>
                              <?php endif ?>
                              <button type="submit" class="hidden" name="save" id="submit_save<?=$u->id_urtug_bulanan?>"></button>
                            <?php elseif ($u->status_kegiatan == "Mutasi"): ?>
                              <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#AddModal<?=$i->$cIkuRenja?>"><i class="fa fa-refresh"></i> Ambil Alih Kegiatan</button>
                            <?php elseif ($u->status_kegiatan == "Selesai"): ?>
                            <?php else: ?>
                            <?php endif ?>
                            </form>
                            <?php if ($u->kuantitas_realisasi>0): ?>
                              <div class="white-box text-center" style="border: #ff6849 1px solid;border-radius: 50%;margin: 5%;">
                                <h1 class="counter"><?=round($u->capaian,2)?></h1>
                                <p class="text-muted"><?=strtoupper(konversi_nilai_skp($u->capaian))?></p>
                              </div>
                            <?php endif ?>
                          </td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Kualitas</b></td>
                          <td class="text-center"><?= convert_satuan($u->kualitas_satuan) ?></td>
                          <td class="text-right"><?= $u->kualitas_target ?></td>
                          <td class="text-right"><?= $u->kualitas_realisasi ?></td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Waktu</b></td>
                          <td class="text-center"><?= convert_satuan($u->waktu_satuan) ?></td>
                          <td class="text-right"><?= $u->waktu_target ?></td>
                          <td class="text-right"><?= $u->waktu_realisasi ?></td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Biaya</b></td>
                          <td class="text-center"><?= convert_satuan($u->biaya_satuan) ?></td>
                          <td class="text-right"><?= dot($u->biaya_target) ?></td>
                          <td class="text-right"><?= @dot($u->biaya_realisasi) ?></td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Tgl. Update</b></td>
                          <td></td>
                          <td class="text-right"><?= tgl_indo($u->tanggal_perencanaan) ?></td>
                          <td class="text-right"><?= @tgl_indo($u->tanggal_realisasi) ?></td>
                        </tr>

                        <div class="modal fade" id="EditModal<?=$u->id_urtug_bulanan?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Ubah SUB URTUG</h4>
                              </div>
                              <form method="post" action="#urtug_<?= $u->id_urtug_bulanan ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="id_urtug_bulanan" value="<?=$u->id_urtug_bulanan?>" required>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Sub Kegiatan Tugas Jabatan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control"><?= $u->kegiatan_tugas_jabatan ?></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $u->kuantitas_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target" value="<?= $u->kuantitas_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target" value="<?= $u->kualitas_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $u->waktu_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target" value="<?= $u->waktu_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target" value="<?= $u->biaya_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="edit" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="UpdateModal<?=$u->id_urtug_bulanan?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Update Realisasi</h4>
                              </div>
                              <form method="post" action="#urtug_<?= $u->id_urtug_bulanan ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="id_urtug_bulanan" value="<?=$u->id_urtug_bulanan?>" required>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Kegiatan Tugas Jabatan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control" readonly=""><?= $u->kegiatan_tugas_jabatan ?></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1" disabled="">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $u->kuantitas_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target" value="<?= $u->kuantitas_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="kuantitas_realisasi" value="<?= $u->kuantitas_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target" value="<?= $u->kualitas_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="kualitas_realisasi" value="<?= $u->kualitas_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1" disabled="">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $u->waktu_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target" value="<?= $u->waktu_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="waktu_realisasi" value="<?= $u->waktu_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target" value="<?= $u->biaya_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="biaya_realisasi" value="<?= $u->biaya_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <!-- <div class="form-group">
                                    <label for="recipient-name" class="control-label">Total Capaian</label>
                                    <div class="input-group m-t-10">
                                      <input type="number" name="capaian" class="form-control" step=".01" value="<?= $u->capaian ?>">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                  </div> -->
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="update" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <?php $nu++; endforeach ?>

                        <?php $n++;
                      } ?>
                    </tbody>
                  </table>
                </div>
              <?php $no++;
            }
            ?>
            
            </div>
                        <div class="modal fade" id="AddModal<?=$a?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Tambah SUB URTUG Bulan <?=$b?></h4>
                              </div>
                              <form method="post" action="#skp_<?=$a?>">
                                <div class="modal-body">
                                  <input type="hidden" name="bulan" value="<?=$a?>" required>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Kegiatan Tugas Jabatan</label>
                                    <select name="id_urtug" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1" required="">
                                      <option value="">-- PILIH --</option>
                                      <?php foreach ($iku_urtug as $row): ?>
                                        <option value="<?=$row->id_urtug?>"><?=$row->kegiatan_tugas_jabatan?> (Target: <?=$row->kuantitas_target?> <?=convert_satuan($row->kuantitas_satuan)?>)</option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Sub Kegiatan Tugas Jabatan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control"></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>"><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>"><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target" required="">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="insert" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
        <?php
          }
        
        ?>


      </div>

    </div>



    <script type="text/javascript">
      function simpan_perencanaan(id) {
        swal({   
            title: "Apakah sudah Yakin?",   
            text: "Setelah disimpan, Anda tidak dapat kembali ke perencanaan!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#6003c8",   
            confirmButtonText: "Ya, Simpan Perencanaan!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Berhasil!", "Perencanaan sudah disimpan.", "success"); 
            $('#submit_set'+id).click();
        });
      }

      function hapus_kegiatan(id) {
        swal({   
            title: "Apakah sudah Yakin?",   
            text: "Setelah dihapus, Data tidak dapat dikembalikan!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#f75b36",   
            confirmButtonText: "Ya, Hapus Kegiatan!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Berhasil!", "Perencanaan sudah dihapus.", "success"); 
            $('#submit_delete'+id).click();
        });
      }

      function hapus_sub(id) {
        swal({   
            title: "Apakah sudah Yakin?",   
            text: "Setelah dihapus, Data tidak dapat dikembalikan!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#f75b36",   
            confirmButtonText: "Ya, Hapus Sub Kegiatan!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Berhasil!", "Sub Kegiatan sudah dihapus.", "success"); 
            $('#submit_deletesub'+id).click();
        });
      }

      function remove_sub(id) {
        swal({   
            title: "Apakah sudah Yakin?",   
            text: "Setelah dihapus, Data Realisasi tidak dapat dikembalikan!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#f75b36",   
            confirmButtonText: "Ya, Hapus Casecading!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Berhasil!", "Casecading sudah dihapus.", "success"); 
            $('#submit_removesub'+id).click();
        });
      }

      function simpan_skp(id) {
        swal({   
            title: "Apakah sudah Yakin?",   
            text: "Setelah disimpan, Anda tidak dapat kembali ke realisasi!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#00c292",   
            confirmButtonText: "Ya, Simpan SKP!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Berhasil!", "SKP sudah disimpan.", "success"); 
            $('#submit_save'+id).click();
        });
      }
    </script>