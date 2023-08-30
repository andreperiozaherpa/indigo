<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h4 class="page-title">Evaluasi Kinerja SKP Tahun <?=$detail->tahun_desc;?> <?= ($triwulan) ? "Triwulan Ke-".$triwulan :"" ;?></h4>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li class="active">Evaluasi Kinerja</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <form id="form-data">

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
            
            $this->load->view('admin/kinerja/laporan/evaluasi/form/kinerja_utama') ;
            $this->load->view('admin/kinerja/laporan/evaluasi/form/instruksi_khusus') ;
            $this->load->view('admin/kinerja/laporan/evaluasi/form/kinerja_tambahan') ;
            ?>
        </form>     
        <div class="col-md-12">
            <button class="btn btn-primary pull-right_ btn-lg_" onclick="submit()" ><i class="ti-check-box"></i> Submit</button>
            <a href="<?=base_url();?>kinerja/laporan/evaluasi" class="btn btn-default btn-outline pull-right_ btn-lg_">Kembali</a>
        </div>

    </div>

    

</div>

<script>
    

    function submit()
    {
        var formdata = new FormData(document.getElementById('form-data'));
        formdata.append("id_skp","<?= $detail->id_skp;?>");
        formdata.append("triwulan","<?= $triwulan;?>");

        $.ajax({
            url        : "<?=base_url()?>kinerja/laporan/evaluasi/submit",
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
                        location.reload();
                    }, 1500);
                }
                else{
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