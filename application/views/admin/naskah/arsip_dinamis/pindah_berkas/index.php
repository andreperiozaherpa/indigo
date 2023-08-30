<div class="container-fluid">
<!-- Begin Container Fluid -->

    <!-- begin title -->
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Daftar Pemindahan Berkas</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    
            <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Daftar Pemindahan Berkas</li>
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
                                        <label class="control-label">Pengusul Pindah</label>
                                        <input type="text" id="" name="perihal" placeholder="Masukkan Pengusul" class="form-control" placeholder="" value=""> <!-- isi value : <-?=($filter) ? $filter_data['perihal'] : ''?> -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Status Usul Pindah</label>
                                        <input type="text" id="" name="hash_id" placeholder="Masukkan Status" class="form-control" placeholder="" value=""><!-- isi value : <-?=($filter) ? $filter_data['hash_id'] : ''?>-->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tgl. Usul Pindah</label>
                                        <input type="text" class="form-control" name="tgl_buat" id="datepicker" placeholder="Pilih Tanggal Usul Pindah" value=""> <!-- isi value : <-?=($filter) ? $filter_data['tgl_buat'] : ''?>  -->
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

  
    <!-- begin table -->
    <div class="col-md-12">
      <div class="white-box">

      <table class="table">
        <thead>
                        <tr>
                            <th>#</th>
                            <th width="50px">No.</th>
                            <th>
                                Bagian / Bidang Pengusul
                            </th>
                            <th>Status</th>
                            <th>Tanggal Pembuatan</th>
                            <th>Tanggal Dipindahkan</th>   
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
                                    <td><button class="btn btn-sm btn-secondary">Usulan</button></td>
                                    <td><?= $file->created_date; ?></td>
                                    <td><?= $file->tgl_usul_pindah; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i></button>
                                        <button class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
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