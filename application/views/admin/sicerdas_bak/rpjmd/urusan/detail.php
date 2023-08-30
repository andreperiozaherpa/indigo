<div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Sasaran RPJMD</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
        <li><a href="https://e-office.sumedangkab.go.id/sasaran_rpjmd">Sasaran RPJMD</a></li>
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <!-- .row -->
  <div class="row">



    <div class="col-md-12">



      <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-default block6">
          <div class="panel-heading"> Detail Sasaran
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
          </div>
          <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6 b-r">
                  <div class="row">
                   <div class="col-md-12 b-b">
                     <h3 class="box-title m-b-0">Visi</h3>
                     <p> Terwujudnya Masyarakat Sumedang yang Sejahtera, Agamis, Maju, Profesional, dan Kreatif (SIMPATI) Pada Tahun 20231</p>
                   </div>
                   <div class="col-md-12">
                     <h3 class="box-title m-b-0">Misi</h3>
                     <p>
                      Menata	birokrasi	pemerintah	yang	responsif	dan	bertanggung	jawab	secara	profesional	dalam	pelayanan	masyarakat</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                 <div class="col-md-12 b-b">
                  <h3 class="box-title m-b-0">Tujuan</h3>
                  <p>
                    Terwujudnya pelayanan publik yang berkualitas                  </p>
                </div>

                <div class="col-md-12">
                  <h3 class="box-title m-b-0">Indikator Tujuan</h3>
                  <p>Meningkatnya kualitas pelayanan publik                </p>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>



        

    <div class="white-box">
    <div class="col-md-12">
                                    <div class="btn-group m-r-10">
                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-gear m-r-5"></i> <span class="caret"></span></button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="#!" onclick="edit_sasaran_strategis_renstra(81);">Edit</a></li>


                                            <li>
                                                <a href="#" class="btn-xs" title="" onclick="delete_ss_(&quot;81&quot;)" data-toggle="tooltip" data-original-title="Hapus Sasaran"> Hapus </a>
                                            </li>
                                        </ul>
                                    </div>


                                    <!-- <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#lakukanPembobotanss0">Lakukan Pembobotan</button> -->

                                    <strong>Nama Sasaran :</strong> Meningkatnya akses dan cakupan mutu layanan kesehatan
                                </div>
                                <hr>

      <table class="table table-bordered table-striped table-hover table-responsive "  >
        <thead  >
          <tr style="" >
            <th style="text-align: center;vertical-align:middle" >#</th>
            <th style="text-align: center;vertical-align:middle">Indikator</th>
            <th style="text-align: center;vertical-align:middle">Target 2019</th>
            <th style="text-align: center;vertical-align:middle">Target 2020</th>
            <th style="text-align: center;vertical-align:middle">Target 2021</th>
            <th style="text-align: center;vertical-align:middle">Target 2022</th>
            <th style="text-align: center;vertical-align:middle">Target 2023</th>
            <th style="text-align: center;vertical-align:middle">Satuan</th>
			<th style="text-align: center;vertical-align:middle">Opsi</th>
          </tr>

        </thead>
        <tbody>
                        <tr>
                <th>1</th>
                <td>Indeks Kepuasan masyarakat Bidang Perizinan</td>
                <td>-</td>
                <td>-</td>
                <td>87,23</td>
                <td>88,31</td>
                <td>90,00</td>
                <td>indeks</td>
                <td>
                  <a href="javascript:void(0)" onclick="editIndikator(2)" class="btn btn-info btn-circle"><i class="ti-pencil"></i></a>
                  <a href="javascript:void(0)" onclick="hapusIndikator(2)" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
                </td>
              </tr>
                            
                          </tbody>
          </table>
        </div>
        
        <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-primary  full-right" onclick="addIndikator();"><i class="fa fa-plus"></i> Tambah Indikator</button>
                            </div>
      </div>
      <!-- .row -->

    </div>

    <!-- Modal Tambah -->
    <div id="modalIndikator" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
     <div class="modal-dialog modal-lg">
       <div class="modal-content  panel-primary">
         <div class="panel-heading">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">Tambah Indikator</h4>
         </div>
         <div class="modal-body">

          <form method="POST" id="formIndikator" class="form-horizontal">
            <div id="hidden"></div>
            <div class="form-group">
             <label class="col-md-12">Nama Indikator</label>
             <div class="col-md-12">
               <input type="text" name="iku_sasaran_rpjmd" class="form-control" placeholder="Masukkan Nama Indikator">
             </div>
           </div>

           <div class="form-group">
             <div class="col-md-12">
               <label class="col-sm-12">Satuan Pengukuran</label>
               <div class="col-sm-12">
                 <div class="select2-container form-control select2" id="s2id_autogen1"><a href="javascript:void(0)" class="select2-choice" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-2">Pilih Satuan Pengukuran</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen2" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-2" id="s2id_autogen2"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen2_search" class="select2-offscreen"></label>       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-2" id="s2id_autogen2_search" placeholder="">   </div>   <ul class="select2-results" role="listbox" id="select2-results-2">   </ul></div></div><select name="id_satuan" class="form-control select2" tabindex="-1" title="" style="display: none;">
                  <option value="">Pilih Satuan Pengukuran</option>
                  <option value="4">Lokasi</option><option value="5">Kegiatan</option><option value="6">Titik</option><option value="7">Sasaran</option><option value="8">SR</option><option value="9">Kali</option><option value="10">minggu sekali dalam setahun</option><option value="11">Forum/Kampung</option><option value="12">Kelompok</option><option value="13">Orang</option><option value="14">KK</option><option value="15">Hektar</option><option value="16">Unit</option><option value="17">Ha</option><option value="18">m3/detik</option><option value="19">KM</option><option value="20">Kecamatan</option><option value="21">Route</option><option value="22">Paket</option><option value="23">Organisasi</option><option value="24">Sekolah/Pesantren</option><option value="25">Sekolah</option><option value="26">Siswa/guru</option><option value="27">Siswa</option><option value="28">Peserta</option><option value="29">Penyuluh</option><option value="30">Tokoh</option><option value="31">Responden</option><option value="32">SR</option><option value="33">Kali</option><option value="34">minggu sekali dalam setahun</option><option value="35">Forum/Kampung</option><option value="36">Kelompok</option><option value="37">Orang</option><option value="38">KK</option><option value="39">Hektar</option><option value="40">Unit</option><option value="41">Ha</option><option value="42">m3/detik</option><option value="43">KM</option><option value="44">Kecamatan</option><option value="45">Route</option><option value="46">Paket</option><option value="47">Organisasi</option><option value="48">Sekolah/Pesantren</option><option value="49">Sekolah</option><option value="50">Siswa/guru</option><option value="51">Siswa</option><option value="52">Peserta</option><option value="53">Penyuluh</option><option value="54">Tokoh</option><option value="55">Responden</option><option value="56">Bulan</option><option value="57">Minggu</option><option value="58">Hari</option><option value="59">%</option><option value="60">Dokumen</option><option value="61">jenis</option><option value="62">Rp</option><option value="63">indeks</option><option value="64">program</option><option value="65">perusahaan</option><option value="66">perusahaan</option><option value="67">Jiwa</option><option value="68">Point</option><option value="69">opini</option><option value="70">Status</option><option value="71">Angka</option><option value="72">UMKM</option><option value="73">Skor</option><option value="74">Perda/Perbup</option><option value="75">Jumlah</option><option value="76">Trayek</option><option value="77">Orang/ hari </option><option value="78">Ton</option><option value="79">Ekor</option><option value="80">Ribu Ekor</option><option value="81">Objek</option><option value="82">Desa/kelurahan</option><option value="83">Buah</option><option value="84">Kategori</option><option value="85">Instansi</option><option value="86">IKM</option><option value="87">Wilayah</option><option value="88">Koperasi</option><option value="89">Pasar</option><option value="90">Sub Sektor</option><option value="91">Even</option><option value="92">pangaduan</option><option value="94">Level</option><option value="95">nilai</option><option value="96">laporan</option><option value="97">Kelahiran</option><option value="98">Atlet</option><option value="99">Kg</option><option value="100">Produk</option><option value="101">Kegiatan Promosi</option><option value="102">Pelaku Usaha</option><option value="103">Draft</option><option value="104">Risiko Bencana</option><option value="105">OK</option><option value="106">Sistem Informasi</option><option value="107">Sarana Prasarana</option><option value="108">Gedung</option><option value="109">Obyek</option><option value="110">Media Promosi</option><option value="111">Event / Kali</option><option value="112">Raperda</option><option value="113">SKPD</option><option value="114">Raper KDH</option><option value="115">Berita Acara</option><option value="116">Keputusan</option><option value="117">Surat</option><option value="118">Nota Dinas</option><option value="119">Notulensi</option><option value="120">Telaahan Staff</option><option value="121">Berkas</option>                </select>
              </div>
            </div>
          </div>

          <div class="form-group">

		
			<div class="col-md-6">
		   <table class="table table-bordered p-t-20">
			   <tr class="active"> <td style="text-align: center;"><b>Target Kondisi Awal</b></td></tr>
				<tr><td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Target"></td></tr>
		   </table>
			</div>

			<div class="col-md-6">
		   <table class="table table-bordered p-t-20">
			   <tr class="active"> <td style="text-align: center;"><b>Target Tahun 2019</b></td></tr>
				<tr><td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td></tr>
		   </table>
			</div>

			<div class="col-md-6">
		   <table class="table table-bordered p-t-20">
			   <tr class="active"> <td style="text-align: center;"><b>Taget Tahun 2020</b></td></tr>
				<tr><td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td></tr>
		   </table>
			</div>

			<div class="col-md-6">
		   <table class="table table-bordered p-t-20">
			   <tr class="active"> <td style="text-align: center;"><b>Target Tahun 2021</b></td></tr>
				<tr><td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td></tr>
		   </table>
			</div>

			<div class="col-md-6">
		   <table class="table table-bordered p-t-20">
			   <tr class="active"> <td style="text-align: center;"><b>Target Tahun 2022</b></td></tr>
				<tr><td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td></tr>
		   </table>
			</div>

			<div class="col-md-6">
		   <table class="table table-bordered p-t-20">
			   <tr class="active"> <td style="text-align: center;"><b>Target Tahun 2023</b></td></tr>
				<tr><td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td></tr>
		   </table>
			</div>

			<div class="col-md-6">
		   <table class="table table-bordered p-t-20">
			   <tr class="active"> <td style="text-align: center;"><b>Kondisi Akhir</b></td></tr>
				<tr><td><input type="text" name="kondisi_awal" class="form-control" placeholder="Masukkan Kondisi target"></td></tr>
		   </table>
			</div>



         <hr>

      
		  </div>
      </form></div>
      <div class="modal-footer">
       <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
       <button type="submit" class="btn btn-primary waves-effect text-left">Simpan</button>
     
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>


