<div class="col-md-12">
    <div class="white-box">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center box-title m-b-0">Perilaku Kerja/Behavior</h3>
                <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                <p class="text-center text-dark"><?=($detail_skpd) ? $detail_skpd->nama_skpd : "";?></p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody id="row-data-perilaku">
                            

                            
                        </tbody>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    
    
    loadPerilaku();
    function loadPerilaku() {
        
        $.ajax({
        url: "<?=base_url()?>kinerja/skp/perilaku/get_data/" ,
        type: 'post',
        dataType: 'json',
        data: {
            id_skp : "<?=!empty($detail) ? $detail->id_skp : "";?>",
        },
        success: function (data) {
            
            $("#row-data-perilaku").html(data.content);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            //swal("Opps", "Terjadi kesalahan", "error");
        }
        });
    }
</script>