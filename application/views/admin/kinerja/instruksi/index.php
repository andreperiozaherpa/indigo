<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Instruksi Khusus</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li class="active">Instruksi Khusus</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama SKPD </label>
                            <select class="form-control select2" id="fid_skpd" onchange="loadPagination(1)">
                                <?php foreach($dt_skpd->result() as $row)
                                {
                                    echo '<option value="'.$row->id_skpd.'">'.$row->nama_skpd.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pencarian </label>
                            <input type="text" class="form-control" id="search" placeholder="Cari instruksi .." onkeyup="loadPagination(1)"/>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tahun </label>
                            <select class="form-control select2" id="ftahun" onchange="loadPagination(1)">
                                <?php foreach($this->Globalvar->get_tahun() as $key=>$value)
                                {
                                    $i = $key + 1;
                                    $selected = (date("Y")==$value) ? "selected" : "" ;
                                    echo '<option '.$selected.' value="'.$i.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0">INSTRUKSI KHUSUS PIMPINAN</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark" id="sub_title"></p>
                        <div class="table-responsive">
                            <button class="btn btn-primary pull-right" onclick="add()"><i class="fa fa-plus"></i> Tambah</button>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5px">No</th>
                                        <th>Nama Instruksi</th>
                                        <th>Jadwal Pelaksanaan</th>
                                        <th>Tahun</th>
                                        <th>Target</th>
                                        <th>Satuan</th>
                                        <th>Cascade</th>
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

<div id="modal-instruksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Instruksi Khusus</h4>
            </div>
            <div class="modal-body">
                <form id="form-data">
                    <div class="form-group">
                        <label for="renja" class="control-label">SKPD</label>
                        <select class="form-control select2" id="id_skpd" name="id_skpd" onchange="getPegawai()">
                                <?php foreach($dt_skpd->result() as $row)
                                {
                                    echo '<option value="'.$row->id_skpd.'">'.$row->nama_skpd.'</option>';
                                }
                                ?>
                        </select>
                        <div class="text-danger error" id="err_id_skpd"></div>
                    </div>
                    <div class="form-group">
                        <label for="id_instruksi_atasan" class="control-label">Rencana Kinerja Atasan</label>
                        <select class="form-control select2" name="id_instruksi_atasan" id="id_instruksi_atasan" onchange="setKinerjaAtasan()">
                            <option value="">Pilih</option>
                        </select>
                        <div class="text-danger error" id="err_id_instruksi_atasan"></div>
                    </div>
                    <div class="form-group">
                        <label for="nama_instruksi" class="control-label">Nama Rencana Kinerja Bawahan</label>
                        <input type="text" class="form-control" id="nama_instruksi" name="nama_instruksi" placeholder="Masukan Rencana Kinerja Bawahan">
                        <div class="text-danger error" id="err_nama_instruksi"></div>
                    </div>

                    <div class="form-group">
                        <label for="target" class="control-label">Target</label>
                        <input type="text" class="form-control" id="target" name="target" placeholder="Masukan Target">
                        <div class="text-danger error" id="err_target"></div>
                    </div>
                    <div class="form-group">
                        <label for="satuan" class="control-label">Satuan</label>
                        <select class="form-control select2" id="satuan" name="satuan">
                            <option value="">Pilih</option>
                            <?php foreach($dt_satuan as $row)
                            {
                                echo '<option value="'.$row->id_satuan.'">'.$row->satuan.'</option>';
                            }
                            ?>
                        </select>
                        <div class="text-danger error" id="err_satuan"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="satuan" class="control-label">Tahun</label>
                        <select class="form-control select2" id="tahun" name="tahun">
                        <option value="">Pilih</option>
                            <?php foreach($this->Globalvar->get_tahun() as $t => $tahun_desc)
                            {
                                $tahun = $t+1;
                                echo '<option value="'.$tahun.'">'.$tahun_desc.'</option>';
                            }
                            ?>
                        </select>
                        <div class="text-danger error" id="err_tahun"></div>
                    </div>

                    <div class="form-group">
                        <label for="bulan" class="control-label">Jadwal Pelaksanaan</label>
                        <select class="form-control_ select2" id="bulan" name="bulan[]" multiple>
                            <?php foreach($this->Config->bulan as $key => $value):?>
                            <option value="<?=$key;?>"><?=$value;?></option>
                            <?php endforeach?>
                        </select>
                        <div class="text-danger error" id="err_bulan"></div>
                    </div>
                    <div class="form-group" id="cascading_row">
                        <label for="cascading" class="control-label">Cascading Ke</label>
                        <select class="form-control_ select2" id="cascading" name="cascading[]" multiple>
                            
                        </select>
                        <div class="text-danger error" id="err_cascading"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="save()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var action = "";
    var rowData = [];
    var id_instruksi = 0;

    var cascading = [];

    init();
    function init()
    {
        getPegawai();
    }

    function add()
    {
        $(".error").html("");
        $('#form-data')[0].reset();
        $("#cascading").val([]).trigger("change");
        
        $("#bulan").val([]).trigger("change");
        $("#satuan").val("").trigger("change");
        $("#tahun").val("").trigger("change");
        $("#id_instruksi_atasan").val("").trigger("change");

        action = "add";
        id_instruksi = 0;
        cascading = [];
        $("#modal-instruksi").modal("show");
    }
    function edit(i)
    {
        $(".error").html("");
        $("#id_instruksi_atasan").val(rowData[i].id_instruksi_atasan).trigger("change");

        cascading = rowData[i].cascading;
        $("#id_skpd").val(rowData[i].id_skpd).trigger("change");

        
        $("#bulan").val(rowData[i].bulan).trigger("change");
        $("#satuan").val(rowData[i].satuan).trigger("change");
        $("#tahun").val(rowData[i].tahun).trigger("change");
        

        $("#nama_instruksi").val(rowData[i].nama_instruksi);
        $("#nama_indikator").val(rowData[i].nama_indikator);
        $("#target").val(rowData[i].target);

        id_instruksi = rowData[i].id_instruksi;

        
        
        action = "edit";
        $("#modal-instruksi").modal("show");
    }
    function reset_error()
    {
        $(".error").html("");
    }

    function save()
    {
        reset_error();
        var formdata = new FormData(document.getElementById('form-data'));
        formdata.append("action",action);
        formdata.append("id_instruksi",id_instruksi);
        
        $.ajax({
            url        : "<?=base_url()?>kinerja/instruksi/save",
            type       : 'post',
            dataType   : 'json',
            data       : formdata,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success    : function(data){
            //console.log(data);
                if(data.status){
                    $('#modal-instruksi').modal('toggle');
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
                    if(data.errors.length==0){
                        swal(
                        'Opps',
                        data.message,
                        'warning');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        });
    }

    function getPegawai() {
        $("#cascading").html("");
        $.ajax({
            url: "<?=base_url()?>kinerja/instruksi/get_pegawai/",
            type: 'post',
            dataType: 'json',
            data: {
                id_skpd: $("#id_skpd").val(),
            },
            success: function (data) {
                //console.log(data);
                $("#cascading").html(data.content).trigger("change");
                $("#cascading").val(cascading).trigger("change");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    var page=1;
    
    function loadPagination(page_num) {

        
        
        page = page_num;
        var nama_skpd = $('#fid_skpd option:selected').text();
        
        $("#sub_title").html(nama_skpd);

        $.ajax({
        url: "<?=base_url()?>kinerja/instruksi/get_list/" + page_num,
        type: 'post',
        dataType: 'json',
        data: {
            id_skpd : $("#fid_skpd").val(),
            search   : $("#search").val(),
            tahun   : $("#ftahun").val()
        },
        success: function (data) {
            console.log(data);
            rowData = data.result;
            $("#row-data").html(data.content);
            $("#pagination").html(data.pagination);
            get_rencana_kerja();
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
        }
        });
    }

    function hapus(id) {
        swal({
                title: "Hapus instruksi ?",
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
                        url: "<?=base_url()?>kinerja/instruksi/delete",
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

    function get_rencana_kerja() {
        $("#id_instruksi_atasan").html("");
        $.ajax({
            url: "<?=base_url()?>kinerja/instruksi/get_rencana_kerja/",
            type: 'post',
            dataType: 'json',
            data: {
                id_skpd: $("#id_skpd").val(),
            },
            success: function (data) {
                $("#id_instruksi_atasan").html(data.content).trigger("change");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function setKinerjaAtasan()
    {
        /* let instruksi_atasan = $("#id_instruksi_atasan").val();
        if(instruksi_atasan != "")
        {
            $("#cascading_row").show();
        }
        else{
            $("#cascading_row").hide();
        } */
    }
</script>