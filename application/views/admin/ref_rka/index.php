 <style type="text/css">
 .nav-tabs>li{
  width: 50%;
  text-align: center;
  text-transform: uppercase;
  font-weight: bold;
}
</style>
<div class="container-fluid">

  <div class="row bg-title">
   <!-- .page title -->
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Rencana Kerja Anggaran</h4>
  </div>
  <!-- /.page title -->
  <!-- .breadcrumb -->
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

    <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li class="active">Rencana Kerja Anggaran</li>
      </ol>
 </div>
 <!-- /.breadcrumb -->
</div>
<?php 
if($user_level=='Administrator'){
 ?>
 <div class="row">
  <div class="col-md-12">
   <div class="white-box">
    <div class="row">
     <form method="POST">
 					<!-- <div class="col-md-3">
 						<div class="form-group">
 							<label for="exampleInputEmail1">Tahun</label>
 							<select name="tahun_rkt" class="form-control">
 								<option value="">Semua Tahun</option>
 								<?php 
 								foreach($tahun as $r){
 									echo'<option value="'.$r->tahun_rkt.'">'.$r->tahun_rkt.'</option>';
 								}
 								?>
 							</select>				
 						</div>
 					</div> -->
 					<div class="col-md-9">
 						<div class="form-group">
 							<label for="exampleInputEmail1">Unit kerja</label>
 							<select name="id_unit_kerja" class="form-control">
 								<option value="">Semua Unit Kerja</option>
 								<?php 
 								foreach($unit_kerja as $r){
 									echo'<option value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
 								}
 								?>
 							</select>				
 						</div>
 					</div>
 					<div class="col-md-3">
 						<div class="form-group">

 							<br>
 							<button type="submit" class="btn btn-primary m-t-5">Filter</button>
 						</div>
 					</div>
 				</form>
 			</div>

 		</div>
 	</div>

 </div>
<?php } ?>
<!-- .row -->
<div class="row">	
  <div class="col-md-12">
   <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <div class="white-box">
      <a href="<?=base_url('ref_rka/tambah')?>"<button type="button" class="btn btn-danger " ><i class="fa fa-plus"></i> Tambah Rencana Kerja Anggaran</button></a>
