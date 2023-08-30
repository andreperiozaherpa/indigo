 <div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Rencana Kerja Tahunan</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
        <li><a href="<?= base_url();?>/rencana_kerja_tahunan">Rencana Kerja Tahunan</a></li>
        <li class="active">Detail Sasaran</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>


  <!-- .row -->

  <div class="row">  
    <?php if (!empty($message)) echo "
    <div class='alert alert-$message_type'>$message</div>";?>
    
      <div class="col-md-6">
        <div class="white-box">

          <?php if($editdata[0]->level_unit_kerja==1){?>
          <div class="form-group">
            <label class="control-label">Misi</label>
            <select disabled name="id_misi" class="form-control">
              <option value="">Pilih</option>
              <?php 
              foreach($misi as $r){
                $selected = ($editdata[0]->id_misi == $r->id_misi) ? "selected" : "";
                echo'<option '.$selected.' value="'.$r->id_misi.'">'.$r->misi.'</option>';
              }
              ?>
            </select>
          </div>
          <?php }
          else if($editdata[0]->level_unit_kerja==2){?>
          <div class="form-group">
            <label class="control-label">Sasaran Strategis</label>
            <select disabled name="id_sasaran_strategis" class="form-control">
              <option value="">Pilih</option>
              <?php 
              foreach($sasaran_strategis as $r){
                $selected = ($editdata[0]->id_sasaran_strategis == $r->id_sasaran_strategis) ? "selected" : "";
                echo'<option '.$selected.' value="'.$r->id_sasaran_strategis.'">'.$r->kode_sasaran_strategis.' - '.$r->sasaran_strategis.'</option>';
              }
              ?>
            </select>
          </div>
          <?php }
          else {?>
          <div class="form-group">
            <label class="control-label">Sasaran Program</label>
            <select disabled name="id_sasaran_program" class="form-control">
              <option value="">Pilih</option>
              <?php 
              foreach($sasaran_program as $r){
                $selected = ($editdata[0]->id_sasaran_program == $r->id_sasaran_program) ? "selected" : "";
                echo'<option '.$selected.' value="'.$r->id_sasaran_program.'">'.$r->kode_sasaran_program.' - '.$r->sasaran_program.'</option>';
              }
              ?>
            </select>
          </div>
          <?php } ?>



          <div class="form-group">
            <label class="control-label">Tahun</label>
            <select disabled name="tahun_rkt" class="form-control">
              <option value="<?= $editdata[0]->tahun;?>"><?= $editdata[0]->tahun;?></option>
            </select>
          </div>


          <div class="form-group">
            <label class="control-label">SS Atasan</label>
            <select disabled name="ss_atasan" id="ss_atasan" class="form-control" onchange="getSSAtasan()">
                
                <?php
              if($editdata[0]->id_sasaran_strategis == null){ 
                echo '<option value="">Pilih</option>';
                foreach($ss_atasan as $ss){
                  echo'<option value="'.$ss->id_sasaran.'-'.$ss->type.'-'.$ss->metode.'">'.$ss->kode.' - '.$ss->nama_sasaran.'</option>';
                }
              }
              else{
                if($editdata[0]->level_unit_kerja==2){
                  echo'<option value="'.$editdata[0]->id_sasaran_strategis.'-SS-'.$editdata[0]->metode.'">'.$editdata[0]->kode_sasaran_strategis.' - '.$editdata[0]->sasaran_strategis.'</option>'; 
                }
                else if($editdata[0]->level_unit_kerja>2){
                  echo'<option value="'.$editdata[0]->id_sasaran_program.'-SP-'.$editdata[0]->metode.'">'.$editdata[0]->kode_sasaran_program.' - '.$editdata[0]->sasaran_program.'</option>'; 
                }
              }
                ?>
            </select>
            <input type="hidden" value="" name="id_sasaran_atasan" id ="id_sasaran_atasan" />
          </div>
         
          <div class="form-group">
            <label class="control-label">Kode  SS</label>
            <input disabled name="kode_sasaran" id="kode_sasaran" type="text" value="<?= $kode_sasaran;?>"  class="form-control" placeholder="">
          </div>


          <div class="form-group">
            <label class="control-label">Nama Sasaran</label>
            <input disabled name="nama_sasaran" id="nama_sasaran" type="text" value="<?= $nama_sasaran;?>"  class="form-control" placeholder="">
          </div>

          <div class="form-group">
            <label class="control-label">Deskripsi Sasaran</label>
            <textarea disabled class="form-control" name="deskripsi_sasaran"  id="deskripsi_sasaran"><?= $editdata[0]->deskripsi;?></textarea>
          </div>
        
        </div>
      </div> 





    </div>


    <div class="row"> 
    <div class="col-md-12">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="white-box">
            <a href="<?=base_url('rencana_kerja_tahunan/add_indikator').'/'.$_type.'/'.$id_rkt.'/'.$id_sasaran?>" class="btn btn-danger " ><i class="fa fa-plus"></i> Tambah Indikator Kinerja Utama</a>
            <a href="<?=base_url('rencana_kerja_tahunan/pembobotan_iku').'/'.$_type.'/'.$id_rkt.'/'.$id_sasaran?>" class="btn btn-warning pull-right" ><i class="fa fa-plus"></i> Lakukan Pemobotan IKU</a>
            <br>
            <hr>

            <table class="table color-table dark-table table-hover">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Tahun</th>
                  <th> Unit Kerja</th>
                  <th>Kode SS </th>
                  <th>Kode IKU </th>
                  <th>Nama IKU</th>
                  <th>Jumlah Cascading </th>
                  <th>Jumlah Ren. Aksi </th>
                  <th>Jumlah Pagu </th>
                  <th>Bobot</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $i=1;
              $CI = & get_instance();
              $CI->load->model("indikator_model");
              $CI->load->model("renaksi_model");
              foreach ($indikator as $row) {
                $totalPagu = $CI->renaksi_model->getTotalPagu($_type,$row->id_unit_kerja,$row->tahun ,$row->uid_ss,$row->uid_iku);
                $jumlahRenaksi = $CI->renaksi_model->getTotalRenaksi($_type,$row->id_unit_kerja,$row->tahun ,$row->uid_ss,$row->uid_iku);
                $param = array(
                  'type'  => $_type,
                  'where' => array(
                    'indikator_turunan.uid_iku_atasan' => $row->uid_iku,
                    )
                  );
                  $ikuBawahan = $CI->indikator_model->getIndikatorTurunan($param);
                  $cascading = (!empty($ikuBawahan)) ? count($ikuBawahan) : 0;
                  $warning_bobot = ($row->bobot==0)  ? "<p style='color:red'>Bobot belum di atur</p>" : "";
                //var_dump($ikuBawahan);
                echo '
                <tr>
                  <td>'.$i.'</td>
                  <td>'.$editdata[0]->tahun.'</td>
                  <td>'.$row->nama_unit_kerja.'</td> 
                  <td>'.$kode_sasaran.'</td>
                  <td>'.$row->kode_indikator.'</td>
                  <td>'.$row->nama_indikator.'</td>
                     <td>'.number_format($cascading).'</td>
                     <td>'.number_format($jumlahRenaksi).'</td>
                  <td>'.number_format($totalPagu).'</td>
                  <td>'.$row->bobot.' %'.$warning_bobot.'</td>
                  <td>
                    <a href="#"<button type="button" class="btn btn-warning " onclick="delete_('.$row->id_indikator.')"> Hapus </button></a>
                   <a href="'.base_url('rencana_kerja_tahunan/detail_indikator').'/'.$_type.'/'.$id_rkt.'/'.$row->id_indikator.'"<button type="button" class="btn btn-primary " > Detail Indikator</button></a>
                   </td> 
                </tr>';
                $i++;
              }
              ?>
              </table>



            </div>
          </div>

        </div>    


      </div>
      <!-- .row -->


    </div>


<script type="text/javascript">
 function delete_(id)
  {
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
            window.location.href= "<?= base_url();?>/rencana_kerja_tahunan/hapus_indikator/<?= $_type.'/'.$id_rkt.'/'.$id_sasaran.'/';?>"+id;
          }
        });
  }

</script>