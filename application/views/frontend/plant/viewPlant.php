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

//var_dump($array[$key]);	

//var_dump($array[$key][2]['is_edit']);	
if($array[$key][0]['is_active'] != 1){
	header("Location: http://localhost/saprfc/user/access_denied");
	die();
}
if($array[$key][1]['is_view'] != 1){
	header("Location: http://localhost/saprfc/user/access_denied");
	die();
}
$is_edit=0;
if($array[$key][2]['is_edit'] == 1){
	$is_edit=1;
}

?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">View Plant</h1>
					
					<div class="row">
						<div class="col-12">
							<div class="card">
								<form id="view_location_form" action="" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
											<div class="col-12 ">
												<div id='result_display'>
												
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>							
						</div>
					</div>						
				</div>
			</main>
			
			<!-- Button trigger modal -->
				<!-- Modal -->
				<div id="modal_display"></div>
				
			<script>
			$(document).ready(function() {
				
				$("#result_display").empty();
				var clearHTML1 ="";
				clearHTML1 = '<table id="example" class="table" style="width:100%"><thead><tr><th>Id</th><th>Plant Name</th><th>Plant Code</th><th>Location</th><th>Cost Center</th><th>Status</th><th>is_active_value</th><th>Option</th></tr></thead><tbody>';
				//all data call
				
				$form = $('#view_plant_form');
				view_plant($form);
				function view_plant($form) {
					var formdata = new FormData($form[0]);
					formdata.append('form_name', 'view_plant_form');
					$.ajax({ 
						type: "GET",
						cache : false,
						async: true,
						dataType: "json",
						cache: false,
						contentType: false,
						processData: false,
						url: "https://localhost:44371/api/plants/",
						success: function(data, response){
							//console.log(data);
							
							$.each(data, function (i, item) {
								//pAreaArr.push(item.WA.substring(3, 7));
	
								
								clearHTML1 += '<tr class="line">';
								clearHTML1 += '<td id="plant_id" class="plant_id">'+item.plant_id+'</td>';
								clearHTML1 += '<td id="plant_name" class="plant_name">'+item.plant_name+'</td>';								
								clearHTML1 += '<td id="plant_code" class="plant_code">'+item.plant_code+'</td>';
								clearHTML1 += '<td id="loc_id" class="loc_id">'+item.loc_id+'</td>';
								clearHTML1 += '<td id="cost_center" class="cost_center">'+item.cost_center+'</td>';
								if(item.is_active == 1){
									clearHTML1 += '<td id="is_active" class="is_active" ><span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right" ></i> Active </span></td>';
								}
								if(item.is_active == 0){
									clearHTML1 += '<td id="is_active" class="is_active" ><span class="badge badge-danger-light"> <i class="mdi mdi-arrow-bottom-right" ></i> Inactive </span> </td>';
								}
								clearHTML1 += '<td id="is_active_value" class="is_active_value">'+item.is_active+'</td>';
								clearHTML1 += '<td class="table-action">';
								clearHTML1 += '<a class="editLine" id="editLine" href="#" style="margin: 10px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
								//clearHTML1 += '<a class="deleteLine" id="deleteLine" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>';
								clearHTML1 += '</td>';
								clearHTML1 += '</tr>';
							});
							
							clearHTML1 += '</tbody></table>';
							
							
							
							//if (data['success'] == true) {	
								$("#result_display").append("");
								$('#result_display').append(clearHTML1);
								
								$('#example').DataTable( {
									"scrollY": 400,
									"scrollX": true
								} );
							//}
							
							//get table 
							var table = $('#example').DataTable();
							//hide 4th column
							table.column(3).visible(false);
							table.column(4).visible(false);
							table.column(6).visible(false);
							//get data table row id click event
							$("#example tbody").on("click",'tr', function() {
								//$(this).on("click",'tr', function(){
									
									var data = table.row(this).data();
									//console.log(data);
									var plant_id = data[0];
									var plant_name = data[1];									
									var plant_code = data[2];
									var loc_id = data[3];
									var cost_center = data[4];
									var is_active = data[6];
									var checked = "";
									
									if(is_active == 1){
										checked = 'checked';
									}
									
									//create plant filter
									var clearHTML1 = '<option value=""> Select Location</option>';
									
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
										$.each(data, function (i, item1) {
											//item.WA.substring(3, 7);	
											if(loc_id == item1.loc_id){
												clearHTML1 += '<option value="'+item1.loc_id+'" selected>'+ item1.loc_name+ '</option>';	
											}
											else{
												clearHTML1 += '<option value="'+item1.loc_id+'">'+ item1.loc_name+ '</option>';
											}
										});
										
										$('#loc_id_select').append(clearHTML1);
										
										
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
									url: "https://localhost:44371/api/cost_centers/",
									success: function(data, result){					
										//console.log(data);
										//--------------P Area --------------------//
										$.each(data, function (i, item2) {
											//item.WA.substring(3, 7);
											//console.log(item2.cost_id);
											if(cost_center == item2.cost_id){
												clearHTML2 += '<option value="'+item2.cost_id+'" selected>'+item2.cost_code+ ' - '+ item2.cost_name+ '</option>';	
											}
											else{
												clearHTML2 += '<option value="'+item2.cost_id+'">'+ item2.cost_code+ ' - '+ item2.cost_name+ '</option>';
											}
											
										});
										
										$('#cost_center_select').append(clearHTML2);
										
										
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
									
									//console.log(is_active);
									var is_edit=0;
									is_edit = <?php echo $is_edit; ?>;
									var modal = '';
									
									if(is_edit == 1){
										modal = '<div class="modal fade" id="Mymodal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
												  '<div class="modal-dialog">'+
													'<div class="modal-content">'+
													  '<div class="modal-header">'+
														'<h5 class="modal-title" id="staticBackdropLabel">Edit Plant Details</h5>'+
														'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
													  '</div>'+
													  '<div class="modal-body">'+
														'<div class="row">'+
															'<div class="col-12">'+
																'<input type="hidden" class="form-control" id="plant_id_edit" name="plant_id_edit" value="'+plant_id+'">'+
																'<input type="hidden" class="form-control" id="is_active_value_edit" name="is_active_value_edit" value="'+is_active+'">'+
																'<div class="">'+
																	'<label class="form-label">Plant Code</label>'+
																	'<input type="text" class="form-control" id="plant_code_edit" name="plant_code_edit" value="'+plant_code+'">'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Plant Name</label>'+
																	'<input type="text" class="form-control" id="plant_name_edit" name="plant_name_edit" value="'+plant_name+'">'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Location</label>'+
																	'<select class="form-control" name="loc_id_select"  id="loc_id_select">'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																'<label class="form-label">Cost Center</label>'+
																	'<select class="form-control" name="cost_center_select"  id="cost_center_select">'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-check">'+
																		'<br/>'+
																		'<input class="form-check-input" type="checkbox" name="is_active_edit" id="is_active_edit" value="1" '+checked+'>'+
																		'<span class="form-check-label">'+															
																			'is active'+
																		'</span>'+
																		'<span style="color:red;position:absolute;font-size: 12px" class="error_is_active"></span>'+
																	'</label>'+
																'</div>'+
															'</div>'+
														'</div>'+
													  '</div>'+
													  '<div class="modal-footer">'+
														'<div class="text-center mt-3">'+
															'<button class="btn btn-lg btn-primary" type="button" id="plantEditBtn">Save</button>'+
														'</div>'+
													  '</div>'+
													'</div>'+
												  '</div>'+
												'</div>';
									}
									else{
										modal = '<div class="modal fade" id="Mymodal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
												  '<div class="modal-dialog">'+
													'<div class="modal-content">'+
													  '<div class="modal-header">'+
														'<h5 class="modal-title" id="staticBackdropLabel">Edit Plant Details</h5>'+
														'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
													  '</div>'+
													  '<div class="modal-body">'+
														'<div class="row">'+
															'<div class="col-12">'+
																'<input type="hidden" class="form-control" id="plant_id_edit" name="plant_id_edit" value="'+plant_id+'">'+
																'<input type="hidden" class="form-control" id="is_active_value_edit" name="is_active_value_edit" value="'+is_active+'">'+
																'<div class="">'+
																	'<label class="form-label">Plant Code</label>'+
																	'<input type="text" class="form-control" id="plant_code_edit" name="plant_code_edit" value="'+plant_code+'" disabled>'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Plant Name</label>'+
																	'<input type="text" class="form-control" id="plant_name_edit" name="plant_name_edit" value="'+plant_name+'" disabled>'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Location</label>'+
																	'<select class="form-control" name="loc_id_select"  id="loc_id_select" disabled>'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																'<label class="form-label">Cost Center</label>'+
																	'<select class="form-control" name="cost_center_select"  id="cost_center_select" disabled>'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-check">'+
																		'<br/>'+
																		'<input class="form-check-input" type="checkbox" name="is_active_edit" id="is_active_edit" value="1" '+checked+' disabled>'+
																		'<span class="form-check-label">'+															
																			'is active'+
																		'</span>'+
																		'<span style="color:red;position:absolute;font-size: 12px" class="error_is_active"></span>'+
																	'</label>'+
																'</div>'+
															'</div>'+
														'</div>'+
													  '</div>'+
													  '<div class="modal-footer">'+
														'<div class="text-center mt-3">'+
															
														'</div>'+
													  '</div>'+
													'</div>'+
												  '</div>'+
												'</div>';
									}
									
									
									$("#modal_display").html("");
									$('#modal_display').append(modal);
									
									$('#Mymodal1').modal('show');
									
								//});
							
								});
								
								$(document).on("click", "#plantEditBtn", function(event){			 
								//e.preventDefault();
								
								//$("#loader").css('display', 'block');
							
								var is_active = ($('#is_active_edit').prop("checked")) ? (1) : (0);					
								var plant_id = $("#plant_id_edit").val();
								var plant_name = $("#plant_name_edit").val();
								var plant_code = $("#plant_code_edit").val();
								var loc_id = $("#loc_id_select").val();
								var cost_center = $("#cost_center_select").val();
																								
								
								if(typeof plant_name !== 'undefined' && plant_name !== '' && typeof plant_code !== 'undefined' && plant_code !== ''
								&& typeof loc_id !== 'undefined' && loc_id !== '' && typeof cost_center !== 'undefined' && cost_center !== ''){
								
									var plantDetails = JSON.stringify({
											"plant_id": plant_id,
											"plant_name": plant_name,
											"plant_code": plant_code,
											"loc_id": loc_id,
											"cost_center": cost_center,
											"is_active": is_active
										});
										
										//console.log(plantDetails);
										$form = $('#update_plant_form');
										update_plant($form);
									
									function update_plant($form) {
										var formdata = new FormData($form[0]);
										formdata.append('form_name', 'update_plant_form');
										$.ajax({
											type: 'PUT',
											dataType: 'json',
											contentType: 'application/json',
											url: 'https://localhost:44371/api/plants/'+plant_id,
											data: plantDetails,
											cache: false,
											processData: false,
											crossDomain: true,
											success: function (data) {
											

												if (data.message == "Successful")  {
												
													setTimeout(location.reload.bind(location), 1000);

													const notyf = new Notyf();
														notyf.success({
														  message: 'Plant Updated!',
														  duration: 5000,
														  icon: true,
														  ripple: true,
														  dismissible: true,
														  position: {
															x: 'right',
															y: 'top',
														  }
														  
														})
													$("#loader").css('display', 'none');
													$('#create_plant_form').trigger("reset");	

													$('#Mymodal1').modal('hide');
													
													
												}
												
											}
											,error: function(XMLHttpRequest, textStatus, errorThrown){
													
											}
										});
										
									}
									
								}
								else{
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
								
								
							},
								error: function(XMLHttpRequest, textStatus, errorThrown) {
								//alert("some error");
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
					
					//create ajax call
					
					
					
					
						
				}
			} );	
				
			</script>