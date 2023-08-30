<div class="col-md-4 col-xs-12">
  <div class="white-box">
    <div class="x_title">
      <h2>Pekerjaan</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>


      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />     <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;">
          <a href="<?=base_url('target_pekerjaan/add')?>" > <button type="submit" class="btn btn-success">+ | Tambah Target Pekerjaan</button></a>
        </div>
      </div>
      <br>
      <div class="ln_solid"></div>

      <h4 align="center">Filter Data</h4>
      <div class="ln_solid"></div>

      <form class="form-horizontal form-label-left" method="post">

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kegiatan</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="nama_kegiatan">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Pekerjaan</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select name="id_pekerjaan" class="form-control">
              <option value="">Semua Kategori Pekerjaan</option>
              <?php foreach($pekerjaan as $p){
                echo '<option value="'.$p->id_pekerjaan.'">'.$p->nama_pekerjaan.'</option>';
              } ?>
            </select>
          </div>
        </div>
        <div class="form-group"> 
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Awal</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control mydatepicker" name="tgl_mulai_kegiatan">
          </div>
        </div>

        <div class="form-group"> 
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Akhir</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control mydatepicker" name="tgl_akhir_kegiatan">
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-success">Filter</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>





<div class="col-md-8 col-sm-8 col-xs-12">
  <div class="white-box">
    <div class="x_title">
      <h2>Daftar Target pekerjaan </h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>

      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Kategori Pekerjaan</th>
            <th>Nama Kegiatan</th>
            <th>Tanggal</th>
            <th>Biaya Pekerjaan</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>

<?php 
  $no=1;
  foreach($query as $q){
?>
          <tr>
            <th scope="row"><?=$no?></th>
            <td><?=$q->nama_pekerjaan?></td>
            <td><?=$q->nama_kegiatan?></td>
            <td> <?=tanggal($q->tgl_mulai_kegiatan).' - '.tanggal($q->tgl_akhir_kegiatan)?> </td>
            <td><?=$q->biaya_kegiatan?></td>
            <td>
                <a href="<?=base_url('target_pekerjaan/edit/'.$q->id_target_pekerjaan.'')?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                <a  title='Delete' onclick='delete_(<?=$q->id_target_pekerjaan?>)' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>


              </td>
            </tr>
<?php  } ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>


  <script type="text/javascript">
   function delete_(id)
   {
    if (confirm('Apakah anda yakin akan menghapus data?')){
     window.location.href= "<?= base_url();?>target_pekerjaan/delete/"+id;
   }
 }
</script>