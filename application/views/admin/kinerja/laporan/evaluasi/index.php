<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Hasil Evaluasi Kinerja Pegawai</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>Laporan</li>
                <li class="active">Hasil Evaluasi Kinerja Pegawai</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        
        <div class="col-md-7">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Filter</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama SKPD </label>
                            <select class="form-control select2" id="id_skpd" onchange="getUnitKerja()">
                                <?php foreach($dt_skpd->result() as $row)
                                {
                                    $selected = ($this->input->get("id_skpd")==$row->id_skpd) ? "selected" : "";
                                    echo '<option '.$selected.' value="'.$row->id_skpd.'">'.$row->nama_skpd.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Unit Kerja </label>
                            <select class="form-control select2" id="id_unit_kerja" onchange="getPegawai()" >
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pegawai </label>
                            <select class="form-control select2" id="id_pegawai" onchange="loadPagination(1)" >
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control select2_" id="tahun" onchange="loadPagination(1)">
                                <?php 
                                foreach($this->Globalvar->get_tahun() as $key=>$value)
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

                    <div class="col-md-1">
                        <div class="form-group">
                            <label>Triwulan</label>
                            <select class="form-control select2_" id="triwulan" onchange="loadPagination(1)">
                                <option value="">-</option>
                                <?php 
                                for($i=1;$i<=4;$i++)
                                {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pencarian </label>
                            <input type="text" onkeyup="loadPagination(1)" placeholder="Cari Nama atau NIP" class="form-control" name="search" id="search" />
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-5 col-lg-5 col-xs-12">
            <div class="white-box" style="height:275px" id="curva">

                

                
            </div>
        </div>

        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0" id="title">HASIL EVALUASI KINERJA PEGAWAI</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark" id="sub_title"></p>
                        <div class="table-responsive">
                            <table style="margin-top:50px" class="table table-striped_">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama </th>
                                        <th>Jabatan</th>
                                        <th>Unit Kerja</th>
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

    var id_skpd = "<?= ($this->input->get("id_skpd")) ? $this->input->get("id_skpd")  : "" ;?>";
    var id_unit_kerja = "<?= ($this->input->get("id_unit_kerja")) ? $this->input->get("id_unit_kerja")  : "" ;?>";
    
    function loadPagination(p) {
        page = p;
        var nama_skpd = $('#id_skpd option:selected').text();
        $("#sub_title").html(nama_skpd);

        if(!isloading)
        {
            isloading = false;
            $.ajax({
                url: "<?=base_url()?>kinerja/laporan/evaluasi/get_list/" + page,
                type: 'post',
                dataType: 'json',
                data: {
                    tahun: $("#tahun").val(),
                    triwulan: $("#triwulan").val(),
                    id_skpd: $("#id_skpd").val(),
                    id_unit_kerja: $("#id_unit_kerja").val(),
                    id_pegawai: $("#id_pegawai").val(),
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

    getUnitKerja();

    function getUnitKerja()
    {
      $("#id_unit_kerja").html("");
      $.ajax({
         url: "<?=base_url()?>kinerja/laporan/evaluasi/get_unit_kerja/",
         type: 'post',
         dataType: 'json',
         data: {
            id_skpd : $("#id_skpd").val(),
            id_unit_kerja : id_unit_kerja,
         },
         success: function (data) {
            $("#id_unit_kerja").html(data.content).trigger("change");
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    function getPegawai()
    {
      $("#id_pegawai").html("");
      $.ajax({
         url: "<?=base_url()?>kinerja/laporan/evaluasi/get_pegawai/",
         type: 'post',
         dataType: 'json',
         data: {
            id_unit_kerja : $("#id_unit_kerja").val()
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

    setTimeout(() => {
        getCurva();
    }, 1000);


    function getCurva()
    {
      $("#curva").html("");
      $.ajax({
         url: "<?=base_url()?>kinerja/laporan/evaluasi/get_curva/",
         type: 'post',
         dataType: 'json',
         data: {
            tahun: $("#tahun").val(),
            triwulan: $("#triwulan").val(),
            id_skpd: $("#id_skpd").val(),
         },
         success: function (data) {
            $("#curva").html(data.content);
            
            $("#curva-chart").sparkline(data.chart, {
            type: 'line',
            width: '100%',
            height: '80',
            lineColor: '#13dafe',
            fillColor: '#b5f3ff',
            minSpotColor:'#13dafe',
            maxSpotColor: '#13dafe',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#13dafe',
            lineWidth : 2,
            spotRadius : 3
        }); 
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

/*     function download()
    {
        var tahun = $("#tahun").val();
        var bulan = $("#bulan").val();
        var id_skpd = $("#id_skpd").val();
        var id_unit_kerja = $("#id_unit_kerja").val();
        var nama_skpd = $('#id_skpd option:selected').text();

        var link = "<?=base_url();?>kinerja/laporan/evaluasi/download?tahun=" + tahun + "&bulan=" + bulan  + "&nama_skpd="+nama_skpd+'&id_skpd='+id_skpd+'&id_unit_kerja='+id_unit_kerja;
        window.open(link,"_blank");
    } */
</script>