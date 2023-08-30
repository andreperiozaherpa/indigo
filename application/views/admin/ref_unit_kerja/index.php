<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Daftar Unit Kerja</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Beranda</a>
							</li>
							<li class="active">		
								<strong>Unit Kerja</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                       

					<?php
					if (!empty($pesan)){
						$type = !empty($error) ? "danger" : "info";
						echo'
					<div class="alert alert-'.$type.' alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						'.$pesan.'
						</div>
						';
					}?>
 <div class="row">

 <div class="col-sm-12 col-md-4">

                <div class="white-box">
                	<div class="row">

                  <form class="form-horizontal form-label-left" method='post'>
					<div class="form-group">
                        <label>Nama Unit Kerja <span class="required">*</span></label>
						<input type="text" value='<?php if (!empty($nama_unit_kerja)) echo $nama_unit_kerja;?>' class="form-control" name='nama_unit_kerja' placeholder="Nama Unit Kerja">
                    </div>
				<?php
				if ($action=="Tambah"){ ?>
				
                    <div class="form-group">
                        <label>Level Unit Kerja <span class="required">*</span></label>
                          <select class="form-control" name='level_unit_kerja' onchange='getInduk()' id='level_unit_kerja'>
                           <?php
							for ($i=0;$i<=4;$i++){
								if (!empty($level_unit_kerja) && $level_unit_kerja==$i) $selected = "selected";
								else $selected = "";
								echo "<option value='$i' $selected>$i</option>";
							}
						   ?>
                          </select>
                    </div>
					<?php
				
						if (!empty($unit_kerja_level)) $display = "block"; else $display ="none";
					?>
					<div class="form-group" id='judul_induk' style='display:<?php echo $display;?>'>
                        <label>Unit Kerja Induk <span class="required">*</span></label>
                    </div>
					<?php
					for($i=0;$i<=4;$i++){
						$display = "none";
						$val = $option = "";
						if (!empty($unit_kerja_level)){
							if ($unit_kerja_level[$i]>=0) {
								$display = "block";
								$exp = explode("-",$unit_kerja_level[$i]);
								$val = $exp[0];
								$option = $exp[1];
							}
						}
						echo'
						<div class="form-group" id="induk'.$i.'" style="display:'.$display.'">
							  <select onchange="get_sub_induk('.$i.')" class="form-control" name="unit_kerja_level'.$i.'" id="unit_kerja_level'.$i.'">
								<option value="'.$val.'">'.$option.'</option>
							  </select>
						</div>
					';
					}
				}?>
                    <div class="form-group">
                        <label>Berkas-berkas</label>
                        <div class="checkbox checkbox-circle">
                        	<input type="hidden" name="set_renstra" value="off">
                            <input id="set_renstra" name="set_renstra" type="checkbox" <?php if (empty($set_renstra) OR $set_renstra == 'on') echo 'checked';?>>
                            <label for="set_renstra"> Renstra </label>
                        </div>
                        <div class="checkbox checkbox-circle">
                        	<input type="hidden" name="set_rkt" value="off">
                            <input id="set_rkt" name="set_rkt" type="checkbox" <?php if (empty($set_rkt) OR $set_rkt == 'on') echo 'checked';?>>
                            <label for="set_rkt"> RKT </label>
                        </div>
                        <div class="checkbox checkbox-circle">
                        	<input type="hidden" name="set_pk" value="off">
                            <input id="set_pk" name="set_pk" type="checkbox" <?php if (empty($set_pk) OR $set_pk == 'on') echo 'checked';?>>
                            <label for="set_pk"> PK </label>
                        </div>
                        <div class="checkbox checkbox-circle">
                        	<input type="hidden" name="set_lkj" value="off">
                            <input id="set_lkj" name="set_lkj" type="checkbox" <?php if (empty($set_lkj) OR $set_lkj == 'on') echo 'checked';?>>
                            <label for="set_lkj"> LKJ </label>
                        </div>
                    </div> 

                    <div class="ln_solid"></div>
			          <div class="form-group">
			            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
			              <a href='<?php echo base_url();?>ref_unit_kerja' class="btn btn-default">Batal</a>
			              <input type="submit" class="btn btn-primary" value="<?=$action?>">
			            </div>
			          </div>

                   </form>
                </div>
                </div>
 </div>

                    <div class="col-sm-12 col-md-8">
                        <div class="white-box">
                        	
                           
                            <div class="table-responsive">

                    <table  class="table table-striped">
                      <thead>
                        <tr>
						  <th>No</th>
                          <th>Kode Unit Kerja</th>
                          <th>Nama Unit Kerja</th>
						  <th>Level</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
					  <?php
					  $no=$offset;
						
						if ($result)
						{
							//$jml=count($result);
							$jml = $offset + $per_page;
							for($no;$no<$jml;$no++){
								if (!empty($result[$no])){
								$margin = ($result[$no]['level_unit_kerja'] * 10 ) - 10;

								switch ($result[$no]['level_unit_kerja']) {
									case '0':
										$color = 'primary';
										break;

									case '1':
										$color = 'danger';
										break;
									
									case '2':
										$color = 'warning';
										break;
									
									case '3':
										$color = 'success';
										break;
									
									case '4':
										$color = 'info';
										break;
									
									default:
										$color = '';
										break;
								}
								?>
								<tr class="<?= $color;?>">
								  <td><?=($no+1);?></td>
								  <td><?= $result[$no]['kode_unit_kerja'];?></td>
								  <td><i class='fa fa-angle-right' style='margin-left:<?= $margin;?>px'></i>
								  <?= $result[$no]['nama_unit_kerja'];?>
								  </td>
								  <td><?= $result[$no]['level_unit_kerja'];?></td>
								  <td>
								   <a href="<?php echo base_url(). "ref_unit_kerja/view/" .$result[$no]['id_unit_kerja'];?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Lihat </a>
									<a href="<?php echo base_url(). "ref_unit_kerja?action=Edit&id=" .$result[$no]['id_unit_kerja']."&per_page=".$offset;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
								  </td>
								</tr>
								<?php
							}
							}
						}					  
						?>
                      
                    </table><div class='row'>
						<div class='col-md-12 pager'>
						<?php
			
						
							$CI =& get_instance();
							$CI->load->library('pagination');

							$config['base_url'] = base_url(). 'ref_unit_kerja/index/';
							$config['total_rows'] = $total_rows;
							$config['per_page'] = $per_page;
							$config['attributes'] = array('class' => 'btn btn-primary btn-xm marginleft2px');
							$config['page_query_string']=TRUE;
							$CI->pagination->initialize($config);
							$link = $CI->pagination->create_links();
							$link = str_replace("<strong>", "<button type='button' class='btn btn-primary btn-xm disabled marginleft2px' >", $link);
							$link = str_replace("</strong>", "</button>", $link);
							echo $link;
							
						?>
						</div>
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
	var level = 0;
	function getInduk()
	{
		
		var level_unit_kerja = $('#level_unit_kerja').val();
		level = level_unit_kerja;
		if (level_unit_kerja!=0){
			$('#judul_induk').show();
			$('#induk0').show();
			for(i=1;i<=4;i++){
				$('#unit_kerja_level'+i).val('');
				$('#induk'+i).hide();
			}
			$.post("<?php echo base_url();?>ref_unit_kerja/get_induk",{'id_induk':9999},function(obj){
				$('#unit_kerja_level0').html(obj);
			});
		} else {
			$('#judul_induk').hide();
			$('#induk0').hide();
			for(i=1;i<=4;i++){
				$('#unit_kerja_level'+i).val('');
				$('#induk'+i).hide();
			}
			// $('#unit_kerja_level1').html('');
		}
	}
	
	function get_sub_induk(no)
	{
		var id_induk = $('#unit_kerja_level'+no).val();
		no++;
		if (no<level){
			var level_unit_kerja = $('#level_unit_kerja'+no).val();
			$('#induk'+no).show();
			$.post("<?php echo base_url();?>ref_unit_kerja/get_induk",{'id_induk':id_induk},function(obj){
				$('#unit_kerja_level'+no).html(obj);
			});
		}
	}
	
</script>