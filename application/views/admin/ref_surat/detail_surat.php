<style type="text/css">
.clear-all, .save-template{
	color: #fff !important;
}
.get-data{
	display: none !important;
}
</style>
<div class="container-fluid">
	
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo title($title) ?></h4> </div>
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
				if (!empty($message)){
					?>
					<div class="alert alert-<?= $type;?> alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<?= $message;?>
					</div>
				<?php }?>
				<div class="x_panel">
						<div class="x_content">
							<div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
								<button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<label id='status'></label>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="panel panel-primary">
										<div class="panel-heading">Detail Surat</div>
										<div class="panel-body">
												<div class="form-group">
													<label>Nama Surat</label>
													<p><?=$detail->nama_surat?></p>
												</div>
												<div class="form-group">
													<label>Jenis Surat</label>
													<p><?=ucwords($detail->jenis_surat)?></p>
												</div>
												<div class="form-group">
													<label>Template </label>
													<p><a style="color: #fff !important" href="<?=base_url('data/template_surat/'.$detail->template_file.'')?>" class="btn btn-primary"><i class="ti-download"></i> Download</a> <a href="javascript:void(0)" class="btn btn-primary btn-outline"  data-toggle="modal" data-target="#myModal"><i class="ti-eye"></i> Lihat</a></p>
												</div>
                        <div class="form-group">
                          <label>Template Bupati</label>
                          <p><a style="color: #fff !important" href="<?=base_url('data/template_surat/'.$detail->template_file_bupati.'')?>" class="btn btn-primary"><i class="ti-download"></i> Download</a> <a href="javascript:void(0)" class="btn btn-primary btn-outline"  data-toggle="modal" data-target="#myModal1"><i class="ti-eye"></i> Lihat</a></p>
                        </div>
                        <div class="form-group">
                          <label>Template Desa/Kelurahan</label>
                          <p><a style="color: #fff !important" href="<?=base_url('data/template_surat/'.$detail->template_file_kel.'')?>" class="btn btn-primary"><i class="ti-download"></i> Download</a> <a href="javascript:void(0)" class="btn btn-primary btn-outline"  data-toggle="modal" data-target="#myModal2"><i class="ti-eye"></i> Lihat</a></p>
                        </div>
                        <div class="form-group">
                          <label>Template Puskesmas</label>
                          <p><a style="color: #fff !important" href="<?=base_url('data/template_surat/'.$detail->template_file_pus.'')?>" class="btn btn-primary"><i class="ti-download"></i> Download</a> <a href="javascript:void(0)" class="btn btn-primary btn-outline"  data-toggle="modal" data-target="#myModal2"><i class="ti-eye"></i> Lihat</a></p>
                        </div>
                        <div class="form-group">
                          <label>Template UPTD</label>
                          <p><a style="color: #fff !important" href="<?=base_url('data/template_surat/'.$detail->template_file_uptd.'')?>" class="btn btn-primary"><i class="ti-download"></i> Download</a> <a href="javascript:void(0)" class="btn btn-primary btn-outline"  data-toggle="modal" data-target="#myModal2"><i class="ti-eye"></i> Lihat</a></p>
                        </div>
                        <div class="form-group">
                          <label>Template DPRD</label>
                          <?php 
                            if(!empty($detail->template_file_dprd)){
                          ?>
                          <p><a style="color: #fff !important" href="<?=base_url('data/template_surat/'.$detail->template_file_dprd.'')?>" class="btn btn-primary"><i class="ti-download"></i> Download</a> <a href="javascript:void(0)" class="btn btn-primary btn-outline"  data-toggle="modal" data-target="#myModal2"><i class="ti-eye"></i> Lihat</a></p>
                          <?php }else{
                            ?>
                            <p class="text-danger">Template belum diupload</p>
                            <?php
                          }
                          ?>
                        </div>
                        <hr>
                    <a href="<?=base_url()."ref_surat/edit/".$detail->id_ref_surat?>" class="btn btn-primary btn-outline btn-rounded btn-block"><i class="ti-pencil"></i> Edit Surat</a>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-outline btn-rounded btn-block"><i class="ti-trash"></i> Hapus Surat</a>
										</div>
									</div>
								</div>
								<div class="col-md-8">	
									<div class="panel panel-primary">
										<div class="panel-heading">
											Formulir
										</div>
										<div class="panel-body">

                    <?php foreach($field as $f) {?>
                    <div class="form-group">

                      <?php if($f->input_type!=='header') {?>
                        <label><?=$f->field_label?></label>
                          <?php if($f->input_type=='text'||$f->input_type=='date'||$f->input_type=='number'||$f->input_type=='file'){ ?>
                          <input type="<?=$f->input_type?>" class="<?=$f->field_class?>" name="<?=$f->field_name?>" placeholder="<?=$f->field_placeholder?>">
                          <?php }elseif($f->input_type=='select'){
                          ?>
                            <?php 
                            if($f->r_table==''&&$f->r_value==''){
                              ?>
                            <select class="<?=$f->field_class?>" name="<?=$f->field_name?>">
                            <option value="">-- Pilih <?=$f->field_label?> --</option>
                              <?php
                              $option = $this->ref_surat_model->get_option($f->id_field);
                              foreach($option as $o){
                                  echo '<option value="'.$o->option_value.'">'.$o->option_label.'</option>';
                              }
                            }elseif($f->r_table=='kabupaten'){
                              ?>
                              <select  onchange="getKecamatanPemohon<?=$f->id_field?>()" id="<?=$f->r_table?><?=$f->id_field?>" class="<?=$f->field_class?>" name="<?=$f->field_name?>">
                              <?php
                                  echo '<option value="">-- Pilih '.$f->field_label.' --</option>';
                                  $data = $this->ref_wilayah_model->get_kabupaten(null,32);
                                  foreach($data as $row){
                                    echo "<option value='".$row->id_kabupaten."'>$row->kabupaten</option>";
                                  }
                              ?>
                              <?php
                            }elseif($f->r_table=='provinsi'){                             
                             ?>
                              <select  onchange="getKabupatenPemohon<?=$f->id_field?>()" id="<?=$f->r_table?><?=$f->id_field?>" class="<?=$f->field_class?>" name="<?=$f->field_name?>">
                              <?php
                                  echo '<option value="">-- Pilih '.$f->field_label.' --</option>';
                                  $data = $this->ref_wilayah_model->get_provinsi(null,null);
                                  foreach($data as $row){
                                    echo "<option value='".$row->id_provinsi."'>$row->provinsi</option>";
                                  }
                              ?>
                              <?php

                            }elseif($f->r_table=='kecamatan'||$f->r_table=='desa'){
                              if($f->r_table=='kecamatan'){
                                  $ajax = 'onchange="getDesaPemohon'.$f->id_field.'()" ';
                              }else{
                                  $ajax = '';
                              }
                              ?>
                              <select <?=$ajax?> id="<?=$f->r_table.$f->id_field?>" class="<?=$f->field_class?>" name="<?=$f->field_name?>">
                              <option value="">-- Pilih <?=$f->field_label?> --</option>
                              <?php

                            }else{
                              ?>
                              <select class="<?=$f->field_class?>" name="<?=$f->field_name?>">
                              <option value="">-- Pilih <?=$f->field_label?> --</option>
                              <?php
                              $option = $this->ref_surat_model->get_option($f->id_field,$f->r_table);
                              foreach($option as $o){
                                $value = $f->r_value;
                                $label = $f->r_label;
                                  echo '<option value="'.$o->$value.'">'.$o->$label.'</option>';
                              }
                            }
                            ?>
                          </select>
                          <?php
                          }elseif($f->input_type=='textarea'){
                            ?>
                            <textarea rows="10" placeholder="<?=$f->field_placeholder?>" class="textarea_editor <?=$f->field_class?>" name="<?=$f->field_name?>" > </textarea>
                            <?php
                          }elseif($f->input_type=='checkbox-group'||$f->input_type=='radio-group'){
                              if($f->input_type=='checkbox-group'){
                                $type = 'checkbox';
                              }else{
                                $type = 'radio';
                              }
                            if($f->r_table==''&&$f->r_value==''){
                              $option = $this->ref_surat_model->get_option($f->id_field);
                              foreach($option as $o){
                                  echo '<br>
                                  <input type="'.$type.'" value="'.$o->option_value.'" name="'.$f->field_name.'">'.$o->option_label.'
                                  ';
                              }
                            }else{
                              $option = $this->ref_surat_model->get_option($f->id_field,$f->r_table);
                              foreach($option as $o){
                                $value = $f->r_value;
                                $label = $f->r_label;
                                  echo '
                                  <br>
                                  <input type="'.$type.'" value="'.$o->$value.'" name="'.$f->field_name.'">'.$o->$label.'
                                  ';
                              }
                            }
                            
                          }
                          ?>
                      <?php }else{ ?>
                        <label> </label>
                        <<?=$f->field_subtype?> style="font-size:20px"><?=$f->field_label?></<?=$f->field_subtype?>>
                      <?php } ?>
                      </div>
                    <?php } ?>

										</div>
									</div>  

									<a href='<?= base_url();?>ref_surat' class='btn btn-default pull-right'>Back</a>

								</div>
						</div>
					</div>
				</div>
			</div>

<div id="exampleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin akan mengapus surat ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <a href="<?=base_url()."ref_surat/delete/".$detail->id_ref_surat?>" class="btn btn-primary">Ya</a>
      </div>
    </div>

  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Preview Template Surat</h4>
      </div>
      <div class="modal-body">
              <iframe src="https://docs.google.com/viewer?url=<?=base_url('data/template_surat/'.$detail->template_file.'')?>
              &embedded=true" width="100%"
              height="700"
              style="border: none;"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Preview Template Surat</h4>
      </div>
      <div class="modal-body">
              <iframe src="https://docs.google.com/viewer?url=<?=base_url('data/template_surat/'.$detail->template_file_bupati.'')?>
              &embedded=true" width="100%"
              height="700"
              style="border: none;"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Preview Template Surat</h4>
      </div>
      <div class="modal-body">
              <iframe src="https://docs.google.com/viewer?url=<?=base_url('data/template_surat/'.$detail->template_file_kel.'')?>
              &embedded=true" width="100%"
              height="700"
              style="border: none;"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>