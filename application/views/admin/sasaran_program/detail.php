 <div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Sasaran Program</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li><a href="<?= base_url();?>sasaran_program">Sasaran Program</a></li>
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <!-- .row -->
  <div class="row">
   






    <div class="col-md-12">



      <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-primary block6">
          <div class="panel-heading"> Sasaran Program
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
          </div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
              <p><?=$detail->kode_sasaran_program?> - <?=$detail->sasaran_program?></p>
            </div>
          </div>
        </div>



        <div class="white-box">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Indikator</th>
                <th>Target 2019</th>
                <th>Target 2020</th>
                <th>Target 2021</th>
                <th>Target 2022</th>
                <th>Target 2023</th>
                <th>Satuan</th>
              </tr>
            </thead>

             <tbody>
              <?php $no_row=0; $jumlah_row=count($data); foreach ($data as $row) : $no_row++;?>
              <tr>
                <th><?=$no_row?></th>
                <td><?=$row->kode_indikator?></td>
                <td><?=$row->nama_indikator?></td>
                <td><?=$row->indikator_target_1?></td>
                <td><?=$row->indikator_target_2?></td>
                <td><?=$row->indikator_target_3?></td>
                <td><?=$row->indikator_target_4?></td>
                <td><?=$row->indikator_target_5?></td>
                <td><?=$row->satuan?></td>
              </tr>
              <?php endforeach;?>
              <?php if ($this->session->userdata('level_unit_kerja') ==  1 || $this->session->userdata('level') == "Administrator"): ?>
              <tr>
                <td colspan="9">
                  <a href="<?=base_url('sasaran_program/indikator/'.$detail->id_sasaran_program.'')?>" class="btn btn-info e pull-right"><i class="fa fa-edit"></i> Tambah/Ubah Indikator</a>
                </td>
              </tr>
              <?php endif;?>
          </tbody>


          </table>




      </div>    


    </div>
    <!-- .row -->

  </div>
