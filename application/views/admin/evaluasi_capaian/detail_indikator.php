 <div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Indikator Kinerja Utama</h4>
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
          <div class="col-md-12 col-xs-12 "> <strong>Sasaran Strategis :</strong>
            <br>
            <p class="text-muted">Sasaran 1</p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>IKU Atasan :</strong>
            <br>
            <p class="text-muted">-</p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Kode IKU :</strong>
            <br>
            <p class="text-muted">IKU1</p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Nama IKU :</strong>
            <br>
            <p class="text-muted">Indikator Kinerja Utama </p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Deskripsi IKU :</strong>
            <br>
            <p class="text-muted">Deskrpsi Indikator Kinerja Utama  </p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Satuan IKU :</strong>
            <br>
            <p class="text-muted">Kegiatan</p>
          </div>
        </div>      
      </div>

      <div class="white-box" style="min-height: 100px;">
        <div class="col-md-12 col-xs-12 "> <strong>Target Tahunan:</strong>
          <br>
          <p class="text-muted">100 Dokumen</p>
          <br>
        </div>


      </div>
    </div> 

    <div class="col-md-6">
      <div class="white-box">
        <div class="row">

          <div class="col-md-12 col-xs-12 "> <strong>Frekuensi Waktu :</strong>
            <br>
            <p class="text-muted">Semester</p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Perhitungan Keatasan :</strong>
            <br>
            <p class="text-muted">Akumulasi</p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Cara Perhitungan :</strong>
            <br>
            <p class="text-muted">dengan menggunakan akumulasi nilai IKU</p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Validasi :</strong>
            <br>
            <p class="text-muted">Lead Input</p>
          </div>


          <div class="col-md-12 col-xs-12 "> <strong>Polarisasi :</strong>
            <br>
            <p class="text-muted">Maximize</p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Metode Cascading :</strong>
            <br>
            <p class="text-muted">Adopsi Langsung</p>
          </div>
          <div class="col-md-12 col-xs-12 "> <strong>Unit Penanggung Jawab :</strong>
            <br>
            <p class="text-muted">Unit Kerja 3</p>
          </div>
          <div class="col-md-12 col-xs-12 "> <strong>Diturunkan :</strong>
            <br>
            <p class="text-muted">Unit Kerja 4</p>
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


            <table class="table color-table dark-table table-hover">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Bulan</th>
                  <th>Target</th>
                  <th>Realisasi</th>
                  <th>Capaian</th>
                  <th>Status Capain </th>
                  <th>File</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Januari</td>
                  <td>10 Dokumen</td>
                  <td>10 Dokumen</td>
                  <td>100%</td>
                  <th>Tercapai</th>
                  <td> <a href="<?=base_url('#')?>">file pendukung.rar</a></td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>
                  </td> 
                </tr>
                <tr class="warning">
                  <td>2</td>
                  <td >Feburari</td>
                  <td colspan="6"><p align="center">- Tidak di jadwalkan -</p></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Maret</td>
                  <td>10 Dokumen</td>
                  <td>10 Dokumen</td>
                  <td>100%</td>
                  <th>Tercapai</th>
                  <td> <a href="<?=base_url('#')?>">file pendukung.rar</a></td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>
                  </td> 
                </tr>
                <tr>
                  <td>4</td>
                  <td>April</td>
                  <td>10 Dokumen</td>
                  <td>10 Dokumen</td>
                  <td>100%</td>
                  <th>Tercapai</th>
                  <td> <a href="<?=base_url('#')?>">file pendukung.rar</a></td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>
                  </td> 
                </tr>
                <tr class="warning">
                  <td>5</td>
                  <td>Mei</td>
                  <td colspan="6"><p align="center">- Tidak di jadwalkan -</p></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Juni</td>
                  <td>10 Dokumen</td>
                  <td>10 Dokumen</td>
                  <td>100%</td>
                  <th>Tercapai</th>
                  <td> <a href="<?=base_url('#')?>">file pendukung.rar</a></td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>
                  </td> 
                </tr>
                <tr>
                  <td>7</td>
                  <td>Juli</td>
                  <td>10 Dokumen</td>
                  <td>10 Dokumen</td>
                  <td>100%</td>
                  <th>Tercapai</th>
                  <td> <a href="<?=base_url('#')?>">file pendukung.rar</a></td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>
                  </td> 
                </tr>
                <tr>
                  <td>8</td>
                  <td>Agustus</td>
                  <td>10 Dokumen</td>
                  <td>10 Dokumen</td>
                  <td>100%</td>
                  <th>Tercapai</th>
                  <td> <a href="<?=base_url('#')?>">file pendukung.rar</a></td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>
                  </td> 
                </tr>
                <tr>
                  <td>9</td>
                  <td>September</td>
                  <td>10 Dokumen</td>
                  <td>10 Dokumen</td>
                  <td>100%</td>
                  <th>Tercapai</th>
                  <td> <a href="<?=base_url('#')?>">file pendukung.rar</a></td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>
                  </td> 
                </tr>

                <tr>
                  <td>10</td>
                  <td>September</td>
                  <td>10 Dokumen</td>
                  <td>10 Dokumen</td>
                  <td>100%</td>
                  <th>Tercapai</th>
                  <td> <a href="<?=base_url('#')?>">file pendukung.rar</a></td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>
                  </td> 
                </tr>

                <tr>
                  <td>11</td>
                  <td>november</td>
                  <td>10 Dokumen</td>
                  <td>10 Dokumen</td>
                  <td>100%</td>
                  <th>Tercapai</th>
                  <td> <a href="<?=base_url('#')?>">file pendukung.rar</a></td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>
                  </td> 
                </tr>

                <tr>
                  <td>12</td>
                  <td>Desember</td>
                  <td>10 Dokumen</td>
                  <td>10 Dokumen</td>
                  <td>100%</td>
                  <th>Tercapai</th>
                  <td> <a href="<?=base_url('#')?>">file pendukung.rar</a></td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>
                  </td> 
                </tr>
              </table>

              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel1">Update Capaian</h4>
                    </div>
                    <div class="">



                      <div class="col-md-12 col-xs-12 " style="margin-top: 20px;margin-bottom: 10px;"> <strong>Target :</strong>
                        <br>

                        <p class="text-muted">10 Dokumen</p>
                      </div>

                      <div class="col-md-12 col-xs-12 "> <strong>Realisasi :</strong>
                        <br>
                        <div class="input-group m-t-10">
                          <input type="text" id="example-input2-group1" name="example-input2-group1" class="form-control" placeholder="realisasi">
                          <span class="input-group-addon">Kegiatan</span> </div>
                        </div>

                        <div class="col-md-12 col-xs-12 " style="margin-top: 20px;margin-bottom: 20px;"> <strong>Status Capaian :</strong>
                          <br>
                          <input type="checkbox" checked class="js-switch"  data-color="#13dafe" /> Tercapai
                        </div>

                        <div class="col-md-12 col-xs-12 "> <strong>File Pendukung:</strong>
                          <br>
                          <input type="file" id="input-file-now" class="dropify" />
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Simpan</button>

                      </div>
                    </div>
                  </div>
                </div>



              </div>
            </div>

          </div>    


        </div>
        <!-- .row -->


      </div>


