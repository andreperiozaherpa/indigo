<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title"><?= $title ?></h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <?php echo breadcrumb($this->uri->segment_array()); ?>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="white-box">

        <form method="POST">
          <div class="row">
            <div class="col-md-5">
              <label><i class="icon-user text-purple"></i> SKPD</label>
              <select name="id_skpd" class="form-control select2">
                <option value="">Semua SKPD</option>
                <?php
                foreach ($skpd as $s) {
                  $selected = set_value('id_skpd') == $s->id_skpd ? ' selected' : '';
                  echo '<option value="' . $s->id_skpd . '"'.$selected.'>' . $s->nama_skpd . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-md-4">
              <label>Bulan</label>
              <select name="bulan" class="form-control">
                <option value="">Semua Bulan</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                  $selected = set_value('bulan') == $i ? ' selected' : '';
                  echo '<option value="' . $i . '"' . $selected . '>' . bulan($i) . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-md-3">
              <label>Tahun</label>
              <select name="tahun" class="form-control">
                <option value="">Semua Tahun</option>
                <?php
                for ($i = 2020; $i <= 2025; $i++) {
                  $selected = set_value('tahun') == $i ? ' selected' : '';
                  echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row" style="margin-top:10px">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary btn-block"><i class="icon-magnifier"></i> Cari</button>
            </div>
          </div>
        </form>
        <hr>
        <?php 
          if(isset($list)){
        ?>
        <div class="text-center">
          <h5 style="font-weight: 700">Rekapitulasi Pengisian / Pelaporan Kegiatan Personal</h5>
          <h5 style="font-weight: 700">
          <?= isset($nama_skpd) ? 'SKPD <span class="text-purple">'.$nama_skpd.'</span>' : '' ?> 
          <?= !empty(set_value('bulan')) ? 'Bulan <span class="text-purple">'.bulan(set_value('bulan')).'</span>' : ''?> 
          <?= !empty(set_value('tahun')) ? 'Tahun <span class="text-purple">'.set_value('tahun').'</span>' : ''?> 
        </h5>
        </div>
        <div class="row">
          <div class="col-md-12">
            <?php 
              $id_skpd = empty(set_value('id_skpd')) ? 0 : set_value('id_skpd');
              $bulan = empty(set_value('bulan')) ? 0 : set_value('bulan');
              $tahun = empty(set_value('tahun')) ? 0 : set_value('tahun');
              $param = "$bulan/$tahun/$id_skpd";
              
            ?>
        <a target="blank" href="<?=base_url('kegiatan_personal/rekap_ekspor/'.$param)?>" class="btn btn-primary pull-right"><i class="ti-download"></i> Download File PDF</a>

          </div>
        </div>
        <div class="table-responsive" style="margin-top:20px">
          <table id="myTable" class="table table-hover color-table primary-table m-b-0 toggle-arrow-tiny">
            <thead>
              <tr>
                <th style="vertical-align: middle;text-align:center" rowspan="2">#</th>
                <th style="vertical-align: middle;text-align:center" rowspan="2">NIP</th>
                <th style="vertical-align: middle;text-align:center" rowspan="2">Nama</th>
                <th style="vertical-align: middle;text-align:center" rowspan="2">Diusulkan</th>
                <th colspan="3" style="text-align:center">Proses Verifikasi</th>
              </tr>
              <tr>
                <th style="text-align:center">Belum Dikerjakan</th>
                <th style="text-align:center">Verifikasi Atasan</th>
                <th style="text-align:center">Pekerjaan Selesai</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $n = 1;
              foreach ($list as $l) {
              ?>
                <tr>
                  <td class="text-center"><?= $n ?></td>
                  <td><?= $l->nip ?></td>
                  <td><?= $l->nama_lengkap ?></td>
                  <td class="text-center"><?= $l->diusulkan ?></td>
                  <td class="text-center"><?= $l->belum_dikerjakan ?></td>
                  <td class="text-center"><?= $l->verifikasi ?></td>
                  <td class="text-center"><?= $l->selesai ?></td>
                </tr>
              <?php
                $n++;
              }
              ?>
            </tbody>
          </table>
        </div>
            <?php } ?>
      </div>
    </div>
  </div>
</div>