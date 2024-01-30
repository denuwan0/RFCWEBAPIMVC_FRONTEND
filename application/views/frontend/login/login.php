<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/backend/img/icons/saprfc.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>SAP RFC CPSTL</title>
	
	<link href="<?php echo base_url();?>assets/backend/css/light.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
	<style>
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
	}
	
	#loader{
		 z-index:999999;
		 display:block;
		 position:fixed;
		 top:0;
		 left:0;
		 width:100%;
		 height:100%;
		 background:url(<?php echo base_url();?>assets/backend/img/icons/loader1.gif) 50% 50% no-repeat #cccccc;
		}
	</style>
</head>
<body>
<div id="loader">
</div>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2"></h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
							<p class="" style="color:red">
								<?php echo $error_msg  = $this->session->userdata('error_msg');?>
							</p>
							
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="<?php echo base_url();?>assets/backend/img/icons/saprfc.png" alt="saprfc.png" class="img-fluid " width="132" height="132" />
									</div>
									<form id="user_login_form" action="#" method="">
										<div class="mb-3">
											<label class="form-label">EPF</label>
											<input class="form-control form-control-lg" type="number" name="emp_epf" id="emp_epf" placeholder="Enter your EPF" />
										</div>										
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="emp_password" id="emp_password" placeholder="Enter your password" />
											<!--small>
												<a href="<?php echo base_url(); ?>login/forgot/" id="forgot" name="forgot" >Forgot password?</a>
												<a href="<?php echo base_url(); ?>login/register/" id="newReg" name="newReg" onclick="">New Registeration?</a>
											</small-->
										</div>
										<div class="mb-3" id="company_select">
											
										</div>
										<div class="text-center mt-3">
											<button type="submit" id="user_login_btn" class="btn btn-lg btn-primary" >Sign in</button>
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
										</div>
										
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
<script>
 $(window).ready(function(){
	$("#loader").css('display', 'none');
	
 });
 </script>
</body>
<footer class="footer">
	<div class="container-fluid">
		<div class="row text-muted">
			<div class="col-6 text-start">
				<p class="mb-0">
					<a class="text-muted" href="" target=""><strong>SAP RFC CPSTL</strong></a> &copy;
				</p>
			</div>
			<div class="col-6 text-end">
				<ul class="list-inline">
					<li class="list-inline-item">
						<a class="text-muted" href="#" target="">Support</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="#" target="">Help Center</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="#" target="">Privacy</a>
					</li>
					<li class="list-inline-item"><!-- _blank-->
						<a class="text-muted" href="#" target="">Terms</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>

<script src="<?php echo base_url();?>assets/backend/js/app.js"></script>

