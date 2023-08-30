<style type="text/css">
  tr.pt-tr td {
    padding-top: 30px !important;
  }

  .pt-tr {
    background: #eee;
    border-top: 2px solid #6003c8;
  }
</style>

<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Sasaran Kinerja Pegawai</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url(); ?>/skp_perencanaan">Sasaran Kinerja Pegawai</a></li>
        <li class="active">List</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
    <div class="white-box">
      <div class="user-bg"> <img width="100%" height="100%" alt="user" src="https://e-office.sumedangkab.go.id/data/images/header/header2.jpg">
        <div class="overlay-box">
          <div class="col-md-3">
            <div class="user-content"><img src="https://e-office.sumedangkab.go.id/data/foto/pegawai/<?= $pegawai->foto_pegawai ?>" class="thumb-lg img-circle" style=" object-fit: cover;
            width: 80px;
            height: 80px;border-radius: 50%;
            " alt="img">
              <h5 class="text-white"><b><?= $pegawai->nama_lengkap ?></b></h5>
              <h6 class="text-white"><?= $pegawai->nip ?></h6>
            </div>
          </div>
          <div class="col-md-3" style="border-right: 1px solid grey;border-left: 1px solid grey;">
            <br>
            <div class="user-content" style="padding-bottom:15px;">
              <h5 class="text-white"><b>SKPD</b></h5>
              <h6 class="text-white"><?= $pegawai->nama_skpd ?></h6>
            </div>
          </div>
          <div class="col-md-3" style="border-right: 1px solid grey;">
            <br>
            <div class="user-content" style="padding-bottom:15px;">
              <h5 class="text-white"><b>Unit Kerja</b></h5>
              <h6 class="text-white"><?= $pegawai->nama_unit_kerja ?></h6>
            </div>
          </div>
          <div class="col-md-3">
            <br>
            <div class="user-content" style="padding-bottom:15px;">
              <h5 class="text-white"><b>Jabatan</b></h5>
              <h6 class="text-white"><?= $pegawai->jabatan ?></h6>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="row">

    <div class="white-box">
      <div class="row" style="position: relative;">
        <i style="position:absolute;display:inline-block;font-size:15px;color:#fff;background-color:#6003c8;padding:17px;border-radius: 50% 0px 0px 50%;line-height: 29px" class="ti-list"></i>
        <div style="margin-left:48px;display:inline-block;border: solid 1px #E4E7EA;padding: 15px;width: 95%">
          <span style="font-weight: 450;text-transform: uppercase;">DAFTAR KEGIATAN TAHUN <?= $this->uri->segment(3) ?></span>
          <a href="<?= base_url() ?>/contoh_skp.xlsx" class="btn btn-outline btn-primary btn-sm btn-rounded pull-right" target="_blank"><i class="fa fa-file-o"></i> Cetak SKP</a>
        </div>
      </div>
      <hr>
      <h4 class="text-center"><strong>HASIL KERJA UTAMA</strong></h4>
      <hr>

      <h4 class="p-b-20"><span class="btn btn-xs btn-circle btn-primary btn-outline">1</span> Meningkatnya pelayanan infrastruktur perumahan dan permukiman yang layak dan aman (penugasan dari Menteri)</h4>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6 b-all p-20">
            <h5 class="text-center"><code>Indikator Kinerja Individu:</code> Persentase peningkatan pelayanan infrastruktur pemukiman yang layak dan aman melalui pendekatan smart living</h5>
            <hr>
            <div class="b-all p-10">

              <div class="pull-right p-l-10" style="border-left: 5px solid #6003c8!important;">Target: <strong>61,95%</strong></div>
              <!-- <div class="p-b-10"><span class="label label-rouded label-purple">KUALITAS</span></div> -->
              <code>Perspektif:</code> Penerima Layanan
            </div>
          </div>
        </div>
      </div>

      <hr>
      <h4 class="p-b-20"><span class="btn btn-xs btn-circle btn-primary btn-outline">2</span> Terwujudnya Direktorat Jenderal III yang reform dan akuntabel (penugasan dari Menteri)</h4>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6 b-all p-20">
            <h5 class="text-center"><code>Indikator Kinerja Individu:</code> Nilai pelaksanaan Reformasi Birokrasi Direktorat Jenderal III</h5>
            <hr>
            <div class="b-all p-10">

              <div class="pull-right p-l-10" style="border-left: 5px solid #6003c8!important;">Target: <strong>85</strong></div>
              <!-- <div class="p-b-10"><span class="label label-rouded label-purple">KUALITAS</span></div> -->
              <code>Perspektif:</code> Penguatan Internal
            </div>
          </div>
          <div class="col-md-6 b-all p-20">
            <h5 class="text-center"><code>Indikator Kinerja Individu:</code> Nilai Akuntabilitas Kinerja Direktorat Jenderal III</h5>
            <hr>
            <div class="b-all p-10">

              <div class="pull-right p-l-10" style="border-left: 5px solid #6003c8!important;">Target: <strong>85</strong></div>
              <!-- <div class="p-b-10"><span class="label label-rouded label-purple">KUALITAS</span></div> -->
              <code>Perspektif:</code> Penguatan Internal
            </div>
          </div>
        </div>
      </div>

      <hr>
      <h4 class="text-center"><strong>HASIL KERJA TAMBAHAN</strong></h4>
      <hr>

      <h4 class="p-b-20"><span class="btn btn-xs btn-circle btn-primary btn-outline">3</span> Terlaksananya rencana aksi/inisiatif strategis dalam rangka pencapaian sasaran dan indikator Kinerja utama organisasi dalam perjanjian kerja (penugasan dari Menteri)</h4>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6 b-all p-20">
            <h5 class="text-center"><code>Indikator Kinerja Individu:</code> Persentase penyelesaian rencana aksi/inisiatif strategis yang berkontribusi langsung terhadap pencapaian indikator Perjanjian Kinerja Direktorat Jenderal III sesuai target waktu yang ditetapkan</h5>
            <hr>
            <div class="b-all p-10">

              <div class="pull-right p-l-10" style="border-left: 5px solid #6003c8!important;">Target: <strong>80%</strong></div>
              <!-- <div class="p-b-10"><span class="label label-rouded label-purple">KUALITAS</span></div> -->
              <code>Perspektif:</code> Proses Bisnis
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>



  <script type="text/javascript">
    function simpan_perencanaan(id) {
      swal({
        title: "Apakah sudah Yakin?",
        text: "Setelah disimpan, Anda tidak dapat kembali ke perencanaan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#6003c8",
        confirmButtonText: "Ya, Simpan Perencanaan!",
        closeOnConfirm: false
      }, function() {
        swal("Berhasil!", "Perencanaan sudah disimpan.", "success");
        $('#submit_set' + id).click();
      });
    }

    function hapus_kegiatan(id) {
      swal({
        title: "Apakah sudah Yakin?",
        text: "Setelah dihapus, Data tidak dapat dikembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f75b36",
        confirmButtonText: "Ya, Hapus Kegiatan!",
        closeOnConfirm: false
      }, function() {
        swal("Berhasil!", "Perencanaan sudah dihapus.", "success");
        $('#submit_delete' + id).click();
      });
    }

    function hapus_sub(id) {
      swal({
        title: "Apakah sudah Yakin?",
        text: "Setelah dihapus, Data tidak dapat dikembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f75b36",
        confirmButtonText: "Ya, Hapus Sub Kegiatan!",
        closeOnConfirm: false
      }, function() {
        swal("Berhasil!", "Sub Kegiatan sudah dihapus.", "success");
        $('#submit_deletesub' + id).click();
      });
    }

    function remove_sub(id) {
      swal({
        title: "Apakah sudah Yakin?",
        text: "Setelah dihapus, Data Realisasi tidak dapat dikembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f75b36",
        confirmButtonText: "Ya, Hapus Casecading!",
        closeOnConfirm: false
      }, function() {
        swal("Berhasil!", "Casecading sudah dihapus.", "success");
        $('#submit_removesub' + id).click();
      });
    }

    function simpan_skp(id) {
      swal({
        title: "Apakah sudah Yakin?",
        text: "Setelah disimpan, Anda tidak dapat kembali ke realisasi!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#00c292",
        confirmButtonText: "Ya, Simpan SKP!",
        closeOnConfirm: false
      }, function() {
        swal("Berhasil!", "SKP sudah disimpan.", "success");
        $('#submit_save' + id).click();
      });
    }
  </script>