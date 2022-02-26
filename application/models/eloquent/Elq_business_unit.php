<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Elq_business_unit extends Eloquent
{
    protected $table = 'abase_03_dept_bu';
    public $timestamps = false;
    public $primaryKey = "CtrlNo";
}