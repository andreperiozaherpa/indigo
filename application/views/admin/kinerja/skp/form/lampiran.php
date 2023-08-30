<div class="col-md-12">
    <div class="white-box">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center box-title m-b-0">LAMPIRAN SASARAN KINERJA PEGAWAI</h3>
                <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                <p class="text-center text-dark"><?=($detail_skpd) ? $detail_skpd->nama_skpd : "";?></p>
                <div class="table-responsive">

                    <?php foreach($this->Config->jenis_lampiran as $key => $jenis_lampiran) :?>
                 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><?=$jenis_lampiran;?></th>
                                <th width="50px">
                                </th>
                            </tr>
                        </thead>
                        <tbody id="row-data-lampiran-<?=$key;?>">
                            
                        </tbody>

                        
                    </table>
                    <a class="btn btn-default  btn-outline btn-sm" onclick="add_lampiran(<?=$key;?>)"><i class="fa fa-plus"></i> Tambah</a>   
                    <hr>
                    
                    <?php endforeach;?>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let num_rows = [];
    function add_lampiran(i)
    {
        if(!num_rows[i])
        {
            num_rows[i] = 1;
        }
        num_rows[i]++;
        let content = '<tr id="row-lampiran-'+i+'_'+num_rows[i]+'">'
        +'<td><input type="hidden" value="0" id="lampiran_id_lampiran'+i+'_'+num_rows[i]+'" name="lampiran[id_lampiran]['+i+'][]" />'
        +'<textarea class="form-control" name="lampiran[nama_lampiran]['+i+'][]"></textarea></td>'
        +'<td>'
        +'<div class="btn-group m-b-20">'
        +'<a onclick="delete_lampiran('+i+','+num_rows[i]+')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-trash"></i></a>'
        +'</div>'
        +'</td>'
        +'</tr>';

        $("#row-data-lampiran-"+i).append(content);
    }
    function delete_lampiran(i,row)
    {
        $("#row-lampiran-"+i+"_"+row).remove();
    }

    loadLampiran();

    function loadLampiran() {

        $.ajax({
            url: "<?=base_url()?>kinerja/skp/lampiran/get_data",
            type: 'post',
            dataType: 'json',
            data: {
                id_skp: "<?=(!empty($detail)) ? $detail->id_skp : "";?>",
            },
            success: function (data) {
                
                for(i in data.content)
                {
                    $("#row-data-lampiran-"+i).html(data.content[i]);
                    if(data.dt_lampiran[i])
                    {
                        num_rows[i] = data.dt_lampiran[i].length;
                    }
                    
                    //console.log(data.dt_lampiran[i].length);
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                //swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }
    
</script>