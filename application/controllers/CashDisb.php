<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CashDisb extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('cashdisbursement/Mdl_cashdisbursement');

        //If there is no known user and role is wrong
        //redirect back to login page
        if ($this->session->userdata('status') != 'admin') {
            redirect('Auth/index');
        }
    }

    public function index()
    {   
        $query['title'] = 'Cash Disbursement';
        $query['headertitle'] = 'Cash Voucher';
        $query['getauto'] = $this->Mdl_cashdisbursement->getidcashauto();
        if ($query['getauto'] == '') {
          $increment = 0;
        }else{
        $increment=$query['getauto'][0]->CashCode;
        }
        $query['autoidnum'] = $increment + 1;
        $query['school'] = $this->Mdl_cashdisbursement->get_all_school_dropdown();
        $query['costcenter'] = $this->Mdl_cashdisbursement->get_all_costcenter_dropdown();
        $query['teacher_staff'] = $this->Mdl_cashdisbursement->get_all_personal_teacher_staff_dropdown();
        $this->load->view('cashdisbursement/v_new_cashdisbursement',$query);
    }


    //Start Save Data
    public function view_save_cash_voucher($id)
    {   
        $query['title'] = 'Cash Disbursement';
        $query['headertitle'] = 'Cash Voucher';
        $query['get_data_mas_save_cash_voucher'] = $this->Mdl_cashdisbursement->get_data_master_cash_voucher_save($id);
        $query['school'] = $this->Mdl_cashdisbursement->get_all_school_dropdown();
        $query['schoolsave'] = $this->Mdl_cashdisbursement->get_data_school_save($id);
        $query['costcenter'] = $this->Mdl_cashdisbursement->get_all_costcenter_dropdown();
        $query['costcentersave'] = $this->Mdl_cashdisbursement->get_data_costcenter_save($id);
        $query['teacher_staff'] = $this->Mdl_cashdisbursement->get_all_personal_teacher_staff_dropdown();
        $query['teacher_staffsave'] = $this->Mdl_cashdisbursement->get_data_teacher_staff_save($id);
        $query['accno'] = $this->Mdl_cashdisbursement->get_data_accno();
        $this->load->view('cashdisbursement/v_save_cashdisbursement',$query);
    }

    function get_data_det_cashvoucher(){
        $id = $this->input->post('idcv');
        $get_det_cashvoucher = $this->Mdl_cashdisbursement->get_data_detail_cash_voucher_save($id);
        $accno= $this->Mdl_cashdisbursement->get_data_accno();
        $value = '';
        $total = 0;
        $no=1; if ($get_det_cashvoucher != null) {
        foreach ($get_det_cashvoucher as $dcvoucher ) {
        $value .='<tr>';
        $value .='<td><button class="btn btn-primary">'.$no.'</button></td>';
        $value .='<td>';
        $value .='<div class="form-group">';
        $value .='<input  type="text" class="form-control" name ="desc_[]" value="'.$dcvoucher->Description.'" placeholder="">';
        $value .='</div>';
        $value .='</td>';
        $value .='<td>';
        $value .='<div class="form-group">';
        $value .='<select name="accno_[]"  class="form-control input-md">';
        $value .='<option value="'.$dcvoucher->AccountNo.'">'.$dcvoucher->Acc_Name.'<span>*</span></option>';
                foreach($accno as $cvaccno) {
                    $value .='<option  value="'.$cvaccno->Acc_No.'">'.$cvaccno->Acc_Name.'</option>';
                }
        $value .='</select>';
        $value .='</div>';
        $value .='</td>';
        $value .='<td>';
        $value .='<div class="form-group">';
        $value .='<input  type="number" class="form-control input-md qty-cls text-right" name ="qty_[]" value="'.$dcvoucher->Qty.'" placeholder="">';
        $value .='</div>';
        $value .='</td>';
        $value .='<td>';
        $value .='<div class="form-group">';
        $value .='<input  type="number" class="form-control input-md price-cls text-right" name ="price_[]" value="'.$dcvoucher->Price.'" placeholder="">';
        $value .='</div>';
        $value .='</td>';
        $value .='<td>';
        $value .='<div class="form-group">';
        $value .='<input  type="number" class="form-control input-md amount-avb text-right" name ="amount_[]" value="'.$dcvoucher->Qty * $dcvoucher->Price.'" readonly placeholder="">';
        $value .='</div>';
        $value .='</td>';
        $value .='<td>';
        $value .='<a><i class="fa fa-close" style="color: maroon" onclick="delete_cashvoucher('.$dcvoucher->CashDetNo.')" title="Delete Data"></i></a>';
        $value .='</td>';
        $value .='</tr>'; 
        $total += ($dcvoucher->Qty * $dcvoucher->Price);
        $no++;}
        }else{
            $value .='<tr>';
            $value .='<td align="center" colspan="12"><font color="red"><u><i>Tidak Ada Data!</i></u></font></td>';
            $value .='</tr>';
        }            

        $data = [
            'render' => $value,
            'tot_amount' => $total
        ];

        echo json_encode($data);
    }

    function inputrowcashvoucher(){
        $cvdesc_ = $this->input->post('new_cvdesc');
        $cvaccno_ = $this->input->post('new_cvaccno');
        $cvqty_ = $this->input->post('new_cvqty');
        $cvprice_ = $this->input->post('new_cvprice');
        $cvamount_ = $this->input->post('new_cvamount');
        $id = $this->input->post('id_cv');

        $data = array(
          'CashCode' => $id,
          'Description' => $cvdesc_,
          'AccountNo' => $cvaccno_,
          'Qty' => $cvqty_,
          'Price' => $cvprice_,
          'Amount' => $cvamount_
        );

        $this->Mdl_cashdisbursement->insert('tbl_cash_voucher_det',$data);
        echo json_encode($id);
    }

    function delrowbudget(){
        $cashdetno = $this->input->post('cash_det_no');
        $this->Mdl_cashdisbursement->delete_row_cash_voucher($cashdetno);
        echo json_encode($cashdetno);
    }
    //End Save Data


    //Start Add Row
    function get_data_account(){
        $select_box = '';
        $data_accno = $this->Mdl_cashdisbursement->get_data_accno();
        $select_box .= '<option value="">--Pilih Account--</option>';
        foreach ($data_accno as $row) {
          # code...
          $select_box .= '<option value="'.$row->Acc_No.'">'.$row->Acc_No.' - '.$row->Acc_Name.'</option>';
        }
        echo json_encode($select_box);
    }
    //End Add Row

    //Insert Data Save
    function transfer_cash_voucher(){
        if ($this->input->post('save')) {
            //Master Cash Voucher
            $query['CCcashcode'] = $cashcode_ = $this->input->post('cashcode');
            $query['CCreqby'] = $reqby_ = $this->input->post('reqby');
            $query['CCsch'] = $sch_ = $this->input->post('sch');
            $query['CCcc'] = $cc_ = $this->input->post('cc');
            $query['CCpaidto'] = $paidto_ = $this->input->post('paidto');
            $query['CCdatetrans'] = $datetrans_ = $this->input->post('datetrans');
            $query['CCwo'] = $wo_ = $this->input->post('wo');
            $query['CCremarks'] = $remarks_ = $this->input->post('remarks');

            //Array Detail Cash Voucher
            $query['CCdesc'] = $detdesc_ = $this->input->post('desc_');
            $query['CCaccno'] = $detaccno_ = $this->input->post('accno_');
            $query['CCqty'] = $detqty_ = $this->input->post('qty_');
            $query['CCprice'] = $detprice_ = $this->input->post('price_');
            $query['CCamount'] = $detamount_ = $this->input->post('amount_');

            $id = $this->input->post('cashcode');
            $dataMasterCashVoucher=array(
                'CashCode' =>$cashcode_,
                'ReqBy' =>$reqby_,
                'ReqDate' => date('Y-m-d'),
                'Branch' =>$sch_,
                'CostCenterCode' => $cc_,
                'PaidTo' =>$paidto_,
                'DateTrans' => $datetrans_,
                'WO' => $wo_,
                'Remarks' => $remarks_,
                'StatusPost' => 'Save'
                );
            $datainsert = $this->Mdl_cashdisbursement->insert('tbl_cash_voucher_mas', $dataMasterCashVoucher);
            if ($datainsert != null) {
                 $codecash = $this->Mdl_cashdisbursement->get_last_cashcode();
                    foreach ($detdesc_ as $key => $value) {
                        # code...
                        $dataDetailCashVoucher=array(
                          'CashCode' =>$codecash->CashCode,
                          'Description' =>$detdesc_[$key],
                          'AccountNo' =>$detaccno_[$key],
                          'Qty' =>$detqty_[$key],
                          'Price' =>$detprice_[$key],
                          'Amount' =>$detamount_[$key]
                        );    
                        $this->Mdl_cashdisbursement->insert('tbl_cash_voucher_det', $dataDetailCashVoucher);
                    }
                    $this->session->set_flashdata('success_saved', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Saved</center> </div>');
                        // redirect('CashDisb/view_save_budget/'.$id);
                        redirect('CashDisb/index');
            }else{
                $this->session->set_flashdata('error_msg_added', '<div class="alert alert-danger alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Failed to added data!</strong></center> </div>');
                 // redirect('CashDisb/view_save_budget/'.$id);
                 redirect('CashDisb/index');
            }               
        }
    }
    //End Insert Data Save

    //Start Insert Data to Submit
    function submit_datacashvoucher(){
        if ($this->input->post('submit')) {
            $id = $this->input->post('cashcode');
            $data_mas_cashvoucher = array(
                'ReqBy' => $this->input->post('reqby'),
                'ReqDate' => date('Y-m-d'),
                'Branch' => $this->input->post('sch'),
                'CostCenterCode' => $this->input->post('cc'),
                'PaidTo' => $this->input->post('paidto'),
                'DateTrans' => $this->input->post('datetrans'),
                'WO' => $this->input->post('wo'),
                'Remarks' => $this->input->post('remarks'),
                'StatusPost' => 'Submit'
            );
            $this->Mdl_cashdisbursement->update_master_cashvoucher($id, $data_mas_cashvoucher);
            $delrowcashvoucher_= $this->Mdl_cashdisbursement->delete_det_cashvoucher($id);
            if($delrowcashvoucher_ == "success"){
                $cvdesc = $this->input->post('desc_');
                $cvaccno = $this->input->post('accno_');
                $cvqty = $this->input->post('qty_');
                $cvprice = $this->input->post('price_');
                $cvamount = $this->input->post('amount_');
                foreach ($cvdesc as $key => $value) {
                    $cv = array(
                        'CashCode' => $id,
                        'Description' => $value,
                        'AccountNo' => $cvaccno[$key],
                        'Qty' => $cvqty[$key],
                        'Price' => $cvprice[$key],
                        'Amount' => $cvamount[$key]
                    );
                    $this->Mdl_cashdisbursement->insert('tbl_cash_voucher_det', $cv);
                }
            }                    
            $this->session->set_flashdata('success_added', '<div class="alert alert-success alert-dismissable"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button> <center><strong>Success!</strong> data has been Update</center> </div>');
            redirect('CashDisb');        
        }
    }
    //End Insert Data to Submit
}
