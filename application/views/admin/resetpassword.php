<!DOCTYPE html>
<html lang="en-US">

<head>

	<!-- Meta
	============================================= -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, intial-scale=1, max-scale=1">

	<meta name="author" content="ExplicitConcepts">
	<!-- description -->
	<meta name="description" content="e-office Sumedang">
	<!-- keywords -->
	<meta name="keywords" content="e-office Kabupaten sumedang">

	<!-- Stylesheets
	============================================= -->
	<link href="<?php echo base_url() ?>assets/css/sweetalert2.css" rel="stylesheet">
	<link href="<?php echo base_url() . "asset/e-office/"; ?>css/css-assets.css" rel="stylesheet">
	<link href="<?php echo base_url() . "asset/e-office/"; ?>css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700i,700" rel="stylesheet">

	<!-- Favicon
	============================================= -->
	<link rel="shortcut icon" href="<?php echo base_url() . "asset/e-office/"; ?>images/files/logo-e.png">
	<link rel="apple-touch-icon" href="images/general-elements/favicon/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/general-elements/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/general-elements/favicon/apple-touch-icon-114x114.png">

	<!-- Title
	============================================= -->
	<title>e-office desa Sumedang</title>

	<!-- Stylesheets
	============================================= -->
	<style>
		.banner-center-box {
			padding: 0px 0 100px;
			max-height: 100%;
			max-width: 100%;
			width: 100%;
			perspective: 1000px;
			backface-visibility: hidden;
		}
	</style>


	<!-- External JavaScripts
	============================================= -->
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jRespond.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.easing.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.waypoints.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.fitvids.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.stellar.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/owl.carousel.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.mb.YTPlayer.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.ajaxchimp.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url() . "asset/e-office/"; ?>js/simple-scrollbar.min.js"></script>
	<script src='<?php echo base_url() . "asset/e-office/"; ?>js/functions.js'></script>
	<script src='<?php echo base_url() ?>assets/js/sweet-alert/sweetalert.min.js'></script>
</head>

