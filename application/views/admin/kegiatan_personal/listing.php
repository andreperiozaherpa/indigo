<!DOCTYPE html>
<head>

<title>Monitoring pegawai</title>

<link rel="stylesheet" href="<?=base_url();?>asset/admin/css/listeo.css">
<link rel="stylesheet" href="<?=base_url();?>asset/admin/css/listeo_color.css" id="colors">
</head>

<body>



<div id="map-container" class="fullwidth-home-map">

<div id="map" data-map-zoom="9">
        <!-- map goes here -->
    </div>

<div class="main-search-inner" >

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="main-search-input">

                <div class="main-search-input-item">
                    <input type="text" placeholder="Cari pegawai" value=""/>
                </div>

                <div class="main-search-input-item">
                    <select data-placeholder="Pilih SKPD" class="chosen-select" >
                        <option>SKPD 1</option>	
                        <option>SKPD 2</option>
                        <option>SKPD 3</option>
                    </select>
                </div>

                <div class="main-search-input-item">
                    <select data-placeholder="Pilih Unit kerja" class="chosen-select" >
                        <option>Unit 1</option>	
                        <option>Unit 2</option>
                        <option>Unit 3</option>
                    </select>
                </div>

                <button class="button">Cari</button>

            </div>
        </div>
    </div>
</div>

</div>

    

	

    <!-- Scroll Enabling Button -->
	<a href="#" id="scrollEnabling"  title="Enable or disable scrolling on map">Enable Scrolling</a>
</body>


<!-- Scripts
================================================== -->
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/jquery-2.2.0.min.js"></script>

<!-- Maps -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBF-EKYJaTXFn5AsQudXlemdxuzApgTTjw&sensor=false&amp;language=en"></script>
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/infobox.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/markerclusterer.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/map.js"></script>

<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/jpanelmenu.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/chosen.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>asset/admin/js/maps/custom.js"></script>