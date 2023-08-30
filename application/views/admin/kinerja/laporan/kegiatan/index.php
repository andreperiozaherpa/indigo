<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Kegiatan</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>Laporan</li>
                <li class="active">Kegiatan</li>
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
                            <select class="form-control select2" id="id_skpd" onchange="getProgram()">
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
                            <label>Program / Sasaran</label>
                            <select class="form-control select2" id="id_program_renstra" onchange="getIndikatorProgram()"></select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Indikator Program</label>
                            <select class="form-control select2" id="id_indikator_program_renstra" onchange="loadPagination(1)"></select>
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

                    <div class="col-md-2">
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

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Pencarian </label>
                            <input type="text" onkeyup="loadPagination(1)" placeholder="Cari Kegiatan" class="form-control" name="search" id="search" />
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0" id="title">LAPORAN KEGIATAN</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark" id="sub_title"></p>
                        <div class="table-responsive">
                            <button class="btn btn-default btn-outline pull-right" onclick="download()"><i class="fa fa-download"></i> Download</button>
                            <table style="margin-top:50px" class="table table-striped_">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sasaran</th>
                                        <th>Program / Indikator</th>
                                        <th>Kegiatan</th>
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
    var id_program_renstra = "<?= ($this->input->get("id_program_renstra")) ? $this->input->get("id_program_renstra")  : "" ;?>";
    var id_indikator_program_renstra = "<?= ($this->input->get("id_indikator_program_renstra")) ? $this->input->get("id_indikator_program_renstra")  : "" ;?>";
    
    var page = 1;
    
    function loadPagination(p) {
        page = p;
        var nama_skpd = $('#id_skpd option:selected').text();
        $("#sub_title").html(nama_skpd);

        if(!isloading)
        {
            isloading = false;
            $.ajax({
                url: "<?=base_url()?>kinerja/laporan/kegiatan/get_list/" + page,
                type: 'post',
                dataType: 'json',
                data: {
                    tahun: $("#tahun").val(),
                    id_skpd: $("#id_skpd").val(),
                    bulan: $("#bulan").val(),
                    search: $("#search").val(),
                    id_program_renstra: $("#id_program_renstra").val(),
                    id_indikator_program_renstra: $("#id_indikator_program_renstra").val()
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

    getProgram();

    function getProgram()
    {
      $("#id_program_renstra").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renstra/program/get_program/",
         type: 'post',
         dataType: 'json',
         data: {
            id_skpd : $("#id_skpd").val(),
            id_program_renstra : id_program_renstra,
         },
         success: function (data) {
            $("#id_program_renstra").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }


    function getIndikatorProgram()
    {
      $("#id_indikator_program_renstra").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renstra/program_indikator/get_indikator_by_program/",
         type: 'post',
         dataType: 'json',
         data: {
            id_program_renstra : $("#id_program_renstra").val(),
            id_skpd : $("#id_skpd").val(),
            id_indikator_program_renstra : id_indikator_program_renstra,
         },
         success: function (data) {
            $("#id_indikator_program_renstra").html(data.content).trigger("change");
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
        var nama_skpd = $('#id_skpd option:selected').text();

        var link = "<?=base_url();?>kinerja/laporan/kegiatan/download?tahun=" + tahun + "&bulan=" + bulan  + "&nama_skpd="+nama_skpd+'&id_skpd='+id_skpd;
        window.open(link,"_blank");
    }
</script>