<div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Visi Misi</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
                <li class="active">Visi Misi</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Visi <span class="label label-primary pull-right m-l-5"> <button type="button" onclick="editVisi()" class="btn btn-primary btn-sm">Edit Visi </button></span></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <p id="label_visi"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Misi</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Misi </th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="row-misi">
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary btn-outline" onclick="addMisi()"><i class="fa fa-plus"></i> Tambah Misi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Tujuan</div>
                <div class="panel-wrapper collapse in" aria-expanded="true" id="row-tujuan">

                </div>
            </div>

        </div>
        
    </div>



    <div id="modalVisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">Ubah Visi</h4>
                </div>
                <div class="modal-body">
                    <form id="form-data-visi">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Visi</label>
                            <textarea id="visi" name="visi" class="form-control" placeholder="Masukkan Visi"><?= $dt_visi->visi;?></textarea>
                            <div class="text-danger error" id="err_visi"></div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="simpanVisi()"  class="btn btn-primary">Simpan</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        load_visi();
        function load_visi()
        {
            $.ajax({
                url        : "<?=base_url()?>sicerdas/rpjmd/visimisi/get_visi/",
                type       : 'post',
                dataType   : 'json',
                data       : {},
                success    : function(data){
                    $("#label_visi").html(data.dt_visi.visi);
                    $("#visi").html(data.dt_visi.visi);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    swal("Opps","Terjadi kesalahan","error");
                }
            });
        }
        function editVisi() {
            $('#modalVisi').modal();
        }

        function simpanVisi() {
            var formdata = new FormData(document.getElementById('form-data-visi'));
            
            $.ajax({
                url        : "<?=base_url()?>sicerdas/rpjmd/visimisi/update_visi/",
                type       : 'post',
                dataType   : 'json',
                data       : formdata,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success    : function(data){

                if(data.status){
                    $('#modalVisi').modal('toggle');
                    load_visi();
                    swal(
                    'Berhasil',
                    data.message,
                    'success'
                    );
                    
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
    </script>

    <div id="modalMisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">Ubah Misi</h4>
                </div>
                <div class="modal-body">
                    <form id="formMisi">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Misi</label>
                            <textarea name="misi" id="misi" class="form-control" placeholder="Masukkan Misi"></textarea>
                            <div class="text-danger error" id="err_misi"></div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="simpanMisi()" class="btn btn-primary">Simpan</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        var action = '';
        var id_misi = 0;
        var rowDataMisi = {};

        load_misi();
        function load_misi()
        {
            $.ajax({
                url        : "<?=base_url()?>sicerdas/rpjmd/visimisi/get_misi/",
                type       : 'post',
                dataType   : 'json',
                data       : {},
                success    : function(data){
                    $("#row-misi").html(data.content);
                    rowDataMisi = data.result;
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    swal("Opps","Terjadi kesalahan","error");
                }
            });
        }
        

        function addMisi() {
            $(".error").html("");
            action = 'add';
            id_misi = 0;
            $('#formMisi')[0].reset();
            $('#message').html('');
            $('#modalMisi').modal('show');
            $('.modal-title').text('Tambah Misi');
        }

        function editMisi(i) {
            $(".error").html("");
            action = 'edit';
            id_misi = rowDataMisi[i].id_misi;
            $("#misi").val(rowDataMisi[i].misi);
            $('#modalMisi').modal('show');
            $('.modal-title').text('Edit Misi');
        }

        function simpanMisi() {
            var formdata = new FormData(document.getElementById('formMisi'));
            formdata.append("action",action);
            formdata.append("id_misi",id_misi);
            $.ajax({
                url        : "<?=base_url()?>sicerdas/rpjmd/visimisi/save_misi/",
                type       : 'post',
                dataType   : 'json',
                data       : formdata,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success    : function(data){

                if(data.status){
                    $('#modalMisi').modal('toggle');
                    load_misi();
                    swal(
                    'Berhasil',
                    data.message,
                    'success'
                    );
                    
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

        function deleteMisi(i) {
            swal({
                    title: "Hapus Misi ?",
                    //text: "Apakah anda yakin akan menghapus data ini?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Ya',
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url        : "<?=base_url()?>sicerdas/rpjmd/visimisi/delete_misi/",
                            type       : 'post',
                            dataType   : 'json',
                            data       : {
                                id      : rowDataMisi[i].id_misi,
                            },
                            success    : function(data){
                                //console.log(data);
                                if(data.status==true)
                                {
                                    swal({
                                        type: 'success',
                                        title: 'Berhasil',
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    load_misi();
                                }
                                else{
                                    swal("Opps",data.message,"error");
                                }
                            },
                            error: function(xhr, status, error) {
                                //swal("Opps","Error","error");
                                console.log(xhr);
                            }
                        });
                    }
                });
        }
    </script>

    <div id="modalTujuan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">Ubah Tujuan</h4>
                </div>
                <div class="modal-body">
                    <form id="formTujuan">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Misi</label>
                            <p class="label_misi"></p>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Tujuan</label>
                            <textarea id="tujuan" name="tujuan" class="form-control" placeholder="Masukkan Tujuan"></textarea>
                            <div class="text-danger error" id="err_tujuan"></div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="simpanTujuan()"  class="btn btn-primary">Simpan</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        var id_tujuan = 0;
        var rowDataTujuan = {};

        load_tujuan();
        function load_tujuan()
        {
            $.ajax({
                url        : "<?=base_url()?>sicerdas/rpjmd/tujuan/get/",
                type       : 'post',
                dataType   : 'json',
                data       : {},
                success    : function(data){
                    $("#row-tujuan").html(data.content);
                    rowDataTujuan  = data.result;
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    swal("Opps","Terjadi kesalahan","error");
                }
            });
        }

        function add_tujuan(i) {
            $(".error").html("");
            id_tujuan = 0;
            $(".label_misi").html(rowDataTujuan[i].misi);
            id_misi = rowDataTujuan[i].id_misi;
            action = 'add';
            $('#formTujuan')[0].reset();
            $('#modalTujuan').modal('show');
            $('.modal-title').text('Tambah Tujuan');
        }

        function edit_tujuan(i,t) {
            $(".error").html("");
            id_tujuan = rowDataTujuan[i].tujuan[t].id_tujuan;
            $(".label_misi").html(rowDataTujuan[i].misi);
            id_misi = rowDataTujuan[i].id_misi;
            action = 'edit';
            $("#tujuan").val(rowDataTujuan[i].tujuan[t].tujuan);
            $('#modalTujuan').modal('show');
            $('.modal-title').text('Edit Tujuan');

        }

        function simpanTujuan() {
            var formdata = new FormData(document.getElementById('formTujuan'));
            formdata.append("action",action);
            formdata.append("id_misi",id_misi);
            formdata.append("id_tujuan",id_tujuan);
            $.ajax({
                url        : "<?=base_url()?>sicerdas/rpjmd/tujuan/save/",
                type       : 'post',
                dataType   : 'json',
                data       : formdata,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success    : function(data){

                if(data.status){
                    $('#modalTujuan').modal('toggle');
                    load_tujuan();
                    swal(
                    'Berhasil',
                    data.message,
                    'success'
                    );
                    
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

        function delete_tujuan(id) {
            swal({
                    title: "Hapus Tujuan ?",
                    //text: "Apakah anda yakin akan menghapus data ini?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Ya',
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url        : "<?=base_url()?>sicerdas/rpjmd/tujuan/delete",
                            type       : 'post',
                            dataType   : 'json',
                            data       : {
                                id      : id,
                            },
                            success    : function(data){
                                //console.log(data);
                                if(data.status==true)
                                {
                                    swal({
                                        type: 'success',
                                        title: 'Berhasil',
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    load_tujuan();
                                }
                                else{
                                    swal("Opps",data.message,"error");
                                }
                            },
                            error: function(xhr, status, error) {
                                //swal("Opps","Error","error");
                                console.log(xhr);
                            }
                        });
                    }
                });   
        }
    </script>

    <div id="modalIndikator" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">Title</h4>
                </div>
                <div class="modal-body">
                    <form id="formIndikator">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Misi</label>
                            <p class="label_misi"></p>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Tujuan</label>
                            <p class="label_tujuan"></p>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Indikator</label>
                            <textarea id="indikator" name="indikator" class="form-control" placeholder="Masukkan Indikator"></textarea>
                            <div class="text-danger error" id="err_indikator"></div>
                        </div>

                        <div class="form-group row">
                                    
                            <label class="col-sm-12">Satuan Pengukuran</label>
                            <div class="col-sm-12">
                                <select name="satuan" id="satuan" class="form-control select2 input_select">
                                    <option value="">Pilih Satuan Pengukuran</option>
                                    <?php foreach($dt_satuan as $row)
                                    {
                                        echo '<option value="'.$row->id_satuan.'">'.$row->satuan.'</option>';
                                    }
                                    ?>
                                </select>
                                <div class="text-danger error" id="err_satuan"></div>
                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-md-6">
                                <table class="table table-bordered p-t-20">
                                    <tr class="active">
                                        <td style="text-align: center;"><b>Target Kondisi Awal</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="target_awal" id="target_awal" class="form-control input_text" placeholder="Masukkan target awal">
                                            <div class="text-danger error" id="err_target_awal"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <?php foreach($dt_tahun as $t => $tahun){?>
                                <div class="col-md-6">
                                    <table class="table table-bordered p-t-20">
                                        <tr class="active">
                                            <td style="text-align: center;"><b>Target Tahun <?=$tahun;?></b></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="target_tahun_<?=($t+1);?>" id="target_tahun_<?=($t+1);?>"  class="form-control input_text" placeholder="Masukkan target <?=$tahun;?>">
                                                <div class="text-danger error" id="err_target_tahun_<?=($t+1);?>"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <?php }?>

                            <div class="col-md-6">
                                <table class="table table-bordered p-t-20">
                                    <tr class="active">
                                        <td style="text-align: center;"><b>Kondisi Akhir</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="target_akhir" id="target_akhir" class="form-control input_text"  placeholder="Masukkan target akhir">
                                            <div class="text-danger error" id="err_target_akhir"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>



                            <hr>


                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="simpanIndikator()"  class="btn btn-primary">Simpan</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        var id_indikator = 0;

        function add_indikator(i,t) {
            $(".error").html("");
            id_indikator = 0;
            $(".label_misi").html(rowDataTujuan[i].misi);
            id_misi = rowDataMisi[i].id_misi;
            $(".label_tujuan").html(rowDataTujuan[i].tujuan[t].tujuan);
            id_tujuan = rowDataTujuan[i].tujuan[t].id_tujuan;
            action = 'add';
            $('#formIndikator')[0].reset();
            $('#modalIndikator').modal('show');
            $('.modal-title').text('Tambah Indikator');
        }

        function edit_indikator(i,t,ind) {
            $(".error").html("");
            id_indikator = rowDataTujuan[i].tujuan[t].indikator[ind].id_indikator_tujuan;
            $(".label_misi").html(rowDataTujuan[i].misi);
            id_misi = rowDataMisi[i].id_misi;
            $(".label_tujuan").html(rowDataTujuan[i].tujuan[t].tujuan);
            id_tujuan = rowDataTujuan[i].tujuan[t].id_tujuan;
            $("#indikator").val(rowDataTujuan[i].tujuan[t].indikator[ind].nama_indikator_tujuan);

            $("#satuan").val(rowDataTujuan[i].tujuan[t].indikator[ind].satuan).trigger("change");
            $("#target_awal").val(rowDataTujuan[i].tujuan[t].indikator[ind].target_awal);
            $("#target_akhir").val(rowDataTujuan[i].tujuan[t].indikator[ind].target_akhir);
            $("#target_tahun_1").val(rowDataTujuan[i].tujuan[t].indikator[ind].target_tahun_1);
            $("#target_tahun_2").val(rowDataTujuan[i].tujuan[t].indikator[ind].target_tahun_2);
            $("#target_tahun_3").val(rowDataTujuan[i].tujuan[t].indikator[ind].target_tahun_3);
            $("#target_tahun_4").val(rowDataTujuan[i].tujuan[t].indikator[ind].target_tahun_4);
            $("#target_tahun_5").val(rowDataTujuan[i].tujuan[t].indikator[ind].target_tahun_5);
            
            action = 'edit';
            $('#modalIndikator').modal('show');
            $('.modal-title').text('Edit Indikator');

        }

        function simpanIndikator() {
            var formdata = new FormData(document.getElementById('formIndikator'));
            formdata.append("action",action);
            formdata.append("id_misi",id_misi);
            formdata.append("id_tujuan",id_tujuan);
            formdata.append("id_indikator",id_indikator);
            $.ajax({
                url        : "<?=base_url()?>sicerdas/rpjmd/tujuan/save_indikator/",
                type       : 'post',
                dataType   : 'json',
                data       : formdata,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success    : function(data){

                if(data.status){
                    $('#modalIndikator').modal('toggle');
                    load_tujuan();
                    swal(
                    'Berhasil',
                    data.message,
                    'success'
                    );
                    
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

        function delete_indikator(id) {
            swal({
                    title: "Hapus Indikator ?",
                    //text: "Apakah anda yakin akan menghapus data ini?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Ya',
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url        : "<?=base_url()?>sicerdas/rpjmd/tujuan/delete_indikator",
                            type       : 'post',
                            dataType   : 'json',
                            data       : {
                                id      : id,
                            },
                            success    : function(data){
                                //console.log(data);
                                if(data.status==true)
                                {
                                    swal({
                                        type: 'success',
                                        title: 'Berhasil',
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    load_tujuan();
                                }
                                else{
                                    swal("Opps",data.message,"error");
                                }
                            },
                            error: function(xhr, status, error) {
                                //swal("Opps","Error","error");
                                console.log(xhr);
                            }
                        });
                    }
                });   
        }

    </script>