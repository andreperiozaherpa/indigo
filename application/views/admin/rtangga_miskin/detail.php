<style>
    th,
    td {
        vertical-align: middle !important;
    }

    td {
        background-color: #fff !important;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Rumah Tangga Miskin</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Rumah Tangga Miskin</li>
                <li class="active">Detail</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <form method="POST">
                        <div class="col-md-3 b-r">
                            <center><img style="width: 80%" src="https://e-office.sumedangkab.go.id/data/logo/skpd/sumedang.png" alt="user" class="img-circle" /> </center>
                        </div>
                        <div class="col-md-9">
                            <div class="panel panel-primary">
                                <div class="panel-heading"> Desa Cijati <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                                </div>
                                <div class="panel-wrapper collapse in" aria-expanded="true">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <td style="width: 120px;">Nama Kepala </td>
                                                <td>:</td>
                                                <td> <strong>Data belum tersedia</strong>
                                            </tr>
                                            <tr>
                                                <td style="width: 120px;">Alamat SKPD </td>
                                                <td>:</td>
                                                <td> <strong>-</strong>
                                            </tr>
                                            <tr>
                                                <td style="width: 120px;">Email/tlp </td>
                                                <td>:</td>
                                                <td> <strong>email@emai.com / -</strong>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    Target Menurunnya Jumlah Rumah Tangga Miskin (Desil 1 dan Desil 2)
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <label>Tambah KK</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Masukkan No. KK">
                                    <span class="input-group-btn">
                                        <button id="btnSearch" type="button" onclick="searchKK()" class="btn waves-effect waves-light btn-primary"><i class="ti-search"></i> Cari</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3 class="box-title text-purple">DAFTAR KELUARGA MISKIN <span class="label label-primary">Target : 20</span> </h3>
                        <div class="table-responsive dragscroll">
                            <table class="table color-table muted-table table-bordered" style="margin-top:10px">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">No. KK</th>
                                        <th class="text-center">Nama Kepala Keluarga</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Status Realisasi</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>3211192338482777</td>
                                        <td class="text-center">Dadang Sulaiman</td>
                                        <td class="text-center">TALUN KALER RT.02 RW.07 KEL. TALUN</td>
                                        <td class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td class="text-center"><a href="javascript:void(0)" onclick="detailSasaran()" class="btn btn-sm btn-danger" style="color:white;"><i class="ti-trash"></i> Hapus</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modalSearchKK" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail KK</h4>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <table>
                        <tr>
                            <td style="font-weight: 500;">Nomor KK</td>
                            <td width="30px" class="text-center">:</td>
                            <td>3211193328477</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 500;">Nama Kepala Keluarga</td>
                            <td class="text-center">:</td>
                            <td>Dadang Sulaiman</td>
                        </tr>
                        </tr>
                        <tr>
                            <td style="font-weight: 500;">Alamat</td>
                            <td class="text-center">:</td>
                            <td>TALUN KALER RT.02 RW.07 KEL. TALUN</td>
                        </tr>
                    </table>

                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Jenis Pekerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Dadang Sulaiman</td>
                                <td>3211193393716</td>
                                <td>Laki-laki</td>
                                <td>Sumedang, 2 Juli 1978</td>
                                <td>Buruh Harian Lepas</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Cicih Sukaesih</td>
                                <td>3211193393938</td>
                                <td>Perempuan</td>
                                <td>Sumedang, 5 Juni 1980</td>
                                <td>Ibu Rumah Tangga</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Rizky Ramadhan</td>
                                <td>3211193393013</td>
                                <td>Laki-laki</td>
                                <td>Sumedang, 18 Agustus 2000</td>
                                <td>Belum / Tidak Bekerja</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="ti-check"></i> Tambahkan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
                </form>
            </div>
        </div>

    </div>
</div>


<script>
    function searchKK(){
        $('#modalSearchKK').modal('show');
    }
</script>