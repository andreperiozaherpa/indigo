<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Monitoring Surat Keluar</h4>
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
              <label for="">No. Reg. Sistem</label>
              <input type="text" class="form-control" name="hash_id" value="<?=($filter) ? $filter_data['hash_id'] : ''?>">
            </div>
          </div>

            <div class="col-md-3">
            <div class="form-group">
              <label for="">Nama Surat</label>
              <input type="text" class="form-control" name="perihal" value="<?=($filter) ? $filter_data['perihal'] : ''?>">
            </div>
          </div>



 					<div class="col-md-3">
 						<div class="form-group">
 							<label for="">Jenis Surat</label>
 							<select name="id_ref_surat" class="form-control">
 								<option value="">Pilih Jenis Surat</option>
                <?php foreach ($ref_surat as $row): ?>
                  <option value="<?=$row->id_ref_surat?>" <?=(isset($filter_data) AND $filter_data['id_ref_surat']==$row->id_ref_surat) ? 'selected' : ''?>>(<?=$row->jenis_surat?>) <?=$row->nama_surat?></option>
                <?php endforeach ?>
              </select>
 						</div>
 					</div>

                <div class="col-md-3 b-l text-center">
                  <div class="form-group">
                    <br>
                    <button type="submit" class="btn btn-primary m-t-5 btn-outline btn-block"><i class="ti-filter"></i> Filter</button>
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
              <label class="btn btn-outline btn-danger" style="cursor:default !important; width: 100%">Maker</label>
            </div>
          </div>
        </div>
        <div class="col-md-3 b-r p-b-20">
          <div class="col-md-12">
            <div class="box-title text-center bg-white">
              <label class="btn btn-outline btn-warning" style="cursor:default !important; width: 100%">Checker</label>
            </div>
          </div>
        </div>
        <div class="col-md-3 b-r p-b-20">
          <div class="col-md-12">
            <div class="box-title text-center bg-white">
              <label class="btn btn-outline btn-success" style="cursor:default !important; width: 100%">Register</label>
            </div>
          </div>
        </div>
        <div class="col-md-3 b-r p-b-20">
          <div class="col-md-12">
            <div class="box-title text-center bg-white">
              <label class="btn btn-outline btn-info" style="cursor:default !important; width: 100%">Signer</label>
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
        $id_verifikasi = explode(',', $l->id_verifikasi);
        if (!($l->foto_input)) {
          $l->foto_input = "user-default.png";
        }

        if (!($l->foto_verifikasi)) {
          $l->foto_verifikasi = "user-default.png";
        }

        if (!($l->foto_ttd)) {
          $l->foto_ttd = "user-default.png";
        }

        if (!($l->foto_register)) {
          $l->foto_register = "user-default.png";
        }

        switch ($l->status_verifikasi) {
          case 'sudah_diverifikasi':
            $status_verifikasi = "fa fa-calendar-check-o";
            $teks_verifikasi = "Diverifikasi";
            $color_verifikasi = "blue";
            break;

          case 'ditolak':
            $status_verifikasi = "fa fa-calendar-times-o";
            $teks_verifikasi = "Ditolak";
            $color_verifikasi = "red";
            break;

          default:
            $status_verifikasi = "fa fa-calendar-minus-o";
            $teks_verifikasi = "Belum Diverifikasi";
            $color_verifikasi = "green";
            break;
        }

        switch ($l->status_ttd) {
          case 'sudah_ditandatangani':
            $status_ttd = "fa fa-calendar-check-o";
            $teks_ttd = "Ditandatangani";
            $color_ttd = "blue";
            break;

          case 'ditolak':
            $status_ttd = "fa fa-calendar-times-o";
            $teks_ttd = "Ditolak";
            $color_ttd = "red";
            break;

          default:
            $status_ttd = "fa fa-calendar-minus-o";
            $teks_ttd = "Belum Ditandatangani";
            $color_ttd = "green";
            break;
        }

        switch ($l->status_penomoran) {
          case 'Y':
            $status_register = "fa fa-calendar-check-o";
            $teks_register = "Diregister Nomor";
            $color_register = "blue";
            break;

          case 'N': default:
            $status_register = "fa fa-calendar-minus-o";
            $teks_register = "Belum Diregistrasi";
            $color_register = "green";
            break;
        }

        switch ($l->status_register) {
          case 'Sudah Diregistrasi': case 'sudah diregistrasi':
            $status_register = "fa fa-calendar-check-o";
            $teks_register = "Diregister";
            $color_register = "blue";
            break;

          case 'Ditolak': case 'ditolak':
            $status_register = "fa fa-calendar-times-o";
            $teks_register = "Ditolak";
            $color_register = "red";
            break;
        }


                $penerima = $this->surat_keluar_model->get_penerima($l->id_surat_keluar);
                if($l->status_surat == 'Sudah Dibaca'){
                  $label_status = "primary";
                }elseif ($l->status_surat == 'Belum Dibaca') {
                  $label_status = "danger";
                }elseif ($l->status_surat == "Perlu Tanggapan") {
                  $label_status = "warning";
                };
                ?>
    <div class="col-md-12">
      <div class="row">

        <div class="col-md-3 b-r ">
          <div class="col-md-12">
            <div class="white-box" style="height:330px;overflow:auto;cursor:pointer;<?=($l->id_pegawai_input == $this->session->userdata('id_pegawai'))?'border : 1px double #6003c8;':''?>" onclick="<?=($l->id_pegawai_input == $this->session->userdata('id_pegawai'))?'window.location=\''.base_url('surat_'.$l->jenis_surat.'/'.'detail_surat_keluar/'.$l->id_surat_keluar).'\'':'swal(\'Maaf..\', \'Anda tidak memiliki akses terhadap surat ini.\', \'error\'); '?>">
              <div class="row b-b " style="padding-bottom:15px;">
                <div class="col-md-8"><strong><?=$l->nama_surat?></strong></div>
                <div class="col-md-4"><span class="label label-<?=($l->jenis_surat=='internal')?'info':'success'?>"> <?=$l->jenis_surat?></span></div>
              </div>

              <div class="row b-b" style="padding-top:15px;padding-bottom: 15px;" >
                <div class="col-md-3">
                  <div class="user-img">
                    <img src="<?php echo base_url('data/foto/pegawai/'.$l->foto_input);?>" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                    <span class="profile-status online pull-right"></span>
                  </div>
                </div>
                <div class="col-md-3-9">
                  <?php
                    if($l->id_pegawai_input == $this->session->userdata('id_pegawai')){
                      echo '<a href="'.base_url('surat_'.$l->jenis_surat.'/'.'detail_surat_keluar/'.$l->id_surat_keluar).'">'.$l->perihal.'</a>';
                    }else{
                      echo $l->perihal;
                    }
                  ?>
                  <span class="well pull-right" style="padding: unset;"><?=$l->hash_id?></span>

                  </div>
              </div>

              <div class="row" style="padding-top:15px;padding-bottom: 15px;">

                <div class="col-md-6 b-r">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="fa fa-edit" style="font-size:20px;color:blue"></i>
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
                      Dibuat <br>
                      <?=($l->tgl_buat)?tanggal($l->tgl_buat):""?>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-3 b-r">
          <div class="col-md-12">
            <div class="white-box" style="height:330px;overflow:auto;cursor:pointer;<?=($l->id_pegawai_verifikasi == $this->session->userdata('id_pegawai') OR in_array($this->session->userdata('id_pegawai'), $id_verifikasi))?'border : 1px double #6003c8;':''?>" onclick="<?=($l->id_pegawai_verifikasi == $this->session->userdata('id_pegawai') OR in_array($this->session->userdata('id_pegawai'), $id_verifikasi))?'window.location=\''.base_url('surat_'.$l->jenis_surat.'/'.'verifikasi_surat_detail/'.$l->id_surat_keluar).'\'':'swal(\'Maaf..\', \'Anda tidak memiliki akses terhadap surat ini.\', \'error\'); '?>">
              <div class="row b-b " style="padding-bottom:15px;">
                <div class="col-md-8"><strong><?=$l->nama_surat?></strong></div>
                <div class="col-md-4"><span class="label label-<?=($l->jenis_surat=='internal')?'info':'success'?>"> <?=$l->jenis_surat?></span></div>
              </div>

              <div class="row b-b" style="padding-top:15px;padding-bottom: 15px;" >
                <div class="col-md-3">
                  <div class="user-img">
                    <img src="<?php echo base_url('data/foto/pegawai/'.$l->foto_verifikasi);?>" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                    <span class="profile-status online pull-right"></span>
                  </div>
                </div>
                <div class="col-md-3-9">

                  <?php
                    if(($l->id_pegawai_verifikasi == $this->session->userdata('id_pegawai') OR in_array($this->session->userdata('id_pegawai'), $id_verifikasi))){
                      echo '<a href="'.base_url('surat_'.$l->jenis_surat.'/'.'verifikasi_surat_detail/'.$l->id_surat_keluar).'">'.$l->perihal.'</a>';
                    }else{
                      echo $l->perihal;
                    }
                  ?>
                  <span class="well pull-right" style="padding: unset;"><?=$l->hash_id?></span>

                  </div>
              </div>

              <div class="row" style="padding-top:15px;padding-bottom: 15px;">

                <div class="col-md-6 b-r">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="fa fa-edit" style="font-size:20px;color:blue"></i><br/>
                    </div>
                    <div class="col-md-9">
                      <?=$l->nama_lengkap_verifikasi?> <br>
                      <?=$l->nip_verifikasi?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="<?=$status_verifikasi?>" style="font-size:20px;color:<?=$color_verifikasi?>"></i>
                    </div>
                    <div class="col-md-9">
                      <?=$teks_verifikasi?> <br>
                      <?=($l->tgl_verifikasi)?tanggal($l->tgl_verifikasi):""?>
                    </div>
                  </div>
                </div>
                <?php if ($detail_verifikasi[$key]): ?>
                <div class="col-md-12">
                  <div class="row text-center p-t-20">
                      <span class="mytooltip tooltip-effect-1">
                        <span class="tooltip-item2">Disetujui juga oleh</span>
                        <span class="tooltip-content4 clearfix">
                          <span class="tooltip-text2">
                            <?php foreach ($detail_verifikasi[$key] as $key2 => $row): $row->foto_pegawai = ($row->foto_pegawai=='') ? 'user-default.png' : $row->foto_pegawai;?>
                                <div class="col-md-12 m-t-5" id="selected-disposisi-internal-<?=$key2?>-<?=$row->id_pegawai?>" style="margin-bottom:10px;border: solid 1px #6003c8;text-align: left !important;padding:4px">
                                  <div class="col-md-4">
                                    <img src="<?=base_url('data/foto/pegawai/'.$row->foto_pegawai)?>" alt="user" class="img-circle img-responsive" style="max-height: 75px;">
                                  </div>
                                  <div class="col-md-8">
                                    <small style="display: block" class="text-purple"> <?=$row->nama_lengkap?> <span class="label label-rouded label-primary"><?=strtoupper($row->jenis_pegawai)?></span></small>
                                    <small style="display: block" class="text-muted"> <?=$row->nama_jabatan?></small>
                                    <span class="well well-success" style="padding: unset;"><?=$row->tgl_verifikasi?></span>
                                  </div>
                                </div>
                            <?php endforeach ?>
                          </span>
                        </span>
                      </span>
                    </div>
                </div>

                <?php endif ?>
              </div>

            </div>
          </div>
        </div>


        <div class="col-md-3 b-r">
          <div class="col-md-12 <?=($l->status_verifikasi=='sudah_diverifikasi')?'':'fade'?>" style="<?=($l->status_ttd=='sudah_ditandatangani')?'cursor:pointer;':'cursor:default;'?>">
            <div class="white-box" style="height:330px;overflow:auto;<?=($l->id_pegawai_register == $this->session->userdata('id_pegawai'))?'border : 1px double #6003c8;':''?>" onclick="<?=($l->id_pegawai_register == $this->session->userdata('id_pegawai'))?'window.location=\''.base_url('penomoran_surat/detail/'.$l->id_surat_keluar).'\'':'swal(\'Maaf..\', \'Anda tidak memiliki akses terhadap surat ini.\', \'error\'); '?>">
              <div class="row b-b " style="padding-bottom:15px;">
                <div class="col-md-8"><strong><?=$l->nama_surat?></strong></div>
                <div class="col-md-4"><span class="label label-<?=($l->jenis_surat=='internal')?'info':'success'?>"> <?=$l->jenis_surat?></span></div>
              </div>

              <div class="row b-b" style="padding-top:15px;padding-bottom: 15px;" >
                <div class="col-md-3">
                  <div class="user-img">
                    <img src="<?php echo base_url('data/foto/pegawai/'.$l->foto_register);?>" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                    <span class="profile-status online pull-right"></span>
                  </div>
                </div>
                <div class="col-md-3-9">


                  <?php
                    if(($l->id_pegawai_register == $this->session->userdata('id_pegawai'))){
                      echo '<a href="'.base_url('penomoran_surat/detail/'.$l->id_surat_keluar).'">'.$l->perihal.'</a>';
                    }else{
                      echo $l->perihal;
                    }
                  ?>
                  <span class="well pull-right" style="padding: unset;"><?=$l->hash_id?></span>

                </div>
              </div>

              <div class="row" style="padding-top:15px;padding-bottom: 15px;">

                <div class="col-md-6 b-r">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="fa fa-edit" style="font-size:20px;color:blue"></i>
                    </div>
                    <div class="col-md-9">
                      <?=$l->nama_lengkap_register?> <br>
                      <?=$l->nip_register?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="<?=$status_register?>" style="font-size:20px;color:<?=$color_register?>"></i>
                    </div>
                    <div class="col-md-9">
                      <?=$teks_register?> <br>
                      <?=($l->tgl_register)?tanggal($l->tgl_register):""?>
                    </div>
                    <div class="col-md-12"><hr style="margin:0;" />
                      <?=($l->status_penomoran=="Y")?$l->nomer_surat:""?>
                  	</div>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
        <div class="col-md-3 b-r">
          <div class="col-md-12 <?=($l->status_penomoran=='Y')?'':'fade'?>" style="<?=($l->status_verifikasi=='sudah_diverifikasi')?'cursor:pointer;':'cursor:default;'?>">
            <div class="white-box" style="height:330px;overflow:auto;<?=($l->id_pegawai_ttd == $this->session->userdata('id_pegawai'))?'border : 1px double #6003c8;':''?>" onclick="<?=($l->id_pegawai_ttd == $this->session->userdata('id_pegawai'))?'window.location=\''.base_url('surat_'.$l->jenis_surat.'/tanda_tangan_detail/'.$l->id_surat_keluar).'\'':'swal(\'Maaf..\', \'Anda tidak memiliki akses terhadap surat ini.\', \'error\'); '?>">
              <div class="row b-b " style="padding-bottom:15px;">
                <div class="col-md-8"><strong><?=$l->nama_surat?></strong></div>
                <div class="col-md-4"><span class="label label-<?=($l->jenis_surat=='internal')?'info':'success'?>"> <?=$l->jenis_surat?></span></div>
              </div>

              <div class="row b-b" style="padding-top:15px;padding-bottom: 15px;" >
                <div class="col-md-3">
                  <div class="user-img">
                    <img src="<?php echo base_url('data/foto/pegawai/'.$l->foto_ttd);?>" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                    <span class="profile-status online pull-right"></span>
                  </div>
                </div>
                <div class="col-md-3-9">

                  <?php
                    if(($l->id_pegawai_ttd == $this->session->userdata('id_pegawai'))){
                      echo '<a href="'.base_url('surat_'.$l->jenis_surat.'/tanda_tangan_detail/'.$l->id_surat_keluar).'">'.$l->perihal.'</a>';
                    }else{
                      echo $l->perihal;
                    }
                  ?>
                  <span class="well pull-right" style="padding: unset;"><?=$l->hash_id?></span>
                </div>
              </div>

              <div class="row" style="padding-top:15px;padding-bottom: 15px;">

                <div class="col-md-6 b-r">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="fa fa-edit" style="font-size:20px;color:blue"></i>
                    </div>
                    <div class="col-md-9">
                      <?=$l->nama_lengkap_ttd?> <br>
                      <?=$l->nip_ttd?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-3">
                      <i class="<?=$status_ttd?>"" style="font-size:20px;color:<?=$color_ttd?>"></i>
                    </div>
                    <div class="col-md-9">
                      <?=$teks_ttd?> <br>
                      <?=($l->tgl_ttd)?tanggal($l->tgl_ttd):""?>
                    </div>
                  </div>
                </div>
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
