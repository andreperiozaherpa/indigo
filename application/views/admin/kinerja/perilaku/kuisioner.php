<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Kuisioner Penilaian Perilaku</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li class="active">Penilaian Perilaku</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
    <div class="col-md-12">
            <div class="white-box" style="min-height:380px">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="box-title m-t-5">Pegawai yang dinilai</h3>
                        <table width="100%" class="table">
                            <thead>
                                <tr valign="top"><td width="20%">Nama</td><td width="1%">:</td><td><?=$pegawai->nama_lengkap;?></td></tr>
                                <tr valign="top"><td>NIP</td><td>:</td><td><?=$pegawai->nip;?></td></tr>
                                <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td><?=$pegawai->pangkat;?></td></tr>
                                <tr valign="top"><td>Jabatan</td><td>:</td><td><?=$pegawai->jabatan;?></td></tr>
                                <tr valign="top"><td>Unit Kerja</td><td>:</td><td><?=$pegawai->nama_unit_kerja;?></td></tr>
                                <tr valign="top"><td>Periode Penilaian</td><td>:</td><td><?=$periode;?></td></tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        
    </div>

    <div class="row kuisioner" style="display:none;">
        <div class="col-sm-12">
            <div class="white-box">
                <form id="form-data">
                <h3 class="box-title m-b-0">Kuisioner Penilaian Perilaku</h3>
                <p class="text-muted m-b-30 font-13"> Silahkan jawab pertanyaan dibawah ini se-objektif mungkin, identias Anda sebagai penilai akan dirahasiakan.</p>
                <div id="kuisioner" class="wizard">
                    
                </div>
                </form>
            </div>
        </div>
    </div>
    
</div>


<script type="text/javascript">


    getKuisioner();
    function getKuisioner() {
        $.ajax({
            url: "<?=base_url()?>kinerja/perilaku/get_kuisioner/",
            type: 'post',
            dataType: 'json',
            data: {
                
            },
            success: function (data) {
                //console.log(data);
                $("#kuisioner").html(data.content);

                $(".kuisioner").show();
                $('#kuisioner').wizard({
                    onFinish: function() {
                        submit();
                    }
                });
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function submit()
    {
        var formdata = new FormData(document.getElementById('form-data'));
        formdata.append("bulan","<?=$this->input->get("bulan");?>");
        formdata.append("tahun","<?=$this->input->get("tahun");?>");
        formdata.append("token","<?=$token;?>");
        $.ajax({
            url        : "<?=base_url()?>kinerja/perilaku/submit_kuisioner",
            type       : 'post',
            dataType   : 'json',
            data       : formdata,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success    : function(data){
                console.log(data);
                if(data.status)
                {
                    swal(
                        'Berhasil',
                        data.message,
                        'success'
                    );
                    setTimeout(() => {
                        window.location = "<?=base_url();?>kinerja/perilaku";
                    }, 1500);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        });
    }
    

</script>