<div id="hapusIndikator" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Hapus Indikator</h4>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan menghapus Indikator ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tidak</button>
        <a style="color: #fff !important" href="" id="btnDeleteIndikator" class="btn btn-primary waves-effect text-left">Ya</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  function addIndikator(){
    $('#formIndikator')[0].reset();
    $('[name="id_satuan"]').select2("val", '');
    $('[name="id_skpd[]"]').select2("val", '');
    $('#modalIndikator #hidden').html('');
    $('#modalIndikator').modal('show');
    $('#modalIndikator .modal-title').html('Tambah Indikator');
  }


  function editIndikator(id_iku_sasaran_rpjmd){
    $('#formIndikator')[0].reset();
    $('#modalIndikator #hidden').html('<input type="hidden" value="" name="id_iku_sasaran_rpjmd"/>');
    $.ajax({
      url : "https://e-office.sumedangkab.go.id/sasaran_rpjmd/get_indikator_by_id//" + id_iku_sasaran_rpjmd,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="id_iku_sasaran_rpjmd"]').val(data.id_iku_sasaran_rpjmd);
        $('[name="iku_sasaran_rpjmd"]').val(data.iku_sasaran_rpjmd);
        $('[name="id_satuan"]').val(data.id_satuan);
        $('[name="id_satuan"]').select2("val",data.id_satuan);
        $('[name="kondisi_awal"]').val(data.kondisi_awal);
        $('[name="target_2019"]').val(data.target_2019);
        $('[name="target_2020"]').val(data.target_2020);
        $('[name="target_2021"]').val(data.target_2021);
        $('[name="target_2022"]').val(data.target_2022);
        $('[name="target_2023"]').val(data.target_2023);
        $('[name="kondisi_akhir"]').val(data.kondisi_akhir);
        $('[name="id_skpd[]"]').val(data.id_skpd.split(','));
        $('[name="id_skpd[]"]').select2("val",data.id_skpd.split(','));
        $('#modalIndikator').modal('show');
        $('#modalIndikator .modal-title').html('Ubah Indikator');

      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert("Gagal mendapatkan data");
      }
    });
  }

  function hapusIndikator(id_iku_sasaran_rpjmd){
    $('#hapusIndikator').modal('show');
    $('#btnDeleteIndikator').attr('href','https://e-office.sumedangkab.go.id/sasaran_rpjmd/delete_indikator/'+id_iku_sasaran_rpjmd);
  }
</script>
        </div>
        <!-- /#page-wrapper -->
        
<footer class="footer text-center"> Copyright 2021 © Made with <i class="fa fa-heart text-danger"></i> by Diskominfosanditik Sumedang - versi 2.3</footer>    </div>



	<!-- Dropzone Plugin JavaScript -->

<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/dropzone-master/dist/dropzone.js"></script>

<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/calendar/jquery-ui.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/waves.js"></script>
<!-- <script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/mask.js"></script> -->
<!--weather icon -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/skycons/skycons.js"></script>
<!--Morris JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/raphael/raphael-min.js"></script>
<!-- <script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/morrisjs/morris.js"></script> -->
<!-- jQuery for carousel -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/owl.carousel/owl.carousel.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/owl.carousel/owl.custom.js"></script>
<!-- Sparkline chart JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<!--Counter js -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!-- Sweet-Alert  -->

<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
<!-- Magnific popup JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<!--wizard Effects -->

<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js"></script>

<script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/footable-init.js"></script>

<!--  Knob JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/knob/jquery.knob.js"></script>

 <!-- FormValidation -->
 <link rel="stylesheet" href="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css">
    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
    <script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js"></script>
    <script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js"></script>




<!-- Custom Theme JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/custom.min.js"></script>

<script>
function menuOffice() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("mySearch");
  filter = input.value.toUpperCase();
  ul = document.getElementById("side-menu");
  li = ul.getElementsByTagName("li");
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		

		// Defining the local dataset
		var cars = ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen'];

		// Constructing the suggestion engine
		var cars = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.whitespace,
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			local: cars
		});

		// Initializing the typeahead
		$('.typeahead').typeahead({
			hint: true,
			highlight: true,
			/* Enable substring highlighting */
			minLength: 1 /* Specify minimum characters required for showing suggestions */
		}, {
			name: 'cars',
			source: cars
		});
	});
