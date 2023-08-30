<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= !empty($detail) ? "Edit SKP Tahun " . $detail->tahun_desc : "Formulir SKP " ;?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>SKP</li>
                <li class="active">Formulir</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <form id="form-skp">
        <?php if(empty($detail)) :?>
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tahun SKP </label>
                            <select class="form-control select2" id="tahun" name="tahun" onchange="getData()">
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
        <?php endif?>
        <div class="col-md-6">
            <div class="white-box" style="min-height:380px">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="box-title m-t-5">Pegawai yang dinilai</h3>
                        <table width="100%" class="table">
                            <thead>
                                <tr valign="top"><td width="30%">Nama</td><td width="5%">:</td><td><?=$pegawai->nama_lengkap;?></td></tr>
                                <tr valign="top"><td>NIP</td><td>:</td><td><?=$pegawai->nip;?></td></tr>
                                <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td><?=$pegawai->pangkat;?></td></tr>
                                <tr valign="top"><td>Jabatan</td><td>:</td><td><?=$pegawai->jabatan;?></td></tr>
                                <tr valign="top"><td>Unit Kerja</td><td>:</td><td><?=$pegawai->nama_unit_kerja;?></td></tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="white-box" style="min-height:380px">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(empty($detail)):?>
                        <a class="btn btn-sm btn-primary btn-outline pull-right" data-toggle="modal" data-target="#modal-atasan"><i class=" icon-note"></i> Ubah</a>
                        <?php endif?>
                        <h3 class="box-title m-t-5">Pejabat penilai kerja</h3>
                        <table width="100%" class="table">
                            <thead>
                                <tr valign="top"><td width="30%">Nama</td><td width="5%">:</td><td><?=($atasan) ? $atasan->nama_lengkap : "-";?></td></tr>
                                <tr valign="top"><td>NIP</td><td>:</td><td><?=($atasan) ? $atasan->nip : "-";?></td></tr>
                                <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td><?=($atasan) ? $atasan->pangkat : "-";?></td></tr>
                                <tr valign="top"><td>Jabatan</td><td>:</td><td><?=($atasan) ? $atasan->jabatan : "-";?></td></tr>
                                <tr valign="top"><td>Unit Kerja</td><td>:</td><td><?=($atasan) ? $atasan->nama_unit_kerja : "-";?></td></tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        
            <?php 
            
            $this->load->view('admin/kinerja/skp/form/kinerja_utama') ;
            $this->load->view('admin/kinerja/skp/form/instruksi_khusus') ;
            $this->load->view('admin/kinerja/skp/form/kinerja_tambahan') ;
            //$this->load->view('admin/kinerja/skp/form/perilaku_kerja') ;
            if(!$role_pimpinan){
                $this->load->view('admin/kinerja/skp/form/lampiran') ;
            }
            ?>
        </form>     
        <div class="col-md-12">
            <button class="btn btn-primary pull-right_ btn-lg" onclick="submit()" ><i class="icon-paper-plane"></i> <?= !empty($detail) ? "Simpan"  : "Submit" ;?></button>
        </div>

    </div>

    

</div>


<div id="modal-atasan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Pejabat Penilai Kerja</h4>
            </div>
            <div class="modal-body">
                <form id="form-atasan">
                    <div class="form-group">
                        <label for="renja" class="control-label">SKPD</label>
                        <select class="form-control select2" id="id_skpd" name="id_skpd" onchange="getPejabatPenilaiKerja()" >
                                <?php foreach($dt_skpd->result() as $row)
                                {
                                    $selected = ($atasan && $row->id_skpd == $atasan->id_skpd) ? "selected" : "";
                                    echo '<option '.$selected.' value="'.$row->id_skpd.'">'.$row->nama_skpd.'</option>';
                                }
                                ?>
                        </select>
                        <div class="text-danger error" id="err_id_skpd"></div>
                    </div>

                    <div class="form-group">
                        <label for="id_pegawai_penilai_kerja" class="control-label">Pejabat penilai kerja</label>
                        <select class="form-control select2" id="id_pegawai_penilai_kerja" name="id_pegawai_penilai_kerja" >
                                <?php 
                                if($dt_pejabat){
                                    foreach($dt_pejabat->result() as $row)
                                    {
                                        $selected = ($atasan && $row->id_pegawai == $atasan->id_pegawai) ? "selected" : "";
                                        echo '<option '.$selected.' value="'.$row->id_pegawai.'">'.$row->nama_lengkap.' - '.$row->jabatan.'</option>';
                                    }
                                }
                                ?>
                        </select>
                        <div class="text-danger error" id="err_id_pegawai_penilai_kerja"></div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="save_atasan()">Ubah</button>
            </div>
        </div>
    </div>
</div>

<script>
    getPejabatPenilaiKerja('<?=($atasan) ? $atasan->id_pegawai : '0';?>');
    function getPejabatPenilaiKerja(id_pegawai_penilai_kerja=null) {
        $("#id_pegawai_penilai_kerja").html("");
        if(id_pegawai_penilai_kerja==null)
        {
            id_pegawai_penilai_kerja = $("#id_pegawai_penilai_kerja").val()
        }
        $.ajax({
            url: "<?= base_url() ?>kinerja/skp/form/get_pejabat_penilai_kerja/",
            type: 'post',
            dataType: 'json',
            data: {
                id_skpd: $("#id_skpd").val(),
                id_pegawai_penilai_kerja: id_pegawai_penilai_kerja,
            },
            success: function (data) {
                $("#id_pegawai_penilai_kerja").html(data.content).trigger("change");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function save_atasan()
    {
        var formdata = new FormData(document.getElementById('form-atasan'));
        formdata.append("id_pegawai","<?= $pegawai->id_pegawai;?>");
        
        $.ajax({
            url        : "<?=base_url()?>kinerja/skp/form/save_atasan",
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
                    $('#modal-atasan').modal('toggle');
                    swal(
                        'Berhasil',
                        data.message,
                        'success'
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
                else{
                    for(err in data.errors)
                    {
                        $("#err_"+err).html(data.errors[err]);
                    }
                    if(data.errors.length==0){
                        swal(
                        'Opps',
                        data.message,
                        'warning');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        });
    }

    function submit()
    {
        $(".error").html("");
        var formdata = new FormData(document.getElementById('form-skp'));
        formdata.append("id_pegawai","<?= $pegawai->id_pegawai;?>");
        formdata.append("id_pegawai_atasan","<?= ($atasan) ? $atasan->id_pegawai : '0';?>");
        formdata.append("tahun",$("#tahun").val());
        formdata.append("tahun_desc",$('#tahun option:selected').text());
        formdata.append("id_skp","<?= (!empty($detail)) ? $detail->id_skp : '0';?>");

        $.ajax({
            url        : "<?=base_url()?>kinerja/skp/form/submit",
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
                    swal(
                        'Berhasil',
                        data.message,
                        'success'
                    );
                    setTimeout(() => {
                        window.location = "<?=base_url();?>kinerja/skp/riwayat";
                    }, 1500);
                }
                else{
                    for(err in data.errors)
                    {
                        $("#err_"+err).html(data.errors[err]);
                    }
                    if(data.hasOwnProperty("message")){
                        swal(
                        'Opps',
                        data.message,
                        'warning');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        });
    }

    function getData()
    {
        loadDataKinerja();
        loadDataInstruksi();
    }
</script>