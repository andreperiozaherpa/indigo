<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Semua Pengumuman</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                     
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Papan Pengumuman</a></li>
                            <li class="active">Semua</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                                                        <div class="pull-right">
                                <form role="search" class="app-search hidden-xs m-r-10">
                                    <input type="text" name="s" placeholder="Search..." class="form-control" style="background:#eee;"> <a href="" class="active"><i class="fa fa-search"></i></a>
                                </form>
                            </div>
                               <h3 class="box-title"><a href="<?=base_url()?>manage_notice/add_notice"  class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Baru</a></h3>
                                    <p class="text-muted m-b-20"></p>
                            <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                    <tr> 
                                        <th>#</th>
                                        <th>Teks </th>
                                        <th>Tanggal </th>
                                        <th>Status </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($notice as $n){ ?>
                                    <tr> 
                                        <td><?=$no?></td>
                                        <td><?=$n->text?></td>
                                        <td><?=$n->date?></td>
                                        <td><?=$n->status?></td>
                                        <td>
                                            <a href='<?php echo base_url()."manage_notice/edit_notice/".$n->notice_id."" ?>' class='btn-xs' title='Edit' data-toggle="tooltip" data-original-title="Edit">
                                        
                                        <i class="fa fa-pencil text-inverse m-r-10"></i> 
                                    </a>
                                    <a class='btn-xs' title='Delete'  onclick='delete_("<?=$n->notice_id?>")' data-toggle="tooltip" data-original-title="Close">
                                        <i class="fa fa-close text-danger"></i>
                                    </a></td>
                                    </tr>
                                    <?php $no++; } ?>
                                </tbody>
                                    
                                    
                                    </table>
                                </div>
                        </div>
                    </div>
	            </div>
	            </div>

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
            window.location = "<?php echo base_url();?>manage_notice/delete/"+id;
            swal("Berhasil!", "Data telah terhapus.", "success"); 
        });
    }
</script>