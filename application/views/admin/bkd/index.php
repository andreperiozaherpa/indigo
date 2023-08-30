
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Simpeg BKD</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Simpeg BKD</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>



<div class="row">
  <div class="col-md-12">
    <div class="white-box">
      <div class="row">
        <div class="col-md-3 b-r">
          <a href="<?php echo base_url(). "getbkd/update" ;?>">
          <button  class="btn btn-primary m-t-15 btn-block">Update Data Pegawai</button>
        </a>
        </div>
        <form method="POST">
          <?php if($user_level=='Administrator'){ ?>
          <div class="col-md-3">
            <div class="form-group">
              <label>Nama Lengkap</label>
                  <input type="text" class="form-control" placeholder="Cari berdasarkan Nama Lengkap" name="nama_lengkap" value="<?=($filter) ? $filter_data['nama_lengkap'] : ''?>">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>NIP</label>
                  <input type="text" class="form-control" placeholder="Cari berdasarkan NIP" name="nip" value="<?=($filter) ? $filter_data['nip'] : ''?>">
            </div>
          </div>


          <?php } ?>
          <div class="col-md-3">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                <?php
                if($filter){
                  ?>
                  <a href="" class="btn btn-default m-t-5"><i class="ti-back-left"></i> Reset</a>
                  <?php
                }
                ?>



              </div>
          </div>

        </form>
      </div>

    </div>
  </div>

</div>

<div class="row">
<div class="col-md-12">
        <div class="white-box">
          <div class="row" >
            <div class="col-md-2 col-sm-2 text-center b-r" style="min-height:70px;" >
              <i class="icon-user" style="font-size:50px"></i>
							<div class="row">
								<small>Last Update</small>
							</div>
							<div class="row">
								<i> <span class="label label-primary"><?=$last_update->tgl_update; ?></span> </i>
							</div>
            </div>
            <div class="col-md-10 col-sm-10"  >
              <div class="row b-b">
                <div class="col-md-12 text-center">
                  Status Kepegawaian
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 text-center b-r">
                  <h3 class="box-title m-b-0"> <?=$total_pegawai?></h3>
                  Total Pegawai
                </div>
                <div class="col-md-4 text-center b-r">
                  <h3 class="box-title m-b-0"><?=$total_perempuan?></h3>
                  Total Laki-laki
                </div>
                <div class="col-md-4 text-center b-r ">
                  <h3 class="box-title m-b-0"><?=$total_laki?></h3>
                  Total Perempuan
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
</div>




      <div class="row">
          <div class="col-md-12">
           <div class="white-box table-responsive">
          <table class="table display">


    <thead>
    <tr>
  <th>No</th>
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
  $no=1;
   foreach ($list as $l ) {

   ?>

 <tr>
    <td><?=$no;?></td>
    <td><?=$l->nip;?></td>
    <td><?=$l->nama_lengkap;?></td>
    <td><?=$l->temlahir;?></td>
    <td><?=$l->tgllahir;?></td>
    <td><?=$l->lulus;?></td>
    <td><?=$l->jurusan;?></td>
    <td><?=$l->lembaga;?></td>
    <td><?=$l->tmtpang;?></td>
    <td><?=$l->tmtcpns;?></td>
    <td><?=$l->tmtpns;?></td>
    <td><?=$l->tmtjab;?></td>
    <td><?=$l->nss;?></td>
    <td><?=$l->unit;?></td>
    <td><?=$l->dudukpeg;?></td>
    <td><?=$l->usia;?></td>
    <td><?=$l->masakerja;?></td>
    <td><?=$l->jenis_jabatan;?></td>
    <td><?=$l->nama_jabatan;?></td>
    <td><?=$l->nama_eselon;?></td>
    <td><?=$l->kelamin;?></td>
    <td><?=$l->agama;?></td>
    <td><?=$l->kawin;?></td>
    <td><?=$l->pendidikan;?></td>
    <td><?=$l->gol;?></td>
    <td><?=$l->pangkat;?></td>
    <td><?=$l->nama_dudukpeg;?></td>
    <td><?=$l->nama_statuspeg;?></td>
    <td><?=$l->unitkerja;?></td>
    <td><?=$l->tingkat;?></td>
   </tr>

<?php
$no++;
}
?>

  </table>
    </div>
      </div>
</div>

<div class="row">
            <div class="col-md-12 pager">
              <?php
              if(!$filter){
                echo make_pagination($pages,$current);
              }
              ?>
            </div>
          </div>


		</div>
