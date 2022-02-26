<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Elq_employee extends Eloquent
{
    protected $table = 'tbl_fa_hr_append';
    public $timestamps = false;
    public $primaryKey = "CtrlNo";
}