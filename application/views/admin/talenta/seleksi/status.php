<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Status Seleksi Calon Talent</h4> </div>
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
                foreach($dt_pendaftaran as $row) {
            ?>
            <div class="col-md-12">
            <!--
            <?php if($row->status_seleksi=="Lolos" && $row->sasaran_kinerja==0){?>
                <div style="background-color: #00c292;padding:5px;color: #fff;text-align: center;font-weight: 600;font-size: 15px"><i class="ti-check"></i> Anda lolos pada seleksi ini, silahkan upload hasil uji kompetensi anda</div>
            <?php }?>    
            -->
                <div class="white-box">
                    <div class="row">
                        <span class="pull-right label label-primary"><?=date('d M', strtotime($row->tanggal_buka)) .' - '. date('d M Y', strtotime($row->tanggal_tutup)) ;?></span>
                        <h5><b><?= $row->nama_jabatan;?></b></h5>
                        <h5><small><i style="color: #6003c8" class="ti-pulse fa-fw"></i> Eselon <?= $row->eselon;?></small></h5>
                        <h5><small><i style="color: #6003c8" data-icon="&#xe030;" class="linea-icon linea-aerrow fa-fw"></i> <?= $row->nama_skpd;?></small></h5>
                    </div>
                    <div class="row">
                        
                        <a href="<?=base_url('talenta/seleksi/detail')."/".$row->id_kebutuhan?>" class="btn btn-xs btn-primary btn-outline">Detail</a>
                        
                        <?php if($row->status_seleksi=="Belum diverifikasi" && !$row->file_kompetensi){?> 
                        <a href="javascript:void(0)" onclick="upload_kompetensi(<?= $row->id_pendaftaran ;?>)" data-toggle="modal" data-target="#kompetensi"  class="btn btn-xs btn-primary">Upload scan kompetensi</a>
                        <?php } 
                        if($row->status_seleksi=="Belum diverifikasi" && !$row->file_potensi){?> 
                        <a href="javascript:void(0)" onclick="upload_potensi(<?= $row->id_pendaftaran ;?>)"  data-toggle="modal" data-target="#potensi"  class="btn btn-xs btn-primary">Upload scan potensi</a>
                        <?php } ?>
                        <span class="pull-right">
                            <b>Status</b><br>
                            <span class="label label-<?= ($row->status_seleksi=="Lolos") ? "success" : "danger" ;?>"><?= $row->status_seleksi;?></span>
                        </span>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="row">
                <div class="col-md-12 pager">
                <?= make_pagination($pages,$current);  ?>    
                </div>

            </div>

        </div>
    </div>

  <div id="kompetensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Upload berkas</h4> </div>
                    <form method="POST" enctype='multipart/form-data' action="<?=base_url();?>talenta/seleksi/upload_kompetensi">
                    <input type="hidden" name="id_pendaftaran" id="id_pendaftaran_kompetensi"/>
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label>Scan Berkas Kompetensi</label>
                                <input type="file" class="dropify" name="file_kompetensi">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect"><i class="fa icon-upload"></i> Upload</button>
                        <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tutup</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        
        <div id="potensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Upload berkas</h4> </div>
                    <form method="POST" enctype='multipart/form-data' action="<?=base_url();?>talenta/seleksi/upload_potensi">
                    <input type="hidden" name="id_pendaftaran" id="id_pendaftaran_potensi"/>
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label>Scan Berkas Potensi</label>
                                <input type="file" class="dropify" name="file_potensi">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect"><i class="fa icon-upload"></i> Upload</button>
                        <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tutup</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

<script>
    function upload_kompetensi(id_pendaftaran)
    {
        $("#id_pendaftaran_kompetensi").val(id_pendaftaran);
        
    }
    function upload_potensi(id_pendaftaran)
    {
        $("#id_pendaftaran_potensi").val(id_pendaftaran);
    }
</script>