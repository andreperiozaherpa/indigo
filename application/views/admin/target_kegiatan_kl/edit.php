<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Target Kegiatan K/L</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
                            </li>
                            <li>    
                                <a href="<?php echo base_url();?>manage_category_finance">Target Kegiatan K/L</a>
                            </li>
                            <li class="active">     
                                <strong>Edit</strong>
                            </li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">

<div class="row">
    <div class="col-md-12">
        
        <div class="panel panel-primary" data-collapsed="0">
        
            
                
            </div>
            <div class="panel-body">
                <?php if (!empty($message)) echo "
                <div class='alert alert-$message_type'>$message</div>";?>
                <form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-md-12">Kode Kegiatan</label>
                            <div class="col-md-12">
                                <select name="id_kode" class="form-control select2">
                                    <option value="">Pilih Kode Kegiatan</option>
                                    <?php 
                                        foreach($kode as $k){
                                            if($k->id_kode==$detail->id_kode){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo'<option value="'.$k->id_kode.'"'.$selected.'>'.$k->kode.' - '.$k->keterangan.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tahun</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $detail->tahun_target_kegiatan_kl?>" name="tahun_target_kegiatan_kl" class="form-control" placeholder="Masukkan Tahun"> </div>
                        </div>
                        <?php  
                            if($instansi_level=='koordinator'||$instansi_level=='lembaga'){
                        ?>
                        <input type="hidden" name="id_koordinator" value="<?php echo $detail->id_koordinator ?>">
                        <?php 
                            }else{
                                ?>
                        <div class="form-group">
                            <label class="col-md-12">Koordinator</label>
                            <div class="col-md-12">
                                <select onchange="getLembaga()" id="id_koordinator" name="id_koordinator" class="form-control select2">
                                    <option value="">Pilih Koordinator</option>
                                    <?php 
                                        foreach($koordinator as $k){
                                            if($k->id_instansi==$detail->id_koordinator){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo'<option value="'.$k->id_instansi.'"'.$selected.'>'.$k->nama_instansi.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        <?php 
                            if($instansi_level=='lembaga'){
                                ?>
                        <input type="hidden" name="id_sub_koordinator" value="<?php echo $detail->id_koordinator ?>">

                                <?php
                            }else{
                        ?>
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-md-12">Sub Koordinator</label>
                            <div class="col-md-12">
                                <select name="id_sub_koordinator" id="id_lembaga" class="form-control select2">
                                    <option value="">Pilih Sub Koordinator</option>
                                    <?php 
                                        foreach($lembaga as $l){
                                            if($l->id_instansi==$detail->id_sub_koordinator){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo'<option value="'.$l->id_instansi.'"'.$selected.'>'.$l->nama_instansi.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Alokasi Anggaran (Rp)</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $detail->alokasi_anggaran ?>" name="alokasi_anggaran" class="form-control" placeholder="Masukkan Alokasi Anggaran"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Jumlah Target Kegiatan</label>
                            <div class="col-md-12">
                                <input type="number" value="<?php echo $detail->jumlah_target_kegiatan ?>" name="jumlah_target_kegiatan" class="form-control" placeholder="Masukkan Jumlah Target Kegiatan"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Volume</label>
                            <div class="col-md-6">
                                <input type="number" value="<?php echo $detail->volume_kegiatan ?>" name="volume_kegiatan" class="form-control" placeholder="Masukkan Volume"> 
                            </div>
                            <div class="col-md-6">
                                <select name="id_satuan" class="form-control select2">
                                    <option value="">Pilih Satuan</option>
                                    <?php 
                                        foreach($satuan as $k){
                                            if($k->id_satuan==$detail->id_satuan){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo'<option value="'.$k->id_satuan.'"'.$selected.'>'.$k->satuan.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Awal</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $detail->tanggal_awal?>" name="tanggal_awal" class="form-control" id="datepicker" placeholder="Masukkan Tanggal Awal"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Akhir</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $detail->tanggal_akhir?>" name="tanggal_akhir" class="form-control" id="datepicker" placeholder="Masukkan Tanggal Akhir"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Provinsi</label>
                            <div class="col-md-12">
                                <select id="id_provinsi" onchange="getKabupaten()" name="id_provinsi_target" class="form-control select2">
                                    <option value="">Pilih Provinsi</option>
                                    <?php 
                                        foreach($provinsi as $p){
                                            if($p->id_provinsi==$detail->id_provinsi_target){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo '<option value="'.$p->id_provinsi.'"'.$selected.'>'.$p->provinsi.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kabupaten / Kota</label>
                            <div class="col-md-12">
                                <select id="id_kabupaten" onchange="getKecamatan()" name="id_kabupaten_target" class="form-control select2">
                                    <option value="">Pilih Kabupaten / Kota</option>
                                    <?php 
                                        foreach($kabupaten as $p){
                                            if($p->id_kabupaten==$detail->id_kabupaten_target){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo '<option value="'.$p->id_kabupaten.'"'.$selected.'>'.$p->kabupaten.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kecamatan</label>
                            <div class="col-md-12">
                                <select name="id_kecamatan_target" onchange="getDesa()" id="id_kecamatan" class="form-control select2">
                                    <option value="">Pilih Kecamatan</option>
                                    <?php 
                                        foreach($kecamatan as $p){
                                            if($p->id_kecamatan==$detail->id_kecamatan_target){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo '<option value="'.$p->id_kecamatan.'"'.$selected.'>'.$p->kecamatan.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Desa / Kelurahan</label>
                            <div class="col-md-12">
                                <select name="id_desa_target" id="id_desa" class="form-control select2">
                                    <option value="">Pilih Desa / Kelurahan</option>
                                    <?php 
                                        foreach($desa as $p){
                                            if($p->id_desa==$detail->id_desa_target){
                                                $selected = ' selected';
                                            }else{
                                                $selected = '';
                                            }
                                            echo '<option value="'.$p->id_desa.'"'.$selected.'>'.$p->desa.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-8">

                        <div class="form-group">
                            <label class="col-md-12">Tempat Kegiatan</label>
                            <div class="col-md-12">
                                <input type="text" value="<?php echo $detail->tempat?>" name="tempat" class="form-control" placeholder="Masukkan Tempat Kegiatan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Rencana Kegiatan</label>
                            <div class="col-md-12">
                                <textarea rows="4" name="rencana_kegiatan" class="form-control" placeholder="Masukkan Rencana Kegiatan"><?php echo $detail->rencana_kegiatan?></textarea> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Keterangan</label>
                            <div class="col-md-12">
                                <textarea rows="4" name="keterangan_kegiatan" class="form-control" placeholder="Masukkan Keterangan Kegiatan"><?php echo $detail->keterangan_kegiatan?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <a href="" class="btn btn-default waves-effect waves-light">Batal</a>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Perbarui</button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
            
            </div>

        </div>
    </div>

</div>
</div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
<script type="text/javascript">
    function getLembaga(){
      var id_koordinator = $('#id_koordinator').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_lembaga') ?>', {id_koordinator:id_koordinator}, function(data){ 
        $('#id_lembaga').html(data); 
        $("#id_lembaga").select2("destroy");
        $("#id_lembaga").select2();
      });
    }
    function getKabupaten(){
      var id_provinsi = $('#id_provinsi').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_kabupaten') ?>', {id_provinsi:id_provinsi}, function(data){ 
        $('#id_kabupaten').html(data); 
        $("#id_kabupaten").select2("destroy");
        $("#id_kabupaten").select2();
      });
    }
    function getKecamatan(){
      var id_kabupaten = $('#id_kabupaten').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_kecamatan') ?>', {id_kabupaten:id_kabupaten}, function(data){ 
        $('#id_kecamatan').html(data); 
        $("#id_kecamatan").select2("destroy");
        $("#id_kecamatan").select2();
      });
    }
    function getDesa(){
      var id_kecamatan = $('#id_kecamatan').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_desa') ?>', {id_kecamatan:id_kecamatan}, function(data){ 
        $('#id_desa').html(data); 
        $("#id_desa").select2("destroy");
        $("#id_desa").select2();
      });
    }
</script>