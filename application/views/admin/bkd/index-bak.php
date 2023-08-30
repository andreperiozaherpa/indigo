
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">BKD</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Catatan</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


      

      <div class="row">
        <div class="col-md-12">
          <div class="col-md-3">
            <a href="<?php echo base_url();?>getbkd/update" class="btn btn-primary"><i class="icon-plus"></i> Update Data </a>
          </div>
          <div class="col-md-9">
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
           <div class="white-box table-responsive">
          <table class="table table-striped table-bordered">


    <thead>
    <tr>
  <th>nip</th>
  <th>nama_lengkap</th>
  <th>temlahir</th>
  <th>tgllahir</th>
  <th>lulus</th>
  <th>jurusan</th>
  <th>lembaga</th>
  <th>tmtpang</th>
  <th>tmtcpns</th>
  <th>tmtpns</th>
  <th>tmtjab</th>
  <th>nss</th>
  <th>unit</th>
  <th>dudukpeg</th>
  <th>usia</th>
  <th>masakerja</th>
  <th>jenis_jabatan</th>
  <th>nama_jabatan</th>
  <th>nama_eselon</th>
  <th>kelamin</th>
  <th>agama</th>
  <th>kawin</th>
  <th>pendidikan</th>
  <th>gol</th>
  <th>pangkat</th>
  <th>nama_dudukpeg</th>
  <th>nama_statuspeg</th>
  <th>unitkerja</th>
  <th>tingkat</th>
  </tr>
  </thead>
  

<?php
    $url = 'http://124.158.175.50/publik/public/pegawai?key=208c462feb15040fc75fcb951c74e87a7f850f97a7ee933a362edca77f7ab744';
    $content = file_get_contents($url);
    $json = json_decode($content, true);
    for($i=0; $i<count($json); $i++)
    {
   ?>

 <tr><td><?=$json[$i]['nip'];?></td>
    <td><?=$json[$i]['nama_lengkap'];?></td>
    <td><?=$json[$i]['temlahir'];?></td>
    <td><?=$json[$i]['tgllahir'];?></td>
    <td><?=$json[$i]['lulus'];?></td>
    <td><?=$json[$i]['jurusan'];?></td>
    <td><?=$json[$i]['lembaga'];?></td>
    <td><?=$json[$i]['tmtpang'];?></td>
    <td><?=$json[$i]['tmtcpns'];?></td>
    <td><?=$json[$i]['tmtpns'];?></td>
    <td><?=$json[$i]['tmtjab'];?></td>
    <td><?=$json[$i]['nss'];?></td>
    <td><?=$json[$i]['unit'];?></td>
    <td><?=$json[$i]['dudukpeg'];?></td>
    <td><?=$json[$i]['usia'];?></td>
    <td><?=$json[$i]['masakerja'];?></td>
    <td><?=$json[$i]['jenis_jabatan'];?></td>
    <td><?=$json[$i]['nama_jabatan'];?></td>
    <td><?=$json[$i]['nama_eselon'];?></td>
    <td><?=$json[$i]['kelamin'];?></td>
    <td><?=$json[$i]['agama'];?></td>
    <td><?=$json[$i]['kawin'];?></td>
    <td><?=$json[$i]['pendidikan'];?></td>
    <td><?=$json[$i]['gol'];?></td>
    <td><?=$json[$i]['pangkat'];?></td>
    <td><?=$json[$i]['nama_dudukpeg'];?></td>
    <td><?=$json[$i]['nama_statuspeg'];?></td>
    <td><?=$json[$i]['unitkerja'];?></td>
    <td><?=$json[$i]['tingkat'];?></td>
   </tr>

<?php
} 
?>

  </table> 
    </div>  
      </div>
</div>
		</div>
