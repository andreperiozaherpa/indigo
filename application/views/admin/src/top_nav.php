<style type="text/css">
    .read-more {
        background-color: #6003c8;
    }

    .read-more a {
        color: #fff !important;
    }

    .read-more:hover a {
        color: #6003c8 !important;
    }
</style>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <!-- <div class="top-left-part"  style="padding-top:20px;"> -->
        <div class="top-left-part">
            <a class="logo" href="<?php echo base_url('home') ?>">

                <b>
                    <!--This is dark logo icon--><img src="<?php echo base_url() . "data/logo/"; ?>e.png" alt="home" class="light-logo" style="width: 40px;" />
                </b>
                <span class="hidden-xs">
                    <!--This is dark logo text--><img src="<?php echo base_url() . "data/logo/"; ?>office.png" alt="home" class="light-logo" style="width: 80px;margin-left: -14px;" />
                </span>
            </a>



        </div>

        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" id="collapse-menu" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" onclick="refresh_notification()">
                    <i class=" ti-bell"></i> Pemberitahuan
                    <div class="notify" id="notif_bubble" style="display: <?= empty($notif) ? 'none' : 'block' ?>">
                        <span class="heartbit" style="border-color: #6003c8"></span><span style="background-color: #6003c8" class="point"></span>
                    </div>
                </a>
                <ul id="notification_list" style="width: 500px" class="dropdown-menu mailbox animated bounceInDown">
                    <li id="notif_none">
                        <div class="message-center">
                            <div class="mail-contnet" style="padding: 10px;text-align: center;">
                                <i style="color: #6003c8; font-size: 30px;" class="text-primary icon-hourglass"></i>
                                <p>Tidak ada pemberitahuan terbaru</p>
                            </div>
                        </div>
                    </li>
                    <li class="read-more">
                        <a style="padding: 5px" class="text-center" href="<?= base_url('pemberitahuan') ?>">Lihat semua pemberitahuan <i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.Task dropdown -->
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
<!-- Left navbar-header