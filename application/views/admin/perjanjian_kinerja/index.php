<div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Perjanjian Kinerja</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url();?>admin">Dashboard</a></li>
                <li class="active">Perjanjian Kinerja</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- .row -->


<div class="col-md-4 col-xs-12">
  <div class="panel panel-default">
                            <div class="panel-heading">
                             Fitler Perjanjian Kinerja

                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    
        <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;">
<a href="<?=site_url('perjanjian_kinerja/add')?>" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Perjanjian Baru</a>
                <hr/>
              </div>
            </div>

                                    <form method="POST">
                                      <div class="form-group">
                                            <label for="exampleInputEmail1">Tahun</label>
                                            <select class="form-control" name="tahun_berkas" required>
                                              <option value="">Pilih Tahun</option>
                                              <?php 
                                              foreach($tahun as $r){
                                                echo'<option value="'.$r->tahun_rkt.'">'.$r->tahun_rkt.'</option>';
                                              }
                                              ?>
                                            </select>
                                        </div>
                                        <?php if($user_level=='Administrator'){?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Unit Kerja</label>
                                            <select name="id_unit_kerja" class="form-control">
                                              <option value="">Semua Unit Kerja</option>
                                              <?php 
                                              foreach($unit_kerja as $r){
                                                echo'<option value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
                                              }
                                              ?>
                                            </select>
                                          </div>
                                          <?php } ?>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Pegawai</label>
                                            <input type="text" name="nama_lengkap" class="form-control" id="exampleInputEmail1" >
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">NIP / NRP </label>
                                            <input type="text" name="nip" class="form-control" id="exampleInputPassword1">
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="exampleInputEmail1">Status Perjanjian</label>
                                            <select class="form-control">
                                              <option>Sudah Ada</option>
                                              <option>Belum Ada</option>
                                   
                                            </select> 
                                          </div> -->
                                       
                                      
                                   
                                    <div class="m-t-15 collapseblebox dn">
                                        <div class="well">
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer"> 

                                  <button type="reset" class="btn btn-default"> Reset</button>
                                  <button type="submit" class="btn btn-primary"> Filter</button>
                                   </form>
                                 </div>
                            </div>
                        </div>
</div>





<div class="col-md-8 col-sm-8 col-xs-12">
  <div class="panel panel-default">
                            <div class="panel-heading">Daftar Perjanjian Kerja</div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tahun</th>
                                            <th>Unit Kerja</th>
                                            <th>NIP / NRP</th>
                                            <th>Nama Pegawai</th>
                                            <th>Status Perjanjian</th>
                                            <th>File</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $no=1;
                                        foreach($item as $t){
                                            if ($t->pk) {
                                              $label_status = "label-success";
                                              $text_status = "Sudah diupload";
                                            } else {
                                              $label_status = "label-danger";
                                              $text_status = "Belum ada";
                                            }
                                          ?>
                                          <tr>
                                            <td><?=$no?></td>
                                            <td><?=$t->tahun_berkas?></td>
                                            <td><?=$t->nama_unit_kerja?></td>
                                            <td><?=$t->nip?></td>
                                            <td><?=$t->nama_lengkap?></td>
                                            <td><span class="label <?=$label_status?>"><?=$text_status?></span> </td>
                                            <td>
                                              <?php if (!empty($t->pk)):?><a href="<?=base_url('data/berkas_unit_kerja/'.$t->pk.'')?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Unduh Dokumen</a><a href="javascript:void(0)" onclick="delete_berkas(<?=$t->id_berkas?>,'pk')" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Hapus Dokumen</a><?php endif;?></td>
                                            <td>
                                              <a href="<?=base_url('perjanjian_kinerja/download_pk/'.$t->tahun_berkas.'/'.$t->id_unit_kerja)?>" id="button-template" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Unduh Template</a>
                                              <a href="#!" onclick="upload_berkas('<?=$t->id_berkas?>','pk');" class="btn btn-success btn-sm" ><i class="fa fa-pencil"></i>Unggah Dokumen</a></td>
                                          </tr>

                                          <?php $no++; } ?>
                                        
                                    </tbody>
                                </table>



                                </div>
                                <div class="panel-footer"> </div>
                            </div>
                        </div>
</div>
</div>
                <!-- sample modal content -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
                            </div>
                          <form id="form-upload" method="POST" enctype="multipart/form-data" >
                            <div class="modal-body">
                                <div class="form-group">
                    <label class="control-label">Unggah Berkas</label>
                    <input type="file" name='userfile' id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                  </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary ">Simpan</button>
                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

<script type="text/javascript">
	function delete_(id)
	{
		if (confirm('Apakah anda yakin akan menghapus data?')){
			window.location.href= "<?= base_url();?>ref_kode_kegiatan/delete/"+id;
		}
	}

  function delete_berkas(id,col){
        swal({
          title: "Hapus Data",
          text: "Apakah anda yakin akan menghapus data ini?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Ya',
          cancelButtonText: "Tidak",
          closeOnConfirm: false
        },
        function(isConfirm){
          if (isConfirm){
            $.ajax({
              url : "<?=base_url().'berkas_unit_kerja/delete_berkas/'?>"+id+"/"+col,
              type: "POST",
              success: function(data)
              {
                swal("Berhasil", "Data Berhasil Dihapus!", "success");
                location.reload();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert('Error deleting data');
                location.reload();
              }
            });
          }
        });
      }

    function upload_berkas(id,col) {
      $('#myModal').modal();
      $('#myModalLabel').text('Unggah Berkas Perjanjian Kinerja');
      var col = "pk";
      var tahun_rkt = $('#tahun_rkt').val();
      var id_unit = $('#id_unit').val();
      if (id) {
        $('#form-upload').attr('action',"<?=base_url().'perjanjian_kinerja/upload_berkas/'?>"+id+"/"+col+"/"+id_unit+"/"+tahun_rkt);
      } else {
        $('#form-upload').attr('action',"");
      }
    }
</script>