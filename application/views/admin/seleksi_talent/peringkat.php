<div class="container-fluid">
    <?php 
    $filter = '';
    ?>
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Peringkat Hasil Seleksi Talent</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <?php echo breadcrumb($this->uri->segment_array()); ?>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="row">
                        <form method="POST">
                            <div class="col-md-10">
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label class="control-label"> Eselon</label>
                                        <select class="form-control">
                                            <option value="">Pilih Eselon</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">


                                    <div class="form-group">
                                        <label class="control-label"> SKPD</label>
                                        <select class="form-control">
                                            <option value="">Pilih SKPD</option>
                                            <option value="1">Sekretariat Daerah</option>
                                            <option value="2">Dinas Kesehatan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label"> Unit Kerja</label>
                                        <select class="form-control">
                                            <option value="">Pilih Unit Kerja</option>
                                            <option value="1">Bagian Keuangan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label class="control-label"> Jabatan</label>
                                        <select class="form-control">
                                            <option value="">Pilih Jabatan</option>
                                            <option value="1">Kepala Bagian Keuangan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                                <?php
                                if($filter){
                                  ?>
                                  <a href="" class="btn btn-default m-t-5"><i class="ti-back-left"></i> Reset</a>
                                  <?php
                              }
                              ?>
                          </div>
                      </div>
                  </form>
              </div>

          </div>
      </div>
  </div>
  <div class="row">
    <div class="white-box">
        <div class="text-center">
            <small><b style="color: #6003c8">PERINGKAT UNTUK</b></small>
            <br>

            <span style="margin-right: 10px;"><i style="color: #6003c8" class="ti-pulse "></i> Eselon II</span>
            <span style="margin-right: 10px;"><i style="color: #6003c8" data-icon="&#xe030;" class="linea-icon linea-aerrow "></i> Sekretariat Daerah</span>
            <span style="margin-right: 10px;"><i style="color: #6003c8" class="ti-briefcase "></i> Bagian Keuangan</span>
            <span><i style="color: #6003c8" class="ti-bar-chart"></i> Kepala Bagian Keuangan</span>
        </div>
        <hr>
        <table class="table color-table primary-table">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>NIP</th>
                    <th>Nama Lengkap</th>
                    <th>Download </th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <th>1</th>
                    <th>196709201992031007</th>
                    <th>CECE HERMAN CAHYONO</th>
                    <th><a href="<?=base_url('data/talent/data-talent.pdf');?>" target="_blank" >
                        <button class="btn btn-primary">Download</button>
                    </a>
                </th>
                </tr>
                <?php 
                for($i=2;$i<=10;$i++){
                    ?>
                <tr>
                    <th><?=$i?></th>
                    <th>###################</th>
                    <th>Nama ASN</th>
                </tr>
            <?php } ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>