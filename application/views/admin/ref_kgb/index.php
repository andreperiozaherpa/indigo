    <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Ref. Gaji Pokok</h4>
          </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
              <ol class="breadcrumb">
                <li class="active">Ref. Gaji Pokok</li>
              </ol>
              </div>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>Tambah Gaji Pokok </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php if ($this->session->flashdata('msg')): ?>
                      <div class="alert alert-<?=$this->session->flashdata('msg_type')?>" role="alert"><?=$this->session->flashdata('msg')?></div>
                    <?php endif ?>
                    <br />
                    <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url();?>ref_kgb/add">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Peraturan Pemerintah</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="id_pp" placeholder="peraturan pemerintah" required>
                            <?php foreach ($pp as $row): ?>
                            <option value="<?=$row->id_pp?>" <?=($row->status=="Y")?"selected":""?>><?=$row->nama_pp?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Golongan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="id_golongan" placeholder="golongan" required>
                            <?php foreach ($golongan as $row): ?>
                            <option value="<?=$row->id_golongan?>" <?=(@$this->input->get('id_golongan')==$row->id_golongan)?"selected":"";?>><?=$row->pangkat?> - <?=$row->golongan?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">MKG</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" class="form-control" name="mkg" placeholder="mkg" value="<?=(@$this->input->get('mkg'))?>" <?=(@$this->input->get('mkg'))?'autofocus':''?> required>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gaji Pokok</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control" name="gaji_pokok" placeholder="gaji pokok" required>
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-7 col-sm-7">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="Y" checked> &nbsp; Aktif &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status" value="N"> Non Aktif
                            </label>
                          </div>
                        </div>
                      </div> -->
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input type="hidden" name="status" value="Y">
                          <button type="reset" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="white-box">
                  <div class="x_title">
                    <h2>Daftar Gaji Pokok</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="panel-group" id="pp-main" aria-multiselectable="true" role="tablist">
                  <?php foreach ($pp as $key => $r_pp): $item = "item".$r_pp->id_pp;?>
                      <div class="panel">
                          <div class="panel-heading" id="pp-head-<?=$key?>" role="tab"> <a class="panel-title <?=($r_pp->status=="Y")?'':'collapsed'?>" data-toggle="collapse" href="#pp-body-<?=$key?>" data-parent="#pp-main" aria-expanded="<?=($r_pp->status=="Y")?'true':'false'?>" aria-controls="pp-body-<?=$key?>"> <?=$r_pp->nama_pp?> </a> </div>
                          <div class="panel-collapse collapse <?=($r_pp->status=="Y")?'in':''?>" id="pp-body-<?=$key?>" aria-labelledby="pp-head-<?=$key?>" role="tabpanel">
                              <div class="panel-body table-responsive dragscroll"> 
                                <table class="table table-striped table-bordered table-condensed color-table primary-table">
                                  <thead>
                                    <tr>
                                      <?php for ($g=1; $g <= 4; $g++): 
                                        $i[$g]=0;
                                        switch ($g) {
                                        case 1:
                                          $max_r = ($mkg[$r_pp->id_pp][$g]>0) ? $mkg[$r_pp->id_pp][$g] : 0;
                                          break;
                                        case 2:
                                          $max_r = ($max_r>$mkg[$r_pp->id_pp][$g]+6) ? $max_r : $mkg[$r_pp->id_pp][$g]+6;
                                          break;
                                        case 3:
                                        case 4:
                                          $max_r = ($max_r>$mkg[$r_pp->id_pp][$g]+11) ? $max_r : $mkg[$r_pp->id_pp][$g]+11;
                                          break;
                                        
                                        default:
                                          $max_r = 0;
                                          break;
                                      } ?>
                                        <th>MKG</th>
                                        <?php foreach ($golongan_golongan[$g] as $gg => $r_gol): ?>
                                          <th class="text-right"><?=$r_gol->pangkat?></th>
                                        <?php endforeach ?>
                                      <?php endfor ?>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php for ($m_r=0; $m_r <= $max_r; $m_r++): ?>
                                      <tr>
                                        <?php for ($g=1; $g <= 4; $g++): 
                                        	$skip = false;
	                                        switch ($g) {
	                                        case 1:
	                                          if ($m_r>$mkg[$r_pp->id_pp][$g]) {
	                                          	$skip = true;
	                                          }
	                                          break;
	                                        case 2:
	                                          if ($m_r<6 OR $m_r>$mkg[$r_pp->id_pp][$g]+6) {
	                                          	$skip = true;
	                                          }
	                                          break;
	                                        case 3:
	                                        case 4:
	                                          if ($m_r<11 OR $m_r>$mkg[$r_pp->id_pp][$g]+11) {
	                                          	$skip = true;
	                                          }
	                                          break;
	                                        
	                                        default:
	                                          $skip = false;
	                                          break;
	                                      } ?>
                                            <th class="active"><?=(!$skip)?$i[$g]:''?></th>
                                            <?php foreach ($golongan_golongan[$g] as $gg => $r_gol): ?>
                                            <td class="text-right">
                                              <?php if (!$skip AND !empty($$item[$g][$i[$g]][$r_gol->id_golongan]['id_kgb'])): ?>
                                                <a href="<?php echo base_url(). "ref_kgb/edit/".@$$item[$g][$i[$g]][$r_gol->id_golongan]['id_kgb'] ;?>"><?=@number_format($$item[$g][$i[$g]][$r_gol->id_golongan]['gaji_pokok'])?></a>
                                              <?php endif ?>
                                            </td>
                                            <?php endforeach ?>
                                        <?php if(!$skip)$i[$g]++; endfor ?>
                                      </tr>
                                    <?php endfor ?>
                                  </tbody>
                                </table>
                              </div>
                          </div>
                      </div>
                  <?php endforeach ?>
                  </div>
                </div>
              </div>
            </div>

      <script type="text/javascript">
       function delete_(id)
      	{
      		if (confirm('Apakah anda yakin akan menghapus data?')){
      			window.location.href= "<?= base_url();?>ref_kgb/delete/"+id;
      		}
      	}

      </script>
