<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Kuadran 9 Box</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li class="active">Kuadran 9 Box</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        
        <div class="col-md-6">
            <div class="white-box">
                <div class="row">
                <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Filter</h3>
                            </div>
                            <div class="col-md-12">
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
                                    <select class="form-control select2" id="id_unit_kerja" onchange="getData()">
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select class="form-control select2" id="tahun" onchange="getData()">
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Triwulan</label>
                                    <select class="form-control select2" id="triwulan" onchange="getData()">
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
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12" id="kuadran">

                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>


    </div>

    

</div>



<div id="modal-detail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal-title">Detail BOX</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr >
                            <th style="text-align:center" rowspan="2">No</th>
                            <th style="text-align:center" rowspan="2">NIP</th>
                            <th style="text-align:center" rowspan="2">Nama Pegawai</th>
                            <th style="text-align:center" rowspan="2">Jabatan</th>
                            <th style="text-align:center" colspan="2">Capaian</th>
                        </tr>
                        <tr>
                            <th style="text-align:center">Kinerja</th>
                            <th style="text-align:center">Perilaku</th>
                        </tr>
                    </thead>
                    <tbody id="row-detail">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var id_skpd = "<?= ($this->input->get("id_skpd")) ? $this->input->get("id_skpd")  : "" ;?>";
    var id_unit_kerja = "<?= ($this->input->get("id_unit_kerja")) ? $this->input->get("id_unit_kerja")  : "" ;?>";

    var detail = [];

    getUnitKerja();

    function getUnitKerja()
    {
      $("#id_unit_kerja").html("");
      $.ajax({
         url: "<?=base_url()?>kinerja/kuadran/get_unit_kerja/",
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

    function getData()
    {
        $.ajax({
         url: "<?=base_url()?>kinerja/kuadran/get_data/",
         type: 'post',
         dataType: 'json',
         data: {
            id_skpd : $("#id_skpd").val(),
            id_unit_kerja : $("#id_unit_kerja").val(),
            tahun : $("#tahun").val(),
            triwulan : $("#triwulan").val(),
         },
         success: function (data) {
             console.log(data);
             if(data.detail)
             {
                 detail = data.detail;
             }
            $("#kuadran").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }    

    function show_detail(i)
    {

        var rows = detail[i];

        var content = '';

        for(n in rows)
        {
            console.log(rows[n]);
            content += '<tr>'
                    + '<td>'+(parseInt(n)+1)+'</td>'
                    + '<td>'+rows[n].nip+'</td>'
                    + '<td>'+rows[n].nama_lengkap+'</td>'
                    + '<td>'+rows[n].jabatan+'</td>'
                    + '<td>'+rows[n].kinerja_desc+'</td>'
                    + '<td>'+rows[n].perilaku_desc+'</td>'
                    + '</tr>'
            ;
        }

        if(content == "")
        {
            content = '<tr><td colspan="6" align="center">Tidak ada data</td></tr>';
        }

        $("#row-detail").html(content);

        $(".modal-title").html("DETAIL BOX ");
        $("#modal-detail").modal("show");
    }
</script>