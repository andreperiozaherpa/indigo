<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Detail Rencana Kerja SKPD</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="https://e-office.sumedangkab.go.id/renja_perencanaan">Rencana Kerja</a></li>				
          <li class="active">Detail</li>       
        </ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="POST">
          <div class="col-md-3 b-r">
            <center><img style="width: 80%" src="https://e-office.sumedangkab.go.id/data/logo/bnpt.png" alt="user" class="img-circle">   </center>
          </div>
          <div class="col-md-9">
            <div class="panel panel-primary">
              <div class="panel-heading"> DINAS PENDIDIKAN                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
              </div>
              <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table">
                          <tbody><tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong>H. AGUS WAHIDIN, S.Pd. M.Si</strong></td></tr>
                          <tr><td style="width: 120px;">Alamat SKPD </td><td>:</td><td> <strong>Jl. Pendopo Tegalkalong, Sumedang Kec. Sumedang Utara Kab. Sumedang Prov. Jawa Barat</strong></td></tr>
                          <tr><td style="width: 120px;">Email/tlp </td><td>:</td><td> <strong>disdiksumedang@gmail.com / 0261-206377</strong>
                      </td></tr></tbody></table>
                    </div>
                  </div>
              </div>
          </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="white-box col-md-12">


     
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Sub Kegiatan</button>
  <table class="table" style="margrin-top:20px">
  <thead>
    <tr>
      <th>No
      </th>
      <th>
         Kode
      </th>
      
      <th>
         Sub Kegiatan
      </th>

      <th>
          Kegiatan
      </th>

      <th>
          Program
      </th>

      <th>
          Sasaran
      </th>

      <th>
          Urusan
      </th>

      <th>
          Unit Kerja
      </th>

      <th>
          Jml. Indikator
      </th>

      <th>
         Opsi
      </th>
</tr>
  </thead>  
  <tbody>
    <tr>
      <td>1</td>
      <td>213</td>
      <td>Sub Kegiatan 1</td>
      <td>Kegiatan 2</td>
      <td>Program 1</td>
      <td>Sasaran 3</td>
      <td>Urusan 3</td>
      <td>Bidang Informatika</td>
      <td>3 Indikator</td>
      <td><a href="<?=base_url();?>sicerdas/renja/perencanaan/add_indikator"> <button class="btn btn-primary">Detail</button></a></td>
    </tr>

  </tbody>
  </table>

    </div>
  </div>
