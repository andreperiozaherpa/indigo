<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title"><?php echo title($title) ?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <?php echo breadcrumb($this->uri->segment_array()); ?>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="col-md-12">
    <div class="white-box">
      <div class="x_content">
        <?php 
          if(!empty($message)){
            ?>
            <div class="alert alert-<?=$message_type?>">
            <?=$message?>
            </div>
            <?php
          }
        ?>
        <form method="POST">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Bulan</th>
              <th>Jumlah Hari Kerja Efektif</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($item as $n => $i) {
              $no = $n + 1;
            ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= bulan($i->id_bulan) ?></td>
                <td><input type="text" class="form-control" value="<?= $i->jumlah ?>" name="<?=$i->id_bulan?>"></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-12">

          <button type="submit" class="btn btn-primary pull-right"><i class="ti-save"></i> Simpan</button>
        <a href="<?=base_url('ref_hari_kerja_efektif')?>" class="btn btn-default pull-right" style="margin-right:10px">Kembali</a>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript">
  function delete_(id) {
    if (confirm('Apakah anda yakin akan menghapus data?')) {
      window.location.href = "<?= base_url(); ?>ref_hari_libur/delete/" + id;
    }
  }
</script>