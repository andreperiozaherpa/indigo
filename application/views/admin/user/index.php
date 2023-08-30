<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Pengguna</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                     
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pengguna</a></li>
                            <li class="active">Semua Pengguna</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <!-- .col -->

			<div class="col-sm-3">
                <form method="POST">
                <div class="white-box">
                	<h3 class="box-title"><a href="<?php echo base_url();?>manage_user/new" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Baru</a></h3>
                	<hr>
                   <div class="form-group">
                    <label class="control-label"> Username</label>
                    <input type="text" name="username" value="<?= !empty($filter['username']) ? $filter['username'] : "" ;?>" id="firstName" class="form-control" placeholder="">
                </div>

                   <div class="form-group">
                	<label class="control-label"> Nama</label>
                	<input type="text" name="full_name" value="<?= !empty($filter['full_name']) ? $filter['full_name'] : "" ;?>"  id="firstName" class="form-control" placeholder="">
                </div>

              	  <div class="form-group">
                	<label class="control-label">Level Pengguna</label>
                	<select name="user_level" class="form-control">
                        <option value="">Semua Level</option>
                        <?php foreach ($level as $key): ?>
                            <?php
                            $selected = (!empty($filter['user_level']) && $filter['user_level']==$key->level_id) ? "selected" : "" ;
                            ?>
                            <option <?=$selected;?> value="<?php echo $key->level_id ?>"><?php echo $key->level ?></option>
                        <?php endforeach ?>
                    </select>
               	 </div>

               	
                

               	   <button class="btn btn-primary" type="submit"><i class="ti-filter"></i> Filter</button>
                </form>


                </div>
                </div>


                    <div class="col-sm-9">
                    <?php
			foreach ($query as $row) {
				$status = "check";
				if ($row->user_status!="Active") $status="cancel";
				?>
                    <div class="col-md-6 col-sm-6" >
                        <div class="white-box" style="min-height: 310px; max-height: 310px;">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center">
                                     <a href="<?php echo base_url('manage_user/contact/'.$row->user_id); ?>"> <img src="<?php echo base_url('data/user_picture/'.$row->user_picture);?>" alt="user" class=" img-responsive" style="height: 90px; width : 90px; object-fit: cover;"></a>
                                     <hr/>
                                     <div class="well hidden-xs" style="max-height: 135px; overflow: hidden;"><p><strong><?php echo $row->nama_unit_kerja; ?></strong></p></div>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h3 class="box-title m-b-0"> <a href="<?php echo base_url('manage_user/contact/'.$row->user_id); ?>"><?php echo $row->full_name; ?></a></h3>
                                    <small><?php echo $row->email; ?></small>
                                    <p>
                                        <address class="hidden-xs" style="max-height: 160px; overflow: hidden;">
                                            <?php echo $row->bio; ?>
                                            <br/>
                                            <br/>
                                        </address>
                                        <abbr title="Phone">P:</abbr> <?php echo $row->phone; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
			<?php } ?>


			<?php echo"<div class='row'>
					<div class='col-md-12 pager'>";

                        $CI =& get_instance();
                        $CI->load->library('pagination');

                        $config['base_url'] = base_url(). 'manage_user/index/';
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
<script type="text/javascript">
	function delete_(id)
	{
		$('#confirm_title').html('Confirmation');
		$('#confirm_content').html('Are you sure want to delete it?');
		$('#confirm_btn').html('Delete');
		$('#confirm_btn').attr('href',"<?php echo base_url();?>manage_user/delete/"+id);
	}
</script>