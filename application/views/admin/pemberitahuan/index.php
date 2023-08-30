<style type="text/css">
    .message-center.read{
        border:solid 1px #6003c8;
        border-left:solid 5px #6003c8;
        padding-left: 0px !important;
    }
</style>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pemberitahuan</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?=base_url('admin')?>">Dashboard</a></li>
                <li class="active">Pemberitahuan</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <ul style="list-style-type: none;padding: 0px" id="all_notification_list">      
                    <li id="notif_none">
                    <div class="message-center">
                        <div class="mail-contnet" style="padding: 10px;text-align: center;">
                            <i style="color: #6003c8; font-size: 30px;" class="text-primary icon-hourglass"></i>
                            <p>Tidak ada pemberitahuan terbaru</p>
                        </div>
                    </div>
                </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin akan menghapus notifikasi ini?</p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void()" id="btnYes" class="btn btn-primary">Ya</a>
                <button type="button" class="btn btn-default" onclick="" data-dismiss="modal">Tidak</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    function showModalDelete(notification_id){
        $('#deleteModal').modal('show');
        $('#btnYes').attr('onclick',"deleteNotif('"+notification_id+"')");
    }
    function deleteNotif(notification_id){
        $.get( "<?=base_url('pemberitahuan/delete_notification')?>/"+notification_id, function(res) {
        $('#deleteModal').modal('hide');
            <?php 
                $this->socketio->send('refresh_notification',array('user_id'=>$this->session->userdata('user_id')),true);
            ?>
        });
    }
</script>