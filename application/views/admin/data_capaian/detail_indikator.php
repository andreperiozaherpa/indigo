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
        <li><a href="#">Dashboard</a></li>
        <li class="active">Starter Page</li>
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
            <p class="text-muted"><?= $detail[0]->sasaran_strategis;?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>IKU Atasan :</strong>
            <br>
            <p class="text-muted"><?= (!empty($iku_atasan[0]->nama_indikator_atasan )) ? $iku_atasan[0]->nama_indikator_atasan : '-';?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Kode IKU :</strong>
            <br>
            <p class="text-muted"><?= $detail[0]->kode_indikator;?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Nama IKU :</strong>
            <br>
            <p class="text-muted"><?=$detail[0]->nama_indikator;?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Deskripsi IKU :</strong>
            <br>
            <p class="text-muted"><?= $detail[0]->deskripsi;?></p>
          </div>

          <div class="col-md-12 col-xs-12 "> <strong>Satuan IKU :</strong>
            <br>
            <p class="text-muted"><?= $detail[0]->satuan;?></p>
          </div>
        </div>      
      </div>

      <div class="white-box" style="min-height: 100px;">
        <div class="col-md-12 col-xs-12 "> <strong>Target Tahunan:</strong>
          <br>
          <p class="text-muted"><?= $detail[0]->target .' '.$detail[0]->satuan;?></p>
          <br>
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
            <ol>
           <?php foreach ($iku_bawahan as $row) {
              echo '<li>'.$row->nama_unit_kerja.'</li>';
            }
            ?>
          </ol>
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


            <table class="table color-table dark-table table-hover">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Bulan</th>
                  <th>Target</th>
                  <th>Realisasi</th>
                  <th>Capaian</th>
                  <th>Status Capaian</th>
                  <th>File</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
          <?php
          if(empty($belum_bobot)){
            $i=1;
            $CI = & get_instance();
            $CI->load->model("pencapaian_model");
            foreach ($pencapaian_detail as $row) {
              if($row->dijadwalkan==1){
                $realisasi = ($row->realisasi) ? $row->realisasi .' '.$row->satuan : '';
                $capaian = ($row->capaian) ? number_format($row->capaian,2) .'%' : '';
                $status_capaian = ($row->capaian==100) ? "Tercapai" : "-";

                $param = array(
                  'pencapaian_indikator_detail.uid_iku'  => $detail[0]->uid_iku,
                  'pencapaian_indikator_detail.tahun'   => $rkt->tahun_rkt,
                  'pencapaian_indikator_detail.bulan'   => $row->bulan
                );
                $cekStatusEvaluasi = $CI->pencapaian_model->getCapaianIndikatorDetail($param);
                $btn = 'Sudah dievaluasi';
                if($cekStatusEvaluasi!=null)
                {
                  if($cekStatusEvaluasi[0]->status_evaluasi==0)
                  {
                    $btn = '<button type="button" class="btn btn-primary" onclick="updateCapaian('.$i.')" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>';
                  }
                }
                else{
                    $btn = '<button type="button" class="btn btn-primary" onclick="updateCapaian('.$i.')" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Update Capaian</button>';

                }

                echo '
                <input type="hidden" id="target_'.$i.'" value="'.$row->target.'" />
                <input type="hidden" id="id_capaian_indikator_'.$i.'" value="'.$row->id_capaian_indikator.'" />

                <tr>
                  <td>'.$i.'</td>
                  <td>'.$GLOBALVAR['bulan'][$row->bulan].'</td>
                  <td>'.$row->target.' '.$row->satuan.'</td>
                  <td>'.$realisasi.'</td>
                  <td>'.$capaian.'</td>
                  <td><strong>'.$status_capaian.'</strong></td>
                  <td> <a href="#">'.$row->berkas.'</a></td>

                  <td>
                    '.$btn.'
                  </td> 
                </tr>
                ';
              }
              else{
                echo '
                <tr class="warning">
                  <td>'.$i.'</td>
                  <td>'.$GLOBALVAR['bulan'][$row->bulan].'</td>
                  <td colspan="6"><p align="center">- Tidak di jadwalkan -</p></td>
                </tr>
                ';
              }
              $i++;
            }
            if(empty($pencapaian_detail))
            {
              echo "<tr class='warning'><td colspan='8' align='center'>Data renaksi kosong</td></tr>";
            }
          }
          else{
            echo "<tr class='warning'><td colspan='8' align='center'>Silahkan lakukan pembobotan Sasaran / IKU terlebih dahulu</td></tr>";
          }
            ?>
              </table>

              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel1">Update Capaian</h4>
                    </div>
                    <div class="">
                      <form id="data-form" action="#!" enctype="multipart/form-data" >

                        <input type="hidden" name="id_capaian_indikator"  id="id_capaian_indikator"/>
                        <input type="hidden" name="id_indikator"  id="id_indikator" value="<?= $detail[0]->id_indikator;?>"/>
                        <input type="hidden" name="type"  id="type" value="<?= $_type;?>"/>
                      <div class="col-md-12 col-xs-12 " style="margin-top: 20px;margin-bottom: 10px;"> <strong>Target :</strong>
                        <br>

                        <p class="text-muted" id="target"></p>
                      </div>

                      <div class="col-md-12 col-xs-12 "> <strong>Realisasi :</strong>
                        <br>
                        <div class="input-group m-t-10">
                          <input type="text" id="realisasi" name="realisasi" class="form-control" placeholder="realisasi">
                          <span class="input-group-addon"><?= $detail[0]->satuan;?></span> </div>
                        </div>
                      <?php 
                      if($detail[0]->formula=="M"){
                        echo '

                        <div class="col-md-12 col-xs-12 "> <strong>Capaian Manual :</strong>
                          <br>
                          <p>'.$detail[0]->cara_perhitungan.'</p>
                          
                          <div class="input-group m-t-10">
                            <input type="text" id="capaian" name="capaian" class="form-control" placeholder="Persentase capaian">
                            <span class="input-group-addon">%</span> </div>
                        </div>
                        ';
                      }
                      ?>
                        <div class="col-md-12 col-xs-12 "> <strong>File Pendukung:</strong>
                          <br>
                          <input type="file" id="berkas" name="berkas"  class="dropify" />
                        </div>
                      </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="simpan()" data-dismiss="modal">Simpan</button>

                      </div>
                    </div>
                  </div>
                </div>



              </div>
            </div>

          </div>    


        </div>
        <!-- .row -->


      </div>


