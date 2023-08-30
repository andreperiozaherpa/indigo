            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Notifikasi</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?=base_url('admin')?>">Dashboard</a></li>
                            <li class="active">SIKAP</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box p-0">
                            <!-- .left-right-aside-column-->
                            <div class="page-aside" style="min-height: 700px;">
                                <!-- .left-aside-column-->
                                <div class="left-aside">
                                    <div class="scrollable">
                                        <ul class="list-style-none">
                                            <?php 
                                                $get_notifikasi             = $this->notifikasi_lib->get_notifikasi();
                                                $total_notifikasi           = count($get_notifikasi);
                                                $total_not_read             = 0;
                                                $subjek_notifikasi          = array();
                                                $total_subjek_notifikasi    = array();
                                                foreach ($get_notifikasi as $row) {
                                                    if (!in_array($this->session->userdata('user_id'), explode(',', $row->read_notifikasi))) $total_not_read++;
                                                    array_push($subjek_notifikasi, $row->subjek_notifikasi);
                                                    (isset($total_subjek_notifikasi[$row->subjek_notifikasi])) ? $total_subjek_notifikasi[$row->subjek_notifikasi]++ : $total_subjek_notifikasi[$row->subjek_notifikasi]=1;
                                                }
                                                $subjek_notifikasi = array_unique($subjek_notifikasi);
                                            ?>
                                            <li class="box-label"><a href="javascript:void(0)" onclick="$('#demo-foo-addrow').trigger('footable_filter', {filter: ''});">Semua Pemberitahuan <span><?=$total_notifikasi?></span></a></li>
                                            <li><a href="javascript:void(0)" onclick="$('#demo-foo-addrow').trigger('footable_filter', {filter: '~||~'});">Belum Dilihat<span><?=$total_not_read?></span></a></li>
                                            <li class="divider"></li>
                                            <?php foreach ($subjek_notifikasi as $value): ?>
                                                <li><a href="javascript:void(0)" onclick="$('#demo-foo-addrow').trigger('footable_filter', {filter: '<?=$value?>'});"><?=$value?><span><?=$total_subjek_notifikasi[$value]?></span></a></li>
                                            <?php endforeach ?>
                                        </ul>
                                        <h4 class="font-bold m-t-30">Daftar Tugas</h4>
                                        <hr>
                                        <h5>Capaian Kinerja <span class="pull-right">80%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">80% Complete</span> </div>
                                        </div>
                                        <h5>Evaluasi Laporan<span class="pull-right">90%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">90% Complete</span> </div>
                                        </div>
                                        <h5>Pelaporan Kinerja <span class="pull-right">50%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5>Sasaran Strategis <span class="pull-right">70%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">70% Complete</span> </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.left-aside-column-->
                                <div class="right-aside">
                                    <div class="right-page-header">
                                        <div class="pull-right m-l-30">
                                            <button type="button" onclick="spam_notifikasi('all')" class="fcbtn btn btn-outline btn-danger btn-1e"><i class="ti-trash"></i> Hapus Semua</button>
                                        </div>
                                        <div class="pull-right">
                                            <input type="text" id="demo-input-search2" placeholder="Cari notifikasi" class="form-control">
                                        </div>
                                        <h3>Daftar Pemberitahuan</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="scrollable">
                                        <div class="table-responsive">
                                            <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Subjek</th>
                                                        <th>Pesan</th>
                                                        <th>Status</th>
                                                        <th>Tanggal</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $no = 1;
                                                        foreach ($get_notifikasi as $row) :
                                                            switch ($row->status_notifikasi) {
                                                                case 'Dibatalkan':
                                                                    $label_notifikasi = "label-warning";
                                                                    break;

                                                                case 'Disetujui':
                                                                    $label_notifikasi = "label-success";
                                                                    break;

                                                                case 'Ditolak':
                                                                    $label_notifikasi = "label-danger";
                                                                    break;
                                                                
                                                                default:
                                                                    $label_notifikasi = "label-primary";
                                                                    break;
                                                            }
                                                            $read = (!in_array($this->session->userdata('user_id'), explode(',', $row->read_notifikasi))) ? true : false;
                                                    ?>
                                                    <tr class="<?=($read)?'warning':''?>">
                                                        <?php if ($read): ?>
                                                            <td class="hidden">~||~</td>
                                                        <?php endif ?>
                                                        <td><?=$no?></td>
                                                        <td>
                                                            <a href="<?=base_url($row->link_notifikasi)?>"><img src="<?=base_url()."data/user_picture/{$row->user_picture}";?>" alt="user" class="img-circle" /> <?=$row->full_name?></a>
                                                        </td>
                                                        <td><?=$row->nama_unit_kerja?></td>
                                                        <td><?=$row->subjek_notifikasi?></td>
                                                        <td><?=$row->pesan_notifikasi?></td>
                                                        <td><span class="label <?=$label_notifikasi?>"><?=$row->status_notifikasi?></span> </td>
                                                        <td><?=$row->tanggal_notifikasi?></td>
                                                        <td>
                                                            <a href="<?=base_url($row->link_notifikasi)?>" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="View"><i class="ti-search" aria-hidden="true"></i></a>
                                                            <button onclick="spam_notifikasi(<?=$row->id_notifikasi?>)" type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2">
                                                            <!-- <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact">Add New Contact</button> -->
                                                        </td>
                                                        </div>
                                                        <td colspan="7">
                                                            <div class="text-right">
                                                                <ul class="pagination">
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- .left-aside-column-->
                            </div>
                            <!-- /.left-right-aside-column-->
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function spam_notifikasi(id) {
                    if (id=="all") {
                        swal({
                            title: "Hapus Notifikasi",
                            text: "Apakah anda yakin akan menghapus semua notifikasi?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#DD6B55',
                            confirmButtonText: 'Ya',
                            cancelButtonText: "Tidak",
                            closeOnConfirm: false
                        },
                        function(isConfirm){
                            if (isConfirm){
                                $.ajax({
                                    url : "<?=base_url().'admin/delete_notifikasi/'?>"+id,
                                    type: "POST",
                                    success: function(data)
                                    {
                                        swal("Berhasil", "Data Berhasil Dihapus!", "success");
                                        location.reload();
                                    },
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        alert('Error deleting data');
                                        location.reload();
                                    }
                                });
                            }
                        });
                    }
                    else {
                        $.ajax({
                            url : "<?=base_url().'admin/delete_notifikasi/'?>"+id,
                            type: "POST",
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Error deleting data');
                            }
                        });
                    }
                }
            </script>