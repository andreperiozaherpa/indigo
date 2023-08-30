 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Pembobotan</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
                <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
                <li><a href="<?= base_url();?>/rencana_kerja_tahunan">Rencana Kerja Tahunan</a></li>
                <li><a href="<?= base_url();?>/rencana_kerja_tahunan/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>/detail_sasaran/">Detail Sasaran</a></li>
                <li class="active">Pembobotan IKU</li>
            </ol>
 		</div>
 		<!-- /.breadcrumb -->
 	</div>
     <div class="row">
     	
     </div>
     <br>

 	<div class="row">
 		<div class="col-md-12">
 			<div class="white-box">
 				<div class="row">
 					<form method="POST">
 					<div class="col-md-3 b-r">
 						<center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>   
 					</div>
 					<div class="col-md-9">
 						<div class="panel panel-inverse">
                            <div class="panel-heading"> <?= $rkt->nama_unit_kerja;?>
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
                            </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <table class="table">
                                    	<tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong>?</strong></tr>
                                    	<tr><td>Jumlah Pegawai </td><td>:</td><td> <strong>? Orang</strong></tr>

                                    </table>
                                </div>
                            </div>
                        </div>

 						
 					</div>
 					
 				</form>
 				</div>

 			</div>
 		</div>

 	</div>
 	<!-- .row -->
 	<div class="row">	

 		<div class="col-md-12">
 			<div class="row">

 				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
 					<div class="white-box">
                        <?php if (!empty($message)) echo "
        <div class='alert alert-$message_type'>$message</div>";?>   
 						<form method ="post">




 						<br>
 						<hr>

 						<table class="table color-table dark-table table-hover">

 							<thead>
 								<tr>
 									<th>#</th>
 									<th>Kode IKU</th>
 									<th>Nama IKU</th>
 									<th>Bobot % </th>
 								</tr>
 							</thead>
 							<tbody>
                                <?php 
                            $i=1;
                            $total = 0;
                            foreach ($indikator as $row) {
                                $total = $total + $row->bobot;
                                echo '
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row->kode_indikator.'</td>
                                    <td>'.$row->nama_indikator.'</td>
                                    <td><input type="text" onkeyup="setBobot()" id="bobot_'.$i.'" name="bobot['.$row->id_indikator.']" class="form-control" value="'.$row->bobot.'"></td>
                                </tr>';
                                $i++;
                            }
                            ?>
                                 <tr>
                                    <td colspan="2"></td>
                                    
                                    <td>Total</td>
                                    <td><label id="total" ><?=$total;?> </label> %</td>
                                </tr>

 							</table>
                                <button type="submit"  class="btn btn-primary pull-right">Simpan</button>

                        <a href="<?=base_url();?>/rencana_kerja_tahunan/detail_sasaran/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/<?=$this->uri->segment(5)?>" <button type="button" class="btn btn-default pull-right " style="margin-right: 5px;" > Batal</button></a>
                                </form>

 						</div>
 					</div>

 				</div>    


 			</div>
 			<!-- .row -->

 		</div>


 		<script type="text/javascript">

 			function setBobot()
            {

                var i = "<?= $i ;?>";
                var y = 1;
                var total = 0;
                for(y;y<i;y++){
                    var bobot = $("#bobot_"+y).val();
                    total = total + parseFloat(bobot);
                }
                if(total>100) alert("Total bobot tidak boleh lebih dari 100%")
                $("#total").html(total);
            }
 		</script>