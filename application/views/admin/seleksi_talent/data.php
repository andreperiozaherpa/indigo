<div class="container-fluid">
<?php 
    $filter = '';
?>
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Assement</h4> </div>
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
<!-- <div class="row">
    <div class="col-md-12">
            <div class="white-box" style="border-left: solid 3px #6003c8">
                    <div class="row" >
                        <div class="col-md-2 col-sm-2 text-center b-r" >
                            <i class="ti-user mt-2" style="font-size:70px;color: #6003c8"></i>
                        </div>
                        <div class="col-md-10 col-sm-10"  >
                            <div class="row b-b">
                            <div class="col-md-12 text-center" style="color: #6003c8">
                                <b>STATUS VERIFIKASI</b>
                            </div>
                            </div>
                        <div class="row">
                            <div class="col-md-3 text-center b-r">
                                <h3 class="box-title m-b-0"><?=$total_pegawai;?></h3>
                                <a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/data_assement/index/">Total Pegawai</a>
                            </div>
                            <div class="col-md-3 text-center b-r">
                                <h3 class="box-title m-b-0"><?=$total_pegawai_true;?></h3>
                                <a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/data_assement/index/status_verifikasi_data/true">Sudah Diverifikasi</a>
                            </div>
                            <div class="col-md-3 text-center b-r ">
                                <h3 class="box-title m-b-0"><?=$total_pegawai_false;?></h3>
                                <a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/data_assement/index/status_verifikasi_data/false">Belum Diverifikasi</a>
                            </div>
                            <div class="col-md-3 text-center b-r ">
                                <h3 class="box-title m-b-0"><?=$total_pegawai_process;?></h3>
                                <a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/data_assement/index/status_verifikasi_data/process">Perlu Tanggapan</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <br>
            <br>
            <br>
</div> -->

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php
        $color = "";
        $color_code = "";
        $icon = "";
        $status = "";
        for ($i=1; $i <= 3 ; $i++) { ?>
            <div class="col-md-4 col-sm-6">
                <div class="verify-data-status <?=$color?>">
                <i class="<?=$icon?>"></i> <?=$status?>
                </div>
                <div class="white-box" style="height:300px;width:auto;">
                    <div class="row b-b" style="height:120px;">
                        <div class="col-md-4 col-xs-4 b-r text-center" style="height:120px;">
                            <br>
                            <img src="<?=base_url('data/foto/pegawai/user_default.png')?>" alt="user" style=" object-fit: cover;
                  width: 80px;
                  height: 80px;border-radius: 50%;
                  ">
                        </div>
                        <div class="col-md-8  col-xs-8">
                            <br>
                            <h5><b>Nandang Koswara</b></h5>
                            <h5><small>1234567890</small></h5>
                        </div>
                    </div>
                    <div class="row b-b" style="height:85px;">
                        <div class="text-center">
                            <br>
                            <b style="color: #6003c8">Jabatan</b>
                            <br>
                            <small>Kepala Bagian Keuangan</small><br>
                        <small style="margin-right: 10px;"><i style="color: #6003c8" class="ti-pulse "></i> Eselon II</small>
                        <small style="margin-right: 10px;"><i style="color: #6003c8" class="ti-briefcase "></i> Bagian Keuangan</small>
                        <small><i style="color: #6003c8" data-icon="&#xe030;" class="linea-icon linea-aerrow "></i> Sekretariat Daerah</small>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                        <a href="<?=base_url('seleksi_talent/detail_talent')?>" class="btn btn-primary btn-block">
                            Detail Pegawai
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>



    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="row">
                <div class="col-md-12 pager">
                    <a href="?page=1" class="btn btn-primary disabled">1</a> <a href="?page=2" class="btn btn-primary ">2</a> <a href="?page=3" class="btn btn-primary ">3</a> <a href="?page=4" class="btn btn-primary ">4</a> <a href="?page=2" class="btn btn-primary">Selanjutnya</a> <a href="?page=52" class="btn btn-primary">Akhir</a>                      </div>
                </div>

            </div>

        </div>
</div>


        <div id="myModalc" class="modal fade" tabindex="" index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4> </div>
                        <div class="modal-body">
                            <p>Apakah anda yakin akan ikut serta dalam seleksi calon talent?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Ya</button>
                            <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
<script type="text/javascript">
    function delete_(id)
    {
        $('#confirm_title').html('Konfirmasi');
        $('#confirm_content').html('Apakah anda yakin akan menghapus data pegawai?');
        $('#confirm_btn').html('Hapus');
        $('#confirm_btn').attr('href',"<?php echo base_url();?>master_pegawai/delete/"+id);
    }

</script>
