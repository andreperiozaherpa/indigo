<div class="col-md-4 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Filter </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <form id="laporan" class="form-horizontal form-label-left" method=post target="_blank" action="<?php echo base_url()."performance/laporan/";?>">
          
         
           


           <!--
            <div class="form-group">
              <label>Bulan <i>(wajib)</i></label>
            </div>
            <div class="form-group" >
              <select class="form-control" name="bulan" id="bulan">
                
                <option value="" selected>Pilih</option>
                <?php
                  for($bln=1;$bln<=12;$bln++){
                    echo "<option value='$bln'>$bulan[$bln]</option>";
                  }
                ?>
              </select>
            </div>
			-->

            <div class="form-group">
              <label>Level User</label>
            </div>
            <div class="form-group" >
              <select class="form-control" name="tipe" id="tipe">
                <option value="baru" selected>Semua</option>
                <option value="baru" >Front Office</option>
                <option value="lama">Back Office</option>
                <option value="lama">Koordinator</option>
                <option value="lama">Kepala Bidang</option>
                <option value="lama">Kepala Dinas</option>
              </select>
            </div>

            <div class="form-group">
              <label>Nama</label>
            </div>

             <div class="form-group" >
               <input type="text" class="form-control" name="nama">
            </div>

             <div class="form-group">
              <label>Tanggal Awal <i>(wajib)</i></label>
            </div>
            <div class="form-group" >
              <input type="date" class="form-control" name="tgl_awal" value="<?=date('Y-m-d')?>">
            </div>

            <div class="form-group">
              <label>Tanggal Akhir <i>(wajib)</i></label>
            </div>
            <div class="form-group" >
              <input type="date" class="form-control" name="tgl_akhir" value="<?=date('Y-m-d')?>">
            </div>


            

                      <div class="form-group">
              <input type="hidden" id="download" name="download"/>
                          <a href='<?= base_url()."rekapinvestasi/index";?>' class="btn btn-default">Reset</a>
                          <a onclick="submit_()"  class="btn btn-success">Tampilkan data</a>
            
                      </div>

                    </form>
                  </div>
                </div>
              </div>

<script>
	function submit_(download)
	{
		//var bulan = $("#bulan").val();
		var tipe = $("#tipe").val();
		//if (bulan!="" && tahun!=""){
		if (tipe!=""){
			if (download)
				$("#download").val(1);
			else
				$("#download").val(0);
			$("#laporan").submit();
		}
		else{
			//alert("Bulan dan tahun wajib diisi");
			alert("Tahun wajib diisi");
		}
	}

   function getKabupaten(){
    var id = $('#id_provinsi').val();
    $('#id_desa').html('<option value="">Pilih</option>');
    $('#id_kecamatan').html('<option value="">Pilih</option>');
    $.post("<?php echo base_url();?>rekapinvestasi/get_kabupaten/"+id,{},function(obj){
      $('#id_kabupaten').html(obj);
    });
    
  }
  function getKecamatan(){
    $('#id_desa').html('<option value="">Pilih</option>');
    var id = $('#id_kabupaten').val();
    $.post("<?php echo base_url();?>rekapinvestasi/get_kecamatan/"+id,{},function(obj){
      $('#id_kecamatan').html(obj);
    });
    
  }
  function getDesa(){
    var id = $('#id_kecamatan').val();
    $.post("<?php echo base_url();?>rekapinvestasi/get_desa/"+id,{},function(obj){
      $('#id_desa').html(obj);
    });
  }

</script>