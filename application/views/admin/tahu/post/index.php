
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
								<a href="<?php echo base_url();?>tahu/manage_post">Berita</a>
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
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Total Berita</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-people text-info"></i></li>
                                        <li class="text-right"><span class="counter"><?=$berita?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Berita (Draft)</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-folder text-purple"></i></li>
                                        <li class="text-right"><span class="counter"><?=$berita_draft?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Berita (Publish)</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-folder-alt text-danger"></i></li>
                                        <li class="text-right"><span class="counter"><?=$berita_publish?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Pembaca Berita Harian</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="ti-wallet text-success"></i></li>
                                        <li class="text-right"><span class="counter"><?=$berita_pembaca?></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($berita_terbaru)) { ?>
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="news-slide m-b-15">
                                <div class="vcarousel slide">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <div class="active item">
                                        <?php if (!empty($berita_terbaru->picture)) { 
                                                if (@getimagesize(base_url().'data/images/featured_image/uploads/'.$berita_terbaru->picture)) {
                                                    $path = base_url('data/images/featured_image/uploads/'.$berita_terbaru->picture);
                                                }else {
                                                    $path = base_url('data/logo/layanan.jpg');
                                                }
                                            }else { 
                                            $path = base_url('data/logo/layanan.jpg');
                                        } ?>
                                            <div class="overlaybg"><img src="<?=$path?>" style="object-fit:cover;" /></div>
                                            <div class="news-content"><span class="label label-success label-rounded">Berita Terbaru</span>
                                                <h2><?=$berita_terbaru->title?></h2> <a href="<?=base_url('berita/detail/'.$berita_terbaru->title_slug)?>" target="_blank">Selengkapnya</a></div>
                                        </div>
                                        <div class="item">
                                            <div class="overlaybg"><img src="<?=base_url('data/images/featured_image/uploads/'.$berita_terbaru->picture)?>" style="object-fit:cover;" /></div>
                                            <div class="news-content"><span class="label label-success label-rounded">Berita Terpopuler</span>
                                                <h2><?=$berita_terbaru->title?></h2> <a href="<?=base_url('berita/detail/'.$berita_terbaru->title_slug)?>" target="_blank">Selengkapnya</a></div>
                                        </div>
                                        <div class="item">
                                            <div class="overlaybg"><img src="<?=base_url('data/images/featured_image/uploads/'.$berita_terbaru->picture)?>" style="object-fit:cover;" /></div>
                                            <div class="news-content"><span class="label label-success label-rounded">Terpopuler Bulan Ini</span>
                                                <h2><?=$berita_terbaru->title?></h2> <a href="<?=base_url('berita/detail/'.$berita_terbaru->title_slug)?>" target="_blank">Selengkapnya</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                        	<div class="pull-right">
                        		<form role="search" class="app-search hidden-xs m-r-10">
		                            <input type="text" name="s" placeholder="Cari..." class="form-control" style="background:#eee;"> <a href="" class="active"><i class="fa fa-search"></i></a>
		                        </form>
                        	</div>
                            <h3 class="box-title"><a href="<?php echo base_url();?>tahu/manage_post/add" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Baru</a></h3>
                            <p class="text-muted m-b-20"></p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
											<th>#</th>
											<th>Judul</th>
											<th>Kategori</th>
											<th>Pembuat</th>
											<th>Dibuat</th>
											<th>Dipublish</th>
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
												$badge = 'badge badge-success';
												$status = 'Publish';
												if ($row->post_status != 'Publish') {
													$badge = 'badge badge-warning';
													$status = 'Draft';
												}
												$num++;
												echo"
													<tr>
														<td>$num</td>
														<td>
															<a target='_blank' href='".base_tahu()."berita/detail/$row->title_slug' >$row->title</a></td>
														<td>";
														if ($row->category_name!="")
															echo"
															<a target='_blank' href='".base_tahu()."berita/category/$row->category_slug' >
															$row->category_name</a>";
														else
															echo "::Internal::";
                                                $row->full_name = ($row->full_name) ? $row->full_name : get_pegawai($row->author)->full_name;
												echo"
														</td>
														<td>$row->full_name</td>
														<td>
															". date('d M Y',strtotime($row->date)) ." $row->time
														</td>
														<td>";
                                                                    if (!empty($row->publish_date) && $row->post_status == 'Publish')
                                                                    echo"
                                                                    ". date('d M Y',strtotime($row->publish_date)) ." $row->publish_time";
                                                                    if ($row->post_status != 'Publish')
                                                                    echo "Belum dipublish";
                                                        echo"	</td>
														<th>$row->hits</th>
														<td><span class='$badge'>$status</span></td>
														<td>";
															// if ($this->session->userdata('user_level')==5 || $this->session->userdata('user_level')==1 || $this->session->userdata('user_level') == 7)
															echo"
															<a href='".base_url()."tahu/manage_post/edit/$row->post_id' class='btn-xs' title='Edit' data-toggle=\"tooltip\" data-original-title=\"Edit\">
																
																<i class=\"fa fa-pencil text-inverse m-r-10\"></i> 
															</a>
															<a class='btn-xs' title='Delete' style='cursor: pointer;'  onclick='delete_(\"$row->post_id\")' data-toggle=\"tooltip\" data-original-title=\"Close\">
																<i class=\"fa fa-trash text-danger\"></i>
															</a>";
															// if ($this->session->userdata('user_level')==6 || $this->session->userdata('user_level')==1 || $this->session->userdata('user_level')==7)
                                                                if ($row->post_status != 'Publish') {
                                                                    echo"
                                                                    <a title='Verifikasi Berita' style='cursor: pointer;'  onclick='update_status_(\"$row->post_id\",\"$row->post_status\")' data-toggle=\"tooltip\" data-original-title=\"Verifikasi Berita\">
                                                                    <i class=\"fa fa-check text-success\"></i>
                                                                    </a>";
                                                                }else{
                                                                    echo"
                                                                    <a title='Batalkan Verifikasi Berita' style='cursor: pointer;'  onclick='update_status_(\"$row->post_id\",\"$row->post_status\")' data-toggle=\"tooltip\" data-original-title=\"Batalkan Verifikasi Berita\">
                                                                    <i class=\"fa fa-close text-warning\"></i>
                                                                    </a>";

                                                                }
												echo"	</td>
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

		                        $config['base_url'] = base_url(). 'tahu/manage_post/index/';
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
        	window.location = "<?php echo base_url();?>tahu/manage_post/delete/"+id;
            swal("Berhasil!", "Data telah terhapus.", "success"); 
        });
	}
	function update_status_(id,post_status)
	{
        console.log(post_status);
        var check_status = 'Publish';
        if (post_status == "Publish") {
            check_status = 'Unpublish';
        }
		swal({   
            title: "Apakah anda yakin?",   
            text: "Untuk "+check_status+" Berita Tersebut ? ",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#6610f2",   
            confirmButtonText: check_status,
            closeOnConfirm: false 
        }, function(){   
        	window.location = "<?php echo base_url();?>tahu/manage_post/update_status/"+id;
            swal("Berhasil!", "Data berhasil diupdate.", "success"); 
        });
	}
</script>