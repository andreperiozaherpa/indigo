<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Verifikasi SKP</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><?=$this->Config->app_name;?></li>
                <li>SKP</li>
                <li class="active">Verifikasi</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pencarian</label>
                            <input type="text" class="form-control" id="search" onkeyup="loadPagination(1)" placeholder="Cari nama, NIP" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control select2" id="tahun" onchange="loadPagination(1)">
                                <option value="">Semua</option>
                                <?php foreach($this->Globalvar->get_tahun() as $key=>$value)
                                {
                                    $i = $key + 1;
                                    $selected = (date("Y")==$value) ? "selected" : "" ;
                                    echo '<option '.$selected.' value="'.$i.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status </label>
                            <select class="form-control select2" id="status" onchange="loadPagination(1)">
                                <option value="">Semua</option>
                                <?php foreach($this->Config->status_skp as $key=>$value)
                                {
                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
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
        url: "<?=base_url()?>kinerja/skp/verifikasi/get_list/" + page_num,
        type: 'post',
        dataType: 'json',
        data: {
            status: $("#status").val(),
            tahun : $("#tahun").val(),
            search: $("#search").val()
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