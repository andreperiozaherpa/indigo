<div class="container-fluid">
<!-- Begin Container Fluid -->

            <?php
			if (isset($messages)) {
			?>
				<div class="alert alert-<?= $type ?>"><?= $messages ?></div>
			<?php } ?>
			<div class="alert alert-primary">
				<i class="ti-alert" style="color: #fff"></i> Kolom yang bertanda (<span class="text-danger"><b>*</b></span>)
				<b>wajib</b> diisi.
			</div>

    <!-- begin title -->
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Daftar Berkas Inaktif</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    
            <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Daftar Berkas Inaktif</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- end title -->

    <!-- begin search -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">

                    <form method="POST">

                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                <!--<div class="col-md-<-?=$user_level=='Administrator' ? 3 : 6?>">-->
                                    <div class="form-group">
                                        <label class="control-label">Nama Berkas</label>
                                        <input type="text" id="" name="perihal" placeholder="Masukkan Perihal Surat" class="form-control" placeholder="" value=""> <!-- isi value : <-?=($filter) ? $filter_data['perihal'] : ''?> -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Klasifikasi Berkas</label>
                                        <input type="text" id="" name="hash_id" placeholder="Masukkan No. Registrasi Sistem" class="form-control" placeholder="" value=""><!-- isi value : <-?=($filter) ? $filter_data['hash_id'] : ''?>-->
                                    </div>
                                </div>
                           	<div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Penyusutan Akhir</label>
                                        <input type="text" id="" name="hash_id" placeholder="Masukkan Penyusutan Akhir" class="form-control" placeholder="" value=""><!-- isi value : <-?=($filter) ? $filter_data['hash_id'] : ''?>-->
                                    </div>
                                </div>

                                <!--div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tgl. Pembuatan Berkas</label>
                                        <input type="text" class="form-control" name="tgl_buat" id="datepicker" placeholder="Pilih Tanggal Penerimaan" value=""> <!-- isi value : <-?=($filter) ? $filter_data['tgl_buat'] : ''?> 
                                    </div>
                                </div> -->
                                <?php 
                                    if($user_level=='Administrator'){
                                ?>                            
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">SKPD Pembuat</label>
                                        <select name="id_skpd_pengirim" class="form-control select2">
                                            <option value="">Semua SKPD</option>
                                            <!--
                                            <-?php 
                                                foreach($skpd as $k){
                                                    $selected = $filter && $filter_data['id_skpd_pengirim'] == $k->id_skpd ? ' selected' : null;
                                                    echo '<option value="'.$k->id_skpd.'"'.$selected.'>'.$k->nama_skpd.'</option>';
                                                }
                                            ?>
                                            -->
                                        </select>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-2 b-l text-center">
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
    <!-- Note : 
    1. Tujuan ketika submit
    2. Value objek input
    -->
    <!-- end search -->

    <div class="col-md-4">
			
				<div style="height: 120px;display: table-cell;vertical-align: middle;width: 999px">
					<a href="<?php echo base_url('arsip_dinamis/berkas_inaktif/musnah');?>" style="font-size: 15px;" class="btn btn-lg btn-rounded btn-primary btn-block"><span class="btn-label"><i data-icon="&#xe003;" class="linea-icon linea-elaborate"></i></span>Musnah</a>
				</div> 
				<div style="height: 120px;display: table-cell;vertical-align: middle;width: 999px">
					<a href="<?php echo base_url('arsip_dinamis/berkas_inaktif/permanen');?>" style="font-size: 15px;" class="btn btn-lg btn-rounded btn-primary btn-block"><span class="btn-label"><i data-icon="&#xe003;" class="linea-icon linea-elaborate"></i></span>Permanen</a>
				</div>
    </div>
   
    <!-- begin table -->
    <div class="col-md-12">
      <div class="white-box">
        <table class="table">
        <thead>
                        <tr>
                            <th>#</th>
                            <th width="50px">No.</th>
                            <th width="100px">
                                <center>Kode Klasifikasi</center>
                            </th>
                            <th>Nama Berkas</th>
                            <th>Kurun Waktu</th>
                            <th>Jumlah Item</th>
                            <th>Akhir Retensi Aktif</th>                            
                            <th>Penyusutan Akhir</th>
                            <th>Aksi</th>
                        </tr>
          </thead>
          <tbody id="row-data">
                        <?php if (!empty($files)) {
                            $no = 1;
                            foreach ($files as $file) { ?>
                                <tr>
                                    <td></td>
                                    <td><?= $no++; ?></td>
                                    <td><?= $file->id_surat_klasifikasi->kode_gabungan; ?></td>
                                    <td><?= $file->nama_berkas; ?></td>
                                    <td><?= $file->id_surat_klasifikasi->kurun_waktu; ?></td>
                                    <td>0</td>
                                    <td><?= $file->id_surat_klasifikasi->akhir_retensi_aktif; ?></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i></button>
                                        <button class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#pinjamBerkas"><i class="fa fa-file"></i></button>
                                       
                                    </td>
                                </tr>
                        <?php }
                        } ?>

          </tbody>

        </table>
      </div>    
    </div>
    <!-- end table -->


<!-- End Container Fluid -->
</div>

<!-- Modal -->
<!-- memanggil modal pinjam -->
<div class="modal fade" id="pinjamBerkas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pinjam Berkas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <label for="exampleInput">Sampai Dengan Tanggal</label>
	        <div class="input-group">
				<div class="input-group-addon"></div>
					<input name="tanggal" value="" type="date" id="tanggal">
				</div>
                <div class="input-group-addon"></div>
					<input name="keterangan" value="" type="text" class="form-control" id="keterangan" placeholder=" ">
				</div>
			</div>
			<div class="form-group">
				<label for="exampleInput">Keterangan</label>
		            <div class="input-group">
				        <div class="input-group-addon"></div>
					        <input name="keterangan" value="" type="text" class="form-control" id="keterangan" placeholder=" ">
				        </div>
		</div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
	  <button type="submit" class="btn btn-primary waves-effect text-left">Kirim</button>
      </div>
    </div>
  </div>
</div>