<?php 
if($user_level=='Administrator'){
 ?>
      <a onclick="new_data()" href="javascript:void(0)"<button type="button" class="btn btn-success " ><i class="fa fa-upload"></i> Import Data Master</button></a>
      <a href="<?=base_url('ref_rka/download_format_import')?>" type="button" class="btn btn-success pull-right" ><i class="fa fa-download"></i> Download Format Excel</a>
    <?php } ?>
      <br>
      <hr>   


      <?php 
      if($this->session->flashdata('sukses')){
        ?>
        <div class="alert alert-success">File Berhasil di Import</div>
      <?php } ?>

    <?php
      if($user_level=='Administrator'){
    ?>
      <ul class="nav customtab nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#master" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-database"></i></span><span class="hidden-xs">DATA MASTER</span></a>
        </li>
        <li role="presentation" class="">
          <a href="#user" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">DATA USER</span></a>
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="master">


      <table id="myTable" class="table color-table dark-table table-hover">
       <thead>
        <tr>
         <th>#</th>
         <th>Kode</th>
         <th>Program/Kegiatan</th>
         <!-- <th>Uraian</th> -->
         <th>Total Pagu</th>
         <th>Opsi</th>
       </tr>
     </thead>
     <tbody>
      <?php 
      $no=1;
      foreach($item_master as $t){
       ?>
       <tr>
        <td style="width: 4%"><?=$no?></td>
        <td><?=$t->kode_rka?></td>
        <td><?=$t->kegiatan_rka?></td>
        <!-- <td><?=$t->uraian_rka?></td> -->
        <td><?="Rp".number_format($t->pagu_rka,2,",",".");?></td>
        <td style="width:12%">
         <a data-toggle="tooltip" data-original-title="Detail" href="<?=base_url('ref_rka/detail/'.$t->id_rka.'/master')?>" class="btn btn-circle btn-info btn-xs"><i class="fa fa-eye"></i></a> 
         <a data-toggle="tooltip" data-original-title="Edit" href="<?=base_url('ref_rka/edit/'.$t->id_rka.'/master')?>" class="btn btn-circle btn-warning btn-xs"><i class="fa fa-pencil"></i></a> 
         <a data-toggle="tooltip" data-original-title="Hapus" href="javascript:void(0)" onclick="delete_(<?=$t->id_rka?>,'master')" class="btn btn-circle btn-danger btn-xs"><i class="fa fa-trash"></i></a>
       </td>
     </tr>
     <?php $no++; } ?>
   </tbody>
 </table>

          <div class="clearfix"></div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="user">

      <table id="myTable1" class="table color-table dark-table table-hover">
       <thead>
        <tr>
         <th>#</th>
         <th>Kode</th>
         <th>Program/Kegiatan</th>
         <!-- <th>Uraian</th> -->
         <th>Total Pagu</th>
         <th>Unit Kerja</th>
         <th>Opsi</th>
       </tr>
     </thead>
     <tbody>
      <?php 
      $no=1;
      foreach($item_user as $t){
       ?>
       <tr>
        <td style="width: 4%"><?=$no?></td>
        <td><?=$t->kode_rka?></td>
        <td><?=$t->kegiatan_rka?></td>
        <!-- <td><?=$t->uraian_rka?></td> -->
        <td><?="Rp".number_format($t->pagu_rka,2,",",".");?></td>
        <td><?=$t->nama_unit_kerja?></td>
        <td style="width:12%">
         <a data-toggle="tooltip" data-original-title="Detail" href="<?=base_url('ref_rka/detail/'.$t->id_rka.'')?>" class="btn btn-circle btn-info btn-xs"><i class="fa fa-eye"></i></a> 
         <a data-toggle="tooltip" data-original-title="Edit" href="<?=base_url('ref_rka/edit/'.$t->id_rka.'')?>" class="btn btn-circle btn-warning btn-xs"><i class="fa fa-pencil"></i></a> 
         <a data-toggle="tooltip" data-original-title="Hapus" href="javascript:void(0)" onclick="delete_(<?=$t->id_rka?>)" class="btn btn-circle btn-danger btn-xs"><i class="fa fa-trash"></i></a>
       </td>
     </tr>
     <?php $no++; } ?>
   </tbody>
 </table>

          <div class="clearfix"></div>
        </div>
      </div>
    <?php }else{ ?>
      <table id="myTable" class="table color-table dark-table table-hover">
       <thead>
        <tr>
         <th>#</th>
         <th>Kode</th>
         <th>Program/Kegiatan</th>
         <!-- <th>Uraian</th> -->
         <th>Total Pagu</th>
         <th>Unit Kerja</th>
         <th>Opsi</th>
       </tr>
     </thead>
     <tbody>
      <?php 
      $no=1;
      foreach($item as $t){
       ?>
       <tr>
        <td style="width: 4%"><?=$no?></td>
        <td><?=$t->kode_rka?></td>
        <td><?=$t->kegiatan_rka?></td>
        <!-- <td><?=$t->uraian_rka?></td> -->
        <td><?="Rp".number_format($t->pagu_rka,2,",",".");?></td>
        <td><?=$t->nama_unit_kerja?></td>
        <td style="width:12%">
         <a data-toggle="tooltip" data-original-title="Detail" href="<?=base_url('ref_rka/detail/'.$t->id_rka.'')?>" class="btn btn-circle btn-info btn-xs"><i class="fa fa-eye"></i></a> 
         <a data-toggle="tooltip" data-original-title="Edit" href="<?=base_url('ref_rka/edit/'.$t->id_rka.'')?>" class="btn btn-circle btn-warning btn-xs"><i class="fa fa-pencil"></i></a> 
         <a data-toggle="tooltip" data-original-title="Hapus" href="javascript:void(0)" onclick="delete_(<?=$t->id_rka?>)" class="btn btn-circle btn-danger btn-xs"><i class="fa fa-trash"></i></a>
       </td>
     </tr>
     <?php $no++; } ?>
   </tbody>
 </table>

<?php } ?>

</div>
</div>

</div>    


</div>
<!-- .row -->

</div>

<?php 
if($user_level=='Administrator'){
 ?>
<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="data-title">Import Data</h4>
      </div>
      <div class="modal-body"><form action="<?php echo base_url();?>ref_rka/import_excel" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="data-tahun_rkt" class="control-label">Tahun</label>
          <select name="tahun" class="form-control">
            <?php 
            $tahun = date('Y');
            for ($i=2018; $i <= 2023 ; $i++) { 
              echo'<option value="'.$i.'">'.$i.'</option>';
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="data-tahun_rkt" class="control-label">File</label>
          <input type="file" name="file" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="data-button" class="btn btn-primary">Upload</button>
      </div>
    </form>
  </div>
  <!-- /#data-content -->
</div>
<!-- /#data-dialog -->
</div>
<?php } ?>

<script type="text/javascript">
  function new_data() {
    $("#data-modal").modal();
    $("#data-title").text("Import Data");
    $("#data-form")[0].reset();
    $("#data-button").text("Upload Data");
  }


  function delete_(id,type=''){
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
       url : "<?=base_url().'ref_rka/delete/'?>"+id+"/"+type,
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
</script>