 <div class="container-fluid">

   <div class="row bg-title">
     <!-- .page title -->
     <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
       <h4 class="page-title">Laporan Perencanaan</h4>
     </div>
     <!-- /.page title -->
     <!-- .breadcrumb -->
     <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

       <ol class="breadcrumb">
         <?php echo breadcrumb($this->uri->segment_array()); ?>
       </ol>
     </div>
     <!-- /.breadcrumb -->
   </div>

   <div class="row">
     <div class="col-md-12">
       <div class="white-box">
         <div class="row">
           <form method="GET">
             <div class="col-md-6">
               <div class="form-group">
                 <label for="exampleInputEmail1">SKPD</label>
                 <select name="id_skpd" class="form-control select2">
                   <option value="">Semua SKPD</option>
                   <?php
                    foreach ($skpd as $s) {
                      $selected = (@$_GET['id_skpd'] == $s->id_skpd) ? "selected" : "";
                      echo '<option value="' . $s->id_skpd . '" ' . $selected . '>' . $s->nama_skpd . '</option>';
                    }
                    ?>
                 </select>
               </div>
             </div>
             <div class="col-md-3">
               <div class="form-group">
                 <label for="exampleInputEmail1">Tahun</label>
                 <select name="tahun" class="form-control select2">
                   <?php
                      for($tahun=2019;$tahun<=2023;$tahun++){
                        if(isset($_GET['tahun'])){
                          $selected = $_GET['tahun'] == $tahun ? ' selected' : '';
                        }else{
                          $selected = date('Y') == $tahun ? ' selected' : '';
                        }
                        echo '<option value="'.$tahun.'"'.$selected.'>'.$tahun.'</option>';
                      }
                    ?>
                 </select>
               </div>
             </div>
             <div class="col-md-3">
               <div class="form-group">

                 <br>
                 <button type="submit" class="btn btn-primary m-t-5">Filter</button>
                 <a href="javascript:void(0)" onclick="downloadExcel('renja','Laporan Rencana Kerja')" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
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

             <table id="renja" class="table table-bordered color-table table-hover">

               <thead style="">
                 <tr>
                   <th style="background-color: #6003c8;color: #fff">Sasaran Strategis / IKU</th>
                   <th style="background-color: #6003c8;color: #fff">Target</th>
                   <th style="background-color: #6003c8;color: #fff">Realisasi</th>
                   <th style="background-color: #6003c8;color: #fff">Satuan</th>
                   <th style="background-color: #6003c8;color: #fff">Polarisasi</th>
                   <th style="background-color: #6003c8;color: #fff">Unit Kerja Penanggung Jawab</th>
                   <th style="background-color: #6003c8;color: #fff">Cascading Unit Kerja</th>
                   <th style="background-color: #6003c8;color: #fff">Capaian</th>
                 </tr>
               </thead>
               <tbody>

                 <?php

                  if (isset($_GET['id_skpd'])) {
                    $id_skpd = $_GET['id_skpd'];
                  } else {
                    $id_skpd = null;
                  }
                  if (isset($_GET['tahun'])) {
                    $tahun = $_GET['tahun'];
                  } else {
                    $tahun = date('Y');
                  }
                  foreach ($jenis as $j) {
                    $name = $this->laporan_sakip_model->name($j);
                    foreach ($name as $v => $n) {
                      $$v = $n;
                    }
                    $renstra_beriku  = $this->laporan_sakip_model->get_sasaran_renaksi($j, $id_skpd, $tahun);
                    foreach ($renstra_beriku as $r) {
                      $iku = $this->laporan_sakip_model->get_iku_sasaran_renstra($j, $r->$cSasaran, $id_skpd);
                  ?>
                     <tr class="warning">
                       <th colspan="7"><strong><?= $nSasaran ?>.</strong> <?= $r->$tSasaran ?></th>
                       <td>
                         <div class="label label-table label-success"><?= $r->jumlah_capaian ?></div>
                       </td>
                     </tr>
                     <?php
                      foreach ($iku as $i) {
                        $iku_renja = $this->laporan_sakip_model->get_iku_renja($j, $i->$cIku, $id_skpd, $tahun);
                        foreach ($iku_renja as $ir) {
                          $capaian = get_capaian($ir->$taIkuRenja, $ir->$rIkuRenja, $ir->polorarisasi);
                      ?>
                         <tr>
                           <th><?= $ir->$tIku ?></th>
                           <td><?= $ir->$taIkuRenja ?></td>
                           <td><?= $ir->$rIkuRenja ?></td>
                           <td><?= $ir->satuan ?></td>
                           <td><?= $ir->polorarisasi ?></td>
                           <td><?= $ir->nama_skpd ?></td>
                           <td><?= $ir->nama_unit_kerja ?></td>
                           <td>
                             <div class="label label-table label-warning"><?= $capaian ?></div>
                           </td>
                         </tr>
                 <?php
                        }
                      }
                    }
                  }
                  ?>



               </tbody>
             </table>



           </div>
         </div>

       </div>


     </div>
     <!-- .row -->

   </div>