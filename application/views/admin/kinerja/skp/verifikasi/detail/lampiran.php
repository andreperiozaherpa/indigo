<div class="col-md-12">
    <div class="white-box">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center box-title m-b-0">LAMPIRAN SASARAN KINERJA PEGAWAI</h3>
                <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                <p class="text-center text-dark"><?=$detail->nama_skpd;?></p>
                <div class="table-responsive">

                    
                    <table class="table table-striped" id="row-data-lampiran">
                        

                        
                    </table>
                    
                   
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    
    
    loadLampiran();

    function loadLampiran() {

        $.ajax({
            url: "<?=base_url()?>kinerja/skp/detail/lampiran/get_data",
            type: 'post',
            dataType: 'json',
            data: {
                id_skp: "<?=$detail->id_skp;?>",
                verifikasi: true,
            },
            success: function (data) {

                $("#row-data-lampiran").html(data.content);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                //swal("Opps", "Terjadi kesalahan", "error");
            }
        });
    }
</script>