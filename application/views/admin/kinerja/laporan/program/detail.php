<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Program</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>Laporan</li>
                <li>Program</li>
                <li class="active">Detail</li>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SKPD</label>
                            <select class="form-control select2" id="id_skpd" onchange="getSasaran()">
                                <?php foreach($dt_skpd->result() as $row)
                                {
                                    echo '<option value="'.$row->id_skpd.'">'.$row->nama_skpd.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sasaran</label>
                            <select class="form-control select2" id="id_sasaran_renstra" onchange="getProgram()"></select>
                        </div>
                    </div>
                    

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Program</label>
                            <select class="form-control select2" id="id_program_renstra" onchange="loadPagination(1)"></select>
                        </div>
                    </div>
                    

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pencarian </label>
                            <input type="text" onkeyup="loadPagination(1)" placeholder="Cari indikator" class="form-control" name="search" id="search" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control select2" id="tahun" onchange="loadPagination(1)">
                                <?php foreach($this->Globalvar->get_tahun() as $key=>$value)
                                {
                                    $i = $key + 1;
                                    if($this->input->get("tahun"))
                                    {
                                        $selected = ($this->input->get("tahun")==$i) ? "selected" : "" ;
                                    }
                                    else{
                                        $selected = (date("Y")==$value) ? "selected" : "" ;
                                    }

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
                        <h3 class="text-center box-title m-b-0" id="title">LAPORAN PROGRAM</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark" id="sub_title"></p>
                        <div class="table-responsive">
                            <a href="<?=base_url();?>kinerja/laporan/program" class="btn btn-default btn-outline pull-right" style="margin-left:5px">Kembali</a>
                            <button class="btn btn-default btn-outline pull-right" onclick="download()"><i class="fa fa-download"></i> Download</button>
                            <table style="margin-top:50px" class="table table-striped_">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sasaran</th>
                                        <th>Program</th>
                                        <th>Indikator</th>
                                        <th>Metode</th>
                                        <th>Kinerja (%)</th>
                                        <th>Anggaran (%)</th>
                                        <th>Aksi</th>
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


<div id="modal-update-capaian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg_">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Update Realisasi Program</h4>
            </div>
            <div class="modal-body">
                <form id="form-data">
                    
                    <div class="form-group">
                        <label for="nama_instruksi" class="control-label">Nama Indikator</label>
                        <input type="hidden" id="id_indikator_program_renstra" name="id_indikator_program_renstra"/>
                        <input type="hidden" id="metode" name="metode"/>
                        <input readonly type="text" class="form-control" id="nama_indikator_program_renstra"
                            name="nama_indikator_program_renstra" placeholder="">
                        <div class="text-danger error" id="err_nama_indikator_program_renstra"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="target" class="control-label">Target Kinerja</label>
                                <input readonly type="text" class="form-control" id="target" name="target"
                                    placeholder="">
                                <div class="text-danger error" id="err_target"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="satuan" class="control-label">Satuan</label>
                                <input readonly type="text" class="form-control" id="satuan" name="satuan"
                                    placeholder="">
                                <div class="text-danger error" id="err_satuan"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="realisasi" class="control-label">Realisasi Kinerja</label>
                                <input type="text" class="form-control" id="realisasi" name="realisasi" placeholder="">
                                <div class="text-danger error" id="err_realisasi"></div>
                            </div>
                            <div class="form-group" id="row_capaian_manual">
                                <label for="realisasi" class="control-label">Input Capaian Manual</label>
                                <input type="number" class="form-control" id="capaian" name="capaian" placeholder="Masukan capaian manual">
                                <div class="text-danger error" id="err_capaian"></div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" id="hitung_otomatis" name="hitung_otomatis" value="Y" class="js-switch_ status" data-color="#6003c8" data-size="small" />
                                    <label for="hitung_otomatis"> Hitung capaian otomatis</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="target_rp" class="control-label">Target Anggaran</label>
                                <input readonly type="text" class="form-control" id="target_rp" name="target_rp" placeholder="">
                                <div class="text-danger error" id="err_target"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="realisasi_rp" class="control-label">Realisasi Anggaran</label>
                                <input type="number" class="form-control" id="realisasi_rp" name="realisasi_rp" placeholder="">
                                <div class="text-danger error" id="err_realisasi_rp"></div>
                            </div>
                        </div>
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
    var isloading = false;
    
    var page = 1;
    var rowData = [];

    var id_skpd = "<?= ($this->input->get("id_skpd")) ? $this->input->get("id_skpd")  : "" ;?>";
    var id_program_renstra = "<?= ($this->input->get("id_program_renstra")) ? $this->input->get("id_program_renstra")  : "" ;?>";
    var id_sasaran_renstra = "<?= ($this->input->get("id_sasaran_renstra")) ? $this->input->get("id_sasaran_renstra")  : "" ;?>";
    
    function loadPagination(p) {
        page = p;
        var nama_skpd = $('#id_skpd option:selected').text();
        $("#sub_title").html(nama_skpd);

        if(!isloading)
        {
            isloading = false;
            $.ajax({
                url: "<?=base_url()?>kinerja/laporan/program/get_detail/" + page,
                type: 'post',
                dataType: 'json',
                data: {
                    tahun: $("#tahun").val(),
                    id_skpd: $("#id_skpd").val(),
                    search: $("#search").val(),
                    id_sasaran_renstra: $("#id_sasaran_renstra").val(),
                    id_program_renstra: $("#id_program_renstra").val(),
                },
                success: function (data) {
                    console.log(data);
                    rowData = data.result;
                    $("#row-data").html(data.content);
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

    getSasaran();

    function getSasaran()
    {
      $("#id_sasaran_renstra").html("");
      $.ajax({
         url: "<?=base_url()?>kinerja/laporan/program/get_sasaran/",
         type: 'post',
         dataType: 'json',
         data: {
            id_skpd : $("#id_skpd").val(),
            id_sasaran_renstra: id_sasaran_renstra
         },
         success: function (data) {
            $("#id_sasaran_renstra").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    function getProgram()
    {
      $("#id_program_renstra").html("");
      $.ajax({
         url: "<?=base_url()?>kinerja/laporan/program/get_program/",
         type: 'post',
         dataType: 'json',
         data: {
            id_sasaran_renstra : $("#id_sasaran_renstra").val(),
            id_program_renstra : id_program_renstra,
         },
         success: function (data) {
             console.log(data);
            $("#id_program_renstra").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }


    function download()
    {
        var tahun = $("#tahun").val();
        var bulan = $("#bulan").val();
        var id_skpd = $("#id_skpd").val();
        var id_sasaran_renstra = $("#id_sasaran_renstra").val();
        var id_program_renstra = $("#id_program_renstra").val();
        var nama_skpd = $('#id_skpd option:selected').text();

        var link = "<?=base_url();?>kinerja/laporan/program/download_detail?tahun=" + tahun + "&bulan=" + bulan  + "&nama_skpd="+nama_skpd+'&id_skpd='+id_skpd+'&id_sasaran_renstra='+id_sasaran_renstra+'&id_program_renstra='+id_program_renstra;
        window.open(link,"_blank");
    }

    function update_capaian(i)
    {
        console.log(rowData[i]);
        var tahun = $("#tahun").val();
        var target = "target_tahun_" + tahun;
        var target_rp = "target_tahun_" + tahun + "_rp";
        $("#nama_indikator_program_renstra").val(rowData[i].nama_indikator_program_renstra);
        $("#id_indikator_program_renstra").val(rowData[i].id_indikator_program_renstra);
        $("#metode").val(rowData[i].metode);
        
        $("#target").val(rowData[i][target]);
        $("#satuan").val(rowData[i].satuan_desc);
        $("#target_rp").val(rowData[i][target_rp]);

        // default otomatis
        $("#hitung_otomatis").attr("checked",true);
        $("#row_capaian_manual").hide();

        if(rowData[i].realisasi)
        {
            if(rowData[i].realisasi.hitung_otomatis=="N")
            {
                $("#hitung_otomatis").attr("checked",false);
                $("#row_capaian_manual").show();
            }
            $("#realisasi").val(rowData[i].realisasi.realisasi);
            $("#realisasi_rp").val(rowData[i].realisasi.realisasi_rp);
            $("#faktor_pendorong").val(rowData[i].realisasi.faktor_pendorong);
            $("#faktor_penghambat").val(rowData[i].realisasi.faktor_penghambat);
            $("#tindak_lanjut_rkpd").val(rowData[i].realisasi.tindak_lanjut_rkpd);
            $("#tindak_lanjut_rpjmd").val(rowData[i].realisasi.tindak_lanjut_rpjmd);
        }

        
        $("#modal-update-capaian").modal("show");
    }

    function save()
    {
        $(".error").html("");
        var formdata = new FormData(document.getElementById('form-data'));
        formdata.append("tahun",$("#tahun").val());
        formdata.append("tahun_desc",$("#tahun option:selected").text());
        $.ajax({
            url        : "<?=base_url()?>kinerja/laporan/program/save_realisasi",
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
                    $('#modal-update-capaian').modal('toggle');
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

</script>