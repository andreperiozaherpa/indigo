<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Data Diklat</h4>
    </div>

		</div>

  <div class="row">


    <div class="col-md-12">
        <div class="white-box">


                        <div class="row ">

                            <div class="col-lg-12 col-md-9 col-sm-12 col-xs-12">
                                <div class="inbox-center">
                                    <div class="col-md-7 m-b-10">
                                        <button class="btn  btn-primary" onclick="add()" data-toggle="modal" data-target="#popup_form">
                                            <i class="ti-plus"> </i>
                                            Tambah diklat</button>

                                    </div>

                                    <div class="col-md-7">


                                    </div>

                                    <table class="table table-hover" id="data">
                                    <thead>

                                    <tr>
                                        <th width="30">
                                            <div class="checkbox m-t-0 m-b-0 ">
                                                <input id="check_all" type="checkbox" class="checkbox-toggle"  value="check all">
                                                <label for="checkbox"></label>
                                            </div>
                                        </th>
                                        <th colspan="2">
                                          <div class="btn-group">
                                              <button id="btn_kategori_" type="button" onclick="getKategori('','')" class="btn btn-primary btn-filter waves-effect">Semua</button>
                                              <?php
                                              $dt_nilai_kesenjangan = $this->config->item("nilai_kesenjangan");
                                              foreach ($this->config->item("kategori_diklat") as $key => $value) {
                                                echo '<button id="btn_kategori_'.$key.'" type="button" onclick="getKategori('.$key.',\''.$value.'\')" class="btn btn-default btn-filter btn-outline waves-effect">'.$value.'</button>';
                                              }
                                              ?>

                                          </div>
                                          <div class="btn-group">
                                              <button type="button" onclick="hapus()" class="btn btn-default btn-outline waves-effect"><i class="fa fa-trash"></i></button>
                                              <button type="button" onclick="resetform()" class="btn btn-default btn-outline waves-effect"><i class="fa fa-refresh"></i></button>
                                          </div>

                                          <div class="btn-group">
                                              <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light m-r-5" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-flag m-r-5"></i>  <b class="caret"></b></button>
                                              <ul class="dropdown-menu" role="menu" id="opt_kategori">
                                                  <li>
                                                          <a href='javascript:void(0)' onclick='get_nilai("")'>Nilai Kesenjangan</a>
                                                  </li>
                                                  <?php foreach ($this->config->item("nilai_kesenjangan") as $key => $row) {
                                                     echo "
                                                     <li>
                                                          <a href='javascript:void(0)' onclick='get_nilai(\"$row\")'>$row</a>
                                                     </li>
                                                     ";
                                                  }
                                                  ?>

                                              </ul>
                                          </div>



                                        </th>

                                        <th colspan="4">
                                            <div class="btn-group pull-right">
                                                <div class="input-group">
                                                    <input type="text" onkeyup="loadPagination(1)" id="fsearch" name="example-input1-group2" class="form-control" placeholder="<?= $this->lang->line("search");?>">
                                                    <span class="input-group-btn">
                                                        <button type="button" onclick="loadPagination(1)" class="btn waves-effect waves-light btn-default">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>

                                        </th>
                                        <tr>
                                            <th></th>
                                            <th>Jenis PK</th>
                                            <th class="text-center">Bentuk PK</th>
                                            <th class="text-center">Untuk Nilai Kesenjangan</th>
                                            <th width="50px"></th>
                                        </tr>
                                    </tr>
                                    </thead>
                                    <tbody>


                                </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12 pager">

                            <div class="btn-group" id="pagination">

                            </div>

                        </div>



                    </div>


        <!-- /.row -->
    </div>
</div>
</div>