<script type="text/javascript">
  function updateCapaian(i)
  {
    var target = $("#target_"+i).val();
    var id_capaian_indikator = $("#id_capaian_indikator_"+i).val();
    $("#target").html(target+" <?= $detail[0]->satuan;?>");
    $("#id_capaian_indikator").val(id_capaian_indikator);
    //alert(id_capaian_indikator);
  }

  function simpan()
  {
    var formData = new FormData( $("#data-form")[0] );
    console.log(formData);
    if(validasi()){
      $.ajax({
        url:"<?php echo base_url('data_capaian/update_capaian');?>",
        type:"POST",
        //data: $('#data-form').serialize(),
        data : formData,
        async : false,
            cache : false,
            contentType : false,
            processData : false,

        success:function(resp){
          if (resp == true) {
            swal("Success!", "Update capaian sukses.", "success");
            window.location.reload(false); 
          } else {
            alert('Error Message: '+ resp);
            console.log(resp);
          }
        },
        error:function(event, textStatus, errorThrown) {
          alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        }
      })
    
    }
  }
  function validasi()
  {
    var formula = "<?= $detail[0]->formula;?>";
    var realisasi = $("#realisasi").val();
    if(realisasi==""){
      alert("Realisasi harus diisi");
      return false;
    }
    else{
      if(formula=="M"){
        var capaian = $("#capaian").val();
        if(capaian==""){
          alert("Persentase capaian harus diisi");
          return false;
        }
        else{
          return true;
        }
      }
      else{
        return true;
      }
    }
  }
  

</script>