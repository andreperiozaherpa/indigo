 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Rencana Kerja Tahunan</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="#">Dashboard</a></li>
 				<li class="active">Starter Page</li>
 			</ol>
 		</div>
 		<!-- /.breadcrumb -->
 	</div>


 	
 	<div class="row">	
 		<div class="col-md-12">
 			<div class="row">
 				<div class="white-box">
          <h3 align="center">Daftar <?=$j?> dan Indikator Kinerja Utama</h3>
          <h4 align="center" ><?=$detail->nama_unit_kerja?></h4>
          <p align="center" class="muted"> Tahun <?=$detail->tahun_rkt?></p> 
          <br>
          <table class="table table-bordered table-highlight table-inverse">
            <thead>
              <tr>
                <th>NO</th>
                <th><?=strtoupper($j)?></th>
                <th>NO</th>
                <th>INDIKATOR KINERJA</th>
                <th style="text-align: center; ">SATUAN</th>
                <th style="text-align: right; ">TARGET <br> TAHUNAN</th>
                <th style="text-align: center; ">PERIODE <br>PENGUKURAN</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach($sasaran as $s){
                $id = 'id_'.$n;
                $param = array('type'=>$type,'id_sasaran'=>$s->$id);
                $data = $this->indikator_model->getIndikator($param);
                ?>
                <tr>
                  <td rowspan="<?=count($data)==0 ? '1' : count($data)?>"><?=$no?></td>
                  <td rowspan="<?=count($data)==0 ? '1' : count($data)?>"><?=$s->$n?></td>
                  <?php 
                  if(count($data)<1){
                    if(empty($data)){
                      ?>
                      <td>-</td>
                      <td>-</td>
                      <td style="text-align: center; ">-</td>
                      <td style="text-align: right; ">-</td>
                      <td style="text-align: center; ">-</td>
                      <?php
                    }else{
                        ?>
                        <td>1</td>
                        <td><?=$data[0]->nama_indikator?></td>
                        <td style="text-align: center; "><?=$data[0]->satuan?></td>
                        <td style="text-align: right; "><?=$data[0]->target?></td>
                        <td style="text-align: center; "><?=$data[0]->frekuensi?></td>
                      </tr>
                      <?php
                  } 
                  }else{
                    ?>
                    <td>1</td>
                    <td><?=$data[0]->nama_indikator?></td>
                    <td style="text-align: center; "><?=$data[0]->satuan?></td>
                    <td style="text-align: right; "><?=$data[0]->target?></td>
                    <td style="text-align: center; "><?=$data[0]->frekuensi?></td>
                  </tr>
                  <?php
                  $nn=0;
                  foreach($data as $d){
                    if($nn!==0){
                      ?>
                      <tr>
                        <td><?=$nn+1?></td>
                        <td><?=$d->nama_indikator?></td>
                        <td style="text-align: center; "><?=$d->satuan?></td>
                        <td style="text-align: right; "><?=$d->target?></td>
                        <td style="text-align: center; "><?=$d->frekuensi?></td>
                      </tr>
                      <?php
                    }
                    $nn++;
                  }
                  ?>
                  <?php
                } ?>
                <?php $no++; } ?>
              </tbody>
            </table>
          </div>


        </div>    


      </div>
      <!-- .row -->

    </div>


    <script type="text/javascript">

      function delete_(id){
       swal({
        title: "Hapus Data",
        text: "Apakah anda yakin akan menghapus data ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Ya',
        cancelButtonText: "Tidak",
        closeOnConfirm: false
      },
      function(isConfirm){
        if (isConfirm){
         $.ajax({
          url : "<?=base_url().'ref_rkt/delete/'?>"+id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
           swal("Berhasil", "Data Berhasil Dihapus!", "success");
           location.reload();
         },
         error: function (jqXHR, textStatus, errorThrown)
         {
           alert('Error deleting data');
         }
       });
       }
     });
     }
   </script>