</script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/typeahead.js"></script>
<!-- <script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/calendar/jquery-ui.min.js"></script> -->

<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/moment/moment.js"></script>

<script type="text/javascript" src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<!-- Horizontal-timeline JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/horizontal-timeline/js/horizontal-timeline.js"></script>


<script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/widget.js"></script>

	<script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/chat.js"></script>

	<script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/chat.js"></script>



<!-- Custom Theme JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/switchery/dist/switchery.min.js"></script>

<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
<!-- <script src="https://select2.github.io/select2/select2-3.5.3/select2.js?ts=2015-08-29T20%3A09%3A48%2B00%3A00" type="text/javascript"></script> -->

<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/footable/js/footable.all.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/multiselect/js/jquery.quicksearch.js"></script>

<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
<!-- Color Picker Plugin JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/nestable/jquery.nestable.js"></script>

<!-- Calendar JavaScript -->

<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/calendar/dist/fullcalendar.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/calendar/dist/jquery.fullcalendar.js"></script>

<!-- EASY PIE CHART JS -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/jquery.easy-pie-chart/easy-pie-chart.init.js"></script>






<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
	jQuery(document).ready(function() {
		// Switchery
		var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		$('.js-switch').each(function() {
			new Switchery($(this)[0], $(this).data());

		});

		$('.js-switch2').each(function() {
			var elem = $(this)[0];
			var init = new Switchery(elem, {
				color: '#6003c8'
			});


			if (elem.checked == true) {

				$(elem).siblings(".switchery").css("width", "100px").prepend("<span>Terima</span>").find("small").css("left", "70px");
				$(elem).siblings(".switchery").find("span").text('Terima').css('float', 'left').css('color', '#fff');
				$(elem).siblings(".switchery").find("small").html('<i class="ti-check"></i>');
			} else {

				$(elem).siblings(".switchery").css("width", "100px").prepend("<span>Tolak</span>");
				$(elem).siblings(".switchery").find("span").text('Tolak').css('float', 'right').css('color', '#6003c8');;
				$(elem).siblings(".switchery").find("small").html('<i class="ti-close"></i>');
			}

			elem.onchange = function(e) {
				var catatan = $(elem).parent().next('td').find('input');
				if (elem.checked == true) {
					$(elem).siblings(".switchery").find("span").text('Terima').css('float', 'left').css('color', '#fff');
					$(elem).siblings(".switchery").find("small").html('<i class="ti-check"></i>');
					$(catatan).attr('disabled', 'disabled');
				} else {
					$(elem).siblings(".switchery").find("span").text('Tolak').css('float', 'right').css('color', '#6003c8');;
					$(elem).siblings(".switchery").find("small").html('<i class="ti-close"></i>');
					$(catatan).removeAttr('disabled');
				}
			};


		});


		$('.js-switch3').each(function() {
			var elem = $(this)[0];
			var init = new Switchery(elem, {
				color: '#6003c8'
			});


			if (elem.checked == true) {

				$(elem).siblings(".switchery").css("width", "200px").prepend("<span>Dijadwalkan</span>").find("small").css("left", "70px");
				$(elem).siblings(".switchery").find("span").text('Dijadwalkan').css('float', 'left').css('color', '#fff');
				$(elem).siblings(".switchery").find("small").html('<i class="ti-check"></i>');
			} else {

				$(elem).siblings(".switchery").css("width", "200px").prepend("<span>Tidak Dijadwalkan</span>");
				$(elem).siblings(".switchery").find("span").text('Tidak Dijadwalkan').css('float', 'right').css('color', '#6003c8');;
				$(elem).siblings(".switchery").find("small").html('<i class="ti-close"></i>');
			}

			elem.onchange = function(e) {
				var catatan = $(elem).parent().next('td').find('input');
				if (elem.checked == true) {
					$(elem).siblings(".switchery").find("span").text('Dijadwalkan').css('float', 'left').css('color', '#fff');
					$(elem).siblings(".switchery").find("small").html('<i class="ti-check"></i>');
					$(catatan).removeAttr('disabled');
				} else {
					$(elem).siblings(".switchery").find("span").text('Tidak Dijadwalkan').css('float', 'right').css('color', '#6003c8');;
					$(elem).siblings(".switchery").find("small").html('<i class="ti-close"></i>');
					$(catatan).attr('disabled', 'disabled');
				}
			};


		});
		// For select 2

		$(".select2").select2();
		$('.selectpicker').selectpicker();

		//Bootstrap-TouchSpin
		$(".vertical-spin").TouchSpin({
			verticalbuttons: true,
			verticalupclass: 'ti-plus',
			verticaldownclass: 'ti-minus'
		});
		var vspinTrue = $(".vertical-spin").TouchSpin({
			verticalbuttons: true
		});
		if (vspinTrue) {
			$('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
		}

		$("input[name='tch1']").TouchSpin({
			min: 0,
			max: 100,
			step: 0.1,
			decimals: 2,
			boostat: 5,
			maxboostedstep: 10,
			postfix: '%'
		});
		$("input[name='tch2']").TouchSpin({
			min: -1000000000,
			max: 1000000000,
			stepinterval: 50,
			maxboostedstep: 10000000,
			prefix: '$'
		});
		$("input[name='tch3']").TouchSpin();

		$("input[name='tch3_22']").TouchSpin({
			initval: 40
		});

		$("input[name='tch5']").TouchSpin({
			prefix: "pre",
			postfix: "post"
		});

		// For multiselect

		$('#pre-selected-options').multiSelect();
		$('#optgroup').multiSelect({
			selectableHeader: "<input type='text' style='margin-bottom:10px' class='search-input form-control' autocomplete='off' placeholder='Cari Penerima ... '>",
			selectionHeader: "<input type='text' style='margin-bottom:10px' class='search-input form-control' autocomplete='off' placeholder='Cari Penerima ...'>",
			afterInit: function(ms) {
				var that = this,
					$selectableSearch = that.$selectableUl.prev(),
					$selectionSearch = that.$selectionUl.prev(),
					selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
					selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

				that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
					.on('keydown', function(e) {
						if (e.which === 40) {
							that.$selectableUl.focus();
							return false;
						}
					});

				that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
					.on('keydown', function(e) {
						if (e.which == 40) {
							that.$selectionUl.focus();
							return false;
						}
					});
			},
			afterSelect: function() {
				this.qs1.cache();
				this.qs2.cache();
			},
			afterDeselect: function() {
				this.qs1.cache();
				this.qs2.cache();
			}
		});

		$('#public-methods').multiSelect();
		$('#select-all').click(function() {
			$('#public-methods').multiSelect('select_all');
			return false;
		});
		$('#deselect-all').click(function() {
			$('#public-methods').multiSelect('deselect_all');
			return false;
		});
		$('#refresh').on('click', function() {
			$('#public-methods').multiSelect('refresh');
			return false;
		});
		$('#add-option').on('click', function() {
			$('#public-methods').multiSelect('addOption', {
				value: 42,
				text: 'test 42',
				index: 0
			});
			return false;
		});

		/*----- BEGIN OF PAGINATION */

		if(typeof loadPagination==="function"){
				loadPagination(1);
		}

		var pagination = document.getElementById("pagination");
		if(pagination){
				$('#pagination').on('click','a',function(e){
						e.preventDefault();
						var pageno = $(this).attr('data-ci-pagination-page');
						if(typeof loadPagination==="function"){
								loadPagination(pageno);
						}
				});

		}

		if(typeof loadPagination2==="function"){
				loadPagination2(1);
		}

		var pagination2 = document.getElementById("pagination2");
		if(pagination){
				$('#pagination2').on('click','a',function(e){
						e.preventDefault();
						var pageno = $(this).attr('data-ci-pagination-page');
						if(typeof loadPagination2==="function"){
								loadPagination2(pageno);
						}
				});

		}



		/*----- END OF PAGINATION */

		// checkall
		$('#check_all').click(function(){
				if(this.checked) {
						// Iterate each checkbox
						$(':checkbox').each(function() {
								this.checked = true;
						});
				} else {
						$(':checkbox').each(function() {
								this.checked = false;
						});
				}

		});

		
	});
</script>


<!-- jQuery file upload -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
<script>
	$(document).ready(function() {
		// Basic
		$('.dropify').dropify();

		// Translated
		$('.dropify-fr').dropify({
			messages: {
				default: 'Glissez-déposez un fichier ici ou cliquez',
				replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
				remove: 'Supprimer',
				error: 'Désolé, le fichier trop volumineux'
			}
		});

		// Used events
		var drEvent = $('#input-file-events').dropify();

		drEvent.on('dropify.beforeClear', function(event, element) {
			return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
		});

		drEvent.on('dropify.afterClear', function(event, element) {
			alert('File deleted');
		});

		drEvent.on('dropify.errors', function(event, element) {
			console.log('Has Errors');
		});

		var drDestroy = $('#input-file-to-destroy').dropify();
		drDestroy = drDestroy.data('dropify')
		$('#toggleDropify').on('click', function(e) {
			e.preventDefault();
			if (drDestroy.isDropified()) {
				drDestroy.destroy();
			} else {
				drDestroy.init();
			}
		})
	});
</script>

<script>
	// Clock pickers
	$('#single-input').clockpicker({
		placement: 'bottom',
		align: 'left',
		autoclose: true,
		'default': 'now'

	});

	$('.clockpicker').clockpicker({
			donetext: 'Done',

		})
		.find('input').change(function() {
			console.log(this.value);
		});

	$('#check-minutes').click(function(e) {
		// Have to stop propagation here
		e.stopPropagation();
		input.clockpicker('show')
			.clockpicker('toggleView', 'minutes');
	});
	// if (/mobile/i.test(navigator.userAgent)) {
	// 	$('input').prop('readOnly', true);
	// }
	// Colorpicker

	$(".colorpicker").asColorPicker();
	$(".complex-colorpicker").asColorPicker({
		mode: 'complex'
	});
	$(".gradient-colorpicker").asColorPicker({
		mode: 'gradient'
	});
	// Date Picker
	jQuery('.mydatepicker, #datepicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		todayHighlight: true
		// startDate: new Date('2018-7-1'),
		// endDate: new Date('2018-7-29')
	});
	jQuery('#tanggalpicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		todayHighlight: true
		// startDate: new Date('2018-7-1'),
		// endDate: new Date('2018-7-29')
	});
	jQuery('.timepicker, #timepicker').timepicker();
	jQuery('#datepicker-autoclose').datepicker({
		autoclose: true,
		todayHighlight: true
	});

	jQuery('#date-range').datepicker({
		toggleActive: true
	});
	jQuery('#datepicker-inline').datepicker({

		todayHighlight: true
	});


	// Daterange picker

	$('.input-daterange-datepicker').daterangepicker({
		buttonClasses: ['btn', 'btn-sm'],
		applyClass: 'btn-danger',
		cancelClass: 'btn-inverse'
	});
	$('.input-daterange-timepicker').daterangepicker({
		timePicker: true,
		format: 'MM/DD/YYYY h:mm A',
		timePickerIncrement: 30,
		timePicker12Hour: true,
		timePickerSeconds: false,
		buttonClasses: ['btn', 'btn-sm'],
		applyClass: 'btn-danger',
		cancelClass: 'btn-inverse'
	});
	$('.input-limit-datepicker').daterangepicker({
		format: 'MM/DD/YYYY',
		minDate: $mindate,
		maxDate: $maxdate,
		buttonClasses: ['btn', 'btn-sm'],
		applyClass: 'btn-success',
		cancelClass: 'btn-inverse',
		// dateLimit: {
		//     days: $dayslimit
		// }
	});

	$('#event-calendar').fullCalendar({
		events: [
			// events here
		],
		editable: true,
		eventDrop: function(event, delta, revertFunc) {

			alert(event.title + " was dropped on " + event.start.format());

			if (!confirm("Are you sure about this change?")) {
				revertFunc();
			}

		}
	});
