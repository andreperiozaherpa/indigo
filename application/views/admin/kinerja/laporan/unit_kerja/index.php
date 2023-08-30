<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pencapaian Unit Kerja</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>Laporan</li>
                <li class="active">Pencapaian Unit Kerja</li>
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
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Nama SKPD </label>
                            <select class="form-control select2" id="id_skpd" onchange="loadData()">
                                <?php foreach($dt_skpd->result() as $row)
                                {
                                    $selected = ($this->input->get("id_skpd")==$row->id_skpd) ? "selected" : "";
                                    echo '<option '.$selected.' value="'.$row->id_skpd.'">'.$row->nama_skpd.'</option>';
                                }
                                ?>
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

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control select2" id="bulan" onchange="loadData()">
                                <option value="">Semua</option>
                                <?php foreach($this->Config->bulan as $key=>$value)
                                {
                                    $selected = ($this->input->get("bulan")==$key) ? "selected" : "";
                                    echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
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
                        <h3 class="text-center box-title m-b-0" id="title">LAPORAN PENCAPAIAN UNIT KERJA</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark" id="sub_title"></p>
                        <div class="table-responsive">
                            <button class="btn btn-default btn-outline pull-right" onclick="download()"><i class="fa fa-download"></i> Download</button>
                            <table style="margin-top:50px" class="table table-striped_">
                                <thead>
                                    <tr>
                                        <th>Unit Kerja</th>
                                        <th>Capaian (%)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="row-data">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>

    </div>

</div>


<script type="text/javascript">
    var isloading = false;
    
    var id_skpd = "<?= ($this->input->get("id_skpd")) ? $this->input->get("id_skpd")  : "" ;?>";
    
    loadData();

    function loadData() {
        var nama_skpd = $('#id_skpd option:selected').text();
        $("#sub_title").html(nama_skpd);

        if(!isloading)
        {
            isloading = false;
            $.ajax({
                url: "<?=base_url()?>kinerja/laporan/unit_kerja/get_data/",
                type: 'post',
                dataType: 'json',
                data: {
                    tahun: $("#tahun").val(),
                    id_skpd: $("#id_skpd").val(),
                    bulan: $("#bulan").val(),
                    search: $("#search").val()
                },
                success: function (data) {
                    //console.log(data);
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

    
    function download()
    {
        var tahun = $("#tahun").val();
        var bulan = $("#bulan").val();
        var id_skpd = $("#id_skpd").val();
        var nama_skpd = $('#id_skpd option:selected').text();

        var link = "<?=base_url();?>kinerja/laporan/unit_kerja/download?tahun=" + tahun + "&bulan=" + bulan  + "&nama_skpd="+nama_skpd+'&id_skpd='+id_skpd;
        window.open(link,"_blank");
    }
</script>