<div class="modal  fade" id="popup_form" tabindex="-1" role="dialog" aria-labelledby="modal_tittle">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Form</h4>
            </div>
            <form id="form-data">
               <div class="modal-body">

                  <div class="form-group row">
                       <label for="nama_kompetensi" class="col-md-4 col-form-label text-right">Jenis PK</label>
                     <div class="col-md-7">
                        <input id="nama_diklat" type="text" class="form-control" name="nama_diklat" value="" placeholder="Nama Diklat" autofocus>
												<label class="text-danger" id="err_nama_diklat"></label>
                      </div>
                  </div>
                  <div class="form-group row">
                     <label for="jabatan" class="col-md-4 col-form-label text-right">Bentuk PK</label>
                     <div class="col-md-7">
                        <select name="kategori_diklat" onchange="set_kategori()" id="kategori_diklat" class="select2 form-control">
													<?php foreach ($this->config->item("kategori_diklat") as $key => $value) {
													 echo "<option value='$value'>$value</option>";
												 }
												 ?>
                        </select>
												<label class="text-danger" id="err_kategori_diklat"></label>
											</div>
                  </div>
                  <div class="form-group row" id="row_jenis_pelatihan">
                     <label for="jabatan" class="col-md-4 col-form-label text-right">Jenis Pelatihan</label>
                     <div class="col-md-7">
                        <select name="jenis_pelatihan" id="jenis_pelatihan" class="select2 form-control">
													<option value="">Pilih</option>
													<?php foreach ($this->config->item("kategori_diklat_pelatihan") as $key => $value) {
													 echo "<option value='$value'>$value</option>";
												 }
												 ?>
                        </select>
												<label class="text-danger" id="err_jenis_pelatihan"></label>
											</div>
                  </div>

                  <div class="form-group row">
                     <label for="jabatan" class="col-md-4 col-form-label text-right">Untuk Nilai Kesenjangan</label>
                     <div class="col-md-7">
                        <select name="nilai_kesenjangan" id="nilai_kesenjangan" class="select2 form-control">
													<option value="">Pilih</option>
													<?php foreach ($this->config->item("nilai_kesenjangan") as $key => $value) {
													 echo "<option value='$value'>$value</option>";
												 }
												 ?>
                        </select>
												<label class="text-danger" id="err_nilai_kesenjangan"></label>
											</div>
                  </div>

                  <div class="form-group row">
                     <label for="jabatan" class="col-md-4 col-form-label text-right">Penyelenggara</label>
                     <div class="col-md-7">
                        <select name="model_penyelenggara" onchange="set_penyelenggara()" id="model_penyelenggara" class="select2 form-control">
													<?php foreach ($this->config->item("model_penyelenggara_diklat") as $key => $value) {
													 echo "<option value='$value'>$value</option>";
												 }
												 ?>
                        </select>
												<label class="text-danger" id="err_model_penyelenggara"></label>
											</div>
                  </div>

                  <div class="form-group row" id="row_penyelenggara">
                     <label for="nama_kompetensi" class="col-md-4 col-form-label text-right"></label>
                     <div class="col-md-7">
                        <input id="penyelenggara" type="text" class="form-control" name="penyelenggara" value="" placeholder="Masukan penyelenggara" autofocus>
												<label class="text-danger" id="err_penyelenggara"></label>
                      </div>
                  </div>

                  <div class="form-group row">
                     <label for="nama_kompetensi" class="col-md-4 col-form-label text-right">Jadwal</label>
                     <div class="col-md-7">
                        <input id="jadwal" type="month" class="form-control" name="jadwal" value="<?=date("Y-m");?>" placeholder="" autofocus>
												<label class="text-danger" id="err_jadwal"></label>
                      </div>
                  </div>

                  <div class="form-group row">
                     <label for="nama_kompetensi" class="col-md-4 col-form-label text-right">Jam Pelajaran</label>
                     <div class="col-md-7">
                        <input id="jam_pelajaran" type="text" class="form-control" name="jam_pelajaran" value="" placeholder="Masukan Jam Pelajaran" autofocus>
												<label class="text-danger" id="err_jam_pelajaran"></label>
                      </div>
                  </div>

                  <div class="form-group row">
                     <label for="nama_kompetensi" class="col-md-4 col-form-label text-right">Anggaran Dasar</label>
                     <div class="col-md-7">
                        <input id="anggaran" type="text" class="form-control" name="anggaran" value="" placeholder="Masukan Anggaran Dasar Diklat" autofocus>
												<label class="text-danger" id="err_anggaran"></label>
                      </div>
                  </div>

                  <div class="form-group row">
                     <label for="jabatan" class="col-md-4 col-form-label text-right">Sumber DPA</label>
                     <div class="col-md-7">
                        <select name="dpa" id="dpa" class="select2 form-control">
													<?php foreach ($this->config->item("dpa_diklat") as $key => $value) {
													 echo "<option value='$value'>$value</option>";
												 }
												 ?>
                        </select>
												<label class="text-danger" id="err_dpa"></label>
											</div>
                  </div>

                  <div class="form-group row">
                     <label for="jabatan" class="col-md-4 col-form-label text-right">Kesesuaian PK dengan Standar Kurikulum</label>
                     <div class="col-md-7">
                        <select name="kesesuaian" id="kesesuaian" class="select2 form-control">
													<?php foreach ($this->config->item("kesesuaian_diklat") as $key => $value) {
													 echo "<option value='$value'>$value</option>";
												 }
												 ?>
                        </select>
												<label class="text-danger" id="err_kesesuaian"></label>
											</div>
                  </div>
               </div>
							</form>
               <div class="modal-footer">
                  <button onclick="save()" class="btn btn-primary">Simpan</button>
               </div>

         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>


