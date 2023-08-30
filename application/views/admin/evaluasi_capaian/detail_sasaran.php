 <div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Rencana Kerja Tahunan</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="active">Starter Page</li>
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
            <p class="text-muted">Sasaran 1</p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Sumber data :</strong>
            <br>
            <p class="text-muted">Sasaran 1</p>
          </div>
<hr>

          <div class="col-md-12 col-xs-12 "> <strong>Kode SS :</strong>
            <br>
            <p class="text-muted">Sasaran 1</p>
          </div>


          <div class="col-md-12 col-xs-12 "> <strong>Sasaran Strategis :</strong>
            <br>
            <p class="text-muted">Sasaran 1</p>
          </div>




        </div>






        
      </div>
    </div> 

    <div class="col-md-6">
      <div class="white-box">
        <div class="row">

          <div class="col-md-12 col-xs-12 "> <strong>Deskripsi :</strong>
            <br>
            <p class="text-muted">Deskripsi ss ini adalah....</p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Disposi SS ke:</strong>
            <br>
            <p class="text-muted">unit kerja 4</p>
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
                  <th>Status Capaian</th>
                  <th>Status Verifikasi </th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>IKU1</td>
                  <td>Indikator Kinerja Utama 1</td>
                  <td>100 Dokumen</td>
                  <td>100 Dokumen</td>
                  <td>100%</td>
                  <td>Tercapai</td>
                  <td>Aproved</td>
                 
                  <td>
                   <a href="<?=base_url('data_capaian/detail_indikator')?>"<button type="button" class="btn btn-primary " > Detail Indikator</button></a>
                   </td> 
                </tr>

                <tr>
                  <td>2</td>
                  <td>IKU2</td>
                  <td>Indikator Kinerja Utama 2</td>
                  <td>50 Kegiatan</td>
                  <td>25 Kegiatan</td>
                  <td>50%</td>
                  <td>Belum Tercapai</td>
                  <td>Pending</td>
                 
                  <td>
                   <a href="<?=base_url('data_capaian/detail_indikator')?>"<button type="button" class="btn btn-primary " > Detail Indikator</button></a>
                   </td> 
                </tr>

              </table>



            </div>
          </div>

        </div>    


      </div>
      <!-- .row -->


    </div>


