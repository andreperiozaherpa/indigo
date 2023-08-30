<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Sigesit</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            
            <ol class="breadcrumb">
                <li><a href="#">Monev</a></li>
                <li class="active">Detail Monev</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="white-box">

                <div class="panel panel-default">
                    <div class="panel-heading">Detail Anggaran</div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="row">

                                    <div class="col-md-12" style="">

                                        <div class="form-group">
                                            <label class="col-md-12">Tahun Periode</label>
                                            <div class="col-md-12">
                                                <span><?=$detail->tahun;?></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Program</label>
                                            <div class="col-md-12">

                                                <span><?= $detail->kode_program.' '.$detail->nama_program;?></span>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Kegiatan</label>
                                            <div class="col-md-12">
                                                <span><?= $detail->kode_kegiatan.' '.$detail->nama_kegiatan;?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Sub-Kegiatan</label>
                                            <div class="col-md-12">
                                                <span><?= $detail->kode_sub_kegiatan.' '.$detail->nama_sub_kegiatan;?></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Output Sub-Kegiatan</label>
                                            <div class="col-md-12">
                                                <span><?=$detail->output_kegiatan;?></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12" style="">


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12">Target</label>
                                                    <div class="col-md-12">
                                                        <span><?=$detail->target;?> <?=$detail->satuan;?></span>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12">Sumber Anggaran</label>
                                            <div class="col-sm-12">

                                                <span><?=$detail->nama_sumber_anggaran;?></span>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Total Anggaran</label>
                                            <div class="col-md-12">
                                                <span>Rp. <?=number_format($detail->total_anggaran);?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Realisasi Anggaran</label>
                                            <div class="col-md-12">
                                                <span>Rp. <?=number_format($detail->realisasi_anggaran);?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Karakteristik / Kelompok Sasaran</label>
                                            <div class="col-md-12">
                                                <span><?=$detail->sasaran;?></span>
                                            </div>
                                        </div>

                                       

                                    </div>
                                </div>
                            </form>



                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">


            <div class="white-box" style="padding:40px">
                <!-- .left-right-aside-column-->
                <div class="row">

                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title">Capaian Aktivitas</h3>
                        <div class="text-right"> <span class="text-muted">Total</span>
                            <h1><sup></sup> Rp. <?=$total_aktivitas;?></h1>
                        </div> <span class="text-success"><?=$p_aktivitas;?>%</span>
                        <div class="progress m-b-0">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?=$p_aktivitas;?>"
                                aria-valuemin="0" aria-valuemax="100" style="width:<?=$p_aktivitas;?>%;"> <span
                                    class="sr-only"><?=$p_aktivitas;?>%
                                    Complete</span> </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Aktivitas</div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama Aktivitas</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Satuan</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="row_realisasi_anggaran">
                                            <?php foreach($dt_anggaran as $key => $row)
                                            {
                                                echo '
                                                    <tr>
                                                        <td>'.$row->nama_kegiatan.'</td>
                                                        <td>'.$row->jumlah.'</td>
                                                        <td>'.number_format($row->harga).'</td>
                                                        <td>'.$row->satuan.'</td>
                                                        <td>'.number_format($row->total).'</td>
                                                    </tr>
                                                ';        
                                            }
                                            ?>
                                        </tbody>
                                    </table>



                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <div class="row">
    <div class="col-md-12">


        <div class="white-box" style="padding:40px">

            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title">Capaian Anggaran</h3>
                        <div class="text-right"> <span class="text-muted">Telah digunakan</span>
                            <h1><sup></sup> Rp. <?=$total_digunakan;?></h1>
                        </div> <span class="text-success"><?=$p_digunakan;?>%</span>
                        <div class="progress m-b-0">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$p_digunakan;?>"
                                aria-valuemin="0" aria-valuemax="100" style="width:<?=$p_digunakan;?>%;"> <span
                                    class="sr-only"><?=$p_digunakan;?>%
                                    Complete</span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .left-right-aside-column-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Realisasi Anggaran</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">

                                <form id="form-realisasi">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama Aktivitas</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Satuan</th>
                                                <th>Total</th>
                                                <th width="50px"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="row_realisasi">
                                            <?php foreach($dt_realisasi_anggaran as $key => $row)
                                            {
                                                $action = '<button onclick="hapus_realisasi('.$key.')" class="btn btn-secondary"><i class="fa fa-trash"></i></button>';

                                                $id_realisasi_anggaran = !empty($row->id_realisasi_anggaran) ? $row->id_realisasi_anggaran : 0;

                                                echo '
                                                <tr id="realisasi_'.$key.'">
                                                    <td><input value="'.$row->nama_kegiatan.'" id="nama_kegiatan_'.$key.'" name="realisasi[nama_kegiatan][]" type="text" class="form-control" placeholder=""></td>
                                                    <td><input value="'.$row->jumlah.'" onkeyup="kalkulasi('.$key.')" id="jumlah_'.$key.'" name="realisasi[jumlah][]" type="number" class="form-control" placeholder=""></td>
                                                    <td><input value="'.number_format($row->harga).'" onkeyup="kalkulasi('.$key.')" id="harga_'.$key.'" name="realisasi[harga][]" type="text" class="form-control" placeholder=""></td>
                                                    <td><input value="'.$row->satuan.'" id="satuan_'.$key.'" name="realisasi[satuan][]" type="text" class="form-control" placeholder=""></td>
                                                    <td><input value="'.number_format($row->total).'" id="total_'.$key.'" type="text" class="form-control" placeholder="" readonly></td>
                                                    <td>
                                                    '.$action.'
                                                    <input value="'.$id_realisasi_anggaran.'" id="id_realisasi_anggaran_'.$key.'" name="realisasi[id_realisasi_anggaran][]" type="hidden">
                                                    </td>
                                                </tr>
                                                ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </form>
                                <a href="javascript:void(0)" class="btn btn-primary btn-outline"
                                    onclick="tambah_realisasi()"><i class="fa fa-plus"></i> Tambah
                                    Data</a>
                                <button onclick="save_realisasi()" class="btn btn-primary"><i
                                        class="fa fa-save"></i>
                                    Simpan</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


    <!-- <div class="row">
        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title">Capaian Anggaran</h3>
                <div class="text-right"> <span class="text-muted">Telah digunakan</span>
                    <h1><sup></sup> Rp. <?=$total_digunakan;?></h1>
                </div> <span class="text-success"><?=$p_digunakan;?>%</span>
                <div class="progress m-b-0">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$p_digunakan;?>"
                        aria-valuemin="0" aria-valuemax="100" style="width:<?=$p_digunakan;?>%;"> <span
                            class="sr-only"><?=$p_digunakan;?>%
                            Complete</span> </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title">Capaian Kinerja</h3>
                <div class="text-right"> <span class="text-muted">Telah Diterima oleh</span>
                    <h1><sup></sup> <?=$total_terima;?> / <?=$total_final;?> Org</h1>
                </div> <span class="text-warning"><?=$p_terima;?>%</span>
                <div class="progress m-b-0">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?=$p_terima;?>"
                        aria-valuemin="0" aria-valuemax="100" style="width:<?=$p_terima;?>%;"> <span
                            class="sr-only"><?=$p_terima;?>% Complete</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title">Capaian Aktivitas</h3>
                <div class="text-right"> <span class="text-muted">Total</span>
                    <h1><sup></sup> Rp. <?=$total_aktivitas;?></h1>
                </div> <span class="text-success"><?=$p_aktivitas;?>%</span>
                <div class="progress m-b-0">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?=$p_aktivitas;?>"
                        aria-valuemin="0" aria-valuemax="100" style="width:<?=$p_aktivitas;?>%;"> <span
                            class="sr-only"><?=$p_aktivitas;?>%
                            Complete</span> </div>
                </div>
            </div>
        </div>

    </div> -->

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="white-box">
                <div class="panel panel-default">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row ">
                                <h3>Penerima (<span id="total_penerima">0</span> Orang)</h3>

                                <div class="col-md-4" style="padding:0px;margin-bottom:10px">
                                    <select class="form-control select2" id="kdkec_penerima"
                                        onchange="get_desa('penerima')">
                                        <option value="">Semua Kecamatan</option>
                                        <?php 
                                            foreach($dt_kecamatan as $row){
                                                echo '<option value="'.$row->id_kecamatan.'">'.$row->kecamatan.'</option>';
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="col-md-4" style="padding:0px 0px 0px 10px;margin-bottom:10px;">
                                    <select class="form-control select2" id="kddesa_penerima" onchange="loadPagination(1)">
                                        <option value="">Semua Desa</option>
                                    </select>
                                </div>
                                <div class="col-md-4" style="padding:0px 0px 0px 10px;margin-bottom:10px;">
                                    <input id="search_penerima" onkeyup="loadPagination(1)" type="text" class="form-control"
                                        placeholder="Cari nama atau NIK" />
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12" style="margin-top:10px">
                                                <div id="range_usia_1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <?php foreach($dt_sasaran as $key=>$val):?>
                                            <div class="col-md-2" style="margin-top:10px">
                                                <div class="form-group">
                                                    <div class="checkbox checkbox-primary">
                                                        <input onclick="loadPagination(1)" id="penerima_jenis_bantuan_<?=$val;?>"
                                                            name="penerima_jenis_bantuan[]" type="checkbox">
                                                        <label for="penerima_jenis_bantuan_<?=$val;?>"> <?=$val;?> </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div style="margin-top:10px">
                                    <button onclick="filter_by_status('')"
                                        class="btn btn-default btn-xs btn-rounded btn-outline">Semua</button>
                                    <?php foreach($dt_status as $key => $value)
                                        {
                                            echo '<button onclick="filter_by_status(\''.$value.'\')" class="btn btn-default btn-xs btn-rounded btn-outline">'.$value.'</button>&nbsp;';
                                        }
                                        ?>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table m-t-30">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Desa</th>
                                            <th>Kecamatan</th>
                                            <th>Karektistik RTS</th>
                                            <th style="text-align:center">Bant. KKS</th>
                                            <th style="text-align:center">Bant. PBI</th>
                                            <th style="text-align:center">Bant. PKH</th>
                                            <th style="text-align:center">Bant. KIP</th>
                                            <th style="text-align:center">Bant. BPNT</th>
                                            <th style="text-align:center">Status</th>
                                            <th style="text-align:center">Opsi</th>
                                            <th style="text-align:center">Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="row-penerima">

                                    </tbody>
                                </table>

                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <nav class="mt-4 mb-3">
                                        <ul class="pagination justify-content-center mb-0" id="pagination">
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xs-12">
            <div class="white-box">
                <div class="panel panel-default">
                    <div class="panel-heading">Pelaksanaan Kegiatan
                    <button onclick="add_aktivitas()"
                    class="btn m-b-5 btn-primary pull-right"> <i class="fa fa-plus"></i> Laporkan Aktivitas</button>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="steamline" id="row-aktivitas">
                                
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-outline btn-primary" id="load_more" onclick="load_more()">Muat lainnya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="laporanAktifitas" tabindex="-1" role="dialog" aria-labelledby="laporanAktifitas">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="laporanAktifitas">Laporan Aktifitas</h4>
                </div>
                <div class="modal-body">
                    <form id="form-aktivitas">
                        <div class="form-group">
                            <label for="tanggal" class="control-label">Tanggal:</label>
                            <input type="date" name="tanggal" class="form-control" id="tanggal">
                            <div class="text-danger error" id="err_tanggal"></div>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="control-label">Deskripsi Laporan:</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                            <div class="text-danger error" id="err_deskripsi"></div>
                        </div>

                        <div class="form-group">
                            <label for="foto" class="control-label">Foto:</label>
                            <input type="file" class="dropify" id="foto" name="foto[]" multiple>
                        </div>

                       
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="save_aktivitas()">Simpan</button>
                </div>
            </div>
        </div>
    </div>





<div class="modal fade" id="detailPenerima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Detail Penerima</h4>
            </div>
            <div class="modal-body">
                <div id="row_detail_penerima">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>


<script>

var page_penerima = 1;
    var status = '';
    var final = 'Y';
    var status = '';

    var i = '<?= ($dt_anggaran) ? count($dt_anggaran) : 0 ;?>';

    function loadPagination(page_num) {

        page_penerima = page_num;
        var usia = $("#range_usia_1").data();
        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/get_penerima/" + page_num,
            type: 'post',
            dataType: 'json',
            data: {
                search: $("#search_penerima").val(),
                kdkec: $("#kdkec_penerima").val(),
                kddesa: $("#kddesa_penerima").val(),
                id_kegiatan : '<?=$detail->id_kegiatan;?>',
                final : final,
                flag : 'monev',
                status : status,
                usia_1 : usia.from,
                usia_2 : usia.to,
                kks : ($("#penerima_jenis_bantuan_KKS").prop("checked")==true) ? 1 : 0,
                pbi : ($("#penerima_jenis_bantuan_PBI").prop("checked")==true) ? 1 : 0,
                kip : ($("#penerima_jenis_bantuan_KIP").prop("checked")==true) ? 1 : 0,
                pkh : ($("#penerima_jenis_bantuan_PKH").prop("checked")==true) ? 1 : 0,
                bpnt : ($("#penerima_jenis_bantuan_BPNT").prop("checked")==true) ? 1 : 0,
            },
            success: function (data) {
                //console.log(data);
                $("#row-penerima").html(data.content);
                $("#pagination").html(data.pagination);
                $("#total_penerima").html(data.total_rows);
                $("#btn-belum-terima").html("Belum terima ("+data.total_belum_terima+")");
                $("#btn-sudah-terima").html("Sudah terima ("+data.total_sudah_terima+")");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function get_desa(flag) {
        $("#kddesa_" + flag).val("").trigger("change");
        $.ajax({
            url: "<?=base_url()?>sigesit/kegiatan/get_desa",
            type: 'post',
            dataType: 'json',
            data: {
                id: $("#kdkec_" + flag).val(),
            },
            success: function (data) {
                //console.log(data);
                $("#kddesa_" + flag).html(data.content);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    
    function filter_by_status(rts) {
        status = rts;
        loadPagination(1);
    }
    function detail_penerima(id_dtks)
    {
        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/detail_penerima",
            type: 'post',
            dataType: 'json',
            data: {
                id_dtks: id_dtks,
            },
            success: function (data) {
                if(data.status==true)
                {
                    $("#row_detail_penerima").html(data.content);
                    $("#detailPenerima").modal();
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
        
    }

    function set_terima(f) {
        status = f;
        loadPagination(1);
    }

    function set_status(status,id=null)
    {
        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/status",
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                status : status,
                id_kegiatan : '<?=$detail->id_kegiatan;?>',
            },
            success: function (data) {
                if(data.status==true)
                {
                    loadPagination(1);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
        
    }

    var action_aktivitas = 'add';
    function add_aktivitas()
    {
        action_aktivitas = 'add';
        $("#laporanAktifitas").modal();
    }

    function save_aktivitas()
    {
        reset_error();
        var formdata = new FormData(document.getElementById('form-aktivitas'));
        formdata.append("action",action_aktivitas);
        formdata.append("id_kegiatan","<?=$detail->id_kegiatan;?>");
        formdata.append("id_skpd","<?=$detail->id_skpd;?>");
        
        $.ajax({
            url        : "<?=base_url()?>sigesit/aktivitas/save",
            type       : 'post',
            dataType   : 'json',
            data       : formdata,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success    : function(data){
                console.log(data);
                if(data.status){
                swal('Berhasil',data.message,'success');
                setTimeout(() => {
                    location.reload();
                }, 1000);
                }
                else{
                for(err in data.errors)
                {
                    $("#err_"+err).html(data.errors[err]);
                }
                if(data.errors.length==0){
                    swal('Opps',data.message,'warning');
                }
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        });
    }

    function reset_error()
    {
      $(".error").html("");
    }

    var page_aktivitas = 1;
    function loadPagination2(page_num) {
        $("#load_more").attr("disabled",true);
        
        page_aktivitas = page_num;

        $.ajax({
            url: "<?=base_url()?>sigesit/aktivitas/get_list/" + page_num,
            type: 'post',
            dataType: 'json',
            data: {
                id_kegiatan : '<?=$detail->id_kegiatan;?>',
            },
            success: function (data) {
                //console.log(data);
                $("#row-aktivitas").append(data.content);
                if(data.load_more)
                {
                    $("#load_more").attr("disabled",false);
                    $("#load_more").show();
                }
                else{
                    $("#load_more").hide();
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function load_more()
    {
        var num = page_aktivitas+1;
        loadPagination2(num);
    }

    function show_hint(i)
    {
        $("#hint_catatan_"+i).show();
    }
    function save_catatan(i,id)
    {
        if(event.key === 'Enter')
        {
            var catatan = $("#catatan_"+i).val();
            
            $.ajax({
                url: "<?=base_url()?>sigesit/penerima/catatan",
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    catatan : catatan,
                },
                success: function (data) {
                    if(data.status==true)
                    {
                        loadPagination(1);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    swal("Opps", "Terjadi kesalahan", "error");
                }
            });
            
            hide_hint(i);
        }
        else{
            show_hint(i);
        }
    }

    function hide_hint(i)
    {
        $("#hint_catatan_"+i).hide();
    }


    function tambah_realisasi()
    {

        var action = '<button onclick="hapus_realisasi('+i+')" class="btn btn-secondary"><i class="fa fa-trash"></i></button>';
        
        
        var row = '<tr id="realisasi_'+i+'">'
            +'<td><input id="nama_kegiatan_'+i+'" name="realisasi[nama_kegiatan][]" type="text" class="form-control" placeholder=""></td>'
            +'<td><input onkeyup="kalkulasi('+i+')" id="jumlah_'+i+'" name="realisasi[jumlah][]" type="number" class="form-control" placeholder=""></td>'
            +'<td><input onkeyup="kalkulasi('+i+')" id="harga_'+i+'" name="realisasi[harga][]" type="text" class="form-control" placeholder=""></td>'
            +'<td><input id="satuan_'+i+'" name="realisasi[satuan][]" type="text" class="form-control" placeholder=""></td>'
            +'<td><input id="total_'+i+'" type="text" class="form-control" placeholder="" readonly></td>'
            +'<td>'
            +action
            +'<input id="total_'+i+'" name="realisasi[id_realisasi_anggaran][]" value="0" type="hidden">'
            +'</td>'
            +'</tr>';

        $("#row_realisasi").append(row);

        i++;

    }

    function hapus_realisasi(x)
    {
        $("#realisasi_"+x).remove();
    }

    setTimeout(() => {
        tambah_realisasi();
    }, 100);

    function kalkulasi(n)
    {
        var jumlah = $("#jumlah_"+n).val();
        var harga = $("#harga_"+n).val().replaceAll(",","");
        var total = 0;
        if(jumlah>0 && harga>0)
        {
            total = parseFloat(jumlah * harga);
        }

        if(harga>0)
        {
            harga = parseFloat(harga).toLocaleString("en-US");
        }

        $("#harga_"+n).val(harga);
        $("#total_"+n).val(total.toLocaleString("en-US"));
    }

    function save_realisasi()
    {
      reset_error();
      var formdata = new FormData(document.getElementById('form-realisasi'));
      formdata.append("id_kegiatan","<?=$detail->id_kegiatan;?>");
      $.ajax({
         url        : "<?=base_url()?>sigesit/monev/save_realisasi",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){
            console.log(data);
            if(data.status){
               swal('Berhasil',data.message,'success');
               setTimeout(() => {
                   location.reload();
               }, 1000);
            }
            else{
               for(err in data.errors)
               {
                  $("#err_"+err).html(data.errors[err]);
               }
               if(data.errors.length==0){
                  swal('Opps',data.message,'warning');
               }
            }
         },
         error: function(xhr, status, error) {
            console.log(xhr);
         }
      });
    }

    function remove(token) {
    swal({
      title: "Hapus data ?",
      //text: "Apakah anda yakin akan menghapus data ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      closeOnConfirm: false
    },
    function (isConfirm) {
      if (isConfirm) {
        $.ajax({
          url: "<?=base_url()?>sigesit/aktivitas/delete",
          type: 'post',
          dataType: 'json',
          data: {
            token: token,
          },
          success: function (data) {
            //console.log(data);
            if (data.status == true) {
              swal({
                type: 'success',
                title: 'Berhasil',
                text: data.message,
                showConfirmButton: false,
                timer: 1500
              });

              setTimeout(() => {
                  location.reload();
              }, 500);
            } else {
              swal("Opps", data.message, "error");
            }
          },
          error: function (xhr, status, error) {
            //swal("Opps","Error","error");
            console.log(xhr);
          }
        });
      }
    });
   }
</script>