<body>
	<?php //if(isset($nama_skpd)) echo "idSkpd:".$nama_skpd;
	?>
	<div id="scroll-progress">
		<div class="scroll-progress"><span class="scroll-percent"></span></div>
	</div>

	<!--<div id="SuccessDiv">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
				<div class="alert alert-success">Reset password berhasil. Saat ini anda dapat melakukan login di http://sigeol.sumedangkab.go.id:8080/cmdbuild dengan username dan password anda</div>
				</div>
				<div class="col-md-3">
				</div>
			</div>
		</div>
	</div>-->
	<!-- Document Full Container
	============================================= -->
	<div id="full-container">

		<!-- Banner
		============================================= -->
		<section id="banner">

			<div class="banner-parallax" data-banner-height="800">
				<div class="overlay-colored"></div><!-- .overlay-colored end -->
				<div class="slide-content">

					<div class="container">
						<div class="row">
							<div class="col-md-3">


							</div><!-- .col-md-7 end -->
							<div class="col-md-5">

								<div class="banner-center-box text-center text-white">
									<div class="cta-subscribe cta-subscribe-2 box-form">
										<div class="box-title text-white">
											<h3 class="title">e-office Sumedang</h3>
											<p>Silakan ubah password lama anda</p>
											<img class="svg" src="<?php echo base_url() . "asset/e-office/"; ?>images/general-elements/section-separators/rounded.svg" alt="">
										</div><!-- .box-title end -->
										<div class="box-content" style="height: 400px;">
											<form id="loginform" method="POST" id="form-cta-subscribe-2" class="form-inline" style="min-height: 300px;">
												<input type="hidden" value="<?= $passwordSuccess; ?>" id="passMsg" class="form-control form-control-line">
												<input type="hidden" value="<?= $nama_skpd; ?>" id="nama_skpd" class="form-control form-control-line">
												<input type="hidden" value="<?= $nama_skpd_alias; ?>" id="nama_skpd_alias" class="form-control form-control-line">
												<input type="hidden" value="<?= $tokenCmdbuild; ?>" id="tokenCmdbuild" class="form-control form-control-line">
												<?php if (!empty($pesan)) {
													echo "
                        <div class='alert-danger' style='padding-bottom:20px'>Opps.. $pesan <br></div>
                      ";
												} ?>

												<div class="form-group">
													<label for="cs2Name">Username</label>
													<input type="text" name="username" id="cs2Name" value="<?php echo $username; ?>" class="form-control" placeholder="" disabled>
												</div><!-- .form-group end -->
												<div class="form-group">
													<label for="cs2Email">New Password</label>
													<input type="password" name="password" class="form-control" placeholder="">
												</div><!-- .form-group end -->
												<div class="form-group">
													<label for="cs2Email">Confirm New Password</label>
													<input type="password" name="confirmpassword" class="form-control" placeholder="">
												</div><!-- .form-group end -->

												<div class="form-group">
													<input type="submit" class="form-control" value="Change">

												</div><!-- .form-group end -->
											</form><!-- #form-cta-subscribe-2 end -->
										</div><!-- .box-content end -->
									</div><!-- .box-form end -->
								</div><!-- .banner-center-box end -->

							</div><!-- .col-md-5 end -->
						</div><!-- .row end -->
					</div><!-- .container end -->

				</div><!-- .slide-content end -->
				<div class="section-separator wave-1 bottom">
					<div class="ss-content">
						<img class="svg" src="<?php echo base_url() . "asset/e-office/"; ?>images/general-elements/section-separators/wave-1.svg" alt="">
					</div><!-- .ss-content -->
				</div><!-- .section-separator -->
			</div><!-- .banner-parallax end -->

		</section><!-- #banner end -->

		<!-- Content
		============================================= -->

		<!-- Footer
		============================================= -->
		<footer id="footer" style="margin-top: -100px;">




			<div id="footer-bar-2" class="footer-bar">

				<div class="footer-bar-wrap">

					<div class="container">
						<div class="row">
							<div class="col-md-12">

								<div class="fb-row">
									<div class="copyrights-message" style="text-align: center !important;">
										<center>2021 © <a href="https://sumedangkab.go.id" target="_blank"><span class="colored">Pemerintah Kabupaten Sumedang </span></a>. All Rights Reserved.</center>
									</div>

								</div><!-- .fb-row end -->

							</div><!-- .col-md-12 end -->
						</div><!-- .row end -->
					</div><!-- .container end -->

				</div><!-- .footer-bar-wrap -->

			</div><!-- #footer-bar-2 end -->

		</footer><!-- #footer end -->

	</div><!-- #full-container end -->

	<a class="scroll-top-icon scroll-top" href="#"><i class="fa fa-angle-up"></i></a>


	<script type="text/javascript">
		(function($) {

			"use strict";

			/*ADD BY AYU*/
			var urlToken = '<?= $this->config->item("urlToken"); ?>';
			var urlUsers = '<?= $this->config->item("urlUsers"); ?>';
			var urlRole = '<?= $this->config->item("urlRole"); ?>';
			var urlTenant = '<?= $this->config->item("urlTenant"); ?>';

			var token = "";
			var users = [];
			var userData = {};
			var roles = [];
			var tenants = [];

			$(document).ready(function() {
				var passSuccess = $("input#passMsg").val();
				var nama_skpd = $("input#nama_skpd").val();
				var nama_skpd_alias = $("input#nama_skpd_alias").val();

				token = $("input#tokenCmdbuild").val();
				//alert(token);

				if (token == "") {
					//get cmdbuild token
					GetCmdbuildToken('<?= $this->config->item("adminCmdbuild"); ?>', '<?= $this->config->item("passwordCmdbuild"); ?>');
				}

				//alert(token);
				if (token != "") {
					//get all users
					GetAllUsers(token);

					//get all tenants
					GetAllTenants(token);

					//get all roles
					GetRoles();

					passSuccess = $("input#passMsg").val();
					if (passSuccess == "success") {
						var userName = "<?= $username ?>";
						var newPassword = "<?= $newPassword ?>";
						var isValid = true;

						var full_name = "<?= $user_data->nama_lengkap; ?>";
						var email = "<?= $user_data->email; ?>";

						/* EOFFICE DESA
						var userRole = GetRoleByRoleName(roles,'<?= $this->config->item("groupUser"); ?>');*/
						/* EOFFICE DESA*/

						/* EOFFICE SKPD*/
						var groupSkpd = "usermanager_" + nama_skpd_alias.toLowerCase();

						if (nama_skpd_alias == 'Sekretariat Kecamatan Jatinangor') {
							groupSkpd = "user_kecamatan";
						}
						if (nama_skpd_alias == 'Sekretariat Kecamatan Cimanggung') {
							groupSkpd = "user_kecamatan";
						}
						if (nama_skpd_alias == 'Sekretariat Kecamatan Tanjungsari') {
							groupSkpd = "user_kecamatan";
						}
						if (nama_skpd_alias == 'Sekretariat Kecamatan Sumedang Selatan') {
							groupSkpd = "user_kecamatan";
						}
						if (nama_skpd_alias == 'Sekretariat Kecamatan Sumedang Utara') {
							groupSkpd = "user_kecamatan";
						}
						var userRole = GetRoleByRoleName(roles, groupSkpd);
						if (userRole == "") {
							isValid = false;
						}
						/* EOFFICE SKPD*/

						if (isValid) {
							var userTenantId = GetTenantByDesc(tenants, nama_skpd);
							var dataUser = '{"username":"' + userName + '","description":"' + full_name + '","email":"' + email + '","lastExpiringNotification":null,"lastPasswordChange":null,"passwordExpiration":null,"service":false,"defaultUserGroup":"","multiGroup":false,"active":true,"userGroups":[{"_id":' + userRole["_id"] + ',"name":"' + userRole["name"] + '","description":"' + userRole["description"] + '"}],"userTenants":[{"_id":' + userTenantId + ',"description":"' + nama_skpd + '","active":true}],"password":"' + newPassword + '","multiTenantActivationPrivileges":"one","initialPage":"","language":"","changePasswordRequired":false,"groupsLength":1,"confirmPassword":"' + newPassword + '"}';

							var userIdCmdbuild = GetIdByUsername(users, userName);

							if (userIdCmdbuild != "") {
								//get data by id 
								GetUserById(userIdCmdbuild);

								//change user password
								var arrUserTenants = [];
								var objTenant = {};
								objTenant._id = userTenantId;
								objTenant.description = nama_skpd;
								objTenant.active = true;
								arrUserTenants.push(objTenant);

								userData.description = full_name;
								userData.email = email;
								userData.password = newPassword;
								userData.confirmPassword = newPassword;
								userData.active = true;
								userData.userTenants = arrUserTenants;

								UpdateUserCmdbuild(userIdCmdbuild);
							} else {
								CreateUserCmdbuild(dataUser);
							}
						} else {
							swal("Error!", "Sinkronisasi akun sigeol gagal. Group tidak terdaftar di sigeol. Error: " + error, "error");
						}

						//location.href = "<?php echo base_url() . "admin" ?>";				
					}
				}

			});

			function GetCmdbuildToken(username, password) {
				$.ajax({
					url: urlToken,
					type: 'POST',
					async: false,
					contentType: 'application/json',
					data: '{"username":"' + username + '", "password":"' + password + '"}',
					success: function(e) {
						token = e.data._id;
						// console.log(e.data._id);			   
					},
					error: function(request, status, error) {
						alert(request.responseText);
					}
				});
			}

			function GetIdByUsername(arrUser, username) {
				for (var i = 0; i < arrUser.length; i++) {
					var item = arrUser[i];
					if (item.username == username) {
						return item._id;
					}
				}

				return "";
			}

			function GetTenantByDesc(arrTenant, tenantName) {
				for (var i = 0; i < arrTenant.length; i++) {
					var item = arrTenant[i];
					if (item.Description == tenantName) {
						return item._id;
					}
				}

				return "";
			}


			function GetUserByUsername(arrUser, username) {
				for (var i = 0; i < arrUser.length; i++) {
					var item = arrUser[i];
					if (item.username == username) {
						return item;
					}
				}

				return "";
			}


			function GetAllUsers(token) {

				$.ajax({
					url: urlUsers,
					type: 'GET',
					async: false,
					headers: {
						'Cmdbuild-authorization': token
					},
					contentType: 'application/json',
					data: '',
					success: function(data) {
						//console.log(data);
						users = data.data;
						/*users = JSON.parse( '{"success":true,"data":[{"_id":55,"username":"workflow","description":"workflow","email":null,"active":true,"service":true,"_can_write":true},{"_id":27,"username":"admin","description":null,"email":null,"active":true,"service":false,"_can_write":true},{"_id":5141516,"username":"test","description":null,"email":null,"active":false,"service":false,"_can_write":true}],"meta":{"total":3}}');*/
						//users = users.data;
					},
					error: function(request, status, error) {
						alert(error);
					}
				});
			}

			function GetAllTenants(token) {

				$.ajax({
					url: urlTenant,
					type: 'GET',
					async: false,
					headers: {
						'Cmdbuild-authorization': token
					},
					contentType: 'application/json',
					data: '',
					success: function(data) {
						//console.log(data);
						tenants = data.data;
					},
					error: function(request, status, error) {
						alert(error);
					}
				});
			}

			function GetUserById(userId) {
				$.ajax({
					url: urlUsers + "/" + userId,
					type: 'GET',
					async: false,
					headers: {
						'Cmdbuild-authorization': token
					},
					contentType: 'application/json',
					data: '',
					success: function(data) {
						//console.log(data);
						userData = data.data;
					},
					error: function(request, status, error) {
						alert(error);
					}
				});
			}

			function CreateUserCmdbuild(dataUser) {
				$.ajax({
					url: urlUsers,
					type: 'POST',
					async: false,
					headers: {
						'Cmdbuild-authorization': token
					},
					contentType: 'application/json',
					data: dataUser,
					success: function(e) {
						swal("Berhasil!", "Reset password berhasil. Saat ini anda dapat melakukan login di '<?= $this->config->item("urlApp"); ?>' dengan username dan password anda", "success").then(function() {
							location.href = "<?php echo base_url() . "admin" ?>";
						});

					},
					error: function(request, status, error) {
						swal("Error!", "Sinkronisasi akun cmdbuild gagal. Silahkan hubungi administrator. Error: " + error, "error");
					}

				});
			}

			function UpdateUserCmdbuild(userIdCmdbuild) {
				userData = JSON.stringify(userData);

				$.ajax({
					url: urlUsers + "/" + userIdCmdbuild,
					type: 'PUT',
					async: false,
					headers: {
						'Cmdbuild-authorization': token
					},
					contentType: 'application/json',
					data: userData,
					success: function(e) {
						//alert('Success');
						$("#message").append(e);

						swal("Berhasil!", "Reset password berhasil. Saat ini anda dapat melakukan login di http://sigeol.sumedangkab.go.id:8080/cmdbuild dengan username dan password anda", "success").then(function() {
							location.href = "<?php echo base_url() . "admin" ?>";
						});

					},
					error: function(request, status, error) {
						swal("Error!", "Sinkronisasi akun sigeol gagal. Silahkan hubungi administrator. Error: " + error, "error");
					}
				});
			}

			function GetRoles() {
				$.ajax({
					url: urlRole,
					type: 'GET',
					async: false,
					headers: {
						'Cmdbuild-authorization': token
					},
					contentType: 'application/json',
					data: '',
					success: function(data) {
						//console.log(data);
						roles = data.data;
					},
					error: function(request, status, error) {
						console.log(error);
					}
				});
			}

			function GetRoleByRoleName(arrRoles, roleName) {
				for (var i = 0; i < arrRoles.length; i++) {
					var item = arrRoles[i];
					if (item.name.toLowerCase() == roleName.toLowerCase()) {
						return item;
					}
				}

				return "";
			}
		})(jQuery);
		/*ADD BY AYU*/
	</script>
</body>

</html>