</script>
<!--Style Switcher -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/blockUI/jquery.blockUI.js"></script>

<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/inputmask/dist/jquery.inputmask.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/push.js/bin/push.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/push.js/bin/serviceWorker.min.js"></script>
<script type="text/javascript">
	// $('input[name="nomer_surat"]').inputmask("9-a{1,3}9{1,3}");
</script>
<script src="https://e-office.sumedangkab.go.id//socket/node_modules/socket.io-client/dist/socket.io.js"></script>
<script type="text/javascript">
	var base_url = 'https://e-office.sumedangkab.go.id/';
	var server_url = 'e-office.sumedangkab.go.id';
	var user_id = '23';
	// $('a[href="https://e-office.sumedangkab.go.id/surat_internal/verifikasi_surat"]').append('<span class="label label-rouded label-primary pull-right">12</span>');
	// alert($('.count[href="https://e-office.sumedangkab.go.id/surat_internal/verifikasi_surat"]').html());
	function refresh_notification() {
		$.get(base_url + 'pemberitahuan/fetch_count', function(res) {
			var res = JSON.parse(res);
			$.each(res, function(k, v) {
				var navbar = $('.count[href="https://e-office.sumedangkab.go.id/' + k + '"]');
				if (v > 0) {
					if (navbar.find('span').length > 0) {
						navbar.find('span').html(v);
					} else {
						navbar.append('<span id="' + k + '" class="label label-rouded label-primary pull-right">' + v + '</span>');
					}
				} else {
					if (navbar.find('span').length > 0) {
						$('.count[href="https://e-office.sumedangkab.go.id/' + k + '"] span').remove();
					}
				}
			});
		});
		$.get(base_url + 'pemberitahuan/fetch_some_unread', function(res) {
			var res = JSON.parse(res);
			if (res.status) {
				$('#notif_bubble').show();
				$('#notification_list').html('');
				$.each(res.data, function() {
					$('#notification_list').append('<li> <div class="message-center"> <a href="' + this.link + '"><div class="mail-contnet"> <h5>' + this.title + '</h5> <span class="mail-desc">' + this.message + '</span> <span class="time">' + this.time + '</span> </div></a> </div></li>');
				});
			} else {
				$('#notif_bubble').hide();
				$('#notification_list').html('<li id="notif_none"> <div class="message-center"> <div class="mail-contnet" style="padding: 10px;text-align: center;"> <i style="color: #6003c8; font-size: 30px;" class="text-primary icon-hourglass"></i> <p>Tidak ada pemberitahuan terbaru</p></div></div></li>');
			}
			$('#notification_list').append(' <li class="read-more"> <a style="padding: 5px" class="text-center" href="' + base_url + 'pemberitahuan">Lihat semua pemberitahuan <i class="ti-arrow-circle-right"></i> </a> </li>');
		});
		$.get(base_url + 'pemberitahuan/fetch_all', function(res) {
			var res = JSON.parse(res);
			if (res.status) {
				$('#all_notification_list').html('');
				$.each(res.data, function() {
					if (this.read_status == "1") {
						var read_class = '';
						var btn_class = ' btn-outline';
					} else {
						var read_class = ' read';
						var btn_class = '';
					}
					$('#all_notification_list').append('<li style="margin-top: 5px;position: relative;"> <div style="padding-left: 5px" class="message-center' + read_class + '"> <a href="' + this.link + '"><div class="mail-contnet"> <h5>' + this.title + '</h5> <span class="mail-desc">' + this.message + '</span> <span class="time">' + this.time + '</span> </div></a> <div class="btn-group" style="position: absolute;top: 0;right: 0;margin-top: 5px;margin-right: 5px"> <button aria-expanded="false" data-toggle="dropdown" class="btn btn-circle' + btn_class + ' btn-primary dropdown-toggle waves-effect waves-light" type="button"> <i class="icon-options"></i></button> <ul role="menu" class="dropdown-menu pull-right"> <li><a href="javasciprt:void(0)" onclick="showModalDelete(\'' + this.notification_id + '\')">Hapus Notifikasi</a></li></ul> </div></div></li>');
				});
			} else {
				$('#all_notification_list').html('<li id="notif_none"> <div class="message-center"> <div class="mail-contnet" style="padding: 10px;text-align: center;"> <i style="color: #6003c8; font-size: 30px;" class="text-primary icon-hourglass"></i> <p>Tidak ada pemberitahuan</p></div></div></li>');
			}
		});
	}
	$(document).ready(function() {
		refresh_notification();
	});
