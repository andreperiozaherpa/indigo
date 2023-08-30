<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pendokumentasian Kinerja</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li class="active">Pendokumentasian Kinerja</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama SKPD </label>
                            <select class="form-control select2" id="id_skpd" onchange="getPegawai()">
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
                            <label>Pegawai </label>
                            <select class="form-control select2" id="id_pegawai" onchange="loadData()">
                            <option value="">Pilih</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control select2" id="tahun" onchange="loadData()">
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

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control select2" id="bulan" onchange="loadData()">
                                <?php foreach($this->Config->bulan as $key=>$value)
                                {
                                    $selected = (date("n")==$key) ? "selected" : "" ;
                                    echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div id="row-pegawai"></div>

        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0" id="title">PENDOKUMENTASIAN KINERJA</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark" id="sub_title"></p>
                        <div class="table-responsive">
                            <button class="btn btn-default btn-outline pull-right" onclick="download()"><i class="fa fa-download"></i> Download</button>
                            <table style="margin-top:50px" class="table table-striped_">
                                <thead>
                                    <tr>
                                        <!-- <th>No</th> -->
                                        <th>Hasil Kerja</th>
                                        <th>Rencana Aksi</th>
                                        <th>Capaian (%)</th>
                                        <th width="120px">Bukti Dukung</th>
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


<script type="text/javascript">
    var isloading = false;

    function detailPegawai()
    {
        $.ajax({
            url: "<?=base_url()?>kinerja/renaksi/get_data/",
            type: 'post',
            dataType: 'json',
            data: {
                tahun: $("#tahun").val(),
                bulan: $("#bulan").val(),
                id_pegawai: $("#id_pegawai").val()
            },
            success: function (data) {
                if (data.skp) {
                    getData(data.skp);
                }
                

                $("#row-pegawai").html(data.pegawai);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }
    function loadData() {
        
        var nama_skpd = $('#id_skpd option:selected').text();
        $("#sub_title").html(nama_skpd);

        if(!isloading)
        {
            detailPegawai(); 
            getData();
        }
    }

    getPegawai();
    function getPegawai() {
        $("#id_pegawai").html("");
        $.ajax({
            url: "<?=base_url()?>kinerja/matrik/get_pegawai/",
            type: 'post',
            dataType: 'json',
            data: {
                id_skpd: $("#id_skpd").val(),
            },
            success: function (data) {
                $("#id_pegawai").html(data.content).trigger("change");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function getData()
    {
        isloading = false;
        $.ajax({
            url: "<?=base_url()?>kinerja/dokumentasi/get_data/",
            type: 'post',
            dataType: 'json',
            data: {
                tahun: $("#tahun").val(),
                bulan: $("#bulan").val(),
                id_pegawai: $("#id_pegawai").val()
            },
            success: function (data) {
                console.log(data);
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

    function download()
    {
        var tahun = $("#tahun").val();
        var bulan = $("#bulan").val();
        var id_pegawai = $("#id_pegawai").val();
        var nama_skpd = $('#id_skpd option:selected').text();

        var link = "<?=base_url();?>kinerja/dokumentasi/download?tahun=" + tahun + "&bulan=" + bulan + "&id_pegawai=" + id_pegawai + "&nama_skpd="+nama_skpd;
        window.open(link,"_blank");
    }
</script>