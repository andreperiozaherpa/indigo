<div class="col-md-12">
    <div class="white-box">
        <div class="row">
            <div class="col-md-12">
            <h3 class="text-center box-title m-b-0">KINERJA TAMBAHAN</h3>
                <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                <p class="text-center text-dark"><?=$detail->nama_skpd;?></p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <?php if($role_pimpinan){
                                echo '
                                    <tr>
                                    <th width="5px">No</th>
                                    <th>Rencana Hasil Kerja</th>
                                    <th>Indikator Kinerja Individu</th>
                                    <th>Target</th>
                                    <th>Satuan</th>
                                    <th>Perspektif</th>
                                    <th>Realisasi</th>
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
                                    <th>Indikator Kinerja Individu</th>
                                    <th>Target</th>
                                    <th>Satuan</th>
                                    <th>Realisasi</th>
                                    <th width="300px">Umpan balik</th>
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

<script type="text/javascript">
    
    
    loadDataKinerjaTambahan();

    function loadDataKinerjaTambahan() {

        $.ajax({
            url: "<?=base_url()?>kinerja/skp/detail/kinerja_tambahan/get_data",
            type: 'post',
            dataType: 'json',
            data: {
                id_skp: "<?=$detail->id_skp;?>",
                evaluasi: true,
                triwulan : '<?=$triwulan;?>'
            },
            success: function (data) {

                $("#row-data-kinerja-tambahan").html(data.content);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script>