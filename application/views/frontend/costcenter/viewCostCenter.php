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

					<h1 class="h3 mb-3">View Cost Center</h1>
					
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
				$("#loader").css('display', 'block');
				$("#result_display").empty();
				var clearHTML1 ="";
				clearHTML1 = '<table id="example" class="table" style="width:100%"><thead><tr><th>Id</th><th>Cost Center name</th><th>Cost Center Code</th><th>Status</th><th>is_active_value</th><th>Option</th></tr></thead><tbody>';
				//all data call
				
				$form = $('#view_cost_center_form');
				view_cost_center($form);
				function view_cost_center($form) {
					var formdata = new FormData($form[0]);
					formdata.append('form_name', 'view_cost_center_form');
					$.ajax({ 
						type: "GET",
						cache : false,
						async: true,
						dataType: "json",
						cache: false,
						contentType: false,
						processData: false,
						url: "https://localhost:44371/api/cost_centers/",
						success: function(data, response){
							//console.log(data);
							$.each(data, function (i, item) {
								//pAreaArr.push(item.WA.substring(3, 7));	
								clearHTML1 += '<tr class="line">';
								clearHTML1 += '<td id="cost_id" class="cost_id">'+item.cost_id+'</td>';
								clearHTML1 += '<td id="cost_name" class="cost_name">'+item.cost_name+'</td>';
								clearHTML1 += '<td id="cost_code" class="cost_code">'+item.cost_code+'</td>';
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
							table.column(4).visible(false);
							//get data table row id click event
							$("#example tbody").on("click",'tr', function() {
								//$(this).on("click",'tr', function(){
									
									var data = table.row(this).data();
									//console.log(data);
									var cost_id = data[0];
									var cost_name = data[1];
									var cost_code = data[2];	
									var is_active = data[4];
									var checked = "";
									
									if(is_active == 1){
										checked = 'checked';
									}
									
									//console.log(is_active);
									var is_edit=0;
									is_edit = <?php echo $is_edit; ?>;
									var modal = '';
									
									if(is_edit == 1){
										modal = '<div class="modal fade" id="Mymodal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
												  '<div class="modal-dialog">'+
													'<div class="modal-content">'+
													  '<div class="modal-header">'+
														'<h5 class="modal-title" id="staticBackdropLabel">Edit Cost Center Details</h5>'+
														'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
													  '</div>'+
													  '<div class="modal-body">'+
														'<div class="row">'+
															'<div class="col-12">'+
																'<input type="hidden" class="form-control" id="cost_id_edit" name="cost_id_edit" value="'+cost_id+'">'+
																'<input type="hidden" class="form-control" id="is_active_value_edit" name="is_active_value_edit" value="'+is_active+'">'+
																'<div class="">'+
																	'<label class="form-label">Cost Center Name</label>'+
																	'<input type="text" class="form-control" id="cost_name_edit" name="cost_name_edit" value="'+cost_name+'">'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+	
																'<div class="">'+
																	'<label class="form-label">Cost Center Code</label>'+
																	'<input type="text" class="form-control" id="cost_code_edit" name="cost_code_edit" value="'+cost_code+'">'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
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
															'<button class="btn btn-lg btn-primary" type="button" id="costCenterEditBtn">Save</button>'+
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
														'<h5 class="modal-title" id="staticBackdropLabel">Edit Cost Center Details</h5>'+
														'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
													  '</div>'+
													  '<div class="modal-body">'+
														'<div class="row">'+
															'<div class="col-12">'+
																'<input type="hidden" class="form-control" id="cost_id_edit" name="cost_id_edit" value="'+cost_id+'">'+
																'<input type="hidden" class="form-control" id="is_active_value_edit" name="is_active_value_edit" value="'+is_active+'">'+
																'<div class="">'+
																	'<label class="form-label">Cost Center Name</label>'+
																	'<input type="text" class="form-control" id="cost_name_edit" name="cost_name_edit" value="'+cost_name+'" disabled>'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+	
																'<div class="">'+
																	'<label class="form-label">Cost Center Code</label>'+
																	'<input type="text" class="form-control" id="cost_code_edit" name="cost_code_edit" value="'+cost_code+'" disabled>'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
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
															'<button class="btn btn-lg btn-primary" type="button" id="costCenterEditBtn">Save</button>'+
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
								
								$(document).on("click", "#costCenterEditBtn", function(event){			 
								//e.preventDefault();
								
								//$("#loader").css('display', 'block');
							
								var is_active = ($('#is_active_edit').prop("checked")) ? (1) : (0);					
								var cost_id = $("#cost_id_edit").val();
								var cost_name = $("#cost_name_edit").val();
								var cost_code = $("#cost_code_edit").val();
																								
								
								if(typeof cost_name !== 'undefined' && cost_name !== '' && typeof cost_code !== 'undefined' && cost_code !== ''){
								
									var costCenterDetails = JSON.stringify({
											"cost_id": cost_id,
											"cost_name": cost_name,
											"cost_code": cost_code,
											"is_active": is_active
										});
										
										//console.log(costCenterDetails);
										$form = $('#update_cost_center_form');
										update_cost_center($form);
									
									function update_cost_center($form) {
										var formdata = new FormData($form[0]);
										formdata.append('form_name', 'update_cost_center_form');
										$.ajax({
											type: 'PUT',
											dataType: 'json',
											contentType: 'application/json',
											url: 'https://localhost:44371/api/cost_centers/'+cost_id,
											data: costCenterDetails,
											cache: false,
											processData: false,
											crossDomain: true,
											success: function (data) {
											

												if (data.message == "Successful")  {
												
													setTimeout(location.reload.bind(location), 1000);

													const notyf = new Notyf();
														notyf.success({
														  message: 'Cost Center Updated!',
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
													$('#create_company_form').trigger("reset");	

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