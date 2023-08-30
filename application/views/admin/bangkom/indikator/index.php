<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Ref. Indikator Kompetensi</h4>
    </div>

		</div>

  <div class="row">


    <div class="col-md-12">
        <div class="white-box">


                        <div class="row ">

                            <div class="col-lg-12 col-md-9 col-sm-12 col-xs-12">
                                <div class="inbox-center">
                                    <div class="col-md-6 m-b-10">
                                        <button class="btn  btn-primary" onclick="add()" data-toggle="modal" data-target="#popup_form">
                                            <i class="ti-plus"> </i>
                                            Tambah indikator</button>

                                    </div>

                                    <div class="col-md-6">


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
                                                <button id="btn_jenis_kompetensi_" type="button" onclick="getJenis('','')" class="btn btn-primary btn-filter waves-effect">Semua</button>
                                                <?php
                                                $dt_jenis_kompetensi = $this->config->item("jenis_kompetensi");
                                                foreach ($dt_jenis_kompetensi as $key => $value) {
                                                  echo '<button id="btn_jenis_kompetensi_'.$key.'" type="button" onclick="getJenis('.$key.',\''.$value.'\')" class="btn btn-default btn-filter btn-outline waves-effect">'.$value.'</button>';
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
                                                            <a href='javascript:void(0)' onclick='get_jabatan("")'>Semua Jabatan</a>
                                                    </li>
                                                    <?php foreach ($this->config->item("eselon") as $key => $row) {
                                                       echo "
                                                       <li>
                                                            <a href='javascript:void(0)' onclick='get_jabatan(\"$row\")'>$row</a>
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
                                            <th>Indikator</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-center">Kompetensi</th>
                                            <th class="text-center">Jabatan</th>
                                            <th class="text-left">SKPD</th>
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
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Form</h4>
            </div>
            <form id="form-data">
               <div class="modal-body">

                  <div class="form-group row">
                     <label for="instansi" class="col-md-3 col-form-label text-right">SKPD</label>
                     <div class="col-md-8">
                        <select name="id_skpd" id="id_skpd" class="form-control select2" style="width: 100%" >
                          <option value="">Pilih</option>
                          <?php
                          foreach ($dt_skpd as $row) {
                            echo "<option value='$row->id_skpd'>$row->nama_skpd</option>";
                          }
                          ?>
                        </select>
												<label class="text-danger" id="err_id_skpd"></label>
                      </div>
                  </div>
                  <div class="form-group row">
                     <label for="jenis_kompetensi" class="col-md-3 col-form-label text-right">Kompetensi</label>
                     <div class="col-md-8">
                        <select name="jenis_kompetensi" id="jenis_kompetensi" class="select2 form-control" >
													<option value="">Pilih</option>
													<?php foreach ($this->config->item("jenis_kompetensi") as $key => $value) {
														echo "<option value='$value'>$value</option>";
													}
													?>
                        </select>
												<label class="text-danger" id="err_jenis_kompetensi"></label>
                      </div>
                  </div>
                  <div class="form-group row">
                     <label for="nama_kompetensi" class="col-md-3 col-form-label text-right">Unit Kompetensi</label>
                     <div class="col-md-8">
                        <input id="nama_kompetensi" type="text" class="form-control" name="nama_kompetensi" value=""  autofocus>
												<label class="text-danger" id="err_nama_kompetensi"></label>
                      </div>
                  </div>
                  <div class="form-group row">
                     <label for="indikator" class="col-md-3 col-form-label text-right">Indikator</label>
                     <div class="col-md-8">
                        <textarea id="indikator" type="text" rows="4" class="form-control" name="indikator" value=""  autofocus></textarea>
												<label class="text-danger" id="err_indikator"></label>
                      </div>
                  </div>
                  <div class="form-group row">
                     <label for="jabatan" class="col-md-3 col-form-label text-right">Untuk Jabatan</label>
                     <div class="col-md-8">
                        <select name="jabatan" id="jabatan" class="select2 form-control">
													<option value="">Pilih</option>
													<?php foreach ($this->config->item("eselon") as $key => $value) {
													 echo "<option value='$value'>$value</option>";
												 }
												 ?>
                        </select>
												<label class="text-danger" id="err_jabatan"></label>
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
    var id_indikator = 0;
    var jenis_kompetensi = "";
    var id_skpd = "";
    var jabatan = "";
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
         url        : "<?=base_url()?>bangkom/indikator/get_list/"+page_num,
         type       : 'post',
         dataType   : 'json',
         data       : {
            search     : search,
            jenis_kompetensi      : jenis_kompetensi,
            id_skpd : id_skpd,
            jabatan : jabatan,
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
            var indikator = data[i].indikator;
            var jenis_kompetensi = data[i].jenis_kompetensi;

            var nama_kompetensi = data[i].nama_kompetensi;
            var nama_skpd = (data[i].nama_skpd) ? data[i].nama_skpd : "";

            var id = data[i].id_indikator;
            var jabatan = data[i].jabatan;

            var tr = "<tr>";



            tr += "<td>";
            tr += "<div class='checkbox m-t-0 m-b-0'>";
            tr += "<input type='checkbox' class='checkbox' value='"+id+"' id='checkbox"+i+"' name='centang[]' >";
            tr += "<label for='checkbox"+i+"'></label>";
            tr += "</div>";
            tr += "</td>";
            tr += "<td class='max-texts'><strong>"+indikator+"</strong></td>";
            tr += "<td class='text-center'>"+jenis_kompetensi+"</td>";
            tr += "<td class='text-center'>"+nama_kompetensi+"</td>";
            tr += "<td class='text-center'>"+jabatan+"</td>";
            tr += "<td class='text-left'>"+nama_skpd+"</td>";
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
            $("#data tbody").append("<tr><td colspan='7' align='center'>- Tidak ada data -</td></tr>");
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

                ids[0] = rowData[i].id_indikator;
            }
        if(ids.length>0){
            swal({
                title: "Hapus Indikator ?",
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
                 url        : "<?=base_url()?>bangkom/indikator/delete/",
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

    function getJenis(i,jenis)
    {

        jenis_kompetensi = jenis;

        $(".btn-filter").attr("class","btn btn-default btn-outline btn-filter  waves-effect");
        $("#btn_jenis_kompetensi_"+i).attr("class","btn btn-primary btn-filter waves-effect");
        loadPagination(1);
    }

    function get_jabatan(jab)
    {

        jabatan = jab;
        loadPagination(1);
    }


    function resetform()
    {

        $("#fsearch").val("");

        getJenis("");
    }

    function add()
    {
        $(".modal-title").html("Tambah Indikator Kompetensi");
        $("#id_skpd").val("").trigger("change");
				$("#jenis_kompetensi").val("").trigger("change");
				$("#jabatan").val("").trigger("change");

        $("#nama_kompetensi").val("");
        $("#indikator").val("");

        action = "add";
        id_indikator = 0;
        reset_error();
    }

    function edit(id)
    {
        $(".modal-title").html("Edit Indikator Kompetensi");
        $("#id_skpd").val(rowData[id].id_skpd).trigger("change");
				$("#jenis_kompetensi").val(rowData[id].jenis_kompetensi).trigger("change");
				$("#jabatan").val(rowData[id].jabatan).trigger("change");

        $("#nama_kompetensi").val(rowData[id].nama_kompetensi);
        $("#indikator").val(rowData[id].indikator);

        //console.log(picture);
        reset_error();

        action = "edit";
        id_indikator = rowData[id].id_indikator;

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
        formdata.append("id_indikator",id_indikator);
        $.ajax({
         url        : "<?=base_url()?>bangkom/indikator/save/",
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


</script>
