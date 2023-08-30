<?php
switch ($this->uri->segment(3)) {
  case 'ss':
  $sasaran  = "sasaran_strategis_renstra";
  $iku      = "iku_ss_renstra";
  $anggaran = "anggaran_ss_renstra";
  break;

  case 'sp':
  $sasaran  = "sasaran_program_renstra";
  $iku      = "iku_sp_renstra";
  $anggaran = "anggaran_sp_renstra";
  break;

  case 'sk':
  $sasaran  = "sasaran_kegiatan_renstra";
  $iku      = "iku_sk_renstra";
  $anggaran = "anggaran_sk_renstra";
  break;

  case 'ssk':
  $sasaran  = "sasaran_subkegiatan_renstra";
  $iku      = "iku_ssk_renstra";
  $anggaran = "anggaran_ssk_renstra";
  break;
  
  default:
  redirect('renstra_perencanaan');
  break;
}
?>
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
        <a href="<?=base_url('renstra_perencanaan/view/'.$detail->id_skpd.'/'.strtolower($detail->apbd))?>" style="margin-bottom: 10px;" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali</a>
      </div>
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
                      <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?=$kepala_skpd->nama_lengkap?></strong></tr>
                        <tr><td style="width: 120px;">Alamat SKPD </td><td>:</td><td> <strong><?=$detail_skpd->alamat_skpd?></strong></tr>
                          <tr><td style="width: 120px;">Email/tlp </td><td>:</td><td> <strong><?=$detail_skpd->email_skpd?> / <?=$detail_skpd->telepon_skpd?></strong>
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
       <div class="col-md-6">


        <div class="panel panel-primary">
          <div class="panel-heading">
           Detail Indikator
         </div>
         <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body">
           <form class="form-horizontal">
             <div class="form-group">
              <div class="col-md-12">
                <label class="col-sm-12">Sasaran</label>
                <div class="col-md-9">
                  <p class="form-control-static"> <?=$detail->$sasaran?> </p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
               <label class="col-md-12">Indikator Kerja Utama</label>
               <div class="col-md-9">
                 <p class="form-control-static"> <?=$detail->$iku?> </p>
               </div>
             </div>
           </div>
           <div class="form-group">
            <div class="col-md-12">
             <label class="col-md-12">Deskripsi</label>
             <div class="col-md-9">
               <p class="form-control-static"> <?=$detail->deskripsi?> </p>
             </div>
           </div>
         </div>
         <div class="form-group">
           <div class="col-md-6">
            <label class="col-sm-12">Satuan Pengukuran</label>
            <div class="col-md-9">
              <p class="form-control-static"><?=$detail->satuan?></p>
            </div>
          </div>
          <div class="col-md-6">
            <label class="col-sm-12">Waktu Pengukuran</label>
            <div class="col-md-9">
              <p class="form-control-static"> <?=$detail->id_waktu?> </p>
            </div>
          </div>
        </div>

        <hr>
        <div class="form-group">

          <div class="col-md-6">
           <label class="col-sm-12">Polarisasi</label>
           <div class="col-md-9">
             <p class="form-control-static"> <?=$detail->polorarisasi?> </p>
           </div>
         </div>
       </div>
       <div class="form-group">
        <div class="col-md-6">
         <label class="col-sm-12">Jenis Casecading</label>
         <div class="col-md-9">
           <p class="form-control-static"><?=$detail->jenis_casecading?> </p>
         </div>
       </div>
       <div class="col-md-6">
         <label class="col-sm-12">Metode Cascading</label>
         <div class="col-md-9">
           <p class="form-control-static"> <?=$detail->metode_casecading?>  </p>
         </div>
       </div>
     </div>
     <div class="form-group">
      <div class="col-md-6">
       <label class="col-sm-12">Bobot Tertimbang</label>
       <div class="col-md-9">
         <p class="form-control-static"> <?=$detail->bobot_tertimbang?>  </p>
       </div>
     </div>
   </div>
   <hr/>
   
<?php if ($this->uri->segment(3)=="ss" OR $this->uri->segment(3)=="sp" OR $this->uri->segment(3)=="sk"): ?>
   <div class="form-group">
    <div class="col-md-12">
      <label class="col-sm-12">Casecading ke Unit Kerja</label>
      <ol>
        <?php foreach ($iku_unit_kerja as $row): ?>
          <li class="form-control-static"> <?=$row['nama_unit_kerja']?> </li>
        <?php endforeach ?>
      </ol>
    </div>
  </div>
  
<?php endif ?>
  <div class="panel-footer">
    <div class="pull-right">
     <a href="<?php echo base_url('renstra_perencanaan/edit/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>" class="btn btn-primary" style="color:white;"><i class="ti-pencil"></i> Edit</a><button type="button" onclick="delete_indikator_sasaran();" class="btn btn-danger" style="color:white;"><i class="ti-trash"></i> Hapus</button>
   </div>
 </div>
</form>
</div>
</div>
</div>

