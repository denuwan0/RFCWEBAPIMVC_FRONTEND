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

					<h1 class="h3 mb-3">View User</h1>
					
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
				clearHTML1 = '<table id="example" class="table" style="width:100%"><thead><tr>';
				clearHTML1 += '<th>Id</th>';
				clearHTML1 += '<th>EPF</th>';
				clearHTML1 += '<th>User Group</th>';
				clearHTML1 += '<th>Sub User Group</th>';
				clearHTML1 += '<th>Name</th>';
				clearHTML1 += '<th>Email</th>';
				clearHTML1 += '<th>Password</th>';
				clearHTML1 += '<th>Company</th>';
				clearHTML1 += '<th>Function</th>';
				clearHTML1 += '<th>Location</th>';
				clearHTML1 += '<th>Plant</th>';
				clearHTML1 += '<th>Mobile</th>';
				clearHTML1 += '<th>Status</th>';
				clearHTML1 += '<th>is_active_value</th>';
				clearHTML1 += '<th>Option</th>';
				clearHTML1 += '</tr></thead><tbody>';
				//all data call
				
				$form = $('#view_user_form');
				view_user_form($form);
				function view_user_form($form) {
					var formdata = new FormData($form[0]);
					formdata.append('form_name', 'view_user_form');
					$.ajax({ 
						type: "GET",
						cache : false,
						async: true,
						dataType: "json",
						cache: false,
						contentType: false,
						processData: false,
						url: "https://localhost:44371/api/users/",
						success: function(data, response){
							//console.log(data);
							
							$.each(data, function (i, item) {
								//pAreaArr.push(item.WA.substring(3, 7));
								//console.log(item.emp_user_grp);
								
								if(item.emp_user_sub_grp == 0){
									clearHTML1 += '<tr class="line bg-primary bg-gradient text-light" >';
								} 
								else{
									clearHTML1 += '<tr class="line" >';
								}
								
								
								clearHTML1 += '<td id="emp_id" class="emp_id">'+item.emp_id+'</td>';
								clearHTML1 += '<td id="emp_epf" class="emp_epf">'+item.emp_epf+'</td>';								
								clearHTML1 += '<td id="emp_user_grp" class="emp_user_grp">'+item.emp_user_grp+'</td>';
								clearHTML1 += '<td id="emp_user_sub_grp" class="emp_user_sub_grp">'+item.emp_user_sub_grp+'</td>';
								clearHTML1 += '<td id="emp_name" class="emp_name">'+item.emp_name+'</td>';
								clearHTML1 += '<td id="emp_email" class="emp_email">'+item.emp_email+'</td>';
								clearHTML1 += '<td id="emp_password" class="emp_password">'+item.emp_password+'</td>';								
								clearHTML1 += '<td id="emp_company" class="emp_company">'+item.emp_company+'</td>';
								clearHTML1 += '<td id="emp_function" class="emp_function">'+item.emp_function+'</td>';
								clearHTML1 += '<td id="emp_location" class="emp_location">'+item.emp_location+'</td>';
								clearHTML1 += '<td id="emp_plant" class="emp_plant">'+item.emp_plant+'</td>';
								clearHTML1 += '<td id="emp_mobile" class="emp_mobile">'+item.emp_mobile+'</td>';
								if(item.is_active == 1){
									if(item.emp_user_sub_grp == 0){
										clearHTML1 += '<td id="is_active" class="is_active" ><span class="badge badge-success-light text-light"> <i class="mdi mdi-arrow-bottom-right" ></i> Active </span></td>';
									} 
									else{
										clearHTML1 += '<td id="is_active" class="is_active" ><span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right" ></i> Active </span></td>';
									}
									
								}
								if(item.is_active == 0){
									clearHTML1 += '<td id="is_active" class="is_active" ><span class="badge badge-danger-light"> <i class="mdi mdi-arrow-bottom-right" ></i> Inactive </span> </td>';
								}
								clearHTML1 += '<td id="is_active_value" class="is_active_value">'+item.is_active+'</td>';
								clearHTML1 += '<td class="table-action">';
								if(item.emp_user_sub_grp == 0){
									clearHTML1 += '<a class="editLine" id="editLine" href="#" style="margin: 10px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
								} 
								else{
									clearHTML1 += '<a class="editLine" id="editLine" href="#" style="margin: 10px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>';
								}
								
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
							table.column(2).visible(false);
							table.column(3).visible(false);
							table.column(5).visible(false);
							table.column(6).visible(false);							
							table.column(7).visible(false);
							table.column(8).visible(false);
							table.column(9).visible(false);
							table.column(10).visible(false);
							table.column(11).visible(false);
							table.column(13).visible(false);
							//get data table row id click event
							$("#example tbody").on("click",'tr', function() {
								//$(this).on("click",'tr', function(){
									
									var data = table.row(this).data();
									//console.log(data);
									var emp_id = data[0];
									var emp_epf = data[1];
									var emp_user_grp = data[2];									
									var emp_user_sub_grp = data[3];
									var emp_name = data[4];
									var emp_email = data[5];
									var emp_password = data[6];
									var emp_company = data[7];									
									var emp_function = data[8];
									var emp_location = data[9];
									var emp_plant = data[10];
									var emp_mobile = data[11];
									var is_active = data[13];
									var checked = "";
									//console.log(emp_user_sub_grp);
									if(is_active == 1){
										checked = 'checked';
									}
									
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
											if(emp_user_grp == item1.grp_id){
												clearHTML2 += '<option value="'+item1.grp_id+'" selected>'+ item1.grp_name+ '</option>';	
											}
											else{
												clearHTML2 += '<option value="'+item1.grp_id+'">'+ item1.grp_name+ '</option>';
											}
										});
										
										if(emp_user_grp == 0){
											$('#emp_user_grp_edit').append(clearHTML2);
											$('#emp_user_grp_edit').addClass('is-invalid')
										}
										else{
											$('#emp_user_grp_edit').append(clearHTML3);
										}
										
										
										
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
											
											if(emp_user_sub_grp == item2.sub_group_id){
												clearHTML3 += '<option value="'+item2.sub_group_id+'" selected>'+item2.sub_group_name+ ' - '+ item2.sub_group_name+ '</option>';	
											}
											else{
												clearHTML3 += '<option value="'+item2.sub_group_id+'">'+ item2.sub_group_name+ ' - '+ item2.sub_group_name+ '</option>';
											}
											
										});
										
										if(emp_user_sub_grp == 0){
											$('#emp_user_sub_grp_edit').append(clearHTML3);
											$('#emp_user_sub_grp_edit').addClass('is-invalid')
										}
										else{
											$('#emp_user_sub_grp_edit').append(clearHTML3);
										}
										
										
										
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
											//item.WA.substring(3, 7);
											//console.log(item3.cost_id);
											if(emp_company == item3.company_id){
												clearHTML4 += '<option value="'+item3.company_id+'" selected>'+item3.company_code+ ' - '+ item3.company_name+ '</option>';	
											}
											else{
												clearHTML4 += '<option value="'+item3.company_id+'">'+ item3.company_code+ ' - '+ item3.company_name+ '</option>';
											}
											
										});
										
										$('#emp_company_edit').append(clearHTML4);
										
										
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
											//item.WA.substring(3, 7);
											//console.log(item4.cost_id);
											if(emp_function == item4.func_id){
												clearHTML5 += '<option value="'+item4.func_id+'" selected>'+item4.func_name+'</option>';	
											}
											else{
												clearHTML5 += '<option value="'+item4.func_id+'">'+ item4.func_name+'</option>';
											}
											
										});
										
										
										if(emp_function == 0){
											$('#emp_function_edit').append(clearHTML5);
											$('#emp_function_edit').addClass('is-invalid')
										}
										else{
											$('#emp_function_edit').append(clearHTML5);
										}
										
										
										
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
											//item.WA.substring(3, 7);
											//console.log(item5.cost_id);
											if(emp_location == item5.loc_id){
												clearHTML6 += '<option value="'+item5.loc_id+'" selected>'+ item5.loc_name+ '</option>';	
											}
											else{
												clearHTML6 += '<option value="'+item5.loc_id+'">'+ item5.loc_name+ '</option>';
											}
											
										});
										
										if(emp_location == 0){
											$('#emp_location_edit').append(clearHTML6);
											$('#emp_location_edit').addClass('is-invalid')
										}
										else{
											$('#emp_location_edit').append(clearHTML6);
										}
										
										
										
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
											//item.WA.substring(3, 7);
											//console.log(item6.cost_id);
											if(emp_plant == item6.plant_id){
												clearHTML7 += '<option value="'+item6.plant_id+'" selected>'+item6.plant_name+'</option>';	
											}
											else{
												clearHTML7 += '<option value="'+item6.plant_id+'">'+ item6.plant_name+'</option>';
											}
											
										});
										
										if(emp_plant == 0){
											$('#emp_plant_edit').append(clearHTML7);
											$('#emp_plant_edit').addClass('is-invalid')
										}
										else{
											$('#emp_plant_edit').append(clearHTML7);
										}
										
										
										
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
												  '<div class="modal-dialog modal-lg">'+
													'<div class="modal-content">'+
													  '<div class="modal-header">'+
														'<h5 class="modal-title" id="staticBackdropLabel">Edit User Details</h5>'+
														'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
													  '</div>'+
													  '<div class="modal-body">'+
														'<div class="row">'+
															'<div class="col-12 col-lg-6">'+
																'<input type="hidden" class="form-control" id="emp_id_edit" name="emp_id_edit" value="'+emp_id+'">'+
																'<input type="hidden" class="form-control" id="is_active_value_edit" name="is_active_value_edit" value="'+is_active+'">'+
																'<div class="">'+
																	'<label class="form-label">EPF</label>'+
																	'<input type="text" class="form-control" id="emp_epf_edit" name="emp_epf_edit" value="'+emp_epf+'">'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Name</label>'+
																	'<input type="text" class="form-control" id="emp_name_edit" name="emp_name_edit" value="'+emp_name+'">'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Email</label>'+
																	'<input type="text" class="form-control" id="emp_email_edit" name="emp_email_edit" value="'+emp_email+'">'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Mobile</label>'+
																	'<input type="text" class="form-control" id="emp_mobile_edit" name="emp_mobile_edit" value="'+emp_mobile+'">'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Password</label>'+
																	'<input type="password" class="form-control" id="emp_password_edit" name="emp_password_edit" value="'+emp_password+'">'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Re-Password</label>'+
																	'<input type="password" class="form-control" id="emp_password_re_edit" name="emp_password_re_edit" value="'+emp_password+'">'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
															'</div>'+	
															'<div class="col-12 col-lg-6">'+															
																'<div class="">'+
																	'<label class="form-label">User Group</label>'+
																	'<select class="form-control" name="emp_user_grp_edit"  id="emp_user_grp_edit">'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">User Sub Group</label>'+
																	'<select class="form-control" name="emp_user_sub_grp_edit"  id="emp_user_sub_grp_edit">'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Company</label>'+
																	'<select class="form-control" name="emp_company_edit"  id="emp_company_edit">'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Function</label>'+
																	'<select class="form-control" name="emp_function_edit"  id="emp_function_edit">'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Location</label>'+
																	'<select class="form-control" name="emp_location_edit"  id="emp_location_edit">'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Plant</label>'+
																	'<select class="form-control" name="emp_plant_edit"  id="emp_plant_edit">'+
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
															'<button class="btn btn-lg btn-primary" type="button" id="userEditBtn">Save</button>'+
														'</div>'+
													  '</div>'+
													'</div>'+
												  '</div>'+
												'</div>';
									}
									else{
										modal = '<div class="modal fade" id="Mymodal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'+
												  '<div class="modal-dialog modal-lg">'+
													'<div class="modal-content">'+
													  '<div class="modal-header">'+
														'<h5 class="modal-title" id="staticBackdropLabel">Edit User Details</h5>'+
														'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
													  '</div>'+
													  '<div class="modal-body">'+
														'<div class="row">'+
															'<div class="col-12 col-lg-6">'+
																'<input type="hidden" class="form-control" id="emp_id_edit" name="emp_id_edit" value="'+emp_id+'">'+
																'<input type="hidden" class="form-control" id="is_active_value_edit" name="is_active_value_edit" value="'+is_active+'">'+
																'<div class="">'+
																	'<label class="form-label">EPF</label>'+
																	'<input type="text" class="form-control" id="emp_epf_edit" name="emp_epf_edit" value="'+emp_epf+'" disabled>'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Name</label>'+
																	'<input type="text" class="form-control" id="emp_name_edit" name="emp_name_edit" value="'+emp_name+'" disabled>'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Email</label>'+
																	'<input type="text" class="form-control" id="emp_email_edit" name="emp_email_edit" value="'+emp_email+'" disabled>'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Mobile</label>'+
																	'<input type="text" class="form-control" id="emp_mobile_edit" name="emp_mobile_edit" value="'+emp_mobile+'" disabled>'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Password</label>'+
																	'<input type="password" class="form-control" id="emp_password_edit" name="emp_password_edit" value="'+emp_password+'" disabled>'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Re-Password</label>'+
																	'<input type="password" class="form-control" id="emp_password_re_edit" name="emp_password_re_edit" value="'+emp_password+'" disabled>'+
																	'<span style="color:red;position:absolute;font-size: 12px" class="error_comp_name"></span>'+
																'</div>'+
															'</div>'+	
															'<div class="col-12 col-lg-6">'+															
																'<div class="">'+
																	'<label class="form-label">User Group</label>'+
																	'<select class="form-control" name="emp_user_grp_edit"  id="emp_user_grp_edit" disabled>'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">User Sub Group</label>'+
																	'<select class="form-control" name="emp_user_sub_grp_edit"  id="emp_user_sub_grp_edit" disabled>'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Company</label>'+
																	'<select class="form-control" name="emp_company_edit"  id="emp_company_edit" disabled>'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Function</label>'+
																	'<select class="form-control" name="emp_function_edit"  id="emp_function_edit" disabled>'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Location</label>'+
																	'<select class="form-control" name="emp_location_edit"  id="emp_location_edit" disabled>'+
																	'</select>'+
																'</div>'+
																'<div class="">'+
																	'<label class="form-label">Plant</label>'+
																	'<select class="form-control" name="emp_plant_edit"  id="emp_plant_edit" disabled>'+
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
								
								$(document).on("click", "#userEditBtn", function(event){			 
								//e.preventDefault();
								
								//$("#loader").css('display', 'block');
							
								var is_active = ($('#is_active_edit').prop("checked")) ? (1) : (0);	
								
								var emp_id = $("#emp_id_edit").val();
								var emp_epf  = $("#emp_epf_edit").val();
								var emp_user_grp  = $("#emp_user_grp_edit").val();
								var emp_user_sub_grp  = $("#emp_user_sub_grp_edit").val();
								var emp_name  = $("#emp_name_edit").val();
								var emp_email  = $("#emp_email_edit").val();
								var emp_password  = $("#emp_password_edit").val();
								var emp_password_re  = $("#emp_password_re_edit").val();
								var emp_company  = $("#emp_company_edit").val();
								var emp_function  = $("#emp_function_edit").val();
								var emp_location  = $("#emp_location_edit").val();
								var emp_plant  = $("#emp_plant_edit").val();
								var emp_mobile  = $("#emp_mobile_edit").val();
								
								//console.log(emp_password_re);
								
								if(typeof emp_epf !== 'undefined' && emp_epf !== '' && typeof emp_id !== 'undefined' && emp_id !== ''
								&& typeof emp_user_grp !== 'undefined' && emp_user_grp !== '' && typeof emp_user_sub_grp !== 'undefined' && emp_user_sub_grp !== ''
								&& typeof emp_name !== 'undefined' && emp_name !== '' && typeof emp_email !== 'undefined' && emp_email !== ''
								&& typeof emp_password !== 'undefined' && emp_password !== '' && typeof emp_password_re !== 'undefined' && emp_password_re !== '' 
								&& typeof emp_company !== 'undefined' && emp_company !== '' && typeof emp_function !== 'undefined' && emp_function !== '' 
								&& typeof emp_location !== 'undefined' && emp_location !== '' && typeof emp_plant !== 'undefined' && emp_plant !== '' 
								&& typeof emp_mobile !== 'undefined' && emp_mobile !== '' && typeof is_active !== 'undefined' && is_active !== ''){
								
									var plantDetails = JSON.stringify({
										"emp_id": emp_id,
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
									$form = $('#update_user_form');
									update_user_form($form);
									
									function update_user_form($form) {
										var formdata = new FormData($form[0]);
										formdata.append('form_name', 'update_user_form');
										$.ajax({
											type: 'PUT',
											dataType: 'json',
											contentType: 'application/json',
											url: 'https://localhost:44371/api/users/'+emp_id,
											data: plantDetails,
											cache: false,
											processData: false,
											crossDomain: true,
											success: function (data) {
											//console.log(data);
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