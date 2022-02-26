<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Elq_company extends Eloquent
{
    protected $table = 'abase_01_com';
    public $timestamps = false;
    public $primaryKey = "CtrlNo";
}