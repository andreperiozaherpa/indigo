<div class="container-fluid">

<div class="row bg-title">
  <!-- .page title -->
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"> Evaluasi terhadap Hasil RPJMD </h4>
  </div>
  <!-- /.page title -->
  <!-- .breadcrumb -->
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

    <ol class="breadcrumb">
      <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
      <li class="active">Evaluasi  RPJMD</li>
    </ol>
  </div>
  <!-- /.breadcrumb -->
</div>

<div class="row">
  <div class="col-md-12">
    <div class="white-box">
      <div class="row">
        <div class="col-md-10">
          <div class="form-group">
            <label>Nama SKPD </label>
            <select class="form-control select2" id="id_skpd" onchange="loadData()">
              <?php foreach($dt_skpd->result() as $row)
              {
                $selected = ($this->input->get("id_skpd")==$row->id_skpd) ? "selected" : "";
                echo '<option '.$selected.' value="'.$row->id_skpd.'">'.$row->nama_skpd.'</option>';
              }
              ?>
            </select>
          </div>
        </div>

        <div class="col-md-2">
        <label>&nbsp;</label>
          <button class="btn btn-block btn-default btn-outline" onclick="download()">Download Excel</button>
        </div>

      </div>

    </div>
  </div>

</div>
<style>
  #rpjmd_perencanaan th 
  {
    text-align: center; 
    vertical-align: middle;
    background-color: #55a3a7; 
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="white-box responsive" style="overflow-x: auto;" id="row-data">
    </div>
  </div>
  <!-- <div class="col-md-12">
    <div class="white-box">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Interval Nilai Realisasi Kinerja</th>
            <th>Kriteria Penilaian Realisasi Kinerja</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>(1)</td>
            <td>91% &le; 100%</td>
            <td>Sangat Tinggi</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div> -->
</div>  



<script type="text/javascript">
    var isloading = false;
    
    loadData();

    function loadData() {
        
        if(!isloading)
        {
          $("#row-data").html("<p>Sedang memuat ...</p>");
            isloading = false;
            $.ajax({
                url: "<?=base_url()?>sievka/evaluasi/rpjmd/get_data/",
                type: 'post',
                dataType: 'json',
                data: {
                    id_skpd: $("#id_skpd").val(),
                },
                success: function (data) {
                    //console.log(data);
                    $("#row-data").html(data.content);
                    isloading = false;
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    swal("Opps", "Terjadi kesalahan", "error");
                    isloading = false;
                }
            });
        }
    }

    
    function download()
    {
        var id_skpd = $("#id_skpd").val();
        
        var link = "<?=base_url();?>sievka/evaluasi/rpjmd/download?id_skpd="+id_skpd;
        window.open(link,"_blank");
    }
</script>