<div class="container-fluid">
<!-- Begin Container Fluid -->

    <!-- begin title -->
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Daftar Usulan Permanen</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    
            <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Daftar Usulan Permanen</li>
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
                                    <div class="form-group">
                                        <label class="control-label">Tgl. Penyerahan Berkas</label>
                                        <input type="text" class="form-control" name="tgl_buat" id="datepicker" placeholder="Pilih Tanggal Penyerahan" value=""> <!-- isi value : <-?=($filter) ? $filter_data['tgl_buat'] : ''?>  -->
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
              <th width="30px">No.</th>
              <th width="150px"><center>Tanggal Penyerahan</center></th>
              <th width="150px">Status</th>
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