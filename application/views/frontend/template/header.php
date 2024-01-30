<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/backend/img/icons/saprfc.png" />
	<link rel="icon" href="<?php echo base_url();?>assets/backend/img/icons/saprfc.png" type="image/gif">

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>SAP RFC CPSTL</title>
	
	<link href="<?php echo base_url();?>assets/backend/css/light.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/backend/css/datatable/jquery.dataTables.min.css" rel="stylesheet">
	
	
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/notyf.min.css">
	<!-- Bootstrap Date-Picker Plugin -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/backend/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/choices/public/assets/styles/choices.min.css" />
	<script src="<?php echo base_url();?>assets/backend/choices/public/assets/scripts/choices.min.js"></script>
	
	<link href="<?php echo base_url();?>assets/backend/css/select2.min.css" rel="stylesheet" />
	<script src="<?php echo base_url();?>assets/backend/js/select2.min.js"></script>
	<style>
	#loader{
		 z-index:999999;
		 display:block;
		 position:fixed;
		 top:0;
		 left:0;
		 width:100%;
		 height:100%;
		 opacity: 0.6;
		 background:url(<?php echo base_url();?>assets/backend/img/icons/loader1.gif) 50% 50% no-repeat #cccccc;
		}
	.hide {
	  display:none;
	}	
	</style>
</head>
<body>
<div id="loader">
</div>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="#">
					<span class="align-middle">SAP RFC</span>
				</a>

				<ul class="sidebar-nav" id="sidebar_generate">
					<!--li class="sidebar-header">
						Reports
					</li-->
					
					
					
					
					
				</ul>
				
				
				

				<div class="sidebar-cta">
					
				</div>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell align-middle"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
									<span class="indicator">4</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell text-warning"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home text-primary"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus text-success"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Christina accepted your request.</div>
												<div class="text-muted small mt-1">14h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon d-inline-block d-sm-none" href="#" data-bs-toggle="">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link d-none d-sm-inline-block" href="#" data-bs-toggle="">
								<p><?php echo $emp_name  = $this->session->userdata('emp_name');?></p>
							</a>
							
						</li>
						
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="<?php echo base_url();?>assets/backend/img/avatars/avatar.jpg" class="avatar img-fluid rounded" alt="Charles Hall">
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="<?php echo base_url(); ?>user/user_profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="https://localhost:44371/help" target="_blank" ><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo base_url(); ?>login/logout">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			
			
<script>
	//create url type filter
	var clearHTML2 = '';
	clearHTML2 += '<li class="sidebar-item">';
	
	var emp_user_sub_grp = <?php echo $this->session->userdata('emp_user_sub_grp');?>;
	//console.log(emp_user_sub_grp);
	
	$.ajax({
	type: "GET",
	cache : false,
	async: false,
	dataType: "json",
	contentType: 'application/json',
	//data: emp_user_sub_grp,
	url: "https://localhost:44371/api/user_permissions/activeListByGrpId1?sub_id="+emp_user_sub_grp,
	success: function(data, result1){					
		//console.log('first');
		
		$.each(data, function (i, item1) {
			//console.log(item1);
			//item.WA.substring(3, 7);
			clearHTML2 += 	'<a data-bs-target="#item'+i+'" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="">'+
									'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg> <span class="align-middle">'+item1.url_type_name+'</span>'+
								'</a>'+
							'<ul id="item'+i+'" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">';
			
			
			$.ajax({
			type: "GET",
			cache : false,
			async: false,
			dataType: "json",
			contentType: 'application/json',
			//data: emp_user_sub_grp,
			url: "https://localhost:44371/api/user_permissions/activeListByGrpId?sub_id="+emp_user_sub_grp+"&url_type_id="+item1.url_type_id,
			success: function(data1, result2){					
				//console.log(clearHTML2);
				//console.log(data1);
				
				//--------------P Area --------------------//
				$.each(data1, function (j, item2) {
					//console.log(item2);
					//item.WA.substring(3, 7);	
					clearHTML2 += '<li class="sidebar-item"><a class="sidebar-link" href="'+item2.url_value+'">'+item2.menu_name+'</a></li>';				
				});
				
				//$('#sidebar_generate').append(clearHTML2);
				
				//console.log(clearHTML2);
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

				clearHTML2 +='</ul>';
				clearHTML2 +='</li>';
			
		});
		
		

		
		$('#sidebar_generate').append(clearHTML2);
		
		
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
	console.log('SAP RFC CPSTL ©');	
</script>

			