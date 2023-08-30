
          <div class="">
            <div class="page-title">
              <div class="title_left">
               
                      <ol class="breadcrumb">
						  <li><a href="#">Home</a></li>
						  <li><a href="<?php echo base_url()."pengajuan_izin_belajar" ; ?> ">Pengajuan izin_belajar</a></li>
						  <li class="active">View</li>
					  </ol>
                  
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pengajuan izin belajar<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          Identitas Pemohon : 
                          <address>
						  <br>
                                          <strong><?= $data_pengajuan->nama_lengkap;?></strong>
                                          <br>NIP. <?= $data_pengajuan->nip_baru;?>
                                          <br><?= empty($pangkat_last[0])? "" : $pangkat_last[0]->golongan .", ". $pangkat_last[0]->pangkat;?>
                                         
                                      </address>
                        </div>
                        <!-- /.col -->
                       
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
						
						 <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
						<hr>
								<h5> <strong> Izin Belajar </strong></H5>
								<hr>
								
						 <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                           <th>NIP</th>
                          <th>Nama</th>
                         
                          <th>Jenjang Pendidikan</th>
                          <th>Nama Universitas</th>
                          
                          <th>Tgl. Pengajuan</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td><?=$data_pengajuan->nip_baru;?></td>
                          <td><?=$data_pengajuan->nama_lengkap;?></td>
                            
                           <td><?=$data_pengajuan->nama_jenjangpendidikan;?></td>
                          <td><?=$data_pengajuan->nama_tempatpendidikan;?></td>
                    
                          <td><?= date("d M Y",strtotime($data_pengajuan->tgl_pengajuan));?></td>
                          
                        </tr>

                           
                        
                       
                       
                      </tbody>
                    </table>
						
						
                          <hr>
								<h5> <strong> RIWAYAT PENDIDIKAN </strong></H5>
								<hr>


								
									<table class="table table-bordered">
							<tbody>
							<tr>
							<td rowspan="2">Nama Sekolah</td><td rowspan="2" >Jurusan Pendidikan</td><td colspan="3" >
							STTB/ Tanda Lulus / Ijazah
							</td>
							</tr><tr><td >Nomor</td><td >Tahun</td><td >Pejabat</td></tr>
							<?php
							if (!empty($riwayat_pendidikan)){
								foreach($riwayat_pendidikan as $row)
								{
									echo "<tr>
											<td>$row->nama_tempatpendidikan</td>
											<td>$row->nama_jurusan</td>
											<td>$row->nomor_sk</td>
											<td>".date("Y",strtotime($row->tgl_sk))."</td>
											<td>$row->nama_pejabat</td>
										</tr>
									";
								}
							}
							else{
								echo "<tr><td colspan=6 align=center>- Tidak ada data -</td></tr>";
							}	
							?>

							</tbody>
							</table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <p class="lead">Keterangan izin_belajar :</p>
                         
                          <p class="text-muted well well-sm no-shadow" stylizin_belajar"margin-top: 10px;">
                            <?=$data_pengajuan->keterangan_pengajuan;?>
                          </p>
						  
						  <a href="<?= base_url()."pengajuan_izin_belajar";?>" class="btn btn-default" stylizin_belajar"margin-right: 5px;"><i class="fa fa-arrow-left"></i> Kembali</a>
						   <?php
						  if ($data_pengajuan->status==2){echo"
						  <a href='".base_url()."pengajuan_izin_belajar/cetak/$data_pengajuan->id' class='btn btn-default' >
							<i class='fa fa-print'></i> Cetak
						  </a>";}?>
						  <a href="<?= base_url()."data/upload_berkas/".$data_pengajuan->berkas;?>" class="btn btn-warning" stylizin_belajar"margin-right: 5px;"><i class="fa fa-download"></i> Download Berkas</a>
						
                       
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Status :</p>
						  <p class="text-muted well well-sm no-shadow" stylizin_belajar"margin-top: 10px;">
                            <?=$arrStatusPengajuan[$data_pengajuan->status];?>
                          </p>
                          <div class="table-responsive">
                            <?php
								if ($data_pengajuan->status==0){
									echo'
										<a href="'.base_url().'pengajuan_izin_belajar/ubah_status/'.$data_pengajuan->id.'/1" class="btn btn-info pull-left"><i class="fa fa-check-square-o"></i> Proses Verifikasi</a>
									';
								}
								else if ($data_pengajuan->status==1){
									echo'
										<a href="'.base_url().'pengajuan_izin_belajar/ubah_status/'.$data_pengajuan->id.'/2" class="btn btn-success pull-left"><i class="fa fa-check"></i> Selesai</a>
										<a href="'.base_url().'pengajuan_izin_belajar/ubah_status/'.$data_pengajuan->id.'/3" class="btn btn-warning pull-left"><i class="fa fa-close"></i> Tolak</a>
									';
								}
								else if ($data_pengajuan->status==2){
									echo'
										<a href="'.base_url().'pengajuan_izin_belajar/ubah_status/'.$data_pengajuan->id.'/0" class="btn btn-warning pull-left"><i class="fa fa-mail-reply"></i> Batalkan Verifikasi</a>
									';
								}
								else if ($data_pengajuan->status==3){
									echo
										"<button class='btn btn-danger pull-left' onclick='hapus($data_pengajuan->id,\"$data_pengajuan->berkas\")'><i class='fa fa-trash-o'></i> Hapus pengajuan</button>";
									;
								}
							?>
                          
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
<script>

function hapus(id,berkas)
  {
    if (confirm("Apakah anda yakin akan menghapus data?")){
		window.location.href = "<?= base_url();?>pengajuan_izin_belajar/delete/"+id+"/"+berkas;
	}
  }
  
</script>