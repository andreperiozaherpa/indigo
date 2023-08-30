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
            
            $this->load->view('admin/kinerja/skp/detail/kinerja_utama') ;
            $this->load->view('admin/kinerja/skp/detail/instruksi_khusus') ;
            $this->load->view('admin/kinerja/skp/detail/kinerja_tambahan') ;
            $this->load->view('admin/kinerja/skp/detail/perilaku_kerja') ;
            if(!$role_pimpinan){
                $this->load->view('admin/kinerja/skp/detail/lampiran') ;
            }
            ?>
        </form>     
        <div class="col-md-12">
            <button class="btn btn-primary pull-right_ btn-lg_" onclick="edit()" ><i class="ti-pencil"></i> Edit</button>
            <button class="btn btn-primary btn-outline pull-right_ btn-lg_" onclick="preview()" ><i class="fa fa-search"></i> Priview SKP</button>
            <button class="btn btn-primary btn-outline pull-right_ btn-lg_" onclick="download()" ><i class="fa fa-download"></i> Download SKP</button>
            <button class="btn btn-danger btn-outline pull-right_ btn-lg_" onclick="hapus()" ><i class="ti-trash"></i> Hapus</button>

            <button class="btn btn-success btn-outline pull-right_ btn-lg_" onclick="arsip()" ><i class="ti-archive"></i> Buat Arsip</button>
        </div>

    </div>

    

</div>

<script>
    function edit()
    {
        let link = "<?= base_url();?>kinerja/skp/form?token=<?=$token;?>";
        window.location = link;
    }  
    
    function download()
    {
        let link = "<?= base_url();?>kinerja/skp/download?token=<?=$token;?>";
        window.location = link;
    } 
    
    function preview()
    {
        let link = "<?= base_url();?>kinerja/skp/download?token=<?=$token;?>&preview=1";
        window.open(link,"_blank");
    } 

    function hapus() {
        swal({
                title: "Hapus SKP ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak",
                closeOnConfirm: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "<?=base_url()?>kinerja/skp/delete",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: '<?=$detail->id_skp;?>  ',
                        },
                        success: function (data) {
                            if (data.status == true) {
                                swal({
                                    type: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    window.location = "<?=base_url();?>kinerja/skp/riwayat";
                                }, 1500);
                                
                            } else {
                                swal("Opps", data.message, "error");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr);
                        }
                    });
                }
            });
    }

    function arsip() {
        swal({
                title: "Buat Arsip ?",
                text : "Anda akan mengarsipkan SKP ini",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya, Buat Arsip',
                cancelButtonText: "Tidak",
                closeOnConfirm: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "<?=base_url()?>kinerja/skp/arsip/create",
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: '<?=$detail->id_skp;?>  ',
                        },
                        success: function (data) {
                            if (data.status == true) {
                                swal({
                                    type: 'success',
                                    title: 'Berhasil',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    window.location = "<?=base_url();?>kinerja/skp/arsip";
                                }, 1500);
                                
                            } else {
                                swal("Opps", data.message, "error");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr);
                        }
                    });
                }
            });
    }
</script>