<script type='text/javascript'>
    var csrf_hash = "<?=$this->security->get_csrf_hash();?>";
    var rowData = {};
    var action = "";
    var id_diklat = 0;
    var kategori_diklat = "";
    var nilai_kesenjangan = "";
    var total_row = 0;
    function loadPagination(page_num)
    {

        $('#data').block({
            message: '<h4><img src="<?=base_url();?>asset/pixel/plugins/images/busy.gif" /> Mohon tunggu</h4>',
            css: {
                border: '1px solid #fff'
            }
        });

        var search     = $("#fsearch").val();
        $.ajax({
         url        : "<?=base_url()?>bangkom/diklat/get_list/"+page_num,
         type       : 'post',
         dataType   : 'json',
         data       : {
            search     : search,
            kategori_diklat      : kategori_diklat,
            nilai_kesenjangan : nilai_kesenjangan,
            "<?=$this->security->get_csrf_token_name();?>" : csrf_hash,
         },
         success    : function(data){
            rowData = data.result;
            //console.log(data.result);
            //console.log(rowData);
            loadData(data.result,data.row);
            $("#pagination").html(data.pagination);
            $('#data').unblock();
            csrf_hash = data.csrf_hash;
         }
       });


    }
    function loadData(data,row)
    {
        row = Number(row);
        $("#data tbody").empty();
        for(i in data)
        {
            row++;
            var nama_diklat = data[i].nama_diklat;
            var kategori_diklat = data[i].kategori_diklat;
            var kesenjangan = data[i].nilai_kesenjangan;
            var id = data[i].id_diklat;
            if(data[i].jenis_pelatihan){
              kategori_diklat += " - "+data[i].jenis_pelatihan;
            }
            var tr = "<tr>";

            tr += "<td>";
            tr += "<div class='checkbox m-t-0 m-b-0'>";
            tr += "<input type='checkbox' class='checkbox' value='"+id+"' id='checkbox"+i+"' name='centang[]' >";
            tr += "<label for='checkbox"+i+"'></label>";
            tr += "</div>";
            tr += "</td>";
            tr += "<td class='max-texts'><strong>"+nama_diklat+"</strong></td>";
            tr += "<td class='text-center'>"+kategori_diklat+"</td>";
            tr += "<td class='text-center'>"+kesenjangan+"</td>";
            tr += "<td>";

            tr += '<div class="btn-group">';
            tr += '<button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-circle btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="icon-options-vertical"></i></button>';
            tr += '<ul role="menu" class="dropdown-menu">';
            tr += '<li><a href="javascript:void(0)" data-toggle="modal" data-target="#popup_form" onclick="edit('+i+')">Edit</a></li>';
            tr += '<li><a href="javascript:void(0)" onclick="hapus('+i+')">Hapus</a></li>';

            tr += '</ul>';
            tr += '</div>';
            tr += "</td>";
            tr += "</tr>";



            $("#data tbody").append(tr);
            total_row++;
        }

        if(row==0){
            $("#data tbody").append("<tr><td colspan='5' align='center'>- Tidak ada data -</td></tr>");
        }
    }


    function hapus(i='')
    {

        var ids = [];
            if(i===''){
                var s=0;
                for(x=0; x<total_row;x++)
                {
                    if($("#checkbox"+x).prop("checked")==true){
                        ids[s] = $("#checkbox"+x).val();
                        s++;
                    }
                    //console.log(i);
                    //console.log($("#checkbox"+i).prop("checked"));
                }
            }
            else{

                ids[0] = rowData[i].id_diklat;
            }
        if(ids.length>0){
            swal({
                title: "Hapus Diklat ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            }, function(){

                console.log(ids);
                $('#data').block({
                    message: '<h4><img src="<?=base_url();?>asset/pixel/plugins/images/busy.gif" /> Mohon tunggu</h4>',
                    css: {
                        border: '1px solid #fff'
                    }
                });

                $.ajax({
                 url        : "<?=base_url()?>bangkom/diklat/delete/",
                 type       : 'post',
                 dataType   : 'json',
                 data       : {
                    "<?=$this->security->get_csrf_token_name();?>" : csrf_hash,
                    ids : ids,
                 },
                 success    : function(data){
                    console.log(data);

                    $('#data').unblock();
                    csrf_hash = data.csrf_hash;

                    if(data.status){
                        loadPagination(1);
                        swal("Sukses", data.message, "success");
                    }
                    else{
                        swal("Gagal", data.message, "warning");
                    }
                 }
               });


            });
        }
    }

    function getKategori(i,kat)
    {

        kategori_diklat = kat;

        $(".btn-filter").attr("class","btn btn-default btn-outline btn-filter  waves-effect");
        $("#btn_kategori_"+i).attr("class","btn btn-primary btn-filter waves-effect");
        loadPagination(1);
    }

    function get_nilai(nilai)
    {

        nilai_kesenjangan = nilai;
        loadPagination(1);
    }


    function resetform()
    {

        $("#fsearch").val("");
        nilai_kesenjangan = "";
        getKategori("");
    }

    function add()
    {
        $(".modal-title").html("Tambah Diklat");

        $("#kategori_diklat").val("Pendidikan").trigger("change");
				$("#model_penyelenggara").val("Mandiri").trigger("change");
				$("#nilai_kesenjangan").val("").trigger("change");
        $("#dpa").val("DPA BPSDM").trigger("change");
        $("#kesesuaian").val("Sesuai").trigger("change");

        $("#nama_diklat").val("");
        $("#jadwal").val("<?=date("Y-m");?>");
        $("#jam_pelajaran").val("");
        $("#anggaran").val("");

        action = "add";
        id_diklat = 0;
        reset_error();
    }

    function edit(id)
    {
      $("#kategori_diklat").val(rowData[id].kategori_diklat).trigger("change");
      $("#model_penyelenggara").val(rowData[id].model_penyelenggara).trigger("change");
      $("#nilai_kesenjangan").val(rowData[id].nilai_kesenjangan).trigger("change");
      $("#dpa").val(rowData[id].dpa).trigger("change");
      $("#kesesuaian").val(rowData[id].kesesuaian).trigger("change");

      $("#nama_diklat").val(rowData[id].nama_diklat);
      $("#jadwal").val(rowData[id].jadwal_df);
      $("#jam_pelajaran").val(rowData[id].jam_pelajaran);
      $("#anggaran").val(rowData[id].anggaran);

        //console.log(picture);
        reset_error();

        action = "edit";
        id_diklat = rowData[id].id_diklat;

    }

    function save()
    {

        reset_error();
        $("#popup_form").block({
            message: '<h4><img src="<?=base_url();?>asset/pixel/plugins/images/busy.gif" /> Mohon tunggu</h4>',
            css: {
                border: '1px solid #fff'
            }
        });

        var formdata = new FormData(document.getElementById('form-data'));
        formdata.append("<?=$this->security->get_csrf_token_name();?>",csrf_hash);
        formdata.append("action",action);
        formdata.append("id_diklat",id_diklat);
        $.ajax({
         url        : "<?=base_url()?>bangkom/diklat/save/",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){
            console.log(data);

            $('#popup_form').unblock();
            csrf_hash = data.csrf_hash;

            if(data.status){
                $('#popup_form').modal('toggle');
                loadPagination(1);
                swal("Berhasil", data.message, "success");
            }
            else{
                for(err in data.errors)
                {
                    $("#err_"+err).html(data.errors[err]);
										$("#err_"+err).show();

                }
                if(data.errors.length==0){
                    swal("Pesan", data.message, "warning");
                }
            }
         },
				 error: function(xhr, status, error) {
					//swal("Opps","Error","error");
					console.log(xhr);
				}
       });
    }
    function reset_error()
    {
			$(".text-danger").html("");
			$(".text-danger").hide();
    }

    function set_kategori()
    {
      var kategori = $("#kategori_diklat").val();
      if(kategori=="Pelatihan")
      {
          $("#row_jenis_pelatihan").show();
      }
      else{
          $("#row_jenis_pelatihan").hide();
      }
      $("#jenis_pelatihan").val("").trigger("change");
    }

    function set_penyelenggara()
    {
      var model = $("#model_penyelenggara").val();
      if(model=="Mandiri")
      {
          $("#row_penyelenggara").hide();
      }
      else{
          $("#row_penyelenggara").show();
      }
      $("#penyelenggara").val("");

    }


</script>
