<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url()."asset/pixel/inverse/" ;?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <link href="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/orgchart/orgchart.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="tree-view"></div>
<ul id="tree-data" style="display:none">
    <?php 
    $no = 0;
    foreach($petjab as $pj) { ?>
        <li id="<?= ($no == 0) ? 'root' : 'node'.$pj->id ?>">
            <table class="table table-striped table-dark">
                <tr>
                    <td><?=$pj->nama?> (<?=($pj->jenis_jabatan == 'Struktural') ? $pj->jenis_pegawai : $pj->jenis_jabatan?>)</td>
                </tr>
                <tr>
                    <td>Kelas <?=$pj->kelas?></td>
                </tr>
                <tr>
                    <td>Eselon Jabatan <?=$pj->eselon_jabatan?></td>
                </tr>
            </table>
            <ul>
                <?php foreach($pj->nested as $pj2){ ?>
                    <li id="node<?=$pj2->id?>">
                        <table class="table table-striped table-dark">
                            <tr>
                                <td><?=$pj2->nama?> (<?=($pj2->jenis_jabatan == 'Struktural') ? $pj2->jenis_pegawai : $pj2->jenis_jabatan?>)</td>
                            </tr>
                            <tr>
                                <td>Kelas <?=$pj2->kelas?></td>
                            </tr>
                            <tr>
                                <td>Eselon Jabatan <?=$pj2->eselon_jabatan?></td>
                            </tr>
                        </table>
                        <?php if($detail->jenis_skpd == 'kecamatan' || $detail->jenis_skpd == 'kelurahan' || $detail->jenis_skpd == 'uptd') { ?>
                          <ul type="vertical">
                              <?php foreach($pj2->nested as $pj3){ ?>
                                  <li id="node<?=$pj3->id?>" class="last">
                                      <table class="table table-striped table-dark">
                                          <tr>
                                              <td rowspan="2"><?=$pj3->nama?></td>
                                              <td>Kls</td>
                                              <td>B</td>
                                              <td>K</td>
                                              <td>S</td>
                                          </tr>
                                          <tr>
                                              <td><?=$pj3->kelas?></td>
                                              <td><?=$pj3->jumlah_pemangku?></td>
                                              <td><?=$pj3->jumlah_kebutuhan_pegawai?></td>
                                              <td><?=$pj3->jumlah_pemangku - $pj3->jumlah_kebutuhan_pegawai?></td>
                                          </tr>
                                      </table>
                                  </li>  
                              <?php }  ?>
                          </ul>
                        <?php }else if($detail->jenis_skpd == 'skpd'){ ?>
                          <ul>
                              <?php foreach($pj2->nested as $pj3){ ?>
                                  <li id="node<?=$pj3->id?>">
                                      <table class="table table-striped table-dark">
                                          <tr>
                                              <td><?=$pj3->nama?> (<?=($pj3->jenis_jabatan == 'Struktural') ? $pj3->jenis_pegawai : $pj3->jenis_jabatan?>)</td>
                                          </tr>
                                          <tr>
                                              <td>Kelas <?=$pj3->kelas?></td>
                                          </tr>
                                          <tr>
                                              <td>Eselon Jabatan <?=$pj3->eselon_jabatan?></td>
                                          </tr>
                                      </table>
                                      <ul type="vertical">
                                          <?php foreach($pj3->nested as $pj4){ ?>
                                              <li id="node<?=$pj4->id?>" class="last">
                                                  <table class="table table-striped table-dark">
                                                      <tr>
                                                          <td rowspan="2"><?=$pj4->nama?></td>
                                                          <td>Kls</td>
                                                          <td>B</td>
                                                          <td>K</td>
                                                          <td>S</td>
                                                      </tr>
                                                      <tr>
                                                          <td><?=$pj4->kelas?></td>
                                                          <td><?=$pj4->jumlah_pemangku?></td>
                                                          <td><?=$pj4->jumlah_kebutuhan_pegawai?></td>
                                                          <td><?=$pj4->jumlah_pemangku - $pj4->jumlah_kebutuhan_pegawai?></td>
                                                      </tr>
                                                  </table>
                                              </li>  
                                          <?php }  ?>
                                      </ul>
                                  </li>
                              <?php }  ?>
                          </ul>
                        <?php } ?>
                    </li>  
                <?php }  ?>
            </ul>
        </li> 
    <?php $no++; } ?>
</ul>


<script type="text/javascript" src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/orgchart/orgchart.js"></script>
<script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
	var base_url = "<?= base_url() ?>";
</script>
<script>
	$(document).ready(function() {
		// create a tree
		$("#tree-data").jOrgChart({
			chartElement: $("#tree-view"),
			nodeClicked: nodeClicked
		});

		// lighting a node in the selection
		function nodeClicked(node, type) {
			node = node || $(this);
			$('.jOrgChart .selected').removeClass('selected');
			node.addClass('selected');
		}
	});
</script>
</body>
</html>