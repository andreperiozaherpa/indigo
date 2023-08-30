
<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Agenda</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_agenda">Agenda</a>
							</li>
							<li class="active">		
								<strong>Edit</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">

<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			
				
			</div>
			<div class="panel-body">
				<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
				<form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Tema</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id='tema' value='<?php echo $tema;?>' name='tema' placeholder="">
							<input type="hidden" class="form-control" value='<?php echo $tema;?>' name='old_tema' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-5">
							<p >/agenda/<label id='slug'><?php echo $tema_slug;?></label></p>
							<input type="hidden" class="form-control" value='<?php echo $tema_slug;?>'  id='tema_slug' name='tema_slug' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Isi Agenda</label>
						<div class="col-sm-5">
							<textarea class="form-control" name='isi_agenda'><?php  echo $isi_agenda;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tempat</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name='tempat' placeholder="" value='<?php echo $tempat;?>' >
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Pengirim</label>
						<div class="col-sm-5">
							<input type="text" class="form-control"  name='pengirim' placeholder="" value='<?php echo $pengirim;?>' >
						</div>
					</div>
           		    <div class="form-group">
						<label class="col-sm-2 control-label">Penerima</label>
						<div class="col-sm-5">
	            			<select name="penerima[]" multiple="multiple" id='optgroup'>
	                            <?php foreach ($instansi_penerima as $i_koor): ?>
	                            	<?php if ($i_koor->level == "koordinator"): $array_team = explode(',', $penerima); $selected = (array_search($i_koor->id_instansi, $array_team) === false ) ? '' : 'selected'?>
	                            		<optgroup label="<?php echo "{$i_koor->nama_instansi}" ?>">
	                            			<option value="<?php echo $i_koor->id_instansi ?>" <?php echo $selected ?>><?php echo "{$i_koor->nama_instansi}" ?></option>
	                            			<?php foreach ($instansi_penerima as $i_lbg): ?>
	                            				<?php if ($i_lbg->id_koordinator == $i_koor->id_instansi): $array_team = explode(',', $penerima); $selected = (array_search($i_koor->id_instansi, $array_team) === false ) ? '' : 'selected'?>
	                            					<option value="<?php echo $i_lbg->id_instansi ?>" <?php echo $selected ?>><?php echo "{$i_lbg->nama_instansi}" ?></option>
	                            				<?php endif ?>
	                            			<?php endforeach ?>
                            			</optgroup>
	                            	<?php endif ?>
	                            <?php endforeach ?>
	                        </select>
						</div>
            		</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tanggal mulai</label>
						<div class="col-sm-5">
							<input type="text" name='tgl_mulai'   id="datepicker" class="form-control datepicker" value='<?php echo date("Y-m-d",strtotime($tgl_mulai));?>'   data-format="D, dd MM yyyy">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tanggal selesai</label>
						<div class="col-sm-5">
							<input type="text" name='tgl_selesai'   id="datepicker" class="form-control datepicker"  value='<?php echo date("Y-m-d",strtotime($tgl_selesai));?>'  data-format="D, dd MM yyyy">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Jam</label>
						<div class="col-sm-5">
							<input type="text" name='jam' placeholder='00:00:00' value='<?php echo $jam;?>'  class="clockpicker form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">File</label>
						<div class="col-sm-5">
							<input type="file" name='userfile' id="" class="form-control" />
							<input type="hidden" name='old_file' value="<?php echo $nama_file;?>" id="" class="form-control" />
						</div>
						<div class="col-sm-5">
				<?php if (!empty($message_file)) echo "
				<div class='alert alert-$message_type_file'>$message_file</div>";?>
								Max : 10MB | File sekarang : <?php echo $nama_file;?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2"></div>
						<div class="col-sm-5">
							 <button type="submit" class="btn btn-primary waves-effect waves-light pull-right" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Perbarui</button>

						</div>
						
					</div>
				</form>
			
			</div>

		</div>
	</div>
</div>


   </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            
<script type="text/javascript">
$('#tema').on('input', function() {
    var permalink;
    // Trim empty space
    permalink = $.trim($(this).val());
    // replace more then 1 space with only one
    permalink = permalink.replace(/\s+/g,' ');
    $('#tema_slug').val(permalink.toLowerCase());
    $('#tema_slug').val($('#tema_slug').val().replace(/\W/g, ' '));
    $('#tema_slug').val($.trim($('#tema_slug').val()));
    $('#tema_slug').val($('#tema_slug').val().replace(/\s+/g, '-'));
    var gappermalink = $('#tema_slug').val();
    $('#slug').html(gappermalink);
});
</script>