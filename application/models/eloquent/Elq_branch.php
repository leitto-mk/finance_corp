<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Elq_branch extends Eloquent
{
    protected $table = 'abase_02_branch';
    public $timestamps = false;
    public $primaryKey = "CtrlNo";
}