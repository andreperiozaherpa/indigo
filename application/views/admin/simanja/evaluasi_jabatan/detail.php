<div class="container-fluid">

<div class="row bg-title">
  <!-- .page title -->
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Detail Evaluasi Jabatan</h4>
  </div>
  <!-- /.page title -->
  <!-- .breadcrumb -->
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

    <ol class="breadcrumb">
      <li><a href="<?= base_url(); ?>admin">Dashboard</a></li>
      <li><a href="<?= base_url('simanja/evaluasi_jabatan'); ?>">Evaluasi Jabatan</a></li>
      <li class="active"><?=$detail->nama?></li>
    </ol>
  </div>
  <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default" style="border-top: 10px solid #6003c8">
          <div class="panel-heading">
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
            <table id="w1" class="table table-striped">
                <tr><th width="180px" style="text-align:right">Nama Jabatan</th><td><?=$detail->nama ?: '-'?></td></tr>
                <tr><th width="180px" style="text-align:right">Eselon Jabatan</th><td><?=$detail->eselon_jabatan ?: '-'?></td></tr>
                <tr><th width="180px" style="text-align:right">Jenis Jabatan</th><td><?=$detail->jenis_jabatan ?: '-' ?></td></tr>
                <tr><th width="180px" style="text-align:right">Unit Kerja</th><td><?=$detail->namaSkpd ?: '-' ?></td></tr>
                <tr><th width="180px" style="text-align:right">Instansi</th><td>Pemerintah Daerah Kabupaten Sumedang</td></tr>
                <tr><th width="180px" style="text-align:right">Total Nilai</th><td><span class="label label-success" id="total_nilai">1</span></td></tr>
                <tr><th width="180px" style="text-align:right">Kelas Jabatan</th><td><span class="label label-success" id="kelas_jabatan">1</span></td></tr>
              </table>
            </div>
          </div>
          <button type="button" class="btn waves-effect waves-light btn-info dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list"></i> Pilihan Menu <span class="caret"></span></button>
          <ul class="dropdown-menu">
              <li><a href="javascript:void(0)" onclick="editRef(<?=$detail->id?>)"><i class="fa fa-edit"></i><small> Sunting Jabatan</small>  </a></li>
              <li><a href="javascript:void(0)" onclick="deleteRef(<?=$detail->id?>)"><i class="fa fa-trash"></i><small> Hapus Jabatan</small></a></li>
              <!-- <li class="divider"></li>
              <li><a href="<?=base_url('simanja/evaluasi_jabatan/export_bkn/'.$detail->id)?>"><i class="fa fa-file-pdf-o"></i> <small>Export PDF BKN</small></a></li> -->
          </ul>
          <a href="<?=base_url('simanja/analisis_jabatan/detail/'.$detail->id)?>" class="btn btn-primary"><i class="fa fa-user"></i> Analisis Jabatan</a>
          <?php if($hasil_kerja){ ?>
            <a href="<?=base_url('simanja/analisis_beban_kerja/detail/'.$detail->id)?>" class="btn btn-warning"><i class="fa fa-steam"></i> Analisis Beban Kerja</a>
          <?php } ?>
        </div>
        </div>
      </div>
      </div>
    <div class="row">
      <div class="white-box">
        <h3>Hasil Evaluasi Jabatan</h3>
        <br>
        <div class="vtabs">
            <ul class="nav tabs-vertical nav-pills">
                <li class="tab active">
                    <a data-toggle="tab" href="#tab_peran_jabatan" aria-expanded="true"> <span class="visible-xs"></span><span class="hidden-xs">Peran Jabatan</span> </a>
                </li>
                <li class="tab">
                    <a data-toggle="tab" href="#tab_uraian_tugas" aria-expanded="true"> <span class="visible-xs"></span><span class="hidden-xs">Uraian Tugas</span> </a>
                </li>
                <li class="tab">
                    <a data-toggle="tab" href="#tab_tanggung_jawab" aria-expanded="true"> <span class="visible-xs"></span><span class="hidden-xs">Tanggung Jawab</span> </a>
                </li>
                <li class="tab">
                    <a data-toggle="tab" href="#tab_hasil_kerja" aria-expanded="true"> <span class="visible-xs"></span><span class="hidden-xs">Hasil Kerja</span> </a>
                </li>
                <li class="tab">
                    <a data-toggle="tab" href="#tab_tingkat_faktor" aria-expanded="true"> <span class="visible-xs"></span><span class="hidden-xs">Tingkat Faktor</span> </a>
                </li>
            </ul>
            <div class="tab-content" style="width: 100%">
                <div id="tab_peran_jabatan" class="tab-pane active">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <div class="panel panel-default">
                            <div class="panel-wrapper collapse in"  >
                                <div class="panel-body">
                                  <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                          <tr>
                                            <th>Peran Jabatan</th>
                                          </tr>
                                          <tr>
                                            <td><?=$detail->ikhtisar_jabatan ?: '-'?></td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>   
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div id="tab_uraian_tugas" class="tab-pane" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <div class="panel panel-default">
                            <div class="panel-wrapper collapse in"  >
                                <div class="panel-body">
                                  <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50px">No</th>
                                                <th>Uraian Tugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach($tugas_pokok as $i) { ?>
                                                <tr>
                                                    <td width="50px"><?=$no++?></td>
                                                    <td><?=$i->uraian_tugas?></td>
                                                </tr>
                                            <?php } ?>
                                            <?php echo $tugas_pokok ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                        </tbody>
                                    </table>
                                </div>   
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <div id="tab_tanggung_jawab" class="tab-pane" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <div class="panel panel-default">
                            <div class="panel-wrapper collapse in"  >
                                <div class="panel-body">
                                  <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50px">No</th>
                                                <th>Tanggung Jawab</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach($tanggung_jawab as $i) { ?>
                                                <tr>
                                                    <td width="50px"><?=$no++?></td>
                                                    <td><?=$i->tanggung_jawab?></td>
                                                </tr>
                                            <?php } ?>
                                            <?php echo $tanggung_jawab ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                        </tbody>
                                    </table>
                                </div>   
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <div id="tab_hasil_kerja" class="tab-pane" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <div class="panel panel-default">
                            <div class="panel-wrapper collapse in"  >
                                <div class="panel-body">
                                  <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50px">No</th>
                                                <th>Hasil Kerja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach($hasil_kerja as $i) { ?>
                                                <tr>
                                                    <td width="50px"><?=$no++?></td>
                                                    <td><?=$i->hasil_kerja?></td>
                                                </tr>
                                            <?php } ?>
                                            <?php echo $hasil_kerja ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                        </tbody>
                                    </table>
                                </div>   
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <div id="tab_tingkat_faktor" class="tab-pane" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <div class="panel panel-default">
                            <div class="panel-wrapper collapse in"  >
                                <div class="panel-body">
                                  <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Faktor Evaluasi</th>
                                                <th>Nilai Yang Diberikan</th>
                                                <th>Level</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            $total = 0;
                                            foreach($faktor_evaluasi as $i) {
                                                if(isset($i['skor'])){
                                                  $total += $i['skor']->nilaiItem;
                                                }
                                              ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td>
                                                      <b>Faktor <?=$i['number'].' : '.$i['nama']?></b>
                                                      <p>
                                                        <?=$i['uraian']?>
                                                      </p>
                                                    </td>
                                                    <td><span class="label label-success"><?=isset($i['skor']) ? $i['skor']->nilaiItem : 0?></span></td>
                                                    <td><?=isset($i['skor']) ? 'Tingkat Faktor '.$i['number'].' - '.$i['skor']->levelItem : 0?></td>
                                                    <td style="width:150px">
                                                        <a href="javascript:void(0)" onclick="editRef(<?=$i['id']?>)" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                              <tr>
                                                <td colspan="2" style="text-align: right"><b>Total</b></td>
                                                <td><span class="label label-success"><?=$total?></span></td>
                                                <td></td>
                                              </tr>
                                              <tr>
                                                <td colspan="2" style="text-align: right"><b>Kelas Jabatan</b></td>
                                                <?php
                                                  $CI =& get_instance();
                                                  $CI->load->model('simanja/ref_kelas_jabatan_model', 'rkjm');
                                                  $kelas_jabatan = $CI->rkjm->get_by_nilai($total);
                                                ?>
                                                <td><span class="label label-success"><?=($kelas_jabatan) ? $kelas_jabatan->kelas : 0?></span></td>
                                                <td><?=($kelas_jabatan) ? $kelas_jabatan->nilai_minimal.' - '.$kelas_jabatan->nilai_maksimal : 0?></td>
                                              </tr>
                                        </tbody>
                                    </table>
                                </div>   
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- .row -->

  <div id="modalReferensi" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel1">Pilih salah satu faktor</h4>
        </div>
        <div class="modal-body">
          <form id="formRef">
            <div id="hiddenRef"></div>
            <div id="messageRef"></div>
            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
            <input type="hidden" name="id_faktor_evaluasi" value="">
            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th width="100px">Pilih</th>
                  <th width="150px">Level</th>
                  <th>Kriteria</th>
                </tr>
              </thead>
              <tbody id="faktorItem">
              </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="simpanRef()" id="btnSaveRef" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>

</div>

<script>
  let save_method = null
  const base_detail_evjab = "<?=base_url('simanja/evaluasi_jabatan/detail/'.$detail->id)?>"

    function editRef(id) {
        save_method = 'update';
        $('[name="id_faktor_evaluasi"]').val(id);
        $('#formRef')[0].reset();
        $('#messageRef').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenRef').html('<input type="hidden" value="" name="id_ref"/>');
        $('.help-block').empty();
        $.ajax({
        url: "<?= base_url() . 'simanja/evaluasi_jabatan/fetch_ref/' ?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          if(data.length == 0){
            alert('Gagal mendapatkan data, silahkan cek jenis jabatan')
          }
          
          let html = ''
          let selectedItem = ''
          let selected = ''

          fetch('<?= base_url() . 'simanja/evaluasi_jabatan/fetch_item/' . $detail->id ?>/'+id)
            .then(response => response.json())
            .then(res => {
              if(res){
                selectedItem = res.id_faktor_evaluasi_item
              }
              data.forEach((e,i) => {
                selected = ''
                if(selectedItem == e.id){
                  selected = 'checked'
                }
                html += '<tr><td><input type="radio" name="id_faktor_evaluasi_item" value="'+e.id+'" '+selected+'></td>';
                html += '<td>Level '+e.level+'</td><td>'+e.kriteria+'</td></tr>';
              })
              $('#faktorItem').html(html)
            });
          
          $('#modalReferensi').modal('show');
          $('.modal-title').text('Pilih level faktor');

        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("Gagal mendapatkan data Referensi");
        }
        });

    }

    function simpanRef() {
        var faktor_evaluasi = $('[name="id_faktor_evaluasi_item"]').val();

        if(!faktor_evaluasi){
        alert('Level faktor evaluasi harus diisi terlebih dahulu')
        }

        if(faktor_evaluasi !== ''){
        $('#btnSaveRef').text('Menyimpan...');
        $('#messageRef').html('');
        $('#btnSaveRef').attr('disabled', true);
        var url;
        var formData = new FormData($('#formRef')[0]);
        if (save_method == 'add') {
            url = "<?= base_url() . 'simanja/evaluasi_jabatan/p_add_ref' ?>";
        } else {
            url = "<?= base_url() . 'simanja/evaluasi_jabatan/p_update_ref' ?>";
        }
    
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
    
            if (data.status) {
                $('#modalReferensi').modal('hide');
                swal("Berhasil", "Data Berhasil Disimpan!", "success");
                window.location.replace(base_detail_evjab+'#tab_tingkat_faktor');
                location.reload();
            } else {
                $('#messageRef').html('<div class="alert alert-danger">' + data.message + '</div>');
            }
            $('#btnSaveRef').text('Simpan');
            $('#btnSaveRef').attr('disabled', false);
    
    
            },
            error: function(jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
            $('#btnSaveRef').text('Simpan');
            $('#btnSaveRef').attr('disabled', false);
    
            }
        });
        }
    }

    $('#total_nilai').html('<?=($total) ?: 0?>');
    $('#kelas_jabatan').html('<?=($kelas_jabatan) ? $kelas_jabatan->kelas : 0?>');
</script>