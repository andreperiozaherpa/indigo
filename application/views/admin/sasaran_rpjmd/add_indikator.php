 <div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Rencana Strategis</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li><a href="<?= base_url();?>sasaran_strategis">Sasaran Strategis</a></li>
        <li class="active">Add Indikator</li>
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
          <div class="panel-heading"> Sasaran Strategis
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
          </div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
              <p><?=$detail->kode_sasaran_strategis?> - <?=$detail->sasaran_strategis?></p>
            </div>
          </div>
        </div>


        <div class="white-box">
          <form role="form" method='post' enctype="multipart/form-data">
          <?php $no_row=0; $jumlah_row=count($data); foreach ($data as $row) : $no_row++;?>
          <div id="add-row-<?php echo $no_row;?>">
            <div class="row">
              <input type="hidden" name="id_indikator<?php echo $no_row;?>" id="id_indikator<?php echo $no_row;?>" value="<?php echo $row->id_indikator ?>"/>
                  <input type="hidden" name="kode_indikator<?php echo $no_row;?>" id="kode_indikator<?php echo $no_row;?>" value="<?php echo $row->kode_indikator ?>" class="form-control" placeholder="">

              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">Nama Indikator</label>
                  <input type="text" name="nama_indikator<?php echo $no_row;?>" id="nama_indikator<?php echo $no_row;?>" value="<?php echo $row->nama_indikator ?>" class="form-control" placeholder="">
                </div>
              </div>

              <div class="col-md-1">
                <div class="form-group">
                  <label class="control-label">Target 2019</label>
                  <input type="text" name="indikator_target_1<?php echo $no_row;?>" id="indikator_target_1<?php echo $no_row;?>" value="<?php echo $row->indikator_target_1 ?>" class="form-control" placeholder="">
                </div>
              </div>
              
              <div class="col-md-1">
                <div class="form-group">
                  <label class="control-label">Target 2020</label>
                  <input type="text" name="indikator_target_2<?php echo $no_row;?>" id="indikator_target_2<?php echo $no_row;?>" value="<?php echo $row->indikator_target_2 ?>" class="form-control" placeholder="">
                </div>
              </div>


              <div class="col-md-1">
                <div class="form-group">
                  <label class="control-label">Target 2021</label>
                  <input type="text" name="indikator_target_3<?php echo $no_row;?>" id="indikator_target_3<?php echo $no_row;?>" value="<?php echo $row->indikator_target_3 ?>" class="form-control" placeholder="">
                </div>
              </div>
              
              <div class="col-md-1">
                <div class="form-group">
                  <label class="control-label">Target 2022</label>
                  <input type="text" name="indikator_target_4<?php echo $no_row;?>" id="indikator_target_4<?php echo $no_row;?>" value="<?php echo $row->indikator_target_4 ?>" class="form-control" placeholder="">
                </div>
              </div>
              
              <div class="col-md-1">
                <div class="form-group">
                  <label class="control-label">Target 2023</label>
                  <input type="text" name="indikator_target_5<?php echo $no_row;?>" id="indikator_target_5<?php echo $no_row;?>" value="<?php echo $row->indikator_target_5 ?>" class="form-control" placeholder="">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label class="control-label">Kondisi Akhir</label>
                  <input type="text" name="kondisi_akhir" id="kondisi_akhir" value="<?php echo $row->kondisi_akhir ?>" class="form-control" placeholder="">
                </div>
              </div>




              <div class="col-md-3">

                <div class="form-group">
                  <label class="control-label">Satuan</label> <button type="button" onclick="delete_row('<?php echo $no_row;?>')" class="btn btn-outline btn-xs pull-right btn-primary"><i class="fa fa-trash-o"></i> Hapus</button>
                  <select name="id_satuan<?php echo $no_row;?>" id="id_satuan<?php echo $no_row;?>" class="form-control">
                    <?php foreach ($satuan as $d_satuan): $selected = ($row->id_satuan == $d_satuan->id_satuan) ? 'selected' : ''?>
                      <option value="<?=$d_satuan->id_satuan?>" <?=$selected?>><?=$d_satuan->satuan?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>

            </div>

          </div>
          <?php endforeach ?>

          <div id="add-row-<?php $add_row = $no_row + 1; echo $add_row;?>"></div>


            <button type="button" id="btn-add-row" onclick="add_row('<?php echo $add_row;?>')" class="btn btn-danger e pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Indikator</button>
            <input type="hidden" name="jumlah_row" id="jumlah-row" value="<?php echo $jumlah_row;?>"/>

          <button type="submit" class="btn btn-success e " data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i> Simpan</button>
        </form>
        </div>


      </div>    


    </div>
    <!-- .row -->

  </div>

<?php 
  $satuan_option = ""; 
  foreach ($satuan as $option) { 
    $satuan_option .= "<option value='{$option->id_satuan}'>{$option->satuan}</option>"; 
  } 
?>
<script type="text/javascript">
    var satuan_option = "<?php echo $satuan_option?>";
    function add_row(no) {
        var i = no; i++;
        $("#btn-add-row").attr("onclick", "add_row('"+i+"')");
        $("#jumlah-row").attr("value", no);

        document.getElementById('add-row-'+no).innerHTML = '<div class="row"> <div class="col-md-4"> <div class="form-group"> <label class="control-label">Nama Indikator</label> <input type="text" name="nama_indikator'+no+'" id="nama_indikator'+no+'" value="" class="form-control" placeholder=""> </div></div><div class="col-md-1"> <div class="form-group"> <label class="control-label">Target 2019</label> <input type="text" name="indikator_target_1'+no+'" id="indikator_target_1'+no+'" value="" class="form-control" placeholder=""> </div></div><div class="col-md-1"> <div class="form-group"> <label class="control-label">Target 2020</label> <input type="text" name="indikator_target_2'+no+'" id="indikator_target_2'+no+'" value="" class="form-control" placeholder=""> </div></div><div class="col-md-1"> <div class="form-group"> <label class="control-label">Target 2021</label> <input type="text" name="indikator_target_3'+no+'" id="indikator_target_3'+no+'" value="" class="form-control" placeholder=""> </div></div><div class="col-md-1"> <div class="form-group"> <label class="control-label">Target 2022</label> <input type="text" name="indikator_target_4'+no+'" id="indikator_target_4'+no+'" value="" class="form-control" placeholder=""> </div></div><div class="col-md-1"> <div class="form-group"> <label class="control-label">Target 2023</label> <input type="text" name="indikator_target_5'+no+'" id="indikator_target_5'+no+'" value="" class="form-control" placeholder=""> </div></div><div class="col-md-3"> <div class="form-group"> <label class="control-label">Satuan</label> <button type="button" onclick="delete_row(\''+no+'\')" class="btn btn-outline btn-xs pull-right btn-primary"><i class="fa fa-trash-o"></i> Hapus</button> <select name="id_satuan'+no+'" id="id_satuan'+no+'" class="form-control"> '+satuan_option+' </select> </div></div></div>';
        var p = document.getElementById('add-row-'+no);
        var newElement = document.createElement('div');
        newElement.setAttribute('id', 'add-row-'+i);
        p.parentNode.insertBefore(newElement, p.nextSibling);
        $("#kode_indikator"+no).focus();

        jumlah = $("#jumlah-row").val() + 1;

        // RECALL FUNCTION
    }

    function delete_row(no) {
        $("#add-row-"+no).hide();
        $("#id_indikator"+no).val('');
        $("#kode_indikator"+no).val('');
        $("#nama_indikator"+no).val('');
    }
</script>
