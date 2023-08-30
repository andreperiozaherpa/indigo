
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Ren. Strategis</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Ren. Strategis</li>				</ol>
       </div>
       <!-- /.col-lg-12 -->
     </div>


     <div class="row">
       <div class="col-md-12">
        <div class="white-box">
         <div class="row">
          <form method="POST">
            <div class="col-md-3 b-r">
              <center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>
            </div>
            <div class="col-md-9">
              <div class="panel-wrapper collapse in" aria-expanded="true">
               <div class="panel panel-default">
                <div class="panel-body">
                  <table class="table">
                    <tr><td style="width: 120px;">Nama Unit </td><td>:</td><td> <strong></strong></tr>
                      <tr><td style="width: 120px;"></td><td>:</td><td> <strong></strong></tr>
                        <tr><td style="width: 120px;"></td><td>:</td><td> <strong></strong>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
             Detail Indikator
           </div>
           <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
             <form class="form-horizontal">
               <div class="form-group">
                <label class="col-sm-12"><?=$sasaran_n?></label>
                <div class="col-md-9">
                  <p class="form-control-static"> <?=$sasaran->$var?> </p>
                </div>
              </div>
              <div class="form-group">
               <label class="col-md-12">Indikator Kerja Utama</label>
               <div class="col-md-9">
                <?php 
                $iku = 'iku_'.$jenis.'_renstra';
                $id_iku = 'id_'.$iku;
                ?>
                <p class="form-control-static"> <?=$detail->$iku?> </p>
              </div>
            </div>
            <div class="form-group">
             <label class="col-md-12">Deskripsi</label>
             <div class="col-md-9">
               <p class="form-control-static"> <?=$detail->deskripsi?> </p>
             </div>
           </div>
           <div class="form-group">
             <div class="col-md-4">
              <label class="col-sm-12">Satuan Pengukuran</label>
              <div class="col-md-9">
                <p class="form-control-static"><?=$detail->satuan?></p>
              </div>
            </div>
            <div class="col-md-4">
              <label class="col-sm-12">Waktu Pengukuran</label>
              <div class="col-md-9">
                <p class="form-control-static"> - </p>
              </div>
            </div>
            <div class="col-md-4">
              <label class="col-sm-12">Anggaran Rp.</label>
              <div class="col-md-9">
                <?php $anggaran = 'anggaran_'.$jenis.'_renstra'; ?>
                <p class="form-control-static"> <?=rupiah($detail->$anggaran)?> </p>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6">
             <label class="col-sm-12">Tingkat Kendali IKU</label>
             <div class="col-md-9">
              <p class="form-control-static"><?=normal_string($detail->t_kendali_indikator)?></p>
            </div>
          </div>
          <div class="col-md-6">
           <label class="col-sm-12">Tingkat Validitas Iku</label>
           <div class="col-md-9">
            <p class="form-control-static"><?=normal_string($detail->t_validitas_indikator)?></p>
          </div>
        </div>
      </div>
      <hr>
      <div class="form-group">
        <div class="col-md-6">
         <label class="col-sm-12">Jenis Konsolidasi.</label>
         <div class="col-md-9">
          <p class="form-control-static"><?=normal_string($detail->jenis_konsolidasi)?></p>
        </div>
      </div>
      <div class="col-md-6">
       <label class="col-sm-12">Polorarisasi</label>
       <div class="col-md-9">
        <p class="form-control-static"><?=normal_string($detail->polorarisasi)?></p>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-6">
     <label class="col-sm-12">Jenis Casecading</label>
     <div class="col-md-9">
      <p class="form-control-static"><?=normal_string($detail->jenis_casecading)?></p>
    </div>
  </div>
  <div class="col-md-6">
   <label class="col-sm-12">Metode Casecading</label>
   <div class="col-md-9">
    <p class="form-control-static"><?=normal_string($detail->metode_casecading)?></p>
  </div>
