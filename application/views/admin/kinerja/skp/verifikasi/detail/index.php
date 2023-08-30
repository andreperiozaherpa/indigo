<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">SKP Tahun <?=$detail->tahun_desc;?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>SKP</li>
                <li class="active">Detail</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <form id="form-verifikasi">

        <div class="col-md-6">
            <div class="white-box" style="min-height:380px">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="box-title m-t-5">Pegawai yang dinilai</h3>
                        <table width="100%" class="table">
                            <thead>
                                <tr valign="top"><td width="30%">Nama</td><td width="5%">:</td><td><?=$detail->nama_lengkap;?></td></tr>
                                <tr valign="top"><td>NIP</td><td>:</td><td><?=$detail->nip;?></td></tr>
                                <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td><?=$detail->pangkat;?></td></tr>
                                <tr valign="top"><td>Jabatan</td><td>:</td><td><?=$detail->jabatan;?></td></tr>
                                <tr valign="top"><td>Unit Kerja</td><td>:</td><td><?=$detail->nama_unit_kerja;?></td></tr>
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
                        
                        <h3 class="box-title m-t-5">Pejabat penilai kerja</h3>
                        <table width="100%" class="table">
                            <thead>
                                <tr valign="top"><td width="30%">Nama</td><td width="5%">:</td><td><?=$detail->nama_lengkap_atasan;?></td></tr>
                                <tr valign="top"><td>NIP</td><td>:</td><td><?=$detail->nip_atasan;?></td></tr>
                                <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td><?=$detail->pangkat_atasan;?></td></tr>
                                <tr valign="top"><td>Jabatan</td><td>:</td><td><?=$detail->jabatan_atasan;?></td></tr>
                                <tr valign="top"><td>Unit Kerja</td><td>:</td><td><?=$detail->nama_unit_kerja_atasan;?></td></tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        
            <?php 
            
            $this->load->view('admin/kinerja/skp/verifikasi/detail/kinerja_utama') ;
            $this->load->view('admin/kinerja/skp/verifikasi/detail/instruksi_khusus') ;
            $this->load->view('admin/kinerja/skp/verifikasi/detail/kinerja_tambahan') ;
            $this->load->view('admin/kinerja/skp/verifikasi/detail/perilaku_kerja') ;
            if(!$role_pimpinan){
                $this->load->view('admin/kinerja/skp/verifikasi/detail/lampiran') ;
            }
            ?>
        </form>     
        <div class="col-md-12">
            <button class="btn btn-primary pull-right_ btn-lg_" onclick="verifikasi()" ><i class="ti-check-box"></i> Verifikasi</button>
            <button class="btn btn-danger pull-right_ btn-lg_" onclick="onReject()" ><i class="ti-close"></i> Tolak</button>
        </div>

    </div>

    

</div>

<div id="modal-reject" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tolak SKP</h4>
            </div>
            <div class="modal-body">
                <form id="form-reject">
                    <div class="form-group">
                        <label for="renja" class="control-label">Alasan Penolakan</label>
                        <textarea class="form-control" id="alasan_penolakan" name="alasan_penolakan" ></textarea>
                        <div class="text-danger error" id="err_alasan_penolakan"></div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger waves-effect waves-light" onclick="reject()">Tolak</button>
            </div>
        </div>
    </div>
</div>

<script>
    
    function onReject() {
        $("#modal-reject").modal("show");
    }

    function verifikasi()
    {
        var formdata = new FormData(document.getElementById('form-verifikasi'));
        formdata.append("id_skp","<?= $detail->id_skp;?>");
        

        $.ajax({
            url        : "<?=base_url()?>kinerja/skp/verifikasi/submit",
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
                        window.location = "<?=base_url();?>kinerja/skp/verifikasi";
                    }, 1500);
                }
                else{
                    for(err in data.errors)
                    {
                        $("#err_"+err).html(data.errors[err]);
                    }
                    if(data.message){
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


    function reject()
    {
        var formdata = new FormData(document.getElementById('form-reject'));
        formdata.append("id_skp","<?= $detail->id_skp;?>");
        

        $.ajax({
            url        : "<?=base_url()?>kinerja/skp/verifikasi/reject",
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
                        window.location = "<?=base_url();?>kinerja/skp/verifikasi";
                    }, 1500);
                }
                else{
                    for(err in data.errors)
                    {
                        $("#err_"+err).html(data.errors[err]);
                    }
                    if(data.message){
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

</script>