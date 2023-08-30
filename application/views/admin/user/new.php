<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Pengguna</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('home') ?>">Home</a></li>
                            <li><a href="<?php echo base_url('manage_user') ?>">Pengguna</a></li>
                            <li class="active">Tambah Pengguna</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                 	 <form class="form-horizontal form-material" method='post' enctype="multipart/form-data">

                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> 
                                <div class="overlay-box">
                                    <div class="user-content">

                                    
                                     <label style="color: #fff">Foto Profil</label>
                                       <input type="file" name='userfile'  id="input-file-now-custom-3" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                                    </div>
                                </div>
                            </div>
                              <div class="user-btm-box">
                                <!-- .row -->
                                <div class="row m-t-10">
                                <div class="col-md-12">
                <?php if (!empty($message)) echo "
                <div class='alert alert-$message_type'>$message</div>";?>
                                         <div class="form-group">
                                                <label class="col-md-12">Nama Pengguna</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="username"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                    </div>

                                    <div class="col-md-12">
                                         
                                             <div class="form-group">
                                                <label class="col-md-12">Kata Sandi</label>
                                                <div class="col-md-12">
                                                   <input type="password" name="password"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-md-12">Ulangi Kata Sandi</label>
                                                <div class="col-md-12">
                                                   <input type="password" name="repassword"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                    </div>

                             
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                <label class="col-md-12">Level Pengguna</label>
                                                <div class="col-md-12">
                                                    <select name="user_level" class="form-control">
                                                        <?php foreach ($level as $key): ?>
                                                            <option value="<?php echo $key->level_id ?>"><?php echo $key->level ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                             
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                <label class="col-md-12">SKPD</label>
                                                <div class="col-md-12">
                                                    <select name="id_skpd" class="form-control">
                                                    	<option value="">Pilih SKPD</option>
                                                        <?php foreach ($skpd as $s): ?>
                                                            <option value="<?php echo $s->id_skpd ?>"><?php echo $s->nama_skpd ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="col-md-12">

                                    </div>

                                        <div class="col-md-12">
                                             <div class="form-group">
                                                <label class="col-md-12">Status Pengguna</label>
                                                <div class="col-md-12">
                                                    <select name="user_status" class="form-control">
                                                        <option value="Active">Aktif</option>
                                                        <option value="Not Active">Nonaktif</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                <!-- /.row -->
                              
                                
                            </div>
                    </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <ul class="nav nav-tabs tabs customtab">
                                
                                <li class="tab active">
                                    <a href="#employ" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-envelope-o"></i></span> <span class="hidden-xs">Data</span> </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                          
                                <div class="tab-pane active" id="employ">

                                <h3 class="text-orange">Data Pribadi :</h3>
                                    
                                    <div class="row">

                                    	 <form class="form-horizontal form-material">
                                       <div class="col-md-12 mt-10">
                                        <div class="form-group">
                                            <label class="col-md-12">Nama Lengkap</label>
                                            <div class="col-md-12">
                                                <input type="text" name="employee_name" placeholder="fullname" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
	                                         <div class="form-group ">
	                                            <label class="col-md-12">Tanggal Lahir</label>
	                                            <div class="col-md-12">
	                                                <input type="text" name="birthday" placeholder="12-12-2012" class="form-control form-control-line mydatepicker" value="<?php echo date('Y-m-d');?>" data-format="D, dd MM yyyy">
	                                            </div>
	                                        </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
	                                         <div class="form-group">
	                                            <label class="col-md-12">Jenis Kelamin</label>
	                                            <div class="col-md-12">
	                                                <select name="gender" class="form-control form-control-line">
															<option value='male'>Male</option>
															<option value='female'>Female</option>
													
		                                             </select>
	                                            </div>
	                                        </div>
                                        </div>
                                        <div class="col-md-12">
	                                         <div class="form-group">
	                                            <label class="col-md-12">Alamat</label>
	                                            <div class="col-md-12">
	                                                <textarea rows="5" name="employee_address" class="form-control form-control-line"></textarea>
	                                            </div>
	                                        </div>
                                        </div>





                                        
                                    </div>
              


                                <h3 class="text-orange">Identitas  :</h3>
                             
                                    <div class="row">
                                          <div class="col-md-6 mt-10">
                                             <div class="form-group ">
                                                <label class="col-md-12">Telepon</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="employee_phone" placeholder="12312321312t" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                   <input type="email" name="employee_email" placeholder="email@imcreative.com" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                    
                                   
                                    <div class="row">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary pull-right">Simpan Profil</button>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                                    <hr>




                                </div>

                            </div>
                        </div>
                    </div>