<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo title($title) ?></h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<?php echo breadcrumb($this->uri->segment_array()); ?>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12">
			<div class="row">
                    <div class="col-md-4 col-xs-12 col-sm-6">
                        <div class="white-box text-center bg-info">
                            <h1 class="text-white counter">165</h1>
                            <p class="text-white">Inisiatif</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-6">
                        <div class="white-box text-center">
                            <h1 class="counter">2065</h1>
                            <p class="text-muted">Uji Coba</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-6">
                        <div class="white-box text-center bg-success">
                            <h1 class="text-white counter">465</h1>
                            <p class="text-white">Penerapan</p>
                        </div>
                    </div>
                </div>
                        <div class="white-box">
                            <ul class="nav customtab nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Semua</span></a></li>
                                <li role="presentation" class=""><a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Inisiatif</span></a></li>
                                <li role="presentation" class=""><a href="#messages1" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Uji Coba</span></a></li>
                                <li role="presentation" class=""><a href="#settings1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Penerapan</span></a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="home1">
									<h4>5 Inovasi Daerah Ditemukan.</h4>
									<div class="mt2 mb-4">
										<a href="<?=base_url('lomba_inovasi/add')?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Inovasi</a>
									</div>
									<br>
									<div class="table-responsive">
										<table id="inovasi1" class="display nowrap" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Dibuat Oleh</th>
													<th>Nama Inovasi</th>
													<th>Tahapan Inovasi</th>
													<th>Waktu Uji Coba Inovasi Daerah</th>
													<th>Waktu Penerapan Inovasi Daerah</th>
													<th>Kematangan</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>
														<b>Sekretariat Daerah</b>
													</td>
													<td>Aplikasi Persuratan</td>
													<td class="text-center">
														<span class="badge badge-success ">
															Penerapan
														</span> 
													</td>
													<td>13, Feb 2019</td>
													<td>14, Agustus 2019</td>
													<td>9.00</td>
													<td>
														<a href="#" title="Input Indikator Satuan Inovasi Daerah"><i class="text-muted fa fa-folder"></i></a>&nbsp;
														<a href="#" title="Kirim ke Kemendagri"><i class="text-muted fa fa-paper-plane"></i></a>&nbsp;
														<a href="<?=base_url('lomba_inovasi/edit')?>" title="Edit Proposal"><i class="text-muted fa fa-edit"></i></a>&nbsp;
														<a href="#" title="Hapus Proposal"><i class="text-muted fa fa-trash"></i></a>&nbsp;
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
                                <div role="tabpanel" class="tab-pane fade" id="profile1">
                                    <div class="table-responsive">
										<table id="inovasi5" class="display nowrap" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Nama Perangkat Daerah</th>
													<th>Nama Inovasi</th>
													<th>Tahapan Inovasi</th>
													<th>Waktu Uji Coba Inovasi Daerah</th>
													<th>Waktu Penerapan Inovasi Daerah</th>
													<th>Kematangan</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>
														<b>Sekretariat Daerah</b>
													</td>
													<td>Aplikasi Persuratan</td>
													<td class="text-center">
														<span class="badge badge-success ">
															Penerapan
														</span> 
													</td>
													<td>13, Feb 2019</td>
													<td>14, Agustus 2019</td>
													<td>9.00</td>
													<td>
														<a href="#" title="Input Indikator Satuan Inovasi Daerah"><i class="text-muted fa fa-folder"></i></a>&nbsp;
														<a href="#" title="Kirim ke Kemendagri"><i class="text-muted fa fa-paper-plane"></i></a>&nbsp;
														<a href="<?=base_url('lomba_inovasi/edit')?>" title="Edit Proposal"><i class="text-muted fa fa-edit"></i></a>&nbsp;
														<a href="#" title="Hapus Proposal"><i class="text-muted fa fa-trash"></i></a>&nbsp;
													</td>
												</tr>
											</tbody>
										</table>
									</div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages1">
                                    <div class="table-responsive">
										<table id="inovasi3" class="display nowrap" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Nama Perangkat Daerah</th>
													<th>Nama Inovasi</th>
													<th>Tahapan Inovasi</th>
													<th>Waktu Uji Coba Inovasi Daerah</th>
													<th>Waktu Penerapan Inovasi Daerah</th>
													<th>Kematangan</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>
														<b>Sekretariat Daerah</b>
													</td>
													<td>Aplikasi Persuratan</td>
													<td class="text-center">
														<span class="badge badge-success ">
															Penerapan
														</span> 
													</td>
													<td>13, Feb 2019</td>
													<td>14, Agustus 2019</td>
													<td>9.00</td>
													<td>
														<a href="#" title="Input Indikator Satuan Inovasi Daerah"><i class="text-muted fa fa-folder"></i></a>&nbsp;
														<a href="#" title="Kirim ke Kemendagri"><i class="text-muted fa fa-paper-plane"></i></a>&nbsp;
														<a href="<?=base_url('lomba_inovasi/edit')?>" title="Edit Proposal"><i class="text-muted fa fa-edit"></i></a>&nbsp;
														<a href="#" title="Hapus Proposal"><i class="text-muted fa fa-trash"></i></a>&nbsp;
													</td>
												</tr>
											</tbody>
										</table>
									</div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="settings1">
                                    <div class="table-responsive">
										<table id="inovasi4" class="display nowrap" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Nama Perangkat Daerah</th>
													<th>Nama Inovasi</th>
													<th>Tahapan Inovasi</th>
													<th>Waktu Uji Coba Inovasi Daerah</th>
													<th>Waktu Penerapan Inovasi Daerah</th>
													<th>Kematangan</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>
														<b>Sekretariat Daerah</b>
													</td>
													<td>Aplikasi Persuratan</td>
													<td class="text-center">
														<span class="badge badge-success ">
															Penerapan
														</span> 
													</td>
													<td>13, Feb 2019</td>
													<td>14, Agustus 2019</td>
													<td>9.00</td>
													<td>
														<a href="#" title="Input Indikator Satuan Inovasi Daerah"><i class="text-muted fa fa-folder"></i></a>&nbsp;
														<a href="#" title="Kirim ke Kemendagri"><i class="text-muted fa fa-paper-plane"></i></a>&nbsp;
														<a href="<?=base_url('lomba_inovasi/edit')?>" title="Edit Proposal"><i class="text-muted fa fa-edit"></i></a>&nbsp;
														<a href="#" title="Hapus Proposal"><i class="text-muted fa fa-trash"></i></a>&nbsp;
													</td>
												</tr>
											</tbody>
										</table>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
			</div>
		</div>
	</div>


</div>
<script>
	function confirmDelete() {
		if (confirm("Confirm message")) {
		// do stuff
		} else {
			return false;
		}
	}
	</script>
