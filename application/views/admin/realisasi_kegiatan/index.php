<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Realisasi Kegiatan</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
        <li class="active">Realisasi Kegiatan</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <div class="col-md-4 col-xs-12">
    <div class="white-box">
      <div class="x_contsent">
        <form class="form-horizontal form-label-left" method="post">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Kegiatan</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select class="form-control">
                <option value="">Semua</option>
                <option value="">Kategori 1</option>
                <option value="">Kategori 2</option>
                <option value="">Kategori 3</option></select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kegiatan</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="date" class="form-control" name="nama"required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Prioritas</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control">
                  <option value="">Semua</option>
                  <option value="">Kategori 1</option>
                  <option value="">Kategori 2</option>
                  <option value="">Kategori 3</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control">
                  <option value="">Semua</option>
                  <option value="">Rahasia</option>
                  <option value="">Publik</option>
                </select>
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

        <table class="table table-striped datatable" id="data">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Kegiatan</th>
              <th>Ketua</th>
              <th>Tanggal Kegiatan </th>
              <th>Prioritas</th>
              <th>Status</th>
              <th width=100px>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach($query as $q){
              $this->kegiatan_model->id_kegiatan = $q->id_kegiatan;
              $anggota = $this->kegiatan_model->get_anggota();
              $id_pegawai = array();
              foreach($anggota as $a){
                $p = $a->id_pegawai;
                $p = explode(';', $p);
                foreach($p as $qq){
                  if(!in_array($qq, $id_pegawai)){
                    $id_pegawai[] = $qq;
                  }
                }
              }
              if(!in_array($this->session->userdata('id_pegawai'), $id_pegawai)){
                $id_pegawai[] = $this->session->userdata('id_pegawai');
              }
              if(in_array($this->session->userdata('id_pegawai'), $id_pegawai) || $user_level=='Administrator'){
                ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$q->nama_kegiatan?></td>
                  <td><?=$q->nama_lengkap?></td>
                  <td><?=tanggal($q->tgl_mulai_kegiatan).' s.d. '.tanggal($q->tgl_mulai_kegiatan)?></td>
                  <td><?= ucwords($q->prioritas) ?></td>
                  <td><?= ucwords($q->status_kegiatan) ?></td>
                  <td>
                    <a href="<?=site_url('realisasi_kegiatan/detail/'.$q->id_kegiatan.'')?>" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat </a>
                  </td>
                </tr>
                <?php $no++; 
              }
            } 
            ?>   
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script type="text/javascript">
   function delete_(id)
   {
    if (confirm('Apakah anda yakin akan menghapus data?')){
     window.location.href= "<?= base_url();?>ref_bahasa_asing/delete/"+id;
   }
 }
</script>
