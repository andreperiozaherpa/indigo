<?php
  $CI =& get_instance();
  $CI->load->model('company_profile_model');
  $CI->company_profile_model->set_identity();
  $p_nama = $CI->company_profile_model->nama;
  $p_tentang = $CI->company_profile_model->tentang;
  $p_alamat = $CI->company_profile_model->alamat;
  $p_logo = $CI->company_profile_model->logo;
  $p_email = $CI->company_profile_model->email;
  $p_facebook = $CI->company_profile_model->facebook;
  $p_twitter = $CI->company_profile_model->twitter;
  $p_telepon = $CI->company_profile_model->telepon;
  $p_youtube = $CI->company_profile_model->youtube;
  $p_gmap = $CI->company_profile_model->gmap;
  $p_tentang = $CI->company_profile_model->tentang;
  $p_instagram = $CI->company_profile_model->instagram;
?>


<!DOCTYPE html>

<html>
<!-- Basic Page Needs
================================================== -->
<head>
<head>
	<?php $this->load->view('blog/src/header_home');?>
	<style type="text/css">
	.marginleft2px{
		margin-left: 2px;
	}
</style>

</head>

<body>

		<?php $this->load->view('blog/src/top_nav_home');?>

        <!-- box-intro -->
        <section class="box-intro" id="home">
            <div class="table-cell">
                <h1 class="box-headline letters rotate-2">
                    <span class="box-words-wrapper centered">

                        <b class="is-visible" >IM.</b>
                        <b align="center">Creative.</b>
                        <b align="center">&nbsp;&nbsp;&nbsp; Studio.</b>
                    </span>
		        </h1>
                <h5>Because Normal Is Boring</h5>
            </div>

            <div class="mouse">
                <div class="scroll"></div>
            </div>
        </section>
        <!-- end box-intro -->

<section class="" id="hello">
		<!-- Parallax -->
	<div class="parallax" style="background: #29333e;"
	    data-background="data/images/bg_hello.png"
	    data-color="#29333e"
	    data-color-opacity="0"
	    data-img-width="800"
	    data-img-height="505">

		<!-- Infobox -->
		<div class="text-content white-font">
			<div class="container">

				<div class="row">
					<div class="col-lg-12 col-sm-12">
						<h1 align="center" class="box-headline letters rotate-2"  ><strong style="color:ffffff;">Hello</strong> <strong class="hijau">!</strong></h1>
						<p align="center" id="typedtext" style="font-size: 12px; line-height: 22px"><!--   Text dibawah dalam script js    --></p>
						
					</div>
				</div>

			</div>
		</div>

		<!-- Infobox / End -->

	</div>

	<!-- Parallax / End -->
</section>

<!-- Main container -->
    <div class="container main-container clearfix " id="about"> 
        <div class="col-md-6">
            <?php foreach ($video as $vd) :?>
                            <iframe style="max-width: 100%; max-height: auto;" width='500px' height='280px' src='<?php echo $vd->link ?>'></iframe>
            <?php endforeach;?>
        </div>
        <div class="col-md-6">
           <h3 class="uppercase">About US </h3>
           <h5><?php echo $p_nama;?></h5>
           <div class="h-30"></div>
            <p style="color:#a3a1a1;"><?php echo $p_tentang;?></p>
           
            <div class="h-10"></div>
            <ul class="social-icons">
				<li><a class="facebook" href="<?php echo $p_facebook; ?>" target="_blank"><i class="icon-facebook"></i></a></li>
				<li><a class="twitter" href="<?php echo $p_twitter; ?>" target="_blank"><i class="icon-twitter"></i></a></li>
				<li><a class="instagram" href="<?php echo $p_instagram; ?>" target="_blank"><i class="icon-instagram"></i></a></li>
				<li><a class="youtube" href="<?php echo $p_youtube; ?>"><i class="icon-youtube"></i></a></li>
			</ul>


        </div>
    </div>
    <!-- end Main container -->

<section class="service" id="services">
    <!-- top bar -->
    <div style="
    /*background: url('data/images/bg_hello.png') fixed;
    color: #333;
    background-size: cover;
    background-attachment: fixed;
    background-position: center center;*/
    padding: 50px 0 50px;
    text-align: center;
"  class="parallax"
    data-background="data/images/bg_hello.png"
    data-color="#fff"
    data-color-opacity="0"
    data-img-width="800"
    data-img-height="505">
        <h1 class="color">services</h1>
        <p style="color:#a3a1a1">We are professional in field</p>
    </div>
    <!-- end top bar -->

    <div class="container main-container">
        <div class="clearfix">
        <?php foreach ($services as $s): ?>
            <a href="<?php echo base_url();?>services/detail/<?php echo $s->id_services;?>">
            <!-- service-box -->
            <div class="col-md-4 <?php echo $s->class_css;?> view-second">
                    <i class="<?php echo $s->icon;?> size-100"></i>
                <div class=" view">
                    <div class="mask"></div>
                    <div class="content">
                        <h4 align="center" class="putih"><?php echo $s->nama_services;?></h4>                    
                        <p align="center"><?php echo $s->deskripsi ?></p>
                    </div>
                </div>
            </div>
            <!-- end service-box -->
            </a>
        <?php endforeach; ?>

          

        </div>
    </div>
