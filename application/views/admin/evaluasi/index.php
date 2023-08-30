<div class="container-fluid">

 <div class="row bg-title">
   <!-- .page title -->
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
     <h4 class="page-title">Evaluasi</h4>
   </div>
   <!-- /.page title -->
   <!-- .breadcrumb -->
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

     <ol class="breadcrumb">
       <li><a href="<?= base_url();?>admin">Dashboard</a></li>
       <li class="active">Evaluasi </li>
     </ol>
   </div>
   <!-- /.breadcrumb -->
 </div>

 <div class="row">
  		<div class="col-md-12">
  			<div class="white-box">
  				<div class="row">
  					<form method="POST">
  					<div class="col-md-3">
  						<div class="form-group">
  							<label for="exampleInputEmail1">Tahun</label>
  							<select name="tahun_evaluasi" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class="form-control">
                  <?php
                  for ($i=2019; $i < 2024; $i++) { 
                    $selected = "";
                  	if ($this->uri->segment(3) == $i) {
                  		$selected = "selected";
                  	}
                    echo'<option value="'.base_url("evaluasi/index/".$i).'" '.$selected.'>'.$i.'</option>';
                  }
                  ?></select>
  						</div>
  					</div>
  					<div class="col-md-6">
  						<div class="form-group">
  							<label for="exampleInputEmail1">SKPD</label>
  							<select name="id_skpd" class="form-control">
  								<option value="">Semua SKPD</option>
                  <?php
   								foreach($skpd as $s){ ?>
   								<option value="<?=$s['id_skpd']?>"><?=$s['nama_skpd'];?></option>';
   								<?php } ?>
    						</select>
  						</div>
  					</div>
  					<div class="col-md-3">
  						<div class="form-group">
  							<br>
  							<button name="filter" type="submit" class="btn btn-primary m-t-5">Filter</button>
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
         <?=$this->session->flashdata('msg'); ?>
         <div class="white-box">
           <table class="table color-table dark-table table-hover">
             <thead>
               <tr>
                 <th>#</th>
                 <th style="width:50%">Nama SKPD</th>
                 <th style="width:8%">Tahun</th>
                 <th class="text-center">Nilai</th>
                 <th class="text-center">Aksi</th>
               </tr>
             </thead>
             <tbody>
               <?php
               $no = 1;
               foreach ($list as $l): ?>
               <tr>
                 <td><?=$no?></td>
                 <td><?=$l['nama_skpd']?></td>
                 <form class="" action="" method="post">
                   <input type="hidden" name="id_evaluasi" value="<?=$l['id_evaluasi'];?>">
                   <td><?=$this->uri->segment(3);?></td>
                     <td>
                       <input type="text" class="form-control text-center" style="text-transform:uppercase" name="nilai" value="<?=$l['nilai'];?>" placeholder="Masukan Nilai">
                     </td>
                   <td>
                     <button name="tombol_submit" class="btn btn-info" style="min-width:150px;">
            					Update
            				</button>
                   </td>
                 </form>
               </tr>
               <?php $no++ ?>
               <?php  endforeach; ?>
             </table>
             <?php if (count($list) == 0): ?>
               <div class="form-group">
                <form  method="post">
                  <?php foreach ($skpd as $s): ?>
                  <input type="hidden" name="id_skpd[]" value="<?=$s['id_skpd'];?>">
                  <?php endforeach; ?>
                  <input type="hidden" name="tahun_evaluasi" value="<?=$this->uri->segment(3);?>">
                  <button name="mass_create" class="btn btn-success btn-block">Tambah Evaluasi Tahun <?=$this->uri->segment(3);?> </button>
                </form>
               </div>
             <?php endif; ?>
           </div>
         </div>
       </div>
     </div>

     </div>
     <!-- .row -->
   </div>
