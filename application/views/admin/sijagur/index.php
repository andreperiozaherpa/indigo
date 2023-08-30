<div class="container-fluid">
    <div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Sijagur</h4>
            </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Monitoring</li>
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
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">Satuan Kerja</label>
												<input type="text" class="form-control"  name="hash_id" placeholder="" value="">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">Metode Pemilihan</label>
												<input type="text" class="form-control" name="nomer_surat" placeholder="" value="">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">Tahun</label>
												<input type="text" id="" name="perihal" placeholder="" class="form-control" value="">
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
			<div class="col-md-12">
				<div class="white-box" style="border-left: solid 3px #6003c8">
					<div class="row table-responsive" >
						<table id="example1" class="table table-striped datatable no-footer">
							<thead>
								<tr>
									<th>No</th>
									<th>Satuan Kerja</th>
									<th>Nama Paket</th>
									<th>Pagu (Rp)</th>
									<th>Metode Pemilihan</th>
									<th>Sumber Dana</th>
									<th>Kode RUP</th>
									<th>Waktu Pemilihan</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($sirup as $key => $value): ?>
								<tr>
									<td><?=$key+1?></td>
									<td><?=$value->nama_skpd?></td>
									<td><?=$value->nama_paket?></td>
									<td><?=rupiah($value->pagu)?></td>
									<td><?=$value->metode_pemilihan?></td>
									<td><?=$value->sumber_dana?></td>
									<td><?=$value->kode_rup?></td>
									<td>
										<?=($value->bulan_pemilihan==date('m') AND $value->tahun_pemilihan==date('Y'))?'<i class="fa fa-circle text-warning"></i> ':'';?>
										<?=($value->bulan_pemilihan<date('m') AND $value->tahun_pemilihan==date('Y'))?'<i class="fa fa-circle text-danger"></i> ':'';?>
										<?=($value->tahun_pemilihan<date('Y'))?'<i class="fa fa-circle text-danger"></i> ':'';?>
										<?=bulan($value->bulan_pemilihan)?> <?=$value->tahun_pemilihan?>
									</td>
									<td>
										<a href="<?=base_url('sijagur/monitoring/detail/'.$value->id_sirup)?>" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-folder"></i> Detail </a>
									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
         </div>


<script type="text/javascript">
	$(document).ready(function () {
		$('#example1 thead tr').clone(true).appendTo( '#example1 thead' );
		$('#example1 thead tr:eq(1) th').each( function (i) {

			var title = $(this).text();
			$(this).html('');
			if(title != 'Opsi' && title != 'No' && title != 'Pagu (Rp)'){
				$(this).html( '<input type="text" class="form-control input-sm" />' );

				$( 'input', this ).on( 'keyup change', function () {
					if ( table.column(i).search() !== this.value ) {
						table
						.column(i)
						.search( this.value )
						.draw();
					}
				} );
			}
		}
		);

		var table = $('#example1').DataTable( {
			orderCellsTop: true,
			fixedHeader: true
		} );

	});
</script>