<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Elq_fin_detail extends Eloquent
{
    protected $table = 'tbl_fa_treasury_det';
    public $timestamps = false;
    public $primaryKey = "CtrlNo";
}