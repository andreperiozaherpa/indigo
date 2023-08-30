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
		<div class="col-md-12 col-sm-12 col-xs-12">
			<?php
			$tipe = (empty($error)) ? "info" : "danger";
			if (!empty($message)) {
			?>
				<div class="alert alert-<?= $tipe; ?> alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<?= $message; ?>
				</div>
			<?php } ?>
			<div class="x_panel">
				<form method='post'>
					<div class="x_content">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									Mass Reset Password
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<?php 
												if(isset($result)){
													foreach($result as $r){
														?>
														<p>
														<b><?=$r['username']?></b> : <span class="text-<?=$r['status']?>"><?=$r['text']?></span>
														</p>
														<?php
													}
													echo "<hr>";
												}
											?>
											<div class="form-group">
												<label>List NIP / Username</label>
												<small style="display: block;margin-bottom:10px;">Pisahkan setiap NIP dengan garis baru</small>
												<textarea id="listNIP" onkeyup="getJumlah()" rows="10" class="form-control" name="list_nip" placeholder="Masukkan List NIP yang Akan Direset" required></textarea>
												<small><span style="font-weight: bold" id="jmlnip">0</span> NIP terdeteksi </small>
											</div>
											<div class="pull-right">
												<button type='submit' class='btn btn-primary'>Reset Password</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			</form>
		</div>
	</div>
</div>
</div>
<script>
	function getJumlah(){
		var jumlah = $('#listNIP').val().split("\n").length;
		$('#jmlnip').html(jumlah);
	}
</script>