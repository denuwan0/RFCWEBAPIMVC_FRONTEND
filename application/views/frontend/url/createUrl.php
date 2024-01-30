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

					<h1 class="h3 mb-3">Create URL</h1>
					
					<div class="row">
						<div class="col-12">
							<div class="card">
								<form id="create_company_form" action="" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
											<div class="col-12 col-lg-6">
												<div class="mb-3">
													<label class="form-label">Url Value</label>
													<input type="text" class="form-control" id="url_value" name="url_value">
													<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>
												</div>
												<div class="mb-3">
													<label class="form-label">Url Type</label>
													<select class="form-control" name="url_type"  id="url_type">
													</select>
												</div>
											</div>
											<div class="col-12 col-lg-6">
												<div class="mb-3">
													<label class="form-label">Menu Name</label>
													<input type="text" class="form-control" id="menu_name" name="menu_name">
													<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>
												</div>
												<div class="mb-3">
													<label class="form-check">
														<br/>
														<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
														<span class="form-check-label">															
															is active
														</span>
														<span style="color:red;position:absolute;font-size: 12px" class="error_is_active"></span>
													</label>
												</div>
											</div>
											<div class="text-center mt-3">
												<button class="btn btn-lg btn-primary" type="button" id="urlBtn">Save</button>
												<!-- <button type="submit" class="btn btn-lg btn-primary">Sign up</button> -->
											</div>
										</div>
									</div>
								</form>
							</div>							
						</div>
						<div id='result_display'>
							
						</div>
					</div>						
				</div>
			</main>
			
			<script>
			//create url type filter
			var clearHTML2 = '<option value=""> Select URL Type</option>';
			
			$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			//data: {},
			url: "https://localhost:44371/api/urlTypes/",
			success: function(data, result){					
				//console.log(data);
				//--------------P Area --------------------//
				$.each(data, function (i, item1) {
					//item.WA.substring(3, 7);	
					clearHTML2 += '<option value="'+item1.url_type_id+'">'+ item1.url_type_name+ '</option>';					
				});
				
				$('#url_type').append(clearHTML2);
				
				
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
			$("#urlBtn").click(function (e) {			 
				$("#loader").css('display', 'block');
				e.preventDefault();
				var is_active = 0;
							
				var url_value = $("#url_value").val();
				var url_type = $("#url_type").val();
				var menu_name = $("#menu_name").val();
				is_active = $('#is_active:checked').val();//$("#is_active").val();
				
				if(typeof url_value !== 'undefined' && url_value !== '' && typeof url_type !== 'undefined' && url_type !== ''
				&& typeof menu_name !== 'undefined' && menu_name !== ''){
										
					var urlDetails = JSON.stringify({
						"url_value": url_value,
						"url_type": url_type,
						"menu_name": menu_name,
						"is_active": is_active
					});
					
					
					
					//console.log(urlDetails);
					
					
					$form = $('#create_url_form');
					create_url_form($form);
					
					function create_url_form($form) {
						var formdata = new FormData($form[0]);
						formdata.append('form_name', 'create_url_form');
						
						$.ajax({
							type: 'POST',
							dataType: 'json',
							crossDomain: true,
							contentType: 'application/json',
							url: 'https://localhost:44371/api/urls/',
							data: urlDetails,
							cache: false,
							processData: false,
							success: function (data) {
								//console.log(data.message);
								//$(".error_comp_name").html(data.comp_name);
								//$(".error_comp_code").html(data.comp_code);							

								if (data.message == "Successful") {

									$("#loader").css('display', 'none');
									$('#create_url_form').trigger("reset");
									
									var url_id = data.url_id;
									var url_type = data.url_type;
									
									var permDetails = JSON.stringify({
										"user_sub_grp_id": 0,
										"url": url_id,
										"url_type": url_type,
										"is_view": 0,
										"is_edit": 0,
										"is_active": 0
									});
									
									$.ajax({
										type: "POST",
										cache : false,
										async: true,
										dataType: "json",
										contentType: 'application/json',
										data: permDetails,
										crossDomain: true,
										url: "https://localhost:44371/api/UserPermission/",
										success: function(data, result){					
											//console.log(data);
											
											const notyf = new Notyf();
													notyf.success({
													message: 'URL created!',
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
												window.location.href = "http://localhost/saprfc/user/update_user_permission/";	
											}, 2000);
																						
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