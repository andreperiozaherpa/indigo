<style>
    .checked {
        color: #6003c8;
    }

    .input-container input {
        border: none;
        box-sizing: border-box;
        outline: 0;
        padding: .75rem;
        position: relative;
        width: 100%;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">LKH Pegawai</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>LKH</li>
                <li class="active">Pegawai</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Filter</h3>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pencarian</label>
                            <input type="text" onkeyup="loadPagination(1)" placeholder="Cari data" class="form-control" name="search" id="search" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Dari Tanggal </label>
                            <input type="date" value="<?=$date1;?>" onChange="loadPagination(1)" placeholder="Tanggal" class="form-control" name="date1" id="date1" />
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Sampai Tanggal </label>
                            <input type="date" value="<?=$date2;?>" onChange="loadPagination(1)" placeholder="Tanggal" class="form-control" name="date2" id="date2" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2" id="status_verifikasi" onchange="loadPagination(1)">
                                <option value="">Semua</option>
                                <option value="sudah_diverifikasi">Sudah Diverifikasi</option>
                                <option value="belum_diverifikasi">Belum Diverifikasi</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button class="btn btn-block btn-primary" onclick="add()"><i class="ti-plus"></i> Tambah Laporan</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0" id="title">LAPORAN KINERJA HARIAN PEGAWAI</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark" id="sub_title"></p>
                        <div class="table-responsive">
                            <button class="btn btn-primary btn-outline pull-right" onclick="download()"><i class="ti-file"></i> Download Rekap</button>
                            <table style="margin-top:50px" class="table table-striped_">
                                <thead>
                                    <tr>
                                        <th width="30px">No</th>
                                        <th width="150px">Hari / Tanggal</th>
                                        <th>Rencana Hasil</th>
                                        <th>Renaksi</th>
                                        <th>Realisasi (%)</th>
                                        <th width="150px">Status</th>
                                        <th width="100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="row-data">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
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

<div class="modal fade" id="modalLaporan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Form Laporan Kinerja Harian</h4>
            </div>
            <div class="modal-body">
                <form id="form-data">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input onchange="getRencanaHasil()" type="date" class="form-control" name="tanggal" id="tanggal" autocomplete="off" placeholder="Pilih Tanggal Pekerjaan" required>
                    <div class="text-danger error" id="err_tanggal"></div>
                </div>
                <div class="form-group">
                    <label>Rencana Hasil Kerja </label>
                    <select class="form-control select2" id="rencana_hasil" name="rencana_hasil" onchange="getRenaksi()">
                    </select>
                    <div class="text-danger error" id="err_rencana_hasil"></div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Rencana Aksi </label>
                            <select class="form-control select2" id="id_renaksi_detail" name="id_renaksi_detail" onchange="getRenaksiDetail()">
                            </select>
                            <div class="text-danger error" id="err_id_renaksi_detail"></div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Target </label>
                            <input type="text" readonly class="form-control " name="target" id="target" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Satuan </label>
                            <input type="text" readonly class="form-control satuan" >
                        </div>
                    </div>
                    <div class="col-md-12 notif_realisasi">
                        <div class="alert alert-danger">Total Akumulasi Pencapaian Rencana Aksi : <strong id="total_realisasi">0 %</strong></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Laporan Hasil Kegiatan</label>
                    <textarea class="form-control textarea_editor" rows="10" name="rincian_kegiatan" id="rincian_kegiatan" placeholder="Masukkan Rincian Kegiatan" required></textarea>
                    <div class="text-danger error" id="err_rincian_kegiatan"></div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label>Realisasi terhadap terhadap target (%)</label>
                            <input type="number" class="form-control" name="hasil_kegiatan" id="hasil_kegiatan" placeholder="Masukkan Realisasi" />
                            <div class="text-danger error" id="err_hasil_kegiatan"></div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" readonly class="form-control satuan_" value="%" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Lampiran / Evidence <small>(Opsional)</small></label>
                    <input type="file" class="dropify" name="lampiran" id="lampiran">
                </div>
                <div class="form-group">
                    <label>Verifikator</label>
                    <select class="form-control select2" name="id_verifikator" id="id_verifikator"> 
                        <option value="">Pilih Verifikator</option>
                        <?php
                        foreach ($dt_verifikator as $p) {
                            echo '<option value="' . $p->id_pegawai . '">' . $p->nama_lengkap . ' - ' . $p->jabatan . '</option>';
                        }
                        ?>
                    </select>
                    <div class="text-danger error" id="err_id_verifikator"></div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Tutup</a>
                <button type="submit" id="btn-submit" onclick="submit()" class="btn btn-primary waves-effect text-left">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modalDownload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Download Rekap Catatan Kerja Pegawai</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('laporan_kinerja_harian/download_rekap_lkh') ?>" target="_blank">
                    <input type="hidden" name="id_pegawai" value="<?= $this->session->userdata('id_pegawai') ?>">
                    <div class="form-group">
                        <label>Bulan</label>
                        <select name="bulan" class="form-control" required>
                            <option value="">Pilih Bulan</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $selected = set_value('bulan') == $i ? ' selected' : '';
                                echo '<option value="' . $i . '"' . $selected . '>' . bulan($i) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <label>Tahun</label>
                        <select name="tahun" class="form-control" required>
                            <option value="">Pilih Tahun</option>
                            <?php
                            for ($i = 2020; $i <= 2025; $i++) {
                                $selected = set_value('tahun') == $i ? ' selected' : '';
                                echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Tutup</a>
                <button type="submit" class="btn btn-primary"><i class="ti-download"></i> Download</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    var isloading = false;

    var page = 1;

    var id_laporan_kerja_harian = 0;
    var id_renaksi_detail = 0;
    var rencana_hasil = 0;

    var action = "";

    var resultData = [];
    
    function loadPagination(p) {
        page = p;
        var nama_skpd = $('#id_skpd option:selected').text();
        $("#sub_title").html(nama_skpd);

        if(!isloading)
        {
            isloading = false;
            $.ajax({
                url: "<?=base_url()?>kinerja/lkh/pegawai/get_list/" + page,
                type: 'post',
                dataType: 'json',
                data: {
                    date1: $("#date1").val(),
                    date2: $("#date2").val(),
                    search: $("#search").val(),
                    status_verifikasi : $("#status_verifikasi").val()
                },
                success: function (data) {
                    //console.log(data);
                    resultData = data.result;
                    $("#row-data").html(data.content);
                    $("#pagination").html(data.pagination);
                    isloading = false;
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    swal("Opps", "Terjadi kesalahan", "error");
                    isloading = false;
                }
            });
        }
    }


    function add()
    {
        action = "add";
        id_laporan_kerja_harian = 0;
        $("#form-data")[0].reset();
        $(".select2").val("").trigger("change");
        $(".error").html("");

        $(".dropify-preview").attr("style","display: none;");
        $("#lampiran").attr("data-default-file",'');

        $("#btn-submit").show();
        $("#form-data .form-control").attr("disabled",false);
        $("#modalLaporan").modal("show");
    }

    function edit(i)
    {
        action = "edit";
        id_laporan_kerja_harian = resultData[i].id_laporan_kerja_harian;

        $("#form-data")[0].reset();
        $(".select2").val("").trigger("change");
        $(".error").html("");

        console.log(resultData[i]);

        $("#tanggal").val(resultData[i].tanggal);
        rencana_hasil = resultData[i].id_rencana_hasil;
        id_renaksi_detail = resultData[i].id_renaksi_detail;

        console.log(id_renaksi_detail);
        getRencanaHasil();
        $("#rincian_kegiatan").html(resultData[i].rincian_kegiatan);
        $("#hasil_kegiatan").val(resultData[i].hasil_kegiatan);
        $("#id_verifikator").val(resultData[i].id_verifikator).trigger("change");

        var file = "<?=base_url();?>data/kegiatan_personal/"+resultData[i].id_pegawai+"/"+resultData[i].lampiran;
        $(".dropify-render").html("<img src='"+file+"' />");
        $(".dropify-preview").attr("style","display: block;");
        $(".dropify-loader").attr("style","display:none;");
        $("#lampiran").attr("data-default-file",'');

        $("#btn-submit").show();
        $("#form-data .form-control").attr("disabled",false);
        $("#modalLaporan").modal("show");
    }

    function detail(i)
    {
        edit(i);
        $("#btn-submit").hide();
        $("#form-data .form-control").attr("disabled",true);
    }


    function submit()
    {
        var formdata = new FormData(document.getElementById('form-data'));
        formdata.append("action",action);
        formdata.append("id_laporan_kerja_harian",id_laporan_kerja_harian);

        //let lampiran = $("#lampiran")[0].files[0];

        //formdata.append("lampiran",lampiran);

        $(".error").html("");

        $.ajax({
            url        : "<?=base_url()?>kinerja/lkh/pegawai/submit",
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
                    $('#modalLaporan').modal('toggle');
                    swal(
                        'Berhasil',
                        data.message,
                        'success'
                    );
                    loadPagination(1);
                }
                else{
                    for(err in data.errors)
                    {
                        $("#err_"+err).html(data.errors[err]);
                    }
                    
                    swal(
                        'Opps',
                        'Mohon periksa kembali data anda',
                        'warning'
                    );
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        });
    }

    function getRencanaHasil()
    {
        $("#rencana_hasil").attr("disabled",true);
        var tanggal = document.getElementsByName("tanggal");
        //console.log(tanggal[0].value);
        $.ajax({
            url: "<?=base_url()?>kinerja/lkh/data/get_rencana_hasil/",
            type: 'post',
            dataType: 'json',
            data: {
                tanggal: tanggal[0].value,
                rencana_hasil : rencana_hasil
            },
            success: function (data) {
                //console.log(data);
                $("#rencana_hasil").attr("disabled",false);
                $("#rencana_hasil").html(data.content).trigger("change");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    var target = [];
    var satuan = [];
    var realisasi = [];

    function getRenaksi()
    {
        $("#id_renaksi_detail").attr("disabled",true);
        var tanggal = document.getElementsByName("tanggal");
        var rencana_hasil = $("#rencana_hasil").val();
        $(".notif_realisasi").hide();
        //console.log(tanggal[0].value);
        $.ajax({
            url: "<?=base_url()?>kinerja/lkh/data/get_renaksi",
            type: 'post',
            dataType: 'json',
            data: {
                rencana_hasil: rencana_hasil,
                tanggal: tanggal[0].value,
                id_renaksi_detail : id_renaksi_detail
            },
            success: function (data) {
                //console.log(data);
                target = data.target;
                satuan = data.satuan;
                realisasi = data.realisasi;
                console.log(data);
                $("#id_renaksi_detail").attr("disabled",false);
                $("#id_renaksi_detail").html(data.content).trigger("change");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function getRenaksiDetail()
    {
        var id = $("#id_renaksi_detail").val();
        
        if(id!="")
        {
            $("#target").val(target[id]);
            $(".satuan").val(satuan[id]);

            if(realisasi[id])
            {
                $("#total_realisasi").html(realisasi[id] + "%");
                $(".notif_realisasi").show();
            }


        }
        else{
            $("#target").val("");
            $(".satuan").val("");
        }
        
    }


    function hapus(id) {
        swal({
                title: "Hapus LKH",
                text : 'Apakah Anda yakin akan menghapus Laporan ini?',
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
                        url: "<?=base_url()?>kinerja/lkh/pegawai/delete",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            if (data.status == true) {
                                swal({
                                    type: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                loadPagination(1);
                            } else {
                                swal("Opps", data.message, "error");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr);
                        }
                    });
                }
            });
    }

    function download() {
        $('#modalDownload').modal('show');
    }
</script>