</div>



          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel1">Tambah Sub Kegiatan</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Urusan:</label>
                                                    <select class="form-control"> 
                                                      <option> 1 - Urusan 1 </option>
                                                      <option> 2 - Urusan 2 </option>
                                                    </select> 
                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Sub Urusan:</label>
                                                    <select class="form-control"> 
                                                      <option> 1 - Sub Urusan 1 </option>
                                                      <option> 2 - Sun Urusan 2 </option>
                                                    </select> 
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Sasaran:</label>
                                                    <select class="form-control"> 
                                                      <option> 1 - Sasaran 1 </option>
                                                      <option> 2 - Sasaran 2 </option>
                                                    </select> 
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Indikator Sasaran:</label>
                                                    <select class="form-control"> 
                                                      <option> 1 - Indikator Sasaran 1 </option>
                                                      <option> 2 - Indikator Sasaran 2 </option>
                                                    </select> 
                                                </div>


                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Program:</label>
                                                    <select class="form-control"> 
                                                      <option> 1 - Program 1 </option>
                                                      <option> 2 - Program 2 </option>
                                                    </select> 
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Indikator Program:</label>
                                                    <select class="form-control"> 
                                                      <option> 1 - Indikator Program 1 </option>
                                                      <option> 2 - Indikator Program 2 </option>
                                                    </select> 
                                                </div>


                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Kegiatan:</label>
                                                    <select class="form-control"> 
                                                      <option> 1 - Kegiatan 1 </option>
                                                      <option> 2 - Kegiatan 2 </option>
                                                    </select> 
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Indikator Kegiatan:</label>
                                                    <select class="form-control"> 
                                                      <option> 1 - Indikator Kegiatan 1 </option>
                                                      <option> 2 - Indikator Kegiatan 2 </option>
                                                    </select> 
                                                </div>



                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Sub Kegiatan:</label>
                                                    <select class="form-control"> 
                                                      <option> 1 - Sub Kegiatan 1 </option>
                                                      <option> 2 - Sub Kegiatan 2 </option>
                                                    </select> 
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Sumber Anggaran:</label>
                                                    <select class="form-control"> 
                                                      <option> Anggaran 1 </option>
                                                      <option> Anggaran 2 </option>
                                                    </select> 
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Prioritas Daerah:</label>
                                                    <select class="form-control"> 
                                                      <option> Anggaran 1 </option>
                                                      <option> Anggaran 2 </option>
                                                    </select> 
                                                </div>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Prioritas Pembangunan Nasional:</label>
                                                    <select class="form-control"> 
                                                      <option> Anggaran 1 </option>
                                                      <option> Anggaran 2 </option>
                                                    </select> 
                                                </div>




                                                <div class="form-group" style=";">
                                              <div class="col-lg-12">
                                                <label class="col-sm-12">Unit Penanggung Jawab</label>
                                                <div class="col-lg-12">
                                                  
                                                      <div class="checkbox checkbox-primary" style="margin-left:0px">
                                                        <input onclick="check(53)" class="checkbox unit-53" id="checkbox_53" type="checkbox" name="ids_unit_kerja[]" value="53">
                                                        <label for="checkbox_53"> Asisten Pemerintahan dan Kesejahteraan Rakyat </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(56)" class="checkbox unit-53 unit-56" id="checkbox_56" type="checkbox" name="ids_unit_kerja[]" value="56">
                                                        <label for="checkbox_56"> Bagian Tata Pemerintahan </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(61)" class="checkbox unit-53 unit-61" id="checkbox_61" type="checkbox" name="ids_unit_kerja[]" value="61">
                                                        <label for="checkbox_61"> Bagian Hukum </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(69)" class="checkbox unit-53 unit-69" id="checkbox_69" type="checkbox" name="ids_unit_kerja[]" value="69">
                                                        <label for="checkbox_69"> Bagian Kerjasama </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(77)" class="checkbox unit-53 unit-77" id="checkbox_77" type="checkbox" name="ids_unit_kerja[]" value="77">
                                                        <label for="checkbox_77"> Bagian Kesejahteraan Rakyat </label>
                                                      </div>
                                                    <hr style="margin-top:10px; margin-bottom:10px">
                                                      <div class="checkbox checkbox-primary" style="margin-left:0px">
                                                        <input onclick="check(54)" class="checkbox unit-54" id="checkbox_54" type="checkbox" name="ids_unit_kerja[]" value="54">
                                                        <label for="checkbox_54"> Asisten Perekonomian dan Pembangunan </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(73)" class="checkbox unit-54 unit-73" id="checkbox_73" type="checkbox" name="ids_unit_kerja[]" value="73">
                                                        <label for="checkbox_73"> Bagian Perekonomian dan Sumber Daya Alam </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:40px">
                                                        <input onclick="check(75)" class="checkbox unit-54 unit-73 unit-75" id="checkbox_75" type="checkbox" name="ids_unit_kerja[]" value="75">
                                                        <label for="checkbox_75"> Sub Bagian Pendayagunaan Sumber Daya Alam dan Pertanian </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(82)" class="checkbox unit-54 unit-82" id="checkbox_82" type="checkbox" name="ids_unit_kerja[]" value="82">
                                                        <label for="checkbox_82"> Bagian Administrasi Pembangunan </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(107)" class="checkbox unit-54 unit-107" id="checkbox_107" type="checkbox" name="ids_unit_kerja[]" value="107">
                                                        <label for="checkbox_107"> Bagian Pengadaan Barang/Jasa </label>
                                                      </div>
                                                    <hr style="margin-top:10px; margin-bottom:10px">
                                                      <div class="checkbox checkbox-primary" style="margin-left:0px">
                                                        <input onclick="check(55)" class="checkbox unit-55" id="checkbox_55" type="checkbox" name="ids_unit_kerja[]" value="55">
                                                        <label for="checkbox_55"> Asisten Administrasi Umum </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(65)" class="checkbox unit-55 unit-65" id="checkbox_65" type="checkbox" name="ids_unit_kerja[]" value="65">
                                                        <label for="checkbox_65"> Bagian Organisasi </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(87)" class="checkbox unit-55 unit-87" id="checkbox_87" type="checkbox" name="ids_unit_kerja[]" value="87">
                                                        <label for="checkbox_87"> Bagian Umum </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:40px">
                                                        <input onclick="check(90)" class="checkbox unit-55 unit-87 unit-90" id="checkbox_90" type="checkbox" name="ids_unit_kerja[]" value="90">
                                                        <label for="checkbox_90"> Sub Bagian Rumah Tangga </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:40px">
                                                        <input onclick="check(91)" class="checkbox unit-55 unit-87 unit-91" id="checkbox_91" type="checkbox" name="ids_unit_kerja[]" value="91">
                                                        <label for="checkbox_91"> Sub Bagian Tata Usaha Pimpinan dan Staf Ahli </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(92)" class="checkbox unit-55 unit-92" id="checkbox_92" type="checkbox" name="ids_unit_kerja[]" value="92">
                                                        <label for="checkbox_92"> Bagian Protokol dan Komunikasi Pimpinan </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:40px">
                                                        <input onclick="check(95)" class="checkbox unit-55 unit-92 unit-95" id="checkbox_95" type="checkbox" name="ids_unit_kerja[]" value="95">
                                                        <label for="checkbox_95"> Sub Bagian Protokol </label>
                                                      </div>
                                                    
                                                      <div class="checkbox checkbox-primary" style="margin-left:20px">
                                                        <input onclick="check(96)" class="checkbox unit-55 unit-96" id="checkbox_96" type="checkbox" name="ids_unit_kerja[]" value="96">
                                                        <label for="checkbox_96"> Bagian Perencanaan dan Keuangan </label>
                                                      </div>
                                                    <hr style="margin-top:10px; margin-bottom:10px">
                                                      <div class="checkbox checkbox-primary" style="margin-left:0px">
                                                        <input onclick="check(104)" class="checkbox unit-104" id="checkbox_104" type="checkbox" name="ids_unit_kerja[]" value="104">
                                                        <label for="checkbox_104"> Staff Ahli </label>
                                                      </div>
                                                    
                                                  
                                                  
                                                  
                                                </div>
                                              </div>
                                               </div>


                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>