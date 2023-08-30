<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Informasi Target dan Realisasi Kegiatan</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li class="active">		
								<strong>Informasi Target dan Realisasi Kegiatan</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                       

<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
 <div class="row">

                    <div class="col-sm-12 col-md-12">
                        <div class="white-box">
                        	
                           
                            <div class="table-responsive">

<table class="table table-striped" id="example23">
<thead>
  <tr>
	<th style="text-align: center" align="center" rowspan="2" width="100px">Tahun</th>
	<th style="text-align: center" align="center" rowspan="2" style="min-width:177px;">Kementerian / Koordinator</th>	
	<th style="text-align: center" align="center" rowspan="2" style="min-width:177px;">Kementerian/Lembaga</th>
	<th style="text-align: center" align="center" rowspan="2">Total<br>Target </th>
	<th style="text-align: center" align="center" colspan="4">Realisasi Kegiatan Yang Dilaporkan </th>
  </tr>
  <tr>
	
	<th style="text-align: center" align="center" width="111px">Triwulan I</th>
	<th style="text-align: center" align="center" width="111px">Triwulan II</th>
	<th style="text-align: center" align="center" width="111px">Triwulan III</th>
	<th style="text-align: center" align="center" width="111px">Triwulan IV</th>
	
  </tr>
	
  </thead>
  <tbody>
  <?php 
  foreach($data as $d){

                        $this->ref_instansi_model->id_instansi = $d->id_koordinator;
                        $nama_koordinator = $this->ref_instansi_model->get_by_id()->nama_instansi;
                        $this->ref_instansi_model->id_instansi = $d->id_sub_koordinator;
                        $nama_lembaga = $this->ref_instansi_model->get_by_id()->nama_instansi;
  	?>

   	  <tr nid="" class="">
		 
		<td style="white-space: nowrap;"><?php echo $d->tahun_realisasi_kegiatan_kl ?></td>
		<td style="white-space: unset;"><?php echo $nama_koordinator ?></td>
		<td style="white-space: unset;"><?php echo $nama_lembaga ?></td>
		<td style="white-space: nowrap;text-align:right;">
			
			<?php echo $this->realisasi_kegiatan_kl_model->get_total_target($d->tahun_realisasi_kegiatan_kl,$d->id_koordinator,$d->id_sub_koordinator) ?>
		</td>

				<?php 
				$triwulan_1 = $this->realisasi_kegiatan_kl_model->get_triwulan(1,$d->tahun_realisasi_kegiatan_kl,$d->id_koordinator,$d->id_sub_koordinator);
				$triwulan_2 = $this->realisasi_kegiatan_kl_model->get_triwulan(2,$d->tahun_realisasi_kegiatan_kl,$d->id_koordinator,$d->id_sub_koordinator);
				$triwulan_3 = $this->realisasi_kegiatan_kl_model->get_triwulan(3,$d->tahun_realisasi_kegiatan_kl,$d->id_koordinator,$d->id_sub_koordinator);
				$triwulan_4 = $this->realisasi_kegiatan_kl_model->get_triwulan(4,$d->tahun_realisasi_kegiatan_kl,$d->id_koordinator,$d->id_sub_koordinator);
				?>
					<td style="white-space: nowrap;text-align:center;<?=$triwulan_1==0 ? 'background: #FA3055;color:#fff;' : ''?>">
						<?php echo $triwulan_1 ?>
					</td>
					<td style="white-space: nowrap;text-align:center;<?=$triwulan_2==0 ? 'background: #FA3055;color:#fff;' : ''?>"> 
						<?php echo $triwulan_2 ?>
					</td>	
					<td style="white-space: nowrap;text-align:center;<?=$triwulan_3==0 ? 'background: #FA3055;color:#fff;' : ''?>">
						<?php echo $triwulan_3 ?> 
					</td>
					<td style="white-space: nowrap;text-align:center;<?=$triwulan_4==0 ? 'background: #FA3055;color:#fff;' : ''?>"> 
						<?php echo $triwulan_4 ?>
					</td>
				
	  </tr>
  	<?php
  }
  ?>
	  
  </tbody>


  </table>
</div>
</div>
</div>
</div>
</div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

<link rel="stylesheet" href="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/responsive/css/datatables.responsive.css">
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/TableTools.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/lodash.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>