</script>
<script src="https://e-office.sumedangkab.go.id//socket/client_socket.js?v=1.5"></script>

<script>
	$(document).ready(function() {
		$(".textarea_editor").each(function() {
			$(this).wysihtml5();
		});

		// var audio = new Audio('https://e-office.sumedangkab.go.id//socket/definite.mp3');
		// audio.play();

	});
</script>





<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script>
	$(document).ready(function() {
		$('#myTable').DataTable();

		
		$('#myTable').DataTable();
		$('#myTable1').DataTable();


		$('#tableSimple').DataTable({
			"searching": false,
			"lengthChange": false,
			"ordering": false
		});

		$(document).ready(function() {
			var table = $('#example').DataTable({
				"columnDefs": [{
					"visible": false,
					"targets": 2
				}],
				"order": [
					[2, 'asc']
				],
				"displayLength": 25,
				"drawCallback": function(settings) {
					var api = this.api();
					var rows = api.rows({
						page: 'current'
					}).nodes();
					var last = null;
					api.column(2, {
						page: 'current'
					}).data().each(function(group, i) {
						if (last !== group) {
							$(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
							last = group;
						}
					});
				}
			});
			// Order by the grouping
			$('#example tbody').on('click', 'tr.group', function() {
				var currentOrder = table.order()[0];
				if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
					table.order([2, 'desc']).draw();
				} else {
					table.order([2, 'asc']).draw();
				}
			});
		});
	});
	$('#example23').DataTable({
		dom: 'Bfrtip',
		"order": [
			[0, "desc"]
		],
		buttons: [
			'excel', 'pdf', 'print'
		]
	});


	$('#example99').DataTable({
		dom: 'Bfrtip',
		buttons: [
			'excel', 'pdf', 'print','csv'
		]
	});



	function export_filtered() {

		var data_filtered = table.buttons.exportData({
			columns: ':visible'
		});

		var id_data = '';

		for (var i = Object.keys(data_filtered.body).length - 1; i >= 0; i--) {
			id_data += 'id:' + data_filtered['body'][i][0] + '\n';
		}
		alert(JSON.stringify(data_filtered) + id_data);
	}
</script>


<script type="text/javascript" src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/orgchart/orgchart.js"></script>
<script type="text/javascript">
	var base_url = "https://e-office.sumedangkab.go.id/";
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
<script>
	$(function() {
		$('[data-plugin="knob"]').knob();
	});
</script>

<!-- Check Semua -->
<script type="text/javascript">
	$(function() {
		$('.checkall').on('click', function() {
			$('.child').prop('checked', this.checked)
		});
	});
</script>
<!-- Flot Charts JavaScript -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/flot/excanvas.min.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/flot/jquery.flot.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/flot/jquery.flot.pie.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/flot/jquery.flot.resize.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/flot/jquery.flot.time.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/flot/jquery.flot.stack.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/flot/jquery.flot.crosshair.js"></script>
<script src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<!-- <script src="https://e-office.sumedangkab.go.id/asset/pixel/inverse/js/flot-data.js"></script> -->

