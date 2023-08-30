<div id="main-content" class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Perencanaan</h4>
        </div>

        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-md-12">
            <form id="form-data" class="form-horizontal" onSubmit="return false;">
                <div class="white-box">

                    <div class="panel panel-default">
                        <div class="panel-heading">Edit Kegiatan</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">

                                <div class="form-group">
                                    <label class="col-md-12">Tahun Periode</label>
                                    <div class="col-md-12">
                                        <select class="form-control select2" id="tahun" name="tahun">
                                            <option value="">Pilih</option>
                                            <?php 
                                                foreach($dt_tahun as $key=>$value){
                                                    $selected = ($detail->tahun == $value) ? "selected" : "";
                                                    echo '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <div class="text-danger error" id="err_tahun"></div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-12">Program</label>
                                    <div class="col-md-12">
                                        <select class="form-control select2" id="id_ref_program" name="id_ref_program"
                                            onchange="getKegiatan()">
                                            <option value="">Pilih</option>
                                            <?php 
                                                foreach($dt_program as $row){
                                                    $selected = ($detail->id_ref_program == $row->id_ref_program) ? "selected" : "";
                                                    echo '<option '.$selected.' value="'.$row->id_ref_program.'">'.$row->kode_program.' '.$row->nama_program.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <div class="text-danger error" id="err_id_ref_program"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Kegiatan</label>
                                    <div class="col-md-12">
                                        <select class="form-control select2" id="id_ref_kegiatan" name="id_ref_kegiatan"
                                            onchange="getSubKegiatan()">
                                            <option value="">Pilih</option>
                                            <?php 
                                                foreach($dt_kegiatan as $row){
                                                    $selected = ($detail->id_ref_kegiatan == $row->id_ref_kegiatan) ? "selected" : "";
                                                    echo '<option '.$selected.' value="'.$row->id_ref_kegiatan.'">'.$row->kode_kegiatan.' '.$row->nama_kegiatan.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <div class="text-danger error" id="err_id_ref_kegiatan"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Sub-Kegiatan</label>
                                    <div class="col-md-12">
                                        <select class="form-control select2" id="id_ref_sub_kegiatan"
                                            name="id_ref_sub_kegiatan">
                                            <option value="">Pilih</option>
                                            <?php 
                                                foreach($dt_sub_kegiatan as $row){
                                                    $selected = ($detail->id_ref_sub_kegiatan == $row->id_sub_kegiatan) ? "selected" : "";
                                                    echo '<option '.$selected.' value="'.$row->id_sub_kegiatan.'">'.$row->kode_sub_kegiatan.' '.$row->nama_sub_kegiatan.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <div class="text-danger error" id="err_id_ref_sub_kegiatan"></div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-12">Output Sub-Kegiatan</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="" id="output_kegiatan"
                                            name="output_kegiatan" value="<?=$detail->output_kegiatan;?>">
                                        <div class="text-danger error" id="err_output_kegiatan"></div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">Target</label>
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" placeholder="" id="target"
                                                    name="target" value="<?=$detail->target;?>">
                                                <div class="text-danger error" id="err_target"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">Satuan</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" placeholder="" id="satuan"
                                                    name="satuan" value="<?=$detail->satuan;?>">
                                                <div class="text-danger error" id="err_satuan"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12">Sumber Anggaran</label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2" id="id_sumber_anggaran" name="id_sumber_anggaran">
                                            <option value="">Pilih</option>
                                            <?php 
                                                foreach($dt_sumber_anggaran as $row){
                                                    $selected = ($detail->id_sumber_anggaran == $row->id_sumber_anggaran) ? "selected" : "";
                                                    echo '<option '.$selected.' value="'.$row->id_sumber_anggaran.'">'.$row->nama_sumber_anggaran.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <div class="text-danger error" id="err_id_sumber_anggaran"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Total Anggaran</label>
                                    <div class="col-md-12">
                                        <input type="text" onkeyup="currency(this)" class="form-control" placeholder="" id="rencana_anggaran"
                                            name="rencana_anggaran" value="<?=number_format($detail->rencana_anggaran);?>">
                                        <div class="text-danger error" id="err_rencana_anggaran"></div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-12">Kelompok sasaran</label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2" id="sasaran" name="sasaran">
                                            <option value="">Pilih</option>
                                            <?php 
                                                foreach($dt_rts as $key => $row){
                                                    $selected = ($detail->sasaran == $row) ? "selected" : "";
                                                    echo '<option '.$selected.' value="'.$row.'">'.$row.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <div class="text-danger error" id="err_sasaran"></div>
                                    </div>
                                </div>




                            </div>

                        </div>
                    </div>

                </div>

                <div class="white-box">
                    <div class="panel panel-default">
                        <div class="panel-heading">Pengalokasian Anggaran</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Kegiatan</th>
                                            <th>Jumlah</th>
                                            <th>Harga Satuan</th>
                                            <th>Satuan</th>
                                            <th>Total</th>
                                            <th width="50px"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="row_alokasi_anggaran">
                                        <?php foreach($dt_alokasi_anggaran as $key => $row)
                                        {
                                            $action = '<button onclick="hapus_alokasi_anggaran('.$key.')" class="btn btn-secondary"><i class="fa fa-trash"></i></button>';
                                            echo '
                                            <tr id="alokasi_anggaran_'.$key.'">
                                                <td><input value="'.$row->nama_kegiatan.'" id="nama_kegiatan_'.$key.'" name="alokasi_anggaran[nama_kegiatan][]" type="text" class="form-control" placeholder=""></td>
                                                <td><input value="'.$row->jumlah.'" onkeyup="kalkulasi('.$key.')" id="jumlah_'.$key.'" name="alokasi_anggaran[jumlah][]" type="number" class="form-control" placeholder=""></td>
                                                <td><input value="'.number_format($row->harga).'" onkeyup="kalkulasi('.$key.')" id="harga_'.$key.'" name="alokasi_anggaran[harga][]" type="text" class="form-control" placeholder=""></td>
                                                <td><input value="'.$row->satuan.'" id="satuan_'.$key.'" name="alokasi_anggaran[satuan][]" type="text" class="form-control" placeholder=""></td>
                                                <td><input value="'.$row->total.'" id="total_'.$key.'" type="text" class="form-control" placeholder="" readonly></td>
                                                <td>
                                                '.$action.'
                                                <input value="'.$row->id_alokasi_anggaran.'" id="id_alokasi_anggaran_'.$key.'" name="alokasi_anggaran[id_alokasi_anggaran][]" type="hidden">
                                                </td>
                                            </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <a href="javascript:void(0)" class="btn btn-primary" onclick="tambah_alokasi_anggaran()"><i class="fa fa-plus"></i> Tambah Data</a>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="dtks">
                    <div class="col-md-6">
                        <div class="white-box">
                           
                            <div class="row ">
                                <h3>DTKS</h3>
                                
                                <div class="col-md-6" style="padding:0px;margin-bottom:10px">
                                    <select class="form-control select2" id="kdkec_dtks" onchange="get_desa('dtks')">
                                        <option value="">Semua Kecamatan</option>
                                        <?php 
                                            foreach($dt_kecamatan as $row){
                                                echo '<option value="'.$row->id_kecamatan.'">'.$row->kecamatan.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6" style="padding:0px 0px 0px 10px;margin-bottom:10px;">
                                    <select class="form-control select2" id="kddesa_dtks" onchange="loadPagination(1)">
                                        <option value="">Semua Desa</option>
                                    </select>
                                </div>

                                <input id="search_dtks" onkeyup="loadPagination(1)" type="text" class="form-control" placeholder="Cari nama atau NIK"/>
                                
                                <div class="col-md-12" style="margin-top:10px">
                                    <div id="range_usia_1"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12" style="margin-top:10px">
                                                <button onclick="set_rts_dtks('')" class="btn btn-default btn-xs btn-rounded btn-outline">Semua</button>
                                                <?php foreach($dt_rts as $key => $value)
                                                {
                                                    echo '<button onclick="set_rts_dtks(\''.$value.'\')" class="btn btn-default btn-xs btn-rounded btn-outline">'.$value.'</button>&nbsp;';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                        <?php foreach($dt_sasaran as $key=>$val):?>
                                        <div class="col-md-2" style="margin-top:0px">
                                            <div class="form-group">
                                                <div class="checkbox checkbox-primary">
                                                    <input onclick="loadPagination(1)" id="dtks_jenis_bantuan_<?=$val;?>" name="dtks_jenis_bantuan[]" type="checkbox">
                                                    <label for="dtks_jenis_bantuan_<?=$val;?>"> <?=$val;?> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach?>
                                    </div>
                                    </div>
                                </div>
                                
                                
                                <hr>

                            </div>
                            <div class="row" id="row-dtks" style="margin-top:10px; overflow: auto; max-height:300px">
                            
                            </div>
                            <div class="row">
                                <hr>
                                <div class="col-12 text-center">
                                    <nav class="mt-4 mb-3">
                                        <ul class="pagination justify-content-center mb-0" id="pagination">
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box">
                            <div class="row ">
                                <h3>Draft Penerima (<span id="total_penerima">0</span> Orang)</h3>
                                
                                <div class="col-md-6" style="padding:0px;margin-bottom:10px">
                                    <select class="form-control select2" id="kdkec_penerima" onchange="get_desa('penerima')">
                                        <option value="">Semua Kecamatan</option>
                                        <?php 
                                            foreach($dt_kecamatan as $row){
                                                echo '<option value="'.$row->id_kecamatan.'">'.$row->kecamatan.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6" style="padding:0px 0px 0px 10px;margin-bottom:10px;">
                                    <select class="form-control select2" id="kddesa_penerima" onchange="loadPagination2(1)">
                                        <option value="">Semua Desa</option>
                                    </select>
                                </div>
                                <input id="search_penerima" onkeyup="loadPagination2(1)" type="text" class="form-control" placeholder="Cari nama atau NIK"/>
                                
                                <div class="col-md-12" style="margin-top:10px">
                                    <div id="range_usia_2"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div style="margin-top:10px">
                                                <button onclick="set_rts_penerima('')" class="btn btn-default btn-xs btn-rounded btn-outline">Semua</button>
                                                <?php foreach($dt_rts as $key => $value)
                                                {
                                                    echo '<button onclick="set_rts_penerima(\''.$value.'\')" class="btn btn-default btn-xs btn-rounded btn-outline">'.$value.'</button>&nbsp;';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <?php foreach($dt_sasaran as $key=>$val):?>
                                            <div class="col-md-2" style="margin-top:10px">
                                                <div class="form-group">
                                                    <div class="checkbox checkbox-primary">
                                                        <input onclick="loadPagination2(1)" id="penerima_jenis_bantuan_<?=$val;?>" name="penerima_jenis_bantuan[]" type="checkbox">
                                                        <label for="penerima_jenis_bantuan_<?=$val;?>"> <?=$val;?> </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach?>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>

                            </div>
                            <div class="row" id="row-penerima" style="margin-top:10px; overflow: auto; max-height:300px">
                            
                            </div>
                            <div class="row">
                                <hr>
                                <div class="col-12 text-center">
                                    <nav class="mt-4 mb-3">
                                        <ul class="pagination justify-content-center mb-0" id="pagination2">
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                

            </form>

            <div class="white-box_">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-lg" style="width: 150px;" onclick="save()"><i class="fa fa-save"></i> Simpan</button>
                        <a href="<?=base_url();?>sigesit/kegiatan/detail/<?=$token;?>"><button class="btn btn-default btn-lg">Kembali</button></a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="detailPenerima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Detail Penerima</h4>
            </div>
            <div class="modal-body">
                <div id="row_detail_penerima">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>

<script>
    var i = '<?= ($dt_alokasi_anggaran) ? count($dt_alokasi_anggaran) : 0 ;?>';

    function save()
    {
      reset_error();
      var formdata = new FormData(document.getElementById('form-data'));
      formdata.append("action","edit");
      formdata.append("id_skpd","<?=$detail->id_skpd;?>");
      formdata.append("id_kegiatan","<?=$detail->id_kegiatan;?>");

      $.ajax({
         url        : "<?=base_url()?>sigesit/kegiatan/save",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){
            console.log(data);
            if(data.status){
               swal('Berhasil',data.message,'success');
               setTimeout(() => {
                   window.location = "<?=base_url();?>sigesit/kegiatan/detail/<?=$token;?>";
               }, 1000);
            }
            else{
               for(err in data.errors)
               {
                  $("#err_"+err).html(data.errors[err]);
               }
               if(data.errors.length==0){
                  swal('Opps',data.message,'warning');
               }
            }
         },
         error: function(xhr, status, error) {
            console.log(xhr);
         }
      });
    }

    function reset_error()
    {
      $(".error").html("");
    }

    function getKegiatan()
    {
        $("#id_ref_kegiatan").val("").trigger("change");
        $.ajax({
            url: "<?=base_url()?>sigesit/kegiatan/get_kegiatan",
            type: 'post',
            dataType: 'json',
            data: {
                id: $("#id_ref_program").val(),
            },
            success: function (data) {
                //console.log(data);
                $("#id_ref_kegiatan").html(data.content);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }
    function getSubKegiatan()
    {
        $("#id_ref_sub_kegiatan").val("").trigger("change");
        $.ajax({
            url: "<?=base_url()?>sigesit/kegiatan/get_sub_kegiatan",
            type: 'post',
            dataType: 'json',
            data: {
                id: $("#id_ref_kegiatan").val(),
            },
            success: function (data) {
                //console.log(data);
                $("#id_ref_sub_kegiatan").html(data.content);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }
    function tambah_alokasi_anggaran()
    {

        var action = '<button onclick="hapus_alokasi_anggaran('+i+')" class="btn btn-secondary"><i class="fa fa-trash"></i></button>';
        
        
        var row = '<tr id="alokasi_anggaran_'+i+'">'
            +'<td><input id="nama_kegiatan_'+i+'" name="alokasi_anggaran[nama_kegiatan][]" type="text" class="form-control" placeholder=""></td>'
            +'<td><input onkeyup="kalkulasi('+i+')" id="jumlah_'+i+'" name="alokasi_anggaran[jumlah][]" type="number" class="form-control" placeholder=""></td>'
            +'<td><input onkeyup="kalkulasi('+i+')" id="harga_'+i+'" name="alokasi_anggaran[harga][]" type="text" class="form-control" placeholder=""></td>'
            +'<td><input id="satuan_'+i+'" name="alokasi_anggaran[satuan][]" type="text" class="form-control" placeholder=""></td>'
            +'<td><input id="total_'+i+'" type="text" class="form-control" placeholder="" readonly></td>'
            +'<td>'
            +action
            +'<input id="total_'+i+'" name="alokasi_anggaran[id_alokasi_anggaran][]" value="0" type="hidden">'
            +'</td>'
            +'</tr>';

        $("#row_alokasi_anggaran").append(row);

        i++;

    }

    function hapus_alokasi_anggaran(x)
    {
        $("#alokasi_anggaran_"+x).remove();
    }


    function kalkulasi(n)
    {
        var jumlah = $("#jumlah_"+n).val();
        var harga = $("#harga_"+n).val().replaceAll(",","");
        var total = 0;
        if(jumlah>0 && harga>0)
        {
            total = parseFloat(jumlah * harga);
        }

        if(harga>0)
        {
            harga = parseFloat(harga).toLocaleString("en-US");
        }

        $("#harga_"+n).val(harga);
        $("#total_"+n).val(total.toLocaleString("en-US"));
    }
    


    
    var page_dtks = 1;
    var rts_dtks = '';

    var page_penerima = 1;
    var rts_penerima = '';

    var dt_sasaran = JSON.parse('<?= json_encode($dt_sasaran) ;?>');

    function loadPagination(page_num) {
        $("#row-dtks").html("<p class='text-center'>Mohon tunggu ..</p>");
        $("#pagination").html("");
        page_dtks = page_num;
        var usia = $("#range_usia_1").data();

        var param = {
            search: $("#search_dtks").val(),
                kdkec : $("#kdkec_dtks").val(),
                kddesa : $("#kddesa_dtks").val(),
                rts : rts_dtks,
                usia_1 : usia.from,
                usia_2 : usia.to,
        };

        for(i in dt_sasaran)
        {
            param[dt_sasaran[i]] = ($("#dtks_jenis_bantuan_"+dt_sasaran[i]).prop("checked")==true) ? 1 : 0;
        }

        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/get_dtks/" + page_num,
            type: 'post',
            dataType: 'json',
            data: param,
            success: function (data) {
                $("#row-dtks").html(data.content);
                $("#pagination").html(data.pagination);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function loadPagination2(page_num) {
        $("#row-penerima").html("<p class='text-center'>Mohon tunggu ..</p>");
        $("#pagination2").html("");
        $("#total_penerima").html("");
        page_penerima = page_num;
        var usia2 = $("#range_usia_2").data();

        var param = {
            search: $("#search_penerima").val(),
                kdkec : $("#kdkec_penerima").val(),
                kddesa : $("#kddesa_penerima").val(),
                rts : rts_penerima,
                usia_1 : usia2.from,
                usia_2 : usia2.to,
        };

        for(i in dt_sasaran)
        {
            param[dt_sasaran[i]] = ($("#penerima_jenis_bantuan_"+dt_sasaran[i]).prop("checked")==true) ? 1 : 0;
        }

        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/get_penerima/" + page_num,
            type: 'post',
            dataType: 'json',
            data: param,
            success: function (data) {
                $("#row-penerima").html(data.content);
                $("#pagination2").html(data.pagination);
                $("#total_penerima").html(data.total_rows);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function get_desa(flag)
    {
        $("#kddesa_"+flag).val("").trigger("change");
        $.ajax({
            url: "<?=base_url()?>sigesit/kegiatan/get_desa",
            type: 'post',
            dataType: 'json',
            data: {
                id: $("#kdkec_"+flag).val(),
            },
            success: function (data) {
                //console.log(data);
                $("#kddesa_"+flag).html(data.content);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function set_rts_dtks(rts)
    {
        rts_dtks = rts;
        loadPagination(1);
    }

    function set_rts_penerima(rts)
    {
        rts_penerima = rts;
        loadPagination2(1);
    }

    function tambah_penerima(id_dtks)
    {
        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/tambah_penerima",
            type: 'post',
            dataType: 'json',
            data: {
                id_dtks: id_dtks,
            },
            success: function (data) {
                if(data.status==true)
                {
                    loadPagination2(1);
                    loadPagination(1);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }
    function hapus_penerima(id)
    {
        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/hapus_penerima",
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
            },
            success: function (data) {
                if(data.status==true)
                {
                    loadPagination2(1);
                    loadPagination(1);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function detail_penerima(id_dtks)
    {
        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/detail_penerima",
            type: 'post',
            dataType: 'json',
            data: {
                id_dtks: id_dtks,
            },
            success: function (data) {
                if(data.status==true)
                {
                    $("#row_detail_penerima").html(data.content);
                    $("#detailPenerima").modal();
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
        
    }
</script>