<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Matrik</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li class="active">Matrik</li>
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
                            <select class="form-control select2" id="id_skpd" onchange="getPegawai()">
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
                            <label>Pegawai </label>
                            <select class="form-control select2" id="id_pegawai" onchange="loadData()">
                            <option value="">Pilih</option>
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
                        <h3 class="text-center box-title m-b-0" id="title">Matrik Pembagian Peran Hasil</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark" id="sub_title"></p>
                        <div class="table-responsive">
                            
                            <div id="row-data">
                            
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>


<script type="text/javascript">
    loadData();
    function loadData() {
        
        var nama_skpd = $('#id_skpd option:selected').text();
        var tahun = $('#tahun option:selected').text();

        $("#sub_title").html(nama_skpd);

        $.ajax({
            url: "<?=base_url()?>kinerja/matrik/get_data/" ,
            type: 'post',
            dataType: 'json',
            data: {
                id_skpd: $("#id_skpd").val(),
                id_pegawai: $("#id_pegawai").val(),
                tahun: $("#tahun").val()
            },
            success: function (data) {
                console.log(data);
                $("#row-data").html(data.content);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                //swal("Opps", "Terjadi kesalahan", "error");
            }
        });
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
 
    function download() {
        var id_skpd = $("#id_skpd").val();
        var id_pegawai = $("#id_pegawai").val();
        var tahun = $("#tahun").val();
        var link = '<?= base_url();?>kinerja/matrik/download?tahun='+tahun+'&id_pegawai='+id_pegawai;

        window.open(link,"_blank");
    }
</script>