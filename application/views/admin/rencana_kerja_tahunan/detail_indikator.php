 <div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Indikator Kinerja Utama</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
            <li><a href="<?= base_url();?>/rencana_kerja_tahunan">Rencana Kerja Tahunan</a></li>
            <li><a href="<?= base_url();?>/rencana_kerja_tahunan/detail_sasaran/<?= $_type .'/'.$id_rkt.'/'.$detail[0]->id_sasaran ;?>">Detail Sasaran</a></li>
            <li class="active">Detail Indikator</li>
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

        <div class="row">
          <div class="col-md-12 col-xs-12 "> <strong>Sasaran Strategis :</strong>
            <br>
            <p class="text-muted"><?= $detail[0]->kode_sasaran_strategis .' - '.$detail[0]->sasaran_strategis;?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>IKU Atasan :</strong>
            <br>
            <p class="text-muted"><?= (!empty($indikator_atasan[0]->kode_indikator) && !empty($indikator_atasan[0]->nama_indikator_atasan)) ? $indikator_atasan[0]->kode_indikator_atasan."-".$indikator_atasan[0]->nama_indikator_atasan : "-" ;?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Kode IKU :</strong>
            <br>
            <p class="text-muted"><?= $detail[0]->kode_indikator;?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Nama IKU :</strong>
            <br>
            <p class="text-muted"><?= $detail[0]->nama_indikator;?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Deskripsi IKU :</strong>
            <br>
            <p class="text-muted"><?= $detail[0]->deskripsi;?> </p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Satuan IKU :</strong>
            <br>
            <p class="text-muted"><?= $detail[0]->satuan;?></p>
          </div>



        </div>






        
      </div>
    </div> 

    <div class="col-md-6">
      <div class="white-box">
        <div class="row">

          <div class="col-md-12 col-xs-12 "> <strong>Frekuensi Waktu :</strong>
            <br>
            <p class="text-muted"><?= $GLOBALVAR['frekuensi_indikator'][$detail[0]->frekuensi];?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Perhitungan Keatasan :</strong>
            <br>
            <p class="text-muted"><?= $GLOBALVAR['perhitungan_indikator'][$detail[0]->perhitungan];?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Cara Perhitungan :</strong>
            <br>
            <p class="text-muted"><?= $detail[0]->cara_perhitungan;?></p>
          </div>

          


          <div class="col-md-12 col-xs-12 "> <strong>Polarisasi :</strong>
            <br>
            <p class="text-muted"><?= $GLOBALVAR['polarisasi'][$detail[0]->polaritas];?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Metode Cascading :</strong>
            <br>
            <p class="text-muted"><?= $GLOBALVAR['metode_penurunan'][$detail[0]->metode_penurunan];?></p>
          </div>
          <div class="col-md-12 col-xs-12 "> <strong>Unit Penanggung Jawab :</strong>
            <br>
            <p class="text-muted"><?= $detail[0]->nama_unit_kerja;?></p>
          </div>
          <div class="col-md-12 col-xs-12 "> <strong>Diturunkan :</strong>
            <br>
            <p class="text-muted">
              <ol>
              <?php 
              foreach ($indikator_bawahan as $row) {
                echo "<li>".$row->nama_unit_kerja."</li>";
              }
              ?>
              </ol>
            </p>
          </div>





        </div>

      </div>

    </div>



  </div>


  <div class="row"> 
    <div class="col-md-12">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="white-box">
            <?php 
            if(!$dRenaksi){?>
            <a href="<?=base_url('rencana_kerja_tahunan/add_renaksi').'/'.$_type."/$id_rkt/$id_indikator"?>"<button type="button" class="btn btn-danger " ><i class="fa fa-plus"></i> Tambah Rencana Aksi</button></a>
            <br>
            <hr>
            <?php } else {?>
            <button type="button" onclick="delete_('<?= $dRenaksi[0]->id_renaksi;?>')" class="btn btn-danger " ><i class="fa fa-trash"></i> Hapus Rencana Aksi</button>
            <br>
            <hr>
            <table class="table color-table dark-table table-hover">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Bulan</th>
                  <th>Target</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $i=1;
              $CI = & get_instance();
              $CI->load->model("pencapaian_model");
              foreach ($dRenaksiDetail as $row) {
              if($row->dijadwalkan==1){
               

                echo '

                <tr>
                  <td>'.$i.'</td>
                  <td>'.$GLOBALVAR['bulan'][$row->bulan].'</td>
                  <td>'.$row->target.' '.$dRenaksi[0]->satuan.'</td>
                </tr>
                ';
              }
              else{
                echo '
                <tr class="warning">
                  <td>'.$i.'</td>
                  <td>'.$GLOBALVAR['bulan'][$row->bulan].'</td>
                  <td><p align="center">- Tidak di jadwalkan -</p></td>
                </tr>
                ';
              }
              $i++;
            }
          }
            if(empty($dRenaksiDetail))
            {
              echo "<tr class='warning'><td colspan='3' align='center'>Data renaksi kosong</td></tr>";
            }
            ?>
              </table>
              <!--
            <table class="table color-table dark-table table-hover">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Output</th>
                  <th>Komponen</th>
                  <th>Sub. Komponen </th>
                  <th>Jumlah Pagu </th>
                  <th>Satuan</th>

                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i=1;
                foreach ($dRenaksi as $row) {
                  echo '
                <tr>
                  <td>'.$i.'</td>
                  <td>'.$row->output.'</td>
                  <td>'.$row->komponen.'</td>
                  <td>'.$row->sub_komponen.'</td>
                  <td>'.number_format($row->jumlah_pagu).'</td>
                  <td>'.$row->satuan.'</td>

                  <td>
                    <button type="button" class="btn btn-danger" onclick="delete_('.$row->id_renaksi.')"> Hapus </button>
                    
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Detail</button>
                  </td> 
                </tr>';
              }
              ?>
              </table>-->
            <?php if(!empty($dRenaksiDetail)) { ?>
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel1">Detail Indikator</h4>
                    </div>
                    <div class="modal-body">

                      <div class="col-md-12 col-xs-12 "> <strong>Indikator :</strong>
                      <br>
                      <p class="text-muted"><?= $detail[0]->kode_indikator.' - '.$detail[0]->nama_indikator;?></p>
                    </div>

                     <div class="col-md-12 col-xs-12 "> <strong>Output :</strong>
                      <br>
                      <p class="text-muted"><?= $dRenaksi[0]->output;?></p>
                    </div>

                    <div class="col-md-12 col-xs-12 "> <strong>Komponen :</strong>
                      <br>
                      <p class="text-muted"><?= $dRenaksi[0]->komponen;?></p>
                    </div>

                    <div class="col-md-12 col-xs-12 "> <strong>Sub.Komponen :</strong>
                      <br>
                      <p class="text-muted"><?= $dRenaksi[0]->sub_komponen;?></p>
                    </div>

                     <div class="col-md-12 col-xs-12 "> <strong>Jumlah Pagu :</strong>
                      <br>
                      <p class="text-muted"><?= number_format($dRenaksi[0]->jumlah_pagu);?></p>
                    </div>

                   

                    <hr>
                    <br>
                    <strong>Jadwal Realisasi :</strong>
                    <table class="table">
                      <?php foreach ($dRenaksiDetail as $row) {
                        if($row->dijadwalkan==0){
                          echo "<tr><td>".$GLOBALVAR['bulan'][$row->bulan]."</td><td>Tidak Dijadwalkan</td><td></td></tr>";
                        }else{
                          echo "<tr><td>".$GLOBALVAR['bulan'][$row->bulan]."</td><td>$row->target</td><td>".$dRenaksi[0]->satuan."</td></tr>";
                        }
                      }
                      ?>
                    </table>






                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>


          </div>
        </div>

      </div>    


    </div>
    <!-- .row -->


  </div>


<script type="text/javascript">

      function delete_(id){
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
            window.location.href= "<?=base_url().'rencana_kerja_tahunan/delete_renaksi/'?>"+id+"/<?= $_type.'/'.$id_rkt.'/'.$id_indikator.'/';?>";
          }
        });
      }
    </script>