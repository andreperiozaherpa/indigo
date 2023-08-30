
            <div class="container-fluid">

                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Semua Berita</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>
								<a href="<?php echo base_url();?>manage_post">Berita</a>
							</li>
							<li class="active">
								<strong>Semua</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                        	<div class="pull-right">
                        		<form role="search" class="app-search hidden-xs m-r-10">
		                            <input type="text" name="s" placeholder="Cari..." class="form-control" style="background:#eee;"> <a href="" class="active"><i class="fa fa-search"></i></a>
		                        </form>
                        	</div>
                            <h3 class="box-title"><a href="<?php echo base_url();?>manage_post/add" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Baru</a></h3>
                            <p class="text-muted m-b-20"></p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
											<th>#</th>
											<th>Judul</th>
											<th>Kategori</th>
											<th>Pembuat</th>
											<th>Tanggal Posting</th>
											<th>Hits</th>
											<th>Status</th>
											<th width=70px>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$num = 0;
											if (!empty($offset)) $num = $offset;
											foreach ($query as $row) {
												$num++;
												echo"
													<tr>
														<td>$num</td>
														<td>
															<a target='_blank' href='".base_url()."berita/read/$row->title_slug' >$row->title</a></td>
														<td>";
														if ($row->category_name!="")
															echo"
															<a target='_blank' href='".base_url()."berita/category/$row->category_slug' >
															$row->category_name</a>";
														else
															echo "::Internal::";
												echo"
														</td>
														<td>$row->full_name</td>
														<td>
															". date('d M Y',strtotime($row->date)) ." $row->time
														</td>
														<th>$row->hits</th>
														<td>$row->post_status</td>
														<td>
															<a href='".base_url()."manage_post/edit/$row->post_id' class='btn-xs' title='Edit' data-toggle=\"tooltip\" data-original-title=\"Edit\">
																
																<i class=\"fa fa-pencil text-inverse m-r-10\"></i> 
															</a>
															<a class='btn-xs' title='Delete'  onclick='delete_(\"$row->post_id\")' data-toggle=\"tooltip\" data-original-title=\"Close\">
																<i class=\"fa fa-close text-danger\"></i>
															</a>
															
														</td>
													</tr>
												";

												
											}
											if ($num==0){
												echo"
													<tr>
													<td colspan=8 align=center>No data</td>
													</tr>
												";
											}
										?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
		
								echo"<div class='row'>
								<div class='col-md-12 pager'>";

		                        $CI =& get_instance();
		                        $CI->load->library('pagination');

		                        $config['base_url'] = base_url(). 'manage_post/index/';
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
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

<script type="text/javascript">
	function delete_(id)
	{
		swal({   
            title: "Apakah anda yakin?",   
            text: "Anda tidak dapat mengembalikan data ini lagi jika sudah terhapus!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Hapus",
            closeOnConfirm: false 
        }, function(){   
        	window.location = "<?php echo base_url();?>manage_post/delete/"+id;
            swal("Berhasil!", "Data telah terhapus.", "success"); 
        });
	}
</script>