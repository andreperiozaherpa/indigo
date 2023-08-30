 <div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Program RPJMD</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li><a href="<?= base_url();?>program_rpjmd">Program RPJMD</a></li>
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <!-- .row -->
  <div class="row">



    <div class="col-md-12">



      <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-primary block6">
          <div class="panel-heading"> Detail Program
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
          </div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6 b-r">
                  <div class="row">
                   <div class="col-md-12 b-b">
                     <h3 class="box-title m-b-0">Misi</h3>
                    <p><?=$misi->misi?></p>
                   </div>
                   <div class="col-md-12">
                     <h3 class="box-title m-b-0">Tujuan</h3>
                    <p> <?=$tujuan->tujuan?></p>
                   </div>
                 </div>
               </div>
               <div class="col-md-6">
                <div class="row">
                   <div class="col-md-6 b-b">
                <h3 class="box-title m-b-0">Nama Sasaran</h3>
                <p><?=$sasaran->sasaran_rpjmd?>
                </p>
              </div>
            </div>
               <div class="col-md-6">

<h3 class="box-title m-b-0">Nama Program</h3>
                <p><?=$detail->program_rpjmd?>
                </p>
               </div>
            </div>
            </div>



          </div>
        </div>
      </div>






        <?php
        if (!empty($message)){
          ?>
          <div class="alert alert-<?= $type;?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <?= $message;?>
          </div>
        <?php }?>


    <div class="white-box">
      <table class="table table-striped table-hover table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>Indikator</th>
            <th>Target 2019</th>
            <th>Target 2020</th>
            <th>Target 2021</th>
            <th>Target 2022</th>
            <th>Target 2023</th>
            <th>Satuan</th>
            <th>SKPD Penanggung Jawab</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $ii=1;
          if(empty($indikator)){?>
            <tr>
              <td colspan="10">
                <div class="alert alert-primary"><i class="ti-alert"></i> Belum ada Indikator</div>
              </td>
            </tr>
          <?php }else{
            foreach($indikator as $i){
              ?>
              <tr>
                <th><?=$ii?></th>
                <td><?=$i->iku_program_rpjmd?></td>
                <td><?=$i->target_2019?></td>
                <td><?=$i->target_2020?></td>
                <td><?=$i->target_2021?></td>
                <td><?=$i->target_2022?></td>
                <td><?=$i->target_2023?></td>
                <td><?=$i->satuan?></td>
                <td><?php 
                  $list_skpd = array();
                  foreach($i->skpd as $s){
                    $list_skpd[] = $s->nama_skpd;
                  }
                  echo implode(', ', $list_skpd);
                ?></td>
                <td>
                <td>
                  <a href="javascript:void(0)" onclick="editIndikator(<?=$i->id_iku_program_rpjmd?>)" class="btn btn-info btn-circle"><i class="ti-pencil"></i></a>
                  <a href="javascript:void(0)" onclick="hapusIndikator(<?=$i->id_iku_program_rpjmd?>)" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
                </td>
              </tr>
              <?php $ii++; } } ?>
            </tbody>


          </table>



        </div>
        <button type="button" class="btn btn-primary" onclick="addIndikator()">Tambah Indikator</button>

         <div class="white-box" style="margin-top: 50px;">
          <h4> Anggaran Program </h4>
          <hr> 
        <table class="table table-striped table-hover table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th>Target 2019</th>
              <th>Target 2020</th>
              <th>Target 2021</th>
              <th>Target 2022</th>
              <th>Target 2023</th>
            </tr>
          </thead>

          <tbody>

            <tr>
              <th>1</th>
              <td><?=rupiah($detail->target_anggaran_2019)?></td>
              <td><?=rupiah($detail->target_anggaran_2020)?></td>
              <td><?=rupiah($detail->target_anggaran_2021)?></td>
              <td><?=rupiah($detail->target_anggaran_2022)?></td>
              <td><?=rupiah($detail->target_anggaran_2023)?></td>

            </tr>
          </tbody>
        </table>
      </div> 

       <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#tambahanggaran">Ubah Anggaran</button>
                    <div id="tambahanggaran" class="modal fade bs-example-modal-lg pull-right" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content  panel-primary">
                                <div class="panel-heading">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">Tambah Anggaran Program</h4>
                                </div>
                                <div class="modal-body">

                                  <form method="POST" class="form-horizontal">

                                      <div class="form-group">
                                        <div class="col-md-6">
                                          <label class="col-sm-12">Anggaran Program 2019</label>
                                          <div class="col-md-12">
                                              <input type="text" class="form-control" name="target_anggaran_2019" value="<?=$detail->target_anggaran_2019?>" placeholder="masukan Anggaran">
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="col-sm-12">Anggaran Program 2020</label>
                                          <div class="col-md-12">
                                              <input type="text" class="form-control" name="target_anggaran_2020" value="<?=$detail->target_anggaran_2020?>" placeholder="masukan Anggaran">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-6">
                                          <label class="col-sm-12">Anggaran Program 2021</label>
                                          <div class="col-md-12">
                                              <input type="text" class="form-control" name="target_anggaran_2021" value="<?=$detail->target_anggaran_2021?>" placeholder="masukan Anggaran">
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <label class="col-sm-12">Anggaran Program 2022</label>
                                          <div class="col-md-12">
                                              <input type="text" class="form-control" name="target_anggaran_2022" value="<?=$detail->target_anggaran_2022?>" placeholder="masukan Anggaran">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-6">
                                          <label class="col-sm-12">Anggaran Program 2023</label>
                                          <div class="col-md-12">
                                              <input type="text" class="form-control" name="target_anggaran_2023" value="<?=$detail->target_anggaran_2023?>" placeholder="masukan Anggaran">
                                          </div>
                                        </div>
                                      </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary waves-effect text-left">Simpan</button>
                                </div>
                            
                                  </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>   




    </div>
    <!-- .row -->

  </div>

  <div id="modalIndikator" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
     <div class="modal-dialog modal-lg">
       <div class="modal-content  panel-primary">
         <div class="panel-heading">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">Tambah Indikator</h4>
         </div>
         <div class="modal-body">

          <form method="POST" id="formIndikator" class="form-horizontal">
            <div id="hidden"></div>
            <div class="form-group">
             <label class="col-md-12">INDIKATOR KERJA UTAMA</label>
             <div class="col-md-12">
               <input type="text" name="iku_program_rpjmd" class="form-control" placeholder="Masukkan Nama Indikator">
             </div>
           </div>

           <div class="form-group">
             <div class="col-md-12">
               <label class="col-sm-12">Satuan Pengukuran</label>
               <div class="col-sm-12">
                 <select name="id_satuan" class="form-control">
                  <option value="">Pilih Satuan Pengukuran</option>
                  <?php 
                  foreach($satuan as $s){
                    echo'<option value="'.$s->id_satuan.'">'.$s->satuan.'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="col-md-6">
             <label class="col-sm-12">Kondisi awal</label>
             <div class="col-md-12">
               <input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Target">
             </div>
           </div>

        
           <div class="col-md-6">
             <label class="col-sm-12">Target 2019</label>
             <div class="col-md-12">
               <input type="text" name="target_2019" class="form-control" placeholder="Masukkan Target">
             </div>
           </div>
           <div class="col-md-6">
             <label class="col-sm-12">Target 2020</label>
             <div class="col-md-12">
               <input type="text" name="target_2020" class="form-control" placeholder="Masukkan Target">
             </div>
           </div>
    
     
           <div class="col-md-6">
             <label class="col-sm-12">Target 2021</label>
             <div class="col-md-12">
               <input type="text" name="target_2021" class="form-control" placeholder="Masukkan Target">
             </div>
           </div>
           <div class="col-md-6">
             <label class="col-sm-12">Target 2022</label>
             <div class="col-md-12">
               <input type="text" name="target_2022" class="form-control" placeholder="Masukkan Target">
             </div>
           </div>
       
  
           <div class="col-md-6">
             <label class="col-sm-12">Target 2023</label>
             <div class="col-md-12">
               <input type="text" name="target_2023" class="form-control" placeholder="Masukkan Target">
             </div>
           </div>

              <div class="col-md-6">
             <label class="col-sm-12">Kondisi Akhir</label>
             <div class="col-md-12">
               <input type="text" name="kondisi_akhir" class="form-control" placeholder="Masukkan Target">
             </div>
           </div>

    
         <hr>

         <div class="form-group">
           <div class="col-md-12">
             <label class="col-sm-12">SKPD Penanggung Jawab</label>
             <div class="col-sm-12">
               <select name="id_skpd[]" class="select2 select2-multiple" multiple="multiple">
                <option value="">Pilih SKPD</option>
                <?php 
                foreach($skpd as $s){
                  echo'<option value="'.$s->id_skpd.'">'.$s->nama_skpd.'</option>';
                }
                ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
       <button type="submit" class="btn btn-primary waves-effect text-left">Simpan</button>
     </form>
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>


<div id="hapusIndikator" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Hapus Indikator</h4>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan menghapus Indikator ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tidak</button>
        <a style="color: #fff !important" href="" id="btnDeleteIndikator" class="btn btn-primary waves-effect text-left">Ya</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  function addIndikator(){
    $('#formIndikator')[0].reset(); 
    $('#modalIndikator #hidden').html('');
    $('#modalIndikator').modal('show');
    $('#modalIndikator .modal-title').html('Tambah Indikator');
  }


  function editIndikator(id_iku_program_rpjmd){
    $('#formIndikator')[0].reset(); 
    $('#modalIndikator #hidden').html('<input type="hidden" value="" name="id_iku_program_rpjmd"/>');
    $.ajax({
      url : "<?php echo base_url('program_rpjmd/get_indikator_by_id/')?>/" + id_iku_program_rpjmd,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="id_iku_program_rpjmd"]').val(data.id_iku_program_rpjmd);
        $('[name="iku_program_rpjmd"]').val(data.iku_program_rpjmd);
        $('[name="id_satuan"]').val(data.id_satuan);
         $('[name="kondisi_awal"]').val(data.kondisi_awal);
        $('[name="target_2019"]').val(data.target_2019);
        $('[name="target_2020"]').val(data.target_2020);
        $('[name="target_2021"]').val(data.target_2021);
        $('[name="target_2022"]').val(data.target_2022);
        $('[name="target_2023"]').val(data.target_2023);
         $('[name="kondisi_akhir"]').val(data.kondisi_akhir);
        $('[name="id_skpd"]').val(data.id_skpd);
        $('#modalIndikator').modal('show'); 
        $('#modalIndikator .modal-title').html('Ubah Indikator');

      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert("Gagal mendapatkan data");
      }
    });
  }

  function hapusIndikator(id_iku_program_rpjmd){
    $('#hapusIndikator').modal('show');
    $('#btnDeleteIndikator').attr('href','<?=base_url('program_rpjmd/delete_indikator')?>/'+id_iku_program_rpjmd);
  }
</script>