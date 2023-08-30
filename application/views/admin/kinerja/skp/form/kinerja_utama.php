<div class="col-md-12">
    <div class="white-box">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center box-title m-b-0">KINERJA UTAMA</h3>
                <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                <p class="text-center text-dark"><?=($detail_skpd) ? $detail_skpd->nama_skpd : "";?></p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <?php if($role_pimpinan){
                                echo '
                                    <tr>
                                    <th width="5px">No</th>
                                    <th>Rencana Hasil Kerja / Sasaran</th>
                                    <th>Indikator Kinerja Individu</th>
                                    <th>Target</th>
                                    <th>Satuan</th>
                                    <th width="280px">Perspektif</th>
                                </tr>';
                            }
                            else{
                                echo '
                                <tr>
                                    <th width="5px">No</th>
                                    <th>Rencana Hasil Kinerja Pimpinan Yang Di Intervensi</th>
                                    <th width="300px">Rencana Hasil Kerja</th>
                                    <th width="280px">Aspek</th>
                                    <th>Kegiatan / Sub Kegiatan</th>
                                    <th>Indikator Kinerja Individu</th>
                                    <th>Target</th>
                                    <th>Satuan</th>
                                </tr>';
                            }
                            ?>
                            
                        </thead>
                        <tbody id="row-data-kinerja-utama">
                            

                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-12 text-center">
                <nav class="mt-4 mb-3">
                    <ul class="pagination justify-content-center mb-0" id="pagination-kinerja-utama">
                    </ul>
                </nav>
            </div>
        </div> -->
    </div>
</div>


<script type="text/javascript">
    
    
    loadDataKinerja();
    function loadDataKinerja() {
        $.ajax({
        url: "<?=base_url()?>kinerja/skp/kinerja_utama/get_data/" ,
        type: 'post',
        dataType: 'json',
        data: {
           tahun : $("#tahun").val(),
           id_skp : "<?=!empty($detail) ? $detail->id_skp : "";?>",
        },
        success: function (data) {
            console.log(data);
            //rowData = data.result;
            $("#row-data-kinerja-utama").html(data.content);
            //$("#pagination-kinerja-utama").html(data.pagination);
            $(".kinerja_utama").select2("destroy").select2();
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            //swal("Opps", "Terjadi kesalahan", "error");
        }
        });
    }
</script>