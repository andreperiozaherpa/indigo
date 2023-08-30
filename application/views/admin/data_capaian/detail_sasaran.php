 <div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Data Capaian Kinerja</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
       <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
                <li><a href="<?= base_url();?>data_capaian">Data Capaian</a></li>
        <li class="active">Detail Sasaran</li>
      </ol>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>


  <!-- .row -->

  <div class="row">  
    <?php if (!empty($message)) echo "
    <div class='alert alert-$message_type'>$message</div>";?>
    
    <div class="col-md-6">
      <div class="white-box">

        <div class="row">

          <div class="col-md-12 col-xs-12 "> <strong>SS Atasan :</strong>
            <br>
            <p class="text-muted"><?= (!empty($ss_atasan[0]->nama_sasaran_atasan)) ? $ss_atasan[0]->nama_sasaran_atasan : "Tidak ada" ;?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Sumber data :</strong>
            <br>
            <p class="text-muted"><?= (!empty($ss_atasan[0]->nama_unit_kerja_atasan)) ? $ss_atasan[0]->nama_unit_kerja_atasan : "Tidak ada" ;?></p>
          </div>
<hr>

          <div class="col-md-12 col-xs-12 "> <strong>Kode SS :</strong>
            <br>
            <p class="text-muted"><?= $kode_sasaran;?></p>
          </div>


          <div class="col-md-12 col-xs-12 "> <strong>Sasaran Strategis :</strong>
            <br>
            <p class="text-muted"><?= $nama_sasaran;?></p>
          </div>




        </div>






        
      </div>
    </div> 

    <div class="col-md-6">
      <div class="white-box">
        <div class="row">

          <div class="col-md-12 col-xs-12 "> <strong>Deskripsi :</strong>
            <br>
            <p class="text-muted"><?= $editdata[0]->deskripsi;?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Disposi SS ke:</strong>
            <br>
            <ol>
            <?php foreach ($ss_bawahan as $row) {
              echo '<li>'.$row->nama_unit_kerja.'</li>';
            }
            ?>
          </ol>
          </div>
        </div>

      </div>

    </div>



  </div>


    <div class="row"> 
    <div class="col-md-12">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="white-box">
            
            <br>
            <hr>

            <table class="table color-table dark-table table-hover">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Kode IKU</th>
                  <th> IKU</th>
                  <th>Target</th>
                  <th>Realisasi</th>
                  <th>Capaian</th>
                  <th>Status Verifikasi </th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $i=1;
              $GLOBALVAR = GLOBALVAR;
              foreach ($indikator as $row) {
                $status_capaian = ($row->status_capaian) ? $GLOBALVAR['status_capaian'][$row->status_capaian] : '';
                $capaian = ($row->capaian) ? number_format($row->capaian,2).' %' : '';
                echo '
                <tr>
                  <td>'.$i.'</td>
                  <td>'.$row->kode_indikator.'</td>
                  <td>'.$row->nama_indikator.'</td>
                  <td>'.$row->target.' '.$row->satuan.'</td>
                  <td>'.$row->realisasi.' '.$row->satuan.'</td>
                  <td>'.$capaian.'</td>
                  <td>'.$status_capaian.'</td>
                 
                  <td>
                   <a href="'.base_url('data_capaian/detail_indikator').'/'.$_type.'/'.$id_rkt.'/'.$row->id_indikator.'"<button type="button" class="btn btn-primary " > Detail Indikator</button></a>
                   </td> 
                </tr>
                ';
                $i++;
              }
              ?>
              </table>



            </div>
          </div>

        </div>    


      </div>
      <!-- .row -->


    </div>


