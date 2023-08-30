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
                                         <a href="javascript:void(0)"><img src="<?php echo base_url('data/user_picture/'.$picture);?>" class="thumb-lg img-circle" alt="img"></a>
                                       
                                    </div>

                                </div>
                            </div>
                              <div class="user-btm-box">
                                <!-- .row -->
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                     <div class="form-group">
                                     <label class="col-md-12">Upload Picture</label>
                                       <input type="file" name='picture'  id="input-file-now-custom-3" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                                    </div>
                                    </div>


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

                                 <li class="tab">
                                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Settings</span> </a>
                                </li>

                                   <li class="tab">
                                    <a href="#privilege" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Privileges</span> </a>
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
                                                <input type="text" name="employee_name" placeholder="fullname" value="<?php echo $employee_name; ?>" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
                                             <div class="form-group ">
                                                <label class="col-md-12">Birthday</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="birthday" placeholder="12-12-2012" class="form-control form-control-line" value="<?php echo $birthday; ?>">
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
                                                    <textarea rows="5" name="employee_address" class="form-control form-control-line">
                                                        <?php echo $employee_address; ?>
                                                    </textarea>
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
                                                    <input type="text" name="employee_phone" value="<?php echo $employee_phone; ?>" placeholder="12312321312t" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                   <input type="email" name="employee_email" placeholder="email@imcreative.com" value="<?php echo $employee_phone; ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>



                                    <div class="row">
                                          <div class="col-md-6 mt-10">
                                             <div class="form-group ">
                                                <label class="col-md-12">KTP</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="ktp" value="<?php echo $ktp; ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">NPWP</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="npwp" value="<?php echo $npwp; ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>

                                          <div class="col-md-6 mt-10">
                                             <div class="form-group ">
                                                <label class="col-md-12">BPJS Ketegakerjaan</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="bpjs" value="<?php echo $bpjs; ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">BPJS Kesehatan</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="bpjs_kesehatan" value="<?php echo $bpjs_kesehatan; ?>" class="form-control form-control-line">
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
                                                    <input type="text" name="date_joining"  value="<?php echo $date_joining; ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Date Leave</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="date_leaving" value="<?php echo $date_leaving; ?>"  class="form-control form-control-line">
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
                                                    <input type="text" name="bank_name" placeholder="fullname" value="<?php echo $bank_name; ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                        

                                          <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Bank Account</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="bank_account"  value="<?php echo $bank_account; ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>


                                        
                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Bank Account Holder</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="bank_account_holder"  value="<?php echo $bank_account_holder; ?>" class="form-control form-control-line">
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
                                                   <input type="text" name="facebook"  value="<?php echo $facebook; ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Twitter</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="twitter" value="<?php echo $twitter; ?>"  class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Google</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="google" value="<?php echo $google; ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-10">
                                             <div class="form-group">
                                                <label class="col-md-12">Youtube</label>
                                                <div class="col-md-12">
                                                   <input type="text" name="youtube" value="<?php echo $youtube; ?>" class="form-control form-control-line">
                                                </div>
                                            </div>
                                        </div>





                                    </div>

                                    
                                   
                                    <div class="row">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-success pull-right">Update Profile</button>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                                    <hr>




                                </div>

                            </div>



                          	    <div class="tab-pane" id="settings">
                                    <form class="form-horizontal form-material">
                                        <div class="form-group">
                                            <label class="col-md-12">Username</label>
                                            <div class="col-md-12">
                                                <input type="text"  name="username" placeholder="Johnathan Doe" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12">Password</label>
                                            <div class="col-md-12">
                                                <input type="password" name="password" value="password" class="form-control form-control-line">
                                            </div>
                                        </div>
                                       
                                      
                                        <div class="form-group">
                                            <label class="col-sm-12">User Level</label>
                                            <div class="col-sm-12">
                                                <select class="form-control form-control-line">
                                                    <option>London</option>
                                                    <option>India</option>
                                                    <option>Usa</option>
                                                    <option>Canada</option>
                                                    <option>Thailand</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" type="submit">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                            <div class="tab-pane" id="privilege">
                                    <form class="form-horizontal form-material" method="POST" action="<?php echo base_url().'manage_user/privileges/'.$this->uri->segment(3); ?>">
                                    	<hr>

                                        <div class="form-group">
                                            <label class="col-md-5"><h3>MENU FINANCE</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_finance" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_finance', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>
                            

                                        <div class="form-group">
                                           <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i> Categori Finance</label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_privileges[]" value="category_finance" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('category_finance', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-5"> <i class="ti-angle-right" style="padding-right: 15px;"></i>Finance</label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_privileges[]" value="finance" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('finance', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?>/> 
                                            </div>
                                        </div>







                                        <hr>
                                        <div class="form-group">
                                            <label class="col-md-5"><h3>Task Management</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_task_management" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_task_management', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Project Manager</label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_privileges[]" value="project" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('project', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Notice Board</label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_privileges[]" value="notice" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('notice', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>


                                        <div class="form-group">
                                           <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Worksheet</label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_privileges[]" value="worksheet" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('worksheet', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                       <hr>
                                        <div class="form-group">
                                            <label class="col-md-5"><h3>PRODUCT & PORTOFOLIO</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_produk_portofolio" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_produk_portofolio', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Category Product</label>
                                           <div class="col-md-7">
                                                <input type="checkbox"  class="js-switch" name="user_privileges[]" value="category_product" data-color="#6164c1" <?php echo $checked = (array_search('category_product', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Product</label>
                                           <div class="col-md-7">
                                                <input type="checkbox"  class="js-switch" name="user_privileges[]" value="product" data-color="#6164c1" <?php echo $checked = (array_search('product', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Portofolio</label>
                                           <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="portofolio" data-color="#6164c1" <?php echo $checked = (array_search('portofolio', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="col-md-5"><h3>SERVICES</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_services" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_services', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                           <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Services</label>
                                            <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="services"  data-color="#6164c1" <?php echo $checked = (array_search('services', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Sub Services</label>
                                            <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="sub_services" data-color="#6164c1" <?php echo $checked = (array_search('sub_services', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <hr>
                                       <hr>
                                        <div class="form-group">
                                            <label class="col-md-5"><h3>DEPARTEMEN</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_departemen" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_departemen', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Departemen</label>
                                          <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="departemen"  data-color="#6164c1" <?php echo $checked = (array_search('departemen', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>


                                          <div class="form-group">
                                            <label class="col-md-5"><h3>FEEDBACK</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_feedback" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_feedback', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                           <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>client</label>
                                         <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="client"  data-color="#6164c1" <?php echo $checked = (array_search('client', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Partner</label>
                                           <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="partner"  data-color="#6164c1" <?php echo $checked = (array_search('partner', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <div class="form-group">
                                           <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Testimoni</label>
                                            <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="testimoni"  data-color="#6164c1"  <?php echo $checked = (array_search('testimoni', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>



                                        <hr>
                                         <div class="form-group">
                                            <label class="col-md-5"><h3>FRONT END</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_front_end" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_front_end', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Blog</label>
                                           <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="post" data-color="#6164c1" <?php echo $checked = (array_search('post', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Blog Category</label>
                                            <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="blog_category" data-color="#6164c1" <?php echo $checked = (array_search('blog_category', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Tags</label>
                                           <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="tags" data-color="#6164c1" <?php echo $checked = (array_search('tags', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>



                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Gallery</label>
                                           <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="gallery" data-color="#6164c1" <?php echo $checked = (array_search('gallery', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>


                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Header</label>
                                           <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="header" data-color="#6164c1" <?php echo $checked = (array_search('header', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Download</label>
                                           <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="download" data-color="#6164c1" <?php echo $checked = (array_search('download', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Banner</label>
                                           <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="banner" data-color="#6164c1" <?php echo $checked = (array_search('banner', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>


                                        <div class="form-group">
                                        <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Video</label>
                                           <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="video" data-color="#6164c1" 
                                                <?php echo $checked = (array_search('video', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Event</label>
                                          <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="event" data-color="#6164c1" <?php echo $checked = (array_search('event', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <hr>
                                         <div class="form-group">
                                            <label class="col-md-5"><h3>Blog</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_blog" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_blog', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Tags</label>
                                          <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="tags" data-color="#6164c1" <?php echo $checked = (array_search('tags', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Category</label>
                                          <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="blog_category" data-color="#6164c1" <?php echo $checked = (array_search('blog_category', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Post</label>
                                          <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="post" data-color="#6164c1" <?php echo $checked = (array_search('post', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <hr>
                                         <div class="form-group">
                                            <label class="col-md-5"><h3>Product</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_product" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_product', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Category Product</label>
                                          <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="category_product" data-color="#6164c1" <?php echo $checked = (array_search('category_product', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Product</label>
                                          <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="product" data-color="#6164c1" <?php echo $checked = (array_search('product', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Portofolio</label>
                                          <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="portofolio" data-color="#6164c1" <?php echo $checked = (array_search('portofolio', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                         <hr>
                                         <div class="form-group">
                                            <label class="col-md-5"><h3>Manage User</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_user" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_user', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>User</label>
                                          <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="user" data-color="#6164c1" <?php echo $checked = (array_search('user', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>

                                        <hr>
                                         <div class="form-group">
                                            <label class="col-md-5"><h3>Company Profile</h3></label>
                                            <div class="col-md-7">
                                                <input type="checkbox" name="user_group_menu[]" value="mn_company" class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('mn_company', explode(';', $user_group_menu)) === false) ? '' : 'checked'; ?>/>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                         <label class="col-md-5">  <i class="ti-angle-right" style="padding-right: 15px;"></i>Identity Company</label>
                                          <div class="col-md-7">
                                                <input type="checkbox" class="js-switch" name="user_privileges[]" value="company" data-color="#6164c1" <?php echo $checked = (array_search('company', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                            </div>
                                        </div>








                                        
                                      
                                       
                                        <?php if ($this->session->userdata('user_level') == "1"): ?>
                                            
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" type="submit">Update</button>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                    </form>
                                </div>

                        </div>
                    </div>