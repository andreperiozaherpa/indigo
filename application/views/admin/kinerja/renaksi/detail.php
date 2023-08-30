<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Rencana Aksi</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>Renaksi</li>
                <li class="active">Detail</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        

        <div class="col-md-6">
            <div class="white-box" style="min-height:380px">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="box-title m-t-5">Pegawai yang dinilai</h3>
                        <table width="100%" class="table">
                            <thead>
                                <tr valign="top"><td width="30%">Nama</td><td width="5%">:</td><td><?=$detail->nama_lengkap;?></td></tr>
                                <tr valign="top"><td>NIP</td><td>:</td><td><?=$detail->nip;?></td></tr>
                                <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td><?=$detail->pangkat;?></td></tr>
                                <tr valign="top"><td>Jabatan</td><td>:</td><td><?=$detail->jabatan;?></td></tr>
                                <tr valign="top"><td>Unit Kerja</td><td>:</td><td><?=$detail->nama_unit_kerja;?></td></tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="white-box" style="min-height:380px">
                <div class="row">
                    <div class="col-md-12">
                        
                        <h3 class="box-title m-t-5">Pejabat penilai kerja</h3>
                        <table width="100%" class="table">
                            <thead>
                                <tr valign="top"><td width="30%">Nama</td><td width="5%">:</td><td><?=$detail->nama_lengkap_atasan;?></td></tr>
                                <tr valign="top"><td>NIP</td><td>:</td><td><?=$detail->nip_atasan;?></td></tr>
                                <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td><?=$detail->pangkat_atasan;?></td></tr>
                                <tr valign="top"><td>Jabatan</td><td>:</td><td><?=$detail->jabatan_atasan;?></td></tr>
                                <tr valign="top"><td>Unit Kerja</td><td>:</td><td><?=$detail->nama_unit_kerja_atasan;?></td></tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Rencana Hasil Kerja </label>
                            <select class="form-control select2" id="rencana_hasil" onchange="loadPagination(1)">
                                <optgroup label="Kinerja Utama">
                                <?php foreach($dt_kinerja_utama as $row)
                                {
                                    if($row->flag=="sasaran")
                                    {
                                        $rencana_hasil = $row->nama_indikator_sasaran_renstra;
                                    }
                                    else{
                                        $rencana_hasil = $row->rencana_hasil_kerja;
                                    }

                                    $value = "U-".$row->id_kinerja_utama;

                                    $selected = ($detail->id_kinerja_utama && $detail->id_kinerja_utama == $row->id_kinerja_utama) ? "selected" : "";

                                    echo '<option '.$selected.' value="'.$value.'">'.$rencana_hasil.'</option>';
                                }
                                ?>
                                </optgroup>

                                <optgroup label="Instruksi Khusus">
                                <?php foreach($dt_instruksi as $row)
                                {
                                    $value = "I-".$row->id_instruksi_khusus;
                                    $selected = ($detail->id_instruksi_khusus && $detail->id_instruksi_khusus == $row->id_instruksi_khusus) ? "selected" : "";
                                    echo '<option '.$selected.' value="'.$value.'">'.$row->indikator_kinerja_individu.'</option>';
                                }
                                ?>
                                </optgroup>

                                <optgroup label="Kinerja Tambahan">
                                <?php foreach($dt_kinerja_tambahan as $row)
                                {
                                    $value = "T-".$row->id_kinerja_tambahan;
                                    $selected = ($detail->id_kinerja_tambahan && $detail->id_kinerja_tambahan == $row->id_kinerja_tambahan) ? "selected" : "";
                                    echo '<option '.$selected.' value="'.$value.'">'.$row->rencana_hasil_kerja.'</option>';
                                }
                                ?>
                                </optgroup>

                               
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
                        <h3 class="text-center box-title m-b-0" id="title">RENCANA AKSI</h3>
                        <p class="text-center text-dark m-b-0" id="sub_title"></p>
                        <div class="table-responsive">
                            <button class="btn btn-primary btn-outline_ m-l-5 pull-right" onclick="add()"><i class="fa fa-plus"></i> Tambah</button>
                            <button class="btn btn-primary btn-outline pull-right" onclick="download()"><i class="fa fa-download"></i> Download</button>
                            <table
                             class="table table-striped_" style="margin-top:50px">
                                
                                    <tr>
                                        <th rowspan="2" width="10px">No</th>
                                        <th rowspan="2">Rencana Aksi</th>
                                        <th colspan="12" style="text-align:center">Target (Bulan)</th>
                                        <th rowspan="2">Satuan</th>
                                        <th rowspan="2" width="100px">Aksi</th>
                                    </tr>
                                    <tr>
                                        <?php foreach($this->Config->bulan as $key=>$value)
                                        {
                                            echo '<th style="text-align:center">'.$key.'</th>';
                                        }
                                        ?>
                                    </tr>
                                
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

