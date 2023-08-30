<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Perjalanan Dinas</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
        <li><a href="https://e-office.sumedangkab.go.id/kegiatan_personal">Perjalanan Dinas</a></li>
        <li class="active">Rekap</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">

    <div class="col-md-3">
      <a href="<?= base_url('perjalanan_dinas/add') ?>" class="btn btn-primary btn-block m-t-40"><i class="ti-plus"></i> Tambah Usulan Perjalanan Dinas</a>
    </div>
    <div class="col-md-9">
      <div class="white-box">
          <div class="row">
            <div class="col-md-4">
              <label>Tanggal Awal</label>
              <input type="text" class="form-control mydatepicker" autocomplete="off" placeholder="Masukkan Tanggal Awal">
            </div>
            <div class="col-md-4">
              <label>Tanggal Akhir</label>
              <input type="text" class="form-control mydatepicker" autocomplete="off" placeholder="Masukkan Tanggal Akhir">
            </div>
            <div class="col-md-4">
            <label style="display: block;">&nbsp;</label>
              <button type="submit" class="btn btn-outline btn-primary"><i class="ti-filter"></i> Filter</button>
            </div>
          </div>
      </div>
    </div>
  </div>
  <!--row -->
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">

        <table class="table color-table primary-table table-striped" id="myTable">
          <thead>
            <tr>
              <th>No.</th>
              <th>Kegiatan</th>
              <th>Tujuan</th>
              <th>Jenis Perjalanan</th>
              <th>Waktu Kegiatan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
                <?php
                $no=1; 
                  foreach($list as $l){
                    ?>
                    <tr>
                      <td><?=$no?></td>
                      <td><?=$l->deskripsi_kegiatan?></td>
                      <td><?=$l->tujuan?></td>
                      <td><?=normal_string($l->jenis_perjalanan)?></td>
                      <td><?= tanggal($l->tanggal_awal) ?> <?= !empty($l->tanggal_akhir) ? "s.d " . tanggal($l->tanggal_akhir) : '' ?></td>
                      <td><?=status_perdin($l->status_verifikasi)?></td>
                      <td><a class="btn btn-primary" href="<?=base_url('perjalanan_dinas/detail/'.$l->id_perjalanan_dinas)?>"><i class="ti-eye"></i> Detail</a></td>
                    </tr>
                    <?php
                    $no++;
                  }
                ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>