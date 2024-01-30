			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Edit User Permission</h1>
					
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-12 col-lg-6">
											<div class="mb-3">
												<label class="form-label">Employee Name</label>
												<input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" inputmode="numeric">
											</div>											
											<div class="mb-3">
												<label class="form-label">Location</label>
												<input type="text" class="form-control" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': '€ ', 'placeholder': '0'" inputmode="decimal" style="text-align: right;">
											</div>
											<div class="mb-3">
												<label class="form-label">Plant</label>
												<input type="text" class="form-control" data-inputmask="'alias': 'numeric', 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" inputmode="decimal" style="text-align: right;">
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div class="mb-3">
												<label class="form-label">Employee EPF</label>
												<input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" inputmode="numeric">
											</div>
											<div class="mb-3">
												<label class="form-label">Company</label>
												<input type="text" class="form-control" data-inputmask-mask="[9-]AAA-999" inputmode="text">
											</div>
											<div class="mb-3">
												<label class="form-label">Function</label>
												<input type="text" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ','" inputmode="decimal" style="text-align: right;">
											</div>											
										</div>
										<div class="text-center mt-3">
											<a href="index.html" class="btn btn-lg btn-primary">Save</a>
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
			//call api GET api/Employees
			$('#loadBtn').click( function(){
				//e.preventDefault();
				var emp_epf = '';
				emp_epf = $('#emp_epf').val();
				
				var emp_epf_len = emp_epf.length;
				if(emp_epf_len==5){
					emp_epf = '001'+emp_epf;
				}
				else if(emp_epf_len==4){
					emp_epf = '0010'+emp_epf;
				}
				
				//console.log(emp_epf);
				
				//epf wise call
				if(emp_epf){
					$.ajax({ 
					type: "GET",
					cache : false,
					cache: false,
					async: true,
					dataType: "json",
					data: {id:emp_epf},
					url: "https://localhost:44371/api/Employees/",
					success: function(data, response){        
						//console.log(data); 
						
						if(data.message == "Invalid EPF")
						{	
							const notyf = new Notyf();
							notyf.error({
							  message: 'Invalid EPF!',
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
						else{
							$('#result_display').empty();
							var clearHTML = '<div class="card"><div class="card-body"><div class="table-responsive"><table id="result_table" class="table table-striped table-bordered " style="" ><thead><tr><th>EPF</th><th>Name</th><th>Location</th><th>Cost Center</th></tr></thead><tbody>';
							
							
								clearHTML += '<tr>' +
									'<td>' + data.PERNR + '</td>' +
									'<td>' + data.ENAME + '</td>' +
									'<td>' + data.WERKS + '</td>' +
									'<td>' + data.KOSTL + '</td>' +								
									'</tr>';
							
							
							clearHTML += '</tbody></table></div></div></div>';
							$('#result_display').append(clearHTML);
							$(document).ready(function() { 
								var table = $("#result_table").DataTable( 
								{	
									lengthChange: false, 
									responsive: true, 
									scrollY:  200, 
									fixedHeader: false, 
									bAutoWidth: true, 
									buttons: 
										[  
											{
												extend: 'excelHtml5',
												title: 'Active Employee List [ZZH_ACT_EMP_LIST]'
											}
										]
								} );
								
								table.buttons().container().appendTo( "#result_table_wrapper .col-md-6:eq(0)" );} );
							//$('#result_display').append(trHTML);
						}
						
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						//alert("some error");
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
						
					}
					
				});
				}
				//all data call
				else{
					$.ajax({ 
					type: "GET",
					cache : false,
					cache: false,
					async: true,
					dataType: "json",
					//data: {id:emp_epf},
					url: "https://localhost:44371/api/Employees/",
					success: function(data, response){        
						//console.log(data); 
						
						
						$('#result_display').empty();
						var clearHTML = '<div class="card"><div class="card-body"><div class="table-responsive"><table id="result_table" class="table table-striped table-bordered " style="" ><thead><tr><th>EPF</th><th>Name</th><th>Location</th><th>Cost Center</th></tr></thead><tbody>';
						
						
						$.each(data, function (i, item) {
							clearHTML += '<tr>' +
								'<td>' + item.PERNR + '</td>' +
								'<td>' + item.ENAME + '</td>' +
								'<td>' + item.WERKS + '</td>' +
								'<td>' + item.KOSTL + '</td>' +								
								'</tr>';
								
								
						});
						
						
						clearHTML += '</tbody></table></div></div></div>';
						$('#result_display').append(clearHTML);
						$(document).ready(function() { 
							var table = $("#result_table").DataTable( 
							{	
								lengthChange: false, 
								responsive: true, 
								scrollY:  200, 
								fixedHeader: false, 
								bAutoWidth: true, 
								buttons: 
									[  
										{
											extend: 'excelHtml5',
											title: 'Active Employee List [ZZH_ACT_EMP_LIST]'
										}
									]
							} );
							
							table.buttons().container().appendTo( "#result_table_wrapper .col-md-6:eq(0)" );} );
						//$('#result_display').append(trHTML);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						//alert("some error");
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
						
					}
					
				});
				}
				
			});
				
			
			document.addEventListener("DOMContentLoaded", function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.querySelectorAll('.needs-validation')
				// Loop over them and prevent submission
				Array.prototype.slice.call(forms)
					.forEach(function(form) {
						form.addEventListener('submit', function(event) {
							if (!form.checkValidity()) {
								event.preventDefault()
								event.stopPropagation()
							}
							form.classList.add('was-validated')
						}, false)
					})
			});
			
				
			</script>