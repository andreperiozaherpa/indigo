<div class="container-fluid">
  
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?php echo title($title) ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                <ol class="breadcrumb">
                    <?php echo breadcrumb($this->uri->segment_array()); ?>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
<div class="col-md-4 col-xs-12">
  <div class="white-box">
    <div class="x_content">


      <h4 align="center">Filter Data</h4>
      <div class="ln_solid"></div>

      <form class="form-horizontal form-label-left" method="post">

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">NIP</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="nip">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="nip">
          </div>
        </div>




        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
            <button type="submit" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-primary">Filter</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>





<div class="col-md-8 col-sm-8 col-xs-12">
  <div class="white-box">
    <div class="x_content">

      <table class="table table-striped">
        <thead>
          <tr>
            <td>#</td>
            <th>NIP</th>
            <th>Nama </th>
            <th>Kategori </th>
            <th>Kegiatan </th>
            <th>Status</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1;

          foreach($query as $q){?>
            <tr>
              <td><?=$no?></td>
              <td><?=$q->nip_baru?></td>
              <td><?=$q->nama_lengkap?></td>
              <td><?=$q->nama_pekerjaan?></td>
              <td><?=$q->nama_kegiatan_realisasi?></td>
              <td><?=status_pekerjaan($q->status)?></td>
              <td>

                <a href="<?= base_url();?>verifikasi_pekerjaan/view/<?=$q->id_realisasi_pekerjaan?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> View </a>



              </td>
            </tr>
            <?php $no++; } ?>
        </tbody>
              </table>

            </div>
          </div>
        </div>


        <script type="text/javascript">
         function delete_(id)
         {
          if (confirm('Apakah anda yakin akan menghapus data?')){
           window.location.href= "<?= base_url();?>ref_pekerjaan/delete/"+id;
         }
       }
     </script>