<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Elq_fin_transaction extends Eloquent
{
    protected $table = 'tbl_fa_transaction';
    public $timestamps = false;
    public $primaryKey = "CtrlNo";
}