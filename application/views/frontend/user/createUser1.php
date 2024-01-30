			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Create Plant</h1>
					
					<div class="row">
						<div class="col-12">
							<div class="card">
								<form id="create_company_form" action="" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
											<div class="col-12 col-lg-6">
												<div class="mb-3">
													<label class="form-label">Plant Name</label>
													<input type="text" class="form-control" id="plant_name" name="plant_name">
												</div>
												<div class="mb-3">
													<label class="form-label">Plant Code</label>
													<input type="text" class="form-control" id="plant_code" name="plant_code">
													<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>
												</div>												
												
											</div>
											
											<div class="col-12 col-lg-6">
												
												<div class="mb-3">
													<label class="form-label">Location</label>
													<select class="form-control" name="loc_id"  id="loc_id">
													</select>
												</div>
												<div class="mb-3">
													<label class="form-label">Cost Center</label>
													<select class="form-control" name="cost_id"  id="cost_id">
													</select>
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
												<button class="btn btn-lg btn-primary" type="button" id="plantBtn">Save</button>
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
			$("#loader").css('display', 'block');
			
			$(document).ready(function() {
				
				
				//create plant filter
				var clearHTML1 = '<option value=""> Select Location</option>';
				
				$.ajax({
				type: "GET",
				cache : false,
				async: true,
				dataType: "json",
				contentType: 'application/json',
				//data: {},
				url: "https://localhost:44371/api/locations/get_active_list/",
				success: function(data, result){					
					//console.log(data);
					//--------------P Area --------------------//
					$.each(data, function (i, item1) {
						//item.WA.substring(3, 7);	
						clearHTML1 += '<option value="'+item1.loc_id+'">'+ item1.loc_name+ '</option>';	
					});
					
					$('#loc_id').append(clearHTML1);
					
					
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
				
				//create cost center filter
				var clearHTML2 = '<option value=""> Select Cost Center</option>';
				
				$.ajax({
				type: "GET",
				cache : false,
				async: true,
				dataType: "json",
				contentType: 'application/json',
				//data: {},
				url: "https://localhost:44371/api/cost_centers/get_active_list/",
				success: function(data, result){					
					//console.log(data);
					//--------------P Area --------------------//
					$.each(data, function (i, item2) {
						//item.WA.substring(3, 7);
						clearHTML2 += '<option value="'+item2.cost_id+'">'+ item2.cost_code+ ' - '+ item2.cost_name+ '</option>';	
					});
					
					$('#cost_id').append(clearHTML2);
					
					
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
				
				
			});
			//create ajax call
			$("#plantBtn").click(function (e) {			 
				$("#loader").css('display', 'block');
				e.preventDefault();
				var is_active = 0;
							
				var plant_name = $("#plant_name").val();
				var plant_code = $("#plant_code").val();
				var loc_id = $("#loc_id").val();
				var cost_id = $("#cost_id").val();
				
				is_active = $('#is_active:checked').val();//$("#is_active").val();
				
				if(typeof plant_name !== 'undefined' && plant_name !== '' && typeof plant_code !== 'undefined' && plant_code !== '' 
				&& typeof loc_id !== 'undefined' && loc_id !== '' && typeof cost_id !== 'undefined' && cost_id !== ''){
										
					var plantDetails = JSON.stringify({
						"plant_name": plant_name,
						"plant_code": plant_code,
						"loc_id": loc_id,
						"cost_center": cost_id,
						"is_active": is_active
					});
					
					//console.log(plantDetails);
					
					$form = $('#create_location_form');
					create_plant_form($form);
					
					function create_plant_form($form) {
						var formdata = new FormData($form[0]);
						formdata.append('form_name', 'create_plant_form');
						
						$.ajax({
							type: 'POST',
							dataType: 'json',
							contentType: 'application/json',
							url: 'https://localhost:44371/api/plants',
							data: plantDetails,
							cache: false,
							processData: false,
							success: function (data) {
								//console.log(data.message);
								//$(".error_comp_name").html(data.comp_name);
								//$(".error_comp_code").html(data.comp_code);							

								if (data.message == "Successful") {
									
									$("#loader").css('display', 'none');
									$('#create_company_form').trigger("reset");

									const notyf = new Notyf();
											notyf.success({
											message: 'Plant created!',
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
										window.location.href = "http://localhost/saprfc/plant/view_plant";	
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