<!-- chartJs with PluginJs -->
<script type="text/javascript">
	! function($) {
		"use strict";

		var EasyPieChart = function() {};

		EasyPieChart.prototype.init = function() {
				//initializing various types of easy pie charts
				$('.easy-pie-chart-1').easyPieChart({
					easing: 'easeOutBounce',
					barColor: '#13dafe',
					lineWidth: 3,
					animate: 1000,
					lineCap: 'square',
					trackColor: '#e5e5e5',
					onStep: function(from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
				});
				$('.easy-pie-chart-2').easyPieChart({
					easing: 'easeOutBounce',
					barColor: '#99d683',
					lineWidth: 3,
					trackColor: false,
					lineCap: 'butt',
					onStep: function(from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
				});
				$('.easy-pie-chart-3').easyPieChart({
					easing: 'easeOutBounce',
					barColor: '#6164c1',
					lineWidth: 3,
					lineCap: 'square',
					trackColor: false,
					onStep: function(from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
				});
				$('.easy-pie-chart-4').easyPieChart({
					easing: 'easeOutBounce',
					barColor: '#13dafe',
					lineWidth: 3,
					scaleColor: false,
					onStep: function(from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
				});
				$('.easy-pie-chart-5').easyPieChart({
					easing: 'easeOutBounce',
					barColor: '#99d683',
					lineWidth: 3,
					scaleColor: false,
					onStep: function(from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
				});
				$('.easy-pie-chart-6').easyPieChart({
					easing: 'easeOutBounce',
					barColor: '#6164c1',
					lineWidth: 3,
					scaleColor: false,
					onStep: function(from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
				});
			},
			//init
			$.EasyPieChart = new EasyPieChart, $.EasyPieChart.Constructor = EasyPieChart
	}(window.jQuery),

	//initializing
	function($) {
		"use strict";
		$.EasyPieChart.init()
	}(window.jQuery);
</script>
<!-- Bootstrap Datetime Picker -->
<script src="https://e-office.sumedangkab.go.id/assets/js/bootstrap-datetime-picker.js"></script>
<!--Style Switcher -->
<script src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
<script>
	$('#files_laporan_rapat').change(function() {
		var i = $(this).prev('a').clone();
		var file = $('#files_laporan_rapat')[0].files[0].name;
		$(this).prev('a').text(file);
	});
</script>
<script>
	$("#file_respons").change(function() {
		$("#name_file").text(this.files[0].name);
	});
</script>
<script>
	$("#files_laporan_rapat").change(function() {
		$("#files_laporan_rapat_new").text(this.files[0].name);
		$("#files_laporan_rapat_old").hide();
	});
</script>
<!-- Details Kepegawaian -->
<script>
	$(document).ready(function() {
		$("#form_riwayat_pangkat").hide();
		$("#tambah_riwayat_pangkat").click(function() {
			$("#table_riwayat_pangkat").hide();
			$("#form_riwayat_pangkat").show();
		});
		$("#lihat_riwayat_pangkat").click(function() {
			$("#table_riwayat_pangkat").show();
			$("#form_riwayat_pangkat").hide();
		});
	});
	$(document).ready(function() {
		$("#form_riwayat_jabatan").hide();
		$("#tambah_riwayat_jabatan").click(function() {
			$("#table_riwayat_jabatan").hide();
			$("#form_riwayat_jabatan").show();
		});
		$("#lihat_riwayat_jabatan").click(function() {
			$("#table_riwayat_jabatan").show();
			$("#form_riwayat_jabatan").hide();
		});
	});
	$(document).ready(function() {
		$("#form_riwayat_pendidikan").hide();
		$("#tambah_riwayat_pendidikan").click(function() {
			$("#table_riwayat_pendidikan").hide();
			$("#form_riwayat_pendidikan").show();
		});
		$("#lihat_riwayat_pendidikan").click(function() {
			$("#table_riwayat_pendidikan").show();
			$("#form_riwayat_pendidikan").hide();
		});
	});
	$(document).ready(function() {
		$("#form_riwayat_diklat").hide();
		$("#tambah_riwayat_diklat").click(function() {
			$("#table_riwayat_diklat").hide();
			$("#form_riwayat_diklat").show();
		});
		$("#lihat_riwayat_diklat").click(function() {
			$("#table_riwayat_diklat").show();
			$("#form_riwayat_diklat").hide();
		});
		$("#form_riwayat_penataran").hide();
		$("#tambah_riwayat_penataran").click(function() {
			$("#table_riwayat_penataran").hide();
			$("#form_riwayat_penataran").show();
		});
		$("#lihat_riwayat_penataran").click(function() {
			$("#table_riwayat_penataran").show();
			$("#form_riwayat_penataran").hide();
		});
		$("#form_riwayat_seminar").hide();
		$("#tambah_riwayat_seminar").click(function() {
			$("#table_riwayat_seminar").hide();
			$("#form_riwayat_seminar").show();
		});
		$("#lihat_riwayat_seminar").click(function() {
			$("#table_riwayat_seminar").show();
			$("#form_riwayat_seminar").hide();
		});
		$("#form_riwayat_kursus").hide();
		$("#tambah_riwayat_kursus").click(function() {
			$("#table_riwayat_kursus").hide();
			$("#form_riwayat_kursus").show();
		});
		$("#lihat_riwayat_kursus").click(function() {
			$("#table_riwayat_kursus").show();
			$("#form_riwayat_kursus").hide();
		});
		$("#form_riwayat_unit_kerja").hide();
		$("#tambah_riwayat_unit_kerja").click(function() {
			$("#table_riwayat_unit_kerja").hide();
			$("#form_riwayat_unit_kerja").show();
		});
		$("#lihat_riwayat_unit_kerja").click(function() {
			$("#table_riwayat_unit_kerja").show();
			$("#form_riwayat_unit_kerja").hide();
		});
		$("#form_riwayat_penghargaan").hide();
		$("#tambah_riwayat_penghargaan").click(function() {
			$("#table_riwayat_penghargaan").hide();
			$("#form_riwayat_penghargaan").show();
		});
		$("#lihat_riwayat_penghargaan").click(function() {
			$("#table_riwayat_penghargaan").show();
			$("#form_riwayat_penghargaan").hide();
		});
		$("#form_riwayat_penugasan").hide();
		$("#tambah_riwayat_penugasan").click(function() {
			$("#table_riwayat_penugasan").hide();
			$("#form_riwayat_penugasan").show();
		});
		$("#lihat_riwayat_penugasan").click(function() {
			$("#table_riwayat_penugasan").show();
			$("#form_riwayat_penugasan").hide();
		});
		$("#form_riwayat_cuti").hide();
		$("#tambah_riwayat_cuti").click(function() {
			$("#table_riwayat_cuti").hide();
			$("#form_riwayat_cuti").show();
		});
		$("#lihat_riwayat_cuti").click(function() {
			$("#table_riwayat_cuti").show();
			$("#form_riwayat_cuti").hide();
		});
		$("#form_riwayat_hukuman").hide();
		$("#tambah_riwayat_hukuman").click(function() {
			$("#table_riwayat_hukuman").hide();
			$("#form_riwayat_hukuman").show();
		});
		$("#lihat_riwayat_hukuman").click(function() {
			$("#table_riwayat_hukuman").show();
			$("#form_riwayat_hukuman").hide();
		});
		$("#form_riwayat_bahasa").hide();
		$("#tambah_riwayat_bahasa").click(function() {
			$("#table_riwayat_bahasa").hide();
			$("#form_riwayat_bahasa").show();
		});
		$("#lihat_riwayat_bahasa").click(function() {
			$("#table_riwayat_bahasa").show();
			$("#form_riwayat_bahasa").hide();
		});
		$("#form_riwayat_bahasa_asing").hide();
		$("#tambah_riwayat_bahasa_asing").click(function() {
			$("#table_riwayat_bahasa_asing").hide();
			$("#form_riwayat_bahasa_asing").show();
		});
		$("#lihat_riwayat_bahasa_asing").click(function() {
			$("#table_riwayat_bahasa_asing").show();
			$("#form_riwayat_bahasa_asing").hide();
		});
		$("#form_riwayat_pernikahan").hide();
		$("#tambah_riwayat_pernikahan").click(function() {
			$("#table_riwayat_pernikahan").hide();
			$("#form_riwayat_pernikahan").show();
		});
		$("#lihat_riwayat_pernikahan").click(function() {
			$("#table_riwayat_pernikahan").show();
			$("#form_riwayat_pernikahan").hide();
		});
		$("#form_riwayat_anak").hide();
		$("#tambah_riwayat_anak").click(function() {
			$("#table_riwayat_anak").hide();
			$("#form_riwayat_anak").show();
		});
		$("#lihat_riwayat_anak").click(function() {
			$("#table_riwayat_anak").show();
			$("#form_riwayat_anak").hide();
		});
		$("#form_riwayat_orangtua").hide();
		$("#tambah_riwayat_orangtua").click(function() {
			$("#table_riwayat_orangtua").hide();
			$("#form_riwayat_orangtua").show();
		});
		$("#lihat_riwayat_orangtua").click(function() {
			$("#table_riwayat_orangtua").show();
			$("#form_riwayat_orangtua").hide();
		});
		$("#form_riwayat_mertua").hide();
		$("#tambah_riwayat_mertua").click(function() {
			$("#table_riwayat_mertua").hide();
			$("#form_riwayat_mertua").show();
		});
		$("#lihat_riwayat_mertua").click(function() {
			$("#table_riwayat_mertua").show();
			$("#form_riwayat_mertua").hide();
		});
		// edit
		$("#form_biodata").hide();
		$("#edit_biodata").click(function() {
			$("#list_biodata").hide();
			$("#form_biodata").show();
		});
		$("#lihat_biodata").click(function() {
			$("#list_biodata").show();
			$("#form_biodata").hide();
		});
	});

	function getJabatan() {
		var jenis_jabatan = $("#jenis_jabatan").val();
		if (jenis_jabatan == 1) {
			$("#id_eselon").attr("disabled", false);
		} else {
			$("#id_eselon").attr("disabled", true);
			$("#id_eselon").val("");
		}
		if (jenis_jabatan == "") $("#jab_level1").html("<option value=''>Pilih</option>");
	}

	function current_histoty(self, target) {
		var val = $("#" + self).val();
		if (val == 0) {
			$("#" + self).val(1);
			$("#" + target).attr('disabled', true);
			$("#" + target).val(1111 - 11 - 11);
		} else if (val == 1) {
			$("#" + self).val(0);
			$("#" + target).attr('disabled', false);
		}
	}
	// <!-- Form -->
	var arrGol = new Array;
	var id_pegawai_upload = "";
	var id_riwayat_upload = "";
	var jenis_riwayat_upload = "";
		$('#id_kabupaten').prop('disabled', 'disabled');
	$('#id_kecamatan').prop('disabled', 'disabled');
	$('#id_desa').prop('disabled', 'disabled');

	function setGol() {
		var id_gol = $("#id_golongan").val();
		var golongan = arrGol[id_gol][1];
		$("#txt_golongan").val(golongan);
	}

	function getKabupaten() {
		var id = $('#id_provinsi').val();
		$('#id_kabupaten').prop('disabled', false);
		$('#id_desa').html('<option value="">Pilih</option>');
		$('#id_kecamatan').html('<option value="">Pilih</option>');
		$.post("https://e-office.sumedangkab.go.id/dashboard_user/get_kabupaten/" + id, {}, function(obj) {
			$('#id_kabupaten').html(obj);
		});

	}

	function getKecamatan() {
		var id = $('#id_kabupaten').val();
		$('#id_kecamatan').prop('disabled', false);
		$('#id_desa').html('<option value="">Pilih</option>');
		$.post("https://e-office.sumedangkab.go.id/dashboard_user/get_kecamatan/" + id, {}, function(obj) {
			$('#id_kecamatan').html(obj);
		});

	}

	function getDesa() {
		var id = $('#id_kecamatan').val();
		$('#id_desa').prop('disabled', false);
		$.post("https://e-office.sumedangkab.go.id/dashboard_user/get_desa/" + id, {}, function(obj) {
			$('#id_desa').html(obj);
		});
	}

	</script>
<script type="text/javascript" src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/tableExport/libs/FileSaver/FileSaver.min.js"></script>
<script type="text/javascript" src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/tableExport/libs/js-xlsx/xlsx.core.min.js"></script>
<script type="text/javascript" src="https://e-office.sumedangkab.go.id/asset/pixel//plugins/bower_components/tableExport/tableExport.min.js"></script>

<script type="text/javascript">
	function downloadExcel(id, filename) {
		$('#' + id).tableExport({
			type: 'excel',
			fileName: filename,
			mso: {
				fileFormat: 'xlshtml',
				styles: ['background-color',
					'border-top-color', 'border-left-color', 'border-right-color', 'border-bottom-color',
					'border-top-width', 'border-left-width', 'border-right-width', 'border-bottom-width',
					'border-top-style', 'border-left-style', 'border-right-style', 'border-bottom-style',
					'color', 'font-size', 'font-weight', 'padding-top', 'padding-bottom', 'padding-left', 'padding-right', 'vertical-align'
				]
			}
		});
	}

	function downloadExcelMulti(classname, filename) {
		$('.' + classname).tableExport({
			type: 'excel',
			fileName: filename,
			worksheetName: ['Table 1', 'Table 2'],
			mso: {
				fileFormat: 'xlshtml',
				styles: ['background-color',
					'border-top-color', 'border-left-color', 'border-right-color', 'border-bottom-color',
					'border-top-width', 'border-left-width', 'border-right-width', 'border-bottom-width',
					'border-top-style', 'border-left-style', 'border-right-style', 'border-bottom-style',
					'color', 'font-size', 'font-weight', 'padding-top', 'padding-bottom', 'padding-left', 'padding-right', 'vertical-align'
				]
			}
		});
	}
</script>

<script type="text/javascript" src="https://e-office.sumedangkab.go.id/asset/zoomscroll/file/dragscroll.js"></script>

<!-- <script src="https://e-office.sumedangkab.go.id/asset/zoomscroll/file/jquery-1.9.1.js"></script> -->
<!-- <script src="https://rawgithub.com/brandonaaron/jquery-mousewheel/master/mousewheel.jquery.json"></script> -->
<script src="https://e-office.sumedangkab.go.id/asset/zoomscroll/file/jquery.mousewheel.js"></script>

<script type="text/javascript">
	// zooming on mouse cursor with adjusting -transform-origin
	// moving the zooming frame with the -transfrorm matrix

	/*****************************************************
	 * Transformations
	 ****************************************************/
	function Transformations(originX, originY, translateX, translateY, scale) {
		this.originX = originX;
		this.originY = originY;
		this.translateX = translateX;
		this.translateY = translateY;
		this.scale = scale;
	}

	/* Getters */
	Transformations.prototype.getScale = function() {
		return this.scale;
	}
	Transformations.prototype.getOriginX = function() {
		return this.originX;
	}
	Transformations.prototype.getOriginY = function() {
		return this.originY;
	}
	Transformations.prototype.getTranslateX = function() {
		return this.translateX;
	}
	Transformations.prototype.getTranslateY = function() {
		return this.translateY;
	}

	/*****************************************************
	 * Zoom Pan Renderer
	 ****************************************************/
	function ZoomPanRenderer(elementId) {
		this.zooming = undefined;
		this.elementId = elementId;
		this.current = new Transformations(0, 0, 0, 0, 1);
		this.last = new Transformations(0, 0, 0, 0, 1);
		new ZoomPanEventHandlers(this);
	}

	/* setters */
	ZoomPanRenderer.prototype.setCurrentTransformations = function(t) {
		this.current = t;
	}
	ZoomPanRenderer.prototype.setZooming = function(z) {
		this.zooming = z;
	}

	/* getters */
	ZoomPanRenderer.prototype.getCurrentTransformations = function() {
		return this.current;
	}
	ZoomPanRenderer.prototype.getZooming = function() {
		return this.zooming;
	}
	ZoomPanRenderer.prototype.getLastTransformations = function() {
		return this.last;
	}
	ZoomPanRenderer.prototype.getElementId = function() {
		return this.elementId;
	}

	/* Rendering */
	ZoomPanRenderer.prototype.getTransform2d = function(t) {
		var transform2d = "matrix(";
		transform2d += t.getScale().toFixed(1) + ",0,0," + t.getScale().toFixed(1) + "," + t.getTranslateX().toFixed(1) + "," + t.getTranslateY().toFixed(1) + ")";
		//0,0)";
		return transform2d;
	}

	ZoomPanRenderer.prototype.applyTransformations = function(t) {
		var elem = $("#" + this.getElementId());
		var orig = t.getOriginX().toFixed(10) + "px " + t.getOriginY().toFixed(10) + "px";
		elem.css("transform-origin", orig);
		elem.css("-ms-transform-origin", orig);
		elem.css("-o-transform-origin", orig);
		elem.css("-moz-transform-origin", orig);
		elem.css("-webkit-transform-origin", orig);
		var transform2d = this.getTransform2d(t);
		elem.css("transform", transform2d);
		elem.css("-ms-transform", transform2d);
		elem.css("-o-transform", transform2d);
		elem.css("-moz-transform", transform2d);
		elem.css("-webkit-transform", transform2d);
	}

	/*****************************************************
	 * Event handler
	 ****************************************************/
	function ZoomPanEventHandlers(renderer) {
		this.renderer = renderer;

		/* Disable scroll overflow - safari */
		document.addEventListener('touchmove', function(e) {
			e.preventDefault();
		}, false);

		/* Disable default drag opeartions on the element (FF makes it ready for save)*/
		$("#" + renderer.getElementId()).bind('dragstart', function(e) {
			e.preventDefault();
		});

		/* Add mouse wheel handler */
		$("#" + renderer.getElementId()).bind("mousewheel", function(event, delta) {
			if (renderer.getZooming() == undefined) {
				var offsetLeft = $("#" + renderer.getElementId()).offset().left;
				var offsetTop = $("#" + renderer.getElementId()).offset().top;
				var zooming = new MouseZoom(renderer.getCurrentTransformations(), event.pageX, event.pageY, offsetLeft, offsetTop, delta);
				renderer.setZooming(zooming);

				var newTransformation = zooming.zoom();
				renderer.applyTransformations(newTransformation);
				renderer.setCurrentTransformations(newTransformation);
				renderer.setZooming(undefined);
			}
			return false;
		});
	}

	/*****************************************************
	 * Mouse zoom
	 ****************************************************/
	function MouseZoom(t, mouseX, mouseY, offsetLeft, offsetTop, delta) {
		this.current = t;
		this.offsetLeft = offsetLeft;
		this.offsetTop = offsetTop;
		this.mouseX = mouseX;
		this.mouseY = mouseY;
		this.delta = delta;
	}

	MouseZoom.prototype.zoom = function() {
		// current scale
		var previousScale = this.current.getScale();
		// new scale
		var newScale = previousScale + this.delta / 10;
		// scale limits
		var maxscale = 1;
		if (newScale < 0.2) {
			newScale = 0.2;
		} else if (newScale > maxscale) {
			newScale = maxscale;
		}
		// current cursor position on image
		var imageX = (this.mouseX - this.offsetLeft).toFixed(2);
		var imageY = (this.mouseY - this.offsetTop).toFixed(2);
		// previous cursor position on image
		var prevOrigX = (this.current.getOriginX() * previousScale).toFixed(2);
		var prevOrigY = (this.current.getOriginY() * previousScale).toFixed(2);
		// previous zooming frame translate
		var translateX = this.current.getTranslateX();
		var translateY = this.current.getTranslateY();
		// set origin to current cursor position
		var newOrigX = imageX / previousScale;
		var newOrigY = imageY / previousScale;

		// move zooming frame to current cursor position
		if ((Math.abs(imageX - prevOrigX) > 1 || Math.abs(imageY - prevOrigY) > 1) && previousScale < maxscale) {
			translateX = translateX + (imageX - prevOrigX) * (1 - 1 / previousScale);
			translateY = translateY + (imageY - prevOrigY) * (1 - 1 / previousScale);
		}
		// stabilize position by zooming on previous cursor position
		else if (previousScale != 1 || imageX != prevOrigX && imageY != prevOrigY) {
			newOrigX = prevOrigX / previousScale;
			newOrigY = prevOrigY / previousScale;
			//frame limit
		}
		// on zoom-out limit frame shifts to original frame
		if (this.delta <= 0) {
			var width = 0;
			var height = 0;
			if (translateX + newOrigX + (width - newOrigX) * newScale <= width) {
				translateX = 0;
				newOrigX = width;
			} else if (translateX + newOrigX * (1 - newScale) >= 0) {
				translateX = 0;
				newOrigX = 0;
			}
			if (translateY + newOrigY + (height - newOrigY) * newScale <= height) {
				translateY = 0;
				newOrigY = height;
			} else if (translateY + newOrigY * (1 - newScale) >= 0) {
				translateY = 0;
				newOrigY = 0;
			}
		}

		return new Transformations(newOrigX, newOrigY, translateX, translateY, newScale);
	}

	$(document).ready(function() {

		console.log($('#jenis_pengajuan_surat option:selected').attr('id'));

		if ($('#jenis_pengajuan_surat option:selected').attr('id') == 1) {
			var id = $('#jenis_pengajuan_surat option:selected').attr('id');

			var formid = "#form" + id;
			var formuploadid = "#form-upload" + id;
			$('input[name="no_ijazah"]').prop('required', false);
			$('input[name="tanggal_ijazah"]').prop('required', false);
			$('input[name="jadwal_kuliah"]').prop('required', true);
			$('input[name="sk_lembaga_pendidikan"]').prop('required', true);
			$('input[name="fc_ijazah"]').prop('required', false);
			$('input[name="transkip_nilai"]').prop('required', false);
			$('.form-update').hide();
			$('.top-form').show();
			$(formid).show();
			$(formuploadid).show();
		} else if ($('#jenis_pengajuan_surat option:selected').attr('id') == 2) {
			var id = $('#jenis_pengajuan_surat option:selected').attr('id');

			var formid = "#form" + id;
			var formuploadid = "#form-upload" + id;
			$('input[name="no_ijazah"]').prop('required', true);
			$('input[name="tanggal_ijazah"]').prop('required', true);
			$('input[name="jadwal_kuliah"]').prop('required', false);
			$('input[name="sk_lembaga_pendidikan"]').prop('required', false);
			$('input[name="fc_ijazah"]').prop('required', true);
			$('input[name="transkip_nilai"]').prop('required', true);
			$('.form-update').hide();
			$('.top-form').show();
			$(formid).show();
			$(formuploadid).show();
		}

		$('#jenis_pengajuan_surat').change(function() {
			var id = $('#jenis_pengajuan_surat option:selected').attr('id');

			var formid = "#form" + id;
			var formuploadid = "#form-upload" + id;

			if (id == 1) {
				$('input[name="no_ijazah"]').prop('required', false);
				$('input[name="tanggal_ijazah"]').prop('required', false);
				$('input[name="jadwal_kuliah"]').prop('required', true);
				$('input[name="sk_lembaga_pendidikan"]').prop('required', true);
				$('input[name="fc_ijazah"]').prop('required', false);
				$('input[name="transkip_nilai"]').prop('required', false);
			} else if (id == 2) {
				$('input[name="no_ijazah"]').prop('required', true);
				$('input[name="tanggal_ijazah"]').prop('required', true);
				$('input[name="jadwal_kuliah"]').prop('required', false);
				$('input[name="sk_lembaga_pendidikan"]').prop('required', false);
				$('input[name="fc_ijazah"]').prop('required', true);
				$('input[name="transkip_nilai"]').prop('required', true);
			}

			$('.form-update').hide();
			$('.top-form').show();
			$('#option-lieur').hide();
			$(formid).show();
			$(formuploadid).show();


		});
	});

	var renderer = new ZoomPanRenderer("tree-view");
</script>

<script type="text/javascript">
	// $( document ).ready(function() {
	if (window.location.hash) {
		var hash = window.location.hash.substring(1);
		$('#' + hash).addClass('flash-highlight');
	}
	// });
</script>

<script>
	</script>




<script type="text/javascript">
	function block_ui(id) {
		$(id).block({
            message: '<h4><img src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/images/busy.gif" /> Mohon tunggu...</h4>',
            css: {
                border: '1px solid #fff'
            }
        });
	}
	function unblock_ui(id) {
		$(id).unblock();
	}
</script>


    <script type="text/javascript" src="https://e-office.sumedangkab.go.id/asset/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#post_manager",
            theme: "modern",
            plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak fullscreen",
			"searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
			"table contextmenu directionality emoticons paste textcolor filemanager"
			],
			image_advtab: true,
            convert_urls: false,
			 });


    </script>
	<script type="text/javascript">
		var active_menu = "sasaran_rpjmd";
		$('#'+active_menu).attr('class','opened active');
	</script>



</div>