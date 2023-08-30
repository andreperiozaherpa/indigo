<div id="main-content" class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Perencanaan</h4>
        </div>

        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-md-12">

            <div class="white-box">

                <div class="panel panel-default">
                    <div class="panel-heading">Detail Perencanaan</div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="row">

                                    <div class="col-md-12" style="">

                                        <div class="form-group">
                                            <label class="col-md-12">Tahun Periode</label>
                                            <div class="col-md-12">
                                                <span><?=$detail->tahun;?></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Program</label>
                                            <div class="col-md-12">

                                                <span><?= $detail->kode_program.' '.$detail->nama_program;?></span>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Kegiatan</label>
                                            <div class="col-md-12">
                                                <span><?= $detail->kode_kegiatan.' '.$detail->nama_kegiatan;?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Sub-Kegiatan</label>
                                            <div class="col-md-12">
                                                <span><?= $detail->kode_sub_kegiatan.' '.$detail->nama_sub_kegiatan;?></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Output Sub-Kegiatan</label>
                                            <div class="col-md-12">
                                                <span><?=$detail->output_kegiatan;?></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12" style="">


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12">Target</label>
                                                    <div class="col-md-12">
                                                        <span><?=$detail->target;?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12">Satuan</label>
                                                    <div class="col-md-12">
                                                        <span><?=$detail->satuan;?></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12">Sumber Anggaran</label>
                                            <div class="col-sm-12">

                                                <span><?=$detail->nama_sumber_anggaran;?></span>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Total Anggaran</label>
                                            <div class="col-md-12">
                                                <span>Rp. <?=number_format($detail->rencana_anggaran);?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Kelompok Sasaran</label>
                                            <div class="col-md-12">
                                                <span><?=$detail->sasaran;?></span>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </form>



                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">


            <div class="white-box" style="padding:40px">
                <!-- .left-right-aside-column-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Penganggaran</div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">

                                    <table class="table">
                                        <thead>
                                            <tr>

                                                <th>RKPD</th>
                                                <th>APBD</th>
                                                <th width="300px">Edit Data APBD</th>
                                            </tr>
                                        </thead>
                                        <tbody id="row-data">
                                            <tr>

                                                <td><?= number_format($detail->rencana_anggaran) ;?></td>
                                                <td><?= ($detail->anggaran) ? number_format($detail->anggaran) : '-' ;?>
                                                </td>
                                                <td> <a href="#" data-toggle="modal" data-target="#updateAnggaran"
                                                        data-whatever="@mdo"><button
                                                            class="btn btn-outline btn-success">
                                                            Edit Data</button></a></td>
                                            </tr>
                                        </tbody>
                                    </table>



                                    <form id="form-anggaran">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nama Aktivitas</th>
                                                    <th>Output</th>
                                                    <th>Kelompok sasaran</th>
                                                    <th>Sumber Anggaran</th>
                                                    <th>Target</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Satuan</th>
                                                    <th>Total</th>
                                                    <th width="50px"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="row_anggaran">
                                                <?php foreach($dt_anggaran_detail as $key => $row)
                                                {
                                                    $action = '<button onclick="hapus_anggaran('.$key.')" class="btn btn-secondary"><i class="fa fa-trash"></i></button>';

                                                    $id_anggaran_detail = !empty($row->id_anggaran_detail) ? $row->id_anggaran_detail : 0;

                                                    echo '
                                                    <tr id="anggaran_'.$key.'">
                                                        <td><input value="'.$row->nama_kegiatan.'" id="nama_kegiatan_'.$key.'" name="anggaran[nama_kegiatan][]" type="text" class="form-control" placeholder=""></td>
                                                        <td><input type="text" class="form-control" disabled value="'.$detail->output_kegiatan.'" /></td>
                                                        <td><input type="text" class="form-control" disabled value="'.$detail->sasaran.'" /></td>
                                                        <td><input type="text" class="form-control" disabled value="'.$detail->nama_sumber_anggaran.'" /></td>
                                                        <td><input value="'.$row->jumlah.'" onkeyup="kalkulasi('.$key.')" id="jumlah_'.$key.'" name="anggaran[jumlah][]" type="number" class="form-control" placeholder=""></td>
                                                        <td><input value="'.number_format($row->harga).'" onkeyup="kalkulasi('.$key.')" id="harga_'.$key.'" name="anggaran[harga][]" type="text" class="form-control" placeholder=""></td>
                                                        <td><input value="'.$row->satuan.'" id="satuan_'.$key.'" name="anggaran[satuan][]" type="text" class="form-control" placeholder=""></td>
                                                        <td><input value="'.number_format($row->total).'" id="total_'.$key.'" type="text" class="form-control" placeholder="" readonly></td>
                                                        <td>
                                                        '.$action.'
                                                        <input value="'.$id_anggaran_detail.'" id="id_anggaran_detail_'.$key.'" name="anggaran[id_anggaran_detail][]" type="hidden">
                                                        </td>
                                                    </tr>
                                                    ';
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </form>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-outline"
                                        onclick="tambah_anggaran()"><i class="fa fa-plus"></i> Tambah
                                        Data</a>
                                    

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="white-box">
                <div class="row ">
                    <h3>Daftar Penerima (<span id="total_penerima">0</span> Orang)</h3>

                    <div class="col-md-4" style="padding:0px;margin-bottom:10px">
                        <select class="form-control select2" id="kdkec_penerima" onchange="get_desa('penerima')">
                            <option value="">Semua Kecamatan</option>
                            <?php 
                                foreach($dt_kecamatan as $row){
                                    echo '<option value="'.$row->id_kecamatan.'">'.$row->kecamatan.'</option>';
                                }
                                ?>
                        </select>
                    </div>
                    <div class="col-md-4" style="padding:0px 0px 0px 10px;margin-bottom:10px;">
                        <select class="form-control select2" id="kddesa_penerima" onchange="loadPagination(1)">
                            <option value="">Semua Desa</option>
                        </select>
                    </div>
                    <div class="col-md-4" style="padding:0px 0px 0px 10px;margin-bottom:10px;">
                        <input id="search_penerima" onkeyup="loadPagination(1)" type="text" class="form-control"
                            placeholder="Cari nama atau NIK" />
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12" style="margin-top:10px">
                                    <div id="range_usia_1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <?php foreach($dt_sasaran as $key=>$val):?>
                                <div class="col-md-2" style="margin-top:10px">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary">
                                            <input onclick="loadPagination(1)" id="penerima_jenis_bantuan_<?=$val;?>"
                                                name="penerima_jenis_bantuan[]" type="checkbox">
                                            <label for="penerima_jenis_bantuan_<?=$val;?>"> <?=$val;?> </label>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach?>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:10px">
                        <!--
                            <button onclick="set_rts_penerima('')"
                                class="btn btn-default btn-xs btn-rounded btn-outline">Semua Karakteristik</button>
                            <?php foreach($dt_rts as $key => $value)
                            {
                                echo '<button onclick="set_rts_penerima(\''.$value.'\')" class="btn btn-default btn-xs btn-rounded btn-outline">'.$value.'</button>&nbsp;';
                            }
                            ?>
                        -->
                        <div class="pull-right_">
                            <button onclick="set_final('')" class="btn btn-info btn-xs btn-rounded btn-outline">Semua
                                Status</button>
                            <button onclick="set_final('N')" class="btn btn-danger btn-xs btn-rounded btn-outline"
                                id="btn-draft">Draft</button>
                            <button onclick="set_final('Y')" class="btn btn-success btn-xs btn-rounded btn-outline"
                                id="btn-final">Final</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table m-t-30">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Desa</th>
                                <th>Kecamatan</th>
                                <th>Karektistik RTS</th>
                                <?php foreach($dt_sasaran as $key=>$val):?>
                                <th style="text-align:center"><?=$val;?></th>
                                <?php endforeach?>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Opsi</th>

                            </tr>
                        </thead>
                        <tbody id="row-penerima">

                        </tbody>
                    </table>
                    <button onclick="update_final('Y',0)" type="button"
                        class="btn btn-success btn-sm btn-outline waves-effect"><i class="fa fa-check"></i> Setuju
                        Semua</button>
                    <button onclick="update_final('N',0)" type="button"
                        class="btn btn-default btn-sm btn-outline waves-effect"><i class="fa fa-file"></i> Tunda
                        semua</button>
                    <a href="<?=base_url();?>sigesit/kegiatan/edit/<?=$token;?>#dtks"
                        class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Penerima </a>
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

    <div class="row" style="margin:0px">
        <div class="col-md-12">
            <button onclick="save_anggaran()" class="btn btn-primary"><i class="fa fa-save"></i>
                Simpan</button>
            <a class="btn btn-default"
                href="<?=base_url();?>sigesit/penganggaran/skpd/<?= md5("SKPD".$detail->id_skpd);?>">Kembali</a>
        </div>
    </div>

</div>


<div class="modal fade" id="updateAnggaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Data dari Keuangan</h4>
            </div>
            <div class="modal-body">
                <form id="form-data">
                    <div class="form-group">
                        <label class="control-label">Program</label>
                        <select class="form-control select2" id="id_ref_program" name="id_ref_program"
                            onchange="getKegiatan()">
                            <option value="">Pilih</option>
                            <?php 
                            foreach($dt_program as $row){
                                $selected = ($dt_anggaran && $dt_anggaran->id_ref_program == $row->id_program) ? "selected" : "";
                                echo '<option '.$selected.' value="'.$row->id_program.'">'.$row->kode_program.' '.$row->nama_program.'</option>';
                            }
                            ?>
                        </select>
                        <div class="text-danger error" id="err_id_ref_program"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Kegiatan</label>
                        <select class="form-control select2" id="id_ref_kegiatan" name="id_ref_kegiatan"
                            onchange="getSubKegiatan()">
                            <option value="">Pilih</option>
                            <?php 
                            foreach($dt_kegiatan as $row){
                                $selected = ($dt_anggaran && $dt_anggaran->id_ref_kegiatan == $row->id_kegiatan) ? "selected" : "";
                                echo '<option '.$selected.' value="'.$row->id_kegiatan.'">'.$row->kode_kegiatan.' '.$row->nama_kegiatan.'</option>';
                            }
                            ?>
                        </select>
                        <div class="text-danger error" id="err_id_ref_kegiatan"></div>

                    </div>

                    <div class="form-group">
                        <label class="control-label">Sub Kegiatan</label>
                        <select class="form-control select2" id="id_ref_sub_kegiatan" name="id_ref_sub_kegiatan">
                            <option value="">Pilih</option>
                            <?php 
                            foreach($dt_sub_kegiatan as $row){
                                $selected = ($dt_anggaran && $dt_anggaran->id_ref_sub_kegiatan == $row->id_sub_kegiatan) ? "selected" : "";
                                echo '<option '.$selected.' value="'.$row->id_sub_kegiatan.'">'.$row->kode_sub_kegiatan.' '.$row->nama_sub_kegiatan.'</option>';
                            }
                            ?>
                        </select>
                        <div class="text-danger error" id="err_id_ref_sub_kegiatan"></div>

                    </div>


                    <div class="form-group" style="">
                        <label for="message-text" class="control-label">Total Anggaran</label>
                        <input type="text" onkeyup="currency(this)"
                            value="<?= ($dt_anggaran)? number_format($dt_anggaran->total_anggaran) : '' ;?>"
                            class="form-control" name="total_anggaran" id="total_anggaran"
                            placeholder="Masukan Realisasi Anggaran">
                        <div class="text-danger error" id="err_total_anggaran"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="">
                                <label for="message-text" class="control-label">Target</label>
                                <input type="text" onkeyup="currency(this)" value="<?=number_format($dt_anggaran->target_anggaran);?>" class="form-control"
                                    name="target_anggaran" id="target_anggaran" placeholder="Target">
                                <div class="text-danger error" id="err_target_anggaran"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="">
                                <label for="message-text" class="control-label">Satuan</label>
                                <input type="text" value="<?=$dt_anggaran->satuan_anggaran;?>" class="form-control"
                                    name="satuan_anggaran" id="satuan_anggaran" placeholder="Satuan">
                                <div class="text-danger error" id="err_satuan_anggaran"></div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="save_penganggaran()">Simpan</button>
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
    var i = '<?= ($dt_anggaran_detail) ? count($dt_anggaran_detail) : 0 ;?>';
    var dt_sasaran = JSON.parse('<?= json_encode($dt_sasaran) ;?>');
    function save_penganggaran()
    {
      reset_error();
      var formdata = new FormData(document.getElementById('form-data'));
      formdata.append("action","add");
      formdata.append("id_kegiatan","<?=$detail->id_kegiatan;?>");
      
      $.ajax({
         url        : "<?=base_url()?>sigesit/penganggaran/save_penganggaran",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){
            //console.log(data);
            if(data.status){
               swal('Berhasil',data.message,'success');
               setTimeout(() => {
                   location.reload();
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

    function save_anggaran()
    {
      reset_error();
      var formdata = new FormData(document.getElementById('form-anggaran'));
      formdata.append("id_kegiatan","<?=$detail->id_kegiatan;?>");
      $.ajax({
         url        : "<?=base_url()?>sigesit/penganggaran/save_anggaran",
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
                   location.reload();
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
            url: "<?=base_url()?>sigesit/penganggaran/get_kegiatan",
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
                //console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }
    function getSubKegiatan()
    {
        $("#id_ref_sub_kegiatan").val("").trigger("change");
        $.ajax({
            url: "<?=base_url()?>sigesit/penganggaran/get_sub_kegiatan",
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


    function tambah_anggaran()
    {

        var action = '<button onclick="hapus_anggaran('+i+')" class="btn btn-secondary"><i class="fa fa-trash"></i></button>';
        
        
        var row = '<tr id="anggaran_'+i+'">'
            +'<td><input id="nama_kegiatan_'+i+'" name="anggaran[nama_kegiatan][]" type="text" class="form-control" placeholder=""></td>'
            +'<td><input type="text" class="form-control" disabled value="<?= $detail->output_kegiatan;?>" /></td>'
            +'<td><input type="text" class="form-control" disabled value="<?=$detail->sasaran;?>" /></td>'
            +'<td><input type="text" class="form-control" disabled value="<?=$detail->nama_sumber_anggaran;?>" /></td>'
            +'<td><input onkeyup="kalkulasi('+i+')" id="jumlah_'+i+'" name="anggaran[jumlah][]" type="number" class="form-control" placeholder=""></td>'
            +'<td><input onkeyup="kalkulasi('+i+')" id="harga_'+i+'" name="anggaran[harga][]" type="text" class="form-control" placeholder=""></td>'
            +'<td><input id="satuan_'+i+'" name="anggaran[satuan][]" type="text" class="form-control" placeholder=""></td>'
            +'<td><input id="total_'+i+'" type="text" class="form-control" placeholder="" readonly></td>'
            +'<td>'
            +action
            +'<input id="total_'+i+'" name="anggaran[id_anggaran_detail][]" value="0" type="hidden">'
            +'</td>'
            +'</tr>';

        $("#row_anggaran").append(row);

        i++;

    }

    function hapus_anggaran(x)
    {
        $("#anggaran_"+x).remove();
    }

    setTimeout(() => {
        tambah_anggaran();
    }, 100);

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


    var page_penerima = 1;
    var rts_penerima = '';
    var final = '';

    function loadPagination(page_num) {

        page_penerima = page_num;
        var usia = $("#range_usia_1").data();

        var param = {
            search: $("#search_penerima").val(),
                kdkec: $("#kdkec_penerima").val(),
                kddesa: $("#kddesa_penerima").val(),
                rts: rts_penerima,
                id_kegiatan : '<?=$detail->id_kegiatan;?>',
                final : final,
                flag : 'realisasi',
                usia_1 : usia.from,
                usia_2 : usia.to,
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
                $("#pagination").html(data.pagination);
                $("#total_penerima").html(data.total_rows);
                $("#btn-draft").html("Ditunda ("+data.total_draft+")");
                $("#btn-final").html("Disetujui ("+data.total_final+")");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function get_desa(flag) {
        $("#kddesa_" + flag).val("").trigger("change");
        $.ajax({
            url: "<?=base_url()?>sigesit/kegiatan/get_desa",
            type: 'post',
            dataType: 'json',
            data: {
                id: $("#kdkec_" + flag).val(),
            },
            success: function (data) {
                //console.log(data);
                $("#kddesa_" + flag).html(data.content);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    
    function set_rts_penerima(rts) {
        rts_penerima = rts;
        loadPagination(1);
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
    function set_final(f) {
        final = f;
        loadPagination(1);
    }

    function update_final(final,id=null)
    {
        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/update_final",
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                final : final,
                id_kegiatan : '<?=$detail->id_kegiatan;?>',
            },
            success: function (data) {
                if(data.status==true)
                {
                    loadPagination(1);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
        
    }
</script>