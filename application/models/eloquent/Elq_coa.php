<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Elq_coa extends Eloquent
{
    protected $table = 'tbl_account_no';
    public $timestamps = false;
}