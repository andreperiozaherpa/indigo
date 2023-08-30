<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Keuangan</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Rekonsiliasi Laporan neraca </li>
                <li class="active">index</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <?php
    if (isset($message)) {
    ?>
        <div class="alert alert-<?= $message_type ?> alert-dismissible" role="alert">
            <p><?= $message ?></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
            </button>
        </div>
    <?php
    }
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">

                    <form method="POST">
                        <div class="col-md-3 b-r">
							<a href="<?=base_url();?>keuangan/lap_neraca/add">
                            <button type="button" class="btn btn-primary btn-block e m-t-20"
                                data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Laporan
                            </button>
							</a>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nama SKPD </label>
                                <input type="text" class="form-control" placeholder="Cari berdasarkan Nama SKPD"
                                    name="nama_skpd" value="">
                            </div>
                        </div>

						



                        <div class="col-md-3">
                            <div class="form-group">

                                <br>
                                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i
                                        class="ti-filter"></i> Filter</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>


    

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_content">

   <?php foreach ($list as $l) {
        if ($l->status == "Selesai") {
            $label   = "primary";
            $status  = "Selesai";
        } elseif ($l->status == "Proses") {
            $label   = "info";
            if ($l->ttd_pegawai_3_skpd == "belum") {
                $status  = "Penandatangan Pengelola Pemanfaatan BMD";
            } elseif ($l->ttd_pegawai_2_skpd == "belum") {
                $status  = "Penandatangan Pejabat Penatausahaan Keuangan";
            } elseif ($l->ttd_pegawai_1_skpd == "belum") {
                $status  = "Penandatangan Kepala SKPD";
            } elseif ($l->status_verifikasi == "belum") {
                $status  = "Pengecekan Verifikator SAREREA";
            } elseif ($l->ttd_pegawai_3_bpkad == "belum") {
                $status  = "Penandatangan Kasubid Penatausahaan Aset Bidang Aset BPKAD";
            } elseif ($l->ttd_pegawai_2_bpkad == "belum") {
                $status  = "Penandatangan Kasubid Pelaporan Bidang Akuntasi BPKAD";
            } elseif ($l->ttd_pegawai_1_bpkad == "belum") {
                $status  = "Penandatangan Kepala Bidang Akutansi BPKAD";
            } else {
                $status  = "Proses";
            }
        } elseif ($l->status == "Ditolak") {
            $label   = "danger";
            if ($l->ttd_pegawai_3_skpd == "ditolak") {
                $status  = "Ditolak Pengelola Pemanfaatan BMD";
            } elseif ($l->ttd_pegawai_2_skpd == "ditolak") {
                $status  = "Ditolak Pejabat Penatausahaan Keuangan";
            } elseif ($l->ttd_pegawai_1_skpd == "ditolak") {
                $status  = "Ditolak Kepala SKPD";
            } elseif ($l->status_verifikasi == "ditolak") {
                $status  = "Ditolak Verifikator SAREREA";
            } elseif ($l->ttd_pegawai_3_bpkad == "ditolak") {
                $status  = "Ditolak Kasubid Penatausahaan Aset Bidang Aset BPKAD";
            } elseif ($l->ttd_pegawai_2_bpkad == "ditolak") {
                $status  = "Ditolak Kasubid Pelaporan Bidang Akuntasi BPKAD";
            } elseif ($l->ttd_pegawai_1_bpkad == "ditolak") {
                $status  = "Ditolak Kepala Bidang Akutansi BPKAD";
            } else {
                $status  = "Ditolak";
            }
        }
       
    ?>

                <div class="col-md-4 col-sm-6">
                    <div class="white-box">
                        <div class="row b-b" style="min-height: 110px;">
                            <div class="col-md-4 col-sm-4 text-center b-r" style="min-height: 120px;">
                                <img src="https://e-office.sumedangkab.go.id/data/logo/skpd/sumedang.png" alt="user"
                                    class="img-circle img-responsive">

                                    <span class="label label-rounded label-<?=$label?>"><?=$status;?></span>

                            </div>
                            <div class="col-md-8 col-sm-8">
                                <p>&nbsp;</p>
                                <h3 class="box-title m-b-0"><?=$l->nama_skpd;?></h3>
                            </div>
                        </div>
                      
                        <div class="row b-b">
                        <div class="col-md-12 col-sm-12 text-center ">
                                <h3 class="box-title m-b-0">Periode</h3>
                                <?=tanggal($l->tgl_periode)?>
                            </div>
                            
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <address>
                                    <a href="<?=base_url();?>keuangan/lap_neraca/detail/<?=encode($l->id_laporan_neraca);?>">
                                        <button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail
                                            Laporan</button>
										
                                    </a>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <?php } ?>




                <!-- /.col -->
            </div>



            <div class="row">
						<div class="col-md-12 pager">
							<?php 
							if(!$filter){
								echo make_pagination($pages,$current);
							}
							?>
						</div>
					</div>


        </div>

    </div>
</div>