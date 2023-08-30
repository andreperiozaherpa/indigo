
<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Pilih Kategori Surat Eksternal</h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>Surat Eksternal</li>       
          <li><a href="<?=base_url('surat_eksternal/surat_keluar')?>">Surat Keluar</a></li>       
          <li class="active">Kategori Surat Keluar</li>       
        </ol>
        </div>
        <!-- /.col-lg-12 -->
      </div>


  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">

          <form method="POST">
            <?php 
            ?>
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label>Nama Surat </label>
                    <input type="text" class="form-control" placeholder="Cari berdasarkan Nama Surat" name="nama_surat" value="<?=($filter) ? $filter_data['nama_surat'] : ''?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Jenis Surat</label>
                    <select class="form-control" name="jenis_surat">
                      <option value="">Semua</option>
                      <?php 
                      $jenis = array('internal','eksternal');
                      foreach($jenis as $j){
                        $selected = '';
                        if($filter){
                          if($filter_data['jenis_surat']==$j){
                            $selected = ' selected';
                          }
                        }
                        echo '<option value="'.$j.'"'.$selected.'>'.ucwords($j).'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i> Filter</button>
                <?php 
                if($filter){
                  ?>
                  <a href="" class="btn btn-default m-t-5"><i class="ti-back-left"></i> Reset</a>
                  <?php
                }
                ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_content">
        <div class="row">
        <?php foreach($list as $l){
          $type = 'primary';
          $color = '6003c8';
          ?>
          <div class="col-md-4 col-sm-6" >
            <div class="panel panel-<?=$type?>">
              <!-- <div class="panel-heading text-center">
                Surat <?=$l->jenis_surat?>
              </div> -->
              <div class="panel-body" style="border-top: solid 3px #6003c8">
                <div class="row b-b" style="min-height: 30px;">
                  <div class="col-md-4 col-sm-4 text-center b-r">
                    <i data-icon="&" class="linea-icon linea-basic" style="font-size:80px;color:#<?=$color?>;"></i>
                  </div>
                  <div class="col-md-8 col-sm-8" style="height: 115px;">
                    <a href="javascript:void(0)" onclick="viewTemplate('<?=$l->template_file?>')"><h5 style="font-weight: 500" class="m-t-20"><?=$l->nama_surat?></h5></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <br>
                    <address>
                      <a href="<?php echo base_url('surat_eksternal/tambah_surat_keluar/'.$l->id_ref_surat.'');?>" class="btn btn-primary btn-1b btn-block" style="color: white"><i class="ti-pencil"></i> Buat Surat</a>
                    </address>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
    </div>
      </div>


      <div class="row">
        <div class="col-md-12 pager">
          <?php 
          if(!$filter){
            echo make_pagination($pages,$current);
          }
          ?>
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
              <iframe id="docFrame" src="https://view.officeapps.live.com/op/embed.aspx?src=" width="100%"
              height="700"
              style="border: none;"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
  function viewTemplate(filename){
    var url = '<?=base_url('data/template_surat')?>/'+filename;
    $('#docFrame').attr('src','https://view.officeapps.live.com/op/embed.aspx?src='+url);
    $('#myModal').modal('show');
  }
</script>