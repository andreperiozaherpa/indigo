<div class="container-fluid">
    <div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Data Surat Masuk</h4>
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
            <div class="white-box">
                <div class="row">
                    <form method="POST">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="form-group">
                                    <label>Periode Tanggal Surat </label>
                                    <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="form-control" name="start" placeholder="Start" />
                                            <span class="input-group-addon bg-primary b-0 text-white">Sampai</span>
                                            <input type="text" class="form-control" name="end" placeholder="End" />
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                          <div class="col-md-auto">
                                  <br>
                                  <button type="submit" class="btn btn-primary m-t-5 btn-outline btn-block"><i class="ti-filter"></i> Filter </button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
       <div class="row" >
        <div class="col-md-12">
            <div class="white-box" >
            <div class="panel panel-default">
                <div class="panel-heading">Tabel Data Surat Masuk</div>
            </div>
                <div class="row">
                   <table id="example23" class="table color-table dark-table table-hover table-bordered">
					<thead>
					<tr  style="text-align: center;">
						<th style="min-width:50px" rowspan="3" align="center" valign="midle">Kode</th>
						<th style="min-width:50px" rowspan="3" align="center" valign="midle">Kode KLSF</th>
                        <th style="min-width:50px" rowspan="3" align="center" valign="midle">Indeks</th>
						<th style="min-width:50px"  rowspan="3" align="center" valign="midle">Deskripsi Uraian Masalah</th>
						<th style="min-width:50px"  rowspan="3" align="center" valign="midle">Tahun</th>
						<th style="min-width:50px" rowspan="3" align="center" valign="midle">Unit Kerja Pencipta</th>
					</tr>
					<tr>
						<th style="min-width:50px" colspan="3" class="text-center">Lokasi</th>
                        <th style="min-width:50px" rowspan="2" align="center" valign="midle">KET</th>
					</tr>
					<tr>
						<th style="min-width:50px" align="center" valign="midle">SMPL</th>
						<th style="min-width:50px" align="center" valign="midle">BOX</th>
                        <th style="min-width:50px" align="center" valign="midle">RAK</th>
					</tr>
				</thead>
				<tbody>
                 <?php foreach ($surat_masuk as $sm) { ?>
                <tr>
                    <td><?=$sm->no_urut?></td>
                    <td><?=$sm->kode?></td>
                    <td><?=$sm->indeks?></td>
                    <td><?=$sm->perihal?></td>
                    <td><?=thn_hungkul($sm->tanggal_surat, 'T')?></td>
                    <td><?=$sm->pengirim?></td>
                    <td><?=$sm->lokasi_smpl?></td>
                    <td><?=$sm->lokasi_box?></td>
                    <td><?=$sm->lokasi_rak?></td>
                    <td><?=$sm->catatan?></td>
                </tr>
                 <?php }?>
                </body>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
