<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Renja</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Sicerdas</li>
                <li>Renja</li>
                <li class="active">Laporan</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Nama SKPD </label>
                            <select class="form-control select2" id="id_skpd" onchange="loadData()">
                                <?php foreach($dt_skpd->result() as $row)
                                {
                                    echo '<option value="'.$row->id_skpd.'">'.$row->nama_skpd.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Urusan </label>
                            <select class="form-control select2" id="id_urusan" onchange="loadData()">
                                <?php foreach($dt_urusan as $row)
                                {
                                    echo '<option value="'.$row->id_urusan.'">'.$row->kode_urusan.' - '.$row->nama_urusan.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tahun </label>
                            <select class="form-control select2" id="tahun" onchange="loadData()">
                                <?php foreach($this->Globalvar->get_tahun() as $key=>$value)
                                {
                                    $i = $key + 1;
                                    $selected = (date("Y")==$value) ? "selected" : "" ;
                                    echo '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
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
                        <button class="btn btn-primary btn-outline pull-right" onclick="download()"><i class="fa fa-download"></i> Download</button>
                        <div id="row-data">
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>


<script type="text/javascript">
    
    var loading = false;
    loadData();
    function loadData() {
        if(loading==false)
        {
            loading = true;
            var nama_skpd = $('#id_skpd option:selected').text();
            var tahun = $('#tahun option:selected').text();
    
            $("#sub_title").html(nama_skpd);
    
            $.ajax({
                url: "<?=base_url()?>sicerdas/renja/report/get_data/" ,
                type: 'post',
                dataType: 'json',
                data: {
                    id_skpd: $("#id_skpd").val(),
                    id_urusan: $("#id_urusan").val(),
                    tahun: $("#tahun").val()
                },
                success: function (data) {
                    loading = false ;
                    //console.log(data);
                    $("#row-data").html(data.content);

                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    //swal("Opps", "Terjadi kesalahan", "error");
                }
            });

        }
    }
   
 
    function download() {
        var id_skpd = $("#id_skpd").val();
        var id_urusan = $("#id_urusan").val();
        var tahun = $("#tahun").val();
        var link = '<?= base_url();?>sicerdas/renja/report/download?id_skpd='+id_skpd+'&id_urusan='+id_urusan+"&tahun="+tahun;

        window.open(link,"_blank");
    }
</script>