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

					<h1 class="h3 mb-3">Create User Permission</h1>
					
					<div class="row">
						<div class="col-12">
							
							<div class="col-lg-3">
												
								<div class="mb-3">
									<label class="form-label">User Sub Group</label>
									<select class="form-control" name="sub_group_id"  id="sub_group_id">
									</select>
								</div>
								
							</div>
							<div id='full_div'>
								<div id='result_display'>
									
								</div>
								
								<div class="text-center mt-3 " style="display:none" id="permissionBtnDiv">
									<button class="btn btn-lg btn-primary" type="button" id="permissionBtn">Save</button>
									<!-- <button type="submit" class="btn btn-lg btn-primary">Sign up</button> -->
								</div>
							</div>
										
										
									
						</div>						
						</div>
							
						</div>
						
					</div>

				</div>
			</main>
			
			<script>
			$("#loader").css('display', 'block');
			$(document).ready(function() {
					
				var urls = [];
			//create plant filter
				var clearHTML2 ="";
				clearHTML2 += '<option value=""> Select User Sub group</option>';
				
				$.ajax({
				type: "GET",
				cache : false,
				async: true,
				dataType: "json",
				contentType: 'application/json',
				//data: {},
				url: "https://localhost:44371/api/user_sub_groups/get_active_list/",
				success: function(data, result){					
					//console.log(data);
					$("#loader").css('display', 'none');	
					$.each(data, function (i, item) {
						
						clearHTML2 += '<option value="'+item.sub_group_id+'">'+ item.sub_group_name+ '</option>';	

					});
					
					clearHTML2 += '</tbody>'+
									'</table>';
					
					$('#sub_group_id').append(clearHTML2);
					
					//get tcod active list
					$( "#sub_group_id" ).change(function() {
						
					var sub_id = subGrpId = $("#sub_group_id option:selected").val();
					
					
					$.ajax({
					type: "GET",
					cache : false,
					async: true,
					dataType: "json",
					contentType: 'application/json',
					crossDomain: true,
					data: {sub_id:sub_id},
					url: "https://localhost:44371/api/user_permissions/activeListByGrpIdPermUpdate/",
					success: function(data, result){					
						//console.log(data);
						var checked = "";
						var clearHTML3 ="";
						clearHTML3 += '<div class="card">'+
									'<!--div class="card-header">'+
										'<button class="btn btn-success" id="selectAllBtn" style="margin:1px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">'+
										  '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>'+
										'</svg> check/ uncheck all</button>'
										+
									'</div-->'+
								'<div class="card-body">'+
										'<table id="example" class="table" style="width:100%">'+
											'<thead>'+
												'<tr>'+
													'<th style="">URL ID</th>'+
													'<th style="">Menu Name</th>'+
													'<th style="">URL Type</th>'+
													'<th style="">URL Value</th>'+
													'<th>is_active</th>'+
													'<th>is_view</th>'+
													'<th>is_edit</th>'+													
												'</tr>'+
											'</thead>'+
											'<tbody>';
						$.each(data, function (i, item3) {
							
							if(item3.is_active == 1){
								checked1 = 'checked';
							}
							else{
								checked1 = '';
							}
							if(item3.is_view == 1){
								checked2 = 'checked';
							}
							else{
								checked2 = '';
							}
							if(item3.is_edit == 1){
								checked3 = 'checked';
							}
							else{
								checked3 = '';
							}
							//item.WA.substring(3, 7);	
							urls.push(item3.url_id);
							clearHTML3 += '<tr class="raw">';
							clearHTML3 += '<td class="url_id">'+item3.url_id+'</td>';
							clearHTML3 += '<td class="url_id">'+item3.menu_name+'</td>';
							clearHTML3 += '<input type="hidden" class="url_type_id" value="'+item3.url_type+'">';
							clearHTML3 += '<input type="hidden" class="perm_id" value="'+item3.perm_id+'">';
							clearHTML3 += '<td >'+item3.url_type_name+'</td>';
							clearHTML3 += '<td>'+item3.url_value+'</td>';
							clearHTML3 += '<td class="table-action"><label class="form-check">'+										
												'<input class="form-check-input is_active perm_check '+item3.is_active+'" type="checkbox" value="1" id="is_active" name="is_active" '+checked1+'>'+									
											'</label></td>';
							clearHTML3 += '<td class="table-action"><label class="form-check">'+										
												'<input class="form-check-input is_view perm_check '+item3.is_view+'" type="checkbox" value="1" id="is_view" name="is_view" '+checked2+'>'+									
											'</label></td>';				
							clearHTML3 += '<td class="table-action"><label class="form-check">'+										
												'<input class="form-check-input is_edit perm_check '+item3.is_edit+'" type="checkbox" value="1" id="is_edit" name="is_edit" '+checked3+'>'+									
											'</label></td>';
							clearHTML3 += '';
							clearHTML3 += '</tr>';
						});
						
						clearHTML3 += '</tbody>'+
											'</table>'+
											'</div>';
						$(document).ready(function() {
							$('#example').DataTable( {
								"scrollY": 200,
								"scrollX": true,
								"pageLength": 150
								//"filter": true,
								//"searching": true
							} );
						} );	
							
						$('#result_display').html("");
						$('#result_display').append(clearHTML3);
						$('#permissionBtnDiv').css('display','block');
						
						//select all permission btn
						$('#selectAllBtn').click(function(){
							
							$(".perm_check").each(function(){
								$(this).prop('checked', false);	
								if(!$(this).prop('checked') == true){
									$(this).prop('checked', true);								
								}
								else{
									$(this).prop('checked', false);	
								}
							});								
						});
						
						var foundPresent;
					
						var subGrp = "";
						var subGrpId = "";
						subGrp = $("#sub_group_id option:selected").text();
						subGrpId = $("#sub_group_id option:selected").val();
						
						
						
						
						$('#permissionBtn').click(function(){
							
							$form = $('#delete_user_permission_form');
							//delete_user_permission_form($form);
							
							
							//get newly changed user permissions							
							var arrUrl = [];
							var i = 0;
							
							
							   $('.raw').each(function () {
								   
								    var is_active = (typeof($(this).find('.is_active:checked').val()) == 'undefined')?0:1 ;
									var is_view = (typeof($(this).find('.is_view:checked').val()) == 'undefined')?0:1 ;
									var is_edit = (typeof($(this).find('.is_edit:checked').val()) == 'undefined')?0:1 ;
									var url_id = $(this).find('.url_id').text();
									var url_type_id = $(this).find('.url_type_id').val();
									var perm_id = $(this).find('.perm_id').val();
																		
									arrUrl[i++] = ({"perm_id": perm_id, "user_sub_grp_id": subGrpId, "url_id": url_id, "url_type_id": url_type_id,  "is_active": is_active, "is_view": is_view,"is_edit": is_edit});
							   })
							
							var jsonString = JSON.stringify(arrUrl);							
							/* var permDetails = JSON.stringify({
								"perm_id": arrTcode	
							}); */
							
							update_user_permission_form($form);
														
							//delete user permission
							function update_user_permission_form($form) {
								var formdata = new FormData($form[0]);
								formdata.append('form_name', 'update_user_permission_form');
								
								$.ajax({
									type: 'PUT',
									dataType: 'json',
									contentType: 'application/json',
									url: 'https://localhost:44371/api/user_permissions/updatePermission/',									
									cache: false,
									data: jsonString,
									processData: false,
									success: function (data) {
										//console.log(jsonString);						

										if (data.message == "Successful") {
											
											$("#loader").css('display', 'none');
											

											const notyf = new Notyf();
													notyf.success({
													message: 'User Permission updated!',
													duration: 1000,
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
											/* window.setTimeout(function() {
												window.location.href = "http://localhost/saprfc/user/";	
											}, 2000); */
											
											
												
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
							
							
							//save user permission
							function create_user_permission_form($form) {
								var formdata = new FormData($form[0]);
								formdata.append('form_name', 'create_user_permission_form');
								
								$.ajax({
									type: 'POST',
									dataType: 'json',
									contentType: 'application/json',
									url: 'https://localhost:44371/api/user_permissions/createPermByGrpId',
									data: jsonString,
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
													message: 'User Permission created!',
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
											/* window.setTimeout(function() {
												window.location.href = "http://localhost/saprfc/user/";	
											}, 2000); */
											
											
												
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
												
															
						});
						
						
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
				
								
				
			
			} );	
			</script>