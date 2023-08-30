<style type="text/css">
.centered {
    position: absolute;
    top: 48%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.centered img{
  width: 80px;
}
</style>
<script src="https://use.typekit.net/bkt6ydm.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

<div id="titlebar"  style="background: #ffffff fixed;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <h2 class="putih">Agenda</h2><span class="color">Daftar Agenda</span>

        <!-- Breadcrumbs -->
        <nav id="breadcrumbs">
          <ul class="color">
            <li><a href=" <?php echo base_url().'home'; ?> ">Home</a></li>
              <li>Agenda</li>
          </ul>
        </nav>

      </div>
    </div>
  </div>
</div>

    <!-- Start Content -->
    <div id="content">
      <div class="container">
        <div class="row blog-page">

    <!-- Search -->
    <div class="col-md-12">
<form method="POST">
      <div class="main-search-input gray-style margin-top-0 margin-bottom-10">
        <div class="main-search-input-item">
          <input name="tema" type="text" placeholder="Cari berdasarkan nama agenda?" value=""/>
        </div>

      

    <!--     <div class="main-search-input-item">
          <select data-placeholder="All Categories" class="chosen-select" >
            <option>All Categories</option> 
            <option>Tutorial</option>
            <option>Produk Hukum</option>
            <option>Surat</option>
          </select>
        </div> -->

        <button class="button" type="submit">Cari</button>
    </form>
      </div>
    </div>
    <!-- Search Section / End -->

          <!-- Start Blog Posts -->
          <div class="col-md-12 blog-box">


            <div class="row example-split">
        <div class="col-md-12 example-title">
            
           <hr>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
            <ul class="timeline timeline-split">
                <?php foreach($agenda as $a){?>
                <li class="timeline-item">
                    <div class="timeline-info">
                        <span><?php echo date('d M Y',strtotime($a->tgl_mulai)) ?></span>
                    </div>
                    <div class="timeline-marker"></div>
                    <div class="timeline-content" style="margin-top:0px !important;">
                        <a href="<?php echo base_url()."agenda/detail/";?>"><h3 class="timeline-title"><?php echo $a->tema?></h3></a>
                        <p><?php echo $a->isi_agenda ?></p>
                    </div>
                </li>
                <?php } ?>
<!--                 <li class="timeline-item period">
                    <div class="timeline-info"></div>
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h2 class="timeline-title">April 2016</h2>
                    </div>
                </li> -->
            </ul>
        </div>
    </div>
       
      

      </div>
    </div>
  </div>
  </div>
    <!-- End Content -->