</section>




<?php if (!empty($product)): ?>
<!-- Fullwidth Section -->
<section class="container fullwidth margin-top-65 padding-top-75 padding-bottom-70" id="produk">

	<div class="">
		<div class="row">

			<div class="col-md-12">
				<h3 class="headline centered margin-bottom-45">
					Our Product
					<span>we do all the work with fun</span>
				</h3>
			</div>

			<div class="col-md-12">
				<div class="simple-slick-carousel dots-nav">
				<?php foreach ($product as $p): ?>
				<!-- Listing Item -->
				<div class="carousel-item">
					<a href="<?php echo base_url().'produk/detail/'.$p->id_product;?>" class="listing-item-container">
						<div class="listing-item">
							<img src="<?php echo base_url().'data/product/'.$p->foto;?>" alt="">
							
							<div class="listing-item-content">
								<span class="tag"><?php echo $p->name_category;?></span>
								<h3><?php echo $p->nama_product;?></h3>
								
							</div>
							
						</div>
					</a>
				</div>
				<!-- Listing Item / End -->
				<?php endforeach; ?>
				</div>
				
			</div>
			<div class="col-md-12 centered-content">
				<a href="<?php echo base_url();?>produk" class="button border margin-top-10">View More</a>
			</div>
		</div>
	</div>

</section>
<!-- Fullwidth Section / End -->

	<?php endif; ?>


<!--
<section class="partner" id="partner">
        <div class="partner-text">
            <h3>Join We Us</h3>
            <h4>IM Creative Studio</h4>
        </div>
        <div class="clearfix">


           
            <div class="col-sm-6 partner-box1">
                <h3>Responsive Design</h3>
                <h4>Responsive Design</h4>
                <div class="h-30"></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
            </div>
           

        
            <div class="col-sm-6 partner-box2">
                <h3>Easy Customization</h3>
                <h4>Easy Customization</h4>
                <div class="h-30"></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliter enim nosmet ipsos nosse non possumus. Inscite autem medicinae </p>
            </div>
         

        </div>

      
</section>
        
  -->
        <!--
        Start Blog Section
        =========================================== -->
                
        

<!-- Content
================================================== -->

<?php if (!empty($testimoni)): ?>
<section class="fullwidth padding-top-40 padding-bottom-40" style="
    background: url('data/images/bg_hello.png') #29333e fixed;
    color: #333;
    padding: 50px 0 50px;
    background-size: cover;
    background-attachment: fixed;
    background-position: center center;
    text-align: center;
" >
	<!-- Info Section -->
	<div class="container">

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h3 class="headline centered putih" style="margin:0;">
					What Our Users Say
					<span class="putih" style="font-size: 16px;">We collect reviews from our website are really like!</span>
				</h3>
			</div>
		</div>

	</div>
	<!-- Info Section / End -->

	<!-- Categories Carousel -->
	<div class="fullwidth-carousel-container margin-top-20">
		<div class="testimonial-carousel testimonials">

             <?php foreach ($testimoni as $t): ?>
			<!-- Item -->
			<div class="fw-carousel-review" >
				<div class="testimonial-box" style="background:#109898;" >
					<div class="testimonial"><?php echo $t->deskripsi ?></div>
				</div>
				<div class="testimonial-author">
					<img src="<?php echo base_url()."data/testimoni/$t->foto";?>" alt="">
					<h4 class="putih"><?php echo $t->nama ?> <span><?php echo $t->jabatan ?></span></h4>
				</div>
			</div>
			 <?php endforeach; ?> 

			
	
		</div>
	</div>
	<!-- Categories Carousel / End -->

</section>

	<?php endif; ?>



