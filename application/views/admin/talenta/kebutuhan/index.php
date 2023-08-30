<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Analisis Kebutuhan</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>


        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Analisis Kebutuhan</h3>

                    <a href="<?=base_url('talenta/kebutuhan/add')?>" class="btn btn-primary"><i class="ti-plus"></i> Tambah Analisis Kebutuhan</a>
                    <hr>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>SKPD</th>
                                    <th>Nama Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            foreach($dt_kebutuhan as $row){ ?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td><?= $row->nama_skpd ;?></td>
                                    
                                    <td><?= $row->nama_jabatan ;?></td>
                                    <td>
                                        <a href="<?=base_url('talenta/kebutuhan/detail').'/'.$row->id_kebutuhan?>" class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                </tr>
                            <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
