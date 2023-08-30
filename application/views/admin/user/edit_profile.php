<ol class="breadcrumb bc-3">
	<li>
		<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
	</li>
	<li>	
		<a href="<?php echo base_url();?>manage_user/profile">Profile</a>
	</li>
	<li class="active">		
		<strong>Edit</strong>
	</li>
</ol>
<h2>Edit profile</h2>

<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					User data
				</div>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
				
			</div>
			<div class="panel-body">
				<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
				<form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-5">
							<input type='hidden' value='<?php echo $username;?>' name='old_username'/>
							<input type="text" class="form-control" value='<?php echo $username;?>' name='username' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name='password' placeholder="Keep it blank if you don't want to change it.">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Full Name</label>
						<div class="col-sm-5">
							<input type="text" class="form-control"  value='<?php echo $full_name;?>' name='full_name' placeholder="">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-5">
							<input type="text" class="form-control"  value='<?php echo $email;?>' name='email' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-5">
							<input type="text" class="form-control"  value='<?php echo $phone;?>' name='phone' placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Bio</label>
						<div class="col-sm-5">
							<textarea class="form-control" name='bio'><?php echo $bio;?></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Picture</label>
						
						<div class="col-sm-5">
							<?php echo"
							<div class='member-img'>
								<img src='".base_url()."data/user_picture/$user_picture' class='img-rounded' style='max-width:200px' />
								
							</div><br>
							";?>
							<input type="file" name='userfile' class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
							<p>
								Max : 500px | 1MB
							</p>
							<?php if (!empty($error)) echo "
				<div class='alert alert-warning'>$error</div>";?>
						</div>
					</div>
					<div class="form-group">
						
						<div class="col-sm-10">
							<button type="submit" class="btn btn-blue">Update</button>
							<a href='<?php echo base_url();?>manage_user/profile' class="btn btn-red">Back</a>
						</div>
						
					</div>
				</form>
			
			</div>

		</div>
	</div>
</div>