</div>
</div>
<div class="form-group">
 <label class="col-sm-12">Bobot Tertimbang</label>
 <div class="col-md-9">
  <p class="form-control-static"><?=normal_string($detail->bobot_tertimbang)?></p>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<div class="col-sm-6">
  <?php echo $detail->polorarisasi;?>

  <?php 


  for ($tahun=2019; $tahun <= 2023 ; $tahun++) {
    $s_target = 'target_'.$tahun;
    $s_realisasi = 'realisasi_'.$tahun;
    $s_capaian = 'capaian_'.$tahun;
    $target = $detail->$s_target;
    $realisasi = $detail->$s_realisasi;
    $pola = $detail->polorarisasi;

    // $capaian = get_capaian($target,$realisasi,$pola);
    $capaian = $detail->$s_capaian;

    ?>
    <div class="panel panel-default">
     <div class="panel-heading text-center" style="border-left: solid 5px #6003C8">
      <span style="color:#6003C8">TAHUN <?=$tahun?></span>
    </div>
    <div class="panel-wrapper collapse in" aria-expanded="true">
     <div class="panel-body">
      <div class="row b-r b-b b-t b-l">
        <div style="background-color: #6003C8;color:#fff" class="col-md-3 col-sm-4 text-center b-r">
          Target
        </div>
        <div style="background-color: #6003C8;color:#fff" class="col-md-3 col-sm-4 text-center b-r">
          Realisasi
        </div>
        <div style="background-color: #6003C8;color:#fff" class="col-md-3 col-sm-4 text-center b-r">
          Capaian
        </div>
        <div style="background-color: #6003C8;color:#fff" class="col-md-3 col-sm-4 text-center b-r">
          Opsi
        </div>
      </div>
      <div class="row b-r b-b b-t b-l">
        <div class="col-md-3 col-sm-4 text-center b-r">
          <span style="font-size: 40px"><?=$target?></span>
        </div>
        <div class="col-md-3 col-sm-4 text-center b-r">
          <span style="font-size: 40px"><?=$realisasi?></span>
        </div>
        <div class="col-md-3 col-sm-4 text-center b-r">
          <span style="font-size: 20px;line-height: 57px"><?=$capaian?>%</span>
        </div>
        <div class="col-md-3 col-sm-4 text-center ">
          <button style="margin-top: 12px" type="button" class="btn btn-primary btn-sm btn-rounded btn-outline" onclick="updateRealisasi(<?=$tahun?>)" style="height:30px;"><i class="ti-pencil"></i>Update</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } ?>
</div>
</div>
</div>


<div id="updateRealisasi" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">Update Realisasi</h4>
        </div>
        <div class="modal-body">
          <form method="POST" id="formRealisasi" class="form-horizontal">
            <input type="hidden" name="tahun" id="txtTahun">
            <div class="form-group">
              <label class="col-sm-12">Realisasi</label>
              <input type="text" id="txtRealisasi" class="form-control" name="" value="">
            </div>
            <div class="form-group">
              <input type="checkbox" name="perhitungan_capaian" value="otomatis" checked class="js-switch" onchange="toggleCapaian()" data-color="#6003c8" data-size="small" /> Hitung Capaian Otomatis
            </div>
            <div class="form-group" id="formCapaian" style="display: none;">
              <label class="col-sm-12">Capaian</label>
              <input type="text" id="txtCapaian" class="form-control" name="" value="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary waves-effect text-left">Kirim</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  function updateRealisasi(tahun){
    $('#formRealisasi')[0].reset(); 

    $.ajax({
      url : "<?= base_url();?>renstra_realisasi/get_iku/<?=$jenis?>/<?=$detail->$id_iku?>",
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        var realisasi = 'realisasi_'+tahun;
        var capaian = 'capaian_'+tahun;
        var d = 'data.'+realisasi;
        var c = 'data.'+capaian;
        $('#txtRealisasi').attr('name',realisasi);
        $('#txtRealisasi').val(eval(d));
        $('#txtTahun').val(tahun);
        $('#txtCapaian').attr('name',capaian);
        $('#txtCapaian').val(eval(c));
        $('#updateRealisasi').modal('show'); 

      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert("Gagal mendapatkan data");
      }
    });

  }

  function toggleCapaian(){
    $('#formCapaian').toggle();
  }
</script>