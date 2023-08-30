<div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Perencanaan Renstra</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="https://e-office.sumedangkab.go.id//admin">Dashboard</a></li>
                <li class="active">Laporan Perencanaan Renstra</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <?php 
                        if($user_level=='Administrator'){
                    ?>
                    <form>
                    <div class="col-md-3">
                        <label>SKPD</label>
                        <select name="id_skpd" class="form-control select2">
                            <?php 
                                foreach($dt_skpd as $d){
                                    $selected = $d->id_skpd == $id_skpd ? ' selected' : null;
                                    echo '<option value="'.$d->id_skpd.'"'.$selected.'>'.$d->nama_skpd.'</option>';
                                }
                            ?>

                        </select>
                    </div>
                    <div class="col-md-2">
                        <label style="display: block;">&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-outline">Filter</button>
                    </div>
                    </form>
                    <?php } ?>
                    <div class="col-md-7">
                        <span style="display: block;">&nbsp;</span>
                        <a href="<?= base_url('data/sicerdas/'.$detail_skpd->nama_skpd.'.xlsx') ?>" class="btn btn-primary pull-right" style="margin-left:10px">Download Laporan Renstra</a>
                        <a href="javascript:void(0)" onclick="printDiv()" class="btn btn-primary pull-right">Cetak Laporan Renstra</a>
                    </div>
                </div>
            </div>

            </form>
        </div>


    </div>
    <style>
        #rpjmd_perencanaan th {
            text-align: center;
            vertical-align: middle;
            background-color: #55a3a7;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box" id="printArea">
                <center>
                    <h4>RENCANA PROGRAM, KEGIATAN DAN PENDANAAN
                        <br>
                        <?=$detail_skpd->nama_skpd?>
                    </h4>
                </center>
                <hr>
                <div class="table-responsive">
                    <?php
                    if(file_exists('./application/views/admin/sicerdas/renstra/laporan/'.$detail_skpd->id_skpd.".php")){
                        $this->load->view('admin/sicerdas/renstra/laporan/'.$detail_skpd->id_skpd);
                    }else{
                        ?>
                        <center>
                            <h3 class="box-title text-purple">Oops</h3>
                            <p>Data tidak ditemukan</p>
                        </center>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function printDiv() {

        var divToPrint = document.getElementById('printArea');

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()"><link href="https://e-office.sumedangkab.go.id/asset/pixel/inverse/css/style.css" rel="stylesheet"><link href="https://e-office.sumedangkab.go.id/asset/pixel/inverse/css/colors/default.css" id="theme" rel="stylesheet"><style>th,td{font-size:11px !important}</style>' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        // setTimeout(function(){newWin.close();},10);

    }
</script>