</html>
<script>
			$list_company_form = $('#list_company_form');
			list_company_form($list_company_form);
			
			
			
			var clearHTML1 ="";
			clearHTML1 = '<label for="sel1">Company</label><select class="form-control" id="company"><option value="">Select your Company</option>';
		
			
			function list_company_form($list_company_form) {
				$("#loader").css('display', 'block');
				var formdata = new FormData($list_company_form[0]);
				formdata.append('form_name', 'list_company_form');
										
				$.ajax({
					type: "GET",
					cache : false,
					async: true,
					dataType: "json",
					cache: false,
					contentType: false,
					processData: false,
					url: "https://localhost:44371/api/companies/",	
					success: function (data) {
						//console.log(data);	
						
						$.each(data, function (i, item) {
							//pAreaArr.push(item.WA.substring(3, 7));
							clearHTML1 += '<option value="'+item.company_id+'">'+item.company_code+'-'+item.company_name+'</option>';
						});
						
						clearHTML1 += '</select>';
						
						$('#company_select').html(clearHTML1);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						$("#loader").css('display', 'none');							
						const notyf = new Notyf();
													
					
						notyf.error({
						  message: 'Failed to load resource: SQL CONNECTION DOWN!',
						  duration: 5000,
						  icon: true,
						  ripple: true,
						  dismissible: true,
						  position: {
							x: 'right',
							y: 'top',
						  }
						  
						})
						
					}
				});
			}
			
			

			//create ajax call
			$("#user_login_btn").click(function (e) {
				$("#loader").css('display', 'block');
				e.preventDefault();
				var emp_epf = $('#emp_epf').val();
				var emp_password = $('#emp_password').val();
				var company = $('#company').val();
				
				
				if(typeof emp_epf !== 'undefined' && emp_epf != '' && typeof emp_password !== 'undefined' && emp_password != ''
				&& typeof company !== 'undefined' && company != ''){
					
					$user_login_form = $('#user_login_form');
					user_login_form($user_login_form);
					
					/* $file_copy_form = $('#file_copy_form');
					file_copy_form($file_copy_form);			
					
					function file_copy_form($file_copy_form) {
						var formdata = new FormData($file_copy_form[0]);
						formdata.append('form_name', 'file_copy_form');
												
						$.ajax({
							type: 'POST',
							dataType: 'json',
							contentType: 'application/json',
							cache: false,
							processData: false,
							async: true,
							url: 'https://localhost:44371/api/Authentications/Getfile',
							//data: {uid:emp_epf , pass:emp_password },						
							success: function (data) {
								console.log(data);	
								$user_login_form = $('#user_login_form');
								user_login_form($user_login_form);
								
							},
							error: function(XMLHttpRequest, textStatus, errorThrown) {
								$("#loader").css('display', 'none');							
								const notyf = new Notyf();
															
							
								notyf.error({
								  message: 'Failed to load resource: SQL CONNECTION DOWN!',
								  duration: 5000,
								  icon: true,
								  ripple: true,
								  dismissible: true,
								  position: {
									x: 'right',
									y: 'top',
								  }
								  
								})
								
							}
						});
					} */
						
					
					
					function user_login_form($user_login_form) {
						//$("#loader").css('display', 'block');
						var formdata = new FormData($user_login_form[0]);
						formdata.append('form_name', 'user_login_form');
												
						$.ajax({
							type: 'GET',
							dataType: 'json',
							url: 'https://localhost:44371/api/Authentications/Authenticate',
							data: {uid:emp_epf , pass:emp_password },						
							success: function (data) {																
								//console.log(data);
								if (data.length > 0) {
									
									var emp_epf  = data[0]['emp_epf'];
									var emp_name = data[0]['emp_name'];
									var emp_id = data[0]['emp_id'];
									var emp_user_grp = data[0]['emp_user_grp'];
									var emp_user_sub_grp = data[0]['emp_user_sub_grp'];
									var emp_email = data[0]['emp_email'];
									var emp_mobile = data[0]['emp_mobile'];
									var func_id = data[0]['func_id'];
									var func_name = data[0]['func_name'];
									var company_id = data[0]['company_id'];
									var company_code = data[0]['company_code'];
									var company_name = data[0]['company_name'];
									var cost_id = data[0]['cost_id'];
									var cost_code = data[0]['cost_code'];
									var cost_name = data[0]['cost_name'];
									var plant_id = data[0]['plant_id'];
									var plant_code = data[0]['plant_code'];
									var plant_name = data[0]['plant_name'];
									var loc_id = data[0]['loc_id'];
									var loc_name = data[0]['loc_name'];
									var is_active = data[0]['is_active'];
									var form_name = 'user_login_form';
									
									var Jdata = JSON.stringify(data);//JSON.stringify(data);
									//console.log(Jdata);
									user_login();
									function user_login() {
										
										$.ajax
										({
											type: "GET",
											url: "https://localhost:44371/api/user_permissions/activeListByGrpIdPermUpdate/",
											dataType: 'json',
											data: {sub_id: emp_user_sub_grp},
											success: function (data1){
												
												var Pdata = JSON.stringify(data1);
												//console.log(Pdata);	
												
												$.ajax
												({
													type: "POST",
													url: "<?php echo base_url(); ?>index.php/login/login_ajax",
													dataType: 'json',
													data: {userData: Jdata,
													permData: data1},
													success: function (data){
														
														//console.log(data.status);
														if(data.status == true)	{
															window.location.href = "<?php echo base_url();?>index.php/login";
														}												
														
													},
													error: function(XMLHttpRequest, textStatus, errorThrown) {
														//console.log(errorThrown);
														//console.log(data);
													}
												});
												
											},
											error: function(XMLHttpRequest, textStatus, errorThrown) {
												//console.log(errorThrown);
												//console.log(data);
											}
										});
										
										
									}								
									
									
								}
								else{
									window.location.href = "<?php echo base_url();?>login";
								}
							},
							error: function(XMLHttpRequest, textStatus, errorThrown) {
								$("#loader").css('display', 'none');							
								const notyf = new Notyf();
							
								notyf.error({
								  message: 'Failed to load resource: SQL CONNECTION DOWN!',
								  duration: 5000,
								  icon: true,
								  ripple: true,
								  dismissible: true,
								  position: {
									x: 'right',
									y: 'top',
								  }
								  
								})
								
							}
						});
					}
					
				}
				else{
					$("#loader").css('display', 'none');
						const notyf = new Notyf();
							
							notyf.error({
							  message: 'Please provide required details!',
							  duration: 5000,
							  icon: true,
							  ripple: true,
							  dismissible: true,
							  position: {
								x: 'right',
								y: 'top',
							  }
							  
							})
					}
				
			});			
			
				
			
			
				
			</script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>