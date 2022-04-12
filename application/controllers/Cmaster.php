<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cmaster extends CI_Controller
{
	/**
     * Common HTTP status codes and their respective description.
     *
     * @link http://www.restapitutorial.com/httpstatuscodes.html
     */
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_INTERNAL_ERROR = 500;

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('response');

		$this->load->model('Mdl_corp_master', 'master');
		
		$this->load->library(array('Datatables' => 'dtables', 'Zend'));
	}

	public function index()
	{
		$data = [
			'title' => 'Masters',
			'h2' => 'Master & Settings',
			'company' => $this->master->M_get_company(),
			'storagecode' => $this->master->get_last_storagecode(),

			'script' => 'master'
		];

		$this->load->view('financecorp/master/v_master_dashboard', $data);
	}

	function mt_mas_stock()
	{
		$data['title'] = 'Master - Stockcode';
		$data['h2'] = 'Master';

		$this->load->view('financecorp/master/v_master_stockcode', $data);
	}

	//Master Abase Start
	public function viewModalMasterAbase()
	{
		$input = $this->input->post('input');
		switch ($input) {
			case 'abasecompany':
				echo '<form id="form_abasecompany" enctype="multipart/form-data">
							<div class="portlet light bordered">
			                    <div class="portlet-body">
			                        <div class="form-horizontal">
			                            <div class="form-body">
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanycode" id="abasecompanycode" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Name : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanyname" id="abasecompanyname" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Short Name : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanyshortname" id="abasecompanyshortname" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Description : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanydescription" id="abasecompanydescription" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Type : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanytype" id="abasecompanytype" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Address : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanyaddress" id="abasecompanyaddress" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">City : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanycity" id="abasecompanycity" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Province : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanyprovince" id="abasecompanyprovince" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Postal Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanypostalcode" id="abasecompanypostalcode" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Country : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanycountry" id="abasecompanycountry" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Region : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanyregion" id="abasecompanyregion" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Phone : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanyphone" id="abasecompanyphone" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Contact : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanycontact" id="abasecompanycontact" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Contact Name : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanycontactname" id="abasecompanycontactname" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">NPWP : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanynpwp" id="abasecompanynpwp" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Logo : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="file" name="abasecompanylogo" id="abasecompanylogo" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Email : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanyemail" id="abasecompanyemail" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Web Address : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanywebaddress" id="abasecompanywebaddress" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Remarks : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecompanyremarks" id="abasecompanyremarks" class="form-control">
			                                    </div>
			                                </div>
			                            </div>
			                        </div>     
			                    </div>
			                </div>
		                </form>';
				break;
			case 'abasebranch':
				echo '<form id="form_abasebranch">
							<div class="portlet light bordered">
			                    <div class="portlet-body">
			                        <div class="form-horizontal">
			                            <div class="form-body">
			                            	<div class="form-group has-error">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Company Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                    	<select name="abasebranchcompanycode" id="abasebranchcompanycode" class="form-required form-control">
			                                    	</select>
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchcode" id="abasebranchcode" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Name : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchname" id="abasebranchname" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Description : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchdescription" id="abasebranchdescription" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Type : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchtype" id="abasebranchtype" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Address : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchaddress" id="abasebranchaddress" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">City : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchcity" id="abasebranchcity" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Province : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchprovince" id="abasebranchprovince" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Province Group : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchprovincegroup" id="abasebranchprovincegroup" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Postal Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchpostalcode" id="abasebranchpostalcode" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Country : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchcountry" id="abasebranchcountry" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Phone : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchphone" id="abasebranchphone" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Contact : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchcontact" id="abasebranchcontact" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Contact Name : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchcontactname" id="abasebranchcontactname" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">NPWP : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchnpwp" id="abasebranchnpwp" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Logo : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="file" name="abasebranchlogo" id="abasebranchlogo" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Email : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchemail" id="abasebranchemail" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Web Address : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchwebaddress" id="abasebranchwebaddress" class="form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Remarks : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasebranchremarks" id="abasebranchremarks" class="form-control">
			                                    </div>
			                                </div>
			                            </div>
			                        </div>     
			                    </div>
			                </div>
		                </form>';
				break;
			case 'abasedepartment':
				echo '<form id="form_abasedepartment">
							<div class="portlet light bordered">
			                    <div class="portlet-body">
			                        <div class="form-horizontal">
			                            <div class="form-body">
			                            	<div class="form-group has-error">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Branch : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <select name="abasedepartmentbranch" id="abasedepartmentbranch" class="form-required form-control">
			                                        </select>
			                                    </div>
			                                </div>
			                                <div class="form-group has-error">
			                                    <label class="col-md-3 col-sm-3 control-label bold">BU Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <select name="abasedepartmentbucode" id="abasedepartmentbucode" class="form-required form-control">
			                                        </select>
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasedepartmentcode" id="abasedepartmentcode" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Description : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasedepartmentdescription" id="abasedepartmentdescription" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Remarks : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasedepartmentremarks" id="abasedepartmentremarks" class="form-control">
			                                    </div>
			                                </div>
			                            </div>
			                        </div>     
			                    </div>
			                </div>
		                </form>';
				break;
			case 'abasedepartmentbu':
				echo '<form id="form_abasedepartmentbu">
							<div class="portlet light bordered">
			                    <div class="portlet-body">
			                        <div class="form-horizontal">
			                            <div class="form-body">
			                            	<div class="form-group has-error">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Division Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <select name="abasedepartmentbudivisioncode" id="abasedepartmentbudivisioncode" class="form-required form-control">
			                                        </select>
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasedepartmentbucode" id="abasedepartmentbucode" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Description : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasedepartmentbudescription" id="abasedepartmentbudescription" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Remarks : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasedepartmentburemarks" id="abasedepartmentburemarks" class="form-control">
			                                    </div>
			                                </div>
			                            </div>
			                        </div>     
			                    </div>
			                </div>
		                </form>';
				break;
			case 'abasedepartmentdiv':
				echo '<form id="form_abasedepartmentdiv">
							<div class="portlet light bordered">
			                    <div class="portlet-body">
			                        <div class="form-horizontal">
			                            <div class="form-body">
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasedepartmentdivcode" id="abasedepartmentdivcode" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Description : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasedepartmentdivdescription" id="abasedepartmentdivdescription" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Remarks : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasedepartmentdivremarks" id="abasedepartmentdivremarks" class="form-control">
			                                    </div>
			                                </div>
			                            </div>
			                        </div>     
			                    </div>
			                </div>
		                </form>';
				break;
			case 'abasecostcenter':
				echo '<form id="form_abasecostcenter">
							<div class="portlet light bordered">
			                    <div class="portlet-body">
			                        <div class="form-horizontal">
			                            <div class="form-body">
			                            	<div class="form-group has-error">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Department : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <select name="abasecostcenterdepartment" id="abasecostcenterdepartment" class="form-required form-control">
			                                        </select>
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Code : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecostcentercode" id="abasecostcentercode" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Description : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecostcenterdescription" id="abasecostcenterdescription" class="form-required form-control">
			                                    </div>
			                                </div>
			                                <div class="form-group">
			                                    <label class="col-md-3 col-sm-3 control-label bold">Remarks : </label>
			                                    <div class="col-md-9 col-sm-9">
			                                        <input type="text" name="abasecostcenterremarks" id="abasecostcenterremarks" class="form-control">
			                                    </div>
			                                </div>
			                            </div>
			                        </div>     
			                    </div>
			                </div>
		                </form>';
				break;
		}
	}

	public function getDataMasterAbase()
	{
		$input = $this->input->post('input');
		
		//From DataTables Ajax
		$limit = $this->input->post('length') ?? 100;
		$offset = $this->input->post('start') ?? 0;

		switch ($input) {
			case 'abasecompany':
				$hasil = $this->master->getWhere('*', 'abase_01_com', 'Disc', 0, $limit, $offset);
				echo json_encode($hasil);
				break;
			case 'abasebranch':
				$hasil = $this->master->getWhere('*', 'abase_02_branch', 'Disc', 0, $limit, $offset);
				echo json_encode($hasil);
				break;
				// case 'abasedepartmentbu':
				// 	$hasil = $this->master->getWhere('*', 'abase_03_dept_bu', 'Disc', 0, $limit, $offset);
				// 	echo json_encode($hasil);
				// 	break;
			case 'abasedepartmentbu':
				$hasil = $this->master->get_join_bu($limit, $offset);
				echo json_encode($hasil);
				break;
				// case 'abasedepartment':
				// 	$hasil = $this->master->getWhere('*', 'abase_03_dept', 'Disc', 0, $limit, $offset);
				// 	echo json_encode($hasil);
				// 	break;
			case 'abasedepartment':
				$hasil = $this->master->get_join_dept($limit, $offset);
				echo json_encode($hasil);
				break;
			case 'abasedepartmentdiv':
				$hasil = $this->master->getWhere('*', 'abase_03_dept_div', 'Disc', 0, $limit, $offset);
				echo json_encode($hasil);
				break;
			case 'abasecostcenter':
				$hasil = $this->master->getWhere('*', 'abase_04_cost_center', 'Disc', 0, $limit, $offset);
				echo json_encode($hasil);
				break;
				// case 'abasecostcenter' :
				// 	$hasil = $this->master->get_join_cc();
				// 	echo json_encode($hasil);
				// 	break;
		}
	}

	public function viewModalMasterViewAbase()
	{
		$input = $this->input->post('input');
		switch ($input) {
			case 'abasecompany':
				echo '
					<div class="row">
						<div class="col-md-4">
							<div class="portlet light bg-grey-cararra stories-cont">
		                        <div class="photo">
		                            <img src="assets/metronic/pages/media/users/teambg1.jpg" class="img-responsive" alt="">
		                        </div>
		                        <div class="title" style="margin-bottom: -15px">
		                                <span class="font-blue-chambray" style="font-size: 24px" id="abasecompanyshortname"></span>
		                        </div>
		                        <div class="desc">
		                        	<span class="bold font-blue-chambray" style="font-size: 12px;" id="abasecompanydescription"></span>
		                            <br>
		                            <span class="bold font-blue-oleo" style="font-size: 12px;" id="abasecompanyaddress"></span>
		                            <br><br>
		                        </div>
		                    </div>	
						</div>
						<div class="col-md-6">
							<div class="portlet light">
								<div class="">
		                            <table class="table table-bordered">
		                                <thead>
		                                    <tr>
		                                        <th class="text-center bg-blue-chambray bg-font-blue-chambray" colspan="2">Details</th>
		                                    </tr>
		                                </thead>
		                                <tbody class="text-left">
		                                    <tr>
		                                        <th>Code</th>
		                                        <td id="abasecompanycode"></td>
		                                    </tr>
		                                    <tr>
		                                        <th>Name</th>
		                                        <td id="abasecompanyname"></td>
		                                    </tr>
		                                    <tr>
		                                        <th>Type</th>
		                                        <td id="abasecompanytype">
		                                            <span class="badge badge-roundless bg-blue bg-font-blue">Service</span>
		                                        </td>
		                                    </tr>
		                                    <tr>
		                                        <th>NPWP</th>
		                                        <td id="abasecompanynpwp">
		                                            
		                                        </td>
		                                    </tr>
		                                    
		                                </tbody>
		                            </table>
		                            <br>
		                            <table class="table table-bordered">
		                            	<thead>
		                            		<tr>
		                            			<th class="text-center bg-blue-chambray bg-font-blue-chambray" colspan="2">Contact</th>
		                            		</tr>
		                            	</thead>
		                            	<tbody class="text-left">
		                            		<tr>
		                            			<tr>
		                                            <th>Phone</th>
		                                            <td id="abasecompanyphone"></td>
		                                        </tr>
		                                        <tr>
		                                            <th>Contact</th>
		                                            <td id="abasecompanycontact"></td>
		                                        </tr>
		                                        <tr>
		                                            <th>Contact Name</th>
		                                            <td id="abasecompanycontactname"></td>
		                                        </tr>
		                                        <tr>
		                                            <th>Email</th>
		                                            <td><a href="#" title="" id="abasecompanyemail"></a></td>
		                                        </tr>
		                                        <tr>
		                                            <th>Web Address</th>
		                                            <td><a href="#" title="" id="abasecompanywebaddress"></a></td>
		                                        </tr>
		                            		</tr>
		                            	</tbody>
		                            </table>
		                            <br>
		                            <table class="table table-bordered">
		                                <thead>
		                                    <tr>
		                                        <th class="text-center bg-blue-chambray bg-font-blue-chambray" colspan="2">Action</th>
		                                    </tr>
		                                </thead>
		                                <tbody class="text-center">
		                                	<tr class="abasecompanyviewaction">
		                                	<td><a class="btn dark btn-xs btn-outline edit-abase" input="abasecompany" href="#"><i class="fa fa-pencil"></i></a> <a class="btn dark btn-xs btn-outline disc-abase" input="abasecompany" href="#"><i class="fa fa-trash"></i></a></td>
		                                	</tr>
		                                </tbody>
		                            </table>
		                        </div>
							</div>
						</div>
					</div>
					';
				break;
			case 'abasebranch':
				echo '
					<div class="row">
						<div class="col-md-4">
							<div class="portlet light bg-grey-cararra stories-cont">
		                        <div style="background-color: #43505c">
		                        	<center>
		                            	<img id="abasebranchlogo" src="" class="img-responsive" alt="" style="width:200px; height: 160px">
		                            </center>
		                        </div>
		                        <div class="title" style="margin-bottom: -15px">
		                                <span class="font-blue-chambray" style="font-size: 24px" id="abasebranchname"></span>
		                        </div>
		                        <div class="desc">
		                            <span class="bold font-blue-oleo" style="font-size: 12px;" id="abasebranchaddress"></span>
		                            
		                        </div>
		                    </div>	
						</div>
						<div class="col-md-6">
							<div class="portlet light">
								<div class="desc">
		                            <table class="table table-bordered">
		                                <thead>
		                                    <tr>
		                                        <th class="text-center bg-blue-chambray bg-font-blue-chambray" colspan="2">Details</th>
		                                    </tr>
		                                </thead>
		                                <tbody class="text-left">
		                                    <tr>
		                                        <th>Code</th>
		                                        <td id="abasebranchcode"></td>
		                                    </tr>
		                                    <tr>
		                                        <th>Description</th>
		                                        <td id="abasebranchdescription"></td>
		                                    </tr>
		                                    <tr>
		                                        <th>Type</th>
		                                        <td id="abasebranchtype">
		                                            <span class="badge badge-roundless bg-blue bg-font-blue">Service</span>
		                                        </td>
		                                    </tr>
		                                    
		                                </tbody>
		                            </table>
		                            <br>
		                            <table class="table table-bordered">
		                            	<thead>
		                            		<tr>
		                            			<th class="text-center bg-blue-chambray bg-font-blue-chambray" colspan="2">Contact</th>
		                            		</tr>
		                            	</thead>
		                            	<tbody class="text-left">
		                            		<tr>
		                                        <th>Phone</th>
		                                        <td id="abasebranchphone"></td>
		                                    </tr>
		                                    <tr>
		                                        <th>Contact</th>
		                                        <td id="abasebranchcontact"></td>
		                                    </tr>
		                                    <tr>
		                                        <th>Contact Name</th>
		                                        <td id="abasebranchcontactname"></td>
		                                    </tr>
		                                    <tr>
		                                        <th>Email</th>
		                                        <td><a href="#" title="" id="abasebranchemail"></a></td>
		                                    </tr>
		                                    <tr>
		                                        <th>Web Address</th>
		                                        <td><a href="#" title="" id="abasebranchwebaddress"></a></td>
		                                    </tr>
		                            	</tbody>
		                            </table>
		                            <br>
		                            <table class="table table-bordered">
		                                <thead>
		                                    <tr>
		                                        <th class="text-center bg-blue-chambray bg-font-blue-chambray" colspan="2">Action</th>
		                                    </tr>
		                                </thead>
		                                <tbody class="text-center">
		                                	<tr class="abasebranchviewaction">
		                                	<td><a class="btn dark btn-xs btn-outline edit-abase" input="abasebranch" href="#"><i class="fa fa-pencil"></i></a> <a class="btn dark btn-xs btn-outline disc-abase" input="abasebranch" href="#"><i class="fa fa-trash"></i></a></td>
		                                	</tr>
		                                </tbody>
		                            </table>	
								</div>
							</div>
						</div>
					</div>
					';
				break;
		}
	}

	public function inputDatamasterAbase()
	{
		$input = $this->input->post('input');

		switch ($input) {
			case 'abasecompany':
				$data = [
					'ComCode' => $this->input->post('abasecompanycode'),
					'ComName' => $this->input->post('abasecompanyname'),
					'ComShortName' => $this->input->post('abasecompanyshortname'),
					'ComDes' => $this->input->post('abasecompanydescription'),
					'CompType' => $this->input->post('abasecompanytype'),
					'Address' => $this->input->post('abasecompanyaddress'),
					'City' => $this->input->post('abasecompanycity'),
					'Province' => $this->input->post('abasecompanyprovince'),
					'PostalCode' => $this->input->post('abasecompanypostalcode'),
					'Country' => $this->input->post('abasecompanycountry'),
					'Region' => $this->input->post('abasecompanyregion'),
					'PhoneNo' => $this->input->post('abasecompanyphone'),
					'ContactNo' => $this->input->post('abasecompanycontact'),
					'ContactName' => $this->input->post('abasecompanycontactname'),
					'NPWP' => $this->input->post('abasecompanynpwp'),
					// 'Logo' => $this->input->post('abasecompanylogo'),
					'Logo' => '',
					'Email' => $this->input->post('abasecompanyemail'),
					'WebAddress' => $this->input->post('abasecompanywebaddress'),
					'Remarks' => $this->input->post('abasecompanyremarks'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['ComCode' => $this->input->post('abasecompanycode')];
				$hasil = $this->master->addData('abase_01_com', $data, $where);

				$data2 = [
					'ComCode' => $this->input->post('abasecompanycode'),
					'BranchCode' => $this->input->post('abasecompanycode'),
					'BranchName' => $this->input->post('abasecompanyname'),
					'BranchDes' => $this->input->post('abasecompanydescription'),
					'BranchType' => $this->input->post('abasecompanytype'),
					'BranchAddress' => $this->input->post('abasecompanyaddress'),
					'BranchCity' => $this->input->post('abasecompanycity'),
					'Province' => $this->input->post('abasecompanyprovince'),
					'ProvinceGrp' => $this->input->post('abasecompanyprovince'),
					'PostalCode' => $this->input->post('abasecompanypostalcode'),
					'Country' => $this->input->post('abasecompanycountry'),
					'PhoneNo' => $this->input->post('abasecompanyphone'),
					'ContactNo' => $this->input->post('abasecompanycontact'),
					'ContactName' => $this->input->post('abasecompanycontactname'),
					'NPWP' => $this->input->post('abasecompanynpwp'),
					// 'Logo' => $this->input->post('abasecompanylogo'),
					'Logo' => '',
					'Email' => $this->input->post('abasecompanyemail'),
					'WebAddress' => $this->input->post('abasecompanywebaddress'),
					'Remarks' => $this->input->post('abasecompanyremarks'),
					'RegDate' => date('Y-m-d')
				];
				$result = $this->master->addData('abase_02_branch', $data2, $where);
				break;
			case 'abasebranch':
				$data = [
					'ComCode' => $this->input->post('abasebranchcompanycode'),
					'BranchCode' => $this->input->post('abasebranchcode'),
					'BranchName' => $this->input->post('abasebranchname'),
					'BranchDes' => $this->input->post('abasebranchdescription'),
					'BranchType' => $this->input->post('abasebranchtype'),
					'BranchAddress' => $this->input->post('abasebranchaddress'),
					'BranchCity' => $this->input->post('abasebranchcity'),
					'Province' => $this->input->post('abasebranchprovince'),
					'ProvinceGrp' => $this->input->post('abasebranchprovincegroup'),
					'PostalCode' => $this->input->post('abasebranchpostalcode'),
					'Country' => $this->input->post('abasebranchcountry'),
					'PhoneNo' => $this->input->post('abasebranchphone'),
					'ContactNo' => $this->input->post('abasebranchcontact'),
					'ContactName' => $this->input->post('abasebranchcontactname'),
					'NPWP' => $this->input->post('abasebranchnpwp'),
					'Logo' => $this->input->post('abasebranchlogo'),
					'Email' => $this->input->post('abasebranchemail'),
					'WebAddress' => $this->input->post('abasebranchwebaddress'),
					'Remarks' => $this->input->post('abasebranchremarks'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['BranchCode' => $this->input->post('abasebranchcode')];
				$result = $this->master->addData('abase_02_branch', $data, $where);
				break;
			case 'abasedepartment':
				$data = [
					'Branch' => $this->input->post('abasedepartmentbranch'),
					'BUCode' => $this->input->post('abasedepartmentbucode'),
					'DeptCode' => $this->input->post('abasedepartmentcode'),
					'DeptDes' => $this->input->post('abasedepartmentdescription'),
					'Remarks' => $this->input->post('abasedepartmentremarks'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['DeptCode' => $this->input->post('abasedepartmentcode')];
				$result = $this->master->addData('abase_03_dept', $data, $where);
				break;
			case 'abasedepartmentbu':
				$data = [
					'DivCode' => $this->input->post('abasedepartmentbudivisioncode'),
					'BUCode' => $this->input->post('abasedepartmentbucode'),
					'BUDes' => $this->input->post('abasedepartmentbudescription'),
					'Remarks' => $this->input->post('abasedepartmentburemarks'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['BUCode' => $this->input->post('abasedepartmentbucode')];
				$result = $this->master->addData('abase_03_dept_bu', $data, $where);
				break;
			case 'abasedepartmentdiv':
				$data = [
					'DivCode' => $this->input->post('abasedepartmentdivcode'),
					'DivDes' => $this->input->post('abasedepartmentdivdescription'),
					'Remarks' => $this->input->post('abasedepartmentdivremarks'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['DivCode' => $this->input->post('abasedepartmentdivcode')];
				$result = $this->master->addData('abase_03_dept_div', $data, $where);
				break;
			case 'abasecostcenter':
				$data = [
					'DeptCode' => $this->input->post('abasecostcenterdepartment'),
					'CostCenter' => $this->input->post('abasecostcentercode'),
					'CCDes' => $this->input->post('abasecostcenterdescription'),
					'Remarks' => $this->input->post('abasecostcenterremarks'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['CostCenter' => $this->input->post('abasecostcentercode')];
				$result = $this->master->addData('abase_04_cost_center', $data, $where);
				break;
		}

		if($result !== true){
			if($result == false){
				set_error_response(self::HTTP_INTERNAL_ERROR, "Database Error");
			}else{
				set_error_response(self::HTTP_INTERNAL_ERROR, $result);
			}
		}

		set_success_response("Added");
	}

	public function getDataMasterAbaseByID()
	{
		$input = $this->input->post('input');
		$id = $this->input->post('CtrlNo');
		switch ($input) {
			case 'abasecompany':
				$hasil = $this->master->getDataByID('abase_01_com', 'CtrlNo', $id);
				echo json_encode($hasil);
				break;
			case 'abasebranch':
				$hasil = $this->master->getDataByID('abase_02_branch', 'CtrlNo', $id);
				echo json_encode($hasil);
				break;
			case 'abasedepartment':
				$hasil = $this->master->getDataByID('abase_03_dept', 'CtrlNo', $id);
				echo json_encode($hasil);
				break;
			case 'abasedepartmentbu':
				$hasil = $this->master->getDataByID('abase_03_dept_bu', 'CtrlNo', $id);
				echo json_encode($hasil);
				break;
			case 'abasedepartmentdiv':
				$hasil = $this->master->getDataByID('abase_03_dept_div', 'CtrlNo', $id);
				echo json_encode($hasil);
				break;
			case 'abasecostcenter':
				$hasil = $this->master->getDataByID('abase_04_cost_center', 'CtrlNo', $id);
				echo json_encode($hasil);
				break;
		}
	}

	public function editDataMasterAbase()
	{
		$input = $this->input->post('input');
		$id = $this->input->post('id');
		$result = 0;
		switch ($input) {
			case 'abasecompany':
				$data = [
					'ComCode' => $this->input->post('abasecompanycode'),
					'ComName' => $this->input->post('abasecompanyname'),
					'ComShortName' => $this->input->post('abasecompanyshortname'),
					'ComDes' => $this->input->post('abasecompanydescription'),
					'CompType' => $this->input->post('abasecompanytype'),
					'Address' => $this->input->post('abasecompanyaddress'),
					'City' => $this->input->post('abasecompanycity'),
					'Province' => $this->input->post('abasecompanyprovince'),
					'PostalCode' => $this->input->post('abasecompanypostalcode'),
					'Country' => $this->input->post('abasecompanycountry'),
					'Region' => $this->input->post('abasecompanyregion'),
					'PhoneNo' => $this->input->post('abasecompanyphone'),
					'ContactNo' => $this->input->post('abasecompanycontact'),
					'ContactName' => $this->input->post('abasecompanycontactname'),
					'NPWP' => $this->input->post('abasecompanynpwp'),
					'Logo' => $this->input->post('abasecompanylogo'),
					'Email' => $this->input->post('abasecompanyemail'),
					'WebAddress' => $this->input->post('abasecompanywebaddress'),
					'Remarks' => $this->input->post('abasecompanyremarks')
				];
				$hasil = $this->master->updateData('CtrlNo', $id, 'abase_01_com', $data);

				$data2 = [
					'ComCode' => $this->input->post('abasecompanycode'),
					'BranchCode' => $this->input->post('abasecompanycode'),
					'BranchName' => $this->input->post('abasecompanyname'),
					'BranchDes' => $this->input->post('abasecompanydescription'),
					'BranchType' => $this->input->post('abasecompanytype'),
					'BranchAddress' => $this->input->post('abasecompanyaddress'),
					'BranchCity' => $this->input->post('abasecompanycity'),
					'Province' => $this->input->post('abasecompanyprovince'),
					'ProvinceGrp' => $this->input->post('abasecompanyprovince'),
					'PostalCode' => $this->input->post('abasecompanypostalcode'),
					'Country' => $this->input->post('abasecompanycountry'),
					'PhoneNo' => $this->input->post('abasecompanyphone'),
					'ContactNo' => $this->input->post('abasecompanycontact'),
					'ContactName' => $this->input->post('abasecompanycontactname'),
					'NPWP' => $this->input->post('abasecompanynpwp'),
					'Logo' => $this->input->post('abasecompanylogo'),
					'Email' => $this->input->post('abasecompanyemail'),
					'WebAddress' => $this->input->post('abasecompanywebaddress'),
					'Remarks' => $this->input->post('abasecompanyremarks')
				];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_02_branch', $data2);
				break;
			case 'abasebranch':
				$data = [
					'ComCode' => $this->input->post('abasebranchcompanycode'),
					'BranchCode' => $this->input->post('abasebranchcode'),
					'BranchName' => $this->input->post('abasebranchname'),
					'BranchDes' => $this->input->post('abasebranchdescription'),
					'BranchType' => $this->input->post('abasebranchtype'),
					'BranchAddress' => $this->input->post('abasebranchaddress'),
					'BranchCity' => $this->input->post('abasebranchcity'),
					'Province' => $this->input->post('abasebranchprovince'),
					'ProvinceGrp' => $this->input->post('abasebranchprovincegroup'),
					'PostalCode' => $this->input->post('abasebranchpostalcode'),
					'Country' => $this->input->post('abasebranchcountry'),
					'PhoneNo' => $this->input->post('abasebranchphone'),
					'ContactNo' => $this->input->post('abasebranchcontact'),
					'ContactName' => $this->input->post('abasebranchcontactname'),
					'NPWP' => $this->input->post('abasebranchnpwp'),
					'Logo' => $this->input->post('abasebranchlogo'),
					'Email' => $this->input->post('abasebranchemail'),
					'WebAddress' => $this->input->post('abasebranchwebaddress'),
					'Remarks' => $this->input->post('abasebranchremarks')
				];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_02_branch', $data);
				break;
			case 'abasedepartment':
				$data = [
					'Branch' => $this->input->post('abasedepartmentbranch'),
					'BUCode' => $this->input->post('abasedepartmentbucode'),
					'DeptCode' => $this->input->post('abasedepartmentcode'),
					'DeptDes' => $this->input->post('abasedepartmentdescription'),
					'Remarks' => $this->input->post('abasedepartmentremarks')
				];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_03_dept', $data);
				break;
			case 'abasedepartmentbu':
				$data = [
					'DivCode' => $this->input->post('abasedepartmentbudivisioncode'),
					'BUCode' => $this->input->post('abasedepartmentbucode'),
					'BUDes' => $this->input->post('abasedepartmentbudescription'),
					'Remarks' => $this->input->post('abasedepartmentburemarks')
				];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_03_dept_bu', $data);
				break;
			case 'abasedepartmentdiv':
				$data = [
					'DivCode' => $this->input->post('abasedepartmentdivcode'),
					'DivDes' => $this->input->post('abasedepartmentdivdescription'),
					'Remarks' => $this->input->post('abasedepartmentdivremarks')
				];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_03_dept_div', $data);
				break;
			case 'abasecostcenter':
				$data = [
					'DeptCode' => $this->input->post('abasecostcenterdepartment'),
					'CostCenter' => $this->input->post('abasecostcentercode'),
					'CCDes' => $this->input->post('abasecostcenterdescription'),
					'Remarks' => $this->input->post('abasecostcenterremarks')
				];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_04_cost_center', $data);
				break;
		}

		if($result == 0){
			return set_error_response(self::HTTP_INTERNAL_ERROR, "Databse Error");
		}

		return set_success_response("Updated");
	}

	public function discDataMasterAbase()
	{
		$input = $this->input->post('input');
		$id = $this->input->post('id');
		$remarks = $this->input->post('remarks');
		$result = 0;
		switch ($input) {
			case 'abasecompany':
				$data = ['Disc' => 1, 'DiscDate' => date('Y-m-d')];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_01_com', $data);
				break;
			case 'abasebranch':
				$data = ['Disc' => '1', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_02_branch', $data);
				break;
			case 'abasedepartment':
				$data = ['Disc' => '1', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_03_dept', $data);
				break;
			case 'abasedepartmentbu':
				$data = ['Disc' => '1', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_03_dept_bu', $data);
				break;
			case 'abasedepartmentdiv':
				$data = ['Disc' => '1', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_03_dept_div', $data);
				break;
			case 'abasecostcenter':
				$data = ['Disc' => 1, 'DiscDate' => date('Y-m-d')];
				$result = $this->master->updateData('CtrlNo', $id, 'abase_04_cost_center', $data);
				break;
		}

		if($result !== 1){
			set_error_response(self::HTTP_INTERNAL_ERROR, "Database Error");
		}

		set_success_response("Deleted");
	}
	//Master Abase End

	//* STOCKGROUP
	public function viewModalMasterStockGroup()
	{
		switch ($this->input->post('input')) {
			case 'mas_stock_a_class':
				echo '<form id="form_stockclass">
						<div class="portlet light bordered">
							<div class="portlet-body">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="form-group">
											<label class="col-md-3 col-sm-3 control-label bold">Code : </label>
											<div class="col-md-9 col-sm-9">
												<input type="text" name="stockclasscode" id="stockclasscode" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 col-sm-3 control-label bold">Description : </label>
											<div class="col-md-9 col-sm-9">
												<input type="text" name="stockclassdescription" id="stockclassdescription" class="form-control">
											</div>
										</div>
									</div>
								</div>     
							</div>
						</div>
					</form>';
				break;
			case 'mas_stock_b_cat':
				echo '<form id="form_stockcategory">
						<div class="portlet light bordered">
							<div class="portlet-body">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="form-group has-error">
											<label class="col-md-3 col-sm-3 control-label bold">Class : </label>
											<div class="col-md-9 col-sm-9">
												<select name="stockclasscode" id="stockclasscode" class="form-control selectinput">
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 col-sm-3 control-label bold">Code : </label>
											<div class="col-md-9 col-sm-9">
												<input type="text" name="stockcatcode" id="stockcatcode" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 col-sm-3 control-label bold">Description : </label>
											<div class="col-md-9 col-sm-9">
												<input type="text" name="stockcatdescription" id="stockcatdescription" class="form-control">
											</div>
										</div>			                               
									</div>
								</div>     
							</div>
						</div>
					</form>';
				break;
			case 'mas_stock_c_type':
				echo '<form id="form_stocktype">
						<div class="portlet light bordered">
							<div class="portlet-body">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="form-group has-error">
											<label class="col-md-3 col-sm-3 control-label bold">Category : </label>
											<div class="col-md-9 col-sm-9">
												<select name="stockcatcode" id="stockcatcode" class="form-control selectinput">
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 col-sm-3 control-label bold">Code : </label>
											<div class="col-md-9 col-sm-9">
												<input type="text" name="stocktypecode" id="stocktypecode" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 col-sm-3 control-label bold">Description : </label>
											<div class="col-md-9 col-sm-9">
												<input type="text" name="stocktypedescription" id="stocktypedescription" class="form-control">
											</div>
										</div>
									</div>
								</div>     
							</div>
						</div>
					</form>';
				break;
			case 'mas_stock_d_grp':
				echo '<form id="form_stockgrp">
						<div class="portlet light bordered">
							<div class="portlet-body">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="form-group has-error">
											<label class="col-md-3 col-sm-3 control-label bold">Sub Category : </label>
											<div class="col-md-9 col-sm-9">
												<select name="stocktypecode" id="stocktypecode" class="form-control selectinput">
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 col-sm-3 control-label bold">Code : </label>
											<div class="col-md-9 col-sm-9">
												<input type="text" name="stockgrpcode" id="stockgrpcode" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 col-sm-3 control-label bold">Description : </label>
											<div class="col-md-9 col-sm-9">
												<input type="text" name="stockgrpdescription" id="stockgrpdescription" class="form-control">
											</div>
										</div>
									</div>
								</div>     
							</div>
						</div>
					</form>';
				break;
		}
	}

	public function getDataMasterStockGroup()
	{
		$input = $this->input->post('input');
		
		//From DataTables Ajax
		$limit = $this->input->post('length') ?? 100;
		$offset = $this->input->post('start') ?? 0;

		switch ($input) {
			case 'mas_stock_a_class':
				$hasil = $this->master->getWhere('*', 'tbl_mat_mas_stock_a_class', 'Disc', '0', $limit, $offset);
				echo json_encode($hasil);
				break;
			case 'mas_stock_b_cat':
				$hasil = $this->master->get_join_stockclass_stockcat($limit, $offset);
				echo json_encode($hasil);
				break;
			case 'mas_stock_c_type':
				$hasil = $this->master->get_join_stockcat_stocktype($limit, $offset);
				echo json_encode($hasil);
				break;
			case 'mas_stock_d_grp':
				$hasil = $this->master->get_join_stocktype_stockgroup($limit, $offset);
				echo json_encode($hasil);
				break;
		}
	}

	public function getDataMasterStockGroupByID()
	{
		$input = $this->input->post('input');
		switch ($input) {
			case 'mas_stock_a_class':
				$hasil = $this->master->getDataByID('tbl_mat_mas_stock_a_class', 'StockClassCode', $this->input->post('StockClassCode'));
				echo json_encode($hasil);
				break;
			case 'mas_stock_b_cat':
				$hasil = $this->master->getDataByID('tbl_mat_mas_stock_b_cat', 'CatCode', $this->input->post('CatCode'));
				echo json_encode($hasil);
				break;
			case 'mas_stock_c_type':
				$hasil = $this->master->getDataByID('tbl_mat_mas_stock_c_type', 'TypeCode', $this->input->post('TypeCode'));
				echo json_encode($hasil);
				break;
			case 'mas_stock_d_grp':
				$hasil = $this->master->getDataByID('tbl_mat_mas_stock_d_grp', 'GroupCode', $this->input->post('GroupCode'));
				echo json_encode($hasil);
				break;
		}
	}

	public function inputDataMasterStockGroup()
	{
		$input = $this->input->post('input');
		$result = false;
		
		switch ($input) {
			case 'mas_stock_a_class':
				$data = [
					'StockClassCode' => $this->input->post('stockclasscode'),
					'StockClassDescription' => $this->input->post('stockclassdescription'),
					'RegBy' => $this->session->userdata('IDNumber'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['StockClassCode' => $this->input->post('stockclasscode')];
				$result = $this->master->addData('tbl_mat_mas_stock_a_class', $data, $where);
				break;
			case 'mas_stock_b_cat':
				$data = [
					'CatCode' => $this->input->post('stockcatcode'),
					'CatDescription' => $this->input->post('stockcatdescription'),
					'StockClassCode' => $this->input->post('stockclasscode'),
					'RegBy' => $this->session->userdata('IDNumber'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['CatCode' => $this->input->post('stockcatcode')];
				$result = $this->master->addData('tbl_mat_mas_stock_b_cat', $data, $where);
				break;
			case 'mas_stock_c_type':
				$data = [
					'TypeCode' => $this->input->post('stocktypecode'),
					'TypeDescription' => $this->input->post('stocktypedescription'),
					'CatCode' => $this->input->post('stockcatcode'),
					'RegBy' => $this->session->userdata('IDNumber'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['TypeCode' => $this->input->post('stocktypecode')];
				$result = $this->master->addData('tbl_mat_mas_stock_c_type', $data, $where);
				break;
			case 'mas_stock_d_grp':
				$data = [
					'GroupCode' => $this->input->post('stockgrpcode'),
					'GroupDescription' => $this->input->post('stockgrpdescription'),
					'TypeCode' => $this->input->post('stocktypecode'),
					'RegBy' => $this->session->userdata('IDNumber'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['GroupCode' => $this->input->post('stockgrpcode')];
				$result = $this->master->addData('tbl_mat_mas_stock_d_grp', $data, $where);
				break;
		}

		if($result !== true){
			if($result == false){
				set_error_response(self::HTTP_INTERNAL_ERROR, "Database Error");
			}else{
				set_error_response(self::HTTP_INTERNAL_ERROR, $result);
			}
		}

		set_success_response("Added");
	}

	public function editDataMasterStockGroup()
	{
		$input = $this->input->post('input');
		$id  = $this->input->post('id');
		$result = 0;
		switch ($input) {
			case 'mas_stock_a_class':
				$data = [
					'StockClassCode' => $this->input->post('stockclasscode'),
					'StockClassDescription' => $this->input->post('stockclassdescription')
				];
				$result = $this->master->updateData('StockClassCode', $id, 'tbl_mat_mas_stock_a_class', $data);
				break;
			case 'mas_stock_b_cat':
				$data = [
					'CatCode' => $this->input->post('stockcatcode'),
					'CatDescription' => $this->input->post('stockcatdescription'),
					'StockClassCode' => $this->input->post('stockclasscode')
				];
				$result = $this->master->updateData('CatCode', $id, 'tbl_mat_mas_stock_b_cat', $data);
				break;
			case 'mas_stock_c_type':
				$data = [
					'TypeCode' => $this->input->post('stocktypecode'),
					'TypeDescription' => $this->input->post('stocktypedescription'),
					'CatCode' => $this->input->post('stockcatcode')
				];
				$result = $this->master->updateData('TypeCode', $id, 'tbl_mat_mas_stock_c_type', $data);
				break;
			case 'mas_stock_d_grp':
				$data = [
					'GroupCode' => $this->input->post('stockgrpcode'),
					'GroupDescription' => $this->input->post('stockgrpdescription'),
					'TypeCode' => $this->input->post('stocktypecode')
				];
				$result = $this->master->updateData('GroupCode', $id, 'tbl_mat_mas_stock_d_grp', $data);
				break;
		}

		if($result == 0){
			set_error_response(self::HTTP_INTERNAL_ERROR, "Database Error");
		}

		set_success_response("Updated");
	}

	public function discDataMasterStockGroup()
	{
		$input = $this->input->post('input');
		$id = $this->input->post('id');
		$remarks = $this->input->post('remarks');
		$result = 0;
		switch ($input) {
			case 'mas_stock_a_class':
				$data = ['Disc' => '1', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
				$result = $this->master->updateData('StockClassCode', $id, 'tbl_mat_mas_stock_a_class', $data);
				break;
			case 'mas_stock_b_cat':
				$data = ['Disc' => '1', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
				$result = $this->master->updateData('CatCode', $id, 'tbl_mat_mas_stock_b_cat', $data);
				break;
			case 'mas_stock_c_type':
				$data = ['Disc' => '1', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
				$result = $this->master->updateData('TypeCode', $id, 'tbl_mat_mas_stock_c_type', $data);
				break;
			case 'mas_stock_d_grp':
				$data = ['Disc' => '1', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
				$result = $this->master->updateData('GroupCode', $id, 'tbl_mat_mas_stock_d_grp', $data);
				break;
		}

		if($result !== 1){
			set_error_response(self::HTTP_INTERNAL_ERROR, "Database Error");
		}

		set_success_response("Deleted");
	}

	//* STORAGE
	function list_storage_dt()
	{
		$result = $this->master->get_list_storage_dt();
		echo $result;
	}

	function add_storage()
	{
		$storagename = null;
		if (!empty($this->input->post('n_storagename'))) {
			$storagename = $this->input->post('n_storagename');
		} else {
			$storagename =  "-";
		}
		$dstorage = array(
			'BranchCode' => $this->input->post('n_branch'),
			'StorageCode' => $this->input->post('n_storagecode'),
			'StorageName' => $storagename,
			'Address' => $this->input->post('n_address'),
			'ContactID' => $this->input->post('n_warehouseman'),
			'PhoneNo' => $this->input->post('n_phoneno'),
			'Fax' => $this->input->post('n_fax'),
			'Email' => $this->input->post('n_email'),
			'is_active' => '1',
			'RegBy' => $this->session->userdata('uid')
		);
		$rstatus = $this->master->insert('tbl_mat_cat_storage', $dstorage);
		echo json_encode(array(
			'rstatus' => $rstatus,
			'StorageCode' => $dstorage['StorageCode']
		));
	}

	function get_list_branch()
	{
		$data = $this->master->get_list_branch();
		echo json_encode($data);
	}

	function get_list_warehouseman()
	{
		$data = $this->master->get_list_warehouseman();
		echo json_encode($data);
	}

	function get_detwarehouseman_by_whmid()
	{
		$whmid = $this->input->post('id');
		$result = $this->master->get_detwarehouseman_by_whmid($whmid);
		echo json_encode($result);
	}

	function get_detail_storage()
	{
		$storagecode = $this->input->post('storagecode');
		$data = $this->master->get_detail_storage($storagecode);
		echo json_encode($data);
	}

	function get_detail_storage_to_edit()
	{
		$storagecode = $this->input->post('storagecode');
		$data = $this->master->get_detail_storage($storagecode);
		echo json_encode(array(
			'dbranch' => $this->master->get_list_branch(),
			'dwarehouseman' => $this->master->get_list_warehouseman(),
			'dstatus' => $this->master->get_list_status($storagecode),
			'dstorage' => $data
		));
	}

	function edit_storage()
	{
		$storagename = null;
		$storageid = $this->input->post('id_storagecode');
		if (!empty($this->input->post('en_storagename'))) {
			$storagename = $this->input->post('en_storagename');
		} else {
			$storagename =  "-";
		}
		$dstorage = array(
			'BranchCode' => $this->input->post('en_branch'),
			'StorageCode' => $this->input->post('en_storagecode'),
			'StorageName' => $storagename,
			'Address' => $this->input->post('en_address'),
			'ContactID' => $this->input->post('en_warehouseman'),
			'PhoneNo' => $this->input->post('en_phoneno'),
			'Fax' => $this->input->post('en_fax'),
			'Email' => $this->input->post('en_email'),
			'is_active' => $this->input->post('en_status')
		);
		$rstatus = $this->master->update_data_storage($dstorage, $storageid);
		echo json_encode(array(
			'rstatus' => $rstatus,
			'StorageCode' => $dstorage['StorageCode']
		));
	}

	public function discDataStorage()
	{
		$scode = $this->input->post('scode');
		$remarks = $this->input->post('remarks');
		$data = ['Disc' => '1', 'is_active' => '0', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
		$hasil = $this->master->updateData('StorageCode', $scode, 'tbl_mat_cat_storage', $data);
	}

	function delete_storage_by_storageid()
	{
		$storagecode = $this->input->post('storagecode');
		$rstatus = $this->master->delete_storage_by_storagecode('tbl_mat_cat_storage', $storagecode);
		if ($rstatus != false) {
			echo json_encode(array(
				'rstatus' => true,
				'StorageCode' => $storagecode
			));
		} else {
			echo json_encode(array(
				'rstatus' => false
			));
		}
	}

	//* STOCKCODE
	function list_stock_dt()
	{
		$result = $this->master->get_list_stock_dt();
		echo $result;
	}

	function list_stock_dt_disc()
	{
		$result = $this->master->get_list_stock_dt_disc();
		echo $result;
	}

	public function discDataStockcode()
	{
		$stcode = $this->input->post('stcode');
		$remarks = $this->input->post('remarks');
		$data = ['Disc' => '1', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
		$hasil = $this->master->updateData2('Stockcode', $stcode, 'tbl_mat_stock', $data);
		$hasil = $this->master->updateData2('Stockcode', $stcode, 'tbl_mat_stockcode', $data);
		$hasil = $this->master->updateData2('Stockcode', $stcode, 'tbl_mat_stock_reg', $data);
	}

	public function continueDataStockcode()
	{
		$stcode = $this->input->post('stcode');
		$data = ['Disc' => '0', 'DiscDate' => null, 'Remarks' => null];
		$hasil = $this->master->updateData2('Stockcode', $stcode, 'tbl_mat_stock', $data);
		$hasil = $this->master->updateData2('Stockcode', $stcode, 'tbl_mat_stockcode', $data);
		$hasil = $this->master->updateData2('Stockcode', $stcode, 'tbl_mat_stock_reg', $data);
	}

	//* UNIT OF MATERIAL
	function list_uom_dt()
	{
		$result = $this->master->get_list_uom_dt();
		echo $result;
	}

	//* CUSTOMER PRICE
	public function getDataMaster()
	{
		$input = $this->input->post('input');
		
		//From DataTables Ajax
		$limit = $this->input->post('length') ?? 100;
		$offset = $this->input->post('start') ?? 0;

		switch ($input) {
			case 'mas_customer_price_type':
				$hasil = $this->master->getWhere('*', 'tbl_mat_cat_customer_price', 'Disc', '0', $limit, $offset);
				echo json_encode($hasil);
				break;
		}
	}

	public function viewModalMaster()
	{
		switch ($this->input->post('input')) {
			case 'mas_customer_price_type':
				echo '<form id="form_custtypeprice">
						<div class="portlet light bordered">
		                    <div class="portlet-body">
		                        <div class="form-horizontal">
		                            <div class="form-body">
		                                <div class="form-group">
		                                    <label class="col-md-3 col-sm-3 control-label bold">Code : </label>
		                                    <div class="col-md-9 col-sm-9">
		                                        <input type="text" name="custtype" id="custtype" class="form-control">
		                                    </div>
		                                </div>
		                                <div class="form-group">
		                                    <label class="col-md-3 col-sm-3 control-label bold">Description : </label>
		                                    <div class="col-md-9 col-sm-9">
		                                        <input type="text" name="custtypedesc" id="custtypedesc" class="form-control">
		                                    </div>
		                                </div>
		                            </div>
		                        </div>     
		                    </div>
		                </div>
		             </form>';
				break;
		}
	}
	public function inputDataMaster()
	{
		$input = ($this->input->post('input'));
		switch ($input) {
			case 'mas_customer_price_type':
				$data = [
					'CustType' => $this->input->post('custtype'),
					'CustTypeDesc' => $this->input->post('custtypedesc'),
					'RegBy' => $this->session->userdata('uid'),
					'RegDate' => date('Y-m-d')
				];
				$where = ['CustType' => $this->input->post('custtype')];
				$hasil = $this->master->addData('tbl_mat_cat_customer_price', $data, $where);
				echo json_encode($hasil);
				break;
		}
	}

	public function getDataMasterByID()
	{
		$input = $this->input->post('input');
		$id = $this->input->post('CustType');
		switch ($input) {
			case 'mas_customer_price_type':
				$hasil = $this->master->getDataByID('tbl_mat_cat_customer_price', 'CustType', $id);
				echo json_encode($hasil);
				break;
		}
	}

	public function editDataMaster()
	{
		$input = $this->input->post('input');
		$id  = $this->input->post('id');
		switch ($input) {
			case 'mas_customer_price_type':
				$data = [
					'CustType' => $this->input->post('custtype'),
					'CustTypeDesc' => $this->input->post('custtypedesc')
				];
				$hasil = $this->master->updateData('CustType', $id, 'tbl_mat_cat_customer_price', $data);
				echo json_encode($hasil);
				break;
		}
	}
	public function discDataMaster()
	{
		$input = $this->input->post('input');
		$id = $this->input->post('id');
		$remarks = $this->input->post('remarks');
		switch ($input) {
			case 'mas_customer_price_type':
				$data = ['Disc' => '1', 'DiscDate' => date('Y-m-d'), 'Remarks' => $remarks];
				$hasil = $this->master->updateData('CustType', $id, 'tbl_mat_cat_customer_price', $data);
				break;
		}
	}

	//* CURRENCY
	function list_cur_dt()
	{
		$result = $this->master->get_list_cur_dt();
		echo $result;
	}

	function add_cur()
	{
		$cur = $this->input->post('n_cur');
		$currency = array(
			'Currency' => $this->input->post('n_cur'),
			'CurrencyName' => $this->input->post('n_curname'),
			// 'Disc' => $this->input->post('n_disc'),
			// 'Remarks' => $this->input->post('n_remarks'),
			'Disc' => '0'

		);
		$rstatus = $this->master->insert('tbl_fa_mas_currency', $currency);
		echo json_encode(array(
			'rstatus' => true,
			'Currency' => $currency['Currency']
		));
	}

	function get_detail_cur_to_edit()
	{
		$cur = $this->input->post('currencycode');
		$data = $this->master->get_detail_cur($cur);
		$yes_ = array(
			'yes' => 'Yes',
			'no' => 'No',
		);
		echo json_encode(array(
			'cur' => $this->master->get_all_cur(),
			'dcur' => $data,
			'yess' => $yes_['yes'],
			'noo' => $yes_['no'],
		));
	}

	function edit_cur()
	{
		$currency = $this->input->post('id_accno');
		$dstorage = array(
			'Currency' => $this->input->post('currency'),
			'CurrencyName' => $this->input->post('currencyname'),
			'Disc' => $this->input->post('ei_disc'),
			'Remarks' => $this->input->post('remarks'),
		);
		$rstatus = $this->master->update_data_cur($dstorage, $currency);
		echo json_encode(array(
			'rstatus' => $rstatus,
			'Currency' => $dstorage['Currency']
		));
	}

	function delete_cur_by_accgid()
	{
		$cur = $this->input->post('currencycode');
		$rstatus = $this->master->delete_cur_by_curcode('tbl_fa_mas_currency', $cur);
		if ($rstatus != false) {
			echo json_encode(array(
				'rstatus' => true,
				'Currency' => $cur
			));
		} else {
			echo json_encode(array(
				'rstatus' => false
			));
		}
	}
}
