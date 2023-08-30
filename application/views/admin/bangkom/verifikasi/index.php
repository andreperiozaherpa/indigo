<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Verifikasi PYB</h4>
    </div>

		</div>

  <div class="row">


    <div class="col-md-12">
        <div class="white-box">


                        <div class="row ">

                            <div class="col-lg-12 col-md-9 col-sm-12 col-xs-12">
                                <div class="inbox-center">


                                    <table class="table table-hover" id="data">
                                    <thead>

                                    <tr>

                                        <th colspan="3">
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
                                            <th class="text-center">#</th>
                                            <th>Jenis PK</th>
                                            <th class="text-center">Bentuk PK</th>
                                            <th class="text-center">Untuk Nilai Kesenjangan</th>
                                            <th class="text-center">Jumlah Peserta Yang Direkomendasikan (orang)</th>
                                            <th class="text-center">Jumlah Peserta Yang Ikut (orang)</th>
                                            <th class="text-center">Detail Peserta</th>
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
         url        : "<?=base_url()?>bangkom/verifikasi/get_list/"+page_num,
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
						var id_diklat = data[i].id_diklat;
            var nama_diklat = data[i].nama_diklat;
            var kategori_diklat = data[i].kategori_diklat;
            var kesenjangan = data[i].nilai_kesenjangan;
            var id = data[i].id_diklat;
            if(data[i].jenis_pelatihan){
              kategori_diklat += " - "+data[i].jenis_pelatihan;
            }
            var tr = "<tr>";

            tr += "<td class='text-center'>"+row+"</td>";
            tr += "<td class='max-texts'><strong>"+nama_diklat+"</strong></td>";
            tr += "<td class='text-center'>"+kategori_diklat+"</td>";
            tr += "<td class='text-center'>"+kesenjangan+"</td>";
            tr += "<td class='text-center'>"+data[i].jumlah_rekomendasi+"</td>";
            tr += "<td class='text-center'>"+data[i].jumlah_ikut+"</td>";
            tr += "<td>";

            tr += '<div class="btn-group">';
            tr += '<button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-circle btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="icon-options-vertical"></i></button>';
            tr += '<ul role="menu" class="dropdown-menu">';

            var max_thn = <?=(date("Y") + 1);?>;
            for(thn=2020;thn<= max_thn;thn++){
                tr += '<li><a href="<?=base_url();?>bangkom/verifikasi/detail/'+thn+'/'+id_diklat+'" >Tahun '+thn+'</a></li>';
            }



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






</script>
