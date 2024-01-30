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

					<h1 class="h3 mb-3">Fire & Safety Report</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">								
								<div class="card-body">
									<div class="col-12">
										<div class="card-body">
											<form>	
												<div class="row">
													<div class="mb-3 col-md-4 hide" id="paChnageTextDiv">
														<label class="form-label" for="inputPassword4">Personnel Area</label>
														<svg id="paChnageText" style="cursor: hand;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard align-middle me-2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
														<textarea class="form-control rounded-0" id="pAreaList" rows="3"></textarea>
													</div>
													<!--div class="mb-3 col-md-6" id="paChnageSelectDiv" >
														<label class="form-label" for="inputEmail4">Personnel Area</label>														
														<svg id="paChnageSelect" style="cursor: hand;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard align-middle me-2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
														<select class="form-control mb-3" id="pAreaSelection">
														</select>
													</div-->												
													
													<div class="mb-3 col-md-4" id="paChnageSelectDiv" >
														<label class="form-label" for="inputEmail4">Personnel Area</label>	
														<select class="form-control mb-3 js-example-basic-multiple" name="pAreaSelection[]" multiple="multiple" id="pAreaSelection">
														</select>
													</div>
													
													<div class="mb-3 col-md-4 hide" id="psaChnageTextDiv">
														<label class="form-label" for="inputPassword4">Personnel Sub Area</label>
														<svg id="psaChnageText" style="cursor: hand;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard align-middle me-2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
														<textarea class="form-control rounded-0" id="pSubAreaList" rows="3"></textarea>
													</div>
													<!--div class="mb-3 col-md-6" id="psaChnageSelectDiv" >
														<label class="form-label" for="inputEmail4">Personnel Sub Area</label>														
														<svg id="psaChnageSelect" style="cursor: hand;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard align-middle me-2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
														<select class="form-control mb-3" id="pSAreaSelection">														
														</select>
													</div-->
													<div class="mb-3 col-md-4" id="psaChnageSelectDiv" >
														<label class="form-label" for="inputEmail4">Personnel Sub Area</label>	
														<select class="form-control mb-3 js-example-basic-multiple" name="pSAreaSelection[]" multiple="multiple" id="pSAreaSelection">
														</select>
													</div>
												
													<!--div class="mb-3 col-md-6 hide" id="gChnageTextDiv">
														<label class="form-label" for="inputEmail4">Grade</label>
														<svg id="gChnageText" style="cursor: hand;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard align-middle me-2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
														<textarea class="form-control rounded-0" id="pGradeList" rows="3"></textarea>
													</div>
													<div class="mb-3 col-md-6" id="gChnageSelectDiv" >
														<label class="form-label" for="inputEmail4">Grade</label>														
														<svg id="gChnageSelect" style="cursor: hand;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard align-middle me-2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
														<select class="form-control mb-3" id="gSelection">
															<option selected="">Open this select menu</option>
															<option>One</option>
															<option>Two</option>
															<option>Three</option>
														</select>
													</div-->
													<div class="mb-3 col-md-4 hide" id="pnChnageTextDiv">
														<label class="form-label" for="inputEmail4">Personnel Number</label>														
														<svg id="pnChnageText" style="cursor: hand;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard align-middle me-2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
														<textarea class="form-control rounded-0" id="epfList" rows="3"></textarea>
													</div>
													<!--div class="mb-3 col-md-6 " id="pnChnageSelectDiv">
														<label class="form-label" for="inputEmail4">Personnel Number</label>														
														<svg id="pnChnageSelect" style="cursor: hand;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard align-middle me-2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
														<select class="form-control mb-3" id="pNSelection">
														</select>
													</div-->
													<div class="mb-3 col-md-4" id="psaChnageSelectDiv" >
														<label class="form-label" for="inputEmail4">Personnel Number</label>	
														<select class="form-control mb-3 js-example-basic-multiple" name="pNSelection[]" multiple="multiple" id="pNSelection">
														</select>
													</div>	
												</div>	
												<!--div class="row">
													<div class="mb-3 col-md-6 hide" id="ccChnageTextDiv">
														<label class="form-label" for="inputEmail4">Cost Center</label>
														<svg id="ccChnageText" style="cursor: hand;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard align-middle me-2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
														<textarea class="form-control rounded-0" id="cCenterList" rows="3"></textarea>
													</div>
													<div class="mb-3 col-md-6" id="ccChnageSelectDiv" >
														<label class="form-label" for="inputEmail4">Cost Center</label>														
														<svg id="ccChnageSelect" style="cursor: hand;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard align-middle me-2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
														<select class="form-control mb-3">
															<option selected="">Open this select menu</option>
															<option>One</option>
															<option>Two</option>
															<option>Three</option>
														</select>
													</div>
													<div class="mb-3 col-md-6">
														<label class="form-label" for="inputPassword4">Action Type</label>
														<textarea class="form-control rounded-0" id="aTypeList" rows="3"></textarea>
													</div>
												</div-->
												<div class="row">
													<label class="form-label" for="inputEmail4">Period</label>
													<div class="mb-3 col-md-2">
														<input name="period" id="today" type="radio" class="form-check-input" value="T" checked>
														<span class="form-check-label">Up to Today</span>
													</div>
													<div class="mb-3 col-md-2">
														<input name="period" id="cMonth" type="radio" class="form-check-input" value="M">
														<span class="form-check-label">Current Month</span>
													</div>
													<div class="mb-3 col-md-2">
														<input name="period" id="cYear" type="radio" class="form-check-input" value="Y">
														<span class="form-check-label">Current Year</span>
													</div>
												</div>
												<div class="row">													
													<div class="mb-3 col-md-2">
														<input name="period" id="oPeriod" type="radio" class="form-check-input" value="O">
														<span class="form-check-label">Other Period</span>
													</div>
													<div class="mb-3 col-md-2">
														<input type="text" class="form-control" id="fromdate" name="fromdate" placeholder="from date" disabled autocomplete="off">
													</div>
													<div class="mb-3 col-md-2">
														<input type="text" class="form-control" id="todate" name="todate" placeholder="to date" disabled autocomplete="off">
													</div>													
												</div>
												<div class="row">													
													<div class="ms-sm-auto">
														<button type="submit" id="loadBtn" class="btn btn-primary" >Submit</button>
													</div>
												</div>
											</form>
										</div>
										<div id='result_display' >
								
										</div>
									</div>									
								</div>							
							</div>
						</div>
						
					</div>

				</div>
			</main>
			
			<script>
					
			
			//$("#loader").css('display', 'block');
			//set personnel area on page load
			$(document).ready(function(){
				
				//collect user values from dropdowns
			
				var companyList = [];
				var pAreaList = [];
				var pSubAreaList = [];
				var epfList = [];			
				//var pSubAreaList = "all";
				//var pAreaList = "all";
				//var companyList = "all";
				//epfList = "all";
				var pAreaVal = "all";
				var pSAreaVal = "all";
				var pNVal = "all";
				companyList.push(3000);//"all"
				pAreaList.push("all");
				pSubAreaList.push("all");
				epfList.push("all");
				var dPeriod = "";
				var fromdate = "";
				var todate = "";			
				var companyArr = [];			
				var pAreaArr = [];
				var pSubAreaArr = [];
				var epfArr = [];
				
				
				//function remove duplicates in array
				function uniqueArray(arr) {
					var a = [];
					for (var i=0, l=arr.length; i<l; i++)
						if (a.indexOf(arr[i]) === -1 && arr[i] !== '' && arr[i] !== null)
							a.push(arr[i]);
									
					return a;
				}
				
				$('.js-example-basic-multiple').select2();
			  //$("button").click(function(){
				var clearHTML1 = '<option value="all" selected="">All</option>';
				var clearHTML2 = '<option value="all" selected="">All</option>';
				$.ajax({
				type: "GET",
				cache : false,
				async: true,
				dataType: "json",
				data: {company :companyList,
				pArea :pAreaList,
				pSubArea :pSubAreaList},
				url: "https://localhost:44371/api/Employees/",
				success: function(data, result){					
					//console.log(data);
					//--------------P Area --------------------//
					$.each(data, function (i, item) {
						pAreaArr.push(item.WA.substring(3, 7));						
					});
					pAreaArr = uniqueArray(pAreaArr);
					
					$.each(pAreaArr, function (i, item) {
						clearHTML1 += '<option value="'+item+'">'+ item+ '</option>';				
					});
					
					//--------------P Sub Area --------------------//
					$.each(data, function (i, item) {
						pSubAreaArr.push(item.WA.substring(7, 11));						
					});
					pSubAreaArr = uniqueArray(pSubAreaArr);
					
					$.each(pSubAreaArr, function (i, item) {
						clearHTML2 += '<option value="'+item+'">'+ item+ '</option>';
					});
					
					$('#pAreaSelection').append(clearHTML1);
					$('#pSAreaSelection').append(clearHTML2);
					
					get_epf_numbers();
					
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
				
				
				
			  //});
			
			
			

			//set personnel sub area on personnel area on change
			/* function get_sub_pArea(pArea){
				var clearHTML2 = '';//<option value="" selected="">Select Personnel Sub Area</option>
				$.ajax({
				type: "GET",
				cache : false,
				async: true,
				dataType: "json",
				data: {company :companyList, pArea :pArea},
				url: "https://localhost:44371/api/Employees/",
				success: function(data, result){					
					console.log(data);
					$.each(data, function (i, item) {
						
						clearHTML2 += '<option value="'+ item.WA.substring(0, 3) +'">'+ item.WA.substring(4, 30)+ '</option>';								
							
					});
					
					$('#pSAreaSelection').append(clearHTML2);	
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
			} */	
			
			//set personnel numbers
			function get_epf_numbers(){
				$("#loader").css('display', 'block');
				var clearHTML3 = '<option value="all" selected="">All</option>';
				$.ajax({
				type: "GET",
				cache : false,
				async: true,
				dataType: "json",
				//data: {company :companyList, pArea :pArea},
				url: "https://localhost:44371/api/Employees/",
				success: function(data, result){					
					//console.log(data);
					
					$.each(data, function (i, item) {						
						clearHTML3 += '<option value="'+ item.PERNR +'">'+ item.PERNR + '</option>';								
							
					});
					
					$('#pNSelection').append(clearHTML3);
					$("#loader").css('display', 'none');
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
			
			//enable/disable date feild on other period select				
			$("input:radio").change(function () {
				if ($("#oPeriod").is(":checked")) {
					$('#fromdate').removeAttr('disabled', 'disabled');
					$('#todate').removeAttr('disabled', 'disabled');
				}
				else {
					$('#fromdate').attr('disabled', 'disabled');
					$('#todate').attr('disabled', 'disabled');
					$('#fromdate').val('');
					$('#todate').val('');
				}
			});
			
			//toggle input fields
			//personnel Number
			$('#pnChnageText').click( function(){
				if (!$("#pnChnageTextDiv").hasClass("hide")) {
					$("#pnChnageTextDiv").addClass( "hide" );
					$('#pnChnageSelectDiv').removeClass( "hide" );
				}								
			});
			
			$('#pnChnageSelect').click( function(){
				if (!$('#pnChnageSelectDiv').hasClass("hide")) {
					$("#pnChnageSelectDiv").addClass( "hide" );
					$('#pnChnageTextDiv').removeClass( "hide" );
				}
			});
			
			//personnel Number
			$('#paChnageText').click( function(){
				if (!$("#paChnageTextDiv").hasClass("hide")) {
					$("#paChnageTextDiv").addClass( "hide" );
					$('#paChnageSelectDiv').removeClass( "hide" );
				}								
			});			
			$('#paChnageSelect').click( function(){
				if (!$('#paChnageSelectDiv').hasClass("hide")) {
					$("#paChnageSelectDiv").addClass( "hide" );
					$('#paChnageTextDiv').removeClass( "hide" );
				}
			});
			
			//personnel Area
			$('#paChnageText').click( function(){
				if (!$("#paChnageTextDiv").hasClass("hide")) {
					$("#paChnageTextDiv").addClass( "hide" );
					$('#paChnageSelectDiv').removeClass( "hide" );
				}								
			});			
			$('#paChnageSelect').click( function(){
				if (!$('#paChnageSelectDiv').hasClass("hide")) {
					$("#paChnageSelectDiv").addClass( "hide" );
					$('#paChnageTextDiv').removeClass( "hide" );
				}
			});
			
			//personnel Sub Area
			$('#psaChnageText').click( function(){
				if (!$("#psaChnageTextDiv").hasClass("hide")) {
					$("#psaChnageTextDiv").addClass( "hide" );
					$('#psaChnageSelectDiv').removeClass( "hide" );
				}								
			});			
			$('#psaChnageSelect').click( function(){
				if (!$('#psaChnageSelectDiv').hasClass("hide")) {
					$("#psaChnageSelectDiv").addClass( "hide" );
					$('#psaChnageTextDiv').removeClass( "hide" );
				}
			});
			
			//personnel Grade
			$('#gChnageText').click( function(){
				if (!$("#gChnageTextDiv").hasClass("hide")) {
					$("#gChnageTextDiv").addClass( "hide" );
					$('#gChnageSelectDiv').removeClass( "hide" );
				}								
			});			
			$('#gChnageSelect').click( function(){
				if (!$('#gChnageSelectDiv').hasClass("hide")) {
					$("#gChnageSelectDiv").addClass( "hide" );
					$('#gChnageTextDiv').removeClass( "hide" );
				}
			});
						
			
			//restict spacebar input	
			function RestrictSpace() {
				if (event.keyCode == 32) {
					return false;
				}
			}
			
			//generate report			
			$('#loadBtn').click( function(e){
				//prevent auto submit
				$("#loader").css('display', 'block');
				e.preventDefault();	
				
				//collect form data
				fromdate = $("#fromdate").val();
				todate = $("#todate").val();
				
				dPeriod = "";	
				if ($("#today").is(":checked")) {
					dPeriod = $("#today").val();
				}
				if ($("#cMonth").is(":checked")) {
					dPeriod = $("#cMonth").val();
				}
				if ($("#cYear").is(":checked")) {
					dPeriod = $("#cYear").val();
				}
				if ($("#oPeriod").is(":checked")) {
					dPeriod = $("#oPeriod").val();
				}
				
				
				
				pAreaList.push($('#pAreaSelection').val());
				pSubAreaList.push($('#pSAreaSelection').val());			
				epfList.push($('#pNSelection').val());
				
				pAreaVal = $('#pAreaSelection').val();
				pSAreaVal = $('#pSAreaSelection').val();
				pNVal = $('#pNSelection').val();
				
				
				// console.log('epfList - '+epfList);
				// console.log('pAreaList - '+pAreaList);
				// console.log('pSubAreaList - '+pSubAreaList);
				// console.log('companyList - '+companyList);
				// console.log('dPeriod - '+dPeriod);
				// console.log('fromDate - '+fromdate);
				// console.log('toDate - '+todate );
				
				/* emp_epf = $('#emp_epf').val();
				
				var emp_epf_len = emp_epf.length;
				if(emp_epf_len==5){
					emp_epf = '001'+emp_epf;
				}
				else if(emp_epf_len==4){
					emp_epf = '0010'+emp_epf;
				} */
				
				//console.log(emp_epf);
				
				//epf wise call
				
				// {company1 :companyList,
					// period1 :dPeriod,
					// pArea1 :pAreaVal,
					// pSubArea1 :pSAreaVal,
					// epfList1 :pNVal,
					// fromDate1 : fromdate,
					// toDate1 : todate };
				
				var data0 = {company :companyList,
					period :dPeriod,
					pArea :pAreaVal,
					pSubArea :pSAreaVal,
					epfList :pNVal,
					fromDate : fromdate,
					toDate : todate };
					
				
				//console.log(data0);
					
				$.ajax({ 
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					contentType: "application/json; charset=utf-8",
					//beforeSend: function (request) { request.setRequestHeader('Access-Control-Allow-Origin', '*') },
					data: JSON.stringify(data0),
					// url: "https://localhost:44371/api/Employees/",
					url: "https://localhost:44371/api/GetEmpByList/empInfo/",
					
					success: function(data, response){        
						//console.log(data); 
						
						if(data.message == "NULL DATA")
						{	
							$("#loader").css('display', 'none');
							$('#result_display').empty();
							const notyf = new Notyf();
							notyf.error({
							  message: 'NO DATA FOUND!',
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
						else if(data.message == "INVALID DATE RANGE")
						{	
							$("#loader").css('display', 'none');
							$('#result_display').empty();
							const notyf = new Notyf();
							notyf.error({
							  message: 'INVALID DATE RANGE',
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
							var clearHTML = '<div class="card"><div class="card-body"><div class="table-responsive"><table id="result_table" class="table table-striped table-bordered " style="" ><thead><tr><th>EPF</th><th>Name</th><th>Retirement Date</th><th>Action Type</th><th>Action Date</th><th>Reason for Action</th><th>Personnel Area</th><th>Personnel Sub Area</th><th>Grade</th><th>New Position</th></tr></thead><tbody>';
							
							$.each(data, function (i, item) {
								
								clearHTML += '<tr>' +
									'<td>' + item.PERNR + '</td>' +
									'<td>' + item.ENAME + '</td>' +
									'<td>' + item.REDAT + '</td>' +
									'<td>' + item.MNTXT + '</td>' +	
									'<td>' + item.BEGDA + '</td>' +
									'<td>' + item.MGTXT + '</td>' +
									'<td>' + item.NAME1 + '</td>' +
									'<td>' + item.BTEXT + '</td>' +	
									'<td>' + item.PTEXT + '</td>' +
									'<td>' + item.PLSTX + '</td>' +	
									'</tr>';
									
							});
							
														
							clearHTML += '</tbody></table></div></div></div>';
							$('#result_display').append(clearHTML);
							$(document).ready(function() { 
								var table = $("#result_table").DataTable( 
								{	
									lengthChange: false, 
									responsive: true, 
									scrollY:  600, 
									fixedHeader: false,
									scrollX: true,
									bAutoWidth: true, 
									buttons: 
										[  
											{
												extend: 'csv',
												title: 'Active Employee List [ZZH_ACT_EMP_LIST]'
											}
										]
								} );
								
								table.buttons().container().appendTo( "#result_table_wrapper .col-md-6:eq(0)" );} );
								
							//$('#result_display').append(trHTML);
						}
						
						$("html, body").animate({
							scrollTop: $("#result_display").offset().top + 20
						}, 500);
						$("#loader").css('display', 'none');
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						//alert("some error");
						$("#loader").css('display', 'none');
						$('#result_display').empty();
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
				
				
				
			});
				
			
			//daterabgepicker settings			
				$(document).ready(function(){
				  var date_input=$('input[name="fromdate"]'); //our date input has the name "date"
				  var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
				  var options={
					format: 'dd.mm.yyyy',
					container: container,
					todayHighlight: true,
					autoclose: true,
				  };
				  date_input.datepicker(options);
				});
				
				$(document).ready(function(){
				  var date_input=$('input[name="todate"]'); //our date input has the name "date"
				  var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
				  var options={
					format: 'dd.mm.yyyy',
					container: container,
					todayHighlight: true,
					autoclose: true,
				  };
				  date_input.datepicker(options);
				})
				
			$("#loader").css('display', 'block');
			});		
				
			</script>