<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Logs</h4>
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
    <div class="col-sm-12">
                        <div class="white-box">
                            <div class="table-responsive">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Aktivitas</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      foreach ($logs as $log): ?>
                                        <tr>
                                            <td><?=$log->activity?></td>
                                            <td><?=$log->category?></td>
                                            <td><?=$log->description?></td>
                                            <td><?=$log->time?></td>
                                        </tr>
                                      <?php
                                    endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

  </div>
</div>
