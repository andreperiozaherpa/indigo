<div class="col-md-12">
    <div class="white-box">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center box-title m-b-0">KINERJA UTAMA</h3>
                <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                <p class="text-center text-dark"><?=$detail->nama_skpd?></p>
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
                                    <th>Perspektif</th>
                                    <th width="300px">Umpan balik</th>
                                </tr>';
                            }
                            else{
                                echo '
                                <tr>
                                    <th width="5px">No</th>
                                    <th>Rencana Hasil Kinerja Pimpinan Yang Di Intervensi</th>
                                    <th>Rencana Hasil Kerja</th>
                                    <th>Aspek</th>
                                    <th>Kegiatan / Sub Kegiatan</th>
                                    <th>Indikator Kinerja Individu</th>
                                    <th>Target</th>
                                    <th>Satuan</th>
                                    <th width="300px">Umpan balik</th>
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
        url: "<?=base_url()?>kinerja/skp/detail/kinerja_utama/get_data",
            type: 'post',
            dataType: 'json',
            data: {
                id_skp: "<?=$detail->id_skp;?>",
                verifikasi: true,
            },
            success: function (data) {
                console.log(data);
                $("#row-data-kinerja-utama").html(data.content);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>