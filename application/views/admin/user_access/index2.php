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
						<input type="text" value='<?php if (!empty($access_name)) echo $access_name;?>' class="form-control" name='access_name' placeholder="Nama Unit Kerja">
                    </div>
				<?php
				if ($action=="Tambah"){ ?>
				
                    <div class="form-group">
                        <label>Level Unit Kerja <span class="required">*</span></label>
                          <select class="form-control" name='access_level' onchange='getInduk()' id='access_level'>
                           <?php
							for ($i=1;$i<=2;$i++){
								if (!empty($access_level) && $access_level==$i) $selected = "selected";
								else $selected = "";
								echo "<option value='$i' $selected>$i</option>";
							}
						   ?>
                          </select>
                    </div>
					<?php
				
						if (!empty($level_access)) $display = "block"; else $display ="none";
					?>
					<div class="form-group" id='judul_induk' style='display:<?php echo $display;?>'>
                        <label>Unit Kerja Induk <span class="required">*</span></label>
                    </div>
					<?php
					for($i=1;$i<=2;$i++){
						$display = "none";
						$val = $option = "";
						if (!empty($level_access)){
							if ($level_access[$i]>0) {
								$display = "block";
								$exp = explode("-",$level_access[$i]);
								$val = $exp[0];
								$option = $exp[1];
							}
						}
						echo'
						<div class="form-group" id="induk'.$i.'" style="display:'.$display.'">
							  <select onchange="get_sub_induk('.$i.')" class="form-control" name="level_access'.$i.'" id="level_access'.$i.'">
								<option value="'.$val.'">'.$option.'</option>
							  </select>
						</div>
					';
					}
				}?>
                    <div class="ln_solid"></div>
			          <div class="form-group">
			            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
			              <a href='<?php echo base_url();?>user_access' class="btn btn-default">Batal</a>
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
								$margin = ($result[$no]['access_level'] * 10 ) - 10;

								switch ($result[$no]['access_level']) {
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
								  <td><i class='fa fa-angle-right' style='margin-left:<?= $margin;?>px'></i>
								  <?= $result[$no]['access_name'];?>
								  </td>
								  <td><?= $result[$no]['access_level'];?></td>
								  <td>
								   <a href="<?php echo base_url(). "user_access/view/" .$result[$no]['access_id'];?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Lihat </a>
									<a href="<?php echo base_url(). "user_access?action=Edit&id=" .$result[$no]['access_id']."&per_page=".$offset;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
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

							$config['base_url'] = base_url(). 'user_access/index/';
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
	var level = 1;
	function getInduk()
	{
		
		var access_level = $('#access_level').val();
		level = access_level;
		if (access_level!=1){
			$('#judul_induk').show();
			$('#induk1').show();
			for(i=2;i<=4;i++){
				$('#level_access'+i).val('');
				$('#induk'+i).hide();
			}
			$.post("<?php echo base_url();?>user_access/get_induk",{'id_induk':9999},function(obj){
				$('#level_access1').html(obj);
			});
		} else {
			$('#judul_induk').hide();
			$('#induk1').hide();
			for(i=2;i<=4;i++){
				$('#level_access'+i).val('');
				$('#induk'+i).hide();
			}
			// $('#level_access1').html('');
		}
	}
	
	function get_sub_induk(no)
	{
		var id_induk = $('#level_access'+no).val();
		no++;
		if (no<level){
			var access_level = $('#access_level'+no).val();
			$('#induk'+no).show();
			$.post("<?php echo base_url();?>user_access/get_induk",{'id_induk':id_induk},function(obj){
				$('#level_access'+no).html(obj);
			});
		}
	}
	
</script>