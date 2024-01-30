<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Profile</h1>

		<div class="row">
			<div class="col-md-4 col-xl-3">
				<div class="card mb-3">
					<div class="card-header">
						<h5 class="card-title mb-0">Profile Details</h5>
					</div>
					<div class="card-body text-center">
						<img src="<?php echo base_url();?>assets/backend/img/avatars/avatar.jpg" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128">
						<h5 class="card-title mb-0"><?php echo $emp_name  = $this->session->userdata('emp_name');?></h5>
						<div class="text-muted mb-2"><?php echo $emp_name  = $this->session->userdata('emp_epf');?></div>

						<!--div>
							<a class="btn btn-primary btn-sm" href="#">Follow</a>
							<a class="btn btn-primary btn-sm" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg> Message</a>
						</div-->
					</div>
					<!--hr class="my-0">
					<div class="card-body">
						<h5 class="h6 card-title">Skills</h5>
						<a href="#" class="badge bg-primary me-1 my-1">HTML</a>
						<a href="#" class="badge bg-primary me-1 my-1">JavaScript</a>
						<a href="#" class="badge bg-primary me-1 my-1">Sass</a>
						<a href="#" class="badge bg-primary me-1 my-1">Angular</a>
						<a href="#" class="badge bg-primary me-1 my-1">Vue</a>
						<a href="#" class="badge bg-primary me-1 my-1">React</a>
						<a href="#" class="badge bg-primary me-1 my-1">Redux</a>
						<a href="#" class="badge bg-primary me-1 my-1">UI</a>
						<a href="#" class="badge bg-primary me-1 my-1">UX</a>
					</div-->
					<hr class="my-0">
					<div class="card-body">
						<h5 class="h6 card-title">About</h5>
						<ul class="list-unstyled mb-0">
							<li class="mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home feather-sm me-1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>Company : <a href="#"><?php echo $company_name  = $this->session->userdata('company_name');?></a></li>
							<li class="mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase feather-sm me-1"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>Function : <a href="#"><?php echo $func_name  = $this->session->userdata('func_name');?></a></li>
							<li class="mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign align-middle me-1"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>Email : <a href="#"><?php echo $emp_email  = $this->session->userdata('emp_email');?></a></li>
							<li class="mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase feather-sm me-1"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Mobile : <a href="#">0<?php echo $emp_mobile  = $this->session->userdata('emp_mobile');?></a></li>
							<li class="mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle me-1"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>Cost Center : <a href="#"><?php echo $cost_name  = $this->session->userdata('cost_name');?>(<?php echo $cost_code  = $this->session->userdata('cost_code');?>)</a></li>
							<li class="mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin align-middle me-1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>Location : <a href="#"><?php echo $loc_name  = $this->session->userdata('loc_name');?></a></li>
							<li class="mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid align-middle me-2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>Plant : <a href="#"><?php echo $plant_name  = $this->session->userdata('plant_name');?></a></li>
						</ul>
					</div>
					<!--hr class="my-0">
					<div class="card-body">
						<h5 class="h6 card-title">Elsewhere</h5>
						<ul class="list-unstyled mb-0">
							<li class="mb-1"><span class="fas fa-globe fa-fw me-1"></span> <a href="#">staciehall.co</a></li>
							<li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
							<li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
							<li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
							<li class="mb-1"><span class="fab fa-linkedin fa-fw me-1"></span> <a href="#">LinkedIn</a></li>
						</ul>
					</div-->
				</div>
			</div>

			<!--div class="col-md-8 col-xl-9">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Activities</h5>
					</div>
					<div class="card-body h-100">

						<div class="d-flex align-items-start">
							<img src="<?php echo base_url();?>assets/backend/img/avatars/avatar.jpg" width="36" height="36" class="rounded-circle me-2" alt="Vanessa Tucker">
							<div class="flex-grow-1">
								<small class="float-end text-navy">5m ago</small>
								<strong><?php echo $emp_name  = $this->session->userdata('emp_name');?></strong> created new user</strong><br>
								<small class="text-muted">Today 7:51 pm</small><br>

							</div>
						</div>

						<hr>
					</div>
				</div>
			</div>
		</div-->

	</div>
</main>
		