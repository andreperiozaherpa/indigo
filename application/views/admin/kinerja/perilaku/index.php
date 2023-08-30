<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Penilaian Perilaku</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li class="active">Penilaian Perilaku</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    

                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Pegawai </label>
                            <select class="form-control select2" id="id_pegawai" onchange="loadPagination(1)">
                            <option value="">Pilih</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control select2" id="bulan" onchange="loadPagination(1)">
                                <?php foreach($this->Config->bulan as $key=>$value)
                                {
                                    $selected = (date("n")==$key) ? "selected" : "" ;
                                    echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control select2" id="tahun" onchange="loadPagination(1)">
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
                        <h3 class="text-center box-title m-b-0" id="title">PENILAIAN PERILAKU</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <div class="table-responsive">
                            <table style="margin-top:50px" class="table table-striped_">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Status Pegawai</th>
                                        <th>Status</th>
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

    var page=1;
    
    function loadPagination(page_num) {

        page = page_num;
        
        $.ajax({
        url: "<?=base_url()?>kinerja/perilaku/get_list/" + page_num,
        type: 'post',
        dataType: 'json',
        data: {
            id_pegawai : $("#id_pegawai").val(),
            bulan   : $("#bulan").val(),
            tahun   : $("#tahun").val()
        },
        success: function (data) {
            console.log(data);
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

    getPegawai();
    function getPegawai() {
        $("#id_pegawai").html("");
        $.ajax({
            url: "<?=base_url()?>kinerja/perilaku/get_pegawai/",
            type: 'post',
            dataType: 'json',
            data: {
                
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


</script>