</div>
<div class="col-md-6">
  <div class="col-sm-12">
    <div class="panel panel-default">
     <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
      <span style="color:#6003C8">KONDISI AWAL</span>
    </div>
    <div class="panel-wrapper collapse in" aria-expanded="true">
     <div class="panel-body">
      <div class="row b-r b-b b-t b-l">
       <table class="table table-bordered table-striped">
        <thead>
          <tr><th>Target</th><th>Satuan</th>
          </thead>
          <tr><td><?=$detail->kondisi_awal?></td><td><?=$detail->satuan?></td>
          </table>

        </div>

      </div>
    </div>
  </div>
</div>

  <div class="col-sm-6">
    <div class="panel panel-default">
     <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
      <span style="color:#6003C8">TAHUN  2019</span>
    </div>
    <div class="panel-wrapper collapse in" aria-expanded="true">
     <div class="panel-body">
      <div class="row b-r b-b b-t b-l">
       <table class="table table-bordered table-striped">
        <thead>
          <tr><th>Target</th><th>Satuan</th>
          </thead>
          <tr><td><?=$detail->target_2019?></td><td><?=$detail->satuan?></td>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><?=rupiah($detail->anggaran_2019)?></td></tr>
          </table>

        </div>

      </div>
    </div>
  </div>
</div>


<div class="col-sm-6">
  <div class="panel panel-default">
   <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
    <span style="color:#6003C8">TAHUN  2020</span>
  </div>
  <div class="panel-wrapper collapse in" aria-expanded="true">
   <div class="panel-body">
    <div class="row b-r b-b b-t b-l">
     <table class="table table-bordered table-striped">
      <thead>
        <tr><th>Target</th><th>Satuan</th>
        </thead>
        <tr><td><?=$detail->target_2020?></td><td><?=$detail->satuan?></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><?=rupiah($detail->anggaran_2020)?></td></tr>
        </table>

      </div>

    </div>
  </div>
</div>
</div>


<div class="col-sm-6">
  <div class="panel panel-default">
   <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
    <span style="color:#6003C8">TAHUN  2021</span>
  </div>
  <div class="panel-wrapper collapse in" aria-expanded="true">
   <div class="panel-body">
    <div class="row b-r b-b b-t b-l">
     <table class="table table-bordered table-striped">
      <thead>
        <tr><th>Target</th><th>Satuan</th>
        </thead>
        <tr><td><?=$detail->target_2021?></td><td><?=$detail->satuan?></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><?=rupiah($detail->anggaran_2021)?></td></tr>
      </table>

    </div>

  </div>
</div>
</div>
</div>



<div class="col-sm-6">
  <div class="panel panel-default">
   <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
    <span style="color:#6003C8">TAHUN  2022</span>
  </div>
  <div class="panel-wrapper collapse in" aria-expanded="true">
   <div class="panel-body">
    <div class="row b-r b-b b-t b-l">
     <table class="table table-bordered table-striped">
      <thead>
        <tr><th>Target</th><th>Satuan</th>
        </thead>
        <tr><td><?=$detail->target_2022?></td><td><?=$detail->satuan?></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><?=rupiah($detail->anggaran_2022)?></td></tr>
      </table>

    </div>

  </div>
</div>
</div>
</div>

<div class="col-sm-6">
  <div class="panel panel-default">
   <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
    <span style="color:#6003C8">TAHUN  2023</span>
  </div>
  <div class="panel-wrapper collapse in" aria-expanded="true">
   <div class="panel-body">
    <div class="row b-r b-b b-t b-l">
     <table class="table table-bordered table-striped">
      <thead>
        <tr><th>Target</th><th>Satuan</th>
        </thead>
        <tr><td><?=$detail->target_2023?></td><td><?=$detail->satuan?></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><?=rupiah($detail->anggaran_2023)?></td></tr>
      </table>

    </div>

  </div>
</div>
</div>
</div>

<div class="col-sm-6">
  <div class="panel panel-default">
   <div class="panel-heading text-center" style="border-top: solid 5px #6003C8">
    <span style="color:#6003C8">KONDISI AKHIR</span>
  </div>
  <div class="panel-wrapper collapse in" aria-expanded="true">
   <div class="panel-body">
    <div class="row b-r b-b b-t b-l">
     <table class="table table-bordered table-striped">
      <thead>
        <tr><th>Target</th><th>Satuan</th>
        </thead>
        <tr><td><?=$detail->kondisi_akhir_target?></td><td><?=$detail->satuan?></td></tr>
        <thead>
            <th colspan="2" style="text-align: center;">Anggaran</th>
          </thead>
          <tr><td colspan="2" style="text-align: center;"><?=rupiah($detail->kondisi_akhir_anggaran)?></td></tr>
      </table>

    </div>

  </div>
</div>
</div>
</div>
</div>



</div>

<script type="text/javascript">

  function delete_indikator_sasaran()
  {
    swal({
      title: "Apakah anda yakin menghapus indikator?",
      text: "data yang dihapus tidak dapat dikembalikan.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Hapus",
      closeOnConfirm: false
    }, function(){
      window.location = "<?php echo base_url();?>renstra_perencanaan/hapus_iku/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>";
      swal("Berhasil!", "Data telah dihapus.", "success");
    });
  }
</script>