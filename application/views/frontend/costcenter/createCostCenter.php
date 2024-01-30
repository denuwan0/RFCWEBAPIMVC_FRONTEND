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

					<h1 class="h3 mb-3">Create Cost Center</h1>
					
					<div class="row">
						<div class="col-12">
							<div class="card">
								<form id="create_company_form" action="" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
											<div class="col-12 col-lg-6">
												<div class="mb-3">
													<label class="form-label">Cost Center Name</label>
													<input type="text" class="form-control" id="cost_name" name="cost_name">
													<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>
												</div>																							
											</div>
											<div class="col-12 col-lg-6">
												<div class="mb-3">
													<label class="form-label">Cost Center Code</label>
													<input type="text" class="form-control" id="cost_code" name="cost_code">
													<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>
												</div>																							
											</div>
											<div class="col-12 col-lg-6">
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
												<button class="btn btn-lg btn-primary" type="button" id="loctionBtn">Save</button>
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
			//create ajax call
			$("#loctionBtn").click(function (e) {			 
				$("#loader").css('display', 'block');
				e.preventDefault();
				var is_active = 0;
							
				var cost_name = $("#cost_name").val();
				var cost_code = $("#cost_code").val();
				is_active = $('#is_active:checked').val();//$("#is_active").val();
				
				if(typeof cost_name !== 'undefined' && cost_name !== '' && typeof cost_code !== 'undefined' && cost_code !== ''){
										
					var cost_centerDetails = JSON.stringify({
						"cost_name": cost_name,
						"cost_code": cost_code,
						"is_active": is_active
					});
					
					//console.log(locationDetails);
					
					$form = $('#create_cost_center_form');
					create_cost_center_form($form);
					
					function create_cost_center_form($form) {
						var formdata = new FormData($form[0]);
						formdata.append('form_name', 'create_cost_center_form');
						
						$.ajax({
							type: 'POST',
							dataType: 'json',
							contentType: 'application/json',
							url: 'https://localhost:44371/api/Cost_Centers',
							data: cost_centerDetails,
							cache: false,
							processData: false,
							success: function (data) {
								//console.log(data.message);
								//$(".error_comp_name").html(data.comp_name);
								//$(".error_comp_code").html(data.comp_code);							

								if (data.message == "Successful") {
									
									$("#loader").css('display', 'none');
									$('#create_cost_center_form').trigger("reset");

									const notyf = new Notyf();
											notyf.success({
											message: 'Cost Center Created!',
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
										window.location.href = "http://localhost/saprfc/costcenter/view_cost_center";	
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