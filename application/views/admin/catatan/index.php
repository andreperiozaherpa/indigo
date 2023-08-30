
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Catatan</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?=breadcrumb($this->uri->segment_array()) ?>
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
											<div class="col-md-4">
												<div class="row">
													<div class="form-group">
														<label>Nama Catatan</label>
														<input type="text" class="form-control" name="nama" value="" placeholder="Nama Catatan" style="width:90%">
													</div>
												</div>
											</div>
												<div class="col-md-8">
														<div class="row">
																<div class="form-group">
																		<label>Periode Tanggal </label>
																		<div class="input-daterange input-group" id="datepicker">
																						<input type="text" class="form-control" name="start" placeholder="Start" />
																						<span class="input-group-addon bg-primary b-0 text-white">Sampai</span>
																						<input type="text" class="form-control" name="end" placeholder="End" />
																				</div>
																</div>
														</div>
												</div>
										</div>
                      <div class="col-md-2 b-l text-center">
                          <div class="form-group">
                              <br>
                              <button type="submit" class="btn btn-primary m-t-5 btn-outline btn-block"><i class="ti-filter"></i> Filter</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="col-md-2">
            <a href="<?php echo base_url('/catatan/add'); ?> " class="btn btn-primary"><i class="icon-plus"></i> Tambah Catatan </a>
          </div>
          <div class="col-md-10">
						<?php if ($this->session->flashdata('sukses')): ?>
							<div class="alert alert-success text-center">
								<?php echo $this->session->flashdata('sukses'); ?>
							</div>
						<?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
				<?php if ($list == false): ?>
					<br>
					<div class="col-md-12">
						<div class="alert alert-danger">
							Belum ada catatan 
						</div>
					</div>
				<?php endif; ?>
				<?php foreach ($list as $ctt): ?>
        <div class="col-md-4">
          <br>
          <div class="col-md-12">
          <div class="white-box" style="min-height:200px;">
              <div class="col-md-10">
                  <b><?=$ctt->nama_catatan;?> </b>
									<p>
										<small><?=tanggal($ctt->tanggal);?> </small>
									</p>
									<style media="screen">
										.text-limit {
											overflow: hidden;
											text-overflow: ellipsis;
											display: -webkit-box;
											max-height: 60px;
											-webkit-line-clamp: 3;
											-webkit-box-orient: vertical;
										}
									</style>
                  <div class="text-limit">
										<?=$ctt->isi?>
                  </div>
              </div>
                <div class="col-md-2">
                  <div class="pull-right" style="margin-top:10px;">
                    <a href="" class="icon-options-vertical" data-toggle="dropdown" style="font-size:20px;color:grey"></a>
                    <ul role="menu" class="dropdown-menu">
                      <li>
                        <a href="<?php echo base_url('catatan/ubah/'.$ctt->id_catatan); ?> "><i class="icon-pencil"></i> Edit</a>
                      </li>
                      <li>
                        <a href="<?php echo base_url('catatan/delete/'.$ctt->id_catatan); ?> "><i class="icon-trash"></i> Hapus</a>
                      </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
              <a href="<?php echo base_url('catatan/detail/'.$ctt->id_catatan); ?> " class="btn btn-outline-secondary pull-right">Read More..</a>
            </div>
              <br>
            </div>
          </div>
        </div>
				<?php endforeach; ?>
      </div>

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
