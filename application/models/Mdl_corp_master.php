<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_corp_master extends CI_Model {
    
    function insert($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

	public function addData($table, $data, $where){
		$this->db->trans_start();

        if($where){
            $check = $this->db->get_where($table, $where)->row_array();

            if($check > 0){
                return 'Data Exist';
            } else {
                $this->db->insert($table, $data);
            }
        } else {
            $this->db->insert($table, $data);
        }
    		
		$this->db->trans_complete();

		if($this->db->trans_status()){
            $this->db->trans_commit();
            
            return true;
        }else{
            $this->db->trans_rollback();
            
            return false;
        }
	}

	public function getData($table){
		return $this->db->get($table)->result_array();
	}

	public function getWhere($select, $table, $where, $val, $limit, $offset){
		return $this->db->select($select)->limit($limit, $offset)->get_where($table, [$where => $val])->result_array();
	}

	public function updateData($where, $val, $table, $data){
		$this->db->where($where, $val);
        $result = $this->db->update($table, $data);
		return $result;
	}

    public function updateData2($where, $val, $table, $data){
        $this->db->where($where, $val);
        return $this->db->update($table, $data);
    }

	public function getDataByID($table, $where, $id){
		return $this->db->get_where($table, [$where => $id])->row_array();
	}

	function getLastID($select, $table, $order, $by){
        $this->db->select($select);
        $this->db->from($table);
        $this->db->order_by($order,$by);
        $this->db->limit(1);
        $query = $this->db->get();
        $querys = $this->db->affected_rows();
        if ($querys > 0) {
            # code...
            return $query->row();
        }else{
            return null;
        }
    }

    public function M_check_company(){
    	$check = $this->db->get_where('abase_01_com', ['Disc' => 0])->row_array();

    	if($check > 0){
    		return true;
    	} else {
    		return false;
    	}
    }

    public function M_get_company(){
    	// return $this->db->get('abase_01_com')->row_array();
        // $data = $this->db->query("SELECT a.*,b.NameLWC,c.Province,d.RegionDes,e.City FROM abase_01_com a LEFT JOIN abase_03_country b ON b.ISO = a.Country LEFT JOIN abase_03_province c ON c.P_BSNI = a.Province LEFT JOIN abase_03_region d ON d.RegionCode = a.Region LEFT JOIN abase_03_city e ON e.K_BSNI = a.City WHERE a.Disc = '0'");
        $data = $this->db->query("SELECT * FROM abase_01_com WHERE Disc = '0'");
        if ($data) {
            return $data->row_array();
        }else{
            return null;
        }
    }

    function get_join_bu($limit, $offset){
        $data = $this->db->query(
            "SELECT 
                a.CtrlNo,
                a.BUCode,
                a.BUDes,
                a.DivCode,
                a.RegBy,
                a.RegDate,
                a.Disc,
                a.DiscDate,
                a.Remarks,
                b.DivDes
             FROM abase_03_dept_bu a 
             LEFT JOIN abase_03_dept_div b 
                ON b.DivCode = a.DivCode 
             WHERE a.Disc = '0'
             LIMIT $offset, $limit");
        if ($data) {
            return $data->result_array();
        }else{
            return null;
        }
    }

    function get_join_dept($limit, $offset){
        $data = $this->db->query(
            "SELECT 
                a.CtrlNo,
                a.DeptCode,
                a.DeptDes,
                a.Branch,
                a.BUCode,
                a.RegBy,
                a.RegDate,
                a.Disc,
                a.DiscDate,
                a.Remarks,
                b.BUDes,c.BranchName 
             FROM abase_03_dept a 
             LEFT JOIN abase_03_dept_bu b 
                ON b.BUCode = a.BUCode 
             LEFT JOIN abase_02_branch c 
                ON c.BranchCode = a.Branch 
             WHERE a.Disc = '0'
             LIMIT $offset, $limit");
        if ($data) {
            return $data->result_array();
        }else{
            return null;
        }
    }

    function get_join_cc($limit, $offset){
        $data = $this->db->query("SELECT 
            a.CostCenter,
            a.CCDes,
            a.DeptCode,
            a.RegBy,
            a.RegDate,
            a.Disc,
            a.DiscDate,
            a.Remarks,
            b.DeptDes 
         FROM abase_04_cost_center a 
         LEFT JOIN abase_03_dept b 
            ON b.DeptCode = a.DeptCode 
         WHERE a.Disc = '0'
         LIMIT $offset, $limit");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_join_stockclass_stockcat($limit, $offset){
        $data = $this->db->query(
            "SELECT 
                a.CatCode,
                a.CatDescription,
                a.StockClassCode,
                a.RegBy,
                a.RegDate,
                a.Disc,
                a.DiscDate,
                a.Remarks,
                b.StockClassDescription 
             FROM tbl_mat_mas_stock_b_cat a 
             LEFT JOIN tbl_mat_mas_stock_a_class b 
                ON b.StockClassCode = a.StockClassCode 
            WHERE a.Disc = '0'
            LIMIT $offset, $limit
        ");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_join_stockcat_stocktype($limit, $offset){
        $data = $this->db->query(
            "SELECT 
                a.TypeCode,
                a.TypeDescription,
                a.CatCode,
                a.RegBy,
                a.RegDate,
                a.Disc,
                a.DiscDate,
                a.Remarks,
                b.CatDescription 
             FROM tbl_mat_mas_stock_c_type a 
             LEFT JOIN tbl_mat_mas_stock_b_cat b 
                ON b.CatCode = a.CatCode 
            WHERE a.Disc = '0'
            LIMIT $offset, $limit
        ");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    function get_join_stocktype_stockgroup($limit, $offset){
        $data = $this->db->query(
            "SELECT 
                a.GroupCode,
                a.GroupDescription,
                a.TypeCode,
                a.RegBy,
                a.RegDate,
                a.Disc,
                a.DiscDate,
                a.Remarks,
                b.TypeDescription 
             FROM tbl_mat_mas_stock_d_grp a 
             LEFT JOIN tbl_mat_mas_stock_c_type b 
                ON b.TypeCode = a.TypeCode 
            WHERE a.Disc = '0'
            LIMIT $offset, $limit
        ");
        if ($data) {
            return $data->result();
        }else{
            return null;
        }
    }

    //Master

    //UOM Start
    function get_list_uom_dt()
    {
        $this->dtables->select("a.CtrlNo, a.UOMCode, a.UOMDesc, a.Disc, a.Remarks");
        $this->dtables->from("tbl_mat_mas_uom a");
        $this->dtables->add_column('view',
            '<button id="edit_uom" class="btn btn-outline btn-xs green" title="Edit" uom-code="$1"><i class="fa fa-pencil"></i></button>' .
            '<button id="delete_uom" class="btn btn-outline btn-xs red" title="Delete" uom-code="$1"><i class="fa fa-trash"></i></button>', 'UOMCode');
        return $this->dtables->generate();
    }
    //UOM End

    //Currency Start
    function get_list_cur_dt()
    {
        $this->dtables->select("a.CtrlNo, a.Currency, a.CurrencyName, a.Disc, a.Remarks");
        $this->dtables->from("tbl_fa_mas_cur a");
        $this->dtables->add_column('view',
            '<button id="edit_currency" class="btn btn-outline btn-xs green" title="Edit" currency-code="$1"><i class="fa fa-pencil"></i></button>' .
            '<button id="delete_currency" class="btn btn-outline btn-xs red" title="Delete" currency-code="$1"><i class="fa fa-trash"></i></button>', 'Currency');
        return $this->dtables->generate();
    }
    
    function update_data_cur($dstorage, $currency)
    {
        $this->db->where('Currency', $currency);
        $this->db->update('tbl_fa_mas_cur', $dstorage);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
    
    function get_detail_cur($currency)
    {
        $query = $this->db->query("SELECT * FROM tbl_fa_mas_cur WHERE Currency = '$currency'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_all_cur()
    {
        $this->db->select('*');
        $this->db->from('tbl_fa_mas_cur');
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            # code...
            return $data->result();
        } else {
            return false;
        }
    }
    
    function delete_cur_by_curcode($table, $id)
    {
        $this->db->delete($table, array('Currency' => $id));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    //Currency End

    //Start - Storage
    function get_last_storagecode(){
        $prefix = 'S';
        $query = $this->db->query("SELECT StorageCode FROM tbl_mat_cat_storage WHERE StorageCode = (SELECT MAX(StorageCode) FROM tbl_mat_cat_storage WHERE StorageCode LIKE 'S-%')");
        if ($query->num_rows() > 0) {
            $lstoragecode = $query->row()->StorageCode;
            $last = substr($lstoragecode, 2);
            $cur = $last + 1;
            return $prefix . '-' . str_pad($cur, 2, '0', STR_PAD_LEFT);
        } else {
            return 'S-001';
        }
    }

    function get_list_storage_dt(){
        $this->dtables->select("a.CtrlNo, a.BranchCode, b.BranchName, b.BranchType, a.StorageCode, a.StorageName, a.Address, a.ContactID, CONCAT_WS(' ', c.FirstName, c.LastName) AS FullName, a.PhoneNo, a.is_active");
        $this->dtables->from("tbl_mat_cat_storage a");
        $this->dtables->join("abase_02_branch b", "b.BranchCode = a.BranchCode", "LEFT");
        $this->dtables->join("tbl_mat_cat_officer c", "c.IDNumber = a.ContactID", "LEFT");
        $this->dtables->where('a.Disc', '0');
        $this->dtables->add_column('view',  '<button id="detail_storage" class="btn btn-outline btn-xs blue" title="Detail" storage-code="$1"><i class="fa fa-search"></i></button>'. 
                                            '<button id="edit_storage" class="btn btn-outline btn-xs green" title="Edit" storage-code="$1"><i class="fa fa-pencil"></i></button>'. '<button id="disc_storage" class="btn btn-outline btn-xs yellow" title="Disc" storage-code="$1"><i class="fa fa-close"></i></button>'/*. 
                                            '<button id="delete_storage" class="btn btn-outline btn-xs red" title="Delete" storage-code="$1"><i class="fa fa-trash"></i></button>'*/, 'StorageCode');
        return $this->dtables->generate();        
    }

    function get_detail_storage($storagecode){
        $query = $this->db->query("SELECT * FROM tbl_mat_cat_storage WHERE StorageCode = '$storagecode'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_list_branch(){
        $query = $this->db->query("SELECT BranchCode, BranchName, BranchType FROM abase_02_branch WHERE Disc = '0'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }    

    function get_list_warehouseman(){
        $query = $this->db->query("SELECT IDNumber, CONCAT_WS(' ', FirstName, LastName) AS FullName FROM tbl_mat_cat_officer WHERE JobTitle = 'Warehouseman'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_detwarehouseman_by_whmid($id){
        $query = $this->db->query("SELECT BusinessPhone, FaxNumber, Email FROM tbl_mat_cat_officer WHERE IDNumber = '$id'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
        
    }

    function get_list_status($storagecode){
        $query = $this->db->query("SELECT is_active FROM tbl_mat_cat_storage WHERE StorageCode = '$storagecode'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function update_data_storage($dstorage, $idstorage){
        $this->db->where('CtrlNo', $idstorage);
        $this->db->update('tbl_mat_cat_storage', $dstorage);
        return ($this->db->affected_rows() > 0) ? true : false;        
    }

    function delete_storage_by_storagecode($table, $id){
        $this->db->delete($table, array('StorageCode' => $id));
        if($this->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    //End - Storage

    //Start - Stockcode
    function get_list_stock_dt(){
        $this->dtables->select('CtrlNo, Stockcode, ManufactureNo, Superceded, Barcode, StockDescription, ManufactureDesc, ModelNo, Size, Color, UOM, UOMQty, StockGroup, Photo, DiscDate, Remarks');
        $this->dtables->from('tbl_mat_stockcode');
        $this->dtables->where('Disc', '0');
        $this->dtables->add_column('view', '<a href="'.site_url('APOSMaster/v_detail_stockcode/').'$1" class="btn btn-outline btn-xs blue detail-stock" title="Detail" target="_blank"><i class="fa fa-search"></i></a>'. 
                                            '<a href="'.site_url('APOSMaster/v_edit_stockcode/').'$1" class="btn btn-outline btn-xs green" target="_blank" title="Edit"><i class="fa fa-pencil"></i></a>' . '<button id="disc_stockcode" class="btn btn-outline btn-xs yellow" title="Discontinue" stock-code="$1"><i class="fa fa-close"></i></button>'/*. 
                                            '<a href="#" class="btn btn-outline btn-xs red" title="Delete"><i class="fa fa-trash"></i></a>'*/, 'Stockcode');
        return $this->dtables->generate();
    }

     function get_list_stock_dt_disc(){
        $this->dtables->select('CtrlNo, Stockcode, ManufactureNo, Superceded, Barcode, StockDescription, ManufactureDesc, ModelNo, Size, Color, UOM, UOMQty, StockGroup, Photo, DiscDate, Remarks');
        $this->dtables->from('tbl_mat_stockcode');
        $this->dtables->where('Disc', '1');
        $this->dtables->add_column('view','<button id="continue_stockcode" class="btn btn-outline btn-xs green" title="Continue" stock-code="$1"><i class="fa fa-check-square-o" title="Continue"></i></button>','Stockcode');
        return $this->dtables->generate();
    }
    //End - Stockcode
}