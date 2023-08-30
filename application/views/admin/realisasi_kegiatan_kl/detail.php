<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Target Kegiatan K/L</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
             <li>
                <a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
            </li>
            <li>	
                <a href="<?php echo base_url();?>manage_category_finance">Target Kegiatan K/L</a>
            </li>
            <li class="active">		
                <strong>Detail</strong>
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
                    <div class="row">
                       <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Tahun</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $detail->tahun_realisasi_kegiatan_kl ?> - Triwulan <?php echo $detail->triwulan ?> </p>
                            </div>
                        </div>
                        <?php       
                        $this->ref_instansi_model->id_instansi = $detail->id_koordinator;
                        $nama_koordinator = $this->ref_instansi_model->get_by_id()->nama_instansi;
                        $this->ref_instansi_model->id_instansi = $detail->id_sub_koordinator;
                        $nama_lembaga = $this->ref_instansi_model->get_by_id()->nama_instansi;
                        $this->target_kegiatan_kl_model->id_target_kegiatan_kl = $detail->id_target_kegiatan_kl;
                        $kegiatan = $this->target_kegiatan_kl_model->get_by_id()->rencana_kegiatan;

                                    if($detail->id_satuan==''||$detail->id_satuan==0||is_null($detail->id_satuan)){
                                        $nama_satuan = '-';
                                    }else{
                                        $this->ref_satuan_model->id_satuan = $detail->id_satuan;
                                        $nama_satuan = $this->ref_satuan_model->get_by_id()->satuan;
                                    }
                        ?>
                        <div class="form-group">
                            <label class="col-md-12">Koordinator</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $nama_koordinator ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kementrian / Lembaga</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $nama_lembaga ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kegiatan</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $kegiatan ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Jumlah Anggaran</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo rupiah($detail->jumlah_anggaran) ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Keterangan</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $detail->keterangan_realisasi ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Volume</label>
                            <div class="col-md-12">
                                <p class="form-control-static">
                                    <?php echo $detail->volume ?> <?php echo $nama_satuan ?>
                                        
                                    </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Awal</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo tanggal($detail->tanggal_awal) ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Akhir</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo tanggal($detail->tanggal_akhir) ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Provinsi</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $this->ref_wilayah_model->get_nama_provinsi($detail->id_provinsi_realisasi) ?></p> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kabupaten</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $this->ref_wilayah_model->get_nama_kabupaten($detail->id_kabupaten_realisasi) ?></p> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kecamatan</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $this->ref_wilayah_model->get_nama_kecamatan($detail->id_kecamatan_realisasi) ?></p> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Desa</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $this->ref_wilayah_model->get_nama_desa($detail->id_desa_realisasi) ?></p> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tempat</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $detail->tempat_realisasi ?></p> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Realisasi Kegiatan
                                <div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
                            </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true" style="">
                                <div class="panel-body">

                                    <?php if (!empty($message)) echo "
                                    <div class='alert alert-$message_type'>$message</div>";?>
                                    <a href="javascript:void(0)" onclick="add()" class="btn btn-primary">+ | Tambah Baru</a>
                                    <hr>
                                    <ul class="timeline">
                                        <?php
                                        if(empty($notes)){
                                            echo "<h3>Belum ada data</h2>";
                                        }else{
                                            $no=1;
                                            foreach($notes as $n){
                                                if($no%2==0){
                                                    $class = ' class="timeline-inverted"';
                                                }else{
                                                    $class = '';
                                                }
                                                ?>
                                                <li<?php echo $class ?>>
                                                <div class="timeline-badge primary">
                                                    <i data-icon="e" class="linea-icon linea-basic fa-fw"></i>
                                                </div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h4 class="timeline-title"><?php echo $n->nama_notes ?>
                                                            <div class="pull-right">
                                                                <small> <?php echo tanggal($n->tanggal_buat) ?> <?php echo $n->waktu_buat ?></small>
                                                            </div></h4> </div>
                                                            <div class="timeline-body">
                                                                <p><?php echo $n->keterangan_notes ?></p>
                                                                <hr>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-gear"></i> <span class="caret"></span> </button>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li><a href="javascript:void(0)" onclick="edit(<?php echo $n->id_realisasi_kegiatan_kl_notes ?>)">Edit</a> </li>
                                                                        <li><a href="javascript:void(0)" onclick="delete_(<?php echo $n->id_realisasi_kegiatan_kl_notes ?>,<?php echo $this->uri->segment('3') ?>)">Hapus</a> </li>
                                                                        <li><a href="javascript:void(0)" onclick="showFile(<?php echo $n->id_realisasi_kegiatan_kl_notes ?>)">Daftar File Pendukung</a> </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>  
                                                    <?php 
                                                    $no++; 
                                                }
                                            } 
                                            ?>                              
 <!--                                <li>
                                    <div class="timeline-badge default">
                                        <i data-icon="e" class="linea-icon linea-basic fa-fw"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor
                                                <div class="pull-right">
                                                    <small> 2018-05-02 14:58:36</small>
                                                </div></h4> </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae consequuntur impedit nulla qui! Laborum, atque.</p>
                                            <hr>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-gear"></i> <span class="caret"></span> </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Edit</a> </li>
                                                    <li><a href="#">Hapus</a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li> -->
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
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
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Baru</h4> </div>
                <div class="modal-body">
                    <form role="form" id="form" method="post" enctype="multipart/form-data">
                        <div id="hidden"></div>
                        <div class="form-group">
                            <label class="control-label">Nama </label>
                            <input type="text" name="nama_notes" class="form-control">

                        </div>

                        <div class="form-group">
                            <label class="control-label">Keterangan </label>
                            <textarea class="form-control" name="keterangan_notes"></textarea>

                        </div>
                        <div id="file_add" class="form-group">
                            <label class="control-label">Data Pendukung </label>

                            <input type="file" name='files[]'  id="data_pendukung" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse"  data-height="100" multiple />
                            <small>File yang diizinkan : jpg,jpeg,png,gif,ppt,pptx,doc,docx,xls,xlsx,pdf</small>
                        </div>
                        <a onclick="addFile()" href="javascript:void(0)" class="btn btn-primary btn-xs">Tambah File</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" id="submitBtn" name="" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>


