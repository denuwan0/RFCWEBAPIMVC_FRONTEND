<?php
if (isset($_POST['userData']) && isset($_POST['permData'])){
	
	$userData = '';
	$permData = '';
	$userData = json_decode(stripslashes($_POST['userData']));
	$permData = $_POST['permData'];
	
	//var_dump($_POST['permData'][0]);
	$permArr = array();
		
	foreach ($permData as $value) {
		$new_str = str_replace(' ', '', $value['url_value']);
		$permArr[$new_str] = array(array("is_active" => $value['is_active']), array("is_view" => $value['is_view']), array("is_edit" => $value['is_edit']));		
	}
	
	//var_dump($permArr);
	
	$this->session->set_userdata('permData',$permArr);
	
	
	
	$this->session->set_userdata(array(
		'emp_epf' => $userData[0]->emp_epf,
		'emp_name'   => $userData[0]->emp_name,
		'emp_id'    => $userData[0]->emp_id,
		'emp_user_grp'   => $userData[0]->emp_user_grp,
		'emp_user_sub_grp'   => $userData[0]->emp_user_sub_grp,
		'emp_email'    => $userData[0]->emp_email,
		'emp_mobile' => $userData[0]->emp_mobile,
		'func_id' => $userData[0]->func_id,
		'func_name'   => $userData[0]->func_name,
		'company_id'    => $userData[0]->company_id,
		'company_code' => $userData[0]->company_code,
		'company_name'   => $userData[0]->company_name,
		'cost_id'    => $userData[0]->cost_id,
		'cost_code'   => $userData[0]->cost_code,
		'cost_name'    => $userData[0]->cost_name,
		'plant_id' => $userData[0]->plant_id,
		'plant_code' => $userData[0]->plant_code,
		'plant_name'   => $userData[0]->plant_name,
		'loc_id'    => $userData[0]->loc_id,
		'loc_name'    => $userData[0]->loc_name,
		'is_active'    => $userData[0]->is_active,
		'logged_in'    => true
		
	));
	
	//var_dump($this->session->userdata);
	
	$success['status'] = TRUE;
    echo json_encode($success);
}
else
{
	$success['status'] = FALSE;
    echo json_encode($success);
}


