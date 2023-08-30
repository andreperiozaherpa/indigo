<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">SKP</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>SKP</li>
                <li class="active">Riwayat</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row" style="margin-bottom:50px">
        <div class="col-md-12">
            <a href="<?=base_url();?>kinerja/skp/form" class="btn btn-primary pull-right_"><i class=" icon-pencil"></i> Buat SKP Baru</a>
            <a href="<?=base_url();?>kinerja/skp/riwayat/detail" class="btn btn-primary btn-outline"><i class=" icon-clock"></i> Lihat Riwayat</a>
        </div>
    </div>


    <div class="row" id="row-data">
        
        
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


<script>
var page = 1;
function loadPagination(page_num) {

    page = page_num;
    
    $.ajax({
        url: "<?=base_url()?>kinerja/skp/riwayat/get_list/" + page_num,
        type: 'post',
        dataType: 'json',
        data: {

        },
        success: function (data) {
            //console.log(data);
            $("#row-data").html(data.content);
            $("#pagination").html(data.pagination);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
        }
    });
}

</script>