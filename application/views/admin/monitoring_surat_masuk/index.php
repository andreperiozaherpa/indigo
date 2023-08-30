<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Monitoring Surat Masuk</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <?=breadcrumb($this->uri->segment_array()) ?>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <div class="row">
 		<div class="col-md-12">
 			<div class="white-box">
 				<div class="row">
 					<form method="POST">

            <div class="col-md-3">
            <div class="form-group">
              <label for="">No. Surat</label>
              <input type="text" class="form-control" name="nomer_surat" placeholder="Masukkan No Surat" value="<?=($filter) ? $filter_data['nomer_surat'] : ''?>">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="">Kode Reg Surat</label>
              <input type="text" class="form-control" name="nomer_surat" placeholder="Masukkan Kode Registrasi Surat" value="<?=($filter) ? $filter_data['hash_id'] : ''?>">
            </div>
          </div>
            <div class="col-md-3">
            <div class="form-group">
              <label for="">Nama Surat</label>
              <input type="text" class="form-control" name="perihal" placeholder="Masukkan Perihal" value="<?=($filter) ? $filter_data['perihal'] : ''?>">
            </div>
          </div>



                <div class="col-md-3 b-l text-center">
                  <div class="form-group">
                    <br>
                    <button type="submit" class="btn btn-primary m-t-5 btn-outline btn-block"> <i class="ti-filter"></i> Filter</button>
                  </div>
                </div>
 				</form>
 				</div>

 			</div>
 		</div>

 	</div>


  <div class="row">
    <br>
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-3 b-r p-b-20">
          <div class="col-md-12">
            <div class="box-title text-center bg-white">
              <label class="btn btn-outline btn-danger" style="cursor:default !important; width: 100%">Dibuat</label>
            </div>
          </div>
        </div>
        <div class="col-md-3 b-r p-b-20">
          <div class="col-md-12">
            <div class="box-title text-center bg-white">
              <label class="btn btn-outline btn-warning" style="cursor:default !important; width: 100%">Distribusi</label>
            </div>
          </div>
        </div>
        <div class="col-md-3 b-r p-b-20">
          <div class="col-md-12">
            <div class="box-title text-center bg-white">
              <label class="btn btn-outline btn-success" style="cursor:default !important; width: 100%">Diterima</label>
            </div>
          </div>
        </div>
        <div class="col-md-3 b-r p-b-20">
          <div class="col-md-12">
            <div class="box-title text-center bg-white">
              <label class="btn btn-outline btn-info" style="cursor:default !important; width: 100%">Disposisi</label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if (count($list) == 0): ?>
    <div class="col-md-12">
      <div class="col-md-12">
        <div class='alert alert-info'>Belum ada Surat</div>
      </div>
    </div>
    <?php else: ?>
      <?php foreach($list as $key => $l){
        // $id_verifikasi = explode(',', $l->id_verifikasi);
        if (!($l->foto_input)) {
          $l->foto_input = "user-default.png";
        }

        if (!($l->foto_penerima)) {
          $l->foto_penerima = "user-default.png";
        }

                ?>
    <div class="col-md-12">
      <div class="row">

        <div class="col-md-3 b-r ">
          <div class="col-md-12">
            <div class="white-box" style="height:330px;overflow:auto;cursor:pointer;<?=($l->pengirim == $this->session->userdata('nama_lengkap'))?'border : 1px double #6003c8;':''?>" onclick="<?=($l->pengirim == $this->session->userdata('nama_lengkap'))?'window.location=\''.base_url('surat_'.$l->jenis_surat.'/'.'detail_surat_masuk/'.$l->id_surat_masuk).'\'':'swal(\'Maaf..\', \'Anda tidak memiliki akses terhadap surat ini.\', \'error\'); '?>">
              <div class="row b-b " style="padding-bottom:15px;">
                <div class="col-md-8"><strong><?=$l->perihal?></strong></div>
                <div class="col-md-4"><span class="label label-<?=($l->jenis_surat=='internal')?'info':'success'?>"> <?=$l->jenis_surat?></span></div>
              </div>

              <div class="row b-b" style="padding-top:15px;padding-bottom: 15px;" >
                <div class="col-md-3">
                  <div class="user-img">
                    <img src="<?php echo base_url('data/foto/pegawai/'.$l->foto_input);?>" alt="user" class="img-circle" width="40px" style="height:40px;width:40px;object-fit:cover;border:3px solid white">
                    <span class="profile-status online pull-right"></span>
                  </div>
                </div>
                <div class="col-md-3-9">
                  <?php
                      echo $l->perihal;
                  ?>
                  <span class="well pull-right" style="padding: unset;"><?=$l->nomer_surat?></span>

                  </div>
              </div>

              <div class="row" style="padding-top:15px;padding-bottom: 15px;">

                <div class="col-md-6 b-r">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="fa fa-edit" style="font-size:20px;color:blue"></i>
                    </div>
                    <div class="col-md-9">
                      <?=$l->pengirim?> <br>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="fa fa-calendar-check-o" style="font-size:20px;color:blue"></i>
                    </div>
                    <div class="col-md-9">
                      <?=($l->tanggal_surat)?tanggal($l->tanggal_surat):""?>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-3 b-r">
          <div class="col-md-12">
            <div class="white-box" style="height:330px;overflow:auto;cursor:pointer;<?=($l->id_pegawai_input == $this->session->userdata('id_pegawai'))?'border : 1px double #6003c8;':''?>" onclick="<?=($l->id_pegawai_input == $this->session->userdata('id_pegawai'))?'window.location=\''.base_url('surat_'.$l->jenis_surat.'/'.'detail_surat_masuk/'.$l->id_surat_masuk).'\'':'swal(\'Maaf..\', \'Anda tidak memiliki akses terhadap surat ini.\', \'error\'); '?>">
              <div class="row b-b " style="padding-bottom:15px;">
                <div class="col-md-8"><strong><?=$l->perihal?></strong></div>
                <div class="col-md-4"><span class="label label-<?=($l->jenis_surat=='internal')?'info':'success'?>"> <?=$l->jenis_surat?></span></div>
              </div>

              <div class="row b-b" style="padding-top:15px;padding-bottom: 15px;" >
                <div class="col-md-3">
                  <div class="user-img">
                    <img src="<?php echo base_url('data/foto/pegawai/'.$l->foto_input);?>" alt="user" class="img-circle" width="40px" style="height:40px;width:40px;object-fit:cover;border:3px solid white">
                    <span class="profile-status online pull-right"></span>
                  </div>
                </div>
                <div class="col-md-3-9">

                  <?php
                      echo $l->perihal;
                  ?>
                  <span class="well pull-right" style="padding: unset;"><?=$l->nomer_surat?></span>

                  </div>
              </div>

              <div class="row" style="padding-top:15px;padding-bottom: 15px;">

                <div class="col-md-6 b-r">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="fa fa-edit" style="font-size:20px;color:blue"></i><br/>
                    </div>
                    <div class="col-md-9">
                      <?=$l->nama_lengkap_input?> <br>
                      <?=$l->nip_input?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="fa fa-calendar-check-o" style="font-size:20px;color:blue"></i>
                    </div>
                    <div class="col-md-9">
                      <?=($l->tgl_input)?tanggal($l->tgl_input):""?>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>


        <div class="col-md-3 b-r">
          <div class="col-md-12">
            <div class="white-box" style="height:330px;overflow:auto;cursor:pointer;<?=($l->id_pegawai_penerima == $this->session->userdata('id_pegawai'))?'border : 1px double #6003c8;':''?>" onclick="<?=($l->id_pegawai_penerima == $this->session->userdata('id_pegawai'))?'window.location=\''.base_url('surat_'.$l->jenis_surat.'/'.'detail_surat_masuk/'.$l->id_surat_masuk).'\'':'swal(\'Maaf..\', \'Anda tidak memiliki akses terhadap surat ini.\', \'error\'); '?>">
              <div class="row b-b " style="padding-bottom:15px;">
                <div class="col-md-8"><strong><?=$l->perihal?></strong></div>
                <div class="col-md-4"><span class="label label-<?=($l->jenis_surat=='internal')?'info':'success'?>"> <?=$l->jenis_surat?></span></div>
              </div>

              <div class="row b-b" style="padding-top:15px;padding-bottom: 15px;" >
                <div class="col-md-3">
                  <div class="user-img">
                    <img src="<?php echo base_url('data/foto/pegawai/'.$l->foto_penerima);?>" alt="user" class="img-circle" width="40px" style="height:40px;width:40px;object-fit:cover;border:3px solid white">
                    <span class="profile-status online pull-right"></span>
                  </div>
                </div>
                <div class="col-md-3-9">


                  <?php
                      echo $l->perihal;
                  ?>
                  <span class="well pull-right" style="padding: unset;"><?=$l->nomer_surat?></span>

                </div>
              </div>

              <div class="row" style="padding-top:15px;padding-bottom: 15px;">

                <div class="col-md-6 b-r">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="fa fa-edit" style="font-size:20px;color:blue"></i>
                    </div>
                    <div class="col-md-9">
                      <?=$l->nama_lengkap_penerima?> <br>
                      <?=$l->nip_penerima?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="<?=($l->tgl_dibaca)?'fa fa-calendar-check-o':'fa fa-calendar-minus-o'?>" style="font-size:20px;color:<?=($l->tgl_dibaca)?'blue':'green'?>"></i>
                    </div>
                    <div class="col-md-9">
                      <?=($l->tgl_dibaca)?tanggal($l->tgl_dibaca):"Belum dibaca"?>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
        <div class="col-md-3 b-r">
          <div class="col-md-12 <?=($detail_disposisi[$key])?'':'fade'?>">
            <?php
              $highlight = false;
              $s_d = false;
              $s_dp = false;
              $s_du = false;
              $s_ds = false;
              $link_disposisi = "";

              if (isset($detail_disposisi[$key])) {
              	$s_d = array_search($this->session->userdata('id_pegawai'), array_column($detail_disposisi[$key], 'id_pegawai'));
                if ($s_d !== false) {
                  $highlight = true;
                  $link_disposisi = 'surat_'.$l->jenis_surat.'/'.'detail_surat_masuk/'.$l->id_surat_masuk;
                  // var_dump($detail_disposisi[$key]);
                }
              }
              if (isset($detail_disposisi_penerima[$key])) {
                foreach ($detail_disposisi[$key] as $key2 => $row){
                  // echo "<pre>".print_r($detail_disposisi_penerima[$key][$key2])."</pre>";
                  // echo $detail_disposisi_penerima[$key][$key2][0]->nama_lengkap;
                  $s_dp = array_search($this->session->userdata('id_pegawai'), array_column($detail_disposisi_penerima[$key][$key2], 'id_pegawai'));
                  $s_du = array_search($this->session->userdata('id_unit_kerja'), array_column($detail_disposisi_penerima[$key][$key2], 'id_unit_kerja'));
                  $s_ds = array_search($this->session->userdata('id_skpd'), array_column($detail_disposisi_penerima[$key][$key2], 'id_skpd'));

                  if ($s_dp !== false) {
                    $highlight = true;
                  	$link_disposisi = 'surat_disposisi/detail/'.$detail_disposisi_penerima[$key][$key2][$s_dp]->id_disposisi_masuk;
                  	break;
                  } elseif ($s_du !== false AND $detail_disposisi_penerima[$key][$key2][$s_du]->id_pegawai == '0') {
                    $highlight = true;
                  	$link_disposisi = 'surat_disposisi/detail/'.$detail_disposisi_penerima[$key][$key2][$s_du]->id_disposisi_masuk;
                  	break;
                  } elseif ($s_ds !== false AND $detail_disposisi_penerima[$key][$key2][$s_ds]->id_pegawai == '0' AND $detail_disposisi_penerima[$key][$key2][$s_ds]->id_unit_kerja == '0') {
                    $highlight = true;
                  	$link_disposisi = 'surat_disposisi/detail/'.$detail_disposisi_penerima[$key][$key2][$s_ds]->id_disposisi_masuk;
                  	break;
                  }
                }

              }
            ?>
            <div class="white-box" style="height:330px;overflow:auto;cursor:pointer;<?=($highlight)?'border : 1px double #6003c8;':''?>" onclick="<?=($highlight)?'window.location=\''.base_url($link_disposisi).'\'':'swal(\'Maaf..\', \'Anda tidak memiliki akses terhadap surat ini.\', \'error\'); '?>">
              <div class="row b-b " style="padding-bottom:15px;">
                <div class="col-md-8"><strong><?=$l->perihal?></strong></div>
                <div class="col-md-4"><span class="label label-<?=($l->jenis_surat=='internal')?'info':'success'?>"> <?=$l->jenis_surat?></span></div>
              </div>

              <div class="row b-b" style="padding-top:15px;" >
                <div class="col-md-3">
                  <div class="user-img">
                    <img src="<?php echo base_url('data/foto/pegawai/'.$l->foto_penerima);?>" alt="user" class="img-circle" width="40px" style="height:40px;width:40px;object-fit:cover;border:3px solid white">
                    <span class="profile-status online pull-right"></span>
                  </div>
                </div>
                <div class="col-md-3-9">

                  <?php
                      echo $l->perihal;
                  ?>
                  <span class="well pull-right" style="padding: unset;"><?=$l->nomer_surat?></span>
                  <div class="col-md-12 text-center">
                    <div class="row">
                      <h3 class="box-title">Didisposisikan oleh</h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row" style="padding-bottom: 15px;">
                <?php foreach ($detail_disposisi[$key] as $key2 => $d):?>
                <div class="col-md-12">
                  <div class="row text-center p-t-20">
                    <span class="mytooltip tooltip-effect-1">
                      <span class="tooltip-item2"><?=$d->nama_lengkap?></span>
                      <span class="tooltip-content4 clearfix">
                        <span class="tooltip-text2">
                          <?php foreach ($detail_disposisi_penerima[$key][$key2] as $key3 => $row): $row->foto_pegawai = ($row->foto_pegawai=='') ? 'user-default.png' : $row->foto_pegawai;?>
                            <?php if ($row->id_pegawai>0): ?>
                              <div class="col-md-12 m-t-5" id="selected-disposisi-internal-<?=$key3?>-<?=$row->id_pegawai?>" style="margin-bottom:10px;border: solid 1px #6003c8;text-align: left !important;padding:4px">
                                <div class="col-md-4">
                                  <img src="<?=base_url('data/foto/pegawai/'.$row->foto_pegawai)?>" alt="user" class="img-circle img-responsive" style="height:50px;width:50px;object-fit:cover;">
                                </div>
                                <div class="col-md-8">
                                  <small style="display: block" class="text-purple"> <?=$row->nama_lengkap?> <span class="label label-rouded label-primary"><?=strtoupper($row->jenis_pegawai)?></span></small>
                                  <small style="display: block" class="text-muted"> <?=$row->nama_jabatan?></small>
                                  <?php if ($row->tgl_terima): ?>
                                    <span class="well well-success" style="padding: unset;"><?=$row->tgl_terima?></span>
                                  <?php endif ?>
                                </div>
                              </div>
                            <?php elseif ($row->id_unit_kerja>0): ?>
                              <div class="col-md-12 m-t-5" id="selected-disposisi-internal-<?=$key3?>-<?=$row->id_pegawai?>" style="margin-bottom:10px;border: solid 1px #6003c8;text-align: left !important;padding:4px">
                                <small style="display: block"><i data-icon="&#xe030;" style="color: #5D03C1" class="linea-icon linea-aerrow fa-fw"></i>Unit Kerja <?=$row->nama_unit_kerja?> (<?=$row->nama_skpd?>)</small>
                                <?php if ($row->tgl_terima): ?>
                                  <span class="well well-success" style="padding: unset;"><?=$row->tgl_terima?></span>
                                <?php endif ?>
                              </div>
                            <?php else: ?>
                              <div class="col-md-12 m-t-5" id="selected-disposisi-internal-<?=$key3?>-<?=$row->id_pegawai?>" style="margin-bottom:10px;border: solid 1px #6003c8;text-align: left !important;padding:4px">
                                <small style="display: block"><i data-icon="&#xe030;" style="color: #5D03C1" class="linea-icon linea-aerrow fa-fw"></i>Kepala <?=$row->nama_skpd?></small>
                                <?php if ($row->tgl_terima): ?>
                                  <span class="well well-success" style="padding: unset;"><?=$row->tgl_terima?></span>
                                <?php endif ?>
                              </div>
                            <?php endif ?>
                          <?php endforeach ?>
                        </span>
                      </span>
                    </span>
                  </div>
                </div>
                <?php endforeach ?>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
      <?php } ?>
          <div class="row">
            <div class="col-md-12 pager">
              <?php
              if(!$filter){
                echo make_pagination($pages,$current);
              }
              ?>
            </div>
          </div>
    <?php endif ?>


  </div>
  <!-- end row -->
</div>
