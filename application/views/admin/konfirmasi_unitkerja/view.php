
          <div class="">
            <div class="page-title">
              <div class="title_left">
               
                      <ol class="breadcrumb">
						  <li><a href="#">Home</a></li>
						  <li><a href="<?php echo base_url()."konfirmasi_unit_kerja" ; ?> ">Verifikasi</a></li>
						  <li class="active">Riwayat unit_kerja</li>
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
                    <h2>Verifikasi <small>Riwayat unit_kerja</small></h2>
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
                          Identitas : 
                          <address>
						  <br>
                                          <strong><?=$result->nama_lengkap;?></strong>
                                          <br>NIP. <?=$result->nip_baru;?>
                                          <br><?= empty($pangkat_last[0])? "" : $pangkat_last[0]->golongan .", ". $pangkat_last[0]->pangkat;?>
                                         
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          Unit Kerja :
                          <address>
                                          <br><strong><?= empty($unit_kerja_last[0])? "" : $unit_kerja_last[0]->nama_skpd;?></strong>
                                          <br><?= empty($unit_kerja_last[0])? "" : $unit_kerja_last[0]->alamat;?>
                                          <br>Telp: <?= empty($unit_kerja_last[0])? "" : $unit_kerja_last[0]->telp;?>
                                          <br>Email: <?= empty($unit_kerja_last[0])? "" : $unit_kerja_last[0]->email;?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <hr>
								<h5> <strong> Riwayat unit_kerja </strong></H5>
								<hr>

<table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                           <th>NIP</th>
                          <th>Nama</th>
                          <th>Unit kerja</th>
                          <th>TMT Awal</th>
						  <th>TMT Akhir</th>
						  <th>No. SK Awal</th>
						  <th>No. SK Akhir</th>
						  <th>Status</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td><?=$result->nip_baru;?></td>
                          <td><?=$result->nama_lengkap;?></td>
						  <td><?=$result->nama_skpd;?></td>
                          <td><?= date('d M Y',strtotime($result->tmt_awal)) ;?></td>
						  <td><?= date('d M Y',strtotime($result->tmt_akhir)) ;?></td>
							<td><?= $result->no_sk_awal;?></td>
							<td><?= $result->no_sk_akhir;?></td>
							<td><?= $arrStatusRiwayat[$result->status] ;?></td>                       
                         
                        </tr>

                           
                        
                       
                       
                      </tbody>
                    </table>



                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <!--<p class="lead">Status Riyawat</p>-->
                         
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
						  <?php
							if ($result->status==0){
								$btn = '
								<a class="btn btn-success pull-left" href="'.base_url().'konfirmasi_unitkerja/ubah_status/'.$result->id.'/1">Setujui Riwayat</a>
								<a class="btn btn-warning pull-left" href="'.base_url().'konfirmasi_unitkerja/ubah_status/'.$result->id.'/2">Tolak Riwayat</a>
								
								';
							}
							else if ($result->status==1){
								$btn = '
								<a class="btn btn-warning pull-left" href="'.base_url().'konfirmasi_unitkerja/ubah_status/'.$result->id.'/0">Batalkan verifikasi</a>
								
								';
							}
							else{
								$btn ='';
							}
							echo $btn;
						  ?>
						  
						  
                           <br>
						<br>
                          </p>
						  
						  
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead"></p>
						  <?php
						  if ($result->berkas!=""){
							  echo'<a href="'.base_url().'data/upload_berkas/'.$result->berkas.'" target="_blank" class="btn btn-info pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Download Berkas</a>';
						  }
						  else {
							  echo'<a href="#" class="btn btn-info pull-right disabled" style="margin-right: 5px;"><i class="fa fa-download"></i> Tidak ada berkas</a>';
						  }
						  ?>
						  <a class="btn btn-default pull-right"  href="<?= base_url();?>konfirmasi_unitkerja">Kembali</a>
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
     