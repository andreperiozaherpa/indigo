<div class="container-fluid">
<!-- Begin Container Fluid -->

    <!-- begin title -->
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Daftar Peminjaman Berkas</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    
            <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Daftar Peminjaman Berkas</li>
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
                                        <label class="control-label">Tgl. Pembuatan Berkas</label>
                                        <input type="text" class="form-control" name="tgl_buat" id="datepicker" placeholder="Pilih Tanggal Penerimaan" value=""> <!-- isi value : <-?=($filter) ? $filter_data['tgl_buat'] : ''?>  -->
                                    </div>
                                </div>
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
			<div class="row">
				<div style="height: 120px;display: table-cell;vertical-align: middle;width: 999px">
					<a href="" data-toggle="modal" data-target="#pinjam" style="font-size: 15px;" class="btn btn-lg btn-rounded btn-primary btn-block"><span class="btn-label"><i data-icon="&#xe003;" class="linea-icon linea-elaborate"></i></span>Pinjam Berkas</a>
				</div>
                
            </div>
    </div>
    <!-- Note : tujuan link belum sesuai
    -->

    <!-- begin status berkas -->
    <div class="col-md-8">
			<div class="white-box" style="border-left: solid 3px #6003c8">
				<div class="row" >
					<div class="col-md-2 col-sm-2 text-center b-r" style="min-height:70px;" >
						<img src="<?php echo base_url('asset/logo/surat.png');?>" width="80px" height="60px" alt="">
					</div>
					<div class="col-md-10 col-sm-10"  >
						<div class="row b-b">
							<div class="col-md-12 text-center" style="color: #6003c8">
								<b>STATUS BERKAS</b>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 text-center b-r">
								<h3 class="box-title m-b-0">1206<!--?=count($total)?--></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_eksternal/surat_keluar')?>">Total Berkas</a>
							</div>
							<div class="col-md-3 text-center b-r ">
								<h3 class="box-title m-b-0">256<!--?=count($selesai)?--></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_eksternal/surat_keluar')?>/status_surat/selesai">Proses Pemberkasan</a>
							</div>

							<div class="col-md-3 text-center b-r">
								<h3 class="box-title m-b-0">9950<!--?=count($perlu_tanggapan)?--></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_eksternal/surat_keluar')?>/status_surat/perlu_tanggapan">Berkas Ditutup</a>
							</div>
							<div class="col-md-3 text-center b-r ">
								<h3 class="box-title m-b-0">846<!--?=count($dalam_proses)?--></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_eksternal/surat_keluar')?>/status_surat/dalam_proses">Memasuki Batas Pindah</a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
	</div><br><br><br>
    <!-- Note : sesuaikan jumlah data dengan data yang tampil pada saat link di klik , icon status berkas 
    -->
    <!-- end status berkas -->

    <!-- begin table -->
    <div class="col-md-12">
      <div class="white-box">
        <table class="table">
          <thead>
            <tr>
              <th width="50px">No.</th>
              <th width="100px"><center>Kode Klasifikasi</center></th>
              <th>Nama Berkas</th>
              <th>Kurun Waktu</th>
              <th>Jumlah Item</th>
              <th>Akhir Retensi Aktif</th>
              <th width="100px">Aksi</th>

            </tr>
          </thead>
          <tbody id="row-data">
          </tbody>

        </table>
      </div>    
    </div>
    <!-- end table -->

<!-- End Container Fluid -->
</div>

<script type="text/javascript">
        var action = '';
        var id_misi = 0;
        var rowDataMisi = {};
function addMisi() {
            $(".error").html("");
            action = 'add';
            id_misi = 0;
            $('#formMisi')[0].reset();
            $('#message').html('');
            $('#modalMisi').modal('show');
            $('.modal-title').text('Tambah Misi');
        }
</script>