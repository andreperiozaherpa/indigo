
          <div class="">
            <div class="page-title">
              <div class="title_left">
               
                      <ol class="breadcrumb">
						  <li><a href="#">Home</a></li>
						  <li><a href="<?php echo base_url()."pengajuan_mutasi" ; ?> ">Pengajuan Mutasi</a></li>
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
                    <h2>Pengajuan Mutasi<small></small></h2>
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
                        <div class="col-sm-4 invoice-col">
                          Dari Unit Kerja :
                          <address>
                                          <br><strong><?= $data_pengajuan->nama_skpd_awal;?></strong>
                                          <br><?=$data_pengajuan->alamat_skpd_awal;?>
                                          <br>Phone: <?= $data_pengajuan->telp_skpd_awal;?>
                                          <br>Email: <?= $data_pengajuan->email_skpd_awal;?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Unit Kerja Tujuan :
                          <address>
                                          <br><strong><?= $data_pengajuan->nama_skpd_tujuan;?></strong>
                                          <br><?=$data_pengajuan->alamat_skpd_tujuan;?>
                                          <br>Phone: <?= $data_pengajuan->telp_skpd_tujuan;?>
                                          <br>Email: <?= $data_pengajuan->email_skpd_tujuan;?>
                                      </address>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <hr>
								<h5> <strong> RIWAYAT KEPANGKATAN </strong></H5>
								<hr>


								<table class="table table-bordered">
								<tbody>
								<tr><td rowspan="2" >Gol. Ruang</td><td rowspan="2" >Pangkat</td><td rowspan="2" >Berlaku Tmt</td><td rowspan="2">Gaji Pokok</td><td colspan="3">Surat Keputusan</td></tr>
								<tr><td >Pejabat</td><td >Nomor</td><td >Tanggal</td></tr>
								<?php
								if (!empty($riwayat_pangkat)){
									foreach($riwayat_pangkat as $row)
									{
										echo"
											<tr>
												<td>$row->golongan</td>
												<td>$row->pangkat</td>
												<td>".date('d M Y', strtotime($row->tmt_berlaku))."</td>
												<td>".number_format($row->gaji_pokok)."</td>
												<td>$row->nama_pejabat</td>
												<td>$row->no_sk</td>
												<td>".date('d M Y', strtotime($row->tgl_sk))."</td>
											</tr>
										";
									}
								}
								else{
									echo "<tr><td colspan='7' align='center'>Tidak ada data</td></tr>";
								}
								?>
								</tbody>
								</table>



								<hr>
								<h5> <strong> RIWAYAT PEKERJAAN / JABATAN </strong></H5>
								<hr>


								<table class="table table-bordered ">
								<tbody>
								<tr><td rowspan="2" >Pekerjaan/ Jabatan</td><td colspan="2"  >Tanggal - Bulan - Tahun </td><td rowspan="2" >Gol. Ruang</td><td rowspan="2" >Gaji Pokok</td><td colspan="3"  >Surat Keputusan</td></tr>
								<tr><td>Mulai</td><td>Sampai</td><td>Pejabat</td><td>Nomor</td><td>Tanggal</td></tr>
								<?php
								if (!empty($riwayat_jabatan)){
									foreach($riwayat_jabatan as $row)
									{
										echo"
											<tr>
												<td>$row->nama_jabatan</td>
												<td>".date('d-m-Y', strtotime($row->tgl_mulai))."</td>
												<td>".date('d-m-Y', strtotime($row->tgl_akhir))."</td>
												<td>$row->golongan</td>
												<td>".number_format($row->gaji_pokok)."</td>
												<td>$row->nama_pejabat</td>
												<td>$row->no_sk</td>
												<td>".date('d M Y', strtotime($row->tgl_sk))."</td>
											</tr>
										";
									}
								}
								else{
									echo "<tr><td colspan='8' align='center'>Tidak ada data</td></tr>";
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
                          <p class="lead">Keterangan Mutasi :</p>
                         
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <?=$data_pengajuan->keterangan_pengajuan;?>
                          </p>
						  
						  <a href="<?= base_url()."pengajuan_mutasi";?>" class="btn btn-default" style="margin-right: 5px;"><i class="fa fa-arrow-left"></i> Kembali</a>
						   <?php
						  if ($data_pengajuan->status==2){echo"
						  <a href='".base_url()."pengajuan_mutasi/cetak/$data_pengajuan->id' class='btn btn-default' >
							<i class='fa fa-print'></i> Cetak
						  </a>";}?>
						  <a href="<?= base_url()."data/upload_berkas/".$data_pengajuan->berkas;?>" class="btn btn-warning" style="margin-right: 5px;"><i class="fa fa-download"></i> Download Berkas</a>
						
                       
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Status :</p>
						  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <?=$arrStatusPengajuan[$data_pengajuan->status];?>
                          </p>
                          <div class="table-responsive">
                            <?php
								if ($data_pengajuan->status==0){
									echo'
										<a href="'.base_url().'pengajuan_mutasi/ubah_status/'.$data_pengajuan->id.'/1" class="btn btn-info pull-left"><i class="fa fa-check-square-o"></i> Proses Verifikasi</a>
									';
								}
								else if ($data_pengajuan->status==1){
									echo'
										<a href="'.base_url().'pengajuan_mutasi/ubah_status/'.$data_pengajuan->id.'/2" class="btn btn-success pull-left"><i class="fa fa-check"></i> Selesai</a>
										<a href="'.base_url().'pengajuan_mutasi/ubah_status/'.$data_pengajuan->id.'/3" class="btn btn-warning pull-left"><i class="fa fa-close"></i> Tolak</a>
									';
								}
								else if ($data_pengajuan->status==2){
									echo'
										<a href="'.base_url().'pengajuan_mutasi/ubah_status/'.$data_pengajuan->id.'/0" class="btn btn-warning pull-left"><i class="fa fa-mail-reply"></i> Batalkan Verifikasi</a>
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
		window.location.href = "<?= base_url();?>pengajuan_mutasi/delete/"+id+"/"+berkas;
	}
  }
  
</script>