<!-- Recent Blog Posts -->
<section class="fullwidth padding-top-75 padding-bottom-75" data-background-color="#f9f9f9" id="blog">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h3 class="headline centered margin-bottom-50">
					From The Blog
				</h3>
			</div>
		</div>

		<div class="row">

    <?php
                                    foreach ($posts as $post) :
                                        $tag = "";
                                        $tags= $post->tag;
                                        if ($tags!=""){
                                            $exp = explode(";", $tags);
                                            $_tag = array();
                                            foreach ($Qtag as $r) {
                                                $_tag[$r->tag_name] = $r->tag_slug;
                                            }
                                            
                                            for ($x=0; $x < (count($exp) - 1) ; $x++)
                                            {
                                                $slug = $_tag[$exp[$x]];
                                                $tag .= "<a href='".base_url()."berita/tag/{$slug}' >$exp[$x]</a>";
                                                if ($x < (count($exp) - 2)) $tag .=",";
                                            }
                                        }
                                        $content = substr($post->content,0,255);
                                        if (strlen($post->content)>255) $content .="...";
                                ?>

			<!-- Blog Post Item -->
			<div class="col-md-4">
				<a href="<?php echo base_url()."blog/read/{$post->title_slug}";?>" class="blog-compact-item-container">
					<div class="blog-compact-item">
                    <?php if (!empty($post->picture)) :?>
                        <img src="<?php echo base_url()."data/images/featured_image/{$post->picture}";?>" alt="">
                     <?php endif;?>
						<span class="blog-item-tag"><?php echo $post->category_name;?></span>
						<div class="blog-compact-item-content">
							<ul class="blog-post-tags">
								<li><?php echo date('d M Y ',strtotime($post->date)).$post->time;?></li>
							</ul>
							<h3><?php echo $post->title;?></h3>
							<?php echo $content;?>
						</div>
					</div>
				</a>
			</div>
			<!-- Blog post Item / End -->
    <?php endforeach;?>
			

			<div class="col-md-12 centered-content">
				<a href="<?php echo base_url();?>blog" class="button border margin-top-10">View Blog</a>
			</div>

		</div>

	</div>
</section>
<!-- Recent Blog Posts / End -->

<!-- Parallax -->
<div class="parallax" style="background: #29333e;"
    data-background="data/images/bg_hello.png"
    data-color="#29333e"
    data-color-opacity="0"
    data-img-width="800"
    data-img-height="505">

	<!-- Infobox -->
	<div class="text-content white-font">
		<div class="container">

			<div class="row">
				<div class="col-lg-12 col-sm-12">
					<h2 align="center">Consult With Us</h2>
					<p align="center">you can consult with us. we will be happy to try to solve your problem. please click the button below to communicate with us<br>
					<a href="<?php echo base_url();?>welcome" class="button margin-top-35">Start</a>
					</p>
					
				</div>
			</div>

		</div>
	</div>

	<!-- Infobox / End -->

</div>
<!-- Parallax / End -->

<section class="fullwidth border-top margin-bottom-0 padding-top-25 " data-background-color="#ffffff" id="banner">
    <!-- Logo Carousel -->
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="headline centered margin-bottom-40 margin-top-10">Our Partner<span>IM Creative Studio</span></h3>
            </div>
            
            <!-- Carousel -->
            <div class="col-md-12">
                <div class="logo-slick-carousel dot-navigation">
                    
                    <?php foreach ($banner as $b): ?>
                    <div class="item">
                        <a href="<?php echo $b->url;?>"><img src="<?php echo base_url().'data/images/banner/'.$b->logo;?>" alt=""></a>
                    </div>
                    <?php endforeach ?>


                </div>
            </div>
            <!-- Carousel / End -->

        </div>
    </div>
    <!-- Logo Carousel / End -->
</section>
<?php $this->load->view('blog/src/footer_home');?>



<script type="text/javascript">
// set up text to print, each item in array is new line
var aText = new Array(
"Welcome to our official website, Normal is boring. The world is created from abnormal people, if only then there was no human minded to fly, maybe at this moment we can not boarding a plane. The normal word can be relative in accordance with its time, or the way of viewing from different perspective. The world in will continue to grow as long as there are people who think that normal is boring. People will be demanded more quickly and efficiently without having to do a lot of works. ", 
"We have the same dream, contribute to creating a better world."
);
var iSpeed = 50; // time delay of print out
var iIndex = 0; // start printing array at this posision
var iArrLength = aText[0].length; // the length of the text array
var iScrollAt = 20; // start scrolling up at this many lines
 
var iTextPos = 0; // initialise text position
var sContents = ''; // initialise contents variable
var iRow; // initialise current row
 
function typewriter()
{
 sContents =  ' ';
 iRow = Math.max(0, iIndex-iScrollAt);
 var destination = document.getElementById("typedtext");
 
 while ( iRow < iIndex ) {
  sContents += aText[iRow++] + '<br />';
 }
 destination.innerHTML = sContents + aText[iIndex].substring(0, iTextPos) + "_";
 if ( iTextPos++ == iArrLength ) {
  iTextPos = 0;
  iIndex++;
  if ( iIndex != aText.length ) {
   iArrLength = aText[iIndex].length;
   setTimeout("typewriter()", 1000);
  }
 } else {
  setTimeout("typewriter()", iSpeed);
 }
}


typewriter();
</script>
</body>
</html>