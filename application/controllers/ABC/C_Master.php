<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_Master extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('master/ABC_Model', 'master');
		auth_admin();
	}

	public function index()
	{
		$title = 'Master ABC';
		$script = '<script src="' . base_url('js/master/abc/type.js') . '" type="text/javascript"></script>
				<script src="' . base_url('js/master/abc/group.js') . '" type="text/javascript"></script>
				<script src="' . base_url('js/master/abc/percentage.js') . '" type="text/javascript"></script>
				<script src="' . base_url('js/master/abc/point.js') . '" type="text/javascript"></script>
				';
		$content = $this->load->view('master/abc/content/dashboard', null, true);

		$data = [
			'title' => $title,
			'content' => $content,
			'script' => $script
		];
		$this->load->view('master/abc/layout/main', $data);
	}

	// * Type
	// TODO : Create, Read, Update, Delete, Validation
	// ! Create & Validation
	public function create_type()
	{
		$code = $this->input->post('type_code', true);
		$description = $this->input->post('type_description', true);
		$result = null;
		$message = [];

		$config_validation = [
			[
				'field' => 'type_code',
				'label' => 'Type Code',
				'rules' => ['required', 'is_unique[tbl_mat_abc_mas_type.ComGrp]'],
				'errors' => [
					'is_unique' => 'This %s is already taken. Please input another Code'
				]
			],
			[
				'field' => 'type_description',
				'label' => 'Type Description',
				'rules' => 'required'
			]
		];
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($config_validation);


		if ($this->form_validation->run() == FALSE) {
			foreach ($config_validation as $row => $value) {
				$message[] = [
					'field' => $value['field'],
					'error_message' => form_error($value['field'])
				];
			}

			$result = [
				'error' => true,
				'status' => 'validation_error',
				'message' => $message
			];
		} else {

			$table = 'tbl_mat_abc_mas_type';
			$data = [
				'ComGrp' => $code,
				'ComGrpDes' => $description
			];

			$query_insert = $this->master->M_insert($table, $data);

			if ($query_insert == 'success') {
				$result = [
					'success' => true,
					'status' => $query_insert,
					'message' => '<strong>Data Recorded!</strong>'
				];
			} else {
				$result = [
					'error' => true,
					'status' => 'error',
					'message' => 'Please Contact Administrator or Web Developer'
				];
			}
		}

		// print_r($result);
		// die;

		echo json_encode($result);
	}

	// ! Create Form
	public function get_type_form()
	{
		$this->load->view('master/abc/component/form/form_type');
	}

	// ! Read 
	public function get_type()
	{
		$data = $this->master->M_get_type()->result_array();

		echo json_encode($data);
	}

	// ! Edit Form
	public function get_type_by_id($id)
	{
		$data = $this->master->M_get_type([
			'CtrlNo' => $id
		])->row_array();

		$data_view = [
			'data' => $data
		];

		$this->load->view('master/abc/component/form/form_type', $data_view);
	}

	// ! Update & Validation
	public function update_type($id)
	{
		$code = $this->input->post('type_code', true);
		$description = $this->input->post('type_description', true);

		$check = $this->master->M_get_type([
			'CtrlNo' => $id
		])->row_array();

		$result = null;
		$message = [];
		$config_validation = [
			[
				'field' => 'type_code',
				'label' => 'Type Code',
				'rules' => ['required'],
				'errors' => [
					'is_unique' => 'This %s is already taken. Please input another Code'
				]
			],
			[
				'field' => 'type_description',
				'label' => 'Type Description',
				'rules' => 'required'
			]
		];
		if ($check['ComGrp'] != $code) {
			array_push($config_validation[0]['rules'], 'is_unique[tbl_mat_abc_mas_type.ComGrp]');
		}
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($config_validation);

		if ($this->form_validation->run() == FALSE) {
			foreach ($config_validation as $row => $value) {
				$message[] = [
					'field' => $value['field'],
					'error_message' => form_error($value['field'])
				];
			}
			$result = [
				'error' => true,
				'status' => 'validation_error',
				'message' => $message
			];
		} else {

			$table = 'tbl_mat_abc_mas_type';
			$data = [
				'ComGrp' => $code,
				'ComGrpDes' => $description
			];
			$where = [
				'CtrlNo' => $id
			];

			$query_insert = $this->master->M_update($table, $data, $where);

			if ($query_insert == 'success') {
				$result = [
					'success' => true,
					'status' => $query_insert,
					'message' => '<strong>Data Updated!</strong>'
				];
			} else {
				$result = [
					'error' => true,
					'status' => 'error',
					'message' => 'Please Contact Administrator or Web Developer'
				];
			}
		}

		echo json_encode($result);
	}

	// ? Delete (needed?)
	// * Type End

	// * Group
	// TODO: Create, Read, Update, Delete, Validation
	// ! Create Form
	public function get_group_form()
	{
		$this->load->view('master/abc/component/form/form_group');
	}

	// ! Create & Validation
	public function create_group()
	{
		$code = $this->input->post('group_code', true);
		$description = $this->input->post('group_description', true);
		$type = $this->input->post('group_type', true);
		$result = null;
		$message = [];

		$config_validation = [
			[
				'field' => 'group_code',
				'label' => 'Group Code',
				'rules' => ['required', 'is_unique[tbl_mat_abc_mas_type_grp.ComGrp]'],
				'errors' => [
					'is_unique' => 'This %s is already taken. Please input another Code'
				]
			],
			[
				'field' => 'group_description',
				'label' => 'Group Description',
				'rules' => 'required'
			],
			[
				'field' => 'group_type',
				'label' => 'Group Type',
				'rules' => 'required'
			]
		];
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($config_validation);

		if ($this->form_validation->run() == FALSE) {
			foreach ($config_validation as $row => $value) {
				$message[] = [
					'field' => $value['field'],
					'error_message' => form_error($value['field'])
				];
			}

			$result = [
				'error' => true,
				'status' => 'validation_error',
				'message' => $message
			];
		} else {

			$table = 'tbl_mat_abc_mas_type_grp';
			$data = [
				'ComGrp' => $code,
				'ComGrpDes' => $description,
				'ComType' => $type
			];

			$query_insert = $this->master->M_insert($table, $data);

			if ($query_insert == 'success') {
				$result = [
					'success' => true,
					'status' => $query_insert,
					'message' => '<strong>Data Recorded!</strong>'
				];
			} else {
				$result = [
					'error' => true,
					'status' => 'error',
					'message' => 'Please Contact Administrator or Web Developer'
				];
			}
		}

		echo json_encode($result);
	}

	// ! Read
	public function get_type_group()
	{
		$data = $this->master->M_get_type_group()->result_array();

		echo json_encode($data);
	}

	public function get_type_select2()
	{
		$data = $this->master->M_get_type_select2([
			'Disc' => '0'
		])->result_array();

		echo json_encode($data);
	}

	// ! Edit Form
	public function get_group_by_id($id)
	{
		$data = $this->master->M_get_type_group([
			'grp.CtrlNo' => $id
		])->row_array();

		$data_view = [
			'data' => $data
		];

		$this->load->view('master/abc/component/form/form_group', $data_view);
	}

	// ! Update
	public function update_group($id)
	{
		$code = $this->input->post('group_code', true);
		$description = $this->input->post('group_description', true);
		$type = $this->input->post('group_type', true);
		$result = null;
		$message = [];

		$check = $this->master->M_get_type_group([
			'grp.CtrlNo' => $id
		])->row_array();

		$config_validation = [
			[
				'field' => 'group_code',
				'label' => 'Group Code',
				'rules' => ['required'],
				'errors' => [
					'is_unique' => 'This %s is already taken. Please input another Code'
				]
			],
			[
				'field' => 'group_description',
				'label' => 'Group Description',
				'rules' => 'required'
			],
			[
				'field' => 'group_type',
				'label' => 'Group Type',
				'rules' => 'required'
			]
		];
		if ($check['ComGrp'] != $code) {
			array_push($config_validation[0]['rules'], 'is_unique[tbl_mat_abc_mas_type_grp.ComGrp]');
		}
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($config_validation);

		if ($this->form_validation->run() == FALSE) {
			foreach ($config_validation as $row => $value) {
				$message[] = [
					'field' => $value['field'],
					'error_message' => form_error($value['field'])
				];
			}

			$result = [
				'error' => true,
				'status' => 'validation_error',
				'message' => $message
			];
		} else {

			$table = 'tbl_mat_abc_mas_type_grp';
			$data = [
				'ComGrp' => $code,
				'ComGrpDes' => $description,
				'ComType' => $type
			];
			$where = [
				'CtrlNo' => $id
			];

			$query_insert = $this->master->M_update($table, $data, $where);

			if ($query_insert == 'success') {
				$result = [
					'success' => true,
					'status' => $query_insert,
					'message' => '<strong>Data Recorded!</strong>'
				];
			} else {
				$result = [
					'error' => true,
					'status' => 'error',
					'message' => 'Please Contact Administrator or Web Developer'
				];
			}
		}

		echo json_encode($result);
	}

	// ? Delete (needed?)

	// ! Percentage Form
	public function get_group_percentage_content($id)
	{
		$data = $this->master->M_get_type_group([
			'grp.CtrlNo' => $id
		])->row_array();

		$data_history = $this->master->M_get_group_percentage([
			'ComGrp' => $data['ComGrp']
		])->result_array();

		$data_view = [
			'data' => [
				'ComGrp' => $data['ComGrp'] ?? null,
				'CtrlNo' => $data['CtrlNo'] ?? null
			],
			'history' => $data_history
		];

		$this->load->view('master/abc/content/group_percentage', $data_view);
	}

	public function get_group_percentage_table($id)
	{
		$data = $this->master->M_get_type_group([
			'grp.CtrlNo' => $id
		])->row_array();

		$data_history = $this->master->M_get_group_percentage([
			'ComGrp' => $data['ComGrp']
		])->result_array();

		$data_view = [
			'history' => $data_history
		];

		$this->load->view('master/abc/component/percentage_history', $data_view);
	}

	// ! Percentage Update
	public function update_group_percentage($id)
	{
		$group = $id;
		$percentage = $this->input->post('percentage', true);
		$date = $this->input->post('percentage_date_update', true);
		$remarks = $this->input->post('percentage_remarks', true);

		$result = null;
		$message = [];

		$config_validation = [
			[
				'field' => 'percentage',
				'label' => 'Group Percentage',
				'rules' => ['required', 'numeric', 'less_than_equal_to[100]', 'greater_than_equal_to[0]']
			],
			[
				'field' => 'percentage_date_update',
				'label' => 'Group Date',
				'rules' => ['required', 'callback_valid_date'],
			],
		];

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($config_validation);

		if ($this->form_validation->run() == FALSE) {
			foreach ($config_validation as $row => $value) {
				$message[] = [
					'field' => $value['field'],
					'error_message' => form_error($value['field'])
				];
			}

			$result = [
				'error' => true,
				'status' => 'validation_error',
				'message' => $message
			];
		} else {
			$group_data = $this->master->M_get_type_group([
				'grp.Disc' => '0',
				'grp.ComGrp' => $group
			])->row_array();

			$table = 'tbl_mat_abc_mas_type_perc';
			$data = [
				'ComGrp' => $group,
				'ComGrpDes' => $group_data['ComGrpDes'],
				'DateUpdate' => $date,
				'Percentage' => $percentage,
				'Remarks' => $remarks
			];

			$query_insert = $this->master->M_insert($table, $data);

			if ($query_insert == 'success') {
				$result = [
					'success' => true,
					'status' => $query_insert,
					'message' => '<strong>Data Recorded!</strong>'
				];
			} else {
				$result = [
					'error' => true,
					'status' => 'error',
					'message' => 'Please Contact Administrator or Web Developer'
				];
			}
		}

		echo json_encode($result);
	}

	// * Group End

	// * Percentage Type
	// TODO: Create, Read, Update, Delete, Validation
	// ! Create Form
	public function get_percentage_form()
	{
		$this->load->view('master/abc/component/form/form_percentage');
	}

	// ! Create & validation
	public function create_percentage()
	{
		$group = $this->input->post('percentage_group', true);
		$percentage = $this->input->post('percentage', true);
		$date = $this->input->post('percentage_date_update', true);
		$remarks = $this->input->post('percentage_remarks', true);
		$result = null;
		$message = [];

		$config_validation = [
			[
				'field' => 'percentage_group',
				'label' => 'Group Code',
				'rules' => ['required'],
			],
			[
				'field' => 'percentage',
				'label' => 'Group Percentage',
				'rules' => ['required', 'numeric', 'less_than_equal_to[100]', 'greater_than_equal_to[0]']
			],
			[
				'field' => 'percentage_date_update',
				'label' => 'Group Date',
				'rules' => ['required', 'callback_valid_date'],
			],
		];
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($config_validation);

		if ($this->form_validation->run() == FALSE) {
			foreach ($config_validation as $row => $value) {
				$message[] = [
					'field' => $value['field'],
					'error_message' => form_error($value['field'])
				];
			}

			$result = [
				'error' => true,
				'status' => 'validation_error',
				'message' => $message
			];
		} else {

			$group_data = $this->master->M_get_type_group([
				'grp.Disc' => '0',
				'grp.ComGrp' => $group
			])->row_array();

			$table = 'tbl_mat_abc_mas_type_perc';
			$data = [
				'ComGrp' => $group,
				'ComGrpDes' => $group_data['ComGrpDes'],
				'DateUpdate' => $date,
				'Percentage' => $percentage,
				'Remarks' => $remarks
			];

			$query_insert = $this->master->M_insert($table, $data);

			if ($query_insert == 'success') {
				$result = [
					'success' => true,
					'status' => $query_insert,
					'message' => '<strong>Data Recorded!</strong>'
				];
			} else {
				$result = [
					'error' => true,
					'status' => 'error',
					'message' => 'Please Contact Administrator or Web Developer'
				];
			}
		}

		echo json_encode($result);
	}

	// ! Read
	public function get_group_percentage()
	{
		$data = $this->master->M_get_group_percentage()->result_array();

		echo json_encode($data);
	}

	public function get_group_select2()
	{
		$data = $this->master->M_get_type_group_select2([
			'Disc' => '0'
		])->result_array();

		echo json_encode($data);
	}

	// ! Edit Form
	public function get_percentage_by_id($id)
	{
		$data = $this->master->M_get_group_percentage([
			'CtrlNo' => $id
		])->row_array();

		$data_view = [
			'data' => $data
		];

		$this->load->view('master/abc/component/form/form_percentage', $data_view);
	}

	// ! Update
	public function update_percentage($id)
	{
		$group = $this->input->post('percentage_group', true);
		$percentage = $this->input->post('percentage', true);
		$date = $this->input->post('percentage_date_update', true);
		$remarks = $this->input->post('percentage_remarks', true);
		$result = null;
		$message = [];

		$config_validation = [
			[
				'field' => 'percentage',
				'label' => 'Group Percentage',
				'rules' => ['required', 'numeric', 'less_than_equal_to[100]']
			],
			[
				'field' => 'percentage_date_update',
				'label' => 'Group Date',
				'rules' => ['required', 'callback_valid_date'],
			],
		];
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($config_validation);

		if ($this->form_validation->run() == FALSE) {
			foreach ($config_validation as $row => $value) {
				$message[] = [
					'field' => $value['field'],
					'error_message' => form_error($value['field'])
				];
			}

			$result = [
				'error' => true,
				'status' => 'validation_error',
				'message' => $message
			];
		} else {
			$result = [
				'error' => true,
				'status' => 'error',
				'message' => 'This feature is <strong>under maintenance.</strong>'
			];
		}

		echo json_encode($result);
	}

	// * Percentage Type End

	// * Point
	// TODO: Create, Read, Update, Delete, Validation
	// ! Create Form
	public function get_point_form()
	{
		$this->load->view('master/abc/component/form/form_point');
	}

	// ! Create & validation
	public function create_point()
	{
		$type = $this->input->post('point_type', true);
		$amount = $this->input->post('point_amount', true);
		$date = $this->input->post('point_date', true);
		$justification = $this->input->post('point_justification', true);
		$approved_by = $this->input->post('point_approved_by', true);

		$result = null;
		$message = [];

		$config_validation = [
			[
				'field' => 'point_type',
				'label' => 'Point Type',
				'rules' => ['required', 'is_unique[tbl_mat_abc_mas_point_type.PointType]'],
				'errors' => [
					'is_unique' => 'This %s is already taken. Please input another Code'
				]
			],
			[
				'field' => 'point_amount',
				'label' => 'Amount',
				'rules' => ['required', 'numeric', 'greater_than_equal_to[0]']
			],
			[
				'field' => 'point_date',
				'label' => 'Date',
				'rules' => ['required', 'callback_valid_date']
			],
			[
				'field' => 'point_justification',
				'label' => 'Justification',
				'rules' => ['required']
			],
			[
				'field' => 'point_approved_by',
				'label' => 'Approved By',
				'rules' => ['required']
			]
		];

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($config_validation);

		if ($this->form_validation->run() == FALSE) {
			foreach ($config_validation as $row => $value) {
				$message[] = [
					'field' => $value['field'],
					'error_message' => form_error($value['field'])
				];
			}

			$result = [
				'error' => true,
				'status' => 'validation_error',
				'message' => $message
			];
		} else {
			$table = 'tbl_mat_abc_mas_point_type';
			$data = [
				'PointType' => $type,
				'PointTypeAmount' => $amount,
				'Date' => $date,
				'Justification' => $justification,
				'ApprovedBy' => $approved_by
			];

			$query_insert = $this->master->M_insert($table, $data);

			if ($query_insert == 'success') {
				$result = [
					'success' => true,
					'status' => $query_insert,
					'message' => '<strong>Data Recorded!</strong>'
				];
			} else {
				$result = [
					'error' => true,
					'status' => 'error',
					'message' => 'Please Contact Administrator or Web Developer'
				];
			}
		}

		echo json_encode($result);
	}

	// ! Read
	public function get_point()
	{
		$data = $this->master->M_get_point()->result_array();

		echo json_encode($data);
	}

	// ! Edit Form
	public function get_point_by_id($id)
	{
		$data = $this->master->M_get_point([
			'CtrlNo' => $id
		])->row_array();

		$data_view = [
			'data' => $data
		];

		$this->load->view('master/abc/component/form/form_point', $data_view);
	}

	// ! Update & Validation
	public function update_point($id)
	{
		$amount = $this->input->post('point_amount', true);
		$date = $this->input->post('point_date', true);
		$justification = $this->input->post('point_justification', true);

		$result = null;
		$message = [];

		$config_validation = [
			[
				'field' => 'point_amount',
				'label' => 'Amount',
				'rules' => ['required', 'numeric', 'greater_than_equal_to[0]']
			],
			[
				'field' => 'point_date',
				'label' => 'Date',
				'rules' => ['required', 'callback_valid_date']
			],
			[
				'field' => 'point_justification',
				'label' => 'Justification',
				'rules' => ['required']
			]
		];

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules($config_validation);

		if ($this->form_validation->run() == FALSE) {
			foreach ($config_validation as $row => $value) {
				$message[] = [
					'field' => $value['field'],
					'error_message' => form_error($value['field'])
				];
			}

			$result = [
				'error' => true,
				'status' => 'validation_error',
				'message' => $message
			];
		} else {
			$table = 'tbl_mat_abc_mas_point_type';
			$data = [
				'PointTypeAmount' => $amount,
				'Date' => $date,
				'Justification' => $justification,
			];

			$where = [
				'CtrlNo' => $id
			];

			$query_update = $this->master->M_update($table, $data, $where);

			if ($query_update == 'success') {
				$result = [
					'success' => true,
					'status' => $query_update,
					'message' => '<strong>Data Recorded!</strong>'
				];
			} else {
				$result = [
					'error' => true,
					'status' => 'error',
					'message' => 'Please Contact Administrator or Web Developer'
				];
			}
		}

		echo json_encode($result);
	}

	// * Point End

	public function valid_date($date)
	{
		// if (date('Y-m-d', strtotime($date)) == $date) {
		//   return true;
		// } else {
		//   $this->form_validation->set_message('valid_date', 'The {field} format di not matched');
		//   return false;
		// }
		if ($date) {
			$d = DateTime::createFromFormat('Y-m-d', $date);
			$this->form_validation->set_message('valid_date', 'The {field} format di not matched');
			return $d && $d->format('Y-m-d') === $date;
		} else {
			return true;
		}
	}
}