<div id="modal-renaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg_">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Rencana Aksi</h4>
            </div>
            <div class="modal-body">
                <form id="form-data">
                    
                    <div class="form-group">
                        <label for="renaksi_" class="control-label">Nama Rencana Aksi</label>
                        <input type="text" class="form-control" id="renaksi_" name="renaksi" placeholder="Masukan Rencana Aksi">
                        <div class="text-danger error" id="err_renaksi"></div>
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

                    <div class="table-responsive">
                        <table class="table table-bordered_ table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: left" width="30%">Jadwal Pelaksanaan</th>
                                <th style="text-align: left" colspan="1">Target</th>
                                <th style="text-align: center">Status Jadwal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->Config->bulan as $key => $value) :?>
                            <tr>
                                <td style="text-align: left"><?=$value?></td>
                                <td style="text-align: center">
                                <input type="number" class="form-control input_target target_renaksi" 
                                    id="target_<?=$key;?>" name="target[<?=$key?>]" placeholder="Target">
                                </td>
                                <td style="text-align: center">
                                    <div class="checkbox checkbox-primary">
                                        <input type="checkbox" id="status_<?=$key;?>" name="status[<?=$key;?>]" value="Y" class="js-switch_ status" data-color="#6003c8" data-size="small" />
                                            <label for="status_<?=$key;?>"> </label>
                                    </div>
                                    
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
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
    var id_renaksi = "";

    var page=1;
    var rowData = [];

    function add()
    {
        action = "add";
        id_renaksi = 0;

        $(".error").html("");
        $('#form-data')[0].reset();

        $(".status").attr("checked",false);

        $("#modal-renaksi").modal("show");

    }

    function edit(i)
    {
        action = "edit";
        id_renaksi = rowData[i].id_renaksi;

        $(".error").html("");
        $('#form-data')[0].reset();

        $("#renaksi_").val(rowData[i].renaksi);
        $("#satuan").val(rowData[i].id_satuan).trigger("change");

        /* var is_checked = $("#status_1").is(":checked");
        if(is_checked)
        {
            $("#status_1").trigger("click");
        } */

        for(x in rowData[i].detail)
        {
            var detail = rowData[i].detail[x];
            $("#target_"+detail.bulan).val(detail.target);
            if(detail.status_jadwal == "Y")
            {
                $("#status_"+detail.bulan).attr("checked",true);
            }
            else{
                $("#status_"+detail.bulan).attr("checked",false);
            }
            //console.log(detail.bulan);
        }

        console.log(rowData[i]);

        $("#modal-renaksi").modal("show");

    }

    function save()
    {
        $(".error").html("");
        var formdata = new FormData(document.getElementById('form-data'));
        formdata.append("action",action);
        formdata.append("id_renaksi",id_renaksi);
        formdata.append("rencana_hasil",$("#rencana_hasil").val());
        formdata.append("tahun","<?=$detail->tahun;?>");
        formdata.append("tahun_desc","<?=$detail->tahun_desc;?>");
        formdata.append("id_skp","<?=$detail->id_skp;?>");
        
        $.ajax({
            url        : "<?=base_url()?>kinerja/renaksi/save",
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
                    $('#modal-renaksi').modal('toggle');
                    swal(
                        'Berhasil',
                        data.message,
                        'success'
                    );
                    loadPagination(page);
                }
                else{
                    for(err in data.errors)
                    {
                        $("#err_"+err).html(data.errors[err]);
                    }
                    if(data.message){
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

    
    function loadPagination(page_num) {

        page = page_num;
        $("#sub_title").html($('#rencana_hasil option:selected').text());
        $.ajax({
            url: "<?=base_url()?>kinerja/renaksi/get_list/" + page_num,
            type: 'post',
            dataType: 'json',
            data: {
                rencana_hasil: $("#rencana_hasil").val(),
            },
            success: function (data) {
                console.log(data.result);
                rowData = data.result;
                $("#row-data").html(data.content);
                $("#pagination").html(data.pagination);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function hapus(id) {
        swal({
                title: "Hapus renaksi ?",
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
                        url: "<?=base_url()?>kinerja/renaksi/delete",
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

    function download()
    {
        var rencana_hasil = $("#rencana_hasil").val();
        var desc = $('#rencana_hasil option:selected').text();
        var link = "<?=base_url()?>kinerja/renaksi/download/"+rencana_hasil+'?desc='+desc;
        window.open(link,"_blank");
    }

</script>