<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Elq_department extends Eloquent
{
    protected $table = 'abase_03_dept';
    public $timestamps = false;
}