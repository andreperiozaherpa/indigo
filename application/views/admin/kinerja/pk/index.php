<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Perjanjian Kerja</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li class="active">Perjanjian Kerja</li>
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
                            <label>Nama SKPD </label>
                            <select class="form-control select2" id="id_skpd" onchange="loadPagination(1)">
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
                            <label>Tahun PK </label>
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
                        <h3 class="text-center box-title m-b-0" id="title"></h3>
                        <p class="text-center text-dark" id="sub_title"></p>
                        <div class="table-responsive">
                            <button class="btn btn-primary pull-right" onclick="download()"><i class="fa fa-download"></i> Download</button>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5px">No</th>
                                        <th>Sasaran Kinerja</th>
                                        <th>Indikator Kinerja</th>
                                        <th>Target</th>
                                        <th>Satuan</th>
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
    var action = "";
    var page=1;
    
    function loadPagination(page_num) {
        
        page = page_num;
        var nama_skpd = $('#id_skpd option:selected').text();
        var tahun = $('#tahun option:selected').text();

        $("#title").html("PERJANJIAN KINERJA TAHUN " + tahun);
        $("#sub_title").html(nama_skpd);

        $.ajax({
        url: "<?=base_url()?>kinerja/pk/get_list/" + page_num,
        type: 'post',
        dataType: 'json',
        data: {
            id_skpd : $("#id_skpd").val(),
            tahun   : $("#tahun").val()
        },
        success: function (data) {
            $("#row-data").html(data.content);
            $("#pagination").html(data.pagination);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
        }
        });
    }
   
    function download() {
        var id_skpd = $("#id_skpd").val();
        var tahun   = $("#tahun").val();
        var label_tahun = $('#tahun option:selected').text();

        var url = '<?=base_url();?>kinerja/pk/download?id_skpd='+id_skpd+'&tahun='+tahun+'&label_tahun='+label_tahun;
        window.open(url,"_blank");
    }
</script>