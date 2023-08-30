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
<div id="titlebar"  style="background: #ffffff fixed;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <h2 class="putih">Video</h2><span class="color">Daftar Playlist Video</span>

        <!-- Breadcrumbs -->
        <nav id="breadcrumbs">
          <ul class="color">
            <li><a href=" <?php echo base_url().'home'; ?> ">Beranda</a></li>
              <li>Video</li>
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
      <form action="<?php echo base_url();?>modul" method='get' style="width: 100%">
      <div class="main-search-input gray-style margin-top-0 margin-bottom-10">
        <div class="main-search-input-item">
          <input name="s" type="text" placeholder="Masukan Judul atau Nama Video" value="<?php if (!empty($search)) echo $search;?>"/>
        </div>

      

        <div class="main-search-input-item">
          <select name="c" data-placeholder="All Categories" class="chosen-select" >
            <option value="">Semua Kategori</option>
            <?php
              foreach ($category as $row) {
                $selected = "";
                if ($row->category_video_id==$this->input->get('c')) {
                  $selected = "selected";
                }
                echo "<option value='{$row->category_video_id}' {$selected}>{$row->category_video_name}</option>";
              }
            ?>
          </select>
        </div>

        <button class="button" type="submit">Cari</button>
      </form>
      </div>
    </div>
    <!-- Search Section / End -->

          <!-- Start Blog Posts -->
          <div class="col-md-12 blog-box">

          
<div class="row">
    <div class="col-lg-12 col-md-12 padding-right-30">

      <div class="row">
      <!-- Listings -->
      <div class="row fs-listings margin-top-30">
        
      <!-- Pagination Container / End -->
      <?php foreach ($video as $vd){
        parse_str( parse_url( $vd->link, PHP_URL_QUERY ), $code );
        $url_id =  $code['v']; 
        ?>

        <div class="col-lg-4 col-md-6">
          <a href="<?php echo site_url('video/detail/'.$vd->id_video.'') ?>" class="listing-item-container" data-marker-id="1">
            <div class="listing-item">
              <img src="https://img.youtube.com/vi/<?php echo $url_id ?>/0.jpg" alt="">
                <div class="centered"><img src="<?php echo base_url()."data/icon/play.png" ?>"></div>
              <div class="listing-item-content">
                <span class="tag"><?php echo $vd->category_video_name ?></span>
                <h3><?php echo $vd->judul ?> <i class="verified-icon"></i></h3>
              </div>
            </div>
          </a>
        </div>
      <?php } ?>
        <!-- Listing Item / End -->



      </div>
      <!-- Listings Container / End -->


      <!-- Pagination Container -->
      <div class="row fs-listings">
        <div class="col-md-12">

      <!-- Pagination -->
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12">
          <!-- Pagination -->
          <div class="pagination-container margin-bottom-40">
            <nav class="pagination">

              <?php
                $CI =& get_instance();
                            $CI->load->library('pagination');

                            $this->config->load('bootstrap_pagination');
                    $config = $this->config->item('pagination');  

                            $config['base_url'] = base_url(). 'video';
                            $config['total_rows'] = $total_rows;
                            $config['per_page'] = $per_page;
                            $config['page_query_string']=TRUE;

                            $config['reuse_query_string'] = TRUE;

                            $CI->pagination->initialize($config);
                            $link = $CI->pagination->create_links();
                            echo $link;
              ?>

            </nav>
          </div>
        </div>
      </div>
      <!-- Pagination / End -->
          

        </div>
      </div>

        

      </div>

     

    </div>


    
  </div>
   


       
      
      </tbody>
      </table>

      </div>
    </div>
  </div>
  </div>
    <!-- End Content -->


