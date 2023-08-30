<div id="main-content" class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Perencanaan</h4>
        </div>

        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-md-12">

            <div class="white-box">

                <div class="panel panel-default">
                    <div class="panel-heading">Detail Kegiatan</div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <div class="row">

                                    <div class="col-md-12" style="">

                                        <div class="form-group">
                                            <label class="col-md-12">Tahun Periode</label>
                                            <div class="col-md-12">
                                                <span><?=$detail->tahun;?></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Program</label>
                                            <div class="col-md-12">

                                                <span><?= $detail->kode_program.' '.$detail->nama_program;?></span>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Kegiatan</label>
                                            <div class="col-md-12">
                                            <span><?= $detail->kode_kegiatan.' '.$detail->nama_kegiatan;?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Sub-Kegiatan</label>
                                            <div class="col-md-12">
                                            <span><?= $detail->kode_sub_kegiatan.' '.$detail->nama_sub_kegiatan;?></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12">Output Sub-Kegiatan</label>
                                            <div class="col-md-12">
                                                <span><?=$detail->output_kegiatan;?></span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12" style="">


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12">Target</label>
                                                    <div class="col-md-12">
                                                    <span><?=$detail->target;?> <?=$detail->satuan;?></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12">Sumber Anggaran</label>
                                            <div class="col-sm-12">

                                            <span><?=$detail->nama_sumber_anggaran;?></span>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Total Anggaran</label>
                                            <div class="col-md-12">
                                                <span>Rp. <?=number_format($detail->rencana_anggaran);?></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Kelompok Sasaran</label>
                                            <div class="col-md-12">
                                            <span><?=$detail->sasaran;?></span>
                                            </div>
                                        </div>


                                    </div>

                            </form>


                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="white-box">
            <div class="panel panel-default">
                <div class="panel-heading">Pengalokasian Anggaran</div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Aktivitas</th>
                                    <th>Output</th>
                                    <th>Kelompok sasaran</th>
                                    <th>Sumber Anggaran</th>
                                    <th>Target</th>
                                    <th>Harga Satuan</th>
                                    <th>Satuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="row_alokasi_anggaran">
                                            <?php foreach($dt_alokasi_anggaran as $key => $row)
                                            {
                                                echo '
                                                    <tr>
                                                        <td>'.$row->nama_kegiatan.'</td>
                                                        <td>'.$detail->output_kegiatan.'</td>
                                                        <td>'.$detail->sasaran.'</td>
                                                        <td>'.$detail->nama_sumber_anggaran.'</td>
                                                        <td>'.$row->jumlah.'</td>
                                                        <td>'.number_format($row->harga).'</td>
                                                        <td>'.$row->satuan.'</td>
                                                        <td>'.number_format($row->total).'</td>
                                                    </tr>
                                                ';
                                            }
                                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="white-box">
            <div class="row ">
                <h3>Penerima (<span id="total_penerima">0</span> Orang)</h3>

                <div class="col-md-4" style="padding:0px;margin-bottom:10px">
                    <select class="form-control select2" id="kdkec_penerima" onchange="get_desa('penerima')">
                        <option value="">Semua Kecamatan</option>
                        <?php 
                        foreach($dt_kecamatan as $row){
                            echo '<option value="'.$row->id_kecamatan.'">'.$row->kecamatan.'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4" style="padding:0px 0px 0px 10px;margin-bottom:10px;">
                    <select class="form-control select2" id="kddesa_penerima" onchange="loadPagination(1)">
                        <option value="">Semua Desa</option>
                    </select>
                </div>
                <div class="col-md-4" style="padding:0px 0px 0px 10px;margin-bottom:10px;">
                    <input id="search_penerima" onkeyup="loadPagination(1)" type="text" class="form-control"
                        placeholder="Cari nama atau NIK" />
                </div>

                
                

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12" style="margin-top:10px">
                                <div id="range_usia_1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <?php foreach($dt_sasaran as $key=>$val):?>
                            <div class="col-md-2" style="margin-top:10px">
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary">
                                        <input onclick="loadPagination(1)" id="penerima_jenis_bantuan_<?=$val;?>"
                                            name="penerima_jenis_bantuan[]" type="checkbox">
                                        <label for="penerima_jenis_bantuan_<?=$val;?>"> <?=$val;?> </label>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div style="margin-top:10px">
                            <button onclick="set_rts_penerima('')"
                                class="btn btn-default btn-xs btn-rounded btn-outline">Semua</button>
                                <?php foreach($dt_rts as $key => $value)
                                {
                                    echo '<button onclick="set_rts_penerima(\''.$value.'\')" class="btn btn-default btn-xs btn-rounded btn-outline">'.$value.'</button>&nbsp;';
                                }
                                ?>
                        </div>
                    </div>
                </div>


               
            </div>
            <div class="table-responsive">
                <table class="table m-t-30" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Karektistik RTS</th>
                            <th style="text-align:center">Bant. KKS</th>
                            <th style="text-align:center">Bant. PBI</th>
                            <th style="text-align:center">Bant. PKH</th>
                            <th style="text-align:center">Bant. KIP</th>
                            <th style="text-align:center">Bant. BPNT</th>
                            <th style="text-align:center">Opsi</th>

                        </tr>
                    </thead>
                    <tbody id="row-penerima" >
                        
                    </tbody>
                </table>

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

            <button class="btn btn-danger" onclick="hapus()">Hapus</button>
            <a href="<?=base_url();?>sigesit/kegiatan/edit/<?=$token;?>" class="btn btn-success" >Edit</a>
            <a href="<?=base_url();?>sigesit/perencanaan/detail/<?=md5("SKPD".$detail->id_skpd);?>" class="btn btn-default" >Kembali</a>
        </div>
    </div>

<div class="modal fade" id="detailPenerima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Detail Penerima</h4>
            </div>
            <div class="modal-body">
                <div id="row_detail_penerima">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>

<script>
    var page_penerima = 1;
    var rts_penerima = '';

    function loadPagination(page_num) {

        page_penerima = page_num;
        var usia = $("#range_usia_1").data();
        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/get_penerima/" + page_num,
            type: 'post',
            dataType: 'json',
            data: {
                search: $("#search_penerima").val(),
                kdkec: $("#kdkec_penerima").val(),
                kddesa: $("#kddesa_penerima").val(),
                rts: rts_penerima,
                id_kegiatan : '<?=$detail->id_kegiatan;?>',

                usia_1 : usia.from,
                usia_2 : usia.to,
                kks : ($("#penerima_jenis_bantuan_KKS").prop("checked")==true) ? 1 : 0,
                pbi : ($("#penerima_jenis_bantuan_PBI").prop("checked")==true) ? 1 : 0,
                kip : ($("#penerima_jenis_bantuan_KIP").prop("checked")==true) ? 1 : 0,
                pkh : ($("#penerima_jenis_bantuan_PKH").prop("checked")==true) ? 1 : 0,
                bpnt : ($("#penerima_jenis_bantuan_BPNT").prop("checked")==true) ? 1 : 0,
            },
            success: function (data) {
                $("#row-penerima").html(data.content);
                $("#pagination2").html(data.pagination);
                $("#total_penerima").html(data.total_rows);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function get_desa(flag) {
        $("#kddesa_" + flag).val("").trigger("change");
        $.ajax({
            url: "<?=base_url()?>sigesit/kegiatan/get_desa",
            type: 'post',
            dataType: 'json',
            data: {
                id: $("#kdkec_" + flag).val(),
            },
            success: function (data) {
                //console.log(data);
                $("#kddesa_" + flag).html(data.content);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }

    function set_rts_penerima(rts) {
        rts_penerima = rts;
        loadPagination(1);
    }

    function hapus() {
    swal({
      title: "Hapus kegiatan ?",
      //text: "Apakah anda yakin akan menghapus data ini?",
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
          url: "<?=base_url()?>sigesit/kegiatan/delete",
          type: 'post',
          dataType: 'json',
          data: {
            id: '<?=$detail->id_kegiatan;?>',
          },
          success: function (data) {
            //console.log(data);
            if (data.status == true) {
              swal({
                type: 'success',
                title: 'Berhasil',
                text: data.message,
                showConfirmButton: false,
                timer: 1500
              });

              setTimeout(() => {
                  window.location = "<?=base_url();?>sigesit/perencanaan/detail/<?=md5("SKPD".$detail->id_skpd);?>";
              }, 1000);
            } else {
              swal("Opps", data.message, "error");
            }
          },
          error: function (xhr, status, error) {
            //swal("Opps","Error","error");
            console.log(xhr);
          }
        });
      }
    });
   }

   function detail_penerima(id_dtks)
    {
        $.ajax({
            url: "<?=base_url()?>sigesit/penerima/detail_penerima",
            type: 'post',
            dataType: 'json',
            data: {
                id_dtks: id_dtks,
            },
            success: function (data) {
                if(data.status==true)
                {
                    $("#row_detail_penerima").html(data.content);
                    $("#detailPenerima").modal();
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                swal("Opps", "Terjadi kesalahan", "error");
            }
        });
        
    }
</script>