<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile page</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('home') ?>">Dashboard</a></li>
                            <li class="active">Profile page</li>
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

                                    
                                     <label style="color: #fff">Profile Picture</label>
                                       <input type="file" name='picture'  id="input-file-now-custom-3" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                                    </div>
                                </div>
                            </div>
                              <div class="user-btm-box">
                                <!-- .row -->
                                <div class="row m-t-10">
                                <div class="col-md-12">
                                         <div class="form-group">
                                            <label class="col-md-12">Employee ID</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="employee_identity"  name="employee_identity" class="form-control form-control-line">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                   
										<div class="form-group">
                                            <label class="col-sm-12">Departemen</label>
                                            <div class="col-sm-12">
                                                <select name="employee_departement" class="form-control form-control-line">
                                                     <?php 
                                                foreach ($departemen as $row) {
                                                    echo "<option value='$row->id_departemen'>$row->nama_departemen</option>";
                                                }
                                            ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label class="col-md-12">Designation</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="designation"  name="employee_designation" class="form-control form-control-line">
                                            </div>
                                        </div>
                                    </div>

                             
                                    <div class="col-md-12">
                                   
										<div class="form-group">
                                            <label class="col-sm-12">Status Employee</label>
                                            <div class="col-sm-12">
                                                <select name="status_id" class="form-control form-control-line">
                                                    <?php 
												foreach ($status_employee as $row) {
													echo "<option value='$row->status_id'>$row->status_name</option>";
												}
											?>
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

                                <h3 class="text-orange">Personal Data :</h3>
                                    
                                    <div class="row">

                                    	 <form class="form-horizontal form-material">
                                       <div class="col-md-12 mt-10">
                                        <div class="form-group">
                                            <label class="col-md-12">Full Name</label>
                                            <div class="col-md-12">
                                                <input type="text" name="employee_name" placeholder="fullname" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
	                                         <div class="form-group ">
	                                            <label class="col-md-12">Birthday</label>
	                                            <div class="col-md-12">
	                                                <input type="text" name="birthday" placeholder="12-12-2012" class="form-control form-control-line mydatepicker" value="<?php echo date('Y-m-d');?>" data-format="D, dd MM yyyy">
	                                            </div>
	                                        </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
	                                         <div class="form-group">
	                                            <label class="col-md-12">Gender</label>
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
	                                            <label class="col-md-12">Address</label>
	                                            <div class="col-md-12">
	                                                <textarea rows="5" name="employee_address" class="form-control form-control-line"></textarea>
	                                            </div>
	                                        </div>
                                        </div>





                                        
                                    </div>
              


                                <h3 class="text-orange">Identity  :</h3>
                             
                                    <div class="row">
                                          <div class="col-md-6 mt-10">
                                             <div class="form-group ">
                                                <label class="col-md-12">Phone</label>
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



                                    <div class="row">
                                          <div class="col-md-6 mt-10">
	                                         <div class="form-group ">
	                                            <label class="col-md-12">KTP</label>
	                                            <div class="col-md-12">
	                                                <input type="text" name="ktp" placeholder="12312321312t" class="form-control form-control-line">
	                                            </div>
	                                        </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
	                                         <div class="form-group">
	                                            <label class="col-md-12">NPWP</label>
	                                            <div class="col-md-12">
	                                               <input type="text" name="npwp" placeholder="123213213123" class="form-control form-control-line">
	                                            </div>
	                                        </div>
                                        </div>

                                          <div class="col-md-6 mt-10">
	                                         <div class="form-group ">
	                                            <label class="col-md-12">BPJS Ketegakerjaan</label>
	                                            <div class="col-md-12">
	                                                <input type="text" name="bpjs" placeholder="12312321312t" class="form-control form-control-line">
	                                            </div>
	                                        </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
	                                         <div class="form-group">
	                                            <label class="col-md-12">BPJS Kesehatan</label>
	                                            <div class="col-md-12">
	                                               <input type="text" name="bpjs_kesehatan" placeholder="123213213123" class="form-control form-control-line">
	                                            </div>
	                                        </div>
                                        </div>

                                    </div>
                           

                                    <div class="row">
                                    <h3 class="text-orange">Register Date :</h3>
                                    <hr>
                                         <div class="col-md-6 mt-10">
	                                         <div class="form-group ">
	                                            <label class="col-md-12">Date Join</label>
	                                            <div class="col-md-12">
	                                                <input type="text" name="date_joining"  class="form-control form-control-line mydatepicker" value="<?php echo date('Y-m-d');?>" data-format="D, dd MM yyyy">
	                                            </div>
	                                        </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
	                                         <div class="form-group">
	                                            <label class="col-md-12">Date Leave</label>
	                                            <div class="col-md-12">
	                                               <input type="text" name="date_leaving"  class="form-control form-control-line mydatepicker" value="<?php echo date('Y-m-d');?>" data-format="D, dd MM yyyy">
	                                            </div>
	                                        </div>
                                        </div>

                                    </div>
                    
                                    <div class="row">
                                    <h3 class="text-orange">Bank Account :</h3>
                                 
                                        <div class="col-md-12 mt-10">
	                                        <div class="form-group">
	                                            <label class="col-md-12">Bank Name</label>
	                                            <div class="col-md-12">
	                                                <input type="text" name="bank_name" placeholder="fullname" class="form-control form-control-line">
	                                            </div>
	                                        </div>
                                        </div>
                                        

                                          <div class="col-md-6 mt-10">
	                                         <div class="form-group">
	                                            <label class="col-md-12">Bank Account</label>
	                                            <div class="col-md-12">
	                                               <input type="text" name="bank_account"  class="form-control form-control-line">
	                                            </div>
	                                        </div>
                                        </div>


                                        
                                        <div class="col-md-6 mt-10">
	                                         <div class="form-group">
	                                            <label class="col-md-12">Bank Account Holder</label>
	                                            <div class="col-md-12">
	                                               <input type="text" name="bank_account_holder"  class="form-control form-control-line">
	                                            </div>
	                                        </div>
                                        </div>

                                    </div>
                                    
                                    <div class="row">
                                    <h3 class="text-orange">Social Account :</h3>

                                          <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Facebook</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="facebook"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Twitter</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="twitter"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Google</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="google"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Youtube</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="youtube"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class="row">
                                    <h3 class="text-orange">Acccount :</h3>

                                          <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Username</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="username"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Password</label>
                                                <div class="col-md-12">
                                                   <input type="password" name="password"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-md-12">Re Password</label>
                                                <div class="col-md-12">
                                                   <input type="password" name="repassword"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">User Level</label>
                                                <div class="col-md-12">
                                                    <select name="user_level" class="form-control">
                                                        <?php foreach ($level as $key): ?>
                                                            <option value="<?php echo $key->level_id ?>"><?php echo $key->level ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">User Status</label>
                                                <div class="col-md-12">
                                                    <select name="user_status" class="form-control">
                                                        <option value="Active">Active</option>
                                                        <option value="Not Active">Not Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    
                                   
                                    <div class="row">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-success pull-right">Save Profile</button>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                                    <hr>




                                </div>

                            </div>
                        </div>
                    </div>