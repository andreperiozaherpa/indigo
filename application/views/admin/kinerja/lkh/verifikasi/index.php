<style>
    .checked {
        color: #6003c8;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Verifikasi LKH</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>LKH</li>
                <li class="active">Verifikasi</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        
        <div class="col-md-12">
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

                    
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control select2" id="tahun" onchange="loadPagination(1)">
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

                                    echo '<option '.$selected.' value="'.$value.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control select2" id="bulan" onchange="loadPagination(1)">
                                <option value="">Semua</option>
                                <?php foreach($this->Config->bulan as $key=>$value)
                                {
                                    $selected = (date("n")==$key) ? "selected" : "";
                                    echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Pencarian </label>
                            <input type="text" onkeyup="loadPagination(1)" placeholder="Cari Nama atau NIP" class="form-control" name="search" id="search" />
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <label>Status Verifikasi</label>
                            <select class="form-control select2" id="status_verifikasi" onchange="loadPagination(1)">
                                <option value="">-</option>
                                <option value="sudah_diverifikasi">Sudah</option>
                                <option value="belum_diverifikasi">Belum</option>
                            </select>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0" id="title">VERIFIKASI LKH PEGAWAI</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark" id="sub_title"></p>
                        <div class="table-responsive">
                            <table style="margin-top:50px" class="table table-striped_">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>NIP</th>
                                        <th>Nama </th>
                                        <th>Status</th>
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



<div id="modal-detail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="modal-title">Detail LKH</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Rencana Hasil Kerja</th>
                            <th>Rencana Aksi</th>
                            <th>Laporan Hasil Kegiatan</th>
                            <th>Realisasi (%)</th>
                            <th>Status</th>
                            <th>Penilaian</th>
                            <th>Lampiran</th>
                        </tr>
                    </thead>
                    <tbody id="row-detail">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                <button type="button" id="btn-verifikasi" data-dismiss="modal" class="btn btn-primary waves-effect waves-light" onclick="verifikasi()"><i class="ti ti-check"></i> Verifikasi</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalVerifikasi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Verifikasi LKH</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-center">Mohon beri penilaian</h4>
                <div class="row">
                    <div class="col-md-12 text-center" style="font-size:30px">
                        <span id="star1" class="fa fa-star" onclick="setRating(1)" style="cursor:pointer;"></span>
                        <span id="star2" class="fa fa-star" onclick="setRating(2)" style="cursor:pointer;"></span>
                        <span id="star3" class="fa fa-star" onclick="setRating(3)" style="cursor:pointer;"></span>
                        <span id="star4" class="fa fa-star" onclick="setRating(4)" style="cursor:pointer;"></span>
                        <span id="star5" class="fa fa-star" onclick="setRating(5)" style="cursor:pointer;"></span>
                        <p id="label_rating"></label>
                    </div>
                    <div class="col-md-12 mt-3" style="margin-top:30px;">
                        <form method="POST" id="formVerifikasi">
                            <input type="hidden" name="status_verifikasi" value="sudah_diverifikasi">
                            <input type="hidden" name="rating" id="rating" value="">
                            <textarea class="form-control" id="komentar" name="komentar" placeholder="Masukkan komentar"></textarea>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Batal</a>
                <a href="javascript:void(0)" data-dismiss="modal" onclick="submit()" id="btnVerifikasi" class="btn btn-primary waves-effect text-left">Verifikasi</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    var isloading = false;

    var rating_desc = JSON.parse('<?=json_encode($rating_desc);?>');
    
    var page = 1;

    var id_skpd = "<?= ($this->input->get("id_skpd")) ? $this->input->get("id_skpd")  : "" ;?>";
    var id_unit_kerja = "<?= ($this->input->get("id_unit_kerja")) ? $this->input->get("id_unit_kerja")  : "" ;?>";

    var id_pegawai = "";
    var tanggal = "";
    
    function loadPagination(p) {
        page = p;
        var nama_skpd = $('#id_skpd option:selected').text();
        $("#sub_title").html(nama_skpd);

        if(!isloading)
        {
            isloading = false;
            $.ajax({
                url: "<?=base_url()?>kinerja/lkh/verifikasi/get_list/" + page,
                type: 'post',
                dataType: 'json',
                data: {
                    tahun: $("#tahun").val(),
                    bulan: $("#bulan").val(),
                    id_skpd: $("#id_skpd").val(),
                    id_unit_kerja: $("#id_unit_kerja").val(),
                    id_pegawai: $("#id_pegawai").val(),
                    search: $("#search").val(),
                    status_verifikasi : $("#status_verifikasi").val()
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
         url: "<?=base_url()?>kinerja/lkh/data/get_unit_kerja/",
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
         url: "<?=base_url()?>kinerja/lkh/data/get_pegawai/",
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

    function detail(_id_pegawai, _tanggal)
    {
        id_pegawai = _id_pegawai;
        tanggal = _tanggal;
        $("#row-detail").html("");
        $.ajax({
            url: "<?=base_url()?>kinerja/lkh/data/get_detail/",
            type: 'post',
            dataType: 'json',
            data: {
                id_pegawai : id_pegawai,
                tanggal : tanggal
            },
            success: function (data) {
                console.log(data);
                if(data.status_verifikasi=="sudah_diverifikasi")
                {
                    $("#btn-verifikasi").hide();
                }
                else{
                    $("#btn-verifikasi").show();
                }
                $("#row-detail").html(data.content);

                for(i=0; i < data.result.length;i++)
                {
                    var txt = document.createElement("textarea");
                    txt.innerHTML = data.result[i].rincian_kegiatan;
                    
                    $("#rincian_kegiatan_"+i).html(txt.value);
                    console.log(data.result[i].rincian_kegiatan);
                }
                
                $("#modal-title").html(data.title);
                $("#modal-detail").modal("show");
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
        
        
        console.log(id_pegawai+' ' + tanggal);
    }

    

    function verifikasi_langsung(_id_pegawai, _tanggal)
    {
        id_pegawai = _id_pegawai;
        tanggal = _tanggal;
        verifikasi();
    }

    function verifikasi()
    {
        $("#komentar").val("");
        setRating(1);
        $('#modalVerifikasi').modal('show');
    }

    function setRating(rating)
    {
        
        var star1 = document.getElementById("star1");
        var star2 = document.getElementById("star2");
        var star3 = document.getElementById("star3");
        var star4 = document.getElementById("star4");
        var star5 = document.getElementById("star5");
        
        if(rating==1)
        {
            star1.classList.add("checked");
            star2.classList.remove("checked");
            star3.classList.remove("checked");
            star4.classList.remove("checked");
            star5.classList.remove("checked");
        }
        else if(rating==2)
        {
            star1.classList.add("checked");
            star2.classList.add("checked");
            star3.classList.remove("checked");
            star4.classList.remove("checked");
            star5.classList.remove("checked");
        }
        else if(rating==3)
        {
            star1.classList.add("checked");
            star2.classList.add("checked");
            star3.classList.add("checked");
            star4.classList.remove("checked");
            star5.classList.remove("checked");
        }
        else if(rating==4)
        {
            star1.classList.add("checked");
            star2.classList.add("checked");
            star3.classList.add("checked");
            star4.classList.add("checked");
            star5.classList.remove("checked");
        }
        else if(rating==5)
        {
            star1.classList.add("checked");
            star2.classList.add("checked");
            star3.classList.add("checked");
            star4.classList.add("checked");
            star5.classList.add("checked");
        }
        else{
            star1.classList.remove("checked");
            star2.classList.remove("checked");
            star3.classList.remove("checked");
            star4.classList.remove("checked");
            star5.classList.remove("checked");
        }
        var desc = '';
        if(rating>0)
        {
            desc = rating_desc[rating];
        }
        $("#label_rating").html(desc);
        $("#rating").val(rating);
        console.log(rating);
    }

    function submit()
    {
        var formdata = new FormData(document.getElementById('formVerifikasi'));
        formdata.append("id_pegawai",id_pegawai);
        formdata.append("tanggal",tanggal);


        $.ajax({
            url        : "<?=base_url()?>kinerja/lkh/verifikasi/submit",
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
                    loadPagination(page);
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