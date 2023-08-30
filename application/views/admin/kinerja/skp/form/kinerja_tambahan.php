<div class="col-md-12">
    <div class="white-box">
        <div class="row">
            <div class="col-md-12">
            <h3 class="text-center box-title m-b-0">KINERJA TAMBAHAN</h3>
                <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                <p class="text-center text-dark"><?=($detail_skpd) ? $detail_skpd->nama_skpd : "";?></p>
                <div class="table-responsive">
                <a class="btn btn-default btn-outline pull-right" onclick="add_kinerja_tambahan()"><i class="fa fa-plus"></i> Tambah</a>                            
                    <table class="table table-striped">
                        <thead>
                            <?php if($role_pimpinan){
                                echo '
                                    <tr>
                                    <th>Rencana Hasil Kerja</th>
                                    <th>Indikator Kinerja Individu</th>
                                    <th>Target</th>
                                    <th>Satuan</th>
                                    <th width="280px">Perspektif</th>
                                    <th width="100px">Aksi</th>
                                </tr>';
                            }
                            else{
                                echo '
                                <tr>
                                    <th>Rencana Hasil Kinerja Pimpinan Yang Di Intervensi</th>
                                    <th>Rencana Hasil Kerja</th>
                                    <th width="280px">Aspek</th>
                                    <th>Indikator Kinerja Individu</th>
                                    <th>Target</th>
                                    <th>Satuan</th>
                                    <th width="100px">Aksi</th>
                                </tr>';
                            }
                            ?>
                            
                        </thead>
                        <tbody id="row-data-kinerja-tambahan">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<div id="modal-kinerja-tambahan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a type="button" class="close" data-dismiss="modal" aria-hidden="true">×</a>
                <h4 class="modal-title">Kinerja Tambahan</h4>
            </div>
            <div class="modal-body">
                
                    <?php if(!$role_pimpinan) :?>
                    <div class="form-group">
                        <label for="rencana_hasil_kerja_atasan" class="control-label">Rencana Hasil Kinerja Pimpinan Yang Di Intervensi</label>
                        <input type="text" class="form-control input_text" id="rencana_hasil_kerja_atasan"  placeholder="Masukan Rencana Kinerja Atasan">
                        <div class="text-danger error" id="err_rencana_hasil_kerja_atasan"></div>
                    </div>
                    <?php endif?>
                    <div class="form-group">
                        <label for="rencana_hasil_kerja" class="control-label">Rencana Hasil Kerja</label>
                        <input type="text" class="form-control input_text" id="rencana_hasil_kerja"  placeholder="Masukan Rencana Kerja">
                        <div class="text-danger error" id="err_rencana_hasil_kerja"></div>
                    </div>
                    <div class="form-group">
                        <label for="indikator_kinerja_individu" class="control-label">Indikator Kinerja Individu</label>
                        <input type="text" class="form-control input_text" id="indikator_kinerja_individu"  placeholder="Masukan nama indikator">
                        <div class="text-danger error" id="err_indikator_kinerja_individu"></div>
                    </div>
                    <div class="form-group">
                        <label for="target" class="control-label">Target</label>
                        <input type="text" class="form-control input_text" id="target"  placeholder="Masukan Target">
                        <div class="text-danger error" id="err_target"></div>
                    </div>
                    <div class="form-group">
                        <label for="satuan" class="control-label">Satuan</label>
                        <select class="form-control select2" id="satuan" >
                            <option value="">Pilih</option>
                            <?php foreach($dt_satuan as $row)
                            {
                                echo '<option value="'.$row->id_satuan.'">'.$row->satuan.'</option>';
                            }
                            ?>
                        </select>
                        <div class="text-danger error" id="err_satuan"></div>
                    </div>
                    

                
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</a>
                <a type="button" class="btn btn-primary waves-effect waves-light" onclick="submit_kinerja_tambahan()">Submit</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    let role_pimpinan = "<?= ($role_pimpinan) ? 'Y' : 'N' ;?>";

    let perspektif = JSON.parse('<?= json_encode($this->Config->perspektif) ;?>');
    let aspek = JSON.parse('<?= json_encode($this->Config->aspek) ;?>');

    let n=1;
    
    let row = 0;

    function add_kinerja_tambahan()
    {
        $(".error").html("");
        $(".input_text").val("");
        $("#satuan").val("").trigger("change");
        
        row = 0;
        $("#modal-kinerja-tambahan").modal("show");
    }

    function edit_kinerja_tambahan(i,rencana_hasil_kerja,indikator_kinerja_individu,target,satuan,rencana_hasil_kerja_atasan=null)
    {
        
        $(".error").html("");
        $("#satuan").val(satuan).trigger("change");
        $("#rencana_hasil_kerja").val(rencana_hasil_kerja);
        $("#indikator_kinerja_individu").val(indikator_kinerja_individu);
        $("#target").val(target);
        if(rencana_hasil_kerja_atasan)
        {
            $("#rencana_hasil_kerja_atasan").val(rencana_hasil_kerja_atasan);
        }
        row = i;
        $("#modal-kinerja-tambahan").modal("show");
    }

    function submit_kinerja_tambahan()
    {
        $("#row-kinerja-tambahan-empty").remove();

        let rencana_hasil_kerja = $("#rencana_hasil_kerja").val();
        let rencana_hasil_kerja_atasan = $("#rencana_hasil_kerja_atasan").val();
        let indikator_kinerja_individu = $("#indikator_kinerja_individu").val();
        let target = $("#target").val();
        let satuan = $("#satuan").val();

        var satuan_desc = $('#satuan option:selected').text();

        if(row==0)
        {
            let content ='<tr id="row-kinerja-tambahan-'+n+'">';

            if(role_pimpinan=="Y")
            {
                content += '<td><label id="label_rencana_hasil_kerja_'+n+'">'+rencana_hasil_kerja+'</label></td>';
                content += '<td><label id="label_indikator_kinerja_individu_'+n+'">'+indikator_kinerja_individu+'</label></td>';
                content += '<td><label id="label_target_'+n+'">'+target+'</label></td>';
                content += '<td><label id="label_satuan_'+n+'">'+satuan_desc+'</label></td>';
                content += '<td><select class="form-control_ kinerja_tambahan_'+n+'" multiple name="kinerja_tambahan[perspektif]['+n+'][]">'
                for(i in perspektif)
                {
                    content += '<option value="'+perspektif[i]+'">'+perspektif[i]+'</option>';
                }
                content += '</select></td>';
            }
            else{
                content += '<td><label id="label_rencana_hasil_kerja_atasan_'+n+'">'+rencana_hasil_kerja_atasan+'</label></td>';
                content += '<td><label id="label_rencana_hasil_kerja_'+n+'">'+rencana_hasil_kerja+'</label></td>';
                content += '<td><select class="form-control_ kinerja_tambahan_'+n+'" multiple name="kinerja_tambahan[aspek]['+n+'][]">'
                for(i in aspek)
                {
                    content += '<option value="'+aspek[i]+'">'+aspek[i]+'</option>';
                }
                content += '</select></td>';
                content += '<td><label id="label_indikator_kinerja_individu_'+n+'">'+indikator_kinerja_individu+'</label></td>';
                content += '<td><label id="label_target_'+n+'">'+target+'</label></td>';
                content += '<td><label id="label_satuan_'+n+'">'+satuan_desc+'</label></td>';
                
            }



            content += '<td>'
                    + '<input type="hidden" id="rencana_hasil_kerja_'+n+'" value="'+rencana_hasil_kerja+'" name="kinerja_tambahan[rencana_hasil_kerja]['+n+']" />'
                    + '<input type="hidden" id="rencana_hasil_kerja_atasan_'+n+'" value="'+rencana_hasil_kerja_atasan+'" name="kinerja_tambahan[rencana_hasil_kerja_atasan]['+n+']" />'
                    + '<input type="hidden" id="indikator_kinerja_individu_'+n+'" value="'+indikator_kinerja_individu+'" name="kinerja_tambahan[indikator_kinerja_individu]['+n+']" />'
                    + '<input type="hidden" id="target_'+n+'" value="'+target+'" name="kinerja_tambahan[target]['+n+']" />'
                    + '<input type="hidden" id="satuan_'+n+'" value="'+satuan+'" name="kinerja_tambahan[satuan]['+n+']" />'
                    + '<div class="btn-group m-b-20" id="btn_kinerja_tambahan_'+n+'">'
                    + '<a onclick="edit_kinerja_tambahan('+n+',\''+rencana_hasil_kerja+'\',\''+indikator_kinerja_individu+'\',\''+target+'\',\''+satuan+'\',\''+rencana_hasil_kerja_atasan+'\')" '
                    + 'type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-pencil"></i></a>'
                    + '<a onclick="delete_kinerja_tambahan('+n+')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-trash"></i></a>'
                    + '</div>'
                    + '</td>';
            
            content +='</tr>';
            $("#row-data-kinerja-tambahan").append(content);
            $(".kinerja_tambahan_"+n).select2("destroy").select2();
            n++;
        }
        else{
            $("#label_rencana_hasil_kerja_"+row).html(rencana_hasil_kerja);
            $("#label_rencana_hasil_kerja_atasan_"+row).html(rencana_hasil_kerja_atasan);
            $("#label_indikator_kinerja_individu_"+row).html(indikator_kinerja_individu);
            $("#label_target_"+row).html(target);
            $("#label_satuan_"+row).html(satuan_desc);

            $("#rencana_hasil_kerja_"+row).val(rencana_hasil_kerja);
            $("#rencana_hasil_kerja_atasan_"+row).val(rencana_hasil_kerja_atasan);
            $("#indikator_kinerja_individu_"+row).val(indikator_kinerja_individu);
            $("#target_"+row).val(target);
            $("#satuan_"+row).val(satuan);

            var btn_action = '<a onclick="edit_kinerja_tambahan('+row+',\''+rencana_hasil_kerja+'\',\''+indikator_kinerja_individu+'\',\''+target+'\',\''+satuan+'\',\''+rencana_hasil_kerja_atasan+'\')" '
                    + 'type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-pencil"></i></a>'
                    + '<a onclick="delete_kinerja_tambahan('+row+')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-trash"></i></a>';

            $("#btn_kinerja_tambahan_"+row).html(btn_action);
        }

        $("#modal-kinerja-tambahan").modal("hide");

        
    }


    function delete_kinerja_tambahan(i)
    {
        $("#row-kinerja-tambahan-"+i).remove();
    }
    

    loadDataKinerjaTambahan();
    function loadDataKinerjaTambahan() {
        $.ajax({
        url: "<?=base_url()?>kinerja/skp/kinerja_tambahan/get_data/" ,
        type: 'post',
        dataType: 'json',
        data: {
           id_skp : "<?=!empty($detail) ? $detail->id_skp : "";?>",
        },
        success: function (data) {
            n = data.n;
            $("#row-data-kinerja-tambahan").html(data.content);
            $(".kinerja_tambahan").select2("destroy").select2();
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            //swal("Opps", "Terjadi kesalahan", "error");
        }
        });
    }
</script>