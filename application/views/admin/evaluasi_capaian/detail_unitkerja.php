

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
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li><a href="<?= base_url();?>evaluasi_capaian">Evaluasi Capaian</a></li>
        <li class="active">Detail Unit Kerja Kegiatan</li>
      </ol>
		</div>
		<!-- /.breadcrumb -->
	</div>
	<div class="row">
		
	</div>
	<br>

	<div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<div class="row">
					<form method="POST">
						<div class="col-md-3 b-r">
							<center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>   
						</div>
						<div class="col-md-9">
							<div class="panel panel-inverse">
								<div class="panel-heading"> <?= $rkt->nama_unit_kerja;?>
									<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
								</div>
								<div class="panel-wrapper collapse in" aria-expanded="true">
									<div class="panel-body">
										<table class="table">
                                    <table class="table">
                                        <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?= $detail_unit['nama_kepala'];?></strong></tr>
                                        <tr><td style="width: 120px;">Jabatan </td><td>:</td><td> <strong><?= $detail_unit['nama_jabatan'];?></strong></tr>
                                        <tr><td style="width: 120px;">Jumlah Staff </td><td>:</td><td> <strong><?= $detail_unit['jumlah_pegawai'];?></strong>

												</table>
											</div>
										</div>
									</div>


								</div>

							</form>
						</div>

					</div>
				</div>

			</div>

	<?php
		$CI = & get_instance();
		$CI->load->model("pencapaian_model");
		$CI->load->model("indikator_model");
		$GLOBALVAR = GLOBALVAR;
		//var_dump($sasaran);
		foreach ($sasaran as $row) {
			$jumlahIndikator = $CI->indikator_model->getTotal($_type,$row->id_unit_kerja,$rkt->tahun_rkt,$row->uid_ss);

			$params1 = array(
				'type'			=> $_type,
				'where'			=> array(
//					'indikator_turunan.id_unit_kerja' => $editdata[0]->id_unit_kerja,
					'indikator_turunan.uid_ss_bawahan' => $row->uid_ss,
				),
			);
			$ss_atasan = $CI->indikator_model->getIndikatorTurunan($params1);
			$SSAtasan = ($ss_atasan!=null) ? $ss_atasan[0]->kode_sasaran_atasan." - ".$ss_atasan[0]->nama_sasaran_atasan : "-";

			
			if($_type=="SS"){
				$id_sasaran = "id_sasaran_strategis";
			}
			elseif ($_type=="SP") {
				$id_sasaran = "id_sasaran_program";
			}
			elseif ($_type=="SK") {
				$id_sasaran = "id_sasaran_kegiatan";
			}

			$paramsIKU = array(
				'type'	=> $_type,
				'id_sasaran' => $row->$id_sasaran,
			);
			$data_iku = $CI->indikator_model->getIndikator($paramsIKU);


			//echo "<pre>";print_r($pencapaian_detail); echo "</pre>";
			echo '
			<!-- .row -->
			<div class="row">	
				<div class="col-md-12">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="white-box">

								<div class="row">

									<div class="col-md-2 b-r">
										<div class="chart easy-pie-chart-2" data-percent="'.number_format($row->capaian).'"> <span class="percent">'.$row->capaian.'</span> </div>
									</div>
									<div class="col-md-10">
										<div class="panel">
											<div class="panel-heading"> '.$row->$kode_sasaran.' - '.$row->$nama_sasaran.'
												<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
											</div>
											<div class="panel-wrapper collapse in" aria-expanded="true">
												<div class="panel-body">
													<table class="table">
														<tr><td style="width: 120px;">Bobot</td><td>:</td><td> <strong>'.$row->bobot.'%</strong></tr>
														<tr><td style="width: 120px;">SS. Atasan</td><td>:</td><td> <strong>'.$SSAtasan.'</strong></tr>
														<!--<tr><td style="width: 120px;">Sumber Data</td><td>:</td><td> <strong>Sektreatiat</strong></tr>	-->
														<tr><td>Jumlah Iku </td><td>:</td><td> <strong>'.number_format($jumlahIndikator).'</strong></tr>

													</table>
												</div>
											</div>
										</div>
									</div>

								</div>';

						foreach ($data_iku as $iku) {
							
							echo'

								<div class="row">
									<h3>'.$iku->kode_indikator.'/'.$iku->nama_indikator.'</h3>
									<div class="col-md-12">
										<table class="table color-table dark-table table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Bulan</th>
													<!--
													<th>Target</th>
													<th>Realisasi</th>
													-->
													<th>Capaian</th>
													<th>Status Capain </th>
													<th>File</th>
													<th>Opsi</th>
													
												</tr>
											</thead>
											<tbody>';
													
													$paramCD = array(
														'pencapaian_indikator_detail.uid_iku' => $iku->uid_iku,
														'pencapaian_indikator_detail.tahun'		=> $rkt->tahun_rkt,
													);
													$pencapaian_detail = $CI->pencapaian_model->getCapaianIndikatorDetail($paramCD);


													foreach ($pencapaian_detail as $r) {
														$status_capaian = ($r->capaian==100) ? "Tercapai" : "-";
														if($r->status_evaluasi==0 && $r->capaian>0)
														{
															$btn = '<button type="button" class="btn btn-default" onclick="tolak('.$r->id_capaian_indikator.')" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" >Tolak</button>
																	<button type="button" class="btn btn-primary" onclick="setuju('.$r->id_capaian_indikator.')" >Setujui</button>'; 
														}
														else $btn = '';
														$btn_update = ($r->status_evaluasi!=0 ) ? 
															'<button onclick="update_('.$r->id_capaian_indikator.')"class="btn btn-primary">Batalkan Evaluasi</button>' : '';
														
														$filePendukung = "";
														if($r->berkas){
															$filePendukung = "<a href='".base_url().'data/capaian/'.$r->berkas."'> ".$r->berkas."</a> <br>";
														}
														
														if($r->dijadwalkan==1){
															echo '
																<tr>
																	<td>'.$r->bulan.'</td>
																	<td>'.$GLOBALVAR['bulan'][$r->bulan].'</td>
																	<!--
																	<td></td>
																	<td></td>
																	-->
																	<td>'.number_format($r->capaian,0).'%</td>
																	<th>'.$status_capaian.'</th>
																	
																	<td>'.$filePendukung.'</td>
																	<td>
																		'.$btn_update
																		.$btn.'
																		
																	</td> 


																</tr>';
														}
														else{
															echo '
											                <tr class="warning">
											                  <td>'.$r->bulan.'</td>
											                  <td>'.$GLOBALVAR['bulan'][$r->bulan].'</td>
											                  <td colspan="6"><p align="center">- Tidak di jadwalkan -</p></td>
											                </tr>
											                ';
														}
													}
													if($pencapaian_detail==null)
													{
														 echo '
											                <tr class="warning">
											                  <td colspan="6"><p align="center">- Tidak ada data -</p></td>
											                </tr>
											                ';
													}
							echo'
															</tbody>
											</table>
										</div>

									</div>';

								}

							echo '	

								</div>




							</div>

						</div>    


					</div>
									<!-- .row -->

				</div>
				';
			}
			?>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel1">Penolakan Capaian</h4>
                    </div>
                    <div class="modal-body">
                    	<form id="data-form" action="#!" enctype="multipart/form-data" >
                    			<div class="form-group">
                                    <label class="col-md-12">Alasan Penolakan :</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="alasan_penolakan" id="alasan_penolakan"></textarea>
                                        <input type="hidden" name="status_evaluasi" id="status_evaluasi" />
                                        <input type="hidden" name="type" value="<?= $_type; ?>" />
                                        <input type="hidden" name="id_capaian_indikator" id="id_capaian_indikator" />
                                    </div>
                                </div>
                     	</form>
                      <div class="modal-footer" style="margin-top: 40px;">
                      	<br>
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top: 20px;">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-top: 20px;" onclick="submitData(2)">Simpan</button>

                      </div>
                    </div>
                  </div>
                </div>
            </div>

<script type="text/javascript">
	function setuju(id_capaian_indikator)
	{
		setStatus(id_capaian_indikator,1);
		submitData(1)
	}
	function update_(id_capaian_indikator)
	{
		setStatus(id_capaian_indikator,0);
		submitData(0)
	}
	function tolak(id_capaian_indikator)
	{
		setStatus(id_capaian_indikator,2);
	}
	function setStatus(id_capaian_indikator,status)
	{
		$("#id_capaian_indikator").val(id_capaian_indikator);
		$("#status_evaluasi").val(status);
	}

	function submitData(status)
	{
		$.ajax({
	        url:"<?php echo base_url('evaluasi_capaian/update_status/'.$this->uri->segment(3));?>",
	        type:"POST",
	        data: $('#data-form').serialize(),
	        //data : formData,

	        success:function(resp){
	          if (resp == true) {
	          	var Message = (status==1) ? "Data telah disetujui" : (status==2) ? "Data telah ditolak." : "Data telah diupdate";
	            swal("Success!", Message, "success");
	            window.location.reload(false); 
	          } else {
	            alert('Error Message: '+ resp);
	            console.log(resp);
	          }
	        },
	        error:function(event, textStatus, errorThrown) {
	          alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
	        }
	    });
	}
</script>