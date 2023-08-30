<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Verifikasi Perjalanan Dinas</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
        <li><a href="https://e-office.sumedangkab.go.id/kegiatan_personal">Perjalanan Dinas</a></li>
        <li class="active">Verifikasi</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <form method="GET">
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label class="control-label"> Bagian</label>
                                    
                        <select name="id_unit_kerja" class="form-control select2">
                            <option value="">Semua Bagian</option>
                            <?php
                            $bagian = $this->db->get_where('ref_unit_kerja',array('id_skpd'=>1,'level_unit_kerja'=>2))->result();
                            foreach($bagian as $b){
                                echo "<option value=\"$b->id_unit_kerja\">" . ($b->nama_unit_kerja) . "</option>";
                            }
                            ?>
                        </select>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label"> Bulan</label>
                                    <select class="form-control select2" name="bulan" id="bulan">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $selected = (!empty($bulan) && $bulan == $i) ? "selected" : "";
                                            $b = date("M", strtotime(date("Y") . "-" . $i . "-01"));
                                            echo "<option $selected value='$i' >$b</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"> Tahun</label>
                                    <select class="form-control select2" id="tahun" name="tahun">
                                        <?php
                                        for ($i = 2020; $i <= date("Y"); $i++) {
                                            $selected = (!empty($tahun) && $tahun == $i) ? "selected" : "";

                                            echo "<option $selected value='$i' >$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <br>
                                <button type="submit" value="1" name="filter" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
  <!--row -->
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">

        <table class="table color-table primary-table table-striped">
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
                      <td><a class="btn btn-primary" href="<?=base_url('perjalanan_dinas/verifikasi_detail/'.$l->id_perjalanan_dinas)?>"><i class="ti-eye"></i> Detail</a></td>
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