<?php 

$baseUrl = '';
$currentUrl = '';
$url = '';

$baseUrl = rtrim(base_url(), "/");
$currentUrl = $_SERVER['REQUEST_URI'];

$x = explode('/', $currentUrl);

$array = $this->session->userdata('permData');	
//echo $url = base_url().$x[2].'/'.$x[3];
$key = base_url().$x[2].'/'.$x[3];

//var_dump($array);	

//var_dump($array[$key][0]['is_active']);	

if($array[$key][0]['is_active'] != 1){
	header("Location: http://localhost/saprfc/user/access_denied");
	die();
}
?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Create User</h1>
					
					<div class="row">
						<div class="col-12">
							<div class="card">							
								<div class="card-header">
									<a type="button" class="btn btn-primary" onclick="" href="<?php echo base_url(); ?>user/user_bulk_upload">Bulk upload</a>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-12 col-lg-6">
											<div class="mb-3">
												<label class="form-label">Employee EPF</label>
												<input type="text" class="form-control" name="emp_epf"  id="emp_epf">
											</div>
											<div class="mb-3">
												<label class="form-label">Employee Name</label>
												<input type="text" class="form-control" name="emp_name"  id="emp_name">
											</div>
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input type="text" class="form-control" name="emp_email"  id="emp_email">
											</div>	
											<div class="mb-3">
												<label class="form-label">Mobile</label>
												<input type="text" class="form-control" name="emp_mobile"  id="emp_mobile">
											</div>
											<div class="mb-3">
												<label class="form-label">Password</label>
												<input type="password" class="form-control" name="emp_password"  id="emp_password">
											</div>
											<div class="mb-3">
												<label class="form-label">Re-Password</label>
												<input type="password" class="form-control" name="emp_password_re"  id="emp_password_re">
											</div>
											
										</div>
										<div class="col-12 col-lg-6">
											<div class="mb-3">
												<label class="form-label">User Group</label>
												<select class="form-control" name="emp_user_grp"  id="emp_user_grp">
												</select>
											</div>
											<div class="mb-3">
												<label class="form-label">User Sub Group</label>
												<select class="form-control" name="emp_user_sub_grp"  id="emp_user_sub_grp">
												</select>
											</div>
											<div class="mb-3">
												<label class="form-label">Company</label>
												<select class="form-control" name="emp_company"  id="emp_company">
												</select>
											</div>
											<div class="mb-3">
												<label class="form-label">Function</label>
												<select class="form-control" name="emp_function"  id="emp_function">
												</select>
											</div>	
											<div class="mb-3">
												<label class="form-label">Location</label>
												<select class="form-control" name="emp_location"  id="emp_location">
												</select>
											</div>
											<div class="mb-3">
												<label class="form-label">Plant</label>
												<select class="form-control" name="emp_plant"  id="emp_plant">
												</select>
											</div>
											<div class="mb-3">
												<label class="form-check">
													<br>
													<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
													<span class="form-check-label">															
														is active
													</span>
													<span style="color:red;position:absolute;font-size: 12px" class="error_is_active"></span>
												</label>
											</div>
										</div>
										
										<div class="text-center mt-3">
											<button class="btn btn-lg btn-primary" type="button" id="userBtn">Save</button>
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign up</button> -->
										</div>
									</div>
								</div>
							</div>							
							</div>
							<div id='result_display'>
								
							</div>
						</div>
						
					</div>

				</div>
			</main>
			
			<script>
			$("#loader").css('display', 'block');
			
			//create group filter
			var clearHTML2 = '<option value=""> Select User Group</option>';
			
			$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			//data: {},
			url: "https://localhost:44371/api/usergroups/",
			success: function(data, result){					
				//console.log(data);
				//--------------P Area --------------------//
				$.each(data, function (i, item1) {
					//item.WA.substring(3, 7);	
					clearHTML2 += '<option value="'+item1.grp_id+'">'+ item1.grp_name+ '</option>';					
				});
				
				$('#emp_user_grp').append(clearHTML2);
				
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
				const notyf = new Notyf();
			
				notyf.error({
				  message: 'Failed to load resource: SAP CONNECTION DOWN!',
				  duration: 5000,
				  icon: true,
				  ripple: true,
				  dismissible: true,
				  position: {
					x: 'right',
					y: 'top',
				  }
				  
				})
				
			}});
			
			//create sub group filter
			var clearHTML3 = '<option value=""> Select Sub Group</option>';
			
			$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			//data: {},
			url: "https://localhost:44371/api/UserSubGroups/",
			success: function(data, result){					
				//console.log(data);
				//--------------P Area --------------------//
				$.each(data, function (i, item2) {
					//item.WA.substring(3, 7);					
					clearHTML3 += '<option value="'+item2.sub_group_id+'">'+ item2.sub_group_name+ ' - '+ item2.sub_group_name+ '</option>';					
				});
				
				$('#emp_user_sub_grp').append(clearHTML3);
				
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
				const notyf = new Notyf();
			
				notyf.error({
				  message: 'Failed to load resource: SAP CONNECTION DOWN!',
				  duration: 5000,
				  icon: true,
				  ripple: true,
				  dismissible: true,
				  position: {
					x: 'right',
					y: 'top',
				  }
				  
				})
				
			}});
			
			//create company filter
			var clearHTML4 = '<option value=""> Select Company</option>';
			
			$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			//data: {},
			url: "https://localhost:44371/api/companies/",
			success: function(data, result){					
				//console.log(data);
				//--------------P Area --------------------//
				$.each(data, function (i, item3) {
					clearHTML4 += '<option value="'+item3.company_id+'">'+ item3.company_code+ ' - '+ item3.company_name+ '</option>';
				});
				
				$('#emp_company').append(clearHTML4);
				
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
				const notyf = new Notyf();
			
				notyf.error({
				  message: 'Failed to load resource: SAP CONNECTION DOWN!',
				  duration: 5000,
				  icon: true,
				  ripple: true,
				  dismissible: true,
				  position: {
					x: 'right',
					y: 'top',
				  }
				  
				})
				
			}});
			
			//create function filter
			var clearHTML5 = '<option value=""> Select Function</option>';
			
			$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			//data: {},
			url: "https://localhost:44371/api/functions/",
			success: function(data, result){					
				//console.log(data);
				//--------------P Area --------------------//
				$.each(data, function (i, item4) {
					clearHTML5 += '<option value="'+item4.func_id+'">'+ item4.func_name+'</option>';
				});
				
				$('#emp_function').append(clearHTML5);
				
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
				const notyf = new Notyf();
			
				notyf.error({
				  message: 'Failed to load resource: SAP CONNECTION DOWN!',
				  duration: 5000,
				  icon: true,
				  ripple: true,
				  dismissible: true,
				  position: {
					x: 'right',
					y: 'top',
				  }
				  
				})
				
			}});
			
			//create location filter
			var clearHTML6 = '<option value=""> Select Location</option>';
			
			$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			//data: {},
			url: "https://localhost:44371/api/locations/",
			success: function(data, result){					
				//console.log(data);
				//--------------P Area --------------------//
				$.each(data, function (i, item5) {
					clearHTML6 += '<option value="'+item5.loc_id+'">'+ item5.loc_name+ '</option>';
				});
				
				$('#emp_location').append(clearHTML6);
				
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
				const notyf = new Notyf();
			
				notyf.error({
				  message: 'Failed to load resource: SAP CONNECTION DOWN!',
				  duration: 5000,
				  icon: true,
				  ripple: true,
				  dismissible: true,
				  position: {
					x: 'right',
					y: 'top',
				  }
				  
				})
				
			}});
			
			//create plant filter
			var clearHTML7 = '<option value=""> Select Plant</option>';
			
			$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			//data: {},
			url: "https://localhost:44371/api/plants/",
			success: function(data, result){					
				//console.log(data);
				//--------------P Area --------------------//
				$.each(data, function (i, item6) {
					clearHTML7 += '<option value="'+item6.plant_id+'">'+ item6.plant_name+'</option>';
				});
				
				$('#emp_plant').append(clearHTML7);
				
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
				const notyf = new Notyf();
			
				notyf.error({
				  message: 'Failed to load resource: SAP CONNECTION DOWN!',
				  duration: 5000,
				  icon: true,
				  ripple: true,
				  dismissible: true,
				  position: {
					x: 'right',
					y: 'top',
				  }
				  
				})
				
			}});
			
			//create ajax call
			$("#userBtn").click(function (e) {			 
				$("#loader").css('display', 'block');
				e.preventDefault();
				var is_active = 0;
							
				var emp_epf  = $("#emp_epf").val();
				var emp_user_grp  = $("#emp_user_grp").val();
				var emp_user_sub_grp  = $("#emp_user_sub_grp").val();
				var emp_name  = $("#emp_name").val();
				var emp_email  = $("#emp_email").val();
				var emp_password  = $("#emp_password").val();
				var emp_password_re  = $("#emp_password_re").val();
				var emp_company  = $("#emp_company").val();
				var emp_function  = $("#emp_function").val();
				var emp_location  = $("#emp_location").val();
				var emp_plant  = $("#emp_plant").val();
				var emp_mobile  = $("#emp_mobile").val();				
				is_active = $('#is_active:checked').val();
				
				if(typeof emp_epf !== 'undefined' && emp_epf !== ''
				&& typeof emp_user_grp !== 'undefined' && emp_user_grp !== '' && typeof emp_user_sub_grp !== 'undefined' && emp_user_sub_grp !== ''
				&& typeof emp_name !== 'undefined' && emp_name !== '' && typeof emp_email !== 'undefined' && emp_email !== ''
				&& typeof emp_password !== 'undefined' && emp_password !== '' && typeof emp_password_re !== 'undefined' && emp_password_re !== '' 
				&& typeof emp_company !== 'undefined' && emp_company !== '' && typeof emp_function !== 'undefined' && emp_function !== '' 
				&& typeof emp_location !== 'undefined' && emp_location !== '' && typeof emp_plant !== 'undefined' && emp_plant !== '' 
				&& typeof emp_mobile !== 'undefined' && emp_mobile !== '' && typeof is_active !== 'undefined' && is_active !== ''){
					
					if(emp_password == emp_password_re){
						
						var groupDetails = JSON.stringify({
							"emp_epf": emp_epf,
							"emp_user_grp": emp_user_grp,
							"emp_user_sub_grp": emp_user_sub_grp,
							"emp_name": emp_name,
							"emp_email": emp_email,
							"emp_password": emp_password,
							"emp_password_re": emp_password_re,
							"emp_company": emp_company,
							"emp_function": emp_function,
							"emp_location": emp_location,
							"emp_plant": emp_plant,
							"emp_mobile": emp_mobile,
							"is_active": is_active
						});
						
						//console.log(plantDetails);
						
						$form = $('#create_user_form');
						create_user_form($form);
						
						function create_user_form($form) {
							var formdata = new FormData($form[0]);
							formdata.append('form_name', 'create_user_form');
							
							$.ajax({
								type: 'POST',
								dataType: 'json',
								contentType: 'application/json',
								url: 'https://localhost:44371/api/users',
								data: groupDetails,
								cache: false,
								processData: false,
								success: function (data) {
									//console.log(data.message);
													

									if (data.message == "Successful") {
										
										$("#loader").css('display', 'none');
										$('#create_user_form').trigger("reset");

										const notyf = new Notyf();
											notyf.success({
												message: 'User created!',
												duration: 5000,
												alertIcon: 'fa fa-check-circle',
												warnIcon: 'fa fa-check-circle',
												icon: true,
												ripple: true,
												dismissible: true,
												position: {
													x: 'right',
													y: 'top',
												}
											  
											})
										window.setTimeout(function() {
											window.location.href = "http://localhost/saprfc/user/view_user";	
										}, 2000);
										
											
									}

								},
								error: function(XMLHttpRequest, textStatus, errorThrown) {
									$("#loader").css('display', 'none');							
									const notyf = new Notyf();
								
									notyf.error({
									  message: 'ERROR OCCURED!',
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
							  message: 'Password and Re-Password does not match!',
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