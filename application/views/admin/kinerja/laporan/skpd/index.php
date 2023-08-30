<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pencapaian Kinerja SKPD</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>Laporan</li>
                <li class="active">Pencapaian Kinerja SKPD</li>
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
                    
                    <div class="col-md-3">
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

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control select2" id="bulan" onchange="loadPagination(1)">
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

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pencarian </label>
                            <input type="text" onkeyup="loadPagination(1)" placeholder="Cari Nama SKPD" class="form-control" name="search" id="search" />
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0" id="title">LAPORAN PENCAPAIAN KINERJA SKPD</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <div class="table-responsive">
                            <button class="btn btn-default btn-outline pull-right" onclick="download()"><i class="fa fa-download"></i> Download</button>
                            <table style="margin-top:50px" class="table table-striped_">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama SKPD</th>
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
    
    var page = 1;
    
    function loadPagination(p) {
        page = p;
       
        if(!isloading)
        {
            isloading = false;
            $.ajax({
                url: "<?=base_url()?>kinerja/laporan/skpd/get_list/" + page,
                type: 'post',
                dataType: 'json',
                data: {
                    tahun: $("#tahun").val(),
                    bulan: $("#bulan").val(),
                    search: $("#search").val()
                },
                success: function (data) {
                    //console.log(data);
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

    function download()
    {
        var tahun = $("#tahun").val();
        var bulan = $("#bulan").val();
        
        var link = "<?=base_url();?>kinerja/laporan/skpd/download?tahun=" + tahun + "&bulan=" + bulan ;
        window.open(link,"_blank");
    }
</script>