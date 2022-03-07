<?php defined('BASEPATH') or exit('No direct script access allowed');

class C_ProductionCost extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ABC/ProductionCost_Model', 'pc');
		// auth_admin();
	}

	public function index()
	{
		$type = $this->pc->M_get_type([
			'Disc' => '0'
		])->result_array();

		$group = $this->pc->M_get_group([
			'Disc' => '0'
		])->result_array();

		$data_cost = $this->pc->M_get_production_cost();

		$title = 'Production Cost';
		$script = '<script src="' . base_url('js/abc/production_cost/view_production_cost.js') . '" type="module"></script>';
		$data_view = [
			'title' => 'Production Cost',
			'data_cost' => $data_cost,
			'data_group' => $group
		];
		$content = $this->load->view('abc/content/production_cost', $data_view, true);

		$data = [
			'title' => $title,
			'content' => $content,
			'script' => $script,
			'no_sidebar' => true
		];
		$this->load->view('abc/layout/main', $data);
	}

	public function get_production_cost()
	{
		$data_cost = $this->pc->M_get_production_cost();

		echo json_encode($data_cost);
	}
}