<div id="file_list" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Daftar File</h4> </div>
                <div class="modal-body">
                    <div id="content_t">
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>



    <script type="text/javascript">
        $('#category_name').on('input', function() {
            var permalink;
    // Trim empty space
    permalink = $.trim($(this).val());
    // replace more then 1 space with only one
    permalink = permalink.replace(/\s+/g,' ');
    $('#category_slug').val(permalink.toLowerCase());
    $('#category_slug').val($('#category_slug').val().replace(/\W/g, ' '));
    $('#category_slug').val($.trim($('#category_slug').val()));
    $('#category_slug').val($('#category_slug').val().replace(/\s+/g, '-'));
    var gappermalink = $('#category_slug').val();
    $('#slug').html(gappermalink);
});

        function addFile(){
            $('#file_add').append('<input type="file" name="files[]"  id="data_pendukung" class="dropify" data-height="100" />');
            $('.dropify').dropify();
        }


        function add(){
          $('#form')[0].reset();
          $('#hidden').html('');
          $('.modal-title').html('Tambah Baru');
          $('#myModal').modal('show'); 
          $('#submitBtn').attr('name', 'save');
      }

      function edit(id){
          $('#form')[0].reset();
          $('#submitBtn').attr('name', 'edit');
          $('.modal-title').html('Edit Data');
          $.ajax({
            url : "<?php echo base_url('realisasi_kegiatan_kl/fetch_notes/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
              $('#hidden').html('<input type="hidden" name="id_realisasi_kegiatan_kl_notes" value="">');
              $('[name="id_realisasi_kegiatan_kl_notes"]').val(data.id_realisasi_kegiatan_kl_notes);
              $('[name="nama_notes"]').val(data.nama_notes);
              $('[name="keterangan_notes"]').val(data.keterangan_notes);
              $('#myModal').modal('show'); 
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert("Gagal mendapatkan data");
          }
      });
      }


      function showFile(id){
          $.ajax({
            url : "<?php echo base_url('realisasi_kegiatan_kl/fetch_files')?>/" + id,
            type: "GET",
            success: function(data)
            {
              $('#content_t').html(data);
              $('#file_list').modal('show'); 
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert("Gagal mendapatkan data");
          }
      });
      }


      function delete_(id,id_realisasi)
      {
        swal({   
            title: "Are you sure?",   
            text: "You will not be able to recover this imaginary file!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false 
        }, function(){   
            window.location = "<?php echo base_url();?>realisasi_kegiatan_kl/delete_notes/"+id+"/"+id_realisasi;
            swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
        });
    }
</script>