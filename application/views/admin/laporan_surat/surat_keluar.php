<div class="container-fluid">
    <div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Data Surat Keluar</h4>
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
                <div class="panel-heading">Tabel Data Surat Keluar</div>
            </div>
                <div class="row">
                   <table id="example23" class="table color-table dark-table table-hover table-bordered">
					<thead>
					<tr  style="text-align: center;">
						<th style="min-width:50px" rowspan="3" align="center" valign="midle">Hash Id</th>
						<th style="min-width:50px" rowspan="3" align="center" valign="midle">Jenis Surat</th>
                        <th style="min-width:50px" rowspan="3" align="center" valign="midle">Id Ref Surat</th>
						<th style="min-width:50px"  rowspan="3" align="center" valign="midle">No Surat</th>
						<th style="min-width:50px"  rowspan="3" align="center" valign="midle">Tahun</th>
						<th style="min-width:50px" rowspan="3" align="center" valign="midle">Perihal</th>
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
                 <?php foreach ($surat_keluar as $sk) { ?>
                <tr>
                    <td><?=$sk->hash_id?></td>
                    <td><?=$sk->jenis_surat?></td>
                    <td><?=$sk->id_ref_surat?></td>
                    <td><?=$sk->nomer_surat?></td>
                    <td><?=thn_hungkul($sk->tgl_surat, 'T')?></td>
                    <td><?=$sk->perihal?></td>
                    <td><?=$sk->lokasi_smpl?></td>
                    <td><?=$sk->lokasi_box?></td>
                    <td><?=$sk->lokasi_rak?></td>
                    <td><?=$sk->catatan?></td>
                </tr>
                 <?php }?>
                </body>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
