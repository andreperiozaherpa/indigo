 <style type="text/css">
 .checkbox, .radio{
  margin: 0;
}
</style>
<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Rencana Kerja Anggaran</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
       <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li><a href="<?= base_url();?>ref_rka">Rencana Kerja Anggaran</a></li>
        <li class="active">add</li>
      </ol>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  
  <!-- .row -->

  <div class="row">  
    <?php if (!empty($message)) echo "
    <div class='alert alert-$message_type'>$message</div>";?>
    <form method="POST">

      <div class="col-md-4">
        <div class="white-box">

         <div class="form-group">
          <label class="control-label">Tahun</label>
          <select onchange="getMaster()" id="tahun" name="tahun" class="form-control">
            <option value="">Pilih Tahun</option>
            <?php 
            $tahun = date('Y');
            for ($i=2018; $i <= 2023 ; $i++) { 
              echo'<option value="'.$i.'">'.$i.'</option>';
            }
            ?>
          </select>
        </div>
        <?php
        if($user_level=='Administrator'){
          if($this->uri->segment(4)=='master'){
            ?>

            <input type="hidden" name="id_unit_kerja" value="0">
            <?php
          }else{
            ?>
            <div class="row">
             <div class="form-group">
               <div class="col-md-12">
                <label class="control-label">Unit Kerja </label>
                <select name="id_unit_kerja" class="form-control">
                  <option value="">Pilih Unit Kerja</option>
                  <?php 
                  foreach($unit_kerja as $r){
                    if($item->id_unit_kerja==$r->id_unit_kerja){
                      $selected = ' selected';
                    }else{
                      $selected = '';
                    }
                    echo'<option value="'.$r->id_unit_kerja.'"'.$selected.'>'.$r->nama_unit_kerja.'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        <?php }
      }else{
        ?>
        <input type="hidden" name="id_unit_kerja" value="<?=$this->session->userdata('unit_kerja_id')?>">
        <?php
      }
      ?>


    </div>
    <div class="pull-right">
      <a href="<?=base_url('ref_rka')?>" class="btn btn-default ">Batal</a>
      <button type="submit" class="btn btn-primary ">Simpan</button>
    </div>
  </div>

  <div class="col-md-8">
    <div class="white-box">


      <div class="table-responsive">
        <table class="table" id="table">
          <thead>
            <tr>
              <th style="text-align: center">Kode</th>
              <th style="text-align: center">Pagu</th>
              <th style="text-align: center">Program / Kegiatan</th>
              <th style="text-align: center">
                <div class="checkbox checkbox-primary">
                  <input onclick="toggleCheck()" id="check_all" type="checkbox">
                  <label for="checkbox2"></label>
                </div>
              </th>
            </tr>
          </thead>
          <tbody id="content_table">
            <tr>
              <td colspan="4"><center>Tidak ada data</center> </td>
            </tr>
          </tbody>
        </table>
      </div>


    </div>
    <!-- <a href="#" class="btn btn-primary pull-right"><i class="fa fa-chevron-up"></i> Kembali ke Atas</a> -->
  </div>


</div>

<form>


</div>


<script type="text/javascript">

  function block_ui(element) {
    $(element).block({
      message: '<h4><img src="<?=base_url()?>/asset/pixel/plugins/images/busy.gif" /> We are processing your request.</h4>',
      css: {
        border: '1px solid #fff'
      }
    });
  }

  function toggleCheck(){
    if ($('#check_all').is(':checked')) {
      $('input[id="checkbox"]').each(function () {
        this.checked = true;
      });
    } else {
      $('input[id="checkbox"]').each(function () {
        this.checked = false;
      });
    }
    if ($('#checkall').is(':checked')) {
      toggleAll();
    }
  }
  function toggleAll(){
    $('#check_all').attr('checked', false);
  }
  function getMaster(){
        block_ui('#table');
    var tahun = $('#tahun').val();
      $.ajax({
       url : "<?=base_url().'ref_rka/get_master/'?>"+tahun,
       type: "POST",
       success: function(data)
       {
        $('#content_table').html(data);
        $('#table').unblock();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error get data');
      